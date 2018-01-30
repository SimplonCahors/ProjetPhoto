<?php
/**
 * ImageFrame implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_ImageFrame extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'image_frame';
			// element name
			$this->config['name']	 		= __('Image Frame', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-image';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates an Image Frame';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_image_frame">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-image"></i><sub class="sub">'.__('Image Frame', 'themedo-core').'</sub><div class="img_frame_section">Image here</div></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$border_size 				= themedoHelper::avalon_td_create_dropdown_data( 0, 10 );
			$reverse_choices			= themedoHelper::get_reversed_choice_data();
			$animation_speed 			= themedoHelper::get_animation_speed_data();
			$animation_direction 		= themedoHelper::get_animation_direction_data();
			$animation_type 			= themedoHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Frame Style Type', 'themedo-core'),
					  "desc" 			=> __('Select the frame style type.', 'themedo-core'),
					  "id" 				=> "avalon_td_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'themedo-core'),
												 'glow' 			=> __('Glow', 'themedo-core'),
												 'dropshadow' 		=> __('Drop Shadow', 'themedo-core'),
												 'bottomshadow' 	=> __('Bottom Shadow', 'themedo-core')) 
					  ),

				array("name" 			=> __('Hover Type', 'themedo-core'),
					  "desc" 			=> __('Select the hover effect type.', 'themedo-core'),
					  "id" 				=> "avalon_td_hover_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'themedo-core'),
												 'zoomin' 			=> __('Zoom In', 'themedo-core'),
												 'zoomout' 			=> __('Zoom Out', 'themedo-core'),
												 'liftup' 			=> __('Lift Up', 'themedo-core')) 
					  ),
					  
				array("name" 			=> __('Border Color', 'themedo-core'),
					  "desc" 			=> __('Controls the border color. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Size', 'themedo-core'),
					  "desc" 			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0px",
					  ),

				array("name" 			=> __('Border Radius', 'themedo-core'),
					  "desc"			=> __('Choose the radius of the image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_borderradius",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0" 
					  ),						  
					  
				array("name" 			=> __('Style Color', 'themedo-core'),
					  "desc" 			=> __('For all style types except border. Controls the style color. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_stylecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Align', 'themedo-core'),
					  "desc" 			=> __('Choose how to align the image.', 'themedo-core'),
					  "id" 				=> "avalon_td_align",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none'				=> __('None', 'themedo-core'),
					  							'left' 				=> __('Left', 'themedo-core'),
												 'right' 			=> __('Right', 'themedo-core'),
												 'center' 			=> __('Center', 'themedo-core')) 
					  ),
					  
				array("name" 			=> __('Image lightbox', 'themedo-core'),
					  "desc" 			=> __('Show image in Lightbox.', 'themedo-core'),
					  "id" 				=> "avalon_td_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Lightbox Image', 'themedo-core'),
					  "desc" 			=> __('Upload an image that will show up in the lightbox.', 'themedo-core'),
					  "id" 				=> "avalon_td_lightboximage",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "upid" 			=> "2",
					  "value" 			=> ""
					  ),						  
					  
				array("name" 			=> __('Image', 'themedo-core'),
					  "desc" 			=> __('Upload an image to display in the frame.', 'themedo-core'),
					  "id" 				=> "avalon_td_image",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "upid" 			=> "1",
					  "value" 			=> ""
					  ),				  
					  
				array("name" 			=> __('Image Alt Text', 'themedo-core'),
					  "desc"			=> __('The alt attribute provides alternative information if an image cannot be viewed.', 'themedo-core'),
					  "id" 				=> "avalon_td_alt",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Picture Link URL', 'themedo-core'),
					  "desc"			=> __('Add the URL the picture will link to, ex: http://example.com.', 'themedo-core'),
					  "id" 				=> "avalon_td_link",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

				array("name"	  		=> __('Link Target', 'themedo-core'),
					  "desc"	  		=> __('_self = open in same window<br>_blank = open in new window.', 'themedo-core'),
					  "id"				=> "avalon_td_target",
					  "type"	  		=> ElementTypeEnum::SELECT,
					  "value"	   		=> "_self",
					  "allowedValues"   => array('_self'	=>'_self',
											   '_blank'	 =>'_blank') 
		   			  ),					  
				
				array("name" 			=> __('Animation Type', 'themedo-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode.', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0",
					  "allowedValues" 	=> $animation_type
					 ),
				
				array("name" 			=> __('Direction of Animation', 'themedo-core'),
					  "desc" 			=> __('Select the incoming direction for the animation.', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'themedo-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1).', 'themedo-core'),
					  "id" 				=> "avalon_td_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0.1" ,
					  "allowedValues"	=> $animation_speed
					  ),
				array(
					"name"          => __( 'Hide on Mobile', 'themedo-core' ),
					"desc"          => __( 'Select yes to hide full width container on mobile.', 'themedo-core' ),
					"id"            => "hide_on_mobile",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'no'  => __( 'No', 'themedo-core' ),
						'yes' => __( 'Yes', 'themedo-core' ),
					)
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