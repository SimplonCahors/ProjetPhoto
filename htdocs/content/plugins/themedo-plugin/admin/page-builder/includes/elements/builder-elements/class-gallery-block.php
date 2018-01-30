<?php
/**
 * RecentWorks implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_GalleryBlock extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'gallery_block';
			// element name
			$this->config['name']	 		= __('Gallery Block', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-insertpicture';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Gallery Block Block';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_gallery_block">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-insertpicture"></i><sub class="sub">'.__('Gallery Block', 'themedo-core').'</sub><p>layout = <span class="gallery_block_layout">Slider</span><span class="rw_cats_container"><br>categories = <font class="gallery_block_cats">All</font></span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$wp_categories_list  		= themedoHelper::avalon_td_shortcodes_categories('gallery_category');
			$choices					= themedoHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
			
			   array( "name" 			=> __('Layout', 'themedo-core'),
					  "desc" 			=> __('Choose the layout for the shortcode', 'themedo-core'),
					  "id" 				=> "avalon_td_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "slider",
					  "allowedValues" 	=> array('slider' 				=> __('Slider', 'themedo-core'),
												 'halfimg' 				=> __('Half Screen Img', 'themedo-core'),
												 'split' 				=> __('Split', 'themedo-core'),
												 'fullscreen' 			=> __('Fullscreen', 'themedo-core'),
												 'fullwidth' 			=> __('Fullwidth', 'themedo-core'),
												 'creative1' 			=> __('Creative A', 'themedo-core'),
												 //'creative2' 			=> __('Creative B', 'themedo-core')
												 )
					  ),
					  	    
				array("name" 			=> __('Categories', 'themedo-core'),
					  "desc" 			=> __('Select a category or leave blank for all', 'themedo-core'),
					  "id" 				=> "avalon_td_cat_slug",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
					 
				array("name" 			=> __('Exclude Categories', 'themedo-core'),
					  "desc" 			=> __('Select a category to exclude', 'themedo-core'),
					  "id" 				=> "avalon_td_exclude_cats",
					  "type" 			=> ElementTypeEnum::MULTI,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list 
					 ),
					 
				array("name" 			=> __('Number of Posts', 'themedo-core'),
					  "desc" 			=> __('Select the number of posts to display', 'themedo-core'),
					  "id" 				=> "avalon_td_post_count",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "2"
					  ),
					  
				array("name" 			=> __('Order Posts', 'themedo-core'),
					  "desc" 			=> __('Choose ordering type for posts', 'themedo-core'),
					  "id" 				=> "avalon_td_order",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 					=> __('Newness', 'themedo-core'),
												 'rand' 				=> __('Random', 'themedo-core'))
					  ),
					  
				array("name" 			=> __('Post Offset', 'themedo-core'),
					  "desc" 			=> __('The number of posts to skip. ex: 1.', 'themedo-core'),
					  "id" 				=> "avalon_td_offset",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array(
					"name"  			=> __( 'Margin Top', 'themedo-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> __( 'Margin Bottom', 'themedo-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    			=> "margin_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),					  
		  
				array("name" 			=> __('CSS Class', 'themedo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "avalon_td_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('CSS ID', 'themedo-core'),
					  "desc"			=> __('Add an ID to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "avalon_td_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					 
				);
		}
	}