<?php
/**
 * Plugin resources loader
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

require_once( BIMBER_PLUGINS_DIR . 'default-filters.php' );

if ( bimber_can_use_plugin( 'wordpress-popular-posts/wordpress-popular-posts.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'wordpress-popular-posts.php' );
}

if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'mailchimp-for-wp.php' );
}

if ( bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'woocommerce.php' );
}

if ( bimber_can_use_plugin( 'loco-translate/loco.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'loco-translate.php' );
}

if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'snax.php' );
}

if ( bimber_can_use_plugin( 'buddypress/bp-loader.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'buddypress/class-bimber-bp-walker-nav-menu.php' );
	require_once( BIMBER_PLUGINS_DIR . 'buddypress/class-bimber-bp-walker-nav-menu.php' );
	require_once( BIMBER_PLUGINS_DIR . 'buddypress/class-bimber-widget-featured-author.php' );
	require_once( BIMBER_PLUGINS_DIR . 'buddypress/buddypress.php' );

	if ( bimber_can_use_plugin( 'buddypress-followers/loader.php' ) ) {
		require_once( BIMBER_PLUGINS_DIR . 'buddypress/buddypress-followers.php' );
	}
}

if ( bimber_can_use_plugin( 'bbpress/bbpress.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'bbpress.php' );
}

if ( bimber_can_use_plugin( 'auto-load-next-post/auto-load-next-post.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'auto-load-next-post.php' );
}

if ( bimber_can_use_plugin( 'facebook-comments-plugin/facebook-comments.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'facebook-comments.php' );
}

if ( bimber_can_use_plugin( 'whats-your-reaction/whats-your-reaction.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'whats-your-reaction.php' );
}

if ( bimber_can_use_plugin( 'easy-google-fonts/easy-google-fonts.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'easy-google-fonts.php' );
}

if ( bimber_can_use_plugin( 'sitepress-multilingual-cms/sitepress.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'wpml.php' );
}

if ( bimber_can_use_plugin( 'disqus-comment-system/disqus.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'disqus.php' );
}

if ( bimber_can_use_plugin( 'fb-instant-articles/facebook-instant-articles.php' ) ) {
	require_once(BIMBER_PLUGINS_DIR . 'facebook-instant-articles.php');
}

if ( bimber_can_use_plugin( 'js_composer/js_composer.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'visual-composer/visual-composer.php' );
}

if ( bimber_can_use_plugin( 'amp/amp.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'amp.php' );
}

if ( bimber_can_use_plugin( 'media-ace/media-ace.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'media-ace.php' );
}

if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'ad-ace.php' );
}

if ( bimber_can_use_plugin( 'search-everything/search-everything.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'search-everything.php' );
}

if ( bimber_can_use_plugin( 'mycred/mycred.php' ) ) {
	require_once( BIMBER_PLUGINS_DIR . 'mycred/mycred.php' );
}

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	if ( bimber_can_use_plugin( 'restrict-content-pro/restrict-content-pro.php' ) ) {
		require_once( BIMBER_PLUGINS_DIR . 'restrict-content-pro.php' );
	}
}

// Load without condition check, below files contain functions that have to be loaded even if plugin is not activated.
require_once( BIMBER_PLUGINS_DIR . 'mashsharer.php' );
require_once( BIMBER_PLUGINS_DIR . 'quick-adsense-reloaded.php' );

// Temporary measure before we handle new BP template.
/**
 * Force the BP template to legacy
 *
 * @param string $plugin			Plugin.
 * @param bool   $network_activation  Is Network.
 */
function bimber_force_bp_legacy_template( $plugin, $network_activation ) {
	if( 'buddypress/bp-loader.php' !== $plugin ) {
		return;
	}
	update_blog_option( bp_get_root_blog_id(), '_bp_theme_package_id', 'legacy' );
}
add_action( 'activated_plugin', 'bimber_force_bp_legacy_template', 10, 2 );
