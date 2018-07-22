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

$section_id = 'g1ui-settings-section-registration';

add_settings_section(
	$section_id,                        // ID used to identify this section and with which to register options.
	'',        // Title to be displayed on the administration page.
	null,
	$this->get_page()                   // Page on which to add this section of options.
);

add_settings_field(
	'theme_registration',
	'',
	'bimber_render_theme_registration_section',
	$this->get_page(),
	$section_id
);

/**
 * Render section
 */
function bimber_render_theme_registration_section() {
	/**
	 * Automatic plugin installation and activation library
	 *
	 * @var TGM_Plugin_Activation $tgmpa
	 */
	global $tgmpa;

	$action = '';
	$install_envato_market_plugin = '';

	if ( ! $tgmpa->is_plugin_active( 'envato-market' ) ) {
		if ( ! $tgmpa->is_plugin_installed( 'envato-market' ) ) {
			$action = 'install';
		} else if ( $tgmpa->can_plugin_activate( 'envato-market' ) ) {
			$action = 'activate';
		}

		$install_envato_market_plugin =
		wp_nonce_url(
			add_query_arg(
				array(
					'plugin'           => urlencode( 'envato-market' ),
					'tgmpa-' . $action => $action . '-plugin',
				),
				$tgmpa->get_tgmpa_url()
			),
			'tgmpa-' . $action,
			'tgmpa-nonce'
		);
	}
	?>
	</td></tr>
	<tr>
	<td colspan="2" style="padding-left: 0;">

	<div style="margin-top: -3em;"></div>

	<div class="about-wrap">
		<h1><?php esc_html_e( 'Register your theme', 'bimber' ); ?></h1>
		<br />

		<p>
			<?php esc_html_e( 'The Bimber theme must be registered to get full access to all demos and auto updates.', 'bimber' ); ?>
		</p>

		<h3><?php esc_html_e( 'Registration steps', 'bimber' ); ?></h3>

		<ol>
			<?php if ( $install_envato_market_plugin ) : ?>
			<li>
				<span class="envato-market-not-activated">
				<?php if ( 'install' === $action ) : ?>
					<?php printf( __( '<a href="%s" class="g1-install-envato-market">Install the Envato Market</a> plugin.', 'bimber' ), $install_envato_market_plugin ); ?>
				<?php else : ?>
					<?php printf( __( '<a href="%s" class="g1-install-envato-market">Activate the Envato Market</a> plugin.', 'bimber' ), $install_envato_market_plugin ); ?>
				<?php endif; ?>
				</span>
				<span class="envato-market-installing" style="display: none;">
					<?php esc_html_e( 'Installing the Envato Market plugin...', 'bimber' ); ?>
				</span>
				<span class="envato-market-activated" style="display: none;">
					<?php esc_html_e( 'The Envato Market plugin ready to use. Go to next step.', 'bimber' ); ?>
				</span>
				<span class="envato-market-installation-failed" style="display: none;">
					<?php esc_html_e( 'The Envato Market plugin installation failed.', 'bimber' ); ?>
					<?php printf( __( '<a href="%s" target="_blank">See details</a>.', 'bimber' ), $install_envato_market_plugin ) ?>
				</span>
			</li>
			<?php endif; ?>
			<li>
				<?php echo sprintf( __( 'Click on this <a href="%s" target="_blank">Create a token</a> link. You must be logged into the ThemeForest account used to purchase Bimber.', 'bimber' ), esc_url( 'https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t' ) ); ?>
			</li>
			<li>
				<?php esc_html_e( 'Enter a token name, leave default permissions selected, agree to the Terms and Conditions and click the Create Token button.', 'bimber' ); ?>
			</li>
			<li>
				<?php echo sprintf( __( 'Insert the token on the <a href="%s" target="_blank">Settings &rsaquo; Global OAuth Personal Token</a> page.', 'bimber' ), esc_url( admin_url( '/admin.php?page=envato-market' ) ) ); ?>
			</li>
			<li>
				<?php esc_html_e( 'After successful token verification, reload this page. The Registration section should disappear, the Demos section should be unlocked.', 'bimber' ); ?>
			</li>
		</ol>
	</div>
	<?php
}
