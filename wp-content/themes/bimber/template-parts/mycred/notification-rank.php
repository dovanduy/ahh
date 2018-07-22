<?php
/**
 * The Template for displaying mycred notifications.
 *
 * @package Bimber_Theme 5.3.2
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$data = get_query_var( 'bimber_mycred_special_notification' );
$img_url = wp_get_attachment_image_src( $data['logo_id'], 'full' )[0];

$share_url 		= get_author_posts_url( get_current_user_id() );
$title 			= __( "I've earned a rank! ", 'bimber' ) . $data['rank_name'];;
$fb_app_id		= bimber_get_theme_option( 'posts', 'fb_app_id' );
$item_id 		= uniqid();

$pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . rawurlencode( $share_url ) . '&amp;description=' . rawurlencode( $title ) . '&amp;media=' . rawurlencode( $img_url );
$twitter_url = 'https://twitter.com/home?status=' . rawurlencode( $title ) . '%20' . rawurlencode( $share_url );
$fb_onclick = 'apiShareOnFB_' . esc_html( $item_id );
?>

<div class="g1-mycred-notice-overlay">
	<div class="g1-mycred-notice g1-mycred-notice-rank">
	<div class="g1-mycred-notice-close"></div>
		<div class="g1-mycred-notice-title">
			<?php if ( 'promotion' === $data['direction'] ) :?>
				<p class="g1-epsilon g1-epsilon-2nd"><?php echo esc_html__( 'Congratulations!', 'bimber' );?></p>
				<h2 class="g1-gamma g1-gamma-1st"><?php echo esc_html__( 'You have been promoted!', 'bimber' );?></h2>
				<?php else : ?>
				<p class="g1-epsilon g1-epsilon-2nd"><?php echo esc_html__( 'Congratulations!', 'bimber' );?></p>
				<h2 class="g1-gamma g1-gamma-1st"><?php echo esc_html__( 'You have been demoted!', 'bimber' );?></h2>
			<?php endif;?>

		</div>
		<div class="g1-mycred-notice-image">
			<div class="g1-mycred-notice-suburst">
				<div class="g1-mycred-notice-suburst-rays"></div>
				<div class="g1-mycred-notice-suburst-overlay"></div>
			</div>
			<img src="<?php echo esc_url( $img_url )?>">
		</div>
		<h3 class="g1-mycred-notice-name g1-delta g1-delta-1st"><?php echo esc_html( $data['rank_name'] )?></h3>
		<div class="g1-mycred-notice-shares">
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

						window.apiShareOnFB_<?php echo esc_html( $item_id ); ?> = function() {
							var shareTitle 		    = '<?php echo html_entity_decode( sanitize_text_field( $data['rank_name'] ) ); ?>';
							var shareDescription	= '<?php echo esc_js( __( "I've got a new rank!", 'bimber' ) );?>';

							FB.login(function(response) {
								if (response.status === 'connected') {
									var objectToShare = {
										'og:url':           '<?php echo esc_url( $share_url ); ?>', // Url to share.
										'og:title':         shareTitle,
										'og:description':   shareDescription
									};


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
			<a onclick="<?php echo esc_attr( $fb_onclick )?>()"
			href="#" target="_blank" rel="nofollow" title="<?php esc_attr( __( 'Share on Facebook', 'bimber' ) );?>"
			class="g1-mycred-notice-share g1-mycred-notice-share-facebook">Facebook</a>
			<a href="<?php echo esc_html( $twitter_url )?>" target="_blank" rel="nofollow" title="<?php esc_attr( __( 'Share on Twitter', 'bimber' ) );?>"
			class="g1-mycred-notice-share g1-mycred-notice-share-twitter">Twitter</a>
		</div>
	</div>
</div>
