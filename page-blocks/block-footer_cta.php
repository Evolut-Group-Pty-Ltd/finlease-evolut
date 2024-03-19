<?php
/**
 * Layout for Footer CTA block.
 * 
 * @package Finlease
 */
$description = isset( $block['content'] ) && ! empty( $block['content'] ) ? $block['content'] : '';
$email = isset( $block['email'] ) && ! empty( $block['email'] ) ? $block['email'] : false;
$phone = isset( $block['phone'] ) && ! empty( $block['phone'] ) ? $block['phone'] : false;
?>

<div class="footer-cta">
    <div class="container">
	    <?php echo $description; ?>

		<div class="row">
			<?php if ( $phone ) : ?>
				<div class="col-sm-6 col-12 text-right">
					<a href="tel:<?php echo $phone; ?>" class="btn btn--big btn--red--dust">Call <?php echo $phone; ?></a>
				</div>
			<?php endif; ?>

			<?php if ( $email ) : ?>
				<div class="col-sm-6 col-12">
					<a href="mailto:<?php echo $email; ?>" class="btn btn--big btn--green">Send an Email</a>
				</div>
			<?php endif; ?>
		</div>
    </div>
</div>