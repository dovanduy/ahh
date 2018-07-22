<?php
/**
 * The Template Part for displaying promoted products.
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

// Make sure that we have WooCommerce on board. If not leave!
if ( ! bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
	return;
}
// Get all options for this template part.
$promoted_product_title       = bimber_get_theme_option( 'woocommerce', 'promoted_product_title' );
$promoted_product_description = bimber_get_theme_option( 'woocommerce', 'promoted_product_description' );
// Get ids and check if are provided. Thanks customizer.
$promoted_product_id            = bimber_get_theme_option( 'woocommerce', 'promoted_product_id' );
if ( empty( $promoted_product_id ) ) {
	return;
}
$promoted_product               = wc_get_product( $promoted_product_id );
if ( $promoted_product ) {
	$promoted_product_thumbnail     = get_the_post_thumbnail( $promoted_product_id, 'shop_single' );
	$promoted_product_title_classes = apply_filters( 'bimber_promoted_product_title_classes', array( 'g1-beta', 'g1-beta-2nd', 'g1-promoted-product-title' ) );
	do_action( 'bimber_before_promoted_product' );
	?>
	<div class="g1-promoted-product">
		<?php if ( ! empty( $promoted_product_title ) ) : ?>
			<div class="g1-column g1-column-1of6">
				<h2 class="<?php echo( join( ' ', $promoted_product_title_classes ) ); ?>"><?php echo( wp_kses_post( $promoted_product_title ) ); ?></h2>
			</div>
		<?php endif; ?>
		<div class="g1-column g1-column-1of3 g1-promoted-product-thumbnail">
			<?php echo( $promoted_product_thumbnail ); ?>
		</div>
		<div class="g1-column g1-column-1of2 g1-promoted-product-details">
			<h3 class="product-title g1-beta g1-beta-1st"><?php echo ( $promoted_product->get_name() ); ?></h3>
			<p class="product-description"><?php echo ( $promoted_product->get_description() ); ?></p>

			<?php echo( do_shortcode( '[add_to_cart id="' . $promoted_product_id . '" style=""]' ) ); ?>

			<p class="product-link">
				<a class="g1-link g1-link-s g1-link-right" href="<?php echo( esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>"><?php esc_html_e( 'More Products', 'bimber' ); ?></a>
			</p>
		</div>
	</div>
	<?php
	do_action( 'bimber_after_promoted_product' );
}
wp_reset_postdata();
