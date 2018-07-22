<?php
/**
 * The Template for displaying newsletter.
 *
 * @package Bimber_Theme 5.3.2
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) :
	$newsletter_avatar = bimber_get_theme_option( 'newsletter', 'above_collection_avatar' );
	$newsletter_title = bimber_get_theme_option( 'newsletter', 'above_collection_title' );
	$newsletter_subtitle = bimber_get_theme_option( 'newsletter', 'above_collection_subtitle' );
	$section_classes   = apply_filters( 'bimber_newsletter_large_class', array(
		'g1-section',
		'g1-section-newsletter',
		'g1-section-large',
		'g1-light',
		'g1-box',
		'g1-newsletter',
		'g1-newsletter-horizontal',
	) );
	if ( ! empty( $newsletter_avatar ) ) {
		$section_classes[] = 'g1-section-with-avatar';
	}
?>
<div class="<?php echo( join( ' ', $section_classes ) ); ?>">
	<i class="g1-box-icon"></i>
	<div class="g1-section-body">
		<?php
		if ( ! empty( $newsletter_avatar ) ) {
			$avatar_id = bimber_get_attachment_id_by_url( $newsletter_avatar );
			if ( $avatar_id ) {
				?>
					<div class="g1-section-img"><?php echo wp_get_attachment_image( $avatar_id ); ?></div>
				<?php
			}
		}
		?>
		<?php if ( ! empty( $newsletter_title ) ) : ?>
			<h3 class="g1-section-title g1-mega g1-mega-1st"><?php echo( wp_kses_post( $newsletter_title ) ); ?></h3>
		<?php endif; ?>
		<?php if ( ! empty( $newsletter_subtitle ) ) : ?>
			<h2 class="g1-delta g1-delta-3rd"><?php echo( wp_kses_post( $newsletter_subtitle ) ); ?></h2>
		<?php endif; ?>
	</div>
	<div class="g1-section-form-wrap g1-newsletter g1-newsletter-section-large">
		<?php
		bimber_mc4wp_render_shortcode();
		?>
	</div>
</div>
<?php
else :
	get_template_part( 'template-parts/newsletter/notice-plugin-required' );
endif;
