<?php
/**
 * Visual Composer integration
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

$wp_customize->add_section( 'bimber_home_vc_section', array(
	'title'    => esc_html__( 'Visual Composer Content', 'bimber' ),
	'priority' => 25,
	'panel'    => 'bimber_home_panel',
) );

if ( bimber_can_use_plugin( 'js_composer/js_composer.php' ) ) {
	// Page id.
	$wp_customize->add_setting( $bimber_option_name . '[home_vc_page_id]', array(
		'default'           => $bimber_customizer_defaults['home_vc_page_id'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_home_vc_page_id', array(
		'label'           => esc_html__( 'Inject content from page', 'bimber' ),
		'section'         => 'bimber_home_vc_section',
		'settings'        => $bimber_option_name . '[home_vc_page_id]',
		'type'            => 'dropdown-pages',
	) );

	// Edit link.
	$wp_customize->add_setting( 'bimber_home_vc_edit_link', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_home_vc_edit_link', array(
		'section'  => 'bimber_home_vc_section',
		'settings' => 'bimber_home_vc_edit_link',
		'html'     =>
			'<p>' .
				sprintf( __( '<a class="bimber-vc-page-id" href="%s" target="_blank">Edit page</a>', 'bimber' ), esc_url( admin_url( 'post.php?post='. bimber_get_theme_option( 'home', 'vc_page_id' ) .'&action=edit' ) ) ) . ' | '.
				sprintf( __( '<a class="bimber-vc-page-id" href="%s" target="_blank">Edit on front-end with VC</a>', 'bimber' ), esc_url( admin_url( 'post.php?vc_action=vc_inline&post_id='. bimber_get_theme_option( 'home', 'vc_page_id' ) .'&post_type=page' ) ) ) .
			'</p>',

		'active_callback' => 'bimber_customizer_vc_is_page_selected',
	) ) );
} else {
	// Info.
	$wp_customize->add_setting( 'bimber_home_vc_info', array(
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_home_vc_info', array(
		'section'  => 'bimber_home_vc_section',
		'settings' => 'bimber_home_vc_info',
		'html'     =>
			'<hr />
			<h2>' . esc_html__( 'Visual Composer is inactive', 'bimber' ) . '</h2>
			<p>' . esc_html__( 'Please install and activate the Visual Composer plugin to edit your homepage.', 'bimber' ) . '</p>',
	) ) );
}

/**
 * Check whether user selected VP page
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_vc_is_page_selected( $control ) {
	$id = $control->manager->get_setting( bimber_get_theme_id() . '[home_vc_page_id]' )->value();

	return (bool) $id;
}