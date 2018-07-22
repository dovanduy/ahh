<?php
/**
 * Video Playlist
 *
 * @package media-ace
 * @subpackage Templates
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

global $mace_vp_videos;

if ( empty( $mace_vp_videos ) ) {
	return;
}
?>

<div class="mace-video-playlist">
	<div class="mace-video-main">
		<?php $mace_vp_videos[0]->render(); ?>
	</div>
	<div class="mace-video-sidebar">
		<?php // @todo move the g1-class to override in the theme ?>
		<h2 class="mace-video-playlist-title g1-delta">Video Playlist Title</h2>
		<div class="mace-video-controls">
			<a class="mace-video-prev"></a>
			<a class="mace-video-next"></a>
			<a class="mace-video-loop"></a>
			<a class="mace-video-shuffle"></a>
		</div>
		<div class="mace-video-list-wrapper">
			<ol class="mace-video-list">
				<?php
				/**
				 * Video object
				 *
				 * @var Mace_Video $mace_video
				 */
				?>
				<?php foreach ( $mace_vp_videos as $mace_video ) : ?>
				<li class="mace-video-item mace-video-<?php echo sanitize_html_class( $mace_video->get_type() ); ?>" data-mace-video-config="<?php echo esc_attr( $mace_video->get_json_config() ); ?>">
						<?php $mace_video_thumb = $mace_video->get_thumbnail(); ?>
						<?php if ( $mace_video_thumb ) : ?>
							<img src="<?php echo esc_url( $mace_video_thumb ); ?>" width="40" height="40" />
						<?php endif; ?>

						<div class="mace-video-title"><?php echo esc_html( $mace_video->get_title() ); ?>
						<div class="mace-video-duration"><?php echo esc_html( $mace_video->get_formatted_duration() ); ?></div>
						</div>
				</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</div>
