<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Metabox of the PAGE and POST both.
// Set a unique slug-like ID
//
$srvy_prefix_meta_opts = '_prefix_meta_options';

//
// Create a metabox
//
SRVY::createMetabox(
	$srvy_prefix_meta_opts,
	array(
		'title'     => 'Shortcode',
		'post_type' => 'gpsp_survey',
		'context'   => 'side',
	)
);

//
// Create a section.
//
if ( isset( $_GET['post'] ) ) {

	SRVY::createSection(
		$srvy_prefix_meta_opts,
		array(
			'fields' => array(

				array(
					'type'  => 'shortcode',
					'class' => 'srvy--shortcode-field',
				),
			),
		)
	);
} else {

	SRVY::createSection(
		$srvy_prefix_meta_opts,
		array(
			'fields' => array(

				array(
					'type'    => 'content',
					'content' => 'Shortcode will appear here after publish the slider.',
				),

			),
		)
	);
}
