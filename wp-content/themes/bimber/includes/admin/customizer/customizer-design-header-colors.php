<?php
/**
 * WP Customizer panel section to handle header design options
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

$wp_customize->add_section( 'bimber_header_builder_colors_section_a', array(
	'title'    => esc_html__( 'Colors - Row A', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );
$wp_customize->add_section( 'bimber_header_builder_colors_section_b', array(
	'title'    => esc_html__( 'Colors - Row B', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );
$wp_customize->add_section( 'bimber_header_builder_colors_section_c', array(
	'title'    => esc_html__( 'Colors - Row C', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );
$wp_customize->add_section( 'bimber_header_builder_colors_section_canvas', array(
	'title'    => esc_html__( 'Colors - Off-Canvas', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );
$wp_customize->add_section( 'bimber_header_builder_colors_section_submenus', array(
	'title'    => esc_html__( 'Colors - Submenus', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );
// Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_a_text_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_a_text_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_a_text_color', array(
	'label'    => esc_html__( 'Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_a',
	'settings' => $bimber_option_name . '[header_builder_a_text_color]',
) ) );
// Acces Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_a_accent_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_a_accent_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_a_accent_color', array(
	'label'    => esc_html__( 'Accent', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_a',
	'settings' => $bimber_option_name . '[header_builder_a_accent_color]',
) ) );
// Background.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_a_background_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_a_background_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_a_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_a',
	'settings' => $bimber_option_name . '[header_builder_a_background_color]',
) ) );
// Optional Gradient Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_a_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_a_gradient_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_a_gradient_color', array(
	'label'    => esc_html__( 'Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_a',
	'settings' => $bimber_option_name . '[header_builder_a_gradient_color]',
) ) );
// Optional Border Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_a_border_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_a_border_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_a_border_color', array(
	'label'    => esc_html__( 'Optional Border', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_a',
	'settings' => $bimber_option_name . '[header_builder_a_border_color]',
) ) );
// Button Background Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_a_button_background]', array(
	'default'           => $bimber_customizer_defaults['header_builder_a_button_background'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_a_button_background', array(
	'label'    => esc_html__( 'Button Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_a',
	'settings' => $bimber_option_name . '[header_builder_a_button_background]',
	'priority' => 100,
) ) );
// Button Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_a_button_text]', array(
	'default'           => $bimber_customizer_defaults['header_builder_a_button_text'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_a_button_text', array(
	'label'    => esc_html__( 'Button Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_a',
	'settings' => $bimber_option_name . '[header_builder_a_button_text]',
	'priority' => 100,
) ) );
// Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_b_text_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_b_text_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_b_text_color', array(
	'label'    => esc_html__( 'Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_b',
	'settings' => $bimber_option_name . '[header_builder_b_text_color]',
) ) );
// Acces Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_b_accent_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_b_accent_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_b_accent_color', array(
	'label'    => esc_html__( 'Accent', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_b',
	'settings' => $bimber_option_name . '[header_builder_b_accent_color]',
) ) );
// Background.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_b_background_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_b_background_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_b_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_b',
	'settings' => $bimber_option_name . '[header_builder_b_background_color]',
) ) );
// Optional Gradient Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_b_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_b_gradient_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_b_gradient_color', array(
	'label'    => esc_html__( 'Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_b',
	'settings' => $bimber_option_name . '[header_builder_b_gradient_color]',
) ) );
// Optional Border Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_b_border_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_b_border_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_b_border_color', array(
	'label'    => esc_html__( 'Optional Border', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_b',
	'settings' => $bimber_option_name . '[header_builder_b_border_color]',
) ) );
// Button Background Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_b_button_background]', array(
	'default'           => $bimber_customizer_defaults['header_builder_b_button_background'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_b_button_background', array(
	'label'    => esc_html__( 'Button Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_b',
	'settings' => $bimber_option_name . '[header_builder_b_button_background]',
	'priority' => 100,
) ) );
// Button Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_b_button_text]', array(
	'default'           => $bimber_customizer_defaults['header_builder_b_button_text'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_b_button_text', array(
	'label'    => esc_html__( 'Button Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_b',
	'settings' => $bimber_option_name . '[header_builder_b_button_text]',
	'priority' => 100,
) ) );
// Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_c_text_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_c_text_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_c_text_color', array(
	'label'    => esc_html__( 'Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_c',
	'settings' => $bimber_option_name . '[header_builder_c_text_color]',
) ) );
// Acces Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_c_accent_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_c_accent_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_c_accent_color', array(
	'label'    => esc_html__( 'Accent', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_c',
	'settings' => $bimber_option_name . '[header_builder_c_accent_color]',
) ) );
// Background.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_c_background_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_c_background_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_c_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_c',
	'settings' => $bimber_option_name . '[header_builder_c_background_color]',
) ) );
// Optional Gradient Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_c_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_c_gradient_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_c_gradient_color', array(
	'label'    => esc_html__( 'Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_c',
	'settings' => $bimber_option_name . '[header_builder_c_gradient_color]',
) ) );
// Optional Border Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_c_border_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_c_border_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_c_border_color', array(
	'label'    => esc_html__( 'Optional Border', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_c',
	'settings' => $bimber_option_name . '[header_builder_c_border_color]',
) ) );

// Button Background Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_c_button_background]', array(
	'default'           => $bimber_customizer_defaults['header_builder_c_button_background'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_c_button_background', array(
	'label'    => esc_html__( 'Button Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_c',
	'settings' => $bimber_option_name . '[header_builder_c_button_background]',
	'priority' => 100,
) ) );
// Button Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_c_button_text]', array(
	'default'           => $bimber_customizer_defaults['header_builder_c_button_text'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_c_button_text', array(
	'label'    => esc_html__( 'Button Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_c',
	'settings' => $bimber_option_name . '[header_builder_c_button_text]',
	'priority' => 100,
) ) );
// Submenu Background Color.
$wp_customize->add_setting( $bimber_option_name . '[header_submenu_background_color]', array(
	'default'           => $bimber_customizer_defaults['header_submenu_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_submenu_background_color', array(
	'label'    => esc_html__( 'Submenu Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_submenus',
	'settings' => $bimber_option_name . '[header_submenu_background_color]',
	'priority' => 100,
) ) );

// Submenu Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_submenu_text_color]', array(
	'default'           => $bimber_customizer_defaults['header_submenu_text_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_submenu_text_color', array(
	'label'    => esc_html__( 'Submenu Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_submenus',
	'settings' => $bimber_option_name . '[header_submenu_text_color]',
	'priority' => 100,
) ) );
// Submenu Accent Color.
$wp_customize->add_setting( $bimber_option_name . '[header_submenu_accent_color]', array(
	'default'           => $bimber_customizer_defaults['header_submenu_accent_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_submenu_accent_color', array(
	'label'    => esc_html__( 'Submenu Accent', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_submenus',
	'settings' => $bimber_option_name . '[header_submenu_accent_color]',
	'priority' => 100,
) ) );
// Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_text_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_canvas_text_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_canvas_text_color', array(
	'label'    => esc_html__( 'Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_text_color]',
) ) );
// Acces Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_accent_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_canvas_accent_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_canvas_accent_color', array(
	'label'    => esc_html__( 'Accent', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_accent_color]',
) ) );

// Background.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_background_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_canvas_background_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_canvas_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_background_color]',
) ) );
// Optional Gradient Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['header_builder_canvas_gradient_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'  		=> 'postMessage',
) );
// Button Background Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_button_background]', array(
	'default'           => $bimber_customizer_defaults['header_builder_canvas_button_background'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_canvas_button_background', array(
	'label'    => esc_html__( 'Button Background', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_button_background]',
	'priority' => 100,
) ) );
// Button Text Color.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_button_text]', array(
	'default'           => $bimber_customizer_defaults['header_builder_canvas_button_text'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_canvas_button_text', array(
	'label'    => esc_html__( 'Button Text', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_button_text]',
	'priority' => 100,
) ) );
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_header_builder_canvas_gradient_color', array(
	'label'    => esc_html__( 'Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_gradient_color]',
) ) );
// Logo.
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_background_image]', array(
	'default'           => $bimber_customizer_defaults['header_builder_canvas_background_image'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_header_builder_canvas_background_image', array(
	'label'    => esc_html__( 'Background image', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_background_image]',
) ) );
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_background_repeat]', array(
	'default'               => $bimber_customizer_defaults['header_builder_canvas_background_repeat'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );

$wp_customize->add_control( 'bimber_header_builder_canvas_background_repeat', array(
	'label'    => esc_html__( 'Background image repeat', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_background_repeat]',
	'type'     => 'select',
	'choices'  => array(
		'no-repeat'      	=> esc_html__( 'no repeat', 'bimber' ),
		'repeat'      		=> esc_html__( 'repeat', 'bimber' ),
		'repeat-x'      	=> esc_html__( 'repeat x', 'bimber' ),
		'repeat-y'      	=> esc_html__( 'repeat y', 'bimber' ),
	),
) );
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_background_size]', array(
	'default'               => $bimber_customizer_defaults['header_builder_canvas_background_size'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_builder_canvas_background_size', array(
	'label'    => esc_html__( 'Background image size', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_background_size]',
	'type'     => 'select',
	'choices'  => array(
		'auto'      	=> esc_html__( 'auto', 'bimber' ),
		'cover'      	=> esc_html__( 'cover', 'bimber' ),
	),
) );
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_background_position]', array(
	'default'               => $bimber_customizer_defaults['header_builder_canvas_background_position'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );

$wp_customize->add_control( 'bimber_header_builder_canvas_background_position', array(
	'label'    => esc_html__( 'Background image position', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_background_position]',
	'type'     => 'select',
	'choices'  => array(
		'top left'      	=> esc_html__( 'top left', 'bimber' ),
		'top center'      	=> esc_html__( 'top center', 'bimber' ),
		'top right'      	=> esc_html__( 'top right', 'bimber' ),
		'center left'      	=> esc_html__( 'center left', 'bimber' ),
		'center center'     => esc_html__( 'center center', 'bimber' ),
		'center right'      => esc_html__( 'center right', 'bimber' ),
		'bottom left'      	=> esc_html__( 'bottom left', 'bimber' ),
		'bottom center'     => esc_html__( 'bottom center', 'bimber' ),
		'bottom right'      => esc_html__( 'bottom right', 'bimber' ),
	),
) );
$wp_customize->add_setting( $bimber_option_name . '[header_builder_canvas_background_opacity]', array(
	'default'               => $bimber_customizer_defaults['header_builder_canvas_background_opacity'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Custom_Range_Control( $wp_customize, 'bimber_header_builder_canvas_background_opacity', array(
	'label'    => esc_html__( 'Background image opacity', 'bimber' ),
	'section'  => 'bimber_header_builder_colors_section_canvas',
	'settings' => $bimber_option_name . '[header_builder_canvas_background_opacity]',
	'input_attrs' => array(
		'min'   => 0,
		'max'   => 100,
	),
) ) );
