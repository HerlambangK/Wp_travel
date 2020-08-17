<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package refresh-blog
 */

get_header();

$args = array(
	'page_layout',
	'sidebar_position_archive',
);

$options       = refresh_blog_get_option( $args );
$page_layout   = $options['page_layout'];
$sidebar_class = $options['sidebar_position_archive'];

$container_class = 'container';

$main_column_class    = 'col-xxl-9 col-xl-8';
$article_column_class = 'col-xxl-4 col-md-6 col-sm-12';
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
					<main id="main" class="site-main">

						<?php if ( is_home() || is_archive() ) : ?>
							<div class="blog-posts-wrapper"> <!-- Blog Wrapper -->
						<?php endif; ?>
						<div class="row">
							<?php
							if ( have_posts() ) {

								while ( have_posts() ) :
									the_post();
									?>
									<div class="<?php echo esc_attr( $article_column_class ); ?>">
									<?php
									get_template_part( 'template-parts/content-archive' );

									?>
									</div>
									<?php
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop.
								do_action( 'refresh_blog_action_posts_navigation' );
							} else {
								get_template_part( 'template-parts/content', 'none' );
							}
							?>
						</div>

						<?php if ( is_home() || is_archive() ) : ?>
							</div> <!-- Blog Wrapper -->
						<?php endif; ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<?php
			if ( 'right-sidebar' == $sidebar_class ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>

<?php
get_footer();
