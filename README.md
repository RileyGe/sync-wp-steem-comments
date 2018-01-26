# sync-wp-steem-comments

Sync WP Steem Comments can sync Steemit and WordPress comments.

## What is the project about?

Before I found [Steemit](https://steemit.com), I am a [WordPress](https://wordpress.org/) blog writer. I write blog on my [WordPress site](http:tson.com) for more than 2 years. Now I am moving to Steemit, but I also post my articals in my WordPress site. But I found a question: some readers leave comments after my post asking the same question on the two different sites. So I must answer them twice. I think there are a lot of blog writers have this problem too. So I develop a wordpress plugin to solve this. Sync WP Steem Comments can sync Steemit and WordPress comments.

## Roadmap
I have a detailed plan for this plugin.

### 1. Connect WordPress articals and Steemit artical

I need extend WordPress articles let them have an additional field to save the permlink of the Steemit articles. In this way when we publish a comment beside a WordPress article, the comment also can be send to Steemit article. Besides when we load the WordPress article this plugin also can pull comments from Steemit article.

Status: Already finished in Version 0.1.

# 2、将Steemit中的评论拉取到WordPress文章评论中

在文章显示时，读取到steemit的用户名和permlink，通过两者查询到合适的评论，将其显示到合适的位置。

如果显示到合适的位置，如果同原有主题相一致，非常重要，需要不断研究。

完成到这一步可能就会出一个beta版，这样就可以在用户中进行测试与改进。看大家使用的兴致，下面的功能也会根据大家需要根进。

# 3、将WordPress文章中的评论同步到Steemit中

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

    
