<?php
/**
 * Text block implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_themedoSlider extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'themedoslider';
			// element shortcode base
			$this->config['base']	   		= 'themedoslider';
			// element name
			$this->config['name']	 		= __('themedo Slider', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-TFicon';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a simple text block';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-TFicon"></i><sub class="sub">'.__('themedo Slider', 'themedo-core').'</sub><p>[themedoslider name="<span class="avalon_td_slider_name">106</span>"]</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$this->config['subElements'] = array(
			

				array("name"	  => __('Slider Name', 'themedo-core'),
					  "desc"	  => __('This is the shortcode name that can be used in the post content area. It is usually all lowercase and contains only letters, numbers, and hyphens. ex: "themedoslider_slidernamehere"', 'themedo-core'),
					  "id"		=> "name",
					  "type"	  => ElementTypeEnum::SELECT,
					  "value"	   => "",
					  "allowedValues"   => themedoHelper::avalon_td_shortcodes_categories( 'slide-page' )
			),
					  
				array("name" 			=> __('CSS Class', 'themedo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('CSS ID', 'themedo-core'),
					  "desc"			=> __('Add an ID to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				);
		}
	}