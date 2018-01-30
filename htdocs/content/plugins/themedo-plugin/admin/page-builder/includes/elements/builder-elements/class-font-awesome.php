<?php
/**
 * FontAwesome implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_FontAwesome extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class($this);
			// element id
			$this->config['id']	   	= 'font_awesome';
			// element name
			$this->config['name']	 	= __('Font Awesome', 'themedo-core');
			// element icon
			$this->config['icon_url']  	= "icons/sc-icon_box.png";
			// css class related to this element
			$this->config['css_class'] 	= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']	= 'themedo-icon builder-options-icon themedoa-flag';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  	= 'Creates Font Awesome Elements';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_font_awesome">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><h3 style="selector:hattrib"><i class="themedoa-flag" style="selector:iattrib"></i></h3></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$animation_speed 			= themedoHelper::get_animation_speed_data();
			$animation_direction 		= themedoHelper::get_animation_direction_data();
			$animation_type 			= themedoHelper::get_animation_type_data();
			$choices					= themedoHelper::get_shortcode_choices();
			$reverse_choices			= themedoHelper::get_reversed_choice_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Select Icon', 'themedo-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect.', 'themedo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "fa-flag",
					  "list"			=> themedoHelper::GET_ICONS_LIST()
					  ),
				
				array("name" 			=> __('Icon in Circle', 'themedo-core'),
					  "desc" 			=> __('Choose to display the icon in a circle', 'themedo-core'),
					  "id" 				=> "avalon_td_circle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					  ),
				
				array("name" 			=> __('Icon Size', 'themedo-core'),
					  "desc" 			=> __('Set the size of the icon. In pixels (px), ex: 13px.', 'themedo-core'),
					  "id" 				=> "avalon_td_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> __('Icon Color', 'themedo-core'),
					  "desc" 			=> __('Controls the color of the icon. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_iconcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Icon Circle Background Color', 'themedo-core'),
					  "desc" 			=> __('Controls the color of the circle. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_circlecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Icon Circle Border Color', 'themedo-core'),
					  "desc" 			=> __('Controls the color of the circle border. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "circlebordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Rotate Icon', 'themedo-core'),
					  "desc" 			=> __('Choose to rotate the icon.', 'themedo-core'),
					  "id" 				=> "avalon_td_rotate",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 			=>'None',
											   '90' 			=>'90',
											   '180' 			=> '180',
											   '270'			=> '270')
					  ),
					  
				array("name" 			=> __('Spinning Icon', 'themedo-core'),
					  "desc" 			=> __('Choose to let the icon spin.', 'themedo-core'),
					  "id" 				=> "avalon_td_spin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Animation Type', 'themedo-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'themedo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> '',
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'themedo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues"	=> $animation_speed 
					  ),

			    array("name"	  	=> __('Alignment', 'themedo-core'),
					  "desc"	  	=> __('Select the icon\'s alignment.', 'themedo-core'),
					  "id"			=> "avalon_td_alignment",
					  "type"	  	=> ElementTypeEnum::SELECT,
					  "value"	   	=> "",
					  "allowedValues"   => array(
							''	  		=> __('Default', 'themedo-core'),
							'left'	 	=> __('Left', 'themedo-core'),
							'center'	=> __('Center', 'themedo-core'),
							'right'		=> __('Right', 'themedo-core')) 
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