<?php

/**
 * The shortcode functionality of the plugin.
 *
 * @link       https://forhad.net
 * @since      1.0.0
 *
 * @package    ACC_Conditional_Typo
 * @subpackage ACC_Conditional_Typo/public
 */

/**
 * The shortcode functionality of the plugin.
 *
 * @package    ACC_Conditional_Typo
 * @subpackage ACC_Conditional_Typo/public
 * @author     GrandPlugin <help@grandplugin.com>
 */
class Survey_Popup_Shortcode {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * A Custom function to get post meta with sanitization and validation.
	 *
	 * @param [type] $post_id Current post ID.
	 * @param string $option Meta key.
	 * @param [type] $default Default meta value.
	 * @param string $option_two Nested meta key.
	 * @param [type] $default_two Nested meta value.
	 * @return mixed
	 */
	function srvy_get_post_meta( $post_id, $option = '', $default = null, $option_two = '', $default_two = null ) {

		$options = get_post_meta( $post_id, '_srvy_page_options', true );
		if ( ! empty( $option_two ) ) {

			return ( isset( $options[ $option ][ $option_two ] ) ) ? $options[ $option ][ $option_two ] : $default_two;
		} else {

			return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
		}
	}

	/**
	 * Custom function to get options.
	 *
	 * @param string $option Option key.
	 * @param array  $default Default value.
	 * @param string $option_two Options key(child).
	 * @param array  $default_two Default value.
	 * @return mixed
	 */
	public function srvy_get_option( $option = '', $default = null, $option_two = '', $default_two = null ) {

		$options = get_option( '_srvy_option_settings' );
		if ( ! isset( $option_two ) ) {

			return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
		} else {

			return ( isset( $options[ $option ][ $option_two ] ) ) ? $options[ $option ][ $option_two ] : $default_two;
		}
	}

	/**
	 * Get tag suggestions from while user writes
	 *
	 * @since      1.0.0
	 */
	public function tags_autofill_function() {

		$srvy_ajax_nonce = ( ! empty( $_POST['nonce_ajax'] ) ) ? sanitize_text_field( wp_unslash( $_POST['nonce_ajax'] ) ) : '';
		if ( ! wp_verify_nonce( $srvy_ajax_nonce, 'survey-popup-script-nonce' ) ) {

			die( 'Busted!' );
		}

		$srvy_user_inputs = ( ! empty( $_POST['srvy_user_inputs'] ) ) ? sanitize_text_field( wp_unslash( $_POST['srvy_user_inputs'] ) ) : ''; // Get user inputs.
		$post_id          = ( ! empty( $_POST['srvy_survey_id'] ) ) ? sanitize_text_field( wp_unslash( $_POST['srvy_survey_id'] ) ) : ''; // Get the post id of admin post type.

		/**
		 * Update user input once as a row data.
		 */
		update_post_meta( $post_id, '_survey_user_inputs', $srvy_user_inputs );

		/**
		 * Survey data manipulation.
		 */
		$srvy_get_survey_data             = get_post_meta( $post_id, '_survey_user_inputs', true );
		$srvy_get_survey_value_from_users = json_decode( $srvy_get_survey_data );
		$srvy_survey_popup_root           = $this->srvy_get_post_meta( $post_id, 'srvy_survey_group' );
		$srvy_ans_counter                 = 0;
		$srvy_survey_group_data           = array();
		foreach ( $srvy_survey_popup_root as $srvy_root_key => $srvy_root_value ) {

			$srvy_survey_group_data[ $srvy_root_value['srvy_survey_question'] ] = $srvy_get_survey_value_from_users[ $srvy_ans_counter++ ];

			/**
			 * The repeater fields are sorting from user inputs.
			 * Only if the survey field type is radio.
			 */
			if ( 'radio' === $srvy_root_value['srvy_survey_type'] ) {

				foreach ( $srvy_root_value['srvy_survey_radio_repeater'] as $radio_key => $radio_value ) {

					if ( in_array( $radio_value['srvy_survey_radio_text'], $srvy_get_survey_value_from_users ) ) {

						add_post_meta( $post_id, '_srvy_radio_repeater_data', $radio_value['srvy_survey_radio_text'] );
					}
				}
			}
		}
		add_post_meta( $post_id, '_srvy_all_survey_data', $srvy_survey_group_data ); // Store the survey data as grouped.

		wp_die(); // This is required to terminate immediately and return a proper response.
	}

	/**
	 * A shortcode for this plugin.
	 *
	 * @since   1.0.0
	 * @param   string $atts attribute of this shortcode.
	 */
	public function gpsc_shortcode_execute( $atts ) {

		$post_id = intval( $atts['id'] );

		// Get Codes.
		$srvy_survey_popup_root = $this->srvy_get_post_meta( $post_id, 'srvy_survey_group' );

		// Enqueue needs.
		wp_enqueue_script( $this->plugin_name . 'sweetalert2' );

		ob_start();

		// Custom CSS.
		include SRVY_CONDITIONAL_TYPO_DIR_PATH_FILE . 'public/dynamic-styles.php';
		?>

		<script>const SRVYSurveyRoot = <?php echo wp_json_encode( $srvy_survey_popup_root, JSON_PRETTY_PRINT ); ?>;</script>
		<div id="srvy__supo--<?php echo esc_attr( $post_id ); ?>" class="srvy--survey-popup" data-survey-id="<?php echo esc_attr( $post_id ); ?>" data-survey-next="<?php echo esc_html( $srvy_survey_popup_next_txt ); ?>" data-survey-exit="<?php echo esc_html( $srvy_survey_popup_exit_txt ); ?>" data-survey-msg-done="<?php echo esc_attr( $srvy_survey_msg_done ); ?>" data-survey-msg-exit="<?php echo esc_attr( $srvy_survey_msg_exit ); ?>">

			<button class="srvy--survey-btn"><?php echo esc_html( $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_txt' ) ); ?></button>

		</div>

		<?php

		return ob_get_clean();
	}

}
