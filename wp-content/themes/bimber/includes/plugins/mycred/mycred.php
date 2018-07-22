<?php
/**
 * MyCred plugin functions
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

/**
 * Is addon enabled.
 *
 * @param string $addon  The addon.
 * @return bool
 */
function bimber_mycred_is_addon_enabled( $addon ) {
	$current_setting = get_option( 'mycred_pref_addons' );
	return in_array( $addon, $current_setting['active'] );
}

require_once( BIMBER_PLUGINS_DIR . 'mycred/widgets.php' );
require_once( BIMBER_PLUGINS_DIR . 'mycred/shortcodes.php' );

if ( bimber_mycred_is_addon_enabled( 'notifications' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'mycred/notifications.php' );
}

if ( is_admin() ) {
	require_once( BIMBER_PLUGINS_DIR . 'mycred/importer.php' );
	require_once( BIMBER_PLUGINS_DIR . 'mycred/importer-modules.php' );
}

add_filter( 'mycred_ranking_row', 'bimber_mycred_leaderboard_add_avatars', 10, 5 );
add_action( 'admin_enqueue_scripts', 'bimber_mycred_admin_script' );
add_filter( 'mycred_leaderboard', 'bimber_mycred_override_leaderboard_output', 10, 3 );

add_action( 'bimber_bp_members_counters', 'bimber_mycred_bp_points_counter', 5 );
add_filter( 'mycred_br_history_page_title', 'bimber_mycred_bp_tab_title', 10, 1 );
add_action( 'bp_setup_nav', 'bimber_mycred_bp_setup_nav', 100 );
add_filter( 'bp_nav_menu', 'bimber_bp_mycred_nav_current', 101, 2 );
if ( bimber_mycred_is_addon_enabled( 'badges' ) ) {
	add_action( 'bimber_author_after_name', 'bimber_mycred_add_badges_to_author_box' );
	add_filter( 'mycred_register_badge', 'bimber_mycred_badge_post_type_args', 10, 1 );
	add_action( 'bp_directory_members_item', 'bimber_mycred_bp_badges', 4 );
	add_action( 'bp_directory_members_item', 'bimber_mycred_bp_badges', 4 );
	add_filter( 'mycred_get_users_badges', 'bimber_mycred_add_years_of_service_badge', 9999, 2 );
	add_filter( 'bimber_mycred_years_of_service_badge_id', 'bimber_mycred_get_default_imported_yos_badge',10, 1 );
}
if ( bimber_mycred_is_addon_enabled( 'ranks' ) ) {
	add_action( 'bimber_buddypress_memebers_after_user_name', 'bimber_mycred_render_rank_text', 10, 1 );
	add_action( 'bimber_buddypress_memebers_after_avatar', 'bimber_mycred_render_rank_in_author_info_box', 10, 1 );
	add_action( 'bimber_author_box_after_avatar', 'bimber_mycred_render_rank_in_author_info_box', 10, 1 );
}

/**
 * Add points counter to BP collection profile
 */
function bimber_mycred_bp_points_counter() {
	?>
	<div class="item-counters-counter">
	<div class="item-counters-counter-value"><?php echo esc_html( mycred_display_users_balance( bp_get_member_user_id() ) ); ?></div>
		<div class="g1-meta"><?php esc_html_e( 'Points', 'bimber' ); ?></div>
	</div>
	<?php
}

/**
 * Add badges to BP collection profile
 */
function bimber_mycred_bp_badges() {
	$user_id = bp_get_member_user_id();
	mycred_display_users_badges( $user_id );
}

/**
 * Set BP tab title.
 *
 * @param string $title  Title.
 * @return string
 */
function bimber_mycred_bp_tab_title( $title ) {
	return mycred_get_point_type_name( MYCRED_DEFAULT_TYPE_KEY, false );
}

/**
 * Rename tab nav.
 */
function bimber_mycred_bp_setup_nav() {
	global $bp;
	$parent_nav = $bp->members->nav->get_primary( array( 'slug' => 'mycred-history' ), false );
	$parent_nav['mycred-history']['name'] = mycred_get_point_type_name( MYCRED_DEFAULT_TYPE_KEY, false );
	$sub_nav = $bp->members->nav->get_secondary( array( 'parent_slug' => 'mycred-history', 'slug' => 'mycred-history' ), false );
	$sub_nav['mycred-history/mycred-history']['slug'] = 'mycred-historyall';
	$sub_nav['mycred-history/mycred-history']['css_id'] = 'mycred-historyall';
	if ( bimber_mycred_is_addon_enabled( 'badges' ) ) {
		bp_core_new_nav_item( array(
			'name'                    =>__( 'Badges', 'bimber' ),
			'slug'                    => 'badges',
			'item_css_id'             => 'badges',
			'position'                => 8,    // Index of where this nav item should be positioned.
			'screen_function'         => 'bimber_mycred_bp_badges_page',
			'default_subnav_slug'     => 'all',
		) );
	}

	bp_core_new_subnav_item( array(
		'name'            => _x( 'View', 'Member profile view', 'buddypress' ),
		'slug'            => 'all',
		'parent_url'      => trailingslashit( bp_displayed_user_domain() . 'all' ),
		'parent_slug'     => 'badges',
		'screen_function' => 'bimber_mycred_bp_badges_page',
		'position'        => 2,
	) );
}

/**
 * Badges page callback.
 */
function bimber_mycred_bp_badges_page() {
	add_action( 'bp_template_content', 'bimber_mycred_bp_badges_page_content' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

/**
 * Badges page content.
 */
function bimber_mycred_bp_badges_page_content() {
	echo do_shortcode( '[mycred_my_badges show="all" user_id="' . bp_displayed_user_id() . '"]' );
}

/**
 * Add avatars to leaderboard widget
 *
 * @param string 				   $layout		Layout.
 * @param string 				   $template	Template.
 * @param array  				   $user		User.
 * @param int    				   $position	Position.
 * @param myCRED_Query_Leaderboard $object  	Object.
 * @return string
 */
function bimber_mycred_leaderboard_add_avatars( $layout, $template, $user, $position, $object ) {
	if ( stripos( $layout, '%avatar%' ) > -1 ) {
		if ( bimber_mycred_is_addon_enabled( 'ranks' ) ) {
			$rank_logo = mycred_get_users_rank( $user['ID'] );
			$rank_logo = '<img src=' . $rank_logo->logo_url . ' class="bimber-mycred-leaderboard-widget-rank">';
		} else {
			$rank_logo = '';
		}
		$avatar = '<a href="' . get_author_posts_url( $user['ID'] ) . '"><span class="bimber-mycred-leaderboard-widget-avatar">' . get_avatar( $user['ID'], 40 ) . $rank_logo . '</span></a>';
		$layout = str_ireplace( '%avatar%', $avatar, $layout );
	}
	if ( stripos( $layout, '%avatar_large%' ) > -1 ) {
		if ( bimber_mycred_is_addon_enabled( 'ranks' ) ) {
			$rank_logo = mycred_get_users_rank( $user['ID'] );
			$rank_logo = '<img src=' . $rank_logo->logo_url . ' class="bimber-mycred-leaderboard-widget-rank">';
		} else {
			$rank_logo = '';
		}
		$avatar = '<a href="' . get_author_posts_url( $user['ID'] ) . '"><span class="bimber-mycred-leaderboard-widget-avatar">' . get_avatar( $user['ID'], 80 ) . $rank_logo . '</span></a>';
		$layout = str_ireplace( '%avatar_large%', $avatar, $layout );
	}
	return $layout;
}

/**
 * Enqueue admin script for leaderboard widget
 *
 * @param string $hook Current page.
 */
function bimber_mycred_admin_script( $hook ) {
		wp_enqueue_script( 'bimber-mycred-admin', BIMBER_PLUGINS_DIR_URI . 'js/mycred-admin.js', array( 'jquery' ), bimber_get_theme_version(), true );
}

/**
 * Overwrite leaderboard output if default template
 *
 * @param string 				   $output Output.
 * @param array 				   $args	Args.
 * @param myCRED_Query_Leaderboard $object Object.
 * @return string
 */
function bimber_mycred_override_leaderboard_output( $output, $args, $object ) {
	if ( '' === $args['template'] ) {
		$args['template'] = '<span class="g1-beta g1-beta-1st bimber-mycred-leaderboard-pos">%position%</span> %avatar% <h3 class="g1-delta g1-delta-1st bimber-mycred-leaderboard-user">%user_profile_link%</h3> <span class="g1-meta bimber-mycred-leaderboard-balance">%cred_f%</span>';
		$leaderboard = mycred_get_leaderboard( $args );
		$leaderboard->get_leaderboard_results( false );
		$output = do_shortcode( $leaderboard->render( $args, '' ) );
		$output = str_replace( 'myCRED-leaderboard list-unstyled', 'myCRED-leaderboard list-unstyled bimber-mycred-leaderboard', $output );
	}
	if ( 'page' === $args['template'] ) {
		$args['template'] = '<span class="g1-beta g1-beta-1st bimber-mycred-leaderboard-pos">%position%</span> %avatar_large% <h3 class="g1-gamma g1-gamma-1st bimber-mycred-leaderboard-user">%user_profile_link%</h3> <span class="g1-meta bimber-mycred-leaderboard-balance">%cred_f% ' . __( 'pts','bimber' ) . '</span>';
		$leaderboard = mycred_get_leaderboard( $args );
		$leaderboard->get_leaderboard_results( false );
		$output = do_shortcode( $leaderboard->render( $args, '' ) );
		$output = str_replace( 'myCRED-leaderboard list-unstyled', 'myCRED-leaderboard list-unstyled bimber-mycred-leaderboard', $output );
	}
	return $output;
}

/**
 * Render badges in Written by.. box
 */
function bimber_mycred_add_badges_to_author_box() {
	$user_id = get_the_author_meta( 'ID' );
	mycred_display_users_badges( $user_id );
}

/**
 * Fix the navigation current tab style.
 *
 * @return string
 */
function bimber_bp_mycred_nav_current( $nav_menu, $args  ) {
	$nav_menu = explode( '<li', $nav_menu );
	foreach ( $nav_menu as $index => $item ) {
		if ( 'mycred-history' === bp_current_component() && strpos( $item, 'mycred-history-personal-li' ) > -1 ) {
			$nav_menu[ $index ] = str_replace( 'g1-tab-item', 'g1-tab-item g1-tab-item-current ', $item );
		}
	}
	$nav_menu = implode( '<li', $nav_menu );
	return $nav_menu;
}

/**
 * Modify badge post type args.
 *
 * @param  array $args
 * @return array
 */
function bimber_mycred_badge_post_type_args( $args ) {
	$args['supports'][] = 'page-attributes';
	$args['supports'][] = 'excerpt';
	return $args;
}

/**
 * Render ranks in author info box
 *
 * @param int $user_id  User id.
 */
function bimber_mycred_render_rank_in_author_info_box( $user_id ) {
	$rank = mycred_get_users_rank( $user_id );
	if ( ! $rank ) {
		return;
	}
	?>
		<img src="<?php echo esc_url( $rank->logo_url );?>" class="author-info-rank" title="<?php echo $rank->title;?>">
	<?php
}

/**
 * Render ranks in author info box
 *
 * @param int $user_id  User id.
 */
function bimber_mycred_render_rank_text( $user_id ) {
	$rank = mycred_get_users_rank( $user_id );
	echo esc_html( $rank->title );
}

/**
 * Add Years of service badge
 *
 * @param  array $badge_ids  Badge ids.
 * @param  int   $user_id	 User id.
 * @return array
 */
function bimber_mycred_add_years_of_service_badge( $badge_ids, $user_id ) {
	$yos_badge_id = apply_filters( 'bimber_mycred_years_of_service_badge_id', false );
	if ( false === $yos_badge_id ) {
		return $badge_ids;
	}
	$data = get_userdata( $user_id );
	$registered = (int) strtotime( $data->user_registered );
	$ago = round( ( time() - $registered ) / 31556926 , 0, PHP_ROUND_HALF_DOWN );
	$current_yos_bagde_set = isset( $badge_ids[ $yos_badge_id ] ) ? $badge_ids[ $yos_badge_id ] + 1 : 0;
	if ( $ago > $current_yos_bagde_set ) {
		$badge = mycred_get_badge( $yos_badge_id, 0 );
		if ( count( $badge->levels ) >= $ago ) {
			mycred_assign_badge_to_user( $user_id, $yos_badge_id, $ago - 1 );
		}
		$badge_ids[ $yos_badge_id ] = $ago - 1;
	}
	return $badge_ids;
}

/**
 * Undocumented function
 *
 * @param mixed $badge_id Int badge id or false if doesn't exits.
 * @return mixed
 */
function bimber_mycred_get_default_imported_yos_badge( $badge_id ) {
	$badge = get_posts(array(
		'post_type' => 'mycred_badge',
		'meta_query'          => array(
			array(
				'key'     => '_bimber_mycred_import_slug',
				'compare' => '=',
				'value'   => 'badge-years',
			),
		),
	));
	if ( ! empty( $badge ) ) {
		return $badge[0]->ID;
	}
	return $badge_id;
}

add_filter( 'bp_pre_user_query', 'bimber_bp_mycred_apply_sorting_by_most_points', 10, 1 );

/**
 * Aplly 'most_points" sorting in BP.
 *
 * @param BP_User_Query $query The query.
 */
function bimber_bp_mycred_apply_sorting_by_most_points( $query ) {
	if ( 'most_points' === $query->query_vars_raw['type'] ) {
		global $wpdb;
		if ( is_multisite() ) {
			$row = 'mycred_default_' . get_current_blog_id();
		} else {
			$row = 'mycred_default';
		}
		$join = " LEFT JOIN {$wpdb->usermeta} um ON (um.user_id = u.ID  AND um.meta_key = '{$row}')";
		$query->uid_clauses['select'] .= $join;
		$query->uid_clauses['orderby'] = "ORDER BY cast(um.meta_value as unsigned) DESC";
	}
}

add_action( 'bimber_buddypress_member_sorting_options', 'bimber_bp_mycred_add_sorting_users_by_most_points' );
/**
 * Add option to sort user by most points.
 */
function bimber_bp_mycred_add_sorting_users_by_most_points() {
	?>
		<option value="most_points"><?php _e( 'Most points', 'bimber' ); ?></option>
	<?php
}
