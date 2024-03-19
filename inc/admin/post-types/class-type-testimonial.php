<?php

// Custom post type - Testimonial.
class FL_Type_Testimonial {

	public function __construct() {
		add_action( 'init', array( &$this, 'finlease_testimonial_init' ) );
		add_action( 'init', array( &$this, 'finlease_testimonial_taxonomies' ) );
	}

	/**
	 * Register a testimonial post type.
	 */
	public function finlease_testimonial_init() {
		$labels = array(
			'name'               => _x( 'Testimonials', 'post type general name', 'Finlease' ),
			'singular_name'      => _x( 'Testimonial', 'post type singular name', 'Finlease' ),
			'menu_name'          => _x( 'Testimonials', 'admin menu', 'Finlease' ),
			'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'Finlease' ),
			'add_new'            => _x( 'Add New', 'testimonial', 'Finlease' ),
			'add_new_item'       => __( 'Add New Testimonial', 'Finlease' ),
			'new_item'           => __( 'New Testimonial', 'Finlease' ),
			'edit_item'          => __( 'Edit Testimonial', 'Finlease' ),
			'view_item'          => __( 'View Testimonial', 'Finlease' ),
			'all_items'          => __( 'All Testimonials', 'Finlease' ),
			'search_items'       => __( 'Search Testimonials', 'Finlease' ),
			'parent_item_colon'  => __( 'Parent Testimonials:', 'Finlease' ),
			'not_found'          => __( 'No testimonials found.', 'Finlease' ),
			'not_found_in_trash' => __( 'No testimonials found in Trash.', 'Finlease' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'testimonial' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor' ),
			'taxonomies'         => array( 'testimonial_tag' ),
			'menu_icon'			 => 'dashicons-format-status',
		);

		register_post_type( 'fl_testimonial', $args );
	}

	// Register Custom Taxonomy
	public function finlease_testimonial_taxonomies() {

		$labels = array(
			'name'                       => _x( 'Tags', 'Taxonomy General Name', 'Finlease' ),
			'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'Finlease' ),
			'menu_name'                  => __( 'Tags', 'Finlease' ),
			'all_items'                  => __( 'All Items', 'Finlease' ),
			'parent_item'                => __( 'Parent Item', 'Finlease' ),
			'parent_item_colon'          => __( 'Parent Item:', 'Finlease' ),
			'new_item_name'              => __( 'New Item Name', 'Finlease' ),
			'add_new_item'               => __( 'Add New Item', 'Finlease' ),
			'edit_item'                  => __( 'Edit Item', 'Finlease' ),
			'update_item'                => __( 'Update Item', 'Finlease' ),
			'view_item'                  => __( 'View Item', 'Finlease' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'Finlease' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'Finlease' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'Finlease' ),
			'popular_items'              => __( 'Popular Items', 'Finlease' ),
			'search_items'               => __( 'Search Items', 'Finlease' ),
			'not_found'                  => __( 'Not Found', 'Finlease' ),
			'no_terms'                   => __( 'No items', 'Finlease' ),
			'items_list'                 => __( 'Items list', 'Finlease' ),
			'items_list_navigation'      => __( 'Items list navigation', 'Finlease' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'testimonial_tag', array( 'fl_testimonial' ), $args );

	}
}

// Run!
new FL_Type_Testimonial();
