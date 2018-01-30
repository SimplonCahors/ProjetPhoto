<?php

	include_once(plugin_dir_path( __FILE__ ).'ReduxCore/framework.php');
	
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";


    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

//		$sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
		$sampleHTML = file_get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /*
     *
     * --> Action hook examples
     *
     */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'avalon_td_option',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    /*$args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );*/

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
	 
	 
	 
	/*-----------------------------------------------------------------------------------------------------*/
	/*----------------------------------------- CUSTOM THEME OPTIONS --------------------------------------*/
	/*-----------------------------------------------------------------------------------------------------*/
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'General', 'redux-framework-demo' ),
        'id'    => 'general',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id' 		=> 'layout_width',
				'type' 		=> 'button_set',
				'title' 	=> __('Layout Width', 'redux-framework-demo'),
				'subtitle' 	=> __('1200px / 960px', 'redux-framework-demo'),
				'options' 	=> array('a' => '1200px', 'b' => '960px'), //Must provide key => value pairs for radio options
				'default' 	=> 'a'
			),
			/*array(
				'id' 		=> 'layout_style',
				'type' 		=> 'button_set',
				'title' 	=> __('Layout Style', 'redux-framework-demo'),
				'subtitle' 	=> __('Wide / Boxed', 'redux-framework-demo'),
				'options' 	=> array('1' => 'Wide', '2' => 'Boxed'), //Must provide key => value pairs for radio options
				'default' 	=> '1'
			),*/
			array(
				'id' 		=> 'right_click',
				'type' 		=> 'button_set',
				'title' 	=> __('Right Click Protection', 'redux-framework-demo'),
				'subtitle' 	=> __('Enable / Disable', 'redux-framework-demo'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'right_click_text',
				'type' 		=> 'textarea',
				'title' 	=> __('Right Click Popup Message', 'redux-framework-demo'),
				'default' 	=> 'You can enable/disable right clicking from Theme Options and customize this message too.',
				'required' => array( 'right_click', '=', 'enable' ),
			),	
			
			/*array(
				'id' 		=> 'theme_skin',
				'type' 		=> 'button_set',
				'title' 	=> __('Theme Skin', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'options' 	=> array('light' => 'Light', 'dark' => 'Dark'), //Must provide key => value pairs for radio options
				'default' 	=> 'light'
			),*/
			array(
				'id' 		=> 'smooth_scroll',
				'type' 		=> 'button_set',
				'title' 	=> __('Smooth Scroll', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'options' 	=> array('on' => 'On', 'off' => 'Off'), //Must provide key => value pairs for radio options
				'default' 	=> 'off'
			),
			array(
				'id'		=> 'totop_button',
				'type' 		=> 'button_set',
				'title' 	=> __('To Top Scrolling Button', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> 'Enable', 
								'disable' 		=> 'Disable'),
								
			),
			array(
				'id' 		=> 'open_graph_meta',
				'type' 		=> 'button_set',
				'title' 	=> __('Open Graph Meta', 'redux-framework-demo'),
				'subtitle' 	=> __('If you disable this, social sharing may not work properly.', 'redux-framework-demo'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			/*array(
				'id' 		=> 'body_background',
				'type' 		=> 'background',
				'output' 	=> array('body'),
				'title' 	=> __('Body Background', 'redux-framework-demo'),
				'subtitle' 	=> __('Body background with image, color, etc.', 'redux-framework-demo'),
				//'default' => '#FFFFFF',
			),*/
			
		)
	));
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Header', 'redux-framework-demo' ),
        'id'    => 'header',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			
		
			array(
					'id'		=> 'topbar_bg',
					'type' 		=> 'select',
					'title' 	=> __('Navigation Background', 'redux-framework-demo'),
					'options' 	=> array(
						'simple'		=> esc_html__('Light', 'redux-framework-demo'),
						'transparent'	=> esc_html__('Light Transparent', 'redux-framework-demo'),
						'none'			=> esc_html__('Without Background (Dark Text)', 'redux-framework-demo'),
						'simple_d'		=> esc_html__('Dark', 'redux-framework-demo'),
						'transparent_d'	=> esc_html__('Dark Transparent', 'redux-framework-demo'),
						'none_d'		=> esc_html__('Without Background (Light Text)', 'redux-framework-demo'),
					),
					'default' 	=> 'simple'
			),
			array(
					'id'		=> 'sticky_nav',
					'type' 		=> 'button_set',
					'title' 	=> __('Sticky Navigation', 'redux-framework-demo'),
					'options' 	=> array('on' => 'Enable', 'off' => 'Disable'), //Must provide key => value pairs for radio options
					'default'	=> 'on'
			),
			array(
				'id' 		=> 'header_padding',
				'type' 		=> 'spacing',
				'output' 	=> array('.avalon_td_topbar .avalon_td_logo a'), // An array of CSS selectors to apply this font style to
				'mode' 		=> 'padding', // absolute, padding, margin, defaults to padding
				//'top' 	=> false, // Disable the top
				//'right' 	=> false, // Disable the right
				//'bottom'	=> false, // Disable the bottom
				//'left' 	=> false, // Disable the left
				//'all' 	=> true, // Have one field that applies to all
				'units' 	=> 'px', // You can specify a unit value. Possible: px, em, %
				//'units_extended' => 'true', // Allow users to select any type of unit
				//'display_units' => 'false', // Set to false to hide the units if the units are specified
				'title' 	=> __('Logo Wrap Padding Options', 'redux-framework-demo'),
				'subtitle' 	=> __('Change padding parameters of logo wrapper', 'redux-framework-demo'),
				'default' 	=> array('padding-top' => '30px', 'padding-right' => "0px", 'padding-bottom' => '30px', 'padding-left' => '0px')
			),
			array(
				'id'		=> 'avalon_td_logo',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> __('Upload Dark Logo', 'redux-framework-demo'),
				'subtitle' 	=> __('We suggest to use png logo', 'redux-framework-demo'),
			),
		array(
				'id'		=> 'avalon_td_logo_l',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> __('Upload Light Logo', 'redux-framework-demo'),
				'subtitle' 	=> __('We suggest to use png logo', 'redux-framework-demo'),
			),
			array(
				'id' 		=> 'logo_height',
				'type' 		=> 'text',
				'title' 	=> __('Logo Height', 'redux-framework-demo'),
				'subtitle' 	=> __('Default value is "26". Insert your logo\'s height value here.', 'redux-framework-demo'),
				'validate' 	=> 'numeric',
				'default' 	=> '26',
			),
			array(
				'id'		=> 'mobile_logo',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> __('Mobile: Upload Dark Logo', 'redux-framework-demo'),
				'subtitle' 	=> __('We suggest to use png logo', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'mobile_logo_l',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> __('Mobile: Upload Light Logo', 'redux-framework-demo'),
				'subtitle' 	=> __('We suggest to use png logo', 'redux-framework-demo'),
			),
			array(
				'id' 		=> 'mobile_logo_height',
				'type' 		=> 'text',
				'title' 	=> __('Mobile Logo Height', 'redux-framework-demo'),
				'subtitle' 	=> __('Default value is "26". Insert your logo\'s height value here.', 'redux-framework-demo'),
				'validate' 	=> 'numeric',
				'default' 	=> '26',
			),
			array(
				'id' 		=> 'submenu_topoffset',
				'type' 		=> 'button_set',
				'title' 	=> __('Submenu Top Offset', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'options' 	=> array('long' => 'Long', 'normal' => 'Normal', 'short' => 'Short'), //Must provide key => value pairs for radio options
				'default' 	=> 'long'
			),
			array(
				'id' 		=> 'topbar_search_icon',
				'type' 		=> 'button_set',
				'title' 	=> __('Search Icon', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'topbar_cart_icon',
				'type' 		=> 'button_set',
				'title' 	=> __('Cart Icon', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
							
		)
    ));
	Redux::setSection( $opt_name, array(
        'title' => __( 'Color', 'redux-framework-demo' ),
        'id'    => 'color',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(   
			array(
				'id' 		=> 'main_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> __('Main Color', 'redux-framework-demo'),
				'subtitle' 	=> __('Pick a color for theme (default: #c09f68).', 'redux-framework-demo'),
				'default' 	=> '#c09f68',
				'validate' 	=> 'color',
			),
			array(
				'id' 		=> 'bg_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> __('Background Color for Elements', 'redux-framework-demo'),
				'subtitle' 	=> __('Pick a color for background', 'redux-framework-demo'),
				'default' 	=> '#c09f68',
				'validate' 	=> 'color',
			),
			array(
				'id' 		=> 'button_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> __('Button Color', 'redux-framework-demo'),
				'subtitle' 	=> __('Pick a color for button', 'redux-framework-demo'),
				'default' 	=> '#000',
				'validate' 	=> 'color',
			),
		)
    ));
	Redux::setSection( $opt_name, array(
        'title' => __( 'Typography', 'redux-framework-demo' ),
        'id'    => 'typography',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id'		=> 'body_font',
				'type' 		=> 'typography',
				'title' 	=> __('Body Font', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify the body font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' => false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '14px',
					'font-family' 	=> 'Open Sans',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'nav_font',
				'type' 		=> 'typography',
				'title' 	=> __('Navigation Font', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify the navigation font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '14px',
					'font-family' 	=> 'Lato',
					'font-weight' 	=> '400',
				),
			),
			
			array(
				'id'		=> 'gallery_cover_font',
				'type' 		=> 'typography',
				'title' 	=> __('Gallery Cover Heading Font', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify the Gallery Cover Heading font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '16px',
					'font-family' 	=> 'Lato',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'gallery_single_font',
				'type' 		=> 'typography',
				'title' 	=> __('Single Page, Single Post and Single Gallery Font', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'font-size' => false,
				'text-align' => false,
				'default' 	=> array(
					'font-family' 	=> 'Lato',
					'font-weight' 	=> '700',
				),
			),
			
			array(
				'id'		=> 'quote_font',
				'type' 		=> 'typography',
				'title' 	=> __('Testimonial Font', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify the testimonial font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '21px',
					'font-family' 	=> 'Lora',
					'font-weight' 	=> '400',
				),
			),
			
			array(
				'id'		=> 'widget_font',
				'type' 		=> 'typography',
				'title' 	=> __('Widget Title', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify the widget title font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'default' 	=> array(
					'font-size' 	=> '17px',
					'font-family' 	=> 'Lato',
					'font-weight' 	=> '700',
				),
			),
			
			array(
				'id'		=> 'button_font',
				'type' 		=> 'typography',
				'title' 	=> __('Button Font', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify the button font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'default' 	=> array(
					'font-size' 	=> '14px',
					'font-family' 	=> 'Lato',
					'font-weight' 	=> '400',
				),
			),
		)
    ));
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Toggle Sidebar', 'themedo-core' ),
        'id'    => 'togglesidebar',
        'desc'  => __( '', 'themedo-core' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(   
			array(
				'id' 		=> 'toggle_sidebar',
				'type' 		=> 'button_set',
				'title' 	=> __('Enable/Disable Toggle Sidebar', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id'		=> 'facebook_side',
				'type' 		=> 'text',
				'title' 	=> __('Facebook', 'redux-framework-demo'),
				'default' 	=> '#',
			),
			array(
				'id'		=> 'twitter_side',
				'type' 		=> 'text',
				'title' 	=> __('Twitter', 'redux-framework-demo'),
				'default' 	=> '#',
			),
			array(
				'id'		=> 'pinterest_side',
				'type' 		=> 'text',
				'title' 	=> __('Pinterest', 'redux-framework-demo'),
				'default' 	=> '#',
			),
			array(
				'id'		=> 'linkedin_side',
				'type' 		=> 'text',
				'title' 	=> __('Linkedin', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'behance_side',
				'type' 		=> 'text',
				'title' 	=> __('Behance', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'vimeo_side',
				'type' 		=> 'text',
				'title' 	=> __('Vimeo', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'flickr_side',
				'type' 		=> 'text',
				'title' 	=> __('Flickr', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'skype_side',
				'type' 		=> 'text',
				'title' 	=> __('Skype', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'google_side',
				'type' 		=> 'text',
				'title' 	=> __('Google', 'redux-framework-demo'),
				'default' 	=> '#',
			),
			array(
				'id'		=> 'youtube_side',
				'type' 		=> 'text',
				'title' 	=> __('Youtube', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'instagram_side',
				'type' 		=> 'text',
				'title' 	=> __('Instagram', 'redux-framework-demo'),
				'default' 	=> '#',
			),
		)
    ));


	Redux::setSection( $opt_name, array(
        'title' => __( 'Share Settings', 'themedo-core' ),
        'id'    => 'sharebox',
        'desc'  => __( '', 'themedo-core' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(   
			array(
				'id' 		=> 'header_share_icon',
				'type' 		=> 'button_set',
				'title' 	=> __('Enable/Disable Header Share Icon', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_facebook',
				'type' 		=> 'button_set',
				'title' 	=> __('Facebook Share', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_twitter',
				'type' 		=> 'button_set',
				'title' 	=> __('Twitter Share', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_google',
				'type' 		=> 'button_set',
				'title' 	=> __('Google Plus Share', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_pinterest',
				'type' 		=> 'button_set',
				'title' 	=> __('Pinterest Share', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_linkedin',
				'type' 		=> 'button_set',
				'title' 	=> __('Linkedin Share', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_email',
				'type' 		=> 'button_set',
				'title' 	=> __('Email Share', 'themedo-core'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			
		)
    ));
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Hiring Settings', 'themedo-core' ),
        'id'    => 'hiring',
        'desc'  => __( '', 'themedo-core' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(   
			array(
				'id' 		=> '1',
				'type' 		=> 'info',
				'required' 	=> '',
				'desc' 		=> __('HIRE ME POPUP', 'themedo-core')
			),

			array(
				'id' 		=> 'hiring_receiver_email',
				'type' 		=> 'text',
				'title' 	=> __('Receiver Email', 'themedo-core'),
				'default' 	=> 'receiver@email.com',
			),
			array(
				'id' 		=> 'hiring_type',
				'type' 		=> 'button_set',
				'title' 	=> __('Hiring Type', 'themedo-core'),
				'options' 	=> array('in' => 'Default', 'ex' => 'External'), //Must provide key => value pairs for radio options
				'default' 	=> 'in'
			),
			array(
				'id' 		=> 'hiring_external',
				'type' 		=> 'text',
				'required'  => array( 'hiring_type', '=', 'ex' ),
				'title' 	=> __('External Link for Hiring', 'themedo-core'),
				'subtitle' 	=> __('You can use this option for external hiring system', 'themedo-core'),
				'validate' 	=> 'text',
				'default' 	=> '',
			),
			array(
				'id' 		=> 'hiring_open_type',
				'type' 		=> 'button_set',
				'required'  => array( 'hiring_type', '=', 'in' ),
				'title' 	=> __('Hiring Opening Animation', 'themedo-core'),
				'options' 	=> array('td-zoom-out' => 'Zoom Out', 'td-zoom-in' => 'Zoom In'), //Must provide key => value pairs for radio options
				'default' 	=> 'td-zoom-out'
			),
			array(
				'id' 		=> 'hiring_time_type',
				'type' 		=> 'button_set',
				'required'  => array( 'hiring_type', '=', 'in' ),
				'title' 	=> __('Hiring Time Type', 'themedo-core'),
				'options' 	=> array('M d, yy' => 'Jan 22, 2017', 'yy M d' => '2017 Jan 22', 'mm - dd - yy' => '01 - 22 - 2017', 'mm / dd / yy' => '01 / 22 / 2017'), //Must provide key => value pairs for radio options
				'default' 	=> 'M d, yy'
			),
			array(
				'id' 		=> 'hiring_start_time',
				'type' 		=> 'text',
				'required'  => array( 'hiring_type', '=', 'in' ),
				'title' 	=> __('Start Time', 'themedo-core'),
				'default' 	=> '09.00',
			),
			array(
				'id' 		=> 'hiring_end_time',
				'type' 		=> 'text',
				'required'  => array( 'hiring_type', '=', 'in' ),
				'title' 	=> __('End Time', 'themedo-core'),
				'default' 	=> '19.40',
			),			
			array(
				'id' 		=> 'hiring_time_step',
				'type' 		=> 'slider',
				'required'  => array( 'hiring_type', '=', 'in' ),
				'title' 	=> __('Time Step', 'themedo-core'),
				'subtitle' 	=> __('in seconds', 'themedo-core'),
				"default" 	=> "20",
				"min" 		=> "0",
				"step" 		=> "5",
				"max" 		=> "30",
			),
		)
    ));
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Gallery Page', 'redux-framework-demo' ),
        'id'    => 'gallerypage',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			
			array(
				'id' 		=> 'gallery_slug',
				'type' 		=> 'text',
				'title' 	=> __('Gallery Slug', 'themedo-core'),
				'subtitle' 	=> __('After changing this, go to "Settings -> Permalinks" and click "Save Changes" button', 'redux-framework-demo'),
				'default' 	=> 'project',
			),
			array(
				'id' 		=> 'gallery_cat_slug',
				'type' 		=> 'text',
				'title' 	=> __('Gallery Category Slug', 'themedo-core'),
				'subtitle' 	=> __('After changing this, go to "Settings -> Permalinks" and click "Save Changes" button', 'redux-framework-demo'),
				'default' 	=> 'project-cat',
			),
			array(
				'id'		=> 'gallery_page_cat_filter',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Page Category Filter', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  	=> __('Enable', 'redux-framework-demo'), 
								'disable' 	=> __('Disable', 'redux-framework-demo')),				
			),
			array(
				'id' 		=> 'password_background',
				'type' 		=> 'background',
				//'output' 	=> array('body'),
				'title' 	=> __('Password Page Background', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				//'default' => '#FFFFFF',
			),
			array(
				'id'		=> 'gallery_prev_next_order',
				'type' 		=> 'button_set',
				'title' 	=> __('Prev/Next Posts order', 'redux-framework-demo'),
				"default" 	=> 'default',
				'options' 	=> array(
								'default'  	=> __('Default', 'redux-framework-demo'), 
								'reverse' 	=> __('Reverse', 'redux-framework-demo')),
								
			),
		
			array(
				'id'		=> 'gallery_category_visibility',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Category', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  	=> __('Enable', 'redux-framework-demo'), 
								'disable' 	=> __('Disable', 'redux-framework-demo')),				
			),
			array(
				'id'		=> 'gallery_date_visibility',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Date', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  	=> __('Enable', 'redux-framework-demo'), 
								'disable' 	=> __('Disable', 'redux-framework-demo')),				
			),
			array(
				'id'		=> 'gallery_photonumber_visibility',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Number Of Photos', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  	=> __('Enable', 'redux-framework-demo'), 
								'disable' 	=> __('Disable', 'redux-framework-demo')),				
			),
			
			array(
				'id'		=> 'gallery_template',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Template', 'redux-framework-demo'),
				"default" 	=> 'alpha',
				'options' 	=> array(
								'alpha'  		=> 'Alpha',
								'alpha2'  		=> 'Alpha-2', 
								'beta' 			=> 'Beta',
								'gamma' 		=> 'Gamma',
								'delta' 		=> 'Delta',
								'epsilon' 		=> 'Epsilon'),
			),
			array(
				'id' 		=> 'gallery_alpha_galleryperpage',
				'type' 		=> 'slider',
				'title' 	=> __('Gallery Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "3",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "10",
				
				'required' => array( 'gallery_template', '=', array('alpha','alpha2') ),
			),
			/*array(
				'id'		=> 'gallery_alpha_post_template',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Type', 'redux-framework-demo'),
				"default" 	=> 'post',
				'options' 	=> array(
								'post'  		=> 'Post', 
								'masonry' 		=> 'Masonry'),
								
				'required' => array( 'gallery_template', '=', 'alpha' ),
			),*/
			array(
				'id' 		=> 'gallery_alpha_postsperpage',
				'type' 		=> 'slider',
				'title' 	=> __('Gallery Images Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "9",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "50",
				
				'required' => array( 'gallery_template', '=', 'alpha' ),
			),
			array(
				'id'		=> 'gallery_alpha_columns',
				'type' 		=> 'button_set',
				'title' 	=> __('Columns Number', 'redux-framework-demo'),
				"default" 	=> '3',
				'options' 	=> array(
								'1'  	=> '1', 
								'2' 	=> '2',
								'3' 	=> '3',
								'4' 	=> '4'),
								
				'required' => array( 'gallery_template', '=', 'alpha' ),
			),
			array(
				'id'		=> 'gallery_alpha_gutter',
				'type' 		=> 'button_set',
				'title' 	=> __('Columns Gutter', 'redux-framework-demo'),
				"default" 	=> 'b',
				'options' 	=> array(
								'a'  		=> 'Gutter 1', 
								'b' 		=> 'Gutter 2',
								'c'  		=> 'Gutter 3', 
								'd' 		=> 'Gutter 4',
								'e' 		=> 'Gutter 5',
								'off' 		=> 'Disable'),
								
				'required' => array( 'gallery_template', '=', 'alpha' ),
			),
			array(
				'id'		=> 'gallery_alpha_imgheight',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Images Height', 'redux-framework-demo'),
				"default" 	=> 'diff',
				'options' 	=> array(
								'equal'  		=> 'Equal Height', 
								'diff' 			=> 'Different'),
								
				'required' => array( 'gallery_template', '=', 'alpha' ),
			),
			array(
				'id'		=> 'gallery_alpha_lightbox',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Lightbox', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> 'Enable', 
								'disable' 		=> 'Disable'),
								
				'required' => array( 'gallery_template', '=', 'alpha' ),
			),
			array(
				'id'		=> 'gallery_alpha_imgtitle',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Images Title', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> 'Enable', 
								'disable' 		=> 'Disable'),
								
				'required' => array( 'gallery_template', '=', 'alpha' ),
			),
			
			// beta
			array(
				'id' 		=> 'gallery_beta_galleryperpage',
				'type' 		=> 'slider',
				'title' 	=> __('Gallery Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "3",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "10",
				
				'required' => array( 'gallery_template', '=', 'beta' ),
			),
			array(
				'id' 		=> 'gallery_beta_postsperpage',
				'type' 		=> 'slider',
				'title' 	=> __('Gallery Images Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "3",
				"step" 		=> "1",
				"max" 		=> "60",
				
				'required' => array( 'gallery_template', '=', 'beta' ),
			),
			array(
				'id'		=> 'gallery_beta_lightbox',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Lightbox', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> 'Enable', 
								'disable' 		=> 'Disable'),
								
				'required' => array( 'gallery_template', '=', 'beta' ),
			),
			
			// gamma
			array(
				'id' 		=> 'gallery_gamma_galleryperpage',
				'type' 		=> 'slider',
				'title' 	=> __('Gallery Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "40",
				
				'required' => array( 'gallery_template', '=', 'gamma' ),
			),
			array(
				'id'		=> 'gallery_gamma_lightbox',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Lightbox', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> 'Enable', 
								'disable' 		=> 'Disable'),
								
				'required' => array( 'gallery_template', '=', 'gamma' ),
			),
			
			// delta
			array(
				'id' 		=> 'gallery_delta_galleryperpage',
				'type' 		=> 'slider',
				'title' 	=> __('Gallery Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "8",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "40",
				
				'required' => array( 'gallery_template', '=', 'delta' ),
			),
			array(
				'id'		=> 'gallery_delta_cols',
				'type' 		=> 'button_set',
				'title' 	=> __('Columns Number', 'redux-framework-demo'),
				"default" 	=> '4',
				'options' 	=> array(
								'4' 	=> '4',
								'5' 	=> '5'),
								
				'required' => array( 'gallery_template', '=', 'delta' ),
			),
			/*array(
				'id'		=> 'gallery_delta_gutter',
				'type' 		=> 'button_set',
				'title' 	=> __('Columns Gutter', 'redux-framework-demo'),
				"default" 	=> 'b',
				'options' 	=> array(
								'a' 	=> 'Gutter 1',
								'b' 	=> 'Gutter 2',
								'off' 	=> 'Disable'),
								
				'required' => array( 'gallery_template', '=', 'delta' ),
			),*/
			array(
				'id'		=> 'gallery_delta_imgsize',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Image Size', 'redux-framework-demo'),
				"default" 	=> 'wide',
				'options' 	=> array(
								'wide'  		=> 'Wide Width', 
								'boxed' 		=> 'Square'),
								
				'required' => array( 'gallery_template', '=', 'delta' ),
			),
			array(
				'id'		=> 'gallery_delta_thumbs',
				'type' 		=> 'button_set',
				'title' 	=> __('Gallery Hover Slider', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> 'Enable', 
								'disable' 		=> 'Disable'),
								
				'required' => array( 'gallery_template', '=', 'delta' ),
			),
			
			// epsilon
			array(
				'id' 		=> 'gallery_epsilon_galleryperpage',
				'type' 		=> 'slider',
				'title' 	=> __('Gallery Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "40",
				
				'required' => array( 'gallery_template', '=', 'epsilon' ),
			),
			array(
				'id' 		=> 'gallery_epsilon_image_width',
				'type' 		=> 'slider',
				'title' 	=> __('Image Width', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "600",
				"min" 		=> "300",
				"step" 		=> "10",
				"max" 		=> "2000",
				
				'required' => array( 'gallery_template', '=', 'epsilon' ),
			),
			array(
				'id' 		=> 'gallery_epsilon_image_space',
				'type' 		=> 'slider',
				'title' 	=> __('Images Gutter', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "0",
				"min" 		=> "0",
				"step" 		=> "1",
				"max" 		=> "50",
				
				'required' => array( 'gallery_template', '=', 'epsilon' ),
			),
			
			
		)
    )); 
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Gallery Blocks', 'redux-framework-demo' ),
        'id'    => 'gallery_blocks',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id'		=> 'viewgallery_text',
				'type' 		=> 'text',
				'title' 	=> __('View Gallery Text', 'redux-framework-demo'),
				'default' 	=> "View Gallery",
			),			
		)
    )); 

	Redux::setSection( $opt_name, array(
        'title' => __( 'Purchase Button', 'redux-framework-demo' ),
        'id'    => 'purchase_button',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id' 		=> 'purchase_btn_text',
				'type' 		=> 'text',
				'title' 	=> __('Purchase Button Text', 'redux-framework-demo'),
				'subtitle' 	=> '',
				"default" 	=> __('Purchase', 'redux-framework-demo'),
			),				
		)
    )); 
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Clients Settings', 'redux-framework-demo' ),
        'id'    => 'clients',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id' 		=> 'client_slug',
				'type' 		=> 'text',
				'title' 	=> __('Client Slug', 'themedo-core'),
				'subtitle' 	=> __('After changing this, go to "Settings -> Permalinks" and click "Save Changes" button', 'redux-framework-demo'),
				'default' 	=> 'client',
			),
			array(
				'id' 		=> 'clients_per_page',
				'type' 		=> 'slider',
				'title' 	=> __('Clients Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "12",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "50",
			),				
		)
    ));  

	Redux::setSection( $opt_name, array(
        'title' => __( 'Events Settings', 'redux-framework-demo' ),
        'id'    => 'events',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id' 		=> 'event_slug',
				'type' 		=> 'text',
				'title' 	=> __('Event Slug', 'themedo-core'),
				'subtitle' 	=> __('After changing this, go to "Settings -> Permalinks" and click "Save Changes" button', 'redux-framework-demo'),
				'default' 	=> 'event',
			),
			array(
				'id' 		=> 'events_per_page',
				'type' 		=> 'slider',
				'title' 	=> __('Events Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "50",
			),				
		)
    ));  

	Redux::setSection( $opt_name, array(
        'title' => __( 'Proofing Settings', 'redux-framework-demo' ),
        'id'    => 'proofing',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id' 		=> 'proofing_slug',
				'type' 		=> 'text',
				'title' 	=> __('Proofing Slug', 'themedo-core'),
				'subtitle' 	=> __('After changing this, go to "Settings -> Permalinks" and click "Save Changes" button', 'redux-framework-demo'),
				'default' 	=> 'proofing',
			),			
		)
    ));  
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Pages Option', 'redux-framework-demo' ),
        'id'    => 'pages',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			
			array(
				'id' => 'archive_layout',
				'type' => 'image_select',
				'title' => __('Pages Layout', 'redux-framework-demo'),
				'subtitle' => __('Set pages( archive, search, eror pages ) layout appearance', 'redux-framework-demo'),
				'options' => array(
					'1' => array('alt' => '1 Column', 'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
					'2' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
					'3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cl.png')
				), //Must provide key => value(array:title|img) pairs for radio options
				'default' => '2'
			),
		)
    )); 
	Redux::setSection( $opt_name, array(
        'title' => __( 'Shop Settings', 'redux-framework-demo' ),
        'id'    => 'shop',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id' 		=> 'woo_per_page',
				'type' 		=> 'slider',
				'title' 	=> __('WooCommerce Products Number Per Page', 'redux-framework-demo'),
				'subtitle' 	=> __('WooCommerce Products Number Per Page', 'redux-framework-demo'),
				"default" 	=> "12",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "50",
			),				
		)
    ));  
	Redux::setSection( $opt_name, array(
        'title' => __( 'Footer', 'redux-framework-demo' ),
        'id'    => 'footer',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id'		=> 'footer',
				'type' 		=> 'button_set',
				'title' 	=> __('Footer', 'redux-framework-demo'),
				'subtitle' 	=> __('Enable/Disable Footer', 'redux-framework-demo'),
				'options'  	=> array(
                    'enable' 	=> 'Enable',
                    'disable' 	=> 'Disable',
                ),
				"default" 	=> 'enable'
			),
		
			array(
					'id'		=> 'footer_bg',
					'type' 		=> 'select',
					'title' 	=> __('Footer Background', 'redux-framework-demo'),
					'options' 	=> array(
						'simple'		=> esc_html__('Light', 'redux-framework-demo'),
						'transparent'	=> esc_html__('Light Transparent', 'redux-framework-demo'),
						'none'			=> esc_html__('Without Background (Dark Text)', 'redux-framework-demo'),
						'simple_d'		=> esc_html__('Dark', 'redux-framework-demo'),
						'transparent_d'	=> esc_html__('Dark Transparent', 'redux-framework-demo'),
						'none_d'		=> esc_html__('Without Background (Light Text)', 'redux-framework-demo'),
					),
					'default' 	=> 'simple'
			),	
		
			array(
				'id'		=> 'facebook_foot',
				'type' 		=> 'text',
				'title' 	=> __('Facebook Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'twitter_foot',
				'type' 		=> 'text',
				'title' 	=> __('Twitter Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'pinterest_foot',
				'type' 		=> 'text',
				'title' 	=> __('Pinterest Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'linkedin_foot',
				'type' 		=> 'text',
				'title' 	=> __('Linkedin Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'behance_foot',
				'type' 		=> 'text',
				'title' 	=> __('Behance Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'vimeo_foot',
				'type' 		=> 'text',
				'title' 	=> __('Vimeo Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'skype_foot',
				'type' 		=> 'text',
				'title' 	=> __('Skype Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'google_foot',
				'type' 		=> 'text',
				'title' 	=> __('Google Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'youtube_foot',
				'type' 		=> 'text',
				'title' 	=> __('Youtube Footer', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'instagram_foot',
				'type' 		=> 'text',
				'title' 	=> __('Instagram Footer', 'redux-framework-demo'),
			),
			array(
				'id' 		=> 'copyright',
				'type' 		=> 'textarea',
				'title' 	=> __('Copyright Text', 'redux-framework-demo'),
				'default' 	=> 'Copyright &copy; 2017. <a href="http://themeforest.net/user/themedo/portfolio" target="_blank">Themedo</a>',
			),				
		)
    )); 
	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Custom CSS', 'redux-framework-demo' ),
        'id'    => 'css',
        'desc'  => __( '', 'redux-framework-demo' ),
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			array(
				'id' 		=> 'custom_css',
				'type' 		=> 'textarea',
				'title' 	=> __('Custom CSS', 'redux-framework-demo'),
			),				
		)
    )); 
	
	
	/*-----------------------------------------------------------------------------------------------------*/
	/*---------------------------------------  END OF CUSTOM THEME OPTIONS --------------------------------*/
	/*-----------------------------------------------------------------------------------------------------*/
	


    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
