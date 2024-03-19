<?php
/**
 * Layout for Testimonial block.
 * 
 * @package Finlease
 */
?>

<div class="product-review-section">
	<div id="review__section"></div>
	<div class="container">
		<?php if($block['layout'] === 'Default'): ?>
		<div id="pr-reviews-horizontal-widget" class="productreviewwidget"></div>
		<script>
			window.__productReviewCallbackQueue = window.__productReviewCallbackQueue || [];
			window.__productReviewCallbackQueue.push(function(ProductReview) {
				ProductReview.use('reviews-horizontal', {
					"identificationDetails": {
						"type": "single",
						"strategy": "from-internal-entry-id",
						"identifier": "0ba1c1c6-2869-31f7-9d5a-87dbe1b0bf5c"
					},
					"container": "#pr-reviews-horizontal-widget"
				});
			});

			window.__productReviewSettings = {
				brandId: 'e6fe3df7-52e9-30be-b37e-a53d6608d026'
			};
		</script>
		<script src="https://cdn.productreview.com.au/assets/widgets/loader.js" async></script>
		<?php endif; ?>
		
		<?php if($block['layout'] === 'Carousel'): ?>
			<h2 class="text--center"><?php echo $block['testimonial_heading']; ?></h2>
			<div class="carousel" data-flickity='{ "adaptiveHeight": true, "pageDots": false, "draggable": false }'>
				<?php foreach($block['testimonial_carousel'] as $item): ?> 
					<div class="carousel-cell">
						<div class="carousel-cell__inner">
							<?php echo $item['text']; ?>
							<p class="info name"><?php echo $item['name']; ?></p>
							<p class="info position-company"><?php if($item['position']): echo $item['position'].', '; endif; ?> <?php echo $item['company']; ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</div>