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

// Privacy.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_privacy]', array(
	'default'           => $bimber_customizer_defaults['newsletter_privacy'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'wp_kses_post',
) );
$wp_customize->add_control( 'bimber_newsletter_privacy', array(
	'label'    => esc_html__( 'Privacy', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_privacy]',
	'type'     => 'textarea',
) );

// SECTION: Slideup.
// Slideup header.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_slideup_header]', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new bimber_Customize_HTML_Control( $wp_customize, 'bimber_newsletter_slideup_header', array(
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_slideup_header]',
	'html'     => '<h3>' . esc_html__( 'Slideup', 'bimber' ) . '</h3><hr />',
) ) );
// Show newsletter slideup.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_slideup]', array(
	'default'           => $bimber_customizer_defaults['newsletter_slideup'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'newsletter_slideup', array(
	'label'    => esc_html__( 'Enable', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_slideup]',
	'type'     => 'checkbox',
) );
// Slideup title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_slideup_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_slideup_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_slideup_title', array(
	'label'       => esc_html__( 'Title', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_slideup_title]',
	'type'        => 'textarea',
) );
// Slideup Avatar.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_slideup_avatar]', array(
	'default'           => $bimber_customizer_defaults['newsletter_slideup_avatar'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_slideup_avatar', array(
	'label'    => esc_html__( 'Avatar', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_slideup_avatar]',
) ) );

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

// SECTION: In collection.
// In collection header.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_in_collection_header]', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new bimber_Customize_HTML_Control( $wp_customize, 'bimber_newsletter_in_collection_header', array(
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_in_collection_header]',
	'html'     => '<h3>' . esc_html__( 'In Collection', 'bimber' ) . '</h3><hr />',
) ) );
// In collection title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_in_collection_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_in_collection_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_in_collection_title', array(
	'label'       => esc_html__( 'Title', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_in_collection_title]',
	'type'        => 'textarea',
) );
// In collection subtitle.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_in_collection_subtitle]', array(
	'default'           => $bimber_customizer_defaults['newsletter_in_collection_subtitle'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_in_collection_subtitle', array(
	'label'       => esc_html__( 'Subtitle', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_in_collection_subtitle]',
	'type'        => 'textarea',
) );
// In collection Avatar.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_in_collection_avatar]', array(
	'default'           => $bimber_customizer_defaults['newsletter_in_collection_avatar'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_in_collection_avatar', array(
	'label'    => esc_html__( 'Avatar', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_in_collection_avatar]',
) ) );

// SECTION: Before collection.
// Before collection header.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_collection_header]', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new bimber_Customize_HTML_Control( $wp_customize, 'bimber_newsletter_above_collection_header', array(
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_above_collection_header]',
	'html'     => '<h3>' . esc_html__( 'Before Collection', 'bimber' ) . '</h3><hr />',
) ) );

// Show newsletter.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_collection]', array(
	'default'           => $bimber_customizer_defaults['newsletter_above_collection'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_newsletter_above_collection', array(
	'label'    => esc_html__( 'Enable', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_above_collection]',
	'type'     => 'checkbox',
) );
// Before collection title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_collection_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_above_collection_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_above_collection_title', array(
	'label'       => esc_html__( 'Title', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_above_collection_title]',
	'type'        => 'textarea',
) );
// Before collection subtitle.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_collection_subtitle]', array(
	'default'           => $bimber_customizer_defaults['newsletter_above_collection_subtitle'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_above_collection_subtitle', array(
	'label'       => esc_html__( 'Subtitle', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_above_collection_subtitle]',
	'type'        => 'textarea',
) );
// Before collection Avatar.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_collection_avatar]', array(
	'default'           => $bimber_customizer_defaults['newsletter_above_collection_avatar'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_above_collection_avatar', array(
	'label'    => esc_html__( 'Avatar', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_above_collection_avatar]',
) ) );

// SECTION: After content.
// After post content header.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_after_post_content_header]', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new bimber_Customize_HTML_Control( $wp_customize, 'bimber_newsletter_after_post_content_header', array(
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_after_post_content_header]',
	'html'     => '<h3>' . esc_html__( 'After Post Content', 'bimber' ) . '</h3><hr />',
) ) );
// After post content title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_after_post_content_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_after_post_content_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_after_post_content_title', array(
	'label'       => esc_html__( 'Title', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_after_post_content_title]',
	'type'        => 'textarea',
) );
// After post content subtitle.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_after_post_content_subtitle]', array(
	'default'           => $bimber_customizer_defaults['newsletter_after_post_content_subtitle'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_after_post_content_subtitle', array(
	'label'       => esc_html__( 'Subtitle', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_after_post_content_subtitle]',
	'type'        => 'textarea',
) );
// Cover.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_after_post_content_cover]', array(
	'default'           => $bimber_customizer_defaults['newsletter_after_post_content_cover'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_after_post_content_cover', array(
	'label'    => esc_html__( 'Cover', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_after_post_content_cover]',
) ) );


// SECTION: Other.
// Other header.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_other_header]', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new bimber_Customize_HTML_Control( $wp_customize, 'bimber_newsletter_other_header', array(
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_other_header]',
	'html'     => '<h3>' . esc_html__( 'Others', 'bimber' ) . '</h3><hr />',
) ) );

// Other title.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_other_title]', array(
	'default'           => $bimber_customizer_defaults['newsletter_other_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_newsletter_other_title', array(
	'label'       => esc_html__( 'Title', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_newsletter_section',
	'settings'    => $bimber_option_name . '[newsletter_other_title]',
	'type'        => 'textarea',
) );
// Other Avatar.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_other_avatar]', array(
	'default'           => $bimber_customizer_defaults['newsletter_other_avatar'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_other_avatar', array(
	'label'    => esc_html__( 'Avatar', 'bimber' ),
	'section'  => 'bimber_newsletter_section',
	'settings' => $bimber_option_name . '[newsletter_other_avatar]',
) ) );

/*  /other  */
