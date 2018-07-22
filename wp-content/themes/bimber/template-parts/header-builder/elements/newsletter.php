<?php
/**
 * Header Builder template
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
?>
<?php if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) : ?>
		<div class="g1-drop g1-drop-before g1-drop-the-newsletter <?php bimber_hb_get_element_class_from_settings( 'newsletter' );?>">
			<a class="g1-drop-toggle" href="<?php echo esc_url( home_url( '/?s=' ) ); ?>">
				<i class="g1-drop-toggle-icon"></i><?php esc_html_e( 'Subscribe', 'bimber' ); ?>
				<span class="g1-drop-toggle-arrow"></span>
			</a>

			<div class="g1-drop-content">
				<div class="g1-newsletter">
					<?php
					if ( shortcode_exists( 'mc4wp_form' ) ) {
						remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10 );
						remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );

						echo do_shortcode( '[mc4wp_form]' );

						add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
						add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
					}

					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
