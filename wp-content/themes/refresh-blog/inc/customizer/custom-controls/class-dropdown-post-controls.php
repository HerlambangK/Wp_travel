<?php
/**
 * Custom Dropdown Post controls for customizer
 *
 * @package refresh-blog
 * @since 1.0.0
 */

/**
 * Create a Dropdown Post control
 */
class Refresh_Blog_Customize_Dropdown_Post_Control extends WP_Customize_Control {


	/**
	 * Render the Select dropdown control to display in the Customizer.
	 */
	public function render_content() {

		$post_args = array(
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);

		$posts = get_posts( $post_args );

		if ( ! empty( $posts ) ) {
			?>
			<label>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<select <?php $this->link(); ?>>
					<?php

					printf( '<option value="0" %s>%s</option>', selected( $this->value(), null, false ), esc_html__( 'Select', 'refresh-blog' ) );

					foreach ( $posts as $post ) {
						printf( '<option value="%s" %s>%s</option>', $post->ID, selected( $this->value(), $post->ID, false ), $post->post_title );
					}
					?>
				</select>
			</label>
			<?php
		}

	}
}
