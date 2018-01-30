<?php
/**
 * ProgressBar implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_ProgressBar extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'progress_bar';
			// element name
			$this->config['name']	 		= __('Progress Bar', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Prcing Bar';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_progress_bar">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-expand-alt"></i><sub class="sub">'.__('Progress Bar', 'themedo-core').'</sub><p class="progress_bar_text">HTML Skills</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$filled_area 				= themedoHelper::avalon_td_create_dropdown_data( 1, 100 );
			$reverse_choices			= themedoHelper::get_reversed_choice_data_2();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Filled Area Percentage', 'themedo-core'),
					  "desc" 			=> __('From 1% to 100%', 'themedo-core'),
					  "id" 				=> "avalon_td_value",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "50",
					  "allowedValues" 	=> $filled_area 
					  ),
					  
				array("name" 			=> __('Progess Bar Text', 'themedo-core'),
					  "desc"			=> __('Text will show up on progess bar', 'themedo-core'),
					  "id" 				=> "avalon_td_content",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					 	  
				array("name" 			=> __('Filled Color', 'themedo-core'),
					  "desc" 			=> __('Controls the color of the filled in area. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_filledcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Striped Filling', 'themedo-core'),
					  "desc" 			=> __('Choose to get the filled area striped.', 'themedo-core'),
					  "id" 				=> "avalon_td_striped",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "off",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name"			=> __('Size', 'themedo-core'),
					  "desc"			=> __('Set size of the shortcode.', 'themedo-core'),
					  "id"				=> "avalon_td_size",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array("big"),
					  "allowedValues"   => array('big'		 => __('Big', 'themedo-core'),
												 'medium'	 => __('Medium', 'themedo-core'),
												 'small'	 => __('Small', 'themedo-core')) 
				),
				array("name"			=> __('Rounded Corner', 'themedo-core'),
					  "desc"			=> __('Set rounded corner', 'themedo-core'),
					  "id"				=> "avalon_td_round",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array("off"),
					  "allowedValues"   => array('off'		=> __('Off', 'themedo-core'),
												 'a'	 	=> __('Small', 'themedo-core'),
												 'b'	 	=> __('Medium', 'themedo-core'),
												 'c'	 	=> __('Large', 'themedo-core')) 
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