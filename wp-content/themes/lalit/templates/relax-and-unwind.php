<?php
/**
 *
  Template Name: Relax and Unwind Template
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
 $location = get_the_terms($page_id, 'locations');
 $location_id = '';
 $global_city = '';
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
$itemList[2]['item']['name'] = 'Relax and Unwind';
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
      <link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/owl.carousel.min.css" />
      <style type="text/css">
            .ui-datepicker-trigger{
                display:none;
            }
      </style>
   </head>
   <body <?php body_class(); ?>>
      <div class="main-wrap">
         <?php get_header(); ?>

            <?php get_template_part( 'template-parts/relax-and-unwind', 'overview' ); ?>

         <?php get_footer(); ?>
      </div>

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
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                        //jQuery('body').removeClass('main-wrap-fixed');
                      },
                      afterShow: function() {
                        jQuery("#treatment").focus();
                      },
                      beforeClose: function() {
                        jQuery('.fancybox-opened form').trigger('reset');
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
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                        //jQuery('body').removeClass('main-wrap-fixed');
                      },
                      afterShow: function() {
                        jQuery("#treatment").focus();
                       // jQuery('body').addClass('overlay-fixed');
                      },
                      beforeClose: function() {
                        jQuery('.fancybox-opened form').trigger('reset');
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
            var currentyear = new Date().getFullYear();
            var nextYear = new Date().getFullYear() + 1;
            var yearRange = currentyear+":"+nextYear;

            jQuery(".pop-up").each(function() {

                jQuery(this).find(".date-field").datepicker({
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
                jQuery(this).find(".date-field").datepicker("setDate",currentDate);
                jQuery(this).find(".date-field").datepicker('option', 'minDate', currentDate);   

            }); 

          });

          jQuery(".res-btn").on("click", function() {

               jQuery(".thank-you-block").fadeOut();
               jQuery(".wpcf7, .form-header").fadeIn();
               jQuery(".pop-up").find(".wpcf7-response-output").remove();

               var href = jQuery(this).attr("href");
               var $c = jQuery(this).attr("data-count");
               $subject = jQuery(this).parent().find("#subject-"+$c).val();
               $wellness_name = jQuery(this).parent().find("#wellness-name-"+$c).val();

               jQuery("#book-a-table-"+$c).find("#your-subject").val($subject);
               jQuery("#book-a-table-"+$c).find("#wellness-name").val($wellness_name);

               jQuery("#book-a-table-"+$c).find(".wpcf7-not-valid-tip").remove();
               jQuery("#book-a-table-"+$c).find(".wpcf7-response-output").html("");
               jQuery("#book-a-table-"+$c).find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
               jQuery("#book-a-table-"+$c).find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
               jQuery("#book-a-table-"+$c).find(".input-text").val("");
               jQuery("#book-a-table-"+$c).find("input[type='checkbox']").prop("checked",false);

               var currentDate = new Date();  
               jQuery("#book-a-table-"+$c).find(".date-field").datepicker("setDate",currentDate);
               jQuery("#book-a-table-"+$c).find(".date-field").datepicker('option', 'minDate', currentDate);

               jQuery("body").addClass("overlay-on");

               //return false;
          });

          /*function successfull_form_submission()
          {    
              jQuery(".pop-up:visible").find(".wpcf7, .form-header").fadeOut(function() {
                  jQuery(".pop-up:visible").find(".thank-you-block").fadeIn();
                  jQuery.fancybox.update();

                  setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                  }, 5000);
              });
          }*/

          document.addEventListener( 'wpcf7mailsent', function( event ) {console.log(event);
              if ( '3372' == event.detail.contactFormId ) {
                jQuery(".pop-up:visible").find(".wpcf7, .form-header").fadeOut(function() {
                  jQuery(".pop-up:visible").find(".thank-you-block").fadeIn();
                  jQuery.fancybox.update();

                  setTimeout(function() {
                    jQuery.fancybox.close();
                    jQuery("body").removeClass("overlay-on");
                  }, 5000);
              });
              }
          }, false );
          
        </script>
        <script type="text/javascript">

          var image_array = [];
          var spa_images = [];
          var needs_array = [];
          image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;
          spa_images = <?php echo json_encode($GLOBALS['spa_images']); ?>;
          needs_array = <?php echo json_encode($GLOBALS['needs_array']); ?>;

          jQuery(document).ready(function(){

            jQuery('.banner-list').each(function(index, el) {

              //img_url = image_array[index].replace("\\","");
    
              jQuery(this).css('background-image', 'url("'+image_array[index]+'")');

            });

            jQuery('.hide-show').show();


            jQuery('.spa_images').each(function(index, el) {
              
              //spa_img_url = spa_images[index].replace("\\","");
              jQuery(this).find('img').attr('src',spa_images[index]);

            });

            jQuery('.card-item').each(function(index, el) {
              
              //needs_img_url = needs_array[index].replace("\\","");
              jQuery(this).find('img').attr('src',needs_array[index]);

            });

          });

        </script>
        <script defer src="<?php echo get_stylesheet_directory_uri(); ?>/js/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function(){
                
              $('.owl-carousel').owlCarousel({
                  autoplay: false,
                  center: true,
                  loop: true,
                  nav:true,
                  dots: true,
                  responsiveClass:true,
                      responsive:{
                        0:{
                            items:1,
                            nav:true
                        },
                         768:{
                            items:2,
                            nav:true
                        },
                           1024:{
                            items:3,
                            nav:true
                        }
                      }
              });
                
            });

            /* On clicking Book Rejuve the spa on the amp page*/
            $(window).load(function(){

              var url_string = window.location.href
              var url = new URL(url_string);
              var c = url.searchParams.get('book-a-table');
              $("a[href='#book-a-table-"+c+"']").trigger('click');
            });

            /* On clicking Book Rejuve the spa on the amp page*/
        </script>
   </body>
</html>