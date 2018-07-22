<?php
/**
 * WP Customizer panel section to handle general design options
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

$wp_customize->add_section( 'bimber_design_typo_section', array(
	'title'    => esc_html__( 'Typography', 'bimber' ),
	'priority' => 10,
	'panel'    => 'bimber_design_panel',
) );

// Selectors.
$wp_customize->add_setting( $bimber_option_name . '[typo_selectors]', array(
	'default'           => $bimber_customizer_defaults['typo_selectors'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Selector_Control( $wp_customize, 'bimber_typo_selectors', array(
	'label'    => esc_html__( 'Add new', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_selectors]',
) ) );

// Body.
$wp_customize->add_setting( $bimber_option_name . '[typo_body]', array(
	'default'           => $bimber_customizer_defaults['typo_body'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_body', array(
	'label'    => esc_html__( 'Paragraphs', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_body]',
	'input_attrs' => array(
		'selector' => '.entry-content p',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_body',
	),
) ) );


// g1-meta.
$wp_customize->add_setting( $bimber_option_name . '[typo_meta]', array(
	'default'           => $bimber_customizer_defaults['typo_meta'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_meta', array(
	'label'    => esc_html__( 'Meta-text', 'bimber' ),
	'description' => esc_html__( 'Short meta information like post date, author etc.', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_meta]',
	'input_attrs' => array(
		'selector' => '.g1-meta',
		'attributes' => array( 'font-family', 'font-style', 'font-size','letter-spacing','text-transform', 'font-size-tablet', 'font-size-mobile' ),
		'setting'	=> 'typo_meta',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 15,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 15,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 15,
			),
		),
	),
) ) );

// g1-link.
$wp_customize->add_setting( $bimber_option_name . '[typo_link]', array(
	'default'           => $bimber_customizer_defaults['typo_link'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_link', array(
	'label'    => esc_html__( 'Meta-text links', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_link]',
	'input_attrs' => array(
		'selector' => '.g1-meta a',
		'attributes' => array( 'font-family', 'font-style', 'font-size','letter-spacing','text-transform', 'font-size-tablet', 'font-size-mobile' ),
		'setting'	=> 'typo_link',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 15,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 15,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 15,
			),
		),
	),
) ) );

// Button medium.
$wp_customize->add_setting( $bimber_option_name . '[typo_button]', array(
	'default'           => $bimber_customizer_defaults['typo_button'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_button', array(
	'label'    => esc_html__( 'Button', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_button]',
	'input_attrs' => array(
		'selector' => '[type=submit], [type=reset], [type=button], button, .g1-button, .g1-hb-row .snax-button-create.g1-button-m',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_button',
	),
) ) );

// Categories.
$wp_customize->add_setting( $bimber_option_name . '[typo_categories]', array(
	'default'           => $bimber_customizer_defaults['typo_categories'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_categories', array(
	'label'    => esc_html__( 'Category labels', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_categories]',
	'input_attrs' => array(
		'selector' => '.entry-category, .entry-categories-l .entry-category',
		'attributes' => array( 'font-family', 'font-style', 'font-size','letter-spacing','text-transform', 'font-size-tablet', 'font-size-mobile' ),
		'setting'	=> 'typo_categories',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 15,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 15,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 15,
			),
		),
	),
) ) );

// Tags.
$wp_customize->add_setting( $bimber_option_name . '[typo_tags]', array(
	'default'           => $bimber_customizer_defaults['typo_tags'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_tags', array(
	'label'    => esc_html__( 'Tags', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_tags]',
	'input_attrs' => array(
		'selector' => '.entry-tag',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_tags',
	),
) ) );


// Tab.
$wp_customize->add_setting( $bimber_option_name . '[typo_tabs]', array(
	'default'           => $bimber_customizer_defaults['typo_tabs'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_tabs', array(
	'label'    => esc_html__( 'Tabs', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_tabs]',
	'input_attrs' => array(
		'selector' => '.g1-tab',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_tabs',
	),
) ) );

// Primary nav.
$wp_customize->add_setting( $bimber_option_name . '[typo_primary_nav]', array(
	'default'           => $bimber_customizer_defaults['typo_primary_nav'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_primary_nav', array(
	'label'    => esc_html__( 'Primary nav', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_primary_nav]',
	'input_attrs' => array(
		'selector' => '.g1-body-inner .g1-primary-nav-menu > .menu-item > a, .g1-primary-nav-menu>.menu-item>a',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_primary_nav',
	),
) ) );

// Secondary nav.
$wp_customize->add_setting( $bimber_option_name . '[typo_secondary_nav]', array(
	'default'           => $bimber_customizer_defaults['typo_secondary_nav'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_secondary_nav', array(
	'label'    => esc_html__( 'Secondary nav', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_secondary_nav]',
	'input_attrs' => array(
		'selector' => '.g1-body-inner .g1-secondary-nav-menu > .menu-item > a',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_secondary_nav',
	),
) ) );

// Quick Nav.
$wp_customize->add_setting( $bimber_option_name . '[typo_quick_nav]', array(
	'default'           => $bimber_customizer_defaults['typo_quick_nav'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_quick_nav', array(
	'label'    => esc_html__( 'Quick Nav', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_quick_nav]',
	'input_attrs' => array(
		'selector' => '.g1-quick-nav .g1-quick-nav-menu > .menu-item > a',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_quick_nav',
	),
) ) );

// Submenus.
$wp_customize->add_setting( $bimber_option_name . '[typo_submenus]', array(
	'default'           => $bimber_customizer_defaults['typo_submenus'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_submenus', array(
	'label'    => esc_html__( 'Submenus', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_submenus]',
	'input_attrs' => array(
		'selector' => '.sub-menu > li > a',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_submenus',
	),
) ) );


// Giga.
$wp_customize->add_setting( $bimber_option_name . '[typo_giga]', array(
	'default'           => $bimber_customizer_defaults['typo_giga'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_giga', array(
	'label'    => esc_html__( 'Giga Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_giga]',
	'input_attrs' => array(
		'selector' => '.g1-giga',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_giga',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// mega.
$wp_customize->add_setting( $bimber_option_name . '[typo_mega]', array(
	'default'           => $bimber_customizer_defaults['typo_mega'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_mega', array(
	'label'    => esc_html__( 'Mega Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_mega]',
	'input_attrs' => array(
		'selector' => '.g1-mega',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_mega',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// mega-2nd.
$wp_customize->add_setting( $bimber_option_name . '[typo_mega_2nd]', array(
	'default'           => $bimber_customizer_defaults['typo_mega_2nd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_mega_2nd', array(
	'label'    => esc_html__( 'Mega as Section Title', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_mega_2nd]',
	'input_attrs' => array(
		'selector' => '.g1-mega-2nd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_mega_2nd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// alpha.
$wp_customize->add_setting( $bimber_option_name . '[typo_alpha]', array(
	'default'           => $bimber_customizer_defaults['typo_alpha'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_alpha', array(
	'label'    => esc_html__( 'H1 Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_alpha]',
	'input_attrs' => array(
		'selector' => '.g1-alpha',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_alpha',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// alpha-2nd.
$wp_customize->add_setting( $bimber_option_name . '[typo_alpha_2nd]', array(
	'default'           => $bimber_customizer_defaults['typo_alpha_2nd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_alpha_2nd', array(
	'label'    => esc_html__( 'H1 as Section Title', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_alpha_2nd]',
	'input_attrs' => array(
		'selector' => '.g1-alpha-2nd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_alpha_2nd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// beta.
$wp_customize->add_setting( $bimber_option_name . '[typo_beta]', array(
	'default'           => $bimber_customizer_defaults['typo_beta'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_beta', array(
	'label'    => esc_html__( 'H2 Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_beta]',
	'input_attrs' => array(
		'selector' => '.g1-beta',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_beta',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// beta-2nd.
$wp_customize->add_setting( $bimber_option_name . '[typo_beta_2nd]', array(
	'default'           => $bimber_customizer_defaults['typo_beta_2nd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_beta_2nd', array(
	'label'    => esc_html__( 'H2 as Section Title', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_beta_2nd]',
	'input_attrs' => array(
		'selector' => '.g1-beta-2nd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_beta_2nd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// gamma.
$wp_customize->add_setting( $bimber_option_name . '[typo_gamma]', array(
	'default'           => $bimber_customizer_defaults['typo_gamma'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_gamma', array(
	'label'    => esc_html__( 'H3 Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_gamma]',
	'input_attrs' => array(
		'selector' => '.g1-gamma',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_gamma',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// gamma-2nd.
$wp_customize->add_setting( $bimber_option_name . '[typo_gamma_2nd]', array(
	'default'           => $bimber_customizer_defaults['typo_gamma_2nd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_gamma_2nd', array(
	'label'    => esc_html__( 'H3 as Section Title', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_gamma_2nd]',
	'input_attrs' => array(
		'selector' => '.g1-gamma-2nd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_gamma_2nd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// gamma-3rd.
$wp_customize->add_setting( $bimber_option_name . '[typo_gamma_3rd]', array(
	'default'           => $bimber_customizer_defaults['typo_gamma_3rd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_gamma_3rd', array(
	'label'    => esc_html__( 'H3 as Subtitle', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_gamma_3rd]',
	'input_attrs' => array(
		'selector' => '.g1-gamma-3rd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_gamma_3rd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// delta.
$wp_customize->add_setting( $bimber_option_name . '[typo_delta]', array(
	'default'           => $bimber_customizer_defaults['typo_delta'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_delta', array(
	'label'    => esc_html__( 'H4 Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_delta]',
	'input_attrs' => array(
		'selector' => '.g1-delta',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_delta',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// delta-2nd.
$wp_customize->add_setting( $bimber_option_name . '[typo_delta_2nd]', array(
	'default'           => $bimber_customizer_defaults['typo_delta_2nd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_delta_2nd', array(
	'label'    => esc_html__( 'H4 as Section Title', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_delta_2nd]',
	'input_attrs' => array(
		'selector' => '.g1-delta-2nd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_delta_2nd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// delta-3rd.
$wp_customize->add_setting( $bimber_option_name . '[typo_delta_3rd]', array(
	'default'           => $bimber_customizer_defaults['typo_delta_3rd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_delta_3rd', array(
	'label'    => esc_html__( 'H4 as Subtitle', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_delta_3rd]',
	'input_attrs' => array(
		'selector' => '.g1-delta-3rd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_delta_3rd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// epsilon.
$wp_customize->add_setting( $bimber_option_name . '[typo_epsilon]', array(
	'default'           => $bimber_customizer_defaults['typo_epsilon'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_epsilon', array(
	'label'    => esc_html__( 'H5 Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_epsilon]',
	'input_attrs' => array(
		'selector' => '.g1-epsilon',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_epsilon',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// epsilon-2nd.
$wp_customize->add_setting( $bimber_option_name . '[typo_epsilon_2nd]', array(
	'default'           => $bimber_customizer_defaults['typo_epsilon_2nd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_epsilon_2nd', array(
	'label'    => esc_html__( 'H5 as Section Title', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_epsilon_2nd]',
	'input_attrs' => array(
		'selector' => '.g1-epsilon-2nd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_epsilon_2nd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// epsilon-3rd.
$wp_customize->add_setting( $bimber_option_name . '[typo_epsilon_3rd]', array(
	'default'           => $bimber_customizer_defaults['typo_epsilon_3rd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_epsilon_3rd', array(
	'label'    => esc_html__( 'H5 as Subtitle', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_epsilon_3rd]',
	'input_attrs' => array(
		'selector' => '.g1-epsilon-3rd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_epsilon_3rd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),

) ) );

// zeta.
$wp_customize->add_setting( $bimber_option_name . '[typo_zeta]', array(
	'default'           => $bimber_customizer_defaults['typo_zeta'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_zeta', array(
	'label'    => esc_html__( 'H6 Heading', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_zeta]',
	'input_attrs' => array(
		'selector' => '.g1-zeta',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_zeta',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// zeta-2nd.
$wp_customize->add_setting( $bimber_option_name . '[typo_zeta_2nd]', array(
	'default'           => $bimber_customizer_defaults['typo_zeta_2nd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_zeta_2nd', array(
	'label'    => esc_html__( 'H6 as Section Title', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_zeta_2nd]',
	'input_attrs' => array(
		'selector' => '.g1-zeta-2nd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_zeta_2nd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),
) ) );

// zeta-3rd.
$wp_customize->add_setting( $bimber_option_name . '[typo_zeta_3rd]', array(
	'default'           => $bimber_customizer_defaults['typo_zeta_3rd'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Typography_Control( $wp_customize, 'bimber_typo_zeta_3rd', array(
	'label'    => esc_html__( 'H6 as Subtitle', 'bimber' ),
	'section'  => 'bimber_design_typo_section',
	'settings' => $bimber_option_name . '[typo_zeta_3rd]',
	'input_attrs' => array(
		'selector' => '.g1-zeta-3rd',
		'attributes' => array( 'font-family', 'font-style', 'font-size','line-height','letter-spacing','text-transform', 'font-size-tablet','line-height-tablet', 'font-size-mobile','line-height-mobile' ),
		'setting'	=> 'typo_zeta_3rd',
		'attribute_args'	=> array(
			'font-size' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-tablet' => array(
				'min' => 11,
				'max' => 60,
			),
			'font-size-mobile' => array(
				'min' => 11,
				'max' => 60,
			),
		),
	),

) ) );
