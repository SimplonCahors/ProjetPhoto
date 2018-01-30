<?php
/**
 * Person element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Person extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'person_box';
			// element name
			$this->config['name']	 		= __('Person', 'themedo-core');
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
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_person">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-expand-alt"></i><sub class="sub">'.__('Person', 'themedo-core').'</sub><div class="img_frame_section">Image here</div><p class="person_name">John Doe</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
					  
				array("name" 			=> __('Name', 'themedo-core'),
					  "desc"			=> __('Insert the name of the person.', 'themedo-core'),
					  "id" 				=> "avalon_td_name",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Occupation', 'themedo-core'),
					  "desc"			=> __('Insert the occupation', 'themedo-core'),
					  "id" 				=> "avalon_td_occ",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					 
				array("name" 			=> __('Picture', 'themedo-core'),
					  "desc" 			=> __('Upload an image to display.', 'themedo-core'),
					  "id" 				=> "avalon_td_picture",
					  "upid" 			=> "1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> __('Content', 'themedo-core'),
					  "desc"			=> '',
					  "id" 				=> "avalon_td_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> "" 
					  ),
					  	  
				array("name" 			=> __('Text Align', 'themedo-core'),
					  "desc"			=> '',
					  "id" 				=> "avalon_td_text_align",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'themedo-core'),
												 'right' 			=> __('Right', 'themedo-core'),
												 'center' 			=> __('Center', 'themedo-core')) 
					  ),
				array(
					"name"  			=> __( 'Email Address', 'themedo-core' ),
					"desc"  			=> __( 'Insert an email address', 'themedo-core' ),
					"id"    			=> "email",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Facebook Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Facebook link', 'themedo-core' ),
					"id"    			=> "facebook",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Twitter Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Twitter link', 'themedo-core' ),
					"id"    			=> "twitter",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Instagram Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Instagram link', 'themedo-core' ),
					"id"    			=> "instagram",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Google+ Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Google+ link', 'themedo-core' ),
					"id"    			=> "google",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'LinkedIn Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom LinkedIn link', 'themedo-core' ),
					"id"    			=> "linkedin",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Vimeo Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Vimeo Link', 'themedo-core' ),
					"id"    			=> "vimeo",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Youtube Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Youtube Link', 'themedo-core' ),
					"id"    			=> "youtube",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Flickr Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Flickr Link', 'themedo-core' ),
					"id"    			=> "flickr",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Skype Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Skype Link', 'themedo-core' ),
					"id"    			=> "skype",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Tumblr Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Tumblr Link', 'themedo-core' ),
					"id"    			=> "tumblr",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Dribbble Link', 'themedo-core' ),
					"desc"  			=> __( 'Insert your custom Dribbble Link', 'themedo-core' ),
					"id"    			=> "dribbble",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'themedo-core' ),
				),
				array(
					"name"  			=> __( 'Margin Top', 'themedo-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'themedo-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
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