<?php
/**
 * WooCommerce plugin functions
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


add_action( 'after_setup_theme', 'bimber_woocommerce_support' );

// Disable all stylesheets.
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_filter( 'bimber_setup_sidebars', 	'bimber_woocommerce_setup_sidebars' );
add_filter( 'bimber_sidebar',			'bimber_woocommerce_sidebar' );
add_filter( 'bimber_show_mini_cart', 	'bimber_woocommerce_show_mini_cart' );

// Before and after the loop.
add_action( 'woocommerce_before_shop_loop', 'bimber_woocommerce_before_shop_loop', 999 );
add_action( 'woocommerce_after_shop_loop', 'bimber_woocommerce_after_shop_loop', 999 );

// Adjust span.count markup.
add_filter( 'woocommerce_layered_nav_count', 'bimber_woocommerce_layered_nav_count', 10, 2 );
add_filter( 'woocommerce_product_reviews_tab_title', 'bimber_woocommerce_product_reviews_tab_title' );

// Display 12 products per page.
add_filter( 'loop_shop_per_page', 'bimber_wc_loop_shop_per_page', 20 );

// Override theme default specification for product # per row.
add_filter('loop_shop_columns', 'bimber_wc_loop_shop_columns', 999);

// Adjust the HTML markup of the add_to_cart button.
add_filter( 'woocommerce_loop_add_to_cart_args', 'bimber_woocommerce_loop_add_to_cart_args', 10, 2 );
// Adjust the HTML markup of the order button.
add_filter( 'woocommerce_order_button_html', 'bimber_woocommerce_order_button_html' );

// Breadcrumbs.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_single_product', 'bimber_wc_breadcrumbs', 9 );

add_filter( 'wp', 'bimber_wc_comments_template', 99 );

// Reconfigure related products.
add_filter( 'woocommerce_output_related_products_args', 'bimber_woocommerce_output_related_products_args' );
// Reconfigure upsell products.
add_filter( 'woocommerce_upsell_display_args', 'bimber_woocommerce_upsell_display_args' );


add_filter( 'bimber_skip_quizzes_for_query', 'bimber_wp_skip_quizzes', 10, 2 );

add_action( 'wp_enqueue_scripts', 'bimber_woocommerce_maybe_enqueue_page_styles', 99 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

add_filter( 'manage_product_posts_columns', 'bimber_wc_product_list_custom_columns' );

add_filter( 'theme_page_templates', 'store_shop_page_templates', 9, 3 );
add_filter( 'theme_page_templates', 'shop_shop_page_templates', 11, 3 );

remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
add_action( 'woocommerce_cart_is_empty', 'bimber_wc_empty_cart_message', 10 );

/**
 * Declare WooCommerce support
 */
function bimber_woocommerce_support() {
	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

/**
 * Render the opening markup of the content theme area
 */
function bimber_woocommerce_content_wrapper_start() {
	?>
	<div class="g1-row g1-row-layout-page g1-row-padding-m">
	<div class="g1-row-inner">
	<div class="g1-column g1-column-2of3">

	<?php
}

/**
 * Render the closing markup of the content theme area.
 */
function bimber_woocommerce_content_wrapper_end() {
	?>
	</div><!-- .g1-column -->
	<?php
}

/**
 * Render the closing markup of the content theme area.
 */
function bimber_woocommerce_sidebar_wrapper_end() {
	?>
	</div>
	</div><!-- .g1-row -->
	<?php
}

/**
 * Reigster WooCommerce specific sidebars
 *
 * @param array $sidebars		Registered sidebars.
 *
 * @return array
 */
function bimber_woocommerce_setup_sidebars( $sidebars ) {
	$sidebars['bimber_woocommerce'] = array(
		'label'       => esc_html__( 'WooCommerce', 'bimber' ),
		'description' => esc_html__( 'Leave empty to use the Primary sidebar', 'bimber' ),
	);

	$sidebars['bimber_woocommerce_single_product'] = array(
		'label'       => esc_html__( 'WooCommerce Single Product', 'bimber' ),
		'description' => esc_html__( 'Leave empty to use the WooCommerce sidebar', 'bimber' ),
	);

	return $sidebars;
}

/**
 * Load WooCommerce specific sidebar
 *
 * @param string $sidebar		Sidebar set.
 *
 * @return string
 */
function bimber_woocommerce_sidebar( $sidebar ) {
	if ( is_woocommerce() || is_checkout() || is_cart() ) {
		$sidebar = 'bimber_woocommerce';
	}

	// If empty, use WooCommerce sidebar as a fallback.
	if ( is_product() && is_active_sidebar( 'bimber_woocommerce_single_product' ) ) {
		$sidebar = 'bimber_woocommerce_single_product';
	}

	return $sidebar;
}

/**
 * Check whether to show mini card icon in the navbar
 *
 * @param bool $show
 *
 * @return bool
 */
function bimber_woocommerce_show_mini_cart( $show ) {
	$visibility = bimber_get_theme_option( 'woocommerce', 'cart_visibility' );

	if ( 'none' === $visibility ) {
		return false;
	}

	if ( 'on_woocommerce' === $visibility ) {
		$show = is_woocommerce();
	}

	if ( is_cart() || is_checkout() ) {
		$show = false;
	}

	return $show;
}



function bimber_woocommerce_maybe_enqueue_page_styles() {
	if ( is_shop() ) {
		bimber_enqueue_page_styles( wc_get_page_id('shop') );
	}
}



/**
 * Show the product title in the product loop. By default this is an H3.
 */
function woocommerce_template_loop_product_title() {
	echo '<h3 class="g1-delta g1-delta-1st">' . get_the_title() . '</h3>';
}



function bimber_wc_loop_shop_per_page( $v ) {
	$v = 12;

	return $v;
}

function bimber_wc_loop_shop_columns( $columns ) {
	$columns = bimber_woocommerce_page_has_sidebar() ? 3 : 4;

	return $columns;
}


function bimber_woocommerce_layered_nav_count( $count, $term ) {
	$count = str_replace(
		array( '<span class="count">(', ')</span>'),
		array( '<span class="count">', '</span>'),
		$count
	);

	return $count;
}

function bimber_woocommerce_product_reviews_tab_title( $title ) {
	$title = str_replace(
		array( '(', ')' ),
		array( '<span class="count">', '</span>' ),
		$title
	);

	return $title;
}

/**
 * Replace CSS classes of the add_to_cart button.
 *
 * @param array $args Arguments.
 * @param $product
 *
 * @return array
 */
function bimber_woocommerce_loop_add_to_cart_args( $args, $product ) {
	$args['class'] = preg_replace( '/^button /', 'g1-button g1-button-s g1-button-subtle ' , $args['class'] );

	return $args;
}


function bimber_woocommerce_breadcrumb_defaults( $args ) {
	$new_args = array(
		'delimiter'     => '',
		'wrap_before'   => '<nav class="g1-breadcrumbs g1-meta" itemprop="breadcrumb"><ol>',
		'before'        => '<li class="g1-breadcrumbs-item">',
		'after'         => '</li>',
		'wrap_after'    => '</ol></nav>',
	);

	$args = array_merge( $args, $new_args );

	return $args;
}

function bimber_wc_breadcrumbs() {
	if ( bimber_show_breadcrumbs() ) {
		bimber_render_breadcrumbs();
	}
}

/**
 * Disable all hooks that overrides native WP comments
 */
function bimber_wc_comments_template() {
	if ( is_woocommerce() ) {
		// Disable Disqus.
		remove_filter( 'comments_template', 'dsq_comments_template' );
	}
}

/**
 * Prevent quizzes injection on WC pages
 *
 * @param bool     $skip			True if quizzes shouldn't be included for the $query.
 * @param WP_Query $query			Current query object.
 *
 * @return bool
 */
function bimber_wp_skip_quizzes( $skip, $query ) {
	if ( $query->is_main_query() && ( is_shop() || is_product_taxonomy() ) ) {
		$skip = true;
	}

	return $skip;
}

/**
 * Change the number of maximum related products to display.
 *
 * @param array $args Arguments.
 *
 * @return array
 */
function bimber_woocommerce_output_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns'] = 4;

	return $args;
}


/**
 * Change the number of maximum upsell products to display.
 *
 * @param array $args Arguments.
 *
 * @return array
 */
function bimber_woocommerce_upsell_display_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns'] = 4;

	return $args;
}


/**
 * Adjust the HTML markup of the order button.
 *
 * @param string $html HTML markup.
 *
 * @return string
 */
function bimber_woocommerce_order_button_html( $html ) {
	$html = str_replace( 'class="button', 'class="g1-button g1-button-xl g1-button-solid button', $html );

	return $html;
}


if (  ! function_exists( 'woocommerce_template_loop_category_title' ) ) {

	/**
	 * Show the subcategory title in the product loop.
	 */
	function woocommerce_template_loop_category_title( $category ) {
		?>
		<h3 class="g1-delta g1-delta-2nd">
			<?php
			echo $category->name;

			if ( $category->count > 0 )
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <div class="product-category-count"><mark class="count">' . sprintf( _n( '%d product', '%d products',  $category->count ), $category->count ) . '</mark></div>', $category );
			?>
		</h3>
		<?php
	}
}

if ( ! function_exists( 'woocommerce_product_archive_description' ) ) {

	/**
	 * Show a shop page description on product archives.
	 *
	 * @subpackage	Archives
	 */
	function woocommerce_product_archive_description() {
		if ( is_post_type_archive( 'product' ) && 0 === absint( get_query_var( 'paged' ) ) ) {
			$shop_page = get_post( wc_get_page_id( 'shop' ) );

			if ( $shop_page ) {
				$description = wc_format_content( $shop_page->post_content );
				if ( $description ) {
					echo '<div class="g1-row g1-row-layout-page">';
						echo '<div class="g1-row-inner">';
							echo '<div class="g1-column">';
								echo $description;
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		}
	}
}

function bimber_woocommerce_page_has_sidebar() {
	$result = true;

	$shop_page_id = wc_get_page_id( 'shop' );
	$template = get_post_meta( $shop_page_id, '_wp_page_template', true );

	if ( 'g1-template-page-full.php' === $template ) {
		$result = false;
	}

	return $result;
}


function bimber_woocommerce_before_shop_loop() {
	if ( is_shop() ) {
		if ( bimber_woocommerce_page_has_sidebar() ) {
			echo '<div class="woocommerce columns-3">';
		} else {
			echo '<div class="woocommerce columns-4">';
		}
	}
}


function bimber_woocommerce_after_shop_loop() {
	if ( is_shop() ) {
		echo '</div>';
	}
}

/**
 * Render WC categories
 *
 * @param array $args
 * @return void
 */
function bimber_render_product_categories( $args = array() ) {
	$out_escaped = '';

	$defaults = array(
		'before'        => '<p class="entry-categories %s"><span class="entry-categories-inner">',
		'after'         => '</span></p>',
		'class'         => '',
		'use_microdata' => false,
	);

	$args = wp_parse_args( $args, $defaults );

	// Sanitize HTML classes.
	$args['class'] = explode( ' ', $args['class'] );
	$args['class'] = implode( ' ', array_map( 'sanitize_html_class', $args['class'] ) );

	$args['before'] = sprintf( $args['before'], $args['class'] );

	$term_list = get_the_terms( get_the_ID(), 'product_cat' );

	if ( is_array( $term_list ) ) {
		$out_escaped .= $args['before'];

		foreach ( $term_list as $term ) {
			$term_link = is_wp_error( get_term_link( $term->slug, 'product_cat' ) ) ? '#' : get_term_link( $term->slug, 'product_cat' );
			if ( $args['use_microdata'] ) {
				$out_escaped .= sprintf(
					'<a href="%s" class="entry-category %s"><span itemprop="articleSection">%s</span></a>, ',
					esc_url( $term_link ),
					sanitize_html_class( 'entry-category-item-' . $term->term_taxonomy_id ),
					wp_kses_post( $term->name )
				);
			} else {
				$out_escaped .= sprintf(
					'<a href="%s" class="entry-category %s">%s</a>, ',
					esc_url( $term_link ),
					sanitize_html_class( 'entry-category-item-' . $term->term_taxonomy_id ),
					wp_kses_post( $term->name )
				);
			}
		}

		$out_escaped .= $args['after'];
	}

	echo $out_escaped;
}

/**
 * Add product post type to search results archive page
 *
 * @param WP_Query $query			WP Query object.
 */
function bimber_woocommerce_add_products_to_search_results( $query ) {
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
		$post_type[] = 'product';
		$query->set( 'post_type', $post_type );
	}
}

function bimber_woocommerce_set_up_shop_page() {
	$page = get_page_by_title( 'Shop' );

	if ( $page ) {
		update_option( 'woocommerce_shop_page_id', $page->ID );
	}
}

/**
 * Return injected product query.
 *
 * @return WP_Query
 */
function bimber_wc_get_injected_product_query() {
	$product_category = is_home() ? bimber_get_theme_option( 'home', 'product_category' ) : bimber_get_theme_option( 'archive', 'product_category' );

	if ( is_array( $product_category ) ) {
		$product_category = implode( ',', $product_category );
	}

	// Query: count products.
	// ---------------------

	$args = array(
		'post_type'         => 'product',
		'posts_per_page'    => -1,
	);

	if ( ! empty( $product_category ) ) {
		$args['product_cat'] = $product_category;
	}

	$count_query = new WP_Query( $args );

	$products_count = $count_query->found_posts;

	// Query: Get single product.
	// -------------------------

	$args['posts_per_page'] = 1;

	$ordering  = WC()->query->get_catalog_ordering_args();

	$args['orderby'] = $ordering['orderby'];
	$args['order']   = $ordering['order'];

	if ( isset( $ordering['meta_key'] ) ) {
		$args['meta_key'] = $ordering['meta_key'];
	}

	if ( $products_count > 1 ) {
		global $bimber_product_offset;

		$offset = absint( $bimber_product_offset );

		$args['offset'] = $offset % $products_count;
	}

	return new WP_Query( $args );
}

/**
 * Manage product list columns
 *
 * @param array $columns    List of columns.
 *
 * @return array
 */
function bimber_wc_product_list_custom_columns( $columns ) {
	if ( isset( $columns['featured_image'] ) ) {
		unset( $columns['featured_image'] );
	}

	return $columns;
}

function store_shop_page_templates( $page_templates, $class, $post ) {
	$shop_page_id = wc_get_page_id( 'shop' );

	if ( $post && absint( $shop_page_id ) === absint( $post->ID ) ) {
		global $bimber_shop_page_templates;

		$bimber_shop_page_templates = $page_templates;
	}

	return $page_templates;
}

function shop_shop_page_templates( $page_templates, $class, $post ) {
	$shop_page_id = wc_get_page_id( 'shop' );

	if ( $post && absint( $shop_page_id ) === absint( $post->ID ) ) {
		global $bimber_shop_page_templates;

		if ( empty( $page_templates ) && ! empty( $bimber_shop_page_templates ) ) {
			$page_templates = $bimber_shop_page_templates;
		}
	}

	return $page_templates;
}

function bimber_wc_empty_cart_message() { ?>
	<p class="g1-alpha g1-alpha-1st cart-empty">
		<?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?>
	</p>
	<?php
}

/**
 * Apply style to promote product link
 *
 * @param string     $button_string  Button string.
 * @param WC_Product $product	Product.
 * @return string
 */
function bimber_woocommerce_promote_product_link( $button_string, $product ) {
	$button_string = sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->get_id() ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'g1-button g1-button-solid g1-section-btn' ),
		esc_html( $product->add_to_cart_text() )
	);
	return $button_string;
}
