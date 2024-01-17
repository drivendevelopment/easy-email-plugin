<?php

namespace Easy_Email;

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Main plugin class.
 */
class Plugin extends Singleton {

	const NOTICE_TYPE_SUCCESS 	= 'notice notice-success';
	const NOTICE_TYPE_WARNING 	= 'notice notice-warning';
	const NOTICE_TYPE_ERROR 	= 'notice notice-error';

	/**
	 * Stores a queue of notices to display when the admin_notices action is
	 * fired.
	 *
	 * @var array
	 */
	private $admin_notices = [];

    /**
     * Stores the singleton instance.
     * 
     * @var Plugin
     */
	protected static $instance;

    public function __construct() {
        add_filter( 'wp_mail_from', array( $this, 'maybe_replace_from_email' ) );
		add_filter(
			'plugin_action_links_easy-email/easy-email.php',
			array( $this, 'add_settings_to_plugin_action_links' )
		);     
        
        add_action( 'phpmailer_init',   array( $this, 'phpmailer_init' ), 10, 1 );
        add_action( 'admin_init',       array( $this, 'admin_init' ) );
		add_action( 'admin_menu',       array( $this, 'add_settings_to_admin_menu' ) );
		add_action( 'admin_notices', 	array( $this, 'admin_notices' ) );
    }

    /**
     * Checks the querystring for a parameter named "action" and returns if it
     * exists.
     * 
     * @return string|bool
     *  The action or false if one isn't set.
     */
    public function get_action() {
        return isset( $_GET['action'] ) ? sanitize_key( $_GET['action'] ) : false;
    }

    /**
     * WordPress init hook.
     */
    public function admin_init() {
        $this->maybe_handle_connect();
        $this->maybe_handle_disconnect();
        $this->maybe_add_notice();
    }

	/**
	 * Wordpress 'admin_notices' function. Outputs admin notices.
	 */
	public function admin_notices() {
		foreach ( $this->admin_notices as $notice ) {
			printf(
				'<div class="%1$s"><p>%2$s</p></div>',
				esc_attr( $notice['type'] ),
				esc_html( $notice['message'] )
			);
		}
	}
    
    /**
     * Adds an admin notice.
     */
	public function add_notice( $message, $type = self::NOTICE_TYPE_SUCCESS ) {
		$this->admin_notices[] = array(
			'message' 	=> $message,
			'type' 		=> $type,
		);
	}

	/**
	 * Checks query string for a notice message and, if one exists, adds it to
	 * the notices queue.
	 */
	private function maybe_add_notice() {
		if ( ! empty( $_GET['easy_email_notice'] ) ) {
			$this->add_notice( sanitize_text_field( $_GET['easy_email_notice'] ) );
		}

		if ( ! empty( $_GET['easy_email_warning'] ) ) {
			$this->add_notice( sanitize_text_field( $_GET['easy_email_warning'] ), self::NOTICE_TYPE_WARNING );
		}

		if ( ! empty( $_GET['easy_email_error'] ) ) {
			$this->add_notice( sanitize_text_field( $_GET['easy_email_error'] ), self::NOTICE_TYPE_ERROR );
		}
	}

	/**
	 * Adds a 'Settings' link to our plugin actions.
	 */
	public function add_settings_to_plugin_action_links( $links ) {
        $settings_link = '<a href="' . esc_url( menu_page_url( 'easy_email_settings', 0 ) ) . '">' . __( 'Settings', 'easy-email' ) . '</a>';

        array_unshift( $links, $settings_link );

        return $links;
    }

	/**
	 * WordPress admin_menu hook to add our settings page.
	 */
	public function add_settings_to_admin_menu() {
		add_submenu_page(
            'options-general.php',
            __( 'Easy Email Settings', 'easy-email' ),
            __( 'Easy Email', 'easy-email' ),
            'manage_options',
            'easy_email_settings',
            array( $this, 'settings_page' ),
        );
	} 

    /**
     * Displays the settings page.
     */
    public function settings_page() {
        $api_key        = $this->get_api_key();
        $app_url        = $this->get_app_url();
        $connect_url    = add_query_arg(
            array(
                'url' => untrailingslashit( site_url() ),
            ),
            $app_url . '/connect'
        );
        $disconnect_url  = add_query_arg(
            array(
                'action' => 'easy_email_disconnect',
            ),
            menu_page_url( 'easy_email_settings', false )
        );

        $connect_url    = wp_nonce_url( $connect_url, 'easy_email_connect' );
        $disconnect_url = wp_nonce_url( $disconnect_url, 'easy_email_disconnect' );

        include( dirname( dirname( __FILE__ ) ) . '/templates/settings.php' );
    }

    /**
     * Returns the Easy Email API key.
     *
     * @return string|bool
     *  The API key or false if one isn't set.
     */
    public function get_api_key() {
        return get_option( 'easy_email_api_key', false );
    }

    /**
     * Returns the base URL to the Easy Email app.
     * 
     * @return string
     *  The app's base URL without the trailing slash.     
     */
    public function get_app_url() {
        return apply_filters( 'easy_email_app_url', 'https://app.wpeasyemail.com' );
    }

    /**
     * Processes a connection response from the app.
     */
    public function maybe_handle_connect() {
        if ( 'easy_email_connect' !== $this->get_action() ) {
            return;
        }

        // Verify nonce
        check_admin_referer( 'easy_email_connect' );

        // Store the API key
        update_option( 'easy_email_api_key', sanitize_key( $_GET['api_key'] ) );

        $url = menu_page_url( 'easy_email_settings', false );
        $url = add_query_arg( 'easy_email_notice', __( 'Success! Your site has been connected to Easy Email. Happy sending.', 'easy-email' ), $url );

        // Redirect back to settings page
        wp_safe_redirect( $url );
    }

    /**
     * Processes requests to disconnect from the app.
     */
    public function maybe_handle_disconnect() {
        if ( 'easy_email_disconnect' !== $this->get_action() ) {
            return;
        }

        // Verify nonce
        check_admin_referer( 'easy_email_disconnect' );

        // Remove the API key
        delete_option( 'easy_email_api_key' );

        $url = menu_page_url( 'easy_email_settings', false );
        $url = add_query_arg( 'easy_email_notice', __( 'Successfully disconnected.', 'easy-email' ), $url );

        // Redirect back to settings page
        wp_safe_redirect( $url );
    }
    /**
     * Checks that the site's from email address is valid and, if not, replaces
     * it with a valid one.
     */
    public function maybe_replace_from_email( $from_email ) {
        if ( ! is_email( $from_email ) ) {
            $from_email = get_option( 'admin_email' );

            if ( ! is_email( $from_email ) ) {
                $from_email = 'no-reply@wpeasyemail.com';
            }
        }

        return $from_email;
    }

    /**
     * WordPress phpmailer_init hook. Replaces the PHPMailer instance with our
     * custom mailer so we can override the send() method.
     * 
     * @param PHPMailer $phpmailer
     *  The PHPMailer instance created in wp_mail().
     */
    public function phpmailer_init( &$phpmailer ) {
        $custom_mailer = new Mailer();

        $custom_mailer->easy_email_api_url = $this->get_app_url();
        $custom_mailer->easy_email_api_key = $this->get_api_key();

        $custom_mailer->init_from_phpmailer( $phpmailer );

        $phpmailer = $custom_mailer;
    }   
}

