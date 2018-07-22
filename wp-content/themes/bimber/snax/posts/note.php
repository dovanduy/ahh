<?php
/**
 * Single Item Content Part for Displaying Notes
 *
 * @package snax
 * @subpackage Theme
 */

?>

<?php if ( snax_post_submitted() ) : ?>
	<div class="snax snax-note-wrapper">
		<?php snax_get_template_part( 'posts/note-submission-success' ); ?>
	</div>
<?php endif; ?>
