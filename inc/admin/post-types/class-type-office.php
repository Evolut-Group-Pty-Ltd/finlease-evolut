<?php

// Custom post type - Office.
class FL_Type_Office {

	public function __construct() {
		add_action( 'init', array( &$this, 'finlease_office_init' ) );
		add_action( 'init', array( &$this, 'finlease_office_taxonomies' ), 0 );
	}

	/**
	 * Register a office post type.
	 */
	public function finlease_office_init() {
		$labels = array(
			'name'               => _x( 'Offices', 'post type general name', 'Finlease' ),
			'singular_name'      => _x( 'Office', 'post type singular name', 'Finlease' ),
			'menu_name'          => _x( 'Offices', 'admin menu', 'Finlease' ),
			'name_admin_bar'     => _x( 'Office', 'add new on admin bar', 'Finlease' ),
			'add_new'            => _x( 'Add New', 'office', 'Finlease' ),
			'add_new_item'       => __( 'Add New Office', 'Finlease' ),
			'new_item'           => __( 'New Office', 'Finlease' ),
			'edit_item'          => __( 'Edit Office', 'Finlease' ),
			'view_item'          => __( 'View Office', 'Finlease' ),
			'all_items'          => __( 'All Offices', 'Finlease' ),
			'search_items'       => __( 'Search Offices', 'Finlease' ),
			'parent_item_colon'  => __( 'Parent Offices:', 'Finlease' ),
			'not_found'          => __( 'No offices found.', 'Finlease' ),
			'not_found_in_trash' => __( 'No offices found in Trash.', 'Finlease' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'office' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title' ),
			'menu_icon'			 => 'dashicons-admin-site',
		);

		register_post_type( 'fl_office', $args );
	}

	// Create taxonomies
	public function finlease_office_taxonomies() {
		$labels = array(
			'name'              => _x( 'States', 'taxonomy general name', 'Finlease' ),
			'singular_name'     => _x( 'State', 'taxonomy singular name', 'Finlease' ),
			'search_items'      => __( 'Search States', 'Finlease' ),
			'all_items'         => __( 'All States', 'Finlease' ),
			'parent_item'       => __( 'Parent State', 'Finlease' ),
			'parent_item_colon' => __( 'Parent State:', 'Finlease' ),
			'edit_item'         => __( 'Edit State', 'Finlease' ),
			'update_item'       => __( 'Update State', 'Finlease' ),
			'add_new_item'      => __( 'Add New State', 'Finlease' ),
			'new_item_name'     => __( 'New State Name', 'Finlease' ),
			'menu_name'         => __( 'States', 'Finlease' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'offices/state' ),
		);

		register_taxonomy( 'fl_office_state', array( 'fl_office' ), $args );
	}
}

// Run!
new FL_Type_Office();
