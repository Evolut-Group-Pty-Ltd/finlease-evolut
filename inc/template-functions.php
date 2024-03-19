<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Finlease
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function finlease_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'finlease_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function finlease_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'finlease_pingback_header' );

function finlease_details_to_menu( $item_output, $item, $depth, $args ) {
	if ( $depth == 2 ) {
		$image = get_field( 'fl_nav_image', $item->ID );
		
		$item_output .= "<div class='product-detail'>";
		if ( isset( $image ) && !empty( $image['url'] ) ) {
			$item_output .= sprintf( '<div class="product-image"><img src="%s" alt="%s"></div>', esc_url( $image['url'] ), esc_attr( $image['alt'] ) );
		}
		if ( strlen( $item->description ) > 0 ) {
			$item_output .= sprintf( '<div class="product-content"><p>%s</p></div>', esc_html( $item->description ) );
		}
		$item_output .= "</div>";
	}
	
	return $item_output; }
add_filter( 'walker_nav_menu_start_el', 'finlease_details_to_menu', 10, 4 );

/**
 * Function limit the number of words.
 */
function finlease_limit_words($string, $word_limit) {

	$words = explode(' ', $string, ($word_limit + 1));

	if(count($words) > $word_limit) {

		if(count($words) > $word_limit) {

			array_pop($words);

			return implode(' ', $words).' ...';

		}
	} else {

		return $string;

	}

}

/**
 * Google map API key
 */
function finlease_acf_init() {
	$api_key = get_field( 'fl_google_map_api_key', 'option' );
	acf_update_setting( 'google_api_key', $api_key );
}

add_action('acf/init', 'finlease_acf_init');

function finlease_wpcf7_form_elements($html) {
    $text = 'Please select one';
    $html = str_replace('<option value="">---</option>', '<option value="">' . $text . '</option>', $html);
    return $html;
}
add_filter('wpcf7_form_elements', 'finlease_wpcf7_form_elements');



function finlease_get_quote_msg( $cf7 ) {
	if ( is_page_template( 'page-templates/template-contact.php' ) ) {
		$wpcf7 = WPCF7_ContactForm::get_current();
		if ( 681 == $wpcf7->id() ) {
	?>
		<script type="text/javascript">
			var getUrlParameter = function getUrlParameter(sParam) {
				var sPageURL = decodeURIComponent(window.location.search.substring(1)),
					sURLVariables = sPageURL.split('&'),
					sParameterName,
					i;
				for (i = 0; i < sURLVariables.length; i++) {
					sParameterName = sURLVariables[i].split('=');
					if (sParameterName[0] === sParam) {
						return sParameterName[1] === undefined ? true : sParameterName[1];
					}
				}
			};

			var type = getUrlParameter('type'),
				loan = getUrlParameter('loan'),
				amount = getUrlParameter('amount'),
				interest = getUrlParameter('interest'),
				residual = getUrlParameter('residual'),
				payment = getUrlParameter('payment'),
				total = getUrlParameter('total');

			if ( loan != null ) {
				document.getElementById('quote-msg').value = "Hi, I would like to get a refine quote for " + type + ".\nLoan Term: "+loan
				+ "\nInterest rate: "+interest
				+ "\nAmount financed: "+amount
				+ "\nResidual / Balloon: "+residual
				+ "\nPayment Arrears: "+payment
				+ "\nYour payment amount will be approximately: "+total
				+ " Monthly";
			}

		</script>
	<?php
		}
	}
}
add_action('wp_footer', 'finlease_get_quote_msg');

/**
 * Related posts
 */
function finlease_get_related_posts( $post_id, $related_count, $args = array() ) {
	$args = wp_parse_args( (array) $args, array(
		'orderby' => 'rand',
		'return'  => 'query',
	) );

	$related_args = array(
		'post_type'      => get_post_type( $post_id ),
		'posts_per_page' => $related_count,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id ),
		'orderby'        => $args['orderby'],
		'tax_query'      => array()
	);

	$post       = get_post( $post_id );
	$taxonomies = get_object_taxonomies( $post, 'names' );

	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( empty( $terms ) ) {
			continue;
		}
		$term_list                   = wp_list_pluck( $terms, 'slug' );
		$related_args['tax_query'][] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term_list
		);
	}

	if ( count( $related_args['tax_query'] ) > 1 ) {
		$related_args['tax_query']['relation'] = 'OR';
	}

	if ( $args['return'] == 'query' ) {
		return new WP_Query( $related_args );
	} else {
		return $related_args;
	}
}

// add_filter( 'post_edit_category_parent_dropdown_args', 'hide_parent_dropdown_select' );

/** Dynamic List for Contact Form 7 **/
/** Usage: [select name term:taxonomy_name] **/
// function dynamic_select_list($tag, $unused){ 
//     $options = (array)$tag['options'];

//     foreach ($options as $option) 
//         if (preg_match('%^menu_name:([-0-9a-zA-Z_]+)$%', $option, $matches)) 
//             $menu_name = $matches[1];

//     //check if post_type is set
//     if(!isset($menu_name))
// 		return $tag;
		
// 	$locations = get_nav_menu_locations();
// 	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
// 	$menu_items = wp_get_nav_menu_items($menu->term_id);


//     foreach ($menu_items as $item) {  
// 		$tag['raw_values'][] = $item->title;  
// 		$tag['values'][] = $item->title;  
// 		$tag['labels'][] = $item->title;
        
//     }

//     return $tag; 
// }
// add_filter( 'wpcf7_form_tag', 'dynamic_select_list', 10, 2);