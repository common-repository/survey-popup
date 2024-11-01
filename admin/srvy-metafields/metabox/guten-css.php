<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Metabox of the PAGE and POST both.
// Set a unique slug-like ID
//
$srvy_prefix_meta_guten = '_prefix_meta_guten';

//
// Create a metabox
//
SRVY::createMetabox(
	$srvy_prefix_meta_guten,
	array(
		'title'     => 'Advanced Custom CSS',
		'post_type' => array( 'post', 'page' ),
		'context'   => 'side',
	)
);

//
// Create a section.
//
SRVY::createSection(
	$srvy_prefix_meta_guten,
	array(
		'fields' => array(

			array(
				'id'       => 'acc_code_editor_guten_css',
				'type'     => 'code_editor',
				'settings' => array(
					'theme' => 'mbo',
					'mode'  => 'css',
				),
			),

		),
	)
);
