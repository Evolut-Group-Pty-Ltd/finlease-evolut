<?php
/**
 * Layout for Application Form block.
 * 
 * @package Finlease
 */
$fl_form = isset( $block['fl_form'] ) && ! empty( $block['fl_form'] ) ? $block['fl_form'] : false;
// echo '<pre>';
//     print_r($fl_form);
// echo '</pre>';
if ( $fl_form ) {
    ?>
    <div class="row">
    <?php
    $count_form = 1;
    foreach ( $fl_form as $form ) {
        
        $form_title = isset( $form['form_title'] ) && ! empty( $form['form_title'] ) ? $form['form_title'] : false;
        $form_button = isset( $form['form_button'] ) && ! empty( $form['form_button'] ) ? $form['form_button'] : false;
    ?>
   
        <div class="col-lg-6" <?php echo $count_form;?>>
            <div class="form__block">

                <?php if ( $form_title ) { ?>
                        <h3><?php echo esc_html( $form_title ); ?></h3>
                <?php } ?>
                
                <?php 
                foreach( $form_button as $button ) { 
                    $btn_type = isset( $button['form_btn_type'] ) && ! empty( $button['form_btn_type'] ) ? $button['form_btn_type'] : false;
                    if ( $btn_type == 'file' && ( isset( $button['form_type_file'] ) ) ) {
                        $link   = isset( $button['form_type_file']['url'] ) && ! empty( $button['form_type_file']['url'] ) ? $button['form_type_file']['url'] : false;
                        $target = '_blank';
                        $label  = isset( $button['form_btn_label'] ) && ! empty( $button['form_btn_label'] ) ? $button['form_btn_label'] : false;
                    }
                    elseif ( $btn_type == 'link' && ( isset( $button['form_btn_link'] ) ) ) {
                        $link   = isset( $button['form_btn_link']['url'] ) && ! empty( $button['form_btn_link']['url'] ) ? $button['form_btn_link']['url'] : false;
                        $target = isset( $button['form_btn_link']['target'] ) && ! empty( $button['form_btn_link']['target'] ) ? $button['form_btn_link']['target'] : '_self';
                        $label  = isset( $button['form_btn_link']['title'] ) && ! empty( $button['form_btn_link']['title'] ) ? $button['form_btn_link']['title'] : false;
                    }
                    ?>
                    <div class="btn__block">
                        <a class="btn btn--big btn--gray--outline" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html( $label ); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    
    <?php
        if ( $count_form %2 == 0 && $count_form < count($fl_form) ) {
            ?>
            </div>
            <div class="row">
            <?php
        }
        $count_form++;
    }
    
    ?>
    </div>
    <?php
}
?>
