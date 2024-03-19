<?php
/**
 * Layout for Pages block.
 * 
 * @package Finlease
 */
$section_pages_title  = isset( $block['section_pages_title'] ) && ! empty( $block['section_pages_title'] ) ? $block['section_pages_title'] : false;
$fl_pages             = isset( $block['fl_pages'] ) && ! empty( $block['fl_pages'] ) ? $block['fl_pages'] : false;
?>
<div class="commercialequipment">
    <div class="container">
        <?php if ( $section_pages_title ) { ?>
                <div class="title-block">
                    <h2><?php echo esc_html( $section_pages_title ); ?></h2>
                </div>
        <?php } ?>
        <?php if ( $fl_pages ) { ?>
                <div class="row">
                    <?php 
                    foreach ( $fl_pages as $fl_page ) { 
                        $page_detail = isset( $fl_page['fl_page'] ) && ! empty( $fl_page['fl_page'] ) ? $fl_page['fl_page'] : false;
                        $fl_page_img = isset( $fl_page['fl_page_image'] ) && ! empty( $fl_page['fl_page_image'] ) ? $fl_page['fl_page_image'] : false;
                        ?>
                        <div class="col-lg-4 col-mf-6">
                            <div class="block__types">

                                <?php 
                                if( $fl_page_img ) {
                                    $page_img_alt  = isset( $fl_page_img['alt'] ) && ! empty( $fl_page_img['alt'] ) ? $fl_page_img['alt'] : false;
                                    $page_img_url  = isset( $fl_page_img['url'] ) && ! empty( $fl_page_img['url'] ) ? $fl_page_img['url'] : false; 
                                    if ( $page_img_url ) {
                                    ?>

                                    <div class="block__type__image">
                                        <a href="<?php echo esc_url( get_the_permalink( $page_detail->ID ) ); ?>"><img src="<?php echo esc_url( $fl_page_img['sizes']['finlease-pages-block'] ); ?>" alt="<?php echo esc_attr( $page_img_alt ); ?>"></a>
                                    </div>

                                <?php 
                                    }
                                } ?>

                                <?php if( $page_detail->post_title ) { ?>
                                    <div class="block__type__caption">
                                        <h4>
                                            <a href="<?php echo esc_url( get_the_permalink( $page_detail->ID ) ); ?>" class="remove-finance"><?php echo esc_html( $page_detail->post_title ); ?></a>
                                        </h4>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        <?php } ?>
    </div>
</div>