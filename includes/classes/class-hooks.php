<?php
/**
 * Class Hooks
 *
 * @author Pluginbazar
 */

use Pluginbazar\Utils;

if ( ! class_exists( 'AIWRITERS_Hooks' ) ) {
	/**
	 * Class AIWRITERS_Hooks
	 */
	class AIWRITERS_Hooks {

		/**
		 * @var null
		 */
		protected static $_instance = null;

		/**
		 * SLIDERXWOO_Hooks constructor.
		 */
		function __construct() {
			add_action( 'init', array( $this, 'register_everything' ) );
		}


		/**
		 * Register Post Types and Settings
		 */
		function register_everything() {

		}


		/**
		 * @return AIWRITERS_Hooks
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

AIWRITERS_Hooks::instance();