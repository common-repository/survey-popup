<?php
/**
 * Dynamic styles.
 *
 * @package WP Post Slider
 * @since 1.0.0
 */
$srvy_survey_popup_max_width      = $this->srvy_get_option( 'srvy_survey_popup_max_width', null, 'width' );
$srvy_survey_popup_max_width_unit = $this->srvy_get_option( 'srvy_survey_popup_max_width', null, 'unit' );
$srvy_survey_popup_next_txt       = $this->srvy_get_option( 'srvy_survey_popup_next', null, 'srvy_survey_popup_next_text', 'Next →' );
$srvy_survey_btn_next_width       = $this->srvy_get_option( 'srvy_survey_popup_next_size', null, 'width' );
$srvy_survey_btn_next_height      = $this->srvy_get_option( 'srvy_survey_popup_next_size', null, 'height' );
$srvy_survey_btn_next_unit        = $this->srvy_get_option( 'srvy_survey_popup_next_size', null, 'unit' );
$srvy_survey_popup_next_color     = $this->srvy_get_option( 'srvy_survey_popup_next', null, 'srvy_survey_popup_next_color' );

$srvy_survey_popup_exit_txt   = $this->srvy_get_option( 'srvy_survey_popup_exit', null, 'srvy_survey_popup_exit_text', 'Exit Survey!' );
$srvy_survey_btn_exit_width   = $this->srvy_get_option( 'srvy_survey_popup_exit_size', null, 'width' );
$srvy_survey_btn_exit_height  = $this->srvy_get_option( 'srvy_survey_popup_exit_size', null, 'height' );
$srvy_survey_btn_exit_unit    = $this->srvy_get_option( 'srvy_survey_popup_exit_size', null, 'unit' );
$srvy_survey_popup_exit_color = $this->srvy_get_option( 'srvy_survey_popup_exit', null, 'srvy_survey_popup_exit_color' );

$srvy_survey_msg_done = $this->srvy_get_option( 'srvy_survey_msg_done', null );
$srvy_survey_msg_exit = $this->srvy_get_option( 'srvy_survey_msg_exit', null );

$srvy_supo_css = array(

	'#srvy__supo--' . $post_id . ' .srvy--survey-btn' => array(
		'font-size'        => $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_txt_size' )['width'] . $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_txt_size' )['unit'],
		'padding'          => $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_size' )['height'] . $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_size' )['unit'] . ' ' . $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_size' )['width'] . $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_size' )['unit'],
		'color'            => $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_colors' )['txt-color'],
		'background-color' => $this->srvy_get_post_meta( $post_id, 'srvy_survey_btn_colors' )['bg-color'],
	),

	'.swal2-popup'                                    => array(
		'max-width' => $srvy_survey_popup_max_width . $srvy_survey_popup_max_width_unit . ' !important',
	),

	'.swal2-container .swal2-confirm.swal2-styled'    => array(
		'padding'          => $srvy_survey_btn_next_height . $srvy_survey_btn_next_unit . ' ' . $srvy_survey_btn_next_width . $srvy_survey_btn_next_unit,
		'background-color' => $srvy_survey_popup_next_color,
	),

	'.swal2-container .swal2-cancel.swal2-styled'     => array(
		'padding'          => $srvy_survey_btn_exit_height . $srvy_survey_btn_exit_unit . ' ' . $srvy_survey_btn_exit_width . $srvy_survey_btn_exit_unit,
		'background-color' => $srvy_survey_popup_exit_color,
	),

);

/***********************
 * CSS Rendering Engine.
 */
$srvy__supo_output_css = '';

foreach ( $srvy_supo_css as $style => $style_array ) {

	$srvy__supo_output_css .= $style . '{';

	foreach ( $style_array as $property => $value ) {

		$srvy__supo_output_css .= $property . ':' . $value . ';';
	}
	$srvy__supo_output_css .= '}';
}

echo '<style>';

// Computed style.
echo esc_html( $srvy__supo_output_css );

echo '</style>';
