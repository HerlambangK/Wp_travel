<?php
/**
 * Refresh Blog Theme Options Customize Settings.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

 /**
  * Customizer Settings and control fields.
  */
function refresh_blog_get_customizer_fields() {
	$strings  = refresh_blog_strings();
	$default  = refresh_blog_get_default_theme_options();
	$settings = array(
		// Colors.
		'theme_options[header_title_color]'         => array(
			'label'             => __( 'Header Title Color', 'refresh-blog' ),
			'type'              => 'color', // Control type.
			'default'           => $default['header_title_color'],
			'section'           => 'colors',
			'priority'          => 5,
			'sanitize_callback' => 'sanitize_hex_color',
		),

		// Theme Options > Loader.
		'theme_options[enable_loader]'              => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox', // Control type.
			'default'           => $default['enable_loader'],
			'description'       => __( 'Enable loader to show when page is loading.', 'refresh-blog' ),
			'section'           => 'loader_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		// Theme Options > Layout.
		'theme_options[page_layout]'                => array(
			'label'             => __( 'Global Page Layout', 'refresh-blog' ),
			'type'              => 'radio-image',
			'default'           => $default['page_layout'],
			'choices'           => refresh_blog_page_layouts(),
			'section'           => 'layout_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_select',

		),
		'theme_options[sidebar_position_page]'      => array(
			'label'             => __( 'Sidebar Position - Page', 'refresh-blog' ),
			'type'              => 'radio-image',
			'default'           => $default['sidebar_position_page'],
			'choices'           => refresh_blog_sidebar_positions(),
			'section'           => 'layout_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_select',
		),
		'theme_options[sidebar_position_post]'      => array(
			'label'             => __( 'Sidebar Position - Post', 'refresh-blog' ),
			'type'              => 'radio-image',
			'default'           => $default['sidebar_position_post'],
			'choices'           => refresh_blog_sidebar_positions(),
			'section'           => 'layout_options',
			'priority'          => 20,
			'sanitize_callback' => 'refresh_blog_sanitize_select',
		),
		'theme_options[sidebar_position_frontpage]' => array(
			'label'             => __( 'Sidebar Position - Home Page', 'refresh-blog' ),
			'type'              => 'radio-image',
			'default'           => $default['sidebar_position_frontpage'], // Note : Front Page has no sidebar so. it is only for home page [latest blog]
			'choices'           => refresh_blog_sidebar_positions(),
			'section'           => 'layout_options',
			'priority'          => 30,
			'sanitize_callback' => 'refresh_blog_sanitize_select',
		),
		'theme_options[sidebar_position_archive]'   => array(
			'label'             => __( 'Sidebar Position - Blog / archive', 'refresh-blog' ),
			'type'              => 'radio-image',
			'default'           => $default['sidebar_position_archive'],
			'choices'           => refresh_blog_sidebar_positions(),
			'section'           => 'layout_options',
			'priority'          => 40,
			'sanitize_callback' => 'refresh_blog_sanitize_select',
		),
		// Theme Options > Topbar.
		'theme_options[enable_topbar]'              => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox',
			'default'           => $default['enable_topbar'],
			'description'       => __( 'Enable topbar to show social icons and info.', 'refresh-blog' ),
			'section'           => 'topbar_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),

		// Theme Options > Header.
		'theme_options[show_title]'                 => array(
			'label'             => __( 'Show Title', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['show_title'],
			'section'           => 'header_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[show_tagline]'               => array(
			'label'             => __( 'Show Tagline', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['show_tagline'],
			'section'           => 'header_options',
			'priority'          => 20,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[sticky_primary_menu]'        => array(
			'label'             => __( 'Sticky Primary Menu', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['sticky_primary_menu'],
			'section'           => 'header_options',
			'priority'          => 30,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[absolute_header]'            => array(
			'label'             => __( 'Absolute Header', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['absolute_header'],
			'section'           => 'header_options',
			'priority'          => 40,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		// Theme Options > Breadcrumb.
		'theme_options[enable_breadcrumb]'          => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox',
			'default'           => $default['enable_breadcrumb'],
			'description'       => __( 'Enable Breadcrumb on pages.', 'refresh-blog' ),
			'section'           => 'breadcrumb_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),

		// Theme Options > Blog.
		'theme_options[hide_post_date]'             => array(
			'label'             => __( 'Hide Post date.', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['hide_post_date'],
			'section'           => 'blog_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[hide_post_author]'           => array(
			'label'             => __( 'Hide Post author.', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['hide_post_author'],
			'section'           => 'blog_options',
			'priority'          => 20,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[hide_post_category]'         => array(
			'label'             => __( 'Hide Post category.', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['hide_post_category'],
			'section'           => 'blog_options',
			'priority'          => 30,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[hide_post_tags]'             => array(
			'label'             => __( 'Hide Post tags.', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['hide_post_tags'],
			'section'           => 'blog_options',
			'priority'          => 40,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[hide_post_featured_image]'   => array(
			'label'             => __( 'Hide Post featured image.', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['hide_post_featured_image'],
			'section'           => 'blog_options',
			'priority'          => 50,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[hide_blog_content]'          => array(
			'label'             => __( 'Hide Blog Content', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['hide_blog_content'],
			'section'           => 'blog_options',
			'priority'          => 60,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[archive_content_type]'       => array(
			'label'             => __( 'Content Type', 'refresh-blog' ),
			'type'              => 'select',
			'choices'           => refresh_blog_archive_content_type(),
			'default'           => $default['archive_content_type'],
			'section'           => 'blog_options',
			'priority'          => 70,
			'sanitize_callback' => 'refresh_blog_sanitize_select',

		),
		// Theme Options > Excerpt.
		'theme_options[excerpt_length]'             => array(
			'label'             => __( 'Excerpt Length', 'refresh-blog' ),
			'type'              => 'number',
			'default'           => $default['excerpt_length'],
			'input_attrs'       => array(
				'min'  => 20,
				'max'  => 500,
				'step' => 1,
			),
			'section'           => 'excerpt_options',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_positive_number',
		),
		'theme_options[readmore_text]'              => array(
			'label'             => __( 'Read more text', 'refresh-blog' ),
			'type'              => 'text',
			'default'           => $default['readmore_text'],
			'input_attrs'       => array(
				'min'  => 20,
				'max'  => 500,
				'step' => 1,
			),
			'section'           => 'excerpt_options',
			'priority'          => 20,
			'sanitize_callback' => 'sanitize_text_field',
		),

		'theme_options[footer_copyright]'           => array(
			'label'             => __( 'Footer Copyright', 'refresh-blog' ),
			'type'              => 'textarea',
			'default'           => $default['footer_copyright'],
			'section'           => 'footer_options',
			'priority'          => 10,
			'sanitize_callback' => 'sanitize_text_field',
		),

		// Theme Options > Back to Top.
		'theme_options[back_to_top]'                => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox',
			'default'           => $default['back_to_top'],

			'section'           => 'back_to_top_options',
			'priority'          => 100,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[scroll_speed]'               => array(
			'label'             => __( 'Scroll Speed', 'refresh-blog' ),
			'type'              => 'number',
			'default'           => $default['scroll_speed'],
			'input_attrs'       => array(
				'min'  => 500,
				'max'  => 5000,
				'step' => 100,
			),
			'section'           => 'back_to_top_options',
			'priority'          => 100,
			'sanitize_callback' => 'refresh_blog_sanitize_positive_number',
		),

		// Front Page Options > Refresh Blog Slider.
		'theme_options[enable_slider]'              => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox',
			'default'           => $default['enable_slider'],
			'section'           => 'refresh_blog_slider',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[slider_type]'                => array(
			'label'             => __( 'Slider Type', 'refresh-blog' ),
			'type'              => 'select',
			'choices'           => refresh_blog_slider_type(),
			'default'           => $default['slider_type'],
			'section'           => 'refresh_blog_slider',
			'priority'          => 10,
			'active_callback'   => 'refresh_blog_customizer_is_slider_enabled',
			'sanitize_callback' => 'refresh_blog_sanitize_select',
		),
		'theme_options[number_of_slider]'           => array(
			'label'           => __( 'Number of Slider', 'refresh-blog' ),
			'type'            => 'number',
			'default'         => $default['number_of_slider'],
			'input_attrs'     => array(
				'min' => 1,
				'max' => 3,
			),
			'description'     => __( 'Please enter number of slides between 1 - 3. Save them and refresh the page.', 'refresh-blog' ),
			'transport'       => 'postMessage',
			'section'         => 'refresh_blog_slider',
			'priority'        => 10,
			'active_callback' => 'refresh_blog_customizer_is_slider_enabled',
		),
		'theme_options[header_image_as_slider]'     => array(
			'label'             => __( 'Use Header image', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['header_image_as_slider'],
			'description'       => __( 'Use header image instead of slider if slider is disabled.', 'refresh-blog' ),
			'section'           => 'refresh_blog_slider',
			'priority'          => 10,
			'active_callback'   => 'refresh_blog_customizer_is_slider_disabled',
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',

		),

		// Front Page Options > Featured Post Section.
		'theme_options[enable_featured_post]'       => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox',
			'default'           => $default['enable_featured_post'],
			'section'           => 'homepage_featured_post',
			'priority'          => 40,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),

		'theme_options[featured_post_1]'            => array(
			'label'    => __( 'Featured 1', 'refresh-blog' ),
			'type'     => 'dropdown-posts',
			'section'  => 'homepage_featured_post',
			'priority' => 40,
		),
		'theme_options[featured_post_2]'            => array(
			'label'    => __( 'Featured 2', 'refresh-blog' ),
			'type'     => 'dropdown-posts',
			'section'  => 'homepage_featured_post',
			'priority' => 40,
		),
		'theme_options[featured_post_3]'            => array(
			'label'    => __( 'Featured 3', 'refresh-blog' ),
			'type'     => 'dropdown-posts',
			'section'  => 'homepage_featured_post',
			'priority' => 40,
		),
		// Front Page Options > Call to Action Section.
		'theme_options[enable_cta]'                 => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox',
			'default'           => $default['enable_cta'],
			'section'           => 'homepage_cta',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[cta_title]'                  => array(
			'label'             => __( 'Title', 'refresh-blog' ),
			'type'              => 'text',
			'default'           => $default['cta_title'],
			'section'           => 'homepage_cta',
			'priority'          => 20,
			'sanitize_callback' => 'sanitize_text_field',
		),
		'theme_options[cta_description]'            => array(
			'label'             => __( 'Description', 'refresh-blog' ),
			'type'              => 'textarea',
			'default'           => $default['cta_description'],
			'section'           => 'homepage_cta',
			'priority'          => 30,
			'sanitize_callback' => 'sanitize_text_field',
		),
		'theme_options[cta_button_text]'            => array(
			'label'             => __( 'Readmore text', 'refresh-blog' ),
			'type'              => 'text',
			'default'           => $default['cta_button_text'],
			'section'           => 'homepage_cta',
			'priority'          => 40,
			'sanitize_callback' => 'sanitize_text_field',
		),
		'theme_options[cta_button_link]'            => array(
			'label'             => __( 'Readmore link', 'refresh-blog' ),
			'type'              => 'text',
			'default'           => $default['cta_button_link'],
			'section'           => 'homepage_cta',
			'priority'          => 50,
			'sanitize_callback' => 'sanitize_text_field',
		),
		'theme_options[cta_background]'             => array(
			'label'             => __( 'Background Image', 'refresh-blog' ),
			'type'              => 'image',
			'default'           => $default['cta_background'],
			'section'           => 'homepage_cta',
			'priority'          => 50,
			'sanitize_callback' => 'sanitize_text_field',
		),

		// Front Page Options > Latest Blogs Section.
		'theme_options[enable_blog]'                => array(
			'label'             => $strings['enable'],
			'type'              => 'checkbox',
			'default'           => $default['enable_blog'],
			'section'           => 'homepage_latest_blogs',
			'priority'          => 10,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
		'theme_options[blog_title]'                 => array(
			'label'             => __( 'Title', 'refresh-blog' ),
			'type'              => 'text',
			'default'           => $default['blog_title'],
			'section'           => 'homepage_latest_blogs',
			'priority'          => 20,
			'sanitize_callback' => 'sanitize_text_field',
		),
		'theme_options[blog_subtitle]'              => array(
			'label'             => __( 'Sub title', 'refresh-blog' ),
			'type'              => 'textarea',
			'default'           => $default['blog_subtitle'],
			'section'           => 'homepage_latest_blogs',
			'priority'          => 30,
			'sanitize_callback' => 'sanitize_text_field',
		),

		// Homepage Settings.
		'theme_options[hide_home_content]'          => array(
			'label'             => __( 'Hide Homepage Content', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['hide_home_content'],
			'section'           => 'static_front_page',
			'priority'          => 40,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),

		// Reset All Options.
		'theme_options[reset_customizer]'           => array(
			'label'             => __( 'Reset all to default', 'refresh-blog' ),
			'type'              => 'checkbox',
			'default'           => $default['reset_customizer'],
			'description'       => __( 'Caution: Reset all options settings to default. Refresh the page after save to view the effects.', 'refresh-blog' ),
			'transport'         => 'postMessage',
			'section'           => 'reset_section',
			'priority'          => 40,
			'sanitize_callback' => 'refresh_blog_sanitize_checkbox',
		),
	);

	// Number of slides for slider.
	$number_of_slider   = refresh_blog_get_option( 'number_of_slider' );
	$slider_type_labels = refresh_blog_slider_type();
	foreach ( $slider_type_labels as $slider_type => $slider_type_label ) {

		for ( $i = 1; $i <= $number_of_slider; $i++ ) {
			$settings_key              = sprintf( 'theme_options[%s_%d]', $slider_type, $i );
			$settings[ $settings_key ] = array(
				'label'           => sprintf( '# %s %d ', $slider_type_label, $i ),
				'default'         => '',
				'section'         => 'refresh_blog_slider',
				'panel'           => 'homepage_option_panel',
				'priority'        => 10 + $i,
				'active_callback' => "refresh_blog_customizer_is_{$slider_type}_enabled",

			);

			if ( 'page_slider' === $slider_type ) {
				$settings[ $settings_key ]['type'] = 'dropdown-pages'; // Inbuild.
			} elseif ( 'post_slider' === $slider_type ) {
				$settings[ $settings_key ]['type'] = 'dropdown-posts'; // Custom.
			}
		}
	}

	return apply_filters( 'refresh_blog_filter_customizer_settings', $settings );

}
