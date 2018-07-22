<?php
/**
 * Restrict Content Pro plugin functions
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

add_filter( 'the_excerpt', 'bimber_rcp_message_filter', 1, 1 );
add_filter( 'the_content', 'bimber_rcp_message_filter', 1, 1 );
/**
 * Add custom box to restricted content message.
 *
 * @param string $content Original RCP message.
 */
function bimber_rcp_message_filter( $content ) {
	// Execute only once.
	static $done = false;
	if ( is_singular() && ! $done ) {
		ob_start();
			get_template_part( 'template-parts/rcp/message', 'paid' );
		$paid_box = ob_get_clean();
		ob_start();
			get_template_part( 'template-parts/rcp/message', 'free' );
		$free_box = ob_get_clean();
		// Get RCP Options so we can know were we are. Simply $message is not enough.
		global $rcp_options;
		$paid = isset( $rcp_options['paid_message'] ) ? $rcp_options['paid_message'] : '';
		$free = isset( $rcp_options['free_message'] ) ? $rcp_options['free_message'] : '';
		$rcp_options['paid_message'] = $paid_box . $paid;
		$rcp_options['free_message'] = $free_box . $free;
		$done = true;
	}
	return $content;
}
