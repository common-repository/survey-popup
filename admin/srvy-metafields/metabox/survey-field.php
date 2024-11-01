<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a section.
//
SRVY::createSection(
	$srvy_page_opts,
	array(
		'title'  => __( 'Field Settings', 'acc-conditional-typo' ),
		'icon'   => 'fa fa-puzzle-piece',
		'fields' => array(

			array(
				'type'    => 'content',
				'content' => '<div class="srvy--menu-detail">
									<strong>Field Settings</strong>
									<a href="https://forhad.net/support-forum/" target="_blank" class="srvy--need-help">Need Help?</a>
									<br>
									<p>General settings connecting the most important part of this plugin. Create your good survey & poll questions. Make sure to check the required field if you don\'t want to escape any question.</p>
								</div>',
			),

			array(
				'id'      => 'srvy_survey_group',
				'type'    => 'group',
				'fields'  => array(

					array(
						'id'    => 'srvy_survey_question',
						'type'  => 'text',
						'title' => 'Question',
					),
					array(
						'id'            => 'srvy_survey_desc',
						'type'          => 'wp_editor',
						'title'         => 'Details',
						'tinymce'       => true,
						'quicktags'     => true,
						'media_buttons' => true,
						'height'        => '100px',
					),
					array(
						'id'      => 'srvy_survey_type',
						'type'    => 'button_set',
						'title'   => 'Answer Set',
						'options' => array(
							'text'     => __( 'Text', 'acc-conditional-typo' ),
							'radio'    => __( 'Radio', 'acc-conditional-typo' ),
							'rating'   => __( 'Rating', 'acc-conditional-typo' ),
							'textarea' => __( 'Textarea', 'acc-conditional-typo' ),
						),
					),
					array(
						'id'         => 'srvy_survey_radio_repeater',
						'type'       => 'repeater',
						'title'      => 'Create options',
						'class'      => 'acc--lib-load-repeater',
						'fields'     => array(
							array(
								'id'   => 'srvy_survey_radio_text',
								'type' => 'text',
							),
						),
						'dependency' => array( 'srvy_survey_type', '==', 'radio' ),
					),
					array(
						'id'         => 'srvy_survey_rating_type',
						'type'       => 'button_set',
						'title'      => 'Rating Type',
						'options'    => array(
							'number' => __( 'Number', 'acc-conditional-typo' ),
							'star'   => __( 'Star', 'acc-conditional-typo' ),
						),
						'dependency' => array( 'srvy_survey_type', '==', 'rating' ),
					),
					array(
						'id'    => 'srvy_survey_check',
						'type'  => 'checkbox',
						'title' => 'Required?',
						'label' => 'Yes, Users should required to say something!',
					),
				),
				'default' => array(
					array(
						'srvy_survey_question'       => '',
						'srvy_survey_type'           => 'radio',
						'srvy_survey_radio_repeater' => array(
							array(
								'srvy_survey_radio_text' => '',
							),
						),
						'srvy_survey_check'          => true,
					),
				),
			),

			//
			// Load Libraries.
			//
			array(
				'type'    => 'heading',
				'content' => 'Additional Settings',
			),
			array(
				'id'       => 'srvy_survey_btn_txt',
				'type'     => 'text',
				'title'    => 'Button Text',
				'subtitle' => 'Set a button text. The pop will up after this button click.',
				'default'  => 'Join Survey',
			),
			array(
				'id'                => 'srvy_survey_btn_txt_size',
				'type'              => 'dimensions',
				'title'             => 'Button Font Size',
				'subtitle'          => 'Set a font size of the button.',
				'height'            => false,
				'width_placeholder' => 'Size',
			),
			array(
				'id'       => 'srvy_survey_btn_size',
				'type'     => 'dimensions',
				'title'    => 'Button Size',
				'subtitle' => 'Set a height and a width of the button.',
			),
			array(
				'id'       => 'srvy_survey_btn_colors',
				'type'     => 'color_group',
				'title'    => 'Button Colors',
				'subtitle' => 'Set the background color and the text color.',
				'options'  => array(
					'txt-color' => 'Text',
					'bg-color'  => 'Background',
				),
			),

		),
	)
);
