<?php
/**
 * Random post Metabox for menu
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
 * Register metabox
 */
function bimber_add_random_post_metabox() {
	add_meta_box(
		'bimber_random_post',
		__( 'Random post', 'bimber' ),
		'bimber_random_post_metabox',
		'nav-menus',
		'side',
		'default'
	);

	do_action( 'bimber_register_random_post_metabox' );
}
add_action( 'load-nav-menus.php',   'bimber_add_random_post_metabox' );


/**
 * Render metabox
 */
function bimber_random_post_metabox() {
	$url = trailingslashit( get_home_url() ) . '?' .  apply_filters( 'bimber_random_post_url_var', 'bimber_random_post' ) . "=true";
	?>
	<div id="posttype-randompost" class="posttypediv">
		<h4><?php esc_html_e( 'Random post', 'bimber' ); ?></h4>

		<div class="tabs-panel tabs-panel-active">
			<ul class="categorychecklist form-no-clear">
				<li>
					<label class="menu-item-title">
						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> <?php esc_html_e( 'Random post', 'bimber' ); ?>
					</label>
					<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
					<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="<?php esc_html_e( 'Random post', 'bimber' ); ?>">
					<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php echo esc_url( $url ); ?>">
					<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="bimber-random-post-nav">
				</li>
			</ul>
		</div>

		<!-- Actions -->
		<p class="button-controls wp-clearfix">
			<span class="add-to-menu">
				<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to Menu' ); ?>" name="add-post-type-menu-item" id="<?php echo esc_attr( 'submit-posttype-randompost' ); ?>" />
				<span class="spinner"></span>
			</span>
		</p>
	</div>
<?php
}
