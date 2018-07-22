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


$wp_customize->add_section( 'bimber_header_builder_section_elements', array(
	'title'    => esc_html__( 'Elements', 'bimber' ),
	'panel'    => 'bimber_header_panel',
) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_label_mobile_menu]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_label_mobile_menu'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_builder_element_label_mobile_menu', array(
	'label'    => esc_html__( 'Hamburger menu label', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_label_mobile_menu]',
	'type'     => 'select',
	'choices'  => array(
		'standard'      => esc_html__( 'enable', 'bimber' ),
		'g1-hamburger-label-hidden'      	=> esc_html__( 'disable', 'bimber' ),
	),
) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_mobile_menu]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_mobile_menu'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_mobile_menu', array(
	'label'    => esc_html__( 'Hamburger menu size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_mobile_menu]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'standard'      	=> esc_html__( '32px', 'bimber' ),
		'g1-hamburger-m'    => esc_html__( '24px', 'bimber' ),
		'g1-hamburger-s'  	=> esc_html__( '16px', 'bimber' ),
	),
) ) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_search]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_search'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_search', array(
	'label'    => esc_html__( 'Search form size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_search]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'standard'      => esc_html__( 'standard', 'bimber' ),
		'g1-form-s'      	=> esc_html__( 'small', 'bimber' ),
	),
) ) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_search_dropdown]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_search_dropdown'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_search_dropdown', array(
	'label'    => esc_html__( 'Search dropdown size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_search_dropdown]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'g1-drop-l'      	=> esc_html__( '32px', 'bimber' ),
		'g1-drop-m'      	=> esc_html__( '24px', 'bimber' ),
		'g1-drop-s'      	=> esc_html__( '16px', 'bimber' ),
	),
) ) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_create_button]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_create_button'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
	$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_create_button', array(
		'label'    => esc_html__( 'Create button size', 'bimber' ),
		'section'  => 'bimber_header_builder_section_elements',
		'settings' => $bimber_option_name . '[header_builder_element_size_create_button]',
		'type'     => 'radio',
		'input_attrs' => array(
			'row-class' => 'radio-single-line',
		),
		'choices'  => array(
			'g1-button-m'      => esc_html__( 'standard', 'bimber' ),
			'g1-button-s'      	=> esc_html__( 'small', 'bimber' ),
		),
	) ) );
}

// Header "Create" button visibility.
$wp_customize->add_setting( $bimber_option_name . '[snax_header_create_button_visibility]', array(
	'default'           => $bimber_customizer_defaults['snax_header_create_button_visibility'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
	$wp_customize->add_control( 'bimber_snax_header_create_button_visibility', array(
		'label'    => esc_html__( 'Show "Create" button', 'bimber' ),
		'section'  => 'bimber_header_builder_section_elements',
		'settings' => $bimber_option_name . '[snax_header_create_button_visibility]',
		'type'     => 'select',
		'choices'  => array(
			'all'		=> esc_html__( 'for all', 'bimber' ),
			'logged_in'	=> esc_html__( 'for logged in users', 'bimber' ),
			'none'		=> esc_html__( 'no', 'bimber' ),
		),
	) );
}

// Header "Create" button type.
$wp_customize->add_setting( $bimber_option_name . '[snax_header_create_button_type]', array(
	'default'           => $bimber_customizer_defaults['snax_header_create_button_type'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
	$all_formats = snax_get_formats();
	$choices = array(
			'all'				=> esc_html__( 'Create (button)', 'bimber' ),
			'all_dropdown'		=> esc_html__( 'Create (dropdown)', 'bimber' ),
	);
	foreach ( $all_formats as $key => $format) {
		$choices[ $key ] = 'Create ' . $format['labels']['name'];
	}
	$wp_customize->add_control( 'bimber_snax_header_create_button_type', array(
		'label'    => esc_html__( '"Create" button type', 'bimber' ),
		'section'  => 'bimber_header_builder_section_elements',
		'settings' => $bimber_option_name . '[snax_header_create_button_type]',
		'type'     => 'select',
		'choices'  => $choices,
	) );
}

// Header "Create" button label.
$wp_customize->add_setting( $bimber_option_name . '[snax_header_create_button_label]', array(
	'default'           => $bimber_customizer_defaults['snax_header_create_button_label'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
	$wp_customize->add_control( 'bimber_snax_header_create_button_label', array(
		'label'       => esc_html__( '"Create" button label', 'bimber' ),
		'section'     => 'bimber_header_builder_section_elements',
		'settings'    => $bimber_option_name . '[snax_header_create_button_label]',
		'type'        => 'text',
	) );
}

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_social_icons_full]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_social_icons_full'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_social_icons_full', array(
	'label'    => esc_html__( 'Socials icons list size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_social_icons_full]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'standard'      => esc_html__( 'standard', 'bimber' ),
		'g1-socials-s'      	=> esc_html__( 'small', 'bimber' ),
	),
) ) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_social_icons_dropdown]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_social_icons_dropdown'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_social_icons_dropdown', array(
	'label'    => esc_html__( 'Social icons dropdown size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_social_icons_dropdown]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'g1-drop-l'      	=> esc_html__( '32px', 'bimber' ),
		'g1-drop-m'      	=> esc_html__( '24px', 'bimber' ),
		'g1-drop-s'      	=> esc_html__( '16px', 'bimber' ),
	),
) ) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_user_menu]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_user_menu'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_user_menu', array(
	'label'    => esc_html__( 'User dropdown size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_user_menu]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'g1-drop-l'      	=> esc_html__( '32px', 'bimber' ),
		'g1-drop-m'      	=> esc_html__( '24px', 'bimber' ),
		'g1-drop-s'      	=> esc_html__( '16px', 'bimber' ),
	),
) ) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_cart]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_cart'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_cart', array(
	'label'    => esc_html__( 'WooCommerce dropdown size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_cart]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'g1-drop-l'      	=> esc_html__( '32px', 'bimber' ),
		'g1-drop-m'      	=> esc_html__( '24px', 'bimber' ),
		'g1-drop-s'      	=> esc_html__( '16px', 'bimber' ),
	),
) ) );

$wp_customize->add_setting( $bimber_option_name . '[header_builder_element_size_newsletter]', array(
	'default'               => $bimber_customizer_defaults['header_builder_element_size_newsletter'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Radio_Control( $wp_customize, 'bimber_header_builder_element_size_newsletter', array(
	'label'    => esc_html__( 'Newsletter size', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_builder_element_size_newsletter]',
	'type'     => 'radio',
	'input_attrs' => array(
		'row-class' => 'radio-single-line',
	),
	'choices'  => array(
		'g1-drop-l'      	=> esc_html__( '32px', 'bimber' ),
		'g1-drop-m'      	=> esc_html__( '24px', 'bimber' ),
		'g1-drop-s'      	=> esc_html__( '16px', 'bimber' ),
	),
) ) );

// Logo Margin Top.
$wp_customize->add_setting( $bimber_option_name . '[header_logo_margin_top]', array(
	'default'           => $bimber_customizer_defaults['header_logo_margin_top'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_logo_margin_top', array(
	'label'    => esc_html__( 'Logo Margin Top', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_logo_margin_top]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Logo Margin Bottom.
$wp_customize->add_setting( $bimber_option_name . '[header_logo_margin_bottom]', array(
	'default'           => $bimber_customizer_defaults['header_logo_margin_bottom'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_logo_margin_bottom', array(
	'label'    => esc_html__( 'Logo Margin Bottom', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_logo_margin_bottom]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Logo Margin Top.
$wp_customize->add_setting( $bimber_option_name . '[header_mobile_logo_margin_top]', array(
	'default'           => $bimber_customizer_defaults['header_mobile_logo_margin_top'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_mobile_logo_margin_top', array(
	'label'    => esc_html__( 'Mobile Logo Margin Top', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_mobile_logo_margin_top]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Logo Margin Bottom.
$wp_customize->add_setting( $bimber_option_name . '[header_mobile_logo_margin_bottom]', array(
	'default'           => $bimber_customizer_defaults['header_mobile_logo_margin_bottom'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_mobile_logo_margin_bottom', array(
	'label'    => esc_html__( 'Mobile Logo Margin Bottom', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_mobile_logo_margin_bottom]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Quick Nav Margin Top.
$wp_customize->add_setting( $bimber_option_name . '[header_quicknav_margin_top]', array(
	'default'           => $bimber_customizer_defaults['header_quicknav_margin_top'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_quicknav_margin_top', array(
	'label'    => esc_html__( 'Quick Nav Margin Top', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_quicknav_margin_top]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Quick Nav Margin Bottom.
$wp_customize->add_setting( $bimber_option_name . '[header_quicknav_margin_bottom]', array(
	'default'           => $bimber_customizer_defaults['header_quicknav_margin_bottom'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_header_quicknav_margin_bottom', array(
	'label'    => esc_html__( 'Quick Nav Margin Bottom', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_quicknav_margin_bottom]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Quick Nav Labels Visibility.
$wp_customize->add_setting( $bimber_option_name . '[header_quicknav_labels]', array(
	'default'           => $bimber_customizer_defaults['header_quicknav_labels'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_header_quicknav_labels', array(
	'label'    => esc_html__( 'Quick Nav Labels', 'bimber' ),
	'section'  => 'bimber_header_builder_section_elements',
	'settings' => $bimber_option_name . '[header_quicknav_labels]',
	'type'     => 'select',
	'choices'     => array(
		'standard'      => esc_html__( 'show', 'bimber' ),
		'none'          => esc_html__( 'hide', 'bimber' ),
	),
) );
