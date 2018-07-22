<?php
/**
 * WP Customizer panel section to handle posts archive options
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

$wp_customize->add_section( 'bimber_posts_archive_section', array(
	'title'    => esc_html__( 'Archive', 'bimber' ),
	'priority' => 40,
	'panel'    => 'bimber_posts_panel',
) );


// Divider.
$wp_customize->add_setting( 'bimber_archive_featured_divider', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_archive_featured_divider', array(
	'section'  => 'bimber_posts_archive_section',
	'settings' => 'bimber_archive_featured_divider',
	'html'     => '<h2>' . esc_html__( 'Featured Entries', 'bimber' ) . '</h2>',
) ) );


// Featured Entries.
$wp_customize->add_setting( $bimber_option_name . '[archive_featured_entries]', array(
	'default'           => $bimber_customizer_defaults['archive_featured_entries'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_featured_entries', array(
	'label'    => esc_html__( 'Type', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_featured_entries]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_featured_entries_types(),
) );

// Featured entries title.
$wp_customize->add_setting( $bimber_option_name . '[archive_featured_entries_title]', array(
	'default'           => $bimber_customizer_defaults['archive_featured_entries_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_featured_entries_title', array(
	'label'           => esc_html__( 'Title', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_featured_entries_title]',
	'type'            => 'text',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'Leave empty to use default', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_archive_has_featured_entries',
) );

// Featured entries hide title.
$wp_customize->add_setting( $bimber_option_name . '[archive_featured_entries_title_hide]', array(
	'default'           => $bimber_customizer_defaults['archive_featured_entries_title_hide'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_featured_entries_title_hide', array(
	'label'    => esc_html__( 'Hide Title', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_featured_entries_title_hide]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
	'active_callback' => 'bimber_customizer_archive_has_featured_entries',
) );


// Featured Entries Template.
$wp_customize->add_setting( $bimber_option_name . '[archive_featured_entries_template]', array(
	'default'           => $bimber_customizer_defaults['archive_featured_entries_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_archive_featured_entries_template', array(
	'label'    => esc_html__( 'Template', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_featured_entries_template]',
	'type'     => 'select',
	'columns'  => 2,
	'choices'  => bimber_get_archive_featured_entries_templates(),
	'active_callback' => 'bimber_customizer_archive_has_featured_entries',
) ) );

// Featured entries gutter.
$wp_customize->add_setting( $bimber_option_name . '[archive_featured_entries_gutter]', array(
	'default'           => $bimber_customizer_defaults['archive_featured_entries_gutter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_featured_entries_gutter', array(
	'label'    => esc_html__( 'Gutter', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_featured_entries_gutter]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
	'active_callback' => 'bimber_customizer_archive_has_featured_entries',
) );


// Featured Entries Time range.
$wp_customize->add_setting( $bimber_option_name . '[archive_featured_entries_time_range]', array(
	'default'           => $bimber_customizer_defaults['archive_featured_entries_time_range'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_featured_entries_time_range', array(
	'label'           => esc_html__( 'Time range', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_featured_entries_time_range]',
	'type'            => 'select',
	'choices'         => bimber_get_archive_featured_entries_time_ranges(),
	'active_callback' => 'bimber_customizer_archive_has_featured_entries',
) );


// Featured Entries Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[archive_featured_entries_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['archive_featured_entries_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_archive_featured_entries_hide_elements', array(
	'label'           => esc_html__( 'Hide Elements', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_featured_entries_hide_elements]',
	'choices'         => array(
		'shares'        => esc_html__( 'Shares', 'bimber' ),
		'views'         => esc_html__( 'Views', 'bimber' ),
		'comments_link' => esc_html__( 'Comments Link', 'bimber' ),
		'categories'    => esc_html__( 'Categories', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_archive_has_featured_entries',
) ) );

/**
 * Check whether featured entries are enabled for archive pages
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_archive_has_featured_entries( $control ) {
	$type = $control->manager->get_setting( bimber_get_theme_id() . '[archive_featured_entries]' )->value();

	return 'none' !== $type;
}


// Divider.
$wp_customize->add_setting( 'bimber_archive_divider', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_archive_divider', array(
	'section'  => 'bimber_posts_archive_section',
	'settings' => 'bimber_archive_divider',
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'Main Collection', 'bimber' ) . '</h2>',
) ) );

// Title.
$wp_customize->add_setting( $bimber_option_name . '[archive_title]', array(
	'default'           => $bimber_customizer_defaults['archive_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_title', array(
	'label'           => esc_html__( 'Title', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_title]',
	'type'            => 'text',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'Leave empty to use default', 'bimber' ),
	),
) );


// Hide title.
$wp_customize->add_setting( $bimber_option_name . '[archive_title_hide]', array(
	'default'           => $bimber_customizer_defaults['archive_title_hide'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_title_hide', array(
	'label'    => esc_html__( 'Hide title', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_title_hide]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
) );


// Template.
$wp_customize->add_setting( $bimber_option_name . '[archive_template]', array(
	'default'           => $bimber_customizer_defaults['archive_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_archive_template', array(
	'label'    => esc_html__( 'Template', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_template]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_templates(),
	'columns'  => 2,
) ) );

// Header composition.
$wp_customize->add_setting( $bimber_option_name . '[archive_header_composition]', array(
	'default'           => $bimber_customizer_defaults['archive_header_composition'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_header_composition', array(
	'label'    => esc_html__( 'Header composition', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_header_composition]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_header_compositions(),
) );


// Archive filter.
$wp_customize->add_setting( $bimber_option_name . '[archive_default_filter]', array(
	'default'           => $bimber_customizer_defaults['archive_default_filter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_archive_default_filter', array(
	'label'    => esc_html__( 'Order by', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_default_filter]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_filters(),
) );



// Archive Filters.
$wp_customize->add_setting( $bimber_option_name . '[archive_filters]', array(
	'default'           => $bimber_customizer_defaults['archive_filters'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_archive_filters', array(
	'label'    => esc_html__( 'Order by filters', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_filters]',
	'choices'  => bimber_get_archive_filters(),
) ) );

// Hide Header Elements.
$wp_customize->add_setting( $bimber_option_name . '[archive_header_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['archive_header_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_archive_header_hide_elements', array(
	'label'    => esc_html__( 'Hide Archive Header Elements', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_header_hide_elements]',
	'choices'  => bimber_get_archive_header_elements_to_hide(),
) ) );

// archive inject embeds.
$wp_customize->add_setting( $bimber_option_name . '[archive_inject_embeds]', array(
	'default'           => $bimber_customizer_defaults['archive_inject_embeds'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_inject_embeds', array(
	'label'    => esc_html__( 'Inject embeds into featured media', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_inject_embeds]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
) );

// Posts Per Page.
$wp_customize->add_setting( $bimber_option_name . '[archive_posts_per_page]', array(
	'default'           => $bimber_customizer_defaults['archive_posts_per_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_posts_per_page', array(
	'label'    => esc_html__( 'Entries per page', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_posts_per_page]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Pagination.
$wp_customize->add_setting( $bimber_option_name . '[archive_pagination]', array(
	'default'           => $bimber_customizer_defaults['archive_pagination'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_pagination', array(
	'label'    => esc_html__( 'Pagination', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_pagination]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_pagination_types(),
) );


// Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[archive_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['archive_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_archive_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_hide_elements]',
	'choices'  => bimber_get_archive_elements_to_hide(),
) ) );


// Newsletter.
$wp_customize->add_setting( $bimber_option_name . '[archive_newsletter]', array(
	'default'           => $bimber_customizer_defaults['archive_newsletter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_newsletter', array(
	'label'    => esc_html__( 'Newsletter', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_newsletter]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_newsletter_options(),
) );

// Newsletter at position.
$wp_customize->add_setting( $bimber_option_name . '[archive_newsletter_after_post]', array(
	'default'           => $bimber_customizer_defaults['archive_newsletter_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_newsletter_after_post', array(
	'label'           => esc_html__( 'Inject newsletter at position', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_newsletter_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 2', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_archive_newsletter_checked',
) );

// Newsletter repeat.
$wp_customize->add_setting( $bimber_option_name . '[archive_newsletter_repeat]', array(
	'default'           => $bimber_customizer_defaults['archive_newsletter_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_newsletter_repeat', array(
	'label'           => esc_html__( 'Repeat newsletter after each X positions', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_newsletter_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_archive_newsletter_checked',
) );

/**
 * Check whether newsletter is enabled for archive pages
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_archive_newsletter_checked( $control ) {
	return $control->manager->get_setting( bimber_get_theme_id() . '[archive_newsletter]' )->value() === 'standard';
}


// Ad.
$wp_customize->add_setting( $bimber_option_name . '[archive_ad]', array(
	'default'           => $bimber_customizer_defaults['archive_ad'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_ad', array(
	'label'    => esc_html__( 'Ad', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_ad]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_ad_options(),
) );

// Ad at position.
$wp_customize->add_setting( $bimber_option_name . '[archive_ad_after_post]', array(
	'default'           => $bimber_customizer_defaults['archive_ad_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_ad_after_post', array(
	'label'           => esc_html__( 'Inject ad at position', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_ad_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 4', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_archive_ad_checked',
) );

// Ad repeat.
$wp_customize->add_setting( $bimber_option_name . '[archive_ad_repeat]', array(
	'default'           => $bimber_customizer_defaults['archive_ad_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_ad_repeat', array(
	'label'           => esc_html__( 'Repeat ad after each X positions', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_ad_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_archive_ad_checked',
) );

/**
 * Check whether ad is enabled for archive pages
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_archive_ad_checked( $control ) {
	return $control->manager->get_setting( bimber_get_theme_id() . '[archive_ad]' )->value() === 'standard';
}

// Product.
$wp_customize->add_setting( $bimber_option_name . '[archive_product]', array(
	'default'           => $bimber_customizer_defaults['archive_product'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_product', array(
	'label'    => esc_html__( 'Product', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings' => $bimber_option_name . '[archive_product]',
	'type'     => 'select',
	'choices'  => bimber_get_archive_product_options(),
) );

// Product at position.
$wp_customize->add_setting( $bimber_option_name . '[archive_product_after_post]', array(
	'default'           => $bimber_customizer_defaults['archive_product_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_product_after_post', array(
	'label'           => esc_html__( 'Inject product at position', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_product_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 6', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_archive_product_checked',
) );

// Product repeat.
$wp_customize->add_setting( $bimber_option_name . '[archive_product_repeat]', array(
	'default'           => $bimber_customizer_defaults['archive_product_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_archive_product_repeat', array(
	'label'           => esc_html__( 'Repeat product after each X positions', 'bimber' ),
	'section'  => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_product_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_archive_product_checked',
) );

// Product category.
$wp_customize->add_setting( $bimber_option_name . '[archive_product_category]', array(
	'default'           => $bimber_customizer_defaults['archive_product_category'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Select_Control( $wp_customize, 'bimber_archive_product_category', array(
	'label'           => esc_html__( 'Inject products from category', 'bimber' ),
	'description'     => esc_html__( 'you can choose many', 'bimber' ),
	'section'         => 'bimber_posts_archive_section',
	'settings'        => $bimber_option_name . '[archive_product_category]',
	'choices'         => bimber_customizer_get_product_category_choices(),
	'active_callback' => 'bimber_customizer_is_archive_product_checked',
) ) );

/**
 * Check whether product is enabled for archive pages
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_archive_product_checked( $control ) {
	return $control->manager->get_setting( bimber_get_theme_id() . '[archive_product]' )->value() === 'standard';
}
