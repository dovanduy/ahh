<?php
/**
 * Mailchimp for WP plugin functions
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

/**
 * Render some HTML markup before the newsletter sign-up form fields
 *
 * @param string $html  HTML markup.
 *
 * @return string
 */
function bimber_mc4wp_form_before_form( $html ) {
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$html .= '<p class="g1-alpha g1-alpha-1st">' . esc_html( bimber_get_theme_option( 'newsletter', 'other_title' ) ) . '</p>';
	} else {
		$html .= '<p class="g1-alpha g1-alpha-1st">' . esc_html( bimber_get_theme_option( 'newsletter', 'compact_title' ) ) . '</p>';
	}

	return $html;
}

/**
 * Render some HTML markup before the newsletter sign-up form fields
 *
 * @param string $html  HTML markup.
 *
 * @return string
 */
function bimber_mc4wp_form_before_form_in_collection( $html ) {
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$html .= '<p class="g1-alpha g1-alpha-1st">' . wp_kses_post( bimber_get_theme_option( 'newsletter', 'in_collection_title' ) ) . '</p>';
	} else {
		$html .= '<p class="g1-alpha g1-alpha-1st">' . esc_html( bimber_get_theme_option( 'newsletter', 'compact_title' ) ) . '</p>';
	}
	return $html;
}

/**
 * Render some HTML markup before the newsletter sign-up form fields
 *
 * @param string $html  HTML markup.
 *
 * @return string
 */
function bimber_mc4wp_avatar_before_form( $html ) {
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$newsletter_avatar = bimber_get_theme_option( 'newsletter', 'other_avatar' );

		$html .= '<div class="g1-newsletter-avatar">';

		if ( ! empty( $newsletter_avatar ) ) {
			$avatar_id = bimber_get_attachment_id_by_url( $newsletter_avatar );

			if ( $avatar_id ) {
				$html .= wp_get_attachment_image( $avatar_id, 'thumbnail', false, array( 'class' => 'g1-no-lazyload' ) );
			}
		}

		$html .= '</div>';
	}
	return $html;
}

/**
 * Render some HTML markup before the newsletter sign-up form fields
 *
 * @param string $html  HTML markup.
 *
 * @return string
 */
function bimber_mc4wp_avatar_before_form_in_collection( $html ) {
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$newsletter_avatar = bimber_get_theme_option( 'newsletter', 'in_collection_avatar' );

		$html .= '<div class="g1-newsletter-avatar">';

		if ( ! empty( $newsletter_avatar ) ) {
			$avatar_id = bimber_get_attachment_id_by_url( $newsletter_avatar );

			if ( $avatar_id ) {
				$html .= wp_get_attachment_image( $avatar_id, 'thumbnail', false, array( 'class' => 'g1-no-lazyload' ) );
			}
		}

		$html .= '</div>';
	}

	return $html;
}

/**
 * Render some HTML markup after the newsletter sign-up form fields
 *
 * @param string $html      HTML markup.
 *
 * @return string
 */
function bimber_mc4wp_form_after_form( $html ) {
	$html .= '<p class="g1-meta g1-newsletter-privacy">' . wp_kses_post( bimber_get_theme_option( 'newsletter', 'privacy' ) ) . '</p>';

	return $html;
}

/**
 * Set up default newsletter sign-up form id
 */
function bimber_mc4wp_set_up_default_form_id() {
	$form_id = (int) get_option( 'mc4wp_default_form_id', 0 );

	// Return if already set.
	if ( 0 !== $form_id ) {
		return;
	}

	$query_args = array(
		'posts_per_page'        => 1,
		'post_type'             => 'mc4wp-form',
		'post_status'           => 'publish',
		'ignore_sticky_posts'   => true,
	);

	$query = new WP_Query();
	$forms = $query->query( $query_args );

	if ( ! empty( $forms ) ) {
		$form = $forms[0];

		update_option( 'mc4wp_default_form_id', $form->ID );
	}
}

/**
 * Render mailchimp shortcode
 *
 * @param string $position	Position.
 */
function bimber_mc4wp_render_shortcode( $position = 'template' ) {
	remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
	remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
	if ( 'grid' === $position ) {
		add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form_in_collection', 10, 2 );
		add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form_in_collection', 10, 2 );
	}
	echo do_shortcode( '[mc4wp_form]' );
	if ( 'grid' === $position ) {
		remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form_in_collection', 10, 2 );
		remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form_in_collection', 10, 2 );
	}
	add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
	add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
}

/**
 * Render newsletter form header
 *
 * @param  string $title_class     Title header type.
 * @param  string $subtitle_class  Subtitle header type.
 * @param  string $position        Theme position.
 */
function bimber_mc4wp_newsletter_header( $title_class, $subtitle_class, $position ) {
	if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
		$title_option 		= $position . '_title';
		$subtitle_option 	= $position . '_subtitle';
	} else {
		$title_option 		= 'title';
		$subtitle_option 	= 'subtitle';
	}
	$title_classes 		= array(
		'g1-' . $title_class,
		'g1-' . $title_class . '-1st',
	);
	$sub_title_classes 	= array(
		'g1-' . $subtitle_class,
		'g1-' . $subtitle_class . '-3rd',
	);
	?>
	<h3 class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $title_classes ) ); ?>">
		<?php echo esc_html( bimber_get_theme_option( 'newsletter', $title_option ) ); ?>
	</h3>
	<p class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $sub_title_classes ) ); ?>">
		<?php echo esc_html( bimber_get_theme_option( 'newsletter', $subtitle_option ) ); ?>
	</p>
	<?php
}
