=== phpinfo() WP ===
Contributors: s4gor
Tags: phpinfo, server info, php, server configuration, php ini, phpinfo(), php configuration, htaccess, apache
Requires at least: 4.7
Tested up to: 5.8-beta1
Stable tag: 2.1
Requires PHP: 5.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Donate link: https://www.paypal.com/donate?hosted_button_id=GUA4CQY8QFZ9G

A simple plugin to look up server info and manage server configuration of wordpress site

== Description ==

A simple wordpress plugin to look up information about server and PHP's configuration and manage server configurations.

This plugin gives a large amount of information about the current state of PHP. This includes information about PHP compilation options and extensions, the PHP version, server information and environment (if compiled as a module), the PHP environment, OS version information, paths, master and local values of configuration options, HTTP headers. For making information concise, PHP license has been removed.

You can see what extensions are enabled in your server through this plugin. Except these, you can edit or set Server configuration values like max_file_uploads, upload_max_filesize, etc. You can edit or set any directive values through this plugin easily.

== Updates ==

Added .htaccess page in order to edit or set directive values of your server configurations like max_file_uploads, upload_max_filesize, etc.

== Screenshots ==

1. PHP Info
2. Extensions
3. Hyper Text Access

== Installation ==

You can [download](https://downloads.wordpress.org/plugin/phpinfo-wp.zip) and upload the plugin via Admin > Plugins > Add New > Upload Plugin. Or,
Go to your website's admin panel. Select Plugins > Add New. search for **phpinfo() WP** by [Imran Hossain Sagor](https://github.com/s4gor). Click **Install Now button**. Then simply click **Active**.

== Frequently Asked Questions ==

= What is the requirements to active this plugin? =

Nothing is needed. But sometimes, hosting providers disable [server setting](http://php.net/manual/en/ini.core.php#ini.disable-functions). In that case, you need to contact with your hosting provider
See screenshot #1. Make sure site's root directory is writable to set or edit server configuration's directive values. 

== Change Log ==

= 2.0 =
Through this version, you can edit or set server configuration values

= 1.0.5 =
Added Extension page in which enabled extensions for wordpress can be seen along with disabled extensions

= 1.0.4 =
Added Extension page in which enabled extensions for wordpress can be seen

= 1.0.3 =
Added donation information and redesigned plugin's interface

= 1.0.2 =
Changed style and added scroll to top button

= 1.0.1 =
Updated position in admin menu. It it currently under tools in admin menu

= 1.0.0 =
First release

== Upgrade Notice ==

Make sure your [server setting](http://php.net/manual/en/ini.core.php#ini.disable-functions) is **enabled**. Editing .htaccess/nginx.conf. **Make sure root directory is writable. Except write permission, server configuration values can not be edited or set through this plugin**.
