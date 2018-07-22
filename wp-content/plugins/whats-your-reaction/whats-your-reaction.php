<?php
/**
Plugin Name:    What's Your Reaction?
Description:    Share your reaction to a post, using nice looking badges
Author:         bringthepixel
Version:        1.2.14
Author URI:     http://www.bringthepixel.com
Text Domain:    wyr
Domain Path:    /languages/
License: 		Located in the 'Licensing' folder
License URI: 	Located in the 'Licensing' folder

@package whats-your-reaction
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Return the plugin directory base path
 *
 * @return string
 */
function wyr_get_plugin_dir() {
	return plugin_dir_path( __FILE__ );
}

/**
 * Return the plugin directory url
 *
 * @return string
 */
function wyr_get_plugin_url() {
	return trailingslashit( plugin_dir_url( __FILE__ ) );
}

/**
 * Return the plugin basename
 *
 * @return string
 */
function wyr_get_plugin_basename() {
	return plugin_basename( __FILE__ );
}

/**
 * Return the plugin version
 *
 * @return string
 */
function wyr_get_plugin_version() {
	$version = false;
	$data = get_plugin_data( __FILE__ );

	if ( ! empty( $data['Version'] ) ) {
		$version = $data['Version'];
	}

	return $version;
}

require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/functions.php' );
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/ajax.php' );
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/hooks.php' );
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/shortcodes.php' );
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/plugins/functions.php' );
require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/widgets/functions.php' );

if ( is_admin() ) {
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/admin/functions.php' );
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/admin/ajax.php' );
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/admin/hooks.php' );
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/admin/metaboxes/fake-reactions-metabox.php' );
}

// Init.
register_activation_hook( plugin_basename( __FILE__ ), 'wyr_activate' );
register_deactivation_hook( plugin_basename( __FILE__ ), 'wyr_deactivate' );
register_uninstall_hook( plugin_basename( __FILE__ ), 'wyr_uninstall' );