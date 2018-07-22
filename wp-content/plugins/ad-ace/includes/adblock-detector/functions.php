<?php
/**
 * Common Functions
 *
 * @package AdAce.
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_action( 'wp_enqueue_scripts', 'adace_adblock_enqueue_scripts' );
add_action( 'wp_footer', 'adace_adblock_detector_check' );

function adace_adblock_enqueue_scripts() {
	$detector = get_option( 'adace_adblock_detector_enabled', adace_options_get_defaults( 'adace_adblock_detector_enabled' ) );

	if ( 'standard' === $detector ) {
		wp_enqueue_script( 'adace-adijs', adace_get_plugin_url() . '/includes/adblock-detector/jquery.adi.js', array( 'jquery' ) );
		wp_enqueue_script( 'adace-adijs-pot', adace_get_plugin_url() . '/includes/adblock-detector/advertisement.js', array( 'adace-adijs' ) );
	}
}

function adace_adblock_detector_check() {
	$trigger_alert  = apply_filters( 'adace_adblock_trigger_alert', false );
	?>
	<script>
		(function ($) {
			"use strict";

			<?php if ( $trigger_alert ) : ?>
			var triggerAlert = true;
			<?php else: ?>
			var triggerAlert = false;
			<?php endif; ?>

			var adblockDetectedAlert = function() {
				alert('Adblock detected.')
			};

			$(document).ready(function () {
				// Only when the AdBlocker is enabled this script will be available.
				if ( typeof $.adi === 'function' ) {
					$.adi({
						onOpen: function (el) {
							adblockDetectedAlert();
						}
					});
				}

				// Show alert on demand. AdBlocker can be disabled.
				if (triggerAlert) {
					adblockDetectedAlert();
				}
			});
		})(jQuery);
	</script>
	<?php
}
