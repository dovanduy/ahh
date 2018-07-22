<?php
/**
 * The Template for displaying patreon.
 *
 * @package Bimber_Theme 5.3.2
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
$patreon_label = get_option( 'adace_patreon_label', adace_options_get_defaults( 'adace_patreon_label' ) );
$patreon_title = get_option( 'adace_patreon_title', adace_options_get_defaults( 'adace_patreon_title' ) );
$patreon_link  = get_option( 'adace_patreon_link', adace_options_get_defaults( 'adace_patreon_link' ) );

?>
<div class="g1-light g1-section g1-section-patreon g1-section-background">
	<span class="g1-section-icon"></span>
	<div class="g1-section-body">
		<h2 class="g1-zeta g1-zeta-2nd g1-section-label"><?php echo( wp_kses_post( html_entity_decode( $patreon_label ) ) ); ?></h2>
		<h3 class="g1-section-title"><a href="<?php echo( esc_url( $patreon_link ) ); ?>" rel="nofollow" target="_blank"><?php echo( wp_kses_post( html_entity_decode( $patreon_title ) ) ); ?></a></h3>
	</div>
	<div class="g1-section-btn-wrap">
		<a class="g1-button g1-button-solid g1-button-m g1-section-btn" href="<?php echo( esc_url( $patreon_link ) ); ?>" rel="nofollow" target="_blank"><?php esc_html_e( 'Become a Patron', 'bimber' ); ?></a>
	</div>
</div>
<?php
