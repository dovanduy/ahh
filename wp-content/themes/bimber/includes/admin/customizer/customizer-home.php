<?php
/**
 * WP Customizer panel section to handle homepage options
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

$wp_customize->add_section( 'bimber_home_featured_entries_section', array(
	'title'    => esc_html__( 'Featured Entries', 'bimber' ),
	'priority' => 20,
	'panel'    => 'bimber_home_panel',
) );

$wp_customize->add_section( 'bimber_home_main_collection_section', array(
	'title'    => esc_html__( 'Main Collection', 'bimber' ),
	'priority' => 30,
	'panel'    => 'bimber_home_panel',
) );

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	$wp_customize->add_section( 'bimber_home_before_main_collection_section', array(
		'title'    => esc_html__( 'Before Main Collection', 'bimber' ),
		'priority' => 29,
		'panel'    => 'bimber_home_panel',
	) );
}




/**
 * Check whether user chose page for Posts
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_posts_page_selected( $control ) {
	$show_on_front = $control->manager->get_setting( 'show_on_front' )->value();

	// Front page displays.
	if ( 'posts' === $show_on_front ) {
		// Your Latest posts.
		return true;
	} else {
		// A static page.
		$page_for_posts = $control->manager->get_setting( 'page_for_posts' )->value();

		// A page is selected (0 means no selection).
		return '0' !== $page_for_posts;
	}
}






// Featured Entries.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_featured_entries', array(
	'label'    => esc_html__( 'Type', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries]',
	'type'     => 'select',
	'choices'  => array(
		'most_shared' => esc_html__( 'most shared', 'bimber' ),
		'most_viewed' => esc_html__( 'most viewed', 'bimber' ),
		'recent'      => esc_html__( 'recent', 'bimber' ),
		'none'        => esc_html__( 'none', 'bimber' ),
	),
) );

// Featured entries title.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_title]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_featured_entries_title', array(
	'label'           => esc_html__( 'Title', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_title]',
	'type'            => 'text',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'Leave empty to use default', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) );

// Featured entries hide title.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_title_hide]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_title_hide'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_featured_entries_title_hide', array(
	'label'    => esc_html__( 'Hide Title', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries_title_hide]',
	'type'     => 'checkbox',
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) );

/**
 * Check whether featured entries are enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_home_has_featured_entries( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	$type = $control->manager->get_setting( bimber_get_theme_id() . '[home_featured_entries]' )->value();

	return 'none' !== $type;
}

/**
 * Check whether featured entries tag filter is supported
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_home_featured_entries_tag_is_active( $control ) {
	$has_featured_entries = bimber_customizer_home_has_featured_entries( $control );

	// Skip if home doesn't use the Featured Entries.
	if ( ! $has_featured_entries ) {
		return false;
	}

	$featured_entries_type = $control->manager->get_setting( bimber_get_theme_id() . '[home_featured_entries]' )->value();

	// The most viewed types doesn't support tag filter.
	if ( 'most_viewed' === $featured_entries_type ) {
		return false;
	}

	return apply_filters( 'bimber_customizer_home_featured_entries_tag_is_active', true );
}

// Featured Entries Template.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_template]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$bimber_uri = BIMBER_ADMIN_DIR_URI . 'images/templates/featured-entries/';
$the_choices = array(
	'2-2-boxed' => array(
		'label' => esc_html__( '2-2 boxed', 'bimber' ),
		'path'  => $bimber_uri . '2-2-boxed.png',
	),
	'2-2-stretched' => array(
		'label' => esc_html__( '2-2 stretched', 'bimber' ),
		'path'  => $bimber_uri . '2-2-stretched.png',
	),
	'3-3-3-boxed' => array(
		'label' => esc_html__( '3-3-3 boxed', 'bimber' ),
		'path'  => $bimber_uri . '3-3-3-boxed.png',
	),
	'3-3-3-stretched' => array(
		'label' => esc_html__( '3-3-3 stretched', 'bimber' ),
		'path'  => $bimber_uri . '3-3-3-stretched.png',
	),
	'2-4-4-boxed' => array(
		'label' => esc_html__( '2-4-4 boxed', 'bimber' ),
		'path'  => $bimber_uri . '2-4-4-boxed.png',
	),
	'2-4-4-stretched' => array(
		'label' => esc_html__( '2-4-4 stretched', 'bimber' ),
		'path'  => $bimber_uri . '2-4-4-stretched.png',
	),
	'2of3-3v-3v-boxed' => array(
		'label' => esc_html__( '2of-3v-3v-boxed', 'bimber' ),
		'path'  => $bimber_uri . '2of3-3v-3v-boxed.png',
	),
	'2of3-3v-3v-stretched' => array(
		'label' => esc_html__( '2of-3v-3v-stretched', 'bimber' ),
		'path'  => $bimber_uri . '2of3-3v-3v-stretched.png',
	),
	'4-4-4-4-boxed' => array(
		'label' => esc_html__( '4-4-4-4 boxed', 'bimber' ),
		'path'  => $bimber_uri . '4-4-4-4-boxed.png',
	),
	'4-4-4-4-stretched' => array(
		'label' => esc_html__( '4-4-4-4 stretched', 'bimber' ),
		'path'  => $bimber_uri . '4-4-4-4-stretched.png',
	),
	'3-3v-3v-3v-3v-boxed' => array(
		'label' => esc_html__( '3-3v-3v-3v-3v boxed', 'bimber' ),
		'path'  => $bimber_uri . '3-3v-3v-3v-3v-boxed.png',
	),
	'3-3v-3v-3v-3v-stretched' => array(
		'label' => esc_html__( '3-3v-3v-3v-3v stretched', 'bimber' ),
		'path'  => $bimber_uri . '3-3v-3v-3v-3v-stretched.png',
	),
	'1-sidebar' => array(
		'label' => esc_html__( '1 sidebar', 'bimber' ),
		'path'  => $bimber_uri . '1-sidebar.png',
	),
	'1-sidebar-bunchy' => array(
		'label' => esc_html__( '1 sidebar', 'bimber' ),
		'path'  => $bimber_uri . '1-sidebar-bunchy.png',
	),
);
if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	$the_choices['module-01'] = array(
		'label' => esc_html__( 'module-01', 'bimber' ),
		'path'  => $bimber_uri . '1-sidebar-bunchy.png',
	);
	$the_choices['todo-music'] = array(
		'label' => esc_html__( 'TODO Music', 'bimber' ),
		'path'  => $bimber_uri . '3-3-3-boxed.png',
	);
}
$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_home_featured_entries_template', array(
	'label'    => esc_html__( 'Template', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries_template]',
	'type'     => 'select',
	'columns'  => 2,
	'choices'  => $the_choices,
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) ) );

// Featured entries gutter.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_gutter]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_gutter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_featured_entries_gutter', array(
	'label'    => esc_html__( 'Gutter', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries_gutter]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) );

// Category.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_category]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_category'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_featured_entries_category', array(
	'label'           => esc_html__( 'Categories', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_category]',
	'choices'         => bimber_customizer_get_category_choices(),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) ) );


// Tag.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_tag]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_tag'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );

$wp_customize->add_control( new Bimber_Customize_Tag_Select_Control( $wp_customize, 'bimber_home_featured_entries_tag', array(
	'label'           => esc_html__( 'Tags', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_tag]',
	'choices'         => bimber_customizer_get_tag_choices(),
	'active_callback' => 'bimber_customizer_home_featured_entries_tag_is_active',
) ) );


// Featured Entries Time range.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_time_range]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_time_range'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_featured_entries_time_range', array(
	'label'           => esc_html__( 'Time range', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_time_range]',
	'type'            => 'select',
	'choices'         => array(
		'day'   => esc_html__( 'last 24 hours', 'bimber' ),
		'week'  => esc_html__( 'last 7 days', 'bimber' ),
		'month' => esc_html__( 'last 30 days', 'bimber' ),
		'all'   => esc_html__( 'all time', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) );


// Featured Entries Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_featured_entries_hide_elements', array(
	'label'           => esc_html__( 'Hide Elements', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_hide_elements]',
	'choices'         => array(
		'categories'    => esc_html__( 'Categories', 'bimber' ),
		'shares'        => esc_html__( 'Shares', 'bimber' ),
		'views'         => esc_html__( 'Views', 'bimber' ),
		'comments_link' => esc_html__( 'Comments Link', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) ) );





// Title.
$wp_customize->add_setting( $bimber_option_name . '[home_title]', array(
	'default'           => $bimber_customizer_defaults['home_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_title', array(
	'label'           => esc_html__( 'Title', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_title]',
	'type'            => 'text',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'Leave empty to use default', 'bimber' ),
	),
) );

// Hide title.
$wp_customize->add_setting( $bimber_option_name . '[home_title_hide]', array(
	'default'           => $bimber_customizer_defaults['home_title_hide'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_title_hide', array(
	'label'    => esc_html__( 'Hide title', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_title_hide]',
	'type'     => 'checkbox',
) );

// Template.
$wp_customize->add_setting( $bimber_option_name . '[home_template]', array(
	'default'           => $bimber_customizer_defaults['home_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );


$bimber_uri = BIMBER_ADMIN_DIR_URI . 'images/templates/archive/';
$the_choices = array(
	'grid-sidebar' => array(
		'label' => esc_html__( 'Grid with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'grid-sidebar.png',
	),
	'grid' => array(
		'label' => esc_html__( 'Grid', 'bimber' ),
		'path'  => $bimber_uri . 'grid.png',
	),
	'list-sidebar' => array(
		'label' => esc_html__( 'List with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'list-sidebar.png',
	),
	'classic-sidebar' => array(
		'label' => esc_html__( 'Classic with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'classic-sidebar.png',
	),
	'stream-sidebar' => array(
		'label' => esc_html__( 'Stream with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'stream-sidebar.png',
	),
	'stream-sidebars' => array(
		'label' => esc_html__( 'Stream with Sidebars', 'bimber' ),
		'path'  => $bimber_uri . 'stream-sidebar.png',
	),
	'stream' => array(
		'label' => esc_html__( 'Stream', 'bimber' ),
		'path'  => $bimber_uri . 'stream.png',
	),
	'masonry-stretched' => array(
		'label' => esc_html__( 'Masonry', 'bimber' ),
		'path'  => $bimber_uri . 'masonry-stretched.png',
	),
	'bunchy' => array(
		'label' => esc_html__( 'Bunchy', 'bimber' ),
		'path'  => $bimber_uri . 'bunchy.png',
	),
);
if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	$the_choices['carmania'] = array(
		'label' => esc_html__( 'Carmania', 'bimber' ),
		'path'  => $bimber_uri . 'bunchy.png',
	);
}
$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_home_template', array(
	'label'           => esc_html__( 'Template', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_template]',
	'type'            => 'select',
	'choices'         => $the_choices,
	'columns'         => 2,
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) ) );
$the_choices = array(
	'grid-sidebar' => array(
		'label' => esc_html__( 'Grid with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'grid-sidebar.png',
	),
	'grid' => array(
		'label' => esc_html__( 'Grid', 'bimber' ),
		'path'  => $bimber_uri . 'grid.png',
	),
	'list-sidebar' => array(
		'label' => esc_html__( 'List with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'list-sidebar.png',
	),
	'classic-sidebar' => array(
		'label' => esc_html__( 'Classic with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'classic-sidebar.png',
	),
	'stream-sidebar' => array(
		'label' => esc_html__( 'Stream with Sidebar', 'bimber' ),
		'path'  => $bimber_uri . 'stream-sidebar.png',
	),
	'stream-sidebars' => array(
		'label' => esc_html__( 'Stream with Sidebars', 'bimber' ),
		'path'  => $bimber_uri . 'stream-sidebar.png',
	),
	'stream' => array(
		'label' => esc_html__( 'Stream', 'bimber' ),
		'path'  => $bimber_uri . 'stream.png',
	),
	'masonry-stretched' => array(
		'label' => esc_html__( 'Masonry', 'bimber' ),
		'path'  => $bimber_uri . 'masonry-stretched.png',
	),
	'bunchy' => array(
		'label' => esc_html__( 'Bunchy', 'bimber' ),
		'path'  => $bimber_uri . 'bunchy.png',
	),
);
if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	$the_choices['carmania'] = array(
		'label' => esc_html__( 'Carmania', 'bimber' ),
		'path'  => $bimber_uri . 'bunchy.png',
	);
}
$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_home_template', array(
	'label'           => esc_html__( 'Template', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_template]',
	'type'            => 'select',
	'choices'         => $the_choices,
	'columns'         => 2,
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) ) );

// Home inject embeds.
$wp_customize->add_setting( $bimber_option_name . '[home_inject_embeds]', array(
	'default'           => $bimber_customizer_defaults['home_inject_embeds'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_inject_embeds', array(
	'label'    => esc_html__( 'Inject embeds into featured media', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_inject_embeds]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
) );


// Posts Per Page.
$wp_customize->add_setting( 'posts_per_page', array(
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_posts_per_page', array(
	'label'    => esc_html__( 'Entries per page', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => 'posts_per_page',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );


// Pagination.
$wp_customize->add_setting( $bimber_option_name . '[home_pagination]', array(
	'default'           => $bimber_customizer_defaults['home_pagination'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_pagination', array(
	'label'    => esc_html__( 'Pagination', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_pagination]',
	'type'     => 'select',
	'choices'  => array(
		'load-more'                 => esc_html__( 'Load More', 'bimber' ),
		'infinite-scroll'           => esc_html__( 'Infinite Scroll', 'bimber' ),
		'infinite-scroll-on-demand' => esc_html__( 'Infinite Scroll (first load via click)', 'bimber' ),
		'pages'                     => esc_html__( 'Prev/Next Pages', 'bimber' ),
	),
) );


// Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[home_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['home_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_hide_elements]',
	'choices'  => array(
		'featured_media' => esc_html__( 'Featured Media', 'bimber' ),
		'categories'     => esc_html__( 'Categories', 'bimber' ),
		'summary'        => esc_html__( 'Summary', 'bimber' ),
		'author'         => esc_html__( 'Author', 'bimber' ),
		'avatar'         => esc_html__( 'Avatar', 'bimber' ),
		'date'           => esc_html__( 'Date', 'bimber' ),
		'shares'         => esc_html__( 'Shares', 'bimber' ),
		'views'          => esc_html__( 'Views', 'bimber' ),
		'comments_link'  => esc_html__( 'Comments Link', 'bimber' ),
	),
) ) );

// Category.
$wp_customize->add_setting( $bimber_option_name . '[home_main_collection_excluded_categories]', array(
	'default'           => $bimber_customizer_defaults['home_main_collection_excluded_categories'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_main_collection_excluded_categories', array(
	'label'           => esc_html__( 'Exclude categories', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_main_collection_excluded_categories]',
	'choices'         => bimber_customizer_get_category_choices(),
) ) );

// Newsletter.
$wp_customize->add_setting( $bimber_option_name . '[home_newsletter]', array(
	'default'           => $bimber_customizer_defaults['home_newsletter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_newsletter', array(
	'label'           => esc_html__( 'Newsletter', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_newsletter]',
	'type'            => 'select',
	'choices'         => array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_newsletter_after_post]', array(
	'default'           => $bimber_customizer_defaults['home_newsletter_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_newsletter_after_post', array(
	'label'           => esc_html__( 'Inject newsletter at position', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_newsletter_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 2', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_newsletter_checked',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_newsletter_repeat]', array(
	'default'           => $bimber_customizer_defaults['home_newsletter_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_newsletter_repeat', array(
	'label'           => esc_html__( 'Repeat newsletter after each X positions', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_newsletter_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'min'         => 0,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_newsletter_checked',
) );

/**
 * Check whether newsletter is enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_newsletter_checked( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	return $control->manager->get_setting( bimber_get_theme_id() . '[home_newsletter]' )->value() === 'standard';
}


// Ad.
$wp_customize->add_setting( $bimber_option_name . '[home_ad]', array(
	'default'           => $bimber_customizer_defaults['home_ad'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_ad', array(
	'label'           => esc_html__( 'Ad', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_ad]',
	'type'            => 'select',
	'choices'         => array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_ad_after_post]', array(
	'default'           => $bimber_customizer_defaults['home_ad_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_ad_after_post', array(
	'label'           => esc_html__( 'Inject ad at position', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_ad_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 4', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_ad_checked',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_ad_repeat]', array(
	'default'           => $bimber_customizer_defaults['home_ad_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_ad_repeat', array(
	'label'           => esc_html__( 'Repeat ad after each X positions', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_ad_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'min'         => 0,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_ad_checked',
) );

/**
 * Check whether ad is enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_ad_checked( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	return $control->manager->get_setting( bimber_get_theme_id() . '[home_ad]' )->value() === 'standard';
}

// Product.
$wp_customize->add_setting( $bimber_option_name . '[home_product]', array(
	'default'           => $bimber_customizer_defaults['home_product'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_product', array(
	'label'           => esc_html__( 'Product', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product]',
	'type'            => 'select',
	'choices'         => array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) );

// Product at position.
$wp_customize->add_setting( $bimber_option_name . '[home_product_after_post]', array(
	'default'           => $bimber_customizer_defaults['home_product_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_product_after_post', array(
	'label'           => esc_html__( 'Inject product at position', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 6', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_product_checked',
) );

// Product repeat.
$wp_customize->add_setting( $bimber_option_name . '[home_product_repeat]', array(
	'default'           => $bimber_customizer_defaults['home_product_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_home_product_repeat', array(
	'label'           => esc_html__( 'Repeat product after each X positions', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'min'         => 0,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_product_checked',
) );

// Product category.
$wp_customize->add_setting( $bimber_option_name . '[home_product_category]', array(
	'default'           => $bimber_customizer_defaults['home_product_category'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Select_Control( $wp_customize, 'bimber_home_product_category', array(
	'label'           => esc_html__( 'Inject products from category', 'bimber' ),
	'description'     => esc_html__( 'you can choose many', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product_category]',
	'choices'         => bimber_customizer_get_product_category_choices(),
	'active_callback' => 'bimber_customizer_is_home_product_checked',
) ) );

/**
 * Check whether product is enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_product_checked( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	return $control->manager->get_setting( bimber_get_theme_id() . '[home_product]' )->value() === 'standard';
}

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {

	if ( bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
		// Show promoted product above collection.
		$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_product_above_collection]', array(
			'default'           => $bimber_customizer_defaults['woocommerce_promoted_product_above_collection'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'bimber_woocommerce_promoted_product_above_collection', array(
			'label'    => esc_html__( 'Show Featured Single Product', 'bimber' ),
			'section'  => 'bimber_home_before_main_collection_section',
			'settings' => $bimber_option_name . '[woocommerce_promoted_product_above_collection]',
			'type'     => 'checkbox',
		) );

		// Show promoted products above collection.
		$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_above_collection]', array(
			'default'           => $bimber_customizer_defaults['woocommerce_promoted_products_above_collection'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'bimber_woocommerce_promoted_products_above_collection', array(
			'label'    => esc_html__( 'Show Featured Products', 'bimber' ),
			'section'  => 'bimber_home_before_main_collection_section',
			'settings' => $bimber_option_name . '[woocommerce_promoted_products_above_collection]',
			'type'     => 'checkbox',
		) );
	}

	if ( bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) ) {
		// Show instagram_above_collection.
		$wp_customize->add_setting( $bimber_option_name . '[instagram_above_collection]', array(
			'default'           => $bimber_customizer_defaults['instagram_above_collection'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'bimber_instagram_above_collection', array(
			'label'    => esc_html__( 'Show Instagram', 'bimber' ),
			'section'  => 'bimber_home_before_main_collection_section',
			'settings' => $bimber_option_name . '[instagram_above_collection]',
			'type'     => 'checkbox',
		) );
	}

	if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ) {
		// Show patreon_above_collection.
		$wp_customize->add_setting( $bimber_option_name . '[patreon_above_collection]', array(
			'default'           => $bimber_customizer_defaults['patreon_above_collection'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'bimber_patreon_above_collection', array(
			'label'    => esc_html__( 'Show Patreon', 'bimber' ),
			'section'  => 'bimber_home_before_main_collection_section',
			'settings' => $bimber_option_name . '[patreon_above_collection]',
			'type'     => 'checkbox',
		) );
	}


}
