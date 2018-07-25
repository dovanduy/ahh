<?php
//update_option('siteurl','https://dev.ahh.vn');
//update_option('home','https://dev.ahh.vn');

// Prevent direct script access
if ( !defined( 'ABSPATH' ) )
	die ( 'No direct script access allowed' );

/**
* Child Theme Setup
* 
* Always use child theme if you want to make some custom modifications. 
* This way theme updates will be a lot easier.
*/
function bimber_child_setup() {
}

add_action( 'after_setup_theme', 'bimber_child_setup' );

define( 'AHH_INCLUDES_DIR',      trailingslashit( get_stylesheet_directory() ) . 'includes/' );
define( 'AHH_INCLUDES_URI',      trailingslashit( get_stylesheet_directory_uri() ) . 'includes/' );
define( 'AHH_CSS_DIR',      trailingslashit( get_stylesheet_directory() ) . 'css/' );
define( 'AHH_CSS_URI',      trailingslashit( get_stylesheet_directory_uri() ) . 'css/' );
define( 'AHH_JS_DIR',      trailingslashit( get_stylesheet_directory() ) . 'js/' );
define( 'AHH_JS_URI',      trailingslashit( get_stylesheet_directory_uri() ) . 'js/' );

// Load common resources (required by both, admin and front, contexts).
require_once( AHH_INCLUDES_DIR . 'front-end-hooks.php' );