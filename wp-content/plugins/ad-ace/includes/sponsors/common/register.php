<?php
/**
 * Common Sponsor Functions
 *
 * @package AdAce.
 * @subpackage Sponsors.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_action( 'init', 'adace_register_sponsor_taxonomy' );
/**
 * Register Sponsor taxonomy.
 */
function adace_register_sponsor_taxonomy() {
	// Labels for taxonomy.
	$labels = array(
		'name'                       => _x( 'Sponsors', 'taxonomy general name', 'adace' ),
		'singular_name'              => _x( 'Sponsor', 'taxonomy singular name', 'adace' ),
		'search_items'               => __( 'Search Sponsors', 'adace' ),
		'popular_items'              => __( 'Popular Sponsors', 'adace' ),
		'all_items'                  => __( 'All Sponsors', 'adace' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Sponsor', 'adace' ),
		'update_item'                => __( 'Update Sponsor', 'adace' ),
		'add_new_item'               => __( 'Add New Sponsor', 'adace' ),
		'new_item_name'              => __( 'New Sponsor Name', 'adace' ),
		'separate_items_with_commas' => __( 'Separate sponsors with commas', 'adace' ),
		'add_or_remove_items'        => __( 'Add or remove sponsors', 'adace' ),
		'choose_from_most_used'      => __( 'Choose from the most used sponsors', 'adace' ),
		'not_found'                  => __( 'No sponsors found.', 'adace' ),
		'menu_name'                  => __( 'Sponsors', 'adace' ),
	);
	// Args for post type.
	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => false,
		'public'            => false,
		'meta_box_cb'		=> 'adace_sponsors_meta_box',
		'rewrite'           => array(
			'slug' => 'adace-sponsor',
		),
	);
	// Args for supported post type.
	$supported_post_types = array( 'post' );
	// Register taxonomy.
	register_taxonomy( 'adace-sponsor', apply_filters( 'adace_sponsor_post_types', $supported_post_types ), apply_filters( 'adace_sponsor_args', $args ) );
}

add_action( 'init', 'adace_register_sponsor_image_size' );
/**
 * Add Sponsor Sizes
 */
function adace_register_sponsor_image_size() {
	add_image_size( 'adace-sponsor', 9999, 48 );
	add_image_size( 'adace-sponsor-2x', 9999, 96 );
}

/**
 * Display post categories form fields.
 *
 * @since 2.6.0
 *
 * @todo Create taxonomy-agnostic wrapper for this.
 *
 * @param WP_Post $post Post object.
 * @param array   $box {
 *     Categories meta box arguments.
 *
 *     @type string   $id       Meta box 'id' attribute.
 *     @type string   $title    Meta box title.
 *     @type callable $callback Meta box display callback.
 *     @type array    $args {
 *         Extra meta box arguments.
 *
 *         @type string $taxonomy Taxonomy. Default 'category'.
 *     }
 * }
 */
function adace_sponsors_meta_box( $post, $box ) {
	$defaults = array( 'taxonomy' => 'category' );
	if ( ! isset( $box['args'] ) || ! is_array( $box['args'] ) ) {
		$args = array();
	} else {
		$args = $box['args'];
	}
	$r = wp_parse_args( $args, $defaults );
	$tax_name = esc_attr( $r['taxonomy'] );
	$taxonomy = get_taxonomy( $r['taxonomy'] );
	?>
	<div id="taxonomy-<?php echo $tax_name; ?>" class="categorydiv">
		<div id="<?php echo $tax_name; ?>-all" class="tabs-panel">
			<?php
			$name = ( $tax_name == 'category' ) ? 'post_category' : 'tax_input[' . $tax_name . ']';
			echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
			?>
			<ul id="<?php echo $tax_name; ?>checklist" data-wp-lists="list:<?php echo $tax_name; ?>" class="categorychecklist form-no-clear">
				<?php
					adace_define_sponsors_walker();
					wp_terms_checklist( $post->ID, array( 'taxonomy' => $tax_name, 'walker' => new Walker_Sponsor_Checklist() ) ); 
				?>
			</ul>
		</div>
	</div>
	<?php
}

function adace_define_sponsors_walker() {
	/**
	 * Walker class to output an unordered list of sponsor checkbox elements.
	 *
	 * @since 2.5.1
	 *
	 * @see Walker
	 * @see wp_category_checklist()
	 * @see wp_terms_checklist()
	 */
	class Walker_Sponsor_Checklist extends Walker_Category_Checklist {
		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 2.5.1
		 *
		 * @param string $output   Used to append additional content (passed by reference).
		 * @param object $category The current term object.
		 * @param int    $depth    Depth of the term in reference to parents. Default 0.
		 * @param array  $args     An array of arguments. @see wp_terms_checklist()
		 * @param int    $id       ID of the current term.
		 */
		public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
			if ( empty( $args['taxonomy'] ) ) {
				$taxonomy = 'category';
			} else {
				$taxonomy = $args['taxonomy'];
			}

			if ( $taxonomy == 'category' ) {
				$name = 'post_category';
			} else {
				$name = 'tax_input[' . $taxonomy . ']';
			}

			$args['popular_cats'] = empty( $args['popular_cats'] ) ? array() : $args['popular_cats'];
			$class = in_array( $category->term_id, $args['popular_cats'] ) ? ' class="popular-category"' : '';

			$args['selected_cats'] = empty( $args['selected_cats'] ) ? array() : $args['selected_cats'];

			if ( ! empty( $args['list_only'] ) ) {
				$aria_checked = 'false';
				$inner_class = 'category';

				if ( in_array( $category->term_id, $args['selected_cats'] ) ) {
					$inner_class .= ' selected';
					$aria_checked = 'true';
				}

				/** This filter is documented in wp-includes/category-template.php */
				$output .= "\n" . '<li' . $class . '>' .
					'<div class="' . $inner_class . '" data-term-id=' . $category->term_id .
					' tabindex="0" role="checkbox" aria-checked="' . $aria_checked . '">' .
					esc_html( apply_filters( 'the_category', $category->name, '', '' ) ) . '</div>';
			} else {
				/** This filter is documented in wp-includes/category-template.php */
				$output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" .
					'<label class="selectit"><input value="' . $category->slug . '" type="checkbox" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' .
					checked( in_array( $category->term_id, $args['selected_cats'] ), true, false ) .
					disabled( empty( $args['disabled'] ), false, false ) . ' /> ' .
					esc_html( apply_filters( 'the_category', $category->name, '', '' ) ) . '</label>';
			}
		}
	}
}

