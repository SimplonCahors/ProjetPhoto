<?php
/**
 * Slider element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Slider extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'slider_element';
			// element name
			$this->config['name']	 		= __('Slider', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-uniF61C';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Slider Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_slider">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-uniF61C"></i><sub class="sub">'.__('Slider', 'themedo-core').'</sub><div class="check_section"><ul class="slider_elements"><li></li><li></li><li></li><li></li><li></li></ul></div></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$choices					= themedoHelper::get_shortcode_choices();
			
	  $am_array = array();
	  $am_array[] = array ( 
							array("name"	=> __('Slide Type', 'themedo-core'),
									  "desc"		=> __('Choose a video or image slide', 'themedo-core'),
									  "id"		=> "avalon_td_slider_type[0]",
							"type"		=> ElementTypeEnum::SELECT,
							"value"	   => array('image'),
							"allowedValues"   => array('image'  =>__('Image', 'themedo-core'),
									   'video'	  =>__('Video', 'themedo-core')) 
						  ),

						  array("name"	=> __('Slide Image', 'themedo-core'),
									  "desc"		=> __('Upload an image to display in the slide', 'themedo-core'),
									  "id"		=> "avalon_td_image_content[0]",
									  "type"		=> ElementTypeEnum::UPLOAD,
							"upid"		=> array(1),
									  "value"	   => array("")
							),
						  array( "name"	 => __('Full Image Link or External Link', 'themedo-core'),
										"desc"		=> __('Add the url of where the image will link to. If lightbox option is enabled, you have to add the full image link to show it in the lightbox', 'themedo-core'),
										"id"		=> "avalon_td_image_url[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array() 
							),
						  array("name"	=> __('Link Target', 'themedo-core'),
									  "desc"		=> __('_self = open in same window<br>_blank = open in new window', 'themedo-core'),
									  "id"		=> "avalon_td_image_target[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array("_self"),
									  "allowedValues"   => array('_self'	=>'_self',
																 '_blank'	 =>'_blank') 
						  ),
		
						  array("name"	=> __('Lighbox', 'themedo-core'),
							"desc"		=> __('Show image in Lightbox', 'themedo-core'),
							"id"		=> "avalon_td_image_lightbox[0]",
							"type"		=> ElementTypeEnum::SELECT,
							"value"	   => array('yes'),
							"allowedValues"   => $choices 
						  ),
						  array( "name"	 => __('Video Shortcode or Video Embed Code', 'themedo-core'),
										"desc"		=> __('Click the Youtube or Vimeo Shortcode button below then enter your unique video ID, or copy and paste your video embed code.<a href="JavaScript:void(0);" sc-data=\'[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]\' class="themedob-add-shortcode">Insert Youtube Shortcode</a><a href="JavaScript:void(0);" sc-data=\'[vimeo id="Enter video ID (eg. 10145153)" width="600" height="350"]\' class="themedob-add-shortcode">Insert Vimeo Shortcode</a>', 'themedo-core'),
										"id"		=> "video_content[0]",
										"type"		=> ElementTypeEnum::TEXTAREA,
										"value"	   => array() 
							)
					  );

			$this->config['defaults'] = $am_array[0];

			if($am_elements) {
			  $am_array_copy = $am_array[0];
			  $am_array = array();
			  foreach($am_elements as $key => $am_element) {
				$build_am = $am_array_copy;
				foreach($build_am as $build_am_key => $build_am_element) {
				  $build_am[$build_am_key]['value'] = $am_elements[$key][$build_am_key];
				  $build_am[$build_am_key]['id'] = str_replace('[0]', '[' . $key . ']', $build_am_element['id']);
				}
				$am_array[] = $build_am;
			  }
			}


			$this->config['subElements'] = array(
			
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
			
				array("name" 			=> __('Image Size Width', 'themedo-core'),
					  "desc"			=> __('Width in percentage (%) or pixels (px)', 'themedo-core'),
					  "id" 				=> "avalon_td_size_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "100%" 
					  ),
					  
				array("name" 			=> __('Image Size Height', 'themedo-core'),
					  "desc"			=> __('Height in percentage (%) or pixels (px)', 'themedo-core'),
					  "id" 				=> "avalon_td_size_height",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "100%" 
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
					  
				array("type" 			=> ElementTypeEnum::ADDMORE,
					  "buttonText"		=> __('Add New Slide', 'themedo-core'),
					  "id"				=> "am_avalon_td_content",
					  "elements" 		=> $am_array
					  ),


				);
		}
	}