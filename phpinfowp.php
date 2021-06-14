<?php

/*
Plugin Name: Phpinfo WP
Plugin URI: www.github.com/s4gor/checkWPFiles
Description: A simple plugin to look up information about server and PHP's configuration
Version: 1.0.3
Author: Imran Hossain Sagor
Author URI: www.github.com/s4gor
License: GPLv3
*/

/**
 *
 * @package Phpinfowp
 *
 */


defined('ABSPATH') or die('Unauthorized Access');

if(!class_exists( 'Phpinfowp' )):

	class Phpinfowp {

		function register() {
			add_action('admin_menu', array($this, 'add_admin_pages'));
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
			add_filter('clean_url', [$this, 'script_async'], 11, 1);
			add_filter("plugin_row_meta", [$this, "meta"], 10, 2);
		}

		public function add_admin_pages() {
			add_submenu_page('tools.php', 'Phpinfo WP', 'Phpinfo WP', 'manage_options', 'php_info', [
			    $this, 'info'
            ], 0);
		}

		public function info() {
			require_once plugin_dir_path( __FILE__ ) . 'info.php';
		}

		public function activate() {
			flush_rewrite_rules();
		}

		public function deactivate() {
			flush_rewrite_rules();
		}
		public function enqueue() {
			wp_enqueue_style('phpinfo_plugin_style', plugins_url( 'style.min.css', __FILE__ ));
			wp_enqueue_script('phpinfo_plugin_script', plugin_dir_url(__FILE__) . 'src/scripts.min.js#async');
		}
		public function script_async($url) {
		    if(strpos($url, '#async') === false) {
		        return $url;
            } else {
		        return str_replace('#async', '', $url) . "' async='async";
            }
        }

        public function meta($links = [], $file = "") {
        	if(strpos($file, "phpinfo-wp/phpinfowp.php") !== false) {
            	$new_link = [
                	"donation0" => '<a href="https://www.paypal.com/donate?hosted_button_id=GUA4CQY8QFZ9G" target="_blank">Donate Us!</a>'
            	];

            	$links = array_merge($links, $new_link);
        	}

        	return $links;

        }

	}

	if(class_exists( 'Phpinfowp' )) $phpinfo = new Phpinfowp();
	else die('Plugin internal code conflict');


	$phpinfo->register();


	register_activation_hook(__FILE__, [$phpinfo, 'activate']);
	register_deactivation_hook(__FILE__, [$phpinfo, 'deactivate']);

	endif;
