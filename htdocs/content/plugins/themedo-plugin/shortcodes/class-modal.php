<?php
class themedoSC_Modal {

	private $modal_counter = 1;

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_modal-shortcode', array( $this, 'attr' ) );
		add_filter( 'avalon_td_attr_modal-shortcode-content', array( $this, 'content_attr' ) );	
		add_filter( 'avalon_td_attr_modal-shortcode-button', array( $this, 'button_attr' ) );

		add_shortcode( 'modal', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'			   			=> '',
				'id'				 		=> '',
				'title'						=> '',
				'button_text'				=> '',
				'button_hover'		 		=> '',
				'button_size'		 		=> '',
				'opening_effect'		 	=> '',
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
		

		$html = sprintf( '<div %s>', themedoCore_Plugin::attributes( 'modal-shortcode' ));
		$html .= sprintf( '<a %s>%s</a>', themedoCore_Plugin::attributes( 'modal-shortcode-button' ), $button_text);
		$html .= sprintf( '<div %s>', themedoCore_Plugin::attributes( 'modal-shortcode-content' ));
		
		// check title
		if( self::$args['title'] ) {
			$html .= sprintf( '<h4>%s</h4> %s', $title, do_shortcode($content) );
		}
		
		$html .= '</div></div>';
		

		$this->modal_counter++;

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'modal_box';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;

	}

	
	function content_attr() {

		$attr = array();

		$attr['class'] = 'zoom-anim-dialog mfp-hide mb_popup';
		
		$attr['id'] = 'mb_popup'.$this->modal_counter;

		return $attr;

	}	

	function button_attr() {

		$attr = array();

		$attr['class'] = 'modal_button avalon_td_btn';
		$attr['data-hover'] = self::$args['button_hover'];;
		$attr['data-size'] = self::$args['button_size'];;
		$attr['data-effect'] = self::$args['opening_effect'];;
		$attr['href'] = '#mb_popup'.$this->modal_counter;

		return $attr;

	}
	
	

	
}
new themedoSC_Modal();