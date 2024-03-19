<?php
$cal_types = isset( $block['cal_types'] ) && ! empty( $block['cal_types'] ) ? $block['cal_types'] : false;

if ( $cal_types ) {
?>
    <div class="finlease-tab finlease--calculator--tab">
        <div class="tabwrapper">
            <div class="container">
                <ul class="nav nav-tabs owl-carousel owl-theme tabwrapper-carousel" id="myTab" role="tablist">

                    <?php                                                    
                        foreach ( $cal_types as $cal_type ) {
                            $count_type++;
                            $cal_type_name = isset( $cal_type['cal_type_name'] ) && ! empty( $cal_type['cal_type_name'] ) ? $cal_type['cal_type_name'] : false;
                            $active = ($count_type == 1) ? 'active' : '';
                        ?>

                            <li class="nav-item" <?php echo "$count_type='' " ?>>
                                <a class="nav-link <?php echo $active ?>" id="<?php echo $cal_type_name ?>-tab" href="#" data-tab="<?php echo $cal_type_name ?>">
                                    <?php echo $cal_type_name ?>
                                </a>
                            </li>

                        <?php 
                        }                    
                    ?>

                </ul>
            </div>
        </div>
        <div class="finlease__tab__wrapper">
            <div class="container">
                <div class="tab-content" id="myTabContent">
                    <?php
                        $type_count = 0;

                        foreach ( $cal_types as $type ) {
                            $type_count++;
                            include(get_template_directory() . '/template-parts/calculator-pane-landing-broker.php');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php 
} 
?>
