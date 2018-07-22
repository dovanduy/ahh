<?php
/**
 * The Template Part for displaying "About Author" box.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.3.2
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<?php
	$author_bio = apply_filters( 'bimber_author_info_box_bio', get_the_author_meta( 'description' ), get_the_author_meta( 'ID' ) );
	if ( post_type_supports( get_post_type(), 'author' ) && $author_bio ) : ?>
	<section class="g1-row author-info" itemscope="" itemtype="http://schema.org/Person">
		<div class="g1-row-inner author-info-inner">
			<div class="g1-column author-overview">

				<figure class="author-avatar">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<?php echo get_avatar( get_the_author_meta( 'email' ), 80 );
						do_action( 'bimber_author_box_after_avatar', get_the_author_meta( 'ID' ) );
						?>

					</a>
				</figure>

				<header class="author-title">
					<h2 class="g1-delta g1-delta-1st"><?php 
					global $allowedposttags;
					$bimber_allowedposttags = $allowedposttags;
					$bimber_allowedposttags['span']['itemprop'] = true;
					printf( wp_kses( __( 'Written by <a href="%s"><span itemprop="name" >%s</span></a>', 'bimber' ), $bimber_allowedposttags ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() ); ?></h2>
				</header>

				<div itemprop="description" class="author-bio">
					<?php
					echo wp_kses_post( wpautop( $author_bio ) );
					?>
				</div>

				<?php
				if ( bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) && apply_filters( 'bimber_display_g1_socials_in_author_box', true ) ) {
					echo do_shortcode( '[g1_socials_user user="' . get_the_author_meta( 'ID' ) . '" icon_size="28" icon_color="text"]' );
				}
				do_action( 'bimber_author_after_name' );?>
			</div>
		</div>
	</section>
<?php endif;
