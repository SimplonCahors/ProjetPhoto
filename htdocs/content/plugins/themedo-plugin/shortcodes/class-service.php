<?php
class themedoSC_Service {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_service-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'service', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'image'						=> '',
				'title'						=> '',
				'subtitle'					=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '40px',
				
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

		self::$args = $defaults;
		
		// image
		$img_url = self::$args['image'];
		$img_id = avalon_td_attachment_id_from_url($img_url);
		$image = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-1000-1000'); //image
		
		
		
		$html = sprintf( '<div %s>
							<div class="image_holder tilter tilter--1">
								<figure class="tilter__figure">
									%s
									<div class="tilter__deco tilter__deco--shine"><div></div></div>
									<div class="tilter__deco tilter__deco--overlay"></div>
									<figcaption class="tilter__caption">
										<h3 class="tilter__title">%s</h3>
										<span class="tilter__description">%s</span>
									</figcaption>
									<div class="tilter__deco--lines"><span></span></div>
								</figure>	
							</div>
							<div class="content_holder"><p>%s</p></div></div>', themedoCore_Plugin::attributes( 'service-shortcode' ), $image, $title, $subtitle, do_shortcode($content) );
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_service ';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id']; 
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

	

}

new themedoSC_Service();