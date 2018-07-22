<?php
/**
 * Header styles
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

$bimber_filter_hex = array( 'options' => array( 'regexp' => '/^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/' ) );

$bimber_logo_margin_top    			= (int) bimber_get_theme_option( 'header', 'logo_margin_top' );
$bimber_logo_margin_bottom 			= (int) bimber_get_theme_option( 'header', 'logo_margin_bottom' );
$bimber_mobile_logo_margin_top    	= (int) bimber_get_theme_option( 'header', 'mobile_logo_margin_top' );
$bimber_mobile_logo_margin_bottom 	= (int) bimber_get_theme_option( 'header', 'mobile_logo_margin_bottom' );

$bimber_quicknav_margin_top    		= (int) bimber_get_theme_option( 'header', 'quicknav_margin_top' );
$bimber_quicknav_margin_bottom 		= (int) bimber_get_theme_option( 'header', 'quicknav_margin_bottom' );
?>
/*customizer_preview_margins*/
<?php if ( 0 === $bimber_logo_margin_top ) : ?>
	.g1-hb-row-normal .g1-id ,
	.g1-header .g1-id {
		margin-top: 0;
	}
<?php endif; ?>

<?php if ( 0 === $bimber_logo_margin_bottom ) : ?>
	.g1-hb-row-normal  .g1-id ,
	.g1-header .g1-id {
	margin-bottom: 0;
	}
<?php endif; ?>

<?php if ( 0 === $bimber_mobile_logo_margin_top ) : ?>
	.g1-hb-row-mobile .g1-id ,
	.g1-header .g1-id {
		margin-top: 0;
	}
<?php endif; ?>

<?php if ( 0 === $bimber_mobile_logo_margin_bottom ) : ?>
	.g1-hb-row-mobile  .g1-id ,
	.g1-header .g1-id {
	margin-bottom: 0;
	}
<?php endif; ?>

@media only screen and ( min-width: 801px ) {
	.g1-hb-row-normal  .g1-id ,
	.g1-header .g1-id {
		margin-top: <?php echo intval( $bimber_logo_margin_top ); ?>px;
		margin-bottom: <?php echo intval( $bimber_logo_margin_bottom ); ?>px;
	}

	.g1-hb-row-normal  .g1-quick-nav ,
	.g1-header .g1-quick-nav {
		margin-top: <?php echo intval( $bimber_quicknav_margin_top ); ?>px;
		margin-bottom: <?php echo intval( $bimber_quicknav_margin_bottom ); ?>px;
	}
}

.g1-hb-row-mobile  .g1-id ,
.g1-header .g1-id {
	margin-top: <?php echo intval( $bimber_mobile_logo_margin_top ); ?>px;
	margin-bottom: <?php echo intval( $bimber_mobile_logo_margin_bottom ); ?>px;
}

.g1-hb-row-mobile  .g1-id ,
.g1-header .g1-id {
	margin-top: <?php echo intval( $bimber_mobile_logo_margin_top ); ?>px;
	margin-bottom: <?php echo intval( $bimber_mobile_logo_margin_bottom ); ?>px;
}

/*customizer_preview_margins_end*/

<?php
$bimber_header_text       = new Bimber_Color( bimber_get_theme_option( 'header', 'text_color' ) );
$bimber_header_accent     = new Bimber_Color( bimber_get_theme_option( 'header', 'accent_color' ) );
$bimber_header_bg1        = new Bimber_Color( bimber_get_theme_option( 'header', 'background_color' ) );

$bimber_header_bg2 = bimber_get_theme_option( 'header', 'bg2_color' );
$bimber_header_bg2 = strlen( $bimber_header_bg2 ) ? new Bimber_Color( $bimber_header_bg2 ) : $bimber_header_bg1;

$bimber_header_border = bimber_get_theme_option( 'header', 'border_color' );
$bimber_header_border = strlen( $bimber_header_border ) ? new Bimber_Color( $bimber_header_border ) : '';

$bimber_navbar_background = new Bimber_Color( bimber_get_theme_option( 'header', 'navbar_background_color' ) );
$bimber_navbar_text       = new Bimber_Color( bimber_get_theme_option( 'header', 'navbar_text_color' ) );
$bimber_navbar_accent     = new Bimber_Color( bimber_get_theme_option( 'header', 'navbar_accent_color' ) );

$bimber_submenu_background = new Bimber_Color( bimber_get_theme_option( 'header', 'submenu_background_color' ) );
$bimber_submenu_text       = new Bimber_Color( bimber_get_theme_option( 'header', 'submenu_text_color' ) );
$bimber_submenu_accent     = new Bimber_Color( bimber_get_theme_option( 'header', 'submenu_accent_color' ) );

$bimber_navbar_secondary_background = new Bimber_Color( bimber_get_theme_option( 'header', 'navbar_secondary_background_color' ) );
$bimber_navbar_secondary_text       = new Bimber_Color( bimber_get_theme_option( 'header', 'navbar_secondary_text_color' ) );
?>

.g1-header .menu-item > a,
.g1-header .g1-hamburger,
.g1-header .g1-drop-toggle,
.g1-header .g1-socials-item-link {
color: #<?php echo filter_var( $bimber_header_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-header .menu-item:hover > a,
.g1-header .current-menu-item > a,
.g1-navbar .current-menu-ancestor > a,
.g1-header .menu-item-object-post_tag > a:before,
.g1-header .g1-socials-item-link:hover {
color: #<?php echo filter_var( $bimber_header_accent->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-header > .g1-row-background {
	<?php if ( $bimber_header_border ) : ?>
		border-color: #<?php echo filter_var( $bimber_header_border->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	<?php endif; ?>


	background-color: #<?php echo filter_var( $bimber_header_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;

	<?php if ( $bimber_header_bg1->get_hex() !== $bimber_header_bg2->get_hex() ) : ?>
	background-image: -webkit-linear-gradient(to right, #<?php echo filter_var( $bimber_header_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_header_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:    -moz-linear-gradient(to right, #<?php echo filter_var( $bimber_header_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_header_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:      -o-linear-gradient(to right, #<?php echo filter_var( $bimber_header_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_header_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:         linear-gradient(to right, #<?php echo filter_var( $bimber_header_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_header_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	<?php endif; ?>
}


.g1-navbar,
.g1-hb-background {
border-color: #<?php echo filter_var( $bimber_navbar_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_navbar_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}


.g1-navbar .menu-item > a,
.g1-navbar .g1-hamburger,
.g1-navbar .g1-drop-toggle,
.g1-navbar .g1-socials-item-link {
color: #<?php echo filter_var( $bimber_navbar_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-navbar .menu-item:hover > a,
.g1-navbar .current-menu-item > a,
.g1-navbar .current-menu-ancestor > a,
.g1-navbar .menu-item-object-post_tag > a:before,
.g1-navbar .g1-socials-item-link:hover {
color: #<?php echo filter_var( $bimber_navbar_accent->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-navbar .sub-menu,
.g1-header .sub-menu,
.g1-preheader .sub-menu {
border-color: #<?php echo filter_var( $bimber_submenu_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_submenu_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-navbar .sub-menu .menu-item > a,
.g1-header .sub-menu .menu-item > a,
.g1-g1-preheader .sub-menu .menu-item > a {
color: #<?php echo filter_var( $bimber_submenu_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-header .g1-link-toggle,
.g1-navbar .g1-link-toggle {
color: #<?php echo filter_var( $bimber_submenu_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-navbar .sub-menu .menu-item:hover > a,
.g1-header .sub-menu .menu-item:hover > a,
.g1-preheader .sub-menu .menu-item:hover > a,
.g1-navbar .sub-menu .current-menu-item > a,
.g1-header .sub-menu .current-menu-item > a,
.g1-preheader .sub-menu .current-menu-item > a,
.g1-navbar .sub-menu .current-menu-ancestor > a,
.g1-header .sub-menu .current-menu-ancestor > a,
.g1-preheader .sub-menu .current-menu-ancestor > a {
color: #<?php echo filter_var( $bimber_submenu_accent->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-header .g1-drop-toggle-badge,
.g1-header .snax-button-create,
.g1-header .snax-button-create:hover,
.g1-navbar .g1-drop-toggle-badge,
.g1-navbar .snax-button-create,
.g1-navbar .snax-button-create:hover {
	border-color: #<?php echo filter_var( $bimber_navbar_secondary_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	background-color: #<?php echo filter_var( $bimber_navbar_secondary_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	color: #<?php echo filter_var( $bimber_navbar_secondary_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

<?php
function bimber_hb_generate_row_css( $row_letter ) {
	$bimber_hb_text       		= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_text_color' ) );
	$bimber_hb_accent  	   		= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_accent_color' ) );
	$bimber_hb_backgound       	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_background_color' ) );
	$bimber_hb_gradient       	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_gradient_color' ) );
	$bimber_hb_border	       	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_border_color' ) );
	$bimber_hb_button_bg       	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_button_background' ) );
	$bimber_hb_button_text     	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_button_text' ) );
	$bimber_filter_hex = array( 'options' => array( 'regexp' => '/^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/' ) );
	?>
	/*customizer_preview_<?php echo esc_attr( $row_letter ); ?>_row*/
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .menu-item > a,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .g1-hamburger,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .g1-drop-toggle,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .g1-socials-item-link{
		color:#<?php echo filter_var( $bimber_hb_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	}

	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .g1-row-background {
		<?php if ( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_border_color' ) ) : ?>
			border-bottom: 1px solid  #<?php echo filter_var( $bimber_hb_border->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
			border-color: #<?php echo filter_var( $bimber_hb_border->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
		<?php endif; ?>


		background-color: #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;

		<?php if ( bimber_get_theme_option( 'header', 'builder_' . $row_letter . '_gradient_color' ) ) : ?>
			background-image: -webkit-linear-gradient(to right, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
			background-image:    -moz-linear-gradient(to right, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
			background-image:      -o-linear-gradient(to right, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
			background-image:         linear-gradient(to right, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
		<?php endif; ?>
	}

	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .menu-item:hover > a,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .current-menu-item > a,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .current-menu-ancestor > a,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .menu-item-object-post_tag > a:before,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .g1-socials-item-link:hover {
		color:#<?php echo filter_var( $bimber_hb_accent->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	}

	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .g1-drop-toggle-badge,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .snax-button-create,
	.g1-hb-row-<?php echo esc_attr( $row_letter ); ?> .snax-button-create:hover {
		border-color: #<?php echo filter_var( $bimber_hb_button_bg->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
		background-color: #<?php echo filter_var( $bimber_hb_button_bg->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
		color: #<?php echo filter_var( $bimber_hb_button_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	}
	/*customizer_preview_<?php echo esc_attr( $row_letter ); ?>_row_end*/
<?php
}

bimber_hb_generate_row_css( 'a' );
bimber_hb_generate_row_css( 'b' );
bimber_hb_generate_row_css( 'c' );

$bimber_hb_text       		= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_canvas_text_color' ) );
$bimber_hb_accent  	   		= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_canvas_accent_color' ) );
$bimber_hb_backgound       	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_canvas_background_color' ) );
$gradient_option 			= bimber_get_theme_option( 'header', 'builder_canvas_gradient_color' );
$bg_image		 			= bimber_get_theme_option( 'header', 'builder_canvas_background_image' );
$bimber_hb_gradient       	= new Bimber_Color( $gradient_option );
if ( $bg_image ) {
	$bg_size 		= bimber_get_theme_option( 'header', 'builder_canvas_background_size' );
	$bg_repeat 		= bimber_get_theme_option( 'header', 'builder_canvas_background_repeat' );
	$bg_position 	= bimber_get_theme_option( 'header', 'builder_canvas_background_position' );
}
$bg_opacity 	= (int) bimber_get_theme_option( 'header', 'builder_canvas_background_opacity' );
$bimber_hb_button_bg       	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_canvas_button_background' ) );
$bimber_hb_button_text     	= new Bimber_Color( bimber_get_theme_option( 'header', 'builder_canvas_button_text' ) );
$bimber_filter_hex = array( 'options' => array( 'regexp' => '/^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/' ) );
?>
/*customizer_preview_canvas*/
.g1-canvas-content,
.g1-canvas-toggle,
.g1-canvas-content .menu-item > a,
.g1-canvas-content .g1-hamburger,
.g1-canvas-content .g1-drop-toggle,
.g1-canvas-content .g1-socials-item-link{
	color:#<?php echo filter_var( $bimber_hb_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>
}

.g1-canvas-content .menu-item:hover > a,
.g1-canvas-content .current-menu-item > a,
.g1-canvas-content .current-menu-ancestor > a,
.g1-canvas-content .menu-item-object-post_tag > a:before,
.g1-canvas-content .g1-socials-item-link:hover {
	color:#<?php echo filter_var( $bimber_hb_accent->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>
}

.g1-canvas-global {
	background-color: #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
		<?php if ( $gradient_option ) : ?>
			background-image: -webkit-linear-gradient(to bottom, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
			background-image:    -moz-linear-gradient(to bottom, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
			background-image:      -o-linear-gradient(to bottom, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
			background-image:         linear-gradient(to bottom, #<?php echo filter_var( $bimber_hb_backgound->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_hb_gradient->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	<?php endif; ?>
}

.g1-canvas-background {
		<?php if ( $bg_image ) : ?>
			background-image: 	url(<?php echo esc_url( $bg_image ); ?>);
			background-size: 	<?php echo esc_attr( $bg_size ); ?>;
			background-repeat: 	<?php echo esc_attr( $bg_repeat ); ?>;
			background-position: <?php echo esc_attr( $bg_position ); ?>;
		<?php endif; ?>
		opacity: <?php echo esc_attr( 0.01 * $bg_opacity ); ?>;
}

.g1-canvas-content .snax-button-create {
	border-color: #<?php echo filter_var( $bimber_hb_button_bg->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	background-color: #<?php echo filter_var( $bimber_hb_button_bg->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	color: #<?php echo filter_var( $bimber_hb_button_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}
/*customizer_preview_canvas_end*/

/*customizer_preview_submenu*/
.g1-hb-row .sub-menu {
border-color: #<?php echo filter_var( $bimber_submenu_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_submenu_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-hb-row .sub-menu .menu-item > a {
color: #<?php echo filter_var( $bimber_submenu_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-hb-row .g1-link-toggle {
color: #<?php echo filter_var( $bimber_submenu_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-hb-row .sub-menu .menu-item:hover > a,
.g1-hb-row .sub-menu .current-menu-item > a,
.g1-hb-row .sub-menu .current-menu-ancestor > a {
color: #<?php echo filter_var( $bimber_submenu_accent->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}
/*customizer_preview_submenu_row_end*/
