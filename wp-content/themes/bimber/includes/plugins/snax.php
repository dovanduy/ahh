<?php
/**
 * Snax plugin functions
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
 * Adjust theme for Snax
 */
function bimber_snax_setup() {
	if ( get_option( 'snax_setup_done', false ) ) {
		return;
	}

	// Change Frontend Submission page template.
	$front_page_id 	= snax_get_frontend_submission_page_id();

	if ( $front_page_id ) {
		update_post_meta( $front_page_id, '_wp_page_template', 'g1-template-page-full.php' );
	}

	update_option( 'snax_setup_done', true );
}

/**
 * Adjust the image size used inside snax collection
 *
 * @param string $image_size Image size.
 *
 * @return string
 */
function bimber_snax_get_collection_item_image_size($image_size ) {
	if ( has_image_size( 'bimber-grid-fancy' ) ) {
		$image_size = 'bimber-grid-fancy';
	}

	return $image_size;
}

/**
 * Disable sticky sharebar on the Frontend Submission page
 *
 * @param bool $bool Whether or not to use the sticky header.
 * @return bool
 */
function bimber_snax_disable_sticky_header($bool ) {
	$frontend_submission_page = snax_get_frontend_submission_page_id();
	if ( is_page( $frontend_submission_page ) && ! empty( $frontend_submission_page ) ) {
		$bool = false;
	}

	return $bool;
}

/**
 * Hide the prefooter on the frontend submission page
 *
 * @param bool $show Whether or not to show the prefooter.
 *
 * @return bool
 */
function bimber_snax_hide_prefooter( $show ) {
	$frontend_submission_page = snax_get_frontend_submission_page_id();
	if ( is_page( $frontend_submission_page ) && ! empty( $frontend_submission_page ) ) {
		$show = false;
	}

	return $show;
}

/**
 * Hide the primary nav menu on the frontend submission page
 *
 * @param bool   $has_nav_menu Whether or not a menu is assigned to nav location.
 * @param string $location Nav location.
 *
 * @return bool
 */
function bimber_snax_hide_nav_menus( $has_nav_menu, $location ) {
	$locations = array(
		'bimber_primary_nav',
		'bimber_secondary_nav',
	);
	$frontend_submission_page = snax_get_frontend_submission_page_id();
	if ( in_array( $location, $locations ) && is_page( snax_get_frontend_submission_page_id() ) && ! empty( $frontend_submission_page ) ) {
		$has_nav_menu = false;
	}

	return $has_nav_menu;
}



/**
 * Hide ad before the content theme area, after snax item submission
 *
 * @param bool   $bool Whether or not an ad is assigned to ad location.
 * @param string $location Ad location.
 *
 * @return bool
 */
function bimber_snax_hide_ad_before_content_theme_area($bool, $location ) {
	if ( 'bimber_before_content_theme_area' === $location && snax_item_submitted() ) {
		$bool = false;
	}

	return $bool;
}

function snax_embed_change_content_width() {
	global $content_width;
	global $snax_old_content_width;

	// Store original value.
	$snax_old_content_width = $content_width;

	// Overide.
	$content_width = 758;
}

function snax_embed_revert_content_width() {
	global $content_width;
	global $snax_old_content_width;

	// Restore.
	$content_width = $snax_old_content_width;
}

/**
 * Hide an element on the frontend submission page
 *
 * @param bool $show Whether or not to show an element.
 *
 * @return bool
 */
function bimber_snax_hide_on_frontend_submission_page( $show ) {
	$frontend_submission_page = snax_get_frontend_submission_page_id();
	if ( is_page( $frontend_submission_page ) && ! empty( $frontend_submission_page ) ) {
		$show = false;
	}

	return $show;
}

function bimber_snax_capture_item_position_args( $args ) {
	$args['prefix'] = '#';
	$args['suffix'] = ' ';

	return $args;
}

function bimber_snax_widget_cta_options( $args ) {
	$args['classname'] .= ' g1-box';

	return $args;
}

function bimber_snax_before_widget_cta_title() {
	echo '<i class="g1-box-icon"></i>';
}

/**
 * Render item notes
 */
function bimber_snax_item_render_notes() {
	snax_item_render_notes();
}

/**
 * Render post notes
 */
function bimber_snax_post_render_notes() {
	snax_post_render_notes();
}

function bimber_snax_setup_header_elements() {
	if ( 'simple' === bimber_get_theme_option( 'snax', 'header_type' ) ) {
		add_filter( 'bimber_show_quick_nav_menu',           'bimber_snax_hide_on_frontend_submission_page' );
		add_filter( 'bimber_show_navbar_searchform',        'bimber_snax_hide_on_frontend_submission_page' );
		add_filter( 'bimber_show_navbar_socials',           'bimber_snax_hide_on_frontend_submission_page' );
		add_filter( 'bimber_show_preheader_socials',        'bimber_snax_hide_on_frontend_submission_page' );

		add_filter( 'has_nav_menu',                         'bimber_snax_hide_nav_menus', 10, 2 );
	}
}

function bimber_snax_show_create_button( $show ) {
	$visibility = bimber_get_theme_option( 'snax', 'header_create_button_visibility' );

	if ( 'none' === $visibility || ( 'logged_in' === $visibility && ! is_user_logged_in() ) ) {
		$show = false;
	}

	return $show;
}

/**
 * Add Quizz post type to regular "posts"
 *
 * @param WP_Query $query			WP Query object.
 */
function bimber_snax_add_cpt_to_queries( $query ) {
	if ( ! function_exists( 'snax_get_quiz_post_type' ) || ! function_exists( 'snax_get_poll_post_type' ) ) {
		return;
	}

	if ( is_admin() ) {
		return;
	}

	if ( is_attachment() ) {
		return;
	}

	if ( $query->is_page() ) {
		return;
	}

	if ( apply_filters( 'bimber_skip_quizzes_for_query', false, $query ) ) {
		return;
	}

	if ( apply_filters( 'bimber_skip_polls_for_query', false, $query ) ) {
		return;
	}

	$post_type = $query->get( 'post_type' );

	// Normalize.
	$post_type = ( '' === $post_type ) ? array( 'post' ) : (array) $post_type;

	// Skip if query is not for "post" type.
	if ( ! in_array( 'post', $post_type, true ) ) {
		return;
	}

	$post_type[] = snax_get_quiz_post_type();
	$post_type[] = snax_get_poll_post_type();

	$query->set( 'post_type', $post_type );
}

/**
 * Load Snax voting box in right order on a single post page
 */
function bimber_snax_apply_voting_box_order() {
	add_action( 'bimber_after_single_content', 'bimber_snax_render_post_voting_box', bimber_get_theme_option( 'post', 'voting_box_order' ) );
}

function bimber_snax_render_post_voting_box() {
	?>
	<div class="snax snax-post-container">

		<?php snax_render_post_voting_box(); ?>

	</div>
	<?php
}

function bimber_snax_add_cpt_to_next_prev_nav( $where_clause, $in_same_term, $excluded_terms, $taxonomy, $post ) {
	if ( function_exists( 'snax_get_quiz_post_type' ) && function_exists( 'snax_get_poll_post_type' ) ) {
		$quiz_type  = snax_get_quiz_post_type();
		$poll_type  = snax_get_poll_post_type();

		$where_clause = str_replace( "p.post_type = 'post'", "p.post_type IN ('post', '$quiz_type', '$poll_type')", $where_clause );
		$where_clause = str_replace( "p.post_type = '$quiz_type'", "p.post_type IN ('post', '$quiz_type', '$poll_type')", $where_clause );
		$where_clause = str_replace( "p.post_type = '$poll_type'", "p.post_type IN ('post', '$quiz_type', '$poll_type')", $where_clause );
	}

	return $where_clause;
}

function snax_register_vc_format_filter( $params ) {
	$active_formats = snax_get_active_formats();
	$vc_filter_value = array(
		'' => '', // Default value.
	);

	foreach ( $active_formats as $format_id => $format_config ) {
		$format_label = $format_config['labels']['name'];

		$vc_filter_value[ $format_label ] = $format_id;
	}

	$snax_format_config = array(
		'group' 		=> __( 'Data', 'bimber' ),
		'type' 			=> 'multi_checkbox',
		'heading' 		=> __( 'Filter by Snax format', 'bimber' ),
		'param_name' 	=> 'snax_format',
		'value' 		=> $vc_filter_value,
	);

	// Add filter after standard WP formats filter.
	$after_index = false;

	foreach ($params as $index => $param_arr ) {
		if ( 'post_format' === $param_arr['param_name'] ) {
			$after_index = $index;
			break;
		}
	}

	if ( false !== $after_index ) {
		array_splice( $params, $after_index + 1, 0, array( $snax_format_config ) );
	}

	return $params;
}

function snax_apply_snax_format_query_filter( $query_args ) {
	if ( ! empty( $query_args['snax_format'] ) ) {
		$format = $query_args['snax_format'];

		// Remove from WP Query args.
		unset( $query_args['snax_format'] );

		if ( ! is_array( $format ) ) {
			$format = explode( ',', $format );
		}

		$query_args['tax_query'] = array(
			array(
				'taxonomy' 	=> snax_get_snax_format_taxonomy_slug(),
				'field' 	=> 'slug',
				'terms'		=> $format,
			)
		);
	}

	return $query_args;
}

/**
 * Add snax_quiz to single options meta box
 *
 * @param arr $types  Allowed types.
 * @return arr
 */
function bimber_snax_add_quiz_to_single_options_meta_box( $types ) {
	$types[] = 'snax_quiz';
	return $types;
}

/**
 * Disallow setting templates for single quizzes
 *
 * @param bool    $allow  Whether to allow setting templates.
 * @param WP_Post $post  Post object.
 * @return bool
 */
function bimber_snax_disallow_single_templates_for_quiz( $allow, $post ) {
	if ( snax_is_quiz( $post ) ) {
		$allow = false;
	}
	return $allow;
}

/**
 * Add snax post types to most popular posts query
 *
 * @param str $post_types  Post types list.
 * @return str
 */
function bimber_snax_add_snax_post_types_to_popular_posts_query( $post_types ) {
	$post_types = $post_types . ', snax_quiz';
	return $post_types;
}

/**
 * Force display featured media on 'overlay' and 'background'
 *
 * @param  string $template Template.
 *
 * @return string
 */
function snax_ignore_disable_default_featured_media( $template ) {
	if ( strpos( $template, 'overlay' ) || strpos( $template, 'background' ) ) {
		add_filter( 'snax_disable_default_featured_media','__return_false' );
	}

	return $template;
}

/**
 * Change media upload form agruments
 *
 * @param arr $args  Media upload settings.
 * @return arr
 */
function bimber_snax_media_upload_form_args( $args ) {
	$args['classes']['select_files_button'] 	= array( 'snax-plupload-browse-button','g1-button','g1-button-m','g1-button-solid' );
	$args['classes']['get_by_url_button'] 		= array( 'snax-load-image-from-url-button','g1-button','g1-button-m','g1-button-solid' );
	$args['classes']['get_by_url_back_button'] 	= array( 'snax-load-image-from-url-button','g1-button','g1-button-m','g1-button-solid' );
	return $args;
}

/**
 * Check whether to show bar for current snax item
 *
 * @return bool
 */
function bimber_snax_show_item_bar() {
	if ( 'bunchy' !== bimber_get_current_stack() ) {
		return false;
	}

	$show = is_singular( 'snax_item' );

	return apply_filters( 'bimber_snax_show_item_bar', $show );
}

/**
 * Checkc whether to show snax bar for current post
 *
 * @return bool
 */
function bimber_snax_show_post_bar() {
	if ( 'bunchy' !== bimber_get_current_stack() ) {
		return false;
	}
	$show = snax_is_post_open_list( );

	return apply_filters( 'bimber_snax_show_post_bar', $show );
}

/**
 * Add Snax gallery to gallery count.
 *
 * @param  int     $count  Items count.
 * @param  WP_Post $post   Post.
 * @return int
 */
function snax_get_post_gallery_media_count( $count, $post ) {
	if ( snax_is_format( 'gallery', $post ) ) {
		$count += snax_get_post_submission_count( $post );
	}
	return $count;
}

/**
 * Force the gallery format icon for Snax galleries
 *
 * @param 	str     $format  Post format.
 * @param 	WP_Post $post   Post.
 * @return 	str
 */
function snax_force_gallery_format_icon( $format, $post ) {
	if ( snax_is_format( 'gallery', $post ) ) {
		$format = 'gallery';
	}
	return $format;
}

/**
 * Force image into microdata when it's disabled by Snax
 *
 * @param WP_Query $query  Query object.
 */
function snax_force_disabled_featured_image_in_meta( $query ) {
	$force = has_filter( 'get_post_metadata', 'snax_skip_post_thumbnail' );
	if ( $force ) {
		add_filter( 'bimber_force_missing_image', '__return_true' );
	}
}

/**
 * Add product snax_item type to search results archive page
 *
 * @param WP_Query $query			WP Query object.
 */
function bimber_woocommerce_add_snax_items_to_search_results( $query ) {
	$is_bbpress = false;
	if ( function_exists( 'is_bbpress' ) && isset($query->query['post_type']) ) {
		$is_bbpress = 'reply' === $query->query['post_type'];
		if ( is_array( $query->query['post_type'] ) ) {
			$is_bbpress = in_array( 'reply', $query->query['post_type']);
		}
	}
	if ( $query->is_search() && ! $is_bbpress ) {
		$post_type = $query->get( 'post_type' );
		$post_type = ( '' === $post_type ) ? array( 'post' ) : (array) $post_type;
		$post_type[] = 'snax_item';
		$query->set( 'post_type', $post_type );
	}
}

/** Content filter to cut embedly script from the list. We'll later add it via JS.
 *
 * @param str $content  The content.
 * @return str
 */
function bimber_snax_cut_embedly_scripts( $content ) {
	$embedly_script = apply_filters( 'snax_embedly_script_code', '<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>' );
	if ( snax_is_format( 'list' ) && substr_count( $content, $embedly_script ) > 0 ) {
		$content = str_replace( $embedly_script, '', $content );
		$content .= '<div class="bimber-snax-embedly-script-placeholder"></div>';
	}
	return $content;
}

/**
 * Set up Snax on auto loaded posts
 */
function bimber_snax_setup_auto_load() {
	if ( bimber_is_auto_load() ) {
		remove_filter( 'the_content', 'snax_render_quiz' );
		add_filter( 'the_content',     'snax_auto_load_render_quiz' );
	}
}

/**
 * Render auto load version of quiz
 *
 * @param str $content  The content.
 * @return str
 */
function snax_auto_load_render_quiz( $content ) {
	if ( is_singular( snax_get_quiz_post_type() ) ) {
		ob_start();
		echo '<div class="snax">';
		?>
		<div class="quiz">
			<p class="snax-quiz-actions">
				<a class="g1-button g1-button-l g1-button-wide g1-button-solid" href="<?php echo esc_attr( get_permalink( ) ); ?>">
					<?php esc_html_e( 'Let\'s play', 'snax' ); ?>
				</a>
			</p>
		</div>
		<?php
		echo '</div>';
		$content .= ob_get_clean();
	}
	return $content;
}

/**
 * Disable embed on collection instread of thumbnail for custom post types(quizz etc.)
 *
 * @param bool $enable  Wheter to allow embed in collection.
 * @return bool
 */
function bimber_snax_block_embed_in_collection_for_cpt( $enable ) {
	if ( 'snax_quiz' === get_post_type() || 'snax_poll' === get_post_type() ) {
		return false;
	}
	return $enable;
}

/**
 * Add most voted archive filter
 *
 * @param  array $archive_filters  Archive filters.
 * @return array
 */
function bimber_snax_add_most_voted_filter( $archive_filters ) {
	$archive_filters['most_upvotes'] = __( 'Most Upvoted', 'bimber' );

	return $archive_filters;
}

/**
 * Apply the archive filter to the query.
 *
 * @param WP_Query $query Archive main query.
 */
function bimber_snax_apply_archive_filter_most_upvotes( $query ) {
	$query->set( 'orderby','meta_value_num' );
	$query->set( 'order','DESC' );
	$query->set( 'meta_key','_snax_vote_score' );
	$query->set( 'meta_query', array(
		array(
			'key'     => '_snax_vote_score',
			'compare' => '>',
			'value'	  => '0',
		),
	));
}

/**
 * Add meme links to stream memes.
 */
function bimber_snax_add_meme_links_to_stream() {
	snax_render_meme_recaption();
	snax_render_meme_see_similar();
}

/**
 * Disable item share when microshare is disabled.
 *
 * @param  bool $bool	Whether to show item share.
 * @return bool
 */
function bimber_snax_disable_itemshare_with_microshare( $bool ) {
	if ( bimber_get_theme_option( 'post', 'microshare', 'standard' ) !== 'standard' ) {
		$bool = false;
	}
	return $bool;
}

/**
 * Add GDPR consent to WPSL form.
 */
function bimber_snax_wpsl_gdpr() {
	$g1_theme_options   = get_option( bimber_get_theme_options_id() );

	if( stripos( $_SERVER['SCRIPT_NAME'], 'wp-login' ) > -1 ) {
		return;
	}
	if ( ! isset( $g1_theme_options['gdpr_enabled'] ) || 'on' !== $g1_theme_options['gdpr_enabled'] || is_admin() ) {
		return;
	}
	$consent = isset( $g1_theme_options['gdpr_wpsl_consent'] ) ? $g1_theme_options['gdpr_wpsl_consent'] : '';
	$page = get_option( 'wpgdprc_settings_privacy_policy_page' ) ;
	if ( $page ) {
		$page_link = '<a href="' . get_page_link( $page ) . '">' . get_the_title( $page ) . '</a>';
		$consent = str_replace( '%privacy_policy%', $page_link, $consent );
	}
	?>
	<label class="snax-wpsl-gdpr-consent"><input type="checkbox">
	<?php echo wp_kses_post( $consent );?>
	</label>
<?php
}
