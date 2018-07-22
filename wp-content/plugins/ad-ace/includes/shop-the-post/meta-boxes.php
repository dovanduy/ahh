<?php
/**
 * WooCommerce plugin functions for post meta
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package AdAce
 * @subpackage Related Products.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Register ad metaboxes.
 */
function adace_post_related_products_metabox() {
	add_meta_box(
		'adace_post_related_products_metabox',
		esc_html( 'Shop the Post', 'adace' ),
		'adace_post_related_products_metabox_render_callback'
	);
}

/**
 * Meta box renderer.
 *
 * @param object $post Post object.
 */
function adace_post_related_products_metabox_render_callback( $post ) {
	// Load current related products meta.
	$current_related_products_type       = get_post_meta( $post->ID, 'adace_related_products_type', true );
	$current_related_products_title      = get_post_meta( $post->ID, 'adace_related_products_title', false );
	$current_related_products_embed      = get_post_meta( $post->ID, 'adace_related_products_embed', true );
	$current_related_products            = get_post_meta( $post->ID, 'adace_related_products', true );

	if ( empty( $current_related_products_type ) && ! adace_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
		$current_related_products_type = 'embed';
	} elseif ( empty( $current_related_products_type ) && adace_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
		$current_related_products_type = 'woocommerce';
	}
	// Make sure that we have array here.
	if ( ! is_array( $current_related_products ) ) {
		$current_related_products = array();
	}
	// Check title, if first add default from customizer.
	if ( isset( $current_related_products_title[0] ) ) {
		$current_related_products_title = $current_related_products_title[0];
	} else {
		$current_related_products_title = esc_html__( 'Shop the Post', 'adace' );
	}
	?>
		<fieldset>
			<table class="form-table form-wrap">
				<tbody>
					<tr>
						<th scope="row"><label for="adace_related_products_title"><?php esc_html_e( 'Title', 'adace' ); ?></label></th>
						<td>
							<input type="text" style="width:100%;" name="adace_related_products_title" id="adace_related_products_title" value="<?php echo( wp_kses_post( $current_related_products_title ) ); ?>">
							<p class=“description”>Leave empty to use the default value.</p>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Type:', 'adace' ); ?></label>
						</th>
						<td class="adace-metabox-header">
							<fieldset class="adace-box-header" name="adace_related_products_type" id="adace_shop_the_post_type" >
								<label><input type="radio" name="adace_related_products_type" class="adace-shop-the-post-type embed" <?php checked( 'embed', $current_related_products_type, true ); ?> value="embed" /><span><?php esc_html_e( 'Embed Code', 'adace' ); ?></span></label>
								<label><input type="radio" name="adace_related_products_type" class="adace-shop-the-post-type woocommerce" <?php checked( 'woocommerce', $current_related_products_type, true ); echo( esc_attr( adace_can_use_plugin( 'woocommerce/woocommerce.php' ) ? '' : 'disabled' ) ); ?> value="woocommerce" /><span><?php esc_html_e( 'WooCommerce Products', 'adace' ); ?></span></label>
							</fieldset>
						</td>
					</tr>
					<tr class="adace-metabox-tab embed <?php echo( esc_attr( 'embed' === $current_related_products_type ? 'current' : '' ) ); ?>">
						<th scope="row"><label for="adace_related_products_embed"><?php esc_html_e( 'Embed Code', 'adace' ); ?></label></th>
						<td>
							<textarea style="width:100%;" rows="6" name="adace_related_products_embed" id="adace_related_products_embed" ><?php echo filter_var( $current_related_products_embed ); ?></textarea>
							<p class=“description”><?php printf( esc_html__( 'Supported services: %s', 'adace' ), implode( ', ', array( '<a href="https://www.shopstylecollective.com/landing" target="_blank">ShopStyle Collectve</a>', '<a href="https://www.rewardstyle.com/" target="_blank">rewardStyle</a>', 'etc.' ) ) ); ?></p>
						</td>
					</tr>
					<?php if ( adace_can_use_plugin( 'woocommerce/woocommerce.php' ) ) : ?>
						<tr class="adace-metabox-tab woocommerce <?php echo( esc_attr( 'woocommerce' === $current_related_products_type ? 'current' : '' ) ); ?>">
							<th scope="row"><label for="adace_related_products"><?php esc_html_e( 'Products', 'adace' ); ?></label></th>
							<td>
								<p class="form-field">
									<input type="hidden" name="adace_related_products" id="adace_related_products" value="<?php echo esc_attr( implode( ',', $current_related_products ) ); ?>" />

									<div class="adace-related-products-preview">
									<?php
										foreach( $current_related_products as $related_product_id ) {
											echo get_the_post_thumbnail( $related_product_id, array( 120, 120 ) );
										}
									?>
									</div>
								</p>
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
			<?php wp_nonce_field( 'adace_save_post_related', 'adace_save_post_related_products_metabox_nonce' ); ?>
		</fieldset>
	<?php
}

add_action( 'save_page', 'adace_save_post_related_products_metabox', 10, 1 );
add_action( 'save_post', 'adace_save_post_related_products_metabox', 10, 1 );
/**
 * Meta box saver.
 *
 * @param string $post_id Post id.
 */
function adace_save_post_related_products_metabox( $post_id ) {
	// Array for sanitized data.
	$input_sanitized = array();
	// Sanitize nonce.
	if ( isset( $_POST['adace_save_post_related_products_metabox_nonce'] ) ) {
		$input_sanitized['nonce'] = filter_var( $_POST['adace_save_post_related_products_metabox_nonce'], FILTER_SANITIZE_STRING );
	} else {
		return;
	}
	// Verify that nonce.
	if ( ! wp_verify_nonce( $input_sanitized['nonce'], 'adace_save_post_related' ) ) {
		return;
	}
	if ( adace_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
		// Sanitize related products, and make sure that we can act atleast on empty array.
		if ( isset( $_POST['adace_related_products'] ) ) {
			$ids_string = filter_input( INPUT_POST, 'adace_related_products', FILTER_SANITIZE_STRING );

			if ( ! empty( $ids_string ) ) {
				$products = explode( ',', $ids_string );
			} else {
				$products = array();
			}

			$input_sanitized['products'] = $products;
		} else {
			$input_sanitized['products'] = array();
		}
		// Update post meta if its array.
		if ( is_array( $input_sanitized['products'] ) ) {
			update_post_meta( $post_id, 'adace_related_products', $input_sanitized['products'] );
		}
	}
	// Sanitize related products title.
	if ( isset( $_POST['adace_related_products_title'] ) ) {
		$input_sanitized['products_title'] = filter_var( $_POST['adace_related_products_title'], FILTER_SANITIZE_STRING );
	} else {
		$input_sanitized['products_title'] = '';
	}
	update_post_meta( $post_id, 'adace_related_products_title', $input_sanitized['products_title'] );
	// Sanitize related products title.
	if ( isset( $_POST['adace_related_products_type'] ) ) {
		$input_sanitized['products_type'] = filter_var( $_POST['adace_related_products_type'], FILTER_SANITIZE_STRING );
	} else {
		$input_sanitized['products_type'] = '';
	}
	// Update post title.
	update_post_meta( $post_id, 'adace_related_products_type', $input_sanitized['products_type'] );
	// Sanitize related products embed.
	if ( isset( $_POST['adace_related_products_embed'] ) ) {
		$input_sanitized['products_embed'] = filter_var( $_POST['adace_related_products_embed'], FILTER_UNSAFE_RAW );
	} else {
		$input_sanitized['products_embed'] = '';
	}
	// Update post title.
	update_post_meta( $post_id, 'adace_related_products_embed', $input_sanitized['products_embed'] );
}
