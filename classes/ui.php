<?php

namespace Easy_Email;

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/**
 * Handles displaying the plugin's UI.
 */
final class UI extends Singleton {

    /**
     * Stores the singleton instance.
     * 
     * @var UI
     */
	protected static $instance;

    public function __construct() {
        add_filter( 'admin_body_class',         array( $this, 'admin_body_class' ) );

		add_action( 'admin_menu',               array( $this, 'add_settings_to_admin_menu' ) );
        add_action( 'admin_enqueue_scripts',    array( $this, 'enqueue_settings_scripts' ) );
    }    

    /**
     * Returns a reference to the plugin singleton.
     * 
     * @return Plugin
     *  The plugin singleton.
     */
    public function plugin() {
        return Plugin::get_instance();
    }

    /**
     * 'admin_body_class' filter.
     */
    public function admin_body_class( $classes ) {
        if ( ! $this->plugin()->get_api_key() || $this->is_success_page() ) {
            $classes .= ' ee-connect';
        }

        return $classes;
    }

    /**
     * Enqueues scripts and styles for the settings page.
     */
    public function enqueue_settings_scripts() {
        if ( $this->is_settings_page() ) {
            wp_enqueue_script( 'easy-email-confetti', plugins_url( 'assets/js/confetti.js', dirname( __FILE__ ) ), array( 'jquery' ), $this->plugin()->get_version() );

            wp_enqueue_style( 'easy-email-settings', plugins_url( 'assets/css/style.css', dirname( __FILE__ ) ), array(), $this->plugin()->get_version() );
        }
    }    

    /**
     * Returns whether or not the current page is the settings page.
     * 
     * @return bool
     *  True if the current page is the settings page, false otherwise.     
     */
    public function is_settings_page() {
        return isset( $_GET['page'] ) && 'easy_email_settings' == $_GET['page'];
    }

    /**
     * Returns whether or not the current page is the success page.
     * 
     * @return bool
     *  True if the current page is the success page, false otherwise.     
     */
    public function is_success_page() {
        return 'easy_email_connect_success' == $this->plugin()->get_action();
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
            array( $this, 'settings_page_router' ),
        );
	} 

    public function settings_page_router() {
        $action = Plugin::get_instance()->get_action();

        if ( 'easy_email_connect_success' == $action ) {
            $this->success_page();
        } else {
            $this->settings_page();
        }
    }

    /**
     * Displays the settings page.
     */
    public function settings_page() {
        $api_key        = $this->plugin()->get_api_key();
        $app_url        = $this->plugin()->get_app_url();
        $site_url       = $this->plugin()->get_site_url();
        $connect_url    = add_query_arg(
            array(
                'url'   => untrailingslashit( site_url() ),
                'name'  => get_bloginfo( 'name' ),
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

        if ( false === $api_key ) {
            include( dirname( dirname( __FILE__ ) ) . '/templates/connect.php' );
        } else {
            include( dirname( dirname( __FILE__ ) ) . '/templates/settings.php' );
        }
    }    

    /**
     * Displays the success page.
     */
    public function success_page() {
        $settings_page_url = menu_page_url( 'easy_email_settings', false );

        include( dirname( dirname( __FILE__ ) ) . '/templates/success.php' );
    } 
}