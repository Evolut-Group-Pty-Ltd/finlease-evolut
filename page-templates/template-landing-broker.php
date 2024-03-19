<?php
    /*
        Template Name: Landing Page - Broker
        Template Post Type: page
    */
    global $header_type;
    $header_type = 'landing';
    
    $intro = get_field('intro');
    $blocks = get_field( 'page_flexible_content' );

    get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="landing-page">
            <?php if ( $intro && $intro = $intro[0] ): ?>
                <div class="intro">
                    <div class="container">
                        <div class="row align-items-end">
                            <div class="col-lg-5">
                                <h1 class="title"><?php echo $intro['title']; ?></h1>
                                <?php echo $intro['paragraph']; ?>
                            </div>
                            <div class="col-lg-6 offset-lg-1">
                                <div class="r-col">
	                                <?php
		                               if ( $intro['image'] ) {
		                                	echo wp_get_attachment_image($intro['image']['id'], 'large');
		                                }
									?>

									<div class="bottom">
										<?php echo $intro['right_column_content']; ?>

										<div class="row">
											<?php if ( $intro['phone'] ) : ?>
												<div class="col-sm-6 col-12 text-center">
													<a href="tel:<?php echo $intro['phone']; ?>" class="btn btn--big btn--red--dust">Call <?php echo $intro['phone']; ?></a>
												</div>
											<?php endif; ?>
	
											<?php if ( $intro['email'] ) : ?>
												<div class="col-sm-6 col-12 text-center">
													<a href="mailto:<?php echo $intro['email']; ?>" class="btn btn--big btn--green">Send an Email</a>
												</div>
											<?php endif; ?>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            <?php endif ?>

            <?php 
                foreach ($blocks as $key => $block) {
                    $block_name    = isset( $block['acf_fc_layout'] ) && ! empty( $block['acf_fc_layout'] ) ? $block['acf_fc_layout'] : false;

                    if ($block_name == 'calculator') {
                        $block_name = 'calculator-landing-broker';
                    }
                    else if ($block_name == 'testimonial') {
                        $block_name = 'testimonial-landing';
                    }

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