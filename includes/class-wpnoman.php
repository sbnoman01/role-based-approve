<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://https://wa.me/8801869226368
 * @since      1.0.0
 *
 * @package    Wpnoman
 * @subpackage Wpnoman/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wpnoman
 * @subpackage Wpnoman/includes
 * @author     wp noman <sbnoman27@gmail.com>
 */
class Wpnoman {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wpnoman_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WPNOMAN_VERSION' ) ) {
			$this->version = WPNOMAN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wpnoman';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wpnoman_Loader. Orchestrates the hooks of the plugin.
	 * - Wpnoman_i18n. Defines internationalization functionality.
	 * - Wpnoman_Admin. Defines all hooks for the admin area.
	 * - Wpnoman_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpnoman-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpnoman-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpn_shortcode.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpnoman-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wpnoman-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wpn-woo-dashboard.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/class_wp_user_dataTable.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/class_register_new_user.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/class_wpn_user_role.php';

		$this->loader = new Wpnoman_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wpnoman_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wpnoman_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wpnoman_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wpnoman_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->run_wpn_hooks();
		$this->wpn_register_shortcodes();
		$this->loader->run();
	}

	public function run_wpn_hooks(){

		$WP_User_DataTable = new WP_User_DataTable();
		$WPN_Register_New_User = new WPN_Register_New_User();
		$WPN_Woo_dashboard = new WPN_Woo_dashboard();


		// run hooks

		add_filter( 'manage_users_columns', [ $WP_User_DataTable, 'new_modify_user_table'] );
		add_filter( 'manage_users_custom_column', [$WP_User_DataTable, 'new_modify_user_table_row'], 10, 3 );
		add_action( 'init', [$WPN_Register_New_User,'regiser_user'] );

		// wp datatable
		add_action('show_user_profile', [ $WP_User_DataTable, 'custom_user_status_field']);
		add_action('edit_user_profile', [ $WP_User_DataTable, 'custom_user_status_field']);
		add_action('personal_options_update', [ $WP_User_DataTable, 'custom_save_user_status']);
		add_action('edit_user_profile_update', [ $WP_User_DataTable,'custom_save_user_status']);


		
		// Save the custom field 'favorite_color' 
		add_action( 'woocommerce_save_account_details', [$WPN_Woo_dashboard, 'save_woo_business_field_account_details'], 12, 1 );
		// Add the custom field "favorite_color"
		add_action( 'woocommerce_edit_account_form', [$WPN_Woo_dashboard, 'wpn_add_woo_business_fields'] );

		$WPN_User_Role = new WPN_User_Role();
		add_action('init', [$WPN_User_Role, 'create_pending_user_role']);
		add_filter('wp_authenticate_user', [$WPN_User_Role,'myplugin_auth_login'], 10,2);

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wpnoman_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public function wpn_register_shortcodes(){
		add_shortcode( 'wpn-registration-form', [WPN_Shortocde::class, 'user_registration_form'] );
		// add_shortcode( 'wpn-login-form', [WPN_Shortocde::class, 'user_login_form'] );
	}
}

