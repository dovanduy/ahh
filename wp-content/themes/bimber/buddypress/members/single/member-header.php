<?php
/**
 * The Template for displaying member header.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}?>
<div class="g1-row">
	<div class="g1-row-inner member-header-wrapper">
		<div class="g1-column  member-header bp-layout-standard">
			<div id="item-header">
				<?php
				/**
				 * Fires before the display of a member's header.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_member_header' );
				?>
				<div id="item-header-avatar">
					<a href="<?php bp_displayed_user_link(); ?>">
						<?php
							bp_displayed_user_avatar( array(
								'width'     => 160,
								'height'    => 160,
								'type'      => 'full',
							) );
							do_action( 'bimber_buddypress_memebers_after_avatar', bp_displayed_user_id() );
						?>
					</a>
					<?php if ( bimber_bp_show_profile_photo_change_link()  ) : ?>
						<?php bimber_bp_render_profile_photo_change_link(); ?>
					<?php endif; ?>
				</div><!-- #item-header-avatar -->
				<div class="item-header-member-info">
					<h1 class="g1-alpha g1-alpha-1st entry-title"><?php bp_displayed_user_fullname(); ?>
						<sup><?php do_action( 'bimber_buddypress_memebers_after_user_name', bp_displayed_user_id() );?></sup>
					</h1>
					<?php if ( function_exists( 'xprofile_get_field_data' ) ) : ?>
					<span class="item-header-user-desc"><?php
						$description = xprofile_get_field_data( bimber_bp_get_short_description_field_name(), bp_displayed_user_id() );
						echo esc_html( strip_tags( $description ) );
					?></span>
					<?php endif; ?>
					<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>
				</div>

				<?php
				/**
				 * Fires after the display of a member's header.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_after_member_header' );
				?>
			</div><!-- #item-header -->

			<div id="item-header-content">
					<?php
					/**
					 * Fires before the display of the member's header meta.
					 *
					 * @since 1.2.0
					 */
					do_action( 'bp_before_member_header_meta' ); ?>
				<div id="item-meta">
					<?php
					/**
					 * Fires after the group header actions section.
					 *
					 * If you'd like to show specific profile fields here use:
					 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
					 *
					 * @since 1.2.0
					 */
					do_action( 'bp_profile_header_meta' );
					?>
				</div><!-- #item-meta -->
				<?php
				/**
				 * Fires after the display of the member's header meta.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_after_member_header_meta' ); ?>
			</div><!-- #item-header-content -->
			<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>
			<div id="item-buttons" class="bimber-item-buttons g1-dropable">
				<?php
				if ( ! is_user_logged_in() && bimber_can_use_plugin( 'snax/snax.php' ) ) {
					bimber_bp_actions_placeholder();
				} else {
					/**
					 * Fires in the member header actions section.
					 *
					 * @since 1.2.6
					 */
					do_action( 'bp_member_header_actions' );
					// Close dropdown, matching opening tags are in bimber_bp_open_action_dropdown().
					echo '</ul></div></div>';
				}
				?>
			</div><!-- #item-buttons -->
		</div>
	</div>
	<div class="g1-row-background g1-background-bp-profile">
	</div>
</div>
