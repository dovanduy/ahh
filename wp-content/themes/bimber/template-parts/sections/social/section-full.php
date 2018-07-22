<?php
/**
 * The Template for displaying podcast.
 *
 * @package Bimber_Theme 5.3.2
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

// Lets make sure that we can use G1 Socials.
if ( bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) ) {
global $bimber_social_section_positon;
$invert = bimber_get_theme_option( 'social', $bimber_social_section_positon . '_invert' );
?>
	<div class="g1-row g1-row-layout-page g1-socials-section <?php echo( $invert ? ' g1-dark-background g1-dark' : '' ); ?>">
		<div class="g1-row-inner">
			<div class="g1-column">
				<?php echo do_shortcode( '[g1_socials icon_size="32" icon_color="text"]' ); ?>
			</div>
		</div>
	</div>
<?php
}
