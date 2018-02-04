<?php  
/*
Plugin Name: Sync WP Steem Comments
Plugin URI: http://steemit.com/@rileyge/
Description: This plugin will sync your the comments of your steemit account and your wordpress website.
Version: 0.0.1
Author: Riley Ge
Author URI: http://tson.com/
License: GPL
*/
/* 注册激活插件时要调用的函数 */ 
register_activation_hook(__FILE__, 'sync_ws_install');   

/* 注册停用插件时要调用的函数 */ 
register_deactivation_hook(__FILE__, 'sync_ws_remove' );  

function sync_ws_install() {  
    /* 在数据库的 wp_options 表中添加一条记录，第二个参数为默认值 */ 
    add_option("sync_ws_author", "");
    add_option("sync_ws_posting_key", "");
    add_option("sync_ws_comments_divid", "");
}

function sync_ws_remove() {  
    /* 删除 wp_options 表中的对应记录 */ 
    delete_option('sync_ws_author');  
    delete_option('sync_ws_posting_key');  
    delete_option("sync_ws_comments_divid");
}

if(is_admin()) {
    /*  利用 admin_menu 钩子，添加菜单 */
    add_action('admin_menu', 'sync_ws_menu');
}

function sync_ws_menu() {
    /* add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);  */
    /* 页名称，菜单名称，访问级别，菜单别名，点击该菜单时的回调函数（用以显示设置页面） */
    add_options_page('Sync WP Steemit Comments Setting', 'Sync WP Steemit Comments Setting', 'administrator','sync_ws', 'sync_ws_html_page');
}

function sync_ws_html_page() {
    ?>
    <div>  
        <h2>Sync WP Steemit Comments Setting</h2>  
        <form method="post" action="options.php">  
            <?php /* 下面这行代码用来保存表单中内容到数据库 */ ?>  
            <?php wp_nonce_field('update-options'); ?>  
 
            <p>  
                <span>Author:</span>
                <input name="sync_ws_author" id="sync_ws_author"
                value = '<?php echo get_option('sync_ws_author'); ?>'/>
            </p>   
            <p>
                <span>Posting Key:</span>  
                <input name="sync_ws_posting_key" id="sync_ws_posting_key"
                value = '<?php echo get_option('sync_ws_posting_key'); ?>'/>
            </p>
            <p>
                <span>Comments Div ID:</span>  
                <input name="sync_ws_comments_divid" id="sync_ws_comments_divid"
                value = '<?php echo get_option('sync_ws_comments_divid'); ?>'/>
            </p>
            <p>  
                <?php wp_nonce_field('update-options'); ?>    
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="sync_ws_author,sync_ws_posting_key,sync_ws_comments_divid" />  
 
                <input type="submit" value="Save" class="button-primary" />  
            </p>  
        </form>  
    </div>  
<?php  
}  

//add_filter('the_content',  'sync_ws');
// 添加回调函数到 init 动作上
add_action('wp_enqueue_scripts', 'sync_ws_enqueue_scripts' );
add_action('wp_footer', 'sync_wp_add_script');
function sync_wp_add_script() {
?>
    <script type="text/javascript">
        load_steemit_comments('<?php echo get_option('sync_ws_author'); ?>', 
        '<?php echo get_post_meta(get_the_ID(), "sync_ws_permlink_key")[0]; ?>', 
        '<?php echo get_option('sync_ws_comments_divid'); ?>');
    </script>
<?php
}


function sync_ws_enqueue_scripts() {
    if(is_single()) { //文章页面增加js
        // 去除已注册的 sync_ws_pull_comments 脚本
        wp_deregister_script('sync_ws_pull_comments');
        wp_deregister_script('sync_ws_steem_js');
        // 注册 jquery 脚本        
        wp_register_script('sync_ws_steem_js',  plugin_dir_url(__FILE__) . 'js/steem.min.js','', false, false);
        wp_register_script('sync_ws_pull_comments', plugin_dir_url(__FILE__) . 'js/pull_steem_comments.js', array('jquery', 'sync_ws_steem_js'), false, false);
        // 提交加载 jquery 脚本
        wp_enqueue_script('sync_ws_steem_js');
        wp_enqueue_script('sync_ws_pull_comments'); 
        
        wp_register_style('sync_ws_comment_style', plugin_dir_url(__FILE__) . 'css/sync-ws-style.css',  array(), '', 'all');  
        wp_enqueue_style('sync_ws_comment_style');  

    } 
}

/* 定义自定义Meta模块 */ 
add_action('add_meta_boxes', 'sync_ws_add_permlink_box');
 
// 向后兼容（WP3.0前）
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 ); 
/* 写入数据*/
add_action('save_post', 'sync_ws_save_post');
 
/*在文章和页面编辑界面的主栏中添加一个模块 */
function sync_ws_add_permlink_box() {
    $screens = array('post', 'page');
    foreach ($screens as $screen) {
        add_meta_box(
            'sync_ws_st_permlink',
            __('Steemit Post Permlink', 'sync_ws_textdomain'),
            'sync_ws_edit_custom_box',//回调函数
            $screen
        );
    }
}
 
/* 输出模块内容 */
function sync_ws_edit_custom_box($post) {
    // 使用随机数进行核查
    wp_nonce_field(plugin_basename( __FILE__ ), 'sync_ws');
    
    // 用于数据输入的实际字段
    // 使用 get_post_meta 从数据库中检索现有的值，并应用到表单中
    $value = get_post_meta($post->ID, 'sync_ws_permlink_key', true );
    echo '<label for="sync_ws_permlink">';
    _e("Steemit Post Permlink", 'sync_ws_textdomain');
    echo '</label> ';
    echo '<input type="text" id="sync_ws_permlink" name="sync_ws_permlink" value="'.esc_attr($value).'" size="25" />';
}
 
/* 文章保存时，保存我们的自定义数据*/
function sync_ws_save_post($post_id) {
 
    // 首先，我们需要检查当前用户是否被授权做这个动作。 
    if ('page'== $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }
 
    // 其次，我们需要检查，是否用户想改变这个值。
    if (!isset( $_POST['sync_ws'] ) || !wp_verify_nonce( $_POST['sync_ws'], plugin_basename( __FILE__ )))
        return;
 
    // 第三，我们可以保存值到数据库中
 
    //如果保存在自定义的表，获取文章ID
    $post_ID = get_the_ID();
    //过滤用户输入
    $permlink = sanitize_text_field($_POST['sync_ws_permlink']);
 
    // 使用$mydata做些什么 
    // 或者使用
    //add_post_meta($post_ID, '_my_meta_value_key', $mydata, true);
    update_post_meta($post_ID, 'sync_ws_permlink_key', $permlink);
}
?>
