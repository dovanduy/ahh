<?php
/**
 * Admin hooks
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

// Post.
add_filter( 'manage_posts_columns',         'bimber_post_list_add_id_column' );
add_action( 'manage_posts_custom_column',   'bimber_post_list_render_id_column' );
add_filter( 'manage_posts_columns',         'bimber_post_list_custom_columns' );
add_action( 'manage_posts_custom_column',   'bimber_post_list_custom_columns_data', 10, 2 );
add_action( 'admin_head', 					'bimber_post_list_styles' );

// Category.
add_action( 'category_edit_form_fields', 	'bimber_category_add_custom_fields', 10, 2 );
add_action( 'edited_category', 				'bimber_category_save_custom_fields' );

// Tag.
add_action( 'post_tag_edit_form_fields', 	'bimber_post_tag_add_custom_fields', 10, 2 );
add_action( 'edited_post_tag', 				'bimber_post_tag_save_custom_fields' );

// Enqueue assets.
add_action( 'admin_enqueue_scripts', 'bimber_admin_enqueue_styles' );
add_action( 'admin_enqueue_scripts', 'bimber_admin_enqueue_scripts' );

// Ajax.
add_action( 'wp_ajax_bimber_demo_import_started',   'bimber_ajax_demo_import_started' );
add_action( 'wp_ajax_bimber_demo_import_ended',     'bimber_ajax_demo_import_ended' );

// Theme Activation.
add_action( 'after_switch_theme',                   'bimber_redirect_after_activation' );
add_action( 'after_switch_theme',                   'bimber_reset_tgm_notices' );

// TGM.
add_action( 'tgmpa_register', 'bimber_register_required_plugins' );

// Dynamic style cache.
add_action( 'customize_save', 'bimber_dynamic_style_mark_cache_as_stale' );
add_action( 'update_option_' . bimber_get_theme_options_id(), 'bimber_dynamic_style_theme_option_changed', 999, 2 );

// Styles.
add_action( 'admin_init', 'bimber_add_editor_styles' );

// Demo content.
add_action( 'admin_init',                              'bimber_handle_import_action' );
add_action( 'init',                                    'bimber_flush_rewrite_rules_after_demo_import' );

// Admin actions.
add_action( 'admin_action_bimber_import_demo',              'bimber_import_demo' );
add_action( 'admin_action_bimber_import_demo_image',        'bimber_import_demo_image' );
add_action( 'admin_action_bimber_import_demo_images_start', 'bimber_import_demo_images_start' );
add_action( 'admin_action_bimber_import_demo_images_end',   'bimber_import_demo_images_end' );

// Cache.
add_action( 'save_post',        'bimber_delete_transients' );   // Fires once a post has been saved.
add_action( 'deleted_post',     'bimber_delete_transients' );   // Fires immediately after a post is deleted from the database.
add_action( 'switch_theme',     'bimber_delete_transients' );   // Fires once user activate/deactivate the theme.
add_action( 'customize_save', 	'bimber_delete_transients' );	// Fires once settings are published in WP Customizer.

// About.
add_action( 'admin_menu', 'bimber_register_about_page' );

// Appearances > Editor.
add_filter( 'wp_theme_editor_filetypes', 'bimber_allow_editing_child_theme_js_files', 10, 2 );

// Metaboxes.
add_action( 'add_meta_boxes',       'bimber_add_fake_views_metabox', 10 ,2 );
add_action( 'save_post',            'bimber_save_fake_views_metabox' );

// Menus.
add_filter( 'wp_edit_nav_menu_walker',  'bimber_wp_edit_nav_menu_walker', 10, 2 );
add_action( 'wp_update_nav_menu_item',  'bimber_wp_update_nav_menu_item', 10, 3 );
add_filter( 'wp_setup_nav_menu_item',   'bimber_wp_setup_nav_menu_item' );

