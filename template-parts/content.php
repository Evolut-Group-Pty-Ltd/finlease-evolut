<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finlease
 */
?>
<?php if ( is_singular() ){
	?>
	<div class="blog-single-media">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'finlease-blog-single' );
		} else {
			echo wp_get_attachment_image( 2552, 'finlease-blog-single' );
		}
		?>
    </div>
   
    <div class="blog-single-post-content">
        <div class="container">
            <div class="card">
                <div class="title-section">
                    <?php finlease_posted_on(); ?>
                    <h1><?php the_title(); ?></h1>

                </div>
                <!-- end title section -->
                <div class="author">
                    <?php finlease_posted_by(); ?>
                    <div class="author-image">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
                    </div>
                </div>
                <!-- end author section -->
                <div class="blog-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
	<?php
} 
else { 
	?>
	<div class="col-lg-4">
		<div class="latestnews__block">
			<a href="<?php the_permalink(); ?>" style="color: inherit;">
<!--
				<div class="image__block">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'finlease-image-blog-listing' );
					}
					?>
				</div>
-->
				<div class="content__block">
					<div class="date"><?php the_date(); ?></div>
					<h3><?php the_title(); ?></h3>
					<?php echo wp_strip_all_tags( finlease_limit_words( get_the_content(), 30 ) ); ?>
				</div>
			</a>
		</div>
	</div>
	<?php
}
?>