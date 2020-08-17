<?php



/**
 * Load Common Helper.
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/helper/helper-common.php';
require get_template_directory() . '/inc/helper/helper-frontpage.php';

 /**
 * Load Theme Options.
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/customizer/theme-options.php';

 /**
 * Load Theme Breadcrumb.
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/breadcrumb/breadcrumb.php';

/**
 * Add Template Blocks. [HTML Doctype, Head].
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/hooks/template-blocks.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template/template-tags.php';

/**
 * Widget Init.
 */
require get_template_directory() . '/inc/widgets/init.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template/template-functions.php';

/**
* TGM plugin additions.
*/
require get_template_directory() . '/inc/tgm-plugin/tgmpa-hook.php';


/**
 * Load Is Active Section of Customizer.
 *
 * @since 1.0.0
 */
require get_template_directory() . '/inc/customizer/is-active.php';
// Customizer Panel & Sections.
require get_template_directory() . '/inc/customizer/panel.php';
require get_template_directory() . '/inc/customizer/sections.php';
require get_template_directory() . '/inc/customizer/settings.php';
require get_template_directory() . '/inc/customizer/customizer-is-active-callback.php';
require get_template_directory() . '/inc/customizer/sanitize-callbacks.php';
require get_template_directory() . '/inc/customizer/custom-controls.php';

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/reset.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
