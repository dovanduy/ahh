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

$bimber_preheader_text       = new Bimber_Color( bimber_get_theme_option( 'preheader', 'text_color' ) );
$bimber_preheader_accent     = new Bimber_Color( bimber_get_theme_option( 'preheader', 'accent_color' ) );
$bimber_preheader_bg1        = new Bimber_Color( bimber_get_theme_option( 'preheader', 'background_color' ) );

$bimber_preheader_bg2 = bimber_get_theme_option( 'preheader', 'bg2_color' );
$bimber_preheader_bg2 = strlen( $bimber_preheader_bg2 ) ? new Bimber_Color( $bimber_preheader_bg2 ) : $bimber_preheader_bg1;

$bimber_preheader_border = bimber_get_theme_option( 'preheader', 'border_color' );
$bimber_preheader_border = strlen( $bimber_preheader_border ) ? new Bimber_Color( $bimber_preheader_border ) : '';
?>

.g1-preheader .menu-item a,
.g1-preheader .g1-drop-toggle,
.g1-preheader .g1-socials-item-link {
	color: #<?php echo filter_var( $bimber_preheader_text->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-preheader .menu-item:hover > a,
.g1-preheader .current-menu-item > a,
.g1-prenavbar .current-menu-ancestor > a,
.g1-preheader .menu-item-object-post_tag > a:before,
.g1-preheader .g1-drop-toggle:hover,
.g1-preheader .g1-socials-item-link:hover {
	color: #<?php echo filter_var( $bimber_preheader_accent->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-preheader > .g1-row-background {
	<?php if ( $bimber_preheader_border ) : ?>
		border-color: #<?php echo filter_var( $bimber_preheader_border->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	<?php else : ?>
		background-clip: padding-box;
	<?php endif; ?>

	background-color: #<?php echo filter_var( $bimber_preheader_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;

	<?php if ( $bimber_preheader_bg1->get_hex() !== $bimber_preheader_bg2->get_hex() ) : ?>
		background-image: -webkit-linear-gradient(to right, #<?php echo filter_var( $bimber_preheader_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_preheader_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
		background-image:    -moz-linear-gradient(to right, #<?php echo filter_var( $bimber_preheader_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_preheader_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
		background-image:      -o-linear-gradient(to right, #<?php echo filter_var( $bimber_preheader_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_preheader_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
		background-image:         linear-gradient(to right, #<?php echo filter_var( $bimber_preheader_bg1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_preheader_bg2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	<?php endif; ?>
}
