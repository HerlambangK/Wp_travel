<?php
/**
 * Refresh Blog Author Widget.
 *
 * @since refresh-blog 1.0.0
 */
if ( ! class_exists( 'Refresh_Blog_Author_Profile_Widget' ) ) :

	class Refresh_Blog_Author_Profile_Widget extends Refresh_Blog_Widget {

		public $image_field = 'image';  // the image field ID

		public function __construct() {
			$widget_ops = array(
				'description'                 => esc_html__( 'Widget for your profile.', 'refresh-blog' ),
				'customize_selective_refresh' => true,
			);

			parent::__construct(
				'refresh_blog_author_profile_widget',
				esc_html__( 'Refresh Blog Author', 'refresh-blog' ),
				$widget_ops
			);

			$this->fields = array(
				'title'       => array(
					'label'   => esc_html__( 'Title', 'refresh-blog' ),
					'type'    => 'text',
					'default' => esc_html__( 'About the Author', 'refresh-blog' ),
				),
				'page_id'     => array(
					'label' => esc_html__( 'Select Page', 'refresh-blog' ),
					'type'  => 'dropdown-pages',
				),
				'sub_title'   => array(
					'label'   => esc_html__( 'Sub Title', 'refresh-blog' ),
					'type'    => 'text',
					'default' => esc_html__( 'Blogger', 'refresh-blog' ),
				),
				'btn_text'    => array(
					'label'   => esc_html__( 'Button Text', 'refresh-blog' ),
					'type'    => 'text',
					'default' => esc_html__( 'About Me', 'refresh-blog' ),
				),
				'social_menu' => array(
					'label' => esc_html__( 'Select Social Menu', 'refresh-blog' ),
					'type'  => 'dropdown-menus',
				),
			);
		}

		public function widget( $args, $instance ) {
			echo $args['before_widget'];

			$instance  = $this->init_defaults( $instance );
			$unique_id = uniqid(); ?>
			<?php if ( $instance['page_id'] ) : ?>

				<?php
				echo '<div class="widget-title-wrap">' . $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'] . '</div>';

				$query = new WP_Query(
					array(
						'p'         => $instance['page_id'],
						'post_type' => 'page',
					)
				);

				while ( $query->have_posts() ) {
					$query->the_post();
					$default = sprintf( '%s/assets/images/default-profile.jpg', get_template_directory_uri() );
					$src     = refresh_blog_get_post_thumbnail_url( $instance['page_id'], 'refresh-blog-square-thumbnail-small', $default, false );
					$profile_empty_class = empty( $src ) ? 'profile-empty' : '';
					?>
					<div class="widget-content">
						<div class="profile <?php echo esc_attr( $profile_empty_class ); ?>">
							<div class="avatar">
								<figure>
									<?php if ( ! empty( $src ) ) : ?>
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url( $src ); ?>" alt="<?php the_title_attribute(); ?>" >
										</a>
									<?php endif; ?>
								</figure>
							</div>
							<div class="name-title">
								<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
								<h3><?php echo esc_html( $instance['sub_title'] ); ?></h3>
							</div>
							<div class="socialgroup">
								<?php echo $this->get_menu( $instance['social_menu'] ); ?>
							</div>
							<div class="read-more">
								<a href="<?php the_permalink(); ?>" class="btn btn-primary" >
									<?php echo esc_html( $instance['btn_text'] ); ?>
								</a>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			<?php endif; ?>
			<?php

			wp_reset_postdata();
			echo $args['after_widget'];
		}
	}

endif;
