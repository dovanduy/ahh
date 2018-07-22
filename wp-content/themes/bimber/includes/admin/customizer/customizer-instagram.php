<?php
/**
 * Instagram integration
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

$wp_customize->add_section( 'bimber_instagram_section', array(
	'title'    => esc_html__( 'Instagram', 'bimber' ),
	'panel'    => 'bimber_plugins_panel',
	'priority' => 700,
) );

// Username.
$wp_customize->add_setting( $bimber_option_name . '[instagram_username]', array(
	'default'           => $bimber_customizer_defaults['instagram_username'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_instagram_username',
) );

$wp_customize->add_control( 'bimber_instagram_username', array(
	'label'    => esc_html__( 'Username', 'bimber' ),
	'section'  => 'bimber_instagram_section',
	'settings' => $bimber_option_name . '[instagram_username]',
	'type'     => 'text',
) );

// Follow text.
$wp_customize->add_setting( $bimber_option_name . '[instagram_follow_text]', array(
	'default'           => $bimber_customizer_defaults['instagram_follow_text'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_instagram_follow_text', array(
	'label'    => esc_html__( 'Follow Text', 'bimber' ),
	'section'  => 'bimber_instagram_section',
	'settings' => $bimber_option_name . '[instagram_follow_text]',
	'type'     => 'text',
) );
