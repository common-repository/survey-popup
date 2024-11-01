<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://forhad.net
 * @since      1.0.0
 *
 * @package    Survey_Popup
 * @subpackage Survey_Popup/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Survey_Popup
 * @subpackage Survey_Popup/admin
 * @author     GrandPlugin <help@grandplugin.com>
 */
class Survey_Popup_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Survey_Popup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Survey_Popup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/survey-popup-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Survey_Popup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Survey_Popup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/survey-popup-admin.js', array( 'jquery' ), $this->version, false );

		global $post_type;
		if ( 'gpsp_survey' == $post_type ) {
			wp_enqueue_script( $this->plugin_name . 'chart-js', plugin_dir_url( __FILE__ ) . 'js/chart.min.js', array(), '2.7.2', false );
		}

	}

}
