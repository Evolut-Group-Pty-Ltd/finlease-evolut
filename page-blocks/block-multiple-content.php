<?php
/**
 * Layout for Multiple Content block.
 * 
 * @package Finlease
 */
$mc_title   = isset( $block['mc_title'] ) && ! empty( $block['mc_title'] ) ? $block['mc_title'] : false;
$mc_heading = isset( $block['mc_heading'] ) && ! empty( $block['mc_heading'] ) ? $block['mc_heading'] : false;
$mc_bg      = isset( $block['mc_bg'] ) && ! empty( $block['mc_bg'] ) ? $block['mc_bg'] : false;
$mc_blocks   = isset( $block['mc_block'] ) && ! empty( $block['mc_block'] ) ? $block['mc_block'] : false;
?>
<div class="help <?php echo esc_attr( ( $mc_bg ) ? $mc_bg : '' ); ?>">
    <div class="container">
        <div class="title-block">
            <?php if ( $mc_title ) { ?>
                <span><?php echo esc_html( $mc_title ); ?></span>
            <?php } ?>

            <?php if ( $mc_heading ) { ?>
                <h2><?php echo esc_html( $mc_heading ); ?></h2>
            <?php } ?>
        </div>

        <?php 
        if ( $mc_blocks ) { 
            foreach ( $mc_blocks as $mc_block ) {
                $block_title      = isset( $mc_block['mc_block_title'] ) && ! empty( $mc_block['mc_block_title'] ) ? $mc_block['mc_block_title'] : false;
                $block_desc       = isset( $mc_block['mc_block_desc'] ) && ! empty( $mc_block['mc_block_desc'] ) ? $mc_block['mc_block_desc'] : false;
                $block_img        = isset( $mc_block['mc_block_img'] ) && ! empty( $mc_block['mc_block_img'] ) ? $mc_block['mc_block_img'] : false;
                $block_btn        = isset( $mc_block['mc_block_button'] ) && ! empty( $mc_block['mc_block_button'] ) ? $mc_block['mc_block_button'] : false;
                ?>
                    <div class="row">
                        
                        <div class="col-lg-6">
                        <?php if ( $block_img && $block_img['url'] ) { ?>
                            <figure class="figure__block">
                                <img src="<?php echo esc_url( $block_img['sizes']['finlease-multiple-content'] ); ?>" alt="<?php echo esc_attr( $block_img['alt'] ); ?>">
                            </figure>
                        <?php } ?>
                        </div>

                        <div class="col-lg-6">
                            <div class="help__content__block">
                                <?php if ( $block_title ) { ?>
                                    <h3><?php echo esc_html( $block_title ); ?></h3>
                                <?php } ?>

                                <?php 
                                if ( $block_desc ) {
                                    echo wp_kses_post( $block_desc ); 
                                }
                                if ( $block_btn ) {
                                    $block_btn_title  = isset( $block_btn['title'] ) && ! empty( $block_btn['title'] ) ? $block_btn['title'] : false;
                                    $block_btn_url    = isset( $block_btn['url'] ) && ! empty( $block_btn['url'] ) ? $block_btn['url'] : false;
                                    $block_btn_target = isset( $block_btn['target'] ) && ! empty( $block_btn['target'] ) ? $block_btn['target'] : '_self';
                                    if ( $block_btn_title ) {
                                ?>
                                    <a class="btn btn--big btn--red--outline" href="<?php echo esc_url(  $block_btn_url ); ?>" target="<?php echo esc_attr( $block_btn_target ); ?>"><?php echo esc_html( $block_btn_title ); ?></a>
                                <?php 
                                    }
                                } 
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
            } 
        } ?>
    </div>
</div>
