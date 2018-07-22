<?php
/**
 * The template part for displaying the footer stamp
 *
 * @package Bimber_Theme 4.10
 */

?>
<?php
$bimber_footer_stamp       = bimber_get_footer_stamp();
$bimber_footer_stamp_label = bimber_get_theme_option( 'footer', 'stamp_label' );
?>

<?php if ( ! empty( $bimber_footer_stamp ) ) : ?>
	<a class="g1-footer-stamp" href="<?php echo esc_url( bimber_get_theme_option( 'footer', 'stamp_url' ) ); ?>">
		<?php
		printf(
			'<img class="g1-footer-stamp-icon" width="%d" height="%d" src="%s" %s alt="" />',
			absint( $bimber_footer_stamp['width'] ),
			absint( $bimber_footer_stamp['height'] ),
			esc_url( $bimber_footer_stamp['src'] ),
			isset( $bimber_footer_stamp['srcset'] ) ? sprintf( 'srcset="%s"', esc_url( $bimber_footer_stamp['srcset'] ) . ' 2x' ) : ''
		);
		?>
		<?php if ( strlen( $bimber_footer_stamp_label ) ) : ?>
			<span class="g1-footer-stamp-label"><?php echo esc_html( $bimber_footer_stamp_label ); ?></span>
		<?php endif; ?>
	</a>
<?php endif;
