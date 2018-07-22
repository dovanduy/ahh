<?php
/**
 * Demo content functions
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

/**
 * Return demos config array
 *
 * @return array
 */
function bimber_get_demos() {
	$demo_images_dir_uri = BIMBER_ADMIN_DIR_URI . 'images/demos/';

	$demos = array(

		// Main.
		'main' => array(
			'name'          => _x( 'Main', 'Demo', 'bimber' ),
			'description'   => _x( 'Default', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/main/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-original.jpg',
		),

		// Gagster.
		'gagster' => array(
			'name'          => _x( 'Gagster', 'Demo', 'bimber' ),
			'description'   => _x( '9GAG inspired', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/gagster/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-gagster.jpg',
		),

		// Music.
		'music' => array(
			'name'          => _x( 'Music', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/music/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-music.jpg',
		),

		// Celebrities.
		'celebrities' => array(
			'name'          => _x( 'Celebrities', 'Demo', 'bimber' ),
			'description'   => _x( 'Celebrity &amp; gossip', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/celebrities/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-celebrities.jpg',
		),

		// Smiley.
		'smiley' => array(
			'name'          => _x( 'Smiley', 'Demo', 'bimber' ),
			'description'   => _x( 'What\'s your reaction ?', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/smiley/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-smiley.jpg',
		),

		// Wall.
		'wall' => array(
			'name'          => _x( 'Wall', 'Demo', 'bimber' ),
			'description'   => _x( 'Masonry feed', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/wall/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-wall.jpg',
		),

		// Bad Boy.
		'badboy' => array(
			'name'          => _x( 'Bad Boy', 'Demo', 'bimber' ),
			'description'   => _x( 'Are you hardcore enough?', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/badboy/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-badboy.jpg',
		),

		// Minimal.
		'minimal' => array(
			'name'          => _x( 'Minimal', 'Demo', 'bimber' ),
			'description'   => _x( 'Minimal', 'Demo', 'bimber' ),
			'default'       => true,
			'preview_url'   => 'http://bimber.bringthepixel.com/minimal/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-minimal.jpg',
		),

		// Geeky.
		'geeky' => array(
			'name'          => _x( 'Geeky', 'Demo', 'bimber' ),
			'description'   => _x( 'Tech magazine', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/geeky/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-geeky.jpg',
		),

		// Affiliate.
		'affiliate' => array(
			'name'          => _x( 'Affiliate', 'Demo', 'bimber' ),
			'description'   => _x( 'Earn on referral links', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/affiliate/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-affiliate.jpg',
		),

		// Bunchy.
		'bunchy' => array(
			'name'          => _x( 'Bunchy', 'Demo', 'bimber' ),
			'description'   => _x( 'Open Lists', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/bunchy/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-bunchy.jpg',
		),

		// Community.
		'community' => array(
			'name'          => _x( 'Community', 'Demo', 'bimber' ),
			'description'   => _x( 'Frontend submission', 'Demo', 'bimber' ),
			'preview_url'   => 'http://bimber.bringthepixel.com/community/',
			'preview_img'   => $demo_images_dir_uri . 'bimber-demo-community.jpg',
		),

	);

	return apply_filters( 'bimber_demos', $demos );
}

/**
 * Load WP Importers (if plugin Wordpress Importer active) but prevent admin import action
 */
function bimber_handle_import_action() {
	// -- Explanation
	// if $_GET['import'] is set, WP defines the WP_LOAD_IMPORTERS const (in wp-admin/admin.php).
	// This, in turn, loads WP_Import class and triggers admin import action.
	// We want to use only WP_Import class to import our demo content, import action is redundant.
	// To achieve this, we have to unset $_GET['import'] after defining const but before action call.
	// The "admin_init" hook is a right place to do that.
	if ( isset( $_GET['import'] ) && 'bimber' === $_GET['import'] ) { // Input var okey.
		unset( $_GET['import'] ); // Input var okey.
	}
}

/**
 * Import demo data
 */
function bimber_import_demo() {
	$allowed_types = array( 'content', 'theme_options', 'all' );
	$demo          = isset( $_GET['demo'] ) ? sanitize_text_field( wp_unslash( $_GET['demo'] ) ) : ''; // Input var okey.
	$type          = isset( $_GET['import-type'] ) ? sanitize_text_field( wp_unslash( $_GET['import-type'] ) ) : ''; // Input var okey.

	if ( ! in_array( $type, $allowed_types, true ) ) {
		wp_die(
			'<h1>' . esc_html__( 'Cheatin&#8217; uh?', 'bimber' ) . '</h1>
			<p>' . sprintf( esc_html__( 'Demo data import type not allowed. Allowed values: %s.', 'bimber' ), esc_html( implode( ', ', $allowed_types ) ) ) . '</p>',
			403
		);
	}

	require_once BIMBER_ADMIN_DIR . 'lib/class-bimber-demo-data.php';

	$demo_data = new Bimber_Demo_Data( $demo );
	$response = null;

	switch ( $type ) {
		case 'content':
			$response = $demo_data->import_content();
			break;

		case 'theme_options':
			$response = $demo_data->import_theme_options();
			break;

		case 'all':
			$response = $demo_data->import_all();
			break;
	}

	if ( $response && 'success' === $response['status'] ) {
		update_option( 'bimber_demo_installed', $demo );
	}

	set_transient( 'bimber_import_demo_response', $response );

	wp_redirect( admin_url( 'themes.php?page=theme-options&group=demos' ) );
}

function bimber_import_demo_images_start() {
	$demo         = isset( $_GET['demo'] ) ? sanitize_text_field( wp_unslash( $_GET['demo'] ) ) : '';
	$path         = trailingslashit( get_parent_theme_file_path() ) . 'dummy-data/' .$demo . '/dummy-data.xml';
	$images_count = 0;
	$res          = 'Demo data loaded';

	// WordPress Importer plugin has to be loaded.
	if ( class_exists( 'WP_Import' ) ) {
		require_once trailingslashit( get_parent_theme_file_path() ) . 'includes/admin/lib/class-bimber-demo-image-importer.php';

		$importer    = new Bimber_Demo_Image_Importer();
		$import_data = $importer->parse( $path );

		if ( ! is_wp_error( $import_data ) ) {
			update_option( 'bimber_import_data', $import_data );

			$images_count = $importer->get_images_count( $import_data );
		} else {
			$res = $import_data->get_error_message();
		}
	} else {
		$res = 'WP_Import class not found!';
	}

	$config = array(
		'response' => $res,
		'count'    => $images_count,
	);

	echo wp_json_encode( $config );
	exit;
}

function bimber_import_demo_images_end() {
	// Clear cache.
	delete_option( 'bimber_import_data' );

	$config = array(
		'response' => 'Cache purged.',
	);

	echo wp_json_encode( $config );
	exit;
}

/**
 * Import demo data image
 */
function bimber_import_demo_image() {
	$nb = isset( $_GET['nb'] ) ? intval( wp_unslash( $_GET['nb'] ) ) : 0;

	if ( $nb <= 0 ) {
		wp_die(
			'<h1>' . esc_html__( 'Cheatin&#8217; uh?', 'bimber' ) . '</h1>
			<p>' . esc_html_e( 'Image number has to be specified.', 'bimber' ) . '</p>',
			403
		);
	}

	// WordPress Importer plugin has to be loaded.
	if ( class_exists( 'WP_Import' ) ) {
		require_once trailingslashit( get_parent_theme_file_path() ) . 'includes/admin/lib/class-bimber-demo-image-importer.php';

		add_filter( 'wp_import_posts', 'bimber_import_change_attachment_path', 10, 2 );

		// Import.
		$importer = new Bimber_Demo_Image_Importer();

		$import_data = get_option( 'bimber_import_data' );

		$importer->fetch_attachments = true;
		$importer->process_image_nb = $nb;

		$importer->import( $import_data );
	}

	exit;
}

function bimber_import_change_attachment_path( $posts ) {
	foreach ( $posts as $index => $post ) {
		if ( 'attachment' === $post['post_type'] ) {
			$remote_url = ! empty( $post['attachment_url'] ) ? $post['attachment_url'] : $post['guid'];

			// if the URL is absolute, but does not contain address, then upload it assuming base_site_url
			if ( preg_match( '|^/[\w\W]+$|', $remote_url ) ) {
				$remote_url = rtrim( get_home_url(), '/' ) . $remote_url;

				$posts[ $index ]['attachment_url'] = $remote_url;
			}
		}
	}

	return $posts;
}

/**
 * Return url to import demo content action
 *
 * @return string
 */
function bimber_get_import_demo_content_url( $demo ) {
	return admin_url( 'admin.php?action=bimber_import_demo&import-type=content&demo=' . $demo . '&import=bimber' );
}

/**
 * Return url to import demo theme options action
 *
 * @return string
 */
function bimber_get_import_demo_theme_options_url( $demo ) {
	return admin_url( 'admin.php?action=bimber_import_demo&import-type=theme_options&demo=' . $demo . '&import=bimber' );
}

/**
 * Return url to import demo all action
 *
 * @return string
 */
function bimber_get_import_demo_all_url( $demo ) {
	return admin_url( 'admin.php?action=bimber_import_demo&import-type=all&demo=' . $demo . '&import=bimber' );
}

/**
 * Demo import started
 */
function bimber_ajax_demo_import_started() {
	$expire_in_10min = 10 * 60;

	set_transient( '_bimber_demo_import_started', true, $expire_in_10min );

	echo wp_json_encode( array(
		'status' => 'success',
	) );
	exit;
}

/**
 * Demo import ended
 */
function bimber_ajax_demo_import_ended() {
	delete_transient( '_bimber_demo_import_started' );

	echo wp_json_encode( array(
		'status' => 'success',
	) );
	exit;
}

/**
 * Flush rewrite rules after finishing demo import
 */
function bimber_flush_rewrite_rules_after_demo_import() {
	$import_response = get_transient( 'bimber_import_demo_response' );

	if ( false !== $import_response ) {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( get_option('permalink_structure') );
		$wp_rewrite->flush_rules();
	}
}
