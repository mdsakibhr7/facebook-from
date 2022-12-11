<?php
/**
 * Class Functions
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'AIWRITERS_Functions' ) ) {
	class AIWRITERS_Functions {
		/**
		 * @var AIWRITERS_Shortcodes|null
		 */
		public $shortcodes = null;
	}
}

global $aiwriters;

$aiwriters = new AIWRITERS_Functions();