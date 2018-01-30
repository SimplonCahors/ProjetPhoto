<?php

$settings = get_option('pixproof_settings');

if ( !isset($settings['enable_pixproof_gallery'] ) || $settings['enable_pixproof_gallery'] != true  ) return;

$single_label =  esc_html_x( 'Proof Gallery', 'Post Type Singular Name', 'themedo-core' );
if ( isset($settings['pixproof_single_item_label']) && !empty( $settings['pixproof_single_item_label'] ) ) {
	$single_label = $settings['pixproof_single_item_label'];
}

$name = esc_html_x( 'Proof Galleries', 'Post Type General Name', 'themedo-core' );
$menu_name = esc_html__( 'Proof Galleries', 'themedo-core' );
if ( isset($settings['pixproof_multiple_items_label']) && !empty( $settings['pixproof_multiple_items_label'] ) ) {
	$name = $menu_name = $settings['pixproof_multiple_items_label'];
}


global $avalon_td_option;
			
$slug = 'proofing';
if(isset($avalon_td_option['proofing_slug']) && $avalon_td_option['proofing_slug'] != ''){
	$slug = $avalon_td_option['proofing_slug'];
}


$rewrite = array( 'slug' => $slug);

$labels = array(
	'name'                => $name,
	'singular_name'       => $single_label,
	'menu_name'           => $menu_name,
	'parent_item_colon'   => esc_html__( 'Parent Item:', 'themedo-core' ),
	'all_items'           => esc_html__( 'All Items', 'themedo-core' ),
	'view_item'           => esc_html__( 'View Item', 'themedo-core' ),
	'add_new_item'        => esc_html__( 'Add New Proof Gallery', 'themedo-core' ),
	'add_new'             => esc_html__( 'Add New', 'themedo-core' ),
	'edit_item'           => esc_html__( 'Edit Proof Gallery', 'themedo-core' ),
	'update_item'         => esc_html__( 'Update Proof Gallery', 'themedo-core' ),
	'search_items'        => esc_html__( 'Search Proof Galelry', 'themedo-core' ),
	'not_found'           => esc_html__( 'Not found', 'themedo-core' ),
	'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'themedo-core' ),
);

$args = array(
	'label'               => $single_label,
	'description'         => $menu_name,
	'labels'              => $labels,
	'supports'            => array( 'title', 'editor', 'comments', 'revisions' ),
//	'taxonomies'          => array( 'category', 'post_tag' ),
	'hierarchical'        => true,
	'public'              => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => true,
	'show_in_admin_bar'   => true,
	'menu_position'       => 6,
	'menu_icon'           => 'dashicons-visibility',
	'can_export'          => true,
	'has_archive'         => false,
	'exclude_from_search' => true,
	'publicly_queryable'  => true,
	'query_var'           => $slug,
	'rewrite'             => $rewrite,
	'capability_type'     => 'page',
	'yarpp_support' 	  => false,
);
register_post_type( 'avalon_td_proofing', $args );

