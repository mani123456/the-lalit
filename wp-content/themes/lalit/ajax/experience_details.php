<?php
	$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);
	$city_name = $GLOBALS['location'][0]->slug;
	
	$experience_id = $_REQUEST['id'];
	$location_id = $_REQUEST['location_id'];
	$term  = get_term( $location_id, 'locations' );
	$GLOBALS['location_slug'] = $term->slug;

	$experience_name = get_post_meta($experience_id,'name',true);
	$experience_link = get_permalink($experience_id);
	$start_time = get_post_meta($experience_id, 'start_time', true);
	$duration = get_post_meta($experience_id, 'duration', true);
	$stops = get_post_meta($experience_id, 'number_of_stops', true);
	$price_single = get_post_meta($experience_id, 'single_price', true);
	$price_couple = get_post_meta($experience_id, 'couple_price', true);
	$inclusions = get_post_meta($experience_id, 'slider_images', true);
	$good_to_know = get_post_meta($experience_id, 'good_to_know', true);

	$result_data = '';

$result_data = '<a href="javascript:void(0);" class="close-popup"><i class="ico-sprite sprite size-32 ico-grey-close"></i></a>';
$result_data .='<div class="packages-bg-sec" id="exp_details">

	<div class="package-head-sec">
		<div class="container">
			<div class="row">

				<a class="logo" href="/" itemprop="url" title=""><img src="/wp-content/themes/lalit/images/head-white-logo.png" itemprop="logo" alt=""></a>

				<div class="row">
					<div class="col col10 align-content-center">';
					
					if($experience_name != '')
					{
					
		$result_data .= '<h2 class="sec-title align-center uppercase"><small class="align-center">Tour package</small>'.$experience_name.'</h2>';
					
					}
				
		$result_data .=	'<ul class="unstyled-listing meta-block clearfix marB20">';
				
					if($start_time != '')
					{
			
			$result_data .=	'<li class="span">
                        		<span class="meta-label uppercase">Start</span>
                        		<strong class="meta-value">'.$start_time.'</strong>
                      		</li>';
					}
					

			 		if($duration != '')
			 		{

            $result_data .=	'<li class="span">
                        		<span class="meta-label uppercase">Duration</span>
                        		<strong class="meta-value">'.$duration.'</strong>
                      		</li>';
                  	}
   


			 		if($stops != '')
			 		{

            $result_data .=	'<li class="span">
                        		<span class="meta-label uppercase">Route</span>
                        		<strong class="meta-value">'.$stops.'</strong>
                      		</li>';
                  	}


			 		if($price_single != '' || $price_couple != '')
			 		{

            $result_data .=	'<li class="span">
                        		<span class="meta-label uppercase">Price:</span>
                        		<strong class="meta-value">&#8377;'.$price_single.' / Person</strong>
                        		<strong class="meta-value">&#8377;'.$price_couple.' / couple</strong>
                      		</li>';
                  	}

		$result_data .=	'</ul>

			 			<small class="slider-inclusions-text">Tour Inclusions</small>
                    	<span class="down-arrow-img">&nbsp;</span>

					</div>
				</div>

			</div>
		</div>
	</div>';

													

if($inclusions)
{

	if(count($inclusions) > 1)
	{

//$result_data .= '<span class="overlay-bg">&nbsp;</span>';
$result_data .= '<div id="banner-slider" class="flexslider">
					<ul class="slides align-center">';

			$c = 1;
			foreach($inclusions as $inclusion)
			{
				$inclusion_title = $inclusion['inclusion_title'];
	 			$inclusion_image = $inclusion['image']['url'];
				$inclusion_description = $inclusion['inclusion_description'];
				/* <h2 class="sec-title align-center uppercase">'.$c.'. '.$inclusion_title.'</h2> */
		$result_data .= '<li style="background: url('.$inclusion_image.') no-repeat left top;">
							<span class="overlay-bg">&nbsp;</span>
							<div class="container">
								<div class="row">
                    				<div class="col col10 align-content-center slidr-content">
                    					<h2 class="sec-title align-center uppercase">'.$inclusion_title.'</h2>
                    					<p>'.$inclusion_description.'</p>
                    				</div>
	                			</div>
	                		</div>
						</li>';

				$c++;
			}

	$result_data .=	'</ul>
				</div>';

	}
	else
	{

//$result_data .= '<span class="overlay-bg">&nbsp;</span>';
$result_data .= '<div id="banner-slider" class="flexslider">
					<ul class="slides align-center" >';

			$c = 1;
			foreach($inclusions as $inclusion)
			{
				$inclusion_title = $inclusion['inclusion_title'];
	 			$inclusion_image = $inclusion['image']['url'];
				$inclusion_description = $inclusion['inclusion_description'];

		$result_data .= '<li style="background: url('.$inclusion_image.') no-repeat left top;">
						 <span class="overlay-bg">&nbsp;</span>
							<div class="container">
								<div class="row">
                    				<div class="col col10 align-content-center slidr-content">
                    					<h2 class="sec-title align-center uppercase">'.$c.'. '.$inclusion_title.'</h2>
                    					<p>'.$inclusion_description.'</p>
                    				</div>
	                			</div>
	                		</div>
						</li>';

				$c++;
			}

	$result_data .=	'</ul>
				</div>';

	}

}

												
$result_data .=	'<div class="package-foot-sec">
					<div class="container">
						<div class="row">
							<div class="col col6 align-content-center align-center">';
		
							if($good_to_know)
							{

                 $result_data .='<small><i class="ico-sprite sprite ico-white-info"></i> Good to Know</small>
                    			<p>'.$good_to_know.'</p>';
  
							}

                	$result_data .=	'<a href="#pkg-enquiry-form" class="btn primary-btn book_package" title="Contact our concierge uppercase">
                						Book this Package
                					</a>
	              			</div>
	            		</div>
	        		</div>
	    		</div>'; 

//$result_data .= '<span class="overlay-bg">&nbsp;</span>';  

$result_data .= '</div>';

												
$result_data .=	'<div id="pkg-enquiry-form" class="container white-bg packages-enquiry-form" style="display:none">
					<div class="row">
						<div class="col col8 align-content-center">

							
				              	<div class="form-header">
				                	<h3 class="item-title">Book this Package</h3>
				                	<p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
				              	</div>';

$exp_subject = 'Experience-'.ucfirst($GLOBALS['location_slug']).' '.$experience_name;
$exp_name = $experience_name;
$GLOBALS['exp_subject'] = $exp_subject;
$GLOBALS['exp_name'] = $exp_name;

$result_data .= do_shortcode( '[contact-form-7 id="1963" title="Experience"]' );
								

			
		$result_data .=	'</div>
				    </div>
				</div>';

$result_data .= '
				<link type="text/css" rel="stylesheet" href="/wp-content/plugins/contact-form-7/includes/css/styles.css" />
				 <style type="text/css">
		            .ui-datepicker-trigger{
		                display:none;
		            }
		        </style>
				<script type="text/javascript">
					jQuery("#popup .close-popup").on("click", function() {
								jQuery(".main-wrap").show();
								jQuery(".cd-section").removeClass("visible");
								jQuery(".cd-section.current_section").addClass("visible");
								jQuery(".cd-vertical-nav li").find("a").removeClass("inactive")
				                jQuery("#popup").css("visibility", "hidden");
				                jQuery("#popup #popup-content").html("");
				                jQuery("#popup").addClass("zoomOut");

				                jQuery(".cd-section.current_section").removeClass("current_section");
				                return false;
				    });

				    jQuery(".book_package").on("click", function(event) {
				    	if (this.hash !== "") {     
				          event.preventDefault();      
				          var hash = this.hash;

				          $("html, body").animate({
				            scrollTop: $(hash).offset().top - jQuery(".package-head-sec").height()
				          }, 800, function(){   

				            window.location.hash = hash;
				            jQuery(".package-head-sec").addClass("package-head-bg");
				            return false;
				          });
						  

				          return false;
				        } 
				    });

				    jQuery(".back_package").on("click", function(event) {
				    	if (this.hash !== "") {     
				          event.preventDefault();      
				          var hash = this.hash;

				          $("html, body").animate({
				            scrollTop: $(hash).offset().top
				          }, 800, function(){   

				            window.location.hash = hash;
				            jQuery(".package-head-sec").removeClass("package-head-bg");
				            return false;
				          });
						  

				          return false;
				        } 
				    });

				    $(document).ready(function(){
				    	var dateFormat = "dd M yy";
				    	var dateFormat = "dd M yy";
            			var currentyear = new Date().getFullYear();
            			var nextYear = new Date().getFullYear() + 1;
            			var yearRange = currentyear+":"+nextYear;

    					$(".date-field").datepicker({
    						dateFormat: dateFormat,
    						yearRange: yearRange,
			                changeMonth: false,
			                numberOfMonths: 1,
			                showOn: "both",
			                buttonImageOnly: true,
			                showButtonPanel: true,
			                closeText: "Close",
			                dayNamesShort: ["S","M", "T", "W", "T", "F", "S"],
                			dayNamesMin: ["S","M", "T", "W", "T", "F", "S"]
    					});

    					var currentDate = new Date();  
            			jQuery(".date-picker").datepicker("setDate",currentDate);
					});
				</script>
				<script type="text/javascript" src="/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.40.0-2013.08.13"></script>
				<script type="text/javascript">
				var _wpcf7 = {"loaderUrl":"/wp-content/plugins/contact-form-7/images/ajax-loader.gif","sending":"Sending ..."};
				</script>
				<script type="text/javascript" src="/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=3.5.2"></script>';

wp_send_json_success($result_data);
?>