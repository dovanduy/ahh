<?php
/**
 * The default template for displaying single post content (with sidebar).
 * This is a template part. It must be used within The Loop.
 *
 * @package Bimber_Theme 5.4
 */

$bimber_entry_data = bimber_get_template_part_data();
$bimber_elements   = $bimber_entry_data['elements'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-tpl-index entry-tpl-index-stickies' ); ?>>
	<div class="entry-box">
		<?php
		bimber_render_entry_stats( array(
			'share_count'   => $bimber_elements['shares'],
			'view_count'    => $bimber_elements['views'],
			'comment_count' => $bimber_elements['comments_link'],
			'class'         => 'g1-meta',
		) );
		?>


		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="g1-alpha g1-alpha-1st entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>

		<?php if ( bimber_can_use_plugin( 'snax/snax.php' ) ) : ?>
			<?php get_template_part( 'template-parts/snax-bar-post' ); ?>
		<?php endif; ?>

		<?php bimber_render_entry_flags(); ?>

		<?php
		if ( $bimber_elements['featured_media'] ) :
			bimber_render_entry_featured_media( array(
				'size' => 'bimber-index',
			) );
		endif;
		?>


		<?php if ( $bimber_elements['author'] && $bimber_elements['avatar'] ) : ?>
			<p class="g1-meta entry-byline entry-byline-with-avatar">
		<?php else : ?>
			<p class="g1-meta entry-byline">
		<?php endif; ?>

			<?php if ( $bimber_elements['author'] || $bimber_elements['date'] || $bimber_elements['categories'] ) : ?>

				<?php
				if ( $bimber_elements['author'] ) :
					bimber_render_entry_author( array(
						'avatar'      => $bimber_elements['avatar'],
						'avatar_size' => 30,
					) );
				endif;
				?>

				<?php
				if ( $bimber_elements['date'] ) :
					bimber_render_entry_date();
				endif;
				?>

				<?php
				if ( $bimber_elements['categories'] ) :
					bimber_render_entry_categories();
				endif;
				?>
			<?php endif; ?>
		</p>

		<div class="entry-body">
			<?php if ( $bimber_elements['summary'] ) : ?>
				<div class="entry-summary g1-typography-xl">
					<?php the_excerpt(); ?>
				</div>
			<?php endif; ?>


		</div>
	</div>

	<div class="entry-actions snax">
		<?php if ( bimber_can_use_plugin( 'snax/snax.php' ) ) : ?>
			<?php snax_render_voting_box(); ?>
		<?php endif; ?>
	</div>
</article>