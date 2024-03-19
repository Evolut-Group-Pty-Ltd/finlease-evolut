<?php
/**
 * Layout for Calculator block.
 * 
 * @package Finlease
 */
$cal_types = isset( $block['cal_types'] ) && ! empty( $block['cal_types'] ) ? $block['cal_types'] : false;

if ( $cal_types ) {
?>
    <div class="finlease-tab finlease--calculator--tab">
        <div class="tabwrapper">
            <div class="container">
					<ul class="nav nav-tabs owl-carousel owl-theme tabwrapper-carousel" id="myTab" role="tablist">

                        <?php if ( is_page( 'boat-loan-repayment-calculator' )) { ?>   
                            <?php /*<li class="nav-item" 1=""><a class="nav-link active" id="Boat-tab" href="<?php echo esc_url( home_url() ); ?>/boat-loan-repayment-calculator/">Boat</a></li>*/ ?>
                            <li class="nav-item" 2=""><a class="nav-link " id="Equipment-tab" href="<?php echo esc_url( home_url() ); ?>/equipment-finance-calculator/">Equipment</a></li>
                            <li class="nav-item" 3=""><a class="nav-link " id="Car-tab" href="<?php echo esc_url( home_url() ); ?>/car-loan-repayment-calculator/">Car</a></li>
                            <li class="nav-item" 4=""><a class="nav-link " id="Truck-tab" href="<?php echo esc_url( home_url() ); ?>/truck-finance-calculator/">Truck</a></li>
                            <li class="nav-item" 5=""><a class="nav-link " id="Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/mortgage-repayment-calculator/">Mortgage</a></li>                            
							<li class="nav-item" 6=""><a class="nav-link " id="Chattel-Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/chattel-mortgage-calculator/">Chattel Mortgage</a></li>
                        <?php } elseif ( is_page( 'equipment-finance-calculator' )) { ?>  
                            <?php /*<li class="nav-item" 1=""><a class="nav-link " id="Boat-tab" href="<?php echo esc_url( home_url() ); ?>/boat-loan-repayment-calculator/">Boat</a></li>*/ ?>
                            <li class="nav-item" 2=""><a class="nav-link active" id="Equipment-tab" href="<?php echo esc_url( home_url() ); ?>/equipment-finance-calculator/">Equipment</a></li>
                            <li class="nav-item" 3=""><a class="nav-link " id="Car-tab" href="<?php echo esc_url( home_url() ); ?>/car-loan-repayment-calculator/">Car</a></li>
                            <li class="nav-item" 4=""><a class="nav-link " id="Truck-tab" href="<?php echo esc_url( home_url() ); ?>/truck-finance-calculator/">Truck</a></li>
                            <li class="nav-item" 5=""><a class="nav-link " id="Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/mortgage-repayment-calculator/">Mortgage</a></li>                            
							<li class="nav-item" 6=""><a class="nav-link " id="Chattel-Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/chattel-mortgage-calculator/">Chattel Mortgage</a></li>
                        <?php } elseif ( is_page( 'car-loan-repayment-calculator' )) { ?>
                            <?php /*<li class="nav-item" 1=""><a class="nav-link " id="Boat-tab" href="<?php echo esc_url( home_url() ); ?>/boat-loan-repayment-calculator/">Boat</a></li>*/ ?>
                            <li class="nav-item" 2=""><a class="nav-link " id="Equipment-tab" href="<?php echo esc_url( home_url() ); ?>/equipment-finance-calculator/">Equipment</a></li>
                            <li class="nav-item" 3=""><a class="nav-link active" id="Car-tab" href="<?php echo esc_url( home_url() ); ?>/car-loan-repayment-calculator/">Car</a></li>
                            <li class="nav-item" 4=""><a class="nav-link " id="Truck-tab" href="<?php echo esc_url( home_url() ); ?>/truck-finance-calculator/">Truck</a></li>
                            <li class="nav-item" 5=""><a class="nav-link " id="Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/mortgage-repayment-calculator/">Mortgage</a></li>                            
							<li class="nav-item" 6=""><a class="nav-link " id="Chattel-Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/chattel-mortgage-calculator/">Chattel Mortgage</a></li>
                        <?php } elseif ( is_page( 'mortgage-repayment-calculator' )) { ?>
                            <?php /*<li class="nav-item" 1=""><a class="nav-link " id="Boat-tab" href="<?php echo esc_url( home_url() ); ?>/boat-loan-repayment-calculator/">Boat</a></li>*/ ?>
                            <li class="nav-item" 2=""><a class="nav-link " id="Equipment-tab" href="<?php echo esc_url( home_url() ); ?>/equipment-finance-calculator/">Equipment</a></li>
                            <li class="nav-item" 3=""><a class="nav-link " id="Car-tab" href="<?php echo esc_url( home_url() ); ?>/car-loan-repayment-calculator/">Car</a></li>
                            <li class="nav-item" 4=""><a class="nav-link " id="Truck-tab" href="<?php echo esc_url( home_url() ); ?>/truck-finance-calculator/">Truck</a></li>
                            <li class="nav-item" 5=""><a class="nav-link active" id="Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/mortgage-repayment-calculator/">Mortgage</a></li>
							<li class="nav-item" 6=""><a class="nav-link " id="Chattel-Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/chattel-mortgage-calculator/">Chattel Mortgage</a></li>
                        <?php } elseif ( is_page( 'truck-finance-calculator' )) { ?>
                            <?php /*<li class="nav-item" 1=""><a class="nav-link " id="Boat-tab" href="<?php echo esc_url( home_url() ); ?>/boat-loan-repayment-calculator/">Boat</a></li>*/ ?>
                            <li class="nav-item" 2=""><a class="nav-link " id="Equipment-tab" href="<?php echo esc_url( home_url() ); ?>/equipment-finance-calculator/">Equipment</a></li>
                            <li class="nav-item" 3=""><a class="nav-link " id="Car-tab" href="<?php echo esc_url( home_url() ); ?>/car-loan-repayment-calculator/">Car</a></li>
                            <li class="nav-item" 4=""><a class="nav-link active" id="Truck-tab" href="<?php echo esc_url( home_url() ); ?>/truck-finance-calculator/">Truck</a></li>
                            <li class="nav-item" 5=""><a class="nav-link " id="Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/mortgage-repayment-calculator/">Mortgage</a></li>                           
							<li class="nav-item" 6=""><a class="nav-link " id="Chattel-Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/chattel-mortgage-calculator/">Chattel Mortgage</a></li>
						<?php } elseif ( is_page( 'chattel-mortgage-calculator' )) { ?>
                            <?php /*<li class="nav-item" 1=""><a class="nav-link " id="Boat-tab" href="<?php echo esc_url( home_url() ); ?>/boat-loan-repayment-calculator/">Boat</a></li>*/ ?>
                            <li class="nav-item" 2=""><a class="nav-link " id="Equipment-tab" href="<?php echo esc_url( home_url() ); ?>/equipment-finance-calculator/">Equipment</a></li>
                            <li class="nav-item" 3=""><a class="nav-link " id="Car-tab" href="<?php echo esc_url( home_url() ); ?>/car-loan-repayment-calculator/">Car</a></li>
                            <li class="nav-item" 4=""><a class="nav-link " id="Truck-tab" href="<?php echo esc_url( home_url() ); ?>/truck-finance-calculator/">Truck</a></li>
                            <li class="nav-item" 5=""><a class="nav-link" id="Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/mortgage-repayment-calculator/">Mortgage</a></li>
							<li class="nav-item" 6=""><a class="nav-link active" id="Chattel-Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/chattel-mortgage-calculator/">Chattel Mortgage</a></li>
                        <?php } else { ?>
                            <?php /*<li class="nav-item" 1=""><a class="nav-link active" id="Boat-tab" href="<?php echo esc_url( home_url() ); ?>/boat-loan-repayment-calculator/">Boat</a></li>*/ ?>
                            <li class="nav-item" 2=""><a class="nav-link " id="Equipment-tab" href="<?php echo esc_url( home_url() ); ?>/equipment-finance-calculator/">Equipment</a></li>
                            <li class="nav-item" 3=""><a class="nav-link " id="Car-tab" href="<?php echo esc_url( home_url() ); ?>/car-loan-repayment-calculator/">Car</a></li>
                            <li class="nav-item" 4=""><a class="nav-link " id="Truck-tab" href="<?php echo esc_url( home_url() ); ?>/truck-finance-calculator/">Truck</a></li>
                            <li class="nav-item" 5=""><a class="nav-link " id="Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/mortgage-repayment-calculator/">Mortgage</a></li>                        
							<li class="nav-item" 6=""><a class="nav-link " id="Chattel-Mortgage-tab" href="<?php echo esc_url( home_url() ); ?>/chattel-mortgage-calculator/">Chattel Mortgage</a></li>
                        <?php } ?>
					</ul>
					
                
                <!-- <ul class="nav nav-tabs owl-carousel owl-theme tabwrapper-carousel" id="myTab" role="tablist">
                    <?php
                    $count_type = 0;
                    foreach ( $cal_types as $cal_type ) {
                        $count_type++;
                        $cal_type_name = isset( $cal_type['cal_type_name'] ) && ! empty( $cal_type['cal_type_name'] ) ? $cal_type['cal_type_name'] : false;
                    ?>
                        <li class="nav-item" <?php echo $count_type;?>>
                            <a class="nav-link <?php echo ( $count_type == 1 ) ? 'active' : ''; ?>" id="<?php echo esc_attr( $cal_type_name ); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr( $cal_type_name ); ?>" role="tab"
                                    aria-controls="<?php echo esc_attr( $cal_type_name ); ?>" aria-selected="true"><?php echo esc_html( $cal_type_name ); ?></a>
                        </li>
                    <?php 
                    } 
                    
                    ?>
                </ul> -->
            </div>
        </div>
        <div class="finlease__tab__wrapper">
            <div class="container">
                <div class="tab-content" id="myTabContent">
                    <?php
                        $type_count = 0;

                        foreach ( $cal_types as $type ) {
                            $type_count++;
                            include(get_template_directory() . '/template-parts/calculator-pane.php');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php 
} 
?>
