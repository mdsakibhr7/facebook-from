<?php
/**
 * Class Functions
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'FACEBOOK_Functions' ) ) {
	class FACEBOOK_Functions {
		/**
		 * @var FACEBOOK_Shortcodes|null
		 */
		public $shortcodes = null;
	}
}

global $facebook;

$facebook = new FACEBOOK_Functions();