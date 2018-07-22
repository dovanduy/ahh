<?php
/**
 * New post form for format "Embed"
 *
 * @package snax 1.11
 * @subpackage Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<?php
$snax_has_embeds = snax_has_user_cards( 'embed' );

// HTML classes of the form.
$snax_class = array(
	'snax',
	'snax-form-frontend',
);
if ( ! $snax_has_embeds ) {
	$snax_class[] = 'snax-form-frontend-without-media';
	add_filter( 'snax_form_file_upload_no_media', '__return_true' );
}
?>

<?php do_action( 'snax_before_frontend_submission_form', 'embed' ); ?>

	<form action="" method="post" class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $snax_class ) ); ?>">
		<?php do_action( 'snax_frontend_submission_form_start', 'embed' ); ?>

		<div class="snax-form-main">
			<h2 class="snax-form-main-title screen-reader-text"><?php esc_html_e( 'Share your story', 'snax' ); ?></h2>

			<?php snax_get_template_part( 'posts/form-edit/row-title' ); ?>

			<div class="snax-edit-post-row-media">
				<?php
				$snax_key = 'embed';

				$snax_class = array(
					'snax-tab-content',
					'snax-tab-content-' . $snax_key,
					'snax-tab-content-' . ( $snax_has_embeds ? 'hidden' : 'visible' ),
				);

				$snax_class[] = 'snax-tab-content-current';
				?>
				<div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $snax_class ) ); ?>">
					<?php snax_get_template_part( 'posts/form-edit/new', $snax_key ); ?>
				</div>
			</div>

			<div class="snax-cards">
				<?php if ( $snax_has_embeds ) : ?>

					<?php snax_get_template_part( 'loop-embeds' ); ?>

				<?php endif; ?>
			</div><!-- .snax-cards -->

			<?php snax_get_template_part( 'posts/form-edit/row-source' ); ?>
			<?php snax_get_template_part( 'posts/form-edit/row-description' ); ?>
			<?php snax_get_template_part( 'posts/form-edit/row-referral' ); ?>

		</div><!-- .snax-form-main -->

		<div class="snax-form-side">
			<h2 class="snax-form-side-title screen-reader-text"><?php esc_html_e( 'Publish Options', 'snax' ); ?></h2>

			<input type="hidden" name="snax-post-format" value="embed"/>

			<?php snax_get_template_part( 'posts/form-edit/row-categories' ); ?>

			<?php snax_get_template_part( 'posts/form-edit/row-tags' ); ?>

			<?php snax_get_template_part( 'posts/form-edit/row-legal' ); ?>

			<?php snax_get_template_part( 'posts/form-edit/row-actions' ); ?>

		</div><!-- .snax-form-side -->

		<?php do_action( 'snax_frontend_submission_form_end', 'embed' ); ?>
	</form>

<?php do_action( 'snax_after_frontend_submission_form', 'embed' ); ?>
