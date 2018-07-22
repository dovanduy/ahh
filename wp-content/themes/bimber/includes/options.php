<?php
/**
 * Options
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

/**
 * Return featured entries possible types for archive pages
 *
 * @return array
 */
function bimber_get_archive_featured_entries_types() {
	return array(
		'most_shared' => esc_html__( 'most shared', 'bimber' ),
		'most_viewed' => esc_html__( 'most viewed', 'bimber' ),
		'recent'      => esc_html__( 'recent', 'bimber' ),
		'none'        => esc_html__( 'none', 'bimber' ),
	);
}

/**
 * Return featured entries possible templates for archive pages
 *
 * @return array
 */
function bimber_get_archive_featured_entries_templates() {
	$uri = BIMBER_ADMIN_DIR_URI . 'images/templates/featured-entries/';
	$choices = array(
		'2-2-boxed' => array(
			'label' => esc_html__( '2-2 boxed', 'bimber' ),
			'path'  => $uri . '2-2-boxed.png',
		),
		'2-2-stretched' => array(
			'label' => esc_html__( '2-2 stretched', 'bimber' ),
			'path'  => $uri . '2-2-stretched.png',
		),
		'3-3-3-boxed' => array(
			'label' => esc_html__( '3-3-3 boxed', 'bimber' ),
			'path'  => $uri . '3-3-3-boxed.png',
		),
		'3-3-3-stretched' => array(
			'label' => esc_html__( '3-3-3 stretched', 'bimber' ),
			'path'  => $uri . '3-3-3-stretched.png',
		),
		'2-4-4-boxed' => array(
			'label' => esc_html__( '2-4-4 boxed', 'bimber' ),
			'path'  => $uri . '2-4-4-boxed.png',
		),
		'2-4-4-stretched' => array(
			'label' => esc_html__( '2-4-4 stretched', 'bimber' ),
			'path'  => $uri . '2-4-4-stretched.png',
		),
		'2of3-3v-3v-boxed' => array(
			'label' => esc_html__( '2of-3v-3v-boxed', 'bimber' ),
			'path'  => $uri . '2of3-3v-3v-boxed.png',
		),
		'2of3-3v-3v-stretched' => array(
			'label' => esc_html__( '2of-3v-3v-stretched', 'bimber' ),
			'path'  => $uri . '2of3-3v-3v-stretched.png',
		),
		'4-4-4-4-boxed' => array(
			'label' => esc_html__( '4-4-4-4 boxed', 'bimber' ),
			'path'  => $uri . '4-4-4-4-boxed.png',
		),
		'4-4-4-4-stretched' => array(
			'label' => esc_html__( '4-4-4-4 stretched', 'bimber' ),
			'path'  => $uri . '4-4-4-4-stretched.png',
		),
		'3-3v-3v-3v-3v-boxed' => array(
			'label' => esc_html__( '3-3v-3v-3v-3v boxed', 'bimber' ),
			'path'  => $uri . '3-3v-3v-3v-3v-boxed.png',
		),
		'3-3v-3v-3v-3v-stretched' => array(
			'label' => esc_html__( '3-3v-3v-3v-3v stretched', 'bimber' ),
			'path'  => $uri . '3-3v-3v-3v-3v-stretched.png',
		),
		'1-sidebar' => array(
			'label' => esc_html__( '1 sidebar', 'bimber' ),
			'path'  => $uri . '1-sidebar.png',
		),
		'1-sidebar-bunchy' => array(
			'label' => esc_html__( '1 sidebar', 'bimber' ),
			'path'  => $uri . '1-sidebar-bunchy.png',
		),
	);
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$choices['module-01'] = array(
			'label' => esc_html__( 'module-01', 'bimber' ),
			'path'  => $uri . '1-sidebar-bunchy.png',
		);
		$choices['todo-music'] = array(
			'label' => esc_html__( 'TODO Music', 'bimber' ),
			'path'  => $uri . '3-3-3-boxed.png',
		);
	}
	return $choices;
}

/**
 * Return featured entries possible time ranges for archive pages
 *
 * @return array
 */
function bimber_get_archive_featured_entries_time_ranges() {
	return array(
		'all'   => esc_html__( 'all time', 'bimber' ),
		'month' => esc_html__( 'last 30 days', 'bimber' ),
		'week'  => esc_html__( 'last 7 days', 'bimber' ),
		'day'   => esc_html__( 'last 24 hours', 'bimber' ),
	);
}

/**
 * Return possible templates for archive pages
 *
 * @return array
 */
function bimber_get_archive_templates() {
	$uri = BIMBER_ADMIN_DIR_URI . 'images/templates/archive/';
	$choices = array(
		'grid-sidebar' => array(
			'label' => esc_html__( 'Grid with Sidebar', 'bimber' ),
			'path'  => $uri . 'grid-sidebar.png',
		),
		'grid' => array(
			'label' => esc_html__( 'Grid', 'bimber' ),
			'path'  => $uri . 'grid.png',
		),
		'list-sidebar' => array(
			'label' => esc_html__( 'List with Sidebar', 'bimber' ),
			'path'  => $uri . 'list-sidebar.png',
		),
		'classic-sidebar' => array(
			'label' => esc_html__( 'Classic with Sidebar', 'bimber' ),
			'path'  => $uri . 'classic-sidebar.png',
		),
		'stream-sidebar' => array(
			'label' => esc_html__( 'Stream with Sidebar', 'bimber' ),
			'path'  => $uri . 'stream-sidebar.png',
		),
		'stream-sidebars' => array(
			'label' => esc_html__( 'Stream with Sidebars', 'bimber' ),
			'path'  => $uri . 'stream-sidebar.png',
		),
		'stream' => array(
			'label' => esc_html__( 'Stream', 'bimber' ),
			'path'  => $uri . 'stream.png',
		),
		'masonry-stretched' => array(
			'label' => esc_html__( 'Masonry, full width', 'bimber' ),
			'path'  => $uri . 'masonry-stretched.png',
		),
		'bunchy' => array(
			'label' => esc_html__( 'Bunchy', 'bimber' ),
			'path'  => $uri . 'bunchy.png',
		),
	);
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$choices['carmania'] = array(
			'label' => esc_html__( 'Carmania', 'bimber' ),
			'path'  => $uri . 'bunchy.png',
		);
	}
	return $choices;
}

/**
 * Return possible header compositions for archive pages
 *
 * @return array
 */
function bimber_get_archive_header_compositions() {
	return array(
		'01'      => esc_html__( '01', 'bimber' ),
		'02'      => esc_html__( '02', 'bimber' ),
		'03'      => esc_html__( '03', 'bimber' ),
	);
}

/**
 * Return possible pagination types for archive pages
 *
 * @return array
 */
function bimber_get_archive_pagination_types() {
	return array(
		'load-more'                 => esc_html__( 'Load More', 'bimber' ),
		'infinite-scroll'           => esc_html__( 'Infinite Scroll', 'bimber' ),
		'infinite-scroll-on-demand' => esc_html__( 'Infinite Scroll (first load via click)', 'bimber' ),
		'pages'                     => esc_html__( 'Prev/Next Pages', 'bimber' ),
	);
}

/**
 * Return possible to hide elements for archive pages
 *
 * @return array
 */
function bimber_get_archive_elements_to_hide() {
	return array(
		'featured_media' => esc_html__( 'Featured Media', 'bimber' ),
		'categories'     => esc_html__( 'Categories', 'bimber' ),
		'title'          => esc_html__( 'Title', 'bimber' ),
		'summary'        => esc_html__( 'Summary', 'bimber' ),
		'author'         => esc_html__( 'Author', 'bimber' ),
		'avatar'         => esc_html__( 'Avatar', 'bimber' ),
		'date'           => esc_html__( 'Date', 'bimber' ),
		'shares'         => esc_html__( 'Shares', 'bimber' ),
		'views'          => esc_html__( 'Views', 'bimber' ),
		'comments_link'  => esc_html__( 'Comments Link', 'bimber' ),
	);
}

/**
 * Return possible to hide elements for archive pages
 *
 * @return array
 */
function bimber_get_archive_header_elements_to_hide() {
	return array(
		'taxonomy image' => esc_html__( 'Archive Image', 'bimber' ),
		'breadcrumbs'    => esc_html__( 'Breadcrumbs', 'bimber' ),
		'title'          => esc_html__( 'Title', 'bimber' ),
		'description'    => esc_html__( 'Description', 'bimber' ),
		'filters'        => esc_html__( 'Archive Filters', 'bimber' ),
	);
}

/**
 * Return possible to hide elements for search pages
 *
 * @return array
 */
function bimber_get_search_elements_to_hide() {
	return array(
		'featured_media' => esc_html__( 'Featured Media', 'bimber' ),
		'categories'     => esc_html__( 'Categories', 'bimber' ),
		'summary'        => esc_html__( 'Summary', 'bimber' ),
		'author'         => esc_html__( 'Author', 'bimber' ),
		'avatar'         => esc_html__( 'Avatar', 'bimber' ),
		'date'           => esc_html__( 'Date', 'bimber' ),
		'shares'         => esc_html__( 'Shares', 'bimber' ),
		'views'          => esc_html__( 'Views', 'bimber' ),
		'comments_link'  => esc_html__( 'Comments Link', 'bimber' ),
	);
}

/**
 * Return possible newsletter options for archive pages
 *
 * @return array
 */
function bimber_get_archive_newsletter_options() {
	return array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	);
}

/**
 * Return possible ad options for archive pages
 *
 * @return array
 */
function bimber_get_archive_ad_options() {
	return array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	);
}

/**
 * Return possible product options for archive pages
 *
 * @return array
 */
function bimber_get_archive_product_options() {
	return array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	);
}

/**
 * Return possible hide title options
 *
 * @return array
 */
function bimber_get_yes_no_options() {
	return array(
		'standard' => esc_html__( 'yes', 'bimber' ),
		'none'     => esc_html__( 'no', 'bimber' ),
	);
}

/**
 * Get archive filters.
 *
 * @return arrray
 */
function bimber_get_archive_filters() {
	$archive_filters = array(
		'newest' 			=> __( 'Latest', 'bimber' ),
		'oldest' 			=> __( 'Oldest', 'bimber' ),
		'most_commented' 	=> __( 'Most Discussed', 'bimber' ),
	);
	return apply_filters( 'bimber_archive_filters', $archive_filters );
}
