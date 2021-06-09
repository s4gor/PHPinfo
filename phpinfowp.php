<?php

/*
Plugin Name: Phpinfo() WP
Plugin URI: www.github.com/s4gor/checkWPFiles
Description: Check PHP information.
Version: 1.0
Author: Imran Hossain Sagor
Author URI: www.github.com/s4gor
License: GPLv3
*/

/**
 *
 * @package piforwp
 *
 */


defined('ABSPATH') or die('Unauthorized Access');

if(!class_exists( 'piforwp' )):

	class piforwp {

		function register() {
			add_action('admin_menu', array($this, 'add_admin_pages'));
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		}

		public function add_admin_pages() {
			add_menu_page('phpnfo_WP', 'phpinfo(); WP', 'manage_options', 'php_info', array(
				$this,
				'info'
			), 'dashicons-format-aside', 70);
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
			wp_enqueue_style('PHPinfo_plugin_style', plugins_url( 'style.min.css', __FILE__ ));
		}

	}

	if(class_exists( 'piforwp' )) $phpinfo = new piforwp();
	else die('Plugin internal code conflict');


	$phpinfo->register();


	register_activation_hook(__FILE__, [$phpinfo, 'activate']);
	register_deactivation_hook(__FILE__, [$phpinfo, 'deactivate']);

	endif;
