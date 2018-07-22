<?php
/**
 * Adace Patreon Widget
 *
 * @package adace
 * @subpackage Frontend Slot
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<div class="g1-light g1-section g1-section-patreon g1-section-background">
<span class="g1-section-icon"></span>
<div class="g1-section-body">
	<h2 class="g1-zeta g1-zeta-2nd g1-section-label"><?php echo( wp_kses_post( html_entity_decode( $adace_patreon_label ) ) ); ?></h2>
	<h3 class="g1-section-title"><a href="<?php echo( esc_url( $adace_patreon_link ) ); ?>" rel="nofollow" target="_blank"><?php echo( wp_kses_post( html_entity_decode( $adace_patreon_title ) ) ); ?></a></h3>
</div>
<div class="g1-section-btn-wrap">
	<a class="g1-button g1-button-solid g1-button-m g1-section-btn" href="<?php echo( esc_url( $adace_patreon_link ) ); ?>" rel="nofollow" target="_blank"><?php esc_html_e( 'Become a Patron', 'bimber' ); ?></a>
</div>
</div>
