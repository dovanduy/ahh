<?php
/**
 * What's Your Reaction integration
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

$wp_customize->add_section( 'bimber_wyr_section', array(
	'title'    => esc_html__( 'What\'s Your Reaction', 'bimber' ),
	'panel'    => 'bimber_plugins_panel',
	'priority' => 600,
) );

// Hide reactions in header.
$wp_customize->add_setting( $bimber_option_name . '[wyr_show_reactions_in_header]', array(
	'default'           => $bimber_customizer_defaults['wyr_show_reactions_in_header'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_wyr_show_reactions_in_header', array(
	'label'    => esc_html__( 'Show reactions in header', 'bimber' ),
	'section'  => 'bimber_wyr_section',
	'settings' => $bimber_option_name . '[wyr_show_reactions_in_header]',
	'type'     => 'select',
	'choices'  => array(
		'standard'	=> esc_html__( 'yes', 'bimber' ),
		'none'		=> esc_html__( 'no', 'bimber' ),
	),
) );

// Hide entry reactions.
$wp_customize->add_setting( $bimber_option_name . '[wyr_show_entry_reactions]', array(
	'default'           => $bimber_customizer_defaults['wyr_show_entry_reactions'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_wyr_show_entry_reactions', array(
	'label'    => esc_html__( 'Show entry reactions in collections', 'bimber' ),
	'section'  => 'bimber_wyr_section',
	'settings' => $bimber_option_name . '[wyr_show_entry_reactions]',
	'type'     => 'select',
	'choices'  => array(
		'standard'	=> esc_html__( 'yes', 'bimber' ),
		'none'		=> esc_html__( 'no', 'bimber' ),
	),
) );
// Hide entry reactions.
$wp_customize->add_setting( $bimber_option_name . '[wyr_show_entry_reactions_single]', array(
	'default'           => $bimber_customizer_defaults['wyr_show_entry_reactions_single'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_wyr_show_entry_reactions_single', array(
	'label'    => esc_html__( 'Show entry reactions on single post', 'bimber' ),
	'section'  => 'bimber_wyr_section',
	'settings' => $bimber_option_name . '[wyr_show_entry_reactions_single]',
	'type'     => 'select',
	'choices'  => array(
		'standard'	=> esc_html__( 'yes', 'bimber' ),
		'none'		=> esc_html__( 'no', 'bimber' ),
	),
) );

// Fake reactions.
$wp_customize->add_setting( 'wyr_fake_reaction_count_base', array(
	'default'           => $bimber_customizer_defaults['wyr_fake_reaction_count_base'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'wyr_fake_reaction_count_base', array(
	'label'    		=> esc_html__( 'Fake reaction count base', 'bimber' ),
	'description' 	=> esc_html__( 'Leave empty to not use the "Fake reactions" feature.', 'bimber' ),
	'section'  		=> 'bimber_wyr_section',
	'settings' 		=> 'wyr_fake_reaction_count_base',
	'type'     		=> 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Randomize fake reactions?
$wp_customize->add_setting( 'wyr_fake_reactions_randomize', array(
	'default'           => $bimber_customizer_defaults['wyr_fake_reactions_randomize'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'wyr_fake_reactions_randomize', array(
	'label'    => esc_html__( 'Randomize fake reactions?', 'bimber' ),
	'section'  => 'bimber_wyr_section',
	'settings' => 'wyr_fake_reactions_randomize',
	'type'     => 'select',
	'choices'  => array(
		'standard'	=> esc_html__( 'yes', 'bimber' ),
		'none'		=> esc_html__( 'no', 'bimber' ),
	),
) );

// Single post "Reactions box" order.
$wp_customize->add_setting( $bimber_option_name . '[post_reactions_order]', array(
	'default'           => $bimber_customizer_defaults['post_reactions_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_reactions_order', array(
	'label'     	=> esc_html__( 'Reactions', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_reactions_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );
