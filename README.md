# SYNC-WP-STEEM-COMMENTS

Sync WP Steem Comments can sync Steemit and WordPress comments.

## What is the project about?

Before I found [Steemit](https://steemit.com), I am a [WordPress](https://wordpress.org/) blog writer. I write blog on my [WordPress site](http:tson.com) for more than 2 years. Now I am moving to Steemit, but I also post my articals in my WordPress site. But I found a question: some readers leave comments after my post asking the same question on the two different sites. So I must answer them twice. I think there are a lot of blog writers have this problem too. So I develop a wordpress plugin to solve this. Sync WP Steem Comments can sync Steemit and WordPress comments.

## How to use this plugin

## Roadmap
I have a detailed plan for this plugin.

### 1. Connect WordPress articles and Steemit articles

I need extend WordPress articles let them have an additional field to save the permlink of the Steemit articles. In this way when we publish a comment beside a WordPress article, the comment also can be send to Steemit article. Besides when we load the WordPress article this plugin also can pull comments from Steemit article.

Status: Already finished in Version 0.1

### 2. Pull the comments from Steemit to WordPress

When we request the WordPress articles, show the Steemit comments below the articles.

In version 0.1, Steemit comments will display before the Wrodpress comments. Also the apperance of the Steemit comments is different from the WordPress comments. This is a simple but useful way. On the other hand, I also can insert Steemit comments into WordPress's database. In this way, Steemit comments can look exactly the same as the WordPress comments. But every comments needs one more field to connected with the Steemit comment, this can lead to more pressure on the WordPress server.

Please give me feedback. I'll decide whether to upgrade the method or not.

Status: Finished in Version 0.1, but maybe need upgrade.

### 3. Push WordPress comments into Steemit

After version 0.1, I'll complete this function. There are two way to do this task:

* Use the author name and **PRIVATE POSTING KEY** push the comments. 
* Use my account to push the comments to your post.

First I think the two ways have no different, but if the users use my account to push the comments, I can get the data. From these data, I can know which article is popular in WordPress but not in Steemit. Then I can recommond these articles to other users.

### 4. Automatic generate WordPress article

After the article is published in Steemit, the article can be transmited to WordPress in one click.

### 5. Sync the WordPress and Steemit articles publish

**THIS FUNCTION IS NOT RECOMMOND**, because this function can be used to produce a greate amount of junk articles.

If users want to have this function, There are another plugin named [SteemPress](https://github.com/drov0/steempress). As the last step, I'll make sure this plugin can be working together whit [SteemPress](https://github.com/drov0/steempress).

## How to contribute?
Yes you can! Join in on our [GitHub repository](https://github.com/RileyGe/sync-wp-steem-comments/) :)

Please support me by following me on Steemit [@rileyge](https://steemit.com/@rileyge) or if you feel like donating, that would really help a lot on my future Steem developments around WordPress ecosystem. :)

## Where can I get support or talk to other users? Where can I report bugs or contribute to the project?

If you get stuck, you can ask for help in the [WordPress Steem GitHub repository](https://github.com/RileyGe/sync-wp-steem-comments/issues). Bugs also can be reported there.

    
