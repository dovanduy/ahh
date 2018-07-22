<?php
/**
 * Bimber Theme functions for the stack
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.6
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_filter( 'bimber_newsletter_after_content_class',    'bimber_newsletter_class_dark' );
add_filter( 'bimber_newsletter_inside_grid_class',      'bimber_newsletter_class_dark' );
add_filter( 'bimber_newsletter_inside_list_class',      'bimber_newsletter_class_dark' );
add_filter( 'bimber_newsletter_inside_classic_class',   'bimber_newsletter_class_dark' );
add_filter( 'bimber_newsletter_inside_stream_class',    'bimber_newsletter_class_dark' );
add_filter( 'bimber_newsletter_inside_bunchy_class',    'bimber_newsletter_class_dark' );

function bimber_newsletter_class_dark( $classes ) {
	$classes[] = 'g1-dark';

	return $classes;
}