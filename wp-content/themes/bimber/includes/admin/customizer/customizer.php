<?php
/**
 * Register theme sections into the WP Customizer
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

add_action( 'customize_register',                   'bimber_customize_register' );
add_action( 'customize_preview_init',               'bimber_customizer_live_preview' );
add_action( 'customize_controls_enqueue_scripts',   'enqueue_customizer_scripts' );
add_action( 'wp_ajax_bimber_tag_search',            'bimber_ajax_tag_search' );

require_once 'builder/header/init.php';


/**
 * Register theme options
 *
 * @param WP_Customize_Manager $wp_customize        WP Customizer instance.
 */
function bimber_customize_register( $wp_customize ) {

	// Load helpers.
	require_once BIMBER_INCLUDES_DIR . 'options.php';

	// Load custom controls classes.
	require_once 'lib/class-bimber-customize-html-control.php';
	require_once 'lib/class-bimber-customize-multi-checkbox-control.php';
	require_once 'lib/class-bimber-customize-multi-radio-control.php';
	require_once 'lib/class-bimber-customize-multi-select-control.php';
	require_once 'lib/class-bimber-customize-tag-select-control.php';
	require_once 'lib/class-bimber-customize-sortable-control.php';
	require_once 'lib/class-bimber-customize-custom-range-control.php';
	require_once 'lib/class-bimber-customize-custom-radio-control.php';
	require_once 'lib/class-bimber-customize-typography-control.php';
	require_once 'lib/class-bimber-customize-typography-selector-control.php';

	// Load defaults.
	require 'customizer-defaults.php';

	require_once 'customizer-site-identity.php';


	// Define design panel.
	$wp_customize->add_panel( 'bimber_home_panel', array(
		'title'    => esc_html__( 'Home', 'bimber' ),
		'priority' => 180,
	) );

	require_once 'customizer-home.php';

	// Define posts panel.
	$wp_customize->add_panel( 'bimber_posts_panel', array(
		'title'    => esc_html__( 'Posts', 'bimber' ),
		'priority' => 200,
	) );

	require_once 'customizer-posts-single.php';
	require_once 'customizer-posts-archive.php';
	require_once 'customizer-posts-global.php';
	require_once 'customizer-posts-nsfw.php';
	require_once 'customizer-posts-auto-load.php';

	require_once 'customizer-featured-entries.php';

	// Define desing panel.
	$wp_customize->add_panel( 'bimber_design_panel', array(
		'title'    => esc_html__( 'Design', 'bimber' ),
		'priority' => 220,
	) );

	require_once 'customizer-design-global.php';

	require_once 'customizer-design-typography.php';

	// Define header panel.
	$wp_customize->add_panel( 'bimber_header_panel', array(
		'title'    => esc_html__( 'Header', 'bimber' ),
		'priority' => 221,
	) );
	require_once 'customizer-design-header.php';
	// Define footer panel.
	$wp_customize->add_panel( 'bimber_footer_panel', array(
		'title'    => esc_html__( 'Footer', 'bimber' ),
		'priority' => 222,
	) );
	require_once 'customizer-design-footer.php';
	require_once 'customizer-footer-modules.php';

	require_once 'customizer-search.php';

	$wp_customize->get_section('custom_css')->priority = 999;

	// Define plugins panel.
	$wp_customize->add_panel( 'bimber_plugins_panel', array(
		'title'    => esc_html__( 'Plugin Integrations', 'bimber' ),
		'priority' => 500,
	) );

	// Mailchimp for WP.
	if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
		if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
			require_once 'customizer-newsletter.php';
		} else {
			require_once 'customizer-newsletter-legacy.php';
		}
	}

	// Snax.
	if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
		require_once 'customizer-snax.php';
	}

	// What's Your Reaction.
	if ( bimber_can_use_plugin( 'whats-your-reaction/whats-your-reaction.php' ) ) {
		require_once 'customizer-whats-your-reaction.php';
	}

	// WooCommerce.
	if ( bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
		require_once 'customizer-woocommerce.php';
	}

	// Mashshare.
	if ( bimber_can_use_plugin( 'mashsharer/mashshare.php' ) ) {
		require_once 'customizer-mashsharer.php';
	}

	// G1 Socials.
	if ( bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) ) {
		if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
			require_once 'customizer-instagram.php';
		}
	}

	// BuddyPress.
	if ( bimber_can_use_plugin( 'buddypress/bp-loader.php' ) ) {
		require_once 'customizer-buddypress.php';
	}

	// Visual Composer.
	require_once 'customizer-visual-composer.php';

	do_action( 'bimber_after_customize_register', $wp_customize );
}

/**
 * Force theme to use head inline css (for dynamic styles) in WP Customize Preview mode
 */
function bimber_customizer_live_preview() {
	add_filter( 'bimber_dynamic_style_type', 'bimber_use_internal_dynamic_style_in_customizer_preview' );
	add_filter( 'transient_bimber_featured_entries_query', '__return_false', 99 );
}

/**
 * Return dynamic style type used in live preview
 *
 * @return string
 */
function bimber_use_internal_dynamic_style_in_customizer_preview() {
	return 'internal';
}

/**
 * Return list of categories
 *
 * @return array
 */
function bimber_customizer_get_category_choices() {
	$choices    = array();
	$categories = get_categories( 'hide_empty=0' );

	foreach ( $categories as $category_obj ) {
		$choices[ $category_obj->slug ] = $category_obj->name;
	}

	return $choices;
}

/**
 * Return list of tags
 *
 * @return array
 */
function bimber_customizer_get_tag_choices() {
	$choices = array();
	$tags    = get_tags( 'hide_empty=0' );

	$choices[''] = esc_html__( '- None -', 'bimber' );

	foreach ( $tags as $tag_obj ) {
		$choices[ $tag_obj->slug ] = $tag_obj->name;
	}

	return apply_filters( 'bimber_customizer_tag_choices', $choices );
}

/**
 * Sanitize value of multi-choice control
 *
 * @param array $input   List of choices.
 *
 * @return array
 */
function bimber_sanitize_multi_choice( $input ) {
	return $input;
}

function bimber_customizer_get_product_category_choices() {
	$terms = get_terms( 'product_cat', array(
		'hide_empty' => false,
	) );

	$choices[''] = esc_html__( '- None -', 'bimber' );

	if ( ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term_obj ) {
			$choices[ $term_obj->slug ] = $term_obj->name;
		}
	}

	return apply_filters( 'bimber_customizer_product_category_choices', $choices );
}

/**
 * Allowed tags for of section title.
 *
 * @return array
 */
function bimber_get_section_title_allowed_tags() {
	return array(
		'em' => array(),
		'br' => array(),
	);
}

/**
 * Sanitize section title.
 *
 * @param string $input Section title input.
 *
 * @return string
 */
function bimber_sanitize_section_title_allowed_tags( $input ) {
	return wp_kses( $input, bimber_get_section_title_allowed_tags() );
}

/**
 * Enqueue customizer scripts
 *
 * @return void
 */
function enqueue_customizer_scripts() {
	wp_enqueue_script( 'tags-box' );
}

/**
 * Sanitize instagram username.
 *
 * @param string $input Username input.
 * @return $input
 */
function bimber_sanitize_instagram_username( $input ) {
	// Remove @ from input.
	$input = str_replace( '@', '', $input );
	// Sanitize and return.
	return sanitize_text_field( $input );
}


/**
 *   Determine the device view size and icons in Customizer
 */
function bimber_print_customizer_sizes_style() {

	$mobile_margin_left = '-240px';
	$mobile_width = '480px';
	$mobile_height = '720px';

	$mobile_landscape_width = '720px';
	$mobile_landscape_height = '480px';

	$tablet_width = '780px';
	$tablet_height = '1000px';

	$tablet_landscape_width = '1000px';
	$tablet_landscape_height = '780px';

	?>
	<style>
		.wp-customizer .preview-mobile .wp-full-overlay-main {
			margin-left: <?php echo $mobile_margin_left; ?>;
			width: <?php echo $mobile_width; ?>;
			height: <?php echo $mobile_height; ?>;
		}

		.wp-customizer .preview-mobile-landscape .wp-full-overlay-main {

			width: <?php echo $mobile_landscape_width; ?>;
			height: <?php echo $mobile_landscape_height; ?>;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.wp-customizer .preview-tablet .wp-full-overlay-main {

			width: <?php echo $tablet_width; ?>;
			height: <?php echo $tablet_height; ?>;
		}

		.wp-customizer .preview-tablet-landscape .wp-full-overlay-main {

			width: <?php echo $tablet_landscape_width; ?>;
			height: <?php echo $tablet_landscape_height; ?>;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
		}

		.wp-full-overlay-footer .devices .preview-tablet-landscape:before {
			content: "\f167";
		}

		.wp-full-overlay-footer .devices .preview-mobile-landscape:before {
			content: "\f167";
		}
	</style>
	<?php

}

add_action( 'customize_controls_print_styles', 'bimber_print_customizer_sizes_style' );

/**
 *   Set device button settings and order
 *
 * @param array $devices Devices.
 */
function bimber_customizer_preview_devices( $devices ) {
	$custom_devices['desktop'] = $devices['desktop'];
	$custom_devices['tablet'] = $devices['tablet'];
	$custom_devices['tablet-landscape'] = array(
			'label' => __( 'Enter tablet landscape preview mode', 'bimber' ),
			'default' => false,
	);
	$custom_devices['mobile'] = $devices['mobile'];
	$custom_devices['mobile-landscape'] = array(
			'label' => __( 'Enter mobile landscape preview mode', 'bimber' ),
			'default' => false,
	);

	foreach ( $devices as $device => $settings ) {
		if ( ! isset( $custom_devices[ $device ] ) ) {
			$custom_devices[ $device ] = $settings;
		}
	}

	return $custom_devices;
}

add_filter( 'customize_previewable_devices', 'bimber_customizer_preview_devices' );
