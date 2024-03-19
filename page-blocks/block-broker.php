<?php
/**
 * Layout for Broker block.
 * 
 * @package Finlease
 */
$broker_section_title = isset( $block['broker_section_title'] ) && ! empty( $block['broker_section_title'] ) ? $block['broker_section_title'] : false;
$broker_section_desc  = isset( $block['broker_section_description'] ) && ! empty( $block['broker_section_description'] ) ? $block['broker_section_description'] : false;
$num_broker           = isset( $block['number_of_brokers'] ) && ! empty( $block['number_of_brokers'] ) ? absint( $block['number_of_brokers'] ) : 3;
$specialised_brokers = isset( $block['specialised_brokers'] ) && ! empty( $block['specialised_brokers'] ) ? $block['specialised_brokers'] : false;


?>
<div class="service-touch-experts">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="expert__left">
                    <?php if ( $broker_section_title ) { ?>
                            <h3><?php echo esc_html( $broker_section_title ); ?></h3>
                    <?php } ?>

                    <?php if ( $broker_section_desc ) {
                        echo wp_kses_post( $broker_section_desc );
                    } ?>
                    
                    
	                <div id="location-select" class="form-group">   
		                <?php
		                        $parent_locations = get_terms( array(
		                            'taxonomy'   => 'fl_broker_location',
		                            'parent'     => 0
		                         ) );
		                ?>
	                        <select class="form-control" id="fl-broker-location">
	                            <option value="">Select location</option>
	                            <?php foreach ( $parent_locations as $parent_loc ) { 
	                                    $locations = get_terms( array( 
	                                        'taxonomy'   => 'fl_broker_location',
	                                        'hide_empty' => false,
	                                        'parent'     => $parent_loc->term_id
	                                    ) );
	                                ?>
	                                <optgroup label="<?php echo esc_attr( $parent_loc->name ); ?>">
	                                    <?php
	                                    if ( !empty( $locations ) ) {
	                                        foreach ( $locations as $location ) {
	                                            ?>
	                                        <option value="<?php echo $location->slug; ?>"><?php echo esc_attr( $location->name ); ?></option>
	                                    <?php
	                                        }
	                                    }
	                                    ?>
	                                </optgroup>
	                            <?php } ?>
	                        </select>								
	                    <input type="hidden" id="broker-num" name="broker-num" value="<?php echo $num_broker; ?>">
	                </div>  
	                
	               	<?php if( $specialised_brokers == "technology" || $specialised_brokers == "aircraft" || $specialised_brokers == "crane") { ?>
	               		<div id="specialised-location" class="form-group">
							<select class="form-control" id="new-form">
								<option value=""></option>
								<option value="nsw">NSW</option>
								<option value="qld">QLD</option>
								<option value="vic">VIC</option>
								<option value="wa">WA</option>
								<option value="sa">SA</option> 
								<option value="nt">NT</option>
								<option value="tas">TAS</option>
								<option value="act">ACT</option>
							</select>	
	               		</div>									
					<?php } else { ?>
		
					<?php } ?> 	                
	                
	                
	                               
                </div>
            </div>    
            
			
				<?php
				if( $specialised_brokers == "technology" || $specialised_brokers == "aircraft" || $specialised_brokers == "crane") {
		        	$args = array(
		                    'post_type'      => 'fl_broker',
		                    'post_status'    => 'publish',
		                    'posts_per_page' => -1,	
		                    'meta_key'		=> 'specialise',
							'meta_value'	=> $specialised_brokers,
							'orderby' => 'menu_order title',
							'order'   => 'ASC'
		            );	
				} else if( $specialised_brokers == "uncategorised") {
				
		            $args = array(
		                    'post_type'      => 'fl_broker',
		                    'post_status'    => 'publish',
		                    'posts_per_page' => -1,
		                    'meta_key'		=> 'specialise',
							'meta_value'	=> $specialised_brokers,
							'orderby' => 'menu_order title',
							'order'   => 'ASC'
					);
				
				} else {
				/* } else if( get_sub_field('specialised_brokers') == "uncategorised") {
				
		            $args = array(
		                    'post_type'      => 'fl_broker',
		                    'post_status'    => 'publish',
		                    'orderby'        => 'rand',
		                    'posts_per_page' => $num_broker					         
					);
				
				} else { */
		            $args = array(
		                    'post_type'      => 'fl_broker',
		                    'post_status'    => 'publish',
		                    'orderby'        => 'rand',
		                    'posts_per_page' => $num_broker					         
					);	
				}
           
                                
                $broker_query = new WP_Query( $args );                
                if ( $broker_query->have_posts() ) : ?>
                    <div class="col-lg-8 offset-lg-1">
                        <div class="expert__wrapper owl-carousel owl-theme" id="broker-ajax">
                            <?php 
                            while( $broker_query->have_posts() ) : $broker_query->the_post(); 
                                $designation = get_field( 'broker_designation', get_the_ID() );
                                $email       = get_field( 'broker_email_address', get_the_ID() );
                                $contact_num = get_field( 'broker_contact_number', get_the_ID() );
                                $social_media = get_field( 'broker_social_media_link', get_the_ID() );
                                
                                // NEW ACF FIELD

								$sl = get_field( 'specialise_location', get_the_ID() );
                            
                                
                                // $linkedin    = get_field( 'broker_linkedin', get_the_ID() );

                                $broker_designation = isset( $designation ) && ! empty( $designation ) ? $designation : false;
                                $broker_email       = isset( $email ) && ! empty( $email ) ? $email : false;
                                $broker_contact_num = isset( $contact_num ) && ! empty( $contact_num ) ?  $contact_num : false;
                                // $broker_linkedin   = isset( $linkedin ) && ! empty( $linkedin ) ? $linkedin : false;
                                $social_medias = isset( $social_media ) && ! empty( $social_media ) ? $social_media : false;
                                $specialloc = isset( $sl ) && ! empty( $sl ) ? $sl : false;


                            ?>
                                <div class="item <?php echo $specialloc; ?>">
                                    <div class="expert__team__block">
                                        <?php if ( has_post_thumbnail() ) { ?>
                                            <div class="expert__fig__bolck">
                                                <?php the_post_thumbnail( 'finlease-broker-slider' ); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="expert__caption">
                                            <h4 class="name"><?php the_title(); ?></h4>
                                            <?php if ( $broker_designation ) { ?>
                                                    <h5 class="destination">
                                                        <?php echo esc_html( $broker_designation ); ?>
                                                    </h5>
                                            <?php } ?>

                                            <div class="expert-contacts">
                                                <ul>
                                                    <?php if ( $broker_email ) { ?>
                                                            <li>
                                                                <a href="mailto:<?php echo $broker_email; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-envelop.svg"></a>
                                                            </li>
                                                    <?php } ?>

                                                    <?php if ( $broker_contact_num ) { 
                                                            $ph_number = preg_replace("/[^0-9]/", "", $broker_contact_num);
                                                        ?>
                                                            <li>
                                                                <a href="tel:<?php echo $ph_number; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-telephone.svg"></a>
                                                            </li>
                                                    <?php } ?>

                                                    <?php if ( $social_medias ) {
                                                        foreach ( $social_medias as $social_media ) { 
                                                            $url = isset( $social_media['broker_sm_url'] ) && ! empty( $social_media['broker_sm_url'] ) ? $social_media['broker_sm_url'] : false;
                                                            $target = isset( $social_media['borker_sm_target'] ) && ! empty( $social_media['borker_sm_target'] ) ? $social_media['borker_sm_target'] : false;
                                                            $name = isset( $social_media['broker_sm_name'] ) && ! empty( $social_media['broker_sm_name'] ) ? $social_media['broker_sm_name'] : false;
                                                        ?>
                                                            <li>
                                                            <a href="<?php echo $url; ?>" target="<?php echo ( $target ) ? '_blank' : '_self'; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-<?php echo $name; ?>.svg" class="img-fluid"> </a>
                                                            </li>
                                                    <?php } 
                                                    } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div id='loader' style='display: none;'>
                            <div class="loading"></div>
                        </div>
                    </div>
            <?php
            else : 
                echo esc_html__( 'No Brokers Found', 'finlease' );
            endif;
            ?>
        </div>
    </div>
</div>