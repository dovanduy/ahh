<?php
/**
 * WPML plugin functions
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
 * Return page id in current language
 *
 * @param int $page_id          Page id.
 *
 * @return int
 */
function bimber_wpml_translate_page_id( $page_id ) {
	$page_id = wpml_object_id_filter( $page_id, 'page', true );

	return $page_id;
}

/**
 * Render language switcher in canvas.
 */
function bimber_wpml_add_canvas_switcher() {
	global $sitepress;

	$ret = array();
	$css_prefix = 'wpml-ls-';

	$get_ls_args = array(
		'skip_missing' => true,
	);

	$languages = $sitepress->get_ls_languages( $get_ls_args );
	$languages = is_array( $languages ) ? $languages : array();

	$languages = $sitepress->order_languages( $languages );

	if ( $languages ) {
		foreach ( $languages as $code => $data ) {
			$css_classes = array(
				$css_prefix . 'slot-shortcode_actions',
				$css_prefix . 'item',
				$css_prefix . 'item-' . $code,
			);

			$is_current_language = $code === $sitepress->get_current_language();

			$ret[ $code ] = array(
				'code' => $code,
				'url'  => $data['url'],
			);

			$ret[ $code ]['url'] = apply_filters( 'wpml_ls_language_url', $ret[ $code ]['url'], $data );

			$ret[ $code ]['url']            = apply_filters( 'wpml_ls_language_url', $ret[ $code ]['url'], $data );
			$ret[ $code ]['url']            = $sitepress->get_wp_api()->is_admin() ? '#' : $ret[ $code ]['url'];
			$ret[ $code ]['flag_url']       = $data['country_flag_url'];
			$ret[ $code ]['flag_title']     = $data['native_name'];
			$ret[ $code ]['native_name']    = $data['native_name'];
			$ret[ $code ]['display_name']   = $data['translated_name'];

			if ( $is_current_language ) {
				$ret[ $code ]['is_current'] = true;

				array_push( $css_classes, $css_prefix . 'current-language' );
			}

			$ret[ $code ]['css_classes'] = $css_classes;
		}

		$i = 1;

		foreach ( $ret as &$lang ) {
			if ( 1 === $i ) {
				array_push( $lang['css_classes'], $css_prefix . 'first-item' );
			}

			if ( count( $ret ) === $i ) {
				array_push( $lang['css_classes'], $css_prefix . 'last-item' );
			}

			$lang['css_classes'] = apply_filters( 'wpml_ls_model_language_css_classes', $lang['css_classes'] );
			$lang['css_classes'] = implode( ' ', $lang['css_classes'] );

			$i++;
		}
	}
	?>
	<div class="wpml-ls-statics-shortcode_actions wpml-ls wpml-ls-legacy-list-horizontal">
		<ul>
			<?php foreach ( $ret as $code => $language ) : ?>

				<li class="<?php echo $language['css_classes']; ?> wpml-ls-item-legacy-list-horizontal">
					<a href="<?php echo esc_url( $language['url'] ); ?>">
						<?php if ( ! empty( $language['flag_url'] ) ) : ?>
						<img class="wpml-ls-flag" src="<?php echo esc_url( $language['flag_url'] ); ?>" alt="<?php echo esc_attr( $language['code'] ); ?>" title="<?php echo esc_attr( $language['flag_title'] ); ?>">
						<?php endif; ?>

						<span class="wpml-ls-display"><?php echo esc_html( $language['display_name'] ); ?></span>
					</a>
				</li>

			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}
