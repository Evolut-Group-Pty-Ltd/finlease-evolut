<?php    
    $type_name = isset( $type['cal_type_name'] ) && ! empty( $type['cal_type_name'] ) ? $type['cal_type_name'] : false;
    $type_title = isset( $type['cal_type_title'] ) && ! empty( $type['cal_type_title'] ) ? $type['cal_type_title'] : false;
    $type_desc = isset( $type['cal_type_desc'] ) && ! empty( $type['cal_type_desc'] ) ? $type['cal_type_desc'] : false;
    $type_form_title = isset( $type['cal_form_title'] ) && ! empty( $type['cal_form_title'] ) ? $type['cal_form_title'] : false;
    $type_form = isset( $type['cal_form_shortcode'] ) && ! empty( $type['cal_form_shortcode'] ) ? $type['cal_form_shortcode'] : false;
    $type_quote = isset( $type['cal_quote_url'] ) && ! empty( $type['cal_quote_url'] ) ? $type['cal_quote_url'] : false;
    if ( $type_quote ) {
        $title = isset( $type_quote['title'] ) && ! empty( $type_quote['title'] ) ? $type_quote['title'] : false;
        $url = isset( $type_quote['url'] ) && ! empty( $type_quote['url'] ) ? $type_quote['url'] : false;
        $target = isset( $type_quote['target'] ) && ! empty( $type_quote['target'] ) ? $type_quote['target'] : '_self';
    }
    if ( $type_name == "Boat" ) {
        // $amount = '$100,000';
        $payment = "checked";
    }
    elseif( $type_name == "Equipment" ) {
        // $amount = '$50,000';
        $payment = "";
    }
?>
            
<div class="tab-pane fade" id="<?php echo esc_attr( $type_name ); ?>" role="tabpanel" aria-labelledby="<?php echo str_replace(" ", "-", esc_attr( $type_name )); ?>-tab">
    <!-- <div class="tab-pane fade <?php echo ( $type_count == 1 ) ? 'show active' : ''; ?>" id="<?php echo esc_attr( $type_name ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $type_name ); ?>-tab"> -->
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="calculator-values">
                    <div class="calculation-info">
                        <?php if ( $type_title ) { ?>
                            <h3><?php echo esc_html( $type_title ); ?></h3>
                        <?php } ?>
                        
                        <?php if ( $type_desc ) {
                            echo $type_desc;
                        } ?>
                    </div>
                    <div class="range-output">
                        <div class="term__loans">
                            <div class="form-group">
                                <label for="loan-term">Loan term (months)</label>
                                <select name="loan-term" id="loan-term-<?php echo esc_attr( $type_name ); ?>" class="form-control">
                                    <option>12</option>
                                    <option>24</option>
                                    <option>36</option>
                                    <option>48</option>
                                    <?php if ( $type_name == "Mortgage" ) { ?>
                                        <option>60</option>
                                        <option selected>360</option>
                                    <?php }else {?>
                                    <option selected>60</option>
                                    
                                    <?php } ?>
                                    
                                </select>
                                <div id="slider-loan-<?php echo esc_attr( $type_name ); ?>"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Interest Rate -->
                    <div class="range-output">
                        <div class="term__loans">
                            <div class="form-group">
                                <label for="interest-rate">Interest rate (%)</label>
                                <select name="interest-rate" id="interest-<?php echo esc_attr( $type_name ); ?>" class="form-control">
                                    <?php
                                    for ( $i=3; $i<=22.5; $i+=0.25 ) {
                                        if ( $type_name == "Boat" ) {
                                            if ($i==9 ) $select = "selected";
                                            else $select = "";
                                        }
                                        elseif ( $type_name == "Equipment" ) {
                                            if ($i==7 ) $select = "selected";
                                            else $select = "";
                                        }
                                        elseif ( $type_name == "Car" ) {
                                            if ($i==7 ) $select = "selected";
                                            else $select = "";
                                        }  
                                        elseif ( $type_name == "Truck" ) {
                                            if ($i==7 ) $select = "selected";
                                            else $select = "";
                                        }   
                                        elseif ( $type_name == "Mortgage" ) {
                                            if ($i==4.5 ) $select = "selected";
                                            else $select = "";
                                        } 
                                        elseif ( $type_name == "Chattel-Mortgage" ) {
                                            if ($i==7 ) $select = "selected";
                                            else $select = "";
                                        }                                                       
                                        echo "<option ".$select.">".$i ."</option>";
                                    }?>
                                </select>
                                <div id="slider-interest-<?php echo esc_attr( $type_name ); ?>"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Amount Financed -->
                    <div class="range-output">
                        <div class="term__loans">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label for="amount">Amount financed ($)</label>
                                    </div>
                                    <div class="col-lg-4">
                                    <input type="text" id="amount-<?php echo esc_attr( $type_name ); ?>" class="form-control" data-index=0 value="$50,000">
                                    </div>
                                </div>

                                
                                <div id="slider-<?php echo esc_attr( $type_name ); ?>"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Residual / balloon (%) for Amount Financed -->
                    <div class="range-output">
                        <div class="term__loans">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label for="residual">Residual / balloon (%) for Amount Financed</label>
                                    </div>
                                    <div class="col-lg-4">
                                    <input type="number" min="1" max="100" id="residual-<?php echo esc_attr( $type_name ); ?>" class="form-control" data-index="0" value="20">
                                    </div>
                                </div>

                                
                                <div id="slider-residual-<?php echo esc_attr( $type_name ); ?>"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkbox -->
                    <div class="range-output">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="payment-<?php echo esc_attr( $type_name ); ?>" <?php echo $payment;?>>
                                <label class="custom-control-label" for="payment-<?php echo esc_attr( $type_name ); ?>">Check this box to show payments monthly in arrears</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 col-md-6">
                <div class="calculator__output">
                    <?php if( $type_form_title ) { ?>
                        <h3><?php echo esc_html( $type_form_title ); ?></h3>
                    <?php } ?>
                    <?php if ( $type_form ) {
                            echo do_shortcode( $type_form );
                    } ?>
                    <a class="wpcf7-form-control wpcf7-submit btn btn--red--dust btn--big" id="quote-<?php echo esc_attr( $type_name ); ?>" href="<?php echo esc_url($url); ?>">Get refined quote</a>
                </div>
            </div>
        </div>
    </div>