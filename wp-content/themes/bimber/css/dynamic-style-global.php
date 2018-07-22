<?php
/**
 * Global styles
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

$bimber_filter_hex = array( 'options' => array( 'regexp' => '/^([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/' ) );

$bimber_stack 	 = bimber_get_current_stack();


$bimber_page_layout = bimber_get_theme_option( 'global', 'layout' );

$bimber_body_background          = array();
$bimber_body_background['color'] = new Bimber_Color( bimber_get_theme_option( 'global', 'background_color' ) );

$bimber_cs_1_background = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_1_background_color' ) );
$bimber_cs_1_background_variations = bimber_get_color_variations( $bimber_cs_1_background );
$bimber_cs_1_background_5          = new Bimber_Color( $bimber_cs_1_background_variations['tone_5_90_hex'] );
$bimber_cs_1_background_10         = new Bimber_Color( $bimber_cs_1_background_variations['tone_20_20_hex'] );

$bimber_cs_1_text1                  = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_1_text1' ) );
$bimber_cs_1_text2                  = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_1_text2' ) );
$bimber_cs_1_text3                  = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_1_text3' ) );
$bimber_cs_1_accent1                = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_1_accent1' ) );
$bimber_cs_2_background             = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_2_background_color' ) );
$bimber_cs_2_text1                  = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_2_text1' ) );

$bimber_cs_2_background2 = $bimber_cs_2_background;
if ( strlen( bimber_get_theme_option( 'content', 'cs_2_background2_color' ) ) ) {
	$bimber_cs_2_background2 = new Bimber_Color( bimber_get_theme_option( 'content', 'cs_2_background2_color' ) );
}


$bimber_trending_background         = new Bimber_Color( bimber_get_theme_option( 'trending', 'background_color' ) );
$bimber_hot_background              = new Bimber_Color( bimber_get_theme_option( 'hot', 'background_color' ) );
$bimber_popular_background          = new Bimber_Color( bimber_get_theme_option( 'popular', 'background_color' ) );
?>
body.g1-layout-boxed {
background-color: #<?php echo filter_var( $bimber_body_background['color']->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.g1-layout-boxed .g1-row-layout-page {
max-width: 1212px;
}

/* Global Color Scheme */
.g1-sharebar > .g1-row-background {
background-color: #<?php echo filter_var( $bimber_cs_1_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

a,
.entry-title > a:hover,
.entry-meta a:hover,
.menu-item > a:hover,
.current-menu-item > a,
.mtm-drop-expanded > a,
.g1-nav-single-prev > a > span:before,
.g1-nav-single-next > a > span:after,
.g1-nav-single-prev > a:hover > strong,
.g1-nav-single-prev > a:hover > span,
.g1-nav-single-next > a:hover > strong,
.g1-nav-single-next > a:hover > span,
.mashsb-count,
.archive-title:before,
.snax .snax-item-title > a:hover {
color: #<?php echo filter_var( $bimber_cs_1_accent1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

input[type="submit"],
input[type="reset"],
input[type="button"],
button,
.g1-button-solid,
.g1-button-solid:hover,
.g1-arrow-solid,
<?php if ( 'original-2018' != $bimber_stack ) : ?>.entry-categories .entry-category:hover, <?php endif; ?>
.author-link,
.author-info .author-link,
.g1-box-icon,
.snax .snax-voting-simple .snax-voting-upvote:hover,
.snax .snax-voting-simple .snax-voting-downvote:hover,
<?php if ( 'bunchy' === $bimber_stack) :?>
.snax .snax-formats .snax-format:hover,
.entry-badge,
a.g1-arrow,
a.g1-arrow:hover,
<?php endif; ?>
.wyr-reaction:hover .wyr-reaction-button,
.wyr-reaction-voted .wyr-reaction-button,
.wyr-reaction .wyr-reaction-bar {
border-color: #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
color: #<?php echo filter_var( $bimber_cs_2_text1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}

.entry-counter:before {
border-color: #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
color: #<?php echo filter_var( $bimber_cs_2_text1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}



.g1-button-simple,
input.g1-button-simple,
button.g1-button-simple {
border-color: currentColor;
background-color: transparent;
color: #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}



.g1-drop-toggle-arrow {
color: #<?php echo filter_var( $bimber_cs_1_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
}


.g1-quick-nav-tabs .menu-item-type-g1-trending > a,
.entry-flag-trending {
border-color: #<?php echo filter_var( $bimber_trending_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_trending_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
color: #fff;
}

.g1-quick-nav-tabs .menu-item-type-g1-hot > a,
.entry-flag-hot {
border-color: #<?php echo filter_var( $bimber_hot_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_hot_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
color: #fff;
}

.g1-quick-nav-tabs .menu-item-type-g1-popular > a,
.entry-flag-popular {
border-color: #<?php echo filter_var( $bimber_popular_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
background-color: #<?php echo filter_var( $bimber_popular_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
color: #fff;
}


<?php if ( 'miami' === $bimber_stack ) : ?>
	.entry-categories .entry-category {
	border-top-color: #<?php echo filter_var( $bimber_cs_1_accent1->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;
	}
<?php endif; ?>

<?php if ( 'miami' === $bimber_stack && $bimber_cs_2_background->get_hex() !== $bimber_cs_2_background2->get_hex() ) : ?>
	.g1-box {
	background-image: -webkit-linear-gradient(to bottom right, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:    -moz-linear-gradient(to bottom right, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:      -o-linear-gradient(to bottom right, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:         linear-gradient(to bottom right, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	}
<?php endif; ?>



<?php if ( 'original-2018' === $bimber_stack && $bimber_cs_2_background->get_hex() !== $bimber_cs_2_background2->get_hex() ) : ?>
	.entry-counter:before {
		background-image: -webkit-linear-gradient(to top left, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
		background-image:    -moz-linear-gradient(to top left, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
		background-image:      -o-linear-gradient(to top left, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
		background-image:         linear-gradient(to top left, #<?php echo filter_var( $bimber_cs_2_background->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_cs_2_background2->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	}
<?php endif; ?>




<?php
// Archive related styles.
$bimber_bg1_color = bimber_get_theme_option( 'archive', 'header_bg1_color' );
$bimber_bg1_color = strlen( $bimber_bg1_color ) ? new Bimber_Color( $bimber_bg1_color) : false;

$bimber_bg2_color = bimber_get_theme_option( 'archive', 'header_bg2_color' );
$bimber_bg2_color = strlen( $bimber_bg2_color ) ? new Bimber_Color( $bimber_bg2_color) : false;
?>

<?php if ( $bimber_bg1_color  ) : ?>
.archive-header > .g1-row-background {
	background-color: #<?php echo filter_var( $bimber_bg1_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>;

	<?php if ( $bimber_bg2_color ) : ?>
	background-image: -webkit-linear-gradient(to right, #<?php echo filter_var( $bimber_bg1_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_bg2_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:    -moz-linear-gradient(to right, #<?php echo filter_var( $bimber_bg1_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_bg2_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:      -o-linear-gradient(to right, #<?php echo filter_var( $bimber_bg1_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_bg2_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	background-image:         linear-gradient(to right, #<?php echo filter_var( $bimber_bg1_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>, #<?php echo filter_var( $bimber_bg2_color->get_hex(), FILTER_VALIDATE_REGEXP, $bimber_filter_hex ); ?>);
	<?php endif; ?>
}
<?php endif; ?>
<?php
// Archives colors.
if ( 'original-2018' === bimber_get_current_stack() ) {
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'hide_empty' => false,
		'meta_query' => array(
			array(
				'key' => 'bimber_label_color',
				'compare' => 'EXISTS'
			),
		),
	) );
	foreach ( $terms as $term ) {
		$color = get_term_meta( $term->term_id, 'bimber_label_color', true );
		if ( ! empty( $color ) ) :?>
			.entry-category-item-<?php echo esc_attr( $term->term_id );?>{
				color: <?php echo esc_attr( $color );?>;
			}
		<?php endif;
	}
}
//Translatable phrases for MyCred Integration:
?>
.member-header .mycred-my-rank:after {
	content:"<?php echo esc_html__( 'Rank', 'bimber' );?>";
}
.member-header .mycred-balance:after {
	content:"<?php echo esc_html__( 'Points', 'bimber' );?>";
}
<?php // GDPR Styles.
$g1_theme_options   = get_option( bimber_get_theme_options_id() );
if ( isset( $g1_theme_options['gdpr_enabled'] ) && 'on' === $g1_theme_options['gdpr_enabled'] ) :
?>
.snax-wpsl-gdpr-consent{
	font-weight:300;
}
@-webkit-keyframes g1-flash {
	from,
	50%,
	to {
	  opacity: 1;
	}

	25%,
	75% {
	  opacity: 0;
	}
}

@keyframes g1-flash {
	from,
	50%,
	to {
	  opacity: 1;
	}

	25%,
	75% {
	  opacity: 0;
	}
}
.snax-wpsl-gdpr-consent-blink{
	-webkit-animation: g1-flash 0.5s 2 linear;
	animation: g1-flash 0.5s 2 linear;
}
.wp-social-login-provider-list a{
	opacity:0.5;
	pointer-events:none;
}
.wp-social-login-provider-list-active a{
	opacity:1;
	pointer-events:unset;
}
<?php endif;?>
