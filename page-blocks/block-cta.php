<?php
/**
 * Layout for CTA without Image block.
 * 
 * @package Finlease
 */
$cta_title      = isset( $block['cta_title'] ) && ! empty( $block['cta_title'] ) ? $block['cta_title'] : false;
$cta_desc       = isset( $block['cta_desc'] ) && ! empty( $block['cta_desc'] ) ? $block['cta_desc'] : false;
$cta_btn        = isset( $block['cta_btn'] ) && ! empty( $block['cta_btn'] ) ? $block['cta_btn'] : false;
$cta_bg_color   = isset( $block['cta_bg_color'] ) && ! empty( $block['cta_bg_color'] ) ? $block['cta_bg_color'] : false;
?>
<div class="readystart <?php echo esc_attr( $cta_bg_color ); ?>">
    <div class="container">
        <div class="text-center readystart__wrapper">
            <?php if ( $cta_title ) { ?>
                    <h2><?php echo esc_html( $cta_title ); ?></h2>
            <?php } ?>

            <?php if ( $cta_desc ) {
                echo wp_kses_post( $cta_desc );
            } ?>

            <?php 
            if ( $cta_btn ) { 
                $ctaw_btn_title  = isset( $cta_btn['title'] ) && ! empty( $cta_btn['title'] ) ? $cta_btn['title'] : false;
                $ctaw_btn_url    = isset( $cta_btn['url'] ) && ! empty( $cta_btn['url'] ) ? $cta_btn['url'] : false;
                $ctaw_btn_target = isset( $cta_btn['target'] ) && ! empty( $cta_btn['target'] ) ? $cta_btn['target'] : '_self';
                if( $ctaw_btn_title ) {
            ?>
                    <a href="<?php echo esc_url(  $ctaw_btn_url ); ?>" class="btn btn--red--dust btn--big" target="<?php echo esc_attr( $ctaw_btn_target ); ?>"><?php echo esc_html( $ctaw_btn_title ); ?></a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>