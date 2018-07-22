<?php
/**
 * Theme setup functions
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
 * Set up the theme
 */
function bimber_setup_theme() {
	// Make theme available for translation.
	load_theme_textdomain( 'bimber', BIMBER_THEME_DIR . 'languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );


	add_image_size( 'bimber-grid-xs',               192,        round( 192 * 1 * 1 / 2 ), true );
	add_image_size( 'bimber-grid-xs-2x',            192 * 2,    round( 192 * 2 * 1 / 2 ), true );
	add_image_size( 'bimber-grid-xs-ratio-16-9',    192,        round( 192 * 1 * 9 / 16 ), true );
	add_image_size( 'bimber-grid-xs-ratio-16-9-2x', 192 * 2,    round( 192 * 2 * 9 / 16 ), true );
	add_image_size( 'bimber-grid-xs-ratio-4-3',     192,        round( 192 * 1 * 3 / 4 ), true );
	add_image_size( 'bimber-grid-xs-ratio-4-3-2x',  192 * 2,    round( 192 * 2 * 3 / 4 ), true );
	add_image_size( 'bimber-grid-xs-ratio-1-1',     192,        round( 192 * 1 * 1 / 1 ), true );
	add_image_size( 'bimber-grid-xs-ratio-1-1-2x',  192 * 2,    round( 192 * 2 * 1 / 1 ), true );

	add_image_size( 'bimber-list-xs',               110,        110, true );
	add_image_size( 'bimber-list-xs-2x',            110 * 2,    110 * 2, true );

	if ( 'miami' === bimber_get_current_stack() || 'music' === bimber_get_current_stack() ) {
		add_image_size( 'bimber-grid-standard',     364,        round( 364 * 3 / 4 ), true );
		add_image_size( 'bimber-grid-standard-2x',  364 * 2,    round( 364 * 2 * 3 / 4 ), true );
	} else {
		add_image_size( 'bimber-grid-standard',     364,        round( 364 * 9 / 16 ), true );
		add_image_size( 'bimber-grid-standard-2x',  364 * 2,    round( 364 * 2 * 9 / 16 ), true );
	}

	// Large Grid (1of2)
	add_image_size( 'bimber-grid-l',            561,        round( 561 * 9 / 16 ), true );
	add_image_size( 'bimber-grid-l-ratio-3-4',  561,        round( 561 * 3 / 4 ), true );
	add_image_size( 'bimber-grid-l-2x',         561 * 2,    round( 561 * 2 * 9 / 16 ), true );

	add_image_size( 'bimber-grid-masonry',      364,        9999 );
	add_image_size( 'bimber-grid-masonry-2x',   758,        9999 );

	add_image_size( 'bimber-list-standard',     364,        round( 364 * 9 / 16 ), true );
	add_image_size( 'bimber-list-standard-2x',  364 * 2,    round( 364 * 2 * 9 / 16 ), true );

	add_image_size( 'bimber-grid-fancy',        364,        round( 364 * 9 / 21 ), true );
	add_image_size( 'bimber-grid-fancy-2x',     364 * 2,    round( 364 * 2 * 9 / 21 ), true );

	add_image_size( 'bimber-list-fancy',        364,        round( 364 * 9 / 21 ), true );
	add_image_size( 'bimber-list-fancy',        364 * 2,    round( 364 * 2 * 9 / 21 ), true );

	add_image_size( 'bimber-stream',            608,        9999 );
	add_image_size( 'bimber-grid-2of3',         758,        9999 );
	add_image_size( 'bimber-classic-1of1',      1152,       9999 );

	add_image_size( 'bimber-tile',              758,        round( 758 * 9 / 16 ), true );
	add_image_size( 'bimber-tile-carmania',     758,        round( 758 * 1 / 2 ), true );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for Post Formats.
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat',
		)
	);

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'bimber_primary_nav'    => esc_html__( 'Primary Navigation', 'bimber' ),
		'bimber_secondary_nav'  => esc_html__( 'Secondary Navigation', 'bimber' ),
		'bimber_user_nav'       => esc_html__( 'User Navigation', 'bimber' ),
		'bimber_footer_nav'     => esc_html__( 'Footer Navigation', 'bimber' ),
	) );
}

/**
 * Load default theme options
 */
function bimber_load_default_options() {
	$theme_id = bimber_get_theme_id();

	// Load options for WP Admin > Appearance > Customize.
	$customizer_option_name = $theme_id;
	$customizer_options     = get_option( $customizer_option_name );

	if ( ! $customizer_options ) {
		include_once( BIMBER_ADMIN_DIR . 'customizer/customizer-defaults.php' );

		if ( isset( $bimber_customizer_defaults ) ) {
			update_option( $customizer_option_name, $bimber_customizer_defaults );
		}
	}

	// Load options for WP Admin > Appearance > Theme Options.
	$theme_option_name = $theme_id . '_options';
	$theme_options     = get_option( $theme_option_name );

	if ( ! $theme_options ) {
		require( BIMBER_ADMIN_DIR . 'theme-options/theme-defaults.php' );

		if ( isset( $bimber_theme_options_defaults ) ) {
			update_option( $theme_option_name, $bimber_theme_options_defaults );
		}
	}
}

/**
 * Set up WPML plugin
 */
function bimber_setup_wpml() {
	if ( bimber_can_use_plugin( 'sitepress-multilingual-cms/sitepress.php' ) ) {

		// Remove @lang from term title.
		global $sitepress;

		if ( $sitepress ) {
			add_filter( 'single_term_title', array( $sitepress, 'the_category_name_filter' ) );
		}

		define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
	}
}

/**
 * Set up sidebars
 */
function bimber_setup_sidebars() {
	$custom_sidebars = get_option( 'bimber_custom_sidebars', array() );

	$core_sidebars = bimber_get_predefined_sidebars();

	$sidebars = array_merge( $core_sidebars, $custom_sidebars );

	$sidebars = apply_filters( 'bimber_setup_sidebars', $sidebars );

	$section_title_args = bimber_get_section_title_args( array( 'widgettitle' ) );
	$before_title = '<header>' . $section_title_args['before_with_class'];
	$after_title = $section_title_args['after'] . '</header>';

	if ( count( $sidebars ) ) {
		foreach ( $sidebars as $sidebar_id => $sidebar_config ) {
			if ( ! empty( $sidebar_config ) && isset( $sidebar_config['label'] ) ) {
				register_sidebar( array(
					'name'          => $sidebar_config['label'],
					'id'            => $sidebar_id,
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => $before_title,
					'after_title'   => $after_title,
					'class'         => isset( $core_sidebars[ $sidebar_id ] ) ? '' : 'g1-custom',
					'description'   => isset( $sidebar_config['description'] ) ? $sidebar_config['description'] : '',
				) );
			}
		}
	}
}

/**
 * Adjust the $content_width WP global variable
 */
function bimber_setup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bimber_content_width', 662 );
}

/**
 * Allow empty strings in widget titles
 *
 * @param string $title Widget title.
 *
 * @return string
 */
function bimber_allow_empty_widget_title( $title ) {
	$title = trim( $title );
	$title = ( '&nbsp;' === $title ) ? '' : $title;

	return $title;
}

function bimber_safe_style_css( $styles ) {
	$styles[] = 'top';

	return $styles;
}
