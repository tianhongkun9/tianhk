=== Advanced Dewplayer ===
Contributors: westerndeal
Donate link: http://westerndeal.com/advanced-dewplayer-plugin/
Tags: wordpress dewplayer, audio, audio player, mp3, mp3 player, flash, flash player, dewplayer, wp dewplayer, music, music player, ultimate player, playlist, playlist dewplayer 
Requires at least: 2.8
Tested up to: 4.1
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Get all MP3 files from any directory and show them with player with Perfect Layout and other options.

== Description ==

Advanced Dewlayer is developed by [WesternDeal](http://www.westerndeal.com) allows you to show list of MP3's on your site or blog by fetching them from single directory on your server. You have to use shortcode into your page/post with path of your MP3 folder from which you want to fetch all MP3 files and you will see a perfect playable list of MP3's with much more options.

**Features**

* Get all MP3 files from sindle directory to display list of playable MP3s with other information and download option
* You can also include single mp3 file from local or remote server
* Plugin settings allows you to manage playing list of MP3s 

**MP3 files from single directory**

You can use below shortcode for fetching all MP3's from single directory on your site:

*[musicdirectory path="path of directory from which you want to fetch MP3's"]*

`Examples

1. [musicdirectory path="myaudio/"]

2. [musicdirectory path="wp-content/myaudio/"]`

**Remember:** Don't forget to Include trailing slash (/) at the end of path and use relative path (relative to your site's root).

For Documentation in PDF Please [Click Here](http://westerndeal.com/wp-content/uploads/2014/04/Documentation.pdf)

Advanced Dewplayer PRO VERSION is AVAILABLE now. [Download Here](http://westerndeal.com/advanced-dewplayer-plugin/)

== Installation ==

**Wordpress Automatic Installation**

1. Visit 'wp-admin > Plugins >Add New'.
2. Search for Advanced Dewplayer OR if you have already downloaded plugin ZIP then instead of 'Search', choose 'Upload'.
3. After installing plugin, activate it.
4. Now you can see 'Advanced Dewplayer' menu in left navigation panel.

**Manual Installation**

1. Download the plugin zip to your computer and unzip it.
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installation *wp-content/plugins/* directory.
3. Activate the plugin through the 'Plugins' menu in WordPress admin.

== Frequently Asked Questions ==

= What to do if encounter warning: filesize() stat failed ? =

Please make sure that directory path you enter for MP3 files fetching has trailing slash (i.e. '/') at the end.

= How to use this plugin shortcode in template files ? =

use following code for inserting shortcode into template file:

`<?php 
echo do_shortcode('[musicdirectory path="playlist/"]');   //replace playlist with your path 
?>`

== Screenshots ==

1. Plugin Settings
2. Front-end look

== Changelog ==

= 1.1 =
* fix URL issues
* add custom name for single MP3 file 

= 1.2 =
* fix some download bugs

= 1.3 =
* fix CVE-2013-7240 issue

= 1.4 =
* Removed a feature as part of CAPEC-148 Content Spoofing security vulnerability

= 1.5 =
* Removed Content Spoofing security vulnerability issues and compatible with wordpress 4.1