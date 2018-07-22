<?php
/**
 * Media Ace plugin integration
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

add_filter( 'bimber_entry_featured_media_args',             'bimber_mace_dont_apply_link_on_media' );
add_action( 'bimber_before_capture_entry_featured_media',   'bimber_mace_allow_gif_conversion' );
add_action( 'bimber_after_capture_entry_featured_media',    'bimber_mace_disallow_gif_conversion' );

/**
 * Override default featured media arguments
 *
 * @param array $args   Arguments.
 *
 * @return array
 */
function bimber_mace_dont_apply_link_on_media( $args ) {
	if ( $args['allow_video'] ) {
		$mp4_version = mace_get_gif_mp4_version( get_post_thumbnail_id() );

		if ( $mp4_version ) {
			$args['apply_link'] = false;
		}
	}

	return $args;
}

/**
 * Allow GIF to MP4 conversion
 *
 * @param array $args       Arguments.
 */
function bimber_mace_allow_gif_conversion( $args ) {
	if ( $args['allow_video'] ) {
		add_filter( 'post_thumbnail_html', 'bimber_mace_replace_gif_thumbnail_to_mp4_video' , 10, 4 );
	}
}

/**
 * Disallow GIF to MP4 conversion
 *
 * @param array $args       Arguments.
 */
function bimber_mace_disallow_gif_conversion( $args ) {
	if ( $args['allow_video'] ) {
		remove_filter( 'post_thumbnail_html', 'bimber_mace_replace_gif_thumbnail_to_mp4_video' , 10, 4 );
	}
}

/**
 * Replaces GIF images with mp4 version in post thumbnails
 *
 * @param string $html              HTML.
 * @param int    $post_id           Post id.
 *
 * @return string
 */
function bimber_mace_replace_gif_thumbnail_to_mp4_video( $html, $post_id, $post_thumbnail_id, $size ) {
	$html = mace_replace_gif_with_shortcode( $html, $post_thumbnail_id );

	$override_content_width = is_single() ? 758 : false;

	// Change content width.
	if ( $override_content_width ) {
		global $content_width;

		$orig_content_width = $content_width;
		$content_width = $override_content_width;
	}

	$html = do_shortcode( $html );

	// Restore.
	if ( $override_content_width ) {
		$content_width = $orig_content_width;
	}

	return $html;
}
