<?php
/**
 * Featured Images module loader
 *
 * @package media-ace
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

require_once( 'functions.php' );
require_once( 'hooks.php' );

if ( is_admin() ) {
	require_once( 'admin/settings.php' );
}
