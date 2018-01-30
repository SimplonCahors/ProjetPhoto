<?php
/**
 * Person element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Service extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'service_box';
			// element name
			$this->config['name']	 		= __('Service', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Person Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_service">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-expand-alt"></i><sub class="sub">'.__('Service', 'themedo-core').'</sub><div class="img_frame_section">Image here</div><p class="service_name">Service Title</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
					  
				array("name" 			=> __('Image', 'themedo-core'),
					  "desc" 			=> __('Upload an image to display.', 'themedo-core'),
					  "id" 				=> "avalon_td_image",
					  "upid" 			=> "1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Title', 'themedo-core'),
					  "desc"			=> __('Insert the title of the service.', 'themedo-core'),
					  "id" 				=> "avalon_td_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Subtitle', 'themedo-core'),
					  "desc"			=> __('Insert the subtitle of the service', 'themedo-core'),
					  "id" 				=> "avalon_td_subtitle",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					 
				
				array("name" 			=> __('Content', 'themedo-core'),
					  "id" 				=> "avalon_td_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
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
					"value" 			=> "40px",
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