# sync-wp-steem-comments

Sync WP Steem Comments can sync Steemit and WordPress comments.

## What is the project about?

Before I found [Steemit](https://steemit.com), I am a [WordPress](https://wordpress.org/) blog writer. I write blog on my [WordPress site](http:tson.com) for more than 2 years. Now I am moving to Steemit, but I also post my articals in my WordPress site. But I found a question: some readers leave comments after my post asking the same question on the two different sites. So I must answer them twice. I think there are a lot of blog writers have this problem too. So I develop a wordpress plugin to solve this. Sync WP Steem Comments can sync Steemit and WordPress comments.

## Roadmap
I have a detailed plan for this plugin.

### 1. Connect WordPress articles and Steemit articles

I need extend WordPress articles let them have an additional field to save the permlink of the Steemit articles. In this way when we publish a comment beside a WordPress article, the comment also can be send to Steemit article. Besides when we load the WordPress article this plugin also can pull comments from Steemit article.

Status: Already finished in Version 0.1

### 2. Pull the comments from Steemit to WordPress

When we request the WordPress articles, show the Steemit comments below the articles.

In version 0.1, Steemit comments will display before the Wrodpress comments. Also the apperance of the Steemit comments is different from the WordPress comments. This is a simple but useful way. On the other hand, I also can insert Steemit comments into WordPress's database. In this way, Steemit comments can look exactly the same as the WordPress comments. But every comments needs one more field to connected with the Steemit comment, this can lead to more pressure on the WordPress server.

Please give me feedback. I'll decide whether to upgrade the method or not.

### 3、将WordPress文章中的评论同步到Steemit中

现在的想法是将用户名和posting wif输入，每个人负责自己的评论的发布，这样就完全独立运行，与我个人的帐号没有什么关系。

# 4、实现WordPress文章的自动生成

这一点我认为比较有必要，使用用户名和permlink找到文章，然后更新到自己的wordpress上，这样两者也可以连接起来，方便又好用。

# 5、实现WordPress和Steemit文章的同步发布与更新

最后这个功能现在有正在开发的插件，要是到了这一步我会联系作者看能不能让两个插件进行兼容，这样的话就能省去不少的开发时间。

但最后一个功能使不使用我觉得是一个值得商议的事，因为这个方法可能会使steemit在短时间内充满大量的垃圾文章，所以。。。

## How to contribute?
Yes you can! Join in on our [GitHub repository](https://github.com/RileyGe/sync-wp-steem-comments/) :)

Please support me by following me on Steemit [@rileyge](https://steemit.com/@rileyge) or if you feel like donating, that would really help a lot on my future Steem developments around WordPress ecosystem. :)

## Where can I get support or talk to other users? Where can I report bugs or contribute to the project?

If you get stuck, you can ask for help in the [WordPress Steem GitHub repository](https://github.com/RileyGe/sync-wp-steem-comments/issues). Bugs also can be reported there.

    
