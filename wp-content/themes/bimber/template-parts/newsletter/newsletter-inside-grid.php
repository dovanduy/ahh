<?php
/**
 * The template part for a newsletter sign-up form inside a grid collection.
 *
 * @package Bimber_Theme 5.4
 */

?>
<li class="g1-collection-item g1-collection-item-1of3">
	<?php if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) : ?>
		<?php
			$bimber_classes = array(
				'g1-box',
				'g1-newsletter',
			);

			$bimber_classes = apply_filters( 'bimber_newsletter_inside_grid_class', $bimber_classes );
		?>

		<aside class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $bimber_classes ) ); ?>">
			<i class="g1-box-icon"></i>

			<header>
				<?php bimber_render_section_title( esc_html__( 'Newsletter', 'bimber' ) ); ?>
			</header>

			<?php bimber_mc4wp_render_shortcode( 'grid' ); ?>

			<div class="g1-box-background">
			</div>
		</aside>

	<?php else : ?>

		<?php get_template_part( 'template-parts/newsletter/notice-plugin-required' ); ?>

	<?php endif; ?>
</li>
