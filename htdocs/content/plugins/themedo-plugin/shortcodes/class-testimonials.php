<?php
class themedoSC_Testimonials {

	private $testimonials_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_testimonials-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'testimonials', array( $this, 'render_parent' ) );
		add_shortcode( 'testimonial', array( $this, 'render_child' ) );

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
				'margin_top'     	=> '0px',
				'margin_bottom'     => '0px',
				'class' 			=> '',
				'id' 				=> '',
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

		$nav = '<div class="avalon_td_nav">
					<span class="avalon_td_left"><i class="xcon-left-open-big"></i></span>
					<span class="avalon_td_right"><i class="xcon-right-open-big"></i></span>
				</div>';
				

		$html = sprintf( '<div %s><div class="avalon_td_item_in"><span class="avalon_td_quote"><i class="xcon-quote-right-alt"></i></span><div class="carouselle">%s</div>%s</div></div>', themedoCore_Plugin::attributes( 'testimonials-shortcode' ) , do_shortcode($content), $nav );

		$this->testimonials_counter++;

		return $html;

	}

	function attr() {

		$attr = array();
		
		$attr['class'] = 'testimonials';
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );	

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}

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
				'name'				=> '',
			), $args
		);


		extract( $defaults );

		self::$child_args = $defaults;	

		$html = $this->render_child_classic( $content );

		return $html;

	}
	
	/* Render classic design */
	private function render_child_classic( $content ) {
		$inner_content = '';
		
		if( self::$child_args['name'] ) {

			$inner_content .= sprintf( '<span class="t_author">%s</span>', self::$child_args['name'] );
		
		}
		
		if(do_shortcode( $content )){
			$html = sprintf( '<div class="carousel-item"><div class="xx_b"><p>%s</p></div>%s</div>', do_shortcode( $content ), $inner_content );
		
			return $html;
		}
	
	}
	
}

new themedoSC_Testimonials();