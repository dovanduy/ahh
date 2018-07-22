<?php
/**
 * Init Links
 *
 * @package AdAce.
 * @subpackage Links.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}


// Add Links support.
add_action( 'init', 'adace_load_links', 0 );
function adace_load_links() {
	if ( apply_filters( 'adace_support_links', false ) ) {
		// Admin.
		if ( is_admin() ) {
			require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/links/admin/meta-boxes.php' );
		}
		// Commons.
		require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/links/common/register.php' );
		require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/links/common/class-adace-links-widget.php' );
		// Front.
		if ( ! is_admin() ) {
			require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/links/front/get-links.php' );
			require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/links/front/links-shortcode.php' );
		}
	}
}
