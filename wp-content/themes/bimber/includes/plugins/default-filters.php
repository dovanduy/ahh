<?php
/**
 * Plugin hooks
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

/*
 * Snax.
 */

add_action( 'snax_setup_theme', 'bimber_snax_setup' );	// On plugin activation.

if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
	add_action( 'after_switch_theme',                   'bimber_snax_setup' ); // On theme activation.

	// It's not optimal way but it's the only one.
	// We can't hook into plugin activation because the hook process performs an instant redirect after it fires.
	// We can use recommended workaround (add_option()) but it's exaclty the same, in case of performance.
	add_action( 'admin_init',                           'bimber_snax_setup' ); // On plugin activation.

	add_filter( 'snax_get_collection_item_image_size',  'bimber_snax_get_collection_item_image_size' );
	//add_filter( 'bimber_use_sticky_header',             'bimber_snax_disable_sticky_header' );

	add_filter( 'bimber_show_prefooter',                'bimber_snax_hide_on_frontend_submission_page' );

	add_action( 'wp_loaded',                            'bimber_snax_setup_header_elements' );

	// Change the location on success submissions notes.
	remove_filter( 'the_content',                       'snax_item_prepend_notes' );
	add_action( 'bimber_before_content_theme_area',     'bimber_snax_item_render_notes' );
	remove_filter( 'the_content',                       'snax_post_prepend_notes' );
	add_action( 'bimber_before_content_theme_area',     'bimber_snax_post_render_notes' );

	//add_filter( 'quads_has_ad',                         'bimber_snax_hide_ad_before_content_theme_area', 10, 2 );
	//remove_action( 'snax_before_item_media',            'snax_item_render_notes' );
	//add_action( 'bimber_before_content_theme_area',     'snax_item_render_notes' );

	// Embed width.
	add_action( 'snax_before_card_media',               'snax_embed_change_content_width' );
	add_action( 'snax_after_card_media',                'snax_embed_revert_content_width' );

	add_filter( 'snax_capture_item_position_args',      'bimber_snax_capture_item_position_args' );
	add_filter( 'snax_widget_cta_options',              'bimber_snax_widget_cta_options' );
	add_action( 'snax_before_widget_cta_title',         'bimber_snax_before_widget_cta_title' );
	add_filter( 'snax_show_create_button', 				'bimber_snax_show_create_button' );

	// Custom post types: Quizzes, Polls.
	add_action( 'pre_get_posts',                        'bimber_snax_add_cpt_to_queries' );
	add_filter( 'get_previous_post_where',              'bimber_snax_add_cpt_to_next_prev_nav', 10, 5 );
	add_filter( 'get_next_post_where',                  'bimber_snax_add_cpt_to_next_prev_nav', 10, 5 );

	// Voting box.
	remove_action( 'snax_post_voting_box',              'snax_render_post_voting_box' );
	add_action( 'wp_loaded',                            'bimber_snax_apply_voting_box_order' );

	// SEO by Yoast title.
	add_filter( 'wpseo_opengraph_title',                'snax_replace_title_placeholder' );

	// Stop Snax from loading FB SDK, Bimber will do that if requested.
	remove_action( 'snax_enqueue_fb_sdk', 				'snax_enqueue_fb_sdk' );
	add_action( 'snax_enqueue_fb_sdk', 					'bimber_enqueue_fb_sdk', 100 );

	add_filter( 'bimber_vc_collection_params',			'snax_register_vc_format_filter' );
	add_filter( 'bimber_vc_featured_collection_params',	'snax_register_vc_format_filter' );

	add_filter( 'bimber_collection_shortcode_query_args',	'snax_apply_snax_format_query_filter' );
	add_filter( 'bimber_featured_posts_query_args',			'snax_apply_snax_format_query_filter' );

	add_filter( 'bimber_post_single_options_meta_box_post_type_list', 		'bimber_snax_add_quiz_to_single_options_meta_box' );
	add_filter( 'bimber_render_single_options_meta_box_template_section',	'bimber_snax_disallow_single_templates_for_quiz', 10, 2 );

	add_filter( 'bimber_wpp_query_post_types', 'bimber_snax_add_snax_post_types_to_popular_posts_query' );

	add_filter( 'single_template',		'snax_ignore_disable_default_featured_media',20, 1 );
	add_filter( 'the_content',			'bimber_snax_cut_embedly_scripts', 9999, 1);

	add_filter( 'bimber_get_post_gallery_media_count', 		'snax_get_post_gallery_media_count', 10, 2 );
	add_filter( 'bimber_get_post_format_for_icon',		 	'snax_force_gallery_format_icon', 10, 2 );

	add_action( 'loop_start',	'snax_force_disabled_featured_image_in_meta', 9999 );

	// the condition doesn't work inside the callback.
	if ( ! is_admin() ) {
		add_action( 'pre_get_posts', 'bimber_woocommerce_add_snax_items_to_search_results' );
	}

	// Auto load next post.
	add_action( 'wp_head', 	'bimber_snax_setup_auto_load' );
	add_filter( 'bimber_load_embeds_on_archives', 	'bimber_snax_block_embed_in_collection_for_cpt', 10,1 );

	add_filter( 'bimber_archive_filters', 'bimber_snax_add_most_voted_filter', 10, 1 );
	add_action( 'bimber_apply_archive_filter_most_upvotes', 'bimber_snax_apply_archive_filter_most_upvotes', 10, 1 );
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		add_action( 'bimber_after_stream_content', 'bimber_snax_add_meme_links_to_stream' );
	}

	add_filter( 'snax_show_item_share', 'bimber_snax_disable_itemshare_with_microshare', 10, 1 );

	add_action( 'wsl_render_auth_widget_end', 'bimber_snax_wpsl_gdpr' );
}


/*
 * What's Your Reaction?
 */

if ( bimber_can_use_plugin( 'whats-your-reaction/whats-your-reaction.php' ) ) {
	remove_filter( 'the_content',                   'wyr_load_post_voting_box' );
	add_action( 'wp_loaded',                        'bimber_wyr_apply_voting_box_order' );

	add_filter( 'bimber_show_reactions_in_header',  'bimber_wyr_show_reactions_in_header' );
	add_filter( 'bimber_show_entry_reactions',      		'bimber_wyr_show_entry_reactions' );
	add_filter( 'bimber_show_entry_reactions_single',      	'bimber_wyr_show_entry_reactions_single' );
}


/*
 * Wordpress Popular Posts.
 */

if ( bimber_can_use_plugin( 'wordpress-popular-posts/wordpress-popular-posts.php' ) ) {
	add_action( 'widgets_init', 'bimber_wpp_remove_widget' );
	add_filter( 'bimber_most_viewed_query_args', 'bimber_wpp_get_most_viewed_query_args', 10, 2 );
	add_filter( 'bimber_entry_view_count', 'bimber_wpp_get_view_count' );
	add_filter( 'bimber_after_single_content', 'bimber_wpp_render_nonce',9994 );

	add_filter( 'bimber_archive_filters', 'bimber_wpp_add_most_viewed_filter', 10, 1 );
	add_action( 'bimber_apply_archive_filter_most_views', 'bimber_wpp_apply_archive_filter_most_views', 10, 1 );
}

/*
 * Mashshare.
 */

// Only core loaded.
if ( bimber_can_use_plugin( 'mashsharer/mashshare.php' ) ) {
	add_action( 'bimber_render_top_share_buttons', 		'bimber_mashsharer_render_top_share_buttons' );
	add_action( 'bimber_render_bottom_share_buttons',	'bimber_mashsharer_render_bottom_share_buttons' );
	add_action( 'bimber_render_side_share_buttons', 	'bimber_mashsharer_render_side_share_buttons' );
	add_action( 'bimber_render_compact_share_buttons', 	'bimber_mashsharer_render_compact_share_buttons' );

	$mashsharer_execution_order = 1000;

	if ( function_exists( 'getExecutionOrder' ) ) {
		$mashsharer_execution_order = getExecutionOrder();
	}

	remove_filter( 'the_content', 'mashshare_filter_content', $mashsharer_execution_order, 1 );

	add_filter( 'bimber_most_shared_query_args',    'bimber_mashsharer_get_most_shared_query_args', 10, 2 );
	add_filter( 'bimber_entry_share_count',         'bimber_mashsharer_get_share_count' );
	add_filter( 'bimber_show_entry_share_count',    'bimber_mashsharer_show_share_count', 10, 2 );
	add_filter( 'mashsb_opengraph_meta' , 'bimber_mashsharer_fix_empty_og_description' );
	add_action( 'bimber_after_import_content',      'bimber_mashsharer_set_defaults' );

	add_filter( 'mashsb_opengraph_meta', 'bimber_mashsharer_gif_opengraph' ,100,1 );

	// Custom caching rules to not refresh counters on archives.
	// Curl requests coast too much, so reload cache only on a single page.
	if ( ! is_admin() ) {
		add_action( 'init',         'bimber_mashsharer_init_custom_caching_rules' );
		add_filter( 'the_content',  'bimber_mashsharer_activate_curl', 1 );
		add_filter( 'the_content',  'bimber_mashsharer_deactivate_curl', 9999 );
	}

	add_filter( 'bimber_archive_filters', 'bimber_mashsharer_add_most_shares_filter', 10, 1 );
	add_action( 'bimber_apply_archive_filter_most_shares', 'bimber_mashsharer_apply_archive_filter_most_shares', 10, 1 );
}

// Core loaded but not Networks addon.
if ( bimber_can_use_plugin( 'mashsharer/mashshare.php' ) && ! bimber_can_use_plugin( 'mashshare-networks/mashshare-networks.php' ) ) {
	add_filter( 'mashsb_array_networks',    'bimber_mashsharer_array_networks' );
	add_action( 'init',                     'bimber_mashsharer_register_new_networks' );
	add_action( 'plugins_loaded',           'bimber_mashsharer_add_networks_class' );
}

// Core and Networks addon loaded.
if ( bimber_can_use_plugin( 'mashsharer/mashshare.php' ) && bimber_can_use_plugin( 'mashshare-networks/mashshare-networks.php' ) ) {
	add_action( 'init', 'bimber_mashsharer_deregister_new_networks' );
}

// Core and ShareBar addon loaded.
if ( bimber_can_use_plugin( 'mashsharer/mashshare.php' ) && bimber_can_use_plugin( 'mashshare-sharebar/mashshare-sharebar.php' ) ) {
	// Disable our built-in bar.
	add_filter( 'bimber_show_sharebar', '__return_false', 99 );
}


/*
 * Mailchimp for WP.
 */

if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
	add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
	add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
	add_filter( 'mc4wp_form_after_fields', 'bimber_mc4wp_form_after_form', 10, 2 );
	add_action( 'bimber_after_import_content', 'bimber_mc4wp_set_up_default_form_id' );
}


/*
 * WP QUADS - Quick AdSense Reloaded.
 */

if ( bimber_can_use_plugin( 'quick-adsense-reloaded/quick-adsense-reloaded.php' ) ) {
	add_action( 'after_setup_theme', 'bimber_quads_register_ad_locations' );
	add_filter( 'quads_has_ad', 'bimber_quads_hide_ads', 10, 2 );
	remove_action('admin_print_footer_scripts', 'quads_check_ad_blocker');
}


/*
 * Loco Translate.
 */

if ( bimber_can_use_plugin( 'loco-translate/loco.php' ) ) {
	add_action( 'admin_notices', 'bimber_loco_notices' );
	add_action( 'admin_enqueue_scripts', 'bimber_logo_admin_enqueue_scripts' );
}


/*
 * bbPress.
 */

if ( bimber_can_use_plugin( 'bbpress/bbpress.php' ) ) {
	add_filter( 'bimber_setup_sidebars',	'bimber_bbpress_setup_sidebars' );
	add_filter( 'bimber_sidebar',			'bimber_bbpress_sidebar' );
	add_filter( 'get_the_excerpt',          'bimber_bbpress_remove_snax_content', 16 );
	add_filter( 'bbp_default_styles',		'bimber_disable_bbp_default_styles', 10, 1 );
}


/*
 * Auto Load Next Post.
 */

if ( bimber_can_use_plugin( 'auto-load-next-post/auto-load-next-post.php' ) ) {
	// Disable plugin's partial location function that doesn't support child themes.
	remove_action( 'template_redirect', 'auto_load_next_post_template_redirect' );

	// Use custom function with child theme support (till plugin doesn't fix it).
	add_action( 'template_redirect', 'bimber_auto_load_next_post_template_redirect' );

	add_filter( 'auto_load_next_post_general_settings', 'bimber_auto_load_next_post_general_settings' );

	// Return values valid for the theme.
	add_filter( 'pre_option_auto_load_next_post_content_container', 	'bimber_auto_load_next_post_content_container' );
	add_filter( 'pre_option_auto_load_next_post_title_selector', 		'bimber_auto_load_next_post_title_selector' );
	add_filter( 'pre_option_auto_load_next_post_navigation_container', 	'bimber_auto_load_next_post_navigation_container' );
	add_filter( 'pre_option_auto_load_next_post_comments_container',	'bimber_auto_load_next_post_comments_container' );
}

/*
 * Easy Google Fonts.
 */
if ( bimber_can_use_plugin( 'easy-google-fonts/easy-google-fonts.php' ) ) {
	add_filter( 'tt_font_get_option_parameters',    'bimber_egf_register_theme_font_options' );
	add_filter( 'tt_font_get_settings_page_tabs',   'bimber_egf_disable_default_typography_tab' );
}

/*
 * WPML.
 */
if ( bimber_can_use_plugin( 'sitepress-multilingual-cms/sitepress.php' ) ) {
	add_filter( 'bimber_hot_page_id', 			'bimber_wpml_translate_page_id' );
	add_filter( 'bimber_popular_page_id', 		'bimber_wpml_translate_page_id' );
	add_filter( 'bimber_trending_page_id', 		'bimber_wpml_translate_page_id' );
	add_filter( 'bimber_top_page_id', 			'bimber_wpml_translate_page_id' );
	add_filter( 'bimber_breadcrumb_page_id',	'bimber_wpml_translate_page_id' );

	add_action( 'bimber_wpml_add_language_selector', 'bimber_wpml_add_canvas_switcher' );
}

/*
 * Facebook Comments.
 */
if ( bimber_can_use_plugin( 'facebook-comments-plugin/facebook-comments.php' ) ) {
	// Disable plugin default location.
	remove_filter( 'the_content', 'fbcommentbox', 100 );
	remove_action( 'wp_footer', 'fbmlsetup', 100 );

	// Render it again.
	add_action( 'bimber_after_comments', 'bimber_render_facebook_comments', 100 );

	// Ajax.
	add_action( 'wp_ajax_bimber_update_fb_comment_count', 			'bimber_ajax_update_fb_comment_count' );
	add_action( 'wp_ajax_nopriv_bimber_update_fb_comment_count',	'bimber_ajax_update_fb_comment_count' );
	add_action( 'wp_ajax_bimber_load_fbcommentbox', 				'bimber_ajax_load_fbcommentbox' );
	add_action( 'wp_ajax_nopriv_bimber_load_fbcommentbox',			'bimber_ajax_load_fbcommentbox' );

	// Reister new comment type.
	add_filter( 'bimber_comment_types', 'bimber_fb_register_comment_type', 12 );

	// Add Facebook comments to post's global comments counter.
	add_filter( 'get_comments_number', 'bimber_add_fb_comments_number');

	// Subtract Facebook comments from WP type comments number.
	add_filter( 'bimber_wp_comment_count', 'bimber_fb_subtract_comments_number' );

	// Use the App Id in SDK url.
	add_filter( 'bimber_facebook_sdk_config', 'bimber_fb_override_sdk_config' );

	add_filter( 'bimber_post_hide_elements_choices', 'bimber_allow_to_disable_wp_comment_type' );
}

/*
 * WooCommerce
 *
 */

if ( bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ) {
	add_action( 'pre_get_posts', 'bimber_woocommerce_add_products_to_search_results' );
	add_action( 'bimber_after_import_content', 'bimber_woocommerce_set_up_shop_page' );
}

/**
 * Disable plugin welcome redirects.
 *
 * We use TGM Plugin Activation to install some plugins.
 * We must be sure there are no redirects during the activation queue.
 */

add_action( 'after_setup_theme', 'bimber_disable_plugin_welcome_redirects' );

function bimber_disable_plugin_welcome_redirects() {
	if ( get_transient( '_bimber_demo_import_started' ) ) {
		delete_transient( 'quads_activation_redirect' );
		delete_transient( '_mashsb_activation_redirect' );
		delete_transient( '_vc_page_welcome_redirect' );
		add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true',99 );
	}
}

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	// G1 Socials features.
	add_filter( 'g1_socials_support_youtube', '__return_true' );
	add_filter( 'g1_socials_support_instagram', '__return_true' );
	// AdAce features.
	add_filter( 'adace_support_patreon', '__return_true' );
	add_filter( 'adace_support_coupons', '__return_true' );
}
add_filter( 'adace_support_sponsor', '__return_true' );
