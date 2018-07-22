<?php
/**
 * Video Playlist module loader
 *
 * @package media-ace
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

require_once( 'lib/interface-mace-video.php' );
require_once( 'lib/class-mace-video.php' );
require_once( 'lib/class-mace-video-youtube.php' );
require_once( 'lib/class-mace-video-vimeo.php' );
require_once( 'lib/class-mace-video-self-hosted.php' );
require_once( 'functions.php' );
require_once( 'shortcodes.php' );
require_once( 'hooks.php' );


