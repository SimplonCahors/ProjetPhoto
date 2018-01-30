<?php
/**
 * PostSlider implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_PostSlider extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'post_slider';
			// element name
			$this->config['name']	 		= __('Post Slider', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-layers-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Elastic Slider';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_post_slider">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-layers-alt"></i><sub class="sub">'.__('Post Slider', 'themedo-core').'</sub><p>layout = <span class="post_slider_layout">posts-with-excerpts</span><br /><span class="cat_container" style="selector:attrib"> category = <span class="post_slider_cat">design</span></span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$wp_categories 	= themedoHelper::get_wp_categories_list();
			$cat_element	= array('' => 'All');
			$wp_categories  = $cat_element + $wp_categories;
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Layout', 'themedo-core'),
					  "desc" 			=> __('Choose a layout style for Post Slider.', 'themedo-core'),
					  "id" 				=> "avalon_td_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "posts",
					  "allowedValues" 	=> array('posts' 				=> __('Posts with Title', 'themedo-core'),
												 'posts-with-excerpt' 	=> __('Posts with Title and Excerpt', 'themedo-core'),
												 'attachments' 			=> __('Attachment Layout, Only Images Attached to Post/Page', 'themedo-core')) 
					  ),
					  
				array("name" 			=> __('Excerpt Number of Words', 'themedo-core'),
					  "desc" 			=> __('Insert the number of words you want to show in the excerpt.', 'themedo-core'),
					  "id" 				=> "avalon_td_excerpt",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "35",
					  ),
					  
				array("name" 			=> __('Category', 'themedo-core'),
					  "desc" 			=> __('Select a category of posts to display.', 'themedo-core'),
					  "id" 				=> "avalon_td_category",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $wp_categories
					  ),
					  
				array("name" 			=> __('Number of Slides', 'themedo-core'),
					  "desc" 			=> __('Select the number of slides to display.', 'themedo-core'),
					  "id" 				=> "avalon_td_limit",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "3"
					  ),
					  
				array("name" 			=> __('Lightbox on Click', 'themedo-core'),
					  "desc" 			=> __('Only works on attachment layout.', 'themedo-core'),
					  "id" 				=> "avalon_td_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 					=> __('Yes', 'themedo-core'),
												 'no' 					=> __('No', 'themedo-core')) 
					  ),
					  
				array("name" 			=> __('Attach Images to Post/Page Gallery', 'themedo-core'),
					  "desc" 			=> __('Only works for attachments layout.', 'themedo-core'),
					  "id" 				=> "avalon_td_gallery",
					  "type" 			=> ElementTypeEnum::GALLERY,
					  "value" 			=> " "
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