<?php
/**
 * Latest Reactions widget
 *
 * @package whats-your-reaction
 * @subpackage Widgets
 */

?>
<div id="<?php echo esc_attr( $wyr_latest_reactions_id ); ?>" class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $wyr_latest_reactions_classes ) ); ?>">
	<?php if ( ! empty( $wyr_latest_reactions ) ) : ?>

		<ul class="wyr-links">
			<?php foreach ( $wyr_latest_reactions as $wyr_reaction ) : 
				$post_id = $wyr_reaction->post_id;
				?>
				<li class="wyr-link">
					<?php $wyr_reaction = wyr_get_reaction( $wyr_reaction->vote );
					?>

					<?php wyr_render_reaction_icon( $wyr_reaction->term_id ); ?>

					<?php if ( 'global' === $wyr_latest_reactions_type ) : ?>
						<span class="wyr-meta">
							<?php
								$author_link = '<a class="wyr-reaction-author" href="' . esc_url( get_author_posts_url( $wyr_reaction->author_id ) ) . '">' . esc_html( get_the_author_meta( 'user_nicename', $wyr_reaction->author_id ) ) . '</a>';
								echo sprintf( esc_html__( '%1$s on', 'wyr' ), $author_link );
							?>
						</span>
					<?php endif; ?>

					<div><a href="<?php echo esc_url( get_the_permalink( $post_id ) ); ?>"><?php echo get_the_title( $post_id ); ?></a></div>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if ( $wyr_latest_reactions_view_all_url ) : ?>
			<p class="wyr-more-results">
				<a class="g1-link" href="<?php echo esc_url( $wyr_latest_reactions_view_all_url ); ?>"><?php esc_html_e( 'View all reactions', 'wyr' ); ?></a>
			</p>
		<?php endif; ?>

	<?php else : ?>
		<p class="wyr-no-results">
			<?php esc_html_e( 'Sorry. No data so far.', 'wyr' ); ?>
		</p>
	<?php endif; ?>
</div>
