<?php
/**
 * Init Coupons
 *
 * @package AdAce.
 * @subpackage Coupons.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

// Load links backend parts.

add_action( 'init', 'adace_load_coupons', 0 );
function adace_load_coupons() {
	if ( apply_filters( 'adace_support_coupons', false ) ) {
		require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/coupons/common/register.php' );
		if ( is_admin() ) {
			require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/coupons/admin/meta-boxes.php' );
			require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/coupons/admin/columns.php' );
		}
		if ( ! is_admin() ) {
			require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/coupons/front/functions.php' );
			require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/coupons/front/shortcode.php' );
		}
	}
}
