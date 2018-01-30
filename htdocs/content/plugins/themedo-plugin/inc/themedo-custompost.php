<?php

if( ! class_exists( 'Avalon_Themedo_Custom_Post' ) ) {
	class Avalon_Themedo_Custom_Post {

		function __construct() {
			add_action( 'init', array( $this, 'gallery_init' ) );
			add_action( 'init', array( $this, 'gallery_taxonomy_init' ) );
			add_action( 'init', array( $this, 'client_init' ) );
			add_action( 'init', array( $this, 'event_init' ) );
			
			// changing "Featured Image" text for custom post type
		}

		
		
		/********************************************************/
		/*  GALLERY POST REGISTER
		/********************************************************/
		
		function gallery_init() {
			
			global $avalon_td_option;
			
			$gallery_slug = 'gallery';
			if(isset($avalon_td_option['gallery_slug']) && $avalon_td_option['gallery_slug'] != ''){
				$gallery_slug = $avalon_td_option['gallery_slug'];
			}
			
			
			
			// Labels for display gallery projects
			$labels = array(
				'name'					=> esc_html__( 'Gallery Posts', 'themedo-core' ),
				'singular_name'			=> esc_html__( 'Gallery Post', 'themedo-core' ),
				'menu_name'				=> esc_html__( 'Gallery Posts', 'themedo-core' ),
				'name_admin_bar' 		=> esc_html__( 'Gallery Posts', 'themedo-core' ),
				'add_new'				=> esc_html__( 'Add New', 'themedo-core' ),
				'add_new_item'			=> esc_html__( 'Add New Gallery Post', 'themedo-core' ),
				'edit_item' 			=> esc_html__( 'Edit Gallery Post', 'themedo-core' ),
				'new_item' 				=> esc_html__( 'New Gallery Post', 'themedo-core' ),
				'view_item' 			=> esc_html__( 'View Gallery Post', 'themedo-core' ),
				'search_items' 			=> esc_html__( 'Search Gallery Posts', 'themedo-core' ),
				'not_found' 			=> esc_html__( 'No Gallery posts found', 'themedo-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Gallery posts found in trash', 'themedo-core' ),
				'all_items' 			=> esc_html__( 'Gallery Posts', 'themedo-core' )
			);
		
			// Arguments for gallery projects
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-format-gallery', //XXS_PLUGIN_URI . 'assets/img/portfolio-icon.png',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $gallery_slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor', 'thumbnail' )
			);
		
			// Register our gallery post type
			register_post_type( 'avalon_td_gallery', $args );
		}
		
		function gallery_taxonomy_init() {
			
			global $avalon_td_option;
			
			$slug = 'gallery-cat';
			if(isset($avalon_td_option['gallery_cat_slug']) && $avalon_td_option['gallery_cat_slug'] != ''){
				$slug = $avalon_td_option['gallery_cat_slug'];
			}
		
			// Label for 'service-category' taxonomy
			$labels = array(
				'name'							=> esc_html__( 'Gallery Categories', 'themedo-core' ),
				'singular_name'					=> esc_html__( 'Gallery Category', 'themedo-core' ),
				'menu_name'						=> esc_html__( 'Gallery Categories', 'themedo-core' ),
				'edit_item'						=> esc_html__( 'Edit Category', 'themedo-core' ),
				'update_item'					=> esc_html__( 'Update Category', 'themedo-core' ),
				'add_new_item'					=> esc_html__( 'Add New Category', 'themedo-core' ),
				'new_item_name'					=> esc_html__( 'New Category Name', 'themedo-core' ),
				'parent_item'					=> esc_html__( 'Parent Category', 'themedo-core' ),
				'parent_item_colon'				=> esc_html__( 'Parent Category:', 'themedo-core' ),
				'all_items'						=> esc_html__( 'All Categories', 'themedo-core' ),
				'search_items'					=> esc_html__( 'Search Categories', 'themedo-core' ),
				'popular_items'					=> esc_html__( 'Popular Categories', 'themedo-core' ),
				'separate_items_with_commas'	=> esc_html__( 'Separate Categoriess with commas', 'themedo-core' ),
				'add_or_remove_items'			=> esc_html__( 'Add or remove Categories', 'themedo-core' ),
				'choose_from_most_used'			=> esc_html__( 'Choose from the most used Categories', 'themedo-core' ),
				'not_found'						=> esc_html__( 'No Categories found', 'themedo-core' )
			);
		
			// Arguments for 'service-category' taxonomy
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'show_ui' 			=> true,
				'show_in_nav_menus'	=> true,
				'show_admin_column'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'query_var'			=> true,
				'rewrite'			=> array( 'slug' => $slug, 'with_front' => false, 'hierarchical' => true )
			);
			
			// Register Taxanomy
			register_taxonomy( 'gallery_category', 'avalon_td_gallery', $args );
			register_taxonomy( 'gallery_tags', 'avalon_td_gallery', array('hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => true));
			
		}
		
		
		
		/********************************************************/
		/*  EVENT POST REGISTER
		/********************************************************/
		
		function event_init() {
			
			global $avalon_td_option;
			
			$slug = 'event';
			if(isset($avalon_td_option['event_slug']) && $avalon_td_option['event_slug'] != ''){
				$slug = $avalon_td_option['event_slug'];
			}
			
			// Labels for display event projects
			$labels = array(
				'name'					=> esc_html__( 'Event Posts', 'themedo-core' ),
				'singular_name'			=> esc_html__( 'Event Post', 'themedo-core' ),
				'menu_name'				=> esc_html__( 'Event Posts', 'themedo-core' ),
				'name_admin_bar' 		=> esc_html__( 'Event Posts', 'themedo-core' ),
				'add_new'				=> esc_html__( 'Add New', 'themedo-core' ),
				'add_new_item'			=> esc_html__( 'Add New Event Post', 'themedo-core' ),
				'edit_item' 			=> esc_html__( 'Edit Event Post', 'themedo-core' ),
				'new_item' 				=> esc_html__( 'New Event Post', 'themedo-core' ),
				'view_item' 			=> esc_html__( 'View Event Post', 'themedo-core' ),
				'search_items' 			=> esc_html__( 'Search Event Posts', 'themedo-core' ),
				'not_found' 			=> esc_html__( 'No Event posts found', 'themedo-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Event posts found in trash', 'themedo-core' ),
				'all_items' 			=> esc_html__( 'Event Posts', 'themedo-core' )
			);
		
			// Arguments for event projects
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-calendar-alt',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor', 'thumbnail', 'comments' )
			);
		
			// Register our event post type
			register_post_type( 'avalon_td_event', $args );
		}
		
		
		
		/********************************************************/
		/*  CLIENT POST REGISTER
		/********************************************************/
		
		function client_init() {
			
			global $avalon_td_option;
			
			$slug = 'client';
			if(isset($avalon_td_option['client_slug']) && $avalon_td_option['client_slug'] != ''){
				$slug = $avalon_td_option['client_slug'];
			}
			
			// Labels for display client
			$labels = array(
				'name'					=> esc_html__( 'Clients', 'themedo-core' ),
				'singular_name'			=> esc_html__( 'Client', 'themedo-core' ),
				'menu_name'				=> esc_html__( 'Clients', 'themedo-core' ),
				'name_admin_bar' 		=> esc_html__( 'Clients', 'themedo-core' ),
				'add_new'				=> esc_html__( 'Add New', 'themedo-core' ),
				'add_new_item'			=> esc_html__( 'Add New Client', 'themedo-core' ),
				'edit_item' 			=> esc_html__( 'Edit Client', 'themedo-core' ),
				'new_item' 				=> esc_html__( 'New Client', 'themedo-core' ),
				'view_item' 			=> esc_html__( 'View Client', 'themedo-core' ),
				'search_items' 			=> esc_html__( 'Search Clients', 'themedo-core' ),
				'not_found' 			=> esc_html__( 'No Clients found', 'themedo-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Clients found in trash', 'themedo-core' ),
				'all_items' 			=> esc_html__( 'Clients', 'themedo-core' )
			);
		
			// Arguments for client
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-admin-users',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor')
			);
		
			// Register our client
			register_post_type( 'avalon_td_client', $args );
		}
	
		
	}

	$avalon_td_custompost = new Avalon_Themedo_Custom_Post();
}