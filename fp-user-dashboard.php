<?php
/*
Plugin Name: FP User Dashboard
Plugin URI:
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: Phil Webster, Forte Press
Author URI: http://forte-press.com
Text Domain: fp-user-dashboard
Domain Path: /languages
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FP_USER_DASHBOARD_PATH', dirname( __FILE__ ) );
define( 'FP_USER_DASHBOARD_URL', plugin_dir_url(__FILE__ ) );
define( 'FP_USER_DASHBOARD_VER', '0.0.1' );

/**
 * Hooks to setup plugin
 */
add_action( 'plugins_loaded', 'fp_user_dashboard_notice_load_plugin_textdomain' );
add_action( 'plugins_loaded', 'fp_user_dashboard_bootstrap', 25 );

/**
 * Load plugin or throw notice
 *
 * @uses plugins_loaded
 */
function fp_user_dashboard_bootstrap(){
	global $wp_version;
	$php_check = version_compare( PHP_VERSION, '5.4.0', '>=' );
	$wp_check = version_compare( $wp_version, '4.2', '>=' );
	if ( ! $php_check  || !  $wp_check ) {
		function fp_user_dashboard_notice() {
			global $pagenow;
			if( 'plugins.php' !== $pagenow ) {
				return;
			}
			?>
			<div class="notice notice-error">
				<p><?php _e( 'Book Review Pro requires PHP 5.4 or later. Please update your PHP.', 'fp-user-dashboard' ); ?></p>
			</div>
			<?php
		}
		add_action( 'admin_notices', 'fp_user_dashboard_notice' );

	}else{
		//bootstrap plugin
		require_once( dirname( __FILE__ ) . '/bootstrap.php' );

	}

}

/**
 * Loads the text domain for translation
 */
function fp_user_dashboard_notice_load_plugin_textdomain() {
	load_plugin_textdomain( 'fp-user-dashboard', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}



