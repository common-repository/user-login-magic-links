<?php

if( !class_exists( 'UALLoginLinks' ) ){
	class UALLoginLinks{

		private static $_instance;

		public static function init(){
			if( ! self::$_instance instanceof UALLoginLinks ){
				self::$_instance 	= new UALLoginLinks();
			}
			return self::$_instance;
		}

		public function __construct(){
			register_activation_hook( UAL_PATH, array( $this, 'ual_activation' ) );
			register_deactivation_hook( UAL_PATH, array( $this, 'ual_deactivation' ) );
			add_action( 'wp', array( $this, 'ual_init' ), 1 );
			add_filter( 'cron_schedules', array( $this, 'ual_cron_schedules' ) );
			add_action( 'ual_schedule_event', array( $this, 'ual_schedule_event_callback' ) );
		}

		public function ual_activation(){
			if (! wp_next_scheduled ( 'ual_schedule_event' )) {
		        wp_schedule_event( time(), 'per_five_minutes', 'ual_schedule_event' );
		    }
		}

		public function ual_schedule_event_callback(){
			$code_time = get_option( 'ual_time' );
			if( $code_time ){
				$time_limit = get_option( 'ual_time_limit' );	
				if( ! $time_limit ){
					$time_limit = 5;
				}
				$time_limit = $time_limit * 60;
				if( ( $code_time + $time_limit ) < strtotime( 'now' ) ){
					delete_option( 'ual_code' );
					delete_option( 'ual_random_string' );  	
					delete_option( 'ual_time' );  	
				}	
			}
		}

		public function ual_cron_schedules( $schedules ){
			$schedules['per_five_minutes'] = array(
		       'interval' => 300,
		       'display' => __( 'Five Minutes' )
		   );
		   return $schedules;
		}

		public function ual_deactivation(){
			wp_clear_scheduled_hook( 'ual_schedule_event' );
		}

		public function ual_init(){
			if( isset( $_GET['ual'] ) ){
				if( ! is_user_logged_in() ){
					$user_id = $this->ual_decrypt( $_GET['ual'] );
					if( $user_id ){
						add_filter( 'authenticate', array( $this, 'ual_authenticate' ), 999, 3 );
						wp_signon( array( 'user_login' => $user_id, 'user_password' => time() ) );
					}
				}
				wp_redirect( site_url() );
				exit;
			}	
		}

		public function ual_authenticate( $data, $username, $password ){
			return get_user_by( 'id', $username );
		}

		public function ual_encrypt( $simple_string ){
			// Store cipher method 
			$ciphering = "BF-CBC"; 
			  
			// Use OpenSSl encryption method 
			$iv_length = openssl_cipher_iv_length($ciphering); 
			$options = 0; 
			  
			// Use random_bytes() function which gives 
			// randomly 16 digit values 
			$encryption_iv = get_option( 'ual_code', false );
			if( ! $encryption_iv ){
				$encryption_iv = bin2hex( random_bytes($iv_length) ); 
				update_option( 'ual_code', $encryption_iv );  
				update_option( 'ual_time', strtotime('now') );  
			}
			$random_string = get_option( 'ual_random_string', false );
			if( ! $random_string ){
				$random_string = $this->ual_random_string();
				update_option( 'ual_random_string', $random_string );
			}
			// Alternatively, we can use any 16 digit 
			// characters or numeric for iv 
			$encryption_key = openssl_digest( $random_string, 'MD5', TRUE ); 
			 
			$encryption_iv  = hex2bin($encryption_iv);
			// Encryption of string process starts 
			$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv); 

			return urlencode( $encryption );
		}

		public function ual_decrypt( $encryption ){
			$encryption = htmlspecialchars_decode( $encryption );
			// Store cipher method 
			$ciphering = "BF-CBC"; 

			$options = 0; 
			  
			// Decryption of string process starts 
			// Used random_bytes() which gives randomly 
			// 16 digit values 
			$decryption_iv = get_option( 'ual_code' );
			$random_string = get_option( 'ual_random_string' ); 
			// Store the decryption key 
			$decryption_key = openssl_digest( $random_string, 'MD5', TRUE ); 

			$decryption_iv  = hex2bin($decryption_iv);
			// Descrypt the string 
			$decryption = openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv); 
			return $decryption;
			  
		}

		public function ual_random_string( $length = 16 ) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}

	}
}
?>