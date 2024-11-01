=== User Login Magic Links ===
Plugin Name: User Login Magic Links
Plugin URI: https://www.prismitworks.com
Contributors: prismitsystems, miteshsolanki
Tags: autologin, user login, user access, login links
Requires at least: 4.4
Tested up to: 6.0.1
Requires PHP: 5.6
Stable tag: 1.0.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows admins to login into their site user's account without a password.

== Description ==

The User Login Magic Links plugin is directed towards web developers.
It allows admins to generate AutoLogin links for their corresponding user accounts for debug purposes. 
With this plugin it is possible to login to any user's account without the need for a password. For security purposes, this plugin comes with a feature via which a given link will expire after a certain period of time to ensure there is no misuse of the link. The magic link contains an encrypted login code that can be auto-generated whenever the admin refreshes the users' page from the WordPress backend. 

= How to use =

Once this plugin is activated, the AutoLogin links can be found in a new column on the users' page for different users. Admin can copy that link and can access it by opening it or redirecting it directly to a web browser.
Admin can set-up the link expiration time from the WordPress General Settings. This setting allows to set expiration time up to 60 minutes maximum.
Once the preset expiry time is reached, the link becomes inactive or expires on its own and the user will not be able to use the same login link again.

The auto-generated login link will look like the one below:
http://yoursite.com/?ual=DXWJRCL%2FTmD%2BHOjBduCCZw%3D%3D

Anyone with the login link will be entitled to acces the corresponding user's account until the link expires.

== Screenshots ==

1. Click to copy the login link of the user of your choice.
2. Set the expiration time of the login link.
3. Paste the login link to the browser and access my account page or any other page as per your need.

== Installation ==

1. Upload the 'User Login Magic Links' plugin to the "/wp-content/plugins/" directory.
1. Activate the plugin through the "Plugins" menu in WordPress.

== Changelog ==

= 1.0.0 =
* Initial Release
