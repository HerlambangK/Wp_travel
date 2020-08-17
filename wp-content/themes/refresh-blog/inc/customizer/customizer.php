<?php
/**
 * Refresh Blog: Customizer Main Class.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Refresh_Blog_Customizer' ) ) :

	class Refresh_Blog_Customizer {

		protected $customize;
		protected $panels          = array();
		protected $sections        = array();
		public $fields             = array();
		public $defaults           = array();
		protected static $instance = null;

		public static function init() {
			if ( ! self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Register Customizer.
		 *
		 * @param object $wp_customize customizer Instance
		 *
		 * @since 1.0.0
		 */
		public function register( $wp_customize ) {
			do_action( 'refresh_blog_action_customize_register', $wp_customize );

			$this->customize = $wp_customize;

			$this->panels   = refresh_blog_get_customizer_panels();
			$this->sections = refresh_blog_get_customizer_sections();

			// Removing default header color option.
			// $wp_customize->remove_control( 'header_textcolor' );

			$this->fields = refresh_blog_get_customizer_fields(); // Consist of settings and controls.
			$this->add_panels();
			$this->add_sections();
			foreach ( $this->fields as $key => $field ) {
				$field['id'] = $key;
				$this->add_setting( $field );
				$this->add_control( $field );
			}
		}

		/**
		 * Register / Add Panels.
		 *
		 * @see   https://developer.wordpress.org/themes/customize-api/customizer-objects/
		 */
		protected function add_panels() {
			foreach ( $this->panels as $id => $args ) {
				$panel                = array();
				$panel['title']       = ! empty( $args['title'] ) ? $args['title'] : esc_html( sprintf( 'Panel %s.', $id ) );
				$panel['description'] = ! empty( $args['description'] ) ? $args['description'] : '';
				$panel['priority']    = ! empty( $args['priority'] ) ? $args['priority'] : 10;

				$this->customize->add_panel( $id, $panel );
			}
		}

		/**
		 * Register / Add Sections.
		 *
		 * @see   https://developer.wordpress.org/themes/customize-api/customizer-objects/
		 */
		protected function add_sections() {
			foreach ( $this->sections as $id => $args ) {
				$section['title']          = ! empty( $args['title'] ) ? $args['title'] : esc_html( sprintf( 'Section %s.', $id ) );
				$section['description']    = ! empty( $args['description'] ) ? $args['description'] : '';
				$section['panel']          = ! empty( $args['panel'] ) ? $args['panel'] : '';
				$section['priority']       = ! empty( $args['priority'] ) ? $args['priority'] : 10;
				$section['capability']     = ! empty( $args['capability'] ) ? $args['capability'] : 'edit_theme_options';
				$section['theme_supports'] = ! empty( $args['theme_supports'] ) ? $args['theme_supports'] : '';

				$this->customize->add_section( $id, $section );
			}
		}

		/**
		 * Register / Add Setting.
		 *
		 * @param array $field field array
		 *
		 * @see   https://developer.wordpress.org/themes/customize-api/customizer-objects/
		 */
		protected function add_setting( $field ) {
			$args = array();
			// theme_mod or option.
			$args['type'] = ( isset( $field['settings_type'] ) || ! empty( $field['settings_type'] ) ) ? $field['settings_type'] : 'theme_mod';

			// edit_theme_options
			$args['capability'] = ( isset( $field['capability'] ) || ! empty( $field['capability'] ) ) ? $field['capability'] : 'edit_theme_options';

			$args['theme_supports'] = ( isset( $field['theme_supports'] ) || ! empty( $field['theme_supports'] ) ) ? $field['theme_supports'] : '';
			$args['default']        = ( isset( $field['default'] ) || ! empty( $field['default'] ) ) ? $field['default'] : '';
			// refresh or postMessage
			$args['transport'] = ( isset( $field['transport'] ) || ! empty( $field['transport'] ) ) ? $field['transport'] : 'refresh';

			$args['sanitize_callback']    = ( isset( $field['sanitize_callback'] ) || ! empty( $field['sanitize_callback'] ) ) ? $field['sanitize_callback'] : '';
			$args['sanitize_js_callback'] = ( isset( $field['sanitize_js_callback'] ) || ! empty( $field['sanitize_js_callback'] ) ) ? $field['sanitize_js_callback'] : '';

			$this->customize->add_setting( $field['id'], $args );
		}

		/**
		 * Register / Add Control.
		 *
		 * @param array $field field array
		 *
		 * @see   https://developer.wordpress.org/themes/customize-api/customizer-objects/
		 * @see   https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
		 */
		protected function add_control( $field ) {
			$args = array();

			$args['type']     = isset( $field['type'] ) && ! empty( $field['type'] ) ? $field['type'] : 'text';
			$args['priority'] = isset( $field['priority'] ) && ! empty( $field['priority'] ) ? $field['priority'] : 10;

			if ( isset( $field['section'] ) && ! empty( $field['section'] ) ) {
				$args['section'] = $field['section'];
			}
			if ( isset( $field['label'] ) && ! empty( $field['label'] ) ) {
				$args['label'] = $field['label'];
			}

			if ( isset( $field['description'] ) && ! empty( $field['description'] ) ) {
				$args['description'] = $field['description'];
			}
			if ( isset( $field['input_attrs'] ) && ! empty( $field['input_attrs'] ) ) {
				$args['input_attrs'] = $field['input_attrs'];
			}

			if ( isset( $field['active_callback'] ) ) {
				$args['active_callback'] = $field['active_callback'];
			}

			if ( isset( $field['choices'] ) && is_array( $field['choices'] ) ) {
				$args['choices'] = $field['choices'];
			}

			if ( isset( $field['mime_type'] ) && ! empty( $field['mime_type'] ) ) {
				$args['mime_type'] = $field['mime_type'];
			}
			if ( isset( $field['edit_shortcut'] ) && ! empty( $field['edit_shortcut'] ) ) {
				$args['edit_shortcut'] = $field['edit_shortcut'];
			}

			$field_id = $field['id'];

			switch ( $field['type'] ) {
				case 'color':
					unset( $args['type'] );

					$this->customize->add_control(
						new WP_Customize_Color_Control(
							$this->customize,
							$field_id,
							$args
						)
					);

					break;
				case 'image':
					$this->customize->add_control(
						new WP_Customize_Image_Control(
							$this->customize,
							$field_id,
							$args
						)
					);

					break;
				case 'radio-image':
					$this->customize->add_control(
						new Refresh_Blog_Radio_Image_Control(
							$this->customize,
							$field_id,
							$args
						)
					);
					break;

				case 'dropdown-posts':
					$this->customize->add_control(
						new Refresh_Blog_Customize_Dropdown_Post_Control(
							$this->customize,
							$field_id,
							$args
						)
					);

					break;

				default:
					if ( isset( $field['type'] ) && ! empty( $field['type'] ) ) {
						$args['type'] = $field['type'];
					} else {
						$args['type'] = 'text';
					}

					$this->customize->add_control( $field_id, $args );

					break;
			}

			if ( isset( $field['edit_shortcut'] ) && ! empty( $field['edit_shortcut'] ) ) {
				$this->customize->selective_refresh->add_partial(
					$field['id'],
					array(
						'selector' => $field['edit_shortcut'],
					)
				);
			}
		}
	}

endif;
add_action( 'customize_register', array( Refresh_Blog_Customizer::init(), 'register' ) );
