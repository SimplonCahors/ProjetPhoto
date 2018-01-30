<?php
/**
 * Alert Box implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_AlertBox extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class($this);
			// element id
			$this->config['id']	   	= 'alert_box';
			// element name
			$this->config['name']	 	= __('Alert', 'themedo-core');
			// element icon
			$this->config['icon_url']  	= "icons/sc-notification.png";
			// css class related to this element
			$this->config['css_class'] 	= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']	= 'themedo-icon builder-options-icon themedoa-exclamation-sign';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  	= 'Creates an Alert Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_alert">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-exclamation-sign"></i><sub class="sub">'.__('Preview text will go here and custom icon choice', 'themedo-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$animation_speed 		= themedoHelper::get_animation_speed_data();
			$animation_direction 	= themedoHelper::get_animation_direction_data();
			$animation_type 		= themedoHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Alert Type', 'themedo-core'),
					  "desc" 			=> __('Select the type of alert message. Choose custom for advanced color options below.', 'themedo-core'),
					  "id" 				=> "avalon_td_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "general",
					  "allowedValues" 	=> array('general' 	=>__('General', 'themedo-core'),
											   'error' 		=>__('Error', 'themedo-core'),
											   'success' 	=> __('Success', 'themedo-core'),
											   'notice' 	=> __('Notice', 'themedo-core'),
											   'custom' 	=> __('Custom', 'themedo-core'),)
					  ),
				
				array("name" 			=> __('Accent Color', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Set the border, text and icon color for custom alert boxes.', 'themedo-core'),
					  "id" 				=> "avalon_td_accentcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Background Color', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Set the background color for custom alert boxes.', 'themedo-core'),
					  "id" 				=> "avalon_td_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Width', 'themedo-core'),
					  "desc"			=> __('Custom setting. For custom alert boxes. In pixels (px), ex: 1px.', 'themedo-core'),
					  "id" 				=> "avalon_td_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					  
				array("name" 			=> __('Select Custom Icon', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Click an icon to select, click again to deselect', 'themedo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> themedoHelper::GET_ICONS_LIST()
					  ),

		array("name"	  => __('Box Shadow', 'themedo-core'),
			"desc"	  => __('Display a box shadow below the alert box.', 'themedo-core'),
					  "id"		=> "avalon_td_boxshadow",
					  "type"	  => ElementTypeEnum::SELECT,
					  "value"	   => "yes",
			"allowedValues"   => array('yes'	=> __('Yes', 'themedo-core'),
											   'no'	 => __('No', 'themedo-core'),)
		   ),
											   
				array("name" 			=> __('Alert Content', 'themedo-core'),
					  "desc" 			=> __('Insert the alert\'s content', 'themedo-core'),
					  "id" 				=> "avalon_td_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> __('Your Content Goes Here', 'themedo-core')
					  ),
					  
				array("name" 			=> __('Animation Type', 'themedo-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'themedo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'themedo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "" ,
					  "allowedValues"	=> $animation_speed
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