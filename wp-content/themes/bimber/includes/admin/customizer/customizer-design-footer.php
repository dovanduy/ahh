<?php
/**
 * WP Customizer panel section to customize footer design options
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

$wp_customize->add_section( 'bimber_footer_colors_section', array(
	'title'    => esc_html__( 'Colors', 'bimber' ),
	'priority' => 11,
	'panel'    => 'bimber_footer_panel',
) );

// Background Color (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_background_color]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_background_color]',
) ) );


// Text 1 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_text1]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_text1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_text1', array(
	'label'    => esc_html__( 'Headings &amp; Titles', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_text1]',
) ) );


// Text 2 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_text2]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_text2'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_text2', array(
	'label'    => esc_html__( 'Regular Text', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_text2]',
) ) );


// Text 3 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_text3]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_text3'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_text3', array(
	'label'    => esc_html__( 'Small Text Descriptions', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_text3]',
) ) );


// Accent 1 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_accent1]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_accent1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_accent1', array(
	'label'    => esc_html__( 'Accent', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_accent1]',
) ) );


// Divider.
$wp_customize->add_setting( 'bimber_footer_cs_2_divider', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_footer_cs_2_divider', array(
	'section'  => 'bimber_footer_colors_section',
	'settings' => 'bimber_footer_cs_2_divider',
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'Secondary Color Scheme', 'bimber' ) . '</h2>
		<p>' . esc_html__( 'Will be applied to buttons, badges &amp; flags.', 'bimber' ) . '</p>',
) ) );


// Background Color (cs2).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_2_background_color]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_2_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_2_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_2_background_color]',
) ) );


// Text 1 (cs2).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_2_text1]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_2_text1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_2_text1', array(
	'label'    => esc_html__( 'Text', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_2_text1]',
) ) );

