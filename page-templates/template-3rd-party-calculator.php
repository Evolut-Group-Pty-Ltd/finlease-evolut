<?php
/*
	Template Name: 3rd party calculator page layout
	Template Post Type: page
*/
get_header();
while ( have_posts() ) :
	the_post();

	$type_id = 'third-party';
	$type_title = get_field('title');
	$type_desc = get_field('content');
	$type_form_title = get_field('form_title');
	$type_form = get_field('form_shortcode');
	$loan_term = get_field('loan_term');
	$interest_rate = get_field('interest_rate');
	$amount_financed = number_format(get_field('amount_financed'));
	$balloon_amount = get_field('balloon_amount');
	$color_1 = get_field('color_1');
	$color_2 = get_field('color_2');
	$color_3 = get_field('color_3');
	$color_4 = get_field('color_4');
?>
<style>
	body {
		color: <?php echo $color_1; ?>;
		overflow: initial;
	}
	.form-control {
		color: <?php echo $color_2; ?>;
	}
	h1, h2, h3, h4, h5, h6 {
		color: <?php echo $color_3; ?>;
	}
	.ui-widget-header {
		background: <?php echo $color_4; ?>;
	}
	.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, .ui-button.ui-state-disabled:hover, .ui-button.ui-state-disabled:active, .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus, .ui-button:hover, .ui-button:focus {
		border-color: <?php echo $color_4; ?>;
		background: <?php echo $color_4; ?>;
		color: <?php echo $color_4; ?>;
	}
	.calculator__output h3 {
		margin-bottom: 10px;
		padding-bottom: 10px;
	}
	.calculator__output .form-group {
		margin-bottom: 0;
	}
	.calculator__output .form-group.fl-quote-email {
		margin-bottom: 10px;
	}
	.calculator__output .calc__value {
		margin-bottom: 20px;
		padding-bottom: 10px;
	}
	.calculator__output .calculated-value {
		margin-bottom: 1rem;
	}
</style>

<div class="d-none">
	<div class="service-touch-experts"><div class="container"></div></div>
	<div class="footer"><div class="container"></div></div>

	<div class="tabwrapper">
		<a class="active" id="third-party-tab"></a>
	</div>
</div>

<div class="container">		
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<div class="calculator-values">
				<div class="calculation-info">
					<?php if ( $type_title ) { ?>
						<h3><?php echo esc_html( $type_title ); ?></h3>
					<?php } ?>
					
					<?php if ( $type_desc ) { ?>
						<p><?php echo $type_desc; ?></p>
					<?php } ?>
				</div>
				<div class="range-output">
					<div class="term__loans">
						<div class="form-group">
							<label for="loan-term">Loan term (months)</label>
							<select name="loan-term" id="loan-term-<?php echo esc_attr( $type_id ); ?>" class="form-control">
								<option value="12" <?php if ( $loan_term == 12 ) { echo 'selected'; } ?>>12</option>
								<option value="24" <?php if ( $loan_term == 24 ) { echo 'selected'; } ?>>24</option>
								<option value="36" <?php if ( $loan_term == 36 ) { echo 'selected'; } ?>>36</option>
								<option value="48" <?php if ( $loan_term == 48 ) { echo 'selected'; } ?>>48</option>
								<option value="60" <?php if ( $loan_term == 60 ) { echo 'selected'; } ?>>60</option>
							</select>
							<div id="slider-loan-<?php echo esc_attr( $type_id ); ?>"></div>
						</div>
					</div>
				</div>
				<!-- Interest Rate -->
				<div class="range-output">
					<div class="term__loans">
						<div class="form-group">
							<label for="interest-rate">Interest rate (%)</label>
							<select name="interest-rate" id="interest-<?php echo esc_attr( $type_id ); ?>" class="form-control">
								<?php
								for ( $i=3; $i<=22.5; $i+=0.25 ) {
									if ( $interest_rate == $i ) {
										echo '<option value="' . $i . '" selected>' . $i . '</option>';
									} else {
										echo '<option value="' . $i . '">' . $i . '</option>';
									}
								}?>
							</select>
							<div id="slider-interest-<?php echo esc_attr( $type_id ); ?>"></div>
						</div>
					</div>
				</div>
				<!-- Amount Financed -->
				<div class="range-output">
					<div class="term__loans">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-8">
									<label for="amount">Amount financed ($)</label>
								</div>
								<div class="col-lg-4">
								<input type="text" id="amount-<?php echo esc_attr( $type_id ); ?>" class="form-control" data-index=0 value="$<?php echo $amount_financed; ?>">
								</div>
							</div>
	
							
							<div id="slider-<?php echo esc_attr( $type_id ); ?>"></div>
						</div>
					</div>
				</div>
				<!-- Residual / balloon (%) for Amount Financed -->
				<div class="range-output">
					<div class="term__loans">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-8">
									<label for="residual">Residual / balloon (%) for Amount Financed</label>
								</div>
								<div class="col-lg-4">
								<input type="number" min="1" max="100" id="residual-<?php echo esc_attr( $type_id ); ?>" class="form-control" data-index="0" value="<?php echo $balloon_amount; ?>">
								</div>
							</div>
	
							
							<div id="slider-residual-<?php echo esc_attr( $type_id ); ?>"></div>
						</div>
					</div>
				</div>
				<!-- Checkbox -->
				<div class="range-output">
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="payment-<?php echo esc_attr( $type_id ); ?>">
							<label class="custom-control-label" for="payment-<?php echo esc_attr( $type_id ); ?>">Check this box to show payments monthly in arrears</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5 offset-lg-1 col-md-6">
			<div class="calculator__output">
				<?php if( $type_form_title ) { ?>
					<h3><?php echo esc_html( $type_form_title ); ?></h3>
				<?php } ?>
				<?php if ( $type_form ) {
					echo do_shortcode( $type_form );
				} ?>
			</div>
		</div>
	</div>
</div>
<?php
endwhile;
get_footer();