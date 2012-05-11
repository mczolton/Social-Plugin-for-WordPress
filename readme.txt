=== Plugin Name ===
Contributors: mczolton
Donate link: http://zolton.org/
Tags: facebook, twitter, social, google
Requires at least: 3.1
Tested up to: 3.3.2
Stable tag: 1.4.0

A simple plugin for WordPress that integrates a blog with popular social 
networking sites such as Facebook and Twitter.

== Description ==

The Zolton.org Social Plugin (ZOSP) is a simple plugin for WordPress that 
integrates a blog with popular social networking sites such as Facebook and 
Twitter. I wrote this plugin to learn WordPress plugin development, and as a 
means to decouple these social networking features from my desired WordPress 
theme.

Features

* Includes the Facebook JavaScript SDK in your WordPress theme.
* Generates Facebook Open Graph tags for posts and pages.
* Includes the Facebook Like Button and Send Button on posts and pages.
* Imports the featured image / post thumbnail (if available) from a post or 
page for use as the featured image on Facebook.
* Generates a Facebook Comment section for posts and pages.
* Includes the Twitter Tweet Button on posts and pages.
* Includes the Google +1 Button on posts and pages.
* Includes the Pinterest Pin It Button on posts and pages.
* Optionally hides Wordpress comments.
* Configurable via Wordpress setting page.

Requirements

* A Facebook App ID.
* A Twitter account.
* WordPress theme supporting featured images / post thumbnails.

== Installation ==

1. Unzip the archive to your /wp-content/plugins/ directory.
1. Activate the plugin via the "Plugins" menu in WordPress.
1. Edit the "Required Settings" via the "Settings / Social Plugin" menu in Wordpress.
At the very least, you need to specify a Facebook App ID and a Twitter username.
1. Optionally edit the "Advanced Settings" via the "Settings / Social Plugin" menu in Wordpress.
1. That's it!

== Frequently Asked Questions ==

= Facebook Comments display the error "Warning: http://somesite.com/somepage/ is unreachable". =
Try using Facebook's [URL Linter](http://developers.facebook.com/tools/lint/) 
to see if the URL for the page in question generates any errors.

= The Pinterest Pin It button does not display despite the fact that it is configured to do so. =
The Pinterest Pin It button requires that the post or page include a featured image. Check your 
post or page to ensure that a featured image is set.

== Screenshots ==

1. screenshot-1.png
1. screenshot-2.png

== Changelog ==

= 1.4.0 =
* Tested with Wordpress 3.3.2.
* Added support for the Pinterest Pin It Button.

= 1.3.1 =
* Fixed a conflict with the social button class and select Wordpress themes. 

= 1.3 =
* Added a settings page. Editing the plugin source is no longer required.
* Added support for the Google +1 Button.

= 1.2.1 =
* Tested with Wordpress 3.2.
* Tested with the Twenty Eleven theme and the Twenty Ten theme.
* Resolved an issue with the Facebook Send button not displaying correctly.
* Added the option to specify the width of the Facebook Comment field. Twenty Eleven 
theme users may be interested in this.
* Added a general purpose style sheet called zosp-style.css. Override these selectors 
to customize various elements of the plugin.

= 1.2.0 =
* Social buttons no longer appear on posts and pages that have comments 
disabled.
* Added the option to include the Facebook Send button along with the Facebook
Like button.
* Added an option to hide the Wordpress comments form.

= 1.0.1 =
* Updated plugin to include generic usernames and IDs.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.3 =
Added a settings page. Editing the plugin source is no longer required. Added 
support for the Google +1 Button.

== Known Issues ==
* "Leave a Comment" link is still visible when Wordpress comments are disabled.