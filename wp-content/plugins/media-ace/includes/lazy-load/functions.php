<?php
/**
 * Functions
 *
 * @package media-ace
 * @subpackage Functions
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$mace_lazy_load_enabled = false;

if ( ! is_admin() && mace_get_lazy_load_images() ) {
	add_filter( 'wp_get_attachment_image_attributes', 'mace_lazy_load_attachment', 10, 3 );
	add_filter( 'the_content', 'mace_lazy_load_content_image' );
	$mace_lazy_load_enabled = true;
}

if ( ! is_admin() && mace_get_lazy_load_embeds() ) {
	add_filter( 'embed_oembed_html', 'mace_lazy_load_iframe', 9, 3 );
	$mace_lazy_load_enabled = true;
}

if ( $mace_lazy_load_enabled ) {
	add_action( 'wp_enqueue_scripts', 'mace_load_lazy_load_assets' );
	add_action( 'wp_head', 'mace_lazy_load_inline_styles' );
	add_filter( 'wp_kses_allowed_html', 'mace_allow_extra_html_attributes' );

	add_filter( 'mace_lazy_load_embed', 'mace_disable_lazy_load_on_feed' );
	add_filter( 'mace_lazy_load_image', 'mace_disable_lazy_load_on_feed' );
}

function mace_allow_extra_html_attributes( $allowedposttags ) {
	$allowedposttags['img']['data-src']     = true;
	$allowedposttags['img']['data-expand']  = true;
	$allowedposttags['img']['data-srcset']  = true;
	$allowedposttags['img']['data-sizes']   = true;

	return $allowedposttags;
}

function mace_lazy_load_attachment( $attr, $attachment, $size ) {
	if ( ! apply_filters( 'mace_lazy_load_image', true ) || is_embed() ) {
		return $attr;
	}

	if ( ! apply_filters( 'mace_lazy_load_attachment', true, $attr, $attachment, $size ) ) {
		return $attr;
	}

	$html_class = isset( $attr['class'] ) ? $attr['class'] : '';

	if ( isset( $attr['src'] ) && mace_can_add_lazy_load_class( $html_class ) ) {
		$attr['class']      .= ' ' . mace_get_lazy_load_class();
		$attr['data-src']   =  $attr['src'];

		if ( mace_get_lazy_load_images_unveilling_effect() ) {
			$attr['data-expand'] = '600';
		}

		$attr['src'] = mace_get_plugin_url() . 'includes/lazy-load/images/blank.png';

		if ( isset( $attr['srcset'] ) ) {
			$attr['data-srcset'] = $attr['srcset'];
			unset($attr['srcset']);
		}

		if ( isset( $attr['sizes'] ) ) {
			$attr['data-sizes'] = $attr['sizes'];
			unset($attr['sizes']);
		}
	}

	return $attr;
}

function mace_lazy_load_content_image( $content ) {
	if ( ! apply_filters( 'mace_lazy_load_image', true || is_embed() ) ) {
		return $content;
	}

	if ( ! apply_filters( 'mace_lazy_load_content_image', true, $content ) ) {
		return $content;
	}

	// Find img tags.
	if ( preg_match_all('/<img[^>]+>/i', $content, $matches) ) {
		$lazy_class = mace_get_lazy_load_class();

		foreach( $matches[0] as $img_tag ) {
			// Process only if the src attribute exists.
			if ( preg_match('/src="([^"]+)"/i', $img_tag ) ) {
				$new_img_tag = $img_tag;

				// Html class not set.
				$html_class = '';

				// Extract html class.
				if ( preg_match('/class="([^"]+)"/i', $new_img_tag, $class_matches ) ) {
					$html_class = $class_matches[1];
				}

				if ( ! mace_can_add_lazy_load_class( $html_class ) ) {
					continue;
				}

				// Thanks to this placeholder, browser will reserve correct space (blank) for future image.
				$placeholder = mace_get_plugin_url() . 'includes/lazy-load/images/blank.png';

				$new_img_tag = str_replace(
					array(
						'src=',
						'srcset=',
						'sizes=',
						'class="',
					),
					array(
						'src="' . $placeholder . '" data-src=',
						'data-srcset=',
						'data-sizes=',
						'class="' . $lazy_class . ' ',
					),
					$new_img_tag
				);

				// Class attribute was not replaced. We need to add it.
				if ( false === strpos( $new_img_tag, 'class=' ) ) {
					$new_img_tag = str_replace( '<img', '<img class="' . $lazy_class . '"', $new_img_tag );
				}

				// Add data-expand attribute if enabled.
				if ( mace_get_lazy_load_images_unveilling_effect() ) {
					$new_img_tag = str_replace( '<img', '<img data-expand="600"', $new_img_tag );
				}

				$content = str_replace( $img_tag, $new_img_tag, $content );
			}
		}
	}

	return $content;
}

function mace_get_lazy_load_class() {
	return apply_filters( 'mace_lazy_load_class', 'lazyload' );
}

function mace_get_lazy_load_disable_class() {
	return apply_filters( 'mace_lazy_load_disable_class', 'g1-no-lazyload' );
}

function mace_can_add_lazy_load_class( $html_class ) {
	$lazy_class     = mace_get_lazy_load_class();
	$disable_class  = mace_get_lazy_load_disable_class();

	// Bail if $lazy_class class is already added.
	if ( false !== strpos( $html_class, $lazy_class ) ) {
		return false;
	}

	// Bail if $disable_class class is set.
	if ( false !== strpos( $html_class, $disable_class ) ) {
		return false;
	}

	return apply_filters( 'mace_can_add_lazy_load_class', true, $html_class );
}

function mace_lazy_load_iframe( $html, $url, $attr ) {
	if ( ! apply_filters( 'mace_lazy_load_embed', true, $html, $url, $attr ) || is_embed() ) {
		return $html;
	}

	if ( 0 === strpos( $html, '<iframe' ) ) {
		$html       = str_replace('src=', 'data-src=', $html);
		$lazy_class = mace_get_lazy_load_class();

		if ( strpos( $html, 'class=' ) ) {
			$html = str_replace('class="', 'class="' . $lazy_class . ' ', $html);
		} else {
			$html = str_replace('<iframe', '<iframe class="' .$lazy_class . '" ', $html);
		}
	}

	return $html;
}

/**
 * Load lazy load js,css
 */
function mace_load_lazy_load_assets() {
	$plugin_url = mace_get_plugin_url();

	wp_enqueue_script( 'lazysizes', $plugin_url . 'includes/lazy-load/js/lazysizes/lazysizes.min.js', array(), '4.0', true );
}

function mace_lazy_load_inline_styles() {
	if ( ! mace_get_lazy_load_images_unveilling_effect() ) {
		return;
	}
	?>
	<style>
		.lazyload, .lazyautosizes, .lazybuffered {
			opacity: 0;
		}
		.lazyloaded {
			opacity: 1;
			transition: opacity 0.175s ease-in-out;
		}

		iframe.lazyloading {
			opacity: 1;
			transition: opacity 0.375s ease-in-out;
			background: #f2f2f2 no-repeat center;
		}
		iframe.lazyloaded {
			opacity: 1;
		}
	</style>
	<?php
}

/**
 * Check whether to lazy load images
 *
 * @return string
 */
function mace_get_lazy_load_images() {
	return 'standard' === get_option( 'mace_lazy_load_images', 'standard' );
}

/**
 * Check whether to lazy load images
 *
 * @return string
 */
function mace_get_lazy_load_images_unveilling_effect() {
	return 'standard' === get_option( 'mace_lazy_load_images_unveilling_effect', 'standard' );
}

/**
 * Check whether to lazy load embeds
 *
 * @return string
 */
function mace_get_lazy_load_embeds() {
	return 'standard' === get_option( 'mace_lazy_load_embeds', 'standard' );
}

/**
 * YouTube player arguments
 *
 * @return string
 */
function mace_get_lazy_load_yt_player_args() {
	$defaults = array(
		'rel'       => 1,
	);

	$args = get_option( 'mace_lazy_load_yt_player_args', false );

	// If not set.
	if ( false === $args ) {
		 $args = $defaults;
	}

	// Normalize.
	if ( false !== $args && ! isset( $args['rel'] ) ) {
		$args['rel'] = 0;
	}

	return $args;
}

/**
 * Disable lazy load on feeds
 *
 * @param  bool $lazy_load  Wheter to lazy load.
 * @return bool
 */
function mace_disable_lazy_load_on_feed( $lazy_load ) {
	if ( is_feed() ) {
		return false;
	}
	return $lazy_load;
}
