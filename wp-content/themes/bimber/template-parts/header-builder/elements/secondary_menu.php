<?php
/**
 * Header Builder template
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
?>
<?php
	if ( has_nav_menu( 'bimber_secondary_nav' ) ) :
		add_filter( 'nav_menu_css_class' , 'bimber_add_class_to_secondary_menu_items' , 10, 2 );
		wp_nav_menu( array(
			'theme_location'  => 'bimber_secondary_nav',
			'container'       => 'nav',
			'container_class' => 'g1-secondary-nav',
			'container_id'    => 'g1-secondary-nav',
			'menu_class'      => 'g1-secondary-nav-menu',
			'menu_id'         => 'g1-secondary-nav-menu',
			'depth'           => 0,
		) );
		remove_filter( 'nav_menu_css_class' , 'bimber_add_class_to_secondary_menu_items' , 10, 2 );
	endif;
?>
