<?php
/**
 * Refresh Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package refresh-blog
 */

if ( ! function_exists( 'refresh_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function refresh_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Refresh Blog, use a find and replace
		 * to change 'Refresh Blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'refresh-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'refresh-blog' ),
				'social'  => esc_html__( 'Social', 'refresh-blog' ),
				'topleft' => esc_html__( 'Top Left', 'refresh-blog' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'refresh_blog_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add Theme Support for footer widgets.
		$number_of_widgets = apply_filters( 'refresh_blog_filter_footer_max_widgets', 4 );
		add_theme_support( 'footer-widgets', 4 );
		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/widgets/class-footer-widgets.php' );

		// Enable excerpt for page.
		add_post_type_support( 'page', 'excerpt' );

		// Archive Images
		add_image_size( 'refresh-blog-thumbnail', 400, 225, true ); // used in Archive.
		add_image_size( 'refresh-blog-featured', 1056, 594, true ); // used in Post Single page.

		add_image_size( 'refresh-blog-square-thumbnail-small', 200, 200, true ); // used in author profile.

	}
endif;
add_action( 'after_setup_theme', 'refresh_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function refresh_blog_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'refresh_blog_filter_content_width', 640 );
}
add_action( 'after_setup_theme', 'refresh_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function refresh_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'refresh-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'refresh-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'refresh_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function refresh_blog_scripts() {
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Styles.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/bootstrap.min.css' );
	wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900|Poppins:400,500,600,700,800,900' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/plugins/fontawesome/css/fontawesome-all.min.css' );
	wp_enqueue_style( 'refresh_blog-style', get_stylesheet_uri() );

	// Scripts Register.
	wp_register_script( 'refresh_blog-scripts', get_template_directory_uri() . '/assets/js/scripts' . $suffix . '.js', array( 'jquery' ) );

	// Script Localize.
	$scroll_speed = refresh_blog_get_option( 'scroll_speed' );
	$localized    = array(
		'strings'      => refresh_blog_strings(),
		'scroll_speed' => $scroll_speed,
	);
	wp_localize_script( 'refresh_blog-scripts', 'refresh_blog', $localized );

	// Script Enqueue.
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/bootstrap.min.js', array( 'jquery' ), '20151215', true );
	wp_enqueue_script( 'match-height', get_template_directory_uri() . '/assets/js/jquery.matchHeight-min.js', array(), '20151215', true );

	wp_enqueue_script( 'refresh_blog-navigation', get_template_directory_uri() . '/assets/js/navigation' . $suffix . '.js', array(), '20151215', true );
	wp_enqueue_script( 'refresh_blog-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js', array(), '20151215', true );
	wp_enqueue_script( 'refresh_blog-scripts' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	do_action( 'refresh_blog_action_additional_scripts' );
}
add_action( 'wp_enqueue_scripts', 'refresh_blog_scripts' );

/**
 * Initialize.
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/init.php';
