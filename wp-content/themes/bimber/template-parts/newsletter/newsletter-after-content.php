<?php
/**
 * The template part for a newsletter sign-up form after the post content.
 *
 * @package Bimber_Theme 5.4
 */

?>

<?php if ( bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) : ?>
<?php
	$bimber_classes = array(
		'g1-box',
		'g1-newsletter',
		'g1-newsletter-horizontal',
	);

	$bimber_classes = apply_filters( 'bimber_newsletter_after_content_class', $bimber_classes );
?>

<aside class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $bimber_classes ) ); ?>">
	<i class="g1-box-icon"></i>

	<header>
		<?php bimber_render_section_title( esc_html__( 'Newsletter', 'bimber' ) ); ?>
	</header>

	<?php echo bimber_mc4wp_avatar_before_form_in_collection( '' );?>
	<?php bimber_mc4wp_newsletter_header( 'mega', 'delta', 'after_post_content' );?>

	<?php bimber_mc4wp_render_shortcode(); ?>

	<div class="g1-box-background">
	</div>
</aside>
<?php else : ?>
	<?php get_template_part( 'template-parts/newsletter/notice-plugin-required' ); ?>
<?php endif; ?>
