<?php
/**
 * Enqueue scripts and styles.
 */
/**
 * Undocumented function
 *
 * @return void
 */
function finlease_scripts() {
	wp_enqueue_style( 'finlease-style', get_stylesheet_uri() );

	// THEME STYLESHEETS
	wp_enqueue_style( 'finlease-bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css', [], null );
	wp_enqueue_style( 'finlease-jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css', [], null );
	wp_enqueue_style( 'finlease-select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css', [], null );
	wp_enqueue_style( 'finlease-custom', FL_TAU . '/css/custom.css', [], '1.0.13' );
		
	// THEME SCRIPTS
	wp_enqueue_script( 'finlease-jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', [], null );
	wp_enqueue_script( 'finlease-jquery-ui-touch', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', [], null );
	wp_enqueue_script( 'finlease-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', [], null );
	wp_enqueue_script( 'finlease-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', ['jquery'], null );
	wp_enqueue_script( 'finlease-select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js', [], null );
	wp_enqueue_script( 'finlease-appear', FL_TAU . '/js/jquery.appear.js', ['jquery'], null, true );
	wp_enqueue_script( 'finlease-owl-carouseln', FL_TAU . '/js/owl.carousel.min.js', ['jquery'], null, true );
	wp_enqueue_script( 'finlease-scrolltofixed', FL_TAU . '/js/jquery-scrolltofixed-min.js', ['jquery'], null, true );
	wp_enqueue_script( 'finlease-isotop', FL_TAU . '/js/isotope.min.js', ['jquery'], null, true );
	wp_enqueue_script( 'finlease-custom', FL_TAU . '/js/custom.min.js', ['jquery'], '1.0.6', true );
	wp_enqueue_script( 'finlease-main', FL_TAU . '/js/main.min.js', ['jquery'], '1.0.7', true );

	wp_localize_script( 'finlease-main', 'finlease_url', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'URL' 	  => FL_TAU,
		'siteurl' => home_url()
	) );
	if (is_page_template( 'page-templates/template-calculator.php' ) || is_page_template( 'page-templates/template-landing.php' ) || is_page_template( 'page-templates/template-landing-broker.php' ) || is_page_template( 'page-templates/template-3rd-party-calculator.php' ) ) {
		wp_enqueue_script( 'finlease-calculator', FL_TAU . '/js/calculator.js', ['jquery'], '1.0.2', true );
	}

	if(is_page_template( 'page-templates/template-3rd-party-calculator-finrent.php' )) {
		wp_enqueue_script( 'finlease-finrent-calculator', FL_TAU . '/js/finrent-calculator.js', ['jquery'], '1.0.6', true );
	}

	wp_enqueue_script( 'finlease-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'finlease-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'finlease_scripts' );

/**
 * finlease_admin_assets - Enqueue Admin Assets
 * @return void
 */
function finlease_admin_assets() {

	wp_register_script( 'finlease-admin-script', FL_TAU . '/js/admin.js', array( 'jquery' ), '', true );

	wp_localize_script( 'finlease-admin-script', 'admin',  array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );

	wp_enqueue_script( 'finlease-admin-script' );

}

add_action( 'admin_enqueue_scripts', 'finlease_admin_assets' );
