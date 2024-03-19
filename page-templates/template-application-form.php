<?php
/*
	Template Name: Application Form page layout
	Template Post Type: page
*/
get_header();
while ( have_posts() ) :
    the_post();
?>
    <div class="applicationform">
        <div class="container">
            <div class="title-block">
                <h2><?php the_title(); ?></h2>
            </div>

            <div class="application__desc text-center">
                <?php the_content(); ?>
            </div>
            <?php
            if ( class_exists( 'ACF' ) ) {
                $app_form_blocks = get_field( 'app_form_flexible_content' );
                if ( ! empty( $app_form_blocks ) && is_array( $app_form_blocks ) ) {
                    foreach ( $app_form_blocks as $key => $block ){
                        $block_name    = isset( $block['acf_fc_layout'] ) && ! empty( $block['acf_fc_layout'] ) ? $block['acf_fc_layout'] : false;
                        $template_path = locate_template( 'page-blocks/block-' . $block_name . '.php' , false, false );
                        if ( $block_name && ! empty( $template_path ) ) :
                            // Include the template file.
                            include( $template_path );
                        
                        endif;
                    }
                }
            }
            ?>
        </div>
    </div>
<?php
    endwhile;
get_footer();