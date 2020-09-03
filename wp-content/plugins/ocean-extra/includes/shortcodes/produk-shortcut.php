<?php

/**
 * All shortcodes
 */

/**
 * Logo shortcode for the Custom Header style
 *
 * @since 1.1.1
 */
function product_shortcode()
{
    return "<div>Test 123</div>";
}
add_shortcode('product_data', 'product_shortcode');