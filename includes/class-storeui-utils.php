<?php
/**
 * StoreUI Utilities
 *
 * @package StoreUI
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * StoreUI_Utils class
 */
class StoreUI_Utils {

	/**
	 * Log a message if debug mode is enabled.
	 *
	 * @param string $message Message to log.
	 * @param string $level   Log level (debug, info, warning, error).
	 */
	public static function log( $message, $level = 'debug' ) {
		if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
			return;
		}

		if ( is_array( $message ) || is_object( $message ) ) {
			$message = print_r( $message, true );
		}

		error_log( 'StoreUI: ' . $message );
	}
}
