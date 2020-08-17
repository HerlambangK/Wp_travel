<?php
/**
 * Refresh Blog Theme Options is active callback.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

/**
 * Function to check Customizer Section is Enabled or not.
 *
 * @param String $section Section name.
 *
 * @since 1.0.0
 * @package refresh-blog
 */
function refresh_blog_is_section_enabled( $section ) {
	if ( ! $section ) {
		return false;
	}
	// Section status.
	$section_status = refresh_blog_get_option( $section );

	// Check condition only for slider.
	if ( 'slider_enable' === $section ) {
		if ( ! is_home() && ( ( is_front_page() && 'static-frontpage' === $section_status ) || 'entire-site' === $section_status ) ) {
			return true;
		} else {
			return false;
		}
	} else {
		return $section_status;
	}
}

