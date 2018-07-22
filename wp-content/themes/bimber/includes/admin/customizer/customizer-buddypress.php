<?php
/**
 * BuddyPress integration
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

$wp_customize->add_section( 'bimber_byddypress_section', array(
	'title'    => esc_html__( 'BuddyPress', 'bimber' ),
	'panel'    => 'bimber_plugins_panel',
	'priority' => 700,
) );

// Hide reactions in header.
$wp_customize->add_setting( $bimber_option_name . '[bp_enable_sidebar]', array(
	'default'           => $bimber_customizer_defaults['bp_enable_sidebar'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_bp_enable_sidebar', array(
	'label'    => esc_html__( 'Show sidebar on BuddyPress pages', 'bimber' ),
	'section'  => 'bimber_byddypress_section',
	'settings' => $bimber_option_name . '[bp_enable_sidebar]',
	'type'     => 'select',
	'choices'  => array(
		'standard'	=> esc_html__( 'yes', 'bimber' ),
		'none'		=> esc_html__( 'no', 'bimber' ),
	),
) );


