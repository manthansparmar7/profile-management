<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.manthansparmar.com
 * @since             1.0.0
 * @package           Profile_Management
 *
 * @wordpress-plugin
 * Plugin Name:       Profile Management
 * Plugin URI:        https://www.profilemanagementtest.com
 * Description:       This plugin provides feature to show profile listing page with search and sorting functionality. This plugin will help users to search and sort profiles based on user's criteria.
 * Version:           1.0.0
 * Author:            Manthan Parmar
 * Author URI:        https://www.manthansparmar.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       profile-management
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
define( 'PROFILE_MANAGEMENT_VERSION', '1.0.0' );

define( 'PROFILE_MANAGEMEN_DIR_PATH', plugin_dir_path( __FILE__ ) );

define( 'PROFILE_MANAGEMEN_URL_PATH', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-profile-management-activator.php
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-profile-management-activator.php';
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-profile-management-deactivator.php
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-profile-management-deactivator.php';
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-profile-management.php';

/*file that contains metaboxs used in plugin*/
require plugin_dir_path( __FILE__ ) . 'includes/class-profile-management-metaboxes.php';

/*file that contains shortcodes used in plugin */
require plugin_dir_path( __FILE__ ) . 'includes/class-profile-management-shortcodes.php';

/*file that contains AJAX functions used in plugin */
require plugin_dir_path( __FILE__ ) . 'includes/class-profile-management-ajax-functions.php';

/*file that contains common functions used in plugin */
require plugin_dir_path( __FILE__ ) . 'includes/class-profile-management-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_profile_management() {

	$plugin = new Profile_Management();
	$plugin->run();

}
run_profile_management();