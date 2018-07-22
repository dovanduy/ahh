<?php
require_once( BIMBER_FRONT_DIR . 'lib/class-bimber-color.php' );

$bimber_skin = bimber_get_theme_option( 'global', 'skin' );
?>


<?php
if ( 'bunchy' === bimber_get_current_stack() ) {
	$bimber_font_dir_uri = trailingslashit( get_template_directory_uri() ) . 'css/' . bimber_get_css_theme_ver_directory() . '/bunchy/fonts/';
} else {
	$bimber_font_dir_uri = trailingslashit( get_template_directory_uri() ) . 'css/' . bimber_get_css_theme_ver_directory() . '/bimber/fonts/';
}
?>
@font-face {
	font-family: "bimber";
	src:url("<?php echo $bimber_font_dir_uri; ?>bimber.eot");
	src:url("<?php echo $bimber_font_dir_uri; ?>bimber.eot?#iefix") format("embedded-opentype"),
	url("<?php echo $bimber_font_dir_uri; ?>bimber.woff") format("woff"),
	url("<?php echo $bimber_font_dir_uri; ?>bimber.ttf") format("truetype"),
	url("<?php echo $bimber_font_dir_uri; ?>bimber.svg#bimber") format("svg");
	font-weight: normal;
	font-style: normal;
}

<?php
// @todo Maybe we shouldn't include it like this:
include( trailingslashit( get_template_directory() ) . '/css/' . bimber_get_css_theme_ver_directory() . '/styles' . '/' . bimber_get_current_stack() . '/amp-'. $bimber_skin .'.min.css');
?>


.amp-wp-iframe-placeholder {
	background-image: url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> );
}


<?php
$bimber_cs_1_accent1                = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_1_accent1' ) );
$bimber_cs_2_text1                  = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_2_text1' ) );
$bimber_cs_2_background             = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_2_background_color' ) );
?>
a {color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_1_accent1->get_hex() ); ?>;}

.g1-nav-single-prev > a > span:before,
.g1-nav-single-next > a > span:after,
.mashsb-count {
color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_1_accent1->get_hex() ); ?>;
}



.g1-button-solid,
.g1-arrow-solid {
border-color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_2_background->get_hex() ); ?>;
background-color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_2_background->get_hex() ); ?>;
color:#<?php echo sanitize_hex_color_no_hash( $bimber_cs_2_text1->get_hex() ); ?>;
}





<?php
$bimber_header_text       = new Bimber_Color( bimber_get_theme_option( 'header', 'text_color' ) );
$bimber_header_accent     = new Bimber_Color( bimber_get_theme_option( 'header', 'accent_color' ) );

$bimber_header_bg1        = new Bimber_Color( bimber_get_theme_option( 'header', 'background_color' ) );
$bimber_header_bg2 = bimber_get_theme_option( 'header', 'bg2_color' );
$bimber_header_bg2 = strlen( $bimber_header_bg2 ) ? new Bimber_Color( $bimber_header_bg2 ) : $bimber_header_bg1;

$bimber_logo = bimber_get_logo();
?>
.g1-header > .g1-row-background {
	background-color:#<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() )?>;
<?php if ( $bimber_header_bg1->get_hex() !== $bimber_header_bg2->get_hex() ) : ?>
	background-image: -webkit-linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
	background-image:    -moz-linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
	background-image:      -o-linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
	background-image:         linear-gradient(to right, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg1->get_hex() ); ?>, #<?php echo sanitize_hex_color_no_hash( $bimber_header_bg2->get_hex() ); ?>);
<?php endif; ?>
}
.g1-header .g1-hamburger {color: #<?php echo sanitize_hex_color_no_hash( $bimber_header_text->get_hex() ); ?>;}
<?php if ( isset( $bimber_logo['width'] ) ) :?>
.g1-header .g1-logo {max-width:<?php echo absint( $bimber_logo['width'] ); ?>px;}
<?php endif;?>





<?php
$bimber_bg1_color = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_1_background_color' ) );
?>

.g1-footer > .g1-row-background {
background-color: #<?php echo sanitize_hex_color_no_hash( $bimber_bg1_color->get_hex() ); ?>;
}
