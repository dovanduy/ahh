<?php
/**
 * Bimber Collection VC Element
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

vc_map( array(
	'name' 				=> __( 'Bimber Collection', 'bimber' ),
	'base'	 			=> 'bimber_collection',
	'category' 			=> __( 'Content', 'js_composer' ),
	'params' 	=> apply_filters( 'bimber_vc_collection_params', array(

		/**
		 * GENERAL
		 */

		// Template.
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Template', 'bimber' ),
			'param_name' 	=> 'template',
			'value' 		=> array(
				__( 'Grid 1 of 3', 'bimber' ) => 'grid-standard',
				__( 'Grid 1 of 2', 'bimber' ) => 'grid-l',
				__( 'List', 'bimber' ) => 'list-standard',
			),
			'std' 			=> 'grid-standard',
			'description' 	=> __( 'Select display style for items.', 'bimber' ),
		),
		// Columns.
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Columns', 'bimber' ),
			'param_name' 	=> 'columns',
			'value' 		=> array(
				__( '1', 'bimber' ) => 1,
				__( '2', 'bimber' ) => 2,
				__( '3', 'bimber' ) => 3,
			),
			'std' => 3,
			'description' 	=> __( 'Number of columns to use for grid template.', 'bimber' ),
		),

		/**
		 * TITLE
		 */

		// Title.
		array(
			'group' 		=> __( 'Title', 'bimber' ),
			'type' 			=> 'textfield',
			'holder' 		=> 'div',
			'class' 		=> '',
			'heading' 		=> __( 'Title', 'bimber' ),
			'param_name'	=> 'title',
			'value' 		=> '',
		),
		array(
			'group' 		=> __( 'Title', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Size', 'bimber' ),
			'param_name'	=> 'title_size',
			'value' 		=> array(
				__( 'Heading 1', 'bimber' ) => 'h1',
				__( 'Heading 2', 'bimber' ) => 'h2',
				__( 'Heading 3', 'bimber' ) => 'h3',
				__( 'Heading 4', 'bimber' ) => 'h4',
				__( 'Heading 5', 'bimber' ) => 'h5',
				__( 'Heading 6', 'bimber' ) => 'h6',
				__( 'Giga', 'bimber' ) 		=> 'giga',
				__( 'Mega', 'bimber' ) 		=> 'mega',
			),
			'std' 		=> 'h4',
		),
		array(
			'group' 		=> __( 'Title', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Align', 'bimber' ),
			'param_name'	=> 'title_align',
			'value' 		=> array(
				__( 'Default', 'bimber' ) => '',
				__( 'Center', 'bimber' ) => 'center',
			),
			'std' 		=> '',
		),

		/**
		 * DATA
		 */

		// Type.
		array(
			'group' 		=> __( 'Data', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Type', 'bimber' ),
			'param_name' 	=> 'type',
			'value' 		=> array(
				__( 'Recent', 'bimber' ) 		=> 'recent',
				__( 'Most shared', 'bimber' ) 	=> 'most_shared',
				__( 'Most viewed', 'bimber' ) 	=> 'most_viewed',
			),
			'std' 			=> 'recent',
		),
		// Time range.
		array(
			'group' 		=> __( 'Data', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Time range', 'bimber' ),
			'param_name' 	=> 'time_range',
			'value' 		=> array(
				__( 'All time', 'bimber' )		=> 'all',
				__( 'Last 30 days', 'bimber' ) 	=> 'month',
				__( 'Last 7 days', 'bimber' ) 	=> 'week',
				__( 'Last 24 hours', 'bimber' ) => 'day',
			),
			'std' 			=> 'all',
			'description' 	=> __( 'Narrow posts to a specific period of time.', 'bimber' ),
		),

		// Total items.
		array(
			'group' 		=> __( 'Data', 'bimber' ),
			'type' 			=> 'textfield',
			'holder' 		=> 'div',
			'class' 		=> '',
			'heading' 		=> __( 'Total items', 'bimber' ),
			'param_name'	=> 'max',
			'value' 		=> 6,
			'description' 	=> __( 'Set max limit for items  or enter - 1 to display all.', 'bimber' ),
		),

		// Offset.
		array(
			'group' 		=> __( 'Data', 'bimber' ),
			'type' 			=> 'textfield',
			'holder' 		=> 'div',
			'class' 		=> '',
			'heading' 		=> __( 'Offset', 'bimber' ),
			'param_name'	=> 'offset',
			'value' 		=> '',
			'description' 	=> __( 'Number of posts to displace or pass over.', 'bimber' ),
		),

		// Category.
		array(
			'group' 		=> __( 'Data', 'bimber' ),
			'type' 			=> 'autocomplete',
			'heading' 		=> __( 'Filter by category', 'bimber' ),
			'param_name' 	=> 'category',
			'settings' => array(
				'multiple' => true,
				'min_length' => 1,
				'groups' => false,
				// In UI show results grouped by groups, default false
				'unique_values' => true,
				// In UI show results except selected. NB! You should manually check values in backend, default false
				'display_inline' => true,
				// In UI show results inline view, default false (each value in own line)
				'delay' => 500,
				// delay for search. default 500
				'auto_focus' => true,
				// auto focus input, default true
			),
		),
		// Tag.
		array(
			'group' 		=> __( 'Data', 'bimber' ),
			'type' 			=> 'autocomplete',
			'heading' 		=> __( 'Filter by tag', 'bimber' ),
			'param_name' 	=> 'post_tag',
			'settings' => array(
				'multiple' => true,
				'min_length' => 1,
				'groups' => false,
				// In UI show results grouped by groups, default false
				'unique_values' => true,
				// In UI show results except selected. NB! You should manually check values in backend, default false
				'display_inline' => true,
				// In UI show results inline view, default false (each value in own line)
				'delay' => 500,
				// delay for search. default 500
				'auto_focus' => true,
				// auto focus input, default true
			),
		),
		// Post Format.
		array(
			'group' 		=> __( 'Data', 'bimber' ),
			'type' 			=> 'multi_checkbox',
			'heading' 		=> __( 'Filter by post format', 'bimber' ),
			'param_name' 	=> 'post_format',
			'value' 		=> bimber_vc_get_post_formats( 'bimber_collection' ),
		),

		/**
		 * ITEM DESIGN
		 */

		// Featured Media.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Featured media', 'bimber' ),
			'param_name' 	=> 'show_featured_media',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Categories.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Categories', 'bimber' ),
			'param_name' 	=> 'show_categories',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Summary.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Summary', 'bimber' ),
			'param_name' 	=> 'show_summary',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Author.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Author', 'bimber' ),
			'param_name' 	=> 'show_author',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Avatar.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Avatar', 'bimber' ),
			'param_name' 	=> 'show_avatar',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Date.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Date', 'bimber' ),
			'param_name' 	=> 'show_date',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Shares.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Shares', 'bimber' ),
			'param_name' 	=> 'show_shares',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Views.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Views', 'bimber' ),
			'param_name' 	=> 'show_views',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
		// Comments Link.
		array(
			'group' 		=> __( 'Item Design', 'bimber' ),
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Comments link', 'bimber' ),
			'param_name' 	=> 'show_comments_link',
			'value' 		=> array(
				__( 'Show', 'bimber' ) => 'standard',
				__( 'Hide', 'bimber' ) => 'none',
			),
			'std' 			=> 'standard',
		),
	) ),
) );
