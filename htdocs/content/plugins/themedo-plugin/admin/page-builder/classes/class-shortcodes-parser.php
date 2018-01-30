<?php
/**
 * Shortoce parser for Page Builder
 *
 * @package   themedoCore
 * @author	themedo
 * @link	  http://theme-themedo.com
 * @copyright themedo
 */

if( ! class_exists( 'avalon_td_Core_Shortcodes_Parser' ) ) {

	class avalon_td_Core_Shortcodes_Parser {

		/**
		 * Instance of this class.
		 *
		 * @since	2.0.0
		 *
		 * @var	  object
		 */
		protected static $instance = null;
		/**
		 * content of current post/page.
		 *
		 * @since	2.0.0
		 *
		 * @var	  object
		 */
		protected static $meta_content = null;

		/**
		 * Initialize the hooks and filters for the page builder UI
		 *
		 * @since  2.0.0
		 */
		private function __construct() {

			

		}
		/**
		 * return an instance of this class.
		 *
		 * @since	 	2.0.0
		 *
		 * @return 		object	A single instance of this class.
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}
		/**
		 * Print array nicely
		 *
		 * @since	 	2.0.0
		 *
		 * @return 		null
		 */
		private static function print_array ( $array ) {
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
		/**
		 * Set value for content
		 *
		 * @since	 	2.0.0
		 *
		 * @return 		null
		 */
		public static function set_content ( $content ) {
			self::$meta_content = json_decode ( json_encode ( $content ) , true );
		}
		/**
		 * Parser for builder elments
		 *
		 * @since  	2.0.0
		 *
		 * @prama	String	String having post/page content
		 */
		public static function check_builder_elements ( $content ) {
			
			global $post; //current page/post
			$short_codes_content;
			
			self::$meta_content = get_post_meta( $post->ID, "avalon_td_builder_content" , TRUE); //get builder contents 
			if( !empty( self::$meta_content ) ) { //if page built through themedo builder
				$short_codes_content = avalon_td_Core_Shortcodes_Parser::parse_column_options( );  // let the magic begin
				return do_shortcode ( $short_codes_content );
			} else {
				return $content;
			}
			
		}
		
		/**
		 * Parser for column options
		 *
		 * @since  	2.0.0
		 */
		public static function parse_column_options () {
			
			$short_codes = NULL; // this element will have all shortcodes once processing ends
			
			foreach ( self::$meta_content as $element ) { //traverse elements
				//convert stdObject to Array  :: quick way
				$element 		= json_decode ( json_encode ( $element ) , true );
				
				$css_class 		= $element['css_class'];
				$css_class 		= explode (" ",$css_class);
				$css_class 		= @$css_class[1];
				if ( empty ($css_class) ) {
					$css_class = $element['php_class'];	
				}
				
				switch ($css_class) { //switch on unique element

					
					case 'grid_two' :
						//add layout container
						$short_codes.= '[one_half '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						//check if child elements exist. Then parse elements one by one
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/one_half]';
						
					break;
					
					case 'grid_three' :
					
						$short_codes.= '[one_third '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/one_third]';
						
					break;
					
					case 'grid_four' :
					
						$short_codes.= '[one_fourth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/one_fourth]';
						
					break;
					
					case 'grid_five' :
					
						$short_codes.= '[one_fifth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/one_fifth]';
						
					break;
					
					case 'grid_two_fifth' :
					
						$short_codes.= '[two_fifth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/two_fifth]';
						
					break;
					
					case 'grid_three_fifth' :
					
						$short_codes.= '[three_fifth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/three_fifth]';
						
					break;
					
					case 'grid_four_fifth' :
					
						$short_codes.= '[four_fifth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/four_fifth]';
						
					break;
					
					case 'grid_six' :
					
						$short_codes.= '[one_sixth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/one_sixth]';
						
					break;
					
					case 'grid_five_sixth' :
					
						$short_codes.= '[five_sixth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/five_sixth]';
						
					break;
					
					case 'grid_three_fourth' :
					
						$short_codes.= '[three_fourth '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/three_fourth]';
						
					break;
					
					case 'grid_two_third' :
					
						$short_codes.= '[two_third '.avalon_td_Core_Shortcodes_Parser::prepare_column_attr( $element['subElements'] ).']';
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= '[/two_third]';
						
					break;
					
					case 'avalon_td_full_width' :
						$short_codes.= avalon_td_Core_Shortcodes_Parser::build_full_width_container_Shortcode( $element['subElements'] );
						$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_column_element( $element );
						$short_codes.= ' [/fullwidth]';
					break;
						
					default: //default case. For elements without layout column
						if ( !isset ( $element['parentId'] ) ) { //if element does not have any parent (column element)
							//parse this element separately.
							$short_codes.= avalon_td_Core_Shortcodes_Parser::parse_builder_elements( $element );
						}
				}
			}
			
			//good to go :)
			return $short_codes;
		}
		/**
		 * Parses column options elements for parent and children
		 *
		 * @since	 	2.0.0
		 *
		 * @param		$element		Array 		Array containing element data
		 *				$short_codes	String		String containing short-codes
		 *
		 * @return 		$short_codes	String		Shortcodes of parsed elements
		 **/
		private static function parse_column_element ( $element ) {
			
			$colum_elements = NULL;
			$child_elements = count ( $element['childrenId'] );
			if ( $child_elements > 0 ) {
				$colum_elements = avalon_td_Core_Shortcodes_Parser::parse_child_elements( $element );
			}
			return $colum_elements;
		}
		/**
		 * Parses child elements of single column option
		 *
		 * @since	 	2.0.0
		 *
		 * @param		$element		Array 		Array containing element data
		 *
		 * @return 		$short_code	 String		Shortcodes of parsed elements
		 **/
		private static function parse_child_elements ($element ) {
			
			$builder_element_shortcode = NULL;
			
			foreach ($element['childrenId'] as $child) {
				
				$builder_element = avalon_td_Core_Shortcodes_Parser::search_child_element ( $child['id'] );
				
				if ($builder_element != false) {
					
					$builder_element_shortcode.= avalon_td_Core_Shortcodes_Parser::parse_builder_elements($builder_element);
				}
				
			}
			
			return $builder_element_shortcode;
		}
		/**
		 * Search for child element in all content and return single element
		 *
		 * @since	 	2.0.0
		 *
		 * @param		$elementID		String 			String having child element ID
		 *
		 * @return 		$element/false  Array/Booleane	Array containg element data / false if element not found
		 **/
		private static function search_child_element ( $elementID ) {
			
			$meta_content_temp = json_decode ( json_encode ( self::$meta_content ) , true );
			
			foreach ( $meta_content_temp as $element ) {
				
				if ($element['id'] == $elementID) {
					
					return $element;
				}
			}
			return false;
		}
		/**
		 * parser for builder elements
		 *
		 * @since	 	2.0.0
		 *
		 * @param		$element		Array 		Array containing element data
		 *
		 * @return 		$short_code	 String		Shortcodes of parsed elements
		 */
		private static function parse_builder_elements ( $element ) {
			
			switch ($element['php_class']) { //switch on unique element
				
				case 'avalon_td_AlertBox':
					return avalon_td_Core_Shortcodes_Parser::build_alert_Shortcode( $element['subElements'] );
				break;
				
				case 'avalon_td_WpBlog':
					return avalon_td_Core_Shortcodes_Parser::build_blog_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_ButtonBlock':
					return avalon_td_Core_Shortcodes_Parser::build_button_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_CheckList' :
					return avalon_td_Core_Shortcodes_Parser::build_checklist_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_ClientSlider' : 
					return avalon_td_Core_Shortcodes_Parser::build_client_slider_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_ContentBoxes' : 
					return avalon_td_Core_Shortcodes_Parser::build_content_box_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_CounterCircle' : 
					return avalon_td_Core_Shortcodes_Parser::build_counter_circle_Shortcode( $element['subElements'] ) ;
				break; 
				
				case 'avalon_td_CounterBox' :
					return avalon_td_Core_Shortcodes_Parser::build_counter_box_Shortcode( $element['subElements'] ) ;
				break;
				
				/*case 'avalon_td_DropCap' :
					return avalon_td_Core_Shortcodes_Parser::build_dropcap_Shortcode( $element['subElements'] ) ;
				break;*/
				
				case 'avalon_td_PostSlider' :
					return avalon_td_Core_Shortcodes_Parser::build_post_slider_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_FlipBoxes' :
					return avalon_td_Core_Shortcodes_Parser::build_flip_boxes_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_FontAwesome' :
					return avalon_td_Core_Shortcodes_Parser::build_font_awesome_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_FullWidthContainer' :
					return avalon_td_Core_Shortcodes_Parser::build_full_width_container_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_GoogleMap' :
					return avalon_td_Core_Shortcodes_Parser::build_google_map_Shortcode( $element['subElements'] ) ; 
				break;
				
				/*case 'avalon_td_HighLight' :
					return avalon_td_Core_Shortcodes_Parser::build_highlight_Shortcode( $element['subElements'] ) ; 
				break;*/
				
				case 'avalon_td_ImageFrame' :
					return avalon_td_Core_Shortcodes_Parser::build_image_frame_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_ImageCarousel' :
					return avalon_td_Core_Shortcodes_Parser::build_image_carousel_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_Intro' :
					return avalon_td_Core_Shortcodes_Parser::build_intro_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_LightBox' :
					return avalon_td_Core_Shortcodes_Parser::build_light_box_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_LayerSlider' :
					return avalon_td_Core_Shortcodes_Parser::build_layer_slider_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_MenuAnchor' :
					return avalon_td_Core_Shortcodes_Parser::build_menu_anchor_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_Modal' :
					return avalon_td_Core_Shortcodes_Parser::build_modal_Shortcode( $element['subElements'] ) ; 
				break;
				
				/*case 'avalon_td_Modal_Link' :
					return avalon_td_Core_Shortcodes_Parser::build_modal_link_Shortcode( $element['subElements'] ) ; 
				break;*/
				
				case 'avalon_td_Person' :
					return avalon_td_Core_Shortcodes_Parser::build_person_Shortcode( $element['subElements'] ) ; 
				break;
				
				/*case 'avalon_td_Popover' :
					return avalon_td_Core_Shortcodes_Parser::build_popover_Shortcode( $element['subElements'] ) ; 
				break;*/
				
				case 'avalon_td_PricingTable' :
					return avalon_td_Core_Shortcodes_Parser::build_pricing_table_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_ProgressBar' :
					return avalon_td_Core_Shortcodes_Parser::build_progress_bar_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_RecentPosts' :
					return avalon_td_Core_Shortcodes_Parser::build_recent_posts_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_GalleryBlock' : 
					return avalon_td_Core_Shortcodes_Parser::build_gallery_block_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_RevolutionSlider' :
					return avalon_td_Core_Shortcodes_Parser::build_rev_slider_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_SectionSeparator' :
					return avalon_td_Core_Shortcodes_Parser::build_section_separator_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_Separator' :
					return avalon_td_Core_Shortcodes_Parser::build_separator_Shortcode( $element['subElements'] ) ; 
				break; 
				
				case 'avalon_td_SharingBox' :
					return avalon_td_Core_Shortcodes_Parser::build_sharing_box_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_Slider' :
					return avalon_td_Core_Shortcodes_Parser::build_slider_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_SoundCloud' :
					return avalon_td_Core_Shortcodes_Parser::build_soundcloud_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_SocialLinks' :
					return avalon_td_Core_Shortcodes_Parser::build_social_links_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_Tabs' :
					return avalon_td_Core_Shortcodes_Parser::build_tabs_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_Table' :
					return avalon_td_Core_Shortcodes_Parser::build_table_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_TaglineBox' :
					return avalon_td_Core_Shortcodes_Parser::build_tagline_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_Testimonial' :
					return avalon_td_Core_Shortcodes_Parser::build_testimonial_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_TextBlock' :
					return avalon_td_Core_Shortcodes_Parser::build_text_block_Shortcode( $element['subElements'] ) ; 
				break;
				
				case 'avalon_td_CustomTitle':
					return avalon_td_Core_Shortcodes_Parser::build_title_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_Accordion' :
					return avalon_td_Core_Shortcodes_Parser::build_accordion_Shortcode( $element['subElements'] ) ;
				break;
				
				/*case 'avalon_td_Tooltip':
					return avalon_td_Core_Shortcodes_Parser::build_tooltip_Shortcode( $element['subElements'] ) ;
				break;*/
				
				case 'avalon_td_Vimeo':
					return avalon_td_Core_Shortcodes_Parser::build_vimeo_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_WooFeatured' :
					return avalon_td_Core_Shortcodes_Parser::build_woo_featured_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_WooCarousel' :
					return avalon_td_Core_Shortcodes_Parser::build_woo_carousel_Shortcode( $element['subElements'] ) ;
				break;
				
				case 'avalon_td_WooShortcodes' :
					return avalon_td_Core_Shortcodes_Parser::build_woo_shortcodes( $element['subElements'] ) ;
				break;

				case 'avalon_td_Youtube':
					return avalon_td_Core_Shortcodes_Parser::build_youtube_Shortcode( $element['subElements'] ) ;
				break;
				
			}
			
			
		}
		/* ** ** ** ** Parser code starts here ** ** ** */
		
		/**
		* Returns layout shortcode attributes
		*
		* @since	 	2.0.0
		*
		* @param		Array 		Array containing element data
		*
		* @return 		String		Layout shortcode attributes
		**/
		public static function prepare_column_attr( $args ) {
			
			$shortcode_data = 'last="'.$args[0]['value'].'" ';
			$shortcode_data.= ' class="'.$args[1]['value'].'" ';
			$shortcode_data.= ' id="'.$args[2]['value'].'" ';
			
			return $shortcode_data;
		}
		/**
		 * Returns Alert box shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Alert doable shortcode
		 **/
		private static function build_alert_Shortcode ( $args ) {
	
			$shortcode_data = ' [alert';
			$shortcode_data.= ' type="'.$args[0]['value'].'"';
			$shortcode_data.= ' accent_color="'.$args[2]['value'].'" ';
			$shortcode_data.= ' background_color="'.$args[3]['value'].'" ';
			$shortcode_data.= ' border_size="'.$args[4]['value'].'" ';
			$shortcode_data.= ' icon="'.$args[5]['value'].'" ';
			$shortcode_data.= ' box_shadow="'.$args[1]['value'].'" ';
			$shortcode_data.= ' animation_type="'.$args[7]['value'].'"';
			$shortcode_data.= '	animation_direction="'.$args[8]['value'].'"';
			$shortcode_data.= ' animation_speed="'.$args[9]['value'].'" ';
			$shortcode_data.= ' class="'.$args[10]['value'].'" ';
			$shortcode_data.= ' id="'.$args[11]['value'].'" ]';
			$shortcode_data.=   $args[6]['value'];
			$shortcode_data.= ' [/alert]';
			
			return $shortcode_data;
		}
		/**
		 * Returns WP Blog shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Blog doable shortcode
		 **/
		private static function build_blog_Shortcode ( $args ) {
			 
			$shortcode_data = ' [blog';
			$shortcode_data.= ' number_posts="'.$args[1]['value'].'"';
			$shortcode_data.= ' cat_slug="'. $args[2]['value'] .'" ';
			$shortcode_data.= ' exclude_cats="'.$args[3]['value'].'" ';
			$shortcode_data.= ' title="'.$args[4]['value'].'" ';
			$shortcode_data.= ' title_link="'.$args[5]['value'].'" ';
			$shortcode_data.= ' thumbnail="'.$args[6]['value'].'" ';
			$shortcode_data.= ' excerpt="'.$args[7]['value'].'"';
			$shortcode_data.= ' excerpt_length="'.$args[8]['value'].'" ';
			$shortcode_data.= ' meta_all="'.$args[9]['value'].'"';
			$shortcode_data.= ' meta_author="'.$args[10]['value'].'" ';
			$shortcode_data.= ' meta_categories="'.$args[11]['value'].'"';
			$shortcode_data.= ' meta_comments="'.$args[12]['value'].'" ';
			$shortcode_data.= ' meta_date="'.$args[13]['value'].'"';
			$shortcode_data.= ' meta_link="'.$args[14]['value'].'" ';
			$shortcode_data.= ' meta_tags="'.$args[15]['value'].'" ';
			$shortcode_data.= ' paging="'.$args[16]['value'].'" ';
			$shortcode_data.= ' scrolling="'.$args[17]['value'].'" ';
			$shortcode_data.= ' strip_html="'.$args[19]['value'].'"';
			$shortcode_data.= ' blog_grid_columns="'.$args[18]['value'].'" ';
			$shortcode_data.= ' layout="'.$args[0]['value'].'"';
			$shortcode_data.= ' class="'.$args[20]['value'].'" ';
			$shortcode_data.= ' id="'.$args[21]['value'].'" ]';
			$shortcode_data.= ' [/blog]';
								
			return $shortcode_data;
		}
		/**
		 * Returns Button shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Button doable shortcode
		 **/
		private static function build_button_Shortcode ( $args ) {
			
			$shortcode_data = '[button';
			$shortcode_data.= ' link="'.$args[0]['value'].'"';
			$shortcode_data.= ' color="'.$args[1]['value'].'"';
			$shortcode_data.= ' size="'.$args[2]['value'].'" ';
			$shortcode_data.= ' type="'.$args[3]['value'].'"';
			$shortcode_data.= ' shape="'.$args[4]['value'].'"';
			$shortcode_data.= ' target="'.$args[5]['value'].'"';
			$shortcode_data.= ' title="'.$args[6]['value'].'"';
			$shortcode_data.= ' gradient_colors="'.$args[8]['value'].'|'.$args[9]['value'].'"';
			$shortcode_data.= ' gradient_hover_colors="'.$args[10]['value'].'|'.$args[11]['value'].'"';
			$shortcode_data.= ' accent_color="'.$args[12]['value'].'"';
			$shortcode_data.= ' accent_hover_color="'.$args[13]['value'].'"';
			$shortcode_data.= ' bevel_color="'.$args[14]['value'].'"';
			$shortcode_data.= ' border_width="'.$args[15]['value'].'"';
			$shortcode_data.= ' shadow="'.$args[16]['value'].'"';
			$shortcode_data.= ' icon="'.$args[17]['value'].'"';
			$shortcode_data.= ' icon_position="'.$args[18]['value'].'"';
			$shortcode_data.= ' icon_divider="'.$args[19]['value'].'"';
			$shortcode_data.= ' modal="'.$args[20]['value'].'"';
			$shortcode_data.= ' animation_type="'.$args[21]['value'].'"';
			$shortcode_data.= ' animation_direction="'.$args[22]['value'].'"';
			$shortcode_data.= ' animation_speed="'.$args[23]['value'].'"';
			$shortcode_data.= ' class="'.$args[24]['value'].'"';
			$shortcode_data.= ' id="'.$args[25]['value'].'"]';
			$shortcode_data.= $args[7]['value'];
			$shortcode_data.= '[/button]';
								
			return $shortcode_data;
		}
		/**
		 * Returns Checklist shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Checklist doable shortcode
		 **/
		private static function build_checklist_Shortcode ( $args ) {
			
			$shortcode_data = ' [checklist';
			$shortcode_data.= ' icon="'.$args[0]['value'].'"';
			$shortcode_data.= ' circle="'.$args[1]['value'].'" ';
			$shortcode_data.= ' size="'.$args[2]['value'].'" ';
			$shortcode_data.= ' class="'.$args[3]['value'].'" ';
			$shortcode_data.= ' id="'.$args[4]['value'].'" ]';
								
			$total_elements = count ( $args[5]['elements'][0]['value'] );
			$elements 		= $args[5]['elements'];
			for ($i = 0; $i < $total_elements; $i ++) {
					
				$shortcode_data.= ' [li_item';
				$shortcode_data.= ' icon="'.$elements[0]['value'][$i].'" ';
				$shortcode_data.= ' iconcolor="'.$elements[1]['value'][$i].'" ';
				$shortcode_data.= ' circle="'.$elements[2]['value'][$i].'"';
				$shortcode_data.= ' circlecolor="'.$elements[3]['value'][$i].'" ] ';
				$shortcode_data.=   $elements[4]['value'][$i] ;
				$shortcode_data.= ' [/li_item] ';
				
			}					
			$shortcode_data.= ' [/checklist]';
			
			return $shortcode_data;
								
		}
		/**
		 * Returns Clien Slider shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Client slider doable shortcode
		 */
		private static function build_client_slider_Shortcode ( $args ) {
			
			$shortcode_data = ' [clients ';
			$shortcode_data.= ' picture_size="'.$args[0]['value'].'" ';
			$shortcode_data.= ' class="'.$args[1]['value'].'" ';
			$shortcode_data.= ' id="'.$args[2]['value'].'"] ';
			
			$total_elements = count ( $args[3]['elements'][0]['value'] );
			$elements 		= $args[2]['elements'];
			for ($i = 0; $i < $total_elements; $i ++) {
					
				$shortcode_data.= ' [client';
				$shortcode_data.= ' link="'.$elements[0]['value'][$i].'" ';
				$shortcode_data.= ' linktarget="'.$elements[1]['value'][$i].'" ';
				$shortcode_data.= ' image="'.$elements[2]['value'][$i].'"  ';
				$shortcode_data.= ' alt="'.$elements[3]['value'][$i].'"] ';
				
			}
			
			$shortcode_data .= '[/clients]';
			return $shortcode_data;
		}
		/**
		 * Returns content box shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		content box doable shortcode
		 **/
		private static function build_content_box_Shortcode ( $args ) {
			
			$shortcode_data = ' [content_boxes';
			$shortcode_data.= ' layout="'.$args[0]['value'].'"';
			$shortcode_data.= ' columns="'.$args[1]['value'].'" ';
			$shortcode_data.= ' iconcolor="'.$args[3]['value'].'" ';
			$shortcode_data.= ' circlecolor="'.$args[4]['value'].'" ';
			$shortcode_data.= ' circlebordercolor="'.$args[5]['value'].'" ';
			$shortcode_data.= ' backgroundcolor="'.$args[2]['value'].'"';
			$shortcode_data.= ' class="'.$args[6]['value'].'" ';
			$shortcode_data.= ' id="'.$args[7]['value'].'"] ';
								
			$total_elements = count ( $args[8]['elements'][0]['value'] );
			$elements		= $args[8]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				$shortcode_data.= ' [content_box';
				$shortcode_data.= ' title="'.$elements[0]['value'][$i].'" ';
				$shortcode_data.= ' backgroundcolor="'.$elements[1]['value'][$i].'" ';
				$shortcode_data.= ' icon="'.$elements[2]['value'][$i].'" ';
				$shortcode_data.= ' iconcolor="'.$elements[3]['value'][$i].'" ';
				$shortcode_data.= ' circlecolor="'.$elements[4]['value'][$i].'" ';
				$shortcode_data.= ' circlebordercolor="'.$elements[5]['value'][$i].'" ';
				$shortcode_data.= ' iconflip="'.$elements[6]['value'][$i].'" ';
				$shortcode_data.= ' iconrotate="'.$elements[7]['value'][$i].'" ';
				$shortcode_data.= ' iconspin="'.$elements[8]['value'][$i].'" ' ;
				$shortcode_data.= ' image="'.$elements[9]['value'][$i].'" ';
				$shortcode_data.= ' image_width="'.$elements[10]['value'][$i].'" ';
				$shortcode_data.= ' image_height="'.$elements[11]['value'][$i].'" ';
				$shortcode_data.= ' link="'.$elements[12]['value'][$i].'"  ';
				$shortcode_data.= ' linktarget="'.$elements[14]['value'][$i].'" ';
				$shortcode_data.= ' linktext="'.$elements[13]['value'][$i].'" ';
				$shortcode_data.= ' animation_type="'.$elements[16]['value'][$i].'" ';
				$shortcode_data.= ' animation_direction="'.$elements[17]['value'][$i].'" ';
				$shortcode_data.= ' animation_speed="'.$elements[18]['value'][$i].'"] ';
				$shortcode_data.= ' '.$elements[15]['value'][$i].'';
				$shortcode_data.= ' [/content_box]';
			}
			
			$shortcode_data.= ' [/content_boxes]';
			return $shortcode_data;
		}
		/**
		 * Returns counter circle shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Counter circle doable shortcode
		 **/
		private static function build_counter_circle_Shortcode ( $args ) {
			
			$shortcode_data = ' [counters_circle ';
			$shortcode_data.= ' class="'.$args[0]['value'].'" ';
			$shortcode_data.= ' id="'.$args[1]['value'].'"] ';
			
			$total_elements = count ( $args[2]['elements'][0]['value'] );
			$element 		= $args[2]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				$shortcode_data.= ' [counter_circle ';
				$shortcode_data.= ' filledcolor="'.$element[1]['value'][$i].'" ';
				$shortcode_data.= ' unfilledcolor="'.$element[2]['value'][$i].'" ';
				$shortcode_data.= ' size="'.$element[3]['value'][$i].'" ';
				$shortcode_data.= ' scales="'.$element[4]['value'][$i].'" ';
				$shortcode_data.= ' countdown="'.$element[5]['value'][$i].'" ';
				$shortcode_data.= ' speed="'.$element[6]['value'][$i].'" ';
				$shortcode_data.= ' value="'.$element[0]['value'][$i].'"]'.$element[7]['value'][$i].'';
				$shortcode_data.= ' [/counter_circle]';
			}
			
			$shortcode_data.= '[/counters_circle]';
			return $shortcode_data;
		}
		/**
		 * Returns counter box  shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Counter box doable shortcode
		 **/
		private static function build_counter_box_Shortcode ( $args ) {
			
			$shortcode_data = ' [counters_box ';
			$shortcode_data.= ' columns="'.$args[0]['value'].'" ';
			$shortcode_data.= ' class="'.$args[1]['value'].'" ';
			$shortcode_data.= ' id="'.$args[2]['value'].'"] ';
			
			$total_elements = count ( $args[3]['elements'][0]['value'] );
			$element 		= $args[3]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++ ){
				
				$shortcode_data.= ' [counter_box ';
				$shortcode_data.= ' value="'.$element[0]['value'][$i].'" ';
				$shortcode_data.= ' unit="'.$element[1]['value'][$i].'" ';
				$shortcode_data.= ' unit_pos="'.$element[2]['value'][$i].'" ';
				$shortcode_data.= ' icon="'.$element[3]['value'][$i].'" ';
				$shortcode_data.= ' border="'.$element[4]['value'][$i].'" ';
				$shortcode_data.= ' color="'.$element[5]['value'][$i].'" ' ;
				$shortcode_data.= ' direction="'.$element[6]['value'][$i].'"] ';
				$shortcode_data.=   $element[7]['value'][$i];
				$shortcode_data.= ' [/counter_box]';
			}
			
			$shortcode_data.= ' [/counters_box]';
			return $shortcode_data;
		}
		/**
		 * Returns dropcap shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Dropcap doable shortcode
		 **/
		/*private static function build_dropcap_Shortcode ( $args ) {

			$shortcode_data = ' [dropcap ';
			$shortcode_data.= ' color="'.$args[1]['value'].'" ';
			$shortcode_data.= ' boxed="'.$args[2]['value'].'" ';
			$shortcode_data.= ' boxed_radius="'.$args[3]['value'].'" ';
			$shortcode_data.= ' class="'.$args[4]['value'].'" ';
			$shortcode_data.= ' id="'.$args[5]['value'].'"] ';	
			$shortcode_data.=   $args[0]['value'];
			$shortcode_data.= '[/dropcap]';
			
			return $shortcode_data;
		}*/
		
		/**
		 * Returns flex slider shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Flex slider doable shortcode
		 **/
		private static function build_post_slider_Shortcode ( $args ) {
			
			$shortcode_data = ' [postslider ';
			$shortcode_data.= ' layout="'.$args[0]['value'].'" ';
			$shortcode_data.= ' excerpt="'.$args[1]['value'].'" ';
			$shortcode_data.= ' category="'.$args[2]['value'].'" ';
			$shortcode_data.= ' limit="'.$args[3]['value'].'" ';
			$shortcode_data.= ' lightbox="'.$args[4]['value'].'" ';
			$shortcode_data.= ' class="'.$args[6]['value'].'" ';
			$shortcode_data.= ' id="'.$args[7]['value'].'"] ';
			
			$shortcode_data.= ' [/postslider]';
			
			return $shortcode_data;
		}
		/**
		 * Returns flip boxes shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Flip Boxes doable shortcode
		 **/
		private static function build_flip_boxes_Shortcode ( $args ) {
			
			$shortcode_data = ' [flip_boxes ';
			$shortcode_data.= ' columns="'.$args[0]['value'].'" ';
			$shortcode_data.= ' class="'.$args[1]['value'].'" ';
			$shortcode_data.= ' id="'.$args[2]['value'].'"] ';
			
			$total_elements = count ( $args[3]['elements'][0]['value'] );
			$element 		= $args[3]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				
				$shortcode_data.= ' [flip_box  ';
				$shortcode_data.= ' title_front="'.$element[0]['value'][$i].'" ';
				$shortcode_data.= ' title_back="'.$element[1]['value'][$i].'" ';
				$shortcode_data.= ' text_front="'.$element[2]['value'][$i].'" ';
				$shortcode_data.= ' background_color_front="'.$element[4]['value'][$i].'" ';
				$shortcode_data.= ' title_front_color="'.$element[5]['value'][$i].'" ';
				$shortcode_data.= ' text_front_color="'.$element[6]['value'][$i].'" ';
				$shortcode_data.= ' background_color_back="'.$element[7]['value'][$i].'" ';
				$shortcode_data.= ' title_back_color="'.$element[8]['value'][$i].'" ';
				$shortcode_data.= ' text_back_color="'.$element[9]['value'][$i].'" ';
				$shortcode_data.= ' border_color="'.$element[10]['value'][$i].'" ';
				$shortcode_data.= ' border_radius="'.$element[11]['value'][$i].'" ';
				$shortcode_data.= ' border_size="'.$element[12]['value'][$i].'" ';
				$shortcode_data.= ' icon="'.$element[13]['value'][$i].'" ';
				$shortcode_data.= ' iconcolor="'.$element[14]['value'][$i].'" ';
				$shortcode_data.= ' circle="'.$element[15]['value'][$i].'" ';
				$shortcode_data.= ' circlecolor="'.$element[16]['value'][$i].'" ';
				$shortcode_data.= ' circlebordercolor="'.$element[17]['value'][$i].'" ';
				$shortcode_data.= ' iconflip="'.$element[18]['value'][$i].'" ';
				$shortcode_data.= ' iconrotate="'.$element[19]['value'][$i].'" ';
				$shortcode_data.= ' iconspin="'.$element[20]['value'][$i].'" ';
				$shortcode_data.= ' image="'.$element[21]['value'][$i].'" ';
				$shortcode_data.= ' image_width="'.$element[22]['value'][$i].'" ';
				$shortcode_data.= ' image_height="'.$element[23]['value'][$i].'" ';
				$shortcode_data.= ' animation_type="'.$element[24]['value'][$i].'" ';
				$shortcode_data.= ' animation_direction="'.$element[25]['value'][$i].'" ';
				$shortcode_data.= ' animation_speed="'.$element[26]['value'][$i].'"] ';
				$shortcode_data.=   $element[3]['value'][$i];
				$shortcode_data.= ' [/flip_box] ';
			}
			$shortcode_data.= '[/flip_boxes] ';
			
			return $shortcode_data;
		}
		/**
		 * Returns font awesome shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Font awesome doable shortcode
		 **/
		private static function build_font_awesome_Shortcode ( $args ) {
			
			$shortcode_data = ' [fontawesome ';
			$shortcode_data.= ' icon="'.$args[0]['value'].'" ';
			$shortcode_data.= ' circle="'.$args[1]['value'].'" ';
			$shortcode_data.= ' size="'.$args[2]['value'].'" ';
			$shortcode_data.= ' iconcolor="'.$args[3]['value'].'" ';
			$shortcode_data.= ' circlecolor="'.$args[4]['value'].'" ';
			$shortcode_data.= ' circlebordercolor="'.$args[5]['value'].'" ';
			$shortcode_data.= ' flip="'.$args[6]['value'].'" ';
			$shortcode_data.= ' rotate="'.$args[7]['value'].'" ';
			$shortcode_data.= ' spin="'.$args[8]['value'].'" ';
			$shortcode_data.= ' animation_type="'.$args[9]['value'].'" ';
			$shortcode_data.= ' animation_direction="'.$args[10]['value'].'" ';
			$shortcode_data.= ' animation_speed="'.$args[11]['value'].'"';
			$shortcode_data.= ' class="'.$args[12]['value'].'" ';
			$shortcode_data.= ' id="'.$args[13]['value'].'"] ';
			
			return $shortcode_data;
		}
		/**
		 * Returns Full width container shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Full width container doable shortcode
		 **/
		private static function build_full_width_container_Shortcode ( $args ) {
		 
			$shortcode_data = ' [fullwidth ';
			$shortcode_data.= ' menu_anchor="'.$args[10]['value'].'" ';
			$shortcode_data.= ' backgroundcolor="'.$args[0]['value'].'" ';
			$shortcode_data.= ' backgroundimage="'.$args[1]['value'].'" ';
			$shortcode_data.= ' backgroundrepeat="'.$args[2]['value'].'" ';
			$shortcode_data.= ' backgroundposition="'.$args[3]['value'].'" ';
			$shortcode_data.= ' backgroundattachment="'.$args[4]['value'].'" ';
			$shortcode_data.= ' bordersize="'.$args[5]['value'].'px" ';
			$shortcode_data.= ' bordercolor="'.$args[6]['value'].'" ';
			$shortcode_data.= ' borderstyle="'.$args[7]['value'].'" ';
			$shortcode_data.= ' paddingtop="'.$args[8]['value'].'px" ';
			$shortcode_data.= ' paddingbottom="'.$args[9]['value'].'px" ';
			$shortcode_data.= ' class="'.$args[12]['value'].'" ';
			$shortcode_data.= ' id="'.$args[13]['value'].'"] ';
			$shortcode_data.= 	$args[11]['value'];
			
			return $shortcode_data;
		}
		/**
		 * Returns Google map shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Google map doable shortcode
		 **/
		private static function build_google_map_Shortcode ( $args ) {
		
			$shortcode_data = ' [map ';
			$shortcode_data.= ' address="'.$args[15]['value'].'" ';
			$shortcode_data.= ' type="'.$args[0]['value'].'" ';
			$shortcode_data.= ' map_style="'.$args[8]['value'].'" ';
			$shortcode_data.= ' overlay_color="'.$args[9]['value'].'" ';
			$shortcode_data.= ' infobox="'.$args[10]['value'].'" ';
			$shortcode_data.= ' infobox_background_color="'.$args[13]['value'].'" ';
			$shortcode_data.= ' infobox_text_color="'.$args[12]['value'].'" ';
			$shortcode_data.= ' infobox_content="'.$args[11]['value'].'" ';
			$shortcode_data.= ' icon="'.$args[14]['value'].'" ';
			$shortcode_data.= ' width="'.$args[1]['value'].'" ';
			$shortcode_data.= ' height="'.$args[2]['value'].'" ';
			$shortcode_data.= ' zoom="'.$args[3]['value'].'" ';
			$shortcode_data.= ' scrollwheel="'.$args[4]['value'].'" ';
			$shortcode_data.= ' scale="'.$args[5]['value'].'" ';
			$shortcode_data.= ' zoom_pancontrol="'.$args[6]['value'].'"';
			$shortcode_data.= ' popup="'.$args[7]['value'].'" ';
			$shortcode_data.= ' class="'.$args[16]['value'].'"] ';
			$shortcode_data.= ' [/map]';
			
			return $shortcode_data;
			
			
		}
		/**
		 * Returns Highlight shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Highlight doable shortcode
		 **/
		/*private static function build_highlight_Shortcode ( $args ) {
	
			$shortcode_data = ' [highlight ';
			$shortcode_data.= ' color="'.$args[0]['value'].'"';
			$shortcode_data.= ' rounded="'.$args[1]['value'].'" ';
			$shortcode_data.= ' class="'.$args[3]['value'].'" ';
			$shortcode_data.= ' id="'.$args[4]['value'].'"] ';
			$shortcode_data.= 	$args[2]['value'];
			$shortcode_data.= ' [/highlight]';
			
			return $shortcode_data;
		}*/
		/**
		 * Returns Image frame shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Image frame doable shortcode
		 **/
		private static function build_image_frame_Shortcode ( $args ) {
		
			$shortcode_data = ' [imageframe ';
			$shortcode_data.= ' lightbox="'.$args[5]['value'].'" ';
			$shortcode_data.= ' style="'.$args[0]['value'].'" ';
			$shortcode_data.= ' bordercolor="'.$args[1]['value'].'" ';
			$shortcode_data.= ' bordersize="'.$args[2]['value'].'px" ';
			$shortcode_data.= ' stylecolor="'.$args[3]['value'].'" ';
			$shortcode_data.= ' align="'.$args[4]['value'].'" ';
			$shortcode_data.= ' link="'.$args[8]['value'].'" ';
			$shortcode_data.= ' linktarget="'.$args[9]['value'].'" ';
			$shortcode_data.= ' animation_type="'.$args[10]['value'].'" ';
			$shortcode_data.= ' animation_direction="'.$args[11]['value'].'" ';
			$shortcode_data.= ' animation_speed="'.$args[12]['value'].'" ';
			$shortcode_data.= ' class="'.$args[13]['value'].'" ';
			$shortcode_data.= ' id="'.$args[14]['value'].'"] ';
			$shortcode_data.= ' <img alt="'.$args[7]['value'].'" ';
			$shortcode_data.= ' src="'.$args[6]['value'].'" /> ';
			$shortcode_data.= ' [/imageframe]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Image corousel shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Image carousel doable shortcode
		 **/
		private static function build_image_carousel_Shortcode ( $args ) {
			
			$shortcode_data = ' [images ';
			$shortcode_data.= ' picture_size="'.$args[0]['value'].'"';
			$shortcode_data.= ' lightbox="'.$args[1]['value'].'"';
			$shortcode_data.= ' class="'.$args[2]['value'].'" ';
			$shortcode_data.= ' id="'.$args[3]['value'].'"] ';
			
			$total_elements = count ( $args[4]['elements'][0]['value'] );
			$element 		= $args[4]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				
				$shortcode_data.= ' [image ';
				$shortcode_data.= ' link="'.$element[0]['value'][$i].'" ';
				$shortcode_data.= ' linktarget="'.$element[1]['value'][$i].'" ';
				$shortcode_data.= ' image="'.$element[2]['value'][$i].'" ';
				$shortcode_data.= ' width=" " height=" " ';
				$shortcode_data.= ' alt="'.$element[3]['value'][$i].'"] ';
				
			}
			
			$shortcode_data.= ' [/images]';
			
			return $shortcode_data;
		}
		/**
		 * Returns title shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Title doable shortcode
		 **/
		private static function build_intro_Shortcode ( $args ) {
			
			$shortcode_data = ' [intro ';
			$shortcode_data.= ' main_text="'.$args[0]['value'].'"';
			$shortcode_data.= ' image="'.$args[1]['value'].'"';
			$shortcode_data.= ' button_text="'.$args[2]['value'].'"';
			$shortcode_data.= ' button_href="'.$args[3]['value'].'"';
			$shortcode_data.= ' button_hover="'.$args[4]['value'].'"';
			$shortcode_data.= ' class="'.$args[5]['value'].'"';
			$shortcode_data.= ' id="'.$args[6]['value'].'"][/intro]';
			
			return $shortcode_data;
		}
		
		/**
		 * Returns Lightbox shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Lightbox doable shortcode
		 **/
		private static function build_light_box_Shortcode ( $args ) {
			
			$shortcode_data = ' <a class="'.$args[4]['value'].'" ';
			$shortcode_data.= ' id="'.$args[5]['value'].'" ';
			$shortcode_data.= ' title="'.$args[3]['value'].'" ';
			$shortcode_data.= ' href="'.$args[0]['value'].'" ';
			$shortcode_data.= ' data-rel="prettyPhoto"> ';
			$shortcode_data.= ' <img alt="'.$args[2]['value'].'" ';
			$shortcode_data.= ' src="'.$args[1]['value'].'" /></a>';

			return $shortcode_data;
		}
		/**
		 * Returns Layer slider shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Layer slider doable shortcode
		 **/
		private static function build_layer_slider_Shortcode ( $args ) {
			
			$shortcode_data = ' [layerslider ';
			$shortcode_data.= ' id="'.$args[0]['value'].'"]';
			
			return $shortcode_data;
		}
		private static function build_menu_anchor_Shortcode ( $args ) {
			return '[menu_anchor name="'.$args[0]['value'].'"]';
		}
		/**
		 * Returns Modal shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Modal doable shortcode
		 **/
		private static function build_modal_Shortcode ( $args ) {
			
			$shortcode_data = ' [modal  ';
			$shortcode_data.= ' name="'.$args[0]['value'].'" ';
			$shortcode_data.= ' title="'.$args[1]['value'].'" ';
			$shortcode_data.= ' size="'.$args[2]['value'].'" ';
			$shortcode_data.= ' background="'.$args[3]['value'].'" ';
			$shortcode_data.= ' border_color="'.$args[4]['value'].'" ';
			$shortcode_data.= ' show_footer="'.$args[5]['value'].'" ';
			$shortcode_data.= ' class="'.$args[7]['value'].'" ';
			$shortcode_data.= ' id="'.$args[8]['value'].'"] ';
			$shortcode_data.=   $args[6]['value'];
			$shortcode_data.= ' [/modal] ';
			
			return $shortcode_data;
		}
		/**
		 * Returns Modal link shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Modal Hook doable shortcode
		 **/
		/*private static function build_modal_link_Shortcode ( $args ) {
			
			$shortcode_data = ' [modal_hook ';
			$shortcode_data.= ' name="{{'.$args[0]['value'].'}}" ';
			$shortcode_data.= ' class="'.$args[1]['value'].'" ';
			$shortcode_data.= ' id="'.$args[2]['value'].'"] ';
			
			return $shortcode_data;
		}*/
		/**
		 * Returns Person shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Person doable shortcode
		 **/
		private static function build_person_Shortcode ( $args ) {
		
			$shortcode_data = ' [person ';
			$shortcode_data.= ' name="'.$args[0]['value'].'" ';
			$shortcode_data.= ' title="'.$args[1]['value'].'" ';
			$shortcode_data.= ' picture="'.$args[2]['value'].'" ';
			$shortcode_data.= ' pic_link="'.$args[3]['value'].'" ';
			$shortcode_data.= ' pic_style="'.$args[4]['value'].'" ';
			$shortcode_data.= ' pic_bordersize="'.$args[5]['value'].'" ';
			$shortcode_data.= ' pic_bordercolor="'.$args[6]['value'].'" ';
			$shortcode_data.= ' social_icon_boxed="'.$args[7]['value'].'" ';
			$shortcode_data.= ' social_icon_boxed_radius="'.$args[8]['value'].'" ';
			$shortcode_data.= ' social_icon_colors="'.$args[9]['value'].'" ';
			$shortcode_data.= ' social_icon_box_colors="'.$args[10]['value'].'" ';
			$shortcode_data.= ' social_icon_order="'.$args[11]['value'].'" ';
			$shortcode_data.= ' social_icon_tooltip="'.$args[12]['value'].'" ';
			$shortcode_data.= ' email="'.$args[13]['value'].'" ';
			$shortcode_data.= ' facebook="'.$args[14]['value'].'" ';
			$shortcode_data.= ' twitter="'.$args[15]['value'].'" ';
			$shortcode_data.= ' dribbble="'.$args[16]['value'].'" ';
			$shortcode_data.= ' google="'.$args[17]['value'].'" '; 
			$shortcode_data.= ' linkedin="'.$args[18]['value'].'" ';
			$shortcode_data.= ' blogger="'.$args[19]['value'].'" ';
			$shortcode_data.= ' tumblr="'.$args[20]['value'].'" ';
			$shortcode_data.= ' reddit="'.$args[21]['value'].'" ';
			$shortcode_data.= ' yahoo="'.$args[22]['value'].'" ';
			$shortcode_data.= ' deviantart="'.$args[23]['value'].'" ';
			$shortcode_data.= ' vimeo="'.$args[24]['value'].'" ';
			$shortcode_data.= ' youtube="'.$args[25]['value'].'" ';
			$shortcode_data.= ' rss="'.$args[27]['value'].'" '; 
			$shortcode_data.= ' pinterest="'.$args[26]['value'].'" ';
			$shortcode_data.= ' digg="'.$args[28]['value'].'" ';
			$shortcode_data.= ' flickr="'.$args[29]['value'].'" ';
			$shortcode_data.= ' forrst="'.$args[30]['value'].'" ';
			$shortcode_data.= ' myspace="'.$args[31]['value'].'" ';
			$shortcode_data.= ' skype="'.$args[32]['value'].'" ';
			$shortcode_data.= ' linktarget="'.$args[33]['value'].'" ';
			$shortcode_data.= ' class="'.$args[35]['value'].'" ';
			$shortcode_data.= ' id="'.$args[36]['value'].'"] ';
			$shortcode_data.=   $args[34]['value'];
			$shortcode_data.= ' [/person]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Popover Table shortcode/HTML
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Popover Table doable shortcode/HTML
		 **/
		/*private static function build_popover_Shortcode ( $args ) {
			
			
			$shortcode_data = ' [popover ';
			$shortcode_data.= ' title="'.$args[0]['value'].'" ';
			$shortcode_data.= ' title_bg_color="'.$args[1]['value'].'" ';
			$shortcode_data.= ' content="'.$args[2]['value'].'" ';
			$shortcode_data.= ' content_bg_color="'.$args[3]['value'].'" ';
			$shortcode_data.= ' bordercolor="'.$args[4]['value'].'" ';
			$shortcode_data.= ' textcolor="'.$args[5]['value'].'" ';
			$shortcode_data.= ' trigger="'.$args[6]['value'].'" ';
			$shortcode_data.= ' placement="'.$args[7]['value'].'" ';
			$shortcode_data.= ' class="'.$args[9]['value'].'" ';
			$shortcode_data.= ' id="'.$args[10]['value'].'"] ';
			$shortcode_data.=   $args[8]['value'];
			$shortcode_data.= ' [/popover]';
			
			return $shortcode_data;
		}*/
		/**
		 * Returns Pricing Table shortcode/HTML
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Pricing Table doable shortcode/HTML
		 **/
		private static function build_pricing_table_Shortcode ( $args ) {
			
			return $args[5]['value'];
		}
		/**
		 * Returns Progress bar shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Progress bar doable shortcode
		 **/
		private static function build_progress_bar_Shortcode ( $args ) {
	
			$shortcode_data = ' [progress ';
			$shortcode_data.= ' percentage="'.$args[0]['value'].'" ';
			$shortcode_data.= ' unit="'.$args[1]['value'].'" ';
			$shortcode_data.= ' filledcolor="'.$args[2]['value'].'" ';
			$shortcode_data.= ' unfilledcolor="'.$args[3]['value'].'" ';
			$shortcode_data.= ' striped="'.$args[4]['value'].'" ';
			$shortcode_data.= ' animated_stripes="'.$args[5]['value'].'" ';
			$shortcode_data.= ' textcolor="'.$args[6]['value'].'" ';
			$shortcode_data.= ' class="'.$args[8]['value'].'" ';
			$shortcode_data.= ' id="'.$args[9]['value'].'"] ';
			$shortcode_data.=   $args[7]['value'];
			$shortcode_data.= ' [/progress]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Recent posts shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Recent posts doable shortcode
		 **/
		private static function build_recent_posts_Shortcode ( $args ) {
	
			$shortcode_data = ' [recent_posts ';
			$shortcode_data.= ' layout="'.$args[0]['value'].'" ';
			$shortcode_data.= ' columns="'.$args[1]['value'].'" ';
			$shortcode_data.= ' number_posts="'.$args[2]['value'].'" ';
			$shortcode_data.= ' cat_slug="'.$args[3]['value'].'" ';
			$shortcode_data.= ' exclude_cats="'.$args[4]['value'].'" ';
			$shortcode_data.= ' thumbnail="'.$args[5]['value'].'" ';
			$shortcode_data.= ' title="'.$args[6]['value'].'" ';
			$shortcode_data.= ' meta="'.$args[7]['value'].'" ';
			$shortcode_data.= ' excerpt="'.$args[8]['value'].'" ';
			$shortcode_data.= ' excerpt_length="'.$args[9]['value'].'" ';
			$shortcode_data.= ' strip_html="'.$args[10]['value'].'" ';
			$shortcode_data.= ' animation_type="'.$args[11]['value'].'" ';
			$shortcode_data.= ' animation_direction="'.$args[12]['value'].'" ';
			$shortcode_data.= ' animation_speed="'.$args[13]['value'].'" ';
			$shortcode_data.= ' class="'.$args[14]['value'].'" ';
			$shortcode_data.= ' id="'.$args[15]['value'].'" ';
			$shortcode_data.= ' [/recent_posts]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Gallery Block shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Gallery Block doable shortcode
		 **/
		private static function build_gallery_block_Shortcode ( $args ) {
			$shortcode_data = ' [gallery_block ';
			$shortcode_data.= ' layout="'.$args[0]['value'].'" ';
			$shortcode_data.= ' cat_slug="'.$args[1]['value'].'" ';
			$shortcode_data.= ' exclude_cats="'.$args[2]['value'].'" ';
			$shortcode_data.= ' post_count="'.$args[3]['value'].'" ';
			$shortcode_data.= ' order="'.$args[4]['value'].'" ';
			$shortcode_data.= ' offset="'.$args[5]['value'].'" ';
			$shortcode_data.= ' class="'.$args[6]['value'].'" ';
			$shortcode_data.= ' id="'.$args[7]['value'].'" ]';
			$shortcode_data.= ' [/gallery_block] ';
			
			return $shortcode_data;
		}
		/**
		 * Returns Revolution slider shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Revolution slider doable shortcode
		 **/
		private static function build_rev_slider_Shortcode ( $args ) {
			
			$shortcode_data = ' [rev_slider ';
			$shortcode_data.= ' '.$args[0]['value'].'] ';
			
			return $shortcode_data ;
		}
		/**
		 * Returns Section Separator shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Section Separator doable shortcode
		 **/
		private static function build_section_separator_Shortcode ( $args ) {
			
			$shortcode_data = ' [section_separator ';
			$shortcode_data.= ' divider_candy="'.$args[0]['value'].'" ';
			$shortcode_data.= ' icon="'.$args[1]['value'].'" ';
			$shortcode_data.= ' icon_color="'.$args[2]['value'].'" ';
			$shortcode_data.= ' bordersize="'.$args[3]['value'].'" ';
			$shortcode_data.= ' bordercolor="'.$args[4]['value'].'" ';
			$shortcode_data.= ' backgroundcolor="'.$args[5]['value'].'" ';
			$shortcode_data.= ' class="'.$args[6]['value'].'" ';
			$shortcode_data.= ' id="'.$args[7]['value'].'"] ';
			
			return $shortcode_data ;
		}
		/**
		 * Returns Separator shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Separator doable shortcode
		 **/
		private static function build_separator_Shortcode ( $args ) {

			$shortcode_data = ' [separator ';
			$shortcode_data.= ' style="'.$args[0]['value'].'" ';
			$shortcode_data.= ' top="'.$args[1]['value'].'" ';
			$shortcode_data.= ' bottom="'.$args[2]['value'].'" ';
			$shortcode_data.= ' sep_color="'.$args[3]['value'].'" ';
			$shortcode_data.= ' icon="'.$args[4]['value'].'" ';
			$shortcode_data.= ' width="'.$args[5]['value'].'" ';
			$shortcode_data.= ' class="'.$args[6]['value'].'" ';
			$shortcode_data.= ' id="'.$args[7]['value'].'"] ';
			return $shortcode_data;
		}
		/**
		 * Returns Sharing box shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Sharing box doable shortcode
		 **/
		private static function build_sharing_box_Shortcode ( $args ) {
			$shortcode_data = ' [sharing ';
			$shortcode_data.= ' tagline="'.$args[0]['value'].'" ';
			$shortcode_data.= ' tagline_color="'.$args[1]['value'].'" ';
			$shortcode_data.= ' title="'.$args[2]['value'].'" ';
			$shortcode_data.= ' link="'.$args[3]['value'].'" ';
			$shortcode_data.= ' description="'.$args[4]['value'].'" ';
			$shortcode_data.= ' pinterest_image="'.$args[11]['value'].'" ';
			$shortcode_data.= ' icons_boxed="'.$args[5]['value'].'" ';
			$shortcode_data.= ' icons_boxed_radius="'.$args[6]['value'].'" ';
			$shortcode_data.= ' box_colors="'.$args[8]['value'].'" ';
			$shortcode_data.= ' icon_colors="'.$args[7]['value'].'" ';
			$shortcode_data.= ' social_networks="'.$args[9]['value'].'" ';
			$shortcode_data.= ' tooltip_placement="'.$args[10]['value'].'" ';
			$shortcode_data.= ' backgroundcolor="'.$args[12]['value'].'" ';
			$shortcode_data.= ' class="'.$args[13]['value'].'" ';
			$shortcode_data.= ' id="'.$args[14]['value'].'"] ';
			$shortcode_data.= ' [/sharing]' ;
			
			return $shortcode_data;
			
		}
		/**
		 * Returns Slider shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Slider doable shortcode
		 **/
		private static function build_slider_Shortcode ( $args ) {

			$shortcode_data = ' [slider ';
			$shortcode_data.= ' width="'.$args[0]['value'].'" ';
			$shortcode_data.= ' height="'.$args[1]['value'].'" ';
			$shortcode_data.= ' class="'.$args[2]['value'].'" ';
			$shortcode_data.= ' id="'.$args[3]['value'].'"] ';
			
			$total_elements = count ( $args[4]['elements'][0]['value'] );
			$element 		= $args[4]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				$shortcode_data.= ' [slide ';
				if( $element[0]['value'][$i] == "image" ) {
					$shortcode_data.= ' type="'.$element[0]['value'][$i].'" ';
					$shortcode_data.= ' link="'.$element[2]['value'][$i].'" ';
					$shortcode_data.= ' linktarget="'.$element[3]['value'][$i].'" ';
					$shortcode_data.= ' lightbox="'.$element[4]['value'][$i].'"] ';
					$shortcode_data.=   $element[1]['value'][$i];
					
				} else if ( $element[0]['value'][$i] == "video" )  {
					$shortcode_data.= ' type="video"] ';
					$shortcode_data.= 	$element[5]['value'][$i];
				}
				
				$shortcode_data.= ' [/slide] ';

			}
			
			$shortcode_data.= ' [/slider]';
			return $shortcode_data;
		}
		/**
		 * Returns Soundcloud shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Soundcloud doable shortcode
		 **/
		private static function build_soundcloud_Shortcode ( $args ) {
		
			$shortcode_data = ' [soundcloud ';
			$shortcode_data.= ' url="'.$args[0]['value'].'" ';
			$shortcode_data.= ' comments="'.$args[1]['value'].'" ';
			$shortcode_data.= ' auto_play="'.$args[2]['value'].'" ';
			$shortcode_data.= ' color="'.$args[3]['value'].'" ';
			$shortcode_data.= ' width="'.$args[4]['value'].'" ';
			$shortcode_data.= ' height="'.$args[5]['value'].'"';
			$shortcode_data.= ' class="'.$args[6]['value'].'"';
			$shortcode_data.= ' id="'.$args[7]['value'].'"]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Social links shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Social links doable shortcode
		 **/
		private static function build_social_links_Shortcode ( $args ) {
		
			$shortcode_data = ' [social_links ';
			$shortcode_data.= ' linktarget="'.$args[0]['value'].'" ';
			$shortcode_data.= ' icons_boxed="'.$args[1]['value'].'" ';
			$shortcode_data.= ' icons_boxed_radius="'.$args[2]['value'].'" ';
			$shortcode_data.= ' icon_colors="'.$args[3]['value'].'" ';
			$shortcode_data.= ' box_colors="'.$args[4]['value'].'" ';
			$shortcode_data.= ' icon_order="'.$args[5]['value'].'" ';
			$shortcode_data.= ' tooltip_placement="'.$args[6]['value'].'" ';
			$shortcode_data.= ' rss="'.$args[20]['value'].'" ';
			$shortcode_data.= ' facebook="'.$args[7]['value'].'" ';
			$shortcode_data.= ' twitter="'.$args[8]['value'].'" ';
			$shortcode_data.= ' dribbble="'.$args[9]['value'].'" ';
			$shortcode_data.= ' google="'.$args[10]['value'].'" ';
			$shortcode_data.= ' linkedin="'.$args[11]['value'].'" ';
			$shortcode_data.= ' blogger="'.$args[12]['value'].'" ';
			$shortcode_data.= ' tumblr="'.$args[13]['value'].'" ';
			$shortcode_data.= ' reddit="'.$args[14]['value'].'" ';
			$shortcode_data.= ' yahoo="'.$args[15]['value'].'" ';
			$shortcode_data.= ' deviantart="'.$args[16]['value'].'" ';
			$shortcode_data.= ' vimeo="'.$args[17]['value'].'" ';
			$shortcode_data.= ' youtube="'.$args[18]['value'].'" ';
			$shortcode_data.= ' pinterest="'.$args[19]['value'].'" ';
			$shortcode_data.= ' digg="'.$args[21]['value'].'" ';
			$shortcode_data.= ' flickr="'.$args[22]['value'].'" ';
			$shortcode_data.= ' forrst="'.$args[23]['value'].'" ';
			$shortcode_data.= ' myspace="'.$args[24]['value'].'" ';
			$shortcode_data.= ' skype="'.$args[25]['value'].'" ';
			$shortcode_data.= ' show_custom="'.$args[26]['value'].'" ';
			$shortcode_data.= ' class="'.$args[27]['value'].'" ';
			$shortcode_data.= ' id="'.$args[28]['value'].'"] ';
			
			return $shortcode_data;
		}
		/**
		 * Returns Tabs shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Tabs doable shortcode
		 **/
		private static function build_tabs_Shortcode ( $args ) {

			$shortcode_data = ' [avalon_td_tabs ';
			$shortcode_data.= ' layout="'.$args[0]['value'].'" ';
			$shortcode_data.= ' justified="'.$args[1]['value'].'" ';
			$shortcode_data.= ' backgroundcolor="'.$args[2]['value'].'" ';
			$shortcode_data.= ' inactivecolor="'.$args[3]['value'].'" ';
			$shortcode_data.= ' class="'.$args[4]['value'].'" ';
			$shortcode_data.= ' id="'.$args[5]['value'].'"] ';
			
			$total_elements = count ( $args[6]['elements'][0]['value'] );
			$element 		= $args[6]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				
				$shortcode_data.= ' [avalon_td_tab ';
				$shortcode_data.= ' title="'.$element[0]['value'][$i].'"] ';
				$shortcode_data.=   $element[1]['value'][$i];
				$shortcode_data.= ' [/avalon_td_tab]';
				
			}
			
			$shortcode_data.= ' [/avalon_td_tabs] ';
			
			return $shortcode_data;
		}
		/**
		 * Returns Table shortcode/HTML
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Table doable shortcode/HTML
		 **/
		private static function build_table_Shortcode ( $args ) {
			
			return $args[2]['value'];
		}
		/**
		 * Returns Tagline shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Tagline doable shortcode
		 **/
		private static function build_tagline_Shortcode ( $args ) {
			
			$shortcode_data = ' [tagline_box ';
			$shortcode_data.= ' backgroundcolor="'.$args[0]['value'].'" ';
			$shortcode_data.= ' shadow="'.$args[1]['value'].'" ';
			$shortcode_data.= ' shadowopacity="'.str_replace("opt_" , "" ,$args[2]['value'] ).'" ';
			$shortcode_data.= ' border="'.$args[3]['value'].'" ';
			$shortcode_data.= ' bordercolor="'.$args[4]['value'].'" ';
			$shortcode_data.= ' highlightposition="'.$args[5]['value'].'" ';
			$shortcode_data.= ' content_alignment="'.$args[6]['value'].'" ';
			$shortcode_data.= ' link="'.$args[8]['value'].'" ';
			$shortcode_data.= ' linktarget="'.$args[9]['value'].'" ';
			$shortcode_data.= ' button_size="'.$args[10]['value'].'" ';
			$shortcode_data.= ' button_shape="'.$args[12]['value'].'" ';
			$shortcode_data.= ' button_type="'.$args[11]['value'].'" ';
			$shortcode_data.= ' buttoncolor="'.$args[13]['value'].'" ';
			$shortcode_data.= ' button="'.$args[7]['value'].'" ';
			$shortcode_data.= ' title="'.$args[14]['value'].'" ';
			$shortcode_data.= ' description="'.$args[15]['value'].'" ';
			$shortcode_data.= ' animation_type="'.$args[16]['value'].'" ';
			$shortcode_data.= ' animation_direction="'.$args[17]['value'].'" ';
			$shortcode_data.= ' animation_speed="'.$args[18]['value'].'" ';
			$shortcode_data.= ' class="'.$args[19]['value'].'" ';
			$shortcode_data.= ' id="'.$args[20]['value'].'"] ';
			$shortcode_data.= ' [/tagline_box]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Testimonial shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Testimonials doable shortcode
		 **/
		private static function build_testimonial_Shortcode ( $args ) {
		
			$shortcode_data = ' [testimonials ';
			$shortcode_data.= ' design="'.$args[0]['value'].'" ';
			$shortcode_data.= ' backgroundcolor="'.$args[1]['value'].'" ';
			$shortcode_data.= ' textcolor="'.$args[2]['value'].'" ';
			$shortcode_data.= ' class="'.$args[3]['value'].'" ';
			$shortcode_data.= ' id="'.$args[4]['value'].'"] ';
			
			$total_elements = count ( $args[5]['elements'][0]['value'] );
			$element 		= $args[5]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				
				$shortcode_data.= ' [testimonial ';
				$shortcode_data.= ' name="'.$element[0]['value'][$i].'" ';
				$shortcode_data.= ' gender="'.$element[1]['value'][$i].'" ';
				$shortcode_data.= ' image_border_radius="'.$element[2]['value'][$i].'" ';
				$shortcode_data.= ' company="'.$element[3]['value'][$i].'" ';
				$shortcode_data.= ' link="'.$element[4]['value'][$i].'" ';
				$shortcode_data.= ' target="'.$element[5]['value'][$i].'"] ';
				$shortcode_data.=   $element[6]['value'][$i] ;
				$shortcode_data.= ' [/testimonial]';
				
			}
			
			$shortcode_data.= ' [/testimonials]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Text block shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Text block doable shortcode
		 **/
		private static function build_text_block_Shortcode ( $args ) {
		
			$shortcode_data = ' [text]';
			$shortcode_data.= $args[0]['value'];
			$shortcode_data = ' [/text]';
			
			return $shortcode_data;
		}
		
		/**
		 * Returns title shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Title doable shortcode
		 **/
		private static function build_title_Shortcode ( $args ) {
			
			$shortcode_data = ' [title ';
			$shortcode_data.= ' size="'.$args[0]['value'].'"';
			$shortcode_data.= ' content_align="'.$args[1]['value'].'"';
			$shortcode_data.= ' style_type="'.$args[2]['value'].' '.$args[3]['value'].'"';
			$shortcode_data.= ' sep_color="'.$args[4]['value'].'"';
			$shortcode_data.= ' class="'.$args[6]['value'].'"';
			$shortcode_data.= ' id="'.$args[7]['value'].'"]';
			$shortcode_data.= $args[5]['value'];
			$shortcode_data.= '[/title]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Toggles shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Toggles doable shortcode
		 **/
		/*private static function build_accordion_Shortcode ( $args ) {
		
			$shortcode_data = ' [accordion ';
			$shortcode_data.= ' skin="'.$args[0]['value'].'" ';
			$shortcode_data.= ' margin_top="'.$args[1]['value'].'" ';
			$shortcode_data.= ' margin_bottom="'.$args[2]['value'].'" ';
			$shortcode_data.= ' class="'.$args[3]['value'].'" ';
			$shortcode_data.= ' id="'.$args[4]['value'].'"] ';
			
			$total_elements = count ( $args[5]['elements'][0]['value'] );
			$element 		= $args[5]['elements'];
			
			for ($i = 0; $i < $total_elements; $i++) {
				
				$shortcode_data.= ' [acc ';
				$shortcode_data.= ' title="'.$element[0]['value'][$i].'"] ';
				$shortcode_data.=   $element[1]['value'][$i];
				$shortcode_data.= ' [/acc] ';
			}
			
			$shortcode_data.= ' [/accordion] ';
			return $shortcode_data;

		}*/
		/**
		 * Returns tooltip shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Tooltip doable shortcode
		 **/
		/*private static function build_tooltip_Shortcode ( $args ) {
	
			$shortcode_data = ' [tooltip ';
			$shortcode_data.= ' title="'.$args[0]['value'].'" ';
			$shortcode_data.= ' placement="'.$args[1]['value'].'" ';
			$shortcode_data.= ' class="'.$args[3]['value'].'" ';
			$shortcode_data.= ' id="'.$args[4]['value'].'"] ';
			$shortcode_data.= $args[2]['value'];
			$shortcode_data.= ' [/tooltip]';
			
			return $shortcode_data;
		}*/
		/**
		 * Returns vimeo shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Vimeo doable shortcode
		 **/
		private static function build_vimeo_Shortcode ( $args ) {
			
			$shortcode_data = ' [vimeo ';
			$shortcode_data.= ' id="'.$args[0]['value'].'"';
			$shortcode_data.= ' width="'.$args[1]['value'].'"';
			$shortcode_data.= ' height="'.$args[2]['value'].'" ';
			$shortcode_data.= ' autoplay="'.$args[3]['value'].'" ';
			$shortcode_data.= ' api_params="'.$args[4]['value'].'" ';
			$shortcode_data.= ' class="'.$args[5]['value'].'"]';
			
			return $shortcode_data;
		}
		/**
		 * Returns Woo commerce feature products slider shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Woo commerce featured products doable shortcode
		 **/
		private static function build_woo_featured_Shortcode ( $args ) {
			
			$shortcode_data = '[featured_products_slider ';
			$shortcode_data.= ' class="'.$args[1]['value'].'" ';
			$shortcode_data.= ' id="'.$args[2]['value'].'"] ';
			return $shortcode_data;
		}
		/**
		 * Returns Woo commerce products slider shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Woo commerce products slider doable shortcode
		 **/
		private static function build_woo_carousel_Shortcode ( $args ) {
	
			$shortcode_data = ' [products_slider ';
			$shortcode_data.= ' picture_size="'.$args[0]['value'].'" ';
			$shortcode_data.= ' cat_slug="'.$args[1]['value'].'" ';
			$shortcode_data.= ' number_posts="'.$args[2]['value'].'" ';
			$shortcode_data.= ' show_cats="'.$args[3]['value'].'" ';
			$shortcode_data.= ' show_price="'.$args[4]['value'].'" ';
			$shortcode_data.= ' show_buttons="'.$args[5]['value'].'" ';
			$shortcode_data.= ' class="'.$args[6]['value'].'" ';
			$shortcode_data.= ' id="'.$args[7]['value'].'"] ';
			
			return $shortcode_data;
		}
		/**
		 * Returns Woocommerce shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Woocommerce default doable shortcode
		 */
		private static function build_woo_shortcodes ( $args ) {
			return $args[1]['value'];
		}
		/**
		 * Returns youtube shortcode
		 *
		 * @since	 	2.0.0
		 *
		 * @param		Array 		Array containing element data
		 *
		 * @return 		String		Youtube doable shortcode
		 */
		private static function build_youtube_Shortcode ( $args ) {
		
			$shortcode_data = ' [youtube ';
			$shortcode_data.= ' id="'.$args[0]['value'].'"';
			$shortcode_data.= ' width="'.$args[1]['value'].'"';
			$shortcode_data.= ' height="'.$args[2]['value'].'" ';
			$shortcode_data.= ' autoplay="'.$args[3]['value'].'" ';
			$shortcode_data.= ' api_params="'.$args[4]['value'].'" ';
			$shortcode_data.= ' class="'.$args[5]['value'].'"]';
			
			return $shortcode_data;
			
		}
		/* ** ** ** ** Parser code ends here ** ** ** */

	}
	
}