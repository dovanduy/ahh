<?php
/**
 * The Template Part for displaying post navigation.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 4.10
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

?>
<nav class="g1-nav-single">
	<div class="g1-nav-single-inner">
		<p class="g1-single-nav-label"><?php esc_html_e( 'See more', 'bimber' ); ?></p>
		<ul class="g1-nav-single-links">
			<li class="g1-nav-single-prev"><?php previous_post_link( '%link', '<strong>' . esc_html__( 'Previous article', 'bimber' ) . '</strong>  <span class="g1-gamma g1-gamma-1st">%title</span>' ); ?></li>
			<li class="g1-nav-single-next"><?php next_post_link( '%link', '<strong>' . esc_html__( 'Next article', 'bimber' ) . '</strong> <span class="g1-gamma g1-gamma-1st">%title</span>' ); ?></li>
		</ul>
	</div>
</nav>
