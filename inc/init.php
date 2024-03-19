<?php

// Load all required files
$fl_includes = array(
	'inc/constants.php',
	'inc/lib/wp_bootstrap4-mega-navwalker.php',
	'inc/lib/class-wp-bootstrap-navwalker.php',
	'inc/acf-options.php',
	'inc/setup.php',
	'inc/admin/init.php',
	'inc/assets.php',
	'inc/custom-header.php',
	'inc/template-tags.php',
	'inc/template-functions.php',
	'inc/ajax-functions.php',
	'inc/customizer.php',
);

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Load the templates
foreach ( $fl_includes as $fl_include ) {
	if ( file_exists( get_template_directory() . '/' . $fl_include ) ) {
		locate_template( $fl_include, true, true );
	}
}
unset( $fl_include );
