<?php
/**
 * The Template Part for displaying the footer.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<?php
if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	do_action( 'bimber_above_footer' );
}
?>
<?php if ( bimber_show_prefooter() ) : ?>
	<div class="g1-row g1-row-layout-page g1-prefooter">
		<div class="g1-row-inner">

			<div class="g1-column g1-column-1of3">
				<?php
				if ( is_active_sidebar( 'footer-1' ) ) {
					dynamic_sidebar( 'footer-1' );
				}
				?>
			</div>

			<div class="g1-column g1-column-1of3">
				<?php
				if ( is_active_sidebar( 'footer-2' ) ) {
					dynamic_sidebar( 'footer-2' );
				}
				?>
			</div>

			<div class="g1-column g1-column-1of3">
				<?php
				if ( is_active_sidebar( 'footer-3' ) ) {
					dynamic_sidebar( 'footer-3' );
				}
				?>
			</div>

		</div>
		<div class="g1-row-background">
		</div>
	</div>
<?php endif; ?>

<div class="g1-row g1-row-layout-page g1-footer">
	<div class="g1-row-inner">
		<div class="g1-column">

			<p class="g1-footer-text"><?php bimber_render_footer_text(); ?></p>

			<?php
			if ( has_nav_menu( 'bimber_footer_nav' ) ) :
				wp_nav_menu( array(
					'theme_location'  => 'bimber_footer_nav',
					'container'       => 'nav',
					'container_class' => 'g1-footer-nav',
					'container_id'    => 'g1-footer-nav',
					'menu_class'      => '',
					'menu_id'         => 'g1-footer-nav-menu',
					'depth'           => 0,
				) );
			endif;
			?>

			<?php get_template_part( 'template-parts/footer-stamp' ); ?>

		</div><!-- .g1-column -->
	</div>
	<div class="g1-row-background">
	</div>
</div><!-- .g1-row -->

<?php if ( apply_filters( 'bimber_render_back_to_top', true ) ) : ?>
	<a href="#page" class="g1-back-to-top"><?php esc_html_e( 'Back to Top', 'bimber' ); ?></a>
<?php endif; ?>

</div><!-- #page -->

<?php /* @todo
<div class="g1-popup">
	<div class="g1-popup-inner">
		<?php get_search_form(); ?>
	</div>
	<a class="g1-popup-close"></a>
</div>
*/ ?>

<div class="g1-canvas-overlay"></div>

</div><!-- .g1-body-inner -->
<div id="g1-breakpoint-desktop"></div>
<?php
get_template_part( 'template-parts/header-builder/off-canvas' );
?>

<?php wp_footer(); ?>
</body>
</html>
