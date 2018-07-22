<?php
/**
 * Collection shortcode
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
 * Collection shortcode
 *
 * @param array $atts			Shortcode attributes.
 *
 * @return string				Shortcode output.
 */
function bimber_collection_shortcode( $atts ) {
	$default_atts = array(
		'title' 				=> '',
		'title_size' 			=> 'h4',
		'title_align' 			=> '',
		'template' 				=> 'grid-standard',
		'columns' 				=> 3,
		'type' 					=> 'recent',
		'time_range'			=> 'all',
		'max' 					=> 6,
		'offset' 				=> '',
		'category' 				=> '',
		'post_tag' 				=> '',
		'post_format'			=> '',
		'snax_format'			=> '',

		// Elements visibility.
		'show_featured_media'	=> 'standard',
		'show_categories' 		=> 'standard',
		'show_summary' 			=> 'standard',
		'show_author' 			=> 'standard',
		'show_avatar' 			=> 'standard',
		'show_date' 			=> 'standard',
		'show_shares' 			=> 'standard',
		'show_views' 			=> 'standard',
		'show_comments_link'	=> 'standard',
	);

	$atts = shortcode_atts( $default_atts, $atts, 'bimber_collection' );

	// Query args.
	// ----------

	// Common.
	$query_args = array(
		'post_type'           	=> 'post',
		'post_status'         	=> 'publish',
		'ignore_sticky_posts' 	=> true,
		'posts_per_page'		=> $atts['max'],
		'snax_format'			=> $atts['snax_format'],
	);

	// Time range.
	$query_args = bimber_time_range_to_date_query( $atts['time_range'], $query_args );

	// Type.
	switch ( $atts['type'] ) {
		case 'recent':
			$query_args['orderby'] = 'date';
			break;

		case 'most_shared':
			$query_args = bimber_get_most_shared_query_args( $query_args );
			break;

		case 'most_viewed':
			$query_args = bimber_get_most_viewed_query_args( $query_args, 'collection_shortcode' );
			break;
	}

	// Offset.
	if ( ! empty( $atts['offset'] ) ) {
		$query_args['offset'] = $atts['offset'];
	}

	// Category.
	if ( ! empty( $atts['category'] ) ) {
		$query_args['category_name'] = $atts['category'];
	}

	// Tag.
	if ( ! empty( $atts['post_tag'] ) ) {
		$query_args['tag'] = $atts['post_tag'];
	}

	// Post format.
	if ( ! empty( $atts['post_format'] ) ) {
		$post_format_terms = explode( ',', $atts['post_format'] );

		foreach ( $post_format_terms as $index => $term ) {
			$post_format_terms[ $index ] = 'post-format-' . $term;
		}

		$query_args['tax_query'] = array(
			array(
				'taxonomy' 	=> 'post_format',
				'field' 	=> 'slug',
				'terms' 	=> $post_format_terms,
			)
		);
	}

	// ------------------
	// End of Query args.


	// Loop posts.
	// -----------

	global $post;
	$current_post = $post;

	$query_args = apply_filters( 'bimber_collection_shortcode_query_args', $query_args, $atts );

	$query = new WP_Query( $query_args );

	$item_settings = array(
		'elements' => array(
			'featured_media' => 'standard' === $atts['show_featured_media'],
			'categories'     => 'standard' === $atts['show_categories'],
			'summary'        => 'standard' === $atts['show_summary'],
			'author'         => 'standard' === $atts['show_author'],
			'avatar'         => 'standard' === $atts['show_avatar'],
			'date'           => 'standard' === $atts['show_date'],
			'shares'         => 'standard' === $atts['show_shares'],
			'views'          => 'standard' === $atts['show_views'],
			'comments_link'  => 'standard' === $atts['show_comments_link'],
		),
	);

	bimber_set_template_part_data( $item_settings );

	ob_start();
	?>
	<div class="g1-collection g1-collection-columns-<?php echo sanitize_html_class( $atts['columns'] ); ?>">

		<?php if ( ! empty( $atts['title'] ) ) : ?>
			<?php echo do_shortcode( '[bimber_title size="' . $atts['title_size'] . '" align="' . $atts['title_align'] . '" class="g1-collection-title"]'. $atts['title'] .'[/bimber_title]' ); ?>
		<?php endif; ?>

		<?php if ( $query->have_posts() ) : ?>
			<div class="g1-collection-viewport">
				<ul class="g1-collection-items">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<li class="g1-collection-item">
							<?php get_template_part( 'template-parts/content-' . $atts['template'], get_post_format() ); ?>
						</li>

					<?php endwhile; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div><!-- .g1-collection -->

	<?php
	$out = ob_get_clean();

	bimber_reset_template_part_data();

	$post = $current_post;
	wp_reset_postdata();

	// ---------
	// Loop end.

	return $out;
}
