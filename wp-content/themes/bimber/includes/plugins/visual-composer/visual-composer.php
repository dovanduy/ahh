<?php
/**
 * Visual Composer plugin functions
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

require_once( BIMBER_PLUGINS_DIR . 'visual-composer/form-fields/multi-checkbox.php' );
require_once( BIMBER_PLUGINS_DIR . 'visual-composer/elements/title.php' );
require_once( BIMBER_PLUGINS_DIR . 'visual-composer/elements/collection.php' );
//require_once( BIMBER_PLUGINS_DIR . 'visual-composer/elements/featured-collection.php' );

add_filter( 'vc_autocomplete_bimber_collection_category_callback', 	'bimber_vc_term_suggestions', 10, 3 );
add_filter( 'vc_autocomplete_bimber_collection_post_tag_callback', 	'bimber_vc_term_suggestions', 10, 3 );
add_filter( 'shortcode_atts_vc_row', 								'bimber_vc_map_row_attributes', 10, 2 );
add_filter( 'bimber_setup_sidebars',								'bimber_vc_setup_sidebars' );
add_action( 'bimber_home_before_main_collection', 					'bimber_vc_render_home_static' );
add_filter( 'bimber_sidebar',										'bimber_vc_home_static_sidebar' );
add_action( 'save_post', 'bimber_vc_yoast_fix', 1,0 );

/**
 * Add custom attribute to the vc_row shortcode
 */
vc_add_param('vc_row', array(
	'group'			=> __( 'Design Options', 'js_composer' ),
	'type' 			=> 'dropdown',
	'heading' 		=> __( 'Color scheme', 'bimber' ),
	'param_name' 	=> 'bimber_color_scheme',
	'value' => array(
		__( 'Default', 'bimber' ) 	=> '',
		__( 'Dark', 'bimber' ) 		=> 'g1-dark',
	)
));

/**
 * Return list of matched terms
 *
 * @param string $search_string				Queried string.
 * @param string $shortcode_name			Source shortcode.
 * @param string $taxonomy					Taxonomy name to filter by.
 *
 * @return array|bool
 */
function bimber_vc_term_suggestions( $search_string, $shortcode_name, $taxonomy ) {
	$data = array();

	$vc_taxonomies = get_terms( $taxonomy, array(
		'hide_empty' => false,
		'search' => $search_string,
	) );

	if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
		foreach ( $vc_taxonomies as $t ) {
			if ( is_object( $t ) ) {
				$data[] = array(
					'label' => $t->name,
					'value' => $t->slug,
				);
			}
		}
	}

	return $data;
}

/**
 * Return WP formats
 *
 * @param string $vc_element		VC element name.
 *
 * @return array
 */
function bimber_vc_get_post_formats( $vc_element ) {
	$formats = array(
		''	=> '',	// First one is a default one.
		__( 'Image', 'bimber' )		=> 'image',
		__( 'Gallery', 'bimber' )	=> 'gallery',
		__( 'Audio', 'bimber' )		=> 'audio',
		__( 'Video', 'bimber' )		=> 'video',
		__( 'Link', 'bimber' )		=> 'link',
		__( 'Quote', 'bimber' )		=> 'quote',
		__( 'Status', 'bimber' )	=> 'status',
		__( 'Aside', 'bimber' )		=> 'aside',
		__( 'Chat', 'bimber' )		=> 'chat',
	);

	return apply_filters( 'bimber_vc_get_post_formats', $formats, $vc_element );
}

/**
 * Handle vc_row custom attributes
 *
 * @param array $atts		Shortcode attributes.
 *
 * @return array
 */
function bimber_vc_map_row_attributes( $atts ) {
	if ( ! empty( $atts['bimber_color_scheme'] ) ) {
		$atts['el_class'] = trim( $atts['el_class'] . ' ' . $atts['bimber_color_scheme'] );
	}

	return $atts;
}

/**
 * Reigster VC specific sidebars
 *
 * @param array $sidebars		Registered sidebars.
 *
 * @return array
 */
function bimber_vc_setup_sidebars( $sidebars ) {
	$sidebars['bimber_vc_home_static'] = array(
		'label'       => esc_html__( 'Visual Composer Home Static', 'bimber' ),
	);

	return $sidebars;
}

/**
 * Render VC static page on the Homepage
 */
function bimber_vc_render_home_static() {
	$vc_page_id = bimber_get_theme_option( 'home', 'vc_page_id' );

	$vc_page_id = apply_filters( 'bimber_home_vc_page_id', $vc_page_id );

	if ( ! $vc_page_id ) {
		return;
	}

	$vc_page_template = get_post_meta( $vc_page_id, '_wp_page_template', true );

	$template_name = ( 'g1-template-page-full.php' === $vc_page_template ) ? 'full' : 'with-sidebar';

	global $post;
	$orig_post = $post;

	$post = get_post( $vc_page_id );
	setup_postdata( $post );

	$quads_priority = function_exists( 'quads_get_load_priority' ) ? quads_get_load_priority() : 20;

	add_filter('the_content', 'bimber_disable_quads_content_ads', $quads_priority - 1 );

	// Load VC page related custom CSS.
	$vc_page_css = get_post_meta( $vc_page_id, '_wpb_shortcodes_custom_css', true );

	if ( ! empty( $vc_page_css ) ) {
		echo '<style type="text/css">';
		echo $vc_page_css;
		echo '</style>';
	}

	get_template_part( 'template-parts/home-static/' . $template_name );

	remove_filter('the_content', 'bimber_disable_quads_content_ads', $quads_priority - 1 );

	$post = $orig_post;
	wp_reset_postdata();
}

/**
 * Set up homepage sidebar
 *
 * @param string $sidebar			Sidebar name.
 *
 * @return string
 */
function bimber_vc_home_static_sidebar( $sidebar ) {
	$vc_page_id = bimber_get_theme_option( 'home', 'vc_page_id' );

	if ( ! $vc_page_id ) {
		return $sidebar;
	}

	if ( is_page( $vc_page_id ) ) {
		$sidebar = 'bimber_vc_home_static';
	}

	return $sidebar;
}

/**
 * Disable WP Quads content ads
 *
 * @param string $content
 *
 * @return string
 */
function bimber_disable_quads_content_ads( $content ) {
	$content .= '<!--OffAds-->';

	return $content;
}

/**
 * Convert theme's template into VC elemenet choices array
 *
 * @return array
 */
function bimber_vc_get_archive_featured_entries_templates() {
	$templates = bimber_get_archive_featured_entries_templates();

	$vc_templates = array();

	foreach ( $templates as $template_id => $template_config ) {
		$vc_templates[ $template_config['label'] ] = $template_id;
	}

	return $vc_templates;
}

/**
 * We need to load frontend functions for post saving when both VC and YOAST are active
 *
 * @return void
 */
function bimber_vc_yoast_fix() {
	if ( bimber_can_use_plugin( 'wordpress-seo/wp-seo.php' ) ) {
		require_once( BIMBER_FRONT_DIR . 'functions.php' );
	}
}
