<?php
/*
	Template Name: Services page layout
	Template Post Type: page
*/
get_header();

if ( class_exists( 'ACF' ) ) {
	$services_blocks = get_field( 'services_flexible_content' );
	if ( ! empty( $services_blocks ) && is_array( $services_blocks ) ) {
		foreach ( $services_blocks as $key => $block ){
			$block_name    = isset( $block['acf_fc_layout'] ) && ! empty( $block['acf_fc_layout'] ) ? $block['acf_fc_layout'] : false;
			$template_path = locate_template( 'page-blocks/block-' . $block_name . '.php' , false, false );
			if ( $block_name && ! empty( $template_path ) ) :
				// Include the template file.
				include( $template_path );
			
			endif;
		}
	}
	else {
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			/*
				* Include the Post-Type-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Type name) and that will be used instead.
				*/
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;

	}
}
else {
	/* Start the Loop */
	while ( have_posts() ) :
		the_post();

		/*
		 * Include the Post-Type-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
		 */
		get_template_part( 'template-parts/content', get_post_type() );

	endwhile;

}

get_footer();