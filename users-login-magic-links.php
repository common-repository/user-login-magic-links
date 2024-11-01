<?php
/*
 * Plugin Name: User Login Magic Links
 * Plugin URI: https://www.prismitworks.com
 * Description: This plugin allows admins to login into their site user's account without a password.
 * Author: Prism I.T. Systems
 * Author URI: www.prismitsystems.com
 * Version: 1.0.1
 * Requires at least: 4.4
 * License: GPLv2
 * Text Domain: pitsual
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define( 'UAL_NAME','User Login Magic Links' );
define( 'UAL_REQUIRED_PHP_VERSION', '5.3' );                          // because of get_called_class()
define( 'UAL_REQUIRED_WP_VERSION',  '3.1' );                          // because of esc_textarea()
define( 'UAL_VER', '0.0.1' );
define( 'UAL_PATH', __FILE__ );
define( 'UAL_DIR', plugin_dir_path( __FILE__ ) );
define( 'UAL_URL', plugin_dir_url( __FILE__ ) );
define( 'UAL_CLASS', UAL_DIR . '/class/' );
define( 'UAL_TEMPLATE', UAL_DIR . '/templates/' );

require_once UAL_CLASS . 'class.ual.php';

UALAutoLogin::init();