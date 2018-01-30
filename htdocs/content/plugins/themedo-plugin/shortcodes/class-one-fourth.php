<?php
class themedoSC_OneFourth {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_one-fourth-shortcode', array( $this, 'attr' ) );
		add_filter( 'avalon_td_attr_one-fourth-shortcode-wrapper', array( $this, 'wrapper_attr' ) );		
		add_shortcode( 'one_fourth', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $avalon_td_option;

		$defaults =	shortcode_atts(
			array(
				'class'					=> '',
				'id'					=> '',				
				'last'  				=> 'no',
				'margin_top'			=> '0px',
				'margin_bottom'			=> '0px',
			), $args
		);

		extract( $defaults );

		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}

		self::$args = $defaults;
		
		// After the last column we need a clearing div
		$clearfix = '';
		if ( self::$args['last'] == 'yes' ) {
			$clearfix = sprintf( '<div %s></div>', themedoCore_Plugin::attributes( 'themedo-clearfix' ) );
		}	

		$inner_content = do_shortcode( $content );


		// Setup the main markup
		$html = sprintf( '<div %s>%s</div>%s', themedoCore_Plugin::attributes( 'one-fourth-shortcode' ), $inner_content, $clearfix );

		return $html;

	}

	function attr() {

		$attr['class'] = 'td-col-3 themedo-layout-column';
			
		// Set the last class on the rightmost column to supress margin
		if ( self::$args['last'] == 'yes' ) {
			$attr['class'] .= ' last';
		}

		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );

		
		// User specific class and id
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}	

		return $attr;

	}
}

new themedoSC_OneFourth();