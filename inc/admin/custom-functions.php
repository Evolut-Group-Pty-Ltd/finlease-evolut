<?php
/**
 * Finlease Admin custom functions
 * 
 * @package Finlease\inc\admin
 */
$post_name = 'post';
/*
 * ADMIN COLUMN - HEADERS
 */
add_filter( 'manage_edit-' . $post_name . '_columns', 'finlease_post_columns' );

/**
 * Customize Admin column.
 *
 * @param  Array $booking_columns List of columns.
 * @return Array                  [description]
 */
function finlease_post_columns( $itinerary_columns ) {
	$comment = isset( $itinerary_columns['comments'] ) ?  $itinerary_columns['comments'] : '';
	$date = $itinerary_columns['date'];
	unset( $itinerary_columns['date'] );
	unset( $itinerary_columns['comments'] );

	$itinerary_columns['featured'] = __( 'Featured', 'finlease' );
	if ( $comment ) {
		$itinerary_columns['comments'] = $comment;
	}
	$itinerary_columns['date'] = __( 'Date', 'finlease' );
	return $itinerary_columns;
}

/*
 * ADMIN COLUMN - CONTENT
 */
add_action( 'manage_' . $post_name . '_posts_custom_column', 'finlease_post_manage_columns', 10, 2 );

/**
 * Add data to custom column.
 *
 * @param  String $column_name Custom column name.
 * @param  int 	  $id          Post ID.
 */
function finlease_post_manage_columns( $column_name, $id ) {
	switch ( $column_name ) {
		case 'featured':
			$featured = get_post_meta( $id, 'finlease_featured', true );
			$featured = ( isset( $featured ) && '' != $featured ) ? $featured : 'no';

			$icon_class = ' dashicons-star-empty ';
			if ( ! empty( $featured ) && 'yes' === $featured ) {
				$icon_class = ' dashicons-star-filled ';
			}
			$nonce = wp_create_nonce( 'finlease_featured_nounce' );
			printf( '<a href="#" class="finlease-featured-post dashicons %s" data-post-id="%d"  data-nonce="%s"></a>', $icon_class, $id, $nonce );
			break;
		default:
			break;
	} // end switch
}