<?php
/**
 *
  Template Name: Weddings Listing Template
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Paper_Plane
 * @since PaperPlane 1.0
 */

$page_id = get_the_ID();
$parent_page_id = wp_get_post_parent_id( $page_id );

$location = get_the_terms($parent_page_id, 'locations');
$location_id = '';
foreach($location as $value)
{
     $location_id = $value->term_id;
}

$GLOBALS['location'] = $location;
$GLOBALS['location_id'] = $location_id;


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
$itemList[1]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug.'/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
$itemList[2]['item']['name'] = 'Weddings';

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
         <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/jquery.mCustomScrollbar.min.css">
        <style type="text/css">
            .ui-datepicker-trigger{
                display:none;
            }
        </style>
    </head>
    <body <?php body_class(); ?>>
        <div class="main-wrap">
          <?php get_header(); ?>

            <?php get_template_part( 'template-parts/weddings', 'listing' ); ?>

          <?php get_footer(); ?>
        </div>
        <div id="book-a-table" class="pop-up" style="display: none;">
              <div class="form-header">
                  <h2 class="page-title">
                      <small><?php echo $GLOBALS['form_hotel_title']; ?></small>
                      Contact a Wedding Planner
                  </h2>
                  <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
              </div>
              <?php
                echo do_shortcode( '[contact-form-7 id="3374" title="Wedding Form"]' );
              ?>

              <div class="thank-you-block" style="display:none;">
                  <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
                  <h2 class="sec-title align-center">Request Sent</h2>
                  <h4 class="intro-sec-title align-center margin-bottom50">Our representative will be in touch shortly.</h4>
              </div><!-- thank-you-block -->

        </div><!-- pop-up -->

        <div id="book-a-table2" class="pop-up" style="display: none;">
              <div class="form-header">
                  <h2 class="page-title">
                      <small><?php echo $GLOBALS['form_hotel_title']; ?></small>
                      Contact a Wedding Planner
                  </h2>
                  <p class="form-group-sub-text">Please enter all the fields to help you serve better.</p>
              </div>
              <?php
                echo do_shortcode( '[contact-form-7 id="4711" title="Wedding Service Form"]' );
              ?>
              
              <div class="thank-you-block" style="display:none;">
                  <span class="check-with-circle"><i class="sprite ico-check-with-circle"></i></span>
                  <h2 class="sec-title align-center">Request Sent</h2>
                  <h4 class="intro-sec-title align-center margin-bottom50">Our representative will be in touch shortly.</h4>
              </div><!-- thank-you-block -->

        </div><!-- pop-up -->

        
        <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
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
                         overlay: {
                            locked: true 
                         }
                      },
                      beforeClose: function() {
                            jQuery('.fancybox-opened form').trigger('reset');
                      },
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                        //jQuery('body').removeClass('main-wrap-fixed');
                      },
                      afterShow: function() {
                        jQuery('.fancybox-opened form select:first').focus();
                     },
                     beforeShow: function() {
                        jQuery('body').addClass('overlay-fixed');
                     }
                  });
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
                         overlay: {
                            locked: true 
                         }
                      },
                      beforeClose: function() {
                            jQuery('.fancybox-opened form').trigger('reset');
                      },
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                        //jQuery('body').removeClass('main-wrap-fixed');
                      },
                      afterShow: function() {
                        jQuery('.fancybox-opened form select:first').focus();
                     },
                     beforeShow: function() {
                        jQuery('body').addClass('overlay-fixed');
                     }
                  });
              });
            </script>
        <?php
        }
        ?>

        <script type="text/javascript">
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
                showOn: "both",
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

          });

          jQuery(".book-btn").on("click", function() {
              jQuery(".thank-you-block").fadeOut();
              jQuery(".wpcf7, .form-header").fadeIn();

              jQuery("#book-a-table").find(".wpcf7-response-output").remove();

              var data_id = jQuery(this).attr("data-id");
              jQuery('#book-a-table').find("#venue option[value='"+data_id+"']").prop('selected', true);
              jQuery('#book-a-table').find("#your-subject").val(jQuery(this).attr("subject"));

              jQuery("#book-a-table").find(".wpcf7-not-valid-tip").remove();
              jQuery("#book-a-table").find(".wpcf7-response-output").html("");
              jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
              jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
              jQuery("#book-a-table").find(".input-text").val("");
              jQuery("#book-a-table").find("input[type='checkbox']").prop("checked",false);

              var currentDate = new Date();  
              jQuery("#book-a-table").find(".date-field").datepicker("setDate",currentDate);
              jQuery("#book-a-table").find(".date-field").datepicker('option', 'minDate', currentDate);
              
              jQuery("body").addClass("overlay-on");

          });

          jQuery(".reserve-btn").on("click", function() {

            jQuery(".thank-you-block").fadeOut();
            jQuery(".wpcf7, .form-header").fadeIn();
            jQuery("#book-a-table").find(".wpcf7-response-output").remove();

            jQuery("#venue").trigger("change");

            jQuery("#book-a-table").find(".wpcf7-not-valid-tip").remove();
            jQuery("#book-a-table").find(".wpcf7-response-output").html("");
            jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
            jQuery("#book-a-table").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
            jQuery("#book-a-table").find(".input-text").val("");
            jQuery("#book-a-table").find("input[type='checkbox']").prop("checked",false);

            var currentDate = new Date();  
            jQuery("#book-a-table").find(".date-field").datepicker("setDate",currentDate);
            jQuery("#book-a-table").find(".date-field").datepicker('option', 'minDate', currentDate);
            
            jQuery("body").addClass("overlay-on");

          });

          jQuery("#venue").change(function() {
            var value = jQuery(this).val();
            jQuery('#book-a-table').find("#your-subject").val("Wedding Enquiry for "+value+" - <?php echo $GLOBALS['location'][0]->name; ?>");
          });


          jQuery(".wedding-service").find(".service-block").on("click", function() {

              jQuery(".thank-you-block").fadeOut();
              jQuery(".wpcf7, .form-header").fadeIn();
              jQuery("#book-a-table2").find(".wpcf7-response-output").remove();

              jQuery("#book-a-table2").find(".service_subject").val(jQuery(this).find(".service_subject").val());
              jQuery("#book-a-table2").find(".service_name").val(jQuery(this).find(".service_name").val());
              jQuery("#book-a-table2").find(".service_name").text(jQuery(this).find(".service_name").val());

              jQuery("#book-a-table2").find(".wpcf7-not-valid-tip").remove();
              jQuery("#book-a-table2").find(".wpcf7-response-output").html("");
              jQuery("#book-a-table2").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
              jQuery("#book-a-table2").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
              jQuery("#book-a-table2").find(".input-text").val("");
              
              jQuery("body").addClass("overlay-on");
             
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
          }

          function successfull_form_submission_service()
          {    
              jQuery("#book-a-table2").find(".wpcf7, .form-header").fadeOut(function() {
                  jQuery("#book-a-table2").find(".thank-you-block").fadeIn();
                  jQuery.fancybox.update();

                  setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                  }, 5000);
              });
          }*/

          document.addEventListener( 'wpcf7mailsent', function( event ) {console.log(event);
            if ( '3374' == event.detail.contactFormId ) {
              jQuery("#book-a-table").find(".wpcf7, .form-header").fadeOut(function() {
                  jQuery("#book-a-table").find(".thank-you-block").fadeIn();
                  jQuery.fancybox.update();

                  setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                  }, 5000);
              });
            }
            else if ( '4711' == event.detail.contactFormId ) {
              jQuery("#book-a-table2").find(".wpcf7, .form-header").fadeOut(function() {
                  jQuery("#book-a-table2").find(".thank-you-block").fadeIn();
                  jQuery.fancybox.update();

                  setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                  }, 5000);
              });
            }
          }, false );
            
              (function($){
                $(window).on("load",function(){
                    $(".scroll-content").mCustomScrollbar();
                });
            })(jQuery);
            
            
            
            $(document).ready(function(){
                $(".wedding-service .item-blk").mouseenter(function(){
                    if($(this).find(".scroll-content .mCSB_scrollTools").css('display') == 'block')
                    {
                        $('body').addClass("hover");
                    }
                });

                $(".wedding-service .item-blk").mouseleave(function(){           
                            $('body').removeClass("hover");            
                }); 
                $('.wedding-service .item-blk ').on({
                    'mousewheel': function(e) {
                        if($('body').hasClass('hover'))
                        {
                            e.preventDefault();
                            e.stopPropagation();
                        }
                    }
                });    
            });

        </script>
        <script type="text/javascript">

          var image_array = wedding_services_image_array = [];
          image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;
          wedding_services_image_array = <?php echo json_encode($GLOBALS['wedding_services_image_array']); ?>;

          jQuery(document).ready(function(){

            jQuery('.banner-list').each(function(index, el) {

              //img_url = image_array[index].replace("\\","");
    
              jQuery(this).css('background-image', 'url("'+image_array[index]+'")');

            });
          
            jQuery('.wedding-services-block').each(function(index, el) {

              //img_url = wedding_services_image_array[index].replace("\\","");
    
              jQuery(this).find('.img-div > img').attr('src',wedding_services_image_array[index]);

            });
            
            jQuery('.hide-show').show();

          });

        </script>
    </body>
</html>