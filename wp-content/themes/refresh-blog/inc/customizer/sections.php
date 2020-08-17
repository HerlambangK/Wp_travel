<?php
/**
 * Refresh Blog Theme Options Customize Section.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

 /**
  * Customizer Sections.
  */
function refresh_blog_get_customizer_sections() {
	$sections = array(

		// Theme Options.
		'loader_options'         => array(
			'title'    => __( 'Loader', 'refresh-blog' ),
			'priority' => 10,
			'panel'    => 'theme_option_panel',
		),
		'layout_options'         => array(
			'title'    => __( 'Layout', 'refresh-blog' ),
			'priority' => 20,
			'panel'    => 'theme_option_panel',
		),
		'topbar_options'         => array(
			'title'       => __( 'Topbar', 'refresh-blog' ),
			'description' => esc_html__( 'Check to enable Topbar.', 'refresh-blog' ),
			'priority'    => 30,
			'panel'       => 'theme_option_panel',
		),
		'header_options'         => array(
			'title'    => __( 'Header', 'refresh-blog' ),
			'priority' => 40,
			'panel'    => 'theme_option_panel',
		),
		'breadcrumb_options'     => array(
			'title'    => __( 'Breadcrumb', 'refresh-blog' ),
			'priority' => 50,
			'panel'    => 'theme_option_panel',
		),
		'blog_options'           => array(
			'title'    => __( 'Blog', 'refresh-blog' ),
			'priority' => 60,
			'panel'    => 'theme_option_panel',
		),
		'excerpt_options'        => array(
			'title'    => __( 'Excerpt', 'refresh-blog' ),
			'priority' => 70,
			'panel'    => 'theme_option_panel',
		),
		'footer_options'         => array(
			'title'    => __( 'Footer', 'refresh-blog' ),
			'priority' => 90,
			'panel'    => 'theme_option_panel',
		),
		'back_to_top_options'    => array(
			'title'    => __( 'Back to Top', 'refresh-blog' ),
			'priority' => 100,
			'panel'    => 'theme_option_panel',
		),

		// Front Page Options.
		'refresh_blog_slider'    => array(
			'title'    => esc_html__( 'Refresh Blog Slider', 'refresh-blog' ),
			'priority' => 10,
			'panel'    => 'homepage_option_panel',
		),
		'homepage_content'       => array(
			'title'    => esc_html__( 'Content', 'refresh-blog' ),
			'priority' => 20,
			'panel'    => 'homepage_option_panel',
		),
		'homepage_latest_blogs'  => array(
			'title'       => esc_html__( 'Latest Blogs', 'refresh-blog' ),
			'description' => esc_html__( 'For more options, go to "Theme Options > Blog"', 'refresh-blog' ),
			'priority'    => 30,
			'panel'       => 'homepage_option_panel',
		),
		'homepage_cta'           => array(
			'title'    => esc_html__( 'Call to action Section', 'refresh-blog' ),
			'priority' => 40,
			'panel'    => 'homepage_option_panel',
		),
		'homepage_featured_post' => array(
			'title'    => esc_html__( 'Featured Post Section', 'refresh-blog' ),
			'priority' => 50,
			'panel'    => 'homepage_option_panel',
		),
		// Reset All Options.
		'reset_section'          => array(
			'title'    => __( 'Reset All Options', 'refresh-blog' ),
			'priority' => 200,
		),
	);
	return apply_filters( 'refresh_blog_filter_customizer_sections', $sections );
}



