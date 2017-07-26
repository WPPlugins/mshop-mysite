<?php
/**
 * Plugin Name: MSHOP MY SITE – Easy Website Verify Ownership
 * Plugin URI: http://www.codemshop.com/
 * Description: Site Owner Verification Plugin for Google, Naver Search Engine Site Register
 * Version: 1.0.7
 * Author: CodeMShop
 * Author URI: http://www.codemshop.com
 * Requires at least: 4.6
 * Tested up to: 4.7
 *
 * Text Domain: mshop-owner-verification
 * Domain Path: /languages/
 */

if ( ! class_exists( 'MShop_Ownership_Verification' ) ) {

	class MShop_Ownership_Verification {

		protected $slug;

        protected static $_instance = null;
		public $version = '1.0.7';
		public $plugin_url;
		public $plugin_path;
		public function __construct() {
			define( 'MSHOP_OWNERSHIP_VERIFICATION_VERSION', $this->version );

			$this->slug = 'mshop-ownership-verification';

			add_action( 'init', array( $this, 'init' ), 0 );
			add_action( 'plugins_loaded', array($this, 'load_plugin_textdomain'), 0);
		}

        public function slug(){
            return $this->slug;
        }

		public function plugin_url() {
			if ( $this->plugin_url ) {
				return $this->plugin_url;
			}

			return $this->plugin_url = untrailingslashit( plugins_url( '/', __FILE__ ) );
		}


		public function plugin_path() {
			if ( empty( $this->plugin_path ) ) {
                $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path;
		}

		function includes() {
			if ( is_admin() ) {
				$this->admin_includes();
			}

			if ( defined( 'DOING_AJAX' ) ) {
				$this->ajax_includes();
			}
			include_once( 'includes/class-msov-verification.php' );
            include_once('includes/class-msov-conversation.php');
		}

		public function ajax_includes() {
			include_once( 'includes/class-msov-ajax.php' );
		}

		public function admin_includes() {
            include_once('includes/admin/class-msov-admin.php');
		}

		public function init() {
			$this->includes();
		}

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

		public function load_plugin_textdomain() {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'mshop-ownership-verification' );
			load_textdomain( 'mshop-ownership-verification', WP_LANG_DIR . '/mshop-ownership-verification/mshop-ownership-verification-' . $locale . '.mo' );
			load_plugin_textdomain( 'mshop-ownership-verification', false, $this->plugin_path() . '/languages/' );
		}

	}

    function MSOV() {
        return MShop_Ownership_Verification::instance();
    }

    return MSOV();
}