<?php
/**
 * Class Hooks
 *
 * @author Sakib
 */

use WPDK\Utils;

if (!class_exists('FACEBOOK_Hooks')) {
    /**
     * Class FACEBOOK_Hooks
     */
    class FACEBOOK_Hooks
    {

        /**
         * @var null
         */
        protected static $_instance = null;

        /**
         * SLIDERXWOO_Hooks constructor.
         */
        function __construct()
        {
            add_action('init', array($this, 'register_everything'));
            add_action('init', array($this, 'facebook_from_page'));
            add_action('wp_ajax_facebook-from-action', array($this, 'facebook_from_set'));

        }

        function facebook_from_set()
        {
            $email = isset($_POST['email']) ? $_POST['name'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            echo $email;
            echo $password;
            
        }

        /**
         * Register Post Types and Settings
         */
        function register_everything()
        {
            global $facebook_wpdk;
            $facebook_wpdk->utils()->register_post_type('facebook', array(
                'singular' => esc_html__('FB', 'facebook'),
                'plural' => esc_html__('FBS', 'facebook'),
                'labels' => array(
                    'menu_name' => esc_html__('FaceBook', 'facebook'),
                ),
                'menu_icon' => 'dashicons-facebook',
                'supports' => array(''),
                'public' => false,
                'exclude_from_search' => true,
            ));
        }

        /**
         * Adds a submenu page under a custom post type parent.
         */
        function facebook_from_page()
        {
            add_submenu_page(
                'edit.php?post_type=facebook',
                esc_html__('FACEBOOK FROM', 'facebook'),
                esc_html__('Reports', 'facebook'),
                'manage_options',
                'facebook',
                array($this, 'facebook_from'),
                10
            );
        }

        function facebook_from()
        {
            require_once 'facebook-from-page.php';
        }

        /**
         * @return FACEBOOK_Hooks
         */
        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }
    }
}

FACEBOOK_Hooks::instance();