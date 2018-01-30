<?php
/**
 * Separator element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Separator extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'separator_element';
			// element name
			$this->config['name']	 		= __('Separator', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-minus';
			// tooltip that will be displyed upon mous over the element
			//$this->config['tool_tip']  		= 'Creates a Separator Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_seprator">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><span class="upper_container" style="selector:spattrib"><i class="themedoa-minus"></i><sub class="sub">'.__('Separator', 'themedo-core').'</sub></span><section class="separator double_dotted" style="selector:sattrib"><i class="fake_class" style="selector:iattrib"></i></section></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$margin_data = themedoHelper::avalon_td_create_dropdown_data(1,100);
			$choices = themedoHelper::get_shortcode_choices_with_default();
			$this->config['subElements'] = array(
			
			   array("name" 			=> __('Style', 'themedo-core'),
					  "desc" 			=> __('Choose the separator line style', 'themedo-core'),
					  "id" 				=> "avalon_td_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array(		'none' => __('No Style', 'themedo-core'),
		'single' => __('Single Border Solid', 'themedo-core'),
		'double' => __('Double Border Solid', 'themedo-core'),
		'single|dashed' => __('Single Border Dashed', 'themedo-core'),
		'double|dashed' => __('Double Border Dashed', 'themedo-core'),
		'single|dotted' => __('Single Border Dotted', 'themedo-core'),
		'double|dotted' => __('Double Border Dotted', 'themedo-core'),
		'shadow' => __('Shadow', 'themedo-core')) 
					 ),
				
				array("name" 			=> __('Margin Top', 'themedo-core'),
					  "desc"			=> __('Spacing above the separator. In pixels.  Use a number without px.', 'themedo-core'),
					  "id" 				=> "avalon_td_top",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Margin Bottom', 'themedo-core'),
					  "desc"			=> __('Spacing below the separator. In pixels.  Use a number without px.', 'themedo-core'),
					  "id" 				=> "avalon_td_bottom",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Separator Color', 'themedo-core'),
					  "desc" 			=> __('Controls the separator color. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_sepcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),

				array("name" 			=> __('Border Size', 'themedo-core'),
					  "desc"			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_border_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Select Icon', 'themedo-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'themedo-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> themedoHelper::GET_ICONS_LIST()
					  ),
					  
				array("name" 			=> __('Circled Icon', 'themedo-core'),
					  "desc" 			=> __('Choose to have a circle in separator color around the icon.', 'themedo-core'),
					  "id" 				=> "avalon_td_circle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $choices
					  ),	
					  
				array("name" 			=> __('Circle Color', 'themedo-core'),
					  "desc" 			=> __('Controls the background color of the circle around the icon.', 'themedo-core'),
					  "id" 				=> "avalon_td_circlecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),					  
					  
				array("name" 			=> __('Separator Width', 'themedo-core'),
					  "desc"			=> __('In pixels (px or %), ex: 1px, ex: 50%. Leave blank for full width.', 'themedo-core'),
					  "id" 				=> "avalon_td_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Alignment', 'themedo-core'),
					  "desc" 			=> __('Select the separator alignment; only works when a width is specified.', 'themedo-core'),
					  "id" 				=> "avalon_td_alignment",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('center' 	=> __('Center', 'themedo-core'),
					  							 'left' 	=> __('Left', 'themedo-core'),
												 'right' 	=> __('Right', 'themedo-core'))
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