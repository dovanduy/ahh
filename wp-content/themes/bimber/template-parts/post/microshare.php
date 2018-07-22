<?php
/**
 *  The template for displaying microshares
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.3
 */


// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<?php
$share_url 		= get_permalink();
$title 			= get_the_title();
$shortlink 		= wp_get_shortlink();
$fb_app_id		= bimber_get_theme_option( 'posts', 'fb_app_id' );
$item_id 		= uniqid();
?>
<div class="bimber-microshare-item-share">
	<a class="bimber-microshare-item-share-toggle" href="#"><?php esc_html_e( 'Share', 'bimber' ); ?></a>
	<div class="bimber-microshare-item-share-content">
		<?php
		$pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . rawurlencode( $shortlink ) . '&amp;description=' . rawurlencode( $title ) . '&amp;media=' . rawurlencode( 'bimber_replace_encode_241gw' );
		printf(
			'<a class="bimber-microshare %1s" href="%2s" title="%3s" target="_blank" rel="nofollow">%4s</a>',
			sanitize_html_class( 'bimber-microshare-pinterest' ),
			esc_url_raw( $pinterest_url ),
			esc_attr( __( 'Share on Pinterest', 'bimber' ) ),
			esc_html( __( 'Share on Pinterest', 'bimber' ) )
		);?>
		<script type="text/javascript">
			(function () {
				var triggerOnLoad = false;

				window.apiShareOnFB = function() {
					jQuery('body').trigger('snaxFbNotLoaded');
					triggerOnLoad = true;
				};

				var _fbAsyncInit = window.fbAsyncInit;

				window.fbAsyncInit = function() {
					FB.init({
						appId      : '<?php echo esc_attr( $fb_app_id ); ?>',
						xfbml      : true,
						version    : 'v3.0'
					});

					window.apiShareOnFB_<?php echo esc_html( $item_id ); ?>_bimber_replace_unique_241gw = function() {
						var shareTitle 		    = '<?php echo html_entity_decode( sanitize_text_field( $title ) ); ?>';
						var shareDescription	= '';
						var shareImage	        = 'bimber_replace_241gw';

						FB.login(function(response) {
							if (response.status === 'connected') {
								var objectToShare = {
									'og:url':           '<?php echo esc_url( $share_url ); ?>', // Url to share.
									'og:title':         shareTitle,
									'og:description':   shareDescription
								};

								// Add image only if set. FB fails otherwise.
								if (shareImage) {
									objectToShare['og:image'] = shareImage;
								}

								FB.ui({
										method: 'share_open_graph',
										action_type: 'og.shares',
										action_properties: JSON.stringify({
											object : objectToShare
										})
									},
									// callback
									function(response) {
									});
							}
						});
					};

					// Fire original callback.
					if (typeof _fbAsyncInit === 'function') {
						_fbAsyncInit();
					}

					// Open share popup as soon as possible, after loading FB SDK.
					if (triggerOnLoad) {
						setTimeout(function() {
							apiShareOnFB();
						}, 1000);
					}
				};

				// JS SDK loaded before we hook into it. Trigger callback now.
				if (typeof window.FB !== 'undefined') {
					window.fbAsyncInit();
				}
			})();
		</script>
		<?php $fb_onclick = 'apiShareOnFB_' . esc_html( $item_id ) . '_bimber_replace_unique_241gw';
		printf(
			'<a class="bimber-microshare %1s" href="%2s" title="%3s" onclick="%4s(); return false;" target="_blank" rel="nofollow">%5s</a>',
			sanitize_html_class( 'bimber-microshare-facebook' ),
			esc_url( '#' ),
			esc_attr( __( 'Share on Facebook', 'bimber' ) ),
			esc_attr( $fb_onclick ),
			esc_html( __( 'Share on Facebook', 'bimber' ) )
		);
		$twitter_url = 'https://twitter.com/home?status=' . rawurlencode( $title ) . '%20' . rawurlencode( $shortlink );
		printf(
			'<a class="bimber-microshare %1s" href="%2s" title="%3s" target="_blank" rel="nofollow">%4s</a>',
			sanitize_html_class( 'bimber-microshare-twitter' ),
			esc_url_raw( $twitter_url ),
			esc_attr( __( 'Share on Twitter', 'bimber' ) ),
			esc_html( __( 'Share on Twitter', 'bimber' ) )
		);
		?>
	</div>
</div>
