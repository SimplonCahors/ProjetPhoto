<?php
/**
 * TaglineBox block implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_TaglineBox extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'tagline_box';
			// element name
			$this->config['name']	 		= __('Tagline Box', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-list-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Tagline Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_tagline_box">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-list-alt"></i><sub class="sub">'.__('Tagline Box', 'themedo-core').'</sub><p class="tagline_title">Tagline title text will go here...</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		//function to create shadow opacity data
		function create_shadow_opacity_data() {
			$opacity_data 	= array();
			$options 		= .1;
			while ($options < 1) {
				
				$opacity_data["avalon_td_".$options] = $options;
				$options				= $options + .1;
			}
			return $opacity_data;
		}
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= themedoHelper::get_reversed_choice_data();
			$animation_speed 			= themedoHelper::get_animation_speed_data();
			$animation_direction 		= themedoHelper::get_animation_direction_data();
			$animation_type 			= themedoHelper::get_animation_type_data();
			
			$opacity_data = $this->create_shadow_opacity_data();
			$this->config['subElements'] = array(
				array("name" 			=> __('Background Color', 'themedo-core'),
					  "desc" 			=> __('Controls the background color. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Shadow', 'themedo-core'),
					  "desc" 			=> __('Show the shadow below the box', 'themedo-core'),
					  "id" 				=> "avalon_td_shadow",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices
					  ),
					  
				array("name" 			=> __('Shadow Opacity', 'themedo-core'),
					  "desc" 			=> __('Choose the opacity of the shadow', 'themedo-core'),
					  "id" 				=> "avalon_td_shadowopacity",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0.7",
					  "allowedValues" 	=> $opacity_data
					  ),
					  
				array("name" 			=> __('Border', 'themedo-core'),
					  "desc"			=> __('In pixels (px), ex: 1px', 'themedo-core'),
					  "id" 				=> "avalon_td_border",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					  
				array("name" 			=> __('Border Color', 'themedo-core'),
					  "desc" 			=> __('Controls the border color. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Highlight Border Position', 'themedo-core'),
					  "desc" 			=> __('Choose the position of the highlight. This border highlight is from theme options primary color and does not take the color from border color above', 'themedo-core'),
					  "id" 				=> "avalon_td_highlightposition",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "top",
					  "allowedValues" 	=> array('top' 			=> __('Top', 'themedo-core'),
												'bottom' 		=> __('Bottom', 'themedo-core'),
												'left'			=> __('Left', 'themedo-core'),
												'right' 		=> __('Right', 'themedo-core'),
												'none'			=> __('None', 'themedo-core'))
					  ),
					  
				array("name" 			=> __('Content Alignment', 'themedo-core'),
					  "desc" 			=> __('Choose how the content should be displayed.', 'themedo-core'),
					  "id" 				=> "avalon_td_contentalignment",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'themedo-core'),
												'center' 		=> __('Center', 'themedo-core'),
												'right'			=> __('Right', 'themedo-core'))
					  ),
					  
				array("name" 			=> __('Button Text', 'themedo-core'),
					  "desc" 			=> __('Insert the text that will display in the button', 'themedo-core'),
					  "id" 				=> "avalon_td_button",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Link', 'themedo-core'),
					  "desc" 			=> __('The url the button will link to', 'themedo-core'),
					  "id" 				=> "avalon_td_url",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Link Target', 'themedo-core'),
					  "desc" 			=> __('_self = open in same window<br>_blank = open in new window', 'themedo-core'),
					  "id" 				=> "avalon_td_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_self",
					  "allowedValues" 	=> array('_self' 		=>'_self',
											   '_blank' 		=>'_blank') 
					 ),

		array("name"	  => __('Modal Window Anchor', 'themedo-core'),
					  "desc"	  => __('Add the class name of the modal window you want to open on button click.', 'themedo-core'),
					  "id"		=> "avalon_td_modalanchor",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""),
					 
				array("name" 			=> __('Button Size', 'themedo-core'),
					  "desc" 			=> __('Select the button\'s size.', 'themedo-core'),
					  "id" 				=> "avalon_td_buttonsize",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'themedo-core'),
					  							'small' 		=>__('Small', 'themedo-core'),
											   'medium' 		=>__('Medium', 'themedo-core'),
											   'large' 			=> __('Large', 'themedo-core'),
											   'xlarge' 		=> __('XLarge', 'themedo-core')) 
					 ),
					 
				array("name" 			=> __('Button Type', 'themedo-core'),
					  "desc" 			=> __('Select the button\'s type.', 'themedo-core'),
					  "id" 				=> "avalon_td_buttontype",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'themedo-core'),
					  							'flat' 		=>__('Flat', 'themedo-core'),
											   '3D' 			=>'3D') 
					 ),
					 
				array("name" 			=> __('Button Shape', 'themedo-core'),
					  "desc" 			=> __('Select the button\'s shape.', 'themedo-core'),
					  "id" 				=> "avalon_td_buttonshape",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'themedo-core'),
					  							'square' 		=> __('Square', 'themedo-core'),
											   'pill' 			=> __('Pill', 'themedo-core'),
											   'round' 			=> __('Round', 'themedo-core')) 
					 ),
					 
				array("name" 			=> __('Button Color', 'themedo-core'),
					  "desc" 			=> __('Choose the button color<br>Default uses theme option selection', 'themedo-core'),
					  "id" 				=> "avalon_td_buttoncolor",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 			=> __('Default', 'themedo-core'),
											   'green' 			=> __('Green', 'themedo-core'),
											   'darkgreen' 		=> __('Dark Green', 'themedo-core'),
											   'orange' 		=> __('Orange', 'themedo-core'),
											   'blue'			=> __('Blue', 'themedo-core'),
											   'red' 			=> __('Red', 'themedo-core'),
											   'pink' 			=> __('Pink', 'themedo-core'),
											   'darkgray' 		=> __('Dark Gray', 'themedo-core'),
											   'lightgray' 		=> __('Light Gray', 'themedo-core')) 
					 ),
					 
				array("name" 			=> __('Tagline Title', 'themedo-core'),
					  "desc"			=> __('Insert the title text', 'themedo-core'),
					  "id" 				=> "avalon_td_title",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Tagline Description', 'themedo-core'),
					  "desc"			=> __('Insert the description text', 'themedo-core'),
					  "id" 				=> "avalon_td_description",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> "" 
					  ),

				array("name" 			=> __('Additional Content', 'themedo-core'),
					  "desc"			=> __('This is additional content you can add to the tagline box. This will show below the title and description if one is used.', 'themedo-core'),
					  "id" 				=> "avalon_td_additionalcontent",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Margin Top', 'themedo-core'),
					  "desc" 			=> __('Add a custom top margin. In pixels.', 'themedo-core'),
					  "id" 				=> "avalon_td_margin_top",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Margin Bottom', 'themedo-core'),
					  "desc" 			=> __('Add a custom bottom margin. In pixels.', 'themedo-core'),
					  "id" 				=> "avalon_td_margin_bottom",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),						  
					  
				array("name" 			=> __('Animation Type', 'themedo-core'),
					  "desc" 			=> __('Select the type on animation to use on the shortcode', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'themedo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'themedo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_speed",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0.1",
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