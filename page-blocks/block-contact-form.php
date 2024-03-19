<?php
/**
 * Layout for Contact Form block.
 * 
 * @package Finlease
 */
$form_style     = isset( $block['form_style'] ) && ! empty( $block['form_style'] ) ? $block['form_style'] : false;
$form_title     = isset( $block['form_title'] ) && ! empty( $block['form_title'] ) ? $block['form_title'] : false;
$form_desc      = isset( $block['form_desc'] ) && ! empty( $block['form_desc'] ) ? $block['form_desc']  : false;
$form_shortcode = isset( $block['form_shortcode'] ) && ! empty( $block['form_shortcode'] ) ? $block['form_shortcode'] : false;
?>
<div class="<?php echo ( $form_style ) ? 'contactform-block' : 'get-quote'; ?>">
    <div class="container">
        <?php if ( $form_style ) { ?>
        <div class="row">
            <div class="col-lg-4">
        <?php } ?>
                <div class="contactform__left">
		            <?php if ( $inner_banner_title || $tb_wi_title || get_the_title()) { ?>
	                    <h2><?php echo esc_html( $form_title ); ?></h2>	                    
	               <?php }else{ ?>	            
						<h1><?php echo esc_html( $form_title ); ?></h1>
					<?php } ?>

                    <?php if ( $form_desc ) {
                        echo wp_kses_post( $form_desc );
                    } ?>

                    <?php if ( $form_style ) { ?>
                        <img src="<?php echo FL_TAU; ?>/images/arrow-down.svg">
                    <?php } ?>
                </div>
                <?php if ( $form_style ) { ?>
                    </div>
                    <div class="col-lg-8">
                <?php } ?>
                    <div class="contactform__form">
                        <?php if ( $form_shortcode ) {
                            echo do_shortcode( $form_shortcode );
                        } ?>
                    </div>
        <?php if ( $form_style ) { ?>
                
            </div>
        </div>
        <?php } ?>
    </div>
</div>