<?php
/**
 * Vimeo element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_Vimeo extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'video_vimeo';
			// element shortcode base
			$this->config['base'] = 'vimeo';
			// element name
			$this->config['name']	 		= __('Vimeo', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-vimeo2';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Video Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_vimeo">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-vimeo2"></i><sub class="sub">'.__('Vimeo', 'themedo-core').'</sub><p class="viemo_url">http://vimeo.com/75230326</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= themedoHelper::get_reversed_choice_data();
			
			$this->config['subElements'] = array(
			
			   array("name" 			=> __('Video ID', 'themedo-core'),
					  "desc"			=> __('For example the Video ID for<br>https://vimeo.com/75230326 is 75230326', 'themedo-core'),
					  "id" 				=> "avalon_td_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Width', 'themedo-core'),
					  "desc"			=> __('In pixels but only enter a number, ex: 600', 'themedo-core'),
					  "id" 				=> "avalon_td_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "600" 
					  ),
					  
				array("name" 			=> __('Height', 'themedo-core'),
					  "desc"			=> __('In pixels but only enter a number, ex: 350', 'themedo-core'),
					  "id" 				=> "avalon_td_height",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "350" 
					  ),
					  
				array("name" 			=> __('Autoplay Video', 'themedo-core'),
					  "desc" 			=> __('Set to yes to make video autoplaying', 'themedo-core'),
					  "id" 				=> "avalon_td_autoplay",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('AdditionalAPI Parameter', 'themedo-core'),
					  "desc"			=> __('Use additional API parameter, for example &title=0 to disable title on video. VimeoPlus account may be required.', 'themedo-core'),
					  "id" 				=> "avalon_td_apiparams",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('CSS Class', 'themedo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "avalon_td_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				);
		}
	}