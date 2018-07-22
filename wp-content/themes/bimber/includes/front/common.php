<?php
/**
 * Front common functions
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
 * Get logo image.
 *
 * @return array
 */
function bimber_get_logo() {
	$result = array();

	$logo = bimber_get_theme_option( 'branding', 'logo' );

	if ( empty( $logo ) ) {
		return array();
	}

	$result['src'] = $logo;

	$logo_2x = bimber_get_theme_option( 'branding', 'logo_hdpi' );

	if ( ! empty( $logo_2x ) ) {
		$result['srcset'] = $logo_2x . ' 2x,' . $logo . ' 1x';
	}

	$result['width']  = bimber_get_theme_option( 'branding', 'logo_width' );
	$result['height'] = bimber_get_theme_option( 'branding', 'logo_height' );

	return $result;
}

/**
 * Get small logo image.
 *
 * @return array
 */
function bimber_get_small_logo() {
	$result = array();

	$logo = bimber_get_theme_option( 'branding', 'logo_small' );

	if ( empty( $logo ) ) {
		return array();
	}

	$result['src'] = $logo;

	$logo_2x = bimber_get_theme_option( 'branding', 'logo_small_hdpi' );

	if ( ! empty( $logo_2x ) ) {
		$result['srcset'] = $logo_2x . ' 2x,' . $logo . ' 1x';
	}

	$result['width']  = bimber_get_theme_option( 'branding', 'logo_small_width' );
	$result['height'] = bimber_get_theme_option( 'branding', 'logo_small_height' );

	return $result;
}

/**
 * Get microdata organization logo URL.
 */
function bimber_get_microdata_organization_logo_url() {
	$url = bimber_get_theme_option( 'branding', 'logo_hdpi' );
	if ( empty( $logo ) ) {
		$url = bimber_get_theme_option( 'branding', 'logo' );
	}
	return $url;
}


/**
 * Get footer stamp image.
 *
 * @return array
 */
function bimber_get_footer_stamp() {
	$result = array();

	$stamp = bimber_get_theme_option( 'footer', 'stamp' );

	if ( empty( $stamp ) ) {
		return array();
	}

	$result['src'] = $stamp;

	$stamp_2x = bimber_get_theme_option( 'footer', 'stamp_hdpi' );

	if ( ! empty( $stamp_2x ) ) {
		$result['srcset'] = $stamp_2x;
	}

	$result['width']  = bimber_get_theme_option( 'footer', 'stamp_width' );
	$result['height'] = bimber_get_theme_option( 'footer', 'stamp_height' );

	return $result;
}

/**
 * Fix RTL styles.
 *
 * @param string $html   The link tag for the enqueued style.
 * @param string $handle The style's registered handle.
 * @param string $href   The stylesheet's source URL.
 * @param string $media  The stylesheet's media attribute.
 * @return string
 */
function bimber_fix_rtl_styles( $html, $handle, $href, $media ){
	if ( strpos( $handle, 'bimber-' ) > -1 || 'g1-main' === $handle ) {
		$html = str_replace( '.min-rtl', '-rtl.min', $html );
	}
	return $html;
}


/**
 * Enqueue stylesheets in the head
 */
function bimber_enqueue_head_styles() {
	// Prevent CSS|JS caching during updates.
	$version = bimber_get_theme_version();
	$uri     = trailingslashit( get_template_directory_uri() );

	$stack         = bimber_get_current_stack();
	$skin          = bimber_get_theme_option( 'global', 'skin' );

	$css_uri = $uri . 'css/' . bimber_get_css_theme_ver_directory() . '\/styles/' . $stack . '/all-' . $skin . '.min.css';

	wp_enqueue_style( 'g1-main', $css_uri, array(), $version );
	wp_style_add_data( 'g1-main', 'rtl', 'replace' );

	// @todo - Move it to the appropriate place
	if ( bimber_can_use_plugin( 'js_composer/js_composer.php' ) ) {
		wp_enqueue_style( 'bimber-vc', $uri . 'css/' . bimber_get_css_theme_ver_directory() . '/vc.min.css', array(), $version );
		wp_style_add_data( 'bimber-vc', 'rtl', 'replace' );
	}

	// @todo - Move it to the appropriate place
	if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
		wp_enqueue_style( 'bimber-snax-extra', $uri . 'css/' . bimber_get_css_theme_ver_directory() . '\/styles/' . $stack . '/snax-extra-' . $skin . '.min.css', array(), $version );
		wp_style_add_data( 'bimber-snax-extra', 'rtl', 'replace' );
	}

	// @todo - Move it to the appropriate place
	if ( bimber_can_use_plugin( 'buddypress/bp-loader.php' ) ) {
		wp_enqueue_style( 'bimber-buddypress', $uri . 'css/' . bimber_get_css_theme_ver_directory() . '\/styles/' . $stack . '/buddypress-' . $skin . '.min.css', array(), $version );
		wp_style_add_data( 'bimber-buddypress', 'rtl', 'replace' );
	}

	// @todo - Move it to the appropriate place
	if ( bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
		wp_enqueue_style( 'bimber-woocommerce', $uri . 'css/' . bimber_get_css_theme_ver_directory() . '\/styles/' . $stack . '/woocommerce-' . $skin . '.min.css', array(), $version );
		wp_style_add_data( 'bimber-woocommerce', 'rtl', 'replace' );
	}

	// @todo - Move it to the appropriate place
	if ( bimber_can_use_plugin( 'bbpress/bbpress.php' ) ) {
		wp_enqueue_style( 'bimber-bbpress', $uri . 'css/' . bimber_get_css_theme_ver_directory() . '\/styles/' . $stack . '/bbpress-' . $skin . '.min.css', array(), $version );
		wp_style_add_data( 'bimber-bbpress', 'rtl', 'replace' );
	}
	if ( bimber_google_fonts_url() ) {
		wp_enqueue_style( 'bimber-google-fonts', bimber_google_fonts_url(), array(), $version );
	}

	if ( bimber_use_external_dynamic_style() ) {
		wp_enqueue_style( 'bimber-dynamic-style', bimber_dynamic_style_get_file_url() . '?respondjs=no', array(), $version );
	}



	// Load the stylesheet from the child theme.
	if ( get_template_directory() !== get_stylesheet_directory() ) {
		wp_register_style( 'bimber-style', get_stylesheet_uri(), array(), false, 'screen' );
		wp_style_add_data( 'bimber-style', 'rtl', trailingslashit( get_stylesheet_directory_uri() ) . 'rtl.css' );
		wp_enqueue_style( 'bimber-style' );
	}
}

/**
 * Google fonts
 */
function bimber_get_google_font_families() {
	$font_families = array();

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Roboto, translate this to 'off'. Do not translate into your own language.
	 */
	$roboto = _x( 'on', 'Roboto font: on or off', 'bimber' );

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Poppins, translate this to 'off'. Do not translate into your own language.
	 */
	$poppins = _x( 'on', 'Poppins font: on or off', 'bimber' );

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Poppins, translate this to 'off'. Do not translate into your own language.
	 */
	$rubik = _x( 'on', 'Rubik font: on or off', 'bimber' );

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Poppins, translate this to 'off'. Do not translate into your own language.
	 */
	$rajdhani = _x( 'on', 'Rajdhani font: on or off', 'bimber' );

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by FiraSans, translate this to 'off'. Do not translate into your own language.
	 */
	$fira = _x( 'on', 'Rajdhani font: on or off', 'bimber' );

	$stack = bimber_get_current_stack();

	// Stack: Original.
	if ( 'original' === $stack || 'minimal' === $stack ) {
		if ( 'off' !== $roboto ) {
			$font_families['roboto'] = 'Roboto:400,300,500,600,700,900';
		}

		if ( 'off' !== $poppins ) {
			$font_families['poppins'] = 'Poppins:400,300,500,600,700';
		}
	}

	// Stack: Cards.
	if ( 'cards' === $stack ) {
		if ( 'off' !== $roboto ) {
			$font_families['roboto'] = 'Roboto:400,300,500,600,700,900';
		}

		if ( 'off' !== $poppins ) {
			$font_families['poppins'] = 'Poppins:400,300,500,600,700';
		}
	}

	// Stack: Miami.
	if ( 'miami' === $stack ) {
		if ( 'off' !== $roboto ) {
			$font_families['roboto'] = 'Roboto:400,300,500,600,700,900';
		}

		if ( 'off' !== $rubik ) {
			$font_families['rubik'] = 'Rubik:700,900';
		}
	}

	// Stack: Music.
	if ( 'music' === $stack ) {
		if ( 'off' !== $roboto ) {
			$font_families['roboto'] = 'Roboto:400,300,500,600,700,900';
		}
	}

	// Stack: Hardcore.
	if ( 'hardcore' === $stack ) {
		if ( 'off' !== $roboto ) {
			$font_families['roboto'] = 'Roboto:400,300,500,600,700,900';
		}

		if ( 'off' !== $rajdhani ) {
			$font_families['rajdhani'] = 'Rajdhani:300,400,500,600,700';
		}
	}

	// Stack: Bunchy.
	if ( 'bunchy' === $stack ) {
		if ( 'off' !== $roboto ) {
			$font_families['roboto'] 			= 'Roboto:400,300,500,600,700,900';
			$font_families['roboto_condensed'] 	= 'Roboto Condensed:400,300,500,600,700';
		}

		if ( 'off' !== $poppins ) {
			$font_families['poppins'] = 'Poppins:400,300,500,600,700';
		}
	}

	// Stack: Carmania.
	if ( 'carmania' === $stack ) {
		if ( 'off' !== $fira ) {
			$font_families['fira'] 				= 'Fira Sans:400,300,500,600,700,900';
			$font_families['fira_condensed'] 	= 'Fira Sans Condensed:400,300,500,600,700,900';
		}
	}

	return apply_filters( 'bimber_get_google_font_families', $font_families );
}

/**
 * Google fonts
 */
function bimber_google_fonts_url() {
	$fonts_url = '';

	$font_families = bimber_get_google_font_families();
	if ( empty( $font_families ) ) {
		return false;
	}
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( bimber_get_google_font_subset() ),
	);

	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}


/**
 * Get Google Font font subset
 *
 * @return string
 */
function bimber_get_google_font_subset() {
	$subset = bimber_get_theme_option( 'global', 'google_font_subset' );

	return apply_filters( 'bimber_google_font_subset', $subset );
}

/**
 * Render scripts in the HTML head
 */
function bimber_render_head_scripts() {

}

/**
 * Enqueue scripts used only on the frontend
 */
function bimber_enqueue_front_scripts() {
	// Prevent CSS|JS caching during updates.
	$version = bimber_get_theme_version();

	$parent_uri = trailingslashit( get_template_directory_uri() );
	$child_uri  = trailingslashit( get_stylesheet_directory_uri() );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Head scripts.
	 */

	wp_enqueue_script( 'modernizr', $parent_uri . 'js/modernizr/modernizr-custom.min.js', array(), '3.3.0', false );

	/**
	 * Footer scripts.
	 */

	if ( bimber_is_masonry_template() ) {
		wp_enqueue_script( 'isotope', $parent_uri . 'js/isotope/isotope.pkgd.min.js', array( 'jquery' ), '3.0.1', true );
	}

	// Postion sticky polyfill.
	wp_enqueue_script( 'stickyfill', $parent_uri . 'js/stickyfill/stickyfill.min.js', array( 'jquery' ), '2.0.3', true );

	// Enqueue input::placeholder polyfill for IE9.
	wp_enqueue_script( 'jquery-placeholder', $parent_uri . 'js/jquery.placeholder/placeholders.jquery.min.js', array( 'jquery' ), '4.0.1', true );

	// Conver dates into fuzzy timestaps.
	wp_enqueue_script( 'jquery-timeago', $parent_uri . 'js/jquery.timeago/jquery.timeago.js', array( 'jquery' ), '1.5.2', true );
	bimber_enqueue_timeago_i10n_script( $parent_uri );

	// Enqueue matchmedia polyfill.
	wp_enqueue_script( 'match-media', $parent_uri . 'js/matchMedia/matchMedia.js', array(), null, true );

	// Enqueue matchmedia addListener polyfill (media query events on window resize) for IE9.
	wp_enqueue_script( 'match-media-add-listener', $parent_uri . 'js/matchMedia/matchMedia.addListener.js', array( 'match-media' ), null, true );

	// Enqueue <picture> polyfill, <img srcset="" /> polyfill for Safari 7.0-, FF 37-, etc.
	wp_enqueue_script( 'picturefill', $parent_uri . 'js/picturefill/picturefill.min.js', array( 'match-media' ), '2.3.1', true );

	// Scroll events.
	wp_enqueue_script( 'jquery-waypoints', $parent_uri . 'js/jquery.waypoints/jquery.waypoints.min.js', array( 'jquery' ), '4.0.0', true );

	// GifPlayer.
	//if ( is_single() ) {
		wp_enqueue_script( 'libgif', $parent_uri . 'js/libgif/libgif.js', array(), null, true );
	//}

	// Media queries in javascript.
	wp_enqueue_script( 'enquire', $parent_uri . 'js/enquire/enquire.min.js', array( 'match-media', 'match-media-add-listener' ), '2.1.2', true );

	if ( bimber_is_ajax_search_enabled() ) {
		wp_enqueue_script( 'jquery-ui-autocomplete' );
	}

	wp_enqueue_script( 'bimber-front', $parent_uri . 'js/front.js', array( 'jquery', 'enquire' ), $version, true );

	// If child theme is activated, we can use this script to override theme js code.
	if ( $parent_uri !== $child_uri ) {
		wp_enqueue_script( 'bimber-child', $child_uri . 'modifications.js', array( 'bimber-front' ), null, true );
	}

	// Prepare js config.
	$config = array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'timeago'  => bimber_get_theme_option( 'posts', 'timeago', 'standard' ) === 'standard' ? 'on' : 'off',
		'sharebar' => bimber_get_theme_option( 'post', 'sharebar', 'standard' ) === 'standard' ? 'on' : 'off',
		'microshare' => bimber_get_theme_option( 'post', 'microshare', 'standard' ) === 'standard' ? 'on' : 'off',
		'i18n'     => array(
			'menu' => array(
				'go_to' => esc_html_x( 'Go to', 'Menu', 'bimber' ),
			),
			'newsletter' => array(
				'subscribe_mail_subject_tpl' => esc_html_x( 'Check out this great article: %subject%', 'Newsletter', 'bimber' ),
			),
			'bp_profile_nav' => array(
				'more_link'	=> esc_html_x( 'More', 'BuddyPress Profile Link', 'bimber' ),
			),
		),
		'comment_types'	   => array_keys( bimber_get_comment_types() ),
		'auto_load_limit'  => bimber_get_theme_option( 'posts', 'auto_load_max_posts' ),
		'auto_play_videos' => bimber_get_theme_option( 'posts', 'auto_play_videos' ),
		'setTargetBlank'   => bimber_get_theme_option( 'posts', 'set_target_blank' ),
		'useWaypoints'     => bimber_get_theme_option( 'posts', 'page_waypoints' ),
		'stack'            => bimber_get_current_stack(),
	);

	wp_localize_script( 'bimber-front', 'bimber_front_config', wp_json_encode( $config ) );
	// we fill the below with HTML later, empty string is to make sure we have the variable
	$data = array();
	wp_localize_script( 'bimber-front', 'bimber_front_microshare', wp_json_encode( $data ) );
}

function bimber_is_masonry_template() {
	// Check Home.
	$is_masonry = is_home() && false !== strpos( bimber_get_theme_option( 'home', 'template' ), 'masonry' );

	// Check other archives, only if home check failed.
	if ( ! $is_masonry ) {
		$is_masonry = is_archive() && false !== strpos( bimber_get_theme_option( 'archive', 'template' ), 'masonry' );
	}

	if ( ! $is_masonry ) {
		$is_masonry = is_search() && false !== strpos( bimber_get_theme_option( 'search', 'template' ), 'masonry' );
	}

	return $is_masonry;
}

/**
 * Enqueue translation file for the timeago script
 *
 * @param string $parent_uri Parent Theme URI.
 */
function bimber_enqueue_timeago_i10n_script( $parent_uri ) {
	$locale       = get_locale();
	$locale_parts = explode( '_', $locale );
	$lang_code    = $locale_parts[0];

	$exceptions_map = array(
		'pt_BR' => 'pt-br',
		'zh_CN' => 'zh-CN',
		'zh_TW' => 'zh-TW',
	);

	$script_i10n_ext = $lang_code;

	if ( isset( $exceptions_map[ $locale ] ) ) {
		$script_i10n_ext = $exceptions_map[ $locale ];
	}

	// Check if translation file exists in "locales" dir.
	if ( ! file_exists( BIMBER_THEME_DIR . 'js/jquery.timeago/locales/jquery.timeago.' . $script_i10n_ext . '.js' ) ) {
		return;
	}

	wp_enqueue_script( 'jquery-timeago-' . $script_i10n_ext, $parent_uri . 'js/jquery.timeago/locales/jquery.timeago.' . $script_i10n_ext . '.js', array( 'jquery-timeago' ), null, true );
}

/**
 * Load front scripts conditionally
 *
 * @param string $tag Script tag.
 * @param string $handle Script handle.
 *
 * @return string
 */
function bimber_load_front_scripts_conditionally( $tag, $handle ) {
	if ( in_array( $handle, array( 'placeholder' ), true ) ) {
		$tag = "\n<!--[if IE 9]>\n$tag<![endif]-->\n";
	}

	return $tag;
}

/**
 * Render meta tag with proper viewport.
 */
function bimber_add_responsive_design_meta_tag() {
	echo "\n" . '<meta name="viewport" content="initial-scale=1.0, width=device-width" />' . "\n";
}

/**
 * Alter the HTML markup of the calendar widget.
 *
 * @param string $out Markup.
 *
 * @return string
 */
function bimber_alter_calendar_output( $out ) {
	$out = str_replace(
		array(
			'<td class="pad" colspan="1">&nbsp;</td>',
			'<td class="pad" colspan="2">&nbsp;</td>',
			'<td class="pad" colspan="3">&nbsp;</td>',
			'<td class="pad" colspan="4">&nbsp;</td>',
			'<td class="pad" colspan="5">&nbsp;</td>',
			'<td class="pad" colspan="6">&nbsp;</td>',
			'<td colspan="1" class="pad">&nbsp;</td>',
			'<td colspan="2" class="pad">&nbsp;</td>',
			'<td colspan="3" class="pad">&nbsp;</td>',
			'<td colspan="4" class="pad">&nbsp;</td>',
			'<td colspan="5" class="pad">&nbsp;</td>',
			'<td colspan="6" class="pad">&nbsp;</td>',
			'<td colspan="3" id="prev" class="pad">&nbsp;</td>',
			'<td colspan="3" id="next" class="pad">&nbsp;</td>',
		),
		array(
			str_repeat( '<td class="pad">&nbsp;</td>', 1 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 2 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 3 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 4 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 5 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 6 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 1 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 2 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 3 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 4 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 5 ),
			str_repeat( '<td class="pad">&nbsp;</td>', 6 ),
			'<td colspan="3" id="prev" class="pad"><span></span></td>',
			'<td colspan="3" id="next" class="pad"><span></span></td>',
		),
		$out
	);

	return $out;
}

/**
 * Whether or not to show global featured content
 *
 * @param WP_Post $post             Optional. Post object or id.
 *
 * @return boolean
 */
function bimber_show_global_featured_entries( $post = null ) {
	$bimber_fe_visibility = explode( ',', bimber_get_theme_option( 'featured_entries', 'visibility' ) );

	// Global set up.
	$bimber_fe_show_on_home        = is_home() && in_array( 'home', $bimber_fe_visibility, true );
	$bimber_fe_show_on_single_post = is_single() && in_array( 'single_post', $bimber_fe_visibility, true );

	// Single post set up.
	if ( is_single() ) {
		$post = get_post( $post );

		$post_meta = get_post_meta( $post->ID, '_bimber_single_options', true );

		if ( ! empty( $post_meta['featured_entries'] ) ) {
			$bimber_fe_show_on_single_post = ( 'standard' === $post_meta['featured_entries'] );
		}
	}

	return apply_filters( 'bimber_show_global_featured_entries', $bimber_fe_show_on_home || $bimber_fe_show_on_single_post );
}

/**
 * Check whether the global featured entires are in specific type
 *
 * @return boolean
 */
function bimber_global_featured_entries_exclude_from_main_loop() {
	return (bool) bimber_get_theme_option( 'featured_entries', 'exclude_from_main_loop' );
}

/**
 * Add body class responsible for boxed|stretched layout
 *
 * @param array $classes Body classes.
 *
 * @return array
 */
function bimber_body_class_global_layout( $classes ) {
	$layout    = bimber_get_theme_option( 'global', 'layout' );
	$classes[] = 'g1-layout-' . $layout;

	return $classes;
}

/**
 * Add some body classes.
 *
 * @param array $classes Body classes.
 *
 * @return array
 */
function bimber_body_class_helpers( $classes ) {
	$classes[] = 'g1-hoverable';
	if (is_preview()) {
		$classes[] = 'g1-post-preview';
	}

	return $classes;
}

/**
 * Add body class indicating there's the mobile logo available.
 *
 * @param array $classes Body classes.
 *
 * @return array
 */
function bimber_body_class_mobile_logo( $classes ) {
	$logo = bimber_get_small_logo();

	if ( ! empty( $logo ) ) {
		$classes[] = 'g1-has-mobile-logo';
	}

	return $classes;
}

/**
 * Hide sharebar on specific pages.
 *
 * @param bool $bool Whether or not the sharebar is visible.
 *
 * @return bool
 */
function bimber_hide_sharebar( $bool ) {
	if ( ! is_single() ) {
		$bool = false;
	}

	return $bool;
}

/**
 * Inserts spans into category listing
 *
 * @param string $in Markup.
 *
 * @return string
 */
function bimber_insert_cat_count_span( $in ) {
	$out = preg_replace( '/<\/a> \(([0-9]+)\)/', ' <span class="g1-meta">\\1</span></a>', $in );

	return $out;
}

/**
 * Inserts spans into archive listing
 *
 * @param string $in Markup.
 *
 * @return string
 */
function bimber_insert_archive_count_span( $in ) {

	if ( false !== strpos( $in, '<li>' ) ) {
		$out = preg_replace( '/<\/a>&nbsp;\(([0-9]+)\)/', ' <span class="g1-meta">\\1</span></a>', $in );

		return $out;
	}

	return $in;
}

function bimber_shorten_number( $value ) {
	if ( $value > 1000000 ) {
		$value = round( $value / 1000000, 1 ) . esc_html_x( 'M', 'formatted number suffix', 'bimber' );
	} elseif ( $value > 1000 ) {
		$value = round( $value / 1000, 1 ) . esc_html_x( 'k', 'formatted number suffix', 'bimber' );
	}

	return $value;
}



/**
 * Whether or not to show the quick navigation links
 *
 * @return mixed|void
 */
function bimber_show_quick_nav_menu() {
	$show = false;

	if ( 'separate' === bimber_get_theme_option( 'posts', 'top_in_menu' ) ) {
		$latest_url  = bimber_get_latest_page_url();
		$popular_url  = bimber_get_popular_page_url();
		$hot_url  = bimber_get_hot_page_url();
		$trending_url = bimber_get_trending_page_url();

		if ( strlen( $latest_url . $popular_url . $hot_url . $trending_url ) ) {
			$show = true;
		}
	}

	// "What's your reaction?" items.
	if ( bimber_can_use_plugin( 'whats-your-reaction/whats-your-reaction.php') ) {
		$wyr_args = array(
			'taxonomy'   => wyr_get_taxonomy_name(),
			'hide_empty' => false,
		);

		$wyr_terms = get_terms( $wyr_args );

		if ( ! empty( $wyr_terms ) && ! is_wp_error( $wyr_terms ) ) {
			$show = true;
		}
	}

	return apply_filters( 'bimber_show_quick_nav_menu', $show );
}





function bimber_show_prefooter() {
	$show = true;

	if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) {
		$show = false;
	}

	return apply_filters( 'bimber_show_prefooter', $show );
}

/**
 * Check whether to use sticky header
 *
 * @return bool
 *
 * @since 3.1
 */
function bimber_use_sticky_header() {
	$use_sticky_header = 'standard' === bimber_get_theme_option( 'header', 'sticky' );

	return apply_filters( 'bimber_use_sticky_header', $use_sticky_header );
}

/**
 * Whether or not to show the user community profile link.
 *
 * $param int $user_id User ID.
 * @return bool
 *
 * @since 2.0.4
 */
function bimber_show_user_profile_link( $user_id ) {
	$bool = false;

	if ( bimber_can_use_plugin( 'buddypress/bp-loader.php' ) ) {
		$bool = true;
	}

	return apply_filters( 'bimber_show_user_profile_link', $bool, $user_id );
}

/**
 * Generates color variations based on a single color
 *
 * @param Bimber_Color $color Color.
 *
 * @return array
 */
function bimber_get_color_variations($color ) {
	$result = array();

	if ( ! is_a( $color, 'Bimber_Color' ) ) {
		$color = new Bimber_Color( $color );
	}

	$color_rgb = $color->get_rgb();
	$color_rgb = array_map( 'round', $color_rgb );

	$result['hex'] = $color->get_hex();
	$result['r']   = $color_rgb[0];
	$result['g']   = $color_rgb[1];
	$result['b']   = $color_rgb[2];

	$result['from_hex'] = $color->get_hex();
	$result['from_r']   = $color_rgb[0];
	$result['from_g']   = $color_rgb[1];
	$result['from_b']   = $color_rgb[2];
	$result['to_hex']   = $color->get_hex();
	$result['to_r']     = $color_rgb[0];
	$result['to_g']     = $color_rgb[1];
	$result['to_b']     = $color_rgb[2];

	$border2     = Bimber_Color_Generator::get_tone_color( $color, 20 );
	$border2_rgb = $border2->get_rgb();
	$border2_rgb = array_map( 'round', $border2_rgb );

	$border1 = clone $color;
	$border1->set_lightness( round( ( $border1->get_lightness() + $border2->get_lightness() ) / 2 ) );
	$border1_rgb = $border1->get_rgb();
	$border1_rgb = array_map( 'round', $border1_rgb );

	$result['border2_hex'] = $border2->get_hex();
	$result['border2_r']   = $border2_rgb[0];
	$result['border2_g']   = $border2_rgb[1];
	$result['border2_b']   = $border2_rgb[2];

	$result['border1_hex'] = $border1->get_hex();
	$result['border1_r']   = $border1_rgb[0];
	$result['border1_g']   = $border1_rgb[1];
	$result['border1_b']   = $border1_rgb[2];

	if ( $color->get_lightness() >= 50 ) {
		$result['border1_start'] = 0;
		$result['border1_end']   = 0.66;
	} else {
		$result['border1_start'] = 0.66;
		$result['border1_end']   = 0;
	}

	$tone_20_20     = Bimber_Color_Generator::get_tone_color( $color, 20, 20 );
	$tone_20_20_rgb = $tone_20_20->get_rgb();
	$tone_20_20_rgb = array_map( 'round', $tone_20_20_rgb );

	$result['tone_20_20_hex'] = $tone_20_20->get_hex();
	$result['tone_20_20_r']   = $tone_20_20_rgb[0];
	$result['tone_20_20_g']   = $tone_20_20_rgb[1];
	$result['tone_20_20_b']   = $tone_20_20_rgb[2];

	$tone_5_90     = Bimber_Color_Generator::get_tone_color( $color, 5, 90 );
	$tone_5_90_rgb = $tone_5_90->get_rgb();
	$tone_5_90_rgb = array_map( 'round', $tone_5_90_rgb );

	$result['tone_5_90_hex'] = $tone_5_90->get_hex();
	$result['tone_5_90_r']   = $tone_5_90_rgb[0];
	$result['tone_5_90_g']   = $tone_5_90_rgb[1];
	$result['tone_5_90_b']   = $tone_5_90_rgb[2];

	return $result;
}

/**
 * Prepend the "Top" menu item to the Primary Navigation
 *
 * @param array  $items 		An array of menu item post objects.
 * @param object $menu  		The menu object.
 *
 * @return array
 */
function bimber_add_top_nav_menu_item( $items, $menu ) {
	if ( is_admin() ) {
		return $items;
	}

	if ( 'single' !== bimber_get_theme_option( 'posts', 'top_in_menu' ) ) {
		return $items;
	}

	$locations = get_nav_menu_locations();

	// Add new menu item only to the Primary Nav.
	if ( isset( $locations['bimber_primary_nav'] ) && $locations['bimber_primary_nav'] === $menu->term_id ) {
		$top_page_id = bimber_get_top_page_id();
		$classes = array();
		if ( bimber_is_top_page() ) {
			$classes [] = sanitize_html_class( 'current-menu-item' );
		}
		if ( $top_page_id ) {
			$item = new stdClass();
			$item->ID = 1000000;
			$item->db_id = $item->ID;
			$item->title = preg_replace( '/(\d+)/', '<strong>$1</strong>', bimber_get_top_page_label() );
			$item->url = bimber_get_top_page_url();
			$item->menu_order = 0;
			$item->menu_item_parent = 0;
			$item->type = 'g1-top';
			$item->object = 'page';
			$item->object_id = $top_page_id;
			$item->classes = $classes;
			$item->target = '';
			$item->attr_title = '';
			$item->description = '';
			$item->xfn = '';
			$item->status = '';

			array_unshift( $items, $item );
		}
	}

	return $items;
}

/**
 * Check whether the search form has autocomplete option enabled
 *
 * @return bool
 */
function bimber_is_ajax_search_enabled() {
	$bool = (bool) bimber_get_theme_option( 'search', 'ajax' );

	return apply_filters( 'bimber_ajax_search', $bool );
}

/**
 * Load FB SDK script in footer
 */
function bimber_enqueue_fb_sdk() {
	static $done = false;
	if ( ! $done ) {
		add_action( 'wp_footer', 'bimber_print_fb_sdk', 9999 );
		$done = true;
	}
}

/**
 * Print FB SDK
 */
function bimber_print_fb_sdk() {
	$delay = apply_filters( 'bimber_facebook_load_with_delay', 0 );

	$sdk_config = array(
		'language'	=> 'en_US',
		'version'	=> 'v3.0',
		'appId'		=> '',
	);

	$sdk_config  = apply_filters( 'bimber_facebook_sdk_config', $sdk_config );

	$sdk_url = '//connect.facebook.net/' . $sdk_config['language'] . '/sdk.js#xfbml=1&version=' . $sdk_config['version'];

	if ( ! empty( $sdk_config['appId'] ) ) {
		$sdk_url .= '&appId=' . $sdk_config['appId'];
	}

	$sdk_url = apply_filters( 'bimber_facebook_sdk_url', $sdk_url );
	?>
	<div id="fb-root"></div>
	<script type="text/javascript">
		(function() {

			var loaded = false;
			var loadFB = function() {
				if (loaded) return;
				loaded = true;
				(function (d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = "<?php echo esc_url_raw( $sdk_url ); ?>";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			};
			setTimeout(loadFB, <?php echo absint( $delay ); ?>);
			document.body.addEventListener('bimberLoadFbSdk', loadFB);
		})();
	</script>
	<?php
}

function bimber_sanitize_ad( $html ) {
	if ( bimber_can_use_plugin( 'amp/amp.php' ) ) {
		if ( is_amp_endpoint() ) {
			$html = bimber_amp_remove_empty_style_attribute( $html );
		}
	}

	return $html;
}

/**
 * Filter posts per page value
 *
 * @param int $posts_per_page  Posts per page.
 * @return int
 */
function bimber_set_posts_per_page( $posts_per_page ) {

	if ( is_search() ) {
		$term_setting = bimber_get_theme_option( 'search','posts_per_page' );
		if ( $term_setting ) {
			return $term_setting;
		}
	}

	if ( is_category() ) {
		$term 				= get_queried_object();
		$term_meta		 	= 'bimber_posts_per_page';
		$term_setting 		= get_term_meta( $term->term_id, $term_meta, true );

		// Valid setting is not empty, empty string is reserved for "inherit" value.
		if ( $term_setting ) {
			return $term_setting;
		}
	}

	if ( is_tag() ) {
		$term 				= get_queried_object();
		$term_meta		 	= 'bimber_posts_per_page';
		$term_setting 		= get_term_meta( $term->term_id, $term_meta, true );

		// Valid setting is not empty, empty string is reserved for "inherit" value.
		if ( $term_setting ) {
			return $term_setting;
		}
	}

	if ( is_archive() ) {
		$term_setting = bimber_get_theme_option( 'archive','posts_per_page' );
		if ( $term_setting ) {
			return $term_setting;
		}
	}

	return $posts_per_page;
}

/** Replaces regexp matches with uniqe temporary tags.
 *
 * @param str $regexp  Regular expression.
 * @param str $string  Haystack.
 * @return array   New string and array with old values to revert
 */
function bimber_preg_make_unique( $regexp, $string ) {
	$replacements = array();
	preg_match_all( $regexp, $string, $matches );
	foreach ( $matches[0] as $match ) {
		$replace = '<!--UNIQUEMATCH' . uniqid() . '-->';
		$replacements[ $replace ] = $match;
		$string = adace_str_replace_first( $match, $replace, $string );
	}
	return array(
		'string' => $string,
		'replacements' => $replacements,
	);
}

/**
 * Reverts adace_preg_make_unique() using it's own return value.
 *
 * @param array $args Exactly as return of adace_preg_make_unique().
 * @return str
 */
function bimber_preg_make_unique_revert( $args ) {
	$string = $args['string'];
	$replacements = $args['replacements'];

	foreach ( $replacements as $key => $value ) {
		$string = str_replace( $key, $value, $string );
	}

	return $string;
}

/**
 * Add class to secondary menu items if they have children.
 *
 * @param  array $classes Classes.
 * @param  mixed $item    Item.
 * @return array
 */
function bimber_add_class_to_secondary_menu_items( $classes, $item ) {
	if ( in_array( 'menu-item-has-children', $classes, true ) ) {
		$classes[] = 'menu-item-g1-standard';
	}
	return $classes;
}

/**
 * Get the css directory appropriate for the theme version
 *
 * @return string
 */
function bimber_get_css_theme_ver_directory() {
	if ( ( defined( 'BTP_DEV' ) && BTP_DEV ) || ( defined( 'BTP_NOT_A_BUILD' ) && BTP_NOT_A_BUILD ) ) {
		return 'theme_ver';
	} else {
		return bimber_get_theme_version();
	}
}

/**
 * Render the section title
 *
 * @param string  $text  				Header text.
 * @param boolean $hide 				Whether to hide the title.
 * @param mixed   $additional_clases	Array of classess to add.
 */
function bimber_render_section_title( $text, $hide = false, $additional_clases = false ) {
	$args = bimber_get_section_title_args();
	if ( $hide ) {
		$args['class'][] = 'screen-reader-text';
	}
	if ( $additional_clases ) {
		$args['class'] = array_merge( $args['class'], $additional_clases );
	}
	if ( ! empty ( $text ) ) {
		printf( $args['before'], implode( ' ', array_map( 'sanitize_html_class', $args['class'] ) ) );
		echo wp_kses_post( $text );
		printf( $args['after'] );
	}
}

/**
 * Get section title args.
 *
 * @param boolean $additional_clases  Additional css classes.
 * @return array
 */
function bimber_get_section_title_args( $additional_clases = false ) {
	$args = array(
		'class' => array(
			'g1-delta',
			'g1-delta-2nd',
		),
		'before' => '<h2 class="%s"><span>',
		'after' => '</span></h2>',
	);
	$args = apply_filters( 'bimber_render_section_title_args', $args, $additional_clases );
	if ( is_array( $additional_clases ) ) {
		$args['class'] = array_merge( $args['class'], $additional_clases );
	}
	$args['before_with_class'] = sprintf( $args['before'], implode( ' ', array_map( 'sanitize_html_class', $args['class'] ) ) );
	return $args;
}

/**
 * Render tracking code inside page <head>
 */
function bimber_add_tracking_code_in_header() {
	echo bimber_get_theme_option( 'tracking_code', 'head' );
}

/**
 * Render tracking code inside page footer
 */
function bimber_add_tracking_code_in_footer() {
	echo bimber_get_theme_option( 'tracking_code', 'footer' );
}