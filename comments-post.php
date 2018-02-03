<?php
/**
 * Handles Comment Post to WordPress and prevents duplicate comment posting.
 *
 * @package WordPress
 * 
 * This file is download from [qiqiboy/comments-post: Post a comment to wordpress blog from ajax](https://github.com/qiqiboy/comments-post)
 * And modified by [@rileyge](https://steemit.com/@rileyge)
 */

if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}

/** Sets up the WordPress Environment. */
require_once(dirname(__FILE__)."/../../../wp-load.php");

function cmt_die($state){
	output(array('err'=>$state));
}

function output($data){
	header('Content-Type: json; charset=UTF-8');
	echo json_encode($data);
	exit;
}

add_action( 'comment_duplicate_trigger', create_function('', 'cmt_die("COMMENT_DUPLICATE");') );

add_action( 'comment_flood_trigger', create_function('', 'cmt_die("COMMENT_FLOOD");') );

nocache_headers();

//由于传的是json数据，所以有很多需要改变
$json = file_get_contents('php://input');

$comment_post_ID = isset($json->post_id) ? (int) $json->post_id : 0;
//$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;

$post = get_post($comment_post_ID);

if ( empty( $post->comment_status ) ) {
	/**
	 * Fires when a comment is attempted on a post that does not exist.
	 *
	 * @since 1.5.0
	 *
	 * @param int $comment_post_ID Post ID.
	 */
	do_action( 'comment_id_not_found', $comment_post_ID );
	cmt_die( 'POST_NOT_EXISTS' );
	exit;
}

// get_post_status() will get the parent status for attachments.
$status = get_post_status($post);

$status_obj = get_post_status_object($status);

if ( ! comments_open( $comment_post_ID ) ) {
	/**
	 * Fires when a comment is attempted on a post that has comments closed.
	 *
	 * @since 1.5.0
	 *
	 * @param int $comment_post_ID Post ID.
	 */
	do_action( 'comment_closed', $comment_post_ID );
	cmt_die( 'CLOSED' );
} elseif ( 'trash' == $status ) {
	/**
	 * Fires when a comment is attempted on a trashed post.
	 *
	 * @since 2.9.0
	 *
	 * @param int $comment_post_ID Post ID.
	 */
	do_action( 'comment_on_trash', $comment_post_ID );
	cmt_die( 'POST_NOT_EXISTS' );
	exit;
} elseif ( ! $status_obj->public && ! $status_obj->private ) {
	/**
	 * Fires when a comment is attempted on a post in draft mode.
	 *
	 * @since 1.5.1
	 *
	 * @param int $comment_post_ID Post ID.
	 */
	do_action( 'comment_on_draft', $comment_post_ID );
	cmt_die( 'POST_NOT_EXISTS' );
	exit;
} elseif ( post_password_required( $comment_post_ID ) ) {
	/**
	 * Fires when a comment is attempted on a password-protected post.
	 *
	 * @since 2.9.0
	 *
	 * @param int $comment_post_ID Post ID.
	 */
	do_action( 'comment_on_password_protected', $comment_post_ID );
	cmt_die( 'POST_NEED_PASSWORD' );
	exit;
} else {
	/**
	 * Fires before a comment is posted.
	 *
	 * @since 2.8.0
	 *
	 * @param int $comment_post_ID Post ID.
	 */
	do_action( 'pre_comment_on_post', $comment_post_ID );
}

$comment_author       = ( isset($json->author) )  ? trim(strip_tags($json->author)) : null;
//由于很多博客都需要email，但steemit又没有email，避免错误，所以将其设置为一个默认的email
$comment_author_email = 'abc@example.com';
//$comment_author_email = ( isset($json->email) )   ? trim($_POST['email']) : null;
$comment_author_url   = 'https://steemit.com/'.$comment_author;
$comment_content      = ( isset($json->comment) ) ? trim($json->comment) : null;

// If the user is logged in
$user = wp_get_current_user();
if ( $user->exists() ) {
	if ( empty( $user->display_name ) )
		$user->display_name=$user->user_login;
	$comment_author       = wp_slash( $user->display_name );
	$comment_author_email = wp_slash( $user->user_email );
	$comment_author_url   = wp_slash( $user->user_url );
	if ( current_user_can( 'unfiltered_html' ) ) {
		if ( ! isset( $_POST['_wp_unfiltered_html_comment'] )
			|| ! wp_verify_nonce( $_POST['_wp_unfiltered_html_comment'], 'unfiltered-html-comment_' . $comment_post_ID )
		) {
			kses_remove_filters(); // start with a clean slate
			kses_init_filters(); // set up the filters
		}
	}
} else {
	if ( get_option( 'comment_registration' ) || 'private' == $status ) {
		cmt_die( 'MUST_LOGIN' );
	}
}

$comment_type = '';

if ( get_option('require_name_email') && !$user->exists() ) {
	if ( 6 > strlen( $comment_author_email ) || '' == $comment_author ) {
		cmt_die( 'NAME_EMAIL_EMPTY' );
	} else if ( ! is_email( $comment_author_email ) ) {
		cmt_die( 'EMAIL_ERROR' );
	}
}

if ( '' == $comment_content ) {
	cmt_die( 'COMMENT_EMPTY' );
}

if ( 5 > strlen($comment_content) ) {
	cmt_die( 'COMMENT_SHORT' );
}
//没有直接设置comment_parent，需要使用steem_parent来查询
$comment_parent_temp = get_post_meta($comment_post_ID, $json->steem_parent, true);
$comment_parent = ($comment_parent_temp != null) ? absint($comment_parent_temp) : 0;
//由于steemit上的评论一般不是当前，所以增加
$comment_date = isset($json->comment_date) ? $json->comment_date : current_time( 'mysql' );
$comment_date_gmt = isset($json->comment_date_gmt) ? $json->comment_date_gmt : get_gmt_from_date($comment_date);
$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_date', 'comment_date_gmt', 'comment_type', 'comment_parent', 'user_ID');

$comment_id = wp_new_comment( $commentdata );
if ( ! $comment_id ) {
	cmt_die( 'FAILD' );
}
/**
 * Added by [@rileyge](https://steemit.com/@rileyge)
 * 增加两个meta_data
 * 1、在当前POST的meta_data中，以当前permlink为key，以comment的id为value，增加meta_data
 * 2、在当前的comment的meta_data中，以'steem_permlink'为key，以permlink为value，增加meta_data
 * 
 * 两个meta_data造成了数据冗余，但各有用处
 * 场景1：当插入steemit的comment时需要根据parent来判断其父comment_parent的id为多少，使用1
 * 场景2：当前版本中尚没有使用，当我们想要有comment下进行一个回复时，想要将这个评论同步到steemit，
 * 此时需要用id查permlink
 */
$permlink = $json->steem_permlink;
update_post_meta($comment_post_ID, $permlink, $comment_id);
update_comment_meta( $comment_id, 'steem_permlink', $permlink);
$comment = get_comment( $comment_id );

/**
 * Perform other actions when comment cookies are set.
 *
 * @since 3.4.0
 *
 * @param object $comment Comment object.
 * @param WP_User $user   User object. The user may not exist.
 */
do_action( 'set_comment_cookies', $comment, $user );

/**
 * 以下部分为评论成功后的返回输出部分
 */ 

output($comment);

exit;

