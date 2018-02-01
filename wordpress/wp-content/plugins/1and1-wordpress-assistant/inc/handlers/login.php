<?php

// Do not allow direct access!
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

/**
 * Class One_And_One_Assistant_Handler_Login
 *
 * Configure the 1&1 alternative login page
 */
class One_And_One_Assistant_Handler_Login {

	/**
	 * Initialize the redirections/hooks in the front-end
	 * N.B. new design & behaviour is an extra feature that needs to be activated
	 *
	 * @param boolean $design_enabled
	 */
	public static function init( $design_enabled = true ) {

		// Redirect to assistant after first login
		add_filter( 'login_redirect', array( 'One_And_One_Assistant_Handler_Login', 'automatic_redirect_after_login' ), 90, 3 );

		// Add the cookie script to control feature switches through JS
		add_action( 'login_enqueue_scripts', array( 'One_And_One_Assistant_Handler_Login', 'enqueue_cookie_script' ) );

		if ( $design_enabled ) {

			// Add the 1&1 CSS class to the login page
			add_filter( 'login_body_class', array( 'One_And_One_Assistant_Handler_Login', 'add_body_class' ) );

			// Add the 1&1 alternative login scripts
			add_action( 'login_enqueue_scripts', array( 'One_And_One_Assistant_Handler_Login', 'enqueue_scripts' ) );

			// Handle the login process without reloading the page
			add_action( 'wp_ajax_nopriv_ajaxlogin', array( 'One_And_One_Assistant_Handler_Login', 'ajax_login' ) );
			add_action( 'wp_ajax_ajaxlogin', array( 'One_And_One_Assistant_Handler_Login', 'ajax_login' ) );

			// Modify / Add some HTML components for the styles and animations to work
			add_action( 'login_header', function() { self::load_template_part( 'header' ); } );
			add_action( 'login_footer', function() { self::load_template_part( 'footer' ); } );
		}
	}

	/**
	 * Handle the login process without reloading the page
	 * This action is called by the WordPress AJAX process
	 */
	public static function ajax_login() {

		// Log in with the standard POST data
		$logged_user = wp_signon();

		// Show error if something wrong happened
		if ( is_wp_error( $logged_user ) ) {
			$response = array(
				'message' => strip_tags( $logged_user->get_error_message(), '<br>' )
			);

			// Identify the field from which the error comes
			$error_code = $logged_user->get_error_code();

			if ( strpos( $error_code, 'username' ) ) {
				$response['origin'] = 'log';
			} elseif ( strpos( $error_code, 'password' ) ) {
				$response['origin'] = 'pwd';
			}

			// Send error
			wp_send_json_error( $response );

		// Return referer if everything went OK
		} else {
			$redirect_to = isset( $_POST[ 'redirect_to' ] ) ? $_POST[ 'redirect_to' ] : '';
			$redirect_to = wp_sanitize_redirect( $redirect_to );
			$redirect_to = wp_validate_redirect( $redirect_to, admin_url() );

			wp_send_json_success(
				array(
					'referer' => self::redirect_after_login( $logged_user, $redirect_to )
				)
			);
		}
		die;
	}

	/**
	 * Handle redirection to the 1&1 Wizard after first login
	 * (Administrators only: other roles don't have the permissions to use the Assistant)
	 *
	 * @param  WP_User $logged_user
	 * @param  string  $redirect_to
	 * @return string
	 */
	public static function redirect_after_login( $logged_user, $redirect_to ) {

		$current_user_authorized = ( $logged_user instanceof WP_User && $logged_user->has_cap( 'manage_options' ) );

		if ( $current_user_authorized && get_option( 'oneandone_assistant_completed' ) == false ) {
			return admin_url( 'admin.php?page=1and1-wordpress-wizard&setup_action=greeting' );
		} else {
			return $redirect_to;
		}
	}

	/**
	 * Handle redirection to the 1&1 Wizard after first login,
	 * in the WP Standard login (when the "redesign" feature is not activated)
	 *
	 * @param  string $redirect_to
	 * @return string
	 */
	public static function automatic_redirect_after_login( $redirect_to ) {
		global $user;
		return self::redirect_after_login( $user, $redirect_to );
	}

	/**
	 * Add the cookie script to control feature switches through JS
	 */
	public static function enqueue_cookie_script() {
		wp_enqueue_script( '1and1-wp-cookies', One_And_One_Assistant::get_js_url( 'cookies.js' ) );
	}

	/**
	 * Add the 1&1 alternative login scripts
	 */
	public static function enqueue_scripts() {
		if ( self::is_standard_login_screen() ) {

			// Remove WP standard CSS
			wp_deregister_style( 'login' );

			// Add Assistant CSS and fonts
			One_And_One_Assistant_Handler_Dispatch::enqueue_assistant_styles( false );

			// Login JS for extra styling + AJAX login
			wp_enqueue_script( '1and1-wp-login', One_And_One_Assistant::get_js_url( 'login.js' ), array( 'jquery' ), null, true );

			// Configure AJAX login
			wp_localize_script( '1and1-wp-login', 'ajax_login_object', array(
				'ajaxurl'     => admin_url( 'admin-ajax.php' ),
				'redirecturl' => home_url()
			) );
		}
	}

	/**
	 * Add the 1&1 CSS class to the login page
	 *
	 * @param  array $classes
	 * @return array
	 */
	public static function add_body_class( $classes ) {
		$classes[] = 'oneandone';
		return $classes;
	}

	/**
	 * Extends the login form HTML code with template parts
	 *
	 * @param string $template
	 */
	public static function load_template_part( $template ) {
		if ( self::is_standard_login_screen() ) {
			One_And_One_Assistant_View::load_template( 'parts/login-' . $template );
		}
	}

	/**
	 * Check if we aren't in a login-related page (reset password, register, etc.)
	 * and if we aren't in the AJAX lightbox-login (with $interim_login)
	 *
	 * @return boolean
	 */
	public static function is_standard_login_screen() {
		global $action;
		global $interim_login;

		return ( ( $action === 'login' ) && ! $interim_login );
	}
}
