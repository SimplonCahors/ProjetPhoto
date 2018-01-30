<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/

// Number of posts array
function avalon_td_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 ) {
	if( $all ) {
		$number_of_posts['-1'] = 'All';
	}

	if( $default ) {
		$number_of_posts[''] = 'Default';
	}

	foreach( range( $range_start, $range ) as $number ) {
		$number_of_posts[$number] = $number;
	}

	return $number_of_posts;
}

// Taxonomies
function avalon_td_shortcodes_categories ( $taxonomy, $empty_choice = false, $empty_choice_label = 'Default' ) {
	$post_categories = array();
	if( $empty_choice == true ) {
		$post_categories[''] = $empty_choice_label;
	}

	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

	if( ! is_wp_error( $get_categories ) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
				if( array_key_exists('slug', $cat) && 
					array_key_exists('name', $cat) 
				) {
					$post_categories[$cat->slug] = $cat->name;
				}
			}
		}

		if( isset( $post_categories ) ) {
			return $post_categories;
		}
	}
}

$choices = array( 'yes' => __('Yes', 'themedo-core'), 'no' => __('No', 'themedo-core') );
$reverse_choices = array( 'no' => __('No', 'themedo-core'), 'yes' => __('Yes', 'themedo-core') );
$choices_with_default = array( '' => __('Default', 'themedo-core'), 'yes' => __('Yes', 'themedo-core'), 'no' => __('No', 'themedo-core') );
$reverse_choices_with_default = array( '' => __('Default', 'themedo-core'), 'no' => __('No', 'themedo-core'), 'yes' => __('Yes', 'themedo-core') );
$leftright = array( 'left' => __('Left', 'themedo-core'), 'right' => __('Right', 'themedo-core') );
$dec_numbers = array( '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' );
$animation_type = array(
                    '0'             => __( 'None', 'themedo-core' ),
                    'bounce'         => __( 'Bounce', 'themedo-core' ),
                    'fade'             => __( 'Fade', 'themedo-core' ),
                    'flash'         => __( 'Flash', 'themedo-core' ),
                    'rubberBand'     => __( 'Rubberband', 'themedo-core' ),                    
                    'shake'            => __( 'Shake', 'themedo-core' ),
                    'slide'         => __( 'Slide', 'themedo-core' ),
                    'zoom'             => __( 'Zoom', 'themedo-core' ),
                );
$animation_direction = array(
                    'down'         => __( 'Down', 'themedo-core' ),
                    'left'         => __( 'Left', 'themedo-core' ),
                    'right'     => __( 'Right', 'themedo-core' ),
                    'up'         => __( 'Up', 'themedo-core' ),
                    'static'     => __( 'Static', 'themedo-core' ),
                );

// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = avalon_td_TINYMCE_DIR . '/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	@$subject = file_get_contents( $fontawesome_path );
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	$icons[$match[1]] = $match[2];
}

$checklist_icons = array ( 'icon-check' => '\f00c', 'icon-star' => '\f006', 'icon-angle-right' => '\f105', 'icon-asterisk' => '\f069', 'icon-remove' => '\f00d', 'icon-plus' => '\f067' );

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Alert Type', 'themedo-core' ),
			'desc' => __( 'Select the type of alert message. Choose custom for advanced color options below.', 'themedo-core' ),
			'options' => array(
				'general' => __('General', 'themedo-core'),
				'error' => __('Error', 'themedo-core'),
				'success' => __('Success', 'themedo-core'),
				'notice' => __('Notice', 'themedo-core'),
				'custom' => __('Custom', 'themedo-core'),
			)
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Set the border, text and icon color for custom alert boxes.', 'themedo-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Set the background color for custom alert boxes.', 'themedo-core')
		),
		'bordersize' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'themedo-core' ),
			'desc' => __('Custom setting only. For custom alert boxes. In pixels (px), ex: 1px.', 'themedo-core')
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Click an icon to select, click again to deselect', 'themedo-core' ),
			'options' => $icons
		),
		'boxshadow' => array(
			'type' => 'select',
			'label' => __( 'Box Shadow', 'themedo-core' ),
			'desc' =>  __( 'Display a box shadow below the alert box.', 'themedo-core' ),
			'options' => $choices
		),		
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'themedo-core' ),
			'desc' => __( 'Insert the alert\'s content', 'themedo-core' ),
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'themedo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'themedo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'themedo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'themedo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'themedo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'themedo-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),		
	),
	'shortcode' => '[alert type="{{type}}" accent_color="{{accentcolor}}" background_color="{{backgroundcolor}}" border_size="{{bordersize}}" icon="{{icon}}" box_shadow="{{boxshadow}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]{{content}}[/alert]',
	'popup_title' => __( 'Alert Shortcode', 'themedo-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['blog'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Blog Layout', 'themedo-core' ),
			'desc' => __( 'Select the layout for the blog shortcode', 'themedo-core' ),
			'options' => array(
				'large' => __('Large', 'themedo-core'),
				'medium' => __('Medium', 'themedo-core'),
				'large alternate' => __('Large Alternate', 'themedo-core'),
				'medium alternate' => __('Medium Alternate', 'themedo-core'),
				'grid' => __('Grid', 'themedo-core'),
				'timeline' => __('Timeline', 'themedo-core')
			)
		),
		'posts_per_page' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'themedo-core' ),
			'desc' => __( 'Select number of posts per page.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_range( 25, true, true )
		),
		'offset' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Post Offset', 'themedo-core' ),
			'desc' => __('The number of posts to skip. ex: 1.', 'themedo-core')
		),			
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'themedo-core' ),
			'desc' => __( 'Select a category or leave blank for all.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_categories( 'category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'themedo-core' ),
			'desc' => __( 'Select a category to exclude.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_categories( 'category' )
		),
		'title' => array(
			'type' => 'select',
			'label' => __( 'Show Title', 'themedo-core' ),
			'desc' =>  __( 'Display the post title below the featured image.', 'themedo-core' ),
			'options' => $choices
		),
		'title_link' => array(
			'type' => 'select',
			'label' => __( 'Link Title To Post', 'themedo-core' ),
			'desc' =>  __( 'Choose if the title should be a link to the single post page.', 'themedo-core' ),
			'options' => $choices
		),		
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Show Thumbnail', 'themedo-core' ),
			'desc' =>  __( 'Display the post featured image.', 'themedo-core' ),
			'options' => $choices
		),
		'excerpt' => array(
			'type' => 'select',
			'label' => __( 'Show Excerpt', 'themedo-core' ),
			'desc' =>  __( 'Show excerpt or choose "no" for full content.', 'themedo-core' ),
			'options' => $choices
		),
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Number of words/characters in Excerpt', 'themedo-core' ),
			'desc' =>  __( 'Controls the excerpt length based on words or characters that is set in Theme Options > Extra.', 'themedo-core' ),
		),
		'meta_all' => array(
			'type' => 'select',
			'label' => __( 'Show Meta Info', 'themedo-core' ),
			'desc' =>  __( 'Choose to show all meta data.', 'themedo-core' ),
			'options' => $choices
		),
		'meta_author' => array(
			'type' => 'select',
			'label' => __( 'Show Author Name', 'themedo-core' ),
			'desc' =>  __( 'Choose to show the author.', 'themedo-core' ),
			'options' => $choices
		),
		'meta_categories' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'themedo-core' ),
			'desc' =>  __( 'Choose to show the categories.', 'themedo-core' ),
			'options' => $choices
		),
		'meta_comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comment Count', 'themedo-core' ),
			'desc' =>  __( 'Choose to show the comments.', 'themedo-core' ),
			'options' => $choices
		),
		'meta_date' => array(
			'type' => 'select',
			'label' => __( 'Show Date', 'themedo-core' ),
			'desc' =>  __( 'Choose to show the date.', 'themedo-core' ),
			'options' => $choices
		),
		'meta_link' => array(
			'type' => 'select',
			'label' => __( 'Show Read More Link', 'themedo-core' ),
			'desc' =>  __( 'Choose to show the Read More link.', 'themedo-core' ),
			'options' => $choices
		),
		'meta_tags' => array(
			'type' => 'select',
			'label' => __( 'Show Tags', 'themedo-core' ),
			'desc' =>  __( 'Choose to show the tags.', 'themedo-core' ),
			'options' => $choices
		),
		'paging' => array(
			'type' => 'select',
			'label' => __( 'Show Pagination', 'themedo-core' ),
			'desc' =>  __( 'Show numerical pagination boxes.', 'themedo-core' ),
			'options' => $choices
		),
		'scrolling' => array(
			'type' => 'select',
			'label' => __( 'Pagination Type', 'themedo-core' ),
			'desc' =>  __( 'Choose the type of pagination.', 'themedo-core' ),
			'options' => array(
				'pagination' => __('Pagination', 'themedo-core'),
				'infinite' => __('Infinite Scrolling', 'themedo-core'),
				'load_more_button' => __('Load More Button', 'themedo-core')
			)
		),
		'blog_grid_columns' => array(
			'type' => 'select',
			'label' => __( 'Grid Layout # of Columns', 'themedo-core' ),
			'desc' => __( 'Select whether to display the grid layout in 2, 3 or 4 column.', 'themedo-core' ),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			)
		),
		'blog_grid_column_spacing' => array(
			'std' => '40',
			'type' => 'text',
			'label' => __( 'Grid Layout Column Spacing', 'themedo-core' ),
			'desc' => __( 'Insert the amount of spacing between blog grid posts without "px".', 'themedo-core' )
		),			
		'strip_html' => array(
			'type' => 'select',
			'label' => __( 'Strip HTML from Posts Content', 'themedo-core' ),
			'desc' =>  __( 'Strip HTML from the post excerpt.', 'themedo-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),		
	),
	'shortcode' => '[blog number_posts="{{posts_per_page}}" offset="{{offset}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" title="{{title}}" title_link="{{title_link}}" thumbnail="{{thumbnail}}" excerpt="{{excerpt}}" excerpt_length="{{excerpt_length}}" strip_html="{{strip_html}}" meta_all="{{meta_all}}" meta_author="{{meta_author}}" meta_categories="{{meta_categories}}" meta_comments="{{meta_comments}}" meta_date="{{meta_date}}" meta_link="{{meta_link}}" meta_tags="{{meta_tags}}" paging="{{paging}}" scrolling="{{scrolling}}" blog_grid_columns="{{blog_grid_columns}}" blog_grid_column_spacing="{{blog_grid_column_spacing}}" layout="{{layout}}" class="{{class}}" id="{{id}}"][/blog]',
	'popup_title' => __( 'Blog Shortcode', 'themedo-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button URL', 'themedo-core' ),
			'desc' => __( 'Add the button\'s url ex: http://example.com.', 'themedo-core' )
		),
		'style' => array(
			'type' => 'select',
			'label' => __( 'Button Style', 'themedo-core' ),
			'desc' => __( 'Select the button\'s color. Select default or color name for theme options, or select custom to use advanced color options below.', 'themedo-core' ),
			'options' => array(
				'default' => __('Default', 'themedo-core'),
				'custom' => __('Custom', 'themedo-core'),
				'green' => __('Green', 'themedo-core'),
				'darkgreen' => __('Dark Green', 'themedo-core'),
				'orange' => __('Orange', 'themedo-core'),
				'blue' => __('Blue', 'themedo-core'),
				'red' => __('Red', 'themedo-core'),
				'pink' => __('Pink', 'themedo-core'),
				'darkgray' => __('Dark Gray', 'themedo-core'),
				'lightgray' => __('Light Gray', 'themedo-core'),
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'themedo-core' ),
			'desc' => __( 'Select the button\'s size. Choose default for theme option selection.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'small' => __('Small', 'themedo-core'),
				'medium' => __('Medium', 'themedo-core'),
				'large' => __('Large', 'themedo-core'),
				'xlarge' => __('XLarge', 'themedo-core'),
			)
		),
		'type' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'themedo-core' ),
			'desc' => __( 'Select the button\'s type. Choose default for theme option selection.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'flat' => __('Flat', 'themedo-core'),
				'3d' => '3D',
			)
		),
		'shape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'themedo-core' ),
			'desc' => __( 'Select the button\'s shape. Choose default for theme option selection.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'square' => __('Square', 'themedo-core'),
				'pill' => __('Pill', 'themedo-core'),
				'round' => __('Round', 'themedo-core'),
			)
		),				
		'target' => array(
			'type' => 'select',
			'label' => __( 'Button Target', 'themedo-core' ),
			'desc' => __( '_self = open in same window <br />_blank = open in new window.', 'themedo-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Title Attribute', 'themedo-core' ),
			'desc' => __( 'Set a title attribute for the button link.', 'themedo-core' ),
		),
		'content' => array(
			'std' => __('Button Text', 'themedo-core'),
			'type' => 'text',
			'label' => __( 'Button\'s Text', 'themedo-core' ),
			'desc' => __( 'Add the text that will display in the button.', 'themedo-core' ),
		),
		'gradtopcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Set the top color of the button background.', 'themedo-core' )
		),
		'gradbottomcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Set the bottom color of the button background or leave empty for solid color.', 'themedo-core' )
		),
		'gradtopcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color Hover', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Set the top hover color of the button background.', 'themedo-core' )
		),
		'gradbottomcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color Hover', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Set the bottom hover color of the button background or leave empty for solid color.', 'themedo-core' )
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'themedo-core' ),
			'desc' => __( 'Custom setting only. This option controls the color of the button border, divider, text and icon.', 'themedo-core' )
		),
		'accenthovercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Hover Color', 'themedo-core' ),
			'desc' => __( 'Custom setting only. This option controls the hover color of the button border, divider, text and icon.', 'themedo-core' )
		),		
		'bevelcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Bevel Color (3D Mode only)', 'themedo-core' ),
			'desc' => __( 'Custom setting only. Set the bevel color of 3D buttons.', 'themedo-core' )
		),		
		'borderwidth' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'themedo-core' ),
			'desc' => __( 'Custom setting only. In pixels (px), ex: 1px.  Leave blank for theme option selection.', 'themedo-core' )
		),
		/*
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'themedo-core' ),
			'desc' => __('Custom setting. Backside.', 'themedo-core')
		),
		'borderhovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Hover Color', 'themedo-core' ),
			'desc' => __('Custom setting. Backside.', 'themedo-core')
		),		
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Color', 'themedo-core' ),
			'desc' => __('Custom setting. Backside.', 'themedo-core')
		),
		'texthovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Hover Color', 'themedo-core' ),
			'desc' => __('Custom setting. Backside.', 'themedo-core')
		),
		*/
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'themedo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'themedo-core' ),
			'options' => $icons
		),
		/*
		'iconcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Icon Color', 'themedo-core' ),
			'desc' => __('Custom setting. Leave blank for theme option selection.', 'themedo-core')
		),
		*/
		'iconposition' => array(
			'type' => 'select',
			'label' => __( 'Icon Position', 'themedo-core' ),
			'desc' => __( 'Choose the position of the icon on the button.', 'themedo-core' ),
			'options' => $leftright
		),			
		'icondivider' => array(
			'type' => 'select',
			'label' => __( 'Icon Divider', 'themedo-core' ),
			'desc' => __( 'Choose to display a divider between icon and text.', 'themedo-core' ),
			'options' => $choices
		),
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Window Anchor', 'themedo-core' ),
			'desc' => __( 'Add the class name of the modal window you want to open on button click.', 'themedo-core' ),
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'themedo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'themedo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'themedo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'themedo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'themedo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'themedo-core' ),
			'options' => $dec_numbers,
		),
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'themedo-core' ),
			'desc' => __( 'Select the button\'s alignment.', 'themedo-core' ),
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'center' => __('Center', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),			
	),
	'shortcode' => '[button link="{{url}}" color="{{style}}" size="{{size}}" type="{{type}}" shape="{{shape}}" target="{{target}}" title="{{title}}" gradient_colors="{{gradtopcolor}}|{{gradbottomcolor}}" gradient_hover_colors="{{gradtopcolorhover}}|{{gradbottomcolorhover}}" accent_color="{{accentcolor}}" accent_hover_color="{{accenthovercolor}}" bevel_color="{{bevelcolor}}" border_width="{{borderwidth}}" icon="{{icon}}" icon_divider="{{icondivider}}" icon_position="{{iconposition}}" modal="{{modal}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]{{content}}[/button]',
	'popup_title' => __( 'Button Shortcode', 'themedo-core')
);


/*-----------------------------------------------------------------------------------*/
/*	Brochure Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['brochure'] = array(
	'params' => array(
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),
	),
	'shortcode' => '[brochures margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/brochures]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Download Link', 'themedo-core' ),
				'desc' => __( 'Insert link to download brochure', 'themedo-core')
			),
			'icon' => array(
				'std' => '0',
				'type' => 'select',
				'label' => __( 'Icon', 'themedo-core' ),
				'desc' => __( 'Choose icon for brochure type', 'themedo-core' ),
				'options' => array(
									'pdf'			=> "Pdf",
									'archive'	 	=> "Archive",
									'word'	 		=> "Word",
									'audio'	 		=> "Audio",
									'video'	 		=> "Video",
									'powerpoint'	=> "Powerpoint",
									'excel'	 		=> "Excel",)
								
			),			
					
			'content' => array(
				'std' => __('Text', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Brochure Text', 'themedo-core' ),
				'desc' => __( 'Insert text for brochure', 'themedo-core' ),
			)
		),
		'shortcode' => '[brochure link="{{link}}" icon="{{icon}}"]{{content}}[/brochure]',
		'clone_button' => __( 'Add New', 'themedo-core')
	)
);



/*-----------------------------------------------------------------------------------*/
/*	Checklist Config
/*-----------------------------------------------------------------------------------*/
$avalon_td_shortcodes['checklist'] = array(
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'themedo-core' ),
			'desc' => __( 'Global setting for all list items, this can be overridden individually below. Click an icon to select, click again to deselect.', 'themedo-core' ),
			'options' => $icons
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'themedo-core' ),
			'desc' => __( 'Global setting for all list items. Leave blank for theme option selection. Defines the icon color.', 'themedo-core')
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'themedo-core' ),
			'desc' => __( 'Global setting for all list items. Set to default for theme option selection. Choose to have icons in circles.', 'themedo-core' ),
			'options' => $choices_with_default
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Circle Color', 'themedo-core' ),
			'desc' => __( 'Global setting for all list items. Leave blank for theme option selection. Defines the circle color.', 'themedo-core')
		),
		'size' => array(
			'std' => '13px',
			'type' => 'text',
			'label' => __( 'Item Size', 'themedo-core' ),
			'desc' => __( 'Select the list item\'s size. In pixels (px), ex: 13px.', 'themedo-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),		
	),

	'shortcode' => '[checklist icon="{{icon}}" iconcolor="{{iconcolor}}" circle="{{circle}}" circlecolor="{{circlecolor}}" size="{{size}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/checklist]',
	'popup_title' => __( 'Checklist Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Select Icon', 'themedo-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'themedo-core' ),
				'options' => $icons
			),				
			'content' => array(
				'std' => __('Your Content Goes Here', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'List Item Content', 'themedo-core' ),
				'desc' => __( 'Add list item content', 'themedo-core' ),
			),
		),
		'shortcode' => '[li_item icon="{{icon}}"]{{content}}[/li_item]',
		'clone_button' => __( 'Add New List Item', 'themedo-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Client Slider Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['clients'] = array(
	'no_preview' => true,
	'params' => array(
		'client_type' => array(
			'std' 		=> 	'b',
			'type'		=> 	'select',
			'label' 	=> 	__( 'Client Template', 'themedo-core' ),
			//'desc' 		=> 	__( '', 'themedo-core' ),
			'options' 	=> 	array(
				'a' 	=> 'A',
				'b'    	=> 'B',
				'c'    	=> 'C',
				'd'    	=> 'D',
				'e'    	=> 'E',
			)
		),
		'client_col' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Client Columns', 'themedo-core' ),
			//'desc' 		=> 	__( '', 'themedo-core' ),
			'std' 		=> 	'5',
			'options' 	=> 	array(
				'1' 		=> '1',
				'2' 		=> '2',
				'3' 		=> '3',
				'4' 		=> '4',
				'5' 		=> '5',
				'6' 		=> '6',
			)
		),
		'client_color' => array(
			'std' => '#000000',
			'type' => 'colorpicker',
			'label' => __( 'Color', 'themedo-core' ),
			//'desc' => __( '', 'themedo-core' )
		),
		'client_opacity' => 	array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Color Transparency', 'themedo-core' ),
			//'desc' 		=> 	__( '', 'themedo-core' ),
			'std' 		=> 	'0.9',
			'options' 	=> 	array(
				'0' 		=> '0',
				'0.1' 		=> '0.1',
				'0.2' 		=> '0.2',
				'0.3' 		=> '0.3',
				'0.4' 		=> '0.4',
				'0.5' 		=> '0.5',
				'0.6' 		=> '0.6',
				'0.7' 		=> '0.7',
				'0.8' 		=> '0.8',
				'0.9' 		=> '0.9',
				'1' 		=> '1',
			)
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[clients client_type="{{client_type}}" client_col="{{client_col}}" client_color="{{client_color}}" client_opacity="{{client_opacity}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/clients]',
	'popup_title' => __('Insert Shortcode', 'themedo-core'),

	'child_shortcode' => array(
		'params' => array(
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Client Link', 'themedo-core' ),
				//'desc' => __( '', 'themedo-core' )
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'themedo-core' ),
				'desc' => __('Upload an image to display in the tab.', 'themedo-core')
			),
		),
		'shortcode' => '[client image="{{image}}" image="{{image}}"]',
		'clone_button' => __( 'Add More', 'themedo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Code Block Config
/*-----------------------------------------------------------------------------------*/

/*$avalon_td_shortcodes['code'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => 'Click edit button to change this code.',
			'type' => 'textarea',
			'label' => __( 'Code', 'themedo-core' ),
			'desc' => __( 'Enter some content for this codeblock', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[avalon_td_code class="{{class}}" id="{{id}}"]{{content}}[/avalon_td_code]',
	'popup_title' => __( 'Code Block Shortcode', 'themedo-core' )
);*/


/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['columns'] = array(
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Columns Shortcode', 'themedo-core' ),
	'no_preview' => true,
	'params' => array(),

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __( 'Column Type', 'themedo-core' ),
				'desc' => __( 'Select the width of the column', 'themedo-core' ),
				'options' => array(
					'one_full'		=> __('One Column', 'themedo-core'),
					'one_half' 		=> __('One Half', 'themedo-core'),
					'one_third' 	=> __('One Third', 'themedo-core'),
					'two_third' 	=> __('Two Thirds', 'themedo-core'),
					'one_fourth'	=> __('One Fourth', 'themedo-core'),
					'three_fourth' 	=> __('Three Fourth', 'themedo-core'),	
					'one_fifth' 	=> __('One Fifth', 'themedo-core'),
					'two_fifth' 	=> __('Two Fifth', 'themedo-core'),
					'three_fifth' 	=> __('Three Fifth', 'themedo-core'),
					'four_fifth' 	=> __('Four Fifth', 'themedo-core'),
					'one_sixth' 	=> __('One Sixth', 'themedo-core'),
					'five_sixth' 	=> __('Five Sixth', 'themedo-core'),
					'one' 	        => __('One ( Six Sixth )', 'themedo-core'),
				)
			),
			'last' => array(
				'type' => 'select',
				'label' => __( 'Last Column', 'themedo-core' ),
				'desc' => __('Choose if the column is last in a set. This has to be set to "Yes" for the last column in a set', 'themedo-core'),
				'options' => $reverse_choices
			),
			'margin_top' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Margin Top', 'themedo-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'themedo-core' )
			),
			'margin_bottom' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Margin Bottom', 'themedo-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'themedo-core' )
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Column Content', 'themedo-core' ),
				'desc' => __( 'Insert the column content', 'themedo-core' ),
			),
			'class' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS Class', 'themedo-core' ),
				'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
			),
			'id' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS ID', 'themedo-core' ),
				'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
			),			
		),
		'shortcode' => '[{{column}} last="{{last}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/{{column}}] ',
		'clone_button' => __( 'Add Column', 'themedo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Content Boxes Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['contentboxes'] = array(
	'params' => array(
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Box Layout', 'themedo-core' ),
			'desc' => __( 'Select the layout for the content box', 'themedo-core' ),
			'options' => array(
				'icon-with-title' => __('Classic Icon With Title', 'themedo-core'),
				'icon-on-top' => __('Classic Icon On Top', 'themedo-core'),
				'icon-on-side' => __('Classic Icon On Side', 'themedo-core'),
				'icon-boxed' => __('Icon Boxed', 'themedo-core'),
				'clean-vertical' => __('Clean Layout Vertical', 'themedo-core'),
				'clean-horizontal' => __('Clean Layout Horizontal', 'themedo-core'),
				'timeline-vertical' => __('Timeline Vertical', 'themedo-core'),
				'timeline-horizontal' => __('Timeline Horizontal', 'themedo-core')
			)
		),
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'themedo-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_range( 6, false )
		),
		'icon_align' => array(
			'std' => 'left',
			'type' => 'select',
			'label' => __( 'Content Alignment', 'themedo-core' ),
			'desc' =>  __( 'Works with "Classic Icon With Title" and "Classic Icon On Side" layout options.' ),
			'options' => array('left'		=> 'Left',
							   'right'	 	=> 'Right') 
		),
		'title_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title Size', 'themedo-core' ),
			'desc' => __( 'Controls the size of the title. Leave blank for theme option selection. In pixels ex: 18px.', 'themedo-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Content Box Background Color', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
		),
		'icon_circle' => array(
			'type' => 'select',
			'label' => __( 'Icon Background', 'themedo-core' ),
			'desc' => __( 'Controls the background behind the icon. Select default for theme option selection.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'yes' => __('Yes', 'themedo-core'),
				'no' => __('No', 'themedo-core'),
			)
		),
		'icon_circle_radius' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Radius', 'themedo-core' ),
			'desc' => __( 'Choose the border radius of the icon background. Leave blank for theme option selection. In pixels (px), ex: 1px, or "round".', 'themedo-core')
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Color', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
		),
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Inner Border Color', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
		),
		'circlebordercolorsize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Inner Border Size', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
		),
		'outercirclebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Outer Border Color', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
		),
		'outercirclebordercolorsize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Outer Border Size', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
		),
		'icon_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Size', 'themedo-core' ),
			'desc' => __( 'Controls the size of the icon.  Leave blank for theme option selection. In pixels ex: 18px.', 'themedo-core')
		),
		'link_type' => array(
			'type' => 'select',
			'label' => __( 'Link Type', 'themedo-core' ),
			'desc' => __( 'Select the type of link that should show in the content box. Select default for theme option selection.', 'themedo-core' ),
			'options' => array(
				''	=> 'Default',
				'text' => 'Text',
				'button-bar' => 'Button Bar',
				'button' => 'Button'
			)
		),
		'link_area' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Link Area', 'themedo-core' ),
			'desc' =>  __( 'Select which area the link will be assigned to' ),
			'options' => array('' => 'Default',
								'link-icon'		=> 'Link+Icon',
							   'box'	 		=> 'Entire Content Box') 
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'themedo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'themedo-core' ),
			'options' => array(
				''	=> 'Default',
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'animation_delay' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Animation Delay', 'themedo-core' ),
			'desc' => __( 'Controls the delay of animation between each element in a set. In milliseconds.', 'themedo-core')
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'themedo-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'themedo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'themedo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'themedo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'themedo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'themedo-core' ),
			'options' => $dec_numbers,
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'In pixels (px), ex: 10px.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'In pixels (px), ex: 10px.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),			
	),
	'shortcode' => '[content_boxes layout="{{layout}}" columns="{{columns}}" icon_align="{{icon_align}}" title_size="{{title_size}}" backgroundcolor="{{backgroundcolor}}" icon_circle="{{icon_circle}}" icon_circle_radius="{{icon_circle_radius}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" circlebordercolorsize="{{circlebordercolorsize}}" outercirclebordercolor="{{circlebordercolor}}" outercirclebordercolorsize="{{outercirclebordercolorsize}}" icon_size="{{icon_size}}" link_type="{{link_type}}" link_area="{{link_area}}" animation_delay="{{animation_delay}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" margin_top="{{margin_top}}" margin_bottom="{{margin_top}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/content_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Content Boxes Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'themedo-core'),
				'desc' => __( 'The box title.', 'themedo-core' ),
			),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'themedo-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'themedo-core' ),
				'options' => $icons
			),
			'backgroundcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Content Box Background Color', 'themedo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
			),
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'themedo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
			),
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Color', 'themedo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Inner Border Color', 'themedo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
			),
			'circlebordercolorsize' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Icon Background Inner Border Size', 'themedo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
			),
			'outercirclebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Outer Border Color', 'themedo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
			),
			'outercirclebordercolorsize' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Icon Background Outer Border Size', 'themedo-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'themedo-core')
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'themedo-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'themedo-core' ),
				'options' => array(
					''	=> __('None', 'themedo-core'),
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'themedo-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'themedo-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'themedo-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'themedo-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'themedo-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'themedo-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'themedo-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'themedo-core' ),
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link Url', 'themedo-core' ),
				'desc' => __( 'Add the link\'s url ex: http://example.com', 'themedo-core' ),

			),
			'linktext' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link Text', 'themedo-core' ),
				'desc' => __( 'Insert the text to display as the link', 'themedo-core' ),

			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'themedo-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'themedo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'content' => array(
				'std' => __('Your Content Goes Here', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'Content Box Content', 'themedo-core' ),
				'desc' => __( 'Add content for content box', 'themedo-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'themedo-core' ),
				'desc' => __( 'Select the type on animation to use on the shortcode', 'themedo-core' ),
				'options' => $animation_type,
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'themedo-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'themedo-core' ),
				'options' => $animation_direction,
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'themedo-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'themedo-core' ),
				'options' => $dec_numbers,
			)
		),
		'shortcode' => '[content_box title="{{title}}" icon="{{icon}}" backgroundcolor="{{backgroundcolor}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" circlebordercolorsize="{{circlebordercolorsize}}" outercirclebordercolor="{{circlebordercolor}}" outercirclebordercolorsize="{{outercirclebordercolorsize}}" iconrotate="{{iconrotate}}" iconspin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" link="{{link}}" linktarget="{{target}}" linktext="{{linktext}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}"]{{content}}[/content_box]',
		'clone_button' => __( 'Add New Content Box', 'themedo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Counters Box Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['countersbox'] = array(
	'params' => array(
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'themedo-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_range( 6, false )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),
	),
	'shortcode' => '[counters_box columns="{{columns}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/counters_box]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'value' => array(
				'std' => '777',
				'type' => 'text',
				'label' => __( 'Counter Value', 'themedo-core' ),
				'desc' => __( 'The number to which the counter will animate.', 'themedo-core')
			),
			'start' => array(
				'std' => '0',
				'type' => 'text',
				'label' => __( 'Counter Starting Value', 'themedo-core' ),
				'desc' => __( 'The number to which the counter starts.', 'themedo-core' ),
			),			
			'speed' => array(
				'std' => '2000',
				'type' => 'text',
				'label' => __( 'Counter Speed', 'themedo-core' ),
			),
					
			'content' => array(
				'std' => __('Text', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Counter Box Text', 'themedo-core' ),
				'desc' => __( 'Insert text for counter box', 'themedo-core' ),
			)
		),
		'shortcode' => '[counter_box value="{{value}}" start="{{start}}" speed="{{speed}}"]{{content}}[/counter_box]',
		'clone_button' => __( 'Add New', 'themedo-core')
	)
);



/*-----------------------------------------------------------------------------------*/
/*	Dropcap Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => 'A',
			'type' => 'textarea',
			'label' => __( 'Dropcap Letter', 'themedo-core' ),
			'desc' => __( 'Add the letter to be used as dropcap', 'themedo-core' ),
		),
		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Color', 'themedo-core' ),
			'desc' => __( 'Controls the color of the dropcap letter. Leave blank for theme option selection.', 'themedo-core ')
		),		
		'boxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Dropcap', 'themedo-core' ),
			'desc' => __( 'Choose to get a boxed dropcap.', 'themedo-core' ),
			'options' => $reverse_choices
		),
		'boxedradius' => array(
			'std' => '8px',
			'type' => 'text',
			'label' => __( 'Box Radius', 'themedo-core' ),
			'desc' => __('Choose the radius of the boxed dropcap. In pixels (px), ex: 1px, or "round".', 'themedo-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),
	),
	'shortcode' => '[dropcap color="{{color}}" boxed="{{boxed}}" boxed_radius="{{boxedradius}}" class="{{class}}" id="{{id}}"]{{content}}[/dropcap]',
	'popup_title' => __( 'Dropcap Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Post Slider Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['postslider'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'themedo-core' ),
			'desc' => __( 'Choose a layout style for Post Slider.', 'themedo-core' ),
			'options' => array(
				'posts' => __('Posts with Title', 'themedo-core'),
				'posts-with-excerpt' => __('Posts with Title and Excerpt', 'themedo-core'),
				'attachments' => __('Attachment Layout, Only Images Attached to Post/Page', 'themedo-core')
			)
		),
		'excerpt' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Excerpt Number of Words', 'themedo-core' ),
			'desc' => __( 'Insert the number of words you want to show in the excerpt.', 'themedo-core' ),
		),
		'category' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Category', 'themedo-core' ),
			'desc' => __( 'Select a category of posts to display.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_categories( 'category', true, 'All' )
		),
		'limit' => array(
			'std' => 3,
			'type' => 'text',
			'label' => __( 'Number of Slides', 'themedo-core' ),
			'desc' => __( 'Select the number of slides to display.', 'themedo-core' )
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Lightbox on Click', 'themedo-core' ),
			'desc' => __( 'Only works on attachment layout.', 'themedo-core' ),
			'options' => $choices
		),
		'image' => array(
			'type' => 'gallery',
			'label' => __( 'Attach Images to Post/Page Gallery', 'themedo-core' ),
			'desc' => __( 'Only works for attachments layout.', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),		
	),
	'shortcode' => '[postslider layout="{{type}}" excerpt="{{excerpt}}" category="{{category}}" limit="{{limit}}" id="" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"][/postslider]',
	'popup_title' => __( 'Post Slider Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Flip Boxes Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['flipboxes'] = array(
	'params' => array(

		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'themedo-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_range( 6, false )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[flip_boxes columns="{{columns}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/flip_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Flip Boxes Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'titlefront' => array(
				'std' => __('Your Content Goes Here', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Flip Box Frontside Heading', 'themedo-core' ),
				'desc' => __( 'Add a heading for the frontside of the flip box.', 'themedo-core' ),
			),			
			'titleback' => array(
				'std' => __('Your Content Goes Here', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Flip Box Backside Heading', 'themedo-core' ),
				'desc' => __( 'Add a heading for the backside of the flip box.', 'themedo-core' ),
			),			
			'textfront' => array(
				'std' => __('Your Content Goes Here', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'Flip Box Frontside Content', 'themedo-core' ),
				'desc' => __( 'Add content for the frontside of the flip box.', 'themedo-core' ),
			),			
			'content' => array(
				'std' => __('Your Content Goes Here', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'Flip Box Backside Content', 'themedo-core' ),
				'desc' => __( 'Add content for the backside of the flip box.', 'themedo-core' ),
			),		
			'backgroundcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Frontside', 'themedo-core' ),
				'desc' => __( 'Controls the background color of the frontside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'themedo-core' )
			),
			'titlecolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Frontside', 'themedo-core' ),
				'desc' => __( 'Controls the heading color of the frontside. Leave blank for theme option selection.', 'themedo-core' )
			),
			'textcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Frontside', 'themedo-core' ),
				'desc' => __( 'Controls the text color of the frontside. Leave blank for theme option selection.', 'themedo-core' )
			),			
			'backgroundcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Backside', 'themedo-core' ),
				'desc' => __( 'Controls the background color of the backside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'themedo-core' )
			),
			'titlecolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Backside', 'themedo-core' ),
				'desc' => __( 'Controls the heading color of the backside. Leave blank for theme option selection.', 'themedo-core' )
			),				
			'textcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Backside', 'themedo-core' ),
				'desc' => __( 'Controls the text color of the backside. Leave blank for theme option selection.', 'themedo-core' )
			),			
			'bordersize' => array(
				'std' => '1px',
				'type' => 'text',
				'label' => __( 'Border Size', 'themedo-core' ),
				'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core' ),
			),
			'bordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Border Color', 'themedo-core' ),
				'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'themedo-core' )
			),
			'borderradius' => array(
				'std' => '4px',
				'type' => 'text',
				'label' => __( 'BorderRadius', 'themedo-core' ),
				'desc' => __( 'Controls the flip box border radius. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'themedo-core' ),
			),			
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'themedo-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'themedo-core' ),
				'options' => $icons
			),			
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'themedo-core' ),
				'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'themedo-core' )
			),
			'circle' => array(
				'std' => 0,
				'type' => 'select',
				'label' => __( 'Icon Circle', 'themedo-core' ),
				'desc' => __( 'Choose to use a circled background on the icon.', 'themedo-core' ),
				'options' => $choices
			),			
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Background Color', 'themedo-core' ),
				'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'themedo-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Border Color', 'themedo-core' ),
				'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'themedo-core')
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'themedo-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'themedo-core' ),
				'options' => array(
					''	=> __('None', 'themedo-core'),
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'themedo-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'themedo-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'themedo-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'themedo-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'themedo-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'themedo-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'themedo-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'themedo-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'themedo-core' ),
				'desc' => __( 'Select the type of animation to use on the shortcode', 'themedo-core' ),
				'options' => $animation_type,
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'themedo-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'themedo-core' ),
				'options' => $animation_direction,
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'themedo-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'themedo-core' ),
				'options' => $dec_numbers,
			)
		),
		'shortcode' => '[flip_box title_front="{{titlefront}}" title_back="{{titleback}}" text_front="{{textfront}}" border_color="{{bordercolor}}" border_radius="{{borderradius}}" border_size="{{bordersize}}" background_color_front="{{backgroundcolorfront}}" title_front_color="{{titlecolorfront}}" text_front_color="{{textcolorfront}}" background_color_back="{{backgroundcolorback}}" title_back_color="{{titlecolorback}}" text_back_color="{{textcolorback}}" icon="{{icon}}" icon_color="{{iconcolor}}" circle="{{circle}}" circle_color="{{circlecolor}}" circle_border_color="{{circlebordercolor}}" icon_rotate="{{iconrotate}}" icon_spin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}"]{{content}}[/flip_box]',
		'clone_button' => __( 'Add New Flip Box', 'themedo-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	FontAwesome Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['fontawesome'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'themedo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'themedo-core' ),
			'options' => $icons
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'themedo-core' ),
			'desc' => __( 'Choose to display the icon in a circle.', 'themedo-core' ),
			'options' => $choices
		),
		'size' => array(
			'std' => '13px',
			'type' => 'text',
			'label' => __( 'Icon Size', 'themedo-core' ),
			'desc' => __( 'Set the size of the icon. In pixels (px), ex: 13px.', 'themedo-core' ),
		),			
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'themedo-core' ),
			'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'themedo-core')
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Background Color', 'themedo-core' ),
			'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'themedo-core')
		),
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Border Color', 'themedo-core' ),
			'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'themedo-core')
		),
		'rotate' => array(
			'type' => 'select',
			'label' => __( 'Rotate Icon', 'themedo-core' ),
			'desc' => __( 'Choose to rotate the icon.', 'themedo-core' ),
			'options' => array(
				''	=> __('None', 'themedo-core'),
				'90' => '90',
				'180' => '180',
				'270' => '270',					
			)
		),				
		'spin' => array(
			'type' => 'select',
			'label' => __( 'Spinning Icon', 'themedo-core' ),
			'desc' => __( 'Choose to let the icon spin.', 'themedo-core' ),
			'options' => $reverse_choices
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'themedo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'themedo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'themedo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'themedo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'themedo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'themedo-core' ),
			'options' => $dec_numbers,
		),
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'themedo-core' ),
			'desc' => __( 'Select the icon\'s alignment.', 'themedo-core' ),
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'center' => __('Center', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),		
	),
	'shortcode' => '[fontawesome icon="{{icon}}" circle="{{circle}}" size="{{size}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" rotate="{{rotate}}" spin="{{spin}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Font Awesome Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Fullwidth Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['fullwidth'] = array(
	'no_preview' => true,
	'params' => array(
		
		'min_height' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Content Min Height', 'themedo-core' ),
			'std'  		=> 'yes',
			'options' 	=> array(
								'enable' 	=> __( 'Full Screen', 'themedo-core' ),
								'disable'  	=> __( 'Auto', 'themedo-core' ),
								'h100'  	=> 100,
								'h200'  	=> 200,
								'h300'  	=> 300,
								'h400'  	=> 400,
								'h500'  	=> 500,
								'h600'  	=> 600,
								'h700'  	=> 700,
								'h800'  	=> 800,
								'h900'  	=> 900,
								'h1000'  	=> 1000,
							),
		),
	
		'content_layout' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Content Layout', 'themedo-core' ),
			'std'  		=> 'yes',
			'options' 	=> array(
								'contained' => __( 'Contained', 'themedo-core' ),
								'full'  	=> __( 'Full', 'themedo-core' ),
							),
		),
		'content_color' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Content Color', 'themedo-core' ),
			'std'  		=> 'light',
			'options' 	=> array( 'light' => 'Light', 'dark' => 'Dark' ),
		),
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'themedo-core' ),
			'desc' => __( 'Controls the background color.', 'themedo-core')
		),
		'background_color_rate' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Background Color Transparency', 'themedo-core' ),
			'desc' 		=> __( '', 'themedo-core' ),
			'std' 		=> '0.3',
			'options' 	=> array( '0' => '0', '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' ),
			
		),
		'background_image' => array(
			'type' 		=> 'uploader',
			'label' 	=> __( 'Background Image', 'themedo-core' ),
			'desc' 		=> __('Upload an image to display in the background', 'themedo-core')
		),
		'background_repeat' => array(
			'type'	 	=> 'select',
			'label' 	=> __( 'Background Repeat', 'themedo-core' ),
			'desc' 		=> __( 'Choose how the background image repeats.', 'themedo-core' ),
			'std' 		=> 'repeat',
			'options' 	=> array(
				'no-repeat' => __( 'No Repeat', 'themedo-core' ),
				'repeat'    => __( 'Repeat Vertically and Horizontally', 'themedo-core' ),
				'repeat-x'  => __( 'Repeat Horizontally', 'themedo-core' ),
				'repeat-y'  => __( 'Repeat Vertically', 'themedo-core' )
			)
		),
		'background_position' => array(
			'type' 		=> 'select',
			'label' 	=> __('Background Position', 'themedo-core' ),
			'desc' 		=> __('Choose the postion of the background image', 'themedo-core'),
			'std'		=> 'left top',
			'options' 	=> array(
				'left top'      => __( 'Left Top', 'themedo-core' ),
				'left center'   => __( 'Left Center', 'themedo-core' ),
				'left bottom'   => __( 'Left Bottom', 'themedo-core' ),
				'right top'     => __( 'Right Top', 'themedo-core' ),
				'right center'  => __( 'Right Center', 'themedo-core' ),
				'right bottom'  => __( 'Right Bottom', 'themedo-core' ),
				'center top'    => __( 'Center Top', 'themedo-core' ),
				'center center' => __( 'Center Center', 'themedo-core' ),
				'center bottom' => __( 'Center Bottom', 'themedo-core' )
			),
		),
		'video_url' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __( 'Video Url', 'themedo-core' ),
			'desc' 		=> '',
		),
		'background_type' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Background Type', 'themedo-core' ),
			'desc' 		=> __('', 'themedo-core'),
			'std'  		=> 'parallax',
			'options' 	=> array(
				'parallax'      => __( 'Parallax', 'themedo-core' ),
				'video'   		=> __( 'Video', 'themedo-core' ),
				'bgslide'   	=> __( 'BG Slide', 'themedo-core' ),
			),
		),
		'bgslide_direction' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide Direction', 'themedo-core' ),
			'desc' 		=> __('', 'themedo-core'),
			'std'  		=> 'hor',
			'options' 	=> array(
				'hor' 		=> __('Horizontal', 'themedo-core'),
				'ver' 		=> __('Vertical', 'themedo-core'),
				'both' 		=> __('Both Direction', 'themedo-core'),
			),
		),
		'bgslide_xaxis' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide: Reverse X axis', 'themedo-core' ),
			'desc' 		=> __('', 'themedo-core'),
			'std'  		=> '0',
			'options' 	=> array( '0' => '0', '1' => '1' ),
		),	
		'bgslide_yaxis' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide: Reverse Y axis', 'themedo-core' ),
			'desc' 		=> __('', 'themedo-core'),
			'std'  		=> '0',
			'options' 	=> array( '0' => '0', '1' => '1' ),
		),	
		'bgslide_rate' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide Rate', 'themedo-core' ),
			'std'  		=> '30',
			'options'	=> avalon_td_shortcodes_range( 100, false )
		),	
		'margin_top' => array(
			'std' 		=> '0px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Top', 'themedo-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' 		=> '0px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Bottom', 'themedo-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'themedo-core' )
		),	
		'padding_top' => array(
			'std' 		=> '150px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Top', 'themedo-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'themedo-core' )
		),
		'padding_bottom' => array(
			'std' 		=> '150px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Bottom', 'themedo-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'themedo-core' )
		),	
		'class' => array(
			'std'		=> '',
			'type' 		=> 'text',
			'label' 	=> __( 'CSS Class', 'themedo-core' ),
			'desc' 		=> __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __( 'CSS ID', 'themedo-core' ),
			'desc' 		=> __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),
		'content' => array(
			'std' 		=> __('Your Content Goes Here', 'themedo-core'),
			'type' 		=> 'textarea',
			'label' 	=> __( 'Content', 'themedo-core' ),
			'desc' 		=> __( 'Add content', 'themedo-core' ),
		),			
	),
	'shortcode' => '[fullwidth min_height="{{min_height}}" content_layout="{{content_layout}}" content_color="{{content_color}}" background_color="{{background_color}}" background_color_rate="{{background_color_rate}}" background_type="{{background_type}}" background_image="{{background_image}}" background_repeat="{{background_repeat}}" background_position="{{background_position}}" video_url="{{video_url}}"  bgslide_direction="{{bgslide_direction}}" bgslide_xaxis="{{bgslide_xaxis}}" bgslide_yaxis="{{bgslide_yaxis}}" bgslide_rate="{{bgslide_rate}}"  margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/fullwidth]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Google Map Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['googlemap'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __( 'Map Type', 'themedo-core' ),
			'desc' => __( 'Select the type of google map to display.', 'themedo-core' ),
			'options' => array(
				'roadmap' => __('Roadmap', 'themedo-core'),
				'satellite' => __('Satellite', 'themedo-core'),
				'hybrid' => __('Hybrid', 'themedo-core'),
				'terrain' => __('Terrain', 'themedo-core')
			)
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Map Width', 'themedo-core' ),
			'desc' => __( 'Map width in percentage or pixels. ex: 100%, or 940px.', 'themedo-core')
		),
		'height' => array(
			'std' => '300px',
			'type' => 'text',
			'label' => __( 'Map Height', 'themedo-core' ),
			'desc' => __( 'Map height in pixels. ex: 300px', 'themedo-core')
		),
		'zoom' => array(
			'std' => 14,
			'type' => 'select',
			'label' => __( 'Zoom Level', 'themedo-core' ),
			'desc' => __( 'Higher number will be more zoomed in.', 'themedo-core' ),
			'options' => avalon_td_shortcodes_range( 25, false )
		),
		'scrollwheel' => array(
			'type' => 'select',
			'label' => __( 'Scrollwheel on Map', 'themedo-core' ),
			'desc' => __( 'Enable zooming using a mouse\'s scroll wheel.', 'themedo-core' ),
			'options' => $choices
		),
		'scale' => array(
			'type' => 'select',
			'label' => __( 'Show Scale Control on Map', 'themedo-core' ),
			'desc' => __( 'Display the map scale.', 'themedo-core' ),
			'options' => $choices
		),
		'zoom_pancontrol' => array(
			'type' => 'select',
			'label' => __( 'Show Pan Control on Map', 'themedo-core' ),
			'desc' => __( 'Displays pan control button.', 'themedo-core' ),
			'options' => $choices
		),
		'animation' => array(
			'type' => 'select',
			'label' => __( 'Address Pin Animation', 'themedo-core' ),
			'desc' => __( 'Choose to animate the address pins when the map first loads.', 'themedo-core' ),
			'options' => $choices
		),		
		'popup' => array(
			'type' => 'select',
			'label' => __( 'Show tooltip by default', 'themedo-core' ),
			'desc' => __( 'Display or hide the tooltip when the map first loads.', 'themedo-core' ),
			'options' => $choices
		),
		'mapstyle' => array(
			'type' => 'select',
			'label' => __( 'Select the Map Styling', 'themedo-core' ),
			'desc' => __( 'Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.', 'themedo-core' ),
			'options' => array(
				'default' => __('Default Styling', 'themedo-core'),
				'theme' => __('Theme Styling', 'themedo-core'),
				'custom' => __('Custom Styling', 'themedo-core'),
			)
		),	
		'overlaycolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Map Overlay Color', 'themedo-core' ),
			'desc' => __( 'Custom styling setting only. Pick an overlaying color for the map. Works best with "roadmap" type.', 'themedo-core')
		),
		'infobox' => array(
			'type' => 'select',
			'label' => __( 'Infobox Styling', 'themedo-core' ),
			'desc' => __( 'Custom styling setting only. Choose between default or custom info box.', 'themedo-core' ),
			'options' => array(
				'default' => __('Default Infobox', 'themedo-core'),
				'custom' => __('Custom Infobox', 'themedo-core'),
			)
		),
		'infoboxcontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Infobox Content', 'themedo-core' ),
			'desc' => __( 'Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3', 'themedo-core' ),
		),		
		'infoboxtextcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Text Color', 'themedo-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box text.', 'themedo-core')
		),
		'infoboxbackgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Background Color', 'themedo-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box background.', 'themedo-core')
		),
		'icon' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Custom Marker Icon', 'themedo-core' ),
			'desc' => __( 'Custom styling setting only. Use full image urls for custom marker icons or input "theme" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3', 'themedo-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Address', 'themedo-core' ),
			'desc' => __( 'Add address to the location which will show up on map. For multiple addresses, separate addresses by using the | symbol. <br />ex: Address 1|Address 2|Address 3', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' ),
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' ),
		)
	),
	'shortcode' => '[map address="{{content}}" type="{{type}}" map_style="{{mapstyle}}" overlay_color="{{overlaycolor}}" infobox="{{infobox}}" infobox_background_color="{{infoboxbackgroundcolor}}" infobox_text_color="{{infoboxtextcolor}}" infobox_content="{{infoboxcontent}}" icon="{{icon}}" width="{{width}}" height="{{height}}" zoom="{{zoom}}" scrollwheel="{{scrollwheel}}" scale="{{scale}}" zoom_pancontrol="{{zoom_pancontrol}}" popup="{{popup}}" animation="{{animation}}" class="{{class}}" id="{{id}}"][/map]',
	'popup_title' => __( 'Google Map Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Gallery Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['gallery'] = array(
	'no_preview' => true,
	'params' => array(
		/*'slide_type' => array(
			'std' 		=> 	'fade',
			'type'		=> 	'select',
			'label' 	=> 	__( 'Slide Type', 'themedo-core' ),
			'desc' 		=> 	__( 'Choose Slide Type', 'themedo-core' ),
			'options' 	=> 	array(
				'fade' 			=> __('Fade', 'themedo-core'),
				'slide' 		=> __('Slide', 'themedo-core'),
			)
		),*/
		'slide_autoplay' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Slide Autoplay', 'themedo-core' ),
			'desc' 		=> 	__( 'Set Autoplay', 'themedo-core' ),
			'std' 		=> 	'on',
			'options' 	=> 	array(
				'on' 			=> __( 'On', 'themedo-core' ),
				'off'    		=> __( 'Off', 'themedo-core' ),
			)
		),
		/*'slide_reverse' => 	array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Slide Reverse', 'themedo-core' ),
			'desc' 		=> 	__( 'Works when slide type is "Slide"', 'themedo-core' ),
			'std' 		=> 	'off',
			'options' 	=> 	array(
				'on' 			=> __( 'On', 'themedo-core' ),
				'off'    		=> __( 'Off', 'themedo-core' ),
			)
		),*/
		'slide_speed' => array(
			'std' => '4000',
			'type' => 'text',
			'label' => __( 'Slide Speed', 'themedo-core' ),
			'desc' => __( 'In milliseconds, ex: 4000.', 'themedo-core' )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[tdgallery slide_autoplay="{{slide_autoplay}}" slide_speed="{{slide_speed}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/tdgallery]',
	'popup_title' => __('Insert Shortcode', 'themedo-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'themedo-core' ),
				'desc' => __('Upload an image to display in the tab.', 'themedo-core')
			),
		),
		'shortcode' => '[gimg image="{{image}}"][/gimg]',
		'clone_button' => __( 'Add More', 'themedo-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Supersized Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['supersized'] = array(
	'no_preview' => true,
	'params' => array(
		'purchase_button' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Purchase Button', 'themedo-core' ),
			'desc' 		=> 	__( '', 'themedo-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'themedo-core' ),
				'disable'    		=> __( 'Disable', 'themedo-core' ),
			)
		),
		'slide_interval' => array(
			'std' => '4000',
			'type' => 'text',
			'label' => __( 'Slide Speed', 'themedo-core' ),
			'desc' => __( 'In milliseconds, ex: 4000.', 'themedo-core' )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[supersized purchase_button="{{purchase_button}}" slide_interval="{{slide_interval}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/supersized]',
	'popup_title' => __('Insert Shortcode', 'themedo-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'themedo-core' ),
				'desc' => __('Upload an image to display in the tab.', 'themedo-core')
			),
		),
		'shortcode' => '[simg image="{{image}}"][/simg]',
		'clone_button' => __( 'Add More', 'themedo-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Supersized Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['kenburns'] = array(
	'no_preview' => true,
	'params' => array(
		'purchase_button' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Purchase Button', 'themedo-core' ),
			'desc' 		=> 	__( '', 'themedo-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'themedo-core' ),
				'disable'    		=> __( 'Disable', 'themedo-core' ),
			)
		),
		'slide_interval' => array(
			'std' => '9000',
			'type' => 'text',
			'label' => __( 'Slide Speed', 'themedo-core' ),
			'desc' => __( 'In milliseconds, ex: 4000.', 'themedo-core' )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[kenburns purchase_button="{{purchase_button}}" slide_interval="{{slide_interval}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/kenburns]',
	'popup_title' => __('Insert Shortcode', 'themedo-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'themedo-core' ),
				'desc' => __('Upload an image to display in the tab.', 'themedo-core')
			),
		),
		'shortcode' => '[ken image="{{image}}"][/ken]',
		'clone_button' => __( 'Add More', 'themedo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Flow Gallery Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['flowgallery'] = array(
	'no_preview' => true,
	'params' => array(
		'purchase_button' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Purchase Button', 'themedo-core' ),
			'desc' 		=> 	__( '', 'themedo-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'themedo-core' ),
				'disable'    		=> __( 'Disable', 'themedo-core' ),
			)
		),
		'img_title' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Image Title', 'themedo-core' ),
			'desc' 		=> 	__( '', 'themedo-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'themedo-core' ),
				'disable'    		=> __( 'Disable', 'themedo-core' ),
			)
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[flowgallery purchase_button="{{purchase_button}}" img_title="{{img_title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/flowgallery]',
	'popup_title' => __('Insert Shortcode', 'themedo-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' 		=> 'uploader',
				'label' 	=> __( 'Image', 'themedo-core' ),
				'desc' 		=> __('Upload an image to display in the gallery.', 'themedo-core')
			),
		),
		'shortcode' => '[flowimg image="{{image}}"][/flowimg]',
		'clone_button' => __( 'Add More', 'themedo-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Highlight Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' => array(

		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Highlight Color', 'themedo-core' ),
			'desc' => __( 'Pick a highlight color', 'themedo-core')
		),
		'rounded' => array(
			'type' => 'select',
			'label' => __( 'Highlight With Round Edges', 'themedo-core' ),
			'desc' => __( 'Choose to have rounded edges.', 'themedo-core' ),
			'options' => $reverse_choices
		),		
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Content to Higlight', 'themedo-core' ),
			'desc' => __( 'Add your content to be highlighted', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),			

	),
	'shortcode' => '[highlight color="{{color}}" rounded="{{rounded}}" class="{{class}}" id="{{id}}"]{{content}}[/highlight]',
	'popup_title' => __( 'Highlight Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Image Carousel Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['imagecarousel'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'themedo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'themedo-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'themedo-core'),
				'auto' => __('Auto', 'themedo-core')
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'themedo-core' ),
			'desc' => __('Select the hover effect type.', 'themedo-core'),
			'options' => array(
				'none' => __('None', 'themedo-core'),
				'zoomin' => __('Zoom In', 'themedo-core'),
				'zoomout' => __('Zoom Out', 'themedo-core'),
				'liftup' => __('Lift Up', 'themedo-core')
			)
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'themedo-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'themedo-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'themedo-core' ),
			'desc' => __('Select the number of max columns to display.', 'themedo-core'),
			'options' => avalon_td_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '13',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'themedo-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "themedo-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'themedo-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "themedo-core"),
		),
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'themedo-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'themedo-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'themedo-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel. IMPORTANT: For easy draggability, when mouse scroll is activated, links will be disabled.', 'themedo-core' ),
			'options' => $reverse_choices
		),
		'border' => array(
			'type' => 'select',
			'label' => __( 'Border', 'themedo-core' ),
			'desc' => __( 'Choose to enable a border around the images.', 'themedo-core' ),
			'options' => $choices
		),		
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'themedo-core' ),
			'desc' => __( 'Show image in lightbox.', 'themedo-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),	
	),
	'shortcode' => '[images picture_size="{{picture_size}}" hover_type="{{hover_type}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" border="{{border}}" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/images]', // as there is no wrapper shortcode
	'popup_title' => __( 'Image Carousel Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Website Link', 'themedo-core' ),
				'desc' => __( 'Add the url to image\'s website. If lightbox option is enabled, you have to add the full image link to show it in the lightbox.', 'themedo-core' )
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'themedo-core' ),
				'desc' => __( '_self = open in same window <br />_blank = open in new window', 'themedo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'themedo-core' ),
				'desc' => __( 'Upload an image to display.', 'themedo-core' ),
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Alt Text', 'themedo-core' ),
				'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'themedo-core' ),
			)
		),
		'shortcode' => '[image link="{{link}}" linktarget="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' => __( 'Add New Image', 'themedo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Image Frame Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['imageframe'] = array(
	'no_preview' => true,
	'params' => array(
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Frame Style Type', 'themedo-core' ),
			'desc' => __( 'Select the frame style type.', 'themedo-core' ),
			'options' => array(
				'none' => __('None', 'themedo-core'),
				'glow' => __('Glow', 'themedo-core'),
				'dropshadow' => __('Drop Shadow', 'themedo-core'),
				'bottomshadow' => __('Bottom Shadow', 'themedo-core')
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'themedo-core' ),
			'desc' => __('Select the hover effect type.', 'themedo-core'),
			'options' => array(
				'none' => __('None', 'themedo-core'),
				'zoomin' => __('Zoom In', 'themedo-core'),
				'zoomout' => __('Zoom Out', 'themedo-core'),
				'liftup' => __('Lift Up', 'themedo-core')
			)
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'themedo-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'bordersize' => array(
			'std' => '0px',
			'type' => 'text',
			'label' => __( 'Border Size', 'themedo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'borderradius' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __( 'Border Radius', 'themedo-core' ),
			'desc' => __( 'Choose the radius of the image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'themedo-core' ),
		),			
		'stylecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Style Color', 'themedo-core' ),
			'desc' => __( 'For all style types except border. Controls the style color. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'align' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Align', 'themedo-core' ),
			'desc' => __('Choose how to align the image.', 'themedo-core'),
			'options' => array(
				'none' => __('None', 'themedo-core'),
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
				'center' => __('Center', 'themedo-core')
			)
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'themedo-core' ),
			'desc' => __( 'Show image in Lightbox.', 'themedo-core' ),
			'options' => $reverse_choices
		),
		'lightbox_image' => array(
			'type' => 'uploader',
			'label' => __( 'Lightbox Image', 'themedo-core' ),
			'desc' => __( 'Upload an image that will show up in the lightbox.', 'themedo-core' ),
		),			
		'image' => array(
			'type' => 'uploader',
			'label' => __( 'Image', 'themedo-core' ),
			'desc' => __('Upload an image to display in the frame.', 'themedo-core')
		),	
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Image Alt Text', 'themedo-core' ),
			'desc' => __('The alt attribute provides alternative information if an image cannot be viewed.', 'themedo-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Picture Link URL', 'themedo-core' ),
			'desc' => __( 'Add the URL the picture will link to, ex: http://example.com.', 'themedo-core' ),
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'themedo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window.', 'themedo-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'themedo-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode.', 'themedo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'themedo-core' ),
			'desc' => __( 'Select the incoming direction for the animation.', 'themedo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'themedo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'themedo-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core')
		),			
	),
	'shortcode' => '[imageframe lightbox="{{lightbox}}" lightbox_image="{{lightbox_image}}" style_type="{{style_type}}" hover_type="{{hover_type}}" bordercolor="{{bordercolor}}" bordersize="{{bordersize}}" borderradius="{{borderradius}}" stylecolor="{{stylecolor}}" align="{{align}}" link="{{link}}" linktarget="{{target}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]&lt;img alt="{{alt}}" src="{{image}}" /&gt;[/imageframe]',
	'popup_title' => __( 'Image Frame Shortcode', 'themedo-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Intro Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['intro'] = array(
	'no_preview' => true,
	'params' => array(
		'main_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Main Text', 'themedo-core' ),
			'desc' => __( 'Insert Main Text', 'themedo-core' )
		),
		'image' => array(
			'type' => 'uploader',
			'label' => __( 'Image', 'themedo-core' ),
			'desc' => __( 'Upload Image', 'themedo-core' )
		),			
		'button_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Title', 'themedo-core' ),
			'desc' => __( 'Insert Button Text', 'themedo-core' ),
		),
		'button_href' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Link', 'themedo-core' ),
			'desc' => __( 'Insert Button Link', 'themedo-core' ),
		),
		'button_hover' => array(
			'std' => 'on',
			'type' => 'text',
			'label' => __( 'Button Hover Animation', 'themedo-core' ),
			'desc' => __( 'Set Hover Animation', 'themedo-core' ),
			'options' => array(
				'on' => __('On', 'themedo-core'),
				'off' => __('Off', 'themedo-core')
			)
		),
		'todown' => array(
			'std' 	=> '',
			'type'	=> 'text',
			'label' => __( 'To Down Button', 'themedo-core' ),
			'desc' 	=> __( 'Insert id of any section. When this button is clicked it scrolls page to that section. It doesn\'s appears if you leave this blank', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[intro main_text="{{main_text}}" image="{{image}}" button_text="{{button_text}}" button_href="{{button_href}}" button_hover="{{button_hover}}" todown="{{todown}}" class="{{class}}" id="{{id}}"][/intro]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['lightbox'] = array(
	'no_preview' => true,
	'params' => array(

		'full_image' => array(
			'type' => 'uploader',
			'label' => __( 'Full Image', 'themedo-core' ),
			'desc' => __( 'Upload an image that will show up in the lightbox.', 'themedo-core' ),
		),
		'thumb_image' => array(
			'type' => 'uploader',
			'label' => __( 'Thumbnail Image', 'themedo-core' ),
			'desc' => __( 'Clicking this image will show lightbox.', 'themedo-core' ),
		),
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Alt Text', 'themedo-core' ),
			'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'themedo-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Lightbox Description', 'themedo-core' ),
			'desc' => __( 'This will show up in the lightbox as a description below the image.', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),				
	),
	'shortcode' => '[avalon_td_lightbox] &lt;a title="{{title}}" class="{{class}}" id="{{id}}" href="{{full_image}}" data-rel="prettyPhoto"&gt;&lt;img alt="{{alt}}" src="{{thumb_image}}" /&gt;&lt;/a&gt; [/avalon_td_lightbox]',
	'popup_title' => __( 'Lightbox Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Menu Anchor Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['menuanchor'] = array(
	'no_preview' => true,
	'params' => array(

		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Menu Anchor', 'themedo-core' ),
			'desc' => __('This name will be the id you will have to use in your one page menu.', 'themedo-core'),

		)
	),
	'shortcode' => '[menu_anchor name="{{name}}"]',
	'popup_title' => __( 'Menu Anchor Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Modal Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['modal'] = array(
	'no_preview' => true,
	'params' => array(

		'button_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Button Text', 'themedo-core' ),
		),
		'button_hover' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Button Hover Effect', 'themedo-core' ),
			'options' => array(
				'on' => __('On', 'themedo-core'),
				'off' => __('Off', 'themedo-core')
			)
		),		
		'button_size' => array(
			'std' => array('medium'),
			'type' => 'select',
			'label' => __( 'Button Size', 'themedo-core' ),
			'options' => array(
				'small' => __('Small', 'themedo-core'),
				'medium' => __('Medium', 'themedo-core'),
				'big' => __('Big', 'themedo-core')
			)
		),
		'opening_effect' => array(
			'type' => 'select',
			'label' => __( 'Modal Window Opening Effect', 'themedo-core' ),
			'options' => array(
				'td-zoom-out' => __('Zoom Out', 'themedo-core'),
				'td-zoom-in' => __('Zoom In', 'themedo-core'),
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Heading', 'themedo-core' ),
			
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Contents of Modal', 'themedo-core' ),
			'desc' => __( 'Add your content to be displayed in modal.', 'themedo-core' ),
		),		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),					
	),
	'shortcode' => '[modal button_text="{{button_text}}" button_hover="{{button_hover}}" button_size="{{button_size}}" opening_effect="{{opening_effect}}" title="{{title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/modal]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);



/*-----------------------------------------------------------------------------------*/
/*	One Page Text Link Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['onepagetextlink'] = array(
	'no_preview' => true,
	'params' => array(
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Anchor', 'themedo-core' ),
			'desc' => __('Unique identifier of the anchor to scroll to on click.', 'themedo-core'),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'themedo-core' ),
			'desc' => __( 'Insert text or HTML code here (e.g: HTML for image). This content will be used to trigger the scrolling to the anchor.', 'themedo-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[one_page_text_link link="{{link}}" class="{{class}}" id="{{id}}"]{{content}}[/one_page_text_link]',
	'popup_title' => __( 'One Page Text Link Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Person Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['person'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name', 'themedo-core' ),
			'desc' => __( 'Insert the name of the person.', 'themedo-core' ),
		),
		'occ' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Occupation', 'themedo-core' ),
		),
		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Picture', 'themedo-core' ),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'themedo-core' ),
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'themedo-core' ),
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
				'center' => __('Center', 'themedo-core'),
			)
		),
	
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'themedo-core' ),
			'desc' => __( 'Insert your email address', 'themedo-core' )
		),
		
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'themedo-core' )
		),
		
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'themedo-core' )
		),
	
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Instagram Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Instagram link', 'themedo-core' )
		),
	
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'themedo-core' )
		),
	
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Linkedin Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Linkedin link', 'themedo-core' )
		),
	
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'themedo-core' )
		),
	
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'themedo-core' )
		),
	
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'themedo-core' )
		),
	
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Skype link', 'themedo-core' )
		),
	
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'themedo-core' )
		),
	
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'themedo-core' )
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[person name="{{name}}" occ="{{occ}}" image="{{image}}" text_align="{{text_align}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" instagram="{{instagram}}" google="{{google}}" linkedin="{{linkedin}}" vimeo="{{vimeo}}" youtube="{{youtube}}" flickr="{{flickr}}" skype="{{skype}}" tumblr="{{tumblr}}" dribbble="{{dribbble}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/person]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Coverbox Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['coverbox'] = array(
	'no_preview' => true,
	'params' => array(
		'template' => array(
			'type' => 'select',
			'label' => __( 'Template', 'themedo-core' ),
			'std' => 'alpha',
			'options' => array(
				'alpha' 	=> __('Alpha', 'themedo-core'),
				'beta' 		=> __('Beta', 'themedo-core'),
				'gamma' 	=> __('Gamma', 'themedo-core'),
				'delta' 	=> __('Delta', 'themedo-core'),
				'epsilon' 	=> __('Epsilon', 'themedo-core'),
				'zeta' 		=> __('Zeta', 'themedo-core'),
				'eta' 		=> __('Eta', 'themedo-core'),
				'theta' 	=> __('Theta', 'themedo-core'),
			)
		),
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'themedo-core' ),
			'std' => 'light',
			'options' => array(
				'light' => __('Light', 'themedo-core'),
				'dark' => __('Dark', 'themedo-core'),
			)
		),
		'width' => array(
			'type' => 'select',
			'label' => __( 'Max Width', 'themedo-core' ),
			'std' => 'max600',
			'options' => array(
				'max400' 				=> '400px',
				'max500' 				=> '500px',
				'max600' 				=> '600px',
				'max700' 				=> '700px',
				'max800' 				=> '800px',
				'max900' 				=> '900px',
				'max1000' 				=> '1000px',
			)
		),
		'position' => array(
			'type' => 'select',
			'label' => __( 'Position', 'themedo-core' ),
			'std' => 'center',
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
				'center' => __('Center', 'themedo-core'),
			)
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'themedo-core' ),
			'std' => 'center',
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
				'center' => __('Center', 'themedo-core'),
			)
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'themedo-core' ),
		),
		
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[coverbox  template="{{template}}"  skin="{{skin}}" width="{{width}}" position="{{position}}" text_align="{{text_align}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/coverbox]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	TDContent Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['tdcontent'] = array(
	'no_preview' => true,
	'params' => array(
		
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'themedo-core' ),
		),
		'text_align' => array(
			'type' 	=> 'select',
			'label' => __( 'Text Align', 'themedo-core' ),
			'std' 	=> 'center',
			'options' => array(
				'left' 		=> __('Left', 'themedo-core'),
				'right' 	=> __('Right', 'themedo-core'),
				'center' 	=> __('Center', 'themedo-core'),
			)
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[tdcontent text_align="{{text_align}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/tdcontent]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Comparison Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['comparison'] = array(
	'no_preview' => true,
	'params' => array(
		'img1' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Image 1', 'themedo-core' ),
		),
		'img2' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Image 2', 'themedo-core' ),
		),
		'image_size' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Image Size', 'themedo-core' ),
			'options' 	=> array(
				 '1170' 	=> '1170x650',
				 'full' 	=> 'Original Image'
			)
		),
		'orientation' => array(
			'type' => 'select',
			'label' => __( 'Orientation', 'themedo-core' ),
			'options' => array(
				'horizontal' => __('Horizontal', 'themedo-core'),
				'vertical' => __('Vertical', 'themedo-core')
			)
		),
		'before' => array(
			'std' => 'Before',
			'type' => 'text',
			'label' => __( 'Before Text', 'themedo-core' ),
			'desc' => __( '', 'themedo-core' )
		),
		'after' => array(
			'std' => 'After',
			'type' => 'text',
			'label' => __( 'After Text', 'themedo-core' ),
			'desc' => __( '', 'themedo-core' )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[comparison img1="{{img1}}" img2="{{img2}}" image_size="{{image_size}}" orientation="{{orientation}}" before="{{before}}" after="{{after}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/comparison]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Hotspot Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['hotspot'] = array(
	'params' => array(
		'image' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Hotspot Image', 'themedo-core' ),
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),	
	),
	'shortcode' => '[hotspots  image="{{image}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/hotspots]', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'top' => array(
				'std' 		=> '0%',
				'type' 		=> 'text',
				'label' 	=> __( 'Top Spacing', 'themedo-core' ),
				'desc' 		=> __( 'Insert space in percent. Make sure it isn\'t higher than 100%', 'themedo-core' )
			),
			'left' => array(
				'std' 		=> '0%',
				'type' 		=> 'text',
				'label' 	=> __( 'Left Spacing', 'themedo-core' ),
				'desc' 		=> __( 'Insert space in percent. Make sure it isn\'t higher than 100%', 'themedo-core' )
			),
			'skin' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Skin', 'themedo-core' ),
				'options' 	=> array(
					'light' 	=> 'Light',
					'dark' 		=> 'Dark'
				)
			),
			'rounded' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Rounded', 'themedo-core' ),
				'options' 	=> array(
					'a' 		=> 'A',
					'b' 		=> 'B',
					'off' 		=> 'Off'
				)
			),
			'tooltip' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Tooltip Visibilty', 'themedo-core' ),
				'options' 	=> array(
					'open' 		=> 'Open',
					'hover' 	=> 'on Hover',
					'click' 	=> 'on Click'
				)
			),
			'position' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Tooltip Position', 'themedo-core' ),
				'options' 	=> array(
					'n'			=> "North",
					's'	 		=> "South",
					'e'	 		=> "East",
					'w'	 		=> "West",
					'nw'	 	=> "North-West",
					'ne'	 	=> "North-East",
					'sw'	 	=> "South-West",
					'se'	 	=> "South-East",
				)
			),
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'themedo-core' ),
			)
		),
		'shortcode' => '[hotspot top="{{top}}" left="{{left}}" skin="{{skin}}" rounded="{{rounded}}" tooltip="{{tooltip}}" position="{{position}}" title="{{title}}"][/hotspot]',
		'clone_button' => __( 'Add New', 'themedo-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Work Step Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['workstep'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Step', 'themedo-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'themedo-core' ),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Content', 'themedo-core' ),
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '40px',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[workstep step="{{step}}" title="{{title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/workstep]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Service Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['service'] = array(
	'no_preview' => true,
	'params' => array(

		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Image', 'themedo-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'themedo-core' ),
			'desc' => __( 'Insert the title of the service.', 'themedo-core' ),
		),
		'subtitle' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Subtitle', 'themedo-core' ),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'themedo-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'themedo-core' ),
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '40px',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[service image="{{image}}" title="{{title}}" subtitle="{{subtitle}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/service]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Servicepack Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['servicepack'] = array(
	'params' => array(
		'image' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Image', 'themedo-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'themedo-core' ),
			'desc' => __( '', 'themedo-core' ),
		),
		'duration' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Duration', 'themedo-core' ),
		),
		'totalcost' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Total Cost', 'themedo-core' ),
		),
		'booking' => array(
			'std' 		=> 'on',
			'type' 		=> 'select',
			'label' 	=> __( 'Booking Button', 'themedo-core' ),
			'options' 	=> array(
				'on' 		=> 'Enable',
				'off' 		=> 'Disable'
			)
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),	
	),
	'shortcode' => '[servicepack  image="{{image}}" title="{{title}}" duration="{{duration}}" totalcost="{{totalcost}}" booking="{{booking}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/servicepack]', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'themedo-core' ),
			),
			'price' => array(
				'std' => '$27.00',
				'type' => 'text',
				'label' => __( 'Price', 'themedo-core' ),
			)
		),
		'shortcode' => '[sp title="{{title}}" price="{{price}}"][/sp]',
		'clone_button' => __( 'Add New', 'themedo-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Popover Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['popover'] = array(
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Popover Heading', 'themedo-core' ),
			'desc' => __( 'Heading text of the popover.', 'themedo-core' ),
		),
		'titlebgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Heading Background Color', 'themedo-core' ),
			'desc' => __( 'Controls the background color of the popover heading. Leave blank for theme option selection.', 'themedo-core')
		),			
		'popovercontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Contents Inside Popover', 'themedo-core' ),
			'desc' => __( 'Text to be displayed inside the popover.', 'themedo-core' ),
		),
		'contentbgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Content Background Color', 'themedo-core' ),
			'desc' => __( 'Controls the background color of the popover content area. Leave blank for theme option selection.', 'themedo-core')
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Border Color', 'themedo-core' ),
			'desc' => __( 'Controls the border color of the of the popover box. Leave blank for theme option selection.', 'themedo-core')
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Text Color', 'themedo-core' ),
			'desc' => __( 'Controls all the text color inside the popover box. Leave blank for theme option selection.', 'themedo-core')
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Popover Trigger Method', 'themedo-core' ),
			'desc' => __( 'Choose mouse action to trigger popover.', 'themedo-core' ),
			'options' => array(
				'click' => __('Click', 'themedo-core'),
				'hover' => __('Hover', 'themedo-core'),
			)
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Popover Position', 'themedo-core' ),
			'desc' => __( 'Choose the display position of the popover. Choose default for theme option selection.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'top' => __('Top', 'themedo-core'),
				'bottom' => __('Bottom', 'themedo-core'),
				'left' => __('Left', 'themedo-core'),
				'Right' => __('Right', 'themedo-core'),
			)
		),
		'content' => array(
			'std' => __('Text', 'themedo-core'),
			'type' => 'text',
			'label' => __( 'Triggering Content', 'themedo-core' ),
			'desc' => __( 'Content that will trigger the popover.', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[popover title="{{title}}" title_bg_color="{{titlebgcolor}}" content="{{popovercontent}}" content_bg_color="{{contentbgcolor}}" bordercolor="{{bordercolor}}" textcolor="{{textcolor}}" trigger="{{trigger}}" placement="{{placement}}" class="{{class}}" id="{{id}}"]{{content}}[/popover]', // as there is no wrapper shortcode
	'popup_title' => __( 'Popover Shortcode', 'themedo-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['pricingtable'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'themedo-core' ),
			'desc' => __( 'Select the type of pricing table', 'themedo-core' ),
			'options' => array(
				'1' => __('Style 1', 'themedo-core'),
				'2' => __('Style 2', 'themedo-core'),
			)
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'themedo-core' ),
			'desc' => __('Controls the background color. Leave blank for theme option selection.', 'themedo-core')
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'themedo-core' ),
			'desc' => __('Controls the border color. Leave blank for theme option selection.', 'themedo-core')
		),
		'dividercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Divider Color', 'themedo-core' ),
			'desc' => __('Controls the divider color. Leave blank for theme option selection.', 'themedo-core')
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'themedo-core' ),
			'desc' => __('Select how many columns to display', 'themedo-core'),
			'options' => array(
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '1 Column',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '2 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '3 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '4 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '5 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '6 Columns'
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[pricing_table type="{{type}}" backgroundcolor="{{backgroundcolor}}" bordercolor="{{bordercolor}}" dividercolor="{{dividercolor}}" class="{{class}}" id="{{id}}"]{{columns}}[/pricing_table]',
	'popup_title' => __( 'Pricing Table Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['progressbar'] = array(
	'params' => array(

		'value' => array(
			'type' => 'select',
			'label' => __( 'Filled Area Percentage', 'themedo-core' ),
			'desc' => __( 'From 1% to 100%', 'themedo-core' ),
			'options' => avalon_td_shortcodes_range( 100, false )
		),
		'content' => array(
			'std' => __('Text', 'themedo-core'),
			'type' => 'text',
			'label' => __( 'Progess Bar Text', 'themedo-core' ),
			'desc' => __( 'Text will show up on progess bar', 'themedo-core' ),
		),
		'filledcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Filled Color', 'themedo-core' ),
			'desc' => __( 'Controls the color of the filled in area. Leave blank for theme option selection.', 'themedo-core' )
		),
		'striped' => array(
			'type' => 'select',
			'label' => __( 'Striped Filling', 'themedo-core' ),
			'desc' => __( 'Choose to get the filled area striped.', 'themedo-core' ),
			'options' => array(
							"on" => "On",
							"off" => "Off",
						)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'themedo-core' ),
			'desc' => __( 'Set size of the shortcode.', 'themedo-core' ),
			'options' => array(
							"small" => "Small",
							"medium" => "Medium",
							"big" => "Big",
						)
		),
		'rounded' => array(
			'type' => 'select',
			'label' => __( 'Rounded Corner', 'themedo-core' ),
			'desc' => __( 'Set rounded corner', 'themedo-core' ),
			'options' => array(
							"off" => "On",
							"a" => "Small",
							"b" => "Medium",
							"c" => "Large",
						)
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),			
		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[progress value="{{value}}" filledcolor="{{filledcolor}}" striped="{{striped}}" size="{{size}}" rounded="{{rounded}}" class="{{class}}" id="{{id}}"]{{content}}[/progress]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Posts Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['recentposts'] = array(
	'no_preview' => true,
	'params' => array(

			
		'post_number' => array(
			'std' => 3,
			'type' => 'text',
			'label' => __( 'Number of Posts', 'themedo-core' ),
			'desc' => __('Select the number of posts to display', 'themedo-core')
		),
		'bg' => array(
			'type' => 'uploader',
			'label' => __( 'Background Image', 'themedo-core' ),
			'desc' => __('Upload Image', 'themedo-core')
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[recent_posts post_number="{{post_number}}" bg="{{bg}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"][/recent_posts]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Gallery Block Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['galleryblock'] = array(
	'no_preview' => true,
	'params' => array(
		'layout' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Layout', 'themedo-core' ),
			'desc' 		=> __('Choose the layout for the shortcode', 'themedo-core'),
			'options' 	=> array(
				'slider' 			=> __('Slider', 'themedo-core'),
				'halfimg' 			=> __('Half Img', 'themedo-core'),
				'split' 			=> __('Split', 'themedo-core'),
				'fullscreen' 		=> __('Fullscreen', 'themedo-core'),
				'fullwidth' 		=> __('Fullwidth', 'themedo-core'),
				'creative1' 		=> __('Creative A', 'themedo-core'),
				//'creative2' 		=> __('Creative B', 'themedo-core'),
			)
		),	
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'themedo-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'themedo-core' ),
			'options' => avalon_td_shortcodes_categories( 'portfolio_category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'themedo-core' ),
			'desc' => __( 'Select a category to exclude', 'themedo-core' ),
			'options' => avalon_td_shortcodes_categories( 'portfolio_category' )
		),		
		'post_count' => array(
			'std' => 4,
			'type' => 'text',
			'label' => __( 'Number of Posts', 'themedo-core' ),
			'desc' => __('Select the number of posts to display', 'themedo-core')
		),
		'order' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Order Posts', 'themedo-core' ),
			'desc' 		=> __('Choose ordering type for posts', 'themedo-core'),
			'options' 	=> array(
				'' 				=> __('Newness', 'themedo-core'),
				'rand' 			=> __('Random', 'themedo-core'),
			)
		),	
		'offset' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Post Offset', 'themedo-core' ),
			'desc' => __('The number of posts to skip. ex: 1.', 'themedo-core')
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),				
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[gallery_block layout="{{layout}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" post_count="{{post_count}}" order="{{order}}" offset="{{offset}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}"  class="{{class}}" id="{{id}}"][/gallery_block]',
	'popup_title' => __( 'Gallery Block Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Section Separator Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['sectionseparator'] = array(
	'no_preview' => true,
	'params' => array(
		'divider_candy' => array(
			'type' => 'select',
			'label' => __( 'Position of the Divider Candy', 'themedo-core' ),
			'desc' => __( 'Select the position of the triangle candy.', 'themedo-core' ),
			'options' => array(
				'top' => __('Top', 'themedo-core'),
				'bottom' => __('Bottom', 'themedo-core'),
				'bottom,top' => __('Top and Bottom', 'themedo-core'),
			)
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'themedo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'themedo-core' ),
			'options' => $icons
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'themedo-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'themedo-core' )
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'themedo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'themedo-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color of Divider Candy', 'themedo-core' ),
			'desc' => __( 'Controls the background color of the triangle. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[section_separator divider_candy="{{divider_candy}}" icon="{{icon}}" icon_color="{{iconcolor}}" bordersize="{{border}}" bordercolor="{{bordercolor}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Section Separator Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(

		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Style', 'themedo-core' ),
			'desc' => __( 'Choose the separator line style', 'themedo-core' ),
			'options' => array(
				'none' => __('No Style', 'themedo-core'),
				'single' => __('Single Border Solid', 'themedo-core'),
				'double' => __('Double Border Solid', 'themedo-core'),
				'single|dashed' => __('Single Border Dashed', 'themedo-core'),
				'double|dashed' => __('Double Border Dashed', 'themedo-core'),
				'single|dotted' => __('Single Border Dotted', 'themedo-core'),
				'double|dotted' => __('Double Border Dotted', 'themedo-core'),
				'shadow' => __('Shadow', 'themedo-core')
			)
		),	
		'topmargin' => array(
			'std' => 40,
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Spacing above the separator. In pixels. Use a number without px.', 'themedo-core' ),
		),
		'bottommargin' => array(
			'std' => 40,
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Spacing below the separator. In pixels. Use a number without px.', 'themedo-core' ),
		),
		'sepcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Separator Color', 'themedo-core' ),
			'desc' => __( 'Controls the separator color. Leave blank for theme option selection.', 'themedo-core' )
		),
		'border_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Border Size', 'themedo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'themedo-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'themedo-core' ),
			'options' => $icons
		),
		'icon_circle' => array(
			'type' => 'select',
			'label' => __( 'Circled Icon', 'themedo-core' ),
			'desc' => __( 'Choose to have a circle in separator color around the icon.', 'themedo-core' ),
			'options' => $choices_with_default
		),	
		'icon_circle_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Circle Color', 'themedo-core' ),
			'desc' => __( 'Controls the background color of the circle around the icon.', 'themedo-core' )
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Separator Width', 'themedo-core' ),
			'desc' => __( 'In pixels (px or %), ex: 1px, ex: 50%. Leave blank for full width.', 'themedo-core' ),
		),
		'alignment' => array(
			'std' => 'center',
			'type' => 'select',
			'label' => __( 'Alignment', 'themedo-core' ),
			'desc' => __( 'Select the separator alignment; only works when a width is specified.', 'themedo-core' ),
			'options' => array(
				'center' => __('Center', 'themedo-core'),
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
			)			
		),			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[separator style_type="{{style_type}}" top_margin="{{topmargin}}" bottom_margin="{{bottommargin}}"  sep_color="{{sepcolor}}" border_size="{{border_size}}" icon="{{icon}}" icon_circle="{{icon_circle}}" icon_circle_color="{{icon_circle_color}}" width="{{width}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Separator Shortcode', 'themedo-core' )
);



/*-----------------------------------------------------------------------------------*/
/*	Servicetabs Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['servicetabs'] = array(
	'no_preview' => true,
	'params' => array(
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[servicetabs margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/servicetabs]',
	'popup_title' => __('Insert Shortcode', 'themedo-core'),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Tab Title', 'themedo-core' ),
				'desc' => __( 'Title of the tab', 'themedo-core' ),
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'themedo-core' ),
				'desc' => __('Upload an image to display in the tab.', 'themedo-core')
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link', 'themedo-core' ),
				'desc' => __( 'Insert the link of the tab', 'themedo-core' ),
			),			
			'content' => array(
				'std' => __('Tab Content', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'Tab Content', 'themedo-core' ),
				'desc' => __( 'Add the tabs content', 'themedo-core' )
			)
		),
		'shortcode' => '[servicetab title="{{title}}" image="{{image}}" link="{{link}}"]{{content}}[/servicetab]',
		'clone_button' => __( 'Add Tab', 'themedo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Sharing Box Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['sharingbox'] = array(
	'no_preview' => true,
	'params' => array(
		'tagline' => array(
			'std' => __('Share This Story, Choose Your Platform!', 'themedo-core'),
			'type' => 'text',
			'label' => __( 'Tagline', 'themedo-core' ),
			'desc' => __('The title tagline that will display', 'themedo-core')
		),
		'taglinecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Tagline Color', 'themedo-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'themedo-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'themedo-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'themedo-core')
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'themedo-core' ),
			'desc' => __('The post title that will be shared', 'themedo-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'themedo-core' ),
			'desc' => __('The link that will be shared', 'themedo-core')
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Description', 'themedo-core' ),
			'desc' => __('The description that will be shared', 'themedo-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link to Share', 'themedo-core' ),
			'desc' => ''
		),
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'themedo-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'themedo-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'themedo-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'themedo-core' ),
		),	
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'themedo-core' ),
			'desc' => __( 'Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'themedo-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'themedo-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'top' => __('Top', 'themedo-core'),
				'bottom' => __('Bottom', 'themedo-core'),
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
			)
		),		
		'pinterest_image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Choose Image to Share on Pinterest', 'themedo-core' ),
			'desc' => ''
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[sharing tagline="{{tagline}}" tagline_color="{{taglinecolor}}" title="{{title}}" link="{{link}}" description="{{description}}" pinterest_image="{{pinterest_image}}" icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" box_colors="{{boxcolor}}" icon_colors="{{iconcolor}}" tooltip_placement="{{icontooltip}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"][/sharing]',
	'popup_title' => __( 'Sharing Box Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Slider Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['slider'] = array(
	'params' => array(
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'themedo-core' ),
			'desc' => __('Select the hover effect type.', 'themedo-core'),
			'options' => array(
				'none' => __('None', 'themedo-core'),
				'zoomin' => __('Zoom In', 'themedo-core'),
				'zoomout' => __('Zoom Out', 'themedo-core'),
				'liftup' => __('Lift Up', 'themedo-core')
			)
		),
		'size' => array(
			'std' => '100%',
			'type' => 'size',
			'label' => __( 'Image Size (Width/Height)', 'themedo-core' ),
			'desc' => __( 'Width and Height in percentage (%) or pixels (px)', 'themedo-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[slider hover_type="{{hover_type}}" width="{{size_width}}" height="{{size_height}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/slider]', // as there is no wrapper shortcode
	'popup_title' => __( 'Slider Shortcode', 'themedo-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'slider_type' => array(
				'type' => 'select',
				'label' => __( 'Slide Type', 'themedo-core' ),
				'desc' => __('Choose a video or image slide', 'themedo-core'),
				'options' => array(
					'image' => __('Image', 'themedo-core'),
					'video' => __('Video', 'themedo-core')
				)
			),
			'video_content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Video Shortcode or Video Embed Code', 'themedo-core' ),
				'desc' => __('Click the Youtube or Vimeo Shortcode button below then enter your unique video ID, or copy and paste your video embed code.<a href=\'[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]\' class="themedo-shortcodes-button themedo-add-video-shortcode">Insert Youtube Shortcode</a><a href=\'[vimeo id="Enter video ID (eg. 10145153)" width="600" height="350"]\' class="themedo-shortcodes-button themedo-add-video-shortcode">Insert Vimeo Shortcode</a>', 'themedo-core')
			),
			'image_content' => array(
				'std' => '',
				'type' => 'uploader',
				'label' => __( 'Slide Image', 'themedo-core' ),
				'desc' => __('Upload an image to display in the slide', 'themedo-core')
			),
			'image_url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Full Image Link or External Link', 'themedo-core' ),
				'desc' => __('Add the url of where the image will link to. If lightbox option is enabled,and you don\'t add the full image link, lightbox will open slide image', 'themedo-core')
			),
			'image_target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'themedo-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'themedo-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image_lightbox' => array(
				'type' => 'select',
				'label' => __( 'Lighbox', 'themedo-core' ),
				'desc' => __( 'Show image in Lightbox', 'themedo-core' ),
				'options' => $choices
			),
		),
		'shortcode' => '[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]',
		'clone_button' => __( 'Add New Slide', 'themedo-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Social Links Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['sociallinks'] = array(
	'no_preview' => true,
	'params' => array(
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'themedo-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'themedo-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'themedo-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'themedo-core' ),
		),
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'themedo-core' ),
			'desc' => __( 'Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'themedo-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'themedo-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'top' => __('Top', 'themedo-core'),
				'bottom' => __('Bottom', 'themedo-core'),
				'left' => __('Left', 'themedo-core'),
				'Right' => __('Right', 'themedo-core'),
			)
		),			
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'themedo-core' ),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'themedo-core' ),
		),
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Instagram Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Instagram link', 'themedo-core' ),
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'themedo-core' ),
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'themedo-core' ),
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'LinkedIn Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom LinkedIn link', 'themedo-core' ),
		),
		'blogger' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Blogger Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Blogger link', 'themedo-core' ),
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'themedo-core' ),
		),
		'reddit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Reddit Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Reddit link', 'themedo-core' ),
		),
		'yahoo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Yahoo Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Yahoo link', 'themedo-core' ),
		),
		'deviantart' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Deviantart Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Deviantart link', 'themedo-core' ),
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'themedo-core' ),
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'themedo-core' ),
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Pinterst Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Pinterest link', 'themedo-core' ),
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'RSS Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom RSS link', 'themedo-core' ),
		),		
		'digg' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Digg Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Digg link', 'themedo-core' ),
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'themedo-core' ),
		),
		'forrst' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Forrst Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Forrst link', 'themedo-core' ),
		),
		'myspace' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Myspace Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Myspace link', 'themedo-core' ),
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom Skype link', 'themedo-core' ),
		),
		'paypal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'PayPal Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom paypal link', 'themedo-core' ),
		),
		'dropbox' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dropbox Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom dropbox link', 'themedo-core' ),
		),
		'soundcloud' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom soundcloud link', 'themedo-core' ),
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'VK Link', 'themedo-core' ),
			'desc' => __( 'Insert your custom vk link', 'themedo-core' ),
		),
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'themedo-core' ),
			'desc' => __( 'Insert an email address to display the email icon', 'themedo-core' ),
		),
		'show_custom' => array(
			'type' => 'select',
			'label' => __( 'Show Custom Social Icon', 'themedo-core' ),
			'desc' => __( 'Show the custom social icon specified in Theme Options', 'themedo-core' ),
			'options' => $reverse_choices
		),
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'themedo-core' ),
			'desc' => __( 'Select the icon\'s alignment.', 'themedo-core' ),
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'center' => __('Center', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[social_links icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" icon_colors="{{iconcolor}}" box_colors="{{boxcolor}}" tooltip_placement="{{icontooltip}}" rss="{{rss}}" facebook="{{facebook}}" twitter="{{twitter}}" instagram="{{instagram}}" dribbble="{{dribbble}}" google="{{google}}" linkedin="{{linkedin}}" blogger="{{blogger}}" tumblr="{{tumblr}}" reddit="{{reddit}}" yahoo="{{yahoo}}" deviantart="{{deviantart}}" vimeo="{{vimeo}}" youtube="{{youtube}}" pinterest="{{pinterest}}" digg="{{digg}}" flickr="{{flickr}}" forrst="{{forrst}}" myspace="{{myspace}}" skype="{{skype}}" paypal="{{paypal}}" dropbox="{{dropbox}}" soundcloud="{{soundcloud}}" vk="{{vk}}" email="{{email}}" show_custom="{{show_custom}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Social Links Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	SoundCloud Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['soundcloud'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Url', 'themedo-core' ),
			'desc' => __('The SoundCloud url, ex: http://api.soundcloud.com/tracks/110813479', 'themedo-core')
		),
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'themedo-core' ),
			'desc' => __('Choose the layout of the soundcloud embed.', 'themedo-core'),
			'options' => array( 'classic' => 'Classic', 'visual' => 'Visual' )
		),			
		'comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comments', 'themedo-core' ),
			'desc' => __('Choose to display comments', 'themedo-core'),
			'options' => $choices
		),
		'show_related' => array(
			'type' => 'select',
			'label' => __( 'Show Related', 'themedo-core' ),
			'desc' => __('Choose to display related items.', 'themedo-core'),
			'options' => $choices
		),	
		'show_user' => array(
			'type' => 'select',
			'label' => __( 'Show User', 'themedo-core' ),
			'desc' => __('Choose to display the user who posted the item.', 'themedo-core'),
			'options' => $choices
		),		
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'themedo-core' ),
			'desc' => __('Choose to autoplay the track', 'themedo-core'),
			'options' => $reverse_choices
		),
		'color' => array(
			'type' => 'colorpicker',
			'std' => '#ff7700',
			'label' => __( 'Color', 'themedo-core' ),
			'desc' => __('Select the color of the shortcode', 'themedo-core')
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Width', 'themedo-core' ),
			'desc' => __('In pixels (px) or percentage (%)', 'themedo-core')
		),
		'height' => array(
			'std' => '150px',
			'type' => 'text',
			'label' => __( 'Height', 'themedo-core' ),
			'desc' => __('In pixels (px)', 'themedo-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[soundcloud url="{{url}}" layout="{{layout}}" comments="{{comments}}" show_related="{{show_related}}" show_user="{{show_user}}" auto_play="{{autoplay}}" color="{{color}}" width="{{width}}" height="{{height}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Sharing Box Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Table Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['table'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'themedo-core' ),
			'desc' => __( 'Select the table style', 'themedo-core' ),
			'options' => array(
				'1' => __('Style 1', 'themedo-core'),
				'2' => __('Style 2', 'themedo-core'),
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'themedo-core' ),
			'desc' => __('Select how many columns to display', 'themedo-core'),
			'options' => array(
				'1' => '1 Column',
				'2' => '2 Columns',
				'3' => '3 Columns',
				'4' => '4 Columns',
				'5' => '5 Columns',
				'6' => '6 Columns'				
			)
		)
	),
	'shortcode' => '',
	'popup_title' => __( 'Table Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['tabs'] = array(
	'no_preview' => true,
	'params' => array(
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'themedo-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'themedo-core' ),
			'options' => array(
				'light' => __('Light', 'themedo-core'),
				'dark' => __('Dark', 'themedo-core')
			)
		),	
		'position' => array(
			'type' => 'select',
			'label' => __( 'Horizontal Position', 'themedo-core' ),
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
				'center' => __('Center', 'themedo-core')
			)
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[avalon_td_tabs skin="{{skin}}" position="{{position}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}"  class="{{class}}" id="{{id}}"]{{child_shortcode}}[/avalon_td_tabs]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Tab Title', 'themedo-core' ),
				'desc' => __( 'Title of the tab', 'themedo-core' ),
			),		
			'content' => array(
				'std' => __('Tab Content', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'Tab Content', 'themedo-core' ),
				'desc' => __( 'Add the tabs content', 'themedo-core' )
			)
		),
		'shortcode' => '[avalon_td_tab title="{{title}}"]{{content}}[/avalon_td_tab]',
		'clone_button' => __( 'Add Tab', 'themedo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['accordion'] = array(
	'no_preview' => true,
	'params' => array(
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'themedo-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'themedo-core' ),
			'options' => array(
				'light' => __('Light', 'themedo-core'),
				'dark' => __('Dark', 'themedo-core')
			)
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[accordion skin="{{skin}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/accordion]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Accordion Title', 'themedo-core' ),
				'desc' => __( 'Title of the accordion', 'themedo-core' ),
			),
			'open' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Open', 'themedo-core' ),
				'desc' 		=> __( 'Choose to have the accordion open', 'themedo-core' ),
				'std' 		=> 'no',
				'options' 	=> array(
					'no' 		=> __('No', 'themedo-core'),
					'yes' 		=> __('Yes', 'themedo-core')
				)
			),			
			'content' => array(
				'std' => __('Accordion Content', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'Accordion Content', 'themedo-core' ),
				'desc' => __( 'Add the accordion content', 'themedo-core' )
			)
		),
		'shortcode' => '[acc title="{{title}}" open="{{open}}"]{{content}}[/acc]',
		'clone_button' => __( 'Add New', 'themedo-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['toggle'] = array(
	'no_preview' => true,
	'params' => array(
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'themedo-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'themedo-core' ),
			'options' => array(
				'light' => __('Light', 'themedo-core'),
				'dark' => __('Dark', 'themedo-core')
			)
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[toggle skin="{{skin}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/toggle]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'themedo-core'),
				'type' => 'text',
				'label' => __( 'Toggle Title', 'themedo-core' ),
				'desc' => __( 'Title of the toggle', 'themedo-core' ),
			),		
			'content' => array(
				'std' => __('Toggle Content', 'themedo-core'),
				'type' => 'textarea',
				'label' => __( 'Toggle Content', 'themedo-core' ),
				'desc' => __( 'Add the toggle content', 'themedo-core' )
			)
		),
		'shortcode' => '[tog title="{{title}}"]{{content}}[/tog]',
		'clone_button' => __( 'Add New', 'themedo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Expandable Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['expandable'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __( 'Title', 'themedo-core' ),
			'desc' 	=> __( 'Insert the title of the expandable box', 'themedo-core' ),
		),	
		'content' => array(
			'std' 	=> '',
			'type' 	=> 'textarea',
			'label' => __( 'Content', 'themedo-core' ),
			'desc' 	=> __( 'Insert the content of the expandable box', 'themedo-core' ),
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[toggle title="{{title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/toggle]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),

);


/*-----------------------------------------------------------------------------------*/
/*	Countdown Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['countdown'] = array(
	'no_preview' => true,
	'params' => array(
		'time' => array(
			'std' 	=> '09:50',
			'type' 	=> 'text',
			'label' => __( 'Time', 'themedo-core' ),
			'desc' 	=> __( 'IInsert the end time. Example: 09:50', 'themedo-core' ),
		),
		'date' => array(
			'std' 	=> 'April 1 2017',
			'type' 	=> 'text',
			'label' => __( 'Date', 'themedo-core' ),
			'desc' 	=> __( 'Insert the end date. Example: April 1 2017', 'themedo-core' ),
		),
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'themedo-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'themedo-core' ),
			'options' => array(
				'light' => __('Light', 'themedo-core'),
				'dark' => __('Dark', 'themedo-core')
			)
		),	
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'themedo-core' ),
			'desc' => __( 'Set size of the shortcode.', 'themedo-core' ),
			'options' => array(
				'big' 	 => __('Big', 'themedo-core'),
				'medium' => __('Medium', 'themedo-core'),
				'small'  => __('Small', 'themedo-core')
			)
		),		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),

	'shortcode' => '[countdown time="{{time}}" date="{{date}}"  skin="{{skin}}"  size="{{size}}"  margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Insert Shortcode', 'themedo-core' ),

);

/*-----------------------------------------------------------------------------------*/
/*	Tagline Box Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['taglinebox'] = array(
	'no_preview' => true,
	'params' => array(
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'themedo-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'shadow' => array(
			'type' => 'select',
			'label' => __( 'Shadow', 'themedo-core' ),
			'desc' => __( 'Show the shadow below the box', 'themedo-core' ),
			'options' => $reverse_choices
		),
		'shadowopacity' => array(
			'type' => 'select',
			'label' => __( 'Shadow Opacity', 'themedo-core' ),
			'desc' => __( 'Choose the opacity of the shadow', 'themedo-core' ),
			'options' => $dec_numbers
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'themedo-core' ),
			'desc' => __( 'In pixels (px), ex: 1px', 'themedo-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'themedo-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'themedo-core' ),
		),
		'highlightposition' => array(
			'type' => 'select',
			'label' => __( 'Highlight Border Position', 'themedo-core' ),
			'desc' => __( 'Choose the position of the highlight. This border highlight is from theme options primary color and does not take the color from border color above', 'themedo-core' ),
			'options' => array(
				'top' => __('Top', 'themedo-core'),
				'bottom' => __('Bottom', 'themedo-core'),
				'left' => __('Left', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
				'none' => __('None', 'themedo-core'),
			)
		),
		'contentalignment' => array(
			'type' => 'select',
			'label' => __( 'Content Alignment', 'themedo-core' ),
			'desc' => __( 'Choose how the content should be displayed.', 'themedo-core' ),
			'options' => array(
				'left' => __('Left', 'themedo-core'),
				'center' => __('Center', 'themedo-core'),
				'right' => __('Right', 'themedo-core'),
			)
		),		
		'button' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Text', 'themedo-core' ),
			'desc' => __( 'Insert the text that will display in the button', 'themedo-core' ),
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'themedo-core' ),
			'desc' => __( 'The url the button will link to', 'themedo-core')
		),		
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'themedo-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'themedo-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Window Anchor', 'themedo-core' ),
			'desc' => __( 'Add the class name of the modal window you want to open on button click.', 'themedo-core' ),
		),			
		'buttonsize' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'themedo-core' ),
			'desc' => __( 'Select the button\'s size.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'small' => __('Small', 'themedo-core'),
				'medium' => __('Medium', 'themedo-core'),
				'large' => __('Large', 'themedo-core'),
				'xlarge' => __('XLarge', 'themedo-core'),
			)
		),
		'buttontype' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'themedo-core' ),
			'desc' => __( 'Select the button\'s type.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'flat' => __('Flat', 'themedo-core'),
				'3d' => '3D',
			)
		),
		'buttonshape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'themedo-core' ),
			'desc' => __( 'Select the button\'s shape.', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'square' => __('Square', 'themedo-core'),
				'pill' => __('Pill', 'themedo-core'),
				'round' => __('Round', 'themedo-core'),
			)
		),		
		'buttoncolor' => array(
			'type' => 'select',
			'label' => __( 'Button Color', 'themedo-core' ),
			'desc' => __( 'Choose the button color <br />Default uses theme option selection', 'themedo-core' ),
			'options' => array(
				'' => __('Default', 'themedo-core'),
				'green' => __('Green', 'themedo-core'),
				'darkgreen' => __('Dark Green', 'themedo-core'),
				'orange' => __('Orange', 'themedo-core'),
				'blue' => __('Blue', 'themedo-core'),
				'red' => __('Red', 'themedo-core'),
				'pink' => __('Pink', 'themedo-core'),
				'darkgray' => __('Dark Gray', 'themedo-core'),
				'lightgray' => __('Light Gray', 'themedo-core'),
			)
		),
		'title' => array(
			'type' => 'textarea',
			'label' => __( 'Tagline Title', 'themedo-core' ),
			'desc' => __( 'Insert the title text', 'themedo-core' ),
			'std' => __('Title', 'themedo-core')
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Tagline Description', 'themedo-core' ),
			'desc' => __( 'Insert the description text', 'themedo-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Additional Content', 'themedo-core' ),
			'desc' => __( 'This is additional content you can add to the tagline box. This will show below the title and description if one is used.', 'themedo-core' ),
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'themedo-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'themedo-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'themedo-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'themedo-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'themedo-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'themedo-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[tagline_box backgroundcolor="{{backgroundcolor}}" shadow="{{shadow}}" shadowopacity="{{shadowopacity}}" border="{{border}}" bordercolor="{{bordercolor}}" highlightposition="{{highlightposition}}" content_alignment="{{contentalignment}}" link="{{url}}" linktarget="{{target}}" modal="{{modal}}" button_size="{{buttonsize}}" button_shape="{{buttonshape}}" button_type="{{buttontype}}" buttoncolor="{{buttoncolor}}" button="{{button}}" title="{{title}}" description="{{description}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]{{content}}[/tagline_box]',
	'popup_title' => __( 'Insert Tagline Box Shortcode', 'themedo-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['testimonials'] = array(
	'no_preview' => true,
	'params' => array(
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'themedo-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'themedo-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[testimonials margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/testimonials]',
	'popup_title' => __( 'Insert Testimonials Shortcode', 'themedo-core' ),

	'child_shortcode' => array(
		'params' => array(
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Name', 'themedo-core' ),
				'desc' => __( 'Insert the name of the person.', 'themedo-core' ),
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Testimonial Content', 'themedo-core' ),
				'desc' => __( 'Add the testimonial content', 'themedo-core' ),
			)
		),
		'shortcode' => '[testimonial name="{{name}}"]{{content}}[/testimonial]',
		'clone_button' => __( 'Add Testimonial', 'themedo-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Title Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['customtitle'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'themedo-core' ),
			'desc' => __( 'Insert the title text', 'themedo-core' ),
		),
		'template' => array(
			'type' => 'select',
			'label' => __( 'Template', 'themedo-core' ),
			'desc' => '',
			'options' => array(
				'alpha' => __('Alpha', 'themedo-core'),
				'beta' => __('Beta', 'themedo-core'),
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'themedo-core' ),
			'desc' => '',
			'options' => array(
				'size1' => __('H1', 'themedo-core'),
				'size2' => __('H2', 'themedo-core'),
				'size3' => __('H3', 'themedo-core'),
				'size4' => __('H4', 'themedo-core'),
				'size5' => __('H5', 'themedo-core'),
				'size6' => __('H6', 'themedo-core'),
			)
		),
		'text_transform' => array(
			'type' => 'select',
			'label' => __( 'Text Transform', 'themedo-core' ),
			'desc' => '',
			'options' => array(
				'uppercase' 		=> __('Uppercase', 'themedo-core'),
				'lovercase' 		=> __('Lovercase', 'themedo-core'),
				'capitalize' 		=> __('Capitalize', 'themedo-core')
			)
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'themedo-core' ),
			'desc' => '',
			'options' => array(
				'left' 			=> __('Left', 'themedo-core'),
				'right' 		=> __('Right', 'themedo-core'),
				'center' 		=> __('Center', 'themedo-core')
			)
		),
		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Color', 'themedo-core' ),
			'desc' => ''
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Top Margin', 'themedo-core' ),
			'desc' => __( 'Spacing above the title. In px or em, e.g. 10px.', 'themedo-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Bottom Margin', 'themedo-core' ),
			'desc' => __( 'Spacing below the title. In px or em, e.g. 10px.', 'themedo-core' )
		),			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[customtitle template="{{template}}" size="{{size}}" text_transform={{text_transform}} text_align="{{text_align}}" color="{{color}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/customtitle]',
	'popup_title' => __( 'Sharing Box Shortcode', 'themedo-core' )
);



/*-----------------------------------------------------------------------------------*/
/*	Tooltip Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tooltip Text', 'themedo-core' ),
			'desc' => __( 'Insert the text that displays in the tooltip', 'themedo-core' )
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Position', 'themedo-core' ),
			'desc' => __( 'Choose the display position.', 'themedo-core' ),
			'options' => array(
				'top' => __('Top', 'themedo-core'),
				'bottom' => __('Bottom', 'themedo-core'),
				'left' => __('Left', 'themedo-core'),
				'Right' => __('Right', 'themedo-core'),
			)
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Trigger', 'themedo-core' ),
			'desc' => __( 'Choose action to trigger the tooltip.', 'themedo-core' ),
			'options' => array(
				'hover' => __('Hover', 'themedo-core'),
				'click' => __('Click', 'themedo-core'),
			)
		),			
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Content', 'themedo-core' ),
			'desc' => __( 'Insert the text that will activate the tooltip hover', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[tooltip title="{{title}}" placement="{{placement}}" trigger="{{trigger}}" class="{{class}}" id="{{id}}"]{{content}}[/tooltip]',
	'popup_title' => __( 'Tooltip Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'themedo-core' ),
			'desc' => __( 'For example the Video ID for <br />https://vimeo.com/75230326 is 75230326', 'themedo-core' )
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'themedo-core' ),
			'desc' => __( 'In pixels but only enter a number, ex: 600', 'themedo-core' )
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'themedo-core' ),
			'desc' => __( 'In pixels but enter a number, ex: 350', 'themedo-core' )
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'themedo-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'themedo-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'themedo-core' ),
			'desc' => __( 'Use additional API parameter, for example &title=0 to disable title on video. VimeoPlus account may be required.', 'themedo-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[vimeo id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Vimeo Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Featured Slider Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['woofeatured'] = array(
	'no_preview' => true,
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'themedo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'themedo-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'themedo-core'),
				'auto' => __('Auto', 'themedo-core')
			)
		),
		'carousel_layout' => array(
			'type' => 'select',
			'label' => __( 'Carousel Layout', 'themedo-core' ),
			'desc' => __( 'Choose to show titles on rollover image, or below image.', 'themedo-core' ),
			'options' => array(
				'title_on_rollover' => __('Title on rollover', 'themedo-core'),
				'title_below_image' => __('Title below image', 'themedo-core'),
			)
		),			
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'themedo-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'themedo-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'std' => '5',
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'themedo-core' ),
			'desc' => __('Select the number of max columns to display.', 'themedo-core'),
			'options' => avalon_td_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'themedo-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "themedo-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'themedo-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "themedo-core"),
		),	
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'themedo-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'themedo-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'themedo-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel.', 'themedo-core' ),
			'options' => $reverse_choices
		),		
		'show_cats' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'themedo-core' ),
			'desc' => __('Choose to show or hide the categories', 'themedo-core'),
			'options' => $reverse_choices
		),
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'themedo-core' ),
			'desc' => __('Choose to show or hide the price', 'themedo-core'),
			'options' => $reverse_choices
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'themedo-core' ),
			'desc' => __('Choose to show or hide the icon buttons', 'themedo-core'),
			'options' => $reverse_choices
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[featured_products_slider picture_size="{{picture_size}}" carousel_layout="{{carousel_layout}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Featured Products Slider Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Products Slider Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['wooproducts'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'themedo-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'themedo-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'themedo-core'),
				'auto' => __('Auto', 'themedo-core')
			)
		),
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'themedo-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'themedo-core' ),
			'options' => avalon_td_shortcodes_categories( 'product_cat' )
		),
		'number_posts' => array(
			'std' => 5,
			'type' => 'text',
			'label' => __( 'Number of Products', 'themedo-core' ),
			'desc' => __('Select the number of products to display', 'themedo-core')
		),
		'carousel_layout' => array(
			'type' => 'select',
			'label' => __( 'Carousel Layout', 'themedo-core' ),
			'desc' => __( 'Choose to show titles on rollover image, or below image.', 'themedo-core' ),
			'options' => array(
				'title_on_rollover' => __('Title on rollover', 'themedo-core'),
				'title_below_image' => __('Title below image', 'themedo-core'),
			)
		),			
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'themedo-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'themedo-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'std' => '5',
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'themedo-core' ),
			'desc' => __('Select the number of max columns to display.', 'themedo-core'),
			'options' => avalon_td_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '13',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'themedo-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "themedo-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'themedo-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "themedo-core"),
		),				
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'themedo-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'themedo-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'themedo-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel.', 'themedo-core' ),
			'options' => $reverse_choices
		),		
		'show_cats' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'themedo-core' ),
			'desc' => __('Choose to show or hide the categories', 'themedo-core'),
			'options' => $choices
		),
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'themedo-core' ),
			'desc' => __('Choose to show or hide the price', 'themedo-core'),
			'options' => $choices
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'themedo-core' ),
			'desc' => __('Choose to show or hide the icon buttons', 'themedo-core'),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),			
	),
	'shortcode' => '[products_slider picture_size="{{picture_size}}" cat_slug="{{cat_slug}}" number_posts="{{number_posts}}" carousel_layout="{{carousel_layout}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Products Slider Shortcode', 'themedo-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'themedo-core' ),
			'desc' => __('For example the Video ID for <br />http://www.youtube.com/LOfeCR7KqUs is LOfeCR7KqUs', 'themedo-core')
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'themedo-core' ),
			'desc' => __('In pixels but only enter a number, ex: 600', 'themedo-core')
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'themedo-core' ),
			'desc' => __('In pixels but only enter a number, ex: 350', 'themedo-core')
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'themedo-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'themedo-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'themedo-core' ),
			'desc' => __('Use additional API parameter, for example &rel=0 to disable related videos', 'themedo-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),		
	),
	'shortcode' => '[youtube id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Youtube Shortcode', 'themedo-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	themedo Slider Config
/*-----------------------------------------------------------------------------------*/

$avalon_td_shortcodes['themedoslider'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'type' => 'select',
			'label' => __( 'Slider Name', 'themedo-core' ),
			'desc' => __( 'This is the shortcode name that can be used in the post content area. It is usually all lowercase and contains only letters, numbers, and hyphens. ex: "themedoslider_slidernamehere"', 'themedo-core' ),
			'options' => avalon_td_shortcodes_categories( 'slide-page' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'themedo-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'themedo-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'themedo-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'themedo-core' )
		),
	),
	'shortcode' => '[themedoslider id="{{id}}" class="{{class}}" name="{{name}}"][/themedoslider]',
	'popup_title' => __( 'themedo Slider Shortcode', 'themedo-core' )
);