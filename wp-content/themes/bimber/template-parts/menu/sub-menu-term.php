<?php
/**
 * The Template for displaying term mega-menu (from category, tag or custom taxonomy).
 *
 * @package Bimber_Theme 4.10
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<div class="sub-menu-wrapper">
	<div class="g1-row">
		<div class="g1-row-inner">
			<div class="g1-column">

				<div class="g1-collection g1-collection-columns-4">

					<?php if ( $bimber_query->have_posts() ) : ?>
						<div class="g1-collection-viewport">
							<ul class="g1-collection-items">
								<?php while( $bimber_query->have_posts() ) : $bimber_query->the_post(); ?>
									<li class="g1-collection-item">
										<?php
										bimber_set_template_part_data( array(
											'elements' => array(
												'featured_media' => true,
												'avatar'         => false,
												'categories'     => false,
												'title'          => true,
												'summary'        => false,
												'author'         => false,
												'date'           => false,
												'shares'         => false,
												'views'          => false,
												'comments_link'  => false,
											),
										) );

										get_template_part( 'template-parts/content-grid-s' );
										?>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php wp_reset_postdata(); ?>
				</div><!-- .g1-collection -->

			</div>
		</div>
	</div>

</div>