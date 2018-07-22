<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div id="cover-image-container" class="g1-row g1-row-layout-full bp-layout-bunchy">
	<a id="header-cover-image" href="<?php bp_displayed_user_link(); ?>"></a>
	<div class="g1-row-inner">
		<div class="g1-column">
			<?php if ( bimber_bp_show_cover_image_change_link() ) : ?>
				<?php bimber_bp_render_cover_image_change_link(); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="g1-row-background" id="item-header-cover-image">
	</div><!-- #item-header-cover-image -->

</div><!-- #cover-image-container -->
