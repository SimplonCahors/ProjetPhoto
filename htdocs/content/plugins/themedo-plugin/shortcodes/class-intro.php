<?php
class themedoSC_Intro {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_intro-shortcode', array( $this, 'attr' ) );
		add_shortcode('intro', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults =	themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'			=> '',
				'id'			=> '',
				'main_text'		=> '',
				'image'			=> '',
				'button_text' 	=> '',
				'button_href' 	=> '',
				'button_hover' 	=> '',
				'todown' 		=> '',
			), $args
		);
		
		// check hashtag
		if( strpos( $defaults['todown'], '#' ) === false ) {$defaults['todown'] = '#'.$defaults['todown'];}
		

		extract( $defaults );

		self::$args = $defaults;
		
		$text = $image = $button = $innerHtml = $href = $href ='';
		
		if( self::$args['main_text'] ) {$text = self::$args['main_text'];}
		if( self::$args['image'] ) {$image = self::$args['image'];}
		if( self::$args['button_text'] ) {$button = self::$args['button_text'];}
		if( self::$args['button_href'] ) {$href = self::$args['button_href'];}
		if( self::$args['button_hover'] ) {$hover = self::$args['button_hover'];}
		
		
		$separator = '<div class="avalon_td_intro_separator">
						<div class="line_left line">
							<span class="big_bullet dot"></span>
							<span class="medium_bullet dot"></span>
							<span class="small_bullet dot"></span>
							<span class="liner"></span>
						</div>
						<div class="line_right line">
							<span class="big_bullet dot"></span>
							<span class="medium_bullet dot"></span>
							<span class="small_bullet dot"></span>
							<span class="liner"></span>
						</div>
						<div class="butterfly"><img src="'.MY_PATH.'/framework/img/butterfly.png" alt="" /></div>
					</div>';
		$link = '<a href="'. $href .'" class="avalon_td_btn" data-hover="'. $hover .'" data-size="medium">'. $button .'</a>';
		
		
		$innerHtmlw = sprintf('<h3 class="avalon_td_speacial_font">%s</h3><img src="%s" alt="" /> %s  %s', $text, $image, $separator, $link);
		
		$html = sprintf( '<div %s><div class="avalon_td_intro"><div class="avalon_td_intro_in"><div class="avalon_td_black_one">%s</div></div></div>', themedoCore_Plugin::attributes( 'intro-shortcode' ),  $innerHtmlw );		
		
		
		// todown button
		if( self::$args['todown'] ){
			
			$html .= sprintf('<div class="avalon_td_todown"><a href="%s"><span class="avalon_td_b"><i class="xcon-angle-down"></i></span><span class="avalon_td_a"><i class="xcon-down-open-big"></i></span></a></div>', self::$args['todown']);
		
		}
		
		$html .= '</div>';
		

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_heroheader';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

		return $attr;

	}

}

new themedoSC_Intro();