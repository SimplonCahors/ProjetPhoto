<?php
class themedoSC_Accordion {

	private $accordion_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_accordion-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'accordion', array( $this, 'render_parent' ) );
		add_shortcode( 'acc', array( $this, 'render_child' ) );

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
				'skin'				=> 'light',
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

		
		$html = sprintf( '<div %s>%s</div>', themedoCore_Plugin::attributes( 'accordion-shortcode' ), do_shortcode($content));

		$this->accordion_counter++;

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'avalon_td_accordion avalon_td_accordion_%s', $this->accordion_counter);



		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
		$attr['data-skin'] = self::$parent_args['skin'];
			
		
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
				'open' 			=> 'no',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		if($open == "yes"){
			$openme = "acc_active";	
		}else{
			$openme = "";		
		}
		

		$html = sprintf( '<div class="accordion_in %s"><div class="acc_head">%s</div><div class="acc_content">%s</div></div>', $openme, $title, do_shortcode( $content ) );

		return $html;

	}

}

new themedoSC_Accordion();