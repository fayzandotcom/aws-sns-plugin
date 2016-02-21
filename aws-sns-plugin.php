<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/fayzandotcom/aws-sns-plugin.git
 * @since             1.0.0
 * @package           Aws_Sns_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       AWS SNS Plugin
 * Plugin URI:        https://github.com/fayzandotcom/aws-sns-plugin.git
 * Description:       Send push notifications to different devices using Amazon Simple Notification Service.
 * Version:           1.0.0
 * Author:            Muhammad Fayzan Siddiqui
 * Author URI:        https://my.linkedin.com/in/fayzansiddiqui
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aws-sns
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aws-sns-plugin-activator.php
 */
function activate_aws_sns_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aws-sns-plugin-activator.php';
	Aws_Sns_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aws-sns-plugin-deactivator.php
 */
function deactivate_aws_sns_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aws-sns-plugin-deactivator.php';
	Aws_Sns_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aws_sns_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_aws_sns_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aws-sns-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aws_sns_plugin() {

	$plugin = new Aws_Sns_Plugin();
	$plugin->run();

}
run_aws_sns_plugin();
