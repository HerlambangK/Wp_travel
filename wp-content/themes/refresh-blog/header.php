<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package refresh-blog
 */

 /**
  * Hook - refresh_blog_action_doctype.
  *
  * @hooked refresh_blog_doctype -  10
  */
 do_action( 'refresh_blog_action_doctype' );
?>
<head>	
	<?php
	/**
	 * Hook - refresh_blog_action_head.
	 *
	 * @hooked refresh_blog_head -  10
	 */
	do_action( 'refresh_blog_action_head' );
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<?php
	/**
	 * Body Open Hook to add Additional scripts inside body tag.
	 */
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}

	/**
	 * Hook - refresh_blog_action_before_start.
	 *
	 * @hooked refresh_blog_loader - 10
	 * @hooked refresh_blog_page_wrapper_start -  10
	 * $hooked refresh_blog_screen_reader_text - 10
	 */
	do_action( 'refresh_blog_action_before_start' );

	/**
	 * Hook - refresh_blog_action_before_header.
	 *
	 * @hooked refresh_blog_header_wrapper_start - 10
	 * @hooked refresh_blog_top_section - 10
	 */
	do_action( 'refresh_blog_action_before_header' );

	/**
	 * Hook - refresh_blog_action_header.
	 *
	 * @hooked refresh_blog_header - 10
	 */
	do_action( 'refresh_blog_action_header' );

	/**
	 * Hook - refresh_blog_action_after_header.
	 *
	 * @hooked refresh_blog_header_wrapper_end - 10
	 * @hooked refresh_blog_slider - 10
	 */
	do_action( 'refresh_blog_action_after_header' );

	/**
	 * Hook - refresh_blog_action_before_content.
	 *
	 * @hooked refresh_blog_main_content_start - 10
	 */
	do_action( 'refresh_blog_action_before_content' );

	/**
	 * Hook - refresh_blog_action_content.
	 *
	 * @hooked refresh_blog_header_content 10
	 */
	do_action( 'refresh_blog_action_content' );
	