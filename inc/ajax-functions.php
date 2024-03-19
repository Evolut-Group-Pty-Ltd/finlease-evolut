<?php
/**
 * Ajax Broker Filter
 */
function finlease_broker_filter() {
	get_template_part( 'template-parts/ajax/content', 'broker' );
	wp_die();
}
add_action( 'wp_ajax_finlease_broker_filter', 'finlease_broker_filter' );
add_action( 'wp_ajax_nopriv_finlease_broker_filter', 'finlease_broker_filter' );

/**
 * Ajax for adding feature add item.
 */
function finlease_featured_admin_ajax() {
	if ( ! wp_verify_nonce( $_POST['nonce'], 'finlease_featured_nounce' ) ) {
		exit( 'invalid' );
	}

	header( 'Content-Type: application/json' );
	$post_id = intval( $_POST['post_id'] );
	$featured_status = esc_attr( get_post_meta( $post_id, 'finlease_featured', true ) );
	$new_status = $featured_status == 'yes' ? 'no' : 'yes';
	update_post_meta( $post_id, 'finlease_featured', $new_status );
	echo json_encode( array(
		'ID' => $post_id,
		'new_status' => $new_status,
	) );
	die();
}
add_action( 'wp_ajax_finlease_featured_post', 'finlease_featured_admin_ajax' );

/**
 * Ajax Blog page
 */

function finlease_blog_posts_filter() {
    get_template_part( 'template-parts/ajax/content', 'blog' );
	wp_die();
}
add_action( 'wp_ajax_finlease_blog_posts', 'finlease_blog_posts_filter' );
add_action( 'wp_ajax_nopriv_finlease_blog_posts', 'finlease_blog_posts_filter' );

/**
 * Ajax Broker page
 */

function finlease_brokers_filter() {
    get_template_part( 'template-parts/ajax/content', 'brokers' );
	wp_die();
}
add_action( 'wp_ajax_finlease_brokers', 'finlease_brokers_filter' );
add_action( 'wp_ajax_nopriv_finlease_brokers', 'finlease_brokers_filter' );