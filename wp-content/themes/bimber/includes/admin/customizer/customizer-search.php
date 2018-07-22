<?php
/**
 * WP Customizer panel section to handle post single options
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

// Define Search section.
$wp_customize->add_section( 'bimber_search_section', array(
	'title'    => esc_html__( 'Search', 'bimber' ),
	'priority' => 210,
) );

$bimber_option_name = bimber_get_theme_id();

// AJAX search results.
$wp_customize->add_setting( $bimber_option_name . '[search_ajax]', array(
	'default'           => $bimber_customizer_defaults['search_ajax'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_search_ajax', array(
	'label'    => esc_html__( 'Enable AJAX search results', 'bimber' ),
	'section'  => 'bimber_search_section',
	'settings' => $bimber_option_name . '[search_ajax]',
	'type'     => 'checkbox',
) );

// Template.
$wp_customize->add_setting( $bimber_option_name . '[search_template]', array(
	'default'           => $bimber_customizer_defaults['search_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_search_template', array(
	'label'    => esc_html__( 'Template', 'bimber' ),
	'section'  => 'bimber_search_section',
	'settings' => $bimber_option_name . '[search_template]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_templates(),
	'columns'  => 2,
) ) );

// Posts Per Page.
$wp_customize->add_setting( $bimber_option_name . '[search_posts_per_page]', array(
	'default'           => $bimber_customizer_defaults['search_posts_per_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_search_posts_per_page', array(
	'label'    => esc_html__( 'Entries per page', 'bimber' ),
	'section'  => 'bimber_search_section',
	'settings' => $bimber_option_name . '[search_posts_per_page]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// search inject embeds.
$wp_customize->add_setting( $bimber_option_name . '[search_inject_embeds]', array(
	'default'           => $bimber_customizer_defaults['search_inject_embeds'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_search_inject_embeds', array(
	'label'    => esc_html__( 'Inject embeds into featured media', 'bimber' ),
	'section'  => 'bimber_search_section',
	'settings' => $bimber_option_name . '[search_inject_embeds]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
) );

// Pagination.
$wp_customize->add_setting( $bimber_option_name . '[search_pagination]', array(
	'default'           => $bimber_customizer_defaults['search_pagination'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_search_pagination', array(
	'label'    => esc_html__( 'Pagination', 'bimber' ),
	'section'  => 'bimber_search_section',
	'settings' => $bimber_option_name . '[search_pagination]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_pagination_types(),
) );

// Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[search_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['search_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_search_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_search_section',
	'settings' => $bimber_option_name . '[search_hide_elements]',
	'choices'  => bimber_get_search_elements_to_hide(),
) ) );
