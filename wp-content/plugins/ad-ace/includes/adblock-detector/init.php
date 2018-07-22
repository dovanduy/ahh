<?php
/**
 * Init Ads
 *
 * @package AdAce.
 * @subpackage Sponsors.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

// Load ads common parts.
require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/adblock-detector/functions.php' );

add_action( 'init', 'adace_load_adblock_detector', 0 );

function adace_load_adblock_detector() {
	add_filter( 'adace_options_defaults', 'adace_options_add_adblock_detector_defaults' );

	if ( is_admin() ) {
		require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/adblock-detector/options-page-adblock-detector.php' );
	}

	require_once( trailingslashit( adace_get_plugin_dir() ) . 'includes/adblock-detector/functions.php' );
}

/**
 * Add Shop The Post Defaults.
 *
 * @param array $option_key Key to get default for.
 * @return mixed Default value or false.
 */
function adace_options_add_adblock_detector_defaults( $defaults ) {
	$defaults = array_merge( $defaults, array(
		'adace_adblock_detector_enabled' => 'none',
	) );
	return $defaults;
}
