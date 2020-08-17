<?php
/**
 * This file includes all functions containing Theme Template.
 *
 * @package refresh-blog
 * @since 1.0.0
 */

 $options = refresh_blog_get_option();

/**
 * Template hooks.
 */



add_action( 'refresh_blog_action_doctype', 'refresh_blog_doctype' );
add_action( 'refresh_blog_action_head', 'refresh_blog_head' );

if ( isset( $options['enable_loader'] ) && $options['enable_loader'] ) {
	add_action( 'refresh_blog_action_before_start', 'refresh_blog_loader' );
}
if ( isset( $options['back_to_top'] ) && $options['back_to_top'] ) {
	add_action( 'refresh_blog_action_before_start', 'refresh_blog_back_to_top' );
}
add_action( 'refresh_blog_action_before_start', 'refresh_blog_page_wrapper_start' );
add_action( 'refresh_blog_action_before_start', 'refresh_blog_screen_reader_text' );

add_action( 'refresh_blog_action_before_header', 'refresh_blog_header_wrapper_start', 10 );
add_action( 'refresh_blog_action_before_header', 'refresh_blog_top_section', 20 );
add_action( 'refresh_blog_action_header', 'refresh_blog_header' );
add_action( 'refresh_blog_action_after_header', 'refresh_blog_header_wrapper_end' );

add_action( 'refresh_blog_action_before_content', 'refresh_blog_main_content_start' );
add_action( 'refresh_blog_action_content', 'refresh_blog_main_slider', 10 );
add_action( 'refresh_blog_action_content', 'refresh_blog_get_breadcrumb', 20 );

add_action( 'refresh_blog_action_posts_navigation', 'refresh_blog_posts_navigation' );

// Front page sections.
add_action( 'refresh_blog_action_front_page', 'refresh_blog_homepage_content_latest_blog', 10 );
add_action( 'refresh_blog_action_front_page', 'refresh_blog_homepage_content_cta', 20 );
add_action( 'refresh_blog_action_front_page', 'refresh_blog_homepage_content_featured_posts', 30 );
add_action( 'refresh_blog_action_front_page', 'refresh_blog_homepage_content_instagram', 40 );

/**
 * Hook Callback Functions.
 */
if ( ! function_exists( 'refresh_blog_doctype' ) ) {
	/**
	 * Doctype Declearation.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_doctype() {
		?><!doctype html><html <?php language_attributes(); ?>>
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_head' ) ) {
	/**
	 * Header Declearation.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_loader' ) ) {
	/**
	 * Loader.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_loader() {
		?>
		<div id="loader">
			<div class="loader-container">
			
				<div id="preloader">
					<?php $src = sprintf( '%s/assets/images/loader.gif', get_template_directory_uri() ); ?>
					<img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( 'Refresh loader' ); ?>" width="100" >
				</div>
			</div>
		</div><!-- #loader -->
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_back_to_top' ) ) {
	/**
	 * Loader.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_back_to_top() {
		?>
		<a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_page_wrapper_start' ) ) {
	/**
	 * Page Wrapper Start.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_page_wrapper_start() {
		?>
		<div class="site" id="page">
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_screen_reader_text' ) ) {
	/**
	 * Screen reader text.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_screen_reader_text() {
		?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'refresh-blog' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_header_wrapper_start' ) ) {
	/**
	 * Header wrapper start.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_header_wrapper_start() {
		?>
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_top_section' ) ) {
	/**
	 * Top content.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_top_section() {
		$enable = refresh_blog_get_option( 'enable_topbar' );
		if ( $enable ) :
			$contact_number = refresh_blog_get_option( 'contact_number' );
			$contact_email  = refresh_blog_get_option( 'contact_email' );
			?>
			<section id="top-bar" >
				<button class="topbar-toggle"><i class="fas fa-phone"></i></button>
				<div class="container  topbar-dropdown">
					<div class="row">
						<div class="col-md-7">

							<div class="address-block-container clearfix">
								<?php
								wp_nav_menu(
									array(
										'theme_location'  => 'topleft',
										'menu_id'         => 'top-left',
										'fallback_cb'     => false,
										'depth'           => 1,
										'menu_class'      => 'top-left',
										'container_class' => 'top-left-container',
										'fallback_cb'     => 'refresh_blog_menu_fallback_cb',
									)
								);
								?>
							</div><!-- end .address-block-container -->
						</div>
						<div class="col-md-5">

							<?php
							wp_nav_menu(
								array(
									'theme_location'  => 'social',
									'menu_id'         => 'social-menu',
									'link_before'     => '<span class="screen-reader-text">',
									'link_after'      => '</span>',
									'fallback_cb'     => false,
									'depth'           => 1,
									'menu_class'      => 'rt-social-menu',
									'container_class' => 'rt-social-menu-container clearfix',
									'fallback_cb'     => 'refresh_blog_menu_fallback_cb',
								)
							);
							?>
						</div>

					</div>

				</div><!-- end .container -->
			</section><!-- #top-bar -->
			<?php
		endif;
	}
}

if ( ! function_exists( 'refresh_blog_header' ) ) {
	/**
	 * Header section.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_header() {

		$args    = array( 'show_title', 'show_tagline' );
		$options = refresh_blog_get_option( $args );

		$show_title   = $options['show_title'];
		$show_tagline = $options['show_tagline'];

		?>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="site-branding">
						<div class="site-logo">
							<?php refresh_blog_custom_logo(); ?>
						</div>

						<?php if ( true === $show_title || true === $show_tagline ) : ?>
							<div class="site-branding-text">
								<?php if ( true === $show_title ) : ?>
									<?php if ( is_front_page() && is_home() ) : ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php else : ?>
										<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php endif; ?>
								<?php endif; ?>

								<?php if ( true === $show_tagline ) : ?>
									<p class="site-description"><?php bloginfo( 'description' ); ?></p>
								<?php endif; ?>
							</div><!-- #site-identity -->
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-8">
					<div class="site-header-menu" id="site-header-menu">
						<button class="menu-toggle" aria-controls="primary-menu" area-label="<?php esc_html_e( 'Menu', 'refresh-blog' ); ?>" aria-hidden="true" aria-expanded="false">
							<span class="icon"></span>
							<span class="menu-label"><?php esc_html_e( 'Menu', 'refresh-blog' ); ?></span>
						</button>
							<?php
								wp_nav_menu(
									array(
										'container'       => 'nav',
										'container_class' => 'main-navigation',
										'container_id'    => 'site-navigation',
										'menu_class'      => 'menu nav-menu',
										'menu_id'         => 'primary-menu',
										'theme_location'  => 'primary',
										'fallback_cb'     => 'refresh_blog_primary_menu_fallback_cb',
									)
								);
							?>
					</div>
				</div>
			</div>
		</div>
	   
		<?php
	}
}

if ( ! function_exists( 'refresh_blog_header_wrapper_end' ) ) {
	/**
	 * Header wrapper end.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_header_wrapper_end() {
		?>
		</header>
		<?php
	}
}
if ( ! function_exists( 'refresh_blog_main_content_start' ) ) :
	/**
	 *  Main Content Start.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_main_content_start() {
		?>
	<div id="content" class="site-content">
		<?php
	}
endif;

if ( ! function_exists( 'refresh_blog_main_slider' ) ) {
	/**
	 *  Header image / Slider.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_main_slider() {
		$args    = array(
			'enable_slider',
			'slider_type',
			'number_of_slider',
			'header_image_as_slider',
			'hide_header_image',
			'hide_post_author',
			'hide_post_date',
			'readmore_text',
		);
		$options = refresh_blog_get_option( $args );

		$enable_slider          = $options['enable_slider'];
		$header_image_as_slider = $options['header_image_as_slider'];
		$hide_header_image      = $options['hide_header_image'];
		$readmore_text          = $options['readmore_text'];
		$display_slider         = false;
		// Front page.
		if ( is_home() || is_front_page() ) {
			if ( $enable_slider ) {
				$display_slider = true;
			}
		} else { // Other Pages.
			if ( $header_image_as_slider && ! $hide_header_image ) {
				$display_slider = false;
			}
		}

		if ( $display_slider ) {
			$slider_type      = $options['slider_type'];
			$number_of_slider = absint( $options['number_of_slider'] );

			// Getting Slider Ids.
			$slider_args = array();
			if ( $number_of_slider > 0 ) :
				for ( $i = 1; $i <= $number_of_slider; $i++ ) {
					$slider_args[] = sprintf( '%s_%d', $slider_type, $i );
				}
			endif;
			$sliders = refresh_blog_get_option( $slider_args );
			// End of getting Slider Ids.
			if ( $number_of_slider > 0 ) :
				?>
				<div id="custom-header-media" class="relative">
					<div class="overlay"></div>
					<div class="refresh_blog-main-slider">
						<?php
						$post_ids = array();

						$has_slider_count = 0;

						foreach ( $sliders as $slider_id ) {
							if ( ! empty( $slider_id ) ) {
								$post_ids[] = $slider_id;
								$has_slider_count++;
							}
						}

						if ( ! $has_slider_count ) { // use default image if none of post have selected.
							?>
							<div class="slide-item" style="background-image:url('<?php echo esc_url( refresh_blog_get_header_image( true ) ); ?>')" >
								
								<div class="wrapper <?php echo esc_attr( ( is_home() || is_front_page() ) ? 'no-background' : '' ); ?> ">
									<header class="entry-header">
										<h2 class="entry-title">
											<?php refresh_blog_header_title(); ?>
										</h2>
									</header><!-- .entry-header -->
								</div><!-- .wrapper -->
								
							</div>
							<?php
						} else {
							$post_type = ( 'page_slider' === $slider_type ) ? 'page' : 'post';

							$slider_args = array(
								'post_type'           => $post_type,
								'post__in'            => $post_ids,
								'posts_per_page'      => 3,
								'orderby'             => 'post__in',
								'ignore_sticky_posts' => 1,
							);

							$slider_post_query = new WP_Query( $slider_args );
							if ( $slider_post_query->have_posts() ) :
								while ( $slider_post_query->have_posts() ) :
									$slider_post_query->the_post();
									?>
									<div class="slide-item" 
									style="background-image:url('<?php echo esc_url( refresh_blog_get_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>')"
									>

										<div class="wrapper">

											<?php refresh_blog_post_category( get_the_ID() ); ?>
											<header class="entry-header">
												<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title( get_the_ID() ) ); ?></a></h2>
											</header><!-- .entry-header -->
											
											<span class="entry-meta">

												<?php

												if ( 'post' === $post_type ) {

													if ( ! $options['hide_post_author'] ) {
														refresh_blog_posted_by();
													}
													if ( ! $options['hide_post_date'] ) {
														refresh_blog_posted_on();
													}
												} else {
													the_excerpt();
												}
												?>
											</span>
											<div class="read-more">
												<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_html( $readmore_text ); ?></a>
											</div><!-- .read-more -->
										</div><!-- .wrapper -->
									</div>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
						}
						?>
					</div>
				</div>
				<?php
			endif;
			$slider_options = array( 'autoplay' => true );
			$slider_options = apply_filters( 'refresh_blog_slick_slider_options', $slider_options );
			foreach ( $slider_options as $k => $v ) {
				$option = sprintf( '%s:%s,', $k, $v );
			}
			$option = rtrim( $option, ',' );
			?>

			<script>
				jQuery(document).ready(function($) {
					$( '.refresh_blog-main-slider' ).slick( {<?php echo esc_attr( $option ); ?> });
				});
			</script>
			<?php
		} else {
			global $post;
			$url = ( is_home() || is_front_page() || is_archive() ) ? refresh_blog_get_header_image( true, '' ) : refresh_blog_get_post_thumbnail_url( $post->ID, 'full' );
			$url = apply_filters( 'refresh_blog_filter_header_image_url', $url, $post->ID );
			?>
			<div id="custom-header-media" class="relative">
				<?php if ( $url ) : ?>
				<div class="slide-item" style="background-image:url('<?php echo esc_url( $url ); ?>'); " >
				<?php else : ?>
					<div class="slide-item">
				<?php endif; ?>
					<div class="wrapper no-background">
						<header class="entry-header">
							<h2 class="entry-title">
								<?php refresh_blog_header_title( $post->ID ); ?>
							</h2>
						</header><!-- .entry-header -->
					</div>
				</div>
			</div>
			<?php
		}

	}
}

if ( ! function_exists( 'refresh_blog_get_breadcrumb' ) ) {
	/**
	 *  Header image / Slider.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_get_breadcrumb() {

		$enable_breadcrumb = refresh_blog_get_option( 'enable_breadcrumb' );
		if ( $enable_breadcrumb ) {
			$args = array(
				'separator'    => '>',
				'show_current' => 1,
				'show_on_home' => 0,
			);
			if ( is_home() || is_front_page() ) {

				if ( $args['show_on_home'] ) {
					echo '<div id="refresh_blog-breadcrumb">';
					echo '<div class="container">';
					echo '<div class="row">';
					refresh_blog_default_breadcrumb( $args );
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
			} else {
				echo '<div id="refresh_blog-breadcrumb">';
				echo '<div class="container">';
				echo '<div class="row">';

				refresh_blog_default_breadcrumb( $args );
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}
		}

	}
}

if ( ! function_exists( 'refresh_blog_posts_navigation' ) ) :

	/**
	 * Posts navigation
	 *
	 * @since refresh-blog 1.0
	 */
	function refresh_blog_posts_navigation() {
		the_posts_navigation();

	}
  endif;


// Home page sections.
if ( ! function_exists( 'refresh_blog_homepage_content_latest_blog' ) ) {
	/**
	 * Services Section.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_homepage_content_latest_blog() {
		$args    = array(
			'enable_blog',
			'blog_title',
			'blog_subtitle',
			'hide_blog_content',
			'readmore_text',
			'hide_post_featured_image',
			'hide_post_author',
			'hide_post_date',
			'hide_post_category',
		);
		$options = refresh_blog_get_option( $args );

		$enable_blog = $options['enable_blog'];

		if ( $enable_blog ) {

			$all_posts = refresh_blog_get_homepage_blogs();

			if ( is_array( $all_posts ) && count( $all_posts ) > 0 ) {
				global $post;
				$blog_title    = $options['blog_title'];
				$blog_subtitle = $options['blog_subtitle'];
				$readmore_text = $options['readmore_text'];
				?>
				<section class="refresh_blog-section">
					<div class="blog-posts-wrapper container">
						<?php if ( ! empty( $blog_title ) && ! empty( $blog_subtitle ) ) : ?>
							<div class="section-header">
								<?php if ( ! empty( $blog_title ) ) : ?>
									<h2 class="section-title"><?php echo esc_html( $blog_title ); ?></h2>
								<?php endif; ?>
								<?php if ( ! empty( $blog_subtitle ) ) : ?>
									<h5 class="section-subtitle"><?php echo esc_html( $blog_subtitle ); ?></h5>
								<?php endif; ?>
							</div><!-- .section-header -->
						<?php endif; ?>

						<!-- supports col-1, col-2, col-3, col-4 -->
						<div class="section-content row">
							<?php foreach ( $all_posts as $post ) : ?>
								<?php setup_postdata( $post ); ?>
								<div class="col-sm-12 col-md-6 col-lg-4">
								<article id="latest-post-01" class="hentry">
									<div class="featured-image">
										<?php
										if ( ! $options['hide_post_featured_image'] ) {
											refresh_blog_post_thumbnail( 'refresh-blog-thumbnail' );
										}
										?>
										<div class="overlay"></div>
										<div class="read-more">
											<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_html( $readmore_text ); ?></a>
										</div><!-- .read-more -->
									</div><!-- .featured-image -->

									<div class="entry-container">
										<span class="entry-meta">
											<?php
											if ( ! $options['hide_post_date'] ) {
												refresh_blog_posted_on();
											}
											if ( ! $options['hide_post_category'] ) {
												refresh_blog_post_category();
											}
											?>
										</span>

										<header class="entry-header">

										
											<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
										</header>
										
										<?php if ( ! $options['hide_blog_content'] ) : ?>
											<div class="entry-content">
												<?php the_excerpt(); ?>
											</div><!-- .entry-content -->
										<?php endif; ?>
										<div class="entry-footer">
											<?php if ( ! $options['hide_post_author'] ) : ?>
												<?php refresh_blog_posted_by(); ?>
											<?php endif; ?>
											<?php refresh_blog_post_comment(); ?>
										</div><!-- .entry-footer -->
										
									</div><!-- .entry-container -->
								</article>
									</div>
							<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
						</div><!-- .section-content -->

						<div class="section-separator"></div>
					</div><!-- .blog-posts-wrapper -->
				</section><!-- #latest-posts -->
				<?php
			}
		}
	}
}

if ( ! function_exists( 'refresh_blog_homepage_content_cta' ) ) {
	/**
	 * Services Section.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_homepage_content_cta() {
		$args    = array(

			'enable_cta',
			'cta_title',
			'cta_description',
			'cta_button_text',
			'cta_button_link',
			'cta_background',
			'readmore_text',
		);
		$options = refresh_blog_get_option( $args );

		if ( $options['enable_cta'] ) {

			$cta_title       = $options['cta_title'];
			$cta_description = $options['cta_description'];
			$cta_button_text = $options['cta_button_text'];
			$cta_button_link = $options['cta_button_link'];

			$cta_image = get_template_directory_uri() . '/assets/images/call-to-action.jpg';
			if ( ! empty( $options['cta_background'] ) ) {
				$cta_image = $options['cta_background'];

			}
			?>
			<section id="call-to-action" class="refresh_blog-section relative" style="background-image: url( <?php echo esc_url( $cta_image ); ?> )">
				<div class="overlay"></div>
				<div class="container relative">
					<div class="row">
						<div class="col-md-12">

							<?php if ( ! empty( $cta_title ) ) : ?>
								<div class="section-header">
									<h2 class="section-title"><?php echo esc_html( $cta_title ); ?></h2>
								</div><!-- .section-header -->
							<?php endif; ?>
		
							<?php if ( ! empty( $cta_description ) ) : ?>
								<div class="section-content">
								<?php echo esc_html( $cta_description ); ?>
								</div><!-- .section-content -->
							<?php endif; ?>
		
							<div class="read-more">
								<a href="<?php echo esc_url( $cta_button_link ); ?>" class="btn btn-transparent"><?php echo esc_html( $cta_button_text ); ?></a>
							</div><!-- .read-more -->
						</div>
					</div>
				</div><!-- .wrapper -->
			</section><!-- #call-to-action -->
			<?php
		}
	}
}

if ( ! function_exists( 'refresh_blog_homepage_content_featured_posts' ) ) {
	/**
	 * Services Section.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_homepage_content_featured_posts() {
		$args    = array(
			'enable_featured_post',
			'readmore_text',
			'featured_post_1',
			'featured_post_2',
			'featured_post_3',
		);
		$options = refresh_blog_get_option( $args );

		$enable_featured_post = $options['enable_featured_post'];
		if ( $enable_featured_post ) {

			$featured_posts = refresh_blog_get_homepage_featured_post();
			if ( is_array( $featured_posts ) && count( $featured_posts ) > 0 ) :
				?>
				<section id="featured-posts" class="refresh_blog-section relative">
					<div class="wrapper container">
							
						<div class="section-contents clearfix row ">
							<?php foreach ( $featured_posts as $featured_post ) : ?>
								<div class="section-content col-sm-12 col-md-6 col-lg-4" id="section-content-<?php echo esc_attr( $featured_post['thumbnail_url'] ); ?>" >
									<article style="background-image:url('<?php echo esc_url( $featured_post['thumbnail_url'] ); ?>')">
										<div class="background-overlay">
											<!-- <div class="overlay"></div> -->
											<div class="section-body">
												<h3>
													<a href="<?php echo esc_url( $featured_post['link'] ); ?>" target="_self">
														<?php echo $featured_post['title']; ?>
													</a>
												</h3>
												<p><?php echo $featured_post['content']; ?></p>
											</div>
										</div>
									</article>
								</div>
							
							<?php endforeach; ?>
						</div>
					</div>
				</section>

				<?php
			endif;
		}

	}
}

if ( ! function_exists( 'refresh_blog_homepage_content_instagram' ) ) {
	/**
	 * Instagram Feed.
	 *
	 * @since 1.0.0
	 */
	function refresh_blog_homepage_content_instagram() {
		if ( shortcode_exists( 'instagram-feed' ) ) {

			?>
			<section>
				<?php echo do_shortcode( '[instagram-feed]' ); ?>
			</section>
			<?php
		}
	}
}
