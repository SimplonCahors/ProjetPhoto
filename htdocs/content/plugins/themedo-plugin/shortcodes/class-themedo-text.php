<?php
class themedoSC_themedoText {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode('avalon_td_text', array( $this, 'render' ) );

		add_filter( 'avalon_td_text_content', 'shortcode_unautop' );
		add_filter( 'avalon_td_text_content', 'do_shortcode' );
	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		return apply_filters( 'avalon_td_text_content', wpautop( $content, false ) );
	}

}

new themedoSC_themedoText();