<?php
/**
 * Facebook widget
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Socials_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_action( 'widgets_init', 'g1_socials_register_facebook_page_widget' );

/**
 * Widget register function
 */
function g1_socials_register_facebook_page_widget() {
	register_widget( 'G1_Facebook_Page_Widget' );
}

if ( ! class_exists( 'G1_Facebook_Page_Widget' ) ) :

	/**
	 * Class G1_Facebook_Page_Widget
	 */
	class G1_Facebook_Page_Widget extends WP_Widget {

		/**
		 * The total number of displayed widgets
		 *
		 * @var int
		 */
		static $counter = 0;

		/**
		 * G1_Facebook_Page_Widget constructor.
		 */
		function __construct() {
			parent::__construct(
				'bimber_widget_facebook_page',                      // Base ID.
				esc_html__( 'G1 Facebook Page', 'g1_socials' ),     // Name.
				array(                                              // Args.
					'description' => esc_html__( 'Easily embed and promote any Facebook Page on your website.', 'g1_socials' ),
				)
			);

			self::$counter ++;
		}

		/**
		 * Get default arguments
		 *
		 * @return array
		 */
		function get_default_args() {
			return apply_filters( 'g1_facebook_page_widget_defaults', array(
				'title'         => esc_html__( 'Find us on Facebook', 'g1_socials' ),
				'page_url'      => 'https://www.facebook.com/facebook',
				'small_header'  => 'none',
				'hide_cover'    => 'none',
				'show_facepile' => 'standard',
				'show_posts'    => 'none',
				'delay_load_ms' => '0',
				'id'            => '',
				'class'         => '',
			) );
		}

		/**
		 * Render widget
		 *
		 * @param array $args Arguments.
		 * @param array $instance Instance of widget.
		 */
		function widget( $args, $instance ) {
			$instance = wp_parse_args( $instance, $this->get_default_args() );

			$title = apply_filters( 'widget_title', $instance['title'] );

			// Translate title.
			if ( function_exists( 'icl_translate' ) ) {
				$title = icl_translate( 'G1 Facebook Page', 'title', $title );
			}

			// HTML id attribute.
			if ( empty( $instance['id'] ) ) {
				$instance['id'] = 'g1-widget-facebook-page-' . self::$counter;
			}

			// HTML class attribute.
			$classes   = explode( ' ', $instance['class'] );
			$classes[] = 'g1-widget-facebook-page';

			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $title ) ) {
				echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
			}

			$facebook_sdk_src = apply_filters( 'g1_facebook_sdk_src', '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5' );
			?>
			<div id="<?php echo esc_attr( $instance['id'] ); ?>"
			     class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $classes ) ); ?>">
				<script>
					(function(delay) {
						setTimeout(function () {
							(function (d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s);
								js.onload = function() {
									// After FB Page plugin is loaded, the height of its container changes.
									// We need to notify theme about that so elements like eg. sticky widgets can react
									FB.Event.subscribe('xfbml.render', function () {
										jQuery('.g1-fb-page-loading-indicator').remove();
										jQuery('.g1-fb-page-loading').removeClass('g1-fb-page-loading');
										jQuery('body').trigger('g1PageHeightChanged');
									});
								};
								js.id = id;
								js.src = "<?php echo esc_url_raw( $facebook_sdk_src ); ?>";
								fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));
						}, delay);
					})(<?php echo intval( $instance['delay_load_ms'] ); ?>);
				</script>
				<p class="g1-fb-page-loading-indicator"><?php esc_html_e( 'Loading...', 'g1_socials' ); ?></p>
				<div class="fb-page g1-fb-page-loading"
				     data-href="<?php echo esc_url( $instance['page_url'] ); ?>"
				     data-adapt-container-width="true"
				     data-small-header="<?php echo esc_attr( 'standard' === $instance['small_header'] ? 'true' : 'false' ); ?>"
				     data-hide-cover="<?php echo esc_attr( 'standard' === $instance['hide_cover'] ? 'true' : 'false' ); ?>"
				     data-show-facepile="<?php echo esc_attr( 'standard' === $instance['show_facepile'] ? 'true' : 'false' ); ?>"
				     data-show-posts="<?php echo esc_attr( 'standard' === $instance['show_posts'] ? 'true' : 'false' ); ?>">
				</div>
			</div>
			<?php

			echo wp_kses_post( $args['after_widget'] );
		}

		/**
		 * Render form
		 *
		 * @param array $instance Instance of widget.
		 *
		 * @return void
		 */
		function form( $instance ) {
			$instance = wp_parse_args( $instance, $this->get_default_args() );
			$delay_time_ms = apply_filters( 'g1_fb_page_delay_time_ms', 5000 );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( 'G1 Facebook Page', 'title', $instance['title'] );
			}

			?>
			<div class="g1-widget-facebook-page">
				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Widget title', 'g1_socials' ); ?>
						:</label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
					       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
					       value="<?php echo esc_attr( $instance['title'] ); ?>">
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'page_url' ) ); ?>"><?php esc_html_e( 'Facebook page url', 'g1_socials' ); ?>
						:</label>
					<input class="widefat" type="text"
					       name="<?php echo esc_attr( $this->get_field_name( 'page_url' ) ); ?>"
					       id="<?php echo esc_attr( $this->get_field_id( 'page_url' ) ); ?>"
					       value="<?php echo esc_attr( $instance['page_url'] ) ?>"/>
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>"><?php esc_html_e( 'Small header', 'g1_socials' ); ?>
						:</label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'small_header' ) ); ?>"
					        id="<?php echo esc_attr( $this->get_field_id( 'small_header' ) ); ?>">
						<option
							value="none"<?php selected( 'none', $instance['small_header'] ); ?>><?php esc_html_e( 'no', 'g1_socials' ); ?></option>
						<option
							value="standard"<?php selected( 'standard', $instance['small_header'] ); ?>><?php esc_html_e( 'yes', 'g1_socials' ); ?></option>
					</select>
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>"><?php esc_html_e( 'Hide cover', 'g1_socials' ); ?>
						:</label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'hide_cover' ) ); ?>"
					        id="<?php echo esc_attr( $this->get_field_id( 'hide_cover' ) ); ?>">
						<option
							value="none"<?php selected( 'none', $instance['hide_cover'] ); ?>><?php esc_html_e( 'no', 'g1_socials' ); ?></option>
						<option
							value="standard"<?php selected( 'standard', $instance['hide_cover'] ); ?>><?php esc_html_e( 'yes', 'g1_socials' ); ?></option>
					</select>
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>"><?php esc_html_e( 'Show facepile', 'g1_socials' ); ?>
						:</label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'show_facepile' ) ); ?>"
					        id="<?php echo esc_attr( $this->get_field_id( 'show_facepile' ) ); ?>">
						<option
							value="none"<?php selected( 'none', $instance['show_facepile'] ); ?>><?php esc_html_e( 'no', 'g1_socials' ); ?></option>
						<option
							value="standard"<?php selected( 'standard', $instance['show_facepile'] ); ?>><?php esc_html_e( 'yes', 'g1_socials' ); ?></option>
					</select>
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'show_posts' ) ); ?>"><?php esc_html_e( 'Show posts', 'g1_socials' ); ?>
						:</label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'show_posts' ) ); ?>"
					        id="<?php echo esc_attr( $this->get_field_id( 'show_posts' ) ); ?>">
						<option
							value="none"<?php selected( 'none', $instance['show_posts'] ); ?>><?php esc_html_e( 'no', 'g1_socials' ); ?></option>
						<option
							value="standard"<?php selected( 'standard', $instance['show_posts'] ); ?>><?php esc_html_e( 'yes', 'g1_socials' ); ?></option>
					</select>
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'delay_load_ms' ) ); ?>"><?php esc_html_e( 'Delay load', 'g1_socials' ); ?>
						:</label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'delay_load_ms' ) ); ?>"
					        id="<?php echo esc_attr( $this->get_field_id( 'delay_load_ms' ) ); ?>">
						<option
							value="0"<?php selected( '0', $instance['delay_load_ms'] ); ?>><?php esc_html_e( 'no', 'g1_socials' ); ?></option>
						<option
							value="<?php echo esc_attr( $delay_time_ms ); ?>"<?php selected( $delay_time_ms, $instance['delay_load_ms'] ); ?>><?php esc_html_e( 'yes', 'g1_socials' ); ?></option>
					</select>
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"><?php esc_html_e( 'HTML id attribute (optional)', 'g1_socials' ); ?>
						:</label>
					<input class="widefat" type="text" name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>"
					       id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"
					       value="<?php echo esc_attr( $instance['id'] ) ?>"/>
				</p>

				<p>
					<label
						for="<?php echo esc_attr( $this->get_field_id( 'class' ) ); ?>"><?php esc_html_e( 'HTML class attribute (optional)', 'g1_socials' ); ?>
						:</label>
					<input class="widefat" type="text"
					       name="<?php echo esc_attr( $this->get_field_name( 'class' ) ); ?>"
					       id="<?php echo esc_attr( $this->get_field_id( 'class' ) ); ?>"
					       value="<?php echo esc_attr( $instance['class'] ) ?>"/>
				</p>
			</div>
			<?php
		}

		/**
		 * Update widget
		 *
		 * @param array $new_instance New instance.
		 * @param array $old_instance Old instance.
		 *
		 * @return array
		 */
		function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['title']         = strip_tags( $new_instance['title'] );
			$instance['page_url']      = esc_url_raw( $new_instance['page_url'] );
			$instance['small_header']  = in_array( $new_instance['small_header'], array(
				'none',
				'standard',
			), true ) ? $new_instance['small_header'] : 'standard';
			$instance['hide_cover']    = in_array( $new_instance['hide_cover'], array(
				'none',
				'standard',
			), true ) ? $new_instance['hide_cover'] : 'standard';
			$instance['show_facepile'] = in_array( $new_instance['show_facepile'], array(
				'none',
				'standard',
			), true ) ? $new_instance['show_facepile'] : 'standard';
			$instance['show_posts']    = in_array( $new_instance['show_posts'], array(
				'none',
				'standard',
			), true ) ? $new_instance['show_posts'] : 'standard';

			$instance['delay_load_ms'] = intval( $new_instance['delay_load_ms'] );

			$instance['id']            = sanitize_html_class( $new_instance['id'] );
			$instance['class']         = implode( ' ', array_map( 'sanitize_html_class', explode( ' ', $new_instance['class'] ) ) );

			return $instance;
		}
	}

endif;
