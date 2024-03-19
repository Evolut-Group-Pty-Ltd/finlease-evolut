<?php
if( isset( $_POST['nonce'] ) ){
    $state      = ( isset( $_POST['state'] ) ) ? $_POST['state'] : '';
    $term_id    = ( isset( $_POST['term_id'] ) ) ? $_POST['term_id'] : '';
    $taxonomy   = 'fl_broker_location';
    ?>
    <div class="tab-pane fade show active" id="<?php echo esc_attr( $state );?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $state );?>-tab">
        <?php
        $locations = get_terms( array(
			'taxonomy' => $taxonomy,
			'hide_empty' => true,
			'parent' => $term_id
		) );
        if ( !empty( $locations ) ) {
            foreach ( $locations as $location ) {
                $loc = get_term( $location, $taxonomy );
                ?>
                <div class="broker-category-section">
                    <div class="brocker-section-detail">
                        <h3><?php echo $loc->name; ?></h3>
                        <p><?php echo wpautop( wptexturize( $loc->description ) ); ?></p>
                    </div>
                    <div class="row">
                    <?php
                    $args = array(
                            'post_type' => 'fl_broker',
                            'tax_query' => array(
                                array(
                                'taxonomy' => 'fl_broker_location',
                                'field' => 'term_id',
                                'terms' => $loc->term_id
                                    )
                                ),
                            'posts_per_page' => 12
                            );
                    $brokers_query = new WP_Query( $args );
                    if ( $brokers_query->have_posts() ){
                        while( $brokers_query->have_posts() ) {
                            $brokers_query->the_post();
                            $designation = get_field( 'broker_designation', get_the_ID() );
                            ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="finlease__tab__items">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="finlease__tab__image">
                                            <?php the_post_thumbnail( 'finlease-image-blog-listing' ); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="finlease__tab__grid__info">
                                        <h4><?php the_title(); ?></h4>
                                        <p><?php echo esc_html( $designation ); ?></p>
                                    </div>
                                    <div class="tab-overlay">
                                        <a href="<?php the_permalink(); ?>" class="btn btn--red--dust btn--big">View more</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } 
                    }
                    else {
                        ?>
                        <div class="col-lg-12 col-sm-12">
                            <p><?php esc_html_e( 'Sorry, no brokers found.' ); ?></p>
                        </div>
                        <?php
                    } 
                    ?>
                    </div>
                </div>
                <?php
            }
        }
        else {
            ?>
            <div class="col-lg-12 col-sm-12">
                <p><?php esc_html_e( 'Sorry, no locations found.' ); ?></p>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}