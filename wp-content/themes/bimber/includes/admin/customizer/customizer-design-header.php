<?php
/**
 * WP Customizer panel section to handle header design options
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

$wp_customize->add_section( 'bimber_header_layout_section', array(
	'title'    => esc_html__( 'Builder', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );


$wp_customize->add_section( 'bimber_header_colors_section', array(
	'title'    => esc_html__( 'Colors', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );


// Composition.
$wp_customize->add_setting( $bimber_option_name . '[header_composition]', array(
	'default'           => $bimber_customizer_defaults['header_composition'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_header_composition', array(
	'label'    => esc_html__( 'Composition', 'bimber' ),
	'section'  => 'bimber_header_layout_section',
	'settings' => $bimber_option_name . '[header_composition]',
	'type'     => 'select',
	'choices'  => array(
		'original'  => array(
			'label'	=> esc_html__( 'Logo on left, menu below', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-01.png',
		),
		'gag'       => array(
			'label'	=> esc_html__( 'Logo + header, same line (full width)', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-02.png',
		),
		'05'  => array(
			'label'	=> esc_html__( '05', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-05.png',
		),
		'smiley'    => array(
			'label'	=> esc_html__( 'Logo + header, same line', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-03.png',
		),
		'07'  => array(
			'label'	=> esc_html__( '07', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-07.png',
		),
		'hardcore'  => array(
			'label'	=> esc_html__( 'Menu on left, logo below', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-04.png',
		),
		'06'  => array(
			'label'	=> esc_html__( '06', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-06.png',
		),
		'bunchy'       => array(
			'label'	=> esc_html__( 'Bunchy', 'bimber' ),
			'path'	=> BIMBER_ADMIN_DIR_URI . 'customizer/images/header-composition-bunchy.png',
		),
	),
) ) );

require_once 'customizer-design-header-colors.php';
require_once 'customizer-design-header-elements.php';
