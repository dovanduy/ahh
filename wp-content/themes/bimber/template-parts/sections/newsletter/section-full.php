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
global $bimber_newsletter_section_positon;
$invert = bimber_get_theme_option( 'newsletter', $bimber_newsletter_section_positon . '_invert' );
?>
	<div class="g1-row g1-row-layout-page g1-section-row <?php echo( $invert ? 'g1-dark-background g1-dark' : ' g1-section-background g1-light' ); ?>">
		<div class="g1-row-inner">
			<div class="g1-column">
				<?php get_template_part( 'template-parts/sections/newsletter/base', 'large' ); ?>
			</div>
		</div>
	</div>
<?php
