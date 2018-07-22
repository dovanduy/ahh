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
$args = array(
	'title'               => '',
	'username'            => $username,
	'number'              => 8,
	'target'              => '_blank',
	'afterwidget_details' => false,
);
$instance = array(
	'before_widget' => '<div class ="instagram-section-widget">',
	'after_widget'  => '</div>',
);
?>
<div class="g1-dark g1-instagram-feed g1-instagram-feed-compressed">
	<?php the_widget( 'G1_Socials_Instagram_Widget', $args, $instance ); ?>
</div>
<?php
