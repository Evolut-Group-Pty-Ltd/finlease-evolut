<?php
/**
 * Layout for Banner block.
 * 
 * @package Finlease
 */
$banner_image       = isset( $block['banner_image'] ) && ! empty( $block['banner_image'] ) ? $block['banner_image'] : false;
$banner_title       = isset( $block['banner_title'] ) && ! empty( $block['banner_title'] ) ? $block['banner_title'] : false;
$banner_description = isset( $block['banner_description'] ) && ! empty( $block['banner_description'] ) ? $block['banner_description'] : false;
$banner_show_menu   = isset( $block['banner_show_menu'] ) && ! empty( $block['banner_show_menu'] ) ? $block['banner_show_menu'] : false;
$banner_buttons      = isset( $block['banner_button'] ) && ! empty( $block['banner_button'] ) ? $block['banner_button'] : false;
?>

<div class="banner">
    <?php if ( !empty( $banner_image['url'] ) ) { ?>
        <img src="<?php echo esc_url( $banner_image['url'] ); ?>" alt="<?php echo esc_attr( $banner_image['alt'] ); ?>">
    <?php } ?>
    <div class="container">
        <div class="banner-caption">
            <?php if ( $banner_title ) { ?>
                <h1><?php echo esc_html( $banner_title ); ?></h1>
            <?php } ?>

            <?php if ( $banner_description ) {
                echo wp_kses_post( $banner_description );
            }
            ?>

            <div class="banner-dropdown">
                <div class="dropdown">
                    <?php
                    $locations = get_nav_menu_locations();
                    $menu = wp_get_nav_menu_object( $locations[ 'menu-banner' ] );
                    $menu_items = wp_get_nav_menu_items($menu->term_id);
                    if ( !empty( $menu_items[0] ) ) {
                        ?>
                        <button class="btn btn-secondary main-toggler"><?php echo $menu_items[0]->title; ?></button>
                        <?php
                    }
                    wp_nav_menu( array(
                        'theme_location' => 'menu-banner',
                        'depth' => 0,
                        'menu_class'  => 'main-dropdown',
                        'walker'  => new WP_Bootstrap_Navwalker()
                        ) );
                    ?>
                </div>
            </div>
            
            <?php 
            if ( $banner_buttons ) { 
                $banner_btn_title  = isset( $banner_buttons['title'] ) && ! empty( $banner_buttons['title'] ) ? $banner_buttons['title'] : false;
                $banner_btn_url    = isset( $banner_buttons['url'] ) && ! empty( $banner_buttons['url'] ) ? $banner_buttons['url'] : false;
                $banner_btn_target = isset( $banner_buttons['target'] ) && ! empty( $banner_buttons['target'] ) ? $banner_buttons['target'] : '_self';
                if( $banner_btn_title ) {
            ?>
                    <div class="get-started">
                        <a href="<?php echo esc_url( $banner_btn_url ); ?>" class="btn btn--red--dust btn--big" target="<?php echo esc_attr( $banner_btn_target ); ?>"><?php echo esc_html( $banner_btn_title ); ?></a>
                    </div>
            <?php
                } 
            } ?>
        </div>
    </div>
</div>