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
$section_classes = apply_filters( 'bimber_newsletter_boxed_class', array(
	'g1-row',
	'g1-row-layout-page',
	'g1-section-row',
	'g1-section-boxed',
) );
?>
<div class="<?php echo( join( ' ', $section_classes ) ); ?>">
	<div class="g1-row-inner">
		<div class="g1-column">
				<?php get_template_part( 'template-parts/sections/newsletter/base', 'standard' ); ?>
		</div>
	</div>
</div>
<?php
