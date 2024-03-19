<?php
$location = ( isset( $_POST['location'] ) ) ? $_POST['location'] : '';
$broker_num = ( isset( $_POST['broker_num'] ) ) ? $_POST['broker_num'] : 3;
$args = array(
    'post_type'      => 'fl_broker',
    'post_status'    => 'publish',
    'orderby'        => 'rand',
    'posts_per_page' => $broker_num
);
if ( !empty( $location ) ) {
    $args['tax_query'][] = array(
        'taxonomy' => 'fl_broker_location',
        'field'    => 'slug',
        'terms'    => $location,
    );
}
$broker_query = new WP_Query( $args );
if ( $broker_query->have_posts() ) :
    while( $broker_query->have_posts() ) : $broker_query->the_post();
        $designation = get_field( 'broker_designation', get_the_ID() );
        $email       = get_field( 'broker_email_address', get_the_ID() );
        $contact_num = get_field( 'broker_contact_number', get_the_ID() );
        $social_media = get_field( 'broker_social_media_link', get_the_ID() );

        $broker_designation = isset( $designation ) && ! empty( $designation ) ? $designation : false;
        $broker_email       = isset( $email ) && ! empty( $email ) ? $email : false;
        $broker_contact_num = isset( $contact_num ) && ! empty( $contact_num ) ?  $contact_num : false;
        $social_medias = isset( $social_media ) && ! empty( $social_media ) ? $social_media : false;

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    ?>
    <div class="item">
        <div class="expert__team__block">
            <div class="expert__fig__bolck">
                <img src="<?php echo $image[0]; ?>" alt="<?php the_title();?>">
            </div>
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
    <?php 
    endwhile; 
    else :
        ?> 
        <h3><?php echo esc_html__( 'No Brokers Found', 'finlease' ); ?><h3>
        <?php
endif;
?>