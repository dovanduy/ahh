<?php

/**
 * Declare AHH frontend custom hook and function
 */
class FrontEndHooks
{
	/**
	 * Constructor
	 * 
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'ahh_init') );
	}

	/**
	 * Function to init
	 * 
	 * @return void
	 */
	function ahh_init() {
		// Hook to add css + js
		add_action( 'wp_enqueue_scripts', array( $this, 'ahh_adding_styles_scripts'), 10 );

		// Hook to add external fonts
		add_action( 'wp_head', array( $this, 'ahh_adding_fonts'), 10 );
	}

	/**
	 * Function to add css + js files
	 * @return [type] [description]
	 */
	function ahh_adding_styles_scripts() {
		wp_register_style('ahh_general_css', AHH_CSS_URI . 'general.min.css');
		wp_register_style('ahh_mobile_css', AHH_CSS_URI . 'mobile.min.css');
		
		wp_enqueue_style('ahh_general_css');
		wp_enqueue_style('ahh_mobile_css');
	}

	/**
	 * Function to add external fonts
	 * @return [type] [description]
	 */
	function ahh_adding_fonts() {
		?>
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<?php
	}
}
new FrontEndHooks();