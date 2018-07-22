<?php
/**
 * WP Customizer custom control to use number input HTML field with sortable capabilities
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

/**
 * Class Bimber_Customize_Sortable_Control
 */
class Bimber_Customize_Sortable_Control extends WP_Customize_Control {

	/**
	 * Type of the control
	 *
	 * @var string
	 */
	public $type = 'sortable';

	/**
	 * Group name control belongs to
	 *
	 * @var string
	 */
	public $group_id = '';

	/**
	 * Constructor.
	 *
	 * Supplied `$args` override class property defaults.
	 *
	 * If `$args['settings']` is not defined, use the $id as the setting ID.
	 *
	 * @since 3.4.0
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    See parent constructor doc comment for more details.
	 */
	public function __construct( WP_Customize_Manager $manager, $id, array $args ) {
		parent::__construct( $manager, $id, $args );

		$this->priority = $args['base_priority'] + $this->value();
	}

	/**
	 * Render control HTML output
	 */
	public function render_content() {

		if ( empty( $this->group_id ) ) {
			return;
		}

		?>
		<label data-temp="<?php echo $this->priority; ?>" class="g1-customizer-sortable-control" data-bimber-group-id="<?php echo esc_attr( $this->group_id ); ?>">
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>

			<input type="number" <?php $this->link(); ?> value="<?php echo absint( $this->value() ); ?>" />
		</label>
		<?php
	}
}
