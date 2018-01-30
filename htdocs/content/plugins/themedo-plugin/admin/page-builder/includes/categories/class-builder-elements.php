<?php
/**
 * BuilderElements implementation
 */
class BuilderElements {
	private $value 		= array();
	private $elements 	= array();
	
	public function __construct() 
	{
		$this->value['id'] 		= "builder_elements_div";
		$this->value['name'] 	= __('Elements', 'themedo-core');
		$this->value['icon'] 	= "icon_pack/tab_icon_4.png";
		$this->value['class']	= "themedo-tab themedoa-TFico";
		
		$this->load_elements();
	}
	
	public function to_array() 
	{
		$this->value['elements'] = $this->elements;
		return $this->value;
	}
	
	/**
	 * Load all the category's elements
	 */
	private function load_elements() 
	{
		$accordion 		= new avalon_td_Accordion();
		array_push($this->elements, $accordion->element_to_array());
		
		$brochure		= new avalon_td_Brochure();
		array_push($this->elements, $brochure->element_to_array());
		
		$contentbox 	= new avalon_td_TDContent();
		array_push($this->elements, $contentbox->element_to_array());
		
		$counter_box	= new avalon_td_CounterBox();
		array_push($this->elements, $counter_box->element_to_array());
		
		$expandable 	= new avalon_td_Expandable();
		array_push($this->elements, $expandable->element_to_array());
		
		$person_box 	= new avalon_td_Person();
		array_push($this->elements, $person_box->element_to_array());
		
		$progress_bar 	= new avalon_td_ProgressBar();
		array_push($this->elements, $progress_bar->element_to_array());
		
		$tabs 			= new avalon_td_Tabs();
		array_push($this->elements, $tabs->element_to_array());
		
		$testimonial 	= new avalon_td_Testimonial();
		array_push($this->elements, $testimonial->element_to_array());
		
		$customtitle 			= new avalon_td_CustomTitle();
		array_push($this->elements, $customtitle->element_to_array());
		
		$gallery_block 	= new avalon_td_GalleryBlock();
		array_push($this->elements, $gallery_block->element_to_array());
		
		$supersized 	= new avalon_td_Supersized();
		array_push($this->elements, $supersized->element_to_array());
		
		$kenburns 	= new avalon_td_Kenburns();
		array_push($this->elements, $kenburns->element_to_array());
		
		$flowgallery 	= new avalon_td_FlowGallery();
		array_push($this->elements, $flowgallery->element_to_array());
		
		$coverbox 		= new avalon_td_Coverbox();
		array_push($this->elements, $coverbox->element_to_array());
		
		$service 		= new avalon_td_Service();
		array_push($this->elements, $service->element_to_array());
		
		$workstep 		= new avalon_td_WorkStep();
		array_push($this->elements, $workstep->element_to_array());
		
		
		//$countdown 		= new avalon_td_Countdown();
		//array_push($this->elements, $countdown->element_to_array());
		
		//$client	= new avalon_td_Client();
		//array_push($this->elements, $client->element_to_array());
		
		//$comparison 	= new avalon_td_Comparison();
		//array_push($this->elements, $comparison->element_to_array());
		
		//$modal 			= new avalon_td_Modal();
		//array_push($this->elements, $modal->element_to_array());
		
		
		//$intro 			= new avalon_td_Intro();
		//array_push($this->elements, $intro->element_to_array());
		
		//$gallery 		= new avalon_td_Gallery();
		//array_push($this->elements, $gallery->element_to_array());
		
		//$hotspot 		= new avalon_td_Hotspot();
		//array_push($this->elements, $hotspot->element_to_array());
		
		//$recent_posts 	= new avalon_td_RecentPosts();
		//array_push($this->elements, $recent_posts->element_to_array());
		
		
		
		//$servicepack 	= new avalon_td_Servicepack();
		//array_push($this->elements, $servicepack->element_to_array());
		
		//$servicetabs 	= new avalon_td_Servicetabs();
		//array_push($this->elements, $servicetabs->element_to_array());
		
		//$toggle 		= new avalon_td_Toggle();
		//array_push($this->elements, $toggle->element_to_array());
		
		//$alert_box 		= new avalon_td_AlertBox();
		//array_push($this->elements, $alert_box->element_to_array());
		
		//$wp_blog		= new avalon_td_WpBlog();
		//array_push($this->elements, $wp_blog->element_to_array());
		
		//$button_block	= new avalon_td_ButtonBlock();
		//array_push($this->elements, $button_block->element_to_array());
		
		//$checklist		= new avalon_td_CheckList();
		//array_push($this->elements, $checklist->element_to_array());
		
		//$code_block		= new avalon_td_CodeBlock();
		//array_push($this->elements, $code_block->element_to_array());
		
		//$content_boxes	= new avalon_td_ContentBoxes();
		//array_push($this->elements, $content_boxes->element_to_array());

		//$counter_circle	= new avalon_td_CounterCircle();
		//array_push($this->elements, $counter_circle->element_to_array());
		
		/*$drop_Cap		= new avalon_td_DropCap();
		array_push($this->elements, $drop_Cap->element_to_array());*/
		
		//$flip_boxes		= new avalon_td_FlipBoxes();
		//array_push($this->elements, $flip_boxes->element_to_array());
		
		//$font_awesmoe 	= new avalon_td_FontAwesome();
		//array_push($this->elements, $font_awesmoe->element_to_array());
		
		//$themedoslider	= new avalon_td_themedoSlider();
		//array_push($this->elements, $themedoslider->element_to_array());
		
		//$google_map 	= new avalon_td_GoogleMap();
		//array_push($this->elements, $google_map->element_to_array());
		
		/*$high_light 	= new avalon_td_HighLight();
		array_push($this->elements, $high_light->element_to_array());*/

		//$image_carousel = new avalon_td_ImageCarousel();
		//array_push($this->elements, $image_carousel->element_to_array());
		
		//$image_frame 	= new avalon_td_ImageFrame();
		//array_push($this->elements, $image_frame->element_to_array());

		//$layer_slider 	= new avalon_td_LayerSlider();
		//array_push($this->elements, $layer_slider->element_to_array());
		
		/*$light_box 		= new avalon_td_LightBox();
		array_push($this->elements, $light_box->element_to_array());*/
		
		//$menu_anchor 	= new avalon_td_MenuAnchor();
		//array_push($this->elements, $menu_anchor->element_to_array());
		
		//$post_slider	= new avalon_td_PostSlider();
		//array_push($this->elements, $post_slider->element_to_array());
		
		/*$person_box 	= new avalon_td_Popover();
		array_push($this->elements, $person_box->element_to_array());*/
		
		//$pricing_table 	= new avalon_td_PricingTable();
		//array_push($this->elements, $pricing_table->element_to_array());
		
		
		//$recent_posts 	= new avalon_td_RecentPosts();
		//array_push($this->elements, $recent_posts->element_to_array());
		
		
		
		//$revolution	 	= new avalon_td_RevolutionSlider();
		//array_push($this->elements, $revolution->element_to_array());
		
		//$section_sep	 = new avalon_td_SectionSeparator();
		//array_push($this->elements, $section_sep->element_to_array());
		
		//$separator 		= new avalon_td_Separator();
		//array_push($this->elements, $separator->element_to_array());
		
		//$sharing_box 	= new avalon_td_SharingBox();
		//array_push($this->elements, $sharing_box->element_to_array());
		
		//$slider 		= new avalon_td_Slider();
		//array_push($this->elements, $slider->element_to_array());

		//$social_links 	= new avalon_td_SocialLinks();
		//array_push($this->elements, $social_links->element_to_array());
		
		//$sound_cloud 	= new avalon_td_SoundCloud();
		//array_push($this->elements, $sound_cloud->element_to_array());

		//$table 			= new avalon_td_Table();
		//array_push($this->elements, $table->element_to_array());

		/*$tagline_box 	= new avalon_td_TaglineBox();
		array_push($this->elements, $tagline_box->element_to_array());*/
		
		/*$text_block 	= new avalon_td_themedoText();
		array_push($this->elements, $text_block->element_to_array());*/
		
		/*$tooltip 		= new avalon_td_Tooltip();
		array_push($this->elements, $tooltip->element_to_array());*/
		
		/*$vimeo 			= new avalon_td_Vimeo();
		array_push($this->elements, $vimeo->element_to_array());*/

		/*$woo_carousel 	= new avalon_td_WooCarousel();
		array_push($this->elements, $woo_carousel->element_to_array());*/
		
		/*$woo_featured 	= new avalon_td_WooFeatured();
		array_push($this->elements, $woo_featured->element_to_array());*/
		
		/*$woo_shortcodes = new avalon_td_WooShortcodes();
		array_push($this->elements, $woo_shortcodes->element_to_array());*/
		
		/*$youtube 		= new avalon_td_Youtube();
		array_push($this->elements, $youtube->element_to_array());*/
		
	}  
} 
