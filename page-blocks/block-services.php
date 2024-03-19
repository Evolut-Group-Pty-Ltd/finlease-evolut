<?php
/**
 * Layout for Services block.
 * 
 * @package Finlease
 */
$fl_services = isset( $block['fl_services'] ) && ! empty( $block['fl_services'] ) ? $block['fl_services'] : false;
$section_title_services = isset( $block['section_title_services'] ) && ! empty( $block['section_title_services'] ) ? $block['section_title_services'] : false;
$services_bg = isset( $block['services_bg'] ) && ! empty( $block['services_bg'] ) ? $block['services_bg'] : false;
?>
<?php if ( $fl_services ) { ?>
<div class="service-icon-block <?php echo esc_attr( ( $services_bg ) ? $services_bg : '' ); ?>">
    <div class="container">
    <?php if ( $section_title_services ) { ?>
        <div class="title-block">
            <h2><?php echo esc_html( $section_title_services ); ?></h2>
        </div>
    <?php } ?>
        <div class="row">
            <?php 
            foreach( $fl_services as $fl_service ) {
                $services_title = isset( $fl_service['services_title'] ) && ! empty( $fl_service['services_title'] ) ? $fl_service['services_title'] : false;
                $services_icon = isset( $fl_service['services_icon'] ) && ! empty( $fl_service['services_icon'] ) ? $fl_service['services_icon'] : false;
            ?>
                <div class="col-lg-3 col-md-6">
                    <div class="service__wrapper">
                        <?php 
                        if ( $services_icon ) { 
                            $icon_alt  = isset( $services_icon['alt'] ) && ! empty( $services_icon['alt'] ) ? $services_icon['alt'] : false;
                            $icon_url  = isset( $services_icon['url'] ) && ! empty( $services_icon['url'] ) ? $services_icon['url'] : false;
                        ?>
                            <div class="service__icon">
                                <img class="svg" src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( $icon_alt ); ?>">
                            </div>
                        <?php } ?>

                        <?php if ( $services_title ) { ?>
                            <div class="service__info">
                            <p><?php echo esc_html( $services_title ); ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>