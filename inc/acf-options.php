<?php

// ACF theme options pages
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => 'Finlease Settings',
		'menu_title' => 'Finlease Settings',
		'menu_slug'  => 'finlease-settings',
		'capability' => 'edit_posts',
		'redirect'	 => false,
		'icon_url'   => 'dashicons-admin-settings',
	) );

	// acf_add_options_sub_page( array(
	// 	'page_title'  => 'Header Settings',
	// 	'menu_title'  => 'Header',
	// 	'parent_slug' => 'finlease-settings',
	// ) );

	// acf_add_options_sub_page( array(
	// 	'page_title'  => 'Footer Settings',
	// 	'menu_title'  => 'Footer',
	// 	'parent_slug' => 'finlease-settings',
	// ) );
}
