<?php

/**
 * All shortcodes
 */

/**
 * Logo shortcode for the Custom Header style
 *
 * @since 1.1.1
 */
if (!function_exists('oceanwp_logo_shortcode')) {

	function oceanwp_logo_shortcode($atts)
	{

		// Extract attributes
		extract(shortcode_atts(array(
			'position' 		=> 'left',
		), $atts));

		// Add classes
		$classes 		= array('custom-header-logo', 'clr');
		$classes[] 		= $position;
		$classes 		= implode(' ', $classes); ?>

<div class="<?php echo esc_attr($classes); ?>">
    <?php get_template_part('partials/header/logo'); ?>
</div>

<?php
	}
}
add_shortcode('oceanwp_logo', 'oceanwp_logo_shortcode');

/**
 * Nav menu shortcode for the Custom Header style
 *
 * @since 1.1.1
 */
if (!function_exists('oceanwp_nav_shortcode')) {

	function oceanwp_nav_shortcode($atts)
	{

		// Extract attributes
		extract(shortcode_atts(array(
			'position' 		=> 'left',
		), $atts));

		// Add classes
		$classes 		= array('custom-header-nav', 'clr');
		$classes[] 		= $position;
		$classes 		= implode(' ', $classes); ?>

<div class="<?php echo esc_attr($classes); ?>">
    <?php
			// Navigation
			get_template_part('partials/header/nav');

			// Mobile nav
			get_template_part('partials/mobile/mobile-icon'); ?>
</div>

<?php
	}
}
add_shortcode('oceanwp_nav', 'oceanwp_nav_shortcode');

/**
 * Dynamic date shortcode
 *
 * @since 1.1.1
 */
if (!function_exists('oceanwp_date_shortcode')) {

	function oceanwp_date_shortcode($atts)
	{

		// Extract attributes
		extract(shortcode_atts(array(
			'year' => '',
		), $atts));

		// Var
		$date = '';

		if ('' != $year) {
			$date .= $year . ' - ';
		}

		$date .= date('Y');

		return esc_attr($date);
	}
}
add_shortcode('oceanwp_date', 'oceanwp_date_shortcode');

/**
 * Search form shortcode
 *
 * @since 1.1.9
 */
if (!function_exists('oceanwp_search_shortcode')) {

	function oceanwp_search_shortcode($atts)
	{

		// Extract attributes
		extract(shortcode_atts(array(
			'width' 		=> '',
			'height' 		=> '',
			'placeholder' 	=> esc_html__('Search', 'ocean-extra'),
			'btn_icon' 		=> 'icon-magnifier',
			'post_type' 	=> 'any',
		), $atts));

		// Styles
		$style = array();
		if (!empty($width)) {
			$style[] = 'width: ' . intval($width) . 'px;';
		}
		if (!empty($height)) {
			$style[] = 'height: ' . intval($height) . 'px;min-height: ' . intval($height) . 'px;';
		}
		$style = implode('', $style);

		if ($style) {
			$style = wp_kses($style, array());
			$style = ' style="' . esc_attr($style) . '"';
		}

		$html = '<form method="get" class="oceanwp-searchform" id="searchform" action="' . esc_url(home_url('/')) . '"' . $style . '>';
		$html .= '<input type="text" class="field" name="s" id="s" placeholder="' . strip_tags($placeholder) . '">';
		if ('any' != $post_type) {
			$html .= '<input type="hidden" name="post_type" value="' . esc_attr($post_type) . '">';
		}
		$html .= '<button type="submit" class="search-submit" value=""><i class="' . esc_attr($btn_icon) . '"></i></button>';
		$html .= '</form>';

		// Return
		return $html;
	}
}
add_shortcode('oceanwp_search', 'oceanwp_search_shortcode');

/**
 * Site url shortcode
 *
 * @since 1.1.9
 */
if (!function_exists('oceanwp_site_url_shortcode')) {

	function oceanwp_site_url_shortcode($atts)
	{

		// Extract attributes
		extract(shortcode_atts(array(
			'target' => 'self',
		), $atts));

		$html = '<a href="' . esc_url(home_url('/')) . '" target="_' . esc_attr($target) . '">' . esc_html(get_bloginfo('name')) . '</a>';

		// Return
		return $html;
	}
}
add_shortcode('oceanwp_site_url', 'oceanwp_site_url_shortcode');

/**
 * Login/logout link
 *
 * @since 1.1.9
 */
if (!function_exists('oceanwp_login_shortcode')) {

	function oceanwp_login_shortcode($atts)
	{

		extract(shortcode_atts(array(
			'custom_url' 		=> '',
			'login_text' 		=> esc_html__('Login', 'ocean-extra'),
			'logout_text' 		=> esc_html__('Log Out', 'ocean-extra'),
			'target' 			=> 'self',
			'logout_redirect' 	=> '',
		), $atts));

		// Custom login url
		if (!empty($custom_url)) {
			$login_url = $custom_url;
		} else {
			$login_url = wp_login_url();
		}

		// Logout redirect
		if (!empty($logout_redirect)) {
			$current = get_permalink();
			if (
				'current' == $logout_redirect
				&& $current
			) {
				$logout_redirect = $current;
			} else {
				$logout_redirect = $logout_redirect;
			}
		} else {
			$logout_redirect = home_url('/');
		}

		// Logout link
		if (class_exists('WooCommerce')) {
			$logout_url = wc_logout_url($logout_redirect);
		} else {
			$logout_url = wp_logout_url($logout_redirect);
		}

		// Logged in link
		if (is_user_logged_in()) {
			return '<a href="' . esc_url($logout_url) . '" title="' . esc_attr($logout_text) . '" class="oceanwp-logout">' . strip_tags($logout_text) . '</a>';
		}

		// Logged out link
		else {
			return '<a href="' . esc_url($login_url) . '" title="' . esc_attr($login_text) . '" class="oceanwp-login" target="_' . esc_attr($target) . '">' . strip_tags($login_text) . '</a>';
		}
	}
}
add_shortcode('oceanwp_login', 'oceanwp_login_shortcode');

/**
 * Login/logout link
 *
 * @since 1.2.1
 */
if (!function_exists('oceanwp_current_user_shortcode')) {

	function oceanwp_current_user_shortcode($atts)
	{

		extract(shortcode_atts(array(
			'text' 			=> esc_html__('Welcome back', 'ocean-extra'),
			'display' 		=> 'display_name',
		), $atts));

		// Get current user
		$current_user = wp_get_current_user();

		// Text
		if (!empty($text)) {
			$text = $text . ' ';
		}

		// If logged in
		if (is_user_logged_in()) {
			return $text . $current_user->$display;
		}

		// Return if not logged in
		else {
			return;
		}
	}
}
add_shortcode('oceanwp_current_user', 'oceanwp_current_user_shortcode');

/**
 * WooCommerce fragments
 *
 * @since 1.2.2
 */
if (!function_exists('oceanwp_woo_fragments')) {

	function oceanwp_woo_fragments($fragments)
	{
		$fragments['.wcmenucart-shortcode .wcmenucart-total'] = '<span class="wcmenucart-total">' . WC()->cart->get_total() . '</span>';
		$fragments['.wcmenucart-shortcode .wcmenucart-count'] = '<span class="wcmenucart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
		$fragments['.oceanwp-woo-total'] 			= '<span class="oceanwp-woo-total">' . WC()->cart->get_total() . '</span>';
		$fragments['.oceanwp-woo-cart-count'] 		= '<span class="oceanwp-woo-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'oceanwp_woo_fragments', 10, 1);

/**
 * WooCommerce cart icon
 *
 * @since 1.4.4
 */
if (!function_exists('oceanwp_woo_cart_icon_shortcode')) {

	function oceanwp_woo_cart_icon_shortcode($atts)
	{

		// Return if WooCommerce is not enabled or if admin to avoid error
		if (
			!class_exists('WooCommerce')
			|| is_admin()
		) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if (
			class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()
		) {
			return esc_html__('This shortcode only works in front end', 'ocean-extra');
		}

		extract(shortcode_atts(array(
			'class' 			=> '',
			'style' 			=> 'drop_down',
			'custom_link' 		=> '',
			'total' 			=> false,
			'cart_style' 		=> 'compact',
			'hide_if_empty' 	=> false,
			'color' 			=> '',
			'hover_color' 		=> '',
			'count_color' 		=> '',
			'count_hover_color' => '',
		), $atts));

		// Return items if "hide if empty cart" is checked (for mobile)
		if (
			true == $hide_if_empty
			&& !WC()->cart->cart_contents_count > 0
		) {
			return;
		}

		// Toggle class
		$toggle_class = 'toggle-cart-widget';

		// Define classes to add to li element
		$classes = array('woo-menu-icon', 'bag-style', 'woo-cart-shortcode');

		// Add style class
		$classes[] = 'wcmenucart-toggle-' . $style;

		// Cart style
		if ('compact' != $cart_style) {
			$classes[] = $cart_style;
		}

		// Prevent clicking on cart and checkout
		if ('custom_link' != $style && (is_cart() || is_checkout())) {
			$classes[] = 'nav-no-click';
		}

		// Add toggle class
		else {
			$classes[] = $toggle_class;
		}

		// If custom class
		if (!empty($class)) {
			$classes[] = $class;
		}

		// Turn classes into string
		$classes = implode(' ', $classes);

		// URL
		if ('custom_link' == $style && $custom_link) {
			$url = esc_url($custom_link);
		} else {
			$cart_id = wc_get_page_id('cart');
			if (function_exists('icl_object_id')) {
				$cart_id = icl_object_id($cart_id, 'page');
			}
			$url = get_permalink($cart_id);
		}

		// Style
		if (
			!empty($color)
			|| !empty($hover_color)
			|| !empty($count_color)
			|| !empty($count_hover_color)
		) {

			// Vars
			$css = '';
			$output = '';

			if (!empty($color)) {
				$css .= '.woo-cart-shortcode .wcmenucart-cart-icon .wcmenucart-count {color:' . $color . '; border-color:' . $color . ';}';
				$css .= '.woo-cart-shortcode .wcmenucart-cart-icon .wcmenucart-count:after {border-color:' . $color . ';}';
			}

			if (!empty($hover_color)) {
				$css .= '.woo-cart-shortcode.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count, .show-cart .wcmenucart-cart-icon .wcmenucart-count {background-color: ' . $hover_color . '; border-color:' . $hover_color . ';}';
				$css .= '.woo-cart-shortcode.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count:after, .show-cart .wcmenucart-cart-icon .wcmenucart-count:after {border-color:' . $hover_color . ';}';
			}

			if (!empty($count_color)) {
				$css .= '.woo-cart-shortcode .wcmenucart-cart-icon .wcmenucart-count {color:' . $count_color . ';}';
			}

			if (!empty($count_hover_color)) {
				$css .= '.woo-cart-shortcode.bag-style:hover .wcmenucart-cart-icon .wcmenucart-count, .show-cart .wcmenucart-cart-icon .wcmenucart-count {color:' . $count_hover_color . ';}';
			}

			// Add style
			if (!empty($css)) {
				echo "<style type=\"text/css\">\n" . wp_strip_all_tags(oceanwp_minify_css($css)) . "\n</style>";
			}
		}

		ob_start(); ?>

<div class="<?php echo esc_attr($classes); ?>">
    <a href="<?php echo esc_url($url); ?>" class="wcmenucart-shortcode">
        <?php
				if (true == $total) { ?>
        <span class="wcmenucart-total"><?php WC()->cart->get_total(); ?></span>
        <?php } ?>
        <span class="wcmenucart-cart-icon">
            <span class="wcmenucart-count"><?php WC()->cart->get_cart_contents_count(); ?></span>
        </span>
    </a>
    <?php
			if (
				'drop_down' == $style
				&& !is_cart()
				&& !is_checkout()
			) { ?>
    <div class="current-shop-items-dropdown owp-mini-cart clr">
        <div class="current-shop-items-inner clr">
            <?php the_widget('WC_Widget_Cart', 'title='); ?>
        </div>
    </div>
    <?php } ?>
</div>

<?php
		return ob_get_clean();
	}
}
add_shortcode('oceanwp_woo_cart', 'oceanwp_woo_cart_icon_shortcode');

/**
 * WooCommerce total cart
 *
 * @since 1.2.2
 */
if (!function_exists('oceanwp_woo_total_cart_shortcode')) {

	function oceanwp_woo_total_cart_shortcode()
	{

		// Return if WooCommerce is not enabled or if admin to avoid error
		if (
			!class_exists('WooCommerce')
			|| is_admin()
		) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if (
			class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()
		) {
			return esc_html__('This shortcode only works in front end', 'ocean-extra');
		}

		$html  = '<span class="oceanwp-woo-total">';
		$html .= WC()->cart->get_total();
		$html .= '</span>';

		return $html;
	}
}
add_shortcode('oceanwp_woo_total_cart', 'oceanwp_woo_total_cart_shortcode');

/**
 * WooCommerce items cart
 *
 * @since 1.2.2
 */
if (!function_exists('oceanwp_woo_cart_items_shortcode')) {

	function oceanwp_woo_cart_items_shortcode()
	{

		// Return if WooCommerce is not enabled or if admin to avoid error
		if (
			!class_exists('WooCommerce')
			|| is_admin()
		) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if (
			class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()
		) {
			return esc_html__('This shortcode only works in front end', 'ocean-extra');
		}

		$html  = '<span class="oceanwp-woo-cart-count">';
		$html .= WC()->cart->get_cart_contents_count();
		$html .= '</span>';

		return $html;
	}
}
add_shortcode('oceanwp_woo_cart_items', 'oceanwp_woo_cart_items_shortcode');

/**
 * WooCommerce free shipping left
 *
 * @since 1.2.2
 */
if (!function_exists('oceanwp_woo_free_shipping_left')) {

	function oceanwp_woo_free_shipping_left($content, $content_reached, $multiply_by = 1)
	{

		// Return if WooCommerce is not enabled
		if (!class_exists('WooCommerce')) {
			return;
		}

		// Return if is in the Elementor edit mode, to avoid error
		if (
			class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()
		) {
			return;
		}

		if (empty($content)) {
			$content = esc_html__('Buy for %left_to_free% more and get free shipping', 'ocean-extra');
		}

		if (empty($content_reached)) {
			$content_reached = esc_html__('You have Free delivery!', 'ocean-extra');
		}

		$min_free_shipping_amount = 0;

		$legacy_free_shipping = new WC_Shipping_Legacy_Free_Shipping();
		if ('yes' === $legacy_free_shipping->enabled) {
			if (in_array($legacy_free_shipping->requires, array('min_amount', 'either', 'both'))) {
				$min_free_shipping_amount = $legacy_free_shipping->min_amount;
			}
		}
		if (0 == $min_free_shipping_amount) {
			if (function_exists('WC') && ($wc_shipping = WC()->shipping) && ($wc_cart = WC()->cart)) {
				if ($wc_shipping->enabled) {
					if ($packages = $wc_cart->get_shipping_packages()) {
						$shipping_methods = $wc_shipping->load_shipping_methods($packages[0]);
						foreach ($shipping_methods as $shipping_method) {
							if ('yes' === $shipping_method->enabled && 0 != $shipping_method->instance_id) {
								if ('WC_Shipping_Free_Shipping' === get_class($shipping_method)) {
									if (in_array($shipping_method->requires, array('min_amount', 'either', 'both'))) {
										$min_free_shipping_amount = $shipping_method->min_amount;
										break;
									}
								}
							}
						}
					}
				}
			}
		}

		if (0 != $min_free_shipping_amount) {
			if (isset(WC()->cart->cart_contents_total)) {
				$total = (WC()->cart->prices_include_tax) ? WC()->cart->cart_contents_total + array_sum(WC()->cart->taxes) : WC()->cart->cart_contents_total;
				if ($total >= $min_free_shipping_amount) {
					return do_shortcode($content_reached);
				} else {
					$content = str_replace('%left_to_free%',             '<span class="oceanwp-woo-left-to-free">' . wc_price(($min_free_shipping_amount - $total) * $multiply_by) . '</span>', $content);
					$content = str_replace('%free_shipping_min_amount%', '<span class="oceanwp-woo-left-to-free">' . wc_price(($min_free_shipping_amount)          * $multiply_by) . '</span>', $content);
					return $content;
				}
			}
		}
	}
}

if (!function_exists('oceanwp_woo_free_shipping_left_shortcode')) {

	function oceanwp_woo_free_shipping_left_shortcode($atts, $content)
	{

		// Return if WooCommerce is not enabled
		if (!class_exists('WooCommerce')) {
			return;
		}

		// Call the script
		wp_enqueue_script('owp-free-shipping');

		// Initiation data on data attr on span
		$content_data     = '';
		$content_reached  = '';
		if (!empty($atts)) {
			if (isset($atts['content'])) {
				$content_data       = $atts['content'];
			}
			if (isset($atts['content_reached'])) {
				$content_reached  = $atts['content_reached'];
			}
		}

		$x = str_replace('%', '+', $content_data);

		extract(shortcode_atts(array(
			'content'           => esc_html__('Buy for %left_to_free% more and get free shipping', 'ocean-extra'),
			'content_reached'   => esc_html__('You have Free delivery!', 'ocean-extra'),
			'multiply_by'       => 1,
		), $atts));

		return oceanwp_woo_free_shipping_left("<span class='oceanwp-woo-free-shipping' data-content='$x' data-reach='$content_reached'>" . $content . '</span>', '<span class="oceanwp-woo-free-shipping">' . $content_reached . '</span>', $multiply_by);
	}
}
add_shortcode('oceanwp_woo_free_shipping_left', 'oceanwp_woo_free_shipping_left_shortcode');

/**
 * Ajax replay the refresh fragemnt
 *
 * @since 1.4.24
 */
if (!function_exists('update_oceanwp_woo_free_shipping_left_shortcode')) {

	function update_oceanwp_woo_free_shipping_left_shortcode()
	{
		$atts = array();

		if ((isset($_POST['content'])
				&& ($_POST['content'] !== ''))
			|| (isset($_POST['content_rech_data'])
				&& ($_POST['content_rech_data'] !== ''))
		) {

			$atts['content_reached'] 	= $_POST['content_rech_data'];
			$content 					= str_replace('+', '%', $_POST['content']);
			$atts['content'] 			= $content;
			$returnShortCodeValue 		= oceanwp_woo_free_shipping_left_shortcode($atts, '');
			wp_send_json($returnShortCodeValue);
		} else {

			$returnShortCodeValue 		= oceanwp_woo_free_shipping_left_shortcode($atts, '');
			wp_send_json($returnShortCodeValue);
		}
	}
}
add_action('wp_ajax_update_oceanwp_woo_free_shipping_left_shortcode', 'update_oceanwp_woo_free_shipping_left_shortcode');
add_action('wp_ajax_nopriv_update_oceanwp_woo_free_shipping_left_shortcode', 'update_oceanwp_woo_free_shipping_left_shortcode');

/**
 * Add js code
 *
 * @since 1.4.24
 */
function oceanwp_woo_free_shipping_left_script()
{
	wp_register_script('owp-free-shipping', plugins_url('/js/shortcode.min.js', __FILE__), false, true);
}
add_action('wp_enqueue_scripts', 'oceanwp_woo_free_shipping_left_script');

/**
 * Breadcrumb shortcode
 *
 * @since 1.3.3
 */
if (!function_exists('oceanwp_breadcrumb_shortcode')) {

	function oceanwp_breadcrumb_shortcode($atts)
	{

		// Return if is in the Elementor edit mode, to avoid error
		if (
			class_exists('Elementor\Plugin')
			&& \Elementor\Plugin::$instance->editor->is_edit_mode()
		) {
			return esc_html__('This shortcode only works in front end', 'ocean-extra');
		}

		// Return if is in the admin, to avoid conflict with Yoast SEO
		if (is_admin()) {
			return;
		}

		// Return if OceanWP_Breadcrumb_Trail doesn't exist
		if (!class_exists('OceanWP_Breadcrumb_Trail')) {
			return;
		}

		extract(shortcode_atts(array(
			'class' 		=> '',
			'color' 		=> '',
			'hover_color' 	=> '',
		), $atts));

		$args = '';

		// Add a space for the beginning of the class attr
		if (!empty($class)) {
			$class = ' ' . $class;
		}

		// Style
		if (!empty($color) || !empty($hover_color)) {

			// Vars
			$css = '';
			$output = '';

			if (!empty($color)) {
				$css .= '.oceanwp-breadcrumb .site-breadcrumbs, .oceanwp-breadcrumb .site-breadcrumbs a {color:' . $color . ';}';
			}

			if (!empty($hover_color)) {
				$css .= '.oceanwp-breadcrumb .site-breadcrumbs a:hover {color:' . $hover_color . ';}';
			}

			// Add style
			if (!empty($css)) {
				echo "<style type=\"text/css\">\n" . wp_strip_all_tags(oceanwp_minify_css($css)) . "\n</style>";
			}
		}

		// Yoast breadcrumbs
		if (function_exists('yoast_breadcrumb') && current_theme_supports('yoast-seo-breadcrumbs')) {
			$classes = 'site-breadcrumbs clr';
			if ($breadcrumbs_position = get_theme_mod('ocean_breadcrumbs_position')) {
				$classes .= ' position-' . $breadcrumbs_position;
			}
			return yoast_breadcrumb('<nav class="' . $classes . '">', '</nav>');
		}

		$breadcrumb = apply_filters('breadcrumb_trail_object', null, $args);

		if (!is_object($breadcrumb)) {
			$breadcrumb = new OceanWP_Breadcrumb_Trail($args);
		}

		return '<span class="oceanwp-breadcrumb' . $class . '">' . $breadcrumb->get_trail() . '</span>';
	}
}
add_shortcode('oceanwp_breadcrumb', 'oceanwp_breadcrumb_shortcode');


function product_shortcode()
{
	$args = array(
		'headers' => array(
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
		)
	);
	$request = wp_remote_get('http://app.javatraveller.com/api/product?category_id=4', $args);
	$body = wp_remote_retrieve_body($request);
	$data = json_decode($body);


	?>
<div class="elementor-row">
    <?php

		foreach ($data->data as $datas) :

		?>
    <div class="elementor-element elementor-element-3727ab09 elementor-column elementor-col-25 elementor-top-column"
        data-id="3727ab09" data-element_type="column"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-column-wrap  elementor-element-populated"
            style="background-image: url('<?php echo $datas->background_image ?>')">
            <div class="elementor-background-overlay"></div>
            <div class="elementor-widget-wrap">
                <div class="elementor-element elementor-element-4f9f1c03 elementor-widget elementor-widget-spacer"
                    data-id="4f9f1c03" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
                <section
                    class="elementor-element elementor-element-176acf3c elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section"
                    data-id="176acf3c" data-element_type="section"
                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-element elementor-element-eef2073 elementor-column elementor-col-100 elementor-inner-column"
                                data-id="eef2073" data-element_type="column">
                                <div class="elementor-column-wrap  elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-60b338a0 elementor-widget elementor-widget-heading"
                                            data-id="60b338a0" data-element_type="widget"
                                            data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">
                                                    <?php echo $datas->name ?></h2>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-3f0cd27d elementor-widget elementor-widget-text-editor"
                                            data-id="3f0cd27d" data-element_type="widget"
                                            data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-text-editor elementor-clearfix">
                                                    <p style="text-align: center;"><span style="color: #ffffff;" <?php
																															$gh = $datas->highlights;
																															$hg = count($gh);
																															for ($i = 0; $i <= $hg; $i++) {;
																																echo  $datas->highlights[$i]->name;
																																echo "- ";
																															}
																															// echo $hg;
																															?></span> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-element elementor-element-6d043602 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section"
                    data-id="6d043602" data-element_type="section"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-row">
                            <div class="elementor-element elementor-element-742ebfa1 elementor-column elementor-col-50 elementor-inner-column"
                                data-id="742ebfa1" data-element_type="column">
                                <div class="elementor-column-wrap  elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-5955f3bd elementor-icon-list--layout-inline elementor-align-left elementor-widget elementor-widget-icon-list"
                                            data-id="5955f3bd" data-element_type="widget"
                                            data-widget_type="icon-list.default">
                                            <div class="elementor-widget-container">
                                                <ul class="elementor-icon-list-items elementor-inline-items">
                                                    <li class="elementor-icon-list-item">
                                                        <span class="elementor-icon-list-icon">
                                                            <i aria-hidden="true" class="fas fa-map-marker-alt"></i>
                                                        </span>
                                                        <span
                                                            class="elementor-icon-list-text"><?php echo  $datas->category->category_name  ?></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-6d6fac6c elementor-column elementor-col-50 elementor-inner-column"
                                data-id="6d6fac6c" data-element_type="column">
                                <div class="elementor-column-wrap  elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-76d86542 elementor-widget elementor-widget-text-editor"
                                            data-id="76d86542" data-element_type="widget"
                                            data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-text-editor elementor-clearfix">
                                                    <p><?php echo $datas->price ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
}
add_shortcode('product_data', 'product_shortcode');



function destination_shortcode()
{
	$args = array(
		'headers' => array(
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
		)
	);
	$request = wp_remote_get('http://app.javatraveller.com/api/destination-category', $args);
	$body = wp_remote_retrieve_body($request);
	$data = json_decode($body);

	// echo "<pre>";
	// // var_dump($datas);
	// echo $data->data[0]->category_name;
	// echo "</pre>";

?>



<section
    class="elementor-element elementor-element-c666d08 elementor-section-height-full elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-items-middle elementor-section elementor-top-section"
    data-id="c666d08" data-element_type="section"
    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;stretch_section&quot;:&quot;section-stretched&quot;}"
    style="width: 2379px; left: -589.375px;">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-element elementor-element-f23adac elementor-column elementor-col-100 elementor-top-column"
                data-id="f23adac" data-element_type="column">
                <div class="elementor-column-wrap  elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-af0ea3b elementor-widget elementor-widget-heading"
                            data-id="af0ea3b" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <p class="elementor-heading-title elementor-size-default">Destinasi</p>
                            </div>
                        </div>
                        <section
                            class="elementor-element elementor-element-ff0b726 elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section"
                            data-id="ff0b726" data-element_type="section">
                            <div class="elementor-background-overlay"></div>
                            <div class="elementor-container elementor-column-gap-wide">
                                <div class="elementor-row">
                                    <div class="elementor-element elementor-element-b39f07c elementor-column elementor-col-33 elementor-inner-column"
                                        data-id="b39f07c" data-element_type="column"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-column-wrap  elementor-element-populated"
                                            style="background-image: url('<?php echo $data->data[0]->category_image ?>')">
                                            <div class="elementor-background-overlay"></div>
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-element-6dae3fc elementor-icon-list--layout-inline elementor-align-right elementor-widget elementor-widget-icon-list"
                                                    data-id="6dae3fc" data-element_type="widget"
                                                    data-widget_type="icon-list.default">
                                                    <div class="elementor-widget-container">
                                                        <ul class="elementor-icon-list-items elementor-inline-items">
                                                            <li class="elementor-icon-list-item">
                                                                <span class="elementor-icon-list-icon">
                                                                    <i aria-hidden="true"
                                                                        class="fab fa-telegram-plane"></i> </span>
                                                                <span class="elementor-icon-list-text">20
                                                                    Tours</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-bfea0a1 elementor-widget elementor-widget-heading"
                                                    data-id="bfea0a1" data-element_type="widget"
                                                    data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-large">
                                                            <?php echo  $data->data[0]->category_name; ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-ab0aeaf elementor-column elementor-col-66 elementor-inner-column"
                                        data-id="ab0aeaf" data-element_type="column"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-column-wrap  elementor-element-populated"
                                            style="background-image: url('<?php echo $data->data[1]->category_image ?>')">
                                            <div class="elementor-background-overlay"></div>
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-element-1748e7e elementor-icon-list--layout-inline elementor-align-right elementor-widget elementor-widget-icon-list"
                                                    data-id="1748e7e" data-element_type="widget"
                                                    data-widget_type="icon-list.default">
                                                    <div class="elementor-widget-container">
                                                        <ul class="elementor-icon-list-items elementor-inline-items">
                                                            <li class="elementor-icon-list-item">
                                                                <span class="elementor-icon-list-icon">
                                                                    <i aria-hidden="true"
                                                                        class="fab fa-telegram-plane"></i> </span>
                                                                <span class="elementor-icon-list-text">20
                                                                    Tours</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-b5d4b84 elementor-widget elementor-widget-heading"
                                                    data-id="b5d4b84" data-element_type="widget"
                                                    data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                            <?php echo  $data->data[1]->category_name; ?></h2>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-0d17684 elementor-widget elementor-widget-spacer"
                                                    data-id="0d17684" data-element_type="widget"
                                                    data-widget_type="spacer.default">
                                                    <div class="elementor-widget-container">
                                                        <div class="elementor-spacer">
                                                            <div class="elementor-spacer-inner"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section
    class="elementor-element elementor-element-f64d5f8 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section"
    data-id="f64d5f8" data-element_type="section"
    data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}" style="width: 3806px; left: -1303px;">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="elementor-element elementor-element-296e58b elementor-column elementor-col-33 elementor-top-column"
                data-id="296e58b" data-element_type="column"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-column-wrap  elementor-element-populated"
                    style="background-image: url('<?php echo $data->data[2]->category_image ?>')">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-c4c79a3 elementor-icon-list--layout-inline elementor-align-right elementor-widget elementor-widget-icon-list"
                            data-id="c4c79a3" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                <ul class="elementor-icon-list-items elementor-inline-items">
                                    <li class="elementor-icon-list-item">
                                        <span class="elementor-icon-list-icon">
                                            <i aria-hidden="true" class="fab fa-telegram-plane"></i> </span>
                                        <span class="elementor-icon-list-text">20 Tours</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-708b88d elementor-widget elementor-widget-heading"
                            data-id="708b88d" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">
                                    <?php echo  $data->data[2]->category_name; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-20564ff elementor-column elementor-col-33 elementor-top-column"
                data-id="20564ff" data-element_type="column"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-column-wrap  elementor-element-populated"
                    style="background-image: url('<?php echo $data->data[3]->category_image ?>')">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-5f50c64 elementor-icon-list--layout-inline elementor-align-right elementor-widget elementor-widget-icon-list"
                            data-id="5f50c64" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                <ul class="elementor-icon-list-items elementor-inline-items">
                                    <li class="elementor-icon-list-item">
                                        <span class="elementor-icon-list-icon">
                                            <i aria-hidden="true" class="fab fa-telegram-plane"></i> </span>
                                        <span class="elementor-icon-list-text">20 Tours</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-84ed962 elementor-widget elementor-widget-heading"
                            data-id="84ed962" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">
                                    <?php echo  $data->data[3]->category_name; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-370ce67 elementor-column elementor-col-33 elementor-top-column"
                data-id="370ce67" data-element_type="column">
                <div class="elementor-column-wrap  elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <section
                            class="elementor-element elementor-element-c7db5d8 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section"
                            data-id="c7db5d8" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="elementor-element elementor-element-5489949 elementor-column elementor-col-100 elementor-inner-column"
                                        data-id="5489949" data-element_type="column"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-column-wrap  elementor-element-populated"
                                            style="background-image: url('<?php echo $data->data[4]->category_image ?>')">
                                            <div class="elementor-background-overlay"></div>
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-element-940abd1 elementor-icon-list--layout-inline elementor-align-right elementor-widget elementor-widget-icon-list"
                                                    data-id="940abd1" data-element_type="widget"
                                                    data-widget_type="icon-list.default">
                                                    <div class="elementor-widget-container">
                                                        <ul class="elementor-icon-list-items elementor-inline-items">
                                                            <li class="elementor-icon-list-item">
                                                                <span class="elementor-icon-list-icon">
                                                                    <i aria-hidden="true"
                                                                        class="fab fa-telegram-plane"></i> </span>
                                                                <span class="elementor-icon-list-text">20 Tours</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-b8927b3 elementor-widget elementor-widget-heading"
                                                    data-id="b8927b3" data-element_type="widget"
                                                    data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                            <?php echo  $data->data[4]->category_name; ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section
                            class="elementor-element elementor-element-f42efcb elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section"
                            data-id="f42efcb" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="elementor-element elementor-element-f055660 elementor-column elementor-col-100 elementor-inner-column"
                                        data-id="f055660" data-element_type="column"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-column-wrap  elementor-element-populated"
                                            style="background-image: url('<?php echo $data->data[5]->category_image ?>')">
                                            <div class="elementor-background-overlay"></div>
                                            <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-element-3f65add elementor-icon-list--layout-inline elementor-align-right elementor-widget elementor-widget-icon-list"
                                                    data-id="3f65add" data-element_type="widget"
                                                    data-widget_type="icon-list.default">
                                                    <div class="elementor-widget-container">
                                                        <ul class="elementor-icon-list-items elementor-inline-items">
                                                            <li class="elementor-icon-list-item">
                                                                <span class="elementor-icon-list-icon">
                                                                    <i aria-hidden="true"
                                                                        class="fab fa-telegram-plane"></i> </span>
                                                                <span class="elementor-icon-list-text">20 Tours</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-13da645 elementor-widget elementor-widget-text-editor"
                                                    data-id="13da645" data-element_type="widget"
                                                    data-widget_type="text-editor.default">
                                                    <div class="elementor-widget-container">
                                                        <div class="elementor-text-editor elementor-clearfix">
                                                            <p style="text-align: center;">
                                                                <?php echo  $data->data[5]->category_name; ?></p>
                                                            <!-- <p style="text-align: center;">&amp;</p>
                                                            <p style="text-align: center;">New Zealand</p> -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
}
add_shortcode('destination_data', 'destination_shortcode');