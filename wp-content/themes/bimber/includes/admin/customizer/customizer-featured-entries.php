<?php
/**
 * WP Customizer panel section to handle featured entries options
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

$wp_customize->add_section( 'bimber_featured_entries_section', array(
	'title'    => esc_html__( 'Featured Entries', 'bimber' ),
	'panel'    => 'bimber_header_panel',
	'priority' => 300,
) );


// Visibility.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_visibility]', array(
	'default'           => $bimber_customizer_defaults['featured_entries_visibility'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_featured_entries_visibility', array(
	'label'    => esc_html__( 'Visibility', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_visibility]',
	'choices'  => array(
		'home'        => esc_html__( 'Home', 'bimber' ),
		'single_post' => esc_html__( 'Single post', 'bimber' ),
	),
) ) );


// Template.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_template]', array(
	'default'               => $bimber_customizer_defaults['featured_entries_template'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	// Reload cache when outputing preview screen.
	// It's enough to bind js callback just for one field.
	'sanitize_js_callback'  => 'bimber_delete_transients',
) );


$wp_customize->add_control( 'bimber_featured_entries_template', array(
	'label'    => esc_html__( 'Template', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_template]',
	'type'     => 'select',
	'choices'  => array(
		'grid'      => esc_html__( 'grid', 'bimber' ),
		'list'      => esc_html__( 'list', 'bimber' ),
		'bunchy'    => esc_html__( 'bunchy', 'bimber' ),
	),
) );



// Full width.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_full_width]', array(
	'default'           => $bimber_customizer_defaults['featured_entries_full_width'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );


$wp_customize->add_control( 'bimber_featured_entries_full_width', array(
	'label'    => esc_html__( 'Full width', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_full_width]',
	'type'     => 'checkbox',
	'active_callback' => 'bimber_is_featured_entries_number_active',
) );
// Size.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_size]', array(
	'default'               => $bimber_customizer_defaults['featured_entries_size'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
) );


$wp_customize->add_control( 'bimber_featured_entries_size', array(
	'label'    => esc_html__( 'Size', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_size]',
	'type'     => 'select',
	'choices'  => array(
		'xs'      	=> esc_html__( 'Small', 'bimber' ),
		'xs-5'    	=> esc_html__( 'Medium', 'bimber' ),
		'xs-4'      => esc_html__( 'Large', 'bimber' ),
	),
	'active_callback' => 'bimber_is_featured_entries_size_active',
) );

/**
 * Is featured entries size active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 * @return bool
 */
function bimber_is_featured_entries_size_active( $control ) {
	$template = bimber_get_theme_option( 'featured_entries', 'template' );
	$active = 'grid' === $template;
	return $active;
}

// Number.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_number]', array(
	'default'           => $bimber_customizer_defaults['featured_entries_number'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_featured_entries_number', array(
	'label'    => esc_html__( 'Number of entries', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_number]',
	'type'     => 'number',
	'input_attrs' => array(
		'min' => 3,
		'max' => 20,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_is_featured_entries_number_active',
) );

// Number - bunchy.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_number_bunchy]', array(
	'default'           => $bimber_customizer_defaults['featured_entries_number_bunchy'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_featured_entries_number_bunchy', array(
	'label'    => esc_html__( 'Number of entries', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_number_bunchy]',
	'type'     => 'number',
	'input_attrs' => array(
		'min' => 3,
		'max' => 4,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_is_featured_entries_number_bunchy_active',
) );

/**
 * Is featured entries number active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 * @return bool
 */
function bimber_is_featured_entries_number_active( $control ) {
	$template = bimber_get_theme_option( 'featured_entries', 'template' );
	$active = 'grid' === $template || 'list' === $template;
	return $active;
}

/**
 * Is featured entries number active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 * @return bool
 */
function bimber_is_featured_entries_number_bunchy_active( $control ) {
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$template = bimber_get_theme_option( 'featured_entries', 'template' );
		$active = 'bunchy' === $template;
	} else {
		$active = false;
	}
	return $active;
}

// Above header.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_above_header]', array(
	'default'           => $bimber_customizer_defaults['featured_entries_above_header'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_featured_entries_above_header', array(
	'label'    => esc_html__( 'Display above header', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_above_header]',
	'type'     => 'checkbox',
) );

// Gutter.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_gutter]', array(
	'default'           => $bimber_customizer_defaults['featured_entries_gutter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_featured_entries_gutter', array(
	'label'    => esc_html__( 'Grid gutter', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_gutter]',
	'type'     => 'checkbox',
) );

// Media ratio.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_img_ratio]', array(
	'default'               => $bimber_customizer_defaults['featured_entries_img_ratio'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	// Reload cache when outputing preview screen.
	// It's enough to bind js callback just for one field.
	'sanitize_js_callback'  => 'bimber_delete_transients',
) );

$wp_customize->add_control( 'bimber_featured_entries_img_ratio', array(
	'label'    => esc_html__( 'Grid image ratio', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_img_ratio]',
	'type'     => 'select',
	'choices'  => array(
		'2-1'   => esc_html__( '2:1', 'bimber' ),
		'16-9'  => esc_html__( '16:9', 'bimber' ),
		'4-3'   => esc_html__( '4:3', 'bimber' ),
		'1-1'   => esc_html__( '1:1', 'bimber' ),
	),
) );



// Type.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_type]', array(
	'default'               => $bimber_customizer_defaults['featured_entries_type'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	// Reload cache when outputing preview screen.
	// It's enough to bind js callback just for one field.
	'sanitize_js_callback'  => 'bimber_delete_transients',
) );

$wp_customize->add_control( 'bimber_featured_entries_type', array(
	'label'    => esc_html__( 'Type', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_type]',
	'type'     => 'select',
	'choices'  => array(
		'most_shared' => esc_html__( 'most shared', 'bimber' ),
		'most_viewed' => esc_html__( 'most viewed', 'bimber' ),
		'recent'      => esc_html__( 'recent', 'bimber' ),
		'none'        => esc_html__( 'none', 'bimber' ),
	),
) );

// Show in main loop?
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_exclude_from_main_loop]', array(
	'default'           => $bimber_customizer_defaults['featured_entries_exclude_from_main_loop'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_featured_entries_exclude_from_main_loop', array(
	'label'    => esc_html__( 'Exclude from the main collection?', 'bimber' ),
	'section'  => 'bimber_featured_entries_section',
	'settings' => $bimber_option_name . '[featured_entries_exclude_from_main_loop]',
	'type'     => 'checkbox',
) );

/**
 * Check whether user selected global featued entries
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_has_global_featured_entries( $control ) {
	$type = $control->manager->get_setting( bimber_get_theme_id() . '[featured_entries_type]' )->value();

	return 'none' !== $type;
}

/**
 * Check whether featured entries tag filter is supported
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_global_featured_entries_tag_is_active( $control ) {
	$has_featured_entries = bimber_customizer_has_global_featured_entries( $control );

	// Skip if home doesn't use the Featured Entries.
	if ( ! $has_featured_entries ) {
		return false;
	}

	$featured_entries_type = $control->manager->get_setting( bimber_get_theme_id() . '[featured_entries_type]' )->value();

	// The most viewed types doesn't support tag filter.
	if ( 'most_viewed' === $featured_entries_type ) {
		return false;
	}

	return apply_filters( 'bimber_customizer_global_featured_entries_tag_is_active', true );
}

// Category.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_category]', array(
	'default'               => $bimber_customizer_defaults['featured_entries_category'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'bimber_sanitize_multi_choice',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_featured_entries_category', array(
	'label'           => esc_html__( 'Category', 'bimber' ),
	'section'         => 'bimber_featured_entries_section',
	'settings'        => $bimber_option_name . '[featured_entries_category]',
	'choices'         => bimber_customizer_get_category_choices(),
	'active_callback' => 'bimber_customizer_has_global_featured_entries',
) ) );


// Tag.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_tag]', array(
	'default'               => $bimber_customizer_defaults['featured_entries_tag'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'bimber_sanitize_multi_choice',
) );

$wp_customize->add_control( new Bimber_Customize_Tag_Select_Control( $wp_customize, 'bimber_featured_entries_tag', array(
	'label'           => esc_html__( 'Tags', 'bimber' ),
	'section'         => 'bimber_featured_entries_section',
	'settings'        => $bimber_option_name . '[featured_entries_tag]',
	'choices'         => bimber_customizer_get_tag_choices(),
	'active_callback' => 'bimber_customizer_global_featured_entries_tag_is_active',
) ) );


// Time range.
$wp_customize->add_setting( $bimber_option_name . '[featured_entries_time_range]', array(
	'default'               => $bimber_customizer_defaults['featured_entries_time_range'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_featured_entries_time_range', array(
	'label'           => esc_html__( 'Time range', 'bimber' ),
	'section'         => 'bimber_featured_entries_section',
	'settings'        => $bimber_option_name . '[featured_entries_time_range]',
	'type'            => 'select',
	'choices'         => array(
		'day'   => esc_html__( 'last 24 hours', 'bimber' ),
		'week'  => esc_html__( 'last 7 days', 'bimber' ),
		'month' => esc_html__( 'last 30 days', 'bimber' ),
		'all'   => esc_html__( 'all time', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_has_global_featured_entries',
) );
