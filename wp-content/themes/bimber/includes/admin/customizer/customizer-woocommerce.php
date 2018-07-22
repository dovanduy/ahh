<?php
/**
 * WooCommerce integration
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

$wp_customize->add_section( 'bimber_woocommerce_section', array(
	'title'    => esc_html__( 'WooCommerce', 'bimber' ),
	'panel'    => 'bimber_plugins_panel',
	'priority' => 700,
) );

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	$wp_customize->add_section( 'bimber_woocommerce_promoted_products_section', array(
		'title'    => esc_html__( 'WooCommerce Promoted Products', 'bimber' ),
		'panel'    => 'bimber_plugins_panel',
		'priority' => 720,
	) );

	$wp_customize->add_section( 'bimber_woocommerce_promoted_product_section', array(
		'title'    => esc_html__( 'WooCommerce Promoted Product', 'bimber' ),
		'panel'    => 'bimber_plugins_panel',
		'priority' => 730,
	) );
}

// Hide cart.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_cart_visibility]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_cart_visibility'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_woocommerce_cart_visibility', array(
	'label'    => esc_html__( 'Show cart in the navbar', 'bimber' ),
	'section'  => 'bimber_woocommerce_section',
	'settings' => $bimber_option_name . '[woocommerce_cart_visibility]',
	'type'     => 'select',
	'choices'  => array(
		'always'			=> esc_html__( 'always', 'bimber' ),
		'on_woocommerce'	=> esc_html__( 'on WooCommerce pages', 'bimber' ),
		'none'				=> esc_html__( 'no', 'bimber' ),
	),
) );

// Hide cart.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_single_product_sidebar]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_single_product_sidebar'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_woocommerce_single_product_sidebar', array(
	'label'    => esc_html__( 'Show sidebar on single product', 'bimber' ),
	'section'  => 'bimber_woocommerce_section',
	'settings' => $bimber_option_name . '[woocommerce_single_product_sidebar]',
	'type'     => 'select',
	'choices'  => array(
		'show'			=> esc_html__( 'Show', 'bimber' ),
		'hide'			=> esc_html__( 'Hide', 'bimber' ),
	),
) );

// Open in.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_affiliate_link_target]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_affiliate_link_target'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_woocommerce_affiliate_link_target', array(
	'label'    => esc_html__( 'Open affiliate links', 'bimber' ),
	'section'  => 'bimber_woocommerce_section',
	'settings' => $bimber_option_name . '[woocommerce_affiliate_link_target]',
	'type'     => 'select',
	'choices'  => array(
		'_blank'		=> esc_html__( 'in a new window', 'bimber' ),
		'_self'			=> esc_html__( 'in the same window', 'bimber' ),
	),
) );

$dev = defined( 'BTP_DEV' ) && BTP_DEV;
if ( ! $dev ) {
	return;
}

// Promoted products title.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_title]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_products_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_woocommerce_promoted_products_title', array(
	'label'    => esc_html__( 'Promoted products title', 'bimber' ),
	'section'  => 'bimber_woocommerce_promoted_products_section',
	'settings' => $bimber_option_name . '[woocommerce_promoted_products_title]',
	'type'     => 'text',
) );

// Show disclosure.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_disclosure]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_products_disclosure'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'woocommerce_promoted_products_disclosure', array(
	'label'    => esc_html__( 'Show disclosure', 'bimber' ),
	'section'  => 'bimber_woocommerce_promoted_products_section',
	'settings' => $bimber_option_name . '[woocommerce_promoted_products_disclosure]',
	'type'     => 'checkbox',
) );

// Promoted products description.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_description]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_products_description'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'wp_filter_post_kses',
) );
$wp_customize->add_control( 'bimber_woocommerce_promoted_products_description', array(
	'label'    => esc_html__( 'Promoted products description', 'bimber' ),
	'section'  => 'bimber_woocommerce_promoted_products_section',
	'settings' => $bimber_option_name . '[woocommerce_promoted_products_description]',
	'type'     => 'textarea',
) );

// Promoted products link label.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_link_label]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_products_link_label'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'wp_filter_post_kses',
) );
$wp_customize->add_control( 'woocommerce_promoted_products_link_label', array(
	'label'    => esc_html__( 'Shop Link Label', 'bimber' ),
	'section'  => 'bimber_woocommerce_promoted_products_section',
	'settings' => $bimber_option_name . '[woocommerce_promoted_products_link_label]',
	'type'     => 'text',
) );

$wp_customize->add_control( 'woocommerce_promoted_products_hide_price', array(
	'label'    => esc_html__( 'Hide price', 'bimber' ),
	'section'  => 'bimber_woocommerce_promoted_products_section',
	'settings' => $bimber_option_name . '[woocommerce_promoted_products_hide_price]',
	'type'     => 'checkbox',
) );

// Products Ids.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_ids]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_products_ids'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( new bimber_Customize_Multi_Select_Control( $wp_customize, 'bimber_woocommerce_promoted_products_ids', array(
	'label'       => esc_html__( 'Products', 'bimber' ),
	'description' => esc_html__( 'You can choose more than one.', 'bimber' ),
	'section'     => 'bimber_woocommerce_promoted_products_section',
	'settings'    => $bimber_option_name . '[woocommerce_promoted_products_ids]',
	'choices'     => bimber_customizer_get_woocomerce_ids_choices(),
	'size'        => 8,
) ) );

// Category.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_categories]', array(
	'default'               => $bimber_customizer_defaults['woocommerce_promoted_products_categories'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( new bimber_Customize_Multi_Select_Control( $wp_customize, 'bimber_woocommerce_promoted_products_categories', array(
	'label'       => esc_html__( 'Categories', 'bimber' ),
	'description' => esc_html__( 'You can choose more than one.', 'bimber' ),
	'section'     => 'bimber_woocommerce_promoted_products_section',
	'settings'    => $bimber_option_name . '[woocommerce_promoted_products_categories]',
	'choices'     => bimber_customizer_get_woocomerce_category_choices(),
	'size'        => 8,
) ) );

// Tag.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_tags]', array(
	'default'               => $bimber_customizer_defaults['woocommerce_promoted_products_tags'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( new bimber_Customize_Multi_Select_Control( $wp_customize, 'bimber_woocommerce_promoted_products_tags', array(
	'label'       => esc_html__( 'Tags', 'bimber' ),
	'description' => esc_html__( 'You can choose more than one.', 'bimber' ),
	'section'     => 'bimber_woocommerce_promoted_products_section',
	'settings'    => $bimber_option_name . '[woocommerce_promoted_products_tags]',
	'choices'     => bimber_customizer_get_woocomerce_tag_choices(),
	'size'        => 8,
) ) );

// Promoted product title.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_product_title]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_product_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
) );
$wp_customize->add_control( 'bimber_woocommerce_promoted_product_title', array(
	'label'    => esc_html__( 'Promoted product title', 'bimber' ),
	'section'  => 'bimber_woocommerce_promoted_product_section',
	'settings' => $bimber_option_name . '[woocommerce_promoted_product_title]',
	'type'     => 'text',
) );

// Promoted product description.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_product_description]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_product_description'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'wp_filter_post_kses',
) );
$wp_customize->add_control( 'bimber_woocommerce_promoted_product_description', array(
	'label'    => esc_html__( 'Promoted product description', 'bimber' ),
	'section'  => 'bimber_woocommerce_promoted_product_section',
	'settings' => $bimber_option_name . '[woocommerce_promoted_product_description]',
	'type'     => 'textarea',
) );

// Product Id.
$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_product_id]', array(
	'default'           => $bimber_customizer_defaults['woocommerce_promoted_product_id'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( 'woocommerce_promoted_product_id', array(
	'label'       => esc_html__( 'Product', 'bimber' ),
	'description' => '',
	'section'     => 'bimber_woocommerce_promoted_product_section',
	'settings'    => $bimber_option_name . '[woocommerce_promoted_product_id]',
	'choices'     => bimber_customizer_get_woocomerce_ids_choices(),
	'type'     => 'select',
) );

/**
 * Return list of products categories
 *
 * @return array
 */
function bimber_customizer_get_woocomerce_ids_choices() {
	// Prep array for return.
	$choices                    = array();
	// Lets make small doggies cry and add this empty choice.
	$choices['']                = esc_html__( '- None -', 'bimber' );
	// Args for products query.
	$bimber_products_query_args = array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
	);
	$bimber_products_query = new WP_Query( $bimber_products_query_args );
	// Check if any products are found.
	if ( $bimber_products_query -> have_posts() ) {
		// Loop products.
		while ( $bimber_products_query -> have_posts() ) {
			$bimber_products_query -> the_post();
			$choices[ get_the_id() ] = get_the_title();
		}
	}
	wp_reset_postdata();
	return $choices;
}

/**
 * Return list of products categories
 *
 * @return array
 */
function bimber_customizer_get_woocomerce_category_choices() {
	// Prep array for return.
	$choices    = array();
	// Lets make small doggies cry and add this empty choice.
	$choices[''] = esc_html__( '- None -', 'bimber' );
	// Get terms and loop to add them to choices.
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	) );
	foreach ( $categories as $category_obj ) {
		$choices[ $category_obj->slug ] = $category_obj->name;
	}
	return $choices;
}

/**
 * Return list of products tag
 *
 * @return array
 */
function bimber_customizer_get_woocomerce_tag_choices() {
	// Prep array for return.
	$choices     = array();
	// Lets make small doggies cry and add this empty choice.
	$choices[''] = esc_html__( '- None -', 'bimber' );
	// Get terms and loop to add them to choices.
	$tags        = get_terms( array(
		'taxonomy'   => 'product_tag',
		'hide_empty' => false,
	) );
	foreach ( $tags as $tag_obj ) {
		$choices[ $tag_obj->slug ] = $tag_obj->name;
	}
	return $choices;
}
