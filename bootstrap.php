<?php

use tcsl\dashboard\Start;
use tcsl\dashboard\Meta;

/**
 * Register Autoloader
 */
spl_autoload_register(function ($class) {
	$prefix = 'tcsl\\dashboard\\';
	$base_dir = __DIR__ . '/classes/';
	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0) {
		return;
	}
	$relative_class = substr($class, $len);
	$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
	if (file_exists($file)) {
		require $file;
	}

});

/**
 * Go!
 */
add_action( 'init', 'tcsl_member_cpt', 0 );
add_action( 'init', 'tcsl_member_load_cmb2', 2 );
add_action( 'init', function(){
	new Start();
}, 3 );



/**
 * Includes
 */

include FP_USER_DASHBOARD_PATH . '/includes/add-woo-templates.php';

add_filter( 'template_include', 'portfolio_page_template', 99 );

function portfolio_page_template( $template ) {

	if ( is_page( 'edit-member' )  ) {

		$new_template = FP_USER_DASHBOARD_PATH . '/templates/edit-member.php';
		if ( '' != $new_template ) {
			return $new_template;
		}
	}

	return $template;
}

// Register Custom Post Type
function tcsl_member_cpt() {

	$labels = array(
		'name'                  => 'Members',
		'singular_name'         => 'Member',
		'menu_name'             => 'Members',
		'name_admin_bar'        => 'Member',
		'archives'              => 'Item Archives',
		'attributes'            => 'Member Attributes',
		'parent_item_colon'     => 'Parent Item:',
		'all_items'             => 'All Members',
		'add_new_item'          => 'Add New Member',
		'add_new'               => 'Add New',
		'new_item'              => 'New Member',
		'edit_item'             => 'Edit Member',
		'update_item'           => 'Update Member',
		'view_item'             => 'View IMember',
		'view_items'            => 'View Members',
		'search_items'          => 'Search Member',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into Member',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Items list',
		'items_list_navigation' => 'Items list navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Member',
		'description'           => 'Post Type Description',
		'labels'                => $labels,
		'supports'              => array( 'revisions', 'author' ),
		'menu_icon'           	=> 'dashicons-groups',
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 70,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => false,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( Start::POST_TYPE, $args );

}

/**
 * Load CMB2
 *
 * @since 0.0.1
 *
 * @uses init
 */
function tcsl_member_load_cmb2(){
	include_once  __DIR__ . '/includes/CMB2/init.php';
}

add_filter( 'post_row_actions', 'tcsl_remove_cpt_view', 10, 1 );

function tcsl_remove_cpt_view( $actions ) {
    if( get_post_type() === Start::POST_TYPE ) {
    	unset( $actions['view'] );
    }

    return $actions;
}
