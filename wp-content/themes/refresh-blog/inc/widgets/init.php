<?php
/**
 * WP Widgets Init.
 *
 * @since refresh-blog 1.0.0
 */

require get_template_directory() . '/inc/widgets/modules/class-base-widget.php';
require get_template_directory() . '/inc/widgets/modules/author.php';



/**
 * Register Widgets.
 *
 * @since refresh-blog 1.0.0
 */
function refresh_blog_register_widget() {

	$widgets = array(
		'Refresh_Blog_Author_Profile_Widget',
	);

	foreach ( $widgets as $widget ) {
		register_widget( $widget );
	}
}
add_action( 'widgets_init', 'refresh_blog_register_widget' );
