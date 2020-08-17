<?php
/**
 * Helper functions.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'refresh_blog_custom_logo' ) ) :
	/**
	 * Custom Logo.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

if ( ! function_exists( 'refresh_blog_menu_fallback_cb' ) ) :

	/**
	 * Fallback for navigation.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_menu_fallback_cb( $args ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		switch ( $args['theme_location'] ) {
			case 'social':
				$label = __( 'Add social menu', 'refresh-blog' );
				break;
			case 'topleft':
				$label = __( 'Add top left menu', 'refresh-blog' );
				break;
			default:
				$label = __( 'Add a menu', 'refresh-blog' );
				break;
		}
		// see wp-includes/nav-menu-template.php for available arguments.
		$link = '<a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . $args['link_before'] . $args['before'] . esc_html( $label ) . $args['after'] . $args['link_after'] . '</a>';

		if ( false !== stripos( $args['items_wrap'], '<ul' ) || false !== stripos( $args['items_wrap'], '<ol' )
		) {
			$link = "<li>$link</li>";
		}
		$output = sprintf( $args['items_wrap'], $args['menu_id'], $args['menu_class'], $link );
		if ( ! empty( $args['container'] ) ) {
			$output = sprintf( '<%1$s class="%2$s" id="%3$s">%4$s</%1$s>', $args['container'], $args['container_class'], $args['container_id'], $output );
		}
		if ( $args['echo'] ) {
			echo $output;
		}

		return $output;
	}

endif;

if ( ! function_exists( 'refresh_blog_primary_menu_fallback_cb' ) ) :

	/**
	 * Fallback for Primary menu.
	 *
	 * @since 1.1.1
	 */
	function refresh_blog_primary_menu_fallback_cb( $args ) {
		?>
		<nav id="site-navigation" class="main-navigation">
			<ul id="primary-menu" class="menu nav-menu">
				<?php
				echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'refresh-blog' ) . '</a></li>';  // phpcs:ignore
				wp_list_pages(
					array(
						'title_li' => '',
						'depth'    => 1,
						'number'   => 3,
					)
				);
				?>
			</ul>
		</nav>
		<?php
	}
endif;

if ( ! function_exists( 'refresh_blog_strings' ) ) {
	/**
	 * Return All Theme Strings.
	 *
	 * @since 1.0.0
	 *
	 * Return Array of Strings.
	 */
	function refresh_blog_strings() {
		$strings = array(
			'enable'     => __( 'Enable', 'refresh-blog' ),
			'contact_no' => __( 'Contact Number', 'refresh-blog' ),
		);

		return apply_filters( 'refresh_blog_filter_strings', $strings );
	}
}

if ( ! function_exists( 'refresh_blog_get_post_thumbnail' ) ) {
	/**
	 * Return Post Thumbnails.
	 *
	 * @since 1.0.0
	 *
	 * @return array of Strings
	 */
	function refresh_blog_get_post_thumbnail( $post_id, $image_size = 'thumbnail' ) {
		if ( ! $post_id ) {
			global $post;
			$post_id = $post->ID;
		}

		$thumbnail_id = get_post_thumbnail_id( $post_id );
		if ( $thumbnail_id && ! is_page( $post_id ) ) { // Only for post
			return get_the_post_thumbnail( $post_id, $image_size );
		} elseif ( refresh_blog_get_header_image() ) {
			return refresh_blog_get_header_image();
		}

		// default image;
		return refresh_blog_get_default_thumbnail();
	}
}

if ( ! function_exists( 'refresh_blog_get_post_thumbnail_url' ) ) {
	/**
	 * Return Post Thumbnails.
	 *
	 * @since 1.0.0
	 *
	 * @return array of Strings
	 */
	function refresh_blog_get_post_thumbnail_url( $post_id, $image_size = 'thumbnail', $default_src = '', $return_header_image_if_no_thumbnail = true ) {
		if ( ! $post_id ) {
			global $post;
			$post_id = $post->ID;
		}

		$thumbnail_id = get_post_thumbnail_id( $post_id );
		if ( $thumbnail_id && ! is_page( $post_id ) && get_the_post_thumbnail_url( $post_id, $image_size ) ) { // Only for post
			return get_the_post_thumbnail_url( $post_id, $image_size );
		}

		if ( is_page() && $return_header_image_if_no_thumbnail ) {
			return refresh_blog_get_header_image( true, $default_src, false );
		}

		// default image;
		return refresh_blog_get_default_thumbnail( true, $default_src );
	}
}

if ( ! function_exists( 'refresh_blog_get_default_thumbnail' ) ) {
	/**
	 * Return Default Thumbnail image.
	 *
	 * @since 1.0.0
	 *
	 * @return HTML
	 */
	function refresh_blog_get_default_thumbnail( $return_url = false, $src = '' ) {
		if ( ! $src ) {
			$src = sprintf( '%s/assets/images/default-header.jpg', get_template_directory_uri() );
		}
		if ( $return_url ) {
			return $src;
		}

		return sprintf( '<img src="%s" >', esc_url( $src ) );
	}
}

if ( ! function_exists( 'refresh_blog_get_header_image' ) ) {
	/**
	 * Return Header image.
	 *
	 * @since 1.0.0
	 *
	 * @return HTML
	 */
	function refresh_blog_get_header_image( $return_url = false, $default_src = '', $return_default_if_no_header = true ) {
		$header_image = get_header_image();
		if ( $header_image ) {
			if ( $return_url ) {
				return $header_image; // return src.
			}

			return sprintf( '<img src="%s" >', $header_image );
		}

		$header_images = get_uploaded_header_images();
		if ( $return_default_if_no_header && ( empty( $header_images ) || empty( $header_image ) ) ) {
			if ( $return_url ) {
				return refresh_blog_get_default_thumbnail( true, $default_src ); // return src.
			}
			// Return default thumbnail.
			return refresh_blog_get_default_thumbnail( false, $default_src );
		}

		return false;
	}
}

if ( ! function_exists( 'refresh_blog_header_title' ) ) {
	/**
	 * Return Header image.
	 *
	 * @param $post_id Post Id
	 * @since 1.1.0
	 *
	 * @return HTML
	 */
	function refresh_blog_header_title( $post_id = null ) {
		if ( ! $post_id ) {
			global $post;
			$post_id = $post->ID;
		}

		ob_start();
		if ( is_home() || is_front_page() ) {
			if ( ! is_front_page() && is_home() ) {
				esc_html_e( 'Blog', 'refresh-blog' );
			} else {
				esc_html_e( 'Home', 'refresh-blog' );
			}
		} else {
			if ( is_category() ) {
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Category : ', 'refresh-blog' ), esc_html( single_cat_title( '', false ) ) );
			} elseif ( is_tax() ) {
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Archive : ', 'refresh-blog' ), esc_html( single_cat_title( '', false ) ) );
			} elseif ( is_tag() ) {
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Archive : ', 'refresh-blog' ), esc_html( single_tag_title( '', false ) ) );
			} elseif ( is_day() ) {
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Archive : ', 'refresh-blog' ), esc_html( get_the_time( 'd' ) ) );
			} elseif ( is_month() ) {
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Archive : ', 'refresh-blog' ), esc_html( get_the_time( 'F' ) ) );
			} elseif ( is_year() ) {
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Archive : ', 'refresh-blog' ), esc_html( get_the_time( 'Y' ) ) );
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Author : ', 'refresh-blog' ), esc_html( $userdata->display_name ) );
			} elseif ( is_search() ) {
				echo sprintf( '<span>%s</span><em>%s</em>', esc_html__( 'Search Results for : ', 'refresh-blog' ), get_search_query() );
			} elseif ( is_404() ) {
				esc_html_e( 'Error 404', 'refresh-blog' );
			} elseif ( ! is_single() && ! is_page() && get_post_type() !== 'post' && ! is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo esc_html( $post_type->labels->singular_name );
			} else {
				echo esc_html( get_the_title() );
			}
		}
		$title = ob_get_contents();
		ob_end_clean();
		$title = apply_filters( 'refresh_blog_filter_header_title', $title, $post_id );
		echo $title; // phpcs:ignore
	}
}

if ( ! function_exists( 'refresh_blog_has_woocommerce' ) ) :

	/**
	 * Check if WooCommerce exists.
	 *
	 * @since 1.0.2
	 *
	 * @return bool active status
	 */
	function refresh_blog_has_woocommerce() {
		if ( class_exists( 'WooCommerce' ) ) {
			return true;
		}

		return false;
	}

endif;
