<?php
/**
 * The template part for displaying the header of AMP.
 *
 * @package Bimber_Theme 5.0
 */
?>
<?php
if ( apply_filters( 'bimber_show_ad_before_header_theme_area', true ) ) :
	get_template_part( 'template-parts/ads/ad-before-header-theme-area' );
endif;
?>
<div class="g1-header g1-row g1-row-layout-page">
	<div class="g1-row-inner">
		<div class="g1-column">
			<div class="g1-hamburger g1-hamburger-show" on="tap:g1-canvas.toggle" role="button" tabindex="10">
				<span class="g1-hamburger-icon"></span>
				<span class="g1-hamburger-label"><?php esc_html_e( 'Menu', 'bimber' ); ?></span>
			</div>

			<?php get_template_part( 'amp/id' ); ?>

		</div>
	</div>
	<div class="g1-row-background">
	</div>
</div>
<?php get_template_part( 'template-parts/ads/ad-before-content-theme-area' );