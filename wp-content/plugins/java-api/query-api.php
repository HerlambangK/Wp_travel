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



// function shapeSpace_include_custom_jquery()
// {

//     wp_deregister_script('jquery');
//     wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true);
// }
// add_action('wp_enqueue_scripts', 'shapeSpace_include_custom_jquery');

defined('ABSPATH') or die('Unauthorized Access!');
/**
 * Register a custom menu page.
 */
function wpdocs_register_produk_javatraveller_menu_page()
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
    add_submenu_page(

        'edit.php?post_type=book',
        __('Books Shortcode Reference', 'textdomain'),
        __('Shortcode Reference', 'textdomain'),
        'manage_options',
        'books-shortcode-ref',
        'books_ref_page_callback'

    );
}
add_action('admin_menu', 'wpdocs_register_produk_javatraveller_menu_page');
function create_menu_page()
{
}
// add_action('subadmin_menu', 'wpdocs_register_produk_javatraveller_submenu_page');
// function create_submenu_page()
// {
// }

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
    $request = wp_remote_get('http://app.javatraveller.com/api/product?category_id=4', $args);
    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body);


    if (200 == wp_remote_retrieve_response_code($request)) {
        $file_link = WP_PLUGIN_DIR . '/java-api/data-travel-product.json';
        echo '<pre>';
        // var_dump($data);
        echo '</pre>';
        $message = $body;
        write_to_file($message, $file_link);
    }

    if (is_wp_error($request)) {
        $file_link = WP_PLUGIN_DIR . '/java-api/error-log.txt';
        $error_message = $request->get_error_message();
        // echo "<pre>";
        // echo 'Something went wrong:' . $error_message;
        $error_message = $request->get_error_message();
        $message = date('d m Y g:i:a') . ' ' . wp_remote_retrieve_response_code($request) . ' ' . $error_message;
        write_to_file($message, $file_link);
        // echo "</pre>";
    }
    table_product($data);
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

function table_product($data)
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



    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';

?>
<style>
table,
td,
th {
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    padding: 15px;
}
</style>
</style>
<h1 for="sender_id_field" style="text-align: center;"> PRODUCT </h1>
<table style="width: 100%; overflow-x:auto;">
    <tbody>
        <tr>
            <th>id</th>
            <th>slug</th>
            <th>name</th>
            <th>about</th>
            <th>price</th>
            <th>img</th>
            <th>highlights</th>
            <th>category</th>
        </tr>

        <?php
            foreach ($data->data as $datas) :

            ?>
        <tr>
            <td><?php echo $datas->id ?></td>
            <td><?php echo $datas->slug ?></td>
            <td><?php echo $datas->name ?></td>
            <td><?php echo $datas->about ?></td>
            <td><?php echo $datas->price ?></td>
            <td> <img width="100px" <?php echo "src='$datas->background_image ' "; ?> /></td>
            <td><?php
                        $gh = $datas->highlights;
                        $hg = count($gh);
                        for ($i = 0; $i <= $hg; $i++) {;
                            echo  $datas->highlights[$i]->name;
                            echo ", ";
                        }
                        // echo $hg;
                        ?>
            </td>
            <td> <?php echo  $datas->category->category_name  ?> </td>

        </tr>
        <?php endforeach; ?>
    </tbody>
</table> <?php


            }



// function wporg_add_custom_box()
// {
//     $screens = ['post', 'wporg_cpt'];
//     foreach ($screens as $screen) {
//         add_meta_box(
//             'wporg_box_id',           // Unique ID
//             'Custom Meta Box Title',  // Box title
//             'wporg_custom_box_html',  // Content callback, must be of type callable
//             $screen                   // Post type
//         );
//     }
// }
// add_action('add_meta_boxes', 'wporg_add_custom_box');

// function wporg_custom_box_html($post)
// {