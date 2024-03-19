<?php
/**
 * Layout for Offices block.
 * 
 * @package Finlease
 */
$offices = isset( $block['fl_office_states'] ) && ! empty( $block['fl_office_states'] ) ? $block['fl_office_states'] : false;
?>

<div class="finlease-tab">
    <div class="tabwrapper">
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php 
                    $count = 1;
                    foreach( $offices as $office ) {
                        $name = isset( $office->name ) && ! empty( $office->name ) ? $office->name : false;
                        $slug = isset( $office->slug ) && ! empty( $office->slug ) ? $office->slug : false;
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo esc_attr( ( $count == 1 ) ? 'active' : '' ); ?>" id="<?php echo esc_attr( $slug ); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr( $slug ); ?>" role="tab" aria-controls="<?php echo esc_attr( $slug ); ?>"
                                aria-selected="true"><?php echo esc_html( $name ); ?></a>
                        </li>
                        <?php
                        $count++;
                    } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="finlease__tab__wrapper">
        <div class="container">
            <div class="tab-content" id="myTabContent">
            <?php 
            $office_count = 1;
            foreach( $offices as $office_term ) { 
                $term_slug = isset( $office_term->slug ) && ! empty( $office_term->slug ) ? $office_term->slug : false;
                ?>
                <div class="tab-pane fade show <?php echo esc_attr( ( $office_count == 1 ) ? 'active' : '' ); ?>" id="<?php echo esc_attr( $term_slug ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $term_slug ); ?>-tab">
                    <div class="row">
                        <?php
                        $args = array(
                        'post_type' => 'fl_office',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'fl_office_state',
                            'field' => 'term_id',
                            'terms' => $office_term->term_id
                                )
                            )
                        );
                        $office_query = new WP_Query( $args );
                        if ( $office_query->have_posts() ) : 
                            while( $office_query->have_posts() ) : $office_query->the_post();
                            $count_map = 1;
                            $office_name            = get_field( 'office_name', get_the_ID() );
                            $office_contact_num     = get_field( 'office_contact_num', get_the_ID() );
                            $office_email_address   = get_field( 'office_email_address', get_the_ID() );
                            $office_location        = get_field( 'office_location', get_the_ID() );
                            $office_other_details   = get_field( 'office_other_details', get_the_ID() );
                            $office_map             = get_field( 'office_map', get_the_ID() );
                            $api_key                = get_field( 'fl_google_map_api_key', 'option' );
                            $latitude   = $office_map['lat'];
                            $longitude  = $office_map['lng'];
                            $address    = $office_map['address'];
                            $map_image  = 'https://maps.googleapis.com/maps/api/staticmap?center='.$latitude.','.$longitude.'&zoom=15&size=360x240&markers=icon:'.FL_TAU.'/images/map-marker.png|'.$latitude.','.$longitude.'&style=feature:poi|element:labels|visibility:off&style=saturation:-100&key='.$api_key;

                            $name        = isset( $office_name ) && ! empty( $office_name ) ? $office_name : false;
                            $contact_num = isset( $office_contact_num ) && ! empty( $office_contact_num ) ? $office_contact_num : false;
                            $email       = isset( $office_email_address ) && ! empty( $office_email_address ) ? $office_email_address : false;
                            $location    = isset( $office_location ) && ! empty( $office_location ) ? $office_location : false;
                            $others      = isset( $office_other_details ) && ! empty( $office_other_details ) ? $office_other_details : false;
                            ?>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="finlease__tab__items">
                                        <div class="finlease__tab__image">
                                            <img src="<?php echo $map_image; ?>" class="<?php echo $count_map; ?>">
                                        </div>
                                        <div class="finlease__tab__grid__info finlease--tab--icon">
                                            <?php if ( $name ) { ?>
                                                <h4><?php echo esc_html( $name ); ?></h4>
                                            <?php } ?>

                                            <?php 
                                            if ( $contact_num ) { 
                                                $ph_number = preg_replace("/[^0-9]/", "", $contact_num);
                                                ?>
                                                <p><a href="tel:<?php echo $ph_number; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-phone.svg"><?php echo $contact_num; ?></a></p>
                                            <?php } ?>

                                            <?php if ( $email ) { ?>
                                                <p><a href="mailto:<?php echo $email; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-message.svg"><?php echo $email; ?></a></p>
                                            <?php } ?>

                                            <?php if ( $location ) { ?>
                                                <p>
                                                    <img src="<?php echo FL_TAU; ?>/images/icon-location.svg">
                                                    <?php echo $location; ?>
                                                </p>
                                            <?php } ?>

                                            <?php if ( $others ) { 
                                                ?>
                                                <p><?php echo $others; ?></p>
                                                <?php
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php
                            endwhile;
                            $count_map ++;
                        else : 
                            echo esc_html__( 'No Offices Found', 'finlease' );
                        endif;
                        ?>
                    </div>
                </div>
                <?php
                $office_count++;
            }
            ?>
            </div>
        </div>
    </div>
</div>
