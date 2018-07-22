<?php
/**
 * Lazy load YouTube module loader
 *
 * @package media-ace
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

require_once( 'functions.php' );

if ( mace_get_lazy_load_embeds() ) {
	require_once( 'youtube.php' );
}

if ( is_admin() ) {
	require_once( 'admin/settings.php' );
}


