<?php
/**
 * What's Your Reaction? plugin functions
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

function bimber_wyr_show_reactions_in_header( $show ) {
	$show = 'standard' === bimber_get_theme_option( 'wyr', 'show_reactions_in_header' );

	return $show;
}

function bimber_wyr_show_entry_reactions( $show ) {
	$show = 'standard' === bimber_get_theme_option( 'wyr', 'show_entry_reactions' );

	return $show;
}

function bimber_wyr_show_entry_reactions_single( $show ) {
	$show = 'standard' === bimber_get_theme_option( 'wyr', 'show_entry_reactions_single' );

	return $show;
}

function bimber_wyr_apply_voting_box_order() {
	add_action( 'bimber_after_single_content',      'bimber_wyr_load_post_voting_box', bimber_get_theme_option( 'post', 'reactions_order' ) );
}

function bimber_wyr_load_post_voting_box() {
	if ( apply_filters( 'bimber_wyr_load_post_voting_box', is_single() ) ) {
		wyr_render_voting_box();
	}
}

add_filter( 'bp_nav_menu', 'bimber_wyr_reactions_nav_current', 100, 2 );

/**
 * Fix the navigation current tab style.
 *
 * @return string
 */
function bimber_wyr_reactions_nav_current( $nav_menu, $args  ) {
	$nav_menu = explode( '<li', $nav_menu );
	foreach ( $nav_menu as $index => $item ) {
		if ( 'reactions' === bp_current_component() && strpos( $item, 'reactions-personal-li' ) > -1 ) {
			$nav_menu[ $index ] = str_replace( 'g1-tab-item', 'g1-tab-item g1-tab-item-current', $item );
		}
	}
	$nav_menu = implode( '<li', $nav_menu );
	return $nav_menu;
}
