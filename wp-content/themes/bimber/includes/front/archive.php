<?php
/**
 * Archive functions
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
 * Get the default archive settings
 *
 * @return mixed|void
 */
function bimber_get_archive_default_settings() {
	return apply_filters( 'bimber_archive_default_settings', array(
		'template'         => 'grid-sidebar',
		'pagination'       => 'load-more',
		'featured_entries' => array(
			'type' => 'none',
		),
		'elements'         => array(
			'featured_media' => true,
			'categories'     => true,
			'title'          => true,
			'summary'        => true,
			'author'         => true,
			'avatar'         => true,
			'date'           => true,
			'shares'         => true,
			'views'          => true,
			'comments_link'  => true,
		),
	) );
}

/**
 * Get archive settings
 *
 * @return mixed|void
 */
function bimber_get_archive_settings() {
	return apply_filters( 'bimber_archive_settings', array(
		'template'         				=> bimber_get_theme_option( 'archive', 'template' ),
		'title'            				=> bimber_get_archive_title(),
		'pagination'       				=> bimber_get_theme_option( 'archive', 'pagination' ),
		'elements'         				=> bimber_get_archive_elements_visibility_arr( bimber_get_theme_option( 'archive', 'hide_elements' ) ),

		'featured_entries_template'     => bimber_get_theme_option( 'archive', 'featured_entries_template' ),
		'featured_entries_gutter'       => 'standard' === bimber_get_theme_option( 'archive', 'featured_entries_gutter' ),
		'featured_entries_title'		=> bimber_get_archive_featured_entries_title(),
		'featured_entries_title_hide'	=> 'standard' === bimber_get_theme_option( 'archive', 'featured_entries_title_hide' ),
		// Query args.
		'featured_entries' => array(
			'type'       => bimber_get_theme_option( 'archive', 'featured_entries' ),
			'time_range' => bimber_get_theme_option( 'archive', 'featured_entries_time_range' ),
			'elements'   => bimber_get_archive_elements_visibility_arr( bimber_get_theme_option( 'archive', 'featured_entries_hide_elements' ) ),
		),
	) );
}

/**
 * Get ids of featured posts on an archive page.
 *
 * @return array
 */
function bimber_get_archive_featured_posts_ids() {
	$settings         = bimber_get_archive_settings();
	$featured_entries = $settings['featured_entries'];

	if ( 'none' === $featured_entries['type'] ) {
		return array();
	}

	$featured_entries['posts_per_page'] = bimber_get_post_per_page_from_template( $settings['featured_entries_template'] );

	return bimber_get_featured_posts_ids( $featured_entries );
}

/**
 * Exclude featured content from archive loops
 *
 * @param WP_Query $query Archive main query.
 */
function bimber_archive_exclude_featured( $query ) {
	if ( ! $query->is_main_query() || is_feed() ) {
		return;
	}

	if ( ! is_archive() ) {
		return;
	}

	$post_types = $query->get( 'post_type' );
	$is_post_archive = false;
	if ( 'post' !== $post_types ) {
		if ( is_array( $post_types ) ) {
			if ( ! in_array( 'post', $post_types, true ) ) {
				return;
			}
		}
	}

	$excluded_ids = bimber_get_archive_featured_posts_ids();

	if ( ! empty( $excluded_ids ) ) {
		$query->set( 'post__not_in', $excluded_ids );

		// When we exclude posts from main query, it can be left empty.
		// We don't want to show empty loop info because featured entries are there.
		add_filter( 'bimber_show_archive_no_results', '__return_false' );
	}
}

/**
 * Get archive elements visibility configuration.
 *
 * @param string $elements_to_hide_str Comma-separated list of elements to hide.
 *
 * @return mixed
 */
function bimber_get_archive_elements_visibility_arr( $elements_to_hide_str ) {
	$elements_to_hide_arr = explode( ',', $elements_to_hide_str );
	$defaults             = bimber_get_archive_default_settings();
	$all_elements         = $defaults['elements'];

	foreach ( $all_elements as $elem_id => $is_visible ) {
		if ( in_array( $elem_id, $elements_to_hide_arr, true ) ) {
			$all_elements[ $elem_id ] = false;
		}
	}

	return $all_elements;
}

/**
 * Get the id of the "Top" page.
 *
 * @return int
 */
function bimber_get_top_page_id() {
	$page_id = bimber_get_theme_option( 'posts', 'top_page' );

	if ( ! $page_id ) {
		$page_id = - 1;
	}

	return apply_filters( 'bimber_top_page_id', $page_id );
}

/**
 * Whether or not we are on the "Top" page
 *
 * @return bool
 */
function bimber_is_top_page() {
	return is_page( bimber_get_top_page_id() );
}

/**
 * Get the URL of the "Top" page.
 *
 * @return int
 */
function bimber_get_top_page_url() {
	return get_permalink( bimber_get_top_page_id() );
}

/**
 * Get the label of the "Top" page
 *
 * @return string
 */
function bimber_get_top_page_label() {
	return get_the_title( bimber_get_top_page_id() );
}


/**
 * Whether or not we are on the "Latest" page
 *
 * @return bool
 */
function bimber_is_latest_page() {
	return is_home();
}

/**
 * Get the URL of the "Latest" page
 *
 * @return mixed|void
 */
function bimber_get_latest_page_url() {
	$enabled = bimber_get_theme_option( 'posts', 'latest_page' );

	if ( $enabled ) {
		$show_on_front = get_option( 'show_on_front' );

		// Front page displays > Your latest posts.
		if ( 'posts' === $show_on_front ) {
			$url = get_home_url();
		// Front page displays > A static page > Posts page.
		} else {
			$url = get_permalink( get_option( 'page_for_posts' ) );
		}
	} else {
		$url = '';
	}

	return apply_filters( 'bimber_latest_page_url', $url );
}

/**
 * Get the label of the "Latest" page
 *
 * @return string|void
 */
function bimber_get_latest_page_label() {
	if ( 'page' === get_option( 'show_on_front' ) ) {
		$posts_page_id = absint( get_option( 'page_for_posts' ) );
	} else {
		$posts_page_id = 0;
	}

	if ( $posts_page_id > 0 ) {
		$label = get_the_title( $posts_page_id );
	} else {
		$label = __( 'Latest', 'bimber' );
	}

	return $label;
}

/**
 * Check whether the Hot collection should be used
 *
 * @return bool
 */
function bimber_is_hot_collection_enabled() {
	return (bool) bimber_get_theme_option( 'posts', 'hot_enable' );
}

/**
 * Get the id of the "Hot" page.
 *
 * @return int
 */
function bimber_get_hot_page_id() {
	$page_id = bimber_get_theme_option( 'posts', 'hot_page' );

	if ( ! $page_id ) {
		$page_id = - 1;
	}

	return apply_filters( 'bimber_hot_page_id', $page_id );
}

/**
 * Whether or not we are on the "Hot" page
 *
 * @return bool
 */
function bimber_is_hot_page() {
	return is_page( bimber_get_hot_page_id() );
}

/**
 * Get the URL of the "Hot" page.
 *
 * @return int
 */
function bimber_get_hot_page_url() {
	return get_permalink( bimber_get_hot_page_id() );
}

/**
 * Get the label of the "Hot" page
 *
 * @return string
 */
function bimber_get_hot_page_label() {
	return get_the_title( bimber_get_hot_page_id() );
}

/**
 * Check whether the Popular collection should be used
 *
 * @return bool
 */
function bimber_is_popular_collection_enabled() {
	return (bool) bimber_get_theme_option( 'posts', 'popular_enable' );
}

/**
 * Get the id of the "Popular" page.
 *
 * @return int
 */
function bimber_get_popular_page_id() {
	$page_id = bimber_get_theme_option( 'posts', 'popular_page' );

	if ( ! $page_id ) {
		$page_id = - 1;
	}

	return apply_filters( 'bimber_popular_page_id', $page_id );
}

/**
 * Whether or not we are on the "Popular" page
 *
 * @return bool
 */
function bimber_is_popular_page() {
	return is_page( bimber_get_popular_page_id() );
}

/**
 * Get the URL of the "Popular" page.
 *
 * @return int
 */
function bimber_get_popular_page_url() {
	return get_permalink( bimber_get_popular_page_id() );
}

/**
 * Get the label of the "Popular" page
 *
 * @return string
 */
function bimber_get_popular_page_label() {
	return get_the_title( bimber_get_popular_page_id() );
}

/**
 * Check whether the Trending collection should be used
 *
 * @return bool
 */
function bimber_is_trending_collection_enabled() {
	return (bool) bimber_get_theme_option( 'posts', 'trending_enable' );
}

/**
 * Get the id of the "Trending" page.
 *
 * @return int
 */
function bimber_get_trending_page_id() {
	$page_id = bimber_get_theme_option( 'posts', 'trending_page' );

	if ( ! $page_id ) {
		$page_id = - 1;
	}

	return apply_filters( 'bimber_trending_page_id', $page_id );
}

/**
 * Whether or not we are on the "Trending" page
 *
 * @return bool
 */
function bimber_is_trending_page() {
	return is_page( bimber_get_trending_page_id() );
}

/**
 * Get the URL of the "Trending" page.
 *
 * @return int
 */
function bimber_get_trending_page_url() {
	return get_permalink( bimber_get_trending_page_id() );
}

/**
 * Get the label of the "Trending" page
 *
 * @return string
 */
function bimber_get_trending_page_label() {
	return get_the_title( bimber_get_trending_page_id() );
}

/**
 * Return list of collections to show on Top page
 *
 * @return array
 */
function bimber_get_top_page_collections() {
	$collections = array();

	if ( bimber_is_trending_collection_enabled() ) {
		$collections['trending'] = array(
			'label' => _x( 'Today', 'Top page', 'bimber' ),
			'url'	=> add_query_arg( bimber_get_top_page_collections_url_var(), 'trending' ),
		);
	}

	if ( bimber_is_hot_collection_enabled() ) {
		$collections['hot'] = array(
			'label' => _x( 'This week', 'Top page', 'bimber' ),
			'url'	=> add_query_arg( bimber_get_top_page_collections_url_var(), 'hot' ),
		);
	}

	if ( bimber_is_popular_collection_enabled() ) {
		$collections['popular'] = array(
			'label' => _x( 'All time', 'Top page', 'bimber' ),
			'url'	=> add_query_arg( bimber_get_top_page_collections_url_var(), 'popular' ),
		);
	}

	return apply_filters( 'bimber_top_page_collections', $collections );
}

/**
 * Return selected collection on Top page
 *
 * @param string $default			Default value.
 *
 * @return string
 */
function bimber_get_top_page_current_collection($default = '' ) {
	$url_var = bimber_get_top_page_collections_url_var();

	$collection = filter_input( INPUT_GET, $url_var, FILTER_SANITIZE_STRING );

	if ( ! $collection ) {
		$collection = $default;
	}

	return $collection;
}

/**
 * Collection filter name to use in url
 *
 * @return string
 */
function bimber_get_top_page_collections_url_var() {
	return apply_filters( 'bimber_top_page_collections_url_var', 'collection' );
}

/**
 * Update populat, hot, trending lists
 */
function bimber_update_lists() {
	$update_lists = ( false === get_transient( 'bimber_lists_up_to_date' ) );   // Transiend expired.

	if ( $update_lists ) {
		do_action( 'bimber_update_hot_posts' );
		do_action( 'bimber_update_popular_posts' );
		do_action( 'bimber_update_trending_posts' );

		$expiration_time = apply_filters( 'bimber_update_lists_interval', 60 * 60 * 24 ); // One day.

		set_transient( 'bimber_lists_up_to_date', 'up_to_date', $expiration_time );
	}
}

/**
 * Get the title of the archive collection.
 *
 * @return string
 */
function bimber_get_archive_title() {

	if ( is_search() ) {
		return '';
	}

	$title = bimber_get_theme_option( 'archive', 'title' );

	// Fallback to defaults.
	if ( ! strlen( $title ) ) {
		if ( 'recent' === bimber_get_theme_option( 'archive', 'featured_entries' ) ) {
			$title = __( 'More stories', 'bimber' );
		} else {
			$title = __( 'Latest stories', 'bimber' );
		}
	}

	return $title;
}

/**
 * Get the title of the archive featured entries.
 *
 * @return string
 */
function bimber_get_archive_featured_entries_title() {
	$title = bimber_get_theme_option( 'archive', 'featured_entries_title' );

	// Fallback to defaults.
	if ( ! strlen( $title ) ) {
		$type = bimber_get_theme_option( 'archive', 'featured_entries' );

		switch ( $type ) {
			case 'most_viewed':
				$title = __( 'Most viewed', 'bimber' );
				break;

			case 'most_shared':
				$title = __( 'Most shared', 'bimber' );
				break;

			default:
				$title = __( 'Latest stories', 'bimber' );
		}
	}

	return $title;
}


/**
 * Remove prefixes from category and tag archive titles.
 *
 * @param $title string Archive title.
 *
 * @return string
 */
function bimber_get_the_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	}

	return $title;
}

/**
 * Enqueue dynamic CSS for a single taxonomy.
 */
function bimber_enqueue_archive_styles() {
	if ( ! is_archive() ) {
		return;
	}

	require_once( BIMBER_FRONT_DIR . 'lib/class-bimber-color.php' );

	$inline_css = '';

	$color = bimber_get_theme_option( 'archive', 'header_background_color' );

	if ( strlen( $color ) ) {
		$color = new Bimber_Color( $color );
		$inline_css .= 'background-color: #' . $color->get_hex() . ';';

		// Background gradient.
		$gradient = bimber_get_theme_option( 'archive', 'header_background2_color');
		if ( strlen( $gradient ) ) {
			$gradient = new Bimber_Color( $gradient );

			$direction = is_rtl() ? 'left' : 'right';
			$inline_css .= 'background-image: -webkit-linear-gradient(to ' . $direction . ', #' . $color->get_hex() . ', #' . $gradient->get_hex() . ');';
			$inline_css .= 'background-image:    -moz-linear-gradient(to ' . $direction . ', #' . $color->get_hex() . ', #' . $gradient->get_hex() . ');';
			$inline_css .= 'background-image:      -o-linear-gradient(to ' . $direction . ', #' . $color->get_hex() . ', #' . $gradient->get_hex() . ');';
			$inline_css .= 'background-image:         linear-gradient(to ' . $direction . ', #' . $color->get_hex() . ', #' . $gradient->get_hex() . ');';
		}
	}

	// Background image.
	$image = wp_get_attachment_image_src( bimber_get_theme_option( 'archive', 'header_background_image' ), 'full' );
	$image = is_array( $image ) ? $image[0] : '';

	if ( strlen( $image ) ) {
		$inline_css .= 'background-image: url(' . esc_url( $image ) . ');';
		$inline_css .= 'background-position: center center;';

		// Background size.
		$size = bimber_get_theme_option( 'archive', 'header_background_size' );
		if ( in_array( $size, array( 'auto', 'cover','contain' ), true ) ) {
			$inline_css .= 'background-size: ' . $size . ';';
		}

		// Background repeat.
		$repeat = bimber_get_theme_option( 'archive', 'header_background_repeat' );
		if ( in_array( $repeat, array( 'no-repeat', 'repeat', 'repeat-x', 'repeat-y' ), true ) ) {
			$inline_css .= 'background-repeat: ' . $repeat . ';';
		}
	}

	// Compose final CSS rules.
	if ( strlen( $inline_css ) ) {
		add_filter( 'bimber_page_header_class', 'bimber_add_dark_color_scheme_class' );

		$inline_css = '.page-header > .g1-row-background { ' . $inline_css . ' }';

		wp_add_inline_style( 'g1-main', $inline_css );
	}
}

function bimber_add_dark_color_scheme_class( $classes ) {
	$classes[] = 'g1-dark';

	return $classes;
}

/**
 * Return number of posts to show on archive page
 *
 * @return int                  Number
 */
function bimber_get_posts_per_page() {
	if ( is_home() ) {
		$posts_per_page = (int) get_option( 'posts_per_page' );
	} elseif ( is_search() ) {
		$posts_per_page = (int) bimber_get_theme_option( 'search', 'posts_per_page' );
	} else {
		$posts_per_page = (int) bimber_get_theme_option( 'archive', 'posts_per_page' );
	}

	return apply_filters( 'bimber_posts_per_page', $posts_per_page );
}

/**
 * Check whether an archive page if only for standard posts
 *
 * @return bool
 */
function bimber_is_posts_archive() {
	return is_archive() && 'post' === get_post_type();
}

/**
 * Get search settings
 *
 * @return mixed|void
 */
function bimber_get_search_settings() {
	return apply_filters( 'bimber_search_settings', array(
		'template'         				=> bimber_get_theme_option( 'search', 'template' ),
		'pagination'       				=> bimber_get_theme_option( 'search', 'pagination' ),
		'elements'         				=> bimber_get_archive_elements_visibility_arr( bimber_get_theme_option( 'search', 'hide_elements' ) ),
	) );
}

/**
 * Render archive filter select.
 */
function bimber_render_archive_filter() {
	$allowed_filters = bimber_get_theme_option( 'archive', 'filters' );
	if ( empty( $allowed_filters ) ) {
		return;
	}
	$allowed_filters = explode( ',', $allowed_filters );
	?>
	<div class="g1-archive-filter">
		<select id="g1-archive-filter-select">
			<?php

			$filters = bimber_get_archive_filters();
			$filter_value = bimber_get_archive_filter_value();
			foreach ( $filters as $slug => $filter ) {
				if ( ! in_array( $slug, $allowed_filters, true ) ) {
					continue;
				}
				$url = add_query_arg( array(
					bimber_get_archive_filter_query_var() => $slug,
				) );
			?>
				<option data-g1-archive-filter-url='<?php echo esc_url( $url );?>' value="<?php echo esc_attr( $slug ); ?>" <?php selected( $slug, $filter_value, true ); ?>><?php echo esc_html( $filter ); ?></option>
			<?php } ?>
		</select>
	</div>
	<?php
}

/**
 * Get archive filter query var.
 *
 * @return string
 */
function bimber_get_archive_filter_query_var() {
	return apply_filters( 'bimber_get_archive_filter_query_var', 'order' );
}

/**
 * Get the value of the archive filter.
 *
 * @return string
 */
function bimber_get_archive_filter_value() {
	if ( isset( $_GET[ bimber_get_archive_filter_query_var() ] ) ) {
		// Make sure only checked filters work.
		$allowed_filters = bimber_get_theme_option( 'archive', 'filters' );
		$allowed_filters = explode( ',', $allowed_filters );
		if ( ! in_array( $_GET[ bimber_get_archive_filter_query_var() ], $allowed_filters, true ) ) {
			return bimber_get_theme_option( 'archive', 'default_filter' );
		}

		return $_GET[ bimber_get_archive_filter_query_var() ];
	} else {
		return bimber_get_theme_option( 'archive', 'default_filter' );
	}
}

/**
 * Apply the archive filter to the query.
 *
 * @param WP_Query $query Archive main query.
 */
function bimber_apply_archive_filter( $query ) {
	if ( is_archive() && $query->is_main_query() ) {
		$filter = bimber_get_archive_filter_value();
		switch ( $filter ) {
			case 'newest':
				$query->set( 'orderby','date' );
				$query->set( 'order','DESC' );
				break;
			case 'oldest':
				$query->set( 'orderby','date' );
				$query->set( 'order','ASC' );
				break;
			case 'most_commented':
				$query->set( 'orderby','comment_count' );
				$query->set( 'order','DESC' );
				break;
			default:
				do_action( 'bimber_apply_archive_filter_' . $filter, $query );
				break;
		}
	}
}

/**
 * Render archive featured image.
 */
function bimber_render_archive_featured_image() {
	$term 				= get_queried_object();
	$term_setting 		= get_term_meta( $term->term_id, 'bimber_taxonomy_image', true );
	if ( empty( $term_setting ) ) {
		return;
	}
	$html = '<div class="g1-archive-featured-image">' . wp_get_attachment_image( $term_setting, 'thumbnail' ) . '</div>';
	echo apply_filters( 'bimber_render_archive_featured_image', $html );
}
