<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.
/**
 *
 * Field: shortcode
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! class_exists( 'SRVY_Field_shortcode' ) ) {
	class SRVY_Field_shortcode extends SRVY_Fields {

		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		public function render() {

			// Get the Post ID.
			$post_id = get_the_ID();

			echo ( ! empty( $post_id ) ) ? '<div class="srvy--shortcode-field-wrap"><code title="Click to select the Shortcode">[survey_popup id="' . $post_id . '"]</code></div>' : '';
		}

	}
}
