<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Create a section.
//
SRVY::createSection(
	$srvy_page_opts,
	array(
		'title'  => __( 'Survey Data', 'acc-conditional-typo' ),
		'icon'   => 'fa fa-database',
		'fields' => array(

			array(
				'type'    => 'content',
				'content' => '<div class="srvy--menu-detail">
									<strong>Survey Data</strong>
									<a href="https://forhad.net/support-forum/" target="_blank" class="srvy--need-help">Need Help?</a>
									<br>
									<p>See how many times have selected your answers.</p>
								</div>',
			),

			array(
				'id'   => 'survey',
				'type' => 'survey',
			),

		),
	)
);
