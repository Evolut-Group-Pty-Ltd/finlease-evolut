<?php
/**
 * Layout for Inner Menu block.
 * 
 * @package Finlease
 */
$inner_menu   = isset( $block['fl_inner_menu'] ) && ! empty( $block['fl_inner_menu'] ) ? $block['fl_inner_menu'] : false;
?>

<?php if ( $inner_menu ) { ?>
<div class="innerpagemenu">
    <div class="container">
        <div class="nav">
            <ul class="owl-carousel owl-theme sliding-menu">
            <?php foreach( $inner_menu as $menu_list ) {
                ?>
                <li class="nav-item"><a href="<?php echo esc_url( get_permalink( $menu_list->ID ) ); ?>"><?php echo esc_html( $menu_list->post_title ); ?></a></li>
                <?php
            } ?>
            </ul>
        </div>

        <!-- <div class="nav-arrows">
            <button id="Prev" class="btn prev"></button>
            <button id="Next" class="btn next"></button>
        </div> -->
    </div>
</div>
<?php } ?>
