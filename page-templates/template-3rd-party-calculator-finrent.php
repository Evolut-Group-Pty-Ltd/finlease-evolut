<?php
/*
	Template Name: 3rd party calculator page finrent layout
	Template Post Type: page
*/
get_header('finrent');
while ( have_posts() ) :
	the_post();

	$type_title = get_field('title');
	$type_desc = get_field('content');
	$loan_term = get_field('loan_term');
	$interest_rate = get_field('interest_rate') ? get_field('interest_rate') : 6;
	$brokerage = get_field('brokerage') ? get_field('brokerage') : 6;
	$amount_financed = get_field('amount_financed');
	$hide_machines = get_field('hide_number_of_machines') ? true : false;
	$machines = get_field('number_of_machines') ? get_field('number_of_machines') : 40;
	$show_weekly = get_field('show_weekly') ? true : false;
	$color_1 = get_field('color_1');
	$color_2 = get_field('color_2');
	$color_3 = get_field('color_3');
	$color_4 = get_field('color_4');

	$row_class = 'pb-4';
	if ( $show_weekly ) {
		$row_class = 'pb-2';
	}
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

<input type="hidden" name="interest-rate" id="interest-rate-val" value="<?php echo $interest_rate/100; ?>">
<input type="hidden" name="brokerage" id="brokerage-val" value="<?php echo $brokerage/100; ?>">

<div class="d-none">
	<div class="service-touch-experts"><div class="container"></div></div>
	<div class="footer"><div class="container"></div></div>

	<div class="tabwrapper">
		<a class="active" id="third-party-tab"></a>
	</div>
</div>

<div class="container py-5">		
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
				<!-- Loan term -->
				<div class="range-output">
					<div class="term__loans">
						<div class="form-group">
							<label for="loan-term">Loan term (months)</label>
							<select name="loan-term" id="loan-term" class="form-control">
								<option value="12" <?php if ( $loan_term == 12 ) { echo 'selected'; } ?>>12</option>
								<option value="24" <?php if ( $loan_term == 24 ) { echo 'selected'; } ?>>24</option>
								<option value="36" <?php if ( $loan_term == 36 ) { echo 'selected'; } ?>>36</option>
								<option value="48" <?php if ( $loan_term == 48 ) { echo 'selected'; } ?>>48</option>
								<option value="60" <?php if ( $loan_term == 60 ) { echo 'selected'; } ?>>60</option>
							</select>
							<div id="slider-loan-term"></div>
						</div>
					</div>
				</div>
				<!-- Amount Financed -->
				<div class="range-output">
					<div class="term__loans">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-8">
									<label for="amount">Amount to be financed ($)</label>
								</div>
								<div class="col-lg-4">
								<input type="text" id="amount-slider-val" class="form-control" data-index=0 value="<?php echo $amount_financed; ?>">
								</div>
							</div>
							<div id="amount-slider"></div>
						</div>
					</div>
				</div>
				<!-- Number of machines -->
				<div class="range-output <?php if ( $hide_machines ) { echo 'd-none'; } ?>">
					<div class="term__loans">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-8">
									<label for="number-of-machines">Number of Machines</label>
								</div>
								<div class="col-lg-4">
								<input type="number" min="1" max="1000" id="machine-slider-val" class="form-control" data-index="0" value="<?php echo $machines; ?>">
								</div>
							</div>
							<div id="machine-slider"></div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-lg-5 offset-lg-1 col-md-6">
			<div class="calculator__output">
				<div class="row <?php echo $row_class; ?>">
					<div class="col-7 text-dark">Loan Term</div>
					<div class="col-5 font-weight-bold text-dark" id="loan-val-calc"></div>
				</div>
				<div class="row <?php echo $row_class; ?>">
					<div class="col-7 text-dark">Amount Financed</div>
					<div class="col-5 font-weight-bold text-dark" id="amount-slider-val-calc"></div>
				</div>
				<div class="row <?php echo $row_class; ?> <?php if ( $hide_machines ) { echo 'd-none'; } ?>">
					<div class="col-7 text-dark">Number of Machines</div>
					<div class="col-5 font-weight-bold text-dark" id="machines-val-calc"></div>
				</div>

				<div class="payment-summary">
					<h3 class="pt-3">Monthly Payment summary</h3>
					<div class="row pt-3 <?php echo $row_class; ?>">
						<div class="col-7 text-dark">Excluding GST</div>
						<div class="col-5 text-bold font-weight-bold text-dark" id="calc-excluding-gst"></div>
					</div>
					<div class="row <?php echo $row_class; ?>">
						<div class="col-7 text-dark">GST (only)</div>
						<div class="col-5 font-weight-bold text-dark" id="calc-gst-only"></div>
					</div>
					<div class="row <?php echo $row_class; ?>">
						<div class="col-7 text-dark">Including GST</div>
						<div class="col-5 font-weight-bold text-dark" id="calc-including-gst"></div>
					</div>
					<div class="row <?php echo $row_class; ?> <?php if ( $hide_machines ) { echo 'd-none'; } ?>">
						<div class="col-7 text-dark">Monthly Cost per machine Ex GST</div>
						<div class="col-5 font-weight-bold text-dark" id="calc-machine-monthly-excluding-gst"></div>
					</div>
					<div class="row <?php echo $row_class; ?> <?php if ( $hide_machines ) { echo 'd-none'; } ?>">
						<div class="col-7 text-dark">Daily Cost per machine Ex GST</div>
						<div class="col-5 font-weight-bold text-dark" id="calc-daily-machine-excluding-gst"></div>
					</div>

					<?php if ( $show_weekly ) : ?>
						<h3 class="pt-3">Weekly Payment summary</h3>

						<div class="row pt-3 <?php echo $row_class; ?>">
							<div class="col-7 text-dark">Excluding GST</div>
							<div class="col-5 text-bold font-weight-bold text-dark" id="calc-excluding-gst-weekly"></div>
						</div>
						<div class="row <?php echo $row_class; ?>">
							<div class="col-7 text-dark">GST (only)</div>
							<div class="col-5 font-weight-bold text-dark" id="calc-gst-only-weekly"></div>
						</div>
						<div class="row <?php echo $row_class; ?>">
							<div class="col-7 text-dark">Including GST</div>
							<div class="col-5 font-weight-bold text-dark" id="calc-including-gst-weekly"></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
endwhile;
get_footer();