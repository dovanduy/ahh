<?php
/**
 * Adace Slot
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
// Output styles.
$slot_styles_array = array();
if ( 0 !== $slot['min_width'] ) {
	$slot_styles_array['min_width'] = 'min-width:' . $slot['min_width'] . 'px;';
}
if ( 0 !== $slot['max_width'] ) {
	$slot_styles_array['max_width'] = 'max-width:' . $slot['max_width'] . 'px;';
}

$alignement_class = '';
if ( ! empty( $slot['alignment'] ) && 'none' !== $slot['alignment'] ) {
	$slot_styles_array['alignment'] = 'text-align:' . $slot['alignment'] . ';';
	$alignement_class = 'adace-align-' . $slot['alignment'];
	if ( isset( $slot['wrap'] ) && $slot['wrap'] ) {
		$alignement_class .= ' -wrap';
	}
}

if ( $slot['margin'] > 0 ) {
	$slot_styles_array['margin'] = 'margin:' . $slot['margin'] . 'px;';
}

$slot_styles_array = apply_filters( 'adace_slot_styles', $slot_styles_array, $slot );
if ( ! empty( $slot_styles_array ) ) {
	$slot_styles = 'style="' . esc_attr( join( '', $slot_styles_array ) ) . '"';
} else {
	$slot_styles = '';
}

// @TODO review markup with Peter
?>
<div class="adace-slot-wrapper <?php echo( sanitize_html_class( $slot['slot_id'] ) ); ?> <?php echo( sanitize_html_class( $alignement_class ) ); ?>" <?php echo( $slot_styles ); ?>>
	<div class="adace-slot"><?php do_action( 'adace_standard_slot_start' );
		if ( 'custom' === $ad['type'] ) {
			adace_render_custom_ad();
		}
		if ( 'adsense' === $ad['type'] ) {
			adace_render_adsense_ad();
		}
		do_action( 'adace_standard_slot_end' ); ?>
	</div>
</div>
<?php
