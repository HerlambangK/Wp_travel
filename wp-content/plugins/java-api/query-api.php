<?php
/*
Plugin Name: API Java Traveller
Plugin URI:https://omukiguys.com
Description:Plugin For Java traveller
Version:0.1
Author:Bembie
AUthor URI:https://gooogle.com
licence:GPL-3.0+
licence URI:http:www.gnu.org/licencses/gpl-2.0.txt
*/



function shapeSpace_include_custom_jquery()
{

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

defined('ABSPATH') or die('Unauthorized Access!');
/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page()
{
    add_menu_page(
        __('Java Traveller product', 'textdomain'),
        'Java Traveller product',
        'manage_options',
        'java-product.php',
        'get_product_travel',
        // plugins_url( 'myplugin/images/icon.png' ),
        'dashicons-store',
        85
    );
}
add_action('admin_menu', 'wpdocs_register_my_custom_menu_page');
function create_menu_page()
{
}

// add_action('admin_init', 'callback_function_name');

function get_product_travel()
{
    echo '<h1> Java Travell </h1>';
    $args = array(
        'headers' => array(
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        )
    );
    $request = wp_remote_get('http://app.javatraveller.com/api/category', $args);
    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body);


    if (200 == wp_remote_retrieve_response_code($request)) {
        $file_link = WP_PLUGIN_DIR . '/java-api/data-travel-product.json';
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        $message = $body;
        write_to_file($message, $file_link);
    }

    if (is_wp_error($request)) {
        $file_link = WP_PLUGIN_DIR . '/java-api/error-log.txt';
        $error_message = $request->get_error_message();
        // echo "<pre>";
        echo 'Something went wrong:' . $error_message;
        $error_message = $request->get_error_message();
        $message = date('d m Y g:i:a') . ' ' . wp_remote_retrieve_response_code($request) . ' ' . $error_message;
        write_to_file($message, $file_link);
        // echo "</pre>";
    }
}

function write_to_file($message, $file_link)
{
    if (file_exists($file_link)) {
        $filing = fopen($file_link, 'a');
        fwrite($filing, $message . "\n");
    } else {
        $filing = fopen($file_link, 'w');
        fwrite($filing, $message . "\n");
    }
    fclose($filing);
}

    // $args = array(
    //     'headers' => array(
    //         'Content-Type' => 'application/json',
    //         'Accept' => 'application/json',
    //     )
    // );
    // $request = wp_remote_get('http://app.javatraveller.com/api/category', $args);

    // if (is_wp_error($request)) {
    //     echo "<pre>";
    //     print_r($request);
    //     echo "</pre>";
    // }

    // $body = wp_remote_retrieve_body($request);
    // $data = json_decode($body);
    // // echo "wp_remote_retrieve_body($data)";
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
// }