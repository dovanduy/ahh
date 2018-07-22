<?php
/**
 * Mashsharer integration
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

// Bottom share buttons order.
$wp_customize->add_setting( $bimber_option_name . '[post_bottom_share_buttons_order]', array(
	'default'           => $bimber_customizer_defaults['post_related_entries_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_post_bottom_share_buttons_order', array(
	'label'     	=> esc_html__( 'Share buttons', 'bimber' ),
	'section'  		=> 'bimber_posts_single_section',
	'settings' 		=> $bimber_option_name . '[post_bottom_share_buttons_order]',
	'group_id'		=> 'bimber_post_elements_order',
	'base_priority' => $bimber_elements_order_base_priority,
) ) );