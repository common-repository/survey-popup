<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

//
// Metabox of the PAGE.
// Set a unique slug-like ID.
//
$srvy_page_opts = '_srvy_page_options';

//
// Create a metabox.
//
SRVY::createMetabox(
	$srvy_page_opts,
	array(
		'title'        => 'SURVEY POPUP',
		'post_type'    => 'gpsp_survey',
		'show_restore' => false,
		'theme'        => 'light',
		'class'        => 'srvy--metabox-options',
	)
);
