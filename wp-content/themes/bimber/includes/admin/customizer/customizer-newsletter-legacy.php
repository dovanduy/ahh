<?php
/**
 * Mailchimp for WP integration
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

$wp_customize->add_section( 'bimber_newsletter_section', array(
	'title'    => esc_html__( 'Mailchimp for WP', 'bimber' ),
	'panel'    => 'bimber_plugins_panel',
	'priority' => 400,
) );


// Title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_newsletter_title', array(
	'label'       => esc_html__( 'Main title', 'bimber' ),
	'description' => esc_html__( 'Used after a single post content and inside list collection.', 'bimber' ),
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_title]',
	'type'        => 'textarea',
) );

// Subtitle.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_subtitle]', array(
	'default'           => $bimber_customizer_defaults['newsletter_subtitle'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_newsletter_subtitle', array(
	'label'       => esc_html__( 'Subtitle', 'bimber' ),
	'description' => esc_html__( 'Used below the main title.', 'bimber' ),
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_subtitle]',
	'type'        => 'textarea',
) );

// Compact title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_compact_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_compact_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_newsletter_compact_title', array(
	'label'       => esc_html__( 'Compact title', 'bimber' ),
	'description' => esc_html__( 'Used for widgets and inside grid collection.', 'bimber' ),
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_compact_title]',
	'type'        => 'textarea',
) );

// Privacy.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_privacy]', array(
	'default'           => $bimber_customizer_defaults['newsletter_privacy'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'bimber_newsletter_privacy', array(
	'label'       => esc_html__( 'Privacy', 'bimber' ),
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_privacy]',
	'type'        => 'textarea',
) );


// SECTION: Popup.
// Popup header.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_popup_header]', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new bimber_Customize_HTML_Control( $wp_customize, 'bimber_newsletter_popup_header', array(
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_popup_header]',
	'html'     => '<h3>' . esc_html__( 'Popup', 'bimber' ) . '</h3><hr />',
) ) );
// Show newsletter popup.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_popup]', array(
	'default'           => $bimber_customizer_defaults['newsletter_popup'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'newsletter_popup', array(
	'label'    => esc_html__( 'Enable', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_popup]',
	'type'     => 'checkbox',
) );
// Popup title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_popup_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_popup_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_popup_title', array(
	'label'       => esc_html__( 'Title', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_popup_title]',
	'type'        => 'textarea',
) );
// Popup subtitle.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_popup_subtitle]', array(
	'default'           => $bimber_customizer_defaults['newsletter_popup_subtitle'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_popup_subtitle', array(
	'label'       => esc_html__( 'Subtitle', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_popup_subtitle]',
	'type'        => 'textarea',
) );
// Popup Cover.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_popup_cover]', array(
	'default'           => $bimber_customizer_defaults['newsletter_popup_cover'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_popup_cover', array(
	'label'    => esc_html__( 'Cover', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_popup_cover]',
) ) );