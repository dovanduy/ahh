<?php
/**
 * The Template for displaying pages.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 4.10.3
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
get_header();
?>
	<div id="primary" class="g1-primary-max bimber-buddypress-profile">
		<div id="content" role="main">
			<?php
			while ( have_posts() ) : the_post();
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope=""
						 itemtype="<?php echo esc_attr( bimber_get_entry_microdata_itemtype() ); ?>">
					<div id="buddypress">

						<div class="g1-row-notices">
							<?php
							/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
							do_action( 'template_notices' );
							?>
						</div>

						<?php
						$bimber_class = array(
							'g1-row',
							'g1-row-layout-page',
						);

						if ( bp_displayed_user_use_cover_image_header() ) {
							$bimber_class[] = 'item-wrapper-with-cover-image';
						} else {
							$bimber_class[] = 'item-wrapper-without-cover-image';
						}
						?>

						<?php if ( bp_displayed_user_use_cover_image_header()) : ?>
							<?php bp_get_template_part( 'members/single/cover-image-header' ); ?>
						<?php endif;?>
						<?php bp_get_template_part( 'members/single/member-header' ); ?>

						<div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $bimber_class ) ); ?>" id="item-wrapper">
							<div class="g1-row-inner">

								<?php
								$bimber_class = array();
								$bimber_class[] = 'bp-layout-standard';
								?>
								<div class="g1-column" id="item-content">
									<div class="entry-content">
										<?php
										the_content();
										wp_link_pages();
										?>
									</div><!-- .entry-content -->
								</div>
							</div>

							<div class="g1-row-background">
							</div>
						</div><!-- .g1-row -->

					</div><!-- #buddypress -->

				</article><!-- #post-## -->

			<?php
				endwhile;
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer();
