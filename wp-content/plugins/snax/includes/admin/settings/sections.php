<?php
/**
 * Snax Settings Sections
 *
 * @package snax
 * @subpackage Settings
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}


/**
 * Get the main settings sections.
 *
 * @return array
 */
function snax_admin_get_settings_sections() {
	return (array) apply_filters( 'snax_admin_get_settings_sections', array(
		'snax_settings_general' => array(
			'title'    => __( 'Frontend Submission', 'snax' ),
			'callback' => 'snax_admin_settings_general_section_description',
			'page'      => 'snax-general-settings',
		),
		'snax_settings_lists' => array(
			'title'    => __( 'Lists', 'snax' ),
			'callback' => 'snax_admin_settings_lists_section_description',
			'page'      => 'snax-lists-settings',
		),
		'snax_settings_pages' => array(
			'title'    => __( 'Pages', 'snax' ),
			'callback' => 'snax_admin_settings_pages_section_description',
			'page'      => 'snax-pages-settings',
		),
		'snax_settings_voting' => array(
			'title'    => __( 'Voting', 'snax' ),
			'callback' => 'snax_admin_settings_voting_section_description',
			'page'      => 'snax-voting-settings',
		),
		'snax_settings_limits' => array(
			'title'    => __( 'General', 'snax' ),
			'callback' => 'snax_admin_settings_limits_section_description',
			'page'      => 'snax-limits-settings',
		),
		'snax_settings_auth' => array(
			'title'    => __( 'Auth', 'snax' ),
			'callback' => 'snax_admin_settings_auth_section_description',
			'page'      => 'snax-auth-settings',
		),
		'snax_settings_demo' => array(
			'title'    => __( 'Demo', 'snax' ),
			'callback' => 'snax_admin_settings_demo_section_description',
			'page'      => 'snax-demo-settings',
		),
		'snax_settings_embedly' => array(
			'title'    => __( 'Embedly', 'snax' ),
			'callback' => 'snax_admin_settings_embedly_section_description',
			'page'      => 'snax-embedly-settings',
		),
		'snax_settings_memes' => array(
			'title'    => __( 'Memes', 'snax' ),
			'callback' => 'snax_admin_settings_memes_section_description',
			'page'      => 'snax-memes-settings',
		),
		'snax_permalinks' => array(
			'title'    => _x( 'Snax', 'Permalink Settings', 'snax' ),
			'callback' => 'snax_permalinks_section_description',
			'page'      => 'permalink',
		),
	) );
}

/**
 * Get all of the settings fields.
 *
 * @return array
 */
function snax_admin_get_settings_fields() {
	return (array) apply_filters( 'snax_admin_get_settings_fields', array(

		/** General Section **************************************************** */

		'snax_settings_general' => array(
			'snax_active_formats' => array(
				'title'             => __( 'Active formats', 'snax' ) . '<br /><span style="font-weight: normal;">' . __( '(drag to reorder)', 'snax' ) . '</span>',
				'callback'          => 'snax_admin_setting_callback_active_formats',
				'sanitize_callback' => 'snax_sanitize_text_array',
				'args'              => array(),
			),
			'snax_formats_order' => array(
				'sanitize_callback' => 'sanitize_text_field',
			),
			'snax_featured_media_required' => array(
				'title'             => __( 'Featured image field', 'snax' ),
				'callback'          => 'snax_admin_setting_featured_media_required',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_category_required' => array(
				'title'             => __( 'Category field', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_category_required',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_category_multi' => array(
				'title'             => __( 'Multiple categories selection?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_category_multi',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_category_whitelist' => array(
				'title'             => __( 'Category whitelist', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_category_whitelist',
				'sanitize_callback' => 'snax_sanitize_category_whitelist',
				'args'              => array(),
			),
			'snax_category_auto_assign' => array(
				'title'             => __( 'Auto assign to categories', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_category_auto_assign',
				'sanitize_callback' => 'snax_sanitize_category_whitelist',
				'args'              => array(),
			),
			'snax_allow_snax_authors_to_add_referrals' => array(
				'title'             => __( 'Referral link field ', 'snax' ),
				'callback'          => 'snax_admin_setting_allow_snax_authors_to_add_referrals',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_froala_for_items' => array(
				'title'             => __( 'Allow rich editor for items in Frontend Submission', 'snax' ),
				'callback'          => 'snax_admin_setting_froala_for_items',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_froala_for_list_items' => array(
				'title'             => __( 'Allow rich editor for items in open lists', 'snax' ),
				'callback'          => 'snax_admin_setting_froala_for_list_items',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_single_post_page_header' => array(
				'title'             => '<h2>' . __( 'Single Post Page', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_show_featured_images_for_formats' => array(
				'title'             => __( 'Show featured images for single:', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_show_featured_images_for_formats',
				'sanitize_callback' => 'snax_sanitize_text_array',
				'args'              => array(),
			),
			'snax_display_comments_on_lists' => array(
				'title'             => __( 'Display items comments on list view ', 'snax' ),
				'callback'          => 'snax_admin_setting_display_comments_on_lists',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_show_origin' => array(
				'title'             => __( 'Show the "This post was created with our nice and easy submission form." text', 'snax' ),
				'callback'          => 'snax_admin_setting_show_origin',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_misc_header' => array(
				'title'             => '<h2>' . __( 'Misc', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_show_item_count_in_title' => array(
				'title'             => __( 'Show items count in title', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_item_count_in_title',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_disable_admin_bar' => array(
				'title'             => __( 'Disable admin bar for non-administrators', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_disable_admin_bar',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_disable_dashboard_access' => array(
				'title'             => __( 'Disable Dashboard access for non-administrators', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_disable_dashboard_access',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_disable_wp_login' => array(
				'title'             => __( 'Disable WP login form', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_disable_wp_login',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_enable_login_popup' => array(
				'title'             => __( 'Enbable the login popup ', 'snax' ),
				'callback'          => 'snax_admin_setting_enable_login_popup',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_skip_verification' => array(
				'title'             => __( 'Moderate new posts?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_skip_verification',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_mail_notifications' => array(
				'title'             => __( 'Send mail to admin when new post/item was added?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_mail_notifications',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
		),

		/** Lists Section ****************************************************** */

		'snax_settings_lists' => array(
			'snax_active_item_forms' => array(
				'title'             => __( 'Item forms', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_active_item_forms',
				'sanitize_callback' => 'snax_sanitize_text_array',
				'args'              => array(),
			),
			'snax_show_open_list_in_title' => array(
				'title'             => __( 'Show list status in title', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_list_status_in_title',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
		),

		/** Pages Section ***************************************************** */

		'snax_settings_pages' => array(
			// Frontend Submission.
			'snax_frontend_submission_page_id' => array(
				'title'             => __( 'Frontend Submission', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_frontend_submission_page',
				'sanitize_callback' => 'snax_sanitize_published_post',
				'args'              => array(),
			),
			// Terms & Conditions.
			'snax_legal_page_id' => array(
				'title'             => __( 'Terms and Conditions', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_legal_page',
				'sanitize_callback' => 'snax_sanitize_published_post',
				'args'              => array(),
			),
			// Report.
			'snax_report_page_id' => array(
				'title'             => __( 'Report', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_report_page',
				'sanitize_callback' => 'snax_sanitize_published_post',
				'args'              => array(),
			),
		),

		/** Voting Section **************************************************** */

		'snax_settings_voting' => array(
			'snax_voting_is_enabled' => array(
				'title'             => __( 'Enable voting?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_voting_enabled',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_guest_voting_is_enabled' => array(
				'title'             => __( 'Guests can vote?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_guest_voting_enabled',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_voting_post_types' => array(
				'title'             => __( 'Allow users to vote on post types', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_voting_post_types',
				'sanitize_callback' => 'snax_sanitize_text_array',
				'args'              => array(),
			),
			'snax_fake_vote_count_base' => array(
				'title'             => __( 'Fake vote count base', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_fake_vote_count_base',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
		),

		/** Limits Section **************************************************** */

		'snax_settings_limits' => array(

			/* IMAGES UPLOAD */

			'snax_limits_image_header' => array(
				'title'             => '<h2>' . __( 'Image upload', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_image_upload_allowed' => array(
				'title'             => __( 'Allowed?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_allowed',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array( 'type' => 'image' ),
			),
			'snax_max_upload_size' => array(
				'title'             => __( 'Maximum file size', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_max_size',
				'sanitize_callback' => 'intval',
				'args'              => array( 'type' => 'image' ),
			),
			'snax_image_allowed_types' => array(
				'title'             => __( 'Allowed types', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_allowed_types',
				'sanitize_callback' => 'snax_sanitize_text_array',
				'args'              => array( 'type' => 'image' ),
			),

			/* AUDIO UPLOAD */

			'snax_limits_audio_header' => array(
				'title'             => '<h2>' . __( 'Audio upload', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_audio_upload_allowed' => array(
				'title'             => __( 'Allowed?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_allowed',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array( 'type' => 'audio' ),
			),
			'snax_audio_max_upload_size' => array(
				'title'             => __( 'Maximum file size', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_max_size',
				'sanitize_callback' => 'intval',
				'args'              => array( 'type' => 'audio' ),
			),
			'snax_audio_allowed_types' => array(
				'title'             => __( 'Allowed types', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_allowed_types',
				'sanitize_callback' => 'snax_sanitize_text_array',
				'args'              => array( 'type' => 'audio' ),
			),

			/* VIDEO UPLOAD */

			'snax_limits_video_header' => array(
				'title'             => '<h2>' . __( 'Video upload', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_video_upload_allowed' => array(
				'title'             => __( 'Allowed?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_allowed',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array( 'type' => 'video' ),
			),
			'snax_video_max_upload_size' => array(
				'title'             => __( 'Maximum file size', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_max_size',
				'sanitize_callback' => 'intval',
				'args'              => array( 'type' => 'video' ),
			),
			'snax_video_allowed_types' => array(
				'title'             => __( 'Allowed types', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_upload_allowed_types',
				'sanitize_callback' => 'snax_sanitize_text_array',
				'args'              => array( 'type' => 'video' ),
			),

			/* POSTS */

			'snax_limits_posts_header' => array(
				'title'             => '<h2>' . __( 'Posts', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_items_per_page' => array(
				'title'             => __( 'List items per page', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_items_per_page',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_user_posts_per_day' => array(
				'title'             => __( 'User can submit', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_new_posts_limit',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_new_post_items_limit' => array(
				'title'             => __( 'User can submit', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_new_post_items_limit',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_user_submission_limit' => array(
				'title'             => __( 'User can submit', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_user_submission_limit',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_tags_limit' => array(
				'title'             => __( 'Tags', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_tags_limit',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_post_title_max_length' => array(
				'title'             => __( 'Title length', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_post_title_max_length',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_post_description_max_length' => array(
				'title'             => __( 'Description length', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_post_description_max_length',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_post_content_max_length' => array(
				'title'             => __( 'Content length', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_post_content_max_length',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),

			/* ITEMS */

			'snax_limits_items_header' => array(
				'title'             => '<h2>' . __( 'Items', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_item_title_max_length' => array(
				'title'             => __( 'Title length', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_item_title_max_length',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_item_content_max_length' => array(
				'title'             => __( 'Description length', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_item_content_max_length',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_item_source_max_length' => array(
				'title'             => __( 'Source length', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_item_source_max_length',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_item_ref_link_max_length' => array(
				'title'             => __( 'Referral link length', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_item_ref_link_max_length',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),

			/* POLLS */

			'snax_limits_polls_header' => array(
				'title'             => '<h2>' . __( 'Polls', 'snax' ) . '</h2>',
				'callback'          => '__return_empty_string',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_limits_poll_vote_limit' => array(
				'title'             => __( 'Votes per user', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_limits_poll_vote_limit',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
		),
		/** Auth Section ***************************************************** */

		'snax_settings_auth' => array(
			'snax_facebook_app_id' => array(
				'title'             => __( 'Facebook App ID', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_facebook_app_id',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_login_recaptcha' => array(
				'title'             => __( 'reCaptcha for login form', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_login_recaptcha',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_recaptcha_site_key' => array(
				'title'             => __( 'reCaptcha Site Key', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_recaptcha_site_key',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_recaptcha_secret' => array(
				'title'             => __( 'reCaptcha Secret', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_recaptcha_secret',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
		),

		/** Demo Section ***************************************************** */

		'snax_settings_demo' => array(
			'snax_demo_mode' => array(
				'title'             => __( 'Enable demo mode?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_demo_mode',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_demo_image_post_id' => array(
				'title'             => __( 'Image', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_demo_post',
				'sanitize_callback' => 'intval',
				'args'              => array( 'format' => 'image' ),
			),
			'snax_demo_gallery_post_id' => array(
				'title'             => __( 'Gallery', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_demo_post',
				'sanitize_callback' => 'intval',
				'args'              => array( 'format' => 'gallery' ),
			),
			'snax_demo_embed_post_id' => array(
				'title'             => __( 'Embed', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_demo_post',
				'sanitize_callback' => 'intval',
				'args'              => array( 'format' => 'embed' ),
			),
			'snax_demo_list_post_id' => array(
				'title'             => __( 'List', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_demo_post',
				'sanitize_callback' => 'intval',
				'args'              => array( 'format' => 'list' ),
			),
			'snax_demo_meme_post_id' => array(
				'title'             => __( 'Meme', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_demo_post',
				'sanitize_callback' => 'intval',
				'args'              => array( 'format' => 'meme' ),
			),
		),

		/** Embedly Section ********************************************** */

		'snax_settings_embedly' => array(
			'snax_embedly_enable' => array(
				'title'             => __( 'Enable Embedly support?', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_embedly_enable',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_embedly_dark_skin' => array(
				'title'             => __( 'Dark skin', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_embedly_dark_skin',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_embedly_buttons' => array(
				'title'             => __( 'Share buttons', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_embedly_buttons',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_embedly_width' => array(
				'title'             => __( 'Width', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_embedly_width',
				'sanitize_callback' => 'intval',
				'args'              => array(),
			),
			'snax_embedly_alignment' => array(
				'title'             => __( 'Alignment', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_embedly_alignment',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_embedly_api_key' => array(
				'title'             => __( 'Embedly cards API key', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_embedly_api_key',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
		),
		/** Memes Section ********************************************** */

		'snax_settings_memes' => array(
			'snax_memes_recaption_enable' => array(
				'title'             => __( 'Enable "Recaption this meme" button', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_memes_recaption_enable',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
			'snax_memes_content_enable' => array(
				'title'             => __( 'Enable post content field', 'snax' ),
				'callback'          => 'snax_admin_setting_callback_memes_content_enable',
				'sanitize_callback' => 'sanitize_text_field',
				'args'              => array(),
			),
		),
		/** Permalinks Section ********************************************** */

		'snax_permalinks' => array(
			'snax_item_slug' => array(
				'title'             => __( 'Item url', 'snax' ),
				'callback'          => 'snax_permalink_callback_item_slug',
				'sanitize_callback' => 'sanitize_text',
				'args'              => array(),
			),
			'snax_url_var_prefix' => array(
				'title'             => __( 'URL variable', 'snax' ),
				'callback'          => 'snax_permalink_callback_url_var_prefix',
				'sanitize_callback' => 'sanitize_text',
				'args'              => array(),
			),
		),
	) );
}


/**
 * Get settings fields by section.
 *
 * @param string $section_id    Section id.
 *
 * @return mixed                False if section is invalid, array of fields otherwise.
 */
function snax_admin_get_settings_fields_for_section( $section_id = '' ) {

	// Bail if section is empty.
	if ( empty( $section_id ) ) {
		return false;
	}

	$fields = snax_admin_get_settings_fields();
	$retval = isset( $fields[ $section_id ] ) ? $fields[ $section_id ] : false;

	return (array) apply_filters( 'snax_admin_get_settings_fields_for_section', $retval, $section_id );
}
