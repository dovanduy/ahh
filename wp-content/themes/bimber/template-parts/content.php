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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-tpl-index' ); ?> itemscope=""
         itemtype="<?php echo esc_attr( bimber_get_entry_microdata_itemtype() ); ?>">

	<header class="entry-header">
		<div class="entry-before-title">
			<?php
			if ( $bimber_elements['categories'] ) :
				bimber_render_entry_categories();
			endif;
			?>

			<?php bimber_render_entry_flags( array( 'show_collections' => false ) ); ?>
		</div>

		<?php the_title( sprintf( '<h2 class="g1-mega g1-mega-1st entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( $bimber_elements['author'] || $bimber_elements['date'] || $bimber_elements['views'] || $bimber_elements['comments_link'] ) : ?>
			<p class="g1-meta g1-meta-m entry-meta entry-meta-m">
                    <span class="entry-byline entry-byline-m <?php if ( $bimber_elements['avatar'] ) { echo sanitize_html_class( 'entry-byline-with-avatar' );}?>">
						<?php
						if ( $bimber_elements['author'] ) :
							bimber_render_entry_author( array(
								'avatar'        => $bimber_elements['avatar'],
								'avatar_size'   => 40,
								'use_microdata' => true,
							) );
						endif;
						?>

						<?php
						if ( $bimber_elements['date'] ) :
							bimber_render_entry_date( array( 'use_microdata' => true ) );
						endif;
						?>
				</span>

				<span class="entry-stats entry-stats-m">

					<?php
					if ( $bimber_elements['views'] ) :
						bimber_render_entry_view_count();
					endif;
					?>

					<?php
					if ( $bimber_elements['comments_link'] ) :
						bimber_render_entry_comments_link();
					endif;
					?>
				</span>
			</p>
		<?php endif; ?>

	</header>

	<?php
	if ( $bimber_elements['featured_media'] ) :
		bimber_render_entry_featured_media( array(
			'size'          => 'bimber-grid-2of3',
			'allow_video'   => true,
			'use_microdata' => true,
		) );
	endif;
	?>

	<?php if ( $bimber_elements['summary'] ) : ?>
		<div class="entry-summary g1-typography-xl">
		<?php if( strpos( get_the_content(), 'more-link' ) === false ) {
			the_excerpt();
		} else {
			the_content( __( 'Continue reading', 'bimber' ) );
		}
		?>
		</div>
	<?php endif;
		bimber_render_missing_metadata( array(
			'layout' => 'index',
			'elements'  => $bimber_elements,
		) ); ?>
</article>
