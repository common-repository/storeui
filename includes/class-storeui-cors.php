<?php
/**
 * StoreUI CORSclass.
 *
 * @package StoreUI
 */

/**
 * Class StoreUI_CORS
 */
class StoreUI_CORS {

	/**
	 * Initialize CORS handling.
	 */
	public function init() {
		add_action( 'rest_api_init', array( $this, 'add_cors_headers' ) );
		add_action( 'init', array( $this, 'add_cors_headers' ) );
	}

	public function add_cors_headers() {
		// Allow requests from both app domains
		$allowed_origins = apply_filters(
			'storeui_allowed_origins',
			array(
				'https://app.storeui.net',
				'https://demo.storeui.net',
			)
		);

		$origin = '';
		if ( isset( $_SERVER['HTTP_ORIGIN'] ) ) {
			$origin = esc_url_raw( wp_unslash( $_SERVER['HTTP_ORIGIN'] ) );
		}

		if ( in_array( $origin, $allowed_origins, true ) ) {
			$allowed_origin = $origin;
		} else {
			$allowed_origin = 'https://demo.storeui.net';
		}

		// Set CORS headers
		header( 'Access-Control-Allow-Origin: ' . $allowed_origin );
		header( 'Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS' );
		header( 'Access-Control-Allow-Credentials: true' );
		header( 'Access-Control-Allow-Headers: Authorization, Content-Type, X-WP-Nonce, X-Requested-With' );
		header( 'Access-Control-Expose-Headers: X-WP-Total, X-WP-TotalPages, Link' );

		// Handle preflight OPTIONS request
		if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'OPTIONS' === $_SERVER['REQUEST_METHOD'] ) {
			status_header( 200 );
			exit;
		}
	}
}
