<?php
/**
 * Common Functions
 *
 * @package AdAce.
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_action( 'plugins_loaded', 'adace_load_textdomain' );
/**
 * Load plugin textdomain.
 */
function adace_load_textdomain() {
	load_plugin_textdomain( 'adace', false, adace_get_plugin_dir() . '/languages' );
}

add_action( 'admin_enqueue_scripts', 'adace_admin_enqueue_scripts' );
/**
 * Register Admin Scripts
 *
 * @param string $hook Current page.
 */
function adace_admin_enqueue_scripts( $hook ) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php', 'edit-tags.php', 'term.php', 'customize.php', 'widgets.php', 'settings_page_adace_options' ), true ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'adace-admin', adace_get_plugin_url() . 'assets/js/admin.js' );
		wp_localize_script( 'adace-admin', 'AdaceAdminVars',
			array(
				'plugins' => array(
					'is_woocommerce' => adace_can_use_plugin( 'woocommerce/woocommerce.php' ) ? true : false,
				),
			)
		);
	}
}

add_action( 'wp_enqueue_scripts', 'adace_front_enqueue_styles' );
/**
 * Register Front Styles
 */
function adace_front_enqueue_styles() {
	wp_enqueue_style( 'adace-style', adace_get_plugin_url() . 'assets/css/style.min.css' );
	wp_enqueue_style( 'adace-icofont', adace_get_plugin_url() . 'assets/css/fonts/icofont.css' );
}

add_action( 'wp_enqueue_scripts', 'adace_front_enqueue_scripts' );
/**
 * Register Front Styles
 */
function adace_front_enqueue_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'adace-slideup', adace_get_plugin_url() . 'assets/js/slideup.js', array( 'jquery' ), '0.1', false );
}

add_action( 'admin_enqueue_scripts', 'adace_admin_enqueue_styles' );
/**
 * Register Admin Scripts
 */
function adace_admin_enqueue_styles() {
	wp_enqueue_style( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'adace-admin-style', adace_get_plugin_url() . 'assets/css/admin.css' );
}

/**
 * Replace first occurence of a string
 *
 * @param str $needle   Needle.
 * @param str $replace  Replacement.
 * @param str $haystack Haystack.
 * @return str
 */
function adace_str_replace_first( $needle, $replace, $haystack ) {
	$newstring = $haystack;
	$pos = strpos( $haystack, $needle );
	if ( false !== $pos ) {
		$newstring = substr_replace( $haystack, $replace, $pos, strlen( $needle ) );
	}
	return $newstring;
}

/**
 * Replaces regexp matches with uniqe temporary tags.
 *
 * @param str $regexp  Regular expression.
 * @param str $string  Haystack.
 * @return array   New string and array with old values to revert
 */
function adace_preg_make_unique( $regexp, $string ) {
	$replacements = array();
	preg_match_all( $regexp, $string, $matches );
	foreach ( $matches[0] as $match ) {
		$replace = '<!--UNIQUEMATCH' . uniqid() . '-->';
		$replacements[ $replace ] = $match;
		$string = adace_str_replace_first( $match, $replace, $string );
	}
	return array(
		'string'       => $string,
		'replacements' => $replacements,
	);
}

/**
 * Reverts adace_preg_make_unique() using it's own return value.
 *
 * @param array $args Exactly as return of adace_preg_make_unique().
 * @return str
 */
function adace_preg_make_unique_revert( $args ) {
	$string = $args['string'];
	$replacements = $args['replacements'];

	foreach ( $replacements as $key => $value ) {
		$string = str_replace( $key, $value, $string );
	}

	return $string;
}

/**
 * Shuffle array by string seed
 *
 * @param array  $array  Array.
 * @param string $seed   Randomization seed.
 * @return array
 */
function adace_seed_shuffle_array( $array, $seed ) {
	mt_srand( crc32( $seed ) );
	$order = array_map( create_function( '$val', 'return mt_rand();' ), range( 1, count( $array ) ) );
	array_multisort( $order, $array );
	return $array;
}
