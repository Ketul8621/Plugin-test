<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ketul.test
 * @since             1.0.0
 * @package           Plugin_Test
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin-test
 * Plugin URI:        https://ketul.test/plugins
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ketul Solanki
 * Author URI:        https://ketul.test
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-test
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
define( 'PLUGIN_TEST_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-test-activator.php
 */
function activate_plugin_test() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-test-activator.php';
	Plugin_Test_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-test-deactivator.php
 */
function deactivate_plugin_test() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-test-deactivator.php';
	Plugin_Test_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_test' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_test' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-test.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_test() {

	$plugin = new Plugin_Test();
	$plugin->run();

}
run_plugin_test();

/*
 * Global variables
*/

// Retrieves our plugin option from our options table.
$pt_options = get_option( 'pt_book_settings' );

/************************
 * includes
 ***********************/


include 'includes/Register-book-post-type.php'; // Register book post type.
include 'includes/Taxonomies-and-Tags.php'; // Register book category and book tag.
include 'includes/metabox.php'; // Register the metabox.
include 'includes/settings/settings.php'; // settings for the book post type.
include 'includes/shortcodes/Book-Information.php'; // shortcode for displaying meta information of a book.
include 'includes/Widgets/display-categorised-books.php'; // Register custom widget.
include 'includes/Dashboard-widgets/top-5-category.php'; // Adds a dashboard widget.
