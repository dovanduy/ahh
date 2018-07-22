<?php
/**
 * Front resources loader
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

require_once( BIMBER_FRONT_DIR . 'default-filters.php' );
require_once( BIMBER_FRONT_DIR . 'common.php' );
require_once( BIMBER_FRONT_DIR . 'archive.php' );
require_once( BIMBER_FRONT_DIR . 'home.php' );
require_once( BIMBER_FRONT_DIR . 'archive-template.php' );
require_once( BIMBER_FRONT_DIR . 'post.php' );
require_once( BIMBER_FRONT_DIR . 'post-template.php' );
require_once( BIMBER_FRONT_DIR . 'page.php' );
require_once( BIMBER_FRONT_DIR . 'comment.php' );
require_once( BIMBER_FRONT_DIR . 'injections.php' );
require_once( BIMBER_FRONT_DIR . 'sections.php' );

require_once( BIMBER_FRONT_DIR . 'ups.php' );

// @todo Na pewno tutaj?
require_once( BIMBER_FRONT_DIR . 'lib/class-bimber-breadcrumbs.php' );
require_once( BIMBER_FRONT_DIR . 'lib/class-bimber-walker-nav-menu.php' );
