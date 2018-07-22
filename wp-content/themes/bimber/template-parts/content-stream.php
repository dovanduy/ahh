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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-tpl-stream' ); ?> itemscope=""
         itemtype="<?php echo esc_attr( bimber_get_entry_microdata_itemtype() ); ?>">

	<header class="entry-header">

		<div class="entry-before-title">
			<?php
			if ( $bimber_elements['categories'] ) :
				bimber_render_entry_categories();
			endif;
			?>

			<?php bimber_render_entry_flags(); ?>
		</div>

		<?php the_title( sprintf( '<h2 class="g1-alpha g1-alpha-1st entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header>

	<?php
	if ( $bimber_elements['featured_media'] ) :
		bimber_render_entry_featured_media( array(
			'size'          => 'bimber-stream',
			'use_ellipsis'  => true,
			'allow_video'   => true,
			'use_microdata' => true,
		) );
	endif;

	?>

	<div class="entry-body">
		<?php if ( $bimber_elements['author'] || $bimber_elements['date'] ) : ?>
			<p class="g1-meta entry-meta entry-byline <?php if ( $bimber_elements['avatar'] ) { echo sanitize_html_class( 'entry-byline-with-avatar' );}?>">
				<?php
				if ( $bimber_elements['author'] ) :
					bimber_render_entry_author( array( 'avatar' => $bimber_elements['avatar'], 'use_microdata' => true ) );
				endif;
				?>

				<?php
				if ( $bimber_elements['date'] ) :
					bimber_render_entry_date( array( 'use_microdata' => true ) );
				endif;
				?>
			</p>
		<?php endif; ?>

		<?php if ( $bimber_elements['summary'] ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="entry-footer snax">
		<?php
			if ( bimber_can_use_plugin( 'snax/snax.php' ) ) :
				snax_render_voting_box();
			endif;
		?>

		<?php
		bimber_render_entry_stats( array(
			'share_count'   => $bimber_elements['shares'],
			'view_count'    => $bimber_elements['views'],
			'comment_count' => $bimber_elements['comments_link'],
		) );
		bimber_render_missing_metadata( array(
			'layout' => 'stream',
			'elements'  => $bimber_elements,
		) );
		?>

		<?php bimber_render_compact_share_buttons(); ?>
		<?php do_action( 'bimber_after_stream_content' );?>
	</div>
</article>