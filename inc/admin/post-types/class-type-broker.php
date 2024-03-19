<?php

// Custom post type - Broker.
class FL_Type_Broker {

	public function __construct() {
		add_action( 'init', array( &$this, 'finlease_broker_init' ) );
		add_action( 'init', array( &$this, 'finlease_broker_taxonomies' ), 0 );
	}

	/**
	 * Register a broker post type.
	 */
	public function finlease_broker_init() {
		$labels = array(
			'name'               => _x( 'Brokers', 'post type general name', 'Finlease' ),
			'singular_name'      => _x( 'Broker', 'post type singular name', 'Finlease' ),
			'menu_name'          => _x( 'Brokers', 'admin menu', 'Finlease' ),
			'name_admin_bar'     => _x( 'Broker', 'add new on admin bar', 'Finlease' ),
			'add_new'            => _x( 'Add New', 'broker', 'Finlease' ),
			'add_new_item'       => __( 'Add New Broker', 'Finlease' ),
			'new_item'           => __( 'New Broker', 'Finlease' ),
			'edit_item'          => __( 'Edit Broker', 'Finlease' ),
			'view_item'          => __( 'View Broker', 'Finlease' ),
			'all_items'          => __( 'All Brokers', 'Finlease' ),
			'search_items'       => __( 'Search Brokers', 'Finlease' ),
			'parent_item_colon'  => __( 'Parent Brokers:', 'Finlease' ),
			'not_found'          => __( 'No brokers found.', 'Finlease' ),
			'not_found_in_trash' => __( 'No brokers found in Trash.', 'Finlease' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'broker' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'menu_icon'			 => 'dashicons-groups',
		);

		register_post_type( 'fl_broker', $args );
	}

	// Create taxonomies
	public function finlease_broker_taxonomies() {
		$labels = array(
			'name'              => _x( 'Locations', 'taxonomy general name', 'Finlease' ),
			'singular_name'     => _x( 'Location', 'taxonomy singular name', 'Finlease' ),
			'search_items'      => __( 'Search Locations', 'Finlease' ),
			'all_items'         => __( 'All Locations', 'Finlease' ),
			'parent_item'       => __( 'Parent Location', 'Finlease' ),
			'parent_item_colon' => __( 'Parent Location:', 'Finlease' ),
			'edit_item'         => __( 'Edit Location', 'Finlease' ),
			'update_item'       => __( 'Update Location', 'Finlease' ),
			'add_new_item'      => __( 'Add New Location', 'Finlease' ),
			'new_item_name'     => __( 'New Location Name', 'Finlease' ),
			'menu_name'         => __( 'Locations', 'Finlease' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'brokers/location' ),
		);

		register_taxonomy( 'fl_broker_location', array( 'fl_broker' ), $args );
	}
}

// Run!
new FL_Type_Broker();
