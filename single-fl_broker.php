<?php
get_header();
while ( have_posts() ) :
    the_post();
    $banner_img                 = get_field( 'broker_banner_image', get_the_ID() );
    $broker_designation         = get_field( 'broker_designation', get_the_ID() );
    $broker_contact_number      = get_field( 'broker_contact_number', get_the_ID() );
    $broker_email_address       = get_field( 'broker_email_address', get_the_ID() );
    $broker_social_media_link   = get_field( 'broker_social_media_link', get_the_ID() );

    $ban_img       = isset( $banner_img ) && ! empty( $banner_img ) ? $banner_img : false;
    $designation   = isset( $broker_designation ) && ! empty( $broker_designation ) ? $broker_designation : false;
    $contact_num   = isset( $broker_contact_number ) && ! empty( $broker_contact_number ) ? $broker_contact_number : false;
    $email         = isset( $broker_email_address ) && ! empty( $broker_email_address ) ? $broker_email_address : false;
    $social_medias = isset( $broker_social_media_link ) && ! empty( $broker_social_media_link ) ? $broker_social_media_link : false;

    $locations = get_the_terms( get_the_ID(), 'fl_broker_location' );
    $loc = join( ', ', wp_list_pluck( $locations, 'name' ) );
    if ( $ban_img ) {
        $img_alt  = isset( $ban_img['alt'] ) && ! empty( $ban_img['alt'] ) ? $ban_img['alt'] : false;
        $img_url  = isset( $ban_img['url'] ) && ! empty( $ban_img['url'] ) ? $ban_img['url'] : false;
        if ( $img_url  ) {
            ?>
            <div class="broker-single-media">
                <img src="<?php echo esc_url( $ban_img['sizes']['finlease-blog-single'] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
            </div>
            <?php
        }
    }
    ?>
    <div class="broker-single-post-content">
        <div class="container">
            <div class="card">
                <div class="author">
                    <?php if ( has_post_thumbnail() ) { ?>
                            <div class="author-image">
                                <?php the_post_thumbnail( 'finlease-broker-single' ); ?>
                            </div>
                    <?php } ?>
                    <div class="title-section">
                        <h1><?php the_title(); ?></h1>
						<?php if ( get_field( 'specialisation' ) ): ?>
							<?php $posts = get_field('specialisation');
							if( $posts ): ?>
							    <h4 class="brokers-links">Specialist in:
							    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
							        <?php setup_postdata($post); ?>
							        <a href="<?php the_permalink(); ?>">
									<?php
									    $input = get_permalink(); 
									    $input2 = str_replace("https://www.finlease.com.au/","",$input);
									    $input3 = str_replace("-"," ",$input2);
									    $finalinput = rtrim($input3, "/");
									    echo $finalinput;
									?></a><span>,</span>
							    <?php endforeach; ?>
							    </h4>
							    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
							<?php endif; ?>
						<?php else: // field_name returned false ?>
	                        <?php if ( $designation ) { ?>
	                            <h4><?php echo esc_html( $designation ); ?></h4>
	                        <?php } ?>
						<?php endif; // end of if field_name logic ?>
                        <div class="contact-info">
                            <ul>
                                <?php if ( $contact_num ) {
                                    $ph_number = preg_replace("/[^0-9]/", "", $contact_num);
                                    ?>
                                    <li><a href="tel:<?php echo $ph_number; ?>"><?php echo $contact_num; ?></a></li>
                                <?php } ?>

                                <?php if ( $email ) { ?>
                                    <li><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- end contact info -->
                        <div class="contact-location">
                            <p><?php echo $loc; ?></p>
                        </div>
                        <!-- end contact location -->
                        <div class="borker-social-media">
                            <?php if ( $social_medias ) { ?>
                            <ul>
                                <?php foreach ( $social_medias as $social_media ) {
                                        $url = isset( $social_media['broker_sm_url'] ) && ! empty( $social_media['broker_sm_url'] ) ? $social_media['broker_sm_url'] : false;
                                        $target = isset( $social_media['borker_sm_target'] ) && ! empty( $social_media['borker_sm_target'] ) ? $social_media['borker_sm_target'] : false;
                                        $name = isset( $social_media['broker_sm_name'] ) && ! empty( $social_media['broker_sm_name'] ) ? $social_media['broker_sm_name'] : false;
                                    ?>
                                    <li><a href="<?php echo $url; ?>" target="<?php echo ( $target ) ? '_blank' : '_self'; ?>"><img src="<?php echo FL_TAU; ?>/images/<?php echo $name; ?>.svg"> </a></li>
                                    <?php
                                } ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- end title section -->
                <!-- end author section -->
                <div class="blog-content">
                    <?php the_content(); ?>
					<div class="action__wrap action__wrap-broker">
						<?php if(!empty($contact_num)) echo '<a href="tel:'. $ph_number.'" class="btn btn--red--dust btn--big">Call Me</a>' ; ?>
						<?php if(!empty($email)) echo '<a href="mailto:'.$email.'" class="btn btn--red--dust btn--big">Email Me</a>' ; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
    <?php
endwhile;
get_footer();