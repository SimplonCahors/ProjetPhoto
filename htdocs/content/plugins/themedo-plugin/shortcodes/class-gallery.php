<?php
class themedoSC_Gallery {

	private $gallery_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_gallery-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'tdgallery', array( $this, 'render_parent' ) );
		add_shortcode( 'gimg', array( $this, 'render_child' ) );

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
				'slide_autoplay' 	=> '',
				'slide_speed' 		=> '',
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

		$html = sprintf( '<div %s><div class="avalon_td_big_image"><ul class="slides">%s</ul></div><div class="avalon_td_thumb"><div class="avalon_td_thumb_image"><ul class="slides"></ul></div></div></div>', themedoCore_Plugin::attributes( 'gallery-shortcode' ),  do_shortcode($content) );
		
		$this->gallery_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'avalon_td_gallery_wrap gallery-%s', $this->gallery_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
		$attr['id'] = sprintf( 'avalon_td_gallery_%s', $this->gallery_counter );
		
		if( self::$parent_args['id'] ) {
			$attr['id'] .= ' ' .self::$parent_args['id'];
		}
		
		/*if( self::$parent_args['slide_type'] ) {
			$attr['data-slide'] = self::$parent_args['slide_type'];
		}else{
			
		}*/
		
		$attr['data-slide'] = 'fade';
		
		if( self::$parent_args['slide_autoplay'] ) {
			$attr['data-autoplay'] = self::$parent_args['slide_autoplay'];
		}else{
			$attr['data-autoplay'] = 'on';
		}
		
		
		$attr['data-direction'] = 'horizontal';
		
		
		/*if( self::$parent_args['slide_reverse'] ) {
			$attr['data-reverse'] = self::$parent_args['slide_reverse'];
		}else{
			
		}*/
		$attr['data-reverse'] = 'off';
		
		if( self::$parent_args['slide_speed'] ) {
			$attr['data-speed'] = self::$parent_args['slide_speed'];
		}else{
			$attr['data-speed'] = '4000';
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
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
				'image'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		
		$img_url = self::$child_args['image'];
		$img_id = avalon_td_attachment_id_from_url($img_url);
		$image = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-1170-650'); //image
		$thumb = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-134-74');   //thumbnail
		

		$html = sprintf("<li data-thumb='%s'>%s<span></span></li>", $thumb, $image);

		return $html;

	}

}

new themedoSC_Gallery();