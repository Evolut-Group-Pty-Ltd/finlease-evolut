<?php
/*
	Template Name: Calculator page layout
	Template Post Type: page
*/
get_header();
while ( have_posts() ) :
	the_post();
?>
	<div class="loan-calculator-text">
        <div class="container">
            <div class="loan__calculator__wrapper">
                <div class="title-blok">
                    <h1><?php the_title(); ?></h1>
                </div>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php
    if ( class_exists( 'ACF' ) ) {
        $calculator_blocks = get_field( 'cal_flexible_content' );
        if ( ! empty( $calculator_blocks ) && is_array( $calculator_blocks ) ) {
            foreach ( $calculator_blocks as $key => $block ){
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

<?php
endwhile;
get_footer();