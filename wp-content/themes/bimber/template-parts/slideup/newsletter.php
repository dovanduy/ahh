<?php
/**
 * Newsletter slideup
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
if ( ! bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) { return; }
$newsletter_avatar = bimber_get_theme_option( 'newsletter', 'slideup_avatar' );
$newsletter_title = bimber_get_theme_option( 'newsletter', 'slideup_title' );
$newsletter_slideup_classes = apply_filters( 'newsletter_slideup_classes', array( 'g1-slideup-newsletter' ) );
?>
<div class="g1-slideup-wrap">
	<div class="g1-slideup-base"></div>
	<div class="<?php echo( esc_attr( implode( ' ', $newsletter_slideup_classes ) ) ); ?>">
		<?php
		if ( ! empty( $newsletter_avatar ) ) {
			$avatar_id = bimber_get_attachment_id_by_url( $newsletter_avatar );
			if ( $avatar_id ) {
				?>
					<div class="g1-slideup-newsletter-avatar"><?php echo wp_get_attachment_image( $avatar_id ); ?></div>
				<?php
			}
		}
		?>
		<div class="g1-slideup-newsletter-body">
			<?php if ( ! empty( $newsletter_title ) ) : ?>
				<h3 class="g1-slideup-newsletter-title g1-mega g1-mega-1st"><?php echo( wp_kses_post( $newsletter_title ) ); ?></h3>
			<?php endif; ?>
			<div class="g1-slideup-newsletter-form-wrap g1-newsletter g1-newsletter-horizontal">
				<?php
					bimber_mc4wp_render_shortcode();
				?>
			</div>
		</div>
	</div>
	<a href="#" class="g1-slideup-newsletter-closer"></a>
</div>
<?php
