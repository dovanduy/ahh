<?php
/**
 * Shortcodes
 *
 * @package media-ace
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_shortcode( 'mace_video_playlist',   'mace_vp_list_shortcode' );
add_shortcode( 'mace_video_item',       'mace_vp_item_shortcode' );

/**
 * Video playlist shortcode
 *
 * @param array  $atts          Shortcode attributes.
 * @param string $content       Optional. Shortcode content.
 *
 * @return string
 */
function mace_vp_list_shortcode( $atts, $content = '' ) {
	$urls   = mace_vp_extract_urls( $content );
	$out    = '';
	$videos = array();

	foreach ( $urls as $url ) {
		$url_type = mace_vp_get_url_type( $url );

		if ( false === $url_type ) {
			continue;
		}

		$class_name = sprintf( 'Mace_Video_%s', $url_type );

		if ( ! class_exists( $class_name ) ) {
			continue;
		}

		/**
		 * Video object
		 *
		 * @var Mace_Video $video_obj
		 */
		$video_obj = new $class_name( $url );

		$video_id = $video_obj->get_id();

		if ( empty( $video_id ) ) {
			$out .= esc_html( $video_obj->get_last_error() );
			continue;
		}

		$videos[] = $video_obj;
	}

	if ( ! empty( $videos ) ) {
		global $mace_vp_videos;
		$mace_vp_videos = $videos;

		ob_start();
		mace_get_template_part( 'video-playlist' );
		$out .= ob_get_clean();
	}

	return $out;
}

/**
 * Video item shortcode
 *
 * @param array  $atts          Shortcode attributes.
 * @param string $content       Optional. Shortcode content.
 *
 * @return string
 */
function mace_vp_item_shortcode( $atts, $content = '' ) {
	$content = strip_tags( $content );
	$content = trim( $content );

	return $content;
}