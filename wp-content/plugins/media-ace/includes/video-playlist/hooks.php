<?php
/**
 * Hooks
 *
 * @package media-ace
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_action( 'wp_enqueue_scripts', 'mace_vp_enqueue_scripts' );

