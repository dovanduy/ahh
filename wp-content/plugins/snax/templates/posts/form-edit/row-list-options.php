<?php
/**
 * Snax Post Row List Options
 *
 * @package snax 1.11
 * @subpackage Theme
 */

?>

<div class="snax-edit-post-row-list-options">
	<div>
		<label>
			<input name="snax-list-submission"
				   id="snax-list-submission"
				   type="checkbox"
				   value="standard"
				<?php checked( snax_get_list_submission_value() ) ?>
			/>
			<?php esc_html_e( 'Open for submissions', 'snax' ); ?>
		</label>
	</div>

	<div>
		<label>
			<input name="snax-list-voting"
				   id="snax-list-voting"
				   type="checkbox"
				   value="standard"
				    <?php checked( snax_get_list_voting_value() ) ?>
			/>
			<?php esc_html_e( 'Open for voting', 'snax' ); ?>
		</label>
	</div>
</div>
