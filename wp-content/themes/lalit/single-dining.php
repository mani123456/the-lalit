<?php
$destination  = get_destination_by_feature_id("dinings", $post->ID);
$hotel_id = '';
$hotel_title = '';
if( $destination->have_posts() ) : 
    while($destination->have_posts()) : $destination->the_post();

        $hotel_id = $post->ID;
        $hotel_title = get_the_title($post->ID);
        $hotel_name = get_post_meta($post->ID, 'name', true);
      
    endwhile;
endif;
wp_reset_postdata();

$location = get_the_terms($hotel_id, 'locations');
$location_id = '';
foreach($location as $value)
{
  $location_id = $value->term_id;
}

$GLOBALS['hotel_id'] = $hotel_id;


$GLOBALS['destination'] = $destination;
$GLOBALS['location'] = $location;
$GLOBALS['location_id'] = $location_id;


/*****  for dining form ******/

$GLOBALS['form_hotel_title'] = $hotel_name;
$GLOBALS['form_location'] = $GLOBALS['location'][0]->name;
$GLOBALS['form_dining_name'] = get_post_meta($post->ID, 'name', true);
$GLOBALS['form_dining_subject'] = 'Dining Enquiry for '.$GLOBALS['form_dining_name'].'-'.$GLOBALS['form_location'];

/*****  for dining form ******/

$GLOBALS['page-name'] = 'restaurant-details';

$position = 1;
$destination_obj = get_destination_by_taxanomy('locations', $location[0]->term_id);
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
$itemList[1]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug .'/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug.'/eat-and-drink/';
$itemList[2]['item']['name'] = 'Eat and Drink';

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

        		<?php get_template_part( 'detail-pages/restaurant', 'detail' ); ?>

         	<?php get_footer(); ?>
        </div><!-- main-wrap -->    

        <div id="book-a-table" class="pop-up" style="display: none;">
           
            <div class="form-header">
                <h2 class="page-title">
                    <small><?php echo $GLOBALS['form_hotel_title']; ?></small>
                    <?php echo $GLOBALS['form_dining_name']; ?>
                </h2>
                <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
            </div>
            <?php
			     // echo $GLOBALS['location'][0]->name;
				 
			     if($GLOBALS['location'][0]->name=='Bekal') {
					 
                 echo do_shortcode( '[contact-form-7 id="261657" title="Dining Form_Bekal"]' );
				 
				 } elseif($GLOBALS['location'][0]->name=='New Delhi')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261658" title="Dining Form_Delhi"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Mumbai')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261659" title="Dining Form_Mumbai"]' );	 
				
				 } elseif($GLOBALS['location'][0]->name=='Bangalore')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261660" title="Dining Form_Bangalore"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Kolkata')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261661" title="Dining Form_Kolkata"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Jaipur')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261662" title="Dining Form_Jaipur"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Udaipur')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261663" title="Dining Form_Udaipur"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Goa')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261664" title="Dining Form_Goa"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Mangar')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261665" title="Dining Form_Mangar"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Srinagar')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261666" title="Dining Form_Srinagar"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Khajuraho')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261667" title="Dining Form_Khajuraho"]' );	 
				 
				 } elseif($GLOBALS['location'][0]->name=='Chandigarh')  {
					 
				 echo do_shortcode( '[contact-form-7 id="261668" title="Dining Form_Chandigarh"]' );	
				 
				 }  else  {
					 
				 echo do_shortcode( '[contact-form-7 id="3370" title="Dining Form"]' );	 
				 
				 }
            ?>

            <div class="thank-you-block" style="display:none;">
                  <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
                  <h2 class="sec-title align-center">Request Sent</h2>
                  <h4 class="intro-sec-title align-center margin-bottom50">Our representative will be in touch shortly.</h4>
            </div><!-- thank-you-block -->
           
        </div><!-- pop-up -->

        <?php
        if(isMobile())
        {
        ?>
            <script type="text/javascript">
              jQuery(document).ready( function () {
                  jQuery('.fancybox').fancybox({
                      autoSize : false,
                      width : "100%",
                      height : "auto",
                      helpers: {
                          overlay : {
                            locked : true
                          }
                      },
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                      },
                      afterShow: function() {
                        jQuery(".date-field").focus();
                      },
                      beforeClose: function() {
                        jQuery('.fancybox-opened form').trigger('reset');
                      },
                      beforeShow: function() {
                        jQuery("body").addClass("overlay-fixed");
                      }
                  });
              });

              jQuery(".mob-view").on("click", function() {
                  jQuery(this).next().slideToggle(400);
              });
            </script>
        <?php
        }
        else
        {
        ?>
            <script type="text/javascript">
              jQuery(document).ready( function () {
                  jQuery('.fancybox').fancybox({
                      autoSize : false,
                      width : "550px",
                      height : "auto",
                      helpers: {
                        overlay : {
                            locked : true
                        }
                      },
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                      },
                      afterShow: function() {
                        jQuery(".date-field").focus();
                      },
                      beforeClose: function() {
                        jQuery('.fancybox-opened form').trigger('reset');
                      },
                      beforeShow: function() {
                        jQuery("body").addClass("overlay-fixed");
                      }
                  });
              });
            </script>
        <?php
        }
        ?>
  
        <script type="text/javascript">
        
          var image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;
          jQuery(document).ready( function () {

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
                  showOn: "button",
                  buttonImageOnly: true,
                  showButtonPanel: true,
                  closeText: "Close",
                  dayNamesShort: ["S","M", "T", "W", "T", "F", "S"],
                  dayNamesMin: ["S","M", "T", "W", "T", "F", "S"],
                  onClose: function(){
                    jQuery('.date-field').focus();
                  }
              });
              var currentDate = new Date();  
              jQuery(".date-field").datepicker("setDate",currentDate);
              jQuery(".date-field").datepicker('option', 'minDate', currentDate);
              jQuery('.date-field').on('click', function(){
                
                jQuery('.date-field').datepicker('show');
              });

              jQuery(".reserve-btn").on("click", function() {

                  jQuery(".thank-you-block").fadeOut();
                  jQuery(".wpcf7, .form-header").fadeIn();

                  jQuery("#book-a-table").find(".wpcf7-response-output").remove();

                  jQuery("#book-a-table").find(".wpcf7-not-valid-tip").remove();
                  jQuery("#book-a-table").find(".wpcf7-response-output").html("");
                  jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
                  jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
                  jQuery("#book-a-table").find(".input-text").val("");

                  var currentDate = new Date();  
                  jQuery("#book-a-table").find(".date-field").datepicker("setDate",currentDate);
                  jQuery("#book-a-table").find(".date-field").datepicker('option', 'minDate', currentDate);

                  jQuery("body").addClass("overlay-on");
                  
              });

          
              jQuery(".content-section").find("img.image").each(function(index) {
                  jQuery(this).attr("src", image_array[index]);
              });
 
          });

          /*function successfull_form_submission()
          {    
              jQuery("#book-a-table").find(".wpcf7, .form-header").fadeOut(function() {
                  jQuery("#book-a-table").find(".thank-you-block").fadeIn();
                  jQuery.fancybox.update();

                  setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                  }, 5000);
              });
          }*/
          document.addEventListener( 'wpcf7mailsent', function( event ) {console.log(event);
            if ( '3370' == event.detail.contactFormId ) {
              jQuery("#book-a-table").find(".wpcf7, .form-header").fadeOut(function() {
                jQuery("#book-a-table").find(".thank-you-block").fadeIn();
                jQuery.fancybox.update();

                setTimeout(function() {
                  jQuery.fancybox.close();
                  jQuery("body").removeClass("overlay-on");
                }, 5000);
              });
            }
          }, false );

          jQuery('.card-info a').click(function() {
                jQuery(this).parent('.card-info').toggleClass('expand');
          });

          jQuery(".read_more").on("click", function() {
                jQuery(this).closest(".card-info").find(".trunc").hide();
                jQuery(this).closest(".card-info").find(".untrunc").show();
          }); 

          jQuery(".read_less").on("click", function() {
                jQuery(this).closest(".card-info").find(".untrunc").hide();
                jQuery(this).closest(".card-info").find(".trunc").show();
          });

          jQuery(window).scroll(function () {
            var fixSidebar = jQuery('.primary-nav').innerHeight();
            var contentHeight = jQuery('.sidebar-rcol').innerHeight();
            var sidebarHeight = jQuery('.sidebar-outer').height();
            var sidebarBottomPos = contentHeight - sidebarHeight; 
            var trigger = jQuery(window).scrollTop() - fixSidebar;

            if (jQuery(window).scrollTop() >= fixSidebar) 
            {
                //$('.side-navigation').addClass('fixed-sidebar');
            } 
            else 
            {
                jQuery('.sidebar-outer').removeClass('fixed-sidebar');
            }

            if (trigger >= sidebarBottomPos-40) 
            {
                jQuery('.sidebar-outer').addClass('sidebar-bottom');
            } 
            else 
            {
                jQuery('.sidebar-outer').removeClass('sidebar-bottom');
            }
        });
        
        jQuery(window).load(function(){
          
          var url_string = window.location.href;
          var url = new URL(url_string);
          var booking = url.searchParams.get("booking");
          if(booking){
            
            jQuery('.btn.secondary-btn.reserve-btn').trigger('click');
          }
        });

        </script>
    </body>    
</html>   