<?php
class themedoSC_Comparison {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_comparison-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'comparison', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'img1'						=> '',
				'img2'						=> '',
				'image_size'				=> '',
				'orientation'				=> '',
				'before'					=> 'Before',
				'after'						=> 'After',
				'class'						=> '',			
				'id'						=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '',
				
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
		
		
		if(self::$args['img1'] && self::$args['img2']){
			
			$img_size 	= self::$args['image_size'];
			
			$img_url_1 	= self::$args['img1'];
			$img_url_2 	= self::$args['img2'];
			
			$img_id1 = avalon_td_attachment_id_from_url($img_url_1);
			$img_id2 = avalon_td_attachment_id_from_url($img_url_2);
			
			if($img_size == '1170'){
				$image1 = avalon_td_get_image_from_id($img_id1, 'avalon_td_thumb-1170-650');
				$image2 = avalon_td_get_image_from_id($img_id2, 'avalon_td_thumb-1170-650');	
			}else{
				$image1 = '<img src="'.$img_url_1.'" alt="before" />';
				$image2 = '<img src="'.$img_url_2.'" alt="before" />';
			}			
		}
		
		
		$html = '<div class="clearfix">';
		$html .= sprintf( '</div><div %s>%s %s</div>', themedoCore_Plugin::attributes( 'comparison-shortcode' ), $image1, $image2);

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'twentytwenty-container';
		
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id']; 
		}
		
		$attr['data-orientation'] = self::$args['orientation']; 
		$attr['data-before'] = self::$args['before']; 
		$attr['data-after'] = self::$args['after']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
		
	}
	

	

}

new themedoSC_Comparison();