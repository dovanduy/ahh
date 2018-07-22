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

if ( is_admin() ) {
	require_once( 'admin/functions.php' );
	require_once( 'admin/ajax.php' );
	require_once( 'admin/settings.php' );
}
