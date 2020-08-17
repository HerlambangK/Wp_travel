<?php
/**
 * Helper functions.
 *
 * @since 1.0.0
 * @package refresh-blog
 */

if ( ! function_exists( 'refresh_blog_get_homepage_featured_post' ) ) {
	function refresh_blog_get_homepage_featured_post() {
		$args    = array(
			'featured_post_1',
			'featured_post_2',
			'featured_post_3',
		);
		$options = refresh_blog_get_option( $args );
		// Default.
		$services_data = array(
			array(
				'title'         => __( 'Featured 1', 'refresh-blog' ),
				'content'       => __( 'Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.', 'refresh-blog' ),
				'link'          => '#',
				'thumbnail_url' => refresh_blog_get_default_thumbnail( true ),
			),
			array(
				'title'         => __( 'Featured 2', 'refresh-blog' ),
				'content'       => __( 'Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Pellentesque in ipsum id orci porta dapibus.', 'refresh-blog' ),
				'link'          => '#',
				'thumbnail_url' => refresh_blog_get_default_thumbnail( true ),
			),
			array(
				'title'         => __( 'Featured 3', 'refresh-blog' ),
				'content'       => __( 'Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui posuere blandit.', 'refresh-blog' ),
				'link'          => '#',
				'thumbnail_url' => refresh_blog_get_default_thumbnail( true ),
			),
		);

		$page_ids = array();
		for ( $i = 1; $i <= 3; $i++ ) {
			$page_id = isset( $options[ 'featured_post_' . $i ] ) ? $options[ 'featured_post_' . $i ] : '';
			if ( ! $page_id ) {
				continue;
			}
			$page_ids[] = $page_id;
		}
		if ( ! empty( $page_ids ) ) {
			$services_args = array(
				'post_type'           => 'post',
				'post__in'            => $page_ids,
				'posts_per_page'      => 3,
				'orderby'             => 'post__in',
				'ignore_sticky_posts' => 1,
			);

			$service_post_query = new WP_Query( $services_args );
			if ( $service_post_query->have_posts() ) :
				$i = 0;
				while ( $service_post_query->have_posts() ) :
					$service_post_query->the_post();

					$title   = get_the_title();
					$content = get_the_content();
					if ( ! empty( $title ) ) {
						$services_data[ $i ]['title'] = $title;
					}
					if ( ! empty( $content ) ) {
						$services_data[ $i ]['content'] = get_the_excerpt();
					}
					$services_data[ $i ]['link']          = get_permalink();
					$services_data[ $i ]['ID']            = get_the_ID();
					$services_data[ $i ]['thumbnail_url'] = refresh_blog_get_post_thumbnail_url( get_the_ID(), 'refresh-blog-thumbnail' );

					$i++;
				endwhile;
				wp_reset_postdata();
			endif;
		}
		return $services_data;
	}
}


if ( ! function_exists( 'refresh_blog_get_homepage_blogs' ) ) {
	function refresh_blog_get_homepage_blogs() {

		$query_args = array(
			'posts_per_page' => 6,
			'no_found_rows'  => true,
			'post_type'      => 'post',
		);
		return get_posts( $query_args );
	}
}
