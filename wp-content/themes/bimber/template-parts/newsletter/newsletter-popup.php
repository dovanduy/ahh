<?php
/**
 * Newsletter popup
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.3.5
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
if ( ! bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ){ return; }
$newsletter_large_cover = bimber_get_theme_option( 'newsletter', 'popup_cover' );
$newsletter_title = bimber_get_theme_option( 'newsletter', 'popup_title' );
$newsletter_subtitle = bimber_get_theme_option( 'newsletter', 'popup_subtitle' );
?>
<div class="g1-popup g1-popup-newsletter">
	<div class="g1-popup-overlay">
	</div>

	<div class="g1-popup-inner">
		<div class="g1-newsletter">
			<div class="g1-newsletter-cover">
				<?php if ( ! empty( $newsletter_large_cover ) ) : ?>
					<div class="g1-newsletter-cover-background" style="background-image:url(<?php echo( esc_url( $newsletter_large_cover ) ); ?>);">
					</div>
				<?php endif; ?>
			</div>

			<div class="g1-newsletter-content">
				<?php if ( ! empty( $newsletter_title ) ) : ?>
					<h3 class="g1-mega g1-mega-1st"><?php echo( wp_kses_post( $newsletter_title ) ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $newsletter_subtitle ) ) : ?>
					<p><?php echo( esc_html( $newsletter_subtitle ) ); ?></p>
				<?php endif; ?>

				<div class="g1-newsletter-form-wrap">
					<?php bimber_mc4wp_render_shortcode(); ?>
				</div>
			</div>
		</div><!-- .g1-newsletter -->

		<a href="#" class="g1-popup-closer"></a>
	</div>
</div><!-- .g1-popup -->
