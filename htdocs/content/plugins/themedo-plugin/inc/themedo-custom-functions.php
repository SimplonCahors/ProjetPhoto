<?php

/*-----------------------------------------------------------------------------------*/
/* GALLERY LIST {--EPSILON--}
/*-----------------------------------------------------------------------------------*/
function avalonGalleryListEpsilon($blockId, $cat=''){
	
	global $avalon_td_option;
	$avalon_td_galleryperpage 	= 	$avalon_td_option['gallery_epsilon_galleryperpage'];
	
	$avalon_td_query = $avalon_td_post_img = $buffy = $disabled = $term_link = $cat_list = $output = $gallery_list = $avalon_td_gallery_images = $count_images = $avalon_td_gallery_locked_content = $avalon_td_post_img_url = NULL;
			
	// RECENT GALLERY QUERY
	$avalon_td_args = array(
		'post_type' 			=> 'avalon_td_gallery',  
		'post_status' 			=> 'publish',  
		'posts_per_page' 		=> $avalon_td_galleryperpage,
		'paged'					=> 1, 
		'ignore_sticky_posts'	=> 1,
		'orderby'				=>'date');
		
	
	if (!empty($cat)) {
		$tax_arg = array('taxonomy' => 'gallery_category', 'field' => 'term_id', 'terms' => $cat);
		$avalon_td_args['tax_query'] = array($tax_arg);
	}

		
	$avalon_td_query 		= new WP_Query($avalon_td_args);
	$avalon_td_post_count 	= $avalon_td_query->found_posts;
	$avalon_td_max_pages 	= $avalon_td_query->max_num_pages;
	
	if($avalon_td_max_pages == 1 || $avalon_td_query->found_posts == ''){$disabled = 'disabled';}
	
	
	// RECENT GALLERY LIST
	foreach ( $avalon_td_query->posts as $avalon_td_gallerypost ) {
		setup_postdata( $avalon_td_gallerypost ); 
				
			$avalon_td_post_id 			= $avalon_td_gallerypost->ID;
			$avalon_td_post_permalink 	= get_permalink($avalon_td_post_id);
			$avalon_td_categories 		= get_the_terms( $avalon_td_post_id, 'gallery_category');
			$avalon_td_post_img_url		= wp_get_attachment_image_src( get_post_thumbnail_id($avalon_td_post_id), 'avalon_td_thumb-1000-1000' ); $avalon_td_post_img_url = $avalon_td_post_img_url[0];
			
			
			$cat_count = sizeof($avalon_td_categories);
			if($cat_count >= 2){$cat_count = 2;}
			
			for($i = 0; $i < $cat_count; $i++){
				$term_link = get_term_link( $avalon_td_categories[$i]->slug, 'gallery_category' );
				$cat_list .= '<a href="'.$term_link.'">'.$avalon_td_categories[$i]->name.'</a> / ';
			}
			$cat_list = trim($cat_list, " / ");
			
			// Check Password Protection
			if(post_password_required($avalon_td_gallerypost)){
				$avalon_td_gallery_locked_content = '<div class="avalon_td_locked"><div><div><span><i class="xcon-lock"></i></span></div></div></div>';	
			}
			
			
			
			if(function_exists('rwmb_meta'))
			{
				$avalon_td_gallery_images 			= rwmb_meta( 'avalon_td_gallery_images', 'type=image&size=full', $avalon_td_post_id );
				
				if($avalon_td_gallery_images)
				{
					$count_images = sizeof($avalon_td_gallery_images);	
				}
				else
				{
					$count_images = 0;	
				}
			}
			

			$buffy   				   .= '<td class="animated hideforanimation" data-fgh="'.$cat.'">
											<div class="avalon_td_gallery_item">
												<div class="gallery_cover">
													'.$avalon_td_gallery_locked_content.'
													<div class="img_holder" style="background-image:url('.$avalon_td_post_img_url.');"></div>
													<a href="'.$avalon_td_post_permalink.'" class="overlay gra"></a>
													<div class="title_holder">
														<h1><a href="'.$avalon_td_post_permalink.'" data-postid="'.$avalon_td_post_id.'" data-gpba="avalon_td_gallery_post_by_ajax">'.$avalon_td_gallerypost->post_title.'</a></h1>
														<span>'.$cat_list.'</span>
													</div>
													<div class="detail_small">
														<span>'.$count_images.'</span>
														<i class="xcon-picture"></i>
													</div>
												</div>
											</div>
										  </td>';

			$cat_list = $gallery_list = $avalon_td_gallery_locked_content = NULL; 
	}
	wp_reset_postdata();
	
	
	$output .= '<div class="avalon_td_gallery_list"><table><tbody><tr>';
	
	// OUTPUT
	if ( $buffy != NULL ) {
		$output .= $buffy; 
	}else{
		$output .= '<td><span>'.esc_html__('No Gallery Posts Added','avalon').'</span></td>';
	}
	
	$output .= '</tr></tbody></table></div>';
	
	$output .= '<div class="avalon_td_pagination" data-archive-value="'.$cat.'">
					<span>
						<a href="#'.$blockId.'" class="avalon_td_ajax-prev-page avalon_td_scroll disabled" data-wid="'.$blockId.'">
							<span class="a"><i class="xcon-left-open-big"></i></span>
							<span class="b"><i class="xcon-left-open-big"></i></span>
						</a>
						<a href="#'.$blockId.'" class="avalon_td_ajax-next-page avalon_td_scroll '.esc_html($disabled).'" data-wid="'.$blockId.'">
							<span class="a"><i class="xcon-right-open-big"></i></span>
							<span class="b"><i class="xcon-right-open-big"></i></span>
						</a>
					</span>
					<span class="ajax_loader"><i class="xcon-spin3 animate-spin"></i></span>
				</div>';
		
	echo $output;
	
	$buffy = str_replace('"', "'", $buffy); // We need to change double quotes to quote for json file
	if(function_exists('avalon_gallery_script')){avalon_gallery_script($buffy, $blockId, $avalon_td_post_count, $avalon_td_max_pages);}	
}



/*-----------------------------------------------------------------------------------*/
/* PROVIDING CUSTOM SCRIPT FOR AJAX GALLERY LIST
/*-----------------------------------------------------------------------------------*/
function avalon_gallery_script($buffy, $blockId, $postCount, $maxPages){
	$divItem  	= 'block_'.$blockId;
	$script 	= '';
	$script 	.= '<script>';
	$script 	.= 'var ' . $divItem . ' = new avalon_td_block();' . "\n";
	$script 	.= $divItem . '.id = "'.$blockId.'";' . "\n";

	$script 	.= 'avalonLocalCacheData.push(' . $divItem . ');' . "\n";
	$script 	.= '</script>';
	
	$td_hide_next = false;
	if($postCount <= 1 || $maxPages <= 1)
	{
		$td_hide_next = true;	
	}
	
	$search = array(
		'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
		'/[^\S ]+\</s',  // strip whitespaces before tags, except space
		'/(\s)+/s'       // shorten multiple whitespace sequences
	);
	$replace = array(
		'>',
		'<',
		'\\1'
	);
	$buffy = preg_replace($search, $replace, $buffy);
	
	$buffyArray = array (
		'avalon_td_data' 		=> $buffy,
		'avalon_td_block_id' 	=> $blockId,
		'avalon_td_hide_prev' 	=> true,
		'avalon_td_hide_next' 	=> $td_hide_next
	);

	ob_start();
	// we need to clone the object to set is_ajax_running to true
	// first we set an object for the all filter
	?>
	<script>
		var tmpObj = JSON.parse(JSON.stringify(<?php echo esc_html($divItem); ?>));
		tmpObj.ajax_running = true;
		var currentBlockObjSignature = JSON.stringify(tmpObj);		
		avalonLocalCache.set(currentBlockObjSignature, JSON.stringify(<?php echo json_encode($buffyArray) ?>));
		
	</script>
	<?php
	$script		.= ob_get_clean();
	
	echo $script;
}


/*-----------------------------------------------------------------------------------*/
/* PROVIDING CUSTOM SCRIPT FOR AJAX GALLERY POST
/*-----------------------------------------------------------------------------------*/
function avalon_gallerypost_script($data, $blockId, $postId){
	$divItem  	= 'gallerypost_'.$blockId;
	$script 	= '';
	$script 	.= '<script>';
	$script 	.= 'var ' . $divItem . ' = new avalon_td_gallerypost();' . "\n";
	$script 	.= $divItem . '.id = "'.$blockId.'";' . "\n";
	$script 	.= $divItem . '.postID = "'.$postId.'";' . "\n";

	$script 	.= 'avalonLocalCacheData.push(' . $divItem . ');' . "\n";
	$script 	.= '</script>';
	
	
	$search = array(
		'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
		'/[^\S ]+\</s',  // strip whitespaces before tags, except space
		'/(\s)+/s'       // shorten multiple whitespace sequences
	);
	$replace = array(
		'>',
		'<',
		'\\1'
	);
	$data = preg_replace($search, $replace, $data);
	
	$dataArray = array (
		'avalon_td_data' 		=> $data,
		'avalon_td_block_id' 	=> $blockId,
		'avalon_td_post_id' 	=> $postId
	);

	ob_start();
	?>
	<script>
		var tmpObj = JSON.parse(JSON.stringify(<?php echo esc_html($divItem) ?>));
		tmpObj.ajax_running = true;
		var currentBlockObjSignature = JSON.stringify(tmpObj);
		avalonLocalCache.set(currentBlockObjSignature, JSON.stringify(<?php echo json_encode($dataArray) ?>));
	</script>
	<?php
	$script		.= ob_get_clean();
	
	return $script;
}