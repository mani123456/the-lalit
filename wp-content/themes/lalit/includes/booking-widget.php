<?php
$destinations_by_name = $GLOBALS['$destinations_by_name'];
?>

<form class="clearfix footer_booking_widget booking_widget nav_booking_widget" name="" action="#" method="post">
	<div class="row">
		<div class="col col9">
			<div class="row">
				<div class="col col4 errorDisplayDiv">
					<div>
						<label class="label">Hotel or Destination</label>
						<select class="select selecthotel" <?php if ($GLOBALS['location'][0]->slug != '') {
																echo 'disabled';
																echo ' style="/*background:none; background-color:transparent !important;*/"';
															} ?>>
							<option value="0" data-booking-url="-1">Select</option>
							<?php

							$i = 1;
							while ($destinations_by_name->have_posts()) {
								$destinations_by_name->the_post();
								$hotel_name = get_post_meta($post->ID, "name", true);
								$booking_engine = get_post_meta($post->ID, "booking_engine", true);
								$location_tax = wp_get_post_terms($post->ID, 'locations');
								$url = '';

								if ($booking_engine == 1) {
									$booking_engine_hotel_code = get_post_meta($post->ID, "booking_engine_hotel_code", true);
									$booking_engine_url = get_post_meta($post->ID, "booking_engine_url", true);
									$booking_engine_url = rtrim($booking_engine_url, '/');

									$url = $booking_engine_url . '/?Hotel=' . $booking_engine_hotel_code;

									if (trim($booking_engine_hotel_code) != '' && $booking_engine != 0 && trim($hotel_name) != '') {
							?>
										<option value="<?php echo $i; ?>" data-booking-engine="<?php echo $booking_engine; ?>" data-booking-url="<?php echo $url; ?>" <?php if ($GLOBALS['location'][0]->slug != '' && $location_tax[0]->slug == $GLOBALS['location'][0]->slug) {
																																											echo ' selected';
																																										} ?>><?php echo $hotel_name; ?></option>
									<?php
										$i++;
									}
								} else if ($booking_engine == 2) {
									$booking_engine_hotel_id = get_post_meta($post->ID, "booking_engine_hotel_id", true);
									$booking_engine_chain_id = get_post_meta($post->ID, "booking_engine_chain_id", true);
									$booking_engine_url = get_post_meta($post->ID, "booking_engine_url", true);
									$booking_engine_url = rtrim($booking_engine_url, '/');

									$url = $booking_engine_url . '?Hotel=' . $booking_engine_hotel_id . '&Chain=' . $booking_engine_chain_id . '&template=RBE&shell=RBE';
									if (trim($booking_engine_hotel_id) != '' && trim($booking_engine_chain_id) != '' && $booking_engine != 0 && trim($hotel_name) != '') {
									?>
										<option value="<?php echo $i; ?>" data-booking-engine="<?php echo $booking_engine; ?>" data-booking-url="<?php echo $url; ?>" <?php if ($GLOBALS['location'][0]->slug != '' && $location_tax[0]->slug == $GLOBALS['location'][0]->slug) {
																																											echo ' selected';
																																										} ?>><?php echo $hotel_name; ?></option>
									<?php
										$i++;
									}
								}
								else if ($booking_engine == 3) {
									$booking_engine_hotel_code = get_post_meta($post->ID, "booking_engine_hotel_code", true);
									$booking_engine_url = get_post_meta($post->ID, "booking_engine_url", true);
									$booking_engine_url = rtrim($booking_engine_url, '/');
									$url = $booking_engine_url;
									if (trim($booking_engine_hotel_code) != '' && $booking_engine != 0 && trim($hotel_name) != '') {
									?>
										<option value="<?php echo $i; ?>" data-booking-engine="<?php echo $booking_engine; ?>" data-booking-url="<?php echo $url; ?>" <?php if ($GLOBALS['location'][0]->slug != '' && $location_tax[0]->slug == $GLOBALS['location'][0]->slug) {
																																											echo ' selected';
																																										} ?>><?php echo $hotel_name; ?></option>
									<?php
										$i++;
									}
								}
							}
							wp_reset_postdata();
							?>
						</select><!--select-->
					</div>
				</div><!-- col4 -->

				<div class="col col2">
					<label class="label">Check-in</label>
					<div class="input-with-icon">
						<input type="text" class="input-text date-picker from" readonly='true' placeholder="Pick a Date" />
					</div><!--input-with-icon-->
				</div><!-- col col2 -->

				<div class="col col2">
					<label class="label">Check-out </label>
					<div class="input-with-icon">
						<input type="text" class="input-text date-picker to" readonly='true' placeholder="Pick a Date" />
					</div><!--input-with-icon-->
				</div><!-- col2 -->

				<div class="col col2">
					<label class="label">Guest</label>
					<select class="select adult">
						<option value="1">1 Adult</option>
						<option value="2" selected="selected">2 Adults</option>
						<option value="3">3 Adults</option>
						<option value="4">4 Adults</option>
						<!--<option value="5">5 Adults</option>-->
					</select><!--select-->
				</div><!-- col2 -->

				<div class="col col2">
					<label class="label">&nbsp;</label>
					<select class="select children">
						<option value="0">0 Child</option>
						<option value="1">1 Child</option>
						<option value="2">2 Children</option>
						<!--<option>3 Children</option>-->
					</select><!--select-->
				</div><!-- col col2 -->

				<div class="col col12 child-element" style="display: none;">
					<div class="row childrenAgeContainer">
						<div class="col col4">
							<span class="label">Please enter the age of each child you are booking for:</span>
						</div><!-- col4 -->

						<div class="span span2 errorDisplayDiv">
							<div class="age-child">
								<span class="label-child span span1">1:</span>
								<select class="span span12 input-age select_field_1">
									<option value="-1">-</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
								</select><!--select-->
							</div><!-- age-child -->
						</div><!-- span -->

						<div class="span span2 errorDisplayDiv">
							<div class="age-child">
								<span class="label-child span span1">2:</span>
								<select class="span span12 input-age select_field_2">
									<option value="-1">-</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
								</select><!--select-->
							</div><!-- age-child -->
						</div><!-- span -->
					</div><!-- row -->
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- col10 -->

		<div class="col col3">
			<div class="promocode vertical-promocode">
				<a href="#promocode-fill" class="vertical-promocode-link promocode-link promocode-fancybox">Have a promo code? </a>
			</div>
			<div class="vertical-promocode-display">
				<span class="promocode-tag">
					<i class="ico-sprite sprite size-16 ico-tag-promocode"></i>
				</span>
				<span class="promocode-display-text"></span>
				<span class="promocode-close">
					<i class="ico-sprite sprite size-12 ico-close-grey"></i>
				</span>
			</div>
			<label class="label available-label">&nbsp;</label>
			<button name="formSend" type="submit" class="btn primary-btn formSend form_submit_nav_widget">Check Availability</button>
			<div class="promocode horizontal-promocode">
				<a href="#promocode-fill" id="from-horizontal" class="horizontal-promocode-link promocode-link promocode-fancybox">Have a promo code? </a>
			</div>
			<div class="horizontal-promocode-display">
				<span class="promocode-tag">
					<i class="ico-sprite sprite size-16 ico-tag-promocode"></i>
				</span>
				<span class="promocode-display-text"></span>
				<span class="promocode-close">
					<i class="ico-sprite sprite size-12 ico-close-grey"></i>
				</span>
			</div>
		</div><!-- col3 -->
	</div><!-- row -->
	<div id="promocode-fill" class="pop-up" style="display: none;">
		<div class="promocode-container">
			<div class="promocode-header">
				<h2 class="page-title">Promo Code</h2>
			</div>
			<div class="promocode-container">
				<div class="row">
					<div class="col col8">
						<input type="text" name="promo-code" value="" size="20" class="input-text promocode-text book-stay-promo-text" aria-required="true" aria-invalid="false" placeholder="Enter Promo Code" autofocus>
					</div>
					<div class="colZero col4">
						<input type="button" value="Apply" class="btn promocode-btn promocode-submit">
					</div>
				</div>
				<p class="promocode-note">Please enter the promo code in the above field then click on apply button.</p>
				<span class="promocode-error">Please enter your promo code.</span>
			</div>
		</div>
		<div class="promocode-add" style="display:none;">
			<i class="ico-sprite sprite size-48 ico-check-with-circle"></i>
			<h3 class="promocode-add-title">Added Successfully !</h3>
			<p class="promocode-add-note">The promocode will be verified &amp; applied while booking.</p>
		</div>
	</div>
</form><!-- booking-widget -->