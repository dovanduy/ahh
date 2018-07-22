<?php
/**
 * The template part for displaying content
 *
 * @package Bimber_Theme 4.10
 */

?>
<?php
$bimber_entry_data = bimber_get_template_part_data();
$bimber_elements   = $bimber_entry_data['elements'];
?>

<article <?php post_class( 'entry-tpl-listxxs' ); ?>>
	<?php
	bimber_render_open_list_badge();
	bimber_render_entry_featured_media( array(
		'size' => 'thumbnail',
	) );
	?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h3 class="g1-epsilon g1-epsilon-1st entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</header>
</article>
