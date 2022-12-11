<?php
/*
	Plugin Name: AI Writers
	Plugin URI: https://www.aiwritters.com/plugins/
	Description: AI Writers
	Version: 1.0.0
	Text Domain: aiwriters
	Author: AI Writers
	Author URI: https://www.aiwritters.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) || exit;
defined( 'AIWRITERS_PLUGIN_URL' ) || define( 'AIWRITERS_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
defined( 'AIWRITERS_PLUGIN_DIR' ) || define( 'AIWRITERS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
defined( 'AIWRITERS_PLUGIN_FILE' ) || define( 'AIWRITERS_PLUGIN_FILE', plugin_basename( __FILE__ ) );
defined( 'AIWRITERS_PLUGIN_VERSION' ) || define( 'AIWRITERS_PLUGIN_VERSION', '1.0.0' );

if ( ! class_exists( 'AIWRITERS_Main' ) ) {
	/**
	 * Class AIWRITERS_Main
	 */
	class AIWRITERS_Main {

		protected static $_instance = null;

		protected static $_script_version = null;

		/**
		 * AIWRITERS_Main constructor.
		 */
		function __construct() {

			self::$_script_version = defined( 'WP_DEBUG' ) && WP_DEBUG ? current_time( 'U' ) : AIWRITERS_PLUGIN_VERSION;

			$this->define_scripts();
			$this->define_classes_functions();
		}

		/**
		 * @return AIWRITERS_Main
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}


		/**
		 * Include Classes and Functions
		 */
		function define_classes_functions() {

			require_once AIWRITERS_PLUGIN_DIR . 'includes/classes/class-hooks.php';
			require_once AIWRITERS_PLUGIN_DIR . 'includes/classes/class-functions.php';
			require_once AIWRITERS_PLUGIN_DIR . 'includes/functions.php';

			require_once AIWRITERS_PLUGIN_DIR . 'includes/classes/class-shortcodes.php';
		}

		/**
		 * Localize Scripts
		 *
		 * @return mixed|void
		 */
		function localize_scripts() {
			return apply_filters( 'AIWRITERS/Filters/localize_scripts', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			) );
		}


		/**
		 * Load Admin Scripts
		 */
		function admin_scripts() {

			wp_enqueue_style( 'aiwriters', AIWRITERS_PLUGIN_URL . 'assets/admin/css/style.css', self::$_script_version );

			wp_enqueue_script( 'aiwriters', plugins_url( '/assets/admin/js/scripts.js', __FILE__ ), array( 'jquery' ), self::$_script_version );
			wp_localize_script( 'aiwriters', 'aiwriters', $this->localize_scripts() );
		}


		/**
		 * Load Scripts
		 */
		function define_scripts() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		}
	}
}


function pb_sdk_init_aiwriters() {

	if ( ! function_exists( 'get_plugins' ) ) {
		include_once ABSPATH . '/wp-admin/includes/plugin.php';
	}

	if ( ! class_exists( 'Pluginbazar\Client' ) ) {
		require_once( plugin_dir_path( __FILE__ ) . 'includes/sdk/classes/class-client.php' );
	}

	global $aiwriters_sdk;

	$aiwriters_sdk = new Pluginbazar\Client( esc_html( 'AI Writers' ), 'aiwriters', 0, __FILE__ );

	do_action( 'pb_sdk_init_aiwriters', $aiwriters_sdk );
}

/**
 * @global \Pluginbazar\Client $aiwriters_sdk
 */
global $aiwriters_sdk;

pb_sdk_init_aiwriters();

AIWRITERS_Main::instance();
