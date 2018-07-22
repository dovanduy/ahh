<?php
/**
 * Theme options "Welcome" section (demo data installation step)
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

$section_id = 'g1ui-settings-section-demos';

add_settings_section(
	$section_id,                        // ID used to identify this section and with which to register options.
	'',        // Title to be displayed on the administration page.
	null,
	$this->get_page()                   // Page on which to add this section of options.
);

add_settings_field(
	'theme_dashboard_welcome',
	'',
	'bimber_render_theme_dashborad_welcome_section',
	$this->get_page(),
	$section_id
);

/**
 * Render dashboard welcome section
 */
function bimber_render_theme_dashborad_welcome_section() {
	$plugins = bimber_get_theme_plugins_config();

	$nonce = wp_create_nonce( 'bimber-change-mode-ajax-nonce' );

	/**
	 * Automatic plugin installation and activation library
	 *
	 * @var TGM_Plugin_Activation $tgmpa
	 */
	global $tgmpa;

	// Set flag to remove importer after finishing (if it was not installed before).
	if ( ! $tgmpa->is_plugin_installed( 'wordpress-importer' ) ) {
		// Set only once.
		if ( false === get_transient( 'bimber_wp_importer_not_installed' ) ) {
			set_transient( 'bimber_wp_importer_not_installed', true );
		}
	}
	?>
	</td></tr>
	<tr>
	<td colspan="2" style="padding-left: 0;">

	<div style="margin-top: -3em;"></div>

	<?php if ( ! bimber_is_theme_registered() ): ?>

		<div class="bimber-error-message">

			<h1><?php esc_html_e( 'You have to register Bimber to import demos', 'bimber' ); ?></h1>

			<p>
				<?php echo sprintf( __( 'Please visit the <a href="%s">Registration</a> section and follow activation steps to import all demos.', 'bimber' ), esc_url( admin_url( 'themes.php?page=theme-options&group=registration' ) ) ); ?>
			</p>

		</div>

		<?php return; ?>

	<?php endif; ?>

	<div class="about-wrap">
		<h1><?php esc_html_e( 'Choose your demo', 'bimber' ); ?></h1>
		<br />

		<?php bimber_render_import_demo_response(); ?>

		<?php
		$plugins_to_install = array();

		foreach ( $plugins as $plugin ) {
			// Skip if plugin already intalled and activated.
			if ( $tgmpa->is_plugin_active( $plugin['slug'] ) ) {
				continue;
			}

			$action = 'install';

			// Display the 'Install' action link if the plugin is not yet available.
			if ( ! $tgmpa->is_plugin_installed( $plugin['slug'] ) ) {
				$action = 'install';
			} else {
				// Display the 'Update' action link if an update is available and WP complies with plugin minimum.
				if ( false !== $tgmpa->does_plugin_have_update( $plugin['slug'] ) && $tgmpa->can_plugin_update( $plugin['slug'] ) ) {
					$action = 'update';
				}

				// Display the 'Activate' action link, but only if the plugin meets the minimum version.
				if ( $tgmpa->can_plugin_activate( $plugin['slug'] ) ) {
					$action = 'activate';
				}
			}

			$plugins_to_install[] = array(
				'slug'        => $plugin['slug'],
				'name'        => str_replace( 'G1 ', '', $plugin['name'] ),
				'description' => isset( $plugin['description'] ) ? $plugin['description'] : '',
				'install_url' => esc_url(
					wp_nonce_url(
						add_query_arg(
							array(
								'plugin'           => urlencode( $plugin['slug'] ),
								'tgmpa-' . $action => $action . '-plugin',
							),
							$tgmpa->get_tgmpa_url()
						),
						'tgmpa-' . $action,
						'tgmpa-nonce'
					)
				),
			);
		}
		?>

		<div class="g1ui-demicons">
			<?php
			$bimber_demos = bimber_get_demos();
			$bimber_installed_demo = get_option( 'bimber_demo_installed' );
			?>

			<?php foreach ( $bimber_demos as $demo_id => $demo_config ) : ?>
				<?php
				$classes = array(
					'g1ui-plugicon',
					'g1ui-plugicon-' . $demo_id,
				);

				if ( $bimber_installed_demo === $demo_id ) {
					$classes[] = 'g1ui-demo-installed';
				}
				?>

				<div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $classes ) ); ?>" data-g1-demo-id="<?php echo esc_attr( $demo_id ); ?>">
					<span class="g1ui-plugicon-icon"></span>
					<strong class="g1ui-plugicon-title"><?php echo esc_html( $demo_config['name'] ); ?></strong>
					<img src="<?php echo esc_url( $demo_config['preview_img'] ); ?>" alt="" />
					<span class="g1ui-plugicon-desc"><?php echo esc_html( $demo_config['description'] ); ?></span>


					<div class="g1ui-plugicon-notice g1ui-plugicon-notice-installed">
						<?php esc_html_e( 'Installed', 'bimber' ); ?>
					</div>


					<div class="g1ui-plugicon-actions">
						<div class="g1ui-progress">
							<div class="g1ui-progress-bar"></div>
						</div>

						<a href="<?php echo esc_url( bimber_get_import_demo_theme_options_url( $demo_id ) ); ?>" class="g1ui-plugicon-action-install action g1-install-demo-data button button-primary"><?php esc_html_e( 'Install', 'bimber' ); ?></a>
						<label class="g1ui-plugicon-checkbox-wrapper action">
							<input type="checkbox" class="g1-install-with-content" checked="checked" />
							<span class="g1-install-all"><?php esc_html_e( 'All data', 'bimber' ); ?></span>
							<span class="g1-install-only-options"><?php esc_html_e( 'Only options', 'bimber' ); ?></span>
						</label>
						<a href="<?php echo esc_url( $demo_config['preview_url'] ); ?>" target="_blank" class="g1ui-plugicon-action-preview action button button-secondary"><?php esc_html_e( 'Preview', 'bimber' ); ?></a>
					</div>

				</div>

			<?php endforeach; ?>
		</div>

		<?php if ( ! empty( $plugins_to_install ) ) : ?>
			<div class="g1ui-plugicons">
				<?php 
				$excluded_plugins = array( 'woocommerce', 'wp-gdpr-compliance' );
				foreach ( $plugins_to_install as $plugin ) : ?>
					<?php $checked = ( in_array( $plugin['slug'], $excluded_plugins, true ) ) ? false : true; ?>
					<div
						class="g1ui-plugicon g1ui-plugicon-<?php echo sanitize_html_class( $plugin['slug'] ); ?> g1ui-plugicon-<?php echo sanitize_html_class( $checked ? 'checked' : 'unchecked' ); ?>">
						<span class="g1ui-plugicon-icon"></span>
						<span class="g1ui-plugicon-title"><?php echo esc_html( $plugin['name'] ); ?></span>
						<span class="g1ui-plugicon-desc"><?php echo esc_html( $plugin['description'] ); ?></span>

						<div class="g1ui-plugicon-bar">
							<input 	type="checkbox" class="g1-plugin-to-install g1ui-plugicon-checkbox"
								   	name="<?php echo esc_attr( $plugin['slug'] ); ?>"
								   	data-g1-install-url="<?php echo esc_url( $plugin['install_url'] ); ?>"
									<?php echo esc_attr( $checked ? 'checked="checked"' : '' ); ?>/>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div id="g1-demo-import-log"></div>

		<input type="hidden" id="g1-change-mode-ajax-nonce" value="<?php echo esc_attr( $nonce ); ?>"/>
		<input type="hidden" id="g1-upload-demo-images-start" value="<?php echo esc_url( admin_url( 'admin.php?action=bimber_import_demo_images_start&import=bimber' ) ); ?>"/>
		<input type="hidden" id="g1-upload-demo-image" value="<?php echo esc_url( admin_url( 'admin.php?action=bimber_import_demo_image&import=bimber' ) ); ?>"/>
		<input type="hidden" id="g1-upload-demo-images-end" value="<?php echo esc_url( admin_url( 'admin.php?action=bimber_import_demo_images_end&import=bimber' ) ); ?>"/>
	</div>
	<?php
}

/**
 * Render response after import demo data
 */
function bimber_render_import_demo_response() {
	$import_response = get_transient( 'bimber_import_demo_response' );

	if ( false !== $import_response ) {
		delete_transient( 'bimber_import_demo_response' );

		$response_status_class = 'success' === $import_response['status'] ? 'notice' : 'error';
		?>
		<div class="updated is-dismissible <?php echo sanitize_html_class( $response_status_class ); ?>">
			<p>
				<strong><?php echo wp_kses_post( $import_response['message'] ); ?></strong><br/>
			</p>
			<button type="button" class="notice-dismiss"><span
					class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'bimber' ); ?></span></button>
		</div>
		<?php
	}
}
