<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="bp-layout-standard" id="cover-image-container">
	<span id="header-cover-image"></span>

			<?php if ( bimber_bp_show_cover_image_change_link() ) : ?>
				<?php bimber_bp_render_cover_image_change_link(); ?>
			<?php endif; ?>

	<div id="item-header-cover-image">
	</div><!-- #item-header-cover-image -->

</div><!-- #cover-image-container -->
