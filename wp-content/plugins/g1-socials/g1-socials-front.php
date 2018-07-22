<?php
// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

if ( ! class_exists( 'G1_Socials_Front' ) ):

    class G1_Socials_Front {

        /**
         * The object instance
         *
         * @var G1_Socials_Front
         */
        private static $instance;

        /**
         * Return the only existing instance of the object
         *
         * @return G1_Socials_Front
         */
        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new G1_Socials_Front();
            }

            return self::$instance;
        }

        private function __construct() {
            $this->setup_hooks();
        }

        public function setup_hooks() {
            add_action( 'wp_footer', array( $this, 'enqueue_styles' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        }

        public function enqueue_styles() {
            $url = trailingslashit( $this->get_plugin_object()->get_plugin_dir_url() );
            $version = $this->get_plugin_object()->get_version();
            $case = apply_filters( 'g1_socials_enqueue_styles', 'all' );
            switch ( $case ) {
                /**
                 * The Font Awesome is already loaded by a theme or a plugin,
                 * so we need to load only plugin specific CSS files
                 */
                case 'basic' :
                    wp_enqueue_style( 'g1-socials-basic-screen', $url . 'css/screen-basic.min.css', array(), $version, 'screen' );
                    break;

                /**
                 * Load all resources
                 */
                case 'all' :
                default :
                    wp_enqueue_style( 'font-awesome',               $url . 'css/font-awesome/css/font-awesome.min.css' );
                    wp_enqueue_style( 'g1-socials-basic-screen',    $url . 'css/screen-basic.min.css', array(), $version, 'screen' );

                    break;
            }

			if ( apply_filters( 'g1_socials_support_snapchat', true ) ) {
				wp_enqueue_style( 'g1-socials-snapcode',    $url . 'css/snapcode.min.css', array(), $version, 'screen' );
			}
        }

        public function enqueue_scripts( $hook ) {
        }

        private function get_plugin_object () {
            return G1_Socials();
        }
    }
endif;

if ( ! function_exists( 'G1_Socials_Front' ) ) :

    function G1_Socials_Front() {
        return G1_Socials_Front::get_instance();
    }

endif;

G1_Socials_Front();


/**
 * Load AMP (Accelerated Mobile Pages) CSS
 */
function g1_socials_amp_load_css() {
	$css = '';
	$css .= file_get_contents( esc_url( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'css/screen-basic.min.css' ) );
	echo( $css );
}
