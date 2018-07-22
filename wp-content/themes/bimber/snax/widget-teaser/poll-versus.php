<?php
/**
 * Snax Versus Poll Teaser widget
 *
 * @package snax 1.11
 * @subpackage Theme
 */

$post_id = get_query_var( 'snax_widget_teaser_post_id' );
$id = get_query_var( 'snax_widget_teaser_id' );
$questions = snax_get_poll_questions( $post_id );?>
<div class="snax-teaser-versus widget snax ">
	<a href="<?php echo esc_url( get_the_permalink( $post_id ) );?>">
		<div class="snax-teaser-versus-images">
				<?php echo wp_get_attachment_image( $questions[0]['answers'][0]['media']['id'], 'bimber-list-xs-2x' );?>
				<?php echo wp_get_attachment_image( $questions[0]['answers'][1]['media']['id'], 'bimber-list-xs-2x' );?>
		</div>
	</a>
	<h4 class="snax-teaser-versus-post-title g1-delta g1-delta-1st">
		<?php echo esc_html( get_the_title( $post_id ) );?>
	</h4>
	<a class="snax-teaser-versus-button g1-button g1-button-s g1-button-simple" href="<?php echo esc_url( get_the_permalink( $post_id ) );?>">
		<?php esc_html_e( 'Take the poll', 'snax' ); ?>
	</a>
</div>