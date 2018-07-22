<?php
/**
 * Snax Settings Navigation
 *
 * @package snax
 * @subpackage Settings
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Highlight the Settings > Snax main menu item regardless of which actual tab we are on.
 */
function snax_admin_settings_menu_highlight() {
	global $plugin_page, $submenu_file;

	if ( in_array( $plugin_page, array( 'snax-general-settings', 'snax-lists-settings', 'snax-pages-settings', 'snax-voting-settings', 'snax-auth-settings', 'snax-demo-settings' ), true ) ) {
		// We want to map all subpages to one settings page (in main menu).
		$submenu_file = 'snax-general-settings';
	}
}

/**
 * Get tabs in the admin settings area.
 *
 * @param string $active_tab        Name of the tab that is active. Optional.
 *
 * @return string
 */
function snax_get_admin_settings_tabs( $active_tab = '' ) {
	$tabs = array(
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-general-settings' ), 'admin.php' ) ),
			'name' => __( 'General', 'snax' ),
		),
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-pages-settings' ), 'admin.php' ) ),
			'name' => __( 'Pages', 'snax' ),
		),
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-lists-settings' ), 'admin.php' ) ),
			'name' => __( 'Lists', 'snax' ),
		),
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-voting-settings' ), 'admin.php' ) ),
			'name' => __( 'Voting', 'snax' ),
		),
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-limits-settings' ), 'admin.php' ) ),
			'name' => __( 'Limits', 'snax' ),
		),
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-auth-settings' ), 'admin.php' ) ),
			'name' => __( 'Auth', 'snax' ),
		),
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-embedly-settings' ), 'admin.php' ) ),
			'name' => __( 'Embedly', 'snax' ),
		),
		array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-demo-settings' ), 'admin.php' ) ),
			'name' => __( 'Demo', 'snax' ),
		),
	);
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$tabs[7] = array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-memes-settings' ), 'admin.php' ) ),
			'name' => __( 'Memes', 'snax' ),
		);
		$tabs[8] = array(
			'href' => snax_admin_url( add_query_arg( array( 'page' => 'snax-demo-settings' ), 'admin.php' ) ),
			'name' => __( 'Demo', 'snax' ),
		);
	}

	return apply_filters( 'snax_get_admin_settings_tabs', $tabs, $active_tab );
}

/**
 * Output the tabs in the admin area.
 *
 * @param string $active_tab        Name of the tab that is active. Optional.
 */
function snax_admin_settings_tabs( $active_tab = '' ) {
	$tabs_html    = '';
	$idle_class   = 'nav-tab';
	$active_class = 'nav-tab nav-tab-active';

	/**
	 * Filters the admin tabs to be displayed.
	 *
	 * @param array $value      Array of tabs to output to the admin area.
	 */
	$tabs = apply_filters( 'snax_admin_settings_tabs', snax_get_admin_settings_tabs( $active_tab ) );

	// Loop through tabs and build navigation.
	foreach ( array_values( $tabs ) as $tab_data ) {
		$is_current = (bool) ( $tab_data['name'] === $active_tab );
		$tab_class  = $is_current ? $active_class : $idle_class;
		$tabs_html .= '<a href="' . esc_url( $tab_data['href'] ) . '" class="' . esc_attr( $tab_class ) . '">' . esc_html( $tab_data['name'] ) . '</a>';
	}

	echo filter_var( $tabs_html );

	do_action( 'snax_admin_tabs' );
}
