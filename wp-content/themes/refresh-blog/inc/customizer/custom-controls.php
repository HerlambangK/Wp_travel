<?php
/**
 * Custom controls include
 *
 * @package refresh-blog
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}
require get_template_directory() . '/inc/customizer/custom-controls/class-radio-image-controls.php';
require get_template_directory() . '/inc/customizer/custom-controls/class-dropdown-post-controls.php';
