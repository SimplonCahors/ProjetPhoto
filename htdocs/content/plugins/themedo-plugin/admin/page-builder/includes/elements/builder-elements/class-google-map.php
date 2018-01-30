<?php
/**
 * GoogleMap implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_GoogleMap extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'google_map';
			// element name
			$this->config['name']	 		= __('Google Map', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-map avalon_td_has_colorpicker';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Google Map Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style" id="avalon_td_google_map">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-map"></i><sub class="sub">'.__('Google Map', 'themedo-core').'</sub><p class="google_map_address">12345 West Elm Street, New York City ,NY 33544</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
	
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$zoom_levels 				= themedoHelper::avalon_td_create_dropdown_data( 1, 25 );
			$choices					= themedoHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Map Type', 'themedo-core'),
					  "desc" 			=> __('Select the type of google map to display', 'themedo-core'),
					  "id" 				=> "avalon_td_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "roadmap",
					  "allowedValues" 	=> array('roadmap' 		=>__('Roadmap', 'themedo-core'),
												 'satellite' 	=>__('Satellite', 'themedo-core'),
												 'hybrid' 		=> __('Hybrid', 'themedo-core'),
												 'terrain' 		=> __('Terrain', 'themedo-core'))
					  ),
											   
				array("name" 			=> __('Map Width', 'themedo-core'),
					  "desc" 			=> __('Map width in percentage or pixels. ex: 100%, or 940px', 'themedo-core'),
					  "id" 				=> "avalon_td_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "100%"
					  ),
				
				array("name" 			=> __('Map Height', 'themedo-core'),
					  "desc" 			=> __('Map height in pixels. ex: 300px', 'themedo-core'),
					  "id" 				=> "avalon_td_height",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "300px"
					  ),
					  
				array("name" 			=> __('Zoom Level', 'themedo-core'),
					  "desc" 			=> __('Higher number will be more zoomed in.', 'themedo-core'),
					  "id" 				=> "avalon_td_zoom",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "14",
					  "allowedValues" 	=> $zoom_levels
					 ),
				
				array("name" 			=> __('Scrollwheel on Map', 'themedo-core'),
					  "desc" 			=> __('Enable zooming using a mouse\'s scroll wheel', 'themedo-core'),
					  "id" 				=> "avalon_td_scrollwheel",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					 ),
				
				array("name" 			=> __('Show Scale Control on Map', 'themedo-core'),
					  "desc"			=> __('Display the map scale', 'themedo-core'),
					  "id" 				=> "avalon_td_scale",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),
					  
				array("name" 			=> __('Show Pan Control on Map', 'themedo-core'),
					  "desc"			=> __('Displays pan control button', 'themedo-core'),
					  "id" 				=> "avalon_td_zoom_pancontrol",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),

				array("name" 			=> __('Address Pin Animation', 'themedo-core'),
					  "desc"			=> __('Choose to animate the address pins when the map first loads.', 'themedo-core'),
					  "id" 				=> "avalon_td_animation",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),

				array("name" 			=> __('Show tooltip by default', 'themedo-core'),
					  "desc"			=> __('Display or hide tooltip by default when the map first loads.', 'themedo-core'),
					  "id" 				=> "avalon_td_popup",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes" ,
					  "allowedValues" 	=> $choices 
					  ),
				
				array("name" 			=> __('Select the Map Styling Switch', 'themedo-core'),
					  "desc" 			=> __('Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.', 'themedo-core'),
					  "id" 				=> "avalon_td_mapstyle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 		=> __('Default Styling', 'themedo-core'),
											   'theme' 			=> __('Theme Styling', 'themedo-core'),
											   'custom' 		=> __('Custom Styling', 'themedo-core'))
					  ),
					  
				array("name" 			=> __('Map Overlay Color', 'themedo-core'),
					  "desc" 			=> __('Custom styling setting only. Pick an overlaying color for the map. Works best with "roadmap" type.', 'themedo-core'),
					  "id" 				=> "avalon_td_overlaycolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Infobox Styling', 'themedo-core'),
					  "desc" 			=> __('Custom styling setting only. Choose between default or custom info box.', 'themedo-core'),
					  "id" 				=> "avalon_td_infobox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 		=> __('Default Infobox', 'themedo-core'),
											   'custom' 		=> __('Custom Infobox', 'themedo-core'))
					  ),
					  
				array("name" 			=> __('Infobox Content', 'themedo-core'),
					  "desc" 			=> __('Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3', 'themedo-core'),
					  "id" 				=> "avalon_td_infoboxcontent",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Info Box Text Color', 'themedo-core'),
					  "desc" 			=> __('Custom styling setting only. Pick a color for the info box text.', 'themedo-core'),
					  "id" 				=> "avalon_td_infoboxtextcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Info Box Background Color', 'themedo-core'),
					  "desc" 			=> __('Custom styling setting only. Pick a color for the info box background.', 'themedo-core'),
					  "id" 				=> "avalon_td_infoboxbackgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Custom Marker Icon', 'themedo-core'),
					  "desc" 			=> __('Custom styling setting only. Use full image urls for custom marker icons or input "theme" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3', 'themedo-core'),
					  "id" 				=> "avalon_td_icon",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
			   array("name" 			=> __('Address', 'themedo-core'),
					  "desc" 			=> __('Add address to the location which will show up on map. For multiple addresses, separate addresses by using the | symbol. 
ex: Address 1|Address 2|Address 3', 'themedo-core'),
					  "id" 				=> "avalon_td_content",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('CSS Class', 'themedo-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'themedo-core'),
					  "id" 				=> "avalon_td_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

		array("name"	  => __('CSS ID', 'themedo-core'),
					  "desc"	  => __('Add an ID to the wrapping HTML element.', 'themedo-core'),
					  "id"		=> "avalon_td_id",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => "" 
			),
				
				);
		}
	}