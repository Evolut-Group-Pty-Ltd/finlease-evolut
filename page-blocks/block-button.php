<?php
/**
 * Layout for Button block.
 * 
 * @package Finlease
 */
$button_details = isset( $block['fl_buttons'] ) && ! empty( $block['fl_buttons'] ) ? $block['fl_buttons'] : false;
$button_type    = isset( $block['fl_button_type'] ) && ! empty( $block['fl_button_type'] ) ? $block['fl_button_type'] : false;
$button_color   = isset( $block['fl_button_color'] ) && ! empty( $block['fl_button_color'] ) ? $block['fl_button_color'] : false;
$button_bg      = isset( $block['fl_btn_bg_color'] ) && ! empty( $block['fl_btn_bg_color'] ) ? $block['fl_btn_bg_color'] : false;

if( $button_details ) {
    $button_title  = $button_details['title'];
    $button_link   =  $button_details['url'];
    $button_target = $button_details['target'] ? $button_details['target'] : '_self';
}
?>
<a href="<?php echo esc_url( $button_link ); ?>" class="btn <?php echo esc_attr( $button_type ); ?> <?php echo esc_attr( $button_color ); ?> <?php echo esc_attr( $button_bg ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>