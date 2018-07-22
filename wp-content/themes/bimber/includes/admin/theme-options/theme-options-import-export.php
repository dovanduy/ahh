<?php
/**
 * Theme options "Import/Export" section
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


$section_id = 'g1ui-settings-section-import-export';

add_settings_section(
	$section_id,                        // ID used to identify this section and with which to register options.
	esc_html__( 'Import demo data', 'bimber' ),        // Title to be displayed on the administration page.
	'bimber_render_import_demo_response',
	$this->get_page()                   // Page on which to add this section of options.
);

add_settings_field(
	'import_demo',
	esc_html__( 'Demo style', 'bimber' ),
	'bimber_render_choose_demo_select',
	$this->get_page(),
	$section_id
);

// Section fields.
add_settings_field(
	'import_demo_content',
	esc_html__( 'Content', 'bimber' ),
	'bimber_render_import_demo_content_button',
	$this->get_page(),
	$section_id
);

add_settings_field(
	'import_demo_theme_options',
	esc_html__( 'Theme options', 'bimber' ),
	'bimber_render_import_demo_theme_options_button',
	$this->get_page(),
	$section_id
);

add_settings_field(
	'import_demo_all',
	esc_html__( 'Content + Theme options', 'bimber' ),
	'bimber_render_import_demo_all_button',
	$this->get_page(),
	$section_id
);

add_settings_field(
	'import_theme_options_label',
	'<h3>' . esc_html__( 'Import theme options', 'bimber' ) . '</h3>',
	array( $this, 'render_empty_field' ),
	$this->get_page(),
	$section_id
);

add_settings_field(
	'import_theme_options',
	esc_html__( 'Load from file', 'bimber' ),
	'bimber_render_import_theme_options_form',
	$this->get_page(),
	$section_id
);

add_settings_field(
	'export_theme_options_label',
	'<h3>' . esc_html__( 'Export theme options', 'bimber' ) . '</h3>',
	array( $this, 'render_empty_field' ),
	$this->get_page(),
	$section_id
);

add_settings_field(
	'export_theme_options',
	esc_html__( 'Export to file', 'bimber' ),
	'bimber_render_export_theme_options_button',
	$this->get_page(),
	$section_id
);

/**
 * Render control to select demo
 */
function bimber_render_choose_demo_select() {
	?>
	<select id="bimber-choose-demo">
		<option value="original"><?php esc_html_e( 'Original', 'bimber' ); ?></option>
		<option value="celebrities"><?php esc_html_e( 'Celebrities', 'bimber' ); ?></option>
		<option value="smiley"><?php esc_html_e( 'Smiley', 'bimber' ); ?></option>
		<option value="badboy"><?php esc_html_e( 'Bad Boy', 'bimber' ); ?></option>
		<option value="gagster"><?php esc_html_e( 'Gagster', 'bimber' ); ?></option>
	</select>
	<?php
}

/**
 * Render button to import demo content
 */
function bimber_render_import_demo_content_button() {
	?>
	<p>
		<a class="bimber-import-demo-data-link button" href="<?php echo esc_url( bimber_get_import_demo_content_url( 'original' ) ); ?>"><?php esc_html_e( 'Import', 'bimber' ); ?></a>
		<?php esc_html_e( 'Posts, pages and images.', 'bimber' ); ?>
	</p>
	<?php
}

/**
 * Render button to import theme options
 */
function bimber_render_import_demo_theme_options_button() {
	?>
	<p>
		<a class="bimber-import-demo-data-link button" href="<?php echo esc_url( bimber_get_import_demo_theme_options_url( 'original' ) ); ?>"><?php esc_html_e( 'Import', 'bimber' ); ?></a>
		<?php esc_html_e( 'Be aware this will override all your options in Appearance > Customize panal.', 'bimber' ); ?>
	</p>
	<?php
}

/**
 * Render button to import demo content and theme options
 */
function bimber_render_import_demo_all_button() {
	?>
	<a class="bimber-import-demo-data-link button"
	   href="<?php echo esc_url( bimber_get_import_demo_all_url( 'original' ) ); ?>"><?php esc_html_e( 'Import', 'bimber' ); ?></a>
	<?php
}

/**
 * Render form to import theme options
 */
function bimber_render_import_theme_options_form() {
	?>
	<input type="file" name="g1_theme_options_file"/>
	<input type="submit" class="button button-secondary" id="g1-import-theme-options" name="g1_import_theme_options"
	       value="<?php esc_html_e( 'Import', 'bimber' ); ?>"/>
	<?php
	$status_ok = get_transient( 'bimber_import_theme_options_status_ok' );

	if ( false !== $status_ok ) {
		delete_transient( 'bimber_import_theme_options_status_ok' );

		echo '<span class="g1-import-status g1-import-status-ok">' . wp_kses_post( $status_ok ) . '</span>';
	}
}

/**
 * Render button to export theme options
 */
function bimber_render_export_theme_options_button() {
	?>
	<a class="button"
	   href="<?php echo esc_url( admin_url( 'themes.php?page=theme-options&export=theme-options' ) ); ?>"><?php esc_html_e( 'Export', 'bimber' ); ?></a>
	<?php
}

