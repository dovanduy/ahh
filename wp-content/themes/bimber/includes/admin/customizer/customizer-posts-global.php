<?php
/**
 * WP Customizer panel section to handle posts global options
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

$bimber_option_name = bimber_get_theme_id();

$wp_customize->add_section( 'bimber_posts_global_section', array(
	'title'    => esc_html__( 'Global', 'bimber' ),
	'priority' => 10,
	'panel'    => 'bimber_posts_panel',
) );


// Enable Popular collection.
$wp_customize->add_setting( $bimber_option_name . '[posts_popular_enable]', array(
	'default'           => $bimber_customizer_defaults['posts_popular_enable'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_popular_enable', array(
	'label'    => esc_html__( 'Enable "Popular" collection', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_popular_enable]',
	'type'     => 'checkbox',
) );

// Enable Hot collection.
$wp_customize->add_setting( $bimber_option_name . '[posts_hot_enable]', array(
	'default'           => $bimber_customizer_defaults['posts_hot_enable'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_hot_enable', array(
	'label'    => esc_html__( 'Enable "Hot" collection', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_hot_enable]',
	'type'     => 'checkbox',
) );

// Enable Trending collection.
$wp_customize->add_setting( $bimber_option_name . '[posts_trending_enable]', array(
	'default'           => $bimber_customizer_defaults['posts_trending_enable'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_trending_enable', array(
	'label'    => esc_html__( 'Enable "Trending" collection', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_trending_enable]',
	'type'     => 'checkbox',
) );


// Quick Nav.
$wp_customize->add_setting( $bimber_option_name . '[posts_top_in_menu]', array(
	'default'           => $bimber_customizer_defaults['posts_top_in_menu'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_top_in_menu', array(
	'label'    => esc_html__( 'Top in menu', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_top_in_menu]',
	'type'     => 'select',
	'choices'  => array(
		'single'    => esc_html__( 'single', 'bimber' ),
		'separate'  => esc_html__( 'separate', 'bimber' ),
	),
) );


// Top posts page.
$wp_customize->add_setting( $bimber_option_name . '[posts_top_page]', array(
	'default'           => $bimber_customizer_defaults['posts_top_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_posts_top_page', array(
	'label'    => esc_html__( 'Top posts page', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_top_page]',
	'type'     => 'dropdown-pages',
	'active_callback' => 'bimber_customizer_top_in_menu_single',
) );

// Latest posts page.
$wp_customize->add_setting( $bimber_option_name . '[posts_latest_page]', array(
	'default'           => $bimber_customizer_defaults['posts_latest_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_latest_page', array(
	'label'    => esc_html__( 'Latest posts page', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_latest_page]',
	'type'     => 'checkbox',
	'active_callback' => 'bimber_customizer_top_in_menu_separate',
) );


// Hot posts page.
$wp_customize->add_setting( $bimber_option_name . '[posts_hot_page]', array(
	'default'           => $bimber_customizer_defaults['posts_hot_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_posts_hot_page', array(
	'label'    => esc_html__( 'Hot posts page', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_hot_page]',
	'type'     => 'dropdown-pages',
	'active_callback' => 'bimber_customizer_top_in_menu_separate',
) );


// Popular posts page.
$wp_customize->add_setting( $bimber_option_name . '[posts_popular_page]', array(
	'default'           => $bimber_customizer_defaults['posts_popular_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_posts_popular_page', array(
	'label'    => esc_html__( 'Popular posts page', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_popular_page]',
	'type'     => 'dropdown-pages',
	'active_callback' => 'bimber_customizer_top_in_menu_separate',
) );


// Trending posts page.
$wp_customize->add_setting( $bimber_option_name . '[posts_trending_page]', array(
	'default'           => $bimber_customizer_defaults['posts_trending_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_posts_trending_page', array(
	'label'    => esc_html__( 'Trending posts page', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_trending_page]',
	'type'     => 'dropdown-pages',
	'active_callback' => 'bimber_customizer_top_in_menu_separate',
) );


// Views Threshold.
$wp_customize->add_setting( $bimber_option_name . '[posts_views_threshold]', array(
	'default'           => $bimber_customizer_defaults['posts_views_threshold'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_posts_views_threshold', array(
	'label'       => esc_html__( 'Hide views', 'bimber' ),
	'description' => esc_html__( 'If you fill in any number here, the views for a specific post are not shown until the view count of this number is reached.', 'bimber' ),
	'section'     => 'bimber_posts_global_section',
	'settings'    => $bimber_option_name . '[posts_views_threshold]',
	'type'        => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Fake Views.
$wp_customize->add_setting( $bimber_option_name . '[posts_fake_view_count_base]', array(
	'default'           => $bimber_customizer_defaults['posts_fake_view_count_base'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_posts_fake_view_count_base', array(
	'label'       => esc_html__( 'Fake view count base', 'bimber' ),
	'section'     => 'bimber_posts_global_section',
	'settings'    => $bimber_option_name . '[posts_fake_view_count_base]',
	'type'        => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Comments Threshold.
$wp_customize->add_setting( $bimber_option_name . '[posts_comments_threshold]', array(
	'default'           => $bimber_customizer_defaults['posts_comments_threshold'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_posts_comments_threshold', array(
	'label'       => esc_html__( 'Hide comments', 'bimber' ),
	'description' => esc_html__( 'If you fill in any number here, the comments for a specific post are not shown until the comment count of this number is reached.', 'bimber' ),
	'section'     => 'bimber_posts_global_section',
	'settings'    => $bimber_option_name . '[posts_comments_threshold]',
	'type'        => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// FB api key.
$wp_customize->add_setting( $bimber_option_name . '[posts_fb_app_id]', array(
	'default'           => $bimber_customizer_defaults['posts_fb_app_id'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_fb_app_id', array(
	'label'       => esc_html__( 'Facebook app ID', 'bimber' ),
	'section'     => 'bimber_posts_global_section',
	'settings'    => $bimber_option_name . '[posts_fb_app_id]',
	'type'        => 'text',
) );


// Timeago.
$wp_customize->add_setting( $bimber_option_name . '[posts_timeago]', array(
	'default'           => $bimber_customizer_defaults['posts_timeago'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_timeago', array(
	'label'       => esc_html__( 'Convert date to time ago', 'bimber' ),
	'description' => esc_html__( 'Instead of displaying full date, use timestamps like "4 minutes ago", "1 day ago".', 'bimber' ),
	'section'     => 'bimber_posts_global_section',
	'settings'    => $bimber_option_name . '[posts_timeago]',
	'type'        => 'select',
	'choices'     => array(
		'none'     => esc_html__( 'disabled', 'bimber' ),
		'standard' => esc_html__( 'enabled', 'bimber' ),
	),
) );

/**
 * Check whether user chose single link for Top, in menu
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_top_in_menu_single( $control ) {
	$top_in_menu = $control->manager->get_setting( bimber_get_theme_id() . '[posts_top_in_menu]' )->value();

	return 'single' === $top_in_menu;
}

/**
 * Check whether user chose separate links for Top, in menu
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_top_in_menu_separate( $control ) {
	$top_in_menu = $control->manager->get_setting( bimber_get_theme_id() . '[posts_top_in_menu]' )->value();

	return 'separate' === $top_in_menu;
}


// Auto play videos
$wp_customize->add_setting( $bimber_option_name . '[posts_auto_play_videos]', array(
	'default'           => $bimber_customizer_defaults['posts_auto_play_videos'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_auto_play_videos', array(
	'label'    => esc_html__( 'Auto play videos in Stream collections', 'bimber' ),
	'section'  => 'bimber_posts_global_section',
	'settings' => $bimber_option_name . '[posts_auto_play_videos]',
	'type'     => 'checkbox',
) );

// Use target blank.
$wp_customize->add_setting( $bimber_option_name . '[posts_set_target_blank]', array(
	'default'           => $bimber_customizer_defaults['posts_set_target_blank'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_set_target_blank', array(
	'label'       => esc_html__( 'Open links in new window for infinite scroll in collections', 'bimber' ),
	'section'     => 'bimber_posts_global_section',
	'settings'    => $bimber_option_name . '[posts_set_target_blank]',
	'type'        => 'checkbox',
) );

// FB api key.
$wp_customize->add_setting( $bimber_option_name . '[posts_page_waypoints]', array(
	'default'           => $bimber_customizer_defaults['posts_page_waypoints'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_posts_page_waypoints', array(
	'label'       => esc_html__( 'Use pagination urls for infinite scroll in collections', 'bimber' ),
	'section'     => 'bimber_posts_global_section',
	'settings'    => $bimber_option_name . '[posts_page_waypoints]',
	'type'        => 'checkbox',
) );