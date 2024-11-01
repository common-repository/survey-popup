<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a section.
//
SRVY::createSection(
	$srvy_prefix,
	array(
		'title'  => __( 'Related', 'acc-conditional-typo' ),
		'icon'   => 'fa fa-random',
		'fields' => array(

			array(
				'id'       => 'srvy_survey_popup_max_width',
				'type'     => 'dimensions',
				'title'    => 'Popup Max-Width',
				'subtitle' => 'Set a maximum width of the popup box.',
				'height'   => false,
				'default'  => array(
					'width' => '70',
					'unit'  => 'em',
				),
			),
			array(
				'id'       => 'srvy_survey_popup_next',
				'type'     => 'fieldset',
				'title'    => 'Survey Popup Next',
				'subtitle' => 'Survey popup next button settings.',
				'fields'   => array(
					array(
						'id'      => 'srvy_survey_popup_next_text',
						'type'    => 'text',
						'title'   => 'Text',
						'default' => 'Next &rarr;',
					),
					array(
						'id'      => 'srvy_survey_popup_next_size',
						'type'    => 'dimensions',
						'title'   => 'Size',
						'default' => array(
							'width'  => '.625',
							'height' => '2',
							'unit'   => 'em',
						),
					),
					array(
						'id'      => 'srvy_survey_popup_next_color',
						'type'    => 'color',
						'title'   => 'Background Color',
						'default' => 'rgb(48, 133, 214)',
					),
				),
			),
			array(
				'id'       => 'srvy_survey_popup_exit',
				'type'     => 'fieldset',
				'title'    => 'Survey Popup Exit',
				'subtitle' => 'Survey popup exit button settings.',
				'fields'   => array(
					array(
						'id'      => 'srvy_survey_popup_exit_text',
						'type'    => 'text',
						'title'   => 'Text',
						'default' => 'Exit Survey!',
					),
					array(
						'id'      => 'srvy_survey_popup_exit_size',
						'type'    => 'dimensions',
						'title'   => 'Size',
						'default' => array(
							'width'  => '.625',
							'height' => '2',
							'unit'   => 'em',
						),
					),
					array(
						'id'      => 'srvy_survey_popup_exit_color',
						'type'    => 'color',
						'title'   => 'Background Color',
						'default' => '#aaa',
					),
				),
			),
			array(
				'id'            => 'srvy_survey_msg_done',
				'type'          => 'wp_editor',
				'title'         => 'Message (When Done)',
				'subtitle'      => 'Set a text to show in the message when someone participate the whole survey.',
				'tinymce'       => true,
				'quicktags'     => true,
				'media_buttons' => false,
				'height'        => '100px',
				'default'       => 'Your survey has been completed.',
			),
			array(
				'id'            => 'srvy_survey_msg_exit',
				'type'          => 'wp_editor',
				'title'         => 'Message (When Exit)',
				'subtitle'      => 'Set a text to show in the message when someone exit the survey.',
				'tinymce'       => true,
				'quicktags'     => true,
				'media_buttons' => false,
				'height'        => '100px',
				'default'       => 'You canceled the Survey :(',
			),

		),
	)
);
