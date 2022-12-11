<?php
/**
 * Class Hooks
 *
 * @author Pluginbazar
 */

use Pluginbazar\Utils;

if ( ! class_exists( 'FACEBOOK_Hooks' ) ) {
	/**
	 * Class FACEBOOK_Hooks
	 */
	class FACEBOOK_Hooks {

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
		 * @return FACEBOOK_Hooks
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

FACEBOOK_Hooks::instance();