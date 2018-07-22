<?php
/**
 * BuddyPress Followers plugin functions
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

add_action( 'bimber_bp_members_counters', 'bimber_bp_members_counter_followers', 7 );

/**
 * Add followers counter
 */
function bimber_bp_members_counter_followers() {
	$args = [
		'user_id' => bp_get_member_user_id(),
	]
	?>
	<div class="item-counters-counter">
	<div class="item-counters-counter-value"><?php echo esc_html( count( bp_follow_get_followers( $args ) ) ); ?></div>
		<div class="g1-meta"><?php esc_html_e( 'Followers', 'bimber' ); ?></div>
	</div>
	<?php
}

/**
 * Add a "Users I'm following" widget for the logged-in user
 *
 * @subpackage Widgets
 */
class BP_Follow_Followers_Widget extends WP_Widget {
	/**
	 * Constructor.
	 */
	function __construct() {
		// Set up optional widget args
		$widget_ops = array(
			'classname'   => 'widget_bp_follow_following_widget widget buddypress',
			'description' => __( 'Show a list of member avatars of the user\'s followers.', 'bimber' )
		);

		// Set up the widget
		parent::__construct(
			false,
			__( "(BP Follow) Followers", 'bp-follow' ),
			$widget_ops
		);
	}

	/**
	 * Displays the widget.
	 */
	function widget( $args, $instance ) {
		// do not do anything if user isn't logged in


		if ( empty( $instance['max_users'] ) ) {
			$instance['max_users'] = 16;
		}

		// logged-in user isn't following anyone, so stop!
		if ( ! $following = bp_follow_get_followers( array( 'user_id' => bp_displayed_user_id() ) ) ) {
			return false;
		}

		// show the users the logged-in user is following
		if ( bp_has_members( array(
			'include'         => $following,
			'max'             => $instance['max_users'],
			'populate_extras' => false,
		) ) ) {
			do_action( 'bp_before_following_widget' );

			echo $args['before_widget'];
			echo $args['before_title']
			   . $instance['title']
			   . $args['after_title'];
	?>

			<div class="avatar-block">
				<?php while ( bp_members() ) : bp_the_member(); ?>
					<div class="item-avatar">
						<a href="<?php bp_member_permalink() ?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar() ?></a>
					</div>
				<?php endwhile; ?>
			</div>

			<?php echo $args['after_widget']; ?>

			<?php do_action( 'bp_after_following_widget' ); ?>

	<?php
		}
	}

	/**
	 * Callback to save widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['max_users'] = (int) $new_instance['max_users'];

		return $instance;
	}

	/**
	 * Widget settings form.
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'     => __( 'Followers', 'bimber' ),
			'max_users' => 16,
		) );
	?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

		<p><label for="bp-follow-widget-users-max"><?php _e( 'Max members to show:', 'bp-follow' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'max_users' ); ?>" name="<?php echo $this->get_field_name( 'max_users' ); ?>" type="text" value="<?php echo esc_attr( (int) $instance['max_users'] ); ?>" style="width: 30%" /></label></p>
		<p><small><?php _e( 'Note: This widget is only displayed if a member is logged in and if the logged-in user is following some users.', 'bp-follow' ); ?></small></p>

	<?php
	}
}

add_action( 'widgets_init', create_function( '', 'return register_widget("BP_Follow_Followers_Widget");' ) );


add_action( 'bp_setup_nav', 'bimber_bp_followers_nav', 100 );
/**
 * Fix the navigation.
 */
function bimber_bp_followers_nav() {
	global $bp;

	$parent_nav = $bp->members->nav->get_primary( array( 'slug' => 'followers' ), false );
	$parent_nav['followers']['name'] = str_replace( '<span>', '<span class="count">', $parent_nav['followers']['name']);
	$parent_nav = $bp->members->nav->get_primary( array( 'slug' => 'following' ), false );
	$parent_nav['following']['name'] = str_replace( '<span>', '<span class="count">', $parent_nav['following']['name']);

}

add_filter( 'bp_nav_menu', 'bimber_bp_followers_nav_current', 100, 2 );

/**
 * Fix the navigation current tab style.
 *
 * @return string
 */
function bimber_bp_followers_nav_current( $nav_menu, $args  ) {
	$nav_menu = explode( '<li', $nav_menu );
	foreach ( $nav_menu as $index => $item ) {
		if ( 'following' === bp_current_component() && strpos( $item, 'following-personal-li' ) > -1 ) {
			$nav_menu[ $index ] = str_replace( 'g1-tab-item', 'g1-tab-item g1-tab-item-current ', $item );
		}
		if ( 'followers' === bp_current_component() && strpos( $item, 'followers-personal-li' ) > -1 ) {
			$nav_menu[ $index ] = str_replace( 'g1-tab-item', 'g1-tab-item g1-tab-item-current', $item );
		}
	}
	$nav_menu = implode( '<li', $nav_menu );
	return $nav_menu;
}

add_filter( 'gettext', 'bimber_bp_followers_tab_span_class', 20, 3 );

/**
 * Add class to count span in tabs.
 *
 * @param  string $translated_text 		Translated text.
 * @param  string $untranslated_text	Untranslated text.
 * @param  string $domain				Domain.
 * @return string
 */
function bimber_bp_followers_tab_span_class( $translated_text, $untranslated_text, $domain ) {

	if ( $untranslated_text == 'Following <span>%d</span>' && $domain = 'bp-follow' ) {
		$translated_text = __( 'Following <span class="count">%d</span>', 'bp-follow' );
	}
	return $translated_text;
}
