<?php
/**
 * Layout for Broker block.
 * 
 * @package Finlease
 */

$broker_section_title = isset( $block['broker_section_title'] ) && ! empty( $block['broker_section_title'] ) ? $block['broker_section_title'] : false;
$broker_section_desc  = isset( $block['broker_section_description'] ) && ! empty( $block['broker_section_description'] ) ? $block['broker_section_description'] : false;
$broker_section_brokers = isset( $block['broker_section_brokers'] ) && ! empty( $block['broker_section_brokers'] ) ? $block['broker_section_brokers'] : false;
$broker_section_dropdown = isset( $block['broker_section_dropdown'] ) ? $block['broker_section_dropdown'] : true;
$broker_section_suburbs = isset( $block['broker_section_suburbs'] ) && ! empty( $block['broker_section_suburbs'] ) ? $block['broker_section_suburbs'] : false;
?>
<div class="service-touch-experts">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="expert__left">
					<?php if ( $broker_section_title ) { ?>
							<h3><?php echo esc_html( $broker_section_title ); ?></h3>
					<?php } ?>

					<?php if ( $broker_section_desc ) {
						echo wp_kses_post( $broker_section_desc );
					} ?>

					<?php if ( $broker_section_dropdown ) : ?>
						<div id="location-select-new" class="form-group">   
							<?php
								$parent_locations = get_terms( array(
									'taxonomy'   => 'fl_broker_location',
									'parent'	 => 0
								) );
							?>

							<select class="form-control" id="new-form">
								<option value="">Select location</option>
								<option value="all">All locations</option>

								<?php
									if ( $broker_section_suburbs ) {
										foreach ( $parent_locations as $parent_loc ) { 
											$locations = get_terms( array( 
												'taxonomy'   => 'fl_broker_location',
												'hide_empty' => false,
												'parent'	 => $parent_loc->term_id
											) );
								?>
											<optgroup label="<?php echo esc_attr( $parent_loc->name ); ?>">
								<?php
												if ( !empty( $locations ) ) {
													foreach ( $locations as $location ) {
								?>
														<option value="<?php echo $location->slug; ?>"><?php echo esc_attr( $location->name ); ?></option>
								<?php
													}
												}
								?>
											</optgroup>
								<?php
										}
									} else {
										foreach ( $parent_locations as $parent_loc ) { 
								?>
											<option value="<?php echo $parent_loc->slug; ?>"><?php echo esc_attr( $parent_loc->name ); ?></option>
								<?php
										}
									}
								?>
							</select>
						</div>
					<?php endif; ?>
				</div>
			</div>	

<?php
			if ( !empty($broker_section_brokers) ) {
?>
				<div class="col-lg-8 offset-lg-1">
					<div class="expert__wrapper owl-carousel owl-theme">
						<?php 
							foreach ( $broker_section_brokers as $broker_section_broker ) {
								$designation = get_field( 'broker_designation', $broker_section_broker );
								$email	   = get_field( 'broker_email_address', $broker_section_broker );
								$contact_num = get_field( 'broker_contact_number', $broker_section_broker );
								$social_media = get_field( 'broker_social_media_link', $broker_section_broker );

								$broker_designation = isset( $designation ) && ! empty( $designation ) ? $designation : false;
								$broker_email = isset( $email ) && ! empty( $email ) ? $email : false;
								$broker_contact_num = isset( $contact_num ) && ! empty( $contact_num ) ?  $contact_num : false;
								$social_medias = isset( $social_media ) && ! empty( $social_media ) ? $social_media : false;

								$specialloc = array('all');

								$terms = wp_get_post_terms( $broker_section_broker, array( 'fl_broker_location' ) );
								foreach ( $terms as $term ) {
									$specialloc[] = $term->slug;
								}
							?>
								<div class="item <?php echo implode(' ', $specialloc); ?>">
									<div class="expert__team__block">
										<?php if ( has_post_thumbnail($broker_section_broker) ) { ?>
											<div class="expert__fig__bolck">
												<?php echo get_the_post_thumbnail( $broker_section_broker, 'finlease-broker-slider' ); ?>
											</div>
										<?php } ?>
										<div class="expert__caption">
											<h4 class="name"><?php echo get_the_title($broker_section_broker); ?></h4>
											<?php if ( $broker_designation ) { ?>
													<h5 class="destination">
														<?php echo esc_html( $broker_designation ); ?>
													</h5>
											<?php } ?>

											<div class="expert-contacts">
												<ul>
													<?php if ( $broker_email ) { ?>
															<li>
																<a href="mailto:<?php echo $broker_email; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-envelop.svg"></a>
															</li>
													<?php } ?>

													<?php if ( $broker_contact_num ) { 
															$ph_number = preg_replace("/[^0-9]/", "", $broker_contact_num);
														?>
															<li>
																<a href="tel:<?php echo $ph_number; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-telephone.svg"></a>
															</li>
													<?php } ?>

													<?php if ( $social_medias ) {
														foreach ( $social_medias as $social_media ) { 
															$url = isset( $social_media['broker_sm_url'] ) && ! empty( $social_media['broker_sm_url'] ) ? $social_media['broker_sm_url'] : false;
															$target = isset( $social_media['borker_sm_target'] ) && ! empty( $social_media['borker_sm_target'] ) ? $social_media['borker_sm_target'] : false;
															$name = isset( $social_media['broker_sm_name'] ) && ! empty( $social_media['broker_sm_name'] ) ? $social_media['broker_sm_name'] : false;
														?>
															<li>
															<a href="<?php echo $url; ?>" target="<?php echo ( $target ) ? '_blank' : '_self'; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-<?php echo $name; ?>.svg" class="img-fluid"> </a>
															</li>
													<?php } 
													} ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
			<?php
			} else {
				echo esc_html__( 'No Brokers Found', 'finlease' );
			}
			?>
		</div>
	</div>
</div>