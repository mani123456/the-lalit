<?php

//remove_action('template_redirect', 'redirect_canonical');

/*add_filter('aioseop_canonical_url','remove_canonical_url', 10, 1);
function remove_canonical_url( $url )
{
	global $post;
 	if( $post->ID === 4036)
 	{
 		return false; // Remove the canonical URL for post #2.
 	}
 	return $url;
}*/

/**
 * get browser details - START
 */
function getBrowser()
{
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version = "";

	//First get the platform?
	if (preg_match('/linux/i', $u_agent)) {
		$platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		$platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	} elseif (preg_match('/Firefox/i', $u_agent)) {
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	} elseif (preg_match('/Chrome/i', $u_agent)) {
		$bname = 'Google Chrome';
		$ub = "Chrome";
	} elseif (preg_match('/Safari/i', $u_agent)) {
		$bname = 'Apple Safari';
		$ub = "Safari";
	} elseif (preg_match('/Opera/i', $u_agent)) {
		$bname = 'Opera';
		$ub = "Opera";
	} elseif (preg_match('/Netscape/i', $u_agent)) {
		$bname = 'Netscape';
		$ub = "Netscape";
	}

	// finally get the correct version number
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count($matches['browser']);
	if ($i != 1) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
			$version = $matches['version'][0];
		} else {
			$version = $matches['version'][1];
		}
	} else {
		$version = $matches['version'][0];
	}

	// check if we have a number
	if ($version == null || $version == "") {
		$version = "?";
	}

	return array(
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'    => $pattern
	);
}
/**
 * get browser details - START
 */



/** 
 * Remove plugin styles and scripts - START
 */
add_action('wp_print_styles', 'the_lalit_dequeue_css_from_plugins', 100);
function the_lalit_dequeue_css_from_plugins()
{
	wp_dequeue_style("jquery-ui-theme");
	wp_dequeue_style("jquery-ui-timepicker");
	wp_dequeue_style("font-awesome");
	wp_dequeue_style("contact-form-7");
	wp_dequeue_style("wcff-style");
	wp_dequeue_style("spectrum-css");
	wp_dequeue_style("wccpf-jquery-ui-css");
	wp_dequeue_style("time-picker-addon");
}
add_action('wp_print_scripts', 'the_lalit_dequeue_scripts_from_plugins', 100);
function the_lalit_dequeue_scripts_from_plugins()
{
	wp_dequeue_script('wccpf-color-picker');
	wp_dequeue_script('wccpf-front-end');
}
/** 
 * Remove plugin styles and scripts - END
 */




/** 
 * Remove emoji styles and scripts - START
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
/** 
 * Remove emoji styles and scripts - END
 */




/** 
 * Add additional image sizes - START
 */
add_image_size('banner_image', '924', '519');
add_image_size('detail_page_image', '820', '421');
add_image_size('listing_page_image', '610', '343');
add_image_size('box_image', '400', '400');
/** 
 * Add additional image sizes - END
 */


/** 
 * Hide admin toolbar for logged in users - START
 */
show_admin_bar(false);
/** 
 * Hide admin toolbar for logged in users - START
 */




/************************************************************************************************************
 *																										   *
 *								                Site functions 										       *
 *        																								   *
/************************************************************************************************************/

/** 
 * function for checking user agent (Mobile) - START
 */
function isMobile()
{
	$useragent = $_SERVER['HTTP_USER_AGENT'];

	if (preg_match('/(iPhone|iPod|android|blackberry|windows|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
		return true;
	} else {
		return false;
	}
}
/** 
 * function for checking user agent (Mobile) - END
 */




/** 
 * function for checking user agent (IPad) - START
 */
function isIPad()
{
	if (preg_match('#\b(ipad|tablet|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'])) {
		return true;
	} else {
		return false;
	}
}
/** 
 * function for checking user agent (IPad) - END
 */




/** 
 * Functions for location content type - START
 */
function get_location_object($count = '-1')
{
	$args = array(
		'post_type' => 'location',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_location_by_id($key, $value)
{
	$args = array(
		'post_type' => 'location',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => $key,
				'value' => $value,
				'compare' => '=',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_location_by_city_country($country, $key, $value)
{
	$args = array(
		'post_type' => 'location',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key'     => 'country',
				'value'   => $country,
				'compare' => '=',
			),
			array(
				'key' => $key,
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for location content type - END
 */


/** 
 * Functions for destination content type - START
 */
function get_destination_object($count = '-1')
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_destination_object_loyalty($count = '-1')
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'posts_per_page' => $count,
		'tax_query' => array(
			array(
				'taxonomy' => 'locations',
				'field'    => 'slug',
				'terms'    => array('london', 'mangar'),
				'operator' => 'NOT IN'
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_destination_object_by_name($count = '-1')
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'posts_per_page' => $count,
		'orderby' => 'meta_value',
		'meta_key' => 'name'
	);

	return $loop = new WP_Query($args);
}

function get_destination_by_feature_id($key, $value)
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => $key,
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_destination_by_taxanomy($taxanomy, $term)
{
	if (is_array($term)) {
		$args = array(
			'post_type' => 'destination',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => $taxanomy,
					'field'    => 'term_id',
					'terms'    => $term,
					'operator' => 'IN'
				)
			)
		);

		return $loop = new WP_Query($args);
	} else {
		$args = array(
			'post_type' => 'destination',
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => $taxanomy,
					'field'    => 'term_id',
					'terms'    => $term
				)
			)
		);

		return $loop = new WP_Query($args);
	}
}

function get_destination_by_award_id($value)
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'hotel_awards',
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_destination_by_banner_id($value)
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'banner_images',
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_destination_by_dining_id($value)
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'dinings',
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_destination_by_experience_id($id)
{
	$args = array(
		'post_type' => 'destination',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'hotel_experiences',
				'value' => $id,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for destination content type - END
 */


/** 
 * Functions for Suites and Room content type - START
 */
function get_suite_and_room_object($count = '-1')
{
	$args = array(
		'post_type' => 'suite-and-room',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_suite_and_room_by_destination($post_id)
{
	$rooms = get_field('suites_and_rooms', $post_id, true);

	$count = 0;
	$room_ids = array();
	foreach ($rooms as $room) {
		$room_ids[$count] = $room->ID;
		$count++;
	}

	$args = array(
		'post_type' => 'suite-and-room',
		'post_status' => 'publish',
		'post__in' => $room_ids
	);
	return $loop = new WP_Query($args);
}

function get_suite_and_rooms_by_room_types($room_type_ids)
{
	$args = array(
		'post_type' => 'suite-and-room',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'room_type',
				'value' => $room_type_ids,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_suite_and_rooms_by_room_facilities($room_facility_ids)
{
	$meta_query = array('relation' => 'OR');
	foreach ($room_facility_ids as $id) {
		$meta_query[] = array(
			'key' => 'room_facilities',
			'value' => $id,
			'compare' => 'LIKE',
		);
	}
	$args = array(
		'post_type' => 'suite-and-room',
		'post_status' => 'publish',
		'order' => 'ASC',
		'meta_query' => $meta_query
	);

	return $loop = new WP_Query($args);
}

function get_suite_and_rooms_by_facilities_and_type($types, $facilities, $total_types, $total_facilities)
{
	//$types = explode(',', $types);
	//$facilities = explode(',', $facilities);

	if (!empty($types) && empty($facilities)) {
		$tax_query = array('relation' => 'OR');
		foreach ($types as $id) {
			$tax_query[] = array(
				array(
					'taxonomy' => 'room_type',
					'field'    => 'term_id',
					'terms'    => array($id),
					'operator' => 'IN'
				)
			);
		}
		$args = array(
			'post_type' => 'suite-and-room',
			'post_status' => 'publish',
			'order' => 'ASC',
			'tax_query' => $tax_query

		);
	} else if (empty($types) && !empty($facilities)) {
		$tax_query = array('relation' => 'OR');
		foreach ($facilities as $id) {
			$tax_query[] = array(
				array(
					'taxonomy' => 'room_facility',
					'field'    => 'term_id',
					'terms'    => array($id),
					'operator' => 'IN'
				)
			);
		}
		$args = array(
			'post_type' => 'suite-and-room',
			'post_status' => 'publish',
			'order' => 'ASC',
			'tax_query' => $tax_query

		);
	} else if (!empty($types) && !empty($facilities)) {


		$args = array(
			'post_type' => 'suite-and-room',
			'post_status' => 'publish',
			'order' => 'ASC',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					array(
						'taxonomy' => 'room_type',
						'field'    => 'term_id',
						'terms'    => $types,
						'operator' => 'IN'
					)
				),
				array(
					array(
						'taxonomy' => 'room_facility',
						'field'    => 'term_id',
						'terms'    => $facilities,
						'operator' => 'IN'
					)
				)
			)
		);
	} else {
		$args = array(
			'post_type' => 'suite-and-room',
			'post_status' => 'publish',
			'order' => 'ASC',
			'tax_query' => array(
				'relation' => 'OR',
				array(
					array(
						'taxonomy' => 'room_type',
						'field'    => 'term_id',
						'terms'    => $total_types,
						'operator' => 'IN'
					)
				),
				array(
					array(
						'taxonomy' => 'room_facility',
						'field'    => 'term_id',
						'terms'    => $total_facilities,
						'operator' => 'IN'
					)
				)
			)
		);
	}

	return $loop = new WP_Query($args);
}
/** 
 * Functions for Suites and Room content type - END
 */


/** 
 * Function for Press Releases - START
 */
function get_press_rooms($post_type, $date_key)
{
	$args = array(
		'post_type' => $post_type,
		'post_status' => 'publish',
		'order' => 'DESC',
		'orderby' => 'meta_value',
		'meta_key' => $date_key,
		'posts_per_page' => '-1'
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for Press Releases - END
 */


/** 
 * Function for careers - START
 */
function get_jobs_by_taxonomy($post_type, $taxonomy, $term)
{
	$args = array(
		'post_type' => $post_type,
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'position_open',
				'value' => '1',
				'compare' => 'NOT LIKE',
			)
		),
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $term,
				'operator' => 'IN',
			)
		),
		'order' => 'ASC',
		'orderby' => 'meta_value',
		'meta_key' => 'job_title',
		'posts_per_page' => '-1'
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for careers - END
 */


/** 
 * Functions for Dining content type - START
 */
function get_dining_object($count = '-1')
{
	$args = array(
		'post_type' => 'dining',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_dinings_by_destination($post_id)
{
	$dinings = get_field('dinings', $post_id, true);
	$count = 0;
	$dining_ids = array();
	foreach ($dinings as $dining) {
		$dining_ids[$count] = $dining->ID;
		$count++;
	}
	$args = array(
		'post_type' => 'dining',
		'post_status' => 'publish',
		'post__in' => $dining_ids
	);
	return $loop = new WP_Query($args);
}

function get_home_page_dinings()
{
	$args = array(
		'post_type' => 'dining',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'is_featured',
				'value' => true,
				'compare' => '=',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for Dining content type - END
 */



/** 
 * Functions for facility content type - START
 */
function get_facility_object($count = '-1')
{
	$args = array(
		'post_type' => 'facility',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_facilities_by_destination($post_id)
{
	$facilities = get_field('facilities', $post_id, true);
	$count = 0;
	$facility_ids = array();
	foreach ($facilities as $facility) {
		$facility_ids[$count] = $facility->ID;
		$count++;
	}
	$args = array(
		'post_type' => 'facility',
		'post_status' => 'publish',
		'post__in' => $facility_ids
	);
	return $loop = new WP_Query($args);
}
/** 
 * Functions for facility content type - END
 */



/** 
 * Functions for Meeting and Events content type - START
 */
function get_meeting_and_event_object($count = '-1')
{
	$args = array(
		'post_type' => 'meeting-and-event',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_meeting_and_events_by_destination($post_id)
{
	$meetings = get_field('meetings_and_events', $post_id, true);
	$count = 0;
	$meeting_ids = array();
	foreach ($meetings as $meeting) {
		$meeting_ids[$count] = $meeting->ID;
		$count++;
	}
	$args = array(
		'post_type' => 'meeting-and-event',
		'post_status' => 'publish',
		'post__in' => $meeting_ids
	);
	return $loop = new WP_Query($args);
}
/** 
 * Functions for Meeting and Events content type - END
 */



/** 
 * Functions for photo gallery content type - START
 */
function get_photo_gallery_object($count = '-1')
{
	$args = array(
		'post_type' => 'photo-gallery',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_photo_galleries_by_destination($count = '-1')
{
	$galleries = get_field('photo_galleries', $post_id, true);
	$count = 0;
	$gallery_ids = array();
	foreach ($galleries as $gallery) {
		$gallery_ids[$count] = $gallery->ID;
		$count++;
	}
	$args = array(
		'post_type' => 'photo-gallery',
		'post_status' => 'publish',
		'post__in' => $gallery_ids
	);
	return $loop = new WP_Query($args);
}
/** 
 * Functions for photo gallery content type - END
 */



/** 
 * Functions for city attraction content type - START
 */
function get_city_attraction_object($count = '-1')
{
	$args = array(
		'post_type' => 'city-attraction',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_city_attractions_by_destination($post_id)
{
	$city_attractions = get_field('city_attractions', $post_id, true);
	$count = 0;
	$city_attraction_ids = array();
	foreach ($city_attractions as $city_attraction) {
		$city_attraction_ids[$count] = $city_attraction->ID;
		$count++;
	}
	$args = array(
		'post_type' => 'city-attraction',
		'post_status' => 'publish',
		'post__in' => $city_attraction_ids
	);
	return $loop = new WP_Query($args);
}

function get_city_attractions_by_category($attraction_ids, $category_id)
{
	$meta_query = array(
		array(
			'key' => 'city_attraction_category',
			'value' => $category_id,
			'compare' => 'LIKE',
		)
	);

	$args = array(
		'post_type' => 'city-attraction',
		'post_status' => 'publish',
		'post__in' => $attraction_ids,
		'meta_query' => $meta_query,
		'orderby' => 'name',
		'order' => 'ASC'

	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for city attraction content type - END
 */



/** 
 * Functions for wedding content type - START
 */
function get_wedding_object($count = '-1')
{
	$args = array(
		'post_type' => 'wedding',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_weddings_by_type($value)
{
	$args = array(
		'post_type' => 'wedding',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'wedding_type',
				'value' => $value,
				'compare' => '=',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for wedding content type - END
 */



/** 
 * Functions for careers content type - START
 */
function get_career_object($count = '-1')
{
	$args = array(
		'post_type' => 'career',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_careers_by_department($value)
{
	$args = array(
		'post_type' => 'career',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'career_department',
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_careers_by_location($value)
{
	$args = array(
		'post_type' => 'career',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'location',
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for careers content type - END
 */



/** 
 * Functions for award content type - START
 */
function get_award_object($count = '-1')
{
	$args = array(
		'post_type' => 'award',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_award_by_destination($value)
{
	$args = array(
		'post_type' => 'award',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'hotels',
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for award content type - END
 */


/** 
 * Function to get homepage awards - START
 */
function get_home_page_awards()
{
	$args = array(
		'post_type' => 'award',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'is_featured',
				'value' => true,
				'compare' => '=',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function to get homepage awards - START
 */



/*function for testimonial object*/
function get_testimonial_object($count = '-1')
{
	$args = array(
		'post_type' => 'testimonial',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_testimonials_by_page($page_id)
{
	$args = array(
		'post_type' => 'testimonial',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'pages',
				'value' => $page_id,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}



/** 
 * Functions for destination type content type - START
 */
function get_destination_type_object($count = '-1')
{
	$args = array(
		'post_type' => 'destination-type',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_destination_type_by_id($key, $value)
{
	$args = array(
		'post_type' => 'destination-type',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => $key,
				'value' => $value,
				'compare' => '=',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for destination type content type - END
 */



/** 
 * Function for room type content type - START
 */
function get_room_type_object($count = '-1')
{
	$args = array(
		'post_type' => 'room-type',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for room type content type - END
 */



/** 
 * Function for room facilities content type - START
 */
function get_room_facilities_object($count = '-1')
{
	$args = array(
		'post_type' => 'room-facility',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for room facilities content type - END
 */



/** 
 * Function for career department content type - START
 */
function get_career_department_object($count = '-1')
{
	$args = array(
		'post_type' => 'career-department',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for career department content type - END
 */




/** 
 * Functions for offers content type - START
 */
function get_offer_object($count = '-1')
{
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_offer_by_id($id)
{
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'post__in' => array($ids),
	);

	return $loop = new WP_Query($args);
}

function get_offers_by_destination($key, $value)
{
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
		'meta_query' => array(
			array(
				'key' => $key,
				'value' => $value,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_offers_by_spa_events($key, $value, $count = -1)
{
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'offer_type',
				'value' => array(3, 4),
				'compare' => 'IN',
			),
			array(
				'key' => $key,
				'value' => $value,
				'compare' => 'LIKE'
			)
		),
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_offers_by_type($value, $hotel_id, $count = -1)
{
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'offer_type',
				'value' => $value,
				'compare' => '=',
			),
			array(
				'key' => 'hotel',
				'value' => $hotel_id,
				'compare' => 'LIKE'
			)
		),
		'posts_per_page' => $count
	);

	return $loop = new WP_Query($args);
}

function get_offers_by_room($hotel_id, $room_id, $count = -1)
{
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'offer_type',
				'value' => '1',
				'compare' => '=',
			),
			array(
				'key' => 'hotel',
				'value' => $hotel_id,
				'compare' => 'LIKE',
			),
			array(
				'key' => 'rooms',
				'value' => $room_id,
				'compare' => 'LIKE',
			)
		),
		'posts_per_page' => $count
	);

	return $loop = new WP_Query($args);
}

function get_offers_by_dining($hotel_id, $dining_id, $count = -1)
{
	$args = array(
		'post_type' => 'offer',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'offer_type',
				'value' => '2',
				'compare' => '=',
			),
			array(
				'key' => 'hotel',
				'value' => $hotel_id,
				'compare' => 'LIKE',
			),
			array(
				'key' => 'dinings',
				'value' => $dining_id,
				'compare' => 'LIKE',
			)
		)
	);

	return $loop = new WP_Query($args);
}
/** 
 * Functions for offers content type - END
 */




/** 
 * Functions for banners content type - START
 */
function get_banner_by_taxonomy($banner_ids, $taxonomy, $count = -1)
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
			//'operator' => '='
		)
	);

	$args = array(
		'post_type' => 'banner',
		'post_status' => 'publish',
		'post__in' => $banner_ids,
		'orderby'  => 'date',
		'order' => 'DESC',
		'tax_query' => $tax_query,
		'posts_per_page' => $count

	);

	return $loop = new WP_Query($args);
}

function get_home_page_banners()
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => 'property_overview',
		)
	);

	$meta_query  = array(
		array(
			'key'     => 'is_featured',
			'value'   => true,
			'compare' => '=',
		)
	);

	$args = array(
		'post_type' => 'banner',
		'post_status' => 'publish',
		'orderby'  => 'is_featured',
		'tax_query' => $tax_query,
		'meta_query' => $meta_query

	);

	return $loop = new WP_Query($args);
}

function get_page_overview_banners($banner_ids = '', $taxonomy = 'property_overview')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$meta_query  = array(
			array(
				'key'     => 'is_featured',
				'value'   => true,
				'compare' => '=',
			)
		);

		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}
/** 
 * Functions for banners content type - END
 */


/** 
 * Functions for banners content type - END
 */

function get_lalit_deliver_banners($taxonomy = 'lalit-delivers', $banner_ids = '')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$meta_query  = array(
			array(
				'key'     => 'is_featured',
				'value'   => true,
				'compare' => '=',
			)
		);

		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}

function get_we_care_banners($taxonomy = 'we_care_banner', $banner_ids = '')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$meta_query  = array(
			array(
				'key'     => 'is_featured',
				'value'   => true,
				'compare' => '=',
			)
		);

		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}
function get_wedding_at_lalit_banners($taxonomy = 'wedding_at_lalit', $banner_ids = '')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$meta_query  = array(
			array(
				'key'     => 'is_featured',
				'value'   => true,
				'compare' => '=',
			)
		);

		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}
function get_home_experience_banners($taxonomy = 'home_experience', $banner_ids = '')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$meta_query  = array(
			array(
				'key'     => 'is_featured',
				'value'   => true,
				'compare' => '=',
			)
		);

		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}
function get_popular_offers_banners($taxonomy = 'popular_offers', $banner_ids = '')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$meta_query  = array(
			array(
				'key'     => 'is_featured',
				'value'   => true,
				'compare' => '=',
			)
		);

		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}
/** 
 * Functions for banners content type - END
 */





/** 
 * Function for brand values content type - START
 */
function get_brand_values($count = '3')
{
	$args = array(
		'post_type' => 'brand-value',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for brand values content type - END
 */




/** 
 * Function for with the lalit content type - START
 */
function get_with_lalit($count = '-1')
{
	$args = array(
		'post_type' => 'with-the-lalit',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function for with the lalit content type - END
 */



/** 
 * Function to get home page services - START
 */
function get_home_page_services()
{
	$meta_query  = array(
		array(
			'key'     => 'is_featured',
			'value'   => true,
			'compare' => '=',
		)
	);

	$args = array(
		'post_type' => 'hotel-service',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
		'meta_query' => $meta_query
	);

	return $loop = new WP_Query($args);
}
/** 
 * Function to get home page services - END
 */



/** 
 * Function for experience content type - START
 */
function get_experience_object($count = '-1')
{
	$args = array(
		'post_type' => 'experience',
		'post_status' => 'publish',
		'posts_per_page' => $count,
	);

	return $loop = new WP_Query($args);
}

function get_home_page_experiences()
{
	$meta_query  = array(
		array(
			'key'     => 'is_featured',
			'value'   => true,
			'compare' => '=',
		)
	);

	$args = array(
		'post_type' => 'experience-category',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
		'meta_query' => $meta_query
	);

	return $loop = new WP_Query($args);
}

function get_experience_by_category($id)
{
	$meta_query  = array(
		array(
			'key'     => 'experience_category',
			'value'   => $id,
			'compare' => '=',
		)
	);
	$args = array(
		'post_type' => 'experience',
		'post_status' => 'publish',
		'posts_per_page' => '-1',
		'meta_query' => $meta_query
	);
	return $loop = new WP_Query($args);
}
/** 
 * Function for experience content type - END
 */


function get_covid_data()
{
	$args = array(
		'post_type' => 'we-care-post',
		'post_status' => 'publish',
		'posts_per_page' => '100',
		'meta_query' => array(
			array(
				'key' => 'is_featured',
				'value' => true,
				'compare' => '=',
			)
		)
	);

	return $loop = new WP_Query($args);
}

function get_we_care_new()
{
	$args = array(
		'post_type' => 'we-care-post-new',
		'post_status' => 'publish',
		'posts_per_page' => '100'
	);

	return $loop = new WP_Query($args);
}

function get_page_banners_by_taxomany_all($taxonomy = 'delivery-main-banner', $banner_ids = '')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}

/** 
 * Functions for banners content type - END
 */

function get_page_banners_by_taxomany($taxonomy = 'delivery-main-banner', $banner_ids = '')
{
	$tax_query = array(
		array(
			'taxonomy' => 'banner-type',
			'field'    => 'slug',
			'terms'    => $taxonomy,
		)
	);


	if ($banner_ids == '') {
		$meta_query  = array(
			array(
				'key'     => 'is_featured',
				'value'   => true,
				'compare' => '=',
			)
		);

		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	} else {
		$args = array(
			'post_type' => 'banner',
			'post_status' => 'publish',
			'post__in' => $banner_ids,
			'tax_query' => $tax_query,
			'orderby' => 'date',
			'order' => 'desc'

		);
	}

	return $loop = new WP_Query($args);
}
/** 
 * Functions for banners content type - END
 */

/** 
 * Function to get attachment - START
 */
function wp_get_attachment($attachment_id)
{
	$attachment = get_post($attachment_id);
	return array(
		'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink($attachment->ID),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}
/** 
 * Function to get attachment - END
 */


/************************************************************************************************************
 *																										   *
 *								            Site functions Ends										       *
 *        																								   *
/************************************************************************************************************/





/************************** Custom Menu *************************/

/*function register_my_menus() 
{
	register_nav_menus(
	    array(
	      'super-nav' => __( 'Super Navigation' ),
	      'global-nav' => __( 'Global Navigation' ),
	      'hotel-global-nav' => __( 'Hotel Global Navigation' ),
	      'hotel-secondary-nav-delhi' => __( 'Hotel Secondary Navigation Delhi' ),
	      'hotel-secondary-nav-mumbai' => __( 'Hotel Secondary Navigation Mumbai' ),
	      'hotel-secondary-nav-bangalore' => __( 'Hotel Secondary Navigation Bangalore' ),
	      'hotel-secondary-nav-kolkata' => __( 'Hotel Secondary Navigation Kolkata' ),
	      'hotel-secondary-nav-jaipur' => __( 'Hotel Secondary Navigation Jaipur' ),
	      'hotel-secondary-nav-goa' => __( 'Hotel Secondary Navigation Goa' ),
	      'hotel-secondary-nav-chandigarh' => __( 'Hotel Secondary Navigation Chandigarh' ),
	      'hotel-secondary-nav-udaipur' => __( 'Hotel Secondary Navigation Udaipur' ),
	      'hotel-secondary-nav-khajuraho' => __( 'Hotel Secondary Navigation Khajuraho' ),
	      'hotel-secondary-nav-srinagar' => __( 'Hotel Secondary Navigation Srinagar' ),
	      'hotel-secondary-nav-bekal' => __( 'Hotel Secondary Navigation Bekal' ),
	      'hotel-secondary-nav-mangar' => __( 'Hotel Secondary Navigation Mangar' ),
	      'hotel-secondary-nav-london' => __( 'Hotel Secondary Navigation London' ),
	    )
	);
}
add_action( 'init', 'register_my_menus' );*/

/************************** Custom Menu Ends *************************/





/** 
 * Add script and css into admin dashboard - START
 */
add_action('admin_head', 'admin_css');
function admin_css()
{
	echo '<link rel="stylesheet" type="text/css" href="/wp-content/themes/lalit/admin-css/admin.css">';
	echo "\n";
}

//code to add js into dashboard
add_action('admin_enqueue_scripts', 'add_js');
function add_js()
{
	wp_enqueue_script('custom_js_script', '/wp-content/themes/lalit/admin-js/admin.js');
}

add_action('wp_head', 'add_lalit_css');
function add_lalit_css()
{
	//$browser = getBrowser();
	/*if (is_safari() || is_ie())
	{
	   	echo 	"<style>
	   				@font-face {
	   					font-family:weathericons;
			    		src:url('/wp-content/themes/lalit/font/weathericons-regular-webfont.woff');
			    	}
				</style>";
	}
	else
	{*/
	if (function_exists('is_amp_endpoint') &&  !is_amp_endpoint()) {
		echo 	"<style>
						@font-face {
							font-family:weathericons;
							src:url('/wp-content/themes/lalit/font/weathericons-regular-webfont.woff');
						}
					</style>";
	}
	//}

	echo '<link href="https://fonts.googleapis.com/css?family=Prata|Roboto:300,400,500,700" rel="stylesheet">';
	echo "\n";
	if (function_exists('is_amp_endpoint') && !is_amp_endpoint()) {

		echo '<link type="text/css" rel="stylesheet" href="/wp-content/themes/lalit/stylesheets/css/lalit-base.min.css?ver=1.10.6" media="all" />';
	}

	echo "\n";
	if ((function_exists('is_amp_endpoint') &&  !is_amp_endpoint())) {

		echo "<script>
				if(screen.width <= 992){
					var link = document.createElement('link');
					link.href = '/wp-content/themes/lalit/stylesheets/css/mobile-nav.min.css?ver=1.10.1';
					link.rel = 'stylesheet';
					document.getElementsByTagName('head')[0].appendChild(link);
				}
			</script>";
		//echo '<link async type="text/css" rel="stylesheet" href="/wp-content/themes/lalit/stylesheets/css/mobile-nav.min.css" media="all" />';
		echo "\n";
	}
}
/** 
 * Add script and css into admin dashboard - END
 */



/** 
 * Metabox class - START
 */
get_template_part('meta-box-class/my', 'meta-box-class');
if (is_admin()) {
	/* configure your getting here meta box */
	$getting_here_config = array(
		'id' => 'service_meta_box',             // meta box id, unique per meta box 
		'title' => 'Getting Here', // meta box title
		'pages' => array('destination'),    // post types, accept custom post types as well, default is array('post'); optional
		'context' => 'advanced',               // where the meta box appear: normal (default), advanced, side; optional
		'priority' => 'low',                // order of meta box: high (default), low; optional
		'fields' => array(),                 // list of meta fields (can be added by field arrays) or using the class's functions
		'local_images' => true,             // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true            //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	/* Initiate your getting here meta box */
	$getting_here_meta =  new AT_Meta_Box($getting_here_config);

	/* Add fields to your getting here meta box */
	$repeater_fields[] = $getting_here_meta->addText('heading', array('name' => 'Heading'), true);
	$repeater_fields[] = $getting_here_meta->addText('value', array('name' => 'Value'), true);
	$getting_here_meta->addRepeaterBlock('getting_here', array('inline' => true, 'name' => '', 'fields' => $repeater_fields));

	/* Finish getting here Meta Box Declaration */
	$getting_here_meta->Finish();




	/* configure your experience inclusion meta box */
	$experience_config = array(
		'id' => 'service_meta_box',             // meta box id, unique per meta box 
		'title' => 'Inclusions', // meta box title
		'pages' => array('experience'),    // post types, accept custom post types as well, default is array('post'); optional
		'context' => 'normal',               // where the meta box appear: normal (default), advanced, side; optional
		'priority' => 'high',                // order of meta box: high (default), low; optional
		'fields' => array(),                 // list of meta fields (can be added by field arrays) or using the class's functions
		'local_images' => true,             // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true            //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	/* Initiate your experience inclusion meta box */
	$experience_meta = new AT_Meta_Box($experience_config);

	/* Add fields to your experience inclusion meta box */
	$experience_repeater_fields[] = $experience_meta->addText('inclusion_title', array('name' => 'Inclusion Title'), true);
	$experience_repeater_fields[] = $experience_meta->addImage('image', array('name' => 'Image'), true);
	$experience_repeater_fields[] = $experience_meta->addTextArea('inclusion_description', array('name' => 'Inclusion Description'), true);
	$experience_meta->addRepeaterBlock('slider_images', array('inline' => false, 'name' => '', 'fields' => $experience_repeater_fields));

	/* Finish experience inclusion Meta Box Declaration */
	$experience_meta->Finish();
}
/** 
 * Metabox class - END
 */


/** 
 * Redirect specific post types URLs to homepage - START
 */
add_action('wp', 'redirect_specific_urls', 1);
function redirect_specific_urls()
{
	global $post;
	$post_type = $post->post_type;

	if ($post_type && ($post_type == 'banner' || $post_type == 'hotel-information' || $post_type == 'facility' || $post_type == 'hotel-service' || $post_type == 'at-the-hotel' || $post_type == 'gallery' || $post_type == 'special-service' || $post_type == 'experience-category' || $post_type == 'attraction-category' || $post_type == 'city-attraction' || $post_type == 'testimonial' || $post_type == 'venue' || $post_type == 'wedding_service' || $post_type == 'award' || ($post_type == 'destination' && is_tax() == false) || $post_type == 'with-the-lalit' || $post_type == 'aviation' || $post_type == 'attachment') && !preg_match('/wp-admin/i', $_SERVER["REQUEST_URI"])) {
		header("HTTP/1.0 404 Not Found - Archive Empty");
		header("Location: " . home_url());
		//require TEMPLATEPATH.'/404.php';
		exit;
	}
}
/** 
 * Redirect specific post types URLs to homepage - START
 */



/** 
 * Contact form 7 shortcodes - START
 */
add_shortcode('CF7_ADD_HOTEL_TITLE', 'cf7_add_hotel_title');
function cf7_add_hotel_title()
{
	if ($GLOBALS['form_hotel_title']) {
		return $GLOBALS['form_hotel_title'];
	}
}

add_shortcode('CF7_ADD_LOCATION', 'cf7_add_location');
function cf7_add_location()
{
	if ($GLOBALS['form_location']) {
		return $GLOBALS['form_location'];
	}
}

add_shortcode('CF7_ADD_EMAIL', 'cf7_add_email');
function cf7_add_email()
{
	if (ENV == 'production') {
		if ($GLOBALS['email']) {
			return $GLOBALS['email'];
		}
	} else {
		return 'ecampaign@thelalit.com';
	}
}

add_shortcode('CF7_ADD_PHONE', 'cf7_add_phone');
function cf7_add_phone()
{
	if ($GLOBALS['phone']) {
		return $GLOBALS['phone'];
	}
}

add_shortcode('CF7_VENUE_ADD_EMAIL', 'cf7_venue_add_email');
function cf7_venue_add_email()
{
	//if(ENV == 'production')
	//{
	if ($GLOBALS['venue_email']) {
		return $GLOBALS['venue_email'];
	}
	/*}
 	else
 	{
 		return 'corporate@thelalit.com';
 	}*/
}

add_shortcode('CF7_VENUE_ADD_EMAIL_MAIL', 'cf7_venue_add_email_mail');
function cf7_venue_add_email_mail()
{
	$email_html = '';
	if ($GLOBALS['venue_email']) {
		if (stripos($GLOBALS['venue_email'], ',') != FALSE) {
			$arr = explode(',', $GLOBALS['venue_email']);
			for ($i = 0; $i <= count($arr); $i++) {
				$email_html .= trim($arr[$i]);
				if ($arr[$i + 1]) {
					$email_html .= ' , ';
				}
			}
		} else {
			$email_html = $GLOBALS['venue_email'];
		}
	}
	return $email_html;
}

add_shortcode('CF7_VENUE_ADD_PHONE', 'cf7_venue_add_phone');
function cf7_venue_add_phone()
{
	if ($GLOBALS['venue_phone']) {
		return $GLOBALS['venue_phone'];
	}
}

add_shortcode('CF7_VENUE_ADD_PHONE_MAIL', 'cf7_venue_add_phone_mail');
function cf7_venue_add_phone_mail()
{
	$phone_html = '';
	if ($GLOBALS['venue_phone']) {
		if (stripos($GLOBALS['venue_phone'], ',') != FALSE) {
			$arr = explode(',', $GLOBALS['venue_phone']);
			for ($i = 0; $i <= count($arr); $i++) {
				$phone_html .= trim($arr[$i]);
				if ($arr[$i + 1]) {
					$phone_html .= ' / ';
				}
			}
		} else {
			$phone_html = $GLOBALS['venue_phone'];
		}
	}
	return $phone_html;
}

/** Experience Form **/
add_shortcode('CF7_ADD_SUBJECT', 'cf7_add_experience_subject');
function cf7_add_experience_subject()
{
	if ($GLOBALS['exp_subject']) {
		return $GLOBALS['exp_subject'];
	}
}

add_shortcode('CF7_ADD_NAME', 'cf7_add_experience_name');
function cf7_add_experience_name()
{
	if ($GLOBALS['exp_name']) {
		return $GLOBALS['exp_name'];
	}
}
/** Experience Form **/

/***  Dining Form ***/
add_shortcode('CF7_ADD_DINING_NAME', 'cf7_add_dining_name');
function cf7_add_dining_name()
{
	if ($GLOBALS['form_dining_name']) {
		return $GLOBALS['form_dining_name'];
	}
}

add_shortcode('CF7_ADD_DINING_SUBJECT', 'cf7_add_dining_subject');
function cf7_add_dining_subject()
{
	if ($GLOBALS['form_dining_subject']) {
		return $GLOBALS['form_dining_subject'];
	}
}
/***  Dining Form ***/

/** 
 * Contact form 7 shortcodes - END
 */


/** 
 * Get all venues (contact form 7 dynamic select) - START
 */
add_filter('my-filter', 'cf7_dynamic_select', 10, 2);
function cf7_dynamic_select($choices, $args = array())
{
	if ($GLOBALS['venues_dropdown']) {
		$choices = array();
		foreach ($GLOBALS['venues_dropdown'] as $value) {
			$choices[$value] = $value;
		}
		return $choices;
	}
}
/** 
 * Get all venues (contact form 7 dynamic select) - END
 */



/** 
 * Get all hotel names (contact form 7 dynamic select) - START
 */
add_filter('my-hotel', 'the_lalit_cf7_dynamic_hotel', 10, 2);
function the_lalit_cf7_dynamic_hotel($choices, $args = array())
{
	if ($GLOBALS['hotels']) {
		foreach ($GLOBALS['hotels'] as $value) {
			$choices[$value['name']] = $value['name'];
		}
		return $choices;
	}
}
/** 
 * Get all hotel names (contact form 7 dynamic select) - END
 */



/** 
 * Get current template file name - START
 */
add_action('template_include', 'the_lalit_current_template_file', 1000);
function the_lalit_current_template_file($template)
{
	$GLOBALS['current_theme_template'] = basename($template);

	return $template;
}
/** 
 * Get current template file name - END
 */



/** 
 * limit image upload size - START
 */
add_filter('wp_handle_upload_prefilter', 'limit_image_upload_size');
function limit_image_upload_size($file)
{
	// Calculate the image size in KB
	$image_size = $file['size'] / 1024;

	// File size limit in KB
	$limit = 500;

	// Check if it's an image
	$is_image = strpos($file['type'], 'image');

	if (($image_size > $limit) && ($is_image !== false))
		$file['error'] = 'Your picture is too large. It has to be smaller than or equal to ' . $limit . 'KB';

	return $file;
}
/** 
 * limit image upload size - END
 */


/** 
 * Banner Images or Videos relationsip field in realtionship content type - START
 */
add_filter('acf/fields/relationship/query/name=banner_images', 'filter_homepage_banners', 10, 3);
function filter_homepage_banners($args, $field, $post_id)
{
	$args['post_status'] = 'publish';
	$args['meta_query'] = array(

		array(

			'key' => 'is_featured',
			'value' => true,
			'compare' => '!='
		)
	);
	return $args;
}
/** 
 * Banner Images or Videos relationsip field in realtionship content type - END
 */

/**
 * Customize change password email - START
 */
add_filter('password_change_email', 'the_lalit_change_password_email', 10, 3);
function the_lalit_change_password_email($pass_change_mail, $user, $userdata)
{
	$site_url = get_site_url();
	$lalit_logo = get_template_directory_uri() . '/images/Lalit-Logo.png';
	$salutation = get_user_meta($user['ID'], 'salutation', true);
	$message = file_get_contents('wp-content/themes/lalit/woocommerce-custom-emailers/the-lalit-password-change.html');

	$message = str_replace('_@site_url@_', $site_url, $message);
	$message = str_replace('_@lalit_logo@_', $lalit_logo, $message);
	$message = str_replace('_@salutation@_', $salutation, $message);
	$message = str_replace('_@last_name@_', $user['last_name'], $message);

	$pass_change_mail['message'] = __($message);
	return $pass_change_mail;
}
/**
 * Customize change password email - END
 */

/**
 * Set emailer content type - START
 */
add_filter('wp_mail_content_type', 'the_lalit_email_set_content_type');
function the_lalit_email_set_content_type()
{
	return "text/html";
}
/**
 * Set emailer content type - END
 */


/**
 * Change forgot password URL (admin) -- START
 */
/*add_filter( 'lostpassword_url', 'forgot_password_url', 10, 0 );
function forgot_password_url()
{
	if(!is_account_page())
	{
		return site_url('/wp-login.php?itsec-hb-token=i-didit-myway&action=lostpassword');
	}
	else
	{
		return site_url('/my-account/lost-password/');
	}
}*/
/**
 * Change forgot password URL (admin) -- END
 */


/*$current_user = wp_get_current_user();
$user_id = $current_user->ID;
if ($user_id == 52 || strpos($current_user->user_email, '@thelalit.com')) {
	add_filter( 'parse_query', 'the_lalit_restrict_admin_pages' );
    function the_lalit_restrict_admin_pages($query) {
        global $pagenow,$post_type;
        if (is_admin() && isset($_GET['page']) && $_GET['page'] == 'checkout_form_designer')
        {
        	echo '<div class="error notice">
    				<p>Sorry, you are not allowed to access this page.</p>
				</div>';
			exit;
        }
    }
}*/

/**
 * Redirect darfted or trashed offers to offer landing page -- START
 */
add_action('template_redirect', 'redirect_draft_trash');
function redirect_draft_trash()
{
	/*if (is_404())
	{
	    global $wp_query, $wpdb;

	    if($wp_query->query['post_type'] == 'offer')
	    {
	    	$wp_query->request = "SELECT wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_name LIKE '%".$wp_query->query['name']."%' AND wp_posts.post_type = 'offer' ORDER BY wp_posts.post_date DESC";
	    	$offer_id = $wpdb->get_var( $wp_query->request );
	    	if($offer_id)
	    	{
	    		$post_status = get_post_status( $offer_id );
	    		if($post_status == 'trash' || $post_status == 'draft')
		        {     
		            
		           	$hotel_id = get_post_meta($offer_id,'hotel',true);
					$location = get_the_terms($hotel_id, 'locations');
		            wp_redirect(home_url().'/the-lalit-'.$location[0]->slug.'/offers/', 302);
		            die();
		        }
	    	}    	
	    }
	    else if($wp_query->query['post_type'] == 'product')
	    {
	    	$wp_query->request = "SELECT wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_name LIKE '%".$wp_query->query['name']."%' AND wp_posts.post_type = 'product' ORDER BY wp_posts.post_date DESC";
	    	$product_id = $wpdb->get_var( $wp_query->request );
	    	if($product_id)
	    	{
	    		$post_status = get_post_status( $product_id );
	    		if($post_status == 'trash' || $post_status == 'draft')
		        {         	
		           	$hotel_id = get_post_meta($product_id,'hotel_product',true)[0];
		           	$location = get_the_terms($hotel_id, 'locations');
		            wp_redirect(home_url().'/the-lalit-'.$location[0]->slug.'/offers/', 302);
		            die();
		        }
	    	}    
	    }
	    else
	    {
	    	wp_redirect(home_url(), 302);
		    die();
	    }
	}*/

	if (is_404()) {
		global $wp_query, $wpdb;

		if ($wp_query->query['post_type'] == 'offer') {
			if ($wp_query->query['p']) {
				$offer_id = $wp_query->query['p'];
				if ($offer_id) {
					$post_status = get_post_status($offer_id);
					if ($post_status == 'trash' || $post_status == 'draft') {

						$hotel_id = get_post_meta($offer_id, 'hotel', true);
						if ($hotel_id) {
							$location = get_the_terms($hotel_id, 'locations');
							wp_redirect(home_url() . '/the-lalit-' . $location[0]->slug . '/offers/', 302);
							die();
						} else {
							wp_redirect(home_url(), 302);
							die();
						}
					}
				}
			} else {
				$wp_query->request = "SELECT wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_name LIKE '%" . $wp_query->query['name'] . "%' AND wp_posts.post_type = 'offer' ORDER BY wp_posts.post_date DESC";
				$offer_id = $wpdb->get_var($wp_query->request);
				if ($offer_id) {
					$post_status = get_post_status($offer_id);
					if ($post_status == 'trash' || $post_status == 'draft') {
						$hotel_id = get_post_meta($offer_id, 'hotel', true);
						if ($hotel_id) {
							$location = get_the_terms($hotel_id, 'locations');
							wp_redirect(home_url() . '/the-lalit-' . $location[0]->slug . '/offers/', 302);
							die();
						} else {
							wp_redirect(home_url(), 302);
							die();
						}
					}
				}
			}
		} else if ($wp_query->query['post_type'] == 'product') {
			if ($wp_query->query['p']) {
				$product_id = $wp_query->query['p'];
				if ($product_id) {
					$post_status = get_post_status($product_id);
					if ($post_status == 'trash' || $post_status == 'draft') {
						$hotel_id = get_post_meta($product_id, 'hotel_product', true);
						if ($hotel_id) {
							$location = get_the_terms($hotel_id[0], 'locations');
							wp_redirect(home_url() . '/the-lalit-' . $location[0]->slug . '/offers/', 302);
							die();
						} else {
							wp_redirect(home_url(), 302);
							die();
						}
					}
				}
			} else {
				$wp_query->request = "SELECT wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_name LIKE '%" . $wp_query->query['name'] . "%' AND wp_posts.post_type = 'product' ORDER BY wp_posts.post_date DESC";
				$product_id = $wpdb->get_var($wp_query->request);
				if ($product_id) {
					$post_status = get_post_status($product_id);
					if ($post_status == 'trash' || $post_status == 'draft') {
						$hotel_id = get_post_meta($product_id, 'hotel_product', true);
						if ($hotel_id) {
							$location = get_the_terms($hotel_id[0], 'locations');
							wp_redirect(home_url() . '/the-lalit-' . $location[0]->slug . '/offers/', 302);
							die();
						} else {
							wp_redirect(home_url(), 302);
							die();
						}
					}
				}
			}
		} else if ($wp_query->query['product_cat']) {
			$product_cat = $wp_query->query['product_cat'];
			$product_cat = rtrim($product_cat, '/');
			$product_cat = explode('/', $product_cat);
			$product_name = end($product_cat);

			$wp_query->request = "SELECT wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_name LIKE '%" . $product_name . "%' AND wp_posts.post_type = 'product' ORDER BY wp_posts.post_date DESC";
			$product_id = $wpdb->get_var($wp_query->request);
			if ($product_id) {
				$post_status = get_post_status($product_id);
				if ($post_status == 'trash' || $post_status == 'draft') {
					$hotel_id = get_post_meta($product_id, 'hotel_product', true);
					if ($hotel_id) {
						$location = get_the_terms($hotel_id[0], 'locations');
						wp_redirect(home_url() . '/the-lalit-' . $location[0]->slug . '/offers/', 302);
						die();
					} else {
						wp_redirect(home_url(), 302);
						die();
					}

					die();
				}
			} else {
				wp_redirect(home_url(), 302);
				die();
			}
		} else {
			wp_redirect(home_url(), 302);
			die();
		}
	}
}
/**
 * Redirect darfted or trashed offers to offer landing page -- END
 */

/**
 * CMS - Dining Restaurant Menu file type checking code starts here
 */

/*function my_acf_save_post( $post_id ) {
    

    if( get_post_type($post_id) == false )
    	return;

    // bail early if no ACF data
    if( empty($_POST['fields']) )
        return;

    // specific field value
    $field = (int)$_POST['fields']['field_5aa6270d4f141'];

    if(empty($field))
    	return;

    $file_url = wp_get_attachment_url($field);

    if(stripos($file_url, '.pdf') == false) {
    	?>
    	<script type="text/javascript">
    		alert('Please upload pdf file');
    	</script>
    	<?php

    	wp_delete_attachment($field);
    	return;
    }
}

add_action('acf/save_post', 'my_acf_save_post', 1);*/

add_filter('wp_handle_upload_prefilter', 'restaurant_menu_upload_filter');

function restaurant_menu_upload_filter($file)
{

	if (!isset($_REQUEST['post_id']) || get_post_type($_REQUEST['post_id']) !== 'dining')
		return $file;

	// Calculate the image size in KB
	$file_size = $file['size'] / 1024;

	if ($file['type'] != 'application/pdf' || $file_size > 2048)

		$file['error'] = 'Please upload pdf files of maximum size 2 MB only';

	return $file;
}

/**
 * CMS - Dining Restaurant Menu file type checking code ends here
 */


function my_custom_offer_bulk_actions($actions)
{
	if ($_GET['post_status'] == 'trash') {
		$actions['draft'] = 'Move to Draft';
	}
	return $actions;
}
add_filter('bulk_actions-edit-offer', 'my_custom_offer_bulk_actions');

function my_bulk_offer_action_handler($redirect_to, $doaction, $post_ids)
{
	if ($doaction !== 'draft') {
		return $redirect_to;
	}
	foreach ($post_ids as $post_id) {
		$current_post = get_post($post_id, 'ARRAY_A');
		$current_post['post_status'] = 'draft';
		wp_update_post($current_post);
	}
	//$redirect_to = add_query_arg( 'bulk_emailed_posts', count( $post_ids ), $redirect_to );
	return $redirect_to;
}
add_filter('handle_bulk_actions-edit-offer', 'my_bulk_offer_action_handler', 10, 3);

function my_custom_product_bulk_actions($actions)
{
	if ($_GET['post_status'] == 'trash') {
		$actions['draft'] = 'Move to Draft';
	}
	return $actions;
}
add_filter('bulk_actions-edit-product', 'my_custom_product_bulk_actions');

function my_bulk_product_action_handler($redirect_to, $doaction, $post_ids)
{
	if ($doaction !== 'draft') {
		return $redirect_to;
	}
	foreach ($post_ids as $post_id) {
		$current_post = get_post($post_id, 'ARRAY_A');
		$current_post['post_status'] = 'draft';
		wp_update_post($current_post);
	}
	//$redirect_to = add_query_arg( 'bulk_emailed_posts', count( $post_ids ), $redirect_to );
	return $redirect_to;
}
add_filter('handle_bulk_actions-edit-product', 'my_bulk_product_action_handler', 10, 3);

/*add_action( 'load-edit.php', function() {

    $post_type   = 'banner';
    $col_name    = 'modified_author';

    $screen = get_current_screen();

    if ( ! isset ( $screen->id ) )
        return;

    if ( "edit-$post_type" !== $screen->id )
        return;

    add_filter(
        "manage_{$post_type}_posts_columns",
        function( $posts_columns ) use ( $col_name ) {
            $posts_columns[ $col_name ] = 'Last modified by';

            return $posts_columns;
        }
    );

    add_action(
        "manage_{$post_type}_posts_custom_column",
        function( $column_name, $post_id ) use ( $col_name ) {

            if ( $col_name !== $column_name )
                return;

            $last_id = get_post_meta( $post_id, '_edit_last', TRUE );

            if ( ! $last_id ) {
                print '<i>Unknown</i>';
                return;
            }

            $last_user = get_userdata( $last_id );
            
            $published_time_content = '';
            $modifed_time_content = '';
            $u_time = get_the_time('U' ,$post_id); 
            $published_date =  get_the_time('F jS, Y' ,$post_id);
            $published_time =  get_the_time('h:i a' ,$post_id);
            
			$u_modified_time = get_the_modified_time('U', $post_id); 
			$published_time_content = '<br/><span class="published">Published on '. $published_date . ' at '. $published_time .' UTC</span>';
			if ($u_modified_time >= $u_time + 86400) { 
				$updated_date = get_the_modified_time('F jS, Y', $post_id);
				$updated_time = get_the_modified_time('h:i a', $post_id); 
				$modifed_time_content .= '<br/><span class="last-updated">Last updated on '. $updated_date . ' at '. $updated_time .' UTC</span>';  
			} 

            print $last_user->display_name.$published_time_content.$modifed_time_content;
        },
        10, 2
    );
});*/


/**
 * The Lalit meta robot tag for the entire site
 */

function the_lalit_add_meta_robot_tag()
{

?>
	<meta name="robots" content="noodp, noydir" />
<?php
}
add_action('wp_head', 'the_lalit_add_meta_robot_tag');

function the_lalit_facebook_verification_tag()
{
?>
	<meta name="facebook-domain-verification" content="91obnu3vxkhvmhoycm7ianqkmz7dui" />
<?php
}
add_action('wp_head', 'the_lalit_facebook_verification_tag');


/** AMP code starts here **/

function the_lalit_remove_canonical_url_from_non_amp_page($url)
{

	global $post;
	$current_template = basename(get_page_template($post->ID));

	if ($current_template === 'offers-template.php' || $current_template === 'suite-and-room-template.php' || $current_template === 'location-template.php' || $current_template === 'dining-template.php' || $current_template === 'relax-and-unwind.php') {

		add_action('wp_head', 'the_lalit_return_amp_url', 3);
		return false;
	} else if (($post->post_type == 'offer' || is_single('offer')) || ($post->post_type == 'suite-and-room' || is_single('suite-and-room')) || ($post->post_type == 'dining' || is_single('dining'))) {

		add_action('wp_head', 'the_lalit_return_amp_url', 3);
		return false;
	} else if ($current_template === 'hotel-template.php' || $current_template === 'home-page.php') {

		add_action('wp_head', 'the_lalit_return_amp_url', 3);
		return false;
	}
	return $url;
}
add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url_from_non_amp_page', 8, 1);

function the_lalit_return_amp_url()
{

	global $post;

	$permalink = get_the_permalink($post->ID);
	$amp_end_point = '?amp';

	if (is_single()) {
		$amp_end_point = 'amp';
	}

	$permalink .= $amp_end_point;

	return '<link rel="amphtml" href="' . $permalink . '">';
}

/*add_theme_support( 'amp', array(
	'paired' => true,
) );*/

/*function isa_amp_add_cpt() {
	add_post_type_support( 'page', amp_get_slug() );
    add_post_type_support( 'offer', amp_get_slug() );
    //add_post_type_support( 'custom_post_type_two', AMP_QUERY_VAR );
 
}
add_action( 'amp_init', 'isa_amp_add_cpt' );

add_filter( 'amp_post_status_default_enabled', function( $default, $post ) {

	echo get_page_template($post->ID);exit;

    if ( 'page' === get_post_type( $post ) || 'offer' === get_post_type( $post ) ) {

        $default = true;
    } else {

        $default = false;
    }
    return $default;
}, 10, 2 );*/

function the_lalit_amp_template($template, $template_type, $post)
{
	//echo basename(get_page_template($post->ID));exit;
	/*if ( 'page' === $template_type && 'page' === get_option( 'show_on_front' ) ) {
		if ( (int) get_option( 'page_on_front' ) === $post->ID ) {
			$template = dirname( __FILE__ ) . '/amp/home.php';
		} elseif ( (int) get_option( 'page_for_posts' ) === $post->ID ) {
			$template = dirname( __FILE__ ) . '/amp/blog.php';
		}
	}
	return $template;*/


	$current_template = basename(get_page_template($post->ID));

	if ($current_template === 'offers-template.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/offers/listing/amp-offer-template.php';
	} else if ($post->post_type == 'offer' && $template_type == 'single') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/offers/detail/amp-single-offer.php';
	} else if ($current_template === 'hotel-template.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/hotel-overview/amp-hotel-overview-template.php';
	} else if ($current_template === 'guest-policy-template.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/global-pages/amp-guest-policy-template.php';
	} else if ($current_template === 'suite-and-room-template.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/suites-and-rooms/listing/amp-suite-and-room-template.php';
	} else if ($post->post_type == 'suite-and-room' && $template_type == 'single') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/suites-and-rooms/detail/amp-single-suite-and-room.php';
	} else if ($current_template === 'dining-template.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/dining/listing/amp-dining-template.php';
	} else if ($post->post_type == 'dining' && $template_type == 'single') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/dining/detail/amp-single-dining.php';
	} else if ($current_template === 'location-template.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/location/location-template.php';
	} else if ($current_template === 'home-page.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/home/home-template.php';
	} else if ($current_template === 'relax-and-unwind.php') {

		add_action('wp_head', 'the_lalit_remove_widget_action', 1);
		add_action('wp_print_styles', 'the_lalit_deregister_styles', 100);
		add_filter('aioseop_canonical_url', 'the_lalit_remove_canonical_url', 10, 1);
		$template = get_template_directory() . '/amp/relax-and-unwind/amp-relax-and-unwind-template.php';
	}
	return $template;
}
add_filter('amp_post_template_file', 'the_lalit_amp_template', 10, 3);

function the_lalit_deregister_styles()
{

	//wp_deregister_style( 'dashicons' );
	wp_dequeue_style('wp-block-library');
	wp_deregister_style('woocommerce-inline');
	remove_action('wp_head', 'wc_gallery_noscript');
	remove_action("wp_head", array('OpenGraphProtocol', 'output_to_head_tag'));
}

function the_lalit_remove_widget_action()
{

	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

function the_lalit_remove_canonical_url($url)
{

	return false;
}

//remove_action( 'wp_head', 'wp_resource_hints', 2 );
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );
//remove_action( 'wp_head', 'rest_output_link_wp_head' );
//remove_action( 'wp_head',      'wp_oembed_add_discovery_links'         );
//remove_action( 'template_redirect', 'rest_output_link_header', 11 );



function the_lalit_remove_image_tags_amp($content)
{

	$content = str_replace(
		'<img',
		'<amp-img',
		$content
	);

	/*$content = str_replace(
		' class="alignnone"',
		'',
		$content
	);
	
	$content = str_replace(
		'alt=""',
		'alt="Book Now"',
		$content
	);*/

	$content = str_replace(
		' />',
		'></amp-img>',
		$content
	);

	$content = str_replace(
		'<iframe',
		'<amp-iframe layout="responsive" sandbox="allow-scripts allow-same-origin allow-popups"',
		$content
	);

	$content = str_replace(
		'</iframe>',
		'></amp-iframe>',
		$content
	);

	return $content;
}


add_filter('amp_post_template_metadata', 'the_lalit_amp_modify_json_metadata', 10, 2);

function the_lalit_amp_modify_json_metadata($metadata, $post)
{

	$current_template = basename(get_page_template($post->ID));

	$position = 1;
	$metadata = [];

	$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location'][0]->term_id);
	$hotel_name = '';
	if ($destination_obj->have_posts()) {

		while ($destination_obj->have_posts()) {

			$destination_obj->the_post();
			$hotel_name = get_post_meta(get_the_id(), 'name', true);
		}
	}
	wp_reset_postdata();

	unset($destination_obj);

	$metadata['@context'] =  "http://schema.org";
	$metadata['@type'] =  "BreadcrumbList";

	if ($current_template === 'offers-template.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][2]['@type'] = 'ListItem';
		$metadata['itemListElement'][2]['position'] = $position + 2;
		$metadata['itemListElement'][2]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
		$metadata['itemListElement'][2]['item']['name'] = 'Offers';
	} else if ($current_template === 'suite-and-room-template.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][2]['@type'] = 'ListItem';
		$metadata['itemListElement'][2]['position'] = $position + 2;
		$metadata['itemListElement'][2]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
		$metadata['itemListElement'][2]['item']['name'] = 'Suites and Rooms';
	} else if ($post->post_type == 'suite-and-room' || is_single('suite-and-room')) {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][2]['@type'] = 'ListItem';
		$metadata['itemListElement'][2]['position'] = $position + 2;
		$metadata['itemListElement'][2]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/suites-and-rooms/?amp';
		$metadata['itemListElement'][2]['item']['name'] = 'Suites and Rooms';

		$metadata['itemListElement'][3]['@type'] = 'ListItem';
		$metadata['itemListElement'][3]['position'] = $position + 3;
		$metadata['itemListElement'][3]['item']['@id'] = get_the_permalink() . 'amp';
		$metadata['itemListElement'][3]['item']['name'] = get_post_meta(get_the_id(), 'name', true);
	} else if ($current_template === 'dining.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][2]['@type'] = 'ListItem';
		$metadata['itemListElement'][2]['position'] = $position + 2;
		$metadata['itemListElement'][2]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
		$metadata['itemListElement'][2]['item']['name'] = 'Eat and Drink';
	} else if ($current_template === 'location-template.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][2]['@type'] = 'ListItem';
		$metadata['itemListElement'][2]['position'] = $position + 2;
		$metadata['itemListElement'][2]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
		$metadata['itemListElement'][2]['item']['name'] = 'Location';
	} else if ($post->post_type == 'dining' || is_single('dining')) {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][2]['@type'] = 'ListItem';
		$metadata['itemListElement'][2]['position'] = $position + 2;
		$metadata['itemListElement'][2]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/eat-and-drink/?amp';
		$metadata['itemListElement'][2]['item']['name'] = 'Eat and Drink';

		$metadata['itemListElement'][3]['@type'] = 'ListItem';
		$metadata['itemListElement'][3]['position'] = $position + 3;
		$metadata['itemListElement'][3]['item']['@id'] = get_the_permalink() . 'amp';
		$metadata['itemListElement'][3]['item']['name'] = get_post_meta(get_the_id(), 'name', true);
	} else if ($current_template === 'hotel-template.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;
	} else if ($current_template === 'guest-policy-template.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][3]['@type'] = 'ListItem';
		$metadata['itemListElement'][3]['position'] = $position + 3;
		$metadata['itemListElement'][3]['item']['@id'] = get_the_permalink() . '?amp';
		$metadata['itemListElement'][3]['item']['name'] = get_the_title();
	} else if ($post->post_type == 'offer' || is_single('offer')) {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][2]['@type'] = 'ListItem';
		$metadata['itemListElement'][2]['position'] = $position + 2;
		$metadata['itemListElement'][2]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/offers/?amp';
		$metadata['itemListElement'][2]['item']['name'] = 'Offers';

		$metadata['itemListElement'][3]['@type'] = 'ListItem';
		$metadata['itemListElement'][3]['position'] = $position + 3;
		$metadata['itemListElement'][3]['item']['@id'] = get_the_permalink() . 'amp';
		$metadata['itemListElement'][3]['item']['name'] = get_post_meta(get_the_id(), 'name', true);
	} else if ($current_template === 'home-page.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';
	} else if ($current_template === 'relax-and-unwind.php') {

		$metadata['itemListElement'][0]['@type'] = 'ListItem';
		$metadata['itemListElement'][0]['position'] = $position;
		$metadata['itemListElement'][0]['item']['@id'] = site_url() . '/';
		$metadata['itemListElement'][0]['item']['name'] = 'Home';

		$metadata['itemListElement'][1]['@type'] = 'ListItem';
		$metadata['itemListElement'][1]['position'] = $position + 1;
		$metadata['itemListElement'][1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $GLOBALS['location'][0]->slug . '/';
		$metadata['itemListElement'][1]['item']['name'] = $hotel_name;

		$metadata['itemListElement'][3]['@type'] = 'ListItem';
		$metadata['itemListElement'][3]['position'] = $position + 3;
		$metadata['itemListElement'][3]['item']['@id'] = get_the_permalink() . '?amp';
		$metadata['itemListElement'][3]['item']['name'] = get_the_title();
	}
	return $metadata;
}

/** AMP code ends here **/



function cf7_enqueue_admin_script($hook)
{
	if ('toplevel_page_wpcf7' != $hook) {
		return;
	}
	wp_enqueue_script('cf7_custom_script', site_url() . '/wp-content/plugins/contact-form-7-datepicker/js/jquery-ui-timepicker/jquery-ui-timepicker-addon.min.js', array('jquery-ui-datepicker'), get_bloginfo('version'), true);
}
add_action('admin_enqueue_scripts', 'cf7_enqueue_admin_script');


function wpb_hook_javascript_head()
{
?>
	<!--Start of cmercury Script
		-->
	<script type="text/javascript">
		(function() {
			var con = document.createElement('script');
			con.type = 'text/javascript';
			var host = (document.location.protocol === 'http:') ? 'http://' : 'https://';
			con.src = host + 'exit.nwtrk.in/ExitPopup/Sourcefiles/78/minify/c2b67b567b3e360ec53d7637efdbb998e54ff4c66c242a7579f8032908c08f91.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(con, s);
		})();
	</script>
	<!--End of cmercury Script-->
<?php
}
add_action('wp_head', 'wpb_hook_javascript_head');
?>