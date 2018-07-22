<?php
/**
 * Snax Post Voting Box Template Part
 *
 * @package snax
 * @subpackage Theme
 */

?>
<?php if ( snax_show_item_voting_box() ) : ?>
<div class="snax-voting-container">
	<?php bimber_render_section_title( __( 'What do you think?', 'bimber' ) ); ?>
	<?php snax_render_voting_box( null, 0, 'snax-voting-large' ); ?>
</div>
<?php endif; ?>
