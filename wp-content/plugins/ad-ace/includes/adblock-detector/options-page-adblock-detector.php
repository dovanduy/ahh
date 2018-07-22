<?php
/**
 * Options Page for Sponsors
 *
 * @package AdAce
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_filter( 'adace_options_tabs', 'adblock_detector_add_options_tab' );
/**
 * Add Options Tab
 */
function adblock_detector_add_options_tab( $tabs = array() ) {
	$tabs['adace_adblock_detector'] = array(
		'path'     => add_query_arg( array(
			'page' => adace_options_page_slug(),
			'tab'  => 'adace_adblock_detector',
		), '' ),
		'label'    => esc_html__( 'Adblock Detector', 'adace' ),
		'settings' => 'adblock_detector_options',
	);
	return $tabs;
}

add_action( 'admin_menu', 'adace_add_adblock_detector_options_sections_and_fields' );
/**
 * Add options page sections, fields and options.
 */
function adace_add_adblock_detector_options_sections_and_fields() {
	// Add setting section.
	add_settings_section(
		'adace_adblock_detector', // Section id.
		'', // Section title.
		'', // Section renderer callback with args pass.
		'adace_adblock_detector' // Page.
	);
	// Add setting field.
	add_settings_field(
		'adace_adblock_detector_enabled', // Field ID.
		esc_html( 'Enable ', 'adace' ), // Field title.
		'adace_options_adblock_detector_fields_renderer_callback', // Callback.
		'adace_adblock_detector', // Page.
		'adace_adblock_detector', // Section.
		array(
			'field_for' => 'adace_adblock_detector_enabled',
		) // Data for callback.
	);
	// Register setting.
	register_setting(
		'adace_adblock_detector', // Option group.
		'adace_adblock_detector_enabled', // Option name.
		'adace_adblock_detector_options_save_validator' // Options saving validator.
	);
}

/**
 * Options fields renderer.
 *
 * @param array $args Field arguments.
 */
function adace_options_adblock_detector_fields_renderer_callback( $args ) {
	// Action to render outside fields. For example other plugins supported fields.
	do_action( 'adace_options_sponsor_field_renderer_action', $args );
	// Switch field.
	switch ( $args['field_for'] ) {
		case 'adace_adblock_detector_enabled':
			$option = get_option( $args['field_for'], adace_options_get_defaults( $args['field_for'] ) );
		?>
		<select id="<?php echo( esc_html( $args['field_for'] ) ); ?>" name="<?php echo( esc_html( $args['field_for'] ) ); ?>">
			<option value="standard" <?php selected( $option, 'standard' ); ?>><?php esc_html_e( 'Enabled', 'adace' ); ?></option>
			<option value="none" <?php selected( $option, 'none' ); ?>><?php esc_html_e( 'Disabled', 'adace' ); ?></option>
		</select>
		<?php
		break;
	}
}

/**
 * Options validator.
 *
 * @param array $input Saved options.
 * @return array Sanitised options for save.
 */
function adace_adblock_detector_options_save_validator( $input ) {
	// Return.
	return apply_filters(
		'adace_adblock_detector_options_save_validator_filter',
		filter_var( $input, FILTER_SANITIZE_STRING )
	);
}
