<?php
/**
 * Class for setting up demo data
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

if ( ! class_exists( 'Bimber_Demo_Data' ) ) {
	/**
	 * Class Bimber_Demo_Data
	 */
	class Bimber_Demo_Data {

		const DEFAULT_DEMO = 'original';

		/**
		 * Demo id
		 *
		 * @var string
		 */
		private $demo;

		/**
		 * Bimber_Demo_Data constructor.
		 *
		 * @param null $demo		Demo id.
		 */
		public function __construct( $demo = null ) {
			$this->demo = $demo ? $demo : self::DEFAULT_DEMO;
		}

		/**
		 * Import theme content, widgets and assigns menus
		 *
		 * @return array        Response: status, message
		 */
		public function import_content() {
			$this->update_image_sizes();

			require_once BIMBER_ADMIN_DIR . 'lib/class-bimber-import-export.php';

			$content_path = trailingslashit( get_template_directory() ) . 'dummy-data/' . $this->demo . '/dummy-data.xml';

			$importer_out = Bimber_Import_Export::import_content_from_file( $content_path, $this->demo );

			// Demo content imported successfully?
			if ( null !== $importer_out ) {
				$response = array(
					'status'  => 'success',
					'message' => $importer_out,
				);

				// Set up menus.
				$this->assign_menus();

				$this->set_up_menu_items();

				// Set up pages.
				$this->assign_pages();

				// Set up posts.
				$this->set_up_posts();

				// Import widgets.
				$widgets_path = trailingslashit( get_template_directory() ) . 'dummy-data/' . $this->demo . '/widgets.txt';

				Bimber_Import_Export::import_widgets_from_file( $widgets_path, $this->demo );

				do_action( 'bimber_after_import_content' );
			} else {
				$response = array(
					'status'  => 'error',
					'message' => esc_html__( 'Failed to import content', 'bimber' ),
				);
			}

			return $response;
		}

		/**
		 * Import theme options
		 *
		 * @return array            Response status and message
		 */
		public function import_theme_options() {

			require_once BIMBER_ADMIN_DIR . 'lib/class-bimber-import-export.php';

			$demo_options_path = trailingslashit( get_template_directory() ) . 'dummy-data/' . $this->demo . '/theme-options.txt';

			if ( Bimber_Import_Export::import_options_from_file( $demo_options_path ) ) {
				$response = array(
					'status'  => 'success',
					'message' => esc_html__( 'Theme options imported successfully.', 'bimber' ),
				);
			} else {
				$response = array(
					'status'  => 'error',
					'message' => esc_html__( 'Failed to import theme options', 'bimber' ),
				);
			}

			return $response;
		}

		/**
		 * Import theme options and content
		 *
		 * @return array        Response status and message
		 */
		public function import_all() {
			$theme_options_response = $this->import_theme_options();

			if ( 'error' === $theme_options_response['status'] ) {
				return $theme_options_response;
			}

			$content_response = $this->import_content();

			if ( 'error' === $content_response['status'] ) {
				return $content_response;
			}

			// If all goes well.
			$response = array(
				'status'  => 'success',
				'message' => esc_html__( 'Import completed successfully.', 'bimber' ),
			);

			return $response;
		}

		/**
		 * Update defined image sizes.
		 */
		protected function update_image_sizes() {
			if ( 'miami' === bimber_get_current_stack() ) {
				remove_image_size( 'bimber-grid-standard' );
				remove_image_size( 'bimber-grid-standard-2x' );

				add_image_size( 'bimber-grid-standard', 364, round( 364 * 3 / 4 ), true );
				add_image_size( 'bimber-grid-standard-2x', 364 * 2, round( 364 * 2 * 3 / 4 ), true );
			}
		}

		/**
		 * Assign menus to locations
		 */
		protected function assign_menus() {
			$menu_location = array(
				'bimber-demo-' . $this->demo . '-primary-menu'      => 'bimber_primary_nav',
				'bimber-demo-' . $this->demo . '-secondary-menu'    => 'bimber_secondary_nav',
				'bimber-demo-' . $this->demo . '-footer-menu'       => 'bimber_footer_nav',
			);

			$registered_locations = get_registered_nav_menus();
			$locations            = get_nav_menu_locations();

			foreach ( $menu_location as $menu => $location ) {
				if ( empty( $menu ) && isset( $locations[ $location ] ) ) {
					unset( $locations[ $location ] );
					continue;
				}

				$menu_obj = wp_get_nav_menu_object( $menu );

				if ( ! $menu_obj || is_wp_error( $menu_obj ) ) {
					continue;
				}

				if ( ! array_key_exists( $location, $registered_locations ) ) {
					continue;
				}

				$locations[ $location ] = $menu_obj->term_id;
			}

			set_theme_mod( 'nav_menu_locations', $locations );
		}

		protected function set_up_menu_items() {
			// Get all menu items with title "Home".
			$nav_items = get_posts( array(
				'title'             => 'Home',
				'post_type'         => 'nav_menu_item',
				'posts_per_page'    => -1
			) );

			foreach( $nav_items as $nav_item ) {
				$post_id = $nav_item->ID;

				$menu_item_url = get_post_meta( $post_id, '_menu_item_url', true );

				// Replace all urls that point to bringthepixel domain.
				if ( strpos( $menu_item_url, 'bringthepixel.com' ) ) {
					update_post_meta( $post_id, '_menu_item_url', home_url() );
				}
			}
		}

		/**
		 * Assign pages
		 */
		protected function assign_pages() {
			$slug_posts_page = array(
				'top-10'    => 'top_page',
				'hot'       => 'hot_page',
				'popular'   => 'popular_page',
				'trending'  => 'trending_page',
			);

			foreach ( $slug_posts_page as $slug => $posts_page ) {
				$page = get_page_by_path( $slug );

				if ( $page ) {
					bimber_set_theme_option( 'posts', $posts_page, $page->ID );
				}
			}
		}

		protected function set_up_posts() {
			// Set the "Hello World!" post to draft.
			$hello_world_post = get_page_by_path( 'hello-world', OBJECT, 'post' );

			if ( $hello_world_post ) {
				wp_update_post( array(
					'ID'            => $hello_world_post->ID,
					'post_status'   => 'draft',
				) );
			}
		}
	}
}
