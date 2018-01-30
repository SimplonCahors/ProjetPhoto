<?php
/*
Plugin Name: Themedo Core
Plugin URI: http://www.themeforest.net
Description: Themedo Core Plugin for Themedo Themes
Version: 1.0.0
Author: themedo
Author URI: http://www.theme-themedo.com
*/

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

// path to font awesome
define ('avalon_td_BUILDER_FA_PATH' , plugin_dir_path( __FILE__ ) . 'tinymce/css/font-awesome.css' );

if( ! get_option( 'avalon_td_disable_builder' ) ) {
	if ( is_admin() ) {
		// Load Page Builder Functionality
		require_once( plugin_dir_path( __FILE__ ) . 'admin/class-pagebuilder.php' );
		add_action( 'plugins_loaded', array( 'avalon_td_Core_PageBuilder', 'get_instance' ) );
	}

	// Load Shortcoded parser
	require_once( plugin_dir_path( __FILE__ ) . 'admin/page-builder/classes/class-shortcodes-parser.php' );
	add_filter( 'the_content', array('avalon_td_Core_Shortcodes_Parser', 'check_builder_elements' ));
}




if( ! class_exists( 'themedoCore_Plugin' ) ) {
	class themedoCore_Plugin {
		/**
		 * Plugin version, used for cache-busting of style and script file references.
		 *
		 * @since   1.0.0
		 *
		 * @var	 string
		 */
		const VERSION = '1.7.4';
		
		/**
		 * Instance of this class.
		 *
		 * @since	1.0.0
		 *
		 * @var	  object
		 */
		protected static $instance = null;
		
		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since	 1.0.0
		 */
		private function __construct() {
			define('avalon_td_TINYMCE_URI', plugin_dir_url( __FILE__ ) . 'tinymce');
			define('avalon_td_TINYMCE_DIR', plugin_dir_path( __FILE__ ) .'tinymce');

			add_action('init', array(&$this, 'init'));
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('init', array(&$this, 'load_avalon_td_core_text_domain'));
			//add_action('admin_init', array(&$this, 'updater'));
			add_action('wp_ajax_avalon_td_shortcodes_popup', array(&$this, 'popup'));
		}

		/**
		 * Registers TinyMCE rich editor buttons
		 *
		 * @return	void
		 */
		function init() {
			if ( get_user_option('rich_editing') == 'true' )
			{
				add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
				add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
			}

			$this->init_shortcodes();

		}
	
		// --------------------------------------------------------------------------	

		/**
		 * Find and include all shortcode classes within shortcodes folder
		 *
		 * @return void
		 */
		function init_shortcodes() {

			foreach( glob( plugin_dir_path( __FILE__ ) . '/shortcodes/*.php' ) as $filename ) {
				require_once $filename;
			}

		}
		
		// --------------------------------------------------------------------------	

		/**
		 * Register the plugin text domain
		 *
		 * @return void
		 */		
		function load_avalon_td_core_text_domain() {
			load_plugin_textdomain( 'themedo-core', false, dirname( plugin_basename(__FILE__) ) . '/languages' );
		}

		// --------------------------------------------------------------------------

		/**
		 * Function to apply attributes to HTML tags.
		 * Devs can override attributes in a child theme by using the correct slug
		 *
		 *
		 * @param  string $slug	   Slug to refer to the HTML tag
		 * @param  array  $attributes Attributes for HTML tag
		 * @return [type]			 [description]
		 */
		public static function attributes( $slug, $attributes = array() ) {

			$out = '';
			$attr = apply_filters( "avalon_td_attr_{$slug}", $attributes );

			if ( empty( $attr ) ) {
				$attr['class'] = $slug;
			}

			foreach ( $attr as $name => $value ) {
				$out .= ( !empty( $value ) || strlen( $value ) > 0 || is_bool( $value ) ) ? sprintf( ' %s="%s"', esc_html( $name ), esc_attr( $value ) ) : '';
			}
			
			return trim( $out );

		} // end attr()
		
		// --------------------------------------------------------------------------		
		
		/**
		 * Return an instance of this class.
		 *
		 * @since	 1.0.0
		 *
		 * @return	object	A single instance of this class.
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;

		}
		
		// --------------------------------------------------------------------------		
		
		/**
		 * Function to return animation classes for shortcodes mainly.
		 *
		 * @param  array  $args Animation type, direction and speed
		 * @return array		Array with data attributes
		 */
		public static function animations( $args = array() ) {

			$defaults = array(
				'type' 		=> '',
				'direction' => 'left',
				'speed' 	=> '0.1',
			);

			$args = wp_parse_args( $args, $defaults );

			if ( $args['type'] ) {

				$animation_attribues['animation_class'] = 'themedo-animated';

				if ( $args['direction'] == 'static' ) {
					$args['direction'] = '';
				}

				if ( $args['type'] != 'bounce' &&
					$args['type'] != 'flash' && 
					$args['type'] != 'shake' &&
					$args['type'] != 'rubberBand'
				) {
					$direction_suffix = 'In' . ucfirst( $args['direction'] );
					$args['type'] .= $direction_suffix;
				}

				$animation_attribues['data-animationType'] = $args['type'];

				if ( $args['speed'] ) {
					$animation_attribues['data-animationDuration'] = $args['speed'];
				}

				return $animation_attribues;

			}

		}
		
		// --------------------------------------------------------------------------		
		
		/**
		 * Function to get the default shortcode param values applied.
		 *
		 * @param  array  $args  Array with user set param values
		 * @return array  $defaults  Array with default param values
		 */
		public static function set_shortcode_defaults( $defaults, $args ) {
			
			if( ! $args ) {
				$$args = array();
			}
		
			$args = shortcode_atts( $defaults, $args );		
		
			foreach( $args as $key => $value ) {
				if( $value == '' || 
					$value == '|' 
				) {
					$args[$key] = $defaults[$key];
				}
			}

			return $args;
		
		}
		
		// --------------------------------------------------------------------------		
		
		/**
		 * Some helping fuctions
		 *
		 */
		public static function font_awesome_name_handler( $icon ) {

			$old_icons['arrow'] = 'angle-right';
			$old_icons['asterik'] = 'asterisk';
			$old_icons['cross'] = 'times';
			$old_icons['ban-circle'] = 'ban';
			$old_icons['bar-chart'] = 'bar-chart-o';
			$old_icons['beaker'] = 'flask';
			$old_icons['bell'] = 'bell-o';
			$old_icons['bell-alt'] = 'bell';
			$old_icons['bitbucket-sign'] = 'bitbucket-square';
			$old_icons['bookmark-empty'] = 'bookmark-o';
			$old_icons['building'] = 'building-o';
			$old_icons['calendar-empty'] = 'calendar-o';
			$old_icons['check-empty'] = 'square-o';
			$old_icons['check-minus'] = 'minus-square-o';
			$old_icons['check-sign'] = 'check-square';
			$old_icons['check'] = 'check-square-o';
			$old_icons['chevron-sign-down'] = 'chevron-circle-down';
			$old_icons['chevron-sign-left'] = 'chevron-circle-left';
			$old_icons['chevron-sign-right'] = 'chevron-circle-right';
			$old_icons['chevron-sign-up'] = 'chevron-circle-up';
			$old_icons['circle-arrow-down'] = 'arrow-circle-down';
			$old_icons['circle-arrow-left'] = 'arrow-circle-left';
			$old_icons['circle-arrow-right'] = 'arrow-circle-right';
			$old_icons['circle-arrow-up'] = 'arrow-circle-up';
			$old_icons['circle-blank'] = 'circle-o';
			$old_icons['cny'] = 'rub';
			$old_icons['collapse-alt'] = 'minus-square-o';
			$old_icons['collapse-top'] = 'caret-square-o-up';
			$old_icons['collapse'] = 'caret-square-o-down';
			$old_icons['comment-alt'] = 'comment-o';
			$old_icons['comments-alt'] = 'comments-o';
			$old_icons['copy'] = 'files-o';
			$old_icons['cut'] = 'scissors';
			$old_icons['dashboard'] = 'tachometer';
			$old_icons['double-angle-down'] = 'angle-double-down';
			$old_icons['double-angle-left'] = 'angle-double-left';
			$old_icons['double-angle-right'] = 'angle-double-right';
			$old_icons['double-angle-up'] = 'angle-double-up';
			$old_icons['download'] = 'arrow-circle-o-down';
			$old_icons['download-alt'] = 'download';
			$old_icons['edit-sign'] = 'pencil-square';
			$old_icons['edit'] = 'pencil-square-o';
			$old_icons['ellipsis-horizontal'] = 'ellipsis-h';
			$old_icons['ellipsis-vertical'] = 'ellipsis-v';
			$old_icons['envelope-alt'] = 'envelope-o';
			$old_icons['exclamation-sign'] = 'exclamation-circle';
			$old_icons['expand-alt'] = 'plus-square-o';
			$old_icons['expand'] = 'caret-square-o-right';
			$old_icons['external-link-sign'] = 'external-link-square';
			$old_icons['eye-close'] = 'eye-slash';
			$old_icons['eye-open'] = 'eye';
			$old_icons['facebook-sign'] = 'facebook-square';
			$old_icons['facetime-video'] = 'video-camera';
			$old_icons['file-alt'] = 'file-o';
			$old_icons['file-text-alt'] = 'file-text-o';
			$old_icons['flag-alt'] = 'flag-o';
			$old_icons['folder-close-alt'] = 'folder-o';
			$old_icons['folder-close'] = 'folder';
			$old_icons['folder-open-alt'] = 'folder-open-o';
			$old_icons['food'] = 'cutlery';
			$old_icons['frown'] = 'frown-o';
			$old_icons['fullscreen'] = 'arrows-alt';
			$old_icons['github-sign'] = 'github-square';
			$old_icons['google-plus-sign'] = 'google-plus-square';
			$old_icons['group'] = 'users';
			$old_icons['h-sign'] = 'h-square';
			$old_icons['hand-down'] = 'hand-o-down';
			$old_icons['hand-left'] = 'hand-o-left';
			$old_icons['hand-right'] = 'hand-o-right';
			$old_icons['hand-up'] = 'hand-o-up';
			$old_icons['hdd'] = 'hdd-o';
			$old_icons['heart-empty'] = 'heart-o';
			$old_icons['hospital'] = 'hospital-o';
			$old_icons['indent-left'] = 'outdent';
			$old_icons['indent-right'] = 'indent';
			$old_icons['info-sign'] = 'info-circle';
			$old_icons['keyboard'] = 'keyboard-o';
			$old_icons['legal'] = 'gavel';
			$old_icons['lemon'] = 'lemon-o';
			$old_icons['lightbulb'] = 'lightbulb-o';
			$old_icons['linkedin-sign'] = 'linkedin-square';
			$old_icons['meh'] = 'meh-o';
			$old_icons['microphone-off'] = 'microphone-slash';
			$old_icons['minus-sign-alt'] = 'minus-square';
			$old_icons['minus-sign'] = 'minus-circle';
			$old_icons['mobile-phone'] = 'mobile';
			$old_icons['moon'] = 'moon-o';
			$old_icons['move'] = 'arrows';
			$old_icons['off'] = 'power-off';
			$old_icons['ok-circle'] = 'check-circle-o';
			$old_icons['ok-sign'] = 'check-circle';
			$old_icons['ok'] = 'check';
			$old_icons['paper-clip'] = 'paperclip';
			$old_icons['paste'] = 'clipboard';
			$old_icons['phone-sign'] = 'phone-square';
			$old_icons['picture'] = 'picture-o';
			$old_icons['pinterest-sign'] = 'pinterest-square';
			$old_icons['play-circle'] = 'play-circle-o';
			$old_icons['play-sign'] = 'play-circle';
			$old_icons['plus-sign-alt'] = 'plus-square';
			$old_icons['plus-sign'] = 'plus-circle';
			$old_icons['pushpin'] = 'thumb-tack';
			$old_icons['question-sign'] = 'question-circle';
			$old_icons['remove-circle'] = 'times-circle-o';
			$old_icons['remove-sign'] = 'times-circle';
			$old_icons['remove'] = 'times';
			$old_icons['reorder'] = 'bars';
			$old_icons['resize-full'] = 'expand';
			$old_icons['resize-horizontal'] = 'arrows-h';
			$old_icons['resize-small'] = 'compress';
			$old_icons['resize-vertical'] = 'arrows-v';
			$old_icons['rss-sign'] = 'rss-square';
			$old_icons['save'] = 'floppy-o';
			$old_icons['screenshot'] = 'crosshairs';
			$old_icons['share-alt'] = 'share';
			$old_icons['share-sign'] = 'share-square';
			$old_icons['share'] = 'share-square-o';
			$old_icons['sign-blank'] = 'square';
			$old_icons['signin'] = 'sign-in';
			$old_icons['signout'] = 'sign-out';
			$old_icons['smile'] = 'smile-o';
			$old_icons['sort-by-alphabet-alt'] = 'sort-alpha-desc';
			$old_icons['sort-by-alphabet'] = 'sort-alpha-asc';
			$old_icons['sort-by-attributes-alt'] = 'sort-amount-desc';
			$old_icons['sort-by-attributes'] = 'sort-amount-asc';
			$old_icons['sort-by-order-alt'] = 'sort-numeric-desc';
			$old_icons['sort-by-order'] = 'sort-numeric-asc';
			$old_icons['sort-down'] = 'sort-asc';
			$old_icons['sort-up'] = 'sort-desc';
			$old_icons['stackexchange'] = 'stack-overflow';
			$old_icons['star-empty'] = 'star-o';
			$old_icons['star-half-empty'] = 'star-half-o';
			$old_icons['sun'] = 'sun-o';
			$old_icons['thumbs-down-alt'] = 'thumbs-o-down';
			$old_icons['thumbs-up-alt'] = 'thumbs-o-up';
			$old_icons['time'] = 'clock-o';
			$old_icons['trash'] = 'trash-o';
			$old_icons['tumblr-sign'] = 'tumblr-square';
			$old_icons['twitter-sign'] = 'twitter-square';
			$old_icons['unlink'] = 'chain-broken';
			$old_icons['upload'] = 'arrow-circle-o-up';
			$old_icons['upload-alt'] = 'upload';
			$old_icons['warning-sign'] = 'exclamation-triangle';
			$old_icons['xing-sign'] = 'xing-square';
			$old_icons['youtube-sign'] = 'youtube-square';
			$old_icons['zoom-in'] = 'search-plus';
			$old_icons['zoom-out'] = 'search-minus';

			if( isset( $icon ) && ! empty( $icon ) ) {
				if( substr( $icon, 0, 5 ) == 'icon-' || substr( $icon, 0, 3 ) != 'fa-' ) {
					$icon = str_replace( 'icon-', 'fa-', $icon );
				
					if( array_key_exists( str_replace( 'fa-', '', $icon ), $old_icons ) ) {
						$fa_icon = 'fa-' . $old_icons[str_replace( 'fa-', '', $icon )];
					} else {
						if( substr( $icon, 0, 3 ) != 'fa-' ) {
							$fa_icon = 'fa-' . $icon;
						} else {
							$fa_icon = $icon;
						}
					}
				} elseif( substr( $icon, 0, 3 ) != 'fa-' ) {
					$fa_icon = 'fa-' . $icon;
				} else {
					$fa_icon = $icon;
				}
			} else {
				$fa_icon = '';
			}

			return $fa_icon;
		}  			 
		 
		public static function order_array_like_array( Array $to_be_ordered, Array $order_like ) {
			$ordered = array();

			foreach( $order_like as $key ) {
				if( array_key_exists( $key, $to_be_ordered ) ) {
					$ordered[$key] = $to_be_ordered[$key];
					unset( $to_be_ordered[$key] );
				}
			}

			return $ordered + $to_be_ordered;
		}  		 
		 
		public static function get_attachment_id_from_url( $attachment_url = '' ) {
			global $wpdb;
			$attachment_id = false;

			if ( $attachment_url == '' ) {
				return;
			}

			$upload_dir_paths = wp_upload_dir();

			// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
			if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

				// If this is the URL of an auto-generated thumbnail, get the URL of the original image
				$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

				// Remove the upload path base directory from the attachment URL
				$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

				// Run a custom database query to get the attachment ID from the modified attachment URL
				$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
			}
			return $attachment_id;
		}


		public static function hex2rgb( $hex ) {
		   $hex = str_replace( "#", "", $hex );

		   if( strlen( $hex ) == 3 ) {
			  $r = hexdec( substr( $hex, 0, 1 ).substr($hex, 0, 1 ) );
			  $g = hexdec( substr( $hex, 1, 1).substr( $hex, 1, 1 ) );
			  $b = hexdec( substr( $hex, 2, 1).substr( $hex, 2, 1 ) );
		   } else {
			  $r = hexdec( substr( $hex, 0, 2 ) );
			  $g = hexdec( substr( $hex, 2, 2 ) ) ;
			  $b = hexdec( substr( $hex, 4, 2 ) );
		   }
		   $rgb = array( $r, $g, $b );

		   return $rgb; // returns an array with the rgb values
		}

		public static function rgb2hsl( $hex_color ) {

				$hex_color	= str_replace( '#', '', $hex_color );

				if( strlen( $hex_color ) < 3 ) {
					str_pad( $hex_color, 3 - strlen( $hex_color ), '0' );
				}

				$add		 = strlen( $hex_color ) == 6 ? 2 : 1;
				$aa		  = 0;
				$add_on	  = $add == 1 ? ( $aa = 16 - 1 ) + 1 : 1;

				$red		 = round( ( hexdec( substr( $hex_color, 0, $add ) ) * $add_on + $aa ) / 255, 6 );
				$green	   = round( ( hexdec( substr( $hex_color, $add, $add ) ) * $add_on + $aa ) / 255, 6 );
				$blue		= round( ( hexdec( substr( $hex_color, ( $add + $add ) , $add ) ) * $add_on + $aa ) / 255, 6 );

				$hsl_color	= array( 'hue' => 0, 'sat' => 0, 'lum' => 0 );

				$minimum	 = min( $red, $green, $blue );
				$maximum	 = max( $red, $green, $blue );

				$chroma	  = $maximum - $minimum;

				$hsl_color['lum'] = ( $minimum + $maximum ) / 2;

				if( $chroma == 0 ) {
					$hsl_color['lum'] = round( $hsl_color['lum'] * 100, 0 );

					return $hsl_color;
				}

				$range = $chroma * 6;

				$hsl_color['sat'] = $hsl_color['lum'] <= 0.5 ? $chroma / ( $hsl_color['lum'] * 2 ) : $chroma / ( 2 - ( $hsl_color['lum'] * 2 ) );

				if( $red <= 0.004 || 
					$green <= 0.004 || 
					$blue <= 0.004 
				) {
					$hsl_color['sat'] = 1;
				}

				if( $maximum == $red ) {
					$hsl_color['hue'] = round( ( $blue > $green ? 1 - ( abs( $green - $blue ) / $range ) : ( $green - $blue ) / $range ) * 255, 0 );
				} else if( $maximum == $green ) {
					$hsl_color['hue'] = round( ( $red > $blue ? abs( 1 - ( 4 / 3 ) + ( abs ( $blue - $red ) / $range ) ) : ( 1 / 3 ) + ( $blue - $red ) / $range ) * 255, 0 );
				} else {
					$hsl_color['hue'] = round( ( $green < $red ? 1 - 2 / 3 + abs( $red - $green ) / $range : 2 / 3 + ( $red - $green ) / $range ) * 255, 0 );
				}

				$hsl_color['sat'] = round( $hsl_color['sat'] * 100, 0 );
				$hsl_color['lum']  = round( $hsl_color['lum'] * 100, 0 );

				return $hsl_color;
		}		

		public static function calc_color_brightness( $color ) {
		
			if( strtolower( $color ) == 'black' ||
				strtolower( $color ) == 'navy' ||
				strtolower( $color ) == 'purple' ||
				strtolower( $color ) == 'maroon' ||
				strtolower( $color ) == 'indigo' ||
				strtolower( $color ) == 'darkslategray' ||
				strtolower( $color ) == 'darkslateblue' ||
				strtolower( $color ) == 'darkolivegreen' ||
				strtolower( $color ) == 'darkgreen' ||
				strtolower( $color ) == 'darkblue' 
			) {
				$brightness_level = 0;
			} elseif( strpos( $color, '#' ) === 0 ) {
				$color = self::hex2rgb( $color );

				$brightness_level = sqrt( pow( $color[0], 2) * 0.299 + pow( $color[1], 2) * 0.587 + pow( $color[2], 2) * 0.114 );			
			} else {
				$brightness_level = 150;
			}

			return $brightness_level;
		}
		
		public static function avalon_td_link_pages() {		
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'themedo-core' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>'
			) ); 
		}
		
		// Get the regular expression to parse a single shortcode
		public static function get_shortcode_regex( $tagname ) {
			return
				  '/\\['                              // Opening bracket
				. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
				. "($tagname)"                     // 2: Shortcode name
				. '(?![\\w-])'                       // Not followed by word character or hyphen
				. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
				.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
				.     '(?:'
				.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
				.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
				.     ')*?'
				. ')'
				. '(?:'
				.     '(\\/)'                        // 4: Self closing tag ...
				.     '\\]'                          // ... and closing bracket
				. '|'
				.     '\\]'                          // Closing bracket
				.     '(?:'
				.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
				.             '[^\\[]*+'             // Not an opening bracket
				.             '(?:'
				.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
				.                 '[^\\[]*+'         // Not an opening bracket
				.             ')*+'
				.         ')'
				.         '\\[\\/\\2\\]'             // Closing shortcode tag
				.     ')?'
				. ')'
				. '(\\]?)/';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
		}
		
		/**
		 * Check if rgba color is transparent
		 * @param  string 	$rgba rgba color string
		 * @return boolean	is transparent or not?
		 */
		public static function is_transparent_color( $rgba ) {
			$test = preg_match_all( '/rgba\((.*)\)/', $rgba, $matches );
			if( $test && is_array( $matches ) && $matches[1][0] ) {
				$explode = explode( ',', $matches[1][0] );
				if( is_array( $explode ) && $explode[3] ) {
					$transperancy_level = (float) $explode[3];
					if( $transperancy_level && $transperancy_level >= 0 || $transperancy_level < 1) {
						return true;
					} else {
						return false;
					}
				}
			}

			return false;
		}
		
		/**
		 * Strips the unit from a given value
		 * @param  string	$value The value with or without unit
		 * @param  string	$unit_to_strip The unit to be stripped
		 *
		 * @return string	the value without a unit
		 */		
		public static function strip_unit( $value, $unit_to_strip = 'px' ) {
			$value_length = strlen( $value );
			$unit_length = strlen( $unit_to_strip );

			if ( $value_length > $unit_length &&
				 substr_compare( $value, $unit_to_strip, $unit_length * (-1), $unit_length ) === 0
			) {
				return substr( $value, 0, $value_length - $unit_length );
			} else {
				return $value;
			}
		}

		// --------------------------------------------------------------------------

		/**
		 * Defins TinyMCE rich editor js plugin
		 *
		 * @return	void
		 */
		function add_rich_plugins( $plugin_array )
		{
			if( is_admin() ) {
				$plugin_array['avalon_td_button'] = avalon_td_TINYMCE_URI . '/plugin.js';
			}

			return $plugin_array;
		}

		// --------------------------------------------------------------------------

		/**
		 * Adds TinyMCE rich editor buttons
		 *
		 * @return	void
		 */
		function register_rich_buttons( $buttons )
		{
			array_push( $buttons, 'avalon_td_button' );
			return $buttons;
		}

		/**
		 * Enqueue Scripts and Styles
		 *
		 * @return	void
		 */
		function admin_init()
		{
			// css
			wp_enqueue_style( 'themedo-popup', avalon_td_TINYMCE_URI . '/css/popup.css', false, themedoCore_Plugin::VERSION, 'all' );
			wp_enqueue_style( 'themedo-jquery.chosen', avalon_td_TINYMCE_URI . '/css/chosen.css', false, themedoCore_Plugin::VERSION, 'all' );
			wp_enqueue_style( 'fuision-font-awesome', avalon_td_TINYMCE_URI . '/css/font-awesome.css', false, themedoCore_Plugin::VERSION, 'all' );
			wp_enqueue_style( 'wp-color-picker' );

			// js
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'themedo-jquery-livequery', avalon_td_TINYMCE_URI . '/js/jquery.livequery.js', false, themedoCore_Plugin::VERSION, false );
			wp_enqueue_script( 'themedo-jquery-appendo', avalon_td_TINYMCE_URI . '/js/jquery.appendo.js', false, themedoCore_Plugin::VERSION, false );
			//wp_enqueue_script( 'themedo-base64', avalon_td_TINYMCE_URI . '/js/base64.js', false, themedoCore_Plugin::VERSION, false );
			wp_enqueue_script( 'themedo-jquery.chosen', avalon_td_TINYMCE_URI . '/js/chosen.jquery.min.js', false, themedoCore_Plugin::VERSION, false );
			wp_enqueue_script( 'wp-color-picker' );

			wp_enqueue_script( 'themedo-popup', avalon_td_TINYMCE_URI . '/js/popup.js', false, themedoCore_Plugin::VERSION, true );
			
			//wp_enqueue_script( 'media-upload' );

			// Developer mode
			$dev_mode = current_theme_supports( 'avalon_td_shortcodes_embed' );
			if( $dev_mode ) {
				$dev_mode = 'true';
			} else {
				$dev_mode = 'false';
			}

			wp_localize_script( 'themedo-popup', 'themedoShortcodes', array('plugin_folder' => plugins_url( '', __FILE__ ), 'dev' => $dev_mode) );
		}

		/**
		 * Popup function which will show shortcode options in thickbox.
		 *
		 * @return void
		 */
		function popup() {

			require_once( avalon_td_TINYMCE_DIR . '/themedo-sc.php' );

			die();

		}

		/*function updater() {
			$current = get_site_transient( 'update_plugins' );
			if ( isset( $current->last_checked ) && 12 * HOUR_IN_SECONDS > ( time() - $current->last_checked ) ) {
				return;
			}

			$plugin_id = plugin_basename( __FILE__ );
			$plugin_slug = basename( dirname( __FILE__ ) );

			require_once plugin_dir_path( __FILE__ ) . 'libs/class-updater.php';
			$theme_update = new themedoCoreUpdater( 'http://updates.theme-themedo.com/themedo-core.php', $plugin_id, $plugin_slug );
		}*/
	}
}
// Load the instance of the plugin
add_action( 'plugins_loaded', array( 'themedoCore_Plugin', 'get_instance' ) );

// Blocking Script
if( ! function_exists( 'avalon_td_block_direct_access' ) ) {
	/**
	 * Blocks direct accessing of a core file
	 * @param  none
	 * @return void
	 */
	function avalon_td_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Direct script access denied.' );
		}
	}
}

/**
 * themedo Slider
 */
//include_once 'themedo-slider.php';

/*----------------------------------------------------------------------------*
 * Register custom post types
 *----------------------------------------------------------------------------*/
//add_action( 'init', 'avalon_td_register_post_types' );
function avalon_td_register_post_types() {
	global $avalon_td_option;

	register_post_type(
		'avalon_td_portfolio',
		array(
			'labels' => array(
				'name' 			=> 'Portfolio',
				'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => $avalon_td_option['portfolio_slug']
			),
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_category', 'avalon_td_portfolio', array('hierarchical' => true, 'label' => 'Portfolio Categories', 'query_var' => true, 'rewrite' => true));
	register_taxonomy('portfolio_skills', 'avalon_td_portfolio', array('hierarchical' => true, 'label' => 'Skills', 'query_var' => true, 'rewrite' => true));
	register_taxonomy('portfolio_tags', 'avalon_td_portfolio', array('hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => true));

	register_post_type(
		'avalon_td_faq',
		array(
			'labels' => array(
				'name' => 'FAQs',
				'singular_name' => 'FAQ'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'faq-items'),
			'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'),
			'can_export' => true,
		)
	);

	register_taxonomy('faq_category', 'avalon_td_faq', array('hierarchical' => true, 'label' => 'FAQ Categories', 'query_var' => true, 'rewrite' => true));


	if( ! $avalon_td_option['status_eslider'] ) {
		register_post_type(
			'avalon_td_elastic',
			array(
				'public' => true,
				'has_archive' => false,
				'rewrite' => array('slug' => 'elastic-slide'),
				'supports' => array('title', 'thumbnail'),
				'can_export' => true,
				'menu_position' => 100,
				'labels' => array(
					'name'				=> _x( 'Elastic Sliders', 'Post Type General Name', 'themedo-core' ),
					'singular_name'	   => _x( 'Elastic Slider', 'Post Type Singular Name', 'themedo-core' ),
					'menu_name'		   => __( 'Elastic Slider', 'themedo-core' ),
					'parent_item_colon'   => __( 'Parent Slide:', 'themedo-core' ),
					'all_items'		   => __( 'Add or Edit Slides', 'themedo-core' ),
					'view_item'		   => __( 'View Slides', 'themedo-core' ),
					'add_new_item'		=> __( 'Add New Slide', 'themedo-core' ),
					'add_new'			 => __( 'Add New Slide', 'themedo-core' ),
					'edit_item'		   => __( 'Edit Slide', 'themedo-core' ),
					'update_item'		 => __( 'Update Slide', 'themedo-core' ),
					'search_items'		=> __( 'Search Slide', 'themedo-core' ),
					'not_found'		   => __( 'Not found', 'themedo-core' ),
					'not_found_in_trash'  => __( 'Not found in Trash', 'themedo-core' ),
				)
			)
		);

		register_taxonomy(
			'avalon_td_es_groups',
			'avalon_td_elastic',
			array(
				'hierarchical' => false,
				'query_var' => true,
				'rewrite' => true,
				'labels' => array(
					'name'					   => _x( 'Groups', 'Taxonomy General Name', 'themedo-core' ),
					'singular_name'			  => _x( 'Group', 'Taxonomy Singular Name', 'themedo-core' ),
					'menu_name'				  => __( 'Add or Edit Groups', 'themedo-core' ),
					'all_items'				  => __( 'All Groups', 'themedo-core' ),
					'parent_item_colon'		  => __( 'Parent Group:', 'themedo-core' ),
					'new_item_name'			  => __( 'New Group Name', 'themedo-core' ),
					'add_new_item'			   => __( 'Add Groups', 'themedo-core' ),
					'edit_item'				  => __( 'Edit Group', 'themedo-core' ),
					'update_item'				=> __( 'Update Group', 'themedo-core' ),
					'separate_items_with_commas' => __( 'Separate groups with commas', 'themedo-core' ),
					'search_items'			   => __( 'Search Groups', 'themedo-core' ),
					'add_or_remove_items'		=> __( 'Add or remove groups', 'themedo-core' ),
					'choose_from_most_used'	  => __( 'Choose from the most used groups', 'themedo-core' ),
					'not_found'				  => __( 'Not Found', 'themedo-core' ),
				),
			)
		);
	}
	
	// qTrabslate and mqTranslate custom post type support
	if( function_exists('qtrans_getLanguage') ) {
		add_action('portfolio_category_add_form', 'qtrans_modifyTermFormFor');
		add_action('portfolio_category_edit_form', 'qtrans_modifyTermFormFor');
		add_action('portfolio_skills_add_form', 'qtrans_modifyTermFormFor');
		add_action('portfolio_skills_edit_form', 'qtrans_modifyTermFormFor');
		add_action('portfolio_tags_add_form', 'qtrans_modifyTermFormFor');
		add_action('portfolio_tags_edit_form', 'qtrans_modifyTermFormFor');		
		add_action('faq_category_edit_form', 'qtrans_modifyTermFormFor');
	}
}

//add_action( 'admin_menu', 'avalon_td_admin_menu' );
function avalon_td_admin_menu() {
	global $submenu;

	unset( $submenu['edit.php?post_type=avalon_td_elastic'][10] );
}

/*----------------------------------------------------------------------------*
* Add shortcode generator toggle button to text editor
*----------------------------------------------------------------------------*/

add_action('admin_print_footer_scripts','avalon_td_add_quicktags_button');

function avalon_td_add_quicktags_button() {
	if( get_current_screen()->base == 'post' ) {
	?>
		<script type="text/javascript" charset="utf-8">
			if ( typeof( QTags ) == 'function' ) {
				QTags.addButton( 'avalon_td_shortcodes_text_mode', ' ','', '', 'f' );
			}
		</script>
	<?php
	}
}



/*----------------------------------------------------------------------------*
* Remove extra P tags
*----------------------------------------------------------------------------*/
function avalon_td_shortcodes_formatter($content) {
	/*$block = join("|",array("rev_slider", "youtube", "vimeo", "soundcloud", "button", "dropcap", "highlight", "checklist", "li_item", "tabs", "tab", "toggle", "tagline_box", "pricing_table", "pricing_column", "pricing_price", "pricing_row", "pricing_footer", "content_boxes", "content_box", "slider", "slide",   "person", "recent_posts", "gallery_block", "alert", "fontawesome", "social_links", "clients", "client", "title", "separator", "tooltip", "map", "counters_circle", "counter_circle", "counters_box", "counter_box", "flexslider", "blog", "imageframe", "images", "image", "sharing", "featured_products_slider", "products_slider", "menu_anchor", 'flip_boxes', 'flip_box', 'text', 'avalon_td_text', 'avalon_td_lightbox', 'avalon_td_code', 'modal', 'modal_text_link', 'postslider'));*/
	
	$block = join("|",array("fullwidth", "one_full", "one_half", "one_third", "one_fourth", "two_third", "three_fourth", "testimonials", "testimonial", "intro", "servicetabs", "servicetab", "tdgallery", "gimg", "clients", "client", "recent_posts", "accordion", "acc", "toggle", "tog", "expandable" , "countdown", "progress", "counters_box", "counter_box", "brochures", "brochure", "modal", "person", "coverbox", "customtitle", "comparison", "hotspots", "hotspot", "service", "servicepack", "sp", "tdcontent", "gallery_block", "supersized", "simg", "flowgallery", "flowimg", "workstep", "kenburns", "ken"));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

	return $rep;
}

add_filter('the_content', 'avalon_td_shortcodes_formatter');
add_filter('widget_text', 'do_shortcode');




/*----------------------------------------------------------------------------*
 * Plugins
 *----------------------------------------------------------------------------*/
// Load Theme Options Panel
include_once(plugin_dir_path( __FILE__ ) . 'inc/themeoptions/config.php');

// Load Meta Boxes
include_once(plugin_dir_path( __FILE__ ) . 'inc/meta-box/meta-box.php');

// Tiled Gallery
//include_once(plugin_dir_path( __FILE__ ) . 'inc/gallerytiled/tiled-gallery.php');

// Pixproof
include_once(plugin_dir_path( __FILE__ ) . 'inc/pixproof/pixproof.php');


/*----------------------------------------------------------------------------*
 * Call to Custom Post types and Functions
 *----------------------------------------------------------------------------*/
include_once(plugin_dir_path( __FILE__ ) . 'inc/themedo-custompost.php');
include_once(plugin_dir_path( __FILE__ ) . 'inc/themedo-custom-functions.php');
include_once(plugin_dir_path( __FILE__ ) . 'inc/sidebar-generator.php');
include_once(plugin_dir_path( __FILE__ ) . 'inc/themedo_custom_media_fields.php');