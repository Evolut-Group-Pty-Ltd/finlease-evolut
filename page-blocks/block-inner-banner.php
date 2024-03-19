<?php
/**
 * Layout for Inner Banner block.
 * 
 * @package Finlease
 */
$inner_banner_img   = isset( $block['inner_banner_image'] ) && ! empty( $block['inner_banner_image'] ) ? $block['inner_banner_image'] : false;
$inner_banner_title = isset( $block['inner_banner_title'] ) && ! empty( $block['inner_banner_title'] ) ? $block['inner_banner_title'] : false;
$inner_banner_desc  = isset( $block['inner_banner_desc'] ) && ! empty( $block['inner_banner_desc'] ) ? $block['inner_banner_desc'] : false;
?>
<div class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <?php if ( $inner_banner_img && !empty( $inner_banner_img['url'] ) ) { ?>
                        <div class="banner__image">
                            <img src="<?php echo esc_url( $inner_banner_img['sizes']['finlease-inner-banner'] ); ?>" alt="<?php echo esc_attr( $inner_banner_img['alt'] ); ?>">
                        </div>
                <?php } ?>
            </div>
            <div class="col-lg-6">
                <div class="inner__banner__caption">
                    <?php if ( $inner_banner_title ) { ?>
                            <h1><?php echo $inner_banner_title; ?></h1>
                    <?php } ?>

                    <?php if ( $inner_banner_desc ) {
                            echo wp_kses_post( $inner_banner_desc );
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>