<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Finlease
 */

get_header();

while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', get_post_type() );

endwhile; // End of the loop.

// Related posts
$args=array(
	'post_type'=> 'post',
	'post_status' => 'publish',
	'post__not_in' => array($post->ID),
	'posts_per_page' => 3,
);

if ( $related_ids = get_field('posts_you_may_like') ) :
	$args['post__in'] = $related_ids;
	$args['orderby'] = 'post__in';

	$related_posts = new WP_Query($args);
else :
	$post_tags_ids = [];
	$post_tags = wp_get_post_tags($post->ID);
	$post_categories = wp_get_post_categories($post->ID);

	foreach ( $post_tags as $post_tag ) :
		$post_tags_ids[] = $post_tag->term_id;
	endforeach;

	if ( !empty($post_tags_ids) ) :
		$args['tag__in'] = $post_tags_ids;
	endif;
	if ( !empty($post_categories) ) :
		$args['category__in'] = $post_categories;
	endif;

	$related_posts = new WP_Query($args);

	if ( !$related_posts->post_count && isset($args['tag__in']) ) :
		unset($args['tag__in']);
	
		$related_posts = new WP_Query($args);
	endif;

	if ( !$related_posts->post_count && isset($args['category__in']) ) :
		unset($args['category__in']);
	
		$related_posts = new WP_Query($args);
	endif;
endif;

if ( $related_posts-> have_posts() ) :
?>
	<div class="you-may-like">
		<div class="container">
			<div class="like-title">
				<h4>Posts you may like</h4>
			</div>

			<div class="row">
				<?php while ( $related_posts->have_posts() ): $related_posts->the_post(); ?>
					<div class="col-lg-4 col-md-4">
						<div class="like__block">
							<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'finlease-image-blog-listing' );
								} else {
							?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-placeholder.png" class="attachment-finlease-image-blog-listing size-finlease-image-blog-listing wp-post-image img-fluid" alt="Finlease" width="360" height="240">
							<?php } ?>

							<div class="like-caption">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php
endif; 

wp_reset_postdata();

get_footer();