<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: survey
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SRVY_Field_survey' ) ) {
	class SRVY_Field_survey extends SRVY_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			// Get the Post ID.
			$post_id = get_the_ID();

			$srvy_get_survey_data = get_post_meta( $post_id, '_survey_user_inputs', true );

			$get_survey_value_from_frontend = json_decode( $srvy_get_survey_data );
			$srvy_survey_popup_root         = get_post_meta( $post_id, '_srvy_page_options', true );
			$srvy_survey_group              = isset( $srvy_survey_popup_root['srvy_survey_group'] ) ? $srvy_survey_popup_root['srvy_survey_group'] : '';

			?>
			<style>
			table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			}

			td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
			}

			tr:nth-child(even) {
			background-color: #dddddd;
			}
			</style>
			<?php

			/**
			 * Get all survey questions.
			 */
			$srvy_all_survey_questions = array();
			if ( ! empty( $srvy_survey_group ) ) {

				foreach ( $srvy_survey_group as $srvy_root_key => $srvy_root_value ) {

					$srvy_all_survey_questions[] = $srvy_root_value['srvy_survey_question'];
				}
			} else {

				echo esc_html( 'No Analytics Data Yet.' );
			}

			/**
			 * Get all survey data and grouping by self questions.
			 */
			$srvy_survey_data_manipulated = get_post_meta( $post_id, '_srvy_all_survey_data', false );
			$srvy_q_counter               = 0;
			$srvy_survery_data_column     = array();
			foreach ( $srvy_all_survey_questions as $sqelement ) {

				$srvy_survery_data_column[ $sqelement ] = array_column( $srvy_survey_data_manipulated, $srvy_all_survey_questions[ $srvy_q_counter++ ] );
			}

			?>
			<style>
			.srvy--supo-accordion {
				background-color: #eee;
				color: #444;
				cursor: pointer;
				padding: 18px;
				width: 100%;
				border: none;
				text-align: left;
				outline: none;
				font-size: 15px;
				transition: 0.4s;
			}
			.active, .srvy--supo-accordion:hover {
				background-color: #ccc;
			}
			.srvy--supo-accordion:after {
				content: '\f067';
				font-family: fontAwesome;
				font-size: 13px;
				color: #777;
				float: right;
				margin-left: 5px;
			}
			.active:after {
				content: "\f068";
				font-family: fontAwesome;
			}
			.srvy--supo-panel {
				padding: 0 18px;
				background-color: white;
				max-height: 0;
				overflow: hidden;
				transition: max-height 0.2s ease-out;
				height: 500px;
				overflow-y: overlay;
				box-shadow: 0px 3px 7px -3px #673AB7;
			}
			.srvy--supo-panel p {
				background-color: #eee;
				padding: 10px;
				margin: 3px;
			}
			.srvy--supo-panel p span {
				color: orange;
				margin-left: 10px;
				font-style: italic;
			}
			</style>

			<?php
			/**
			 * Display table.
			 */
			foreach ( $srvy_survery_data_column as $sdc_key => $sdc_value ) {

				echo '<button class="srvy--supo-accordion"><strong>' . $sdc_key . '</strong></button>';

				/**
				 * Counting answers and display under the question.
				 */
				echo '<div class="srvy--supo-panel">';
				foreach ( array_count_values( $sdc_value ) as $srvy_sq_key => $srvy_sq_value ) {

					$srvy_sq_key   = ( ! empty( $srvy_sq_key ) ) ? $srvy_sq_key : '<i>(empty)</i>';
					$srvy_sq_value = ( 1 !== $srvy_sq_value ) ? ' (' . $srvy_sq_value . ' Times Selected)' : '';
					echo '<p>' . $srvy_sq_key . '<span>' . $srvy_sq_value . '</span></p>';
				}
				echo '</div>';
			}
			?>

			<script>
			var acc = document.getElementsByClassName("srvy--supo-accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
			acc[i].addEventListener("click", function(event) {
				event.preventDefault()
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
				panel.style.maxHeight = null;
				} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
				}
			});
			}
			</script>
			<?php

		}

	}
}
