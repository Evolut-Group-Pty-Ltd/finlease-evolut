<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finlease
 */

get_header();
?>
<div class="latestnews blog-section">
    <div class="container">
		<?php
		$args = array(
			'post_type'		=> 'post',
			'posts_per_page' => 1,
			'post_status'   => 'publish',
			'meta_key'      => 'finlease_featured',
			'meta_value'    => 'yes',
		);
		$featured_post = new WP_Query( $args );
		if ( $featured_post->have_posts() ) :
			while ( $featured_post->have_posts() ) :
				$featured_post->the_post();
				?>
				<div class="featured-block">
					<div class="image__block">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'finlease-featured-blog' );
						}
						?>
						<div class="feature-blog-caption">
							<?php 
							$featured = get_field( 'fl_blog_featured', get_the_ID() ); 
							if ( isset( $featured ) && !empty( $featured ) ) {
								?>
								<div class="featured">featured</div>
								<?php
							}
							?>
							<h1><?php the_title(); ?></h1>
							<a href="<?php the_permalink(); ?>" class="btn btn--big">Read more</a>
						</div>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		endif;
		?>

        <div class="filter-section" data-nonce="<?php echo wp_create_nonce( 'fl_filter_nounce' ); ?>">
            <div class="row">
                <div class="col-12">
                    <div class="filter-buttons">
					<?php 
					$fl_terms = get_terms( 'category', array(
										'hide_empty' => false,
									) );
					?>
                        <ul>
							<?php
							foreach ( $fl_terms as $fl_term ) {
								?>
								<li><a href="#" class="btn btn--gray--outline fl-blog-term" data-slug="<?php echo esc_attr( $fl_term->slug ); ?>"><?php echo esc_html( $fl_term->name ); ?></a></li>
								<?php
							}
							?>
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
        
        <div class="blog-lists">
            <div class="row" id="fl-blog-posts">
			<?php
			$args = array(
				'post_type' 	 => 'post',
				'posts_per_page' => 6,
				'order'  		 => 'DESC'
			);
			$blog_posts = new WP_Query( $args );
			if ( $blog_posts->have_posts() ) :
				while ( $blog_posts->have_posts() ) :
					$blog_posts->the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
			endif;
			?>
            </div>
        </div>
		<div id='loader' style='display: none;'>
			<div class="loading"></div>
		</div>
		<?php
		$count_posts = $blog_posts->found_posts;
		$total_pages = ceil( $count_posts/6 );
		if ( $count_posts > 6 ) {
		?>
			<div class="text-center explore__blog" id="fl-blog-btn">
				<a href="#" class="btn btn--big btn--red--outline" id="fl-blog-more" data-nonce="<?php echo wp_create_nonce( 'fl_blog_nounce' ); ?>" data-offset="<?php echo $total_pages; ?>">View more</a> 
			</div> 
		<?php } ?> 
    </div>
</div>
<?php
get_footer();
