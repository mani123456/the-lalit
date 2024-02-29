<?php
$destination  = get_destination_by_feature_id("hotel_experiences", $post->ID);
$hotel_id = '';
$hotel_title = '';
if( $destination->have_posts() ) : 
    while($destination->have_posts()) : $destination->the_post();

        $hotel_id = $post->ID;
        $hotel_title = get_the_title($post->ID);
        $hotel_name = get_post_meta($post->ID, 'name', true);

        $GLOBALS['address'] = get_post_meta($hotel_id,"address",true);
        $GLOBALS['email'] = get_post_meta($hotel_id,"email",true);
        $GLOBALS['phone'] = get_post_meta($hotel_id,"phone",true);
        $GLOBALS['fax'] = get_post_meta($hotel_id,"fax",true);
        $GLOBALS['review_widget'] = get_post_meta( $hotel_id, "review_widget", true);

        $currency = get_post_meta( $hotel_id, "currency", true);
        if($currency == 1)
        {
            $GLOBALS['curr'] = '&#8377;';
        }
        else
        {
            $GLOBALS['curr'] = '&pound;';
        }
      
    endwhile;
endif;
wp_reset_postdata();

$location = get_the_terms($hotel_id, 'locations');
$location_id = '';
foreach($location as $value)
{
  $location_id = $value->term_id;
}

//$GLOBALS['hotel_id'] = $hotel_id;
//$GLOBALS['destination'] = $destination;
$GLOBALS['location'] = $location;
$GLOBALS['location_id'] = $location_id;


/*****  for Experience form ******/

$GLOBALS['form_hotel_title'] = $hotel_name;
$GLOBALS['form_location'] = $GLOBALS['location'][0]->name;
//$GLOBALS['form_experience_name'] = get_post_meta($post->ID, 'name', true);
//$GLOBALS['form_experience_subject'] = 'Experience Enquiry for '.$GLOBALS['form_experience_name'].'-'.$GLOBALS['form_location'];

/*****  for Experience form ******/



$position = 1;
$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location'][0]->term_id);
$hotel_name = '';
if($destination_obj->have_posts()){

    while($destination_obj->have_posts()){
        
        $destination_obj->the_post();
        $hotel_name = get_post_meta(get_the_id(), 'name', true);
    }

}
wp_reset_postdata();

$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';


$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().'/'.'the-lalit-'.$GLOBALS['location'][0]->slug.'/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url().'/'.'the-lalit-'.$GLOBALS['location'][0]->slug.'/experience-the-lalit';
$itemList[2]['item']['name'] = 'Experience '.ucfirst($GLOBALS['location'][0]->slug);

$itemList[3]['@type'] = 'ListItem';
$itemList[3]['position'] = $position + 3;
$itemList[3]['item']['@id'] = get_the_permalink();
$itemList[3]['item']['name'] = get_post_meta(get_the_id(), 'name', true);

?>
<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
        <script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": <?php echo json_encode($itemList); ?>
		}
		</script>
        <style type="text/css">
            .ui-datepicker-trigger{
                display:none;
            }
        </style>
    </head>
    <body <?php body_class('local-page'); ?>>
        <div class="main-wrap">
        	<?php get_header(); ?>

        		<?php get_template_part( 'detail-pages/experience', 'detail' ); ?>

         	<?php get_footer(); ?>
        </div><!-- main-wrap -->    

        <?php
        if(isMobile())
        {
        ?>
            <script type="text/javascript">
                jQuery(".book_package").on("click", function(event) {
                    if (this.hash !== "") {     
                      event.preventDefault();      
                      var hash = this.hash;

                      $("html, body").animate({
                        scrollTop: $(hash).offset().top-(jQuery(".nav-bar-fill").height()+jQuery(".mobile-sticky").height()+30)
                      }, 800);

                      return false;
                    } 
                });
            </script>
        <?php
        }
        else
        {
        ?>
            <script type="text/javascript">
                jQuery(".book_package").on("click", function(event) {
                        if (this.hash !== "") {     
                          event.preventDefault();      
                          var hash = this.hash;

                          $("html, body").animate({
                            scrollTop: $(hash).offset().top - (jQuery(".package-head-sec").outerHeight() + jQuery(".nav-bar-fill").outerHeight())
                          }, 800);

                          return false;
                        } 
                    });
            </script>
        <?php
        }
        ?>  
        <script type="text/javascript">
            jQuery(document).ready( function () {

                jQuery("#pkg-enquiry-form").find(".wpcf7-response-output").remove();

                var dateFormat = "dd M yy";
                var dateFormat = "dd M yy";
                var currentyear = new Date().getFullYear();
                var nextYear = new Date().getFullYear() + 1;
                var yearRange = currentyear+":"+nextYear;

                jQuery(".date-field").datepicker({
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
                jQuery(".date-field").datepicker("setDate",currentDate);
                jQuery(".date-field").datepicker('option', 'minDate', currentDate);  
            });

            jQuery(".back_package").on("click", function(event) {
                if (this.hash !== "") {     
                  event.preventDefault();      
                  var hash = this.hash;

                  $("html, body").animate({
                        scrollTop: $("body").offset().top
                  }, 800);

                  return false;
                } 
            });

            /*function successfull_form_submission()
            {    
                jQuery("#pkg-enquiry-form").find(".wpcf7, .form-header").fadeOut(function() {
                    jQuery("#pkg-enquiry-form .align-content-center").find(".thank-you-block").fadeIn();
                });

                setTimeout(function() {
                    jQuery("#pkg-enquiry-form").find(".wpcf7, .form-header").show();
                    jQuery("#pkg-enquiry-form .align-content-center").find(".thank-you-block").hide();
                }, 5000);
            }*/

            document.addEventListener( 'wpcf7mailsent', function( event ) {console.log(event);
                if ( '1963' == event.detail.contactFormId ) {
                    jQuery("#pkg-enquiry-form").find(".wpcf7, .form-header").fadeOut(function() {
                        jQuery("#pkg-enquiry-form .align-content-center").find(".thank-you-block").fadeIn();
                    });

                    setTimeout(function() {
                        jQuery("#pkg-enquiry-form").find(".wpcf7, .form-header").show();
                        jQuery("#pkg-enquiry-form .align-content-center").find(".thank-you-block").hide();
                    }, 5000);
                }
            }, false );

        </script>
    </body>    
</html>   