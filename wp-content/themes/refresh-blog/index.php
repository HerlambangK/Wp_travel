<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package refresh-blog
 */

get_header();
$sidebar_class = refresh_blog_get_sidebar_class();

$main_column_class = 'col-xxl-9 col-xl-8';
if ( 'no-sidebar' === $sidebar_class ) {
	$main_column_class = 'col-xxl-12 col-xl-12';
}
$hide_home_content = apply_filters( 'refresh_blog_filter_hide_home_content', false );
if ( ! $hide_home_content ) : ?>
	<div class="inner-content-wrapper page-section">
		<div class="container">
			<div class="row">
				<?php
				if ( 'left-sidebar' == $sidebar_class ) {
					get_sidebar();
				}
				?>
				<div class="<?php echo esc_attr( $main_column_class ); ?>">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">

							<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', get_post_format() );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>

						</main> <!-- #main -->
					</div><!-- #primary -->
				</div>
				<?php
				if ( 'right-sidebar' == $sidebar_class ) {
					get_sidebar();
				}
				?>
			</div>
		</div><!-- .container -->
	</div>
	<?php
endif;
get_footer();

