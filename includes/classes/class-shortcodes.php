<?php
/**
 * Class Shortcodes
 *
 * @author Pluginbazar
 */

use Pluginbazar\Utils;

if ( ! class_exists( 'AIWRITERS_Shortcodes' ) ) {
	/**
	 * Class AIWRITERS_Shortcodes
	 */
	class AIWRITERS_Shortcodes {

		/**
		 * SLIDERXWOO_Hooks constructor.
		 */
		function __construct() {

			global $aiwriters_sdk;

			$aiwriters_sdk->utils()->register_shortcode( 'dashboard', array( $this, 'render_dashboard' ) );
		}


		/**
		 * Render Dashboard
		 *
		 * @return false|string
		 */
		function render_dashboard() {

			ob_start();

			aiwriters_get_template( 'dashboard/index.php' );

			return ob_get_clean();
		}
	}
}

aiwriters()->shortcodes = new AIWRITERS_Shortcodes();