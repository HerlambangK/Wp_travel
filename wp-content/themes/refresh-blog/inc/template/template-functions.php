<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package refresh-blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function refresh_blog_body_classes( $classes ) {
	$post_id = get_the_ID();

	$classes[] = 'refresh_blog lite-version classic-menu';
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$options = refresh_blog_get_option();

	$sticky_primary_menu = $options['sticky_primary_menu'];
	$absolute_header     = $options['absolute_header'];
	$page_layout         = $options['page_layout'];

	if ( $sticky_primary_menu ) {
		$classes[] = 'sticky-menu';
	}

	if ( $absolute_header && ( is_home() || is_front_page() ) ) {
		$classes[] = 'absolute-header';

	} else {
		$classes[] = 'relative-header';
	}

	// Sidebar class for post and pages.
	$classes[] = refresh_blog_get_sidebar_class( $post_id );

	if ( ! is_home() && ! is_front_page() ) {
		$classes[] = 'refresh_blog-inner-page';
	}
	// Global Layout Class.
	if ( $page_layout ) {
		$classes[] = $page_layout;
	}

	return $classes;
}

/**
 * Function to return sidebar class.
 *
 * @since 1.0.6
 */
function refresh_blog_get_sidebar_class( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	if ( ! is_active_sidebar( 'sidebar-1' ) || is_404() ) {
		$sidebar_class = 'no-sidebar';
	} else {
		$args = array( 'sidebar_position_archive', 'sidebar_position_frontpage', 'sidebar_position_page', 'sidebar_position_post' );
		$options = refresh_blog_get_option( $args );

		if ( is_archive() || is_home() ) {
			$sidebar_class = $options['sidebar_position_archive'];
		} elseif ( is_front_page() ) {
			$sidebar_class = $options['sidebar_position_frontpage'];
		} elseif ( is_page( $post_id ) ) {
			$sidebar_class = $options['sidebar_position_page'];
		} else {
			$sidebar_class = $options['sidebar_position_post'];
		}
	}
	$sidebar_class = apply_filters( 'refresh_blog_filter_sidebar_class', $sidebar_class, $post_id );
	return $sidebar_class;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function refresh_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

function refresh_blog_slider_scripts() {
	wp_enqueue_style( 'refresh_blog-slick-style', get_template_directory_uri() . '/assets/plugins/slick/slick.css' );
	wp_enqueue_style( 'refresh_blog-slick-theme-style', get_template_directory_uri() . '/assets/plugins/slick/slick-theme.css' );

	wp_enqueue_script( 'refresh_blog-slick', get_template_directory_uri() . '/assets/plugins/slick/slick.min.js', array( 'jquery' ) );

}

function refresh_blog_hide_home_content_callback( $hide ) {
	return refresh_blog_get_option( 'hide_home_content' );
}

if ( ! function_exists( 'refresh_blog_excerpt_length_callback' ) ) :

	/**
	 * Set excerpt length on archive page.
	 *
	 * @param  int $length Number of words in the excerpt [content].
	 * @return int Length.
	 */
	function refresh_blog_excerpt_length_callback( $length ) {

		$excerpt_length = refresh_blog_get_option( 'excerpt_length' );

		if ( ! empty( $excerpt_length ) ) {
			$length = $excerpt_length;
		}
		return apply_filters( 'refresh_blog_filter_excerpt_length', esc_attr( $length ) );
	}

endif;

if ( ! function_exists( 'refresh_blog_excerpt_read_more' ) ) :

	/**
	 * Implement read more in excerpt
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function refresh_blog_excerpt_read_more( $more ) {

		$output        = $more;
		$readmore_text = refresh_blog_get_option( 'readmore_text' );
		if ( ! empty( $readmore_text ) ) {
			$output = ' <span class="read-more" ><a href="' . esc_url( get_permalink() ) . '" class="btn btn-primary">' . esc_html( $readmore_text ) . '</a></span>';
			$output = apply_filters( 'refresh_blog_filter_excerpt_read_more', $output );
		}
		return $output;
	}

endif;

if ( ! function_exists( 'refresh_blog_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more           Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function refresh_blog_content_more_link( $more, $more_link_text ) {

		$output        = $more;
		$readmore_text = refresh_blog_get_option( 'readmore_text' );

		if ( ! empty( $readmore_text ) ) {
			$output = str_replace( $more_link_text, esc_html( $readmore_text ), $more );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'refresh_blog_read_more_filters' ) ) {
	function refresh_blog_read_more_filters() {
		if ( is_home() || is_front_page() || is_category() || is_tag() || is_author() || is_date() ) {
			add_filter( 'excerpt_length', 'refresh_blog_excerpt_length_callback', 999 );

			add_filter( 'excerpt_more', 'refresh_blog_excerpt_read_more' );
			add_filter( 'the_content_more_link', 'refresh_blog_content_more_link', 10, 2 );
		}
	}
}


add_filter( 'body_class', 'refresh_blog_body_classes' );
add_action( 'wp_head', 'refresh_blog_pingback_header' );
add_action( 'refresh_blog_action_additional_scripts', 'refresh_blog_slider_scripts' );
add_filter( 'refresh_blog_filter_hide_home_content', 'refresh_blog_hide_home_content_callback' );
add_action( 'wp', 'refresh_blog_read_more_filters' );
