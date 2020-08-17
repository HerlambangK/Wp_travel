<?php
/**
 * Refresh Blog Theme Options is active callback.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

/**
 * Customizer Callback function to check if slider is active.
 *
 * @since 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool True if the control is active to the current section.
 */
function refresh_blog_customizer_is_slider_enabled( $control ) {
	if ( true === $control->manager->get_setting( 'theme_options[enable_slider]' )->value() ) {
		return true;
	}

	return false;
}

/**
 * Customizer Callback function to check if slider is inactive.
 *
 * @since 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool True if the control is inactive to the current section.
 */
function refresh_blog_customizer_is_slider_disabled( $control ) {
	if ( ! refresh_blog_customizer_is_slider_enabled( $control ) ) {
		return true;
	}

	return false;
}

/**
 * Customizer Callback function to check if Page Slider Type is active.
 *
 * @since 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool True if the control is active to the current section.
 */
function refresh_blog_customizer_is_page_slider_enabled( $control ) {
	// return true;
	$slider_type = $control->manager->get_setting( 'theme_options[slider_type]' )->value();

	if ( refresh_blog_customizer_is_slider_enabled( $control ) && 'page_slider' === $slider_type ) {
		return true;
	}

	return false;
}

/**
 * Customizer Callback function to check if Post Slider Type is active.
 *
 * @since 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool True if the control is active to the current section.
 */
function refresh_blog_customizer_is_post_slider_enabled( $control ) {
	$slider_type = $control->manager->get_setting( 'theme_options[slider_type]' )->value();

	if ( refresh_blog_customizer_is_slider_enabled( $control ) && 'post_slider' === $slider_type ) {
		return true;
	}

	return false;
}

/**
 * Customizer Callback function to check if Topbar Enabled / Disabled.
 *
 * @since 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool True if the control is active to the current section.
 */
function refresh_blog_customizer_is_enable_topbar( $control ) {
	if ( true === $control->manager->get_setting( 'theme_options[enable_topbar]' )->value() ) {
		return true;
	}

	return false;
}
