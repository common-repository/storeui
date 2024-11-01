<?php
/**
 * Plugin Name:       StoreUI
 * Description:       Add StoreUI.net to your WooCommerce store.
 * Version:           1.0.2
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            StoreUI.net, storeui, corsonr
 * Author URI:        https://storeui.net/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       storeui
 * Domain Path:       /languages
 * Requires Plugins:  woocommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'STOREUI_PLUGIN_FILE', __FILE__ );

// Include required files
require_once plugin_dir_path( __FILE__ ) . 'includes/class-storeui-loader.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-storeui.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-storeui-cors.php';

// Initialize the plugin
StoreUI_Loader::get_instance();
