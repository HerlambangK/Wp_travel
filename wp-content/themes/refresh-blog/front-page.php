<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package refresh-blog
 */

get_header();
$hide_home_content = apply_filters( 'refresh_blog_filter_hide_home_content', false );
if ( ! $hide_home_content ) :

	if ( is_front_page() && ! is_home() ) :
		?>
		<!-- page.php -->
		<div class="inner-content-wrapper">
			<?php
			/**
			 * refresh_blog_action_front_page hook
			 *
			 * @since 1.0.0
			 */
			do_action( 'refresh_blog_action_front_page' );
			?>
		</div>
		<?php
	else :

		$args = array(
			'page_layout',
			'sidebar_position_archive',
		);

		$options       = refresh_blog_get_option( $args );
		$page_layout   = $options['page_layout'];
		$sidebar_class = refresh_blog_get_sidebar_class();
		$container_class      = 'container';
		$main_column_class    = 'col-xxl-9 col-xl-8';
		$article_column_class = 'col-xxl-4 col-xl-6 col-sm-6';
		if ( 'no-sidebar' === $sidebar_class ) {
			$main_column_class    = 'col-xl-12';
			$article_column_class = 'col-xxl-3 col-xl-4 col-md-6 col-sm-12';
		}
		?>
		<div class="inner-content-wrapper page-section">
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<div class="row">
					<?php
					if ( 'left-sidebar' == $sidebar_class ) {
						get_sidebar();
					}
					?>
					<div class="<?php echo esc_attr( $main_column_class ); ?>">
						<div id="primary" class="content-area">
							<main id="main" class="site-main" role="main">
								<?php if ( is_home() ) : ?>
									<div class="blog-posts-wrapper"> <!-- Blog Wrapper -->
								<?php endif; ?>
								<div class="row">
									<?php
									while ( have_posts() ) :
										the_post();
										?>
										<div class="<?php echo esc_attr( $article_column_class ); ?>">

										<?php
										get_template_part( 'template-parts/content-archive' );

										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;
										?>
										</div>
										<?php

									endwhile; // End of the loop.
									?>
								</div>
								<?php do_action( 'refresh_blog_action_posts_navigation' ); ?>
								<?php if ( is_home() ) : ?>
									</div>
								<?php endif; ?>
							</main> <!-- #main -->
						</div><!-- #primary -->
					</div>

					<?php
					if ( 'right-sidebar' == $sidebar_class ) {
						get_sidebar();
					}
					?>
				</div>
			</div>
		</div><!-- .container -->
		<?php
	endif;
endif;
get_footer();
