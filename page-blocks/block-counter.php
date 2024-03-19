<?php
/**
 * Layout for Counter block.
 * 
 * @package Finlease
 */
$fl_counter = isset( $block['fl_counter'] ) && ! empty( $block['fl_counter'] ) ? $block['fl_counter'] : array();
if ( !empty( $fl_counter ) ) {
    ?>
        <div class="numerical-section">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ( $fl_counter as $counter ) {
                        $counter_title    = isset( $counter['fl_counter_title'] ) && ! empty( $counter['fl_counter_title'] ) ? $counter['fl_counter_title'] : false;
                        $counter_num      = isset( $counter['fl_counter_number'] ) && ! empty( $counter['fl_counter_number'] ) ? $counter['fl_counter_number'] : false;
                        $counter_currency = isset( $counter['fl_counter_currency'] ) && ! empty( $counter['fl_counter_currency'] ) ? $counter['fl_counter_currency'] : false;
                        $counter_unit     = isset( $counter['fl_counter_unit'] ) && ! empty( $counter['fl_counter_unit'] ) ? $counter['fl_counter_unit'] : false;
                        ?>
                            <div class="col-lg-3 col-sm-6">
                                <div class="numerial-wrapper">
                                    <div class="numerical-container">
                                        <div class="number-value">
                                            <?php if ( $counter_currency ) { ?>
                                                <span><?php echo esc_html( $counter_currency ); ?></span>
                                            <?php } ?>

                                            <?php if ( $counter_num ) { ?>
                                                <div class="value" data-value="<?php echo esc_attr( $counter_num ); ?>"><?php echo esc_html( $counter_num ); ?></div>
                                            <?php } ?>

                                            <?php if ( $counter_unit ) { ?>
                                                <span><?php echo esc_html( $counter_unit ); ?></span>
                                            <?php } ?>
                                        </div>
                                        <?php if ( $counter_title ) { ?>
                                            <div class="numerical-content"><?php echo esc_html( $counter_title ); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
}
?>
