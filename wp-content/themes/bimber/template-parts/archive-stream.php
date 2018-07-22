<?php
/**
 * The Template for displaying archive body.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 4.10
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<?php
$bimber_template_data = bimber_get_template_part_data();
?>

<?php
if ( bimber_show_archive_featured_entries() ) :
	get_template_part( 'template-parts/featured/' . bimber_get_theme_option('archive', 'featured_entries_template') );
	get_template_part( 'template-parts/ads/ad-after-featured-content' );
endif;
?>

<?php if ( have_posts() ) : ?>
	<div class="g1-row g1-row-layout-page archive-body archive-body-stream">
		<div class="g1-row-inner">

			<div class="g1-column g1-column-1of6">
				<?php get_template_part( 'template-parts/ads/ad-left-stream' ); ?>
			</div>

			<div id="primary" class="g1-column g1-column-2of3">

				<?php get_template_part( 'template-parts/collection/title', 'archive' ); ?>

				<div class="g1-collection">
					<div class="g1-collection-viewport">
						<ul class="g1-collection-items">
							<?php $bimber_post_number = 0; ?>
							<?php while ( have_posts() ) : the_post();
								$bimber_post_number ++; ?>
								<?php do_action( 'bimber_archive_loop_before_post', 'stream', $bimber_post_number ); ?>

								<li class="g1-collection-item">
									<?php get_template_part( 'template-parts/content-stream', get_post_format() ); ?>
								</li>

								<?php do_action( 'bimber_archive_loop_after_post', 'stream', $bimber_post_number ); ?>
							<?php endwhile; ?>
						</ul>
					</div>

					<?php get_template_part( 'template-parts/archive/pagination', $bimber_template_data['pagination'] ); ?>
				</div><!-- .g1-collection -->

			</div><!-- .g1-column -->

			<div class="g1-column g1-column-1of6">
				<?php get_template_part( 'template-parts/ads/ad-left-stream' ); ?>
			</div>

		</div>
		<div class="g1-row-background"></div>
	</div><!-- .g1-row -->
<?php else : ?>
	<?php get_template_part( 'template-parts/archive/notice-no-results' ); ?>
<?php endif;
