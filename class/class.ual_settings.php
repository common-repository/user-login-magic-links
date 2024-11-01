<?php

if( !class_exists( 'UALSettings' ) ){
    class UALSettings{

        private static $_instance;

        public static function init(){
            if( ! self::$_instance instanceof UALSettings ){
                self::$_instance    = new UALSettings();
            }
            return self::$_instance;
        }

        public function __construct() {
            add_action( 'admin_init', array( $this, 'ual_add_settings' ) );
            add_filter( 'plugin_action_links_' . plugin_basename( UAL_PATH ), array( $this, 'ual_settings_links' ) );
        }
     
        function ual_add_settings() {
            add_settings_field(
                'ual_time_limit',
                __( 'Expire Auto-Login Link After', 'pitsual' ),
                array( $this, 'ual_setting_callback' ),
                'general'
            );
            register_setting( 'general', 'ual_time_limit' );
        }
     
        function ual_setting_callback( $args ) {
            $selected_time = get_option( 'ual_time_limit' );
            require_once UAL_TEMPLATE . 'ual_settings.php';
        }

        /*
        * Add plugin settings link on the plugins listing page
        */
        function ual_settings_links( $links ) {
            $plugin_links = array(
                '<a href="' . admin_url( 'options-general.php#ual_time_limit' ) . '">' . __( 'Settings', 'pitsual' ) . '</a>',
            );
            return array_merge( $plugin_links, $links );
        }
    }
}
