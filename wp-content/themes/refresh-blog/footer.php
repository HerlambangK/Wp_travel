<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package refresh-blog
 */
$footer_copyright = refresh_blog_get_option( 'footer_copyright');
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php do_action( 'refresh_blog_action_before_footer' ); ?>
		
		<div class="site-info">
			<?php if ( $footer_copyright ) : ?>
				<div><?php echo esc_html( $footer_copyright ); ?></div>
			<?php endif; ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'refresh-blog' ) ); ?>" target="_blank">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'refresh-blog' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'refresh-blog' ), 'Refresh Blog', '<a href="http://refreshthemes.com/" target="_blank">Refresh Themes</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
