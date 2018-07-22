<?php
/**
 * Template part for displaying item submission note.
 *
 * @package snax
 * @subpackage Theme
 */

?>

<?php if ( snax_item_submitted() ) : ?>
	<div class="snax snax-note-wrapper">
		<?php snax_get_template_part( 'items/note-submission-success' ); ?>
	</div>
<?php endif; ?>
