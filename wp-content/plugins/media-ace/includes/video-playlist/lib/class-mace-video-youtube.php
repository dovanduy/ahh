<?php
/**
 * MediaAce YouTube Video
 *
 * @package media-ace
 * @subpackage Classes
 */

/**
 * MediaAce Video Class for YouTube
 */
class Mace_Video_YouTube extends Mace_Video {

	/**
	 * Return video type
	 *
	 * @return string
	 */
	public function get_type() {
		return 'YouTube';
	}

	/**
	 * Render video HTML
	 */
	public function render() {
		?>
		<video class="mace-video-player" width="788" height="446" controls="controls" preload="none" poster="<?php echo esc_url( $this->get_poster() ); ?>">
			<source type="video/youtube" src="<?php echo esc_url( $this->get_url() ); ?>" />
		</video>
		<?php
	}

	/**
	 * Try to extract video id from url
	 *
	 * @return string|WP_Error
	 */
	protected function extract_video_id() {
		if ( ! preg_match( mace_vp_get_video_type_regex( 'YouTube' ), $this->get_url(), $matches ) ) {
			/* translators: %s is replaced with the video url */
			return new WP_Error( 'mace_vp_youtube_invalid_url', sprintf( esc_html__( 'YouTube video url %s is not valid!', 'mace' ), $this->get_url() ) );
		}

		return trim( $matches[0] );
	}

	/**
	 * Fetch and format video details
	 *
	 * @param string $video_id      Video unique id.
	 *
	 * @return bool|WP_Error        True if ok, WP_Error otherwise.
	 */
	protected function fetch_details( $video_id ) {
		$details = $this->call_api( $video_id );

		if ( is_wp_error( $details ) ) {
			return $details;
		}

		if ( empty( $details['items'][0] ) ) {
			/* translators: %s is replaced with the video url */
			return new WP_Error( 'mace_vp_youtube_not_found', sprintf( esc_html__( 'YouTube video %s not found!', 'mace' ), $this->get_url() ) );
		}

		$item = $details['items'][0];

		$this->details = array(
			'id'        => $video_id,
			'url'       => $this->get_url(),
			'title'     => $item['snippet']['title'],
			'thumbnail' => $item['snippet']['thumbnails']['default']['url'],
			'poster'    => '',
			'duration'  => $this->get_item_duration( $item ),
		);

		return true;
	}

	/**
	 * Call YouTube API to get video details
	 *
	 * @param string $video_id      Video unique id.
	 *
	 * @return array|WP_Error       Array with details or WP_Error
	 */
	protected function call_api( $video_id ) {
		$params = array(
			'id'   => $video_id,
			// @todo
			'key'  => 'AIzaSyCr-4_d7OXJIRANf5_CK0qceXj8sMJiDeM',
			'part' => 'snippet,contentDetails',
		);

		$api_url = apply_filters( 'mace_vp_youtube_video_api', 'https://www.googleapis.com/youtube/v3/videos' );

		$api_url = sprintf( '%s?%s', $api_url, http_build_query( $params ) );

		$request = wp_remote_get( $api_url );

		if ( is_wp_error( $request ) ) {
			return $request;
		}

		return json_decode( wp_remote_retrieve_body( $request ), true );
	}

	/**
	 * Extract video duration from details
	 *
	 * @param array $item       Video item data.
	 *
	 * @return int
	 */
	protected function get_item_duration( $item ) {
		if ( empty( $item['contentDetails'] ) ) {
			return 0;
		}

		$content_details = $item['contentDetails'];

		if ( ! empty( $content_details['duration'] ) ) {
			$interval = new DateInterval( $content_details['duration'] );

			return $interval->h * 3600 + $interval->i * 60 + $interval->s;
		}

		return 0;
	}
}
