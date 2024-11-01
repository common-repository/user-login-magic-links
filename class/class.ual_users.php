<?php

if( !class_exists( 'UALUsers' ) ){
	class UALUsers{

		private static $_instance;

		public static function init(){
			if( ! self::$_instance instanceof UALUsers ){
				self::$_instance 	= new UALUsers();
			}
			return self::$_instance;
		}

		public function __construct(){
			add_action( 'admin_init', array( $this, 'ual_init' ) );
			add_filter( 'manage_users_columns', array( $this, 'ual_manage_users_columns' ) );
			add_filter( 'manage_users_custom_column', array( $this, 'ual_manage_users_custom_column' ), 10, 3 );
		}

		public function ual_init(){
			$version = filemtime( UAL_DIR . 'js/pitsual-admin.js' );
			wp_register_script( 'ual_script', UAL_URL . 'js/pitsual-admin.js', array( 'jquery' ), $version );
		}

		public function ual_manage_users_columns( $column ){
			wp_enqueue_script( 'ual_script' );
			$column['auto_join_link'] 	= __( 'Auto login link', 'pitsual' );
			return $column; 
		}

		public function ual_manage_users_custom_column( $val, $column_name, $user_id ){
			global $UALLoginLinks;
			switch ($column_name) {
		        case 'auto_join_link' :
		        	$encrypt 	= $UALLoginLinks->ual_encrypt( $user_id ); 
		        	$link 		= add_query_arg( 'ual', $encrypt, site_url() );
		            return sprintf( '<a class="button btnUALink" href="%s">%s</a>', $link, __( ' Click to copy login link', 'pitsual' ) );
		        default:
		    }
		    return $val;
		}

	}
}
?>