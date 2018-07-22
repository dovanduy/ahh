<?php
/**
 * Snax Settings Template Tags
 *
 * @package snax
 * @subpackage Settings
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}


/** Settings ************************************************************ */


/**
 * Settings > General
 */
function snax_admin_general_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ) ?></h1>
		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'General', 'snax' ) ); ?></h2>

		<form action="options.php" method="post">

			<?php settings_fields( 'snax-general-settings' ); ?>
			<?php do_settings_sections( 'snax-general-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>
		</form>
	</div>

<?php
}

/**
 * Settings > Lists
 */
function snax_admin_lists_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ) ?></h1>
		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Lists', 'snax' ) ); ?></h2>

		<form action="options.php" method="post">

			<?php settings_fields( 'snax-lists-settings' ); ?>
			<?php do_settings_sections( 'snax-lists-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>
		</form>
	</div>

	<?php
}

/**
 * Settings > Pages
 */
function snax_admin_pages_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ); ?> </h1>

		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Pages', 'snax' ) ); ?></h2>
		<form action="options.php" method="post">

			<?php settings_fields( 'snax-pages-settings' ); ?>
			<?php do_settings_sections( 'snax-pages-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>

		</form>
	</div>

	<?php
}

/**
 * Settings > Voting
 */
function snax_admin_voting_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ); ?> </h1>

		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Voting', 'snax' ) ); ?></h2>
		<form action="options.php" method="post">

			<?php settings_fields( 'snax-voting-settings' ); ?>
			<?php do_settings_sections( 'snax-voting-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>

		</form>
	</div>

	<?php
}

/**
 * Settings > Limits
 */
function snax_admin_limits_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ); ?> </h1>

		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Limits', 'snax' ) ); ?></h2>
		<form action="options.php" method="post">

			<?php settings_fields( 'snax-limits-settings' ); ?>
			<?php do_settings_sections( 'snax-limits-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>

		</form>
	</div>

	<?php
}

/**
 * Settings > Auth
 */
function snax_admin_auth_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ); ?> </h1>

		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Auth', 'snax' ) ); ?></h2>
		<form action="options.php" method="post">

			<?php settings_fields( 'snax-auth-settings' ); ?>
			<?php do_settings_sections( 'snax-auth-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>

		</form>
	</div>

	<?php
}

/**
 * Settings > Demo
 */
function snax_admin_demo_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ); ?> </h1>

		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Demo', 'snax' ) ); ?></h2>
		<form action="options.php" method="post">

			<?php settings_fields( 'snax-demo-settings' ); ?>
			<?php do_settings_sections( 'snax-demo-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>

		</form>
	</div>

	<?php
}

/**
 * Settings > Embedly
 */
function snax_admin_embedly_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ); ?> </h1>

		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Embedly', 'snax' ) ); ?></h2>
		<form action="options.php" method="post">

			<?php settings_fields( 'snax-embedly-settings' ); ?>
			<?php do_settings_sections( 'snax-embedly-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>

		</form>
	</div>

	<?php
}

/**
 * Settings > Embedly
 */
function snax_admin_memes_settings() {
	?>

	<div class="wrap">

		<h1><?php esc_html_e( 'Snax Settings', 'snax' ); ?> </h1>

		<h2 class="nav-tab-wrapper"><?php snax_admin_settings_tabs( __( 'Memes', 'snax' ) ); ?></h2>
		<form action="options.php" method="post">

			<?php settings_fields( 'snax-memes-settings' ); ?>
			<?php do_settings_sections( 'snax-memes-settings' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'snax' ); ?>" />
			</p>

		</form>
	</div>

	<?php
}

/** Sections ************************************************************ */

/**** Sections > General ************************************************ */

/**
 * Render general section description
 */
function snax_admin_settings_general_section_description() {}

/**
 * Formats
 */
function snax_admin_setting_callback_active_formats() {
	$formats = snax_get_formats();
	$active_formats_ids = snax_get_active_formats_ids();
	?>
	<div id="snax-settings-active-formats">
	<?php
	foreach ( $formats as $format_id => $format_args ) {
		$checkbox_id = 'snax_active_format_' . $format_id;
		?>
		<fieldset>
			<label for="<?php echo esc_attr( $checkbox_id ); ?>">
				<input name="snax_active_formats[]" id="<?php echo esc_attr( $checkbox_id ); ?>" type="checkbox" value="<?php echo esc_attr( $format_id ); ?>" <?php checked( in_array( $format_id, $active_formats_ids, true ) , true ); ?> /> <?php echo esc_html( $format_args['labels']['name'] ); ?>
			</label>
		</fieldset>
		<?php
	}
	?>
	</div>
	<input name="snax_formats_order" id="snax_formats_order" type="hidden" value="<?php echo esc_attr( implode( ',', snax_get_formats_order() ) ); ?>">
	<?php
}

/**
 * Items per page
 */
function snax_admin_setting_callback_items_per_page() {
	?>
	<input name="snax_items_per_page" id="snax_items_per_page" type="number" size="5" value="<?php echo esc_attr( snax_get_global_items_per_page() ); ?>" />
	<?php
}

/**
 * Item count in title
 */
function snax_admin_setting_callback_item_count_in_title() {
	?>
	<input name="snax_show_item_count_in_title" id="snax_show_item_count_in_title" type="checkbox" <?php checked( snax_show_item_count_in_title() ); ?> />
	<?php
}

/**
 * Upload allowed
 *
 * @param array $args           Arguments.
 */
function snax_admin_setting_callback_upload_allowed( $args ) {
	$media_type = $args['type'];

	$setting_id = 'snax_' . $media_type . '_upload_allowed';
	$is_checked = call_user_func( 'snax_is_' . $media_type . '_upload_allowed' );

	$rel_settings = array(
		'image' === $media_type ? '#snax_max_upload_size' : '#snax_' . $media_type . '_max_upload_size',
		'[name^=snax_' . $media_type . '_allowed_types]',
	);
	?>
	<input class="snax-hide-rel-settings" data-snax-rel-settings="<?php echo esc_attr( implode( ',', $rel_settings ) ); ?>" name="<?php echo esc_attr( $setting_id ); ?>" id="<?php echo esc_attr( $setting_id ); ?>" type="checkbox" <?php checked( $is_checked ); ?> value="standard" />
	<?php
}

/**
 * Max. image upload size
 *
 * @param array $args          Arguments.
 */
function snax_admin_setting_callback_upload_max_size( $args ) {
	$media_type = $args['type'];

	$bytes_1mb = 1024 * 1024;

	$max_upload_size = call_user_func( 'snax_get_' . $media_type . '_max_upload_size' );
	$limit = wp_max_upload_size();

	$choices = array(
		$bytes_1mb => '1MB',
	);

	if ( $limit > $bytes_1mb  ) {
		// Iterate each 2MB.
		for ( $i = 2 * $bytes_1mb; $i <= $limit; $i += 2 * $bytes_1mb ) {
			$choices[ $i ] = ( $i / $bytes_1mb ) . 'MB';
		}
	}

	// Max limit not included?
	if ( ! isset( $choices[ $limit ] ) ) {
		$choices[ $limit ] = ( $limit / $bytes_1mb ) . 'MB';
	}

	$choices = apply_filters( 'snax_max_upload_size_choices', $choices, $media_type );

	$setting_id = 'image' === $media_type ? 'snax_max_upload_size' : 'snax_' . $media_type . '_max_upload_size';
	?>
	<select name="<?php echo esc_attr( $setting_id ); ?>" id="<?php echo esc_attr( $setting_id ); ?>">
		<?php foreach ( $choices as $value => $label ) : ?>
		<option value="<?php echo esc_attr( $value ); ?>"<?php selected( $max_upload_size, $value ); ?>><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
	</select>
	<span><?php printf( esc_html__( 'Maximum size can be set to %dMB, which is your server\'s upload limit (set in php.ini).', 'snax' ), absint( $limit / $bytes_1mb ) ); ?></span>
	<?php
}

/**
 * Allowed upload types
 *
* @param array $args                Arguments.
 */
function snax_admin_setting_callback_upload_allowed_types( $args ) {
	$media_type = $args['type'];

	$setting_id = 'snax_' . $media_type . '_allowed_types';
	$all_types  = call_user_func( 'snax_get_all_' . $media_type . '_allowed_types' );
	$checked    = call_user_func( 'snax_get_' . $media_type . '_allowed_types' );

	foreach ( $all_types as $type ) {
		$field_id = $setting_id . '_' . $type;
		?>
		<label for="<?php echo esc_attr( $field_id ); ?>">
			<input name="<?php echo esc_attr( $setting_id ); ?>[]" id="<?php echo esc_attr( $field_id ); ?>" type="checkbox" value="<?php echo esc_attr( $type ); ?>"<?php checked( in_array( $type, $checked ) ); ?> /> <?php echo esc_html( $type ); ?>
		</label>
		<?php
	}
}

/**
 * How many new posts user can submit, per day.
 */
function snax_admin_setting_callback_new_posts_limit() {
	$limit = snax_get_user_posts_per_day();
	?>

	<select name="snax_user_posts_per_day" id="snax_user_posts_per_day">
		<option value="1" <?php selected( 1, $limit ) ?>><?php esc_html_e( 'only 1 post', 'snax' ) ?></option>
		<option value="10" <?php selected( 10, $limit ) ?>><?php esc_html_e( '10 posts', 'snax' ) ?></option>
		<option value="-1" <?php selected( -1, $limit ) ?>><?php esc_html_e( 'unlimited posts', 'snax' ) ?></option>
	</select>
	<span><?php esc_html_e( 'per day.', 'snax' ); ?></span>
	<?php
}

/**
 * How many new items user can submit to a new post (during creation).
 */
function snax_admin_setting_callback_new_post_items_limit() {
	$limit = snax_get_new_post_items_limit();
	?>

	<select name="snax_new_post_items_limit" id="snax_new_post_items_limit">
		<option value="10" <?php selected( 10, $limit ) ?>><?php esc_html_e( '10 items', 'snax' ) ?></option>
		<option value="20" <?php selected( 20, $limit ) ?>><?php esc_html_e( '20 items', 'snax' ) ?></option>
		<option value="-1" <?php selected( -1, $limit ) ?>><?php esc_html_e( 'unlimited items', 'snax' ) ?></option>
	</select>
	<span><?php esc_html_e( 'while creating a new list/gallery. Applies also to Story format images.', 'snax' ); ?></span>
	<?php
}

/**
 * Disable admin bar
 */
function snax_admin_setting_callback_disable_admin_bar() {
	?>
	<input name="snax_disable_admin_bar" id="snax_disable_admin_bar" type="checkbox" <?php checked( snax_disable_admin_bar() ); ?> />
	<?php
}

/**
 * Disable dashboard access
 */
function snax_admin_setting_callback_disable_dashboard_access() {
	?>
	<input name="snax_disable_dashboard_access" id="snax_disable_dashborad_access" type="checkbox" <?php checked( snax_disable_dashboard_access() ); ?> />
	<?php
}

/**
 * Disable WP login form
 */
function snax_admin_setting_callback_disable_wp_login() {
	?>
	<input name="snax_disable_wp_login" id="snax_disable_wp_login" type="checkbox" <?php checked( snax_disable_wp_login() ); ?> />
	<?php
}

/**
 * Whether force user to choose category or not
 */
function snax_admin_setting_callback_category_required() {
	$required = snax_is_category_required();
	?>

	<select name="snax_category_required" id="snax_category_required">
		<option value="standard" <?php selected( $required, true ) ?>><?php esc_html_e( 'required', 'snax' ) ?></option>
		<option value="none" <?php selected( $required, false ) ?>><?php esc_html_e( 'optional', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Multiple categories selection.
 */
function snax_admin_setting_callback_category_multi() {
	?>
	<input name="snax_category_multi" id="snax_category_multi" type="checkbox" <?php checked( snax_multiple_categories_selection() ); ?> />
	<?php
}

/**
 * Category white-list
 */
function snax_admin_setting_callback_category_whitelist() {
	$whitelist = snax_get_category_whitelist();
	$all_categories = get_categories( 'hide_empty=0' );
	?>
	<select size="10" name="snax_category_whitelist[]" id="snax_category_whitelist" multiple="multiple">
		<option value="" <?php selected( in_array( '', $whitelist, true ) ); ?>><?php esc_html_e( '- Allow all -', 'snax' ) ?></option>
		<?php foreach ( $all_categories as $category_obj ) : ?>
			<?php
			// Exclude the Uncategorized option.
			if ( 'uncategorized' === $category_obj->slug ) {
				continue;
			}
			?>

			<option value="<?php echo esc_attr( $category_obj->slug ); ?>" <?php selected( in_array( $category_obj->slug, $whitelist, true ) ); ?>><?php echo esc_html( $category_obj->name ) ?></option>
		<?php endforeach; ?>
	</select>
	<p class="description"><?php esc_html_e( 'Categories allowed for user while creating a new post.', 'snax' ); ?></p>
	<?php
}

/**
 * Auto assign to category.
 */
function snax_admin_setting_callback_category_auto_assign() {
	$auto_assign_list = snax_get_category_auto_assign();
	$all_categories = get_categories( 'hide_empty=0' );
	?>
	<select size="10" name="snax_category_auto_assign[]" id="snax_category_auto_assign" multiple="multiple">
		<option value="" <?php selected( in_array( '', $auto_assign_list, true ) ); ?>><?php esc_html_e( '- Not assign -', 'snax' ) ?></option>
		<?php foreach ( $all_categories as $category_obj ) : ?>
			<?php
			// Exclude the Uncategorized option.
			if ( 'uncategorized' === $category_obj->slug ) {
				continue;
			}
			?>

			<option value="<?php echo esc_attr( $category_obj->slug ); ?>" <?php selected( in_array( $category_obj->slug, $auto_assign_list, true ) ); ?>><?php echo esc_html( $category_obj->name ) ?></option>
		<?php endforeach; ?>
	</select>
	<?php
}

/**
 * Facebook App Id
 */
function snax_admin_setting_callback_facebook_app_id() {
	?>
	<input name="snax_facebook_app_id" id="snax_facebook_app_id" class="regular-text" type="number" size="5" value="<?php echo esc_attr( snax_get_facebook_app_id() ); ?>" />
	<p class="description">
	<?php echo wp_kses_post( sprintf( __( 'How do I get my <strong>App ID</strong>? Use the <a href="%s" target="_blank">Register and Configure an App</a> guide for help.', 'snax' ), esc_url( 'https://developers.facebook.com/docs/apps/register' ) ) ); ?>
	</p>
	<?php
}

/**
 * Whether to allow user direct publishing
 */
function snax_admin_setting_callback_skip_verification() {
	// The label of the option was changed to Moderate new post? from Skip verification, so "yes" and "no" were inverted in labels here.
	$skip = snax_skip_verification();
	?>

	<select name="snax_skip_verification" id="snax_skip_verification">
		<option value="standard" <?php selected( $skip, true ) ?>><?php esc_html_e( 'no', 'snax' ) ?></option>
		<option value="none" <?php selected( $skip, false ) ?>><?php esc_html_e( 'yes', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Whether to send mail to admin when new post/item was added
 */
function snax_admin_setting_callback_mail_notifications() {
	$mail = snax_mail_notifications();
	?>

	<select name="snax_mail_notifications" id="snax_mail_notifications">
		<option value="standard" <?php selected( $mail, true ) ?>><?php esc_html_e( 'yes', 'snax' ) ?></option>
		<option value="none" <?php selected( $mail, false ) ?>><?php esc_html_e( 'no', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Wheter to show "This post was created with our nice and easy submission form."
 */
function snax_admin_setting_show_origin() {
	$origin = snax_show_origin();
	?>

	<select name="snax_show_origin" id="snax_show_origin">
		<option value="standard" <?php selected( $origin, true ) ?>><?php esc_html_e( 'yes', 'snax' ) ?></option>
		<option value="none" <?php selected( $origin, false ) ?>><?php esc_html_e( 'no', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Wheter to make featured media required
 */
function snax_admin_setting_featured_media_required() {
	$featured_media_required = snax_featured_media_required();
	?>

	<select name="snax_featured_media_required" id="snax_featured_media_required">
		<option value="standard" <?php selected( $featured_media_required, true ) ?>><?php esc_html_e( 'required', 'snax' ) ?></option>
		<option value="none" <?php selected( $featured_media_required, false ) ?>><?php esc_html_e( 'optional', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Wheter to allow Froala in items
 */
function snax_admin_setting_froala_for_items() {
	$froala_for_items = snax_froala_for_items();
	?>

	<select name="snax_froala_for_items" id="snax_froala_for_items">
		<option value="standard" <?php selected( $froala_for_items, true ) ?>><?php esc_html_e( 'yes', 'snax' ) ?></option>
		<option value="none" <?php selected( $froala_for_items, false ) ?>><?php esc_html_e( 'no', 'snax' ) ?></option>
			<?php
}

/**
 * Wheter to allow snax_autor to add referral links to posts and items
 */
function snax_admin_setting_allow_snax_authors_to_add_referrals() {
	$allow_snax_authors_to_add_referrals = snax_allow_snax_authors_to_add_referrals();
	?>

	<select name="snax_allow_snax_authors_to_add_referrals" id="snax_allow_snax_authors_to_add_referrals">
		<option value="standard" <?php selected( $allow_snax_authors_to_add_referrals, true ) ?>><?php esc_html_e( 'show', 'snax' ) ?></option>
		<option value="none" <?php selected( $allow_snax_authors_to_add_referrals, false ) ?>><?php esc_html_e( 'hide', 'snax' ) ?></option>
	</select>
	<p class="description">Applies only to Snax Authors</p>
	<?php
}

/**
 * Wheter to allow comments for items
 */
function snax_admin_setting_display_comments_on_lists() {
	$display_comments_on_lists = snax_display_comments_on_lists();
	?>

	<select name="snax_display_comments_on_lists" id="snax_display_comments_on_lists">
		<option value="standard" <?php selected( $display_comments_on_lists, true ) ?>><?php esc_html_e( 'yes', 'snax' ) ?></option>
		<option value="none" <?php selected( $display_comments_on_lists, false ) ?>><?php esc_html_e( 'no', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Wheter to allow Froala in open list items
 */
function snax_admin_setting_froala_for_list_items() {
	$froala_for_list_items = snax_froala_for_list_items();
	?>

	<select name="snax_froala_for_list_items" id="snax_froala_for_list_items">
		<option value="standard" <?php selected( $froala_for_list_items, true ) ?>><?php esc_html_e( 'yes', 'snax' ) ?></option>
		<option value="none" <?php selected( $froala_for_list_items, false ) ?>><?php esc_html_e( 'no', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Formats
 */
function snax_admin_setting_callback_show_featured_images_for_formats() {
	$formats = snax_get_formats();
	$active_formats_ids = snax_show_featured_images_for_formats();
	?>
	<div id="snax-settings-show-featured-images-for-formats">
	<?php
	foreach ( $formats as $format_id => $format_args ) {
		$checkbox_id = 'snax_show_featured_images_for_' . $format_id;
		?>
		<fieldset>
			<label for="<?php echo esc_attr( $checkbox_id ); ?>">
				<input name="snax_show_featured_images_for_formats[]" id="<?php echo esc_attr( $checkbox_id ); ?>" type="checkbox" value="<?php echo esc_attr( $format_id ); ?>" <?php checked( in_array( $format_id, $active_formats_ids, true ) , true ); ?> /> <?php echo esc_html( $format_args['labels']['name'] ); ?>
			</label>
		</fieldset>
		<?php
	}
	?>
	</div>

	<?php
}

/**
 * Wheter to enable the login popup
 */
function snax_admin_setting_enable_login_popup() {
	$enable_login_popup = snax_enable_login_popup();
	?>

	<select name="snax_enable_login_popup" id="snax_enable_login_popup">
		<option value="standard" <?php selected( $enable_login_popup, true ) ?>><?php esc_html_e( 'yes', 'snax' ) ?></option>
		<option value="none" <?php selected( $enable_login_popup, false ) ?>><?php esc_html_e( 'no', 'snax' ) ?></option>
	</select>
	<?php
}

/**** Sections > Lists ************************************************** */

/**
 * Render Lists section description
 */
function snax_admin_settings_lists_section_description() {}

/**
 * New item forms
 */
function snax_admin_setting_callback_active_item_forms() {
	$forms = snax_get_registered_item_forms();
	$active_forms_ids = snax_get_active_item_forms_ids();

	foreach ( $forms as $form_id => $form_args ) {
		$checkbox_id = 'snax_active_item_form_' . $form_id;
		?>
		<fieldset>
			<label for="<?php echo esc_attr( $checkbox_id ); ?>">
				<input name="snax_active_item_forms[]" id="<?php echo esc_attr( $checkbox_id ); ?>" type="checkbox" value="<?php echo esc_attr( $form_id ); ?>" <?php checked( in_array( $form_id, $active_forms_ids, true ) , true ); ?> /> <?php echo esc_html( $form_args['labels']['name'] ); ?>
			</label>
		</fieldset>
		<?php
	}
	?>
	<?php
}

/**
 * Show open list status in title
 */
function snax_admin_setting_callback_list_status_in_title() {
	?>
	<input name="snax_show_open_list_in_title" id="snax_show_open_list_in_title" type="checkbox" <?php checked( snax_show_open_list_in_title() ); ?> />
	<?php
}

/**
 * Anonymous posting
 */
function snax_admin_setting_callback_anonymous() {
	?>

	<input name="snax_allow_anonymous" id="snax_allow_anonymous" type="checkbox" value="1" <?php checked( snax_allow_anonymous( false ) ); ?> />
	<label for="snax_allow_anonymous"><?php esc_html_e( 'Allow guest users without accounts to submit new items.', 'snax' ); ?></label>

<?php
}

/**
 * User can submit (limit)
 */
function snax_admin_setting_callback_user_submission_limit() {
	$limit = snax_get_user_submission_limit();
	?>

	<select name="snax_user_submission_limit" id="snax_user_submission_limit">
		<option value="1" <?php selected( 1, $limit ) ?>><?php esc_html_e( 'only 1 item', 'snax' ) ?></option>
		<option value="-1" <?php selected( -1, $limit ) ?>><?php esc_html_e( 'unlimited items', 'snax' ) ?></option>
	</select>
	<span><?php esc_html_e( 'to an existing list.', 'snax' ); ?></span>
<?php
}


/** Pages Section **************************************************************/


/**
 * Pages section description
 */
function snax_admin_settings_pages_section_description() {}

/**
 * Frontend Submission page
 */
function snax_admin_setting_callback_frontend_submission_page() {
	$selected_page_id = snax_get_frontend_submission_page_id();
	?>

	<?php wp_dropdown_pages( array(
		'name'             => 'snax_frontend_submission_page_id',
		'show_option_none' => esc_html__( '- None -', 'snax' ),
		'selected'         => absint( $selected_page_id ),
	) );

if ( ! empty( $selected_page_id ) ) :
	?>
		<a href="<?php echo esc_url( snax_get_frontend_submission_page_url() ); ?>" class="button-secondary" target="_blank"><?php esc_html_e( 'View', 'snax' ); ?></a>
	<?php
	endif;
}

/**
 * Legal page
 */
function snax_admin_setting_callback_legal_page() {
	$selected_page_id = snax_get_legal_page_id();
	?>

	<?php wp_dropdown_pages( array(
		'name'             => 'snax_legal_page_id',
		'show_option_none' => esc_html__( '- None -', 'snax' ),
		'selected'         => absint( $selected_page_id ),
	) );

if ( ! empty( $selected_page_id ) ) :
		?>
		<a href="<?php echo esc_url( snax_get_legal_page_url() ); ?>" class="button-secondary" target="_blank"><?php esc_html_e( 'View', 'snax' ); ?></a>
		<?php
	endif;
}

/**
 * Report page
 */
function snax_admin_setting_callback_report_page() {
	$selected_page_id = snax_get_report_page_id();
	?>

	<?php wp_dropdown_pages( array(
		'name'             => 'snax_report_page_id',
		'show_option_none' => esc_html__( '- None -', 'snax' ),
		'selected'         => absint( $selected_page_id ),
	) );

if ( ! empty( $selected_page_id ) ) :
		?>
		<a href="<?php echo esc_url( snax_get_report_page_url() ); ?>" class="button-secondary" target="_blank"><?php esc_html_e( 'View', 'snax' ); ?></a>
		<?php
	endif;
}

/** Voting Section ************************************************************/

/**
 * Voting section description
 */
function snax_admin_settings_voting_section_description() {}

/**
 * Voting enabled?
 */
function snax_admin_setting_callback_voting_enabled() {
	?>
	<input name="snax_voting_is_enabled" id="snax_voting_is_enabled" type="checkbox" <?php checked( snax_voting_is_enabled() ); ?> />
	<?php
}

/**
 * Guest Voting enabled?
 */
function snax_admin_setting_callback_guest_voting_enabled() {
	?>
	<input name="snax_guest_voting_is_enabled" id="snax_guest_voting_is_enabled" type="checkbox" <?php checked( snax_guest_voting_is_enabled() ); ?> />
	<?php
}


/**
 * Post types.
 */
function snax_admin_setting_callback_voting_post_types() {
	$post_types = get_post_types();
	$supported_post_types = snax_voting_get_post_types();

	foreach ( $post_types as $post_type ) {
		$skipped = array( 'attachment', 'revision', 'nav_menu_item', snax_get_item_post_type() );

		if ( in_array( $post_type, $skipped, true ) ) {
			continue;
		}

		$checkbox_id = 'snax_voting_post_type_' . $post_type;
		?>
		<fieldset>
			<label for="<?php echo esc_attr( $checkbox_id ); ?>">
				<input name="snax_voting_post_types[]" id="<?php echo esc_attr( $checkbox_id ); ?>" type="checkbox" value="<?php echo esc_attr( $post_type ); ?>" <?php checked( in_array( $post_type, $supported_post_types, true ) , true ); ?> /> <?php echo esc_html( $post_type ); ?>
			</label>
		</fieldset>
		<?php
	}
	?>
	<?php
}

/**
 * Fake vote count base
 */
function snax_admin_setting_callback_fake_vote_count_base() {
	?>
	<input name="snax_fake_vote_count_base" id="snax_fake_vote_count_base" type="number" value="<?php echo esc_attr( snax_get_fake_vote_count_base() ); ?>" placeholder="<?php esc_attr_e( 'e.g. 1000', 'snax' ); ?>" />
	<p class="description">
		<?php esc_html_e( 'Leave empty to not use "Fake votes" feature.', 'snax' ); ?></span>
	</p>
	<?php
}

/** Limits Section ************************************************************/

/**
 * Limts section description
 */
function snax_admin_settings_limits_section_description() {}

/**
 * Tags limit
 */
function snax_admin_setting_callback_tags_limit() {
	?>
	<input name="snax_tags_limit" id="snax_tags_limit" type="number" size="5" value="<?php echo esc_attr( snax_get_tags_limit() ); ?>" />
	<p class="description"><?php esc_html_e( 'Maximum number of tags user can assign to a post during new submission.', 'snax' ); ?></p>
	<?php
}

/**
 * Post title max. length
 */
function snax_admin_setting_callback_post_title_max_length() {
	?>
	<input name="snax_post_title_max_length" id="snax_post_title_max_length" type="number" size="5" value="<?php echo esc_attr( snax_get_post_title_max_length() ); ?>" />
	<?php
}

/**
 * Post description max. length
 */
function snax_admin_setting_callback_post_description_max_length() {
	?>
	<input name="snax_post_description_max_length" id="snax_post_description_max_length" type="number" size="5" value="<?php echo esc_attr( snax_get_post_description_max_length() ); ?>" />
	<?php
}

/**
 * Post content max. length
 */
function snax_admin_setting_callback_post_content_max_length() {
	?>
	<input name="snax_post_content_max_length" id="snax_post_content_max_length" type="number" size="5" value="<?php echo esc_attr( snax_get_post_content_max_length() ); ?>" />
	<span><?php esc_html_e( 'For Story format.', 'snax' ); ?></span>
	<?php
}

/**
 * Item title max. length
 */
function snax_admin_setting_callback_item_title_max_length() {
	?>
	<input name="snax_item_title_max_length" id="snax_item_title_max_length" type="number" size="5" value="<?php echo esc_attr( snax_get_item_title_max_length() ); ?>" />
	<?php
}

/**
 * Item content max. length
 */
function snax_admin_setting_callback_item_content_max_length() {
	?>
	<input name="snax_item_content_max_length" id="snax_item_content_max_length" type="number" size="5"
	       value="<?php echo esc_attr( snax_get_item_content_max_length() ); ?>"/>
	<?php
}

/**
 * Item source max. length
 */
function snax_admin_setting_callback_item_source_max_length() {
	?>
	<input name="snax_item_source_max_length" id="snax_item_source_max_length" type="number" size="5" value="<?php echo esc_attr( snax_get_item_source_max_length() ); ?>" />
	<?php
}

/**
 * Item referral link max. length
 */
function snax_admin_setting_callback_item_ref_link_max_length() {
	?>
	<input name="snax_item_ref_link_max_length" id="snax_item_ref_link_max_length" type="number" size="5"
	       value="<?php echo esc_attr( snax_get_item_ref_link_max_length() ); ?>"/>
	<?php
}

/**
 * How many new items user can submit to a new post (during creation).
 */
function snax_admin_setting_callback_limits_poll_vote_limit() {
	$limit = snax_get_limits_poll_vote_limit();
	?>

	<select name="snax_limits_poll_vote_limit" id="snax_limits_poll_vote_limit">
		<option value="1" <?php selected( 1, $limit ) ?>><?php esc_html_e( 'one vote', 'snax' ) ?></option>
		<option value="-1" <?php selected( -1, $limit ) ?>><?php esc_html_e( 'unlimited votes', 'snax' ) ?></option>
	</select>
	<?php
}

/** Auth Section **************************************************************/


/**
 * Auth section description
 */
function snax_admin_settings_auth_section_description() {}

/**
 * Enable reCaptcha for login
 */
function snax_admin_setting_callback_login_recaptcha() {
	?>
	<input name="snax_login_recaptcha" id="snax_login_recaptcha" type="checkbox" <?php checked( snax_is_recatpcha_enabled_for_login_form() ); ?> />
	<?php
}

/*
 * reCaptcha Site Key
 */
function snax_admin_setting_callback_recaptcha_site_key() {
	?>
	<input name="snax_recaptcha_site_key" id="snax_recaptcha_site_key" class="regular-text" type="text" value="<?php echo esc_attr( snax_get_recaptcha_site_key() ); ?>" />
	<p class="description">
		<?php echo wp_kses_post( sprintf( __( 'How do I get my <strong>reCaptcha API key pair</strong>? Use the <a href="%s" target="_blank">reCaptcha Getting Started</a> guide for help.', 'snax' ), esc_url( 'https://developers.google.com/recaptcha/intro' ) ) ); ?>
	</p>
	<?php
}

/*
 * reCaptcha Secret
 */
function snax_admin_setting_callback_recaptcha_secret() {
	?>
	<input name="snax_recaptcha_secret" id="snax_recaptcha_secret" class="regular-text" type="text" value="<?php echo esc_attr( snax_get_recaptcha_secret() ); ?>" />
	<?php
}

/** Demo Section **************************************************************/


/**
 * Demo section description
 */
function snax_admin_settings_demo_section_description() {}

/**
 * Demo mode enabled?
 */
function snax_admin_setting_callback_demo_mode() {
	?>
	<input name="snax_demo_mode" id="snax_demo_mode" type="checkbox" <?php checked( snax_is_demo_mode() ); ?> />
	<?php
}


/**
 * Demo post
 *
 * @param array $args			Renderer config.
 */
function snax_admin_setting_callback_demo_post( $args ) {
	$format = $args['format'];
	$selected_post_id = snax_get_demo_post_id( $format );
	$select_name = sprintf( 'snax_demo_%s_post_id', $format );

	$posts = get_posts( array(
		'posts_per_page'   => -1,
		'orderby'          => 'title',
		'order'            => 'ASC',
		'post_status'      => 'any',
		'tax_query'		 => array(
			array(
				'taxonomy' 	=> snax_get_snax_format_taxonomy_slug(),
				'field' 	=> 'slug',
				'terms' 	=> 'meme' === $format ? 'image' : $format,
			),
		),
	) );
	?>
	<select name="<?php echo esc_attr( $select_name ) ?>" id="<?php echo esc_attr( $select_name ); ?>">
		<option value=""><?php esc_html_e( '- None -', 'snax' ) ?></option>

		<?php foreach( $posts as $post ) : ?>
			<option class="level-0" value="<?php echo intval( $post->ID ) ?>" <?php selected( $post->ID, $selected_post_id ); ?>><?php echo esc_html( get_the_title( $post ) ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php

	if ( ! empty( $selected_post_id ) ) :
		?>
		<a href="<?php echo esc_url( get_permalink( $selected_post_id ) ); ?>" class="button-secondary" target="_blank"><?php esc_html_e( 'View', 'snax' ); ?></a>
		<?php
	endif;

	if ( 'meme' === $format ) {
		esc_html_e( 'Choose an Image post', 'snax' );
	}
}

/** Embedly Section **************************************************************/


/**
 * Embedly section description
 */
function snax_admin_settings_embedly_section_description() {
	?>
	<p><?php echo wp_kses_post( __( '<a href="http://Embedly.com" target="_blank">Embedly</a> is an alternative embed handler for Snax. It allows you to have unified, beautiful embeds on your site with more than 400 services supported. Free plan does not require any API key - just enable and enjoy!', 'snax' ) ); ?>
	</p>
	<?php
}

/**
 * Embedly enabled?
 */
function snax_admin_setting_callback_embedly_enable() {
	?>
	<input name="snax_embedly_enable" id="snax_embedly_enable" type="checkbox" <?php checked( snax_is_embedly_enabled() ); ?> />
	<?php
}

/**
 * Dark skin enabled?
 */
function snax_admin_setting_callback_embedly_dark_skin() {
	?>
	<input name="snax_embedly_dark_skin" id="snax_embedly_dark_skin" type="checkbox" <?php checked( snax_is_embedly_dark_skin() ); ?> />
	<?php
}

/**
 * Share buttons enabled?
 */
function snax_admin_setting_callback_embedly_buttons() {
	?>
	<input name="snax_embedly_buttons" id="snax_embedly_buttons" type="checkbox" <?php checked( snax_is_embedly_buttons() ); ?> />
	<?php
}

/**
 * Embed width
 */
function snax_admin_setting_callback_embedly_width() {
	?>
	<input name="snax_embedly_width" id="snax_embedly_width" type="number" value="<?php echo esc_attr( snax_get_embedly_width() ); ?>" placeholder="<?php esc_attr_e( 'e.g. 500px', 'snax' ); ?>" />
	<p class="description"><?php esc_html_e( 'Leave empty for responsive.', 'snax' ); ?></p	>
	<?php
}

/**
 * Embed alignment
 */
function snax_admin_setting_callback_embedly_alignment() {
	$alignment = snax_get_embedly_alignment();
	?>

	<select name="snax_embedly_alignment" id="snax_embedly_alignment">
		<option value="center" <?php selected( 'center' === $alignment, true ) ?>><?php esc_html_e( 'center', 'snax' ) ?></option>
		<option value="left" <?php selected( 'left' === $alignment, true ) ?>><?php esc_html_e( 'left', 'snax' ) ?></option>
		<option value="right" <?php selected( 'right' === $alignment, true ) ?>><?php esc_html_e( 'right', 'snax' ) ?></option>
	</select>
	<?php
}

/**
 * Embedly API key
 */
function snax_admin_setting_callback_embedly_api_key() {
	$api_key = snax_get_embedly_api_key();
	?>
	<input name="snax_embedly_api_key" id="snax_embedly_api_key" class="regular-text" type="text" size="5" value="<?php echo esc_attr( $api_key ); ?>" />
	<?php
	if ( $api_key ) {
		if ( snax_embedly_verify_cards_key( $api_key ) ) {
			echo wp_kses_post( __( '&#10004;', 'snax' ) );
		} else {
			echo wp_kses_post( __( '&#10006;', 'snax' ) );
		}
	} else {
		?><p class="description"><?php
		echo wp_kses_post( sprintf( __( 'Get your Embedly API key at <a href="%s" target="_blank">Embed.ly/cards</a>', 'snax' ), esc_url( 'http://Embed.ly/cards' ) ) );
		?></p><?php
	}
}

/** Memes Section **************************************************************/


/**
 * Memes section description
 */
function snax_admin_settings_memes_section_description() {
	$meme_import_url = 'https://api.imgflip.com/get_memes';
	?>
	<table class="form-table"><tbody>
		<tr><th scope="row"><?php esc_html_e( 'Import popular meme templates', 'snax' ) ?></th><td>
			<p>
				<a class="button snax-import-meme-templates-button" href="<?php echo esc_url( $meme_import_url );?>">Run now</a>
			</p>
			<p class="description"><?php
			echo wp_kses_post( __( 'The meme templates are imported from <a target="_blank" href="https://api.imgflip.com/">https://api.imgflip.com/</a>', 'snax' ) );
			?></p>
			<p class="description"><?php
			echo wp_kses_post( __( 'Already imported templates will be skipped - if any errors occur during import you can re-run it and only misssing memes will be downloaded.', 'snax' ) );
			?></p>
		</td></tr>
	</tbody></table>
	<div class="snax-import-meme-templates-status"></div>
	<?php wp_nonce_field( 'snax_meme_import_nonce', 'snax_meme_import_nonce' );?>
	<?php
}

/**
 * Recaption this meme enabled?
 */
function snax_admin_setting_callback_memes_recaption_enable() {
	?>
	<input name="snax_memes_recaption_enable" id="snax_memes_recaption_enable" type="checkbox" <?php checked( snax_is_memes_recaption_enabled() ); ?> />
	<?php
}
/**
 * Post content enabled?
 */
function snax_admin_setting_callback_memes_content_enable() {
	?>
	<input name="snax_memes_content_enable" id="snax_memes_content_enable" type="checkbox" <?php checked( snax_is_memes_content_enabled() ); ?> />
	<?php
}

/** Permalinks Section **************************************************************/


/**
 * Permalinks section description
 */
function snax_permalinks_section_description() {}

/**
 * Item post type slug
 */
function snax_permalink_callback_item_slug() {
	?>
	<code><?php echo esc_url( trailingslashit( home_url() ) ); ?></code>
	<input name="snax_item_slug" id="snax_item_slug" maxlength="20" type="text" value="<?php echo esc_attr( snax_get_item_slug() ) ?>" />
	<code>/sample-post/</code>
	<?php
}

/**
 * Prefix for all Snax url variables
 */
function snax_permalink_callback_url_var_prefix() {
	?>
	<input name="snax_url_var_prefix" id="snax_url_var_prefix" type="text" value="<?php echo esc_attr( snax_get_url_var_prefix() ) ?>" />
	<?php
}
