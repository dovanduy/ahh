<?php
/**
 * BuddyPress plugin functions
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

define( 'BP_DEFAULT_COMPONENT', 'profile' );

add_filter( 'snax_bp_component_main_nav',   'bimber_snax_bp_component_main_nav', 999, 2 );

add_action( 'bp_member_header_actions', 'bimber_bp_member_add_button_class_filters', 1 );
add_action( 'bp_member_header_actions', 'bimber_bp_member_remove_button_class_filters', 9999 );

add_action( 'bp_group_header_actions', 'bimber_bp_group_add_button_class_filters', 1 );
add_action( 'bp_group_header_actions', 'bimber_bp_group_remove_button_class_filters', 9999 );

add_filter( 'bp_get_add_friend_button', 			'bimber_bp_get_simple_xs_button', 99 );
add_filter( 'bp_get_group_join_button', 			'bimber_bp_get_simple_xs_button', 99 );
add_filter( 'bp_get_send_public_message_button', 	'bimber_bp_get_simple_xs_button', 99 );
add_filter( 'bp_get_send_message_button_args', 		'bimber_bp_get_simple_xs_button', 99 );

add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', 'bimber_cover_image_css', 10, 1 );
add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'bimber_cover_image_css', 10, 1 );

add_filter( 'bp_directory_members_search_form', 'bimber_bp_directory_search_form' );
add_filter( 'bp_directory_groups_search_form', 'bimber_bp_directory_search_form' );

add_filter( 'author_link', 'bimber_bp_get_author_link', 10, 3 );

add_filter( 'template_include', 'bimber_bp_load_no_sidebar_page_template', 99 );
add_action( 'bp_member_header_actions',    'bimber_bp_open_action_dropdown',  6 );

add_action( 'bp_directory_members_item', 'bimber_bp_members_counters', 5);
add_action( 'bimber_bp_members_counters', 'bimber_bp_members_counter_posts', 6);

add_action( 'bp_setup_nav', 'bimber_bp_add_home_tab', 100 );
add_filter( 'bp_before_has_members_parse_args', 'bimber_bp_fix_multisite_members', 9999, 2 );
add_filter( 'bp_core_get_active_member_count', 'bimber_bp_fix_multisite_members_count', 9999, 2 );

add_action( 'wp_loaded', 'bimber_bp_setup_xprofile_fields' );

add_filter( 'bimber_setup_sidebars', 	'bimber_bp_setup_sidebars' );
add_filter( 'bimber_sidebar',			'bimber_bp_sidebar',100 );

add_action( 'bp_after_profile_field_content', 'bimber_bp_profile_elements',9 );
add_action( 'wp', 'bimber_bp_update_last_online',9 );

add_filter( 'bp_nav_menu_args', 'bimber_bp_nav_menu_args' );
add_filter( 'bp_nav_menu', 'bimber_bp_nav_menu', 10, 2 );

add_action( 'widgets_init', 'bimber_bp_widgets_init' );

add_filter( 'bimber_author_info_box_bio', 'bimber_buddypress_use_description_for_author_info_box', 10, 2 );

add_action( 'wp_enqueue_scripts', 'bimber_dequeue_bp_styles', 20 );


/**
 * Don' load BuddyPress legacy stylesheet.
 *
 * We will provide our own stylesheets.
 */
function bimber_dequeue_bp_styles() {
	wp_dequeue_style( 'bp-legacy-css' );
}


function bimber_bp_nav_menu_args( $args ) {
	$args['container_class'] = 'g1-tabs';
	$args['menu_class']      = 'g1-tab-items';
	$args['walker']          = new Bimber_BP_Walker_Nav_Menu();

	global $bimber_bp_nav_sub_items;
	global $bimber_bp_nav_sub_items_used_css_ids;
	$bimber_bp_nav_sub_items = array();
	$bimber_bp_nav_sub_items_used_css_ids = array();

	return $args;
}

function bimber_bp_nav_menu( $nav_menu, $args ) {
	global $bimber_bp_nav_sub_items;
	if ( $args->walker instanceof Bimber_BP_Walker_Nav_Menu && isset( $bimber_bp_nav_sub_items [ bp_current_component() ] ) ) {
		$sub_menu_items = $bimber_bp_nav_sub_items [ bp_current_component() ];

		if ( ! empty( $sub_menu_items ) ) {
			$sub_menu_output = '<div id="object-sub-nav g1-subtabs">';

				$sub_menu_output .= '<ul class="g1-subtab-items">';

					foreach ( $sub_menu_items as $sub_menu_item ) {
						$sub_menu_item = str_replace( 'g1-tab-item', 'g1-subtab-item', $sub_menu_item);
						$sub_menu_item = str_replace( 'current-menu-item', 'g1-tab-item-current', $sub_menu_item);
						$sub_menu_item = str_replace( 'g1-tab', 'g1-subtab', $sub_menu_item);
						$sub_menu_output .= $sub_menu_item;
					}

				$sub_menu_output .= '</ul>';

			$sub_menu_output .= '</div>';

			$nav_menu .= $sub_menu_output;
		}
	}

	return $nav_menu;
}

if ( function_exists( 'bp_set_theme_compat_feature' ) ) {
	bp_set_theme_compat_feature( 'legacy', array(
		'name'     => 'cover_image',
		'settings' => array(
			'components'   => array( 'xprofile', 'groups' ),
			'width'        => 1920,
			'height'       => 360,
			'callback'     => 'bp_legacy_theme_cover_image',
			'theme_handle' => 'bp-legacy-css',
		),
	) );
}

/**
 * Move Snax tabs to the beginning of profile tabs.
 *
 * @param array  $main_nav      Navigation config.
 * @param string $id            Component id.
 *
 * @return array
 */
function bimber_snax_bp_component_main_nav( $main_nav, $id ) {
	if ( ! bimber_can_use_plugin( 'snax/snax.php' ) ) {
		return $main_nav;
	}

	$lists_component_id = snax_posts_bp_component_id();
	$items_component_id = snax_items_bp_component_id();
	$votes_component_id = snax_votes_bp_component_id();

	if ( $lists_component_id === $id ) {
		$main_nav['position'] = 4;
	}

	if ( $items_component_id === $id ) {
		$main_nav['position'] = 6;
	}

	if ( $votes_component_id === $id ) {
		$main_nav['position'] = 8;
	}

	return $main_nav;
}

/**
 * Adjust the markup of a directory (groups, members) search form
 *
 * @param string $html HTML markup.
 *
 * @return string
 */
function bimber_bp_directory_search_form( $html ) {
	$html = str_replace( '<input type="submit"', '<input class="g1-button g1-button-simple" type="submit"', $html );
	return $html;
}

function bimber_bp_member_add_button_class_filters() {
	add_filter( 'bp_get_add_friend_button', 			'bimber_bp_get_solid_button' );
}

function bimber_bp_member_remove_button_class_filters() {
	remove_filter( 'bp_get_add_friend_button', 			'bimber_bp_get_solid_button' );
}

function bimber_bp_group_add_button_class_filters() {
	add_filter( 'bp_get_group_join_button', 			'bimber_bp_get_solid_button' );
}

function bimber_bp_group_remove_button_class_filters() {
	remove_filter( 'bp_get_group_join_button', 			'bimber_bp_get_solid_button' );
}

/**
 * Adjust BuddyPress button classes.
 */
function bimber_bp_get_simple_xs_button( $button ) {
	if ( ! isset( $button['g1'] ) ) {
		$button['link_class'] .= ' ';

		// Add our special key for tracking purposes.
		$button['g1'] = true;
	}

	return $button;
}

function bimber_bp_get_solid_button( $button ) {
	$button['link_class'] .= ' g1-button g1-button-m g1-button-simple';
	// Add our special key for tracking purposes
	$button['g1'] = true;

	return $button;
}

/**
 * Render dynamic CSS for the #header-cover-image
 *
 * @param array $params Parameters.
 *
 * @return string
 */
function bimber_cover_image_callback( $params = array() ) {
	if ( empty( $params ) ) {
		return;
	}

	return '
		#buddypress #header-cover-image {
			height: ' . absint( $params['height'] ) . 'px;
			background-image: url(' . esc_url( $params['cover_image'] ) . ');
		}
	';
}

function bimber_cover_image_css( $settings = array() ) {
	/**
	 * If you are using a child theme, use bp-child-css
	 * as the theme handle
	 */
	$settings['theme_handle'] = 'bp-parent-css';
	// Adjust size
	$settings['height'] = 360;

	$settings['callback'] = 'bimber_cover_image_callback';

	return $settings;
}

function bimber_render_markup_before_list_items_loop() {
	echo '<div class="g1-indent">';
}

function bimber_render_markup_after_list_items_loop() {
	echo '</div>';
}

/**
 * Return current user profile url
 *
 * @param string $link          Author posts link.
 * @param int 	 $author_id		Author id.
 *
 * @return string
 */
function bimber_bp_get_author_link( $link, $author_id ) {
	$link = bp_core_get_user_domain( $author_id );
	$link = trailingslashit( $link . bp_get_profile_slug() );
	$link = trailingslashit( $link . 'home' );
	return $link;
}

/** PROFILE ************/


/**
 * Whether or not to show the "Change Cover Image" link
 *
 * @return bool
 */
function bimber_bp_show_cover_image_change_link() {
	$show = bp_core_can_edit_settings() && bp_displayed_user_use_cover_image_header();

	return apply_filters( 'bimber_bp_show_cover_image_change_link', $show );
}

/**
 * Render the "Change Cover Image" link
 */
function bimber_bp_render_cover_image_change_link() {
	$link = bp_get_members_component_link( 'profile', 'change-cover-image' );

	?>
	<a class="g1-bp-change-image" href="<?php echo esc_url( $link ); ?>" title="<?php  esc_attr_e( 'Change Cover Image', 'buddypress' ); ?>"><?php esc_html_e( 'Change Cover Image', 'buddypress' ); ?></a>
	<?php
}

/**
 * Whether or not to show the "Change Profile Photo" link
 *
 * @return bool
 */
function bimber_bp_show_profile_photo_change_link() {
	$show = bp_core_can_edit_settings() && buddypress()->avatar->show_avatars;

	return apply_filters( 'bimber_bp_show_profile_photo_change_link', $show );
}

/**
 * Render the "Change Profile Photo" link
 */
function bimber_bp_render_profile_photo_change_link() {
	$link = bp_get_members_component_link( 'profile', 'change-avatar' );

	?>
	<a class="g1-bp-change-avatar" href="<?php echo esc_url( $link ); ?>" title="<?php esc_attr_e( 'Change Profile Photo', 'buddypress' ); ?>"><?php esc_html_e( 'Change Profile Photo', 'buddypress' ); ?></a>
	<?php
}


/** GROUP ************/


/**
 * Whether or not to show the "Change Cover Image" link
 *
 * @return bool
 */
function bimber_bp_show_group_cover_image_change_link() {
	$show = bp_core_can_edit_settings() && bp_group_use_cover_image_header();

	return apply_filters( 'bimber_bp_show_group_cover_image_change_link', $show );
}

/**
 * Render the "Change Cover Image" link
 */
function bimber_bp_render_group_cover_image_change_link() {
	$group_link = bp_get_group_permalink();
	$admin_link = trailingslashit( $group_link . 'admin' );
	$link = trailingslashit( $admin_link . 'group-cover-image' );

	?>
	<a class="g1-bp-change-image" href="<?php echo esc_url( $link ); ?>" title="<?php  esc_attr_e( 'Change Cover Image', 'buddypress' ); ?>"><?php esc_html_e( 'Change Cover Image', 'buddypress' ); ?></a>
	<?php
}

/**
 * Whether or not to show the "Change Profile Photo" link
 *
 * @return bool
 */
function bimber_bp_show_group_photo_change_link() {
	$show = bp_core_can_edit_settings() && ! bp_disable_group_avatar_uploads() && buddypress()->avatar->show_avatars;

	return apply_filters( 'bimber_bp_show_group_photo_change_link', $show );
}

/**
 * Render the "Change Profile Photo" link
 */
function bimber_bp_render_group_photo_change_link() {
	$group_link = bp_get_group_permalink();
	$admin_link = trailingslashit( $group_link . 'admin' );
	$link = trailingslashit( $admin_link . 'group-avatar' );

	?>
	<a class="g1-bp-change-avatar" href="<?php echo esc_url( $link ); ?>" title="<?php esc_attr_e( 'Change Group Photo', 'buddypress' ); ?>"><?php esc_html_e( 'Change Group Photo', 'buddypress' ); ?></a>
	<?php
}

/**
 * Override default page template for BuddyPress pages.
 *
 * @param str $template  Template to load.
 * @return str
 */
function bimber_bp_load_no_sidebar_page_template( $template ) {
	$is_groups = strpos( $template, 'groups' ) > 0;
	if ( 'home' === bp_current_action() && ! $is_groups ) {
		$template = str_replace( 'index.php', 'index-full.php', $template );
	}

	if ( 'standard' === bimber_get_theme_option( 'bp', 'enable_sidebar' ) ) {
		return $template;
	}

	if ( is_buddypress() && strpos( $template, trailingslashit( 'single' ) . 'index.php' )  && ! $is_groups ) {
		$template = str_replace( 'index.php', 'index-full.php', $template );
	}

	if ( is_buddypress() && strpos( $template, 'page.php' )) {
		$template = str_replace( 'page.php', 'g1-template-page-full.php', $template );
	}
	if ( is_buddypress() && strpos( $template, 'index-directory.php' )) {
		$template = str_replace( 'index-directory.php', 'index-directory-full.php', $template );
	}

	return $template;
}

/**
 * Open action dropdown markup
 */
function bimber_bp_open_action_dropdown() {
	?>
	<div class="g1-drop g1-drop-before">
	<a class="g1-button g1-button-m g1-button-simple g1-drop-toggle" href="#"></a>
	<div class="g1-drop-content"><ul class="sub-menu">
	<?php
}

/**
 * BP actions placeholder for logged out users
 */
function bimber_bp_actions_placeholder() {
	?>
	<div class="bp-actions-placeholder friendship-button not_friends generic-button" id="friendship-button-1"><a href="#" class="snax-login-required friendship-button not_friends add g1-button g1-button-m g1-button-simple" id="friend-1" rel="add">Add Friend</a></div>	
	<div class="g1-drop g1-drop-before">
	<a class="g1-button g1-button-m g1-button-simple g1-drop-toggle" href="#"></a>
	<div class="g1-drop-content">
	<div id="post-mention" class="generic-button"><a href="#" class="snax-login-required activity-button mention ">Public Message</a></div><div id="send-private-message" class="generic-button"><a href="#" class="snax-login-required send-message">Private Message</a></div></div></div>
	<?php
}

/**
 * Add member counters section
 */
function bimber_bp_members_counters() {
	?>
	<div class="item-counters">
	<?php do_action( 'bimber_bp_members_counters' ); ?>
	</div>
	<?php
}

/**
 * Add member posts counter
 */
function bimber_bp_members_counter_posts() {
	?>
	<div class="item-counters-counter">
	<div class="item-counters-counter-value"><?php echo esc_html( count_user_posts( bp_get_member_user_id() ) ); ?></div>
		<div class="g1-meta"><?php esc_html_e( 'Posts', 'bimber' ); ?></div>
	</div>
	<?php
}

/**
 * Add home tab.
 */
function bimber_bp_add_home_tab() {
	global $bp;
	bp_core_new_subnav_item( array(
		'name'              => __( 'Home', 'bimber' ),
		'slug'              => 'home',
		'parent_url'        => trailingslashit( bp_displayed_user_domain() . 'profile' ),
		'parent_slug'       => 'profile',
		'screen_function'   => 'bimber_bp_home_callback',
		'position'          => 1,
	) );

	bp_core_remove_subnav_item( 'profile', 'public' );

	bp_core_new_subnav_item( array(
		'name'            => _x( 'View', 'Member profile view', 'buddypress' ),
		'slug'            => 'classic',
		'parent_url'      => trailingslashit( bp_displayed_user_domain() . 'profile' ),
		'parent_slug'     => 'profile',
		'screen_function' => 'bp_members_screen_display_profile',
		'position'        => 2,
	) );

	bp_core_new_nav_default( array(
		'parent_slug'       => 'profile',
		'subnav_slug'       => 'home',
		'screen_function'   => 'bimber_bp_home_callback',
	) );
	$parent_nav = $bp->members->nav->get_primary( array( 'slug' => 'profile' ), false );
	$parent_nav['profile']['position'] = 2;

}

/**
 * Home tab callback.
 */
function bimber_bp_home_callback() {
	add_action( 'bp_template_content', 'bimber_bp_home_content' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

/**
 * Home tab content.
 */
function bimber_bp_home_content() {
	$columns_class = 'g1-collection-columns-3';
	?>
	<div class="g1-collection <?php echo sanitize_html_class( $columns_class )?> buddypress-home">
		<div class="g1-collection-viewport">
			<ul class="g1-collection-items">
				<?php
				add_filter( 'dynamic_sidebar_params', 'bimber_bp_home_content_columns',10 , 1 );
				dynamic_sidebar( 'bimber_bp_home' );
				remove_filter( 'dynamic_sidebar_params', 'bimber_bp_home_content_columns', 10 ,1 );
				?>
			</ul>
		</div>
	</div>
	<?php
}

/**
 * Add column classes to widgets
 *
 * @param array $params  Params.
 * @return array
 */
function bimber_bp_home_content_columns( $params ) {
	$params[0]['before_widget'] = '<li class="g1-collection-item g1-collection-item-1of3"><div class="bimber-buddypress-home-item">' . $params[0]['before_widget'];
	$params[0]['after_widget'] = $params[0]['after_widget'] . '</div></li>';
	return $params;
}

/**
 * Fix multisite members view
 *
 * @param array $args Query args.
 * @return array
 */
function bimber_bp_fix_multisite_members( $args ) {
	if ( ! is_multisite() ) {
		return $args;
	}
	global $wpdb;
	$all_sites = get_sites();
	$all_users = $wpdb->get_col( "SELECT ID FROM {$wpdb->users}" );
	$current_site = get_current_blog_id();
	$excluded_users = array();
	foreach ( $all_users as $key => $user ) {
		$user_blogs = get_blogs_of_user( $user );
		if ( ! array_key_exists( $current_site, $user_blogs ) ) {
			$excluded_users[] = $user;
		}
	}
	$args['exclude'] = implode( ',', $excluded_users );
	return $args;
}

/**
 * Create Xprofile fields.
 */
function bimber_bp_setup_xprofile_fields() {
	if ( ! bp_is_active( 'xprofile' ) ) {
		return;
	}
	if ( ! xprofile_get_field_id_from_name( bimber_bp_get_short_description_field_name() ) ) {
		$args = array(
			'field_group_id' 	=> 1,
			'type' 				=> 'textbox',
			'name' 				=> bimber_bp_get_short_description_field_name(),
		);
		$id = xprofile_insert_field( $args );
	}

	if ( ! xprofile_get_field_id_from_name( bimber_bp_get_long_description_field_name() ) ) {
		$args = array(
			'field_group_id' 	=> 1,
			'type' 				=> 'textarea',
			'name' 				=> bimber_bp_get_long_description_field_name(),
		);
		$id = xprofile_insert_field( $args );
	}

}

/**
 * Short description field name.
 */
function bimber_bp_get_short_description_field_name() {
	return __( 'Short Description', 'bimber' );
}

/**
 * Long description field name.
 */
function bimber_bp_get_long_description_field_name() {
	return __( 'Long Description', 'bimber' );
}

/**
 * Reigster BuddyPress specific sidebars
 *
 * @param array $sidebars		Registered sidebars.
 *
 * @return array
 */
function bimber_bp_setup_sidebars( $sidebars ) {
	$sidebars['bimber_buddypress'] = array(
		'label'       => esc_html__( 'Buddypress', 'bimber' ),
		'description' => esc_html__( 'Leave empty to use the Primary sidebar', 'bimber' ),
	);

	$sidebars['bimber_buddypress_members'] = array(
		'label'       => esc_html__( 'BuddyPress Members', 'bimber' ),
		'description' => esc_html__( 'Leave empty to use the Buddypress sidebar', 'bimber' ),
	);

	$sidebars['bimber_buddypress_single_member'] = array(
		'label'       => esc_html__( 'BuddyPress Single Member', 'bimber' ),
		'description' => esc_html__( 'Leave empty to use the Buddypress Members sidebar', 'bimber' ),
	);

	$sidebars['bimber_bp_home'] = array(
		'label'       => esc_html__( 'BuddyPress Single Member Home', 'bimber' ),
		'description' => esc_html__( 'BuddyPress profile Home section', 'bimber' ),
	);

	return $sidebars;
}

/**
 * Load BuddyPress specific sidebar
 *
 * @param string $sidebar		Sidebar set.
 *
 * @return string
 */
function bimber_bp_sidebar( $sidebar ) {
	global $bp;
	if ( is_buddypress() ) {
		$sidebar = 'bimber_buddypress';
	}
	if ( bp_is_current_component( $bp->members->slug ) && is_active_sidebar( 'bimber_buddypress_members' ) ) {
		$sidebar = 'bimber_buddypress_members';
	}

	if ( bp_is_user() && is_active_sidebar( 'bimber_buddypress_single_member' ) ) {
		$sidebar = 'bimber_buddypress_single_member';
	}

	return $sidebar;
}

/**
 * Add our fields to BP profile.
 */
function bimber_bp_profile_elements() {
	$data = get_userdata( bp_displayed_user_id() );
	$registered = $data->user_registered;
	$last_online = get_user_meta( bp_displayed_user_id(), 'bimber_last_online', true );
	if ( ! empty( $last_online ) ) {
		$since_last_check = time() - $last_online;
		if ( $since_last_check > 300 ) {
			$last_online = date( 'h:i d/m/Y', $last_online );
		} else {
			$last_online = __( 'Less than five minutes ago', 'bimber' );
		}
	} else {
		$last_online = __( 'Never', 'bimber' );
	}
	?>
	<div class="bp-widget base">
		<h2><?php esc_html_e( 'Additional info', 'g1_socials' ); ?></h2>
		<table class="profile-fields">
			<tbody>
				<tr>
					<td class="label">
						<?php echo esc_html__( 'Member since', 'bimber' );?>
					</td>
					<td class="data"><?php echo date( 'd/m/Y', strtotime( $registered ) );?><p>
					</p></td>
				</tr>
				<tr>
					<td class="label">
						<?php echo esc_html__( 'Last online', 'bimber' );?>
					</td>
					<td class="data"><?php echo esc_html( $last_online); ;?><p>
					</p></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/**
 * Update user last online meta
 */
function bimber_bp_update_last_online() {

	$last_online = get_user_meta( get_current_user_id(), 'bimber_last_online', true );
	if ( $last_online ) {
		$since_last_check = time() - $last_online;
	} else {
		$since_last_check = 301;
	}
	if ( is_user_logged_in() && ! is_admin() && $since_last_check > 300 ) {
		update_user_meta( get_current_user_id(), 'bimber_last_online', time() );
	}
}

/**
 * Init widgets
 */
function bimber_bp_widgets_init() {
	register_widget( 'Bimber_Widget_Featured_Author' );
}

/**
 * Fix multisite member count
 *
 * @param int $count  Member count.
 * @return int
 */
function bimber_bp_fix_multisite_members_count( $count ) {
	if ( ! is_multisite() ) {
		return $count;
	}
	global $wpdb;
	$all_sites = get_sites();
	$all_users = $wpdb->get_col( "SELECT ID FROM {$wpdb->users}" );
	$current_site = get_current_blog_id();
	$excluded_users = array();
	foreach ( $all_users as $key => $user ) {
		$user_blogs = get_blogs_of_user( $user );
		$not_site_user = ! array_key_exists( $current_site, $user_blogs );
		if ( $not_site_user ) {
			$excluded_users[] = $user;
		}
		if ( apply_filters( 'bimber_buddypress_exclude_multisite_user_from_count', false, $user ) ) {
			$excluded_users[] = $user;
		}
	}
	$count = get_transient( 'bp_active_member_count' );
	if ( false === $count ) {
		$bp = buddypress();
		// Avoid a costly join by splitting the lookup.
		if ( is_multisite() ) {
			$sql = "SELECT ID FROM {$wpdb->users} WHERE (user_status != 0 OR deleted != 0 OR user_status != 0) ";
		} else {
			$sql = "SELECT ID FROM {$wpdb->users} WHERE user_status != 0";
		}
		$exclude_users     = $wpdb->get_col( $sql );
		$exclude_users = array_merge( $exclude_users, $excluded_users );
		$exclude_users_sql = !empty( $exclude_users ) ? "AND user_id NOT IN (" . implode( ',', wp_parse_id_list( $exclude_users ) ) . ")" : '';
		$count             = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(user_id) FROM {$bp->members->table_name_last_activity} WHERE component = %s AND type = 'last_activity' {$exclude_users_sql}", $bp->members->id ) );
		set_transient( 'bp_active_member_count', $count );
	}
	return $count;
}

/**
 * Use long description instead of bio in author info box.
 *
 * @param string $bio Bio.
 * @param int    $user_id User id.
 * @return string
 */
function bimber_buddypress_use_description_for_author_info_box( $bio, $user_id ) {
	if ( function_exists( 'xprofile_get_field_data' ) ) {
		$description = xprofile_get_field_data( bimber_bp_get_long_description_field_name(), $user_id );
		if ( ! empty( $description ) ) {
			$bio = $description;
		}
	}
	return $bio;
}
