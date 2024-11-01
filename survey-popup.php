<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://forhad.net
 * @since             1.0.0
 * @package           Survey_Popup
 *
 * @wordpress-plugin
 * Plugin Name:       Survey Popup
 * Plugin URI:        https://forhad.net/plugins/survey-popup/
 * Description:       Survey plugin. Survey Popup.
 * Version:           1.0.0
 * Author:            Forhad
 * Author URI:        https://forhad.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       survey-popup
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define global constants.
 */
$srvysp_plugin_data = get_file_data(
	__FILE__,
	array(
		'version' => 'Version',
	)
);
define( 'SRVY_CONDITIONAL_TYPO_VERSION', $srvysp_plugin_data['version'] );
define( 'SRVY_CONDITIONAL_TYPO_DIR_PATH_FILE', plugin_dir_path( __FILE__ ) );
define( 'SRVY_CONDITIONAL_TYPO_DIR_URL_FILE', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-survey-popup-activator.php
 */
function activate_survey_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-survey-popup-activator.php';
	Survey_Popup_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-survey-popup-deactivator.php
 */
function deactivate_survey_popup() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-survey-popup-deactivator.php';
	Survey_Popup_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_survey_popup' );
register_deactivation_hook( __FILE__, 'deactivate_survey_popup' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-survey-popup.php';

/**
 * SRVY Framework.
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/classes/setup.class.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/metabox/init.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/metabox/survey-field.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/metabox/survey-data.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/metabox/survey-analytics.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/metabox/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/metabox/guten-css.php';

// Settings.
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/option/settings-init.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/srvy-metafields/option/settings-global.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_survey_popup() {

	$plugin = new Survey_Popup();
	$plugin->run();

}
run_survey_popup();
