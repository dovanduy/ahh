<?php
/**
 * Adace Standard template
 *
 * @package adace
 * @subpackage Frontend Slot
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$slot = adace_slot_get_query();
$ad = adace_ad_get_query();

// @TODO review markup with Peter
?>
<div class="adace-slot-wrapper <?php echo( sanitize_html_class( $slot['slot_id'] ) ); ?>">
	<div class="adace-slot"><?php do_action( 'adace_generic_slot_start' );
		if ( 'custom' === $ad['type'] ) {
			adace_render_custom_ad();
		}
		if ( 'adsense' === $ad['type'] ) {
			adace_render_adsense_ad();
		}
		do_action( 'adace_generic_slot_end' ); ?>
	</div>
</div>
<?php
