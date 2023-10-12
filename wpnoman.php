<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://wa.me/8801869226368
 * @since             1.2.0
 * @package           Wpnoman
 *
 * @wordpress-plugin
 * Plugin Name:       Registration system - Noman
 * Plugin URI:        https://https://wa.me/8801869226368
 * Description:       custom plugin developed on request
 * Version:           1.2.0
 * Author:            wp noman
 * Author URI:        https://https://wa.me/8801869226368/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpnoman
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WPNOMAN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpnoman-activator.php
 */
function activate_wpnoman() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpnoman-activator.php';
	Wpnoman_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpnoman-deactivator.php
 */
function deactivate_wpnoman() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpnoman-deactivator.php';
	Wpnoman_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpnoman' );
register_deactivation_hook( __FILE__, 'deactivate_wpnoman' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpnoman.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpnoman() {

	$plugin = new Wpnoman();
	$plugin->run();

}
run_wpnoman();
