<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: survey_chart
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SRVY_Field_survey_chart' ) ) {
	class SRVY_Field_survey_chart extends SRVY_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			/**
			 * Display Chart.
			 */
			$post_id                           = get_the_ID();
			$srvy_get_only_radio_repeater_data = get_post_meta( $post_id, '_srvy_radio_repeater_data' );
			$srvy_radio_repeater_counted       = array_count_values( $srvy_get_only_radio_repeater_data );
			$srvy_radio_labels                 = array();
			$srvy_radio_points                 = array();
			foreach ( $srvy_radio_repeater_counted as $rrc_key => $rrc_value ) {

				$srvy_radio_labels[] = $rrc_key;
				$srvy_radio_points[] = $rrc_value;
			}

			?>
			<div style="width: 100%;">
				<canvas id="myChart"></canvas>
			</div>

			<script>
				var ctx = document.getElementById('myChart').getContext('2d');
				var chart = new Chart(ctx, {
					// The type of chart we want to create
					type: 'horizontalBar',

					// The data for our dataset
					data: {
						labels: [<?php echo '"' . implode( '", "', $srvy_radio_labels ) . '"'; ?>],
						datasets: [{
							label: 'Radio dataset',
							backgroundColor: 'rgb(255, 99, 132)',
							borderColor: 'rgb(255, 99, 132)',
							data: [<?php echo '"' . implode( '", "', $srvy_radio_points ) . '"'; ?>]
						}]
					},

					// Configuration options go here
					options: {
						title: {
							display: true,
							text: 'Survey Analytics Chart'
						}
					}
				});
			</script>
			<?php

		}

	}
}
