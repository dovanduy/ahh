<?php
/**
 * The Template Part for displaying search form.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.4
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>

<?php
global $bimber_searchform_data;

if ( empty( $bimber_searchform_data['final_class'] ) ) {
	$bimber_searchform_data['final_class'] = array( 'g1-searchform-tpl-default' );
}

if ( empty( $bimber_searchform_data['input_label'] ) ) {
	$bimber_searchform_data['input_label'] = esc_html_x( 'Search &hellip;', 'placeholder', 'bimber' );
}

if ( empty( $bimber_searchform_data['submit_label'] ) ) {
	$bimber_searchform_data['submit_label'] = esc_html_x( 'Search', 'submit button', 'bimber' );
}

if ( bimber_is_ajax_search_enabled() ) {
	$bimber_searchform_data['final_class'][] = 'g1-searchform-ajax';
}
?>

<div role="search" class="search-form-wrapper">
	<form method="get"
	      class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $bimber_searchform_data['final_class'] ) ); ?> search-form"
	      action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label>
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'bimber' ); ?></span>
			<input type="search" class="search-field"
			       placeholder="<?php echo esc_attr( $bimber_searchform_data['input_label'] ); ?>"
			       value="<?php echo esc_attr( get_search_query() ); ?>" name="s"
			       title="<?php echo esc_attr_x( 'Search for:', 'label', 'bimber' ); ?>"/>
		</label>
		<button class="search-submit"><?php echo esc_html( $bimber_searchform_data['submit_label'] ); ?></button>
	</form>

	<?php if ( bimber_is_ajax_search_enabled() ) : ?>
		<div class="g1-searches g1-searches-ajax"></div>
	<?php endif; ?>
</div>
