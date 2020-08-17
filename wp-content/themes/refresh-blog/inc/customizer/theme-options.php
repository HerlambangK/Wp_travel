<?php
/**
 * Refresh Blog Theme Options.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

if ( ! function_exists( 'refresh_blog_get_default_theme_options' ) ) :

	/**
	 * Function to get default theme options
	 *
	 * @since 1.0.0
	 * @return array Default theme options.
	 */
	function refresh_blog_get_default_theme_options() {

		$defaults = array();

		// Colors.
		$defaults['header_title_color']   = '#ff9220';
		$defaults['header_tagline_color'] = '#656565';

		// Theme Options > Loader.
		$defaults['enable_loader'] = false;

		// Theme Options > Layout.
		$defaults['page_layout']                = 'page-layout-boxed';
		$defaults['sidebar_position_page']      = 'right-sidebar';
		$defaults['sidebar_position_post']      = 'right-sidebar';
		$defaults['sidebar_position_frontpage'] = 'no-sidebar';
		$defaults['sidebar_position_archive']   = 'right-sidebar';

		// Theme Options > Topbar.
		$defaults['enable_topbar'] = true;

		// Theme Options > Header.
		$defaults['show_title']          = true;
		$defaults['show_tagline']        = true;
		$defaults['sticky_primary_menu'] = true;
		$defaults['absolute_header']     = false;
		$defaults['hide_header_image']   = false;

		// Theme Options > Breadcrumb.
		$defaults['enable_breadcrumb'] = false;

		// Theme Options > Blog.
		$defaults['hide_post_date']           = false;
		$defaults['hide_post_author']         = false;
		$defaults['hide_post_category']       = false;
		$defaults['hide_post_tags']           = false;
		$defaults['hide_post_featured_image'] = false;
		$defaults['archive_content_type']     = 'post_excerpt';

		// Theme Options > Excerpt.
		$defaults['excerpt_length'] = 30;
		$defaults['readmore_text']  = __( 'Read More', 'refresh-blog' );

		// Theme Options > Pagination
		$defaults['pagination_type'] = 'default';

		// Theme Options > Footer
		$defaults['footer_copyright'] = __( '&copy; Copyright. All Right Reserved.', 'refresh-blog' );

		// Theme Options > Back to top Options.
		$defaults['back_to_top']  = false;
		$defaults['scroll_speed'] = 1000;

		// Front Page Options > Slider.
		$defaults['enable_slider']          = true;
		$defaults['slider_type']            = 'post_slider';
		$defaults['number_of_slider']       = 3;
		$defaults['header_image_as_slider'] = true;
		$defaults['page_slider_1']          = '';
		$defaults['page_slider_2']          = '';
		$defaults['page_slider_3']          = '';
		$defaults['post_slider_1']          = '';
		$defaults['post_slider_2']          = '';
		$defaults['post_slider_3']          = '';

		// Front Page Options > Content.
		$defaults['hide_home_content'] = false;

		// Front Page Options > Featured Post.
		$defaults['enable_featured_post'] = true;
		$defaults['featured_post_1']      = '';
		$defaults['featured_post_2']      = '';
		$defaults['featured_post_3']      = '';

		// Front Page Options > Call to action Section.
		$defaults['enable_cta']      = true;
		$defaults['cta_title']       = __( 'Call To Action', 'refresh-blog' );
		$defaults['cta_description'] = __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'refresh-blog' );
		$defaults['cta_button_text'] = __( 'Read more', 'refresh-blog' );
		$defaults['cta_button_link'] = '#';
		$defaults['cta_background']  = get_template_directory_uri() . '/assets/images/call-to-action.jpg';

		// Front Page Options > Latest Blogs Section.
		$defaults['enable_blog']       = true;
		$defaults['blog_title']        = __( 'Latest Blogs', 'refresh-blog' );
		$defaults['blog_subtitle']     = __( 'blog sub title', 'refresh-blog' );
		$defaults['hide_blog_content'] = true;

		// Reset All Options.
		$defaults['reset_customizer'] = false;

		$defaults = apply_filters( 'refresh_blog_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;


if ( ! function_exists( 'refresh_blog_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param Mixed $key Option key, It is either string or array.
	 * @return Mixed Option.
	 */
	function refresh_blog_get_option( $key = '' ) {

		// Getting Default Options.
		$default_theme_options = refresh_blog_get_default_theme_options();
		// Saved Theme Options.
		$theme_options = get_theme_mod( 'theme_options', $default_theme_options );

		// Theme option merged.
		$theme_options = array_merge( $default_theme_options, $theme_options );

		// Return all result if no key.
		if ( ! $key ) {
			return $theme_options;
		}

		if ( is_array( $key ) ) {
			if ( empty( $key ) ) {
				return;
			}
			// Return Specified option as per key [array].
			$options = array();
			foreach ( $key as $k ) {
				if ( isset( $theme_options[ $k ] ) ) {
					$options[ $k ] = $theme_options[ $k ];
				}
			}
		} else {
			// Return Specified option as per key [string].
			$options = '';

			if ( isset( $theme_options[ $key ] ) ) {
				$options = $theme_options[ $key ];
			}
		}

		return $options;
	}

endif;


/**
 * Page Layout Dropdown options.
 */
if ( ! function_exists( 'refresh_blog_page_layouts' ) ) :
	/**
	 * Global layout
	 *
	 * @return array Global layout options.
	 */
	function refresh_blog_page_layouts() {
		$refresh_blog_page_layouts = array(
			'page-layout-boxed'  => get_template_directory_uri() . '/assets/images/layout/boxed.png',
			'page-layout-framed' => get_template_directory_uri() . '/assets/images/layout/framed.png',
		);

		return apply_filters( 'refresh_blog_filter_page_layouts', $refresh_blog_page_layouts );
	}
endif;

/**
 * Sidebar Position Dropdown options.
 */
if ( ! function_exists( 'refresh_blog_sidebar_positions' ) ) :
	/**
	 * Sidebar layout
	 *
	 * @return array layout options.
	 */
	function refresh_blog_sidebar_positions() {
		$refresh_blog_sidebar_positions = array(
			'left-sidebar'  => get_template_directory_uri() . '/assets/images/layout/left.png',
			'right-sidebar' => get_template_directory_uri() . '/assets/images/layout/right.png',
			'no-sidebar'    => get_template_directory_uri() . '/assets/images/layout/framed.png',
		);

		return apply_filters( 'refresh_blog_filter_sidebar_positions', $refresh_blog_sidebar_positions );
	}
endif;

if ( ! function_exists( 'refresh_blog_slider_type' ) ) :
	/**
	 * Slider Type
	 *
	 * @return array layout options.
	 */
	function refresh_blog_slider_type() {
		$slider_type = array(
			'page_slider' => __( 'Page Slider', 'refresh-blog' ),
			'post_slider' => __( 'Post Slider', 'refresh-blog' ),
		);
		$output      = apply_filters( 'refresh_blog_filter_slider_type', $slider_type );
		return $output;
	}
endif;

if ( ! function_exists( 'refresh_blog_archive_content_type' ) ) :
	/**
	 * Archive Content TYpe layout
	 *
	 * @return array layout options.
	 */
	function refresh_blog_archive_content_type() {
		$content_type = array(
			'full_content' => __( 'Full Content', 'refresh-blog' ),
			'post_excerpt' => __( 'Post Excerpt', 'refresh-blog' ),
		);
		$output       = apply_filters( 'refresh_blog_filter_archive_content_type', $content_type );
		return $output;
	}
endif;

if ( ! function_exists( 'refresh_blog_pagination_type' ) ) :
	/**
	 * Pagination type.
	 *
	 * @return array pagination type.
	 */
	function refresh_blog_pagination_type() {
		$content_type = array(
			'default' => __( 'Default', 'refresh-blog' ),
		);
		$output       = apply_filters( 'refresh_blog_filter_pagination_type', $content_type );
		return $output;
	}
endif;
