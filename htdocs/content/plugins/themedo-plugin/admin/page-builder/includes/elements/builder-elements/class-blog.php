<?php
/**
 * Blog element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_WpBlog extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'wp_blog';
			// element name
			$this->config['name']	 		= __('Blog', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-blog';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Blog';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_blog">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-blog"></i><sub class="sub">'.__('Blog', 'themedo-core').'</sub><p>layout = <span class="blog_layout">icon-on-side</span><font class="blog_columns">columns = 5</font></p></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$posts_per_page 			= array('avalon_td_-1' => 'All' , 'avalon_td_' => 'Default');
			$blog_posts_per_page 		= themedoHelper::avalon_td_create_dropdown_data( 1, 25, $posts_per_page );
			$wp_categories_list  		= themedoHelper::get_wp_categories_list();
			$choices					= themedoHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Blog Layout', 'themedo-core'),
					  "desc" 			=> __('Select the layout for the blog shortcode', 'themedo-core'),
					  "id" 				=> "avalon_td_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "large",
					  "allowedValues" 	=> array('large' 			=> __('Large', 'themedo-core'),
												 'medium' 			=> __('Medium', 'themedo-core'),
												 'large alternate' 	=> __('Large Alternate', 'themedo-core'),
												 'medium alternate' => __('Medium Alternate', 'themedo-core'),
												 'grid'				=> __('Grid', 'themedo-core'),
												 'timeline'			=> __('Timeline', 'themedo-core'))
					  ),
											   
				array("name" 			=> __('Posts Per Page', 'themedo-core'),
					  "desc" 			=> __('Select number of posts per page.', 'themedo-core'),
					  "id" 				=> "avalon_td_posts_per_page",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $blog_posts_per_page
					  ),
					  
				array("name" 			=> __('Post Offset', 'themedo-core'),
					  "desc" 			=> __('The number of posts to skip. ex: 1.', 'themedo-core'),
					  "id" 				=> "avalon_td_offset",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> '',
					  ),					  					  
					  
				array("name" 			=> __('Categories', 'themedo-core'),
					  "desc" 			=> __('Select a category or leave blank for all.', 'themedo-core'),
					  "id" 				=> "avalon_td_cat_slug",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
					 
				array("name" 			=> __('Exclude Categories', 'themedo-core'),
					  "desc" 			=> __('Select a category to exclude.', 'themedo-core'),
					  "id" 				=> "avalon_td_exclude_cats",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
				
				array("name" 			=> __('Show Title', 'themedo-core'),
					  "desc" 			=> __('Display the post title below the featured image.', 'themedo-core'),
					  "id" 				=> "avalon_td_title",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
				array("name" 			=> __('Link Title To Post', 'themedo-core'),
					  "desc" 			=> __('Choose if the title should be a link to the single post page.', 'themedo-core'),
					  "id" 				=> "avalon_td_title_link",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
				
				array("name" 			=> __('Show Thumbnail', 'themedo-core'),
					  "desc" 			=> __('Display the post featured image.', 'themedo-core'),
					  "id" 				=> "avalon_td_thumbnail",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			   array("name" 			=> __('Show Excerpt', 'themedo-core'),
					  "desc" 			=> __('Show excerpt or choose "no" for full content.', 'themedo-core'),
					  "id" 				=> "avalon_td_excerpt",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			  
			  array("name" 				=> __('Number of words/characters in Excerpt', 'themedo-core'),
					  "desc" 			=> __('Control the excerpt length based on words/character setting in Theme Options > Extra.', 'themedo-core'),
					  "id" 				=> "avalon_td_excerpt_words",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> 35,
					 ),
					 
			 array("name" 				=> __('Show Meta Info', 'themedo-core'),
					  "desc" 			=> __('Choose to show all meta data.', 'themedo-core'),
					  "id" 				=> "avalon_td_meta_all",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Author Name', 'themedo-core'),
					  "desc" 			=> __('Choose to show the author.', 'themedo-core'),
					  "id" 				=> "avalon_td_meta_author",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			
			array("name" 				=> __('Show Categories', 'themedo-core'),
					  "desc" 			=> __('Choose to show the categories.', 'themedo-core'),
					  "id" 				=> "avalon_td_meta_categories",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Comment Count', 'themedo-core'),
					  "desc" 			=> __('Choose to show the comments.', 'themedo-core'),
					  "id" 				=> "avalon_td_meta_comments",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			
			array("name" 				=> __('Show Date', 'themedo-core'),
					  "desc" 			=> __('Choose to show the date.', 'themedo-core'),
					  "id" 				=> "avalon_td_meta_date",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
			
			array("name" 				=> __('Show Read More Link', 'themedo-core'),
					  "desc" 			=> __('Choose to show the Read More link.', 'themedo-core'),
					  "id" 				=> "avalon_td_meta_link",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Tags', 'themedo-core'),
					  "desc" 			=> __('Choose to show the tags.', 'themedo-core'),
					  "id" 				=> "avalon_td_meta_tags",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Show Pagination', 'themedo-core'),
					  "desc" 			=> __('Show numerical pagination boxes.', 'themedo-core'),
					  "id" 				=> "avalon_td_paging",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('Pagination Type', 'themedo-core'),
					  "desc" 			=> __('Choose the type of pagination.', 'themedo-core'),
					  "id" 				=> "avalon_td_scrolling",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "pagination",
					  "allowedValues" 	=> array('pagination' => __('Pagination', 'themedo-core'),
												 'infinite'   => __('Infinite Scrolling', 'themedo-core'),
												 'load_more_button' => __('Load More Button', 'themedo-core')) 
					 ),
					 
			array("name" 				=> __('Grid Layout # of Columns', 'themedo-core'),
					  "desc" 			=> __('Select whether to display the grid layout in 2, 3, 4, 5 or 6 column.', 'themedo-core'),
					  "id" 				=> "avalon_td_blog_grid_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "3",
					  "allowedValues" 	=> array('2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6') 
					 ),
					 
			array("name" 				=> __('Grid Layout Column Spacing', 'themedo-core'),
					  "desc" 			=> __('Insert the amount of spacing between blog grid posts without "px".', 'themedo-core'),
					  "id" 				=> "avalon_td_blog_grid_column_spacing",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "40"
				  ),	
					 				 	 
			array("name" 				=> __('Strip HTML from Posts Content', 'themedo-core'),
					  "desc" 			=> __('Strip HTML from the post excerpt.', 'themedo-core'),
					  "id" 				=> "avalon_td_strip_html",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
					 
			array("name" 				=> __('CSS Class', 'themedo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "avalon_td_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
			array("name" 				=> __('CSS ID', 'themedo-core'),
				  	"desc"				=> __('Add an ID to the wrapping HTML element.', 'themedo-core'),
				  	"id" 				=> "avalon_td_id",
				  	"type" 				=> ElementTypeEnum::INPUT,
				  	"value" 			=> "" 
				  ),
				
				);
		}
	}