<?php
/**
 * Profile socials template part
 *
 * @package g1-socials
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
$data = get_the_author_meta( 'g1_socials', bp_displayed_user_id() );
if ( ! is_array( $data ) ) {
	$data = array();
}
?>

<div class="g1-socials-bp-profile-header">
		<?php
		foreach ( $data as $network => $value ) {
			$network_url = isset( $data[ $network ] ) ? $data[ $network ] : '';
			if ( empty( $network_url ) ) {
				continue;
			} ?>
			<a
			target="_blank"
			href="<?php echo esc_url( $network_url );?>" 
			title="<?php echo esc_html( $network ); ?>"
			class="g1-socials-item-icon g1-socials-item-icon-<?php echo sanitize_html_class( $network ); ?>">
			</a>
			<?php }?>
</div>
