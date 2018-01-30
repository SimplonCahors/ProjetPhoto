<?php
class themedoSC_RecentPosts {

	public static $args;


	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'avalon_td_attr_recentposts-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'recent_posts', array( $this, 'render' ) );

	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $post, $avalon_td_option;

		$defaults = themedoCore_Plugin::set_shortcode_defaults(
			array(
				'class' 				=> '',
				'id' 					=> '',
				'margin_top' 			=> '',
				'margin_bottom' 		=> '',
				'post_number' 			=> '',
				'bg' 					=> '',
				
			), $args
		);
		
		

		extract( $defaults );

		self::$args = $defaults;		
		
		$posts = '';
		$post_number = 1;
		$published_posts = wp_count_posts()->publish;
		
		// has user inserted posts number ?
		if( self::$args['post_number'] ) {
			
			// do we have enough posts to display ?
			if($published_posts < self::$args['post_number']){
				$post_number = $published_posts;
			}else{
				$post_number = self::$args['post_number'];	
			}
		}
		
		
		if($post_number !== 1 || $post_number !== 0){
		
		
			$r = new WP_Query(array('showposts' => $post_number, 'order' => 'DESC',  'post_status' => 'publish', 'post_type' => 'post', 'ignore_sticky_posts' => '1'));
			if ($r->have_posts()) : while ($r->have_posts()) : $r->the_post();
			
				// category
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if ( ! empty( $categories ) ) {
					foreach( $categories as $category ) {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
					}
					$output = trim( $output, $separator );
				}
				
				// comments
				$comments = '';
				if ( !post_password_required() ){ 
					ob_start();
					comments_popup_link( __( 'No Comment', 'themedo-core' ),__( '1 Comment', 'themedo-core' ),__( '% Comments', 'themedo-core' ),'',__( 'Off', 'themedo-core' ),__( 'Off', 'themedo-core' )); 
					$comments = ob_get_contents();
					ob_get_clean();
				}else{
					$comments = '<i class="icon-lock"></i>'; 
				}
				
			
			
				$posts .= '<div class="item_holder '.$post_number.'">
									<div class="img_holder">'. avalon_td_get_thumbnail('585', '600', $post->ID) .'</div>
									<div class="content_holder">
										<div class="avalon_td_holder_in">
											<div>
												<h4><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h4>
												<span class="sub"><span>'.$output .' / '.get_the_time('M d, Y', $post->ID).' / '.$comments.'</span></span>
												<p>'. avalon_td_excerpt(15) .'</p>
												<a href="'.get_permalink($post->ID).'" class="read_more">'.__("Read More", "themedo-core").'</a>
											</div>
										</div>
									</div>
								</div>';
			
			endwhile; endif; wp_reset_postdata();
			
			$nav = '<div class="avalon_td_nav">
						<span class="avalon_td_left"><i class="xcon-left-open-big"></i></span>
						<span class="avalon_td_right"><i class="xcon-right-open-big"></i></span>
					</div>';
		
			$html = sprintf( '<div %s><div class="avalon_td_carousel">%s</div>%s</div>', themedoCore_Plugin::attributes( 'recentposts-shortcode' ), $posts, $nav );
	
			wp_reset_query();
		}else{
			$html = "<p>You don't have enough of posts to display here. Make sure they are more than two at least</p>";
		}
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'avalon_td_blog_intro';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		if( self::$args['id'] ) {
			$attr['id'] = self::$args['id'];
		}

        
		$img_url = '';
		$img_url = self::$args['bg'];
		
		$attr['style'] = sprintf( 'background:url("%s") no-repeat; margin-top:%s; margin-bottom:%s;', $img_url, self::$args['margin_top'], self::$args['margin_bottom']);
		
		
		return $attr;

	}	
}

new themedoSC_RecentPosts();