<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_group_header' ); ?>

<div class="g1-column g1-column-2of3" id="cover-image-container">
	<a id="header-cover-image" href="<?php bp_group_permalink(); ?>"></a>

	<?php if ( bimber_bp_show_group_cover_image_change_link() ) : ?>
		<?php bimber_bp_render_group_cover_image_change_link(); ?>
	<?php endif; ?>

	<div id="item-header-cover-image">
		<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
			<div id="item-header-avatar">
				<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

					<?php bp_group_avatar(); ?>

				</a>
			</div><!-- #item-header-avatar -->
		<?php endif; ?>


		<div id="item-actions">

			<?php if ( bp_group_is_visible() ) : ?>

				<h3><?php _e( 'Group Admins', 'buddypress' ); ?></h3>

				<?php bp_group_list_admins();

				/**
				 * Fires after the display of the group's administrators.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_after_group_menu_admins' );

				if ( bp_group_has_moderators() ) :

					/**
					 * Fires before the display of the group's moderators, if there are any.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_before_group_menu_mods' ); ?>

					<h3><?php _e( 'Group Mods' , 'buddypress' ); ?></h3>

					<?php bp_group_list_mods();

					/**
					 * Fires after the display of the group's moderators, if there are any.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_after_group_menu_mods' );

				endif;

			endif; ?>

		</div><!-- #item-actions -->

	</div><!-- #item-header-cover-image -->
</div><!-- #cover-image-container -->

<?php

/**
 * Fires after the display of a group's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_group_header' );

/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
do_action( 'template_notices' ); ?>
