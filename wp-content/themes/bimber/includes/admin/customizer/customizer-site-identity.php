<?php
/**
 * WP Customizer panel section to handle general side options (like logo, footer text)
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

// Show tagline.
$wp_customize->add_setting( $bimber_option_name . '[branding_show_tagline]', array(
	'default'           => $bimber_customizer_defaults['branding_show_tagline'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_branding_show_tagline', array(
	'label'    => esc_html__( 'Show Tagline', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[branding_show_tagline]',
	'type'     => 'checkbox',
) );

// Logo.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo]', array(
	'default'           => $bimber_customizer_defaults['branding_logo'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_branding_logo', array(
	'label'    => esc_html__( 'Logo', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[branding_logo]',
) ) );


// Logo width.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo_width]', array(
	'default'           => $bimber_customizer_defaults['branding_logo_width'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_branding_logo_width', array(
	'label'    => esc_html__( 'Logo Width', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[branding_logo_width]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Logo height.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo_height]', array(
	'default'           => $bimber_customizer_defaults['branding_logo_height'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_branding_logo_height', array(
	'label'    => esc_html__( 'Logo Height', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[branding_logo_height]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Logo HDPI.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo_hdpi]', array(
	'default'           => $bimber_customizer_defaults['branding_logo_hdpi'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_branding_logo_hdpi', array(
	'label'       => esc_html__( 'Logo HDPI', 'bimber' ),
	'description' => esc_html__( 'An image for High DPI screen (like Retina) should be twice as big.', 'bimber' ),
	'section'     => 'title_tagline',
	'settings'    => $bimber_option_name . '[branding_logo_hdpi]',
) ) );


// Small Logo.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo_small]', array(
	'default'           => $bimber_customizer_defaults['branding_logo_small'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_branding_logo_small', array(
	'label'    => esc_html__( 'Mobile Logo', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[branding_logo_small]',
) ) );


// Logo width.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo_small_width]', array(
	'default'           => $bimber_customizer_defaults['branding_logo_small_width'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_branding_logo_small_width', array(
	'label'    => esc_html__( 'Mobile Logo Width', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[branding_logo_small_width]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Logo height.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo_small_height]', array(
	'default'           => $bimber_customizer_defaults['branding_logo_small_height'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_branding_logo_small_height', array(
	'label'    => esc_html__( 'Mobile Logo Height', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[branding_logo_small_height]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Logo HDPI.
$wp_customize->add_setting( $bimber_option_name . '[branding_logo_small_hdpi]', array(
	'default'           => $bimber_customizer_defaults['branding_logo_small_hdpi'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_branding_logo_small_hdpi', array(
	'label'       => esc_html__( 'Mobile Logo HDPI', 'bimber' ),
	'description' => esc_html__( 'An image for High DPI screen (like Retina) should be twice as big.', 'bimber' ),
	'section'     => 'title_tagline',
	'settings'    => $bimber_option_name . '[branding_logo_small_hdpi]',
) ) );





// Footer Text.
$wp_customize->add_setting( $bimber_option_name . '[footer_text]', array(
	'default'           => $bimber_customizer_defaults['footer_text'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_footer_text', array(
	'label'    => esc_html__( 'Footer Text', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[footer_text]',
	'type'     => 'text',
) );

// Footer Stamp.
$wp_customize->add_setting( $bimber_option_name . '[footer_stamp]', array(
	'default'           => $bimber_customizer_defaults['footer_stamp'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_footer_stamp', array(
	'label'    => esc_html__( 'Footer Stamp', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[footer_stamp]',
) ) );


// Footer Stamp Width.
$wp_customize->add_setting( $bimber_option_name . '[footer_stamp_width]', array(
	'default'           => $bimber_customizer_defaults['footer_stamp_width'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_footer_stamp_width', array(
	'label'    => esc_html__( 'Footer Stamp Width', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[footer_stamp_width]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Footer Stamp Height.
$wp_customize->add_setting( $bimber_option_name . '[footer_stamp_height]', array(
	'default'           => $bimber_customizer_defaults['footer_stamp_height'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_footer_stamp_height', array(
	'label'    => esc_html__( 'Footer Stamp Height', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[footer_stamp_height]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Footer Stamp HDPI.
$wp_customize->add_setting( $bimber_option_name . '[footer_stamp_hdpi]', array(
	'default'           => $bimber_customizer_defaults['footer_stamp_hdpi'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_footer_stamp_hdpi', array(
	'label'       => esc_html__( 'Footer Stamp HDPI', 'bimber' ),
	'description' => esc_html__( 'An image for High DPI screen (like Retina) should be twice as big.', 'bimber' ),
	'section'     => 'title_tagline',
	'settings'    => $bimber_option_name . '[footer_stamp_hdpi]',
) ) );


// Footer Stamp Label.
$wp_customize->add_setting( $bimber_option_name . '[footer_stamp_label]', array(
	'default'           => $bimber_customizer_defaults['footer_stamp_label'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_footer_stamp_label', array(
	'label'    => esc_html__( 'Footer Stamp Label', 'bimber' ),
	'section'  => 'title_tagline',
	'settings' => $bimber_option_name . '[footer_stamp_label]',
	'type'     => 'text',
) );


// Footer Stamp Url.
$wp_customize->add_setting( $bimber_option_name . '[footer_stamp_url]', array(
	'default'           => $bimber_customizer_defaults['footer_stamp_url'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_footer_stamp_url', array(
	'label'       => esc_html__( 'Footer Stamp URL', 'bimber' ),
	'section'     => 'title_tagline',
	'settings'    => $bimber_option_name . '[footer_stamp_url]',
	'type'        => 'text',
	'input_attrs' => array(
		'placeholder' => esc_html__( 'http://', 'bimber' ),
	),
) );
