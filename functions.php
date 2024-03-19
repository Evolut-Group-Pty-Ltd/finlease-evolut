<?php
// Init.
require __DIR__ . '/inc/init.php';

// Removing annoying admin bar spacing
function remove_admin_login_header() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'remove_admin_login_header' );

// CF7 shortcode attributes
function finlease_shortcode_atts_wpcf7( $out, $pairs, $atts ) {
  $custom_attrs = [
    'amount-financed',
    'interest-rate',
    'loan-term',
    'residual-balloon',
  ];
  foreach ( $custom_attrs as $custom_attr ) {
    if ( isset( $atts[ $custom_attr ] ) ) {
      $out[ $custom_attr ] = $atts[ $custom_attr ];
    }
  }
  return $out;
}
add_filter( 'shortcode_atts_wpcf7', 'finlease_shortcode_atts_wpcf7', 10, 3 );

add_action( 'wp_footer', function () {
?>
  <script>
    document.addEventListener( 'wpcf7mailsent', ( event ) => {
      window.dataLayer.push( {
        'event' : 'Contact Form Submission',
        'formId' : event.detail.contactFormId,
        'formData' : event.detail.inputs,
        'formLocation' : window.location.href
      } );
    }); 
  </script>
<?php
}, 999, 0 );

// Remove comment functionality and pages. */
add_action(
  'admin_init',
  function () {
    global $current_page;
    if ( $current_page === 'edit-comments.php' ) {
      wp_safe_redirect( admin_url() );
      exit;
    }
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    foreach ( get_post_types() as $post_type ) {
      if ( post_type_supports( $post_type, 'comments' ) ) {
        remove_post_type_support( $post_type, 'comments' );
        remove_post_type_support( $post_type, 'trackbacks' );
      }
    }
  }
);
add_action(
  'admin_menu',
  function () {
    remove_menu_page( 'edit-comments.php' );
  }
);
add_action(
  'init',
  function () {
    if ( is_admin_bar_showing() ) {
      remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
    }
  }
);
add_filter( 'comments_array', '__return_empty_array', 10, 2 );
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );