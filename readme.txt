=== Sync WP Steem Comments ===
Contributors: grlsr
Donate link: https://steemit.com/@rileyge/
Tags: wordpress, sync-ws, steem, steemit
Requires at least: 4.4
Tested up to: 4.7
Stable tag: 4.7
Requires PHP: 5.2.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Sync WP Steem Comments can sync Steemit and WordPress comments.

== Description ==

Sync WP Steem Comments can sync Steemit and WordPress comments. [Steemit](https://steemit.com/) is a blockchain-based social media platform where anyone can earn rewards. There are more and more persons using Steemit, and more comments on Steemit. So it's important to pull comments from Steemit to Wordpress.

= Features =
- Automatically sync Steemit and WordPress comments
- Easy to use User Interface

= What is Steem? =
[Steemit](https://steemit.com/) is a blockchain-based social media platform where anyone can earn rewards.

= Note =
You will require your Steem _PRIVATE POSTING KEY_ for this plugin to work. Your _PRIVATE POSTING KEY_ is <strong>NOT</strong> stored on our servers.

= Support =
Please support me by following me on Steem [@rileyge](https://steemit.com/@rileyge) or if you feel like donating, that would really help a lot on my future Steem developments around WordPress ecosystem. :)

== Installation ==


== Frequently Asked Questions ==

= Where can I report bugs or contribute to the project? =

Bugs can be reported either in our support forum or preferably on the [Sync WP Steem Comments GitHub repository issues](https://github.com/RileyGe/sync-wp-steem-comments/issues).

= How can I contribute? =

Yes you can! Join in on our [GitHub repository](https://github.com/RileyGe/sync-wp-steem-comments) :)
== Changelog ==

= 0.0.1 - 2018-02-02 =
* Initial version in of Sync WP Steem Comments
* 增加了手动定制Comments的div的id的功能
注：由于多数评论div的id都是在主题或者插件中comment.h中直接以html代码的形式出现，所以用php获取这个还是相当困难的，所以本插件用三种方法获取：1、如果手动设置，用手动。2、没有手动，直接找comments。3、还没有找“*comments*”的div