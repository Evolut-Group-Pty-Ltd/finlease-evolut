<?php
/*
	Template Name: Quote Page
	Template Post Type: page
*/
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="quote-page">
			<div class="container">
				<div class="quote">
					<div class="quote-header">
				        <?php 
				            $footer_logo = get_field( 'fl_footer_logo', 'option' );
				            if ( isset( $footer_logo ) && !empty( $footer_logo['url'] ) ) {
				        ?>
				            <div class="footer-logo">
				                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $footer_logo['url'] ); ?>" alt="<?php echo esc_attr( $footer_logo['alt'] ); ?>"></a>
				            </div>
				        <?php } ?>
						<h1>Your quote is ready</h1>
					</div>
					<div class="quote-body">	
						<table>	
							<?php if( get_field('loan_term') ): ?>							
								<tr>
									<td>Loan Term</td>
									<td><?php the_field('loan_term'); ?></td>
								</tr>							
							<?php endif; ?>				
							<?php if( get_field('interest_rate') ): ?>
								<tr>
									<td>Interest Rate</td>
									<td><?php the_field('interest_rate'); ?></td>
								</tr>
							<?php endif; ?>	
							<?php if( get_field('amount_financed') ): ?>
								<tr>
									<td>Amount Financed</td>
									<td><?php the_field('amount_financed'); ?></td>
								</tr>
							<?php endif; ?>	
							<?php if( get_field('residual__balloon') ): ?>
								<tr>
									<td>Residual / Balloon</td>
									<td><?php the_field('residual__balloon'); ?></td>
								</tr>
							<?php endif; ?>	
							<?php if( get_field('payment_monthly_in_arrears') ): ?>
								<tr>
									<td>Payment Monthly in Arrears</td>
									<td><?php the_field('payment_monthly_in_arrears'); ?></td>
								</tr>
							<?php endif; ?>	
							<?php if( get_field('your_payment_amount_will_be_approximately') ): ?>
								<tr>
									<td>Your payment amount will be approximately</td>
									<td><?php the_field('your_payment_amount_will_be_approximately'); ?></td>
								</tr>
							<?php endif; ?>	
						</table>
					</div>
					<div class="quote-footer">
						<p>Thanks for requesting a quote from our team!</p>
						<p>For a refined quote, please call <a href="tel:1800358658">1800 358 658</a> or head over to our website at <a href="https://www.finlease.com.au/">finlease.com.au</a> to find a broker near you.</p>	
					</div>				
				</div>				
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();