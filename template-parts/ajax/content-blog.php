<?php
if( isset( $_POST['nonce'] ) ){
    $page           = (isset($_POST['page'])) ? $_POST['page'] : 0;
    $term 	        = (isset($_POST['term'])) ? $_POST['term'] : '';
    $currentOffset 	= (isset($_POST['currentOffset'])) ? $_POST['currentOffset'] : 0;
    $sort 		    = ( isset( $_POST['sort'] ) ) ? $_POST['sort'] : '';

    $args = array(
		'post_type' 	=> 'post',
        'posts_per_page' => 6,
        'paged'    		=> $page,
    );

    if ( !empty( $term ) ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $term,
		);
    }

    if ( !empty( $sort ) ) {
        if ( $sort == 'fl-latest'  ) {
			$order  = "DESC";
		}
		elseif ( $sort == 'fl-oldest' ) {
			$order  = "ASC";
        }
        $args['order'] = $order;
    }
    
    $blog_posts = new WP_Query( $args );
    $total_posts = $blog_posts->found_posts;
	$total_pages = ceil( $total_posts/6 );
    if ( $blog_posts->have_posts() ) :
		while ( $blog_posts->have_posts() ) :
			$blog_posts->the_post();
?>
            <div class="col-lg-4">
                <div class="latestnews__block">
                    <div class="image__block">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'finlease-image-blog-listing' );
                            }
                            ?>
                        </a>
                    </div>
                    <div class="content__block">
                        <div class="date"><?php the_date(); ?></div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php echo wp_strip_all_tags( finlease_limit_words( get_the_content(), 30 ) ); ?>
                    </div>
                </div>
            </div>
<?php 
        endwhile;
    endif;
    if ( $currentOffset != $page && $total_posts > 6 ) {
		?>
		<div class="text-center explore__blog" id="fl-blog-btn">
            <a href="#" class="btn btn--big btn--red--outline" id="fl-blog-more" data-nonce="<?php echo wp_create_nonce( 'fl_blog_nounce' ); ?>" data-offset="<?php echo $total_pages; ?>">View more</a> 
        </div>
        <?php
	}
} 
?>