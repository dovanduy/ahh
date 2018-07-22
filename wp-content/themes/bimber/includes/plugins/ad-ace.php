<?php
/**
 * WP QUADS plugin functions
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

add_action( 'after_setup_theme', 				'bimber_adace_register_ad_ids' );
add_action( 'bimber_before_single_content', 	'bimber_adace_sponsor_before_content' );

add_action( 'admin_head',           			'bimber_adace_hide_places' );
add_action( 'widgets_init', 'bimber_adace_deregister_places_widget', 11,0 );
add_filter( 'bimber_has_coupon', 'bimber_adace_has_coupon' );

add_action( 'pre_get_posts', 'bimber_adace_remove_sponsor_filters' );
/**
 * Remove after content sponsor filter, we handle this in the theme.
 *
 * @return void
 */
function bimber_adace_remove_sponsor_filters() {
	remove_filter( 'the_content', 					'adace_sponsor_before_post_inject' );
}


/**
 * Hide Places menu
 */
function bimber_adace_hide_places() {
	remove_menu_page( 'edit.php?post_type=adace_place' );
}

/**
 * Register custom ad ids
 */
function bimber_adace_register_ad_ids() {

	adace_register_ad_section( 'bimber', __( 'Bimber Custom Slots', 'bimber' ) );

	adace_register_ad_slot(
		array(
			'id'   => 'bimber_before_header_theme_area',
			'name' => esc_html__( 'Before header theme area', 'bimber' ),
			'section' => 'bimber',
		)
	);

	adace_register_ad_slot(
		array(
			'id'   => 'bimber_inside_header',
			'name' => esc_html__( 'Inside header', 'bimber' ),
			'section' => 'bimber',
		)
	);

	adace_register_ad_slot(
		array(
			'id'   => 'bimber_before_content_theme_area',
			'name' => esc_html__( 'Before content theme area', 'bimber' ),
			'section' => 'bimber',
		)
	);

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_after_featured_content',
		'name' => esc_html__( 'After featured entries', 'bimber' ),
		'section' => 'bimber',
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_before_related_entries',
		'name' => esc_html__( 'Before "You May Also Like" section', 'bimber' ),
		'section' => 'bimber',
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_before_more_from',
		'name' => esc_html__( 'Before "More From" section', 'bimber' ),
		'section' => 'bimber',
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_before_comments',
		'name' => esc_html__( 'Before “Comments” section', 'bimber' ),
		'section' => 'bimber',
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_before_dont_miss',
		'name' => esc_html__( 'Before "Don\'t Miss" section', 'bimber' ),
		'section' => 'bimber',
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_inside_grid',
		'name' => esc_html__( 'Inside grid collection', 'bimber' ),
		'section' => 'bimber',
		'is_repeater' => true,
		'options' => array(
			'is_singular_editable'       => false,
		),
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_inside_list',
		'name' => esc_html__( 'Inside list collection', 'bimber' ),
		'section' => 'bimber',
		'is_repeater' => true,
		'options' => array(
			'is_singular_editable'       => false,
		),
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_inside_classic',
		'name' => esc_html__( 'Inside classic collection', 'bimber' ),
		'section' => 'bimber',
		'is_repeater' => true,
		'options' => array(
			'is_singular_editable'       => false,
		),
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_inside_stream',
		'name' => esc_html__( 'Inside stream collection', 'bimber' ),
		'section' => 'bimber',
		'is_repeater' => true,
		'options' => array(
			'is_singular_editable'       => false,
		),
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_left_stream',
		'name' => esc_html__( 'On the left side of stream collection', 'bimber' ),
		'section' => 'bimber',
	) );

	adace_register_ad_slot(
		array(
		'id'    => 'bimber_right_stream',
		'name' => esc_html__( 'On the right side of stream collection', 'bimber' ),
		'section' => 'bimber',
	) );

}

/**
 * Inject sponsor before content
 */
function bimber_adace_sponsor_before_content() {
	$template = get_option( 'adace_sponsor_before_post' );
	$content = '';
	if ( 'compact' === $template ) {
		$content = adace_get_sponsor_box_compact();
	}
	if ( 'full' === $template ) {
		$content = adace_get_sponsor_box_full();
	}
	echo $content;
}


/**
 * Ads widget register function
 */
function bimber_adace_deregister_places_widget() {
	unregister_widget( 'Adace_Places_Widget' );
}

/**
 * Check if post has coupons
 *
 * @param bool        $bool Current filter output.
 * @param int|WP_Post $post Optional. Post ID or WP_Post object.
 *
 * @return bool
 */
function bimber_adace_has_coupon( $bool, $post = null ) {
	$post = get_post( $post );

	if ( false !== strpos( $post->post_content, 'adace_coupons' ) ) {
		$bool = true;
	}

	return $bool;
}
