<?php
/**
 * Theme options "Logs" section
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


$section_id = 'g1ui-settings-section-tasks';

add_settings_section(
	$section_id,                        // ID used to identify this section and with which to register options.
	null,                               // Title to be displayed on the administration page.
	'bimber_render_tasks_description',
	$this->get_page()                   // Page on which to add this section of options.
);

// Section fields.
add_settings_field(
	'task_popular_list',
	'Update Popular list',
	'bimber_render_task_popular_list',
	$this->get_page(),
	$section_id
);

add_settings_field(
	'task_hot_list',
	'Update Hot list',
	'bimber_render_task_hot_list',
	$this->get_page(),
	$section_id
);

add_settings_field(
	'task_trending_list',
	'Update Trending list',
	'bimber_render_task_trending_list',
	$this->get_page(),
	$section_id
);

if ( bimber_can_use_plugin( 'mycred/mycred.php' ) ) {
	add_settings_field(
		'task_import_mycred',
		'Import myCRED content',
		'bimber_render_task_import_mycred',
		$this->get_page(),
		$section_id
	);
}

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	if ( bimber_can_use_plugin( 'mycred/mycred.php' ) ) {
		add_settings_field(
			'task_reset_mycred',
			'Reset MyCred',
			'bimber_render_task_reset_mycred',
			$this->get_page(),
			$section_id
		);
	}
}

/**
 * Render Popular list section
 */
function bimber_render_task_popular_list() {
	?>
	<p>
		<a class="button" href="<?php echo esc_url( wp_nonce_url( admin_url( 'themes.php?page=theme-options&group=tasks&action=run-task&task=bimber_update_popular_posts' ), 'bimber-task' ) ); ?>"><?php esc_html_e( 'Run now', 'bimber' ); ?></a>
	</p>
	<?php
}

/**
 * Render Hot list section
 */
function bimber_render_task_hot_list() {
	?>
	<p>
		<a class="button" href="<?php echo esc_url( wp_nonce_url( admin_url( 'themes.php?page=theme-options&group=tasks&action=run-task&task=bimber_update_hot_posts' ), 'bimber-task' ) ); ?>"><?php esc_html_e( 'Run now', 'bimber' ); ?></a>
	</p>
	<?php
}

/**
 * Render Trending list section
 */
function bimber_render_task_trending_list() {
	?>
	<p>
		<a class="button" href="<?php echo esc_url( wp_nonce_url( admin_url( 'themes.php?page=theme-options&group=tasks&action=run-task&task=bimber_update_trending_posts' ), 'bimber-task' ) ); ?>"><?php esc_html_e( 'Run now', 'bimber' ); ?></a>
	</p>
	<?php
}

/**
 * Render import MyCred
 */
function bimber_render_task_import_mycred() {
	?>
	<div class="import-mycred-modules">
		<fieldset>
			<h4><?php _e( 'Integrations', 'bimber' ); ?></h4>
			<?php do_action( 'bimber_mycred_display_import_packages' );?>
		</fieldset>
	</div>
	<hr />
	<div class="import-mycred-parts">
		<fieldset>
			<h4><?php _e( 'myCRED elements', 'bimber' ); ?></h4>
			<label>
				<input name="import_mycred_settings[hooks]" id="import_mycred_hooks" type="checkbox" value="import_mycred_hooks" checked />
				<?php _e( 'Hooks', 'bimber' ); ?>
			</label>
			<br />

			<label>
				<input name="import_mycred_settings[badges]" id="import_mycred_badges" type="checkbox" value="import_mycred_badges"
				<?php disabled( bimber_mycred_is_addon_enabled( 'badges' ), false )?>
				<?php checked( bimber_mycred_is_addon_enabled( 'badges' ), true )?> />
				<?php _e( 'Badges', 'bimber' ); ?>
				<?php if ( ! bimber_mycred_is_addon_enabled( 'badges' ) ) :?>
					<span class="description">Please go to <strong>Points->Addons</strong> to activate Badges.</span>
				<?php endif;?>
			</label>
			<br />

			<label>
				<input name="import_mycred_settings[ranks]" id="import_mycred_ranks" type="checkbox" value="import_mycred_ranks"
				<?php disabled( bimber_mycred_is_addon_enabled( 'ranks' ), false )?>
				<?php checked( bimber_mycred_is_addon_enabled( 'badges' ), true )?>
				/>
				<?php _e( 'Ranks', 'bimber' ); ?>
				<?php if ( ! bimber_mycred_is_addon_enabled( 'ranks' ) ) :?>
					<span class="description">Please go to <strong>Points->Addons</strong> to activate Ranks.</span>
				<?php endif;?>
			</label>
		</fieldset>
	</div>
	<p>
		<?php wp_nonce_field( 'bimber_mycred_import_nonce', 'bimber_mycred_import_nonce' );?>
		<a class="button bimber-import-mycred-button-import" href="<?php echo esc_url( get_home_url() ); ?>/"><?php esc_html_e( 'Import', 'bimber' ); ?></a>
		<div class="bimber-import-mycred-result"></div>
	</p>
	<?php
}

/**
 * Render import MyCred
 */
function bimber_render_task_reset_mycred() {
	?>
	<p>
	<?php wp_nonce_field( 'bimber_mycred_import_nonce_reset', 'bimber_mycred_import_nonce_reset' );?>
		<a class="button bimber-import-mycred-button-reset" href="<?php echo esc_url( get_home_url() ); ?>/?import_mycred=reset"><?php esc_html_e( 'Remove', 'bimber' ); ?></a>
	</p>
	<?php
}

/**
 * Render logs section description
 */
function bimber_render_tasks_description() {
	?>
	<h3><?php esc_html_e( 'Tasks', 'bimber' ); ?></h3>
	<?php
	$executed = get_transient( 'bimber_task_executed' );

	if ( false !== $executed ) {
		delete_transient( 'bimber_task_executed' );

		?>
		<div id="message" class="updated notice is-dismissible">
			<p><?php echo $executed; ?></p>
		</div>
		<?php
	}
}