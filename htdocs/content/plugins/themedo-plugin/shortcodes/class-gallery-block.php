<?php
class themedoSC_GalleryBlock {
	
	private $avalon_td_counter = 1;
	
	public static $args;


	/**
	 * Initiate the shortcode
	 */
	 
	public function __construct() {

		// Element attributes
		add_filter( 'avalon_td_attr_gallery_block-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'gallery_block', array( $this, 'render' ) );
	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 				=> '',
				'id' 					=> '',
				'layout' 				=> '',			
				'cat_slug' 				=> '',
				'exclude_cats' 			=> '',
				'post_count' 			=> '',
				'order' 				=> '',
				'offset'				=> '',
				'margin_top' 			=> '',
				'margin_bottom' 		=> '',
			), $args
		);
		
		// check: has "px" or not. if not: add "px"
		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}
		
		extract( $defaults );

		self::$args = $defaults;
		
		
		// Transform $cat_slugs to array
		if ( self::$args['cat_slug'] ) {
			$cat_slugs = preg_replace( '/\s+/', '', self::$args['cat_slug'] );
			$cat_slugs = explode( ',', self::$args['cat_slug'] );
		} else {
			$cat_slugs = array();
		}		
		
		// Transform $cats_to_exclude to array
		if ( self::$args['exclude_cats'] ) {
			$cats_to_exclude = preg_replace( '/\s+/', '', self::$args['cat_slug'] );
			$cats_to_exclude = explode( ',' , self::$args['exclude_cats'] );
		} else {
			$cats_to_exclude = array();			
		}
		
		

		// Initialize the query array
		$query_args = array(
			'post_type' 			=> 'avalon_td_gallery',
			'paged' 				=> 1,
			'post_status' 			=> 'publish',  
			'posts_per_page'		=> $post_count,
			'has_password' 		 	=> false,
			'order' 				=> 'DESC', 
			'ignore_sticky_posts'	=> 1,
		);
		
		if ( $defaults['offset'] ) {
			$query_args['offset'] =  $offset;
		}
		
		if ( $defaults['order'] ) {
			$query_args['orderby'] =  $order;
		}		
		
		// Check if the are categories that should be excluded
		if ( ! empty ( $cats_to_exclude ) ) {
		
			// Exclude the correct cats from tax_query
			$query_args['tax_query'] = array(
				array(
					'taxonomy'	=> 'gallery_category',
					'field'	 	=> 'slug',
					'terms'		=> $cats_to_exclude,
					'operator'	=> 'NOT IN'
				)
			);

			// Include the correct cats in tax_query
			if ( ! empty ( $cat_slugs ) ) {
				$query_args['tax_query']['relation'] = 'AND';
				$query_args['tax_query'][] = array(
					'taxonomy'	=> 'gallery_category',
					'field'		=> 'slug',
					'terms'		=> $cat_slugs,
					'operator'	=> 'IN'
				);
			}		
		
		} else {
			// Include the cats from $cat_slugs in tax_query
			if ( ! empty ( $cat_slugs ) ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' 	=> 'gallery_category',
						'field' 	=> 'slug',
						'terms' 	=> $cat_slugs
					)
				);
			}
		}
		wp_reset_query();
		
		
		$avalon_td_query = NULL;
		$avalon_td_post_img = NULL;
		$disabled = NULL;
		$term_link = NULL;
		$cat_list = NULL;
		$gallery_list = NULL;
		$avalon_td_gallery_images = NULL;
		$count_images = NULL;
		
		$avalon_td_query 		= new WP_Query($query_args);
		$avalon_td_post_count 	= $avalon_td_query->found_posts;
		$avalon_td_max_pages 	= $avalon_td_query->max_num_pages;
		
		
		
		
		// START OUTPUT
		$html = '</div></div></div>';
		$html .= sprintf('<div %s><div class="avalon_td_galleryblock">', themedoCore_Plugin::attributes( 'gallery_block-shortcode' ));
		
		
		
		// SLIDER
		if($layout == '' || $layout == 'slider') /* ::::::::::::::::::::::::::::: SLIDER ::::::::::::::::::::::::::::::: */
		{
			$html .= '<div class="container"><div class="avalon_td_galleryblock_slider"><ul class="slides">';
			
			foreach ( $avalon_td_query->posts as $avalon_td_gallerypost ) {
				setup_postdata( $avalon_td_gallerypost ); 
						
					$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
					$avalon_td_post_img 		= avalon_td_get_thumbnail('1000', '1000', $avalon_td_post_id);
					$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
					$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
					$avalon_td_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-1000-1000.jpg'; 
					$avalon_td_backupthumbnail = '<img src="'.$avalon_td_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $avalon_td_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'avalon_td_thumb-1000-1000' );
					
					$cat_count = sizeof($avalon_td_categories);
					if($cat_count >= 2){$cat_count = 2;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
						$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
					
					
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
						
						if($avalon_td_gallery_images)
						{
							$count_images = sizeof($avalon_td_gallery_images);
							foreach(array_slice($avalon_td_gallery_images, 0, 3) as $img){
		
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-500-500' );
								$src = $src[0];
								$gallery_list .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							} 	
						}
						else
						{
							$count_images = 0;	
						}
					}
					
					 
					$html   				   .= '<li class="avalon_td_galleryblock_item">
														<div class="avalon_td_first_half">
															<div class="gallery_cover">
																<div class="img_holder_overlay" style="background-image:url('.$post_thumbnail_url[0].')"><a href="'.$avalon_td_post_permalink.'"></a></div>
																<div class="img_holder">'.$avalon_td_backupthumbnail.'</div>
																<div class="detail_small">
																	<span>'.$count_images.'</span>
																	<i class="xcon-picture"></i>
																</div>
															</div>
														</div>
														<div class="avalon_td_second_half">
															<div class="in">
																<div class="title_holder">
																	<span>'.$cat_list.'</span>
																	<h1 class="title">
																		<a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a>
																	</h1>
																</div>
																<div class="content_holder">
																	<p>'.avalon_td_excerpt(15).'</p>
																	<a href="'.$avalon_td_post_permalink.'" class="viewgallerylink" >'.esc_html($avalon_td_option['viewgallery_text']).'</a>
																	<ul>'.$gallery_list.'</ul>
																</div>
															</div>
															
														</div>									
													</li>';
					$cat_list = $gallery_list = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '';
			$html .= '</ul></div></div>';	
		}
		else if($layout == 'halfimg') /* ::::::::::::::::::::::::::::: HALF SCREEN IMAGE ::::::::::::::::::::::::::::::: */
		{
			
			$html .= '<div class="avalon_td_galleryblock_halfimg"><div class="avalon_td_fullpagejs">';
			
			foreach ( $avalon_td_query->posts as $avalon_td_gallerypost ) {
				setup_postdata( $avalon_td_gallerypost ); 
						
					$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
					$avalon_td_post_img 		= avalon_td_get_thumbnail('1000', '1000', $avalon_td_post_id, false);
					$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
					$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $avalon_td_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'avalon_td_thumb-1000-1000' );
					
					$cat_count = sizeof($avalon_td_categories);
					if($cat_count >= 2){$cat_count = 2;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
						$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
					
					
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
						
						if($avalon_td_gallery_images)
						{
							$count_images = sizeof($avalon_td_gallery_images);
							foreach(array_slice($avalon_td_gallery_images, 0, 6) as $img){
		
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-500-500' );
								$src = $src[0];
								$gallery_list .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							} 	
						}
						else
						{
							$count_images = 0;	
						}
					}
					
					 
					$html   				   .= '<div class="item section">
														<div class="avalon_td_first_half">
														
															<div class="img_holder_bg" style="background-image:url('.$post_thumbnail_url[0].')">
																<div class="detail_small">
																	<span>'.$count_images.'</span>
																	<i class="xcon-picture"></i>
																</div>
															</div>
															
														</div>
														<div class="avalon_td_second_half">
															<div class="in">
																<div class="inin">
																	<div>
																		<div class="title_holder">
																			<span>'.$cat_list.'</span>
																			<h1 class="title">
																				<a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a>
																			</h1>
																		</div>
																		<div class="content_holder">
																			<p>'.avalon_td_excerpt(15).'</p>
																			<a href="'.$avalon_td_post_permalink.'" class="viewgallerylink" >'.esc_html($avalon_td_option['viewgallery_text']).'</a>
																			<ul>'.$gallery_list.'</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>									
													</div>';
					$cat_list = $gallery_list = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '</div></div>';	
			
			
		}
		else if($layout == 'split') /* ::::::::::::::::::::::::::::: SPLIT SCREEN ::::::::::::::::::::::::::::::: */
		{

					
			$html .= '<div class="avalon_td_galleryblock_split"><div class="ms-left">';
					
			foreach ( $avalon_td_query->posts as $key => $avalon_td_gallerypost ) {
				
				if($key % 2 == 1) continue; 
				setup_postdata( $avalon_td_gallerypost ); 
						
					$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
					$avalon_td_post_img 		= avalon_td_get_thumbnail('1920', '9999', $avalon_td_post_id, false);
					$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
					$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $avalon_td_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'avalon_td_thumb-1000-1000' );
					
					$cat_count = sizeof($avalon_td_categories);
					if($cat_count >= 2){$cat_count = 2;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
						$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
					
					
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
						
						if($avalon_td_gallery_images)
						{
							$count_images = sizeof($avalon_td_gallery_images);
							foreach(array_slice($avalon_td_gallery_images, 0, 3) as $img){
		
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-120-120' );
								$src = $src[0];
								$gallery_list .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							} 	
						}
						else
						{
							$count_images = 0;	
						}
					}
					
					 
					$html   				   .= '<div class="item ms-section '.$key.'">
														<div class="overlay gra"><a href="'.$avalon_td_post_permalink.'" ></a></div>
														<div class="img_holder_bg" style="background-image:url('.$post_thumbnail_url[0].')"></div>
														<div class="detail_small">
															<span>'.$count_images.'</span>
															<i class="xcon-picture"></i>
														</div>
														<div class="content_holder">
															<a href="'.$avalon_td_post_permalink.'" ></a>
															<ul class="list_img">'.$gallery_list.'</ul>
															<div class="title_holder">
																<span>'.$cat_list.'</span>
																<h1 class="title">
																	<a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a>
																</h1>
															</div>
														</div>							
													</div>';
					$cat_list = $gallery_list = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '</div><div class="ms-right">';
			
			foreach ( $avalon_td_query->posts as $key => $avalon_td_gallerypost ) {
				
				if($key % 2 == 0) continue; 
				setup_postdata( $avalon_td_gallerypost ); 
						
					$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
					$avalon_td_post_img 		= avalon_td_get_thumbnail('1920', '9999', $avalon_td_post_id, false);
					$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
					$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $avalon_td_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'avalon_td_thumb-1000-1000' );
					
					$cat_count = sizeof($avalon_td_categories);
					if($cat_count >= 2){$cat_count = 2;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
						$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
					
					
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
						
						if($avalon_td_gallery_images)
						{
							$count_images = sizeof($avalon_td_gallery_images);
							foreach(array_slice($avalon_td_gallery_images, 0, 3) as $img){
		
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-120-120' );
								$src = $src[0];
								$gallery_list .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							} 	
						}
						else
						{
							$count_images = 0;	
						}
					}
					
					 
					$html   				   .= '<div class="item ms-section  '.$key.'">
														<div class="overlay gra"><a href="'.$avalon_td_post_permalink.'" ></a></div>
														<div class="img_holder_bg" style="background-image:url('.$post_thumbnail_url[0].')"></div>
														<div class="detail_small">
															<span>'.$count_images.'</span>
															<i class="xcon-picture"></i>
														</div>
														<div class="content_holder">
															<a href="'.$avalon_td_post_permalink.'" ></a>
															<ul class="list_img">'.$gallery_list.'</ul>
															<div class="title_holder">
																<span>'.$cat_list.'</span>
																<h1 class="title">
																	<a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a>
																</h1>
															</div>
														</div>						
						
													</div>';
					$cat_list = $gallery_list = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '</div></div>';
		}
		else if($layout == 'fullscreen') /* ::::::::::::::::::::::::::::: FULLSCREEN IMAGE ::::::::::::::::::::::::::::::: */
		{
			$html .= '<div class="avalon_td_galleryblock_fullscreen"><div class="avalon_td_fullpagejs">';
			
			foreach ( $avalon_td_query->posts as $avalon_td_gallerypost ) {
				setup_postdata( $avalon_td_gallerypost ); 
						
					$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
					$avalon_td_post_img 		= avalon_td_get_thumbnail('1920', '9999', $avalon_td_post_id, false);
					$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
					$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $avalon_td_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'avalon_td_thumb-1920-9999' );
					$gallery_list2				= NULL;
					
					$cat_count = sizeof($avalon_td_categories);
					if($cat_count >= 2){$cat_count = 2;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
						$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
					
					
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
						
						if($avalon_td_gallery_images)
						{
							$count_images = sizeof($avalon_td_gallery_images);
							foreach(array_slice($avalon_td_gallery_images, 0, 2) as $img){
		
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-500-500' );
								$src = $src[0];
								$gallery_list .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							}
							foreach(array_slice($avalon_td_gallery_images, 2, 2) as $img){
		
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-500-500' );
								$src = $src[0];
								$gallery_list2 .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							} 	
						}
						else
						{
							$count_images = 0;	
						}
					}
					
					 
					$html   				   .= '<div class="item section">
														<div class="avalon_td_tc">
															<div class="container">
																<div class="avalon_td_details">
																	<div class="title_holder">
																		<span>'.$cat_list.'</span>
																		<h1 class="title">
																			<a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a>
																		</h1>
																	</div>
																	<div class="content_holder">
																		<p>'.avalon_td_excerpt(23).'</p>
																		<a href="'.$avalon_td_post_permalink.'" class="viewgallerylink" >'.esc_html($avalon_td_option['viewgallery_text']).'</a>
																	</div>
																</div>
																<div class="avalon_td_thumbs">
																	<ul class="list_img_1">'.$gallery_list.'</ul>
																	<ul class="list_img_2">'.$gallery_list2.'</ul>
																</div>
															</div>
														</div>
														<div class="detail_small">
															<span>'.$count_images.'</span>
															<i class="xcon-picture"></i>
														</div>
														<div class="avalon_td_overlay"></div>
														<div class="img_holder_bg" style="background-image:url('.$post_thumbnail_url[0].')" ></div>			
													</div>';
					$cat_list = $gallery_list = $gallery_list2 = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '</div></div>';		
		}
		else if($layout == 'fullwidth') /* ::::::::::::::::::::::::::::: FULLWIDTH IMAGE ::::::::::::::::::::::::::::::: */
		{
			$html .= '<div class="avalon_td_galleryblock_fullwidth">';
			
			foreach ( $avalon_td_query->posts as $key => $avalon_td_gallerypost ) {
				setup_postdata( $avalon_td_gallerypost ); 
						
					$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
					$avalon_td_post_img 		= avalon_td_get_thumbnail('1920', '9999', $avalon_td_post_id, false);
					$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
					$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $avalon_td_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'avalon_td_thumb-1920-9999' );
					
					$cat_count = sizeof($avalon_td_categories);
					if($cat_count >= 2){$cat_count = 2;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
						$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
					
					
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
						
						if($avalon_td_gallery_images)
						{
							$count_images = sizeof($avalon_td_gallery_images);
							foreach(array_slice($avalon_td_gallery_images, 0, 3) as $key2 => $img){
								
								$index = $key2 * 40;
								
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-500-500' );
								$src = $src[0];
								$gallery_list .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							}	
						}
						else
						{
							$count_images = 0;	
						}
					}
					
					 
					$html   				   .= '<div class="item section">
														<div class="avalon_td_tc">
															<div class="avalon_td_details">
																<div class="title_holder">
																	<span>'.$cat_list.'</span>
																	<h1 class="title">
																		<a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a>
																	</h1>
																</div>
																<div class="content_holder">
																	<p>'.avalon_td_excerpt(23).'</p>
																	<a href="'.$avalon_td_post_permalink.'" class="viewgallerylink" >'.esc_html($avalon_td_option['viewgallery_text']).'</a>
																</div>
															</div>
															<div class="avalon_td_thumbs">
																<ul class="list_img">'.$gallery_list.'</ul>
															</div>
															<div class="detail_small">
																<span>'.$count_images.'</span>
																<i class="xcon-picture"></i>
															</div>
														</div>
														
														<div class="avalon_td_overlay"></div>
														<div class="img_holder_bg jarallax" style="background-image:url('.$post_thumbnail_url[0].')"></div>			
													</div>';
					$cat_list = $gallery_list = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '</div>';		
		}else if($layout == 'creative1') /* ::::::::::::::::::::::::::::: CREATIVE 1 ::::::::::::::::::::::::::::::: */
		{
			$html .= '<div class="avalon_td_galleryblock_creative1"><div class="avalon_td_fullpagejs">';
			
			foreach ( $avalon_td_query->posts as $avalon_td_gallerypost ) {
				setup_postdata( $avalon_td_gallerypost ); 
						
					$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
					$avalon_td_post_img 		= avalon_td_get_thumbnail('1920', '9999', $avalon_td_post_id, false);
					$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
					$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $avalon_td_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'avalon_td_thumb-1920-9999' );
					
					$cat_count = sizeof($avalon_td_categories);
					if($cat_count >= 2){$cat_count = 2;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
						$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
					
					
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
						
						if($avalon_td_gallery_images)
						{
							$count_images = sizeof($avalon_td_gallery_images);
							foreach(array_slice($avalon_td_gallery_images, 0, 1) as $img){
		
								$src = wp_get_attachment_image_src( $img['ID'], 'avalon_td_thumb-500-500' );
								$src = $src[0];
								$gallery_list .= '<li>
													<img src="'.esc_url($src).'" alt="'.esc_attr($img['title']).'" />
												  </li>';
							}
						}
						else
						{
							$count_images = 0;	
						}
					}
					
					 
					$html   				   .= '<div class="item section">
															<div class="avalon_td_thumbs">
																<ul class="list_img_1">'.$gallery_list.'</ul>
															</div>
																
															<div class="avalon_td_details">
																<div class="title_holder">
																	<span>'.$cat_list.'</span>
																	<h1 class="title">
																		<a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a>
																	</h1>
																</div>
																<div class="content_holder">
																	<p>'.avalon_td_excerpt(23).'</p>
																	<a href="'.$avalon_td_post_permalink.'" class="viewgallerylink" >'.esc_html($avalon_td_option['viewgallery_text']).'</a>
																</div>
															</div>
															
															
															<div class="img_holder_bg" style="background-image:url('.$post_thumbnail_url[0].')" >
																<div class="detail_small">
																	<span>'.$count_images.'</span>
																	<i class="xcon-picture"></i>
																</div>
															</div>			
														
													</div>';
					$cat_list = $gallery_list = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '</div></div>';		
		}
		
		
		
		
		
		$html .= '</div></div>';
		$html .= '<div class="container"><div class="row"><div class="td-col-12 fix desc">';
		// END OUTPUT	

		$this->avalon_td_counter++;
		return $html;
		
		
	}
	
	
	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_galleryblock_wrap';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s; margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom']);
		
		return $attr;

	}
}

new themedoSC_GalleryBlock();