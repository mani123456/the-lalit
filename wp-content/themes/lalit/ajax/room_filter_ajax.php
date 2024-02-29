<?php
	 
	 $total_room_type_ids = explode(',', $_REQUEST['total_room_type_ids']);
	 $total_room_facility_ids = explode(',', $_REQUEST['total_room_facility_ids']);

	 //$room_type_ids = array();
	 //$room_facility_ids = array();
	 $room_type_ids = explode(',', rtrim($_REQUEST['room_types'],',') );
	 $room_facility_ids = explode(',', rtrim($_REQUEST['facilities'],',') );

	 $types = array();
	 if(!empty($total_room_type_ids) && !empty($room_type_ids))
	 {
	 	$types = array_intersect($total_room_type_ids, $room_type_ids);
	 }

	 $facilities = array();
	 if(!empty($total_room_facility_ids) && !empty($room_facility_ids))
	 {
	 	$facilities = array_intersect($total_room_facility_ids, $room_facility_ids);
	 }

	 //$types = implode(',', $types);
	 //$facilities = implode(',', $facilities);

	 $suites_and_rooms_object = get_suite_and_rooms_by_facilities_and_type($types, $facilities, $total_room_type_ids, $total_room_facility_ids);

	 if( $suites_and_rooms_object->have_posts() ) :
	 	 	$data = ''; 
   			while($suites_and_rooms_object->have_posts()) : $suites_and_rooms_object->the_post();


   				$room_name = get_post_meta( get_the_ID(), "name", true);
   				//echo $room_name.'<br/>';
				$room_description = get_post_meta( get_the_ID(), "description", true);
				if(strlen($room_description) > 150)
				{
					$room_description = substr($room_description, 0, 150).'...';
				}
				$room_images = get_post_meta( get_the_ID(), "images", true);
				$room_images = explode(",", $room_images);
				//$room_link = get_permalink(get_the_ID());
				foreach($room_images as $room_image_id)
				{
					$room_image = wp_get_attachment_url($room_image_id);
				}
				$room_features = get_post_meta( get_the_ID(), "room_features", true);
				$room_base_price = get_post_meta( get_the_ID(), "base_price", true);
				$extra_bed = get_post_meta( get_the_ID(), "extra_bed", true);

				$adults = get_post_meta( get_the_ID(), "adults", true);
				$child = get_post_meta( get_the_ID(), "child", true);

				/*$room_type_obj = get_the_terms(get_the_ID(), 'room_type');
				if(isset($room_type_obj) && count($room_type_obj) > 0)
				{
					foreach($room_type_obj as $room_types)
					{
						$term_id = $room_types->term_id;
						$room_type = $room_types->name;
					}
				}

				$room_facility_obj = get_the_terms(get_the_ID(), 'room_facility');
				if(isset($room_facility_obj) && count($room_facility_obj) > 0)
				{
					foreach($room_facility_obj as $room_facilities)
					{
						$term_id = $room_facilities->term_id;
						$room_facility = $room_facilities->name;
						$room_facility_ids[] = $term_id;
					}
				}*/
					
		$data .= '<div class="room-items">
                        <div class="row">
                            <div class="col col3">
                                <img src="'.$room_image.'" class="rooms-img">
                                <div class="guest-type">
                                    <span>
                                        <i class="sprite"></i>
                                        <span class="guest noofchildren">Adults '.$adults.'</span>
                                    </span>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <span>
                                        <i class="sprite"></i>
                                        <span class="guest noofchildren">Children '.$child.'</span>
                                    </span>
                                </div><!-- guest-type -->
                            </div><!-- col -->

                            <div class="col col9">
                                <div class="room-items-info">
                                    <h4 class="sec-title">'.$room_name.'</h4>
                                    <p class="room-discp">'.$room_description.' <a href="#" class="read-more">Read More<i class="sprite"></i></a></p>

                                    <div class="row room-book-blk">
                                        <div class="col col3">
                                            <div class="price-lbl">
                                                <span class="price-label">From</span>
                                                <strong class="amount-lbl"><span class="lbl-currency">INR</span> '.number_format($room_base_price).'</strong> 
                                            </div><!-- price-lbl -->
                                        </div><!-- col -->

                                        <div class="col col2">
                                            <button type="button" class="btn primary-btn">Book Now</button>
                                        </div><!-- col -->
                                    </div><!-- row -->
                                </div><!-- room-items-info -->     
                            </div><!-- col -->                                        
                        </div><!-- row -->    
                    </div><!-- room-items -->';

   			endwhile;

   			$room_type_ids = array();
			$room_facility_ids = array();
   			$types = get_terms('room_type');
            $facilities = get_terms('room_facility');

            foreach($types as $type)
            {
            	$room_type_ids[] = $type->term_id;
            }

            foreach($facilities as $facility)
            {
            	$room_facility_ids[] = $facility->term_id;
            }

   			$data .= '<input type="hidden" id="total_types" value="'.implode(',', array_unique($room_type_ids)).'" />
					 <input type="hidden" id="total_facilities" value="'.implode(',', array_unique($room_facility_ids)).'" />';
   	else:
   			$data = '<input type="hidden" id="total_types" value="'.implode(',', array_unique($room_type_ids)).'" />
					 <input type="hidden" id="total_facilities" value="'.implode(',', array_unique($room_facility_ids)).'" />';
   		 	$data .= '<h3 class="no_rooms">No Rooms Found.</h3>';
   	endif;


   	wp_send_json_success($data);
?>