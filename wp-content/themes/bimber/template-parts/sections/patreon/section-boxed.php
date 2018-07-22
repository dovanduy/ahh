<?php
/**
 * The Template for displaying patron.
 *
 * @package Bimber_Theme 5.3.2
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<div class="g1-row g1-row-layout-page g1-section-row g1-section-boxed">
	<div class="g1-row-inner">
		<div class="g1-column">
			<?php get_template_part( 'template-parts/sections/patreon/base-standard' ); ?>
		</div>
	</div>
</div>
<?php
