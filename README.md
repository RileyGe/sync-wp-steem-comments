# SYNC-WP-STEEM-COMMENTS

Sync WP Steem Comments can sync Steemit and WordPress comments.

## What is the project about?

Before I found [Steemit](https://steemit.com), I am a [WordPress](https://wordpress.org/) blog writer. I write blog on my [WordPress site](http:tson.com) for more than 2 years. Now I am moving to Steemit, but I also post my articals in my WordPress site. But I found a question: some readers leave comments after my post asking the same question on the two different sites. So I must answer them twice. I think there are a lot of blog writers have this problem too. So I develop a wordpress plugin to solve this. Sync WP Steem Comments can sync Steemit and WordPress comments.

## How to use this plugin

### Step 1: download zip file from [github](https://github.com/RileyGe/sync-wp-steem-comments).
### Step 2: install this plugin in WordPress, and activate plugin.
### Step 3: setup the plugin, input the author name and your PRIVATE POSTING KEY.
You can input the author name and your PRIVATE POSTING KEY in the setting page.
![The Setting Page of Sycn-WP-Steem-Comments](https://github.com/RileyGe/sync-wp-steem-comments/blob/master/screenshot/SETTING-PAGE.PNG?raw=true)
### Step 4: input permlink of Steemit article in the post/update article page in WordPress and save the article.
You can input the Steemit article permlink in the WordPress posting article page.
![The Post Article Page of Sycn-WP-Steem-Comments](https://github.com/RileyGe/sync-wp-steem-comments/blob/master/screenshot/ADD-ARTICLE-PAGE.PNG?raw=true)
### Step 5: everything done.

Now it is something like this:
 
![VERSION0.0.1 IN TSON.COM.PNG](https://github.com/RileyGe/sync-wp-steem-comments/blob/master/screenshot/VERSION0.0.1%20IN%20TSON.COM.PNG?raw=true)

You can find this web page on :[TSON.COM](http://tson.com/wordpress-steemjs-comments/) and this page is connected with [how to use steemjs read comments from blockchain](https://steemit.com/cn/@rileyge/steemjs).

## Roadmap and what have I done
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

# SYNC-WP-STEEM-COMMENTS中文说明

Sync WP Steem Comments 是一个可以同步Wordpress和Steemit上评论的插件。

## 一、如何使用

下一步我会将此插件上传到wordpress的应用市场上，希望安装更加方便。现在Wordpress正在审核插件，大家稍安勿躁，现在可以用github上下载使用此插件。

从github获取最新版方法：

### Step 1:从[github](https://github.com/RileyGe/sync-wp-steem-comments)上下载zip文件。
### Step 2: 安装并激活插件。
### Step 3: 设置插件，输入Steemit用户名及 PRIVATE POSTING KEY。

**如果需要，输入Comments Div的ID**

对于多数用户来说，Comments Div的ID，不需要设置，直接留空即可。

如果无法正常显示，再对其进行设置，设置方法为查看博客页的HTML代码，看评论最外层的Div的id是什么，将此id填入到Comments Div ID中。

你可以在设置页面输入用户名及PRIVATE POSTING KEY。

**注：现阶段PRIVATE POSTING KEY可以不填写，现在插件还没有用到此功能**

![The Setting Page of Sycn-WP-Steem-Comments](https://github.com/RileyGe/sync-wp-steem-comments/blob/master/screenshot/SETTING-PAGE.PNG?raw=true)
### Step 4: 在文章发布（更新）页面输入Steemit文章的permlink，然后保存文章。

![The Post Article Page of Sycn-WP-Steem-Comments](https://github.com/RileyGe/sync-wp-steem-comments/blob/master/screenshot/ADD-ARTICLE-PAGE.PNG?raw=true)
### Step 5: 完成。

现在效果是这样的:
 
![VERSION0.0.1 IN TSON.COM.PNG](https://github.com/RileyGe/sync-wp-steem-comments/blob/master/screenshot/VERSION0.0.1%20IN%20TSON.COM.PNG?raw=true)
 
上图为:[TSON.COM](http://tson.com/wordpress-steemjs-comments/)，此页面与Steemit文章[how to use steemjs read comments from blockchain](https://steemit.com/cn/@rileyge/steemjs)相连接。

## 二、下一步计划

饭要一口一口吃，事要一步一步做，中文的就写点实际的：

### 1. 将Steemit中的评论同步到Wordpress功能完善

#### I 完善现有方案
现有方案是直接用steemjs在文章加载后直接显示，个人觉得此方案不错，但对于SEO没有任何帮助，所以提供方案II
#### II 将Steemit的评论插入到Wordpress的数据库中
此方案有利于SEO，而且博客的整体性更好。

### 2. 将Wordpress中的评论同步的Steemit中
这个功能可能还需要比较久的时间来做，所以暂时先不规划。 
 
## 三、感谢
 
插件在发布后使用的人较少，但得到了[@justyy](https://steemit.com/@justyy)同志的大力支持。[@justyy](https://steemit.com/@justyy)使用并对此插件功能提出了部分意见。
