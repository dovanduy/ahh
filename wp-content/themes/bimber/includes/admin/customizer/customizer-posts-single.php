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

$bimber_option_name = bimber_get_theme_id();

$wp_customize->add_section( 'bimber_posts_single_section', array(
	'title'    => esc_html__( 'Single', 'bimber' ),
	'priority' => 20,
	'panel'    => 'bimber_posts_panel',
) );

// Template.
$wp_customize->add_setting( $bimber_option_name . '[post_template]', array(
	'default'           => $bimber_customizer_defaults['post_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_post_template', array(
	'label'    => esc_html__( 'Template', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_template]',
	'type'     => 'select',
	'priority' => 100,
	'choices'  => bimber_get_post_templates(),
	'columns'  => 2,
) ) );

// Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[post_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['post_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_post_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_hide_elements]',
	'priority' => 200,
	'choices'  => apply_filters( 'bimber_post_hide_elements_choices', array(
		'categories'      => esc_html__( 'Categories', 'bimber' ),
		'author'          => esc_html__( 'Author', 'bimber' ),
		'avatar'          => esc_html__( 'Avatar', 'bimber' ),
		'date'            => esc_html__( 'Date', 'bimber' ),
		'comments_link'   => esc_html__( 'Comments Link', 'bimber' ),
		'views'           => esc_html__( 'Views', 'bimber' ),
		'featured_media'  => esc_html__( 'Featured Media', 'bimber' ),
		'tags'            => esc_html__( 'Tags', 'bimber' ),
		'newsletter'      => esc_html__( 'Newsletter', 'bimber' ),
		'navigation'      => esc_html__( 'Prev/Next Links', 'bimber' ),
		'author_info'     => esc_html__( 'Author info', 'bimber' ),
		'related_entries' => esc_html__( 'You May Also Like', 'bimber' ),
		'more_from'       => esc_html__( 'More from category', 'bimber' ),
		'dont_miss'       => esc_html__( 'Don\'t miss', 'bimber' ),
		'comments'        => esc_html__( 'Comments section', 'bimber' ),
	) ),
) ) );

// Elements order header.
$bimber_elements_order_base_priority = 300;

$wp_customize->add_setting( 'bimber_post_elements_order_header', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_post_elements_order_header', array(
	'section'  => 'bimber_posts_single_section',
	'settings' => 'bimber_post_elements_order_header',
	'priority' => $bimber_elements_order_base_priority,
	'html'     => '<span class="customize-control-title">' . esc_html__( 'Elements order', 'bimber' ) . '</span>',
) ) );

// Pagination single order.
$wp_customize->add_setting( $bimber_option_name . '[post_pagination_single_order]', array(
	'default'           => $bimber_customizer_defaults['post_pagination_single_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_pagination_single_order', array(
	'label'     	=> esc_html__( 'Pagination Single', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_pagination_single_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );

// Tags order.
$wp_customize->add_setting( $bimber_option_name . '[post_tags_order]', array(
	'default'           => $bimber_customizer_defaults['post_tags_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_tags_order', array(
	'label'     	=> esc_html__( 'Tags', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_tags_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );


// Newsletter order.
$wp_customize->add_setting( $bimber_option_name . '[post_newsletter_order]', array(
	'default'           => $bimber_customizer_defaults['post_newsletter_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_newsletter_order', array(
	'label'     	=> esc_html__( 'Newsletter', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_newsletter_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );

// Nav single order.
$wp_customize->add_setting( $bimber_option_name . '[post_nav_single_order]', array(
	'default'           => $bimber_customizer_defaults['post_nav_single_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_nav_single_order', array(
	'label'     	=> esc_html__( 'Nav Single', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_nav_single_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );

// Author info order.
$wp_customize->add_setting( $bimber_option_name . '[post_author_info_order]', array(
	'default'           => $bimber_customizer_defaults['post_author_info_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_author_info_order', array(
	'label'     	=> esc_html__( 'Author Info', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_author_info_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );

// "You May Also Like" order.
$wp_customize->add_setting( $bimber_option_name . '[post_related_entries_order]', array(
	'default'           => $bimber_customizer_defaults['post_related_entries_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_related_entries_order', array(
	'label'     	=> esc_html__( 'You May Also Like', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_related_entries_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );

// "More From" order.
$wp_customize->add_setting( $bimber_option_name . '[post_more_from_order]', array(
	'default'           => $bimber_customizer_defaults['post_more_from_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'post_more_from_order', array(
	'label'     => esc_html__( 'More From', 'bimber' ),
	'section'  	=> 'bimber_posts_single_section',
	'settings' 	=> $bimber_option_name . '[post_more_from_order]',
	'group_id'	=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );

// "Comments" order.
$wp_customize->add_setting( $bimber_option_name . '[post_comments_order]', array(
	'default'           => $bimber_customizer_defaults['post_comments_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'post_comments_order', array(
	'label'     	=> esc_html__( 'Comments', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_comments_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );

// "Don't Miss" order.
$wp_customize->add_setting( $bimber_option_name . '[post_dont_miss_order]', array(
	'default'           => $bimber_customizer_defaults['post_dont_miss_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'post_dont_miss_order', array(
	'label'     	=> esc_html__( 'Don\'t Miss', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_dont_miss_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority'	=> $bimber_elements_order_base_priority,
) ) );

// ShareBar.
$wp_customize->add_setting( $bimber_option_name . '[post_sharebar]', array(
	'default'           => $bimber_customizer_defaults['post_sharebar'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_sharebar', array(
	'label'       => esc_html__( 'Sticky ShareBar', 'bimber' ),
	'section'     => 'bimber_posts_single_section',
	'settings'    => $bimber_option_name . '[post_sharebar]',
	'type'        => 'select',
	'priority' 	  => 400,
	'choices'     => array(
		'none'          => esc_html__( 'hide', 'bimber' ),
		'standard'      => esc_html__( 'show', 'bimber' ),
	),
) );

// Microshare.
$wp_customize->add_setting( $bimber_option_name . '[post_microshare]', array(
	'default'           => $bimber_customizer_defaults['post_microshare'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_microshare', array(
	'label'       => esc_html__( 'Social sharing buttons on images', 'bimber' ),
	'section'     => 'bimber_posts_single_section',
	'settings'    => $bimber_option_name . '[post_microshare]',
	'type'        => 'select',
	'priority' 	  => 400,
	'choices'     => array(
		'none'          => esc_html__( 'hide', 'bimber' ),
		'standard'      => esc_html__( 'show', 'bimber' ),
	),
) );

// Fly-in next | previous links.
$wp_customize->add_setting( $bimber_option_name . '[post_flyin_nav]', array(
	'default'           => $bimber_customizer_defaults['post_flyin_nav'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_flyin_nav', array(
	'label'    => esc_html__( 'Enable Fly-in Prev/Next Links', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_flyin_nav]',
	'type'     => 'checkbox',
	'priority' => 500,
) );

// Native comments label.
$wp_customize->add_setting( $bimber_option_name . '[post_native_comments_label]', array(
	'default'           => $bimber_customizer_defaults['post_native_comments_label'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_native_comments_label', array(
	'label'           => esc_html__( 'Native comment section label', 'bimber' ),
	'section'         => 'bimber_posts_single_section',
	'settings'        => $bimber_option_name . '[post_native_comments_label]',
	'type'            => 'text',
	'priority'        => 550,
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'Our site', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_comments_multiple_types',
) );

/**
 * Check whether there are many comment types active
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_comments_multiple_types( $control ) {
	return count( bimber_get_comment_types() ) > 1;
}

// Pagination.
$wp_customize->add_setting( 'bimber_post_pagination_header', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_post_pagination_header', array(
	'section'  => 'bimber_posts_single_section',
	'settings' => 'bimber_post_pagination_header',
	'priority' => 600,
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'Pagination', 'bimber' ) . '</h2>',
) ) );

// Pagination: overview.
$wp_customize->add_setting( $bimber_option_name . '[post_pagination_overview]', array(
	'default'           => $bimber_customizer_defaults['post_pagination_overview'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_pagination_overview', array(
	'label'       => esc_html__( 'Overview', 'bimber' ),
	'section'     => 'bimber_posts_single_section',
	'settings'    => $bimber_option_name . '[post_pagination_overview]',
	'type'        => 'select',
	'priority' 	  => 610,
	'choices'     => array(
		'page_links'        => esc_html__( 'page links', 'bimber' ),
		'page_xofy'         => esc_html__( 'page X of Y', 'bimber' ),
		'none'              => esc_html__( 'none', 'bimber' ),
	),
) );

// Pagination: adjacent label.
$wp_customize->add_setting( $bimber_option_name . '[post_pagination_adjacent_label]', array(
	'default'           => $bimber_customizer_defaults['post_pagination_adjacent_label'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_pagination_adjacent_label', array(
	'label'       => esc_html__( 'Labels for previous, next', 'bimber' ),
	'section'     => 'bimber_posts_single_section',
	'settings'    => $bimber_option_name . '[post_pagination_adjacent_label]',
	'type'        => 'select',
	'priority' 	  => 620,
	'choices'     => array(
		'adjacent'      => esc_html__( 'previous | next', 'bimber' ),
		'adjacent_page' => esc_html__( 'previous page | next page', 'bimber' ),
		'arrow'         => esc_html__( 'just arrows', 'bimber' ),
	),
) );

// Pagination: adjacent style.
$wp_customize->add_setting( $bimber_option_name . '[post_pagination_adjacent_style]', array(
	'default'           => $bimber_customizer_defaults['post_pagination_adjacent_style'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_pagination_adjacent_style', array(
	'label'       => esc_html__( 'Style of previous, next', 'bimber' ),
	'section'     => 'bimber_posts_single_section',
	'settings'    => $bimber_option_name . '[post_pagination_adjacent_style]',
	'type'        => 'select',
	'priority' 	  => 630,
	'choices'     => array(
		'link'      => esc_html__( 'link', 'bimber' ),
		'button'    => esc_html__( 'button', 'bimber' ),
	),
) );

// Pagination: next post.
$wp_customize->add_setting( $bimber_option_name . '[post_pagination_next_post]', array(
	'default'           => $bimber_customizer_defaults['post_pagination_next_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_post_pagination_next_post', array(
	'label'       => esc_html__( 'Next on last page redirects to next post', 'bimber' ),
	'section'     => 'bimber_posts_single_section',
	'settings'    => $bimber_option_name . '[post_pagination_next_post]',
	'type'        => 'select',
	'priority' 	  => 640,
	'choices'     => array(
		'none'      => esc_html__( 'no', 'bimber' ),
		'standard'  => esc_html__( 'yes', 'bimber' ),
	),
) );

// "You May Also Like" section header.
$wp_customize->add_setting( 'bimber_post_related_header', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_post_related_header', array(
	'section'  => 'bimber_posts_single_section',
	'settings' => 'bimber_post_related_header',
	'priority' => 700,
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'You May Also Like', 'bimber' ) . '</h2>',
	'active_callback' => 'bimber_customizer_is_related_active',
) ) );

// Max posts.
$wp_customize->add_setting( $bimber_option_name . '[post_related_max_posts]', array(
	'default'           => $bimber_customizer_defaults['post_related_max_posts'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_post_related_max_posts', array(
	'label'    => esc_html__( 'Number of posts', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_related_max_posts]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
	'priority' => 705,
) );

// "You May Also Like" section.
$wp_customize->add_setting( $bimber_option_name . '[post_related_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['post_related_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_post_related_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_related_hide_elements]',
	'priority' => 710,
	'choices'  => array(
		'featured_media'  => esc_html__( 'Featured Media', 'bimber' ),
		'shares'          => esc_html__( 'Shares', 'bimber' ),
		'views'           => esc_html__( 'Views', 'bimber' ),
		'comments_link'   => esc_html__( 'Comments Link', 'bimber' ),
		'categories'      => esc_html__( 'Categories', 'bimber' ),
		'summary'         => esc_html__( 'Summary', 'bimber' ),
		'author'          => esc_html__( 'Author', 'bimber' ),
		'avatar'          => esc_html__( 'Avatar', 'bimber' ),
		'date'            => esc_html__( 'Date', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_related_active',
) ) );

/**
 * Check whether user hide the You May Also Like section
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_related_active( $control ) {
	$hidden_elements = $control->manager->get_setting( bimber_get_theme_id() . '[post_hide_elements]' )->value();

	return false === strpos( $hidden_elements, 'related_entries' );
}

// "More From" section header.
$wp_customize->add_setting( 'bimber_post_more_from_header', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_post_more_from_header', array(
	'section'  => 'bimber_posts_single_section',
	'settings' => 'bimber_post_more_from_header',
	'priority' => 800,
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'More From', 'bimber' ) . '</h2>',
	'active_callback' => 'bimber_customizer_is_more_from_active',
) ) );

// Max posts.
$wp_customize->add_setting( $bimber_option_name . '[post_more_from_max_posts]', array(
	'default'           => $bimber_customizer_defaults['post_more_from_max_posts'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_post_more_from_max_posts', array(
	'label'    => esc_html__( 'Number of posts', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_more_from_max_posts]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
	'priority' => 805,
) );

// "More From" section.
$wp_customize->add_setting( $bimber_option_name . '[post_more_from_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['post_more_from_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_post_more_from_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_more_from_hide_elements]',
	'priority' => 810,
	'choices'  => array(
		'featured_media'  => esc_html__( 'Featured Media', 'bimber' ),
		'shares'          => esc_html__( 'Shares', 'bimber' ),
		'views'           => esc_html__( 'Views', 'bimber' ),
		'comments_link'   => esc_html__( 'Comments Link', 'bimber' ),
		'categories'      => esc_html__( 'Categories', 'bimber' ),
		'summary'         => esc_html__( 'Summary', 'bimber' ),
		'author'          => esc_html__( 'Author', 'bimber' ),
		'avatar'          => esc_html__( 'Avatar', 'bimber' ),
		'date'            => esc_html__( 'Date', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_more_from_active',
) ) );

/**
 * Check whether user hide the More From section
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_more_from_active( $control ) {
	$hidden_elements = $control->manager->get_setting( bimber_get_theme_id() . '[post_hide_elements]' )->value();

	return false === strpos( $hidden_elements, 'more_from' );
}

// "Don't Miss" section header.
$wp_customize->add_setting( 'bimber_post_dont_miss_hide_elements_header', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_post_dont_miss_hide_elements_header', array(
	'section'  => 'bimber_posts_single_section',
	'settings' => 'bimber_post_dont_miss_hide_elements_header',
	'priority' => 900,
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'Don\'t Miss', 'bimber' ) . '</h2>',
	'active_callback' => 'bimber_customizer_is_dont_miss_active',
) ) );

// Max posts.
$wp_customize->add_setting( $bimber_option_name . '[post_dont_miss_max_posts]', array(
	'default'           => $bimber_customizer_defaults['post_dont_miss_max_posts'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_post_dont_miss_max_posts', array(
	'label'    => esc_html__( 'Number of posts', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_dont_miss_max_posts]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
	'priority' => 905,
) );

// "Don't Miss" section.
$wp_customize->add_setting( $bimber_option_name . '[post_dont_miss_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['post_dont_miss_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_post_dont_miss_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_posts_single_section',
	'settings' => $bimber_option_name . '[post_dont_miss_hide_elements]',
	'priority' 	  => 910,
	'choices'  => array(
		'featured_media'  => esc_html__( 'Featured Media', 'bimber' ),
		'shares'          => esc_html__( 'Shares', 'bimber' ),
		'views'           => esc_html__( 'Views', 'bimber' ),
		'comments_link'   => esc_html__( 'Comments Link', 'bimber' ),
		'categories'      => esc_html__( 'Categories', 'bimber' ),
		'summary'         => esc_html__( 'Summary', 'bimber' ),
		'author'          => esc_html__( 'Author', 'bimber' ),
		'avatar'          => esc_html__( 'Avatar', 'bimber' ),
		'date'            => esc_html__( 'Date', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_dont_miss_active',
) ) );

/**
 * Check whether user hide the Don't Miss section
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_dont_miss_active( $control ) {
	$hidden_elements = $control->manager->get_setting( bimber_get_theme_id() . '[post_hide_elements]' )->value();

	return false === strpos( $hidden_elements, 'dont_miss' );
}
