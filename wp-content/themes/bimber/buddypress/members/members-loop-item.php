<?php
/**
 * BuddyPress - Members Loop item
 *
 * @package Bimber
 */

 
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}?>

	<div class="g1-members-item">
		<a href="<?php bp_member_permalink(); ?>">
		<?php
			$member_cover_image_url = bp_attachments_get_attachment('url', array(
				'object_dir' => 'members',
				'item_id' => bp_get_member_user_id(),
			));
			$member_cover_image_url = apply_filters( 'bimber_bp_member_cover_image_url', $member_cover_image_url );
			if ( ! empty( $member_cover_image_url ) ) :
		?>
			<div class="item-cover" style="background-image:url(<?php echo esc_url( $member_cover_image_url ); ?>)"></div>
		<?php else :?>
			<div class="item-cover"></div>
		<?php endif;?>
		</a>

		<div class="item-avatar">
			<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(array(
					'width'     => 80,
					'height'    => 80,
					'type'      => 'full',
			));
			do_action( 'bimber_buddypress_memebers_after_avatar', bp_get_member_user_id() );
			?>
		</a>
		</div>

		<div class="item">
			<div class="g1-beta item-title">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
			</div>
			<div class="item-desc">
				<?php
				$description = xprofile_get_field_data( bimber_bp_get_short_description_field_name(), bp_get_member_user_id() );
				echo esc_html( strip_tags( $description ) );?>
			</div>
			<?php
			/**
			 * Fires inside the display of a directory member item.
			 *
			 * @since 1.1.0
		`	 */
		do_action( 'bp_directory_members_item' ); ?>

		</div>

		<div class="clear"></div>
	</div>
