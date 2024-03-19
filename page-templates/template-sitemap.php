<?php
/*
	Template Name: Sitemap Page
	Template Post Type: page
*/
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="sitemap-page">
			<div class="container">
			<h1>Sitemap</h1>
			<?php echo do_shortcode('[wp_sitemap_page]');?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();