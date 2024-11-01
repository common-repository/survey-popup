<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a section.
//
SRVY::createSection(
	$srvy_page_opts,
	array(
		'title'  => __( 'Survey Analytics', 'acc-conditional-typo' ),
		'icon'   => 'fa fa-bar-chart',
		'fields' => array(

			array(
				'type'    => 'content',
				'content' => '<div class="srvy--menu-detail">
									<strong>Survey Analytics</strong>
									<a href="https://forhad.net/support-forum/" target="_blank" class="srvy--need-help">Need Help?</a>
									<br>
									<p style="background: antiquewhite;padding: 10px;text-align: center;color: chocolate;">Analyze your survey only with the radio fieldset.</p>
								</div>',
			),

			array(
				'id'   => 'survey_chart',
				'type' => 'survey_chart',
			),

		),
	)
);
