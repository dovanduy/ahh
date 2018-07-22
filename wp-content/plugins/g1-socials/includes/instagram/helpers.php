<?php
/**
 * Instagram
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Socials
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Return Instagram feed
 *
 * @param string $username      Username/Tag to be displayed.
 * @param int    $cache_time    How long the feed should be not updated.
 *
 * @return string|WP_Error
 */
function g1_socials_get_instagram_feed( $username, $cache_time ) {
	$username       = trim( strtolower( $username ) );
	$instagram_feed = get_transient( 'g1-instagram-cache-' . sanitize_title_with_dashes( $username ) );

	// Fetch if not cached.
	if ( false === $instagram_feed ) {
		$instagram_feed = g1_socials_fetch_instagram( $username, $cache_time );
	}

	if ( is_wp_error( $instagram_feed ) ) {
		return new WP_Error( 'g1_instagram_fetch_failed', $instagram_feed->get_error_message() );
	}

	if ( empty( $instagram_feed ) || false === $instagram_feed ) {
		return new WP_Error( 'g1_instagram_empty_feed', esc_html__( 'Instagram did not return any data.', 'g1_socials' ) );
	}

	return unserialize( base64_decode( $instagram_feed ) );
}

/**
 * Fetch Instagram feed
 *
 * @param string $username      Username/Tag to be displayed.
 * @param int    $cache_time    Cache time.
 *
 * @return string|WP_Error
 */
function g1_socials_fetch_instagram( $username, $cache_time ) {
	$instagram = array();

	// Build url.
	switch ( substr( $username, 0, 1 ) ) {
		case '#':
			$url = esc_url( 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username ) );
			break;
		default:
			$url = esc_url( 'https://instagram.com/' . str_replace( '@', '', $username ) );
			break;
	}

	$images = g1_socials_instagram_get_images( $url );

	if ( is_wp_error( $images ) ) {
		return $images;
	}

	foreach ( $images as $image ) {
		if ( true === $image['node']['is_video'] ) {
			$type = 'video';
		} else {
			$type = 'image';
		}

		$caption = __( 'Instagram Image', 'wp-instagram-widget' );

		if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
			$caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
		}

		$instagram[] = array(
			'description' => $caption,
			'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
			'time'        => $image['node']['taken_at_timestamp'],
			'comments'    => $image['node']['edge_media_to_comment']['count'],
			'likes'       => $image['node']['edge_liked_by']['count'],
			'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
			'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
			'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
			'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
			'type'        => $type,
		);
	}

	if ( ! empty( $instagram ) ) {
		$instagram = base64_encode( serialize( $instagram ) );

		// Cache data.
		set_transient( 'g1-instagram-cache-' . sanitize_title_with_dashes( $username ), $instagram, $cache_time * 60 );

		return $instagram;
	} else {
		return '';
	}
}

function g1_socials_instagram_get_images( $url ) {
	// Fetch page body.
	$remote = wp_remote_get( $url );

	if ( is_wp_error( $remote ) ) {
		return new WP_Error( 'g1_instagram_service_down', esc_html__( 'Unable to communicate with Instagram.', 'g1_socials' ) );
	}

	if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
		return new WP_Error( 'g1_instagram_wrong_response', esc_html__( 'Instagram did not return a 200.', 'g1_socials' ) );
	}

	// Extract Instagram feed JSON string from page body.
	$temp     = explode( 'window._sharedData = ', $remote['body'] );
	$temp     = explode( ';</script>', $temp[1] );
	$json_str = $temp[0];

	// Decode.
	$data_arr = json_decode( $json_str, true );

	if ( ! $data_arr ) {
		return new WP_Error( 'g1_instagram_wrong_json', esc_html__( 'Instagram has returned invalid data.', 'g1_socials' ) );
	}

	if ( isset( $data_arr['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
		$images = $data_arr['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
	} elseif ( isset( $data_arr['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
		$images = $data_arr['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
	} else {
		return new WP_Error( 'g1_instagram_bad_json_2', esc_html__( 'Instagram has returned invalid JSON.', 'g1_socials' ) );
	}

	if ( ! is_array( $images ) ) {
		return new WP_Error( 'g1_instagram_bad_array', esc_html__( 'Instagram data is not an array.', 'g1_socials' ) );
	}

	return $images;
}
