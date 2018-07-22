<?php
/**
 * The Header for our theme.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?><!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie10 lt-ie9" id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10" id="ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]><!-->
<html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php do_action( 'bimber_body_start' ); ?>

<div class="g1-body-inner">

	<div id="page">
		<?php get_template_part( 'template-parts/sharebar' ); ?>

		<?php
		if ( apply_filters( 'bimber_show_ad_before_header_theme_area', true ) ) :
			get_template_part( 'template-parts/ads/ad-before-header-theme-area' );
		endif;
		?>

		<?php
		if ( bimber_show_global_featured_entries() && bimber_get_theme_option( 'featured_entries', 'above_header' ) ) :
			get_template_part( 'template-parts/collection-featured' );
		endif;
		?>

		<?php
		get_template_part( 'template-parts/header-builder/index' );
		?>

		<?php
		if ( bimber_show_global_featured_entries() && ! bimber_get_theme_option( 'featured_entries', 'above_header' ) ) :
			get_template_part( 'template-parts/collection-featured' );
		endif;
		?>

		<?php do_action( 'bimber_before_content_theme_area' ); ?>

		<?php get_template_part( 'template-parts/ads/ad-before-content-theme-area' );
