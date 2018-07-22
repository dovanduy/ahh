<?php
/**
 * Front attach sections functions
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

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	add_action( 'bimber_home_before_main_collection', 'bimber_attach_sections_before_main_collection', 10 );
}
/**
 * Attach boxed newsletter section.
 */
function bimber_attach_sections_before_main_collection() {
	if ( is_paged() && apply_filters( 'bimber_hide_sections_above_collection_on_paged', true ) ) {
		return;
	}

	// Promoted Product.
	bimber_render_promoted_product_section( 'above_collection' );
	// Patreon.
	bimber_render_patreon_section( 'above_collection' );
	// Newsletter.
	bimber_render_newsletter_section( 'above_collection' );
	// Promoted Products.
	bimber_render_promoted_products_section( 'above_collection' );
	// Instagram.
	bimber_render_instagram_section( 'above_collection' );
}

add_action( 'bimber_above_footer', 'bimber_attach_sections_above_footer', 10 );
/**
 * Footer modules.
 */
function bimber_attach_sections_above_footer() {
	do_action( 'bimber_above_footer_sections', 'above_footer' );
}

add_action( 'wp_loaded', 			'bimber_footer_set_elements_order' );

/**
 * Set final elements order on the footer
 */
function bimber_footer_set_elements_order() {
	add_action( 'bimber_above_footer_sections', 'bimber_render_newsletter_section', bimber_get_theme_option( 'footer', 'newsletter_order' ), 1 );
	add_action( 'bimber_above_footer_sections', 'bimber_render_instagram_section', bimber_get_theme_option( 'footer', 'instagram_order' ), 1 );
	add_action( 'bimber_above_footer_sections', 'bimber_render_social_section', bimber_get_theme_option( 'footer', 'social_order' ), 1 );
	add_action( 'bimber_above_footer_sections', 'bimber_render_patreon_section', bimber_get_theme_option( 'footer', 'patreon_order' ), 1 );
	add_action( 'bimber_above_footer_sections', 'bimber_render_promoted_product_section', bimber_get_theme_option( 'footer', 'promoted_product_order' ), 1 );
	add_action( 'bimber_above_footer_sections', 'bimber_render_promoted_products_section', bimber_get_theme_option( 'footer', 'promoted_products_order' ), 1 );
}

/**
 * Render newsletter section.
 *
 * @param string $position  Position.
 */
function bimber_render_newsletter_section( $position = 'above_collection' ) {
	global $bimber_newsletter_section_positon;
	$bimber_newsletter_section_positon = $position;
	if ( 'above_collection' === $position ) {
		$style = 'full';
	}
	if ( 'above_footer' === $position ) {
		$style = 'full';
	}
	if ( bimber_get_theme_option( 'newsletter', $position ) ) {
		get_template_part( 'template-parts/sections/newsletter/section', $style );
	}
}

/**
 * Render instagram section.
 *
 * @param string $position  Position.
 */
function bimber_render_instagram_section( $position = 'above_collection' ) {
	global $bimber_instagram_section_type;
	global $bimber_instagram_section_positon;
	$bimber_instagram_section_positon = $position;
	$bimber_instagram_section_type    = 'expanded';
	$style = 'full';
	if ( bimber_get_theme_option( 'instagram', $position ) ) {
		get_template_part( 'template-parts/sections/instagram/section', $style );
	}
}

/**
 * Render social section.
 *
 * @param string $position  Position.
 */
function bimber_render_social_section( $position = 'above_collection' ) {
	global $bimber_social_section_positon;
	$bimber_social_section_positon = $position;
	$style = 'full';
	if ( bimber_get_theme_option( 'social', $position ) ) {
		get_template_part( 'template-parts/sections/social/section', $style );
	}
}

/**
 * Render patreon section.
 *
 * @param string $position  Position.
 */
function bimber_render_patreon_section( $position = 'above_collection' ) {
	global $bimber_patreon_section_positon;
	$bimber_patreon_section_positon = $position;
	if ( 'above_collection' === $position ) {
		$style = 'boxed';
	}
	if ( 'above_footer' === $position ) {
		$style = 'full';
	}
	if ( bimber_get_theme_option( 'patreon', $position ) ) {
		if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ) {
			get_template_part( 'template-parts/sections/patreon/section', $style );
		}
	}
}

/**
 * Render promoted product section.
 *
 * @param string $position  Position.
 */
function bimber_render_promoted_product_section( $position = 'above_collection' ) {
	global $bimber_promoted_product_section_positon;
	$bimber_promoted_product_section_positon = $position;
	$style = 'boxed';
	if ( bimber_get_theme_option( 'woocommerce_promoted_product', $position ) ) {
		// Hide on woo pages.
		if ( function_exists( 'is_woocommerce' ) && ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) ) {
			get_template_part( 'template-parts/sections/promoted-product/section', $style );
		}
	}
}

/**
 * Render  promoted products section.
 *
 * @param string $position  Position.
 */
function bimber_render_promoted_products_section( $position = 'above_collection' ) {
	global $bimber_promoted_products_section_positon;
	$bimber_promoted_products_section_positon = $position;
	$style = 'boxed';
	if ( bimber_get_theme_option( 'woocommerce_promoted_products', $position ) ) {
		// Hide on woo pages.
		if ( function_exists( 'is_woocommerce' ) && ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) ) {
			get_template_part( 'template-parts/sections/promoted-products/section', $style );
		}
	}
}
