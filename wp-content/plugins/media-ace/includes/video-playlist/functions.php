<?php
/**
 * Functions
 *
 * @package media-ace
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Enqueue video playlist assets
 */
function mace_vp_enqueue_scripts() {
	$ver = mace_get_plugin_version();
	$plugin_url = mace_get_plugin_url();

	wp_enqueue_style( 'wp-mediaelement' );

	wp_enqueue_style( 'mace-vp-style', $plugin_url . 'includes/video-playlist/css/video-playlist.css' );

	wp_enqueue_script( 'mace-vp-renderer-vimeo', $plugin_url . 'includes/video-playlist/js/mejs-renderers/vimeo.min.js', array(), $ver, true );
	wp_enqueue_script( 'mace-vp', $plugin_url . 'includes/video-playlist/js/playlist.js', array( 'jquery', 'wp-mediaelement' ), $ver, true );
}

/**
 * Extract video url from content, divided by new line.
 *
 * @param string $content       Content.
 *
 * @return array
 */
function mace_vp_extract_urls( $content ) {
	$content = strip_tags( $content );
	$content = trim( $content );
	str_replace( '[mace_video_item]', '', $content );
	$list = explode( '[/mace_video_item]', $content );
	$urls = array();

	foreach ( $list as $item_shortcode ) {
		$urls[] = do_shortcode( $item_shortcode );
	}

	return $urls;
}

/**
 * Return video url type (youtube, vimeo, self_hosted)
 *
 * @param string $url       Video url.
 *
 * @return string|bool      Type of false if doesn't match to any.
 */
function mace_vp_get_url_type( $url ) {
	$type_regex = mace_vp_get_video_type_regex();

	foreach ( $type_regex as $type => $regex ) {
		if ( preg_match( $regex, $url ) ) {
			return $type;
		}
	}

	// Self-hosted?
	if ( false !== strpos( $url, get_home_url() ) ) {
		return 'SelfHosted';
	}

	return false;
}

/**
 * Return regular expression to parse video url
 *
 * @param string $type          Optional. Video type.
 *
 * @return string|array
 */
function mace_vp_get_video_type_regex( $type = '' ) {
	$regex = apply_filters( 'mace_vp_type_regex', array(
		'YouTube'   =>'#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#',
		'Vimeo'     => '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/',
	) );

	if ( ! empty( $type ) && isset( $regex[ $type ] ) ) {
		return $regex[ $type ];
	}

	return $regex;
}
