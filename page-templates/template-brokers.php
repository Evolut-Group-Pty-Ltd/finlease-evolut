<?php
/*
	Template Name: Brokers page layout
	Template Post Type: page
*/
get_header();

while ( have_posts() ) :
    the_post();
    ?>
    <div class="loan-calculator-text broker-text-block">
        <div class="container">
            <div class="loan__calculator__wrapper">
                <div class="title-blok">
                    <h1><?php the_title(); ?></h1>
                </div>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php
endwhile;
?>
<div class="finlease-tab brocker--tab ">
    <div class="tabwrapper">
        <div class="container">
            <ul class="nav nav-tabs tabwrapper-carousel owl-carousel owl-theme" id="myTab" role="tablist">
                <?php
                $taxonomy = 'fl_broker_location';
                $states = get_terms( array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                    'parent' => 0
                ) );
                $count = 1;
                foreach ( $states as $state ) {
                    $name = isset( $state->name ) && ! empty( $state->name ) ? $state->name : false;
                    $slug = isset( $state->slug ) && ! empty( $state->slug ) ? $state->slug : false;
                    $term_id = isset( $state->term_id ) && ! empty( $state->term_id ) ? $state->term_id : false;
                    ?>
                    <li class="nav-item">
                        <a class="nav-link fl-broker <?php echo esc_attr( ( $count == 1 ) ? 'active' : '' ); ?>" id="<?php echo esc_attr( $slug ); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr( $slug ); ?>" role="tab" aria-controls="<?php echo esc_attr( $slug ); ?>"
                            aria-selected="true" data-nonce="<?php echo wp_create_nonce( 'fl_broker_nounce' ); ?>" data-id="<?php echo $term_id; ?>"><?php echo esc_html( $name ); ?></a>
                    </li>
                    <?php
                    $count++;
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="finlease__tab__wrapper">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="<?php echo esc_attr( $states[0]->slug );?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $states[0]->slug );?>-tab">
                    <?php
                    $locations = get_terms( array(
	                    'taxonomy' => $taxonomy,
	                    'hide_empty' => true,
	                    'parent' => $states[0]->term_id
	                ) );
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
								'orderby' => 'menu_order title',
								'order'   => 'ASC',
                                'posts_per_page' => -1
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
                                <p><?php esc_html_e( 'Sorry, no brokers found.' ); ?></p>
                                <?php
                            } 
                            ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div id='loader' style='display: none;'>
                    <div class="loading"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
