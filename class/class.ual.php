<?php

if( !class_exists( 'UALAutoLogin' ) ){
	class UALAutoLogin{

		private static $_instance;

		public static function init(){
			global $PITSALU;
			if( ! self::$_instance instanceof UALAutoLogin ){
				self::$_instance 	= new UALAutoLogin();
			}
			$PITSALU = self::$_instance;
			return $PITSALU;
		}

		public function __construct(){
			$this->load_files();
			$this->load_classes();
		}

		public function load_files(){
			require_once( UAL_CLASS . 'class.ual_main.php' );
			require_once( UAL_CLASS . 'class.ual_users.php' );
			require_once( UAL_CLASS . 'class.ual_settings.php' );
		}

		public function load_classes(){
			$GLOBALS['UALSettings'] 	= UALSettings::init();
			$GLOBALS['UALLoginLinks'] 	= UALLoginLinks::init();
			$GLOBALS['UALUsers'] 		= UALUsers::init();
		}

	}
}
?>