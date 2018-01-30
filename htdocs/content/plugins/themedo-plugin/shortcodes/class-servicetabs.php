<?php
class themedoSC_Servicetabs {

	private $tabs_counter = 1;
	private $tab_counter = 1;
	private $tabs = array();
	private $active = false;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_servicetabs-shortcode', array( $this, 'attr' ) );
		add_filter( 'avalon_td_attr_servicetabs-shortcode-link', array( $this, 'link_attr' ) );		
		add_filter( 'avalon_td_attr_servicetabs-shortcode-tab', array( $this, 'tab_attr' ) );

		add_shortcode( 'stabs', array( $this, 'render_parent' ) );
		add_shortcode( 'stab', array( $this, 'render_child' ) );
		
		add_shortcode( 'servicetabs', array( $this, 'service_tabs' ) );
		add_shortcode( 'servicetab', array( $this, 'service_tab' ) );

	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
			), $args
		);
		
		// check: has "px" or not. if not: add "px"
		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}

		extract( $defaults );

		self::$parent_args = $defaults;

		$justified_class = '';
		
		
		$html = sprintf( '<div %s><ul %s>', themedoCore_Plugin::attributes( 'servicetabs-shortcode' ), themedoCore_Plugin::attributes( 'etabs' ) );

		
		if( empty( $this->tabs ) ) {
			$this->parse_tab_parameter( $content, 'servicetab', $args );
		}

		for( $i = 0; $i < count( $this->tabs ); $i++ ) {
			
			
			$html .= sprintf( '<li><a %s>%s</a></li>', themedoCore_Plugin::attributes( 'servicetabs-shortcode-link', array( 'index' => $i ) ), $this->tabs[$i]['title'] );
			
		}
		
		$html .= '';
		$html .= sprintf( '</ul><div %s>%s</div></div>', themedoCore_Plugin::attributes( 'tabcontent' ), do_shortcode($content) );

		$this->tabs_counter++;
		$this->tab_counter = 1;
		$this->active = false;
		unset( $this->tabs );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'serviceIntro si-%s', $this->tabs_counter );

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
		return $attr;

	}	

	function link_attr( $atts ) {

		$attr = array();

		$index = $atts['index'];

		$attr['class'] = 'tab-link';
		$attr['id'] = strtolower( preg_replace( '/\s+/', '', $this->tabs[$index]['title'] ) );
		$attr['href'] = '#' . $this->tabs[$index]['unique_id'];

		return $attr;

	}
		

	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'title'			=> '',
				'image'			=> '',
				'link'			=> '',
				'id'			=> '',
				'avalon_td_tab'	=> 'no'
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		$img_url = self::$child_args['image'];
		$img_id = avalon_td_attachment_id_from_url($img_url);
		$img_src = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-1170-650');
		
		$link = '';
		
		if(self::$child_args['link']){
			$link = sprintf('<a href="%s" class="read_more"><i class="xcon-right-open-big"></i></a>', self::$child_args['link']);
		}

		$html = sprintf( '<div %s><div class="img_holder">%s<div class="content_holder"><div class="avalon_td_holder_in"><div><h4>%s</h4><p>%s</p></div></div>%s</div></div></div>', themedoCore_Plugin::attributes( 'servicetabs-shortcode-tab' ), $img_src, self::$child_args['title'], do_shortcode( $content ), $link );

		return $html;

	}

	function tab_attr() {

		$attr = array();

		$attr['class'] = 'tab-pane';
		
		if( self::$child_args['avalon_td_tab'] == 'yes' ) {
			$attr['id'] = self::$child_args['id'];
		} else {
			$index = self::$child_args['id'] - 1;
			$attr['id'] = $this->tabs[$index]['unique_id'];
		}
		

		return $attr;

	}
	
	
	function service_tabs( $atts, $content = null ) {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom'		=> '',
			), $atts
		);

		extract( $defaults );

		$atts = $defaults;

		$content = preg_replace('/tab\][^\[]*/','tab]', $content);
		$content = preg_replace('/^[^\[]*\[/','[', $content);

		$this->parse_tab_parameter( $content, 'servicetab' );

		$shortcode_wrapper = '[stabs margin_top="' . $atts['margin_top'] . '" margin_bottom="' . $atts['margin_bottom'] .'" class="' . $atts['class'] . '" id="' . $atts['id'] . '"]';
		$shortcode_wrapper .= $content;
		$shortcode_wrapper .= '[/stabs]';

		return do_shortcode($shortcode_wrapper);
	}

	function service_tab( $atts, $content = null) {
		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'title'			=> '',
				'image'			=> '',
				'link'			=> '',
				'id'			=> '',
			), $atts
		);

		extract( $defaults );

		$atts = $defaults;	
	
		// create unique tab id for linking
		$sanitized_title = hash("md5", $title, false);
		$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
		$unique_id = 'tab-' . substr( md5( get_the_ID() . '-' . $this->tabs_counter . '-' . $this->tab_counter . '-' . $sanitized_title), 13 );

		$shortcode_wrapper = sprintf( '[stab id="%s" title="%s" image="%s" link="%s" avalon_td_tab="yes"]%s[/stab]', $unique_id, $title, $image, $link, do_shortcode( $content ) );

		$this->tab_counter++;

		return do_shortcode( $shortcode_wrapper );
	}
	
	
	
	function parse_tab_parameter( $content, $shortcode, $args = null ) {
		$preg_match_tabs_single = preg_match_all( themedoCore_Plugin::get_shortcode_regex( $shortcode ), $content, $tabs_single );

		if( is_array( $tabs_single[0] ) ) {
			foreach( $tabs_single[0] as $key => $tab ) {
				
				
				if( is_array( $args ) ) {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' id=([0-9]+)/i', $tab, $ids );	

					if( array_key_exists( '0', $ids[1] ) ) {
						$id = $ids[1][0];
					} else {
						$title = 'default';
					}				

					foreach ( $args as $key => $value ) {

						if( $key == $shortcode . $id ) {
							
							$title = $value;
						}
					}
				} else {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' title="([^\"]+)"/i', $tab, $titles );
					if( array_key_exists( '0', $titles[1] ) ) {
						$title = $titles[1][0];
					} else {
						$title = 'default';
					}
				}
				
			
				$preg_match_icons = preg_match_all( '/' . $shortcode . '( id=[0-9]+| title="[^\"]+")? image="([^\"]+)"/i', $tab, $images );
				if( array_key_exists( '0', $images[2] ) ) {
					$image = $images[2][0];
				} else {
					$image = 'none';
				}
				
				// create unique tab id for linking
				$sanitized_title = hash("md5", $title, false);
				$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
				$unique_id = 'tab-' . substr( md5( get_the_ID() . '-' . $this->tabs_counter . '-' . $this->tab_counter . '-' . $sanitized_title), 13 );

				// create array for every single tab shortcode
				$this->tabs[] = array('title' => $title, 'image' => $image, 'unique_id' => $unique_id );
				
				$this->tab_counter++;
			}
			
			$this->tab_counter = 1;
		}
	}

}

new themedoSC_Servicetabs();