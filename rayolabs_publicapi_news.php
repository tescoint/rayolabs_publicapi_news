<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://facebook.com/tsal3
 * @since             1.0.0
 * @package           Rayolabs_publicapi_news
 *
 * @wordpress-plugin
 * Plugin Name:       RayoLabs Publicapi News Content King
 * Plugin URI:        http://publicapi.org.ng/
 * Description:       The RayoLabs Content King plugin (developed by Tes Sal CTO PublicApi.org.ng) is a powerful, lightweight and easy to use Atom/RSS aggregation and content curation plugin for WordPress. The Rayolabs Content King plugin has one very unique feature which allows you to import full text articles from various news sources.
 * Version:           1.0.0
 * Author:            Salako Teslim
 * Author URI:        https://facebook.com/tsal3
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rayolabs_publicapi_news
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rayolabs_paper_admin-activator.php
 */
function activate_rayolabs_publicapi_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rayolabs_publicapi_news-activator.php';
	Rayolabs_publicapi_news_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rayolabs_paper_admin-deactivator.php
 */
function deactivate_rayolabs_publicapi_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rayolabs_publicapi_news-deactivator.php';
	Rayolabs_publicapi_news_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rayolabs_publicapi_news' );
register_deactivation_hook( __FILE__, 'deactivate_rayolabs_publicapi_news' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rayolabs_publicapi_news.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rayolabs_publicapi_news() {

	$plugin = new Rayolabs_publicapi_news();
	$plugin->run();

}
run_rayolabs_publicapi_news();
