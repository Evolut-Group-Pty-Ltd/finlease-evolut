<?php
/**
 * Layout for CTA with Image block.
 * 
 * @package Finlease
 */
$cta_wi_title = isset( $block['cta_wi_title'] ) && ! empty( $block['cta_wi_title'] ) ? $block['cta_wi_title'] : false;
$cta_wi_desc  = isset( $block['cta_wi_desc'] ) && ! empty( $block['cta_wi_desc'] ) ? $block['cta_wi_desc'] : false;
$cta_wi_img   = isset( $block['cta_wi_img'] ) && ! empty( $block['cta_wi_img'] ) ? $block['cta_wi_img'] : false;
$ct_wi_btn    = isset( $block['ct_wi_btn'] ) && ! empty( $block['ct_wi_btn'] ) ? $block['ct_wi_btn'] : false;
?>
<div class="touch-experts white--bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="touch__content__block">
                    <?php if ( $cta_wi_title ) { ?>
                        <h3><?php echo esc_html( $cta_wi_title ); ?></h3>
                    <?php } ?>

                    <?php if ( $cta_wi_desc ) {
                        echo wp_kses_post( $cta_wi_desc );
                    } ?>

                    <?php 
                    if ( $ct_wi_btn ) { 
                        $cta_btn_title  = isset( $ct_wi_btn['title'] ) && ! empty( $ct_wi_btn['title'] ) ? $ct_wi_btn['title'] : false;
                        $cta_btn_url    = isset( $ct_wi_btn['url'] ) && ! empty( $ct_wi_btn['url'] ) ? $ct_wi_btn['url'] : false;
                        $cta_btn_target = isset( $ct_wi_btn['target'] ) && ! empty( $ct_wi_btn['target'] ) ? $ct_wi_btn['target'] : '_self';
                        if( $cta_btn_title ) {
                    ?>
                            <a class="btn btn--big btn--red--outline"  href="<?php echo esc_url(  $cta_btn_url ); ?>" target="<?php echo esc_attr( $cta_btn_target ); ?>"><?php echo esc_html( $cta_btn_title ); ?></a>
                    <?php 
                        }
                    } 
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <?php 
                if ( $cta_wi_img ) { 
                    $cta_img_alt  = isset( $cta_wi_img['alt'] ) && ! empty( $cta_wi_img['alt'] ) ? $cta_wi_img['alt'] : false;
                    $cta_img_url  = isset( $cta_wi_img['url'] ) && ! empty( $cta_wi_img['url'] ) ? $cta_wi_img['url'] : false;
                    if ( $cta_img_url ) {
                ?>
                    <div class="touch__image">
                        <img src="<?php echo esc_url( $cta_wi_img['sizes']['finlease-cta-block'] ); ?>" alt="<?php echo esc_attr( $cta_img_alt ); ?>">
                    </div>
                <?php
                    }
                } 
                ?>
            </div>
        </div>
    </div>
</div>