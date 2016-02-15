<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://my.linkedin.com/in/fayzansiddiqui
 * @since      1.0.0
 *
 * @package    Aws_Sns_Plugin
 * @subpackage Aws_Sns_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Aws_Sns_Plugin
 * @subpackage Aws_Sns_Plugin/includes
 * @author     Fayzan Siddiqui <fayzandotcom@hotmail.com>
 */
class Aws_Sns_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'aws-sns-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
