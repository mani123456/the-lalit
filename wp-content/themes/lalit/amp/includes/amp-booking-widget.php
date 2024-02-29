<?php
/**
 * 
 * This is the booking widget markup used in the amp-header.php file
 */
?>

<amp-accordion id="booking-widget-accordion" animate class="book-stay-accordion">
	<section>
		<h4 class="btn tertiary-btn mobile-book-stay">Book A Stay</h4>
		<div class="book-stay-container">
			<div class="col col4">
				<ul class="unstyled-listing h-card">
					<?php

						$i = 1;
						foreach($GLOBALS['locations_array'] as $location){

							$destinations_by_taxonomy = get_destination_by_taxanomy('locations', $location->term_id);
							
							while($destinations_by_taxonomy->have_posts())
							{
								//$terms = get_the_terms( get_the_ID(), '' );echo "<pre>";print_r($terms);exit;
								$destinations_by_taxonomy->the_post();
								//$hotel_name = get_post_meta( $post->ID, "name", true);
								$booking_engine = get_post_meta( $post->ID, "booking_engine", true);
								$location_tax = wp_get_post_terms($post->ID,'locations');
								$url = '';

								if($booking_engine == 1)
								{
									$booking_engine_hotel_code = get_post_meta( $post->ID, "booking_engine_hotel_code", true);
									$booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
									$booking_engine_url = rtrim($booking_engine_url, '/');

									if(trim($booking_engine_hotel_code) != '' && $booking_engine != 0)
									{
										$url = $booking_engine_url.'/?Hotel='.$booking_engine_hotel_code;
										?>
										<li class="list-item"><a on="tap:AMP.setState({visited_<?php echo $booking_engine_hotel_code; ?>: !visited_<?php echo $booking_engine_hotel_code; ?>})" [class]="visited_<?php echo $booking_engine_hotel_code; ?> ? 'active' : ''" class="p-name u-url" href="<?php echo $url; ?>"><?php echo $location_tax[0]->name; ?></a></li>
										<?php
									}
								}
								else if($booking_engine == 2)
								{
									
									$booking_engine_hotel_id = get_post_meta( $post->ID, "booking_engine_hotel_id", true);
									$booking_engine_chain_id = get_post_meta( $post->ID, "booking_engine_chain_id", true);
									$booking_engine_url = get_post_meta( $post->ID, "booking_engine_url", true);
									$booking_engine_url = rtrim($booking_engine_url, '/');

									if(trim($booking_engine_hotel_id) != '' && trim($booking_engine_chain_id) != '' && $booking_engine != 0)
									{
										$url = $booking_engine_url.'?Hotel='.$booking_engine_hotel_id.'&Chain='.$booking_engine_chain_id;
										?>
										<li class="list-item"><a on="tap:AMP.setState({visited_<?php echo $booking_engine_hotel_id; ?>: !visited_<?php echo $booking_engine_hotel_id; ?>})" [class]="visited_<?php echo $booking_engine_hotel_id; ?> ? 'active' : ''" class="p-name u-url" href="<?php echo $url; ?>"><?php echo $location_tax[0]->name; ?></a></li>
										<?php
									}
								}
								if($i % 5 == 0)
								{
									?>
										</ul><!-- unstyled-listing -->
									</div><!-- col -->
									<div class="col col4">
										<ul class="unstyled-listing h-card">
									<?php
								}
								$i++;
							}
							wp_reset_postdata();
						}
					?>
				</ul><!-- unstyled-listing -->
			</div><!-- col -->
		</div>
	</section>
</amp-accordion>