<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Finlease
 */

?>
<?php if ( !is_page_template( 'page-templates/template-3rd-party-calculator.php' ) ) : ?>
	<footer class="footer">
	    <div class="top-footer">
	        <div class="container">
	            <?php get_template_part( 'template-parts/footer/content', 'top' ); ?>
	            <?php get_template_part( 'template-parts/footer/content', 'middle' ); ?>
	        </div>
	    </div>
	    <?php get_template_part( 'template-parts/footer/content', 'bottom' ); ?>
	</footer>
	<a href="#" class="scrollToTop btn--blue" title="click here for top" style="display: block;"><i class="fa fa-angle-up"></i></a>
<?php endif; ?>

<?php wp_footer(); ?>

<?php if ( !is_page_template( 'page-templates/template-3rd-party-calculator.php' ) ) : ?>
	<div id="reviews" style="display: inline-block;">
		<a href="https://www.productreview.com.au/listings/finlease" target="_blank">
			<p><span class="average-rating-value">4.9</span>/5 from <span class="number-of-reviews">954</span> reviews</p>
			<div class="stars">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</a>
	</div>
	
	<script>
		/* 2022.11.23 Disabled as it does not appear to do anything.
		var monitor = setInterval(function(){
				var elem = document.activeElement;
				if(elem && elem.tagName == 'IFRAME'){
						clearInterval(monitor);
						console.log('clicked!');
				}
		}, 100); */
	</script>
<?php endif; ?>
</body>
</html>
