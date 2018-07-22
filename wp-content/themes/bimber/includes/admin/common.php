<?php
/**
 * Admin common functions
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
 * Enqueue admin CSS
 */
function bimber_admin_enqueue_styles( $hook ) {
	$version = bimber_get_theme_version();

	if ( in_array( $hook, array( 'term.php', 'post.php' ), true ) ) {
		wp_enqueue_style( 'wp-color-picker' );
	}

	// Register.
	wp_enqueue_style( 'bimber-admin', BIMBER_ADMIN_DIR_URI . 'css/admin.css', array(), $version, 'screen' );
}

/**
 * Enqueue admin JS
 */
function bimber_admin_enqueue_scripts( $hook ) {
	$child_theme_uri = trailingslashit( get_stylesheet_directory_uri() );

	if ( in_array( $hook, array( 'term.php', 'post.php' ), true ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'bimber-category', BIMBER_ADMIN_DIR_URI . 'js/term.js', array( 'wp-color-picker' ), false, true );
	}

	if ( BIMBER_THEME_DIR_URI !== $child_theme_uri ) {
		wp_enqueue_script( 'bimber-modifications-admin', $child_theme_uri . 'modifications-admin.js', array( 'jquery' ), false, true );
	}
}

/**
 * Add editor styles
 */
function bimber_add_editor_styles() {
	add_editor_style( 'css/editor-style.css' );
}

/**
 * Add the "Id" column to post list table in admin area
 *
 * @param array $columns        List of current columns.
 *
 * @return array                Modified column list.
 */
function bimber_post_list_add_id_column( $columns ) {
	$new_columns = array();

	foreach ( $columns as $k => $v ) {
		$new_columns[ $k ] = $v;
		if ( 'cb' === $k ) {
			$new_columns['id'] = 'ID';
		}
	}

	return $new_columns;
}

/**
 * Render the "Id" column on post list table in admin area
 *
 * @param string $name      Column name.
 */
function bimber_post_list_render_id_column( $name ) {
	global $post;

	if ( 'id' === $name ) {
		echo intval( $post->ID );
	}
}

/**
 * Register custom column headers
 *
 * @param array $columns    List of columns.
 *
 * @return mixed            Modified colum list.
 */
function bimber_post_list_custom_columns( $columns ) {
	$columns['featured_image'] = esc_html__( 'Featured Image', 'bimber' );

	return $columns;
}

/**
 * Render custom column value
 *
 * @param string $column         Column name.
 */
function bimber_post_list_custom_columns_data( $column ) {
	if ( 'featured_image' === $column ) {
		the_post_thumbnail( 'thumbnail' );
	}
}

/**
 * Check whether we are in autosave state
 *
 * @return bool
 */
function bimber_is_doing_autosave() {
	return defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ? true : false;
}

/**
 * Check whether inline edit was requested
 *
 * @return bool
 */
function bimber_is_inline_edit() {
	return isset( $_REQUEST['_inline_edit'] ) ? true : false;  // Input var okey.
}

/**
 * Check whether we are in preview state
 *
 * @return bool
 */
function bimber_is_doing_preview() {
	return ! empty( $_REQUEST['wp-preview'] ); // Input var okey.
}

/**
 * Register the About page
 */
function bimber_register_about_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( ! bimber_about_page_exists() ) {
		return;
	}

	// About.
	add_dashboard_page(
		__( 'Welcome to Bimber',  'bimber' ),
		__( 'Welcome to Bimber',  'bimber' ),
		'manage_options',
		'bimber-about',
		'render_bimber_about_page'
	);
}

/**
 * Render the About page
 */
function render_bimber_about_page() {
	$version = bimber_get_theme_version();

	get_template_part( 'includes/admin/about/version-' . $version );
}

/**
 * Checks whether current theme version page exists.
 *
 * @param string $version		Version to check. Optional.
 *
 * @return bool
 */
function bimber_about_page_exists( $version = '' ) {
	if ( empty( $version ) ) {
		$version = bimber_get_theme_version();
	}

	return file_exists( BIMBER_ADMIN_DIR . 'about/version-' . $version . '.php' );
}

/**
 * Allow editing the "js" file type in child theme editor
 *
 * @param array    $allowed_types		List of current types.
 * @param WP_Theme $theme				Theme object.
 *
 * @return array
 */
function bimber_allow_editing_child_theme_js_files( $allowed_types, $theme ) {
	// Not for main theme.
	if ( bimber_get_theme_name() !== strtolower( $theme->Name ) ) {
		$allowed_types[] = 'js';
	}

	return $allowed_types;
}

/**
 * Register custom walker.
 *
 * @param string $walker_class          Walek class name.
 * @param int    $menu_id               Menu id.
 *
 * @return string
 */
function bimber_wp_edit_nav_menu_walker( $walker_class, $menu_id ) {
	$walker_class = 'Bimber_Walker_Nav_Menu_Edit';

	return $walker_class;
}

/**
 * Save menu custom fields
 *
 * @param int   $menu_id                Menu id.
 * @param int   $menu_item_db_id        Menu database id.
 * @param array $args                   Menu args.
 */
function bimber_wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $args ) {
	if ( isset( $_REQUEST['menu-item-g1-mega-menu'] ) && is_array( $_REQUEST['menu-item-g1-mega-menu'] ) ) {
		if ( isset( $_REQUEST['menu-item-g1-mega-menu'][ $menu_item_db_id ] ) ) {
			$value = $_REQUEST['menu-item-g1-mega-menu'][ $menu_item_db_id ];

			update_post_meta( $menu_item_db_id, '_menu_item_g1_mega_menu', $value );
		// Unchecked checkbox doesn't send any value.
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_g1_mega_menu' );
		}
	// Unchecked checkbox doesn't send any value. If there are no other selections, won't be an array too.
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_item_g1_mega_menu' );
	}
}

/**
 * Add custom fields to $item nav object
 * in order to be used in custom Walker
 *
 * @param stdClass $menu_item           Menu item object.
 *
 * @return stdClass
 */
function bimber_wp_setup_nav_menu_item( $menu_item ) {
	$menu_item->g1_mega_menu = get_post_meta( $menu_item->ID, '_menu_item_g1_mega_menu', true );

	return $menu_item;
}

/**
 * Renders an image radio control
 *
 * @param array $args       Config.
 */
function bimber_ui_render_image_radio( $args ) {
	$defaults = array(
		'options'       => array(),
		'width'         => 75,
		'height'        => 45,
		'value'         => '',
		'html_name'     => 'image_radio',
		'html_id'       => '',
		'html_class'    => '',
		'img_base_url'  => '',
	);

	$args = wp_parse_args( $args, $defaults );

	$final_class = array_merge( array( 'g1ui-img-radios' ), explode( ' ', $args['html_class'] ) );
	?>
	<ul id="<?php echo esc_attr( $args['html_id'] ); ?>" class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $final_class ) ); ?>">
		<?php foreach ( $args['options'] as $option_value => $option_args ): ?>
			<?php
			$radio_id = $args['html_name'] . '_' . $option_value;
			?>
			<li class="g1ui-img-radio">
				<input type="radio" id="<?php echo esc_attr( $radio_id ); ?>" name="<?php echo esc_attr( $args['html_name'] ); ?>" value="<?php echo esc_attr( $option_value ); ?>"<?php checked( $option_value, $args['value'] ); ?> />
				<label for="<?php echo esc_attr( $radio_id ); ?>">
					<img class="g1-image-radio-choice" width="<?php echo absint( $args['width'] ); ?>" height="<?php echo absint( $args['height'] ); ?>" src="<?php echo esc_url( $option_args['path'] ); ?>" alt="<?php echo esc_attr( $option_args['label'] ); ?>" />
					<span><span><?php echo esc_html( $option_args['label'] ); ?></span></span>
				</label>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

/**
 * Add styles to stop columns from overflowing
 */
function bimber_post_list_styles() {
	$screen = get_current_screen();
	if ( ! $screen ) {
		return;
	}
	if ( 'edit-post' === $screen->id && 'post' === $screen->post_type ) :
	?>
		<style>
		#tags, .tags,
		#date, .date,
		#mashsb_shares, .mashsb_shares{
			width:10%;
		}
		#snax_format,.snax_format{
			width:8%;
		}
		#categories, .categories{
			width:10%;
		}

		.featured_image img{
			max-width:100%;
			height:auto;
		}

		#id, .id{
			width:5%;
		}
		#mashsb_shares, .mashsb_shares{
			width:5%;
		}
		#date,.date{
			width:8%;
		}

		</style>
	<?php
	endif;
}
