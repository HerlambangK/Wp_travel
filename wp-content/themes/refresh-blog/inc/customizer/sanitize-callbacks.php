<?php
/**
 * Refresh Blog Theme Options is active callback.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

if ( ! function_exists( 'refresh_blog_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox value.
	 *
	 * @since 1.0.0
	 *
	 * @param  bool $checked Value of checkbox.
	 * @return bool Return true if checkbox is checked else return false.
	 */
	function refresh_blog_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

endif;

if ( ! function_exists( 'refresh_blog_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed          $input The value to sanitize.
	 * @param Customizer_Obj $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function refresh_blog_sanitize_select( $input, $setting ) {

		$input = sanitize_key( $input );

		$choices = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;


if ( ! function_exists( 'refresh_blog_sanitize_positive_number' ) ) :

	/**
	 * Sanitize positive number without fraction.
	 *
	 * @param int                  $input Number.
	 * @param Customizer_Obj $setting WP_Customize_Setting instance.
	 * @return int Positive Number.
	 */
	function refresh_blog_sanitize_positive_number( $input, $setting ) {

		$input = absint( $input );

		// If the input is an absolute integer, return it.
		// otherwise, return the default.
		return ( $input ? $input : $setting->default );

	}

endif;

