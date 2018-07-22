<?php
/**
 * The Template for displaying ad after the featured content.
 *
 * @package Bimber_Theme 5.0
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
set_query_var( 'plugin_required_notice_slot_id', esc_html__( 'After featured content', 'bimber' ) );
?>

<?php if ( bimber_can_use_plugin( 'quick-adsense-reloaded/quick-adsense-reloaded.php' ) && ( quads_has_ad( 'bimber_after_featured_content' ) ) ) : ?>
	<div class="g1-advertisement g1-advertisement-after-featured-content">

		<?php echo bimber_sanitize_ad( quads_ad( array( 'location' => 'bimber_after_featured_content', 'echo' => false ) ) ); ?>

	</div>
<?php endif;

if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) && ( adace_is_ad_slot( 'bimber_after_featured_content' ) ) ) : ?>
	<div class="g1-advertisement g1-advertisement-after-featured-content">

		<?php echo bimber_sanitize_ad( adace_get_ad_slot( 'bimber_after_featured_content' ) ); ?>

	</div>
<?php endif;
