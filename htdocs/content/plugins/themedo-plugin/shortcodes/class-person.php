<?php
class themedoSC_Person {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_person-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'person', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'image'						=> '',
				'name'						=> '',
				'occ'						=> '',
				'text_align'				=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '',
				'facebook' => '', 'twitter' => '', 'instagram' => '', 'linkedin' => '', 'dribbble' => '', 'youtube' => '', 'pinterest' => '', 'flickr' => '', 'vimeo' => '', 'tumblr' => '', 'google' => '', 'googleplus' => '', 'skype' => '', 'email' => '',
				
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

		
		
		// SOCIAL LIST
		$social_list = '<ul class="social_list">';
		
		if( isset( self::$args['facebook'] ) && self::$args['facebook'] ) {
			$social_list .= '<li><a href="'.self::$args['facebook'].'" target="_blank"><i class="xcon-facebook"></i></a></li>'; 
		}
		if( isset( self::$args['twitter'] ) && self::$args['twitter'] ) {
			$social_list .= '<li><a href="'.self::$args['twitter'].'" target="_blank"><i class="xcon-twitter"></i></a></li>'; 
		}
		if( isset( self::$args['instagram'] ) && self::$args['instagram'] ) {
			$social_list .= '<li><a href="'.self::$args['instagram'].'" target="_blank"><i class="xcon-instagram"></i></a></li>'; 
		}
		if( isset( self::$args['google'] ) && self::$args['google'] ) {
			$social_list .= '<li><a href="'.self::$args['google'].'" target="_blank"><i class="xcon-gplus"></i></a></li>'; 
		}
		if( isset( self::$args['linkedin'] ) && self::$args['linkedin'] ) {
			$social_list .= '<li><a href="'.self::$args['linkedin'].'" target="_blank"><i class="xcon-linkedin"></i></a></li>'; 
		}
		if( isset( self::$args['vimeo'] ) && self::$args['vimeo'] ) {
			$social_list .= '<li><a href="'.self::$args['vimeo'].'" target="_blank"><i class="xcon-vimeo"></i></a></li>'; 
		}
		if( isset( self::$args['youtube'] ) && self::$args['youtube'] ) {
			$social_list .= '<li><a href="'.self::$args['youtube'].'" target="_blank"><i class="xcon-youtube"></i></a></li>'; 
		}
		if( isset( self::$args['flickr'] ) && self::$args['flickr'] ) {
			$social_list .= '<li><a href="'.self::$args['flickr'].'" target="_blank"><i class="xcon-flickr"></i></a></li>'; 
		}
		if( isset( self::$args['skype'] ) && self::$args['skype'] ) {
			$social_list .= '<li><a href="'.self::$args['skype'].'" target="_blank"><i class="xcon-skype"></i></a></li>'; 
		}
		if( isset( self::$args['tumblr'] ) && self::$args['tumblr'] ) {
			$social_list .= '<li><a href="'.self::$args['tumblr'].'" target="_blank"><i class="xcon-tumblr"></i></a></li>'; 
		}
		if( isset( self::$args['dribbble'] ) && self::$args['dribbble'] ) {
			$social_list .= '<li><a href="'.self::$args['dribbble'].'" target="_blank"><i class="xcon-dribbble"></i></a></li>'; 
		}
		if( isset( self::$args['email'] ) && self::$args['email'] ) {
			$social_list .= '<li><a href="'.self::$args['email'].'" target="_blank"><i class="xcon-email"></i></a></li>'; 
		}
		
		$social_list .= '</ul>';
			
		
		
		$html = sprintf( '<div %s><div class="avalon_td_member_holder">', themedoCore_Plugin::attributes( 'person-shortcode' ) );
		
		// check image
		if(self::$args['image']){
			
			$img_url = self::$args['image'];
			$img_id = avalon_td_attachment_id_from_url($img_url);
			$image = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-500-500'); //image

			$html .= '<div class="img_holder">'.$image.'</div>';
		}
		
		$html .= '<div class="title_holder"><h3>'.$name.'</h3><span>'.$occ.'</span></div><div class="content_holder"><p>'.do_shortcode($content).'</p>'.$social_list.'</div>';
		$html .= '</div></div>';
												
		

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_member';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id']; 
		}
		
		$attr['data-text-hor-pos'] = self::$args['text_align']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

}

new themedoSC_Person();