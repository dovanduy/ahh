<?php
/**
 * Bimber Title VC Element
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

vc_map( array(
	'name' 		=> __( 'Bimber Title', 'bimber' ),
	'base'	 	=> 'bimber_title',
	'category' 	=> __( 'Content', 'js_composer' ),
	'params' 	=> apply_filters( 'bimber_vc_title_params', array(
		// General > Text.
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Text', 'bimber' ),
			'param_name'	=> 'content',
			'value' 		=> '',
		),
		// General > Size.
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Size', 'bimber' ),
			'param_name'	=> 'size',
			'value' 		=> array(
				__( 'Giga', 'bimber' ) 		=> 'giga',
				__( 'Mega', 'bimber' ) 		=> 'mega',
				__( 'Heading 1', 'bimber' ) => 'h1',
				__( 'Heading 2', 'bimber' ) => 'h2',
				__( 'Heading 3', 'bimber' ) => 'h3',
				__( 'Heading 4', 'bimber' ) => 'h4',
				__( 'Heading 5', 'bimber' ) => 'h5',
				__( 'Heading 6', 'bimber' ) => 'h6',
			),
			'std' 			=> 'h4',
		),
		// General > Size.
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Align', 'bimber' ),
			'param_name'	=> 'align',
			'value' 		=> array(
				__( 'default', 'bimber' )	=> '',
				__( 'center', 'bimber' ) 	=> 'center',
			),
			'std' 			=> '',
		),
		// General > HTML Id.
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'HTML id', 'bimber' ),
			'param_name'	=> 'html_class',
			'value' 		=> '',
		),
		// General > HTML class.
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'HTML class', 'bimber' ),
			'param_name'	=> 'html_id',
			'value' 		=> '',
		),
	) ),
) );
