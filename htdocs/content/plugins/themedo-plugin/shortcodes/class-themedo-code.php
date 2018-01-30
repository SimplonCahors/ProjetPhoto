<?php
class themedoSC_themedoCode {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode('avalon_td_code', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		
		if ( base64_encode( base64_decode( $content ) ) === $content ){
			$content = base64_decode( $content );
		} else {
			//not encoded
		}
		return do_shortcode( $content );
	}

}

new themedoSC_themedoCode();