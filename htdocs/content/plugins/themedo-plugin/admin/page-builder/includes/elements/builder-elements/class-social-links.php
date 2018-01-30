<?php
/**
 * SocialLinks element implementation, it extends DDElementTemplate like all other elements
 */
	class avalon_td_SocialLinks extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'social_links';
			// element name
			$this->config['name']	 		= __('Social Links', 'themedo-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "avalon_td_element_box";
			// element icon class
			$this->config['icon_class']		= 'themedo-icon builder-options-icon themedoa-link';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Social Links Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="avalon_td_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="avalon_td_iconbox_icon"><i class="themedoa-link"></i><sub class="sub">'.__('Social Links', 'themedo-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= themedoHelper::get_shortcode_choices_with_default();
			
			$this->config['subElements'] = array(
					 

				array("name" 			=> __('Boxed Social Icons', 'themedo-core'),
					  "desc" 			=> __('Choose to get a boxed icons. Choose default for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_iconboxed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Social Icon Box Radius', 'themedo-core'),
					  "desc" 			=> __('Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_iconboxedradius",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> "4px"
					  ),
					  
				array("name" 			=> __('Social Icon Custom Colors', 'themedo-core'),
					  "desc" 			=> __('Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_iconcolor",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Social Icon Custom Box Colors', 'themedo-core'),
					  "desc" 			=> __('Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_boxcolor",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Social Icon Tooltip Position', 'themedo-core'),
					  "desc" 			=> __('Choose the display position for tooltips. Choose default for theme option selection.', 'themedo-core'),
					  "id" 				=> "avalon_td_icontooltip",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 			=> 'Default',
												 'top' 			=> __('Top', 'themedo-core'),
												 'bottom' 		=> __('Bottom', 'themedo-core'),
												 'left' 		=> __('Left', 'themedo-core'),
												 'Right' 		=> __('Right', 'themedo-core')) 
					 ),
					 
					  
				array("name" 			=> __('Facebook Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Facebook link', 'themedo-core'),
					  "id" 				=> "avalon_td_facebook",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Twitter Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Twitter link', 'themedo-core'),
					  "id" 				=> "avalon_td_twitter",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),

		array("name"	  => __('Instagram Link', 'themedo-core'),
					  "desc"	  => __('Insert your custom Instagram link', 'themedo-core'),
					  "id"		=> "avalon_td_instagram",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

				array("name" 			=> __('Dribbble Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Dribbble link', 'themedo-core'),
					  "id" 				=> "avalon_td_dribbble",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Google+ Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Google+ link', 'themedo-core'),
					  "id" 				=> "avalon_td_google",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('LinkedIn Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom LinkedIn link', 'themedo-core'),
					  "id" 				=> "avalon_td_linkedin",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Blogger Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Blogger link', 'themedo-core'),
					  "id" 				=> "avalon_td_blogger",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Tumblr Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Tumblr link', 'themedo-core'),
					  "id" 				=> "avalon_td_tumblr",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Reddit Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Reddit link', 'themedo-core'),
					  "id" 				=> "avalon_td_reddit",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Yahoo Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Yahoo link', 'themedo-core'),
					  "id" 				=> "avalon_td_yahoo",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Deviantart Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Deviantart link', 'themedo-core'),
					  "id" 				=> "avalon_td_deviantart",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Vimeo Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Vimeo link', 'themedo-core'),
					  "id" 				=> "avalon_td_vimeo",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Youtube Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Youtube link', 'themedo-core'),
					  "id" 				=> "avalon_td_youtube",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Pinterest Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Pinterest link', 'themedo-core'),
					  "id" 				=> "avalon_td_pinterest",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('RSS Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom RSS link', 'themedo-core'),
					  "id" 				=> "avalon_td_rss",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Digg Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Digg link', 'themedo-core'),
					  "id" 				=> "avalon_td_digg",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Flickr Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Flickr link', 'themedo-core'),
					  "id" 				=> "avalon_td_flickr",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Forrst Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Forrst link', 'themedo-core'),
					  "id" 				=> "avalon_td_forrst",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Myspace Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Myspace link', 'themedo-core'),
					  "id" 				=> "avalon_td_myspace",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Skype Link', 'themedo-core'),
					  "desc" 			=> __('Insert your custom Skype link', 'themedo-core'),
					  "id" 				=> "avalon_td_skype",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),

		array("name"	  => __('PayPal Link', 'themedo-core'),
					  "desc"	  => __('Insert your custom PayPal link', 'themedo-core'),
					  "id"		=> "avalon_td_paypal",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		array("name"	  => __('Dropbox Link', 'themedo-core'),
					  "desc"	  => __('Insert your custom Dropbox link', 'themedo-core'),
					  "id"		=> "avalon_td_dropbox",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		array("name"	  => __('SoundCloud Link', 'themedo-core'),
					  "desc"	  => __('Insert your custom Soundcloud link', 'themedo-core'),
					  "id"		=> "avalon_td_soundcloud",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		array("name"	  => __('VK Link', 'themedo-core'),
					  "desc"	  => __('Insert your custom VK link', 'themedo-core'),
					  "id"		=> "avalon_td_vk",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		  array("name"	  => __('Email Address', 'themedo-core'),
					  "desc"	  => __('Insert an email address to display the email icon', 'themedo-core'),
					  "id"		=> "avalon_td_email",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),
					  
				array("name" 			=> __('Show Custom Social Icon', 'themedo-core'),
					  "desc" 			=> __('Show the custom social icon specified in Theme Options', 'themedo-core'),
					  "id" 				=> "avalon_td_show_custom",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices 
					  ),

		  array("name"	  => __('Alignment', 'themedo-core'),
					  "desc"	  => __('Select the icon\'s alignment.', 'themedo-core'),
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