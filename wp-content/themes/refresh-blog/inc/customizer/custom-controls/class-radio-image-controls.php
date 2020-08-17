<?php
/**
 * Custom Radio controls for customizer
 *
 * @package refresh-blog
 * @since 1.0.0
 */

/**
 * Create a Radio-Image control
 *
 * @link https://github.com/dingo-d/wordpress-theme-customizer-extra-custom-controls/blob/master/inc/customizer/custom-controls.php
 */
class Refresh_Blog_Radio_Image_Control extends WP_Customize_Control {

	/**
	 * Initialize and assign value to the control type.
	 *
	 * @var string
	 */
	public $type = 'radio-image';

	/**
	 * Render the Input radio control to display in the Customizer.
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

		$field_name = '_customize_radio_' . $this->id;
		?>
		<span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
		</span>
		<div id="input_<?php echo esc_attr( $this->id ); ?>" class="input-radio-img">
			<?php foreach ( $this->choices as $value => $label ) : ?>
				<label for="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>">
					<input class="input-radio-img-field" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>" name="<?php echo esc_attr( $field_name ); ?>"
					<?php
					$this->link();
					checked( $this->value(), $value );
					?>
					 />
					<img src="<?php echo esc_url( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
				</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
