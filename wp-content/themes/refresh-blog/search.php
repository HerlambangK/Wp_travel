<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package refresh-blog
 */

get_header();
$container_class = 'container';
$main_column_class    = 'col-xl-12';
$article_column_class = 'col-xxl-3 col-xl-4 col-md-6 col-sm-12';
?>
<div class="inner-content-wrapper page-section">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $main_column_class ); ?>">

				<div id="primary" class="content-area">
					<main id="main" class="site-main">
						<?php if ( is_search() ) : ?>
							<div class="blog-posts-wrapper"> <!-- Blog Wrapper -->
						<?php endif; ?>
		
						<?php if ( have_posts() ) : ?>
			
							<header class="page-header">
								<h1 class="page-title">
									<?php
									/* translators: %s: search query. */
									printf( esc_html__( 'Search Results for: %s', 'refresh-blog' ), '<span>' . get_search_query() . '</span>' );
									?>
								</h1>
							</header><!-- .page-header -->
							<div class="row">

								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();
									?>
									<div class="<?php echo esc_attr( $article_column_class ); ?>">
										<?php
					
										/**
										 * Run the loop for the search to output the results.
										 * If you want to overload this in a child theme then include a file
										 * called content-search.php and that will be used instead.
										 */
										get_template_part( 'template-parts/content', 'search' );

										?>
									</div>
									<?php
				
								endwhile; ?>
							</div>
							
							<?php
			
							the_posts_navigation();
			
						else :
			
							get_template_part( 'template-parts/content', 'none' );
			
						endif;
						?>
						<?php if ( is_search() ) : ?>
						</div> <!-- Blog Wrapper -->
						<?php endif; ?>
		
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>

	</div>
</div>

<?php
get_footer();
