<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://my.linkedin.com/in/fayzansiddiqui
 * @since      1.0.0
 *
 * @package    Aws_Sns_Plugin
 * @subpackage Aws_Sns_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aws_Sns_Plugin
 * @subpackage Aws_Sns_Plugin/admin
 * @author     Fayzan Siddiqui <fayzandotcom@hotmail.com>
 */
class Aws_Sns_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aws_Sns_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aws_Sns_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aws-sns-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aws_Sns_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aws_Sns_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aws-sns-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 */
		
		add_options_page( 'AWS SNS plugin', 'AWS SNS', 'manage_options', $this->plugin_name."_settings", array($this, 'display_plugin_setup_page'));

	}
	
	/**
	 * Register the administration backend page for this plugin into the WordPress admin menu.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_plugin_admin_backend() {

		/*
		 * Add a backend admin page for this plugin.
		 */
		
		add_menu_page( 'AWS SNS plugin', 'AWS SNS', 'publish_posts', $this->plugin_name."_backend", array($this, 'display_plugin_backend_page'), 'dashicons-email');
	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	 
	public function add_action_links( $links ) {
		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
	   $settings_link = array(
		'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	 
	public function display_plugin_setup_page() {
		include_once( 'partials/aws-sns-plugin-admin-settings-display.php' );
	}
	
	public function display_plugin_backend_page() {
		include_once( 'partials/aws-sns-plugin-admin-backend-display.php' );
	}
	
	 public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}
	
	public function validate($input) {
		// All checkboxes inputs        
		$valid = array();
		
		$valid['access-key-id'] = (isset($input['access-key-id']) && !empty($input['access-key-id'])) ? $input['access-key-id'] : "";
		$valid['secret-access-key'] = (isset($input['secret-access-key']) && !empty($input['secret-access-key'])) ? $input['secret-access-key'] : "";
		$valid['region'] = (isset($input['region']) && !empty($input['region'])) ? $input['region'] : "";
		
		return $valid;
	}


}
