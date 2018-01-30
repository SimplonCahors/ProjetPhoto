<?php
/**
 * Button element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_ButtonBlock extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'button_block';
			// element name
			$this->config['name']	 		= __('Button', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-check-empty';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Button';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_button">';
			$innerHtml .= '<div class="bilder_icon_container"> <a title="" target="_self" class="button orange" style="selector:attrib"><span class="themedo-button-text">Button Text</span></a> </div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$choices					= themedoHelper::get_shortcode_choices();
			$leftright					= themedoHelper::get_left_right_data();
			$animation_speed 			= themedoHelper::get_animation_speed_data();
			$animation_direction 		= themedoHelper::get_animation_direction_data();
			$animation_type 			= themedoHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Button URL', 'themedo-core'),
					  "desc" 			=> __('Add the button\'s url ex: http://example.com', 'themedo-core'),
					  "id" 				=> "avalon_td_url",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Button Style', 'themedo-core'),
					  "desc" 			=> __('Select the button\'s color. Select default or color name for theme options, or select custom to use advanced color options below.', 'themedo-core'),
					  "id" 				=> "avalon_td_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 			=> __('Default', 'themedo-core'),
					  						   'custom'			=> __('Custom', 'themedo-core'),
											   'green' 			=> __('Green', 'themedo-core'),
											   'darkgreen' 		=> __('Dark Green', 'themedo-core'),
											   'orange' 		=> __('Orange', 'themedo-core'),
											   'blue'			=> __('Blue', 'themedo-core'),
											   'red' 			=> __('Red', 'themedo-core'),
											   'pink' 			=> __('Pink', 'themedo-core'),
											   'darkgray' 		=> __('Dark Gray', 'themedo-core'),
											   'lightgray' 		=> __('Light Gray', 'themedo-core')) 
					 ),
					 
				array("name" 			=> __('Button Size', 'themedo-core'),
					  "desc" 			=> __('Select the button\'s size. Choose default for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'themedo-core'),
						'small' 		=> __('Small', 'themedo-core'),
											   'medium' 		=> __('Medium', 'themedo-core'),
											   'large' 			=> __('Large', 'themedo-core'),
												'xlarge' 		=> __('XLarge', 'themedo-core'),) 
					 ),
					 
				array("name" 			=> __('Button Type', 'themedo-core'),
					  "desc" 			=> __('Select the button\'s type. Choose default for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'themedo-core'),
						'flat' 		=>__('Flat', 'themedo-core'),
											   '3d' 			=>'3D') 
					 ),
					 
				array("name" 			=> __('Button Shape', 'themedo-core'),
					  "desc" 			=> __('Select the button\'s shape. Choose default for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_shape",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'themedo-core'),
						'square' 		=> __('Square', 'themedo-core'),
												'pill' 			=> __('Pill', 'themedo-core'),
												'round' 		=> __('Round', 'themedo-core')) 
					 ),
					 
				array("name" 			=> __('Button Target', 'themedo-core'),
					  "desc" 			=> __('_self = open in same window<br>_blank = open in new window', 'themedo-core'),
					  "id" 				=> "avalon_td_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_self",
					  "allowedValues" 	=> array('_self' 		=>'_self',
											   '_blank' 		=>'_blank') 
					 ),
					 
				array("name" 			=> __('Button Title attribute', 'themedo-core'),
					  "desc" 			=> __('Set a title attribute for the button link.', 'themedo-core'),
					  "id" 				=> "avalon_td_title",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  	 
				array("name" 			=> __('Button\'s Text', 'themedo-core'),
					  "desc" 			=> __('Add the text that will display on button', 'themedo-core'),
					  "id" 				=> "avalon_td_content",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> "Button Text"
					  ),
				
				array("name" 			=> __('Button Gradient Top Color', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Set the top color of the button background.', 'themedo-core'),
					  "id" 				=> "avalon_td_gradtopcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Bottom Color', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Set the bottom color of the button background or leave empty for solid color.', 'themedo-core'),
					  "id" 				=> "avalon_td_gradbottomcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Top Color Hover', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Set the top hover color of the button background.', 'themedo-core'),
					  "id" 				=> "avalon_td_gradtopcolorhover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Bottom Color Hover', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. Set the bottom hover color of the button background or leave empty for solid color.', 'themedo-core'),
					  "id" 				=> "avalon_td_gradbottomcolorhover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Accent Color', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. This option controls the color of the button border, divider, text and icon.', 'themedo-core'),
					  "id" 				=> "avalon_td_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Accent Hover Color', 'themedo-core'),
					  "desc" 			=> __('Custom setting only. This option controls the hover color of the button border, divider, text and icon.', 'themedo-core'),
					  "id" 				=> "avalon_td_borderhovercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Bevel Color (3D Mode only)', 'themedo-core'),
					  "desc" 			=> __('Custom setting. Set the bevel color of 3D buttons.', 'themedo-core'),
					  "id" 				=> "avalon_td_bevelcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Width', 'themedo-core'),
					  "desc"			=> __('Custom setting only. In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					 
				array("name" 			=> __('Select Custom Icon', 'themedo-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'themedo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> themedoHelper::GET_ICONS_LIST()
					  ),
					  
				
				array("name" 			=> __('Icon Position', 'themedo-core'),
					  "desc" 			=> __('Choose the position of the icon on the button.', 'themedo-core'),
					  "id" 				=> "avalon_td_iconposition",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $leftright
					 ),
					 
				array("name" 			=> __('Icon Divider', 'themedo-core'),
					  "desc" 			=> __('Choose to display a divider between icon and text.', 'themedo-core'),
					  "id" 				=> "avalon_td_icondivider",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $choices
					 ),
					 
				array("name" 			=> __('Modal Window Anchor', 'themedo-core'),
					  "desc"			=> __('Add the class name of the modal window you want to open on button click.', 'themedo-core'),
					  "id" 				=> "avalon_td_modal",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
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
					  "allowedValues" 	=> $animation_speed 
					  ),

		  array("name"	  => __('Alignment', 'themedo-core'),
					  "desc"	  => __('Select the button\'s alignment.', 'themedo-core'),
					  "id"		=> "avalon_td_alignment",
					  "type"	  => ElementTypeEnum::SELECT,
			"value"	   => "",
					  "allowedValues"   => array(''	  => __('Default', 'themedo-core'),
						   'left'	 => __('Left', 'themedo-core'),
											   'center'	  => __('Center', 'themedo-core'),
						 'right'	=> __('Right', 'themedo-core')) 
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