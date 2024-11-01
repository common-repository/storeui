<?php
/**
 * StoreUI Plugin Loader
 *
 * @package StoreUI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * StoreUI_Loader class
 */
class StoreUI_Loader {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.1';

	/**
	 * Plugin instance.
	 *
	 * @var StoreUI_Loader
	 */
	private static $instance = null;

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->define_constants();
		$this->init_hooks();
	}

	/**
	 * Get plugin instance.
	 *
	 * @return StoreUI_Loader
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Define plugin constants.
	 */
	private function define_constants() {
		if ( ! defined( 'STOREUI_VERSION' ) ) {
			define( 'STOREUI_VERSION', self::VERSION );
		}
		if ( ! defined( 'STOREUI_PLUGIN_DIR' ) ) {
			define( 'STOREUI_PLUGIN_DIR', plugin_dir_path( __DIR__ ) );
		}
		if ( ! defined( 'STOREUI_PLUGIN_URL' ) ) {
			define( 'STOREUI_PLUGIN_URL', plugin_dir_url( __DIR__ ) );
		}
		if ( ! defined( 'STOREUI_PROD_SERVER_URL' ) ) {
			define( 'STOREUI_PROD_SERVER_URL', 'https://storeui.net' );
		}
		if ( ! defined( 'STOREUI_TEXT_DOMAIN' ) ) {
			define( 'STOREUI_TEXT_DOMAIN', 'storeui' );
		}
	}

	/**
	 * Initialize hooks.
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
	}

	/**
	 * Load plugin textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			STOREUI_TEXT_DOMAIN,
			false,
			dirname( plugin_basename( STOREUI_PLUGIN_FILE ) ) . '/languages'
		);
	}

	/**
	 * Initialize plugin components.
	 */
	public function init_plugin() {
		// Initialize main plugin class
		StoreUI::get_instance();

		// Initialize CORS handling
		$cors = new StoreUI_CORS();
		$cors->init();
	}

	/**
	 * Get server URL.
	 *
	 * @return string
	 */
	public static function get_server_url() {
		return STOREUI_PROD_SERVER_URL;
	}
}
