<?php
/**
 * Refresh Blog Theme Options Customize Panel.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

 /**
  * Customizer Panels.
  */
function refresh_blog_get_customizer_panels() {
	$panels = array(
		'theme_option_panel'    => array(
			'title'       => esc_html__( 'Theme Options ', 'refresh-blog' ),
			'description' => esc_html__( 'Theme Options.', 'refresh-blog' ),
			'priority'    => 90,
		),
		'homepage_option_panel' => array(
			'title'       => esc_html__( 'Front Page Options ', 'refresh-blog' ),
			'description' => esc_html__( 'Front Page Options.', 'refresh-blog' ),
			'priority'    => 100,
		),
	);
	return apply_filters( 'refresh_blog_filter_customizer_panels', $panels );
}
