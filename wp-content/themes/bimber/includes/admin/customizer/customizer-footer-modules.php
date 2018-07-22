<?php
/**
 * WP Customizer panel section to customize footer design options
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
$dev = defined( 'BTP_DEV' ) && BTP_DEV;
if ( ! $dev ) {
	return;
}

$bimber_option_name = bimber_get_theme_id();

$wp_customize->add_section( 'bimber_footer_modules_section', array(
	'title'    => esc_html__( 'Modules', 'bimber' ),
	'priority' => 75,
	'panel'    => 'bimber_footer_panel',
) );

$bimber_footer_sections_order = 300;

$wp_customize->add_setting( 'bimber_footer_sections_order_header', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_footer_sections_order_header', array(
	'section'  => 'bimber_footer_modules_section',
	'settings' => 'bimber_footer_sections_order_header',
	'priority' => $bimber_footer_sections_order,
	'html'     => '<span class="customize-control-title">' . esc_html__( 'Sections order', 'bimber' ) . '</span>',
) ) );

/**
 * Featured Products.
 */

if ( bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {

	$bimber_curr_module_order = $bimber_customizer_defaults['footer_promoted_products_order'];

	// Visibility.
	$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_products_above_footer]', array(
		'default'           => $bimber_customizer_defaults['woocommerce_promoted_products_above_footer'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'bimber_woocommerce_promoted_products_above_footer', array(
		'label'    => esc_html__( 'Show Featured Products', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[woocommerce_promoted_products_above_footer]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order,
	) );

	// Order.
	$wp_customize->add_setting( $bimber_option_name . '[footer_promoted_products_order]', array(
		'default'           => $bimber_customizer_defaults['footer_promoted_products_order'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_footer_promoted_products_order', array(
		'label' 	     => esc_html__( 'Featured Products', 'bimber' ),
		'section' 		 => 'bimber_footer_modules_section',
		'settings' 		 => $bimber_option_name . '[footer_promoted_products_order]',
		'group_id'		 => 'bimber_footer_sections_order',
		'base_priority'  => $bimber_footer_sections_order,
	) ) );
}

/**
 * Check whether products section is active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_woocommerce_promoted_products_above_footer_is_active( $control ) {
	$value = $control->manager->get_setting( bimber_get_theme_id() . '[woocommerce_promoted_products_above_footer]' )->value();

	return ! empty( $value );
}

/**
 * Featured Single Product.
 */

if ( bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {

	$bimber_curr_module_order = $bimber_customizer_defaults['footer_promoted_product_order'];

	// Visibility.
	$wp_customize->add_setting( $bimber_option_name . '[woocommerce_promoted_product_above_footer]', array(
		'default'           => $bimber_customizer_defaults['woocommerce_promoted_product_above_footer'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'bimber_woocommerce_promoted_product_above_footer', array(
		'label'    => esc_html__( 'Show Featured Single Product', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[woocommerce_promoted_product_above_footer]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order,
	) );

	// Order.
	$wp_customize->add_setting( $bimber_option_name . '[footer_promoted_product_order]', array(
		'default'           => $bimber_customizer_defaults['footer_promoted_product_order'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_footer_promoted_product_order', array(
		'label' 	     => esc_html__( 'Featured Single Product', 'bimber' ),
		'section' 		 => 'bimber_footer_modules_section',
		'settings' 		 => $bimber_option_name . '[footer_promoted_product_order]',
		'group_id'		 => 'bimber_footer_sections_order',
		'base_priority'  => $bimber_footer_sections_order,
	) ) );
}

/**
 * Check whether promoted product section is active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_woocommerce_promoted_product_above_footer_is_active( $control ) {
	$value = $control->manager->get_setting( bimber_get_theme_id() . '[woocommerce_promoted_product_above_footer]' )->value();

	return ! empty( $value );
}

/**
 * Newsletter.
 */

if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {

	$bimber_curr_module_order = $bimber_customizer_defaults['footer_newsletter_order'];

	// Visibility.
	$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_footer]', array(
		'default'           => $bimber_customizer_defaults['newsletter_above_footer'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'newsletter_above_footer', array(
		'label'    => esc_html__( 'Show Newsletter', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[newsletter_above_footer]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order,
	) );

	// Invert color schema.
	$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_footer_invert]', array(
		'default'           => $bimber_customizer_defaults['newsletter_above_footer_invert'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'newsletter_above_footer_invert', array(
		'label'    => esc_html__( 'Invert Newsletter Color Schema.', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[newsletter_above_footer_invert]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order + 5,
		'active_callback' => 'bimber_customizer_newsletter_above_footer_is_active',
	) );

	// Title.
	$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_footer_title]', array(
		'default'           => $bimber_customizer_defaults['newsletter_above_footer_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_above_footer_title', array(
		'label'       => esc_html__( 'Newsletter Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_footer_modules_section',
		'settings'    => $bimber_option_name . '[newsletter_above_footer_title]',
		'type'        => 'textarea',
		'priority' => $bimber_curr_module_order + 8,
		'active_callback' => 'bimber_customizer_newsletter_above_footer_is_active',
	) );

	// Avatar.
	$wp_customize->add_setting( $bimber_option_name . '[newsletter_above_footer_avatar]', array(
		'default'           => $bimber_customizer_defaults['newsletter_above_footer_avatar'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_above_footer_avatar', array(
		'label'    => esc_html__( 'Avatar', 'bimber' ),
		'section'     => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[newsletter_above_footer_avatar]',
		'priority' => $bimber_curr_module_order + 10,
		'active_callback' => 'bimber_customizer_newsletter_above_footer_is_active',
	) ) );

	// Order.
	$wp_customize->add_setting( $bimber_option_name . '[footer_newsletter_order]', array(
		'default'           => $bimber_customizer_defaults['footer_newsletter_order'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_footer_newsletter_order', array(
		'label' 	     => esc_html__( 'Newsletter', 'bimber' ),
		'section' 		 => 'bimber_footer_modules_section',
		'settings' 		 => $bimber_option_name . '[footer_newsletter_order]',
		'group_id'		 => 'bimber_footer_sections_order',
		'base_priority'  => $bimber_footer_sections_order,
	) ) );
}

/**
 * Check whether newsletter section is active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_newsletter_above_footer_is_active( $control ) {
	$value = $control->manager->get_setting( bimber_get_theme_id() . '[newsletter_above_footer]' )->value();

	return ! empty( $value );
}

/**
 * Patreon.
 */

if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ) {

	$bimber_curr_module_order = $bimber_customizer_defaults['footer_patreon_order'];

	// Visibility.
	$wp_customize->add_setting( $bimber_option_name . '[patreon_above_footer]', array(
		'default'           => $bimber_customizer_defaults['patreon_above_footer'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'patreon_above_footer', array(
		'label'    => esc_html__( 'Show Patreon', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[patreon_above_footer]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order,
	) );

	// Order.
	$wp_customize->add_setting( $bimber_option_name . '[footer_patreon_order]', array(
		'default'           => $bimber_customizer_defaults['footer_patreon_order'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_footer_patreon_order', array(
		'label' 	     => esc_html__( 'Patreon', 'bimber' ),
		'section' 		 => 'bimber_footer_modules_section',
		'settings' 		 => $bimber_option_name . '[footer_patreon_order]',
		'group_id'		 => 'bimber_footer_sections_order',
		'base_priority'  => $bimber_footer_sections_order,
	) ) );
}

/**
 * Check whether patreon section is active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_patreon_above_footer_is_active( $control ) {
	$value = $control->manager->get_setting( bimber_get_theme_id() . '[patreon_above_footer]' )->value();

	return ! empty( $value );
}

/**
 * Instagram.
 */

if ( bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) ) {

	$bimber_curr_module_order = $bimber_customizer_defaults['footer_instagram_order'];

	// Visibility.
	$wp_customize->add_setting( $bimber_option_name . '[instagram_above_footer]', array(
		'default'           => $bimber_customizer_defaults['instagram_above_footer'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_instagram_above_footer', array(
		'label'    => esc_html__( 'Show Instagram', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[instagram_above_footer]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order,
	) );

	// Invert color schema.
	$wp_customize->add_setting( $bimber_option_name . '[instagram_above_footer_invert]', array(
		'default'           => $bimber_customizer_defaults['instagram_above_footer_invert'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_instagram_above_footer_invert', array(
		'label'    => esc_html__( 'Invert Instagram Colors', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[instagram_above_footer_invert]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order + 5,
		'active_callback' => 'bimber_customizer_instagram_above_footer_is_active',
	) );

	// Order.
	$wp_customize->add_setting( $bimber_option_name . '[footer_instagram_order]', array(
		'default'           => $bimber_customizer_defaults['footer_instagram_order'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_footer_instagram_order', array(
		'label' 	     => esc_html__( 'Instagram', 'bimber' ),
		'section' 		 => 'bimber_footer_modules_section',
		'settings' 		 => $bimber_option_name . '[footer_instagram_order]',
		'group_id'		 => 'bimber_footer_sections_order',
		'base_priority'  => $bimber_footer_sections_order,
	) ) );
}

/**
 * Check whether instagram section is active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_instagram_above_footer_is_active( $control ) {
	$value = $control->manager->get_setting( bimber_get_theme_id() . '[instagram_above_footer]' )->value();

	return ! empty( $value );
}

/**d
 * Social Media Profile Links.
 */

if ( bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) ) {

	$bimber_curr_module_order = $bimber_customizer_defaults['footer_social_order'];

	// Visibility.
	$wp_customize->add_setting( $bimber_option_name . '[social_above_footer]', array(
		'default'           => $bimber_customizer_defaults['social_above_footer'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'social_above_footer', array(
		'label'    => esc_html__( 'Show Social Media Profile Links', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[social_above_footer]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order,
	) );

	// Invert color schema.
	$wp_customize->add_setting( $bimber_option_name . '[social_above_footer_invert]', array(
		'default'           => $bimber_customizer_defaults['social_above_footer_invert'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'social_above_footer_invert', array(
		'label'    => esc_html__( 'Invert Social Media Profile Links Colors', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[social_above_footer_invert]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order + 5,
		'active_callback' => 'bimber_customizer_social_above_footer_is_active',
	) );

	// Order.
	$wp_customize->add_setting( $bimber_option_name . '[footer_social_order]', array(
		'default'           => $bimber_customizer_defaults['footer_social_order'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_footer_social_order', array(
		'label' 	     => esc_html__( 'Social Media Profile Links', 'bimber' ),
		'section' 		 => 'bimber_footer_modules_section',
		'settings' 		 => $bimber_option_name . '[footer_social_order]',
		'group_id'		 => 'bimber_footer_sections_order',
		'base_priority'  => $bimber_footer_sections_order,
	) ) );

	// Show in footer.
	$wp_customize->add_setting( $bimber_option_name . '[social_in_footer]', array(
		'default'           => $bimber_customizer_defaults['social_in_footer'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'social_in_footer', array(
		'label'    => esc_html__( 'Show Social Media Profile Links in the footer', 'bimber' ),
		'section'  => 'bimber_footer_modules_section',
		'settings' => $bimber_option_name . '[social_in_footer]',
		'type'     => 'checkbox',
		'priority' => $bimber_curr_module_order + 8,
	) );
}

/**
 * Check whether G1 socials section is active.
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_social_above_footer_is_active( $control ) {
	$value = $control->manager->get_setting( bimber_get_theme_id() . '[social_above_footer]' )->value();

	return ! empty( $value );
}
