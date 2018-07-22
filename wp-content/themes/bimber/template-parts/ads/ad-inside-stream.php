<?php
/**
 * The Template for displaying ad inside collection (list).
 *
 * @package Bimber_Theme 5.4
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
set_query_var( 'plugin_required_notice_slot_id', esc_html__( 'Inside stream collection', 'bimber' ) );
global $bimber_ad_offset;

?>
<li class="g1-collection-item g1-injected-unit">
	<?php if ( bimber_can_use_plugin( 'quick-adsense-reloaded/quick-adsense-reloaded.php' ) ) : ?>

		<?php if ( quads_has_ad( 'bimber_inside_stream' ) ) : ?>

			<div class="g1-advertisement g1-advertisement-inside-stream">

				<?php quads_ad( array( 'location' => 'bimber_inside_stream' ) ); ?>

			</div>

		<?php else : ?>

			<?php get_template_part( 'template-parts/ads/notice-not-allowed' ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ) : ?>

		<?php if (  adace_is_ad_slot( 'bimber_inside_stream' ) ) : ?>

			<div class="g1-advertisement g1-advertisement-inside-stream">

				<?php echo bimber_sanitize_ad( adace_get_ad_slot( 'bimber_inside_stream', $bimber_ad_offset + 1 ) ); ?>

			</div>

		<?php else : ?>

			<?php get_template_part( 'template-parts/ads/notice-not-allowed' ); ?>

		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! bimber_can_use_plugin( 'quick-adsense-reloaded/quick-adsense-reloaded.php' ) && ! bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ) : ?>

		<?php get_template_part( 'template-parts/ads/notice-plugin-required' ); ?>

	<?php endif; ?>
</li>
