<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finlease
 */

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

	endwhile; // End of the loop.
	?>

	<?php if( get_field('video_embed') ): ?>
		<div class="embed-container">
			<?php the_field('video_embed'); ?>		
		</div>
		<div class="embed-text">
			<p>Contact us for all your equipment finance needs.</p>
			<a href="https://dev.finlease.com.au/contact-us/" class="btn btn--red--dust btn--big" target="_self">Contact Us</a>
		</div>				
	<?php endif; ?>		
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();