<?php
/**
 * The Template Part for displaying instagram.
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
// Make sure that we have wp-instagram-widget on board. If not leave!
if ( ! bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) ) {
	return;
}
$username = bimber_get_theme_option( 'instagram', 'username' );
if ( empty( $username ) ) {
	return;
}
$follow_text = bimber_get_theme_option( 'instagram', 'follow_text' );
$user_instagram_url = trailingslashit( '//instagram.com/' . trim( str_replace( '@', '', $username ) ) );
$args = array(
	'title'               => '',
	'username'            => $username,
	'limit'               => 12,
	'target'              => '_blank',
	'afterwidget_details' => false,
);
$instance = array(
	'before_widget' => '<div class="instagram-section-widget">',
	'after_widget'  => '</div>',
);
?>
<div class="g1-instagram-feed g1-instagram-feed-expanded">
	<?php the_widget( 'G1_Socials_Instagram_Widget', $args, $instance ); ?>
	<div class="g1-instagram-feed-overlay">
		<div class="g1-instagram-feed-overlay-row"><i class="fa fa-instagram" aria-hidden="true"></i></div>
		<div class="g1-instagram-feed-overlay-row"><a class="g1-delta g1-delta-1st instagram-username" href="<?php echo esc_url( $user_instagram_url ); ?>" rel="me" target="_blank">@<?php echo( esc_html( $username ) ); ?></a></div>
		<?php if ( $follow_text ) : ?>
			<div class="g1-instagram-feed-overlay-row"><a class="g1-button g1-button-s g1-button-simple" href="<?php echo esc_url( $user_instagram_url ); ?>" rel="me" target="_blank"><?php echo wp_kses_post( $follow_text ); ?></a></div>
		<?php endif; ?>
	</div>
</div>
<?php
