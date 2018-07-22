<?php
/**
 * Footer styles
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

$bimber_filter_hex = array( 'options' => array( 'regexp' => '/^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/' ) );

$bimber_cs_1_background = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_1_background_color' ) );

$bimber_cs_1_background_variations = bimber_get_color_variations( $bimber_cs_1_background );
$bimber_cs_1_background_5          = new Bimber_Color( $bimber_cs_1_background_variations['tone_5_90_hex'] );
$bimber_cs_1_background_10         = new Bimber_Color( $bimber_cs_1_background_variations['tone_20_20_hex'] );

$bimber_cs_1_text1   = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_1_text1' ) );
$bimber_cs_1_text2   = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_1_text2' ) );
$bimber_cs_1_text3   = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_1_text3' ) );
$bimber_cs_1_accent1 = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_1_accent1' ) );

$bimber_cs_2_background = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_2_background_color' ) );
$bimber_cs_2_text1      = new Bimber_Color( bimber_get_theme_option( 'footer', 'cs_2_text1' ) );

?>
/* Prefooter Theme Area */
.g1-prefooter > .g1-row-background,
.g1-prefooter .g1-current-background {
background-color: #<?php echo filter_var( $bimber_cs_1_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}


.g1-prefooter h1,
.g1-prefooter h2,
.g1-prefooter h3,
.g1-prefooter h4,
.g1-prefooter h5,
.g1-prefooter h6,
.g1-prefooter .g1-mega,
.g1-prefooter .g1-alpha,
.g1-prefooter .g1-beta,
.g1-prefooter .g1-gamma,
.g1-prefooter .g1-delta,
.g1-prefooter .g1-epsilon,
.g1-prefooter .g1-zeta,
.g1-prefooter blockquote,
.g1-prefooter .widget_recent_entries a,
.g1-prefooter .widget_archive a,
.g1-prefooter .widget_categories a,
.g1-prefooter .widget_meta a,
.g1-prefooter .widget_pages a,
.g1-prefooter .widget_recent_comments a,
.g1-prefooter .widget_nav_menu .menu a {
color: #<?php echo filter_var( $bimber_cs_1_text1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-prefooter {
color: #<?php echo filter_var( $bimber_cs_1_text2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-prefooter .entry-meta {
color: #<?php echo filter_var( $bimber_cs_1_text3->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-prefooter input,
.g1-prefooter select,
.g1-prefooter textarea {
border-color: #<?php echo filter_var( $bimber_cs_1_background_10->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-prefooter input[type="submit"],
.g1-prefooter input[type="reset"],
.g1-prefooter input[type="button"],
.g1-prefooter button,
.g1-prefooter .g1-button-solid,
.g1-prefooter .g1-button-solid:hover,
.g1-prefooter .g1-box-icon {
border-color: #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
color: #<?php echo filter_var( $bimber_cs_2_text1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}


/* Footer Theme Area */
.g1-footer > .g1-row-background,
.g1-footer .g1-current-background {
background-color: #<?php echo filter_var( $bimber_cs_1_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-footer {
color: #<?php echo filter_var( $bimber_cs_1_text2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-footer-text {
color: #<?php echo filter_var( $bimber_cs_1_text3->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-footer a:hover,
.g1-footer-nav a:hover {
color: #<?php echo filter_var( $bimber_cs_1_accent1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}
