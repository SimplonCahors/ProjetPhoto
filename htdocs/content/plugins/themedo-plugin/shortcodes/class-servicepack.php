<?php
class themedoSC_Servicepack {

	public static $parent_args;
	public static $child_args;
	private $sp_counter = 1;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_servicepack-shortcode', array( $this, 'parent_attr' ) );
		add_filter( 'avalon_td_attr_sp-shortcode', array( $this, 'child_attr' ) );
		
		
		add_shortcode( 'servicepack', array( $this, 'render_parent' ) );
		add_shortcode( 'sp', array( $this, 'render_child' ) );

	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '' ) {
		global $avalon_td_option;

		$defaults =	themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class'				=> '',			
				'id'				=> '',
				'image'				=> '',
				'title'				=> '',
				'duration'			=> '',
				'totalcost'			=> '',
				'booking'			=> '',
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
		
	
		// image
		$img_url = self::$parent_args['image'];
		$img_id = avalon_td_attachment_id_from_url($img_url);
		$image = avalon_td_get_image_from_id($img_id, 'avalon_td_thumb-570-450'); //image
		
		// duration
		$dur = __('Time Duration : ','themedo-core').' '.$duration;
		
		// totalcost
		$total = __('Total Cost : ','themedo-core').' '.$totalcost;
		
		// booking
		if(self::$parent_args['booking'] == 'on'){
			
			$exlink = $classy = $mylink = "";
			$booktype = $avalon_td_option['book_type'];
			
			
			if($booktype == 'in'){
				$classy = 'popup';
				$mylink = '#booking_popup';
			}else if($booktype == 'ex'){
				$exlink = $avalon_td_option['book_external'];
				$mylink = $exlink;
			}else{
				$classy = 'popup';
				$mylink = '#booking_popup';	
			}
			
			$book = '<a class="avalon_td_btn avalon_td_booking '.esc_html($classy).'" href="'.$mylink.'" data-hover="on" data-effect="'.esc_attr($avalon_td_option['book_open_type']).'">'.__('Make Reservation','themedo-core').'</a>';
			
			
		}else{
			$book = '';	
		}
		
		
		$html = sprintf( '<div %s><header class="avalon_td_pack_header">%s</header><footer class="avalon_td_pack_footer"><div class="avalon_td_pack_footer_in"><div class="avalon_td_pack_title"><h3>%s</h3><span>%s</span></div><div class="avalon_td_pack_content"><ul class="avalon_td_pack_includes">%s</ul><span class="avalon_td_pack_total">%s</span>%s</div></div></footer></div>', themedoCore_Plugin::attributes( 'servicepack-shortcode' ), $image, self::$parent_args['title'], $dur,  do_shortcode( $content ), $total, $book);

		return $html;

	}

	function parent_attr() {

		$attr['class'] = 'avalon_td_service_pack';

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

		if( self::$parent_args['id'] ) {
			$attr['id'] = self::$parent_args['id'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );

		return $attr;

	}



	/**
	 * Render the child shortcode
	 * 
	 * @param  array  $args	 Shortcode paramters
	 * @param  string $content  Content between shortcode
	 * @return string		   HTML output
	 */
	function render_child( $args, $content = '' ) {
		global $avalon_td_option;

		$defaults =	themedoCore_Plugin::set_shortcode_defaults(
			array(
				'title'			=> '',
				'price'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;


		$html = sprintf( '<li><span>%s <span>%s</span></span></li>', self::$child_args['title'], $price );
		
		$this->sp_counter++;

		return $html;

	}
	

}

new themedoSC_Servicepack();
