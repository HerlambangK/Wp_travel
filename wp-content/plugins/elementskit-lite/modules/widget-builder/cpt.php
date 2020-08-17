<?php 
namespace ElementsKit\Modules\Widget_Builder;

defined( 'ABSPATH' ) || exit;

class Cpt{

    public function __construct() {
        $this->post_type(); 

        add_action('admin_menu', [$this, 'cpt_menu']);
    }

    public function post_type() {
        
		$labels = array(
			'name'               => esc_html__( 'Widgets', 'elementskit' ),
			'singular_name'      => esc_html__( 'Widget', 'elementskit' ),
			'menu_name'          => esc_html__( 'Widget Builder', 'elementskit' ),
			'name_admin_bar'     => esc_html__( 'Widgets', 'elementskit' ),
			'add_new'            => esc_html__( 'Add New', 'elementskit' ),
			'add_new_item'       => esc_html__( 'Add New Widget', 'elementskit' ),
			'new_item'           => esc_html__( 'New Widget', 'elementskit' ),
			'edit_item'          => esc_html__( 'Edit Widget', 'elementskit' ),
			'view_item'          => esc_html__( 'View Widget', 'elementskit' ),
			'all_items'          => esc_html__( 'All Widgets', 'elementskit' ),
			'search_items'       => esc_html__( 'Search Widgets', 'elementskit' ),
			'parent_item_colon'  => esc_html__( 'Parent Widgets:', 'elementskit' ),
			'not_found'          => esc_html__( 'No Widgets found.', 'elementskit' ),
			'not_found_in_trash' => esc_html__( 'No Widgets found in Trash.', 'elementskit' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'rewrite'             => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'page',
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
		);

		register_post_type( 'elementskit_widget', $args );
    }

    public function cpt_menu(){
        $link_our_new_cpt = 'edit.php?post_type=elementskit_widget';
        add_submenu_page('elementskit', esc_html__('Widget builder', 'elementskit'), esc_html__('Widget Builder', 'elementskit'), 'manage_options', $link_our_new_cpt);
    }
}