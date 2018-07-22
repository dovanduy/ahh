<?php
/**
 * Snax Widgets
 *
 * @package snax
 * @subpackage Widgets
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Init widgets
 */
function snax_widgets_init() {
	register_widget( 'Snax_Widget_Lists' );
	register_widget( 'Snax_Widget_CTA' );
	register_widget( 'Snax_Widget_Teaser' );
	register_widget( 'Snax_Widget_Latest_Votes' );
}

require_once 'snax-widget-lists.class.php';
require_once 'snax-widget-cta.class.php';
require_once 'snax-widget-teaser.class.php';
require_once 'snax-widget-latest-votes.class.php';