<?php
/**
 * Theme common functions
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Get theme identificator
 *
 * @return string
 */
function bimber_get_theme_id() {
	return 'bimber_theme';
}

/**
 * Get the id of the option where we store all theme options
 *
 * @return string
 */
function bimber_get_theme_options_id() {
	return 'bimber_theme_options';
}

/**
 * Get theme name
 *
 * @return string
 */
function bimber_get_theme_name() {
	return 'bimber';
}

/**
 * Get theme version
 *
 * @return string
 */
function bimber_get_theme_version() {
	$current_theme = wp_get_theme(get_template());

	return $current_theme->exists() ? $current_theme->get( 'Version' ) : '1.0';
}

/**
 * Get theme options prefixes
 *
 * @return array
 */
function bimber_get_theme_options_vars_prefixes() {
	return array(
		'theme_update',
		'advanced',
		'tracking_code',
	);
}

/**
 * Get default theme option values
 *
 * @return array
 */
function bimber_get_theme_defaults() {
	static $defaults;

	// Load only once.
	if ( ! $defaults ) {
		require( BIMBER_ADMIN_DIR . 'customizer/customizer-defaults.php' );
		require( BIMBER_ADMIN_DIR . 'theme-options/theme-defaults.php' );

		$storage_name = bimber_get_theme_id();

		/**
		 * Vars from included files
		 *
		 * @var array $bimber_customizer_defaults
		 * @var array $bimber_theme_options_defaults
		 */
		$defaults = array(
			$storage_name              => $bimber_customizer_defaults,
			$storage_name . '_options' => $bimber_theme_options_defaults,
		);
	}

	return $defaults;
}

/**
 * Get theme options about image paths
 *
 * @return array
 */
function bimber_get_theme_image_options() {
	return array(
		'branding_logo',
		'branding_logo_hdpi',
		'branding_logo_small',
		'branding_logo_small_hdpi',
		'footer_stamp',
		'footer_stamp_hdpi',
		'newsletter_popup_cover',
		'header_builder_canvas_background_image',
	);
}

/**
 * Get theme option value
 *
 * @param string $base 				Base.
 * @param string $key 				Key.
 * @param bool   $force_global		If set to true, global value will always be returned.
 *
 * @return mixed
 */
function bimber_get_theme_option( $base, $key, $force_global = false ) {
	/*
	 * Single category.
	 */

	if ( ! $force_global && 'archive' === $base && is_category() ) {
		if ( 'header_hide_elements' === $key ) {
		}
		$term 				= get_queried_object();
		$term_meta_prefix 	= 'bimber_';
		$term_setting 		= get_term_meta( $term->term_id, $term_meta_prefix . $key, true );
		if ( 'header_hide_elements' === $key ) {
		}
		// Valid setting is not empty, empty string is reserved for "inherit" value.
		if ( $term_setting ) {
			return $term_setting;
		}
	}

	/*
	 * Single post tag.
	 */

	if ( ! $force_global && 'archive' === $base && is_tag() ) {
		$term 				= get_queried_object();
		$term_meta_prefix 	= 'bimber_';
		$term_setting 		= get_term_meta( $term->term_id, $term_meta_prefix . $key, true );

		// Valid setting is not empty, empty string is reserved for "inherit" value.
		if ( $term_setting ) {
			return $term_setting;
		}
	}

	/*
	 * Global.
	 */

	$storage_name = bimber_get_theme_id();

	// Use different storage for WP Admin > Appearance > Theme Options values.
	if ( in_array( $base, bimber_get_theme_options_vars_prefixes(), true ) ) {
		$storage_name .= '_options';
	}

	$storage_values = get_option( $storage_name, array() );

	$option_name = $base;

	if ( strlen( $key ) > 0 ) {
		$option_name .= '_' . $key;
	}

	$defaults = bimber_get_theme_defaults();

	if ( isset( $defaults[ $storage_name ][ $option_name ] ) ) {
		$result = isset( $storage_values[ $option_name ] ) ? $storage_values[ $option_name ] : $defaults[ $storage_name ][ $option_name ];
	} else {
		$result = null;
	}
	return $result;
}

/**
 * Set theme option value
 *
 * @param string $base Base.
 * @param string $key Key.
 * @param mixed  $value Value.
 */
function bimber_set_theme_option( $base, $key, $value ) {
	$storage_name = bimber_get_theme_id();

	// Use different storage for WP Admin > Appearance > Theme Options values.
	if ( in_array( $base, bimber_get_theme_options_vars_prefixes(), true ) ) {
		$storage_name .= '_options';
	}

	$storage_values = get_option( $storage_name, array() );

	$option_name = $base;

	if ( strlen( $key ) > 0 ) {
		$option_name .= '_' . $key;
	}

	$storage_values[ $option_name ] = $value;

	update_option( $storage_name, $storage_values );
}

/**
 * Set template part data.
 *
 * @param mixed|void $data Data.
 */
function bimber_set_template_part_data( $data ) {
	global $bimber_template_data;
	global $bimber_template_data_last;

	$bimber_template_data_last = $bimber_template_data;
	$bimber_template_data      = $data;
}

/**
 * Get template part data.
 *
 * @return mixed
 */
function bimber_get_template_part_data() {
	global $bimber_template_data;

	return $bimber_template_data;
}

/**
 * Reset template part data
 */
function bimber_reset_template_part_data() {
	global $bimber_template_data;
	global $bimber_template_data_last;

	$bimber_template_data = $bimber_template_data_last;
}

/**
 * Return query args for most shared posts
 *
 * @param array $query_args         Arguments.
 *
 * @return array
 */
function bimber_get_most_shared_query_args( $query_args ) {
	if ( isset( $query_args['time_range'] ) ) {
		$query_args = bimber_time_range_to_date_query( $query_args['time_range'], $query_args );
	}

	return apply_filters( 'bimber_most_shared_query_args', $query_args );
}

/**
 * Return query args for most viewed posts
 *
 * @param array $query_args     Arguments.
 *
 * @return array
 */
function bimber_get_most_viewed_query_args( $query_args, $type = '' ) {
	if ( isset( $query_args['time_range'] ) ) {
		$query_args = bimber_time_range_to_date_query( $query_args['time_range'], $query_args );
	}

	// By default there are no most viewed posts,
	// so to make sure that no posts will be returned we use none existing post id.
	$query_args['post__in'] = array( -1 );

	return apply_filters( 'bimber_most_viewed_query_args', $query_args, $type );
}

/**
 * Get the maximum number of hot posts
 *
 * @return int
 */
function bimber_get_hot_posts_limit() {
	return apply_filters( 'bimber_hot_posts_limit', 10 );
}

/**
 * Get the maximum number of popular posts
 *
 * @return int
 */
function bimber_get_popular_posts_limit() {
	return apply_filters( 'bimber_popular_posts_limit', 10 );
}

/**
 * Get the maximum number of trending posts
 *
 * @return int
 */
function bimber_get_trending_posts_limit() {
	return apply_filters( 'bimber_trending_posts_limit', 10 );
}

/**
 * Get the maximum number of related posts
 *
 * @return int
 */
function bimber_get_related_posts_limit() {
	return apply_filters( 'bimber_related_posts_limit', bimber_get_theme_option( 'post', 'related_max_posts' ) );
}

/**
 * Get the maximum number of "More From" posts
 *
 * @return int
 */
function bimber_get_more_from_posts_limit() {
	return apply_filters( 'bimber_more_from_posts_limit', bimber_get_theme_option( 'post', 'more_from_max_posts' ) );
}

/**
 * Get the maximum number of "Don't Miss" posts
 *
 * @return int
 */
function bimber_get_dont_miss_posts_limit() {
	return apply_filters( 'bimber_dont_miss_posts_limit', bimber_get_theme_option( 'post', 'dont_miss_max_posts' ) );
}

/**
 * Convert custom time range to date query args
 *
 * @param string $time_range      Time range type.
 * @param array  $query_args       Arguments.
 *
 * @return array
 */
function bimber_time_range_to_date_query( $time_range, $query_args ) {
	switch ( $time_range ) {
		case 'day':
			$date_ago = '1 day ago';
			break;

		case 'week':
			$date_ago = '1 week ago';
			break;

		case 'month':
			$date_ago = '1 month ago';
			break;
	}

	// Keep it for further use (eg. for 3rd party plugins like WPP).
	$query_args['time_range'] = $time_range;

	if ( isset( $date_ago ) ) {
		$query_args['date_query'] = array(
			array(
				'after' => $date_ago,
			),
		);
	}

	return $query_args;
}

/**
 * Get predefined sidebars
 *
 * @return array
 */
function bimber_get_predefined_sidebars() {
	return array(
		'primary'      => array(
			'label' => esc_html__( 'Primary', 'bimber' ),
		),
		'secondary'      => array(
			'label' => esc_html__( 'Secondary', 'bimber' ),
		),
		'home'         => array(
			'label'       => esc_html__( 'Home', 'bimber' ),
			'description' => esc_html__( 'Leave empty to use the Primary sidebar', 'bimber' ),
		),
		'home_2nd'         => array(
			'label'       => esc_html__( 'Home 2nd', 'bimber' ),
			'description' => esc_html__( 'Leave empty to use the Secondary sidebar', 'bimber' ),
		),
		'post_single'  => array(
			'label'       => esc_html__( 'Single Post', 'bimber' ),
			'description' => esc_html__( 'Leave empty to use the Primary sidebar', 'bimber' ),
		),
		'post_archive' => array(
			'label'       => esc_html__( 'Post Archives', 'bimber' ),
			'description' => esc_html__( 'For posts archive pages (categories, tags). Leave empty to use the Primary sidebar', 'bimber' ),
		),
		'post_archive_2nd' => array(
			'label'       => esc_html__( 'Post Archives 2nd', 'bimber' ),
			'description' => esc_html__( 'For posts archive pages (categories, tags). Leave empty to use the Secondary sidebar', 'bimber' ),
		),
		'page'         => array(
			'label'       => esc_html__( 'Pages', 'bimber' ),
			'description' => esc_html__( 'Leave empty to use the Primary sidebar', 'bimber' ),
		),
		'footer-1'     => array(
			'label' => esc_html__( 'Footer 1', 'bimber' ),
		),
		'footer-2'     => array(
			'label' => esc_html__( 'Footer 2', 'bimber' ),
		),
		'footer-3'     => array(
			'label' => esc_html__( 'Footer 3', 'bimber' ),
		),
	);
}

/**
 * Get nice name of a sidebar
 *
 * @param string $sidebar_id Sidebar identificator.
 *
 * @return mixed|string
 */
function bimber_get_nice_sidebar_name( $sidebar_id ) {
	$sidebar_name = str_replace( '-', ' ', $sidebar_id );

	// Split to single words.
	$parts = explode( ' ', $sidebar_name );

	// Each word with first letter capitalized.
	$parts = array_map( 'ucfirst', $parts );

	// Join to one string.
	$sidebar_name = implode( ' ', $parts );

	return $sidebar_name;
}

/**
 * Check whether the plugin is active and theme can rely on it
 *
 * @param string $plugin        Base plugin path.
 * @return bool
 */
function bimber_can_use_plugin( $plugin ) {
	// Detect plugin. For use on Front End only.
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	return is_plugin_active( $plugin );
}

/**
 * Empty theme related transients.
 */
function bimber_delete_transients() {
	delete_transient( 'bimber_featured_entries_query' );
	delete_transient( 'bimber_dont_miss_query' );
}

/**
 * Calculate hot posts.
 *
 * The list position is stored in the "_bimber_hot" post meta.
 *
 * @return array            Calculated post ids.
 */
function bimber_calculate_hot_posts() {
	delete_post_meta_by_key( '_bimber_hot' );

	$query_args = bimber_get_most_viewed_query_args( array(
		'posts_per_page' => bimber_get_hot_posts_limit(),
		'time_range'     => 'month',
	), 'hot' );

	$query = new WP_Query();
	$posts = $query->query( $query_args );
	$ids = array();

	foreach ( $posts as $index => $post ) {
		$ids[] = $post->ID;
		update_post_meta( $post->ID, '_bimber_hot', $index + 1 );
	}

	return $ids;
}

/**
 * If list empty, calculate
 *
 * @param array $ids                    Current list of ids.
 * @param int   $limit                  Limit.
 *
 * @return array                        Calculated list.
 */
function bimber_calculate_hot_post_ids_if_empty( $ids, $limit ) {
	if ( empty( $ids ) ) {
		$ids = bimber_calculate_hot_posts();
	}

	return $ids;
}

/**
 * Calculate popular posts.
 *
 * The list position is stored in the "_bimber_popular" post meta.
 *
 * @return array    Calculated post ids.
 */
function bimber_calculate_popular_posts() {
	delete_post_meta_by_key( '_bimber_popular' );

	$query_args = bimber_get_most_viewed_query_args( array(
		'posts_per_page' => bimber_get_popular_posts_limit(),
	), 'popular' );



	$query = new WP_Query();
	$posts = $query->query( $query_args );
	$ids = array();

	foreach ( $posts as $index => $post ) {
		$ids[] = $post->ID;
		update_post_meta( $post->ID, '_bimber_popular', $index + 1 );
	}

	return $ids;
}

/**
 * If list empty, calculate
 *
 * @param array $ids                    Current list of ids.
 * @param int   $limit                  Limit.
 *
 * @return array                        Calculated list.
 */
function bimber_calculate_popular_post_ids_if_empty( $ids, $limit ) {
	if ( empty( $ids ) ) {
		$ids = bimber_calculate_popular_posts();
	}

	return $ids;
}

/**
 * Calculate trending posts.
 *
 * The list position is stored in the "_bimber_popular" post meta.
 *
 * @return array    Calculated post ids.
 */
function bimber_calculate_trending_posts() {
	delete_post_meta_by_key( '_bimber_trending' );

	$query_args = bimber_get_most_viewed_query_args( array(
		'posts_per_page' => bimber_get_trending_posts_limit(),
		'time_range'     => 'day',
	), 'trending' );

	$query = new WP_Query();
	$posts = $query->query( $query_args );
	$ids = array();

	foreach ( $posts as $index => $post ) {
		$ids[] = $post->ID;
		update_post_meta( $post->ID, '_bimber_trending', $index + 1 );
	}

	return $ids;
}

/**
 * If list empty, calculate
 *
 * @param array $ids                    Current list of ids.
 * @param int   $limit                  Limit.
 *
 * @return array                        Calculated list.
 */
function bimber_calculate_trending_post_ids_if_empty( $ids, $limit ) {
	if ( empty( $ids ) ) {
		$ids = bimber_calculate_trending_posts();
	}

	return $ids;
}

/**
 * Convers string (opt1,opt2,opt3) into bool array (array( opt1 => true ))
 *
 * @param string $string        Comma-separated list of elements.
 * @param array  $array         All elements.
 *
 * @return array
 */
function bimber_conver_string_to_bool_array( $string, $array ) {
	$string_arr = explode( ',', $string );

	foreach ( $array as $key => $value ) {
		if ( in_array( $key, $string_arr, true ) ) {
			$array[ $key ] = false;
		}
	}

	return $array;
}

/**
 * Adjust embed defaul values.
 *
 * @param array  $dims Dimensions.
 * @param string $url URL.
 *
 * @return mixed
 */
function bimber_embed_defaults( $dims, $url ) {
	// 16:9 aspect ratio.
	$video_16_9_domains = apply_filters( 'bimber_oembed_video_16_9_domains', array(
		'youtube.com',
		'youtu.be',
		'vimeo.com',
		'dailymotion.com',
		'facebook.com/plugins/video.php',
	) );

	$is_video_16_9 = false;

	foreach ( $video_16_9_domains as $video_16_9_domain ) {
		if ( strpos( $url, $video_16_9_domain ) !== false ) {
			$is_video_16_9 = true;
			break;
		}
	}

	if ( $is_video_16_9 ) {
		$dims['height'] = absint( round( 9 * $dims['width'] / 16 ) );
	}

	// 1:1 aspect ratio.
	$video_1_1_domains = apply_filters( 'bimber_oembed_video_1_1_domains', array(
		'vine.co',
	) );

	$is_video_1_1 = false;

	foreach ( $video_1_1_domains as $video_1_1_domain ) {
		if ( strpos( $url, $video_1_1_domain ) !== false ) {
			$is_video_1_1 = true;
			break;
		}
	}

	if ( $is_video_1_1 ) {
		$dims['height'] = $dims['width'];
	}

	return $dims;
}

/**
 * Wrap embeds in fluid wrapper
 *
 * @param string $html oembed HTML markup.
 * @param string $url Embed URL.
 * @param array  $attr Attributes.
 *
 * @return string
 */
function bimber_fluid_wrapper_embed_oembed_html( $html, $url, $attr ) {
	$apply = apply_filters( 'bimber_apply_fluid_wrapper_for_oembed', false, $url );

	preg_match_all( '/<blockquote class=\"embedly-card\".*<\/blockquote>/', $html, $matches );

	if ( ! $apply || count( $matches[0] ) > 0 ) {
		return $html;
	}

	return bimber_fluid_wrapper( array(
		'width'  => esc_attr( $attr['width'] ),
		'height' => esc_attr( $attr['height'] ),
	), $html );
}

/**
 * Keep element ratio while scaling.
 *
 * @param array  $atts Attributes.
 * @param string $content Content.
 *
 * @return string
 */
function bimber_fluid_wrapper( $atts, $content ) {
	/* We need a static counter to trace a shortcode without the id attribute */
	static $counter = 0;
	$counter ++;

	$vars = shortcode_atts( array(
		'id'     => '',
		'class'  => '',
		'width'  => '',
		'height' => '',
	), $atts, 'bimber_fluid_wrapper' );

	$id     = $vars['id'];
	$class  = $vars['class'];
	$width  = $vars['width'];
	$height = $vars['height'];

	$content = preg_replace( '#^<\/p>|<p>$#', '', $content );

	// Compose final HTML id attribute.
	$final_id = strlen( $id ) ? $id : 'g1-fluid-wrapper-counter-' . $counter;

	// Compose final HTML class attribute.
	$final_class = array(
		'g1-fluid-wrapper',
	);

	$final_class = array_merge( $final_class, explode( ' ', $class ) );

	// Get width and height values.
	$width  = absint( $width );
	$height = absint( $height );

	if ( ! $width ) {
		$re    = '/width=[\'"]?(\d+)[\'"]?/';
		$width = preg_match( $re, $content, $match );
		$width = $width ? absint( $match[1] ) : 0;
	}

	if ( ! $height ) {
		$re     = '/height=[\'"]?(\d+)[\'"]?/';
		$height = preg_match( $re, $content, $match );
		$height = $height ? absint( $match[1] ) : 0;
	}

	$height = ( 9999 === $height ) ? round( $width * 9 / 16 ) : $height;

	// Compose output.
	$out = '<div id="%id%" class="%class%" %outer_style% data-g1-fluid-width="%fluid_width%" data-g1-fluid-height="%fluid_height%">
	       <div class="g1-fluid-wrapper-inner" %inner_style%>
	       %content%
	       </div>
	       </div>';
	$out = str_replace(
		array(
			'%id%',
			'%class%',
			'%outer_style%',
			'%fluid_width%',
			'%fluid_height%',
			'%inner_style%',
			'%content%',
		),
		array(
			esc_attr( $final_id ),
			implode( ' ', array_map( 'sanitize_html_class', $final_class ) ),
			( $width && $height ? 'style="width:' . absint( $width ) . 'px;"' : '' ),
			$width,
			$height,
			( $width && $height ? 'style="padding-bottom:' . ( absint( $height ) / absint( $width ) ) * 100 . '%;"' : '' ),
			do_shortcode( shortcode_unautop( $content ) ),
		),
		$out
	);

	return $out;
}

/**
 * Apply fluid wrapper for embedded services
 *
 * @param bool   $apply     Current state.
 * @param string $url       Service url.
 *
 * @return bool
 */
function bimber_apply_fluid_wrapper_for_services( $apply, $url ) {
	$services = apply_filters( 'bimber_fluid_wrapper_services', array(
		'youtube.com',
		'youtu.be',
		'vimeo.com',
		'dailymotion.com',
		'vine.co',
		'facebook.com/plugins/video.php',
	) );

	foreach ( $services as $service ) {
		if ( strpos( $url, $service ) !== false ) {
			$apply = true;
			break;
		}
	}

	return $apply;
}

/**
 * Returns list of avaliable templates for single post
 *
 * @return array
 */
function bimber_get_post_templates() {
	$uri = BIMBER_ADMIN_DIR_URI . 'images/templates/post/';

	return apply_filters( 'bimber_single_post_templates', array(
		'classic' => array(
			'label' => esc_html__( 'Classic', 'bimber' ),
			'path'  => $uri . 'classic.png',
		),
		'classic-no-sidebar' => array(
			'label' => esc_html__( 'Classic, no sidebar', 'bimber' ),
			'path' => $uri . 'classic-no-sidebar.png',
		),
		'classic-v2' => array(
			'label' => esc_html__( 'Classic v2', 'bimber' ),
			'path' => $uri . 'classic-v2.png',
		),
		'classic-v3' => array(
			'label' => esc_html__( 'Classic v3', 'bimber' ),
			'path' => $uri . 'classic-v3.png',
		),
		'classic-v3-no-sidebar' => array(
			'label' => esc_html__( 'Classic v3, no sidebar', 'bimber' ),
			'path' => $uri . 'classic-v3-no-sidebar.png',
		),
		'media' => array(
			'label' => esc_html__( 'Media', 'bimber' ),
			'path'  => $uri . 'media.png',
		),
		'media-v2' => array(
			'label' => esc_html__( 'Media v2', 'bimber' ),
			'path'  => $uri . 'media-v2.png',
		),
		'background-stretched' => array(
			'label' => esc_html__( 'Background stretched', 'bimber' ),
			'path'  => $uri . 'background-stretched.png',
		),
		'background-stretched-no-sidebar' => array(
			'label' => esc_html__( 'Background stretched, no sidebar', 'bimber' ),
			'path'  => $uri . 'background-stretched-no-sidebar.png',
		),
		'background-stretched-v2' => array(
			'label' => esc_html__( 'Background stretched, v2', 'bimber' ),
			'path'  => $uri . 'background-stretched-v2.png',
		),
		'background-boxed' => array(
			'label' => esc_html__( 'Background boxed', 'bimber' ),
			'path'  => $uri . 'background-boxed.png',
		),
		'background-boxed-v2' => array(
			'label' => esc_html__( 'Background boxed, v2', 'bimber' ),
			'path'  => $uri . 'background-boxed-v2.png',
		),
		'overlay-stretched' => array(
			'label' => esc_html__( 'Overlay stretched', 'bimber' ),
			'path'  => $uri . 'overlay-stretched.png',
		),
		'overlay-stretched-no-sidebar' => array(
			'label' => esc_html__( 'Overlay stretched, no sidebar', 'bimber' ),
			'path'  => $uri . 'overlay-stretched-no-sidebar.png',
		),
		'overlay-stretched-v2' => array(
			'label' => esc_html__( 'Overlay stretched, v2', 'bimber' ),
			'path'  => $uri . 'overlay-stretched-v2.png',
		),
		'overlay-boxed' => array(
			'label' => esc_html__( 'Overlay boxed', 'bimber' ),
			'path'  => $uri . 'overlay-boxed.png',
		),
		'overlay-boxed-v2' => array(
			'label' => esc_html__( 'Overlay boxed, v2', 'bimber' ),
			'path'  => $uri . 'overlay-boxed-v2.png',
		),
	) );
}

/**
 * Return number of featured entries for passed template
 *
 * @param string $template_name		Template name.
 * @param int 	 $default			Default value.
 *
 * @return int
 */
function bimber_get_post_per_page_from_template( $template_name, $default = 3 ) {
	$result = $default;

	switch ( $template_name ) {
		case 'module-01':
		case '3-3v-3v-3v-3v-stretched':
		case '3-3v-3v-3v-3v-boxed':
			$result = 5;
			break;

		case '4-4-4-4-stretched':
		case '4-4-4-4-boxed':
		case 'todo-music':
			$result = 4;
			break;

		case '2-2-stretched':
		case '2-2-boxed':
			$result = 2;
			break;

		case '1-sidebar':
		case '1-sidebar-bunchy':
			$result = 1;
			break;
	}

	return $result;
}

/**
 * Render the featured media of the current post.
 *
 * @param array $args Arguments.
 */
function bimber_render_entry_featured_media( $args = array() ) {
	if ( apply_filters( 'bimber_render_entry_featured_media', true, $args ) ) {
		echo bimber_capture_entry_featured_media( $args );
	}
}

/**
 * Capture the featured media of the current post.
 *
 * @param array $args Arguments.
 *
 * @return string       Escaped HTML
 */
function bimber_capture_entry_featured_media( $args ) {
	global $post;

	$args = wp_parse_args( $args, array(
		'size'              => 'post-thumbnail',
		'class'				=> '',
		'use_microdata'     => false,
		'use_ellipsis'      => false,
		'use_sizer'         => true,
		'apply_link'        => true,
		'background_image'  => false,
		'force_placeholder' => false,
		'show_caption'      => false,
		'allow_video'       => false,
	) );

	$args = apply_filters( 'bimber_entry_featured_media_args', $args );

	if ( post_password_required() || is_attachment( get_the_ID() ) ) {
		return '';
	}

	$out = '';
	if ( is_single() ) {
		$load_embeds_on_archives = false;
	} else {
		$load_embeds_on_archives = false;
		if ( is_archive() ) {
			$load_embeds_on_archives = 'standard' === bimber_get_theme_option( 'archive', 'inject_embeds');
		}
		if ( is_home() ) {
			$load_embeds_on_archives = 'standard' === bimber_get_theme_option( 'home', 'inject_embeds');
		}
		if ( is_search() ) {
			$load_embeds_on_archives = 'standard' === bimber_get_theme_option( 'search', 'inject_embeds');
		}
	}
	$load_embeds_on_archives = apply_filters( 'bimber_load_embeds_on_archives', $load_embeds_on_archives );
	$load_embeds_for_sizes   = apply_filters( 'bimber_load_embeds_for_sizes', array( 'bimber-stream', 'bimber-grid-2of3' ) );
	$allowed_size = in_array( $args['size'], $load_embeds_for_sizes, true );
	$archive_settings = bimber_get_archive_settings();
	if ( is_archive() && $archive_settings['elements']['summary'] && 'bimber-grid-2of3' === $args['size'] ) {
		$allowed_size = false;
	}
	$home_settings = bimber_get_home_settings();
	if ( is_home() && $home_settings['elements']['summary'] && 'bimber-grid-2of3' === $args['size'] ) {
		$allowed_size = false;
	}
	$nsfw = bimber_is_nsfw() && ! is_category( bimber_get_nsfw_categories() );

	if ( $load_embeds_on_archives && $allowed_size ) {
		// @todo - refactor to allow NSFW and other featrued image related options for embeds (if possible).

		$embed = bimber_get_the_post_embed( null, $args['size'] );

		if ( ! empty( $embed ) ) {
			$final_class = array(
				'entry-featured-media',
			);

			if ( $args['use_microdata'] ) {
				$out .= '<figure class="' . implode( ' ', array_map( 'sanitize_html_class', $final_class ) ) . '" itemprop="video" itemscope itemtype="http://schema.org/VideoObject">';
			} else {
				$out .= '<figure class="' . implode( ' ', array_map( 'sanitize_html_class', $final_class ) ) . '">';
			}

			$out .= $embed;

			if ( $nsfw ) {
				$final_class[] = 'entry-media-nsfw';
				$final_class[] = 'entry-media-nsfw-embed';
				$out .= '<div class="g1-nsfw">';
				$out .= '<div class="g1-nsfw-inner">';
				$out .= '<i class="g1-nsfw-icon"></i>';
				$out .= '<div class="g1-nsfw-title">' . __( 'Not Safe For Work', 'bimber' ) .  '</div>';
				$out .= '<div class="g1-nsfw-desc">' . __( 'Click to view this post', 'bimber' ) .  '</div>';
				$out .= '</div>';
				$out .= '</div>';
			}

			$out .= '</figure>';
		}
	}

	// If embed found, use it.
	if ( ! empty( $out ) ) {
		return $out;
	}

	if ( ! has_post_thumbnail() && ! $args['force_placeholder'] ) {
		return '';
	}

	do_action( 'bimber_before_capture_entry_featured_media', $args );

	$style_attr_escaped = '';

	if ( $args['background_image'] ) {
		$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $args['size'] );

		$style_attr_escaped = ' style="background-image: url(' . esc_url( $full_image[0] ) . ');"';
	}

	$inner_style_escaped = '';

	// Get thumbnail to display.
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $args['size'] );

	$use_ellipsis = false;

	if ( is_array( $thumb ) ) {
		$thumb_width  = absint( $thumb[1] );
		$thumb_height = absint( $thumb[2] );

		// Use ellipsis.
		if ( $args['use_ellipsis'] ) {
			$ratio = 0 !== $thumb_width ? $thumb_height / $thumb_width : 0;
			$use_ellipsis = $ratio > ( 3 / 1 ) ? true : false;
		}

		// Use sizer. Prevent image loading jump.
		if ( true === $args['use_sizer'] ) {
			$inner_style_escaped = ' style="padding-bottom: ' . sprintf( "%.8F", $thumb[2] / $thumb[1] * 100 ) . '%;"';
		}
	}

	$final_class = array(
		'entry-featured-media',
	);

	if ( $use_ellipsis ) {
		$final_class[] = 'entry-media-with-ellipsis';
	}

	if ( $nsfw ) {

		$final_class[] = 'entry-media-nsfw';
	}

	$final_class = array_merge( $final_class, explode( ' ', $args['class'] ) );

	// Get image to use in microdata.
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

	// GIF has to be served in original size so GIF player can be loaded on it.
	if ( is_array( $image ) && false !== strpos( $image[0], '.gif' )) {
		$args['size'] = 'full';
	}

	$out_escaped = '';

	if ( $args['use_microdata'] ) {
		$out_escaped .= '<figure class="' . implode( ' ', array_map( 'sanitize_html_class', $final_class ) ) . '" ' . $style_attr_escaped . ' itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
	} else {
		$out_escaped .= '<figure class="' . implode( ' ', array_map( 'sanitize_html_class', $final_class ) ) . '" ' . $style_attr_escaped . '>';
	}

	if ( $args['apply_link'] ) {
		$out_escaped .= '<a class="g1-frame" href="' . esc_url( apply_filters( 'the_permalink', get_permalink( $post ), $post ) ) . '">';
		$out_escaped .= '<span class="g1-frame-inner"' . $inner_style_escaped . '>';

		if ( $args['use_microdata'] ) {
			$out_escaped .= get_the_post_thumbnail( null, $args['size'], array( 'itemprop' => 'contentUrl' ) );
		} else {
			$out_escaped .= get_the_post_thumbnail( null, $args['size'] );
		}

		$post_format = apply_filters( 'bimber_get_post_format_for_icon', get_post_format( $post ), $post );

		$out_escaped .= '<span class="g1-frame-icon g1-frame-icon-' . sanitize_html_class( $post_format ) .'">';
		if ( 'gallery' === $post_format ) {
			$out_escaped .= bimber_get_post_gallery_media_count( $post );
		}

		$out_escaped .= '</span>';

		if ( $nsfw ) {
			$out_escaped .= '<div class="g1-nsfw">';
			$out_escaped .= '<div class="g1-nsfw-inner">';
			$out_escaped .= '<i class="g1-nsfw-icon"></i>';
			$out_escaped .= '<div class="g1-nsfw-title">' . __( 'Not Safe For Work', 'bimber' ) .  '</div>';
			$out_escaped .= '<div class="g1-nsfw-desc">' . __( 'Click to view this post', 'bimber' ) .  '</div>';
			$out_escaped .= '</div>';
			$out_escaped .= '</div>';
		}

		$out_escaped .= '</span>'; // .g1-frame-inner container.

		$out_escaped .= '</a>'; // .g1-frame container.
	} else {
		$out_escaped .= '<span class="g1-frame">';
		$out_escaped .= '<span class="g1-frame-inner"' . $inner_style_escaped . '>';

		if ( $args['use_microdata'] ) {
			$out_escaped .= get_the_post_thumbnail( null, $args['size'], array( 'itemprop' => 'contentUrl' ) );
		} else {
			$out_escaped .= get_the_post_thumbnail( null, $args['size']);
		}

		$out_escaped .= '</span>';
		$out_escaped .= '</span>';
	}

	if ( $args['use_microdata'] ) {
		$out_escaped .= '<meta itemprop="url" content="' . esc_url( $image[0] ) .  '" />';
		$out_escaped .= '<meta itemprop="width" content="' . intval( $image[1] ) .  '" />';
		$out_escaped .= '<meta itemprop="height" content="' . intval( $image[2] ) .  '" />';
	}


	if ( $use_ellipsis ) {
		$out_escaped .= '<div class="entry-media-ellipsis">';
		$out_escaped .= '<a class="g1-button g1-button-xs g1-button-solid" href="' .  esc_url( apply_filters( 'the_permalink', get_permalink( $post ), $post ) ) . '">'  . esc_html__( 'View full post', 'bimber' ) .  '</a>';
		$out_escaped .= '</div>';
	}


	$thumb_id = get_post_thumbnail_id( get_the_ID() );

	// Show caption.
	if ( $args['show_caption'] ) {
		$thumb_img = get_post( $thumb_id );
		$thumb_caption = $thumb_img->post_excerpt;

		if ( strlen( $thumb_caption ) ) {
			$out_escaped .= '<figcaption class="wp-caption-text">';
			$out_escaped .= wp_kses_post( $thumb_caption );
			$out_escaped .= '</figcaption>';
		}
	}

	$out_escaped .= '</figure>';

	do_action( 'bimber_after_capture_entry_featured_media', $args );

	return apply_filters( 'bimber_capture_entry_featured_media', $out_escaped, $args, $post );
}

function bimber_get_the_post_embed( $post = null, $poster_size ) {
	$post = get_post( $post );

	$content = $post->post_content;

	// Replace line breaks from all HTML elements with placeholders.
	$content = wp_replace_in_html_tags( $content, array( "\n" => '<!-- wp-line-break -->' ) );

	$html = '';
	$url  = '';

	// Find URLs on their own line.
	if ( preg_match( '|^(\s*)(https?://[^\s<>"]+)(\s*)$|im', $content, $matches ) ) {
		$url = $matches[2];
		// Find URLs in their own paragraph.
	} elseif( preg_match( '|(<p(?: [^>]*)?>\s*)(https?://[^\s<>"]+)(\s*<\/p>)|i', $content, $matches ) ) {
		$url = $matches[2];
	}

	if ( ! empty( $url ) ) {
		global $wp_embed;

		$embed = $wp_embed->shortcode( array(), $matches[2] );

		// Check if valid string, may return false.
		if ( ! empty( $embed ) ) {
			// Converted to shortcode ([audio], [video])?
			if ( false !== strpos( $embed, '[' ) ) {
				if ( has_post_thumbnail( $post ) ) {
					$poster_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), $poster_size );
					$poster_url  = $poster_data[0];

					$embed = str_replace(']', ' poster="' . $poster_url . '"]', $embed);
				}

				$embed = do_shortcode( $embed );
			}

			$html = $embed;
		}
	}

	return $html;
}

/**
 * Checks whether the post is NSFW
 *
 * @return bool
 */
function bimber_is_nsfw() {
	$bool = false;

	if ( bimber_get_theme_option( 'nsfw', 'enabled' ) ) {
		$nsfw_categories = bimber_get_nsfw_categories();

		if ( ! empty( $nsfw_categories ) && has_category( $nsfw_categories ) ) {
			$bool = true;
		}
	}

	return apply_filters( 'bimber_is_nsfw', $bool );
}

/**
 * Return ids of categories for NSFW posts.
 *
 * @return array		Array of ids.
 */
function bimber_get_nsfw_categories() {
	$ids = array();
	$slugs = explode( ',', bimber_get_theme_option( 'nsfw', 'categories_ids' ) );

	foreach ( $slugs as $slug ) {
		$category = get_category_by_slug( $slug );

		if ( $category ) {
			$ids[] = $category->term_id;
		}
	}

	return $ids;
}

function bimber_allow_to_disable_wp_comment_type( $choices ) {
	if ( ! isset( $choices['native_comments'] ) ) {
		$choices['native_comments'] = esc_html__( 'Native comments tab', 'bimber' );
	}

	return $choices;
}

/**
 * Return list of registered comment types
 *
 * @return array
 */
function bimber_get_comment_types() {
	return apply_filters( 'bimber_comment_types', array() );
}

function bimber_is_theme_registered() {
	$is_registered = get_transient( 'bimber_theme_registered' );

	// Verified, access granted.
	if ( $is_registered ) {
		return true;
	}

	// Can't verify.
	if ( ! bimber_can_use_plugin( 'envato-market/envato-market.php' ) ) {
		return false;
	}

	$purchased_themes = envato_market()->api()->themes();

	foreach ( $purchased_themes as $purchased_theme ) {
		if ( bimber_get_theme_name() === strtolower( $purchased_theme['name'] ) ) {
			$is_registered = true;
		}
	}

	if ( $is_registered ) {
		$expire_in_one_day = 60 * 60 * 24;

		// Theme is active for next 24h. Then next check will be performed (user eg. got a refund).
		set_transient( 'bimber_theme_registered', true, $expire_in_one_day );
	}

	return $is_registered;
}

/**
 * Whether there is auto load template url var set
 *
 * @return bool
 */
function bimber_is_auto_load() {
	$auto_load_template = filter_input( INPUT_GET, 'bimber_auto_load_next_post_template', FILTER_SANITIZE_STRING );
	if ( $auto_load_template ) {
		return true;
	}
}

/**
 * Change video shortcode attributes to better match the content width
 *
 * @param string $out Markup.
 * @param array  $pairs Entire list of supported attributes and their defaults.
 * @param array  $atts User defined attributes in shortcode tag.
 * @param string $shortcode Shortcode name.
 *
 * @return mixed
 */
function bimber_wp_video_shortcode_atts( $out, $pairs, $atts ) {
	global $content_width;
	$width  = $out['width'];
	$height = $out['height'];

	$out['width']  = $content_width;
	if ( $width > 0 ) {
		$out['height'] = round( $content_width * $height / $width );
	}

	return $out;
}

/**
 * Render footer text
 */
function bimber_render_footer_text() {
	$bimber_footer_text = bimber_get_theme_option( 'footer', 'text' );

	// Automatic date (eg. usage @ %%Y%%).
	if ( preg_match( '/%%([^%]+)%%/', $bimber_footer_text, $date_matches ) ) {
		$bimber_footer_text = str_replace( $date_matches[0], date( $date_matches[1] ), $bimber_footer_text );
	}

	echo wp_kses_post( $bimber_footer_text );
}

/**
 * Get attachment by id.
 *
 * @param string $url attachment url.
 * @return string|bool attachment id or false
 */
function bimber_get_attachment_id_by_url( $url ) {
	$attachment_id = false;
	$cached_id = get_transient( 'bimber_get_attachment_id_by_url_' . sanitize_title( esc_url( $url ) ) );
	if ( false !== $cached_id ) {
		return $cached_id;
	}
	$dir = wp_upload_dir();

	if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) {
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'any',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files, true ) ) {
					$attachment_id = $post_id;
					set_transient( 'bimber_get_attachment_id_by_url_' . sanitize_title( esc_url( $url ) ), $attachment_id, 72 * HOUR_IN_SECONDS );
					break;
				}
			}
		}
	}
	return $attachment_id;
}

/**
 * Get current global style.
 *
 * @return string
 */
function bimber_get_current_stack() {
	return bimber_get_theme_option( 'global', 'stack' );
}
