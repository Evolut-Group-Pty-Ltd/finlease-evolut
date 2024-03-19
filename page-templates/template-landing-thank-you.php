<?php
    /*
        Template Name: Landing Page - Thank you
        Template Post Type: page
    */
    global $header_type;
    $header_type = 'landing';
    
    $intro = get_field('intro');
    $blocks = get_field( 'home_flexible_content' );

    get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="landing-page-thanks">
            <div class="intro">
                <div class="container">
                    <div class="text">
                        <?php the_content() ?>
                    </div>
                    <a href="<?php echo home_url() ?>" class="btn btn--red--dust btn--big">Visit Site</a>
                </div>
            </div>

            <?php 
                foreach ($blocks as $key => $block) {
                    $block_name    = isset( $block['acf_fc_layout'] ) && ! empty( $block['acf_fc_layout'] ) ? $block['acf_fc_layout'] : false;

                    $template_path = locate_template( 'page-blocks/block-' . $block_name . '.php' , false, false );
                    if ( $block_name && ! empty( $template_path ) ) :
                        // Include the template file.
                        include( $template_path );
                    
                    endif;
                }
            ?>         
		</div>
	</main>
</div>

<?php 
    get_footer();