<?php
    $testimonial_title     = isset( $block['testimonial_title'] ) && ! empty( $block['testimonial_title'] ) ? $block['testimonial_title'] : false;
    $testimonial_heading   = isset( $block['testimonial_heading'] ) && ! empty( $block['testimonial_heading'] ) ? $block['testimonial_heading'] : false;
    $testimonial_customers = isset( $block['testimonial_customers'] ) && ! empty( $block['testimonial_customers'] ) ? $block['testimonial_customers'] : false;
    $testimonial_bg_color = isset( $block['testimonial_bg_color'] ) && ! empty( $block['testimonial_bg_color'] ) ? $block['testimonial_bg_color'] : false;
?>

<div class="product-review-section">
    <div class="container">
        <h3 class="over-title"><?php echo $testimonial_title ?></h3>
        <h2 class="title"><?php echo $testimonial_heading ?></h2>

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

        <div class="reviews"><?php // JS ?></div>
    </div>
</div>
