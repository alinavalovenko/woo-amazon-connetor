<?php
/*
	Plugin Name: Amazon FBA
	Description: Integration Amazon FBA to WooCommerce
	Version: 1.0
	Author: Alina Valovenko
	Author URI: http://www.valovenko.pro
	License: GPL2
*/

namespace Woo_Amazon_FBA_Plugin;
if ( ! class_exists( 'Woo_Amazon_FBA' ) ) {

	require_once( 'core/class-wafba-admin.php' );

	class Woo_Amazon_FBA {
		public function __construct() {
			DEFINE( 'WA_FBA_SLUG', 'woo-amazon-fba' );
			DEFINE( 'WA_FBA_DIR', plugin_dir_path( __FILE__ ) );
			DEFINE( 'WA_FBA_URL', plugin_dir_url( __FILE__ ) );
			DEFINE( 'WA_FBA_CORE', LXP_DIR . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR );
			DEFINE( 'WA_FBA_VIEW', LXP_DIR . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR );
			DEFINE( 'WA_FBA_TEMP', LXP_DIR . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR );
			DEFINE( 'WA_FBA_CSS', LXP_URL . 'assets/css/' );
			DEFINE( 'WA_FBA_JS', LXP_URL . 'assets/js/' );
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				register_activation_hook( WA_FBA_SLUG . '-plugin', array( &$this, 'activate_plugin' ) );
				register_deactivation_hook( WA_FBA_SLUG . '-plugin', array( &$this, 'deactivate_plugin' ) );
				register_uninstall_hook( WA_FBA_SLUG . '-plugin', array( &$this, 'uninstall_plugin' ) );

				$admin_page = new WA_FBA_Admin();
			} else {
				add_action( 'admin_notices', array( $this, 'woo_is_required_notice' ) );
				return;
			}
		}

		public function activate_plugin() {

		}

		public function deactivate_plugin() {
			return true;
		}

		public function uninstall_plugin() {
			return true;
		}

		function woo_is_required_notice() {
			?>
            <div class="notice error my-acf-notice is-dismissible">
                <p><?php _e( 'WooCommerce Plugin is required' ); ?></p>
            </div>
			<?php
		}
	}

	global $amazo_fba;
	$amazo_fba = new Woo_Amazon_FBA();
}