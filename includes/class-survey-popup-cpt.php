<?php

/**
 * The file that defines the Custom Post Type of the plugin.
 *
 * @link       https://forhad.net
 * @since      1.0.0
 *
 * @package    ACC_Conditional_Typo
 * @subpackage ACC_Conditional_Typo/includes
 */

/**
 * The file that defines the Custom Post Type of the plugin.
 *
 * @since      1.0.0
 * @package    ACC_Conditional_Typo
 * @subpackage ACC_Conditional_Typo/includes
 * @author     GrandPlugin <help@grandplugin.com>
 */
class Survey_Popup_CPT {

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
	 * Settings page ID for post-to-card settings.
	 */
	const PAGE_ID = 'gpsp_survey';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Custom Post Type of the Plugin.
	 *
	 * @since    1.0.0
	 */
	public function gpsc_custom_post_type() {

		$labels = apply_filters(
			self::PAGE_ID . '_post_type_labels',
			array(
				'name'               => esc_html_x( 'Manage Survey', 'acc-conditional-typo' ),
				'singular_name'      => esc_html_x( 'Survey', 'acc-conditional-typo' ),
				'add_new'            => esc_html__( 'Add New', 'acc-conditional-typo' ),
				'add_new_item'       => esc_html__( 'Add New Survey', 'acc-conditional-typo' ),
				'edit_item'          => esc_html__( 'Edit Survey', 'acc-conditional-typo' ),
				'new_item'           => esc_html__( 'New Survey', 'acc-conditional-typo' ),
				'view_item'          => esc_html__( 'View  Survey', 'acc-conditional-typo' ),
				'search_items'       => esc_html__( 'Search Survey', 'acc-conditional-typo' ),
				'not_found'          => esc_html__( 'No Survey found.', 'acc-conditional-typo' ),
				'not_found_in_trash' => esc_html__( 'No Survey found in trash.', 'acc-conditional-typo' ),
				'parent_item_colon'  => esc_html__( 'Parent Item:', 'acc-conditional-typo' ),
				'menu_name'          => esc_html__( 'Survey Popup', 'acc-conditional-typo' ),
				'all_items'          => esc_html__( 'Manage Survey', 'acc-conditional-typo' ),
			)
		);

		$args = apply_filters(
			self::PAGE_ID . '_post_type_args',
			array(
				'labels'              => $labels,
				'public'              => false,
				'hierarchical'        => false,
				'exclude_from_search' => true,
				'show_ui'             => true,
				'show_in_admin_bar'   => false,
				'menu_position'       => apply_filters( self::PAGE_ID . '_menu_position', 25 ),
				'menu_icon'           => 'dashicons-welcome-widgets-menus',
				'rewrite'             => false,
				'query_var'           => false,
				'imported'            => true,
				'supports'            => array( 'title' ),
			)
		);
		register_post_type( self::PAGE_ID, $args );

	}

	/**
	 * Change Sliders updated messages.
	 *
	 * @param string $messages The Update messages.
	 * @return statement
	 */
	public function wpps_updated_messages( $messages ) {
		global $post, $post_ID;
		$messages[ self::PAGE_ID ] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => sprintf( __( 'Sliders updated.', 'acc-conditional-typo' ) ),
			2  => '',
			3  => '',
			4  => __( 'updated.', 'acc-conditional-typo' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Sliders restored to revision from %s', 'acc-conditional-typo' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( 'Sliders published.', 'acc-conditional-typo' ) ),
			7  => __( 'Sliders saved.', 'acc-conditional-typo' ),
			8  => sprintf( __( 'Sliders submitted.', 'acc-conditional-typo' ) ),
			9  => sprintf( __( 'Sliders scheduled for: <strong>%1$s</strong>.', 'acc-conditional-typo' ), date_i18n( __( 'M j, Y @ G:i', 'acc-conditional-typo' ), strtotime( $post->post_date ) ) ),
			10 => sprintf( __( 'Sliders draft updated.', 'acc-conditional-typo' ) ),
		);
		return $messages;
	}

	/**
	 * Admin help page
	 *
	 * @since    2.0.0
	 */
	public function gpsc_help_admin_submenu() {
		add_submenu_page(
			'edit.php?post_type=' . self::PAGE_ID,
			__( 'Help', 'post-to-card' ),
			__( 'Help', 'post-to-card' ),
			'manage_options',
			'grandplugin_help',
			array( $this, 'ptc_help_callback' )
		);
	}

	/**
	 * Safe Welcome Page Redirect.
	 *
	 * Safe welcome page redirect which happens only
	 * once and if the site is not a network or MU.
	 *
	 * @since 1.0.0
	 */
	public function gpsc_safe_welcome_redirect() {
		// Bail if no activation redirect transient is present. (if ! true).
		if ( ! get_transient( '_gpsc_safe_redirect' ) ) {
			return;
		}

		// Delete the redirect transient.
		delete_transient( '_gpsc_safe_redirect' );

		// Bail if activating from network or bulk sites.
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}

		// Redirects to a specific Page.
		wp_safe_redirect(
			add_query_arg(
				array(
					'post_type' => self::PAGE_ID,
					'page'      => 'grandplugin_help',
				),
				admin_url( 'edit.php' )
			)
		);

	}

	/**
	 * Admin help callback function
	 *
	 * @since    1.0.0
	 */
	public function ptc_help_callback() {

		include_once SRVY_CONDITIONAL_TYPO_DIR_PATH_FILE . '/admin/partials/survey-popup-admin-display.php';
	}

	/**
	 * Bottom review notice.
	 *
	 * @param string $text The review notice.
	 * @return string
	 */
	public function gpsc_review_text( $text ) {

		$screen = get_current_screen();
		if ( self::PAGE_ID === get_post_type() || ( self::PAGE_ID . '_page_grandplugin_help' === $screen->id ) ) {

			$url  = 'https://wordpress.org/plugins/search/grandplugin/';
			$text = sprintf( __( 'If you love this plugin, please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your review is so important to us and we are delighted you are happy to share your experience with others on this platform.', 'acc-conditional-typo' ), $url );
		}

		return $text;
	}

}
