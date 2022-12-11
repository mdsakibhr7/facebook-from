<?php
/**
 * Functions
 */

defined( 'ABSPATH' ) || exit;


if ( ! function_exists( 'aiwriters_get_template_part' ) ) {
	/**
	 * Get Template Part
	 *
	 * @param $slug
	 * @param string $name
	 * @param array $args
	 */
	function aiwriters_get_template_part( $slug, $name = '', $args = array() ) {

		$template   = '';
		$plugin_dir = AIWRITERS_PLUGIN_DIR;

		/**
		 * Locate template
		 */
		if ( $name ) {
			$template = locate_template( array(
				"{$slug}-{$name}.php",
				"aiwriters/{$slug}-{$name}.php"
			) );
		}

		/**
		 * Search for Template in Plugin
		 *
		 * @in Plugin
		 */
		if ( ! $template && $name && file_exists( untrailingslashit( $plugin_dir ) . "/templates/{$slug}-{$name}.php" ) ) {
			$template = untrailingslashit( $plugin_dir ) . "/templates/{$slug}-{$name}.php";
		}


		/**
		 * Search for Template in Theme
		 *
		 * @in Theme
		 */
		if ( ! $template ) {
			$template = locate_template( array( "{$slug}.php", "aiwriters/{$slug}.php" ) );
		}


		/**
		 * Allow 3rd party plugins to filter template file from their plugin.
		 *
		 * @filter aiwriters_filters_get_template_part
		 */
		$template = apply_filters( 'AIWRITERS/Filters/get_template_part', $template, $slug, $name );

		if ( $template ) {
			load_template( $template, false, $args );
		}
	}
}


if ( ! function_exists( 'aiwriters_get_template' ) ) {
	/**
	 * Get Template
	 *
	 * @param $template_name
	 * @param array $args
	 * @param string $template_path
	 * @param string $default_path
	 */
	function aiwriters_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		$located = aiwriters_locate_template( $template_name, $template_path, $default_path );

		if ( ! file_exists( $located ) ) {
			return;
		}
		
		$located = apply_filters( 'AIWRITERS/Filters/get_template', $located, $template_name, $args, $template_path, $default_path );

		do_action( 'AIWRITERS/Actions/before_template_part', $template_name, $template_path, $located, $args );

		include $located;

		do_action( 'AIWRITERS/Actions/after_template_part', $template_name, $template_path, $located, $args );
	}
}


if ( ! function_exists( 'aiwriters_locate_template' ) ) {
	/**
	 *  Locate template
	 *
	 * @param $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed|void
	 */
	function aiwriters_locate_template( $template_name, $template_path = '', $default_path = '' ) {

		$plugin_dir = AIWRITERS_PLUGIN_DIR;

		/**
		 * Template path in Theme
		 */
		if ( ! $template_path ) {
			$template_path = 'aiwriters/';
		}


		/**
		 * Template default path from Plugin
		 */
		if ( ! $default_path ) {
			$default_path = untrailingslashit( $plugin_dir ) . '/templates/';
		}

		/**
		 * Look within passed path within the theme - this is priority.
		 */
		$template = locate_template(
			array(
				trailingslashit( $template_path ) . $template_name,
				$template_name,
			)
		);

		/**
		 * Get default template
		 */
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		/**
		 * Return what we found with allowing 3rd party to override
		 *
		 * @filter aiwriters_filters_locate_template
		 */
		return apply_filters( 'AIWRITERS/Filters/locate_template', $template, $template_name, $template_path );
	}
}


if ( ! function_exists( 'aiwriters' ) ) {

	/**
	 * @return AIWRITERS_Functions
	 */
	function aiwriters() {

		global $aiwriters;

		if ( empty( $aiwriters ) ) {
			$aiwriters = new AIWRITERS_Functions();
		}

		return $aiwriters;
	}
}



