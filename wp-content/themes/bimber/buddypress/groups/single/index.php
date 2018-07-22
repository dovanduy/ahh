<?php
/**
 * The Template for displaying pages.
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

get_header();
?>
	<div id="primary" class="g1-primary-max">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( bp_has_groups() ) : ?>
				<?php while ( bp_groups() ) : bp_the_group(); ?>
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

							if ( bp_group_use_cover_image_header() ) {
								$bimber_class[] = 'item-wrapper-with-cover-image';
							} else {
								$bimber_class[] = 'item-wrapper-without-cover-image';
							}
							?>

							<div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $bimber_class ) ); ?>" id="item-wrapper">
								<div class="g1-row-inner">

									<?php
									/**
									 * If the cover image feature is enabled, use a specific header
									 */
									if ( bp_group_use_cover_image_header() ) :
										bp_get_template_part( 'groups/single/cover-image-header' );
									else :
										bp_get_template_part( 'groups/single/group-header' );
									endif;
									?>

									<div id="item-header" role="complementary" class="g1-column g1-column-1of3">

										<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
											<div id="item-header-avatar">
												<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

													<?php bp_group_avatar(); ?>

												</a>

												<?php if ( bimber_bp_show_group_photo_change_link() ) : ?>
													<?php bimber_bp_render_group_photo_change_link(); ?>
												<?php endif; ?>

											</div><!-- #item-header-avatar -->
										<?php endif; ?>

										<?php the_title( '<h1 class="g1-alpha g1-alpha-2nd entry-title">', '</h1>' ); ?>

									</div><!-- #item-header -->

									<div id="item-header-content" class="g1-column g1-column-1of3">

										<div id="item-buttons"><?php

											/**
											 * Fires in the group header actions section.
											 *
											 * @since 1.2.6
											 */
											do_action( 'bp_group_header_actions' ); ?></div><!-- #item-buttons -->

										<?php

										/**
										 * Fires before the display of the group's header meta.
										 *
										 * @since 1.2.0
										 */
										do_action( 'bp_before_group_header_meta' ); ?>

										<div id="item-meta">

											<?php

											/**
											 * Fires after the group header actions section.
											 *
											 * @since 1.2.0
											 */
											do_action( 'bp_group_header_meta' ); ?>

											<span class="highlight"><?php bp_group_type(); ?></span>
											<span class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span>

											<?php bp_group_description(); ?>

										</div>

										<?php

										/**
										 * Fires after the display of the group's header meta.
										 *
										 * @since 1.2.0
										 */
										do_action( 'bp_after_group_header_meta' ); ?>

									</div><!-- #item-header-content -->


									<div class="g1-column g1-column-2of3" id="item-content">
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

				<?php endwhile; ?>
			<?php endif; ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer();
