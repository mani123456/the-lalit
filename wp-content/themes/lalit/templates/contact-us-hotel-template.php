<?php
/**
 *
  Template Name: Contact Us Hotel Landing Template
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
$itemList[2]['item']['@id'] = site_url().$_SERVER['REQUEST_URI'];
$itemList[2]['item']['name'] = get_the_title(get_the_id());
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
    </head>
    <body <?php body_class(); ?>>
        
        <div class="main-wrap">
        	<?php get_header(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

        		  <?php get_template_part( 'template-parts/contact-us-hotel', 'listing' ); ?>

            <?php endwhile; ?>
            
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
                        afterShow: function(){
                            jQuery("#salutation").focus();
                        },
                        beforeShow: function() {
                            jQuery('body').addClass('overlay-fixed');
                        },
                        beforeClose: function() {
                            jQuery('.fancybox-opened form').trigger('reset');
                        },
                        afterClose: function(){
                            jQuery('body').removeClass('overlay-fixed');
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
                        width : "605px",
                        height : "auto",
                        helpers: {
                            overlay: {
                                locked: true 
                            }
                        },
                        afterShow: function(){
                            jQuery("#salutation").focus();
                        },
                        beforeShow: function() {
                            jQuery('body').addClass('overlay-fixed');
                        },
                        beforeClose: function() {
                            jQuery('.fancybox-opened form').trigger('reset');
                        },
                        afterClose: function(){
                            jQuery('body').removeClass('overlay-fixed');
                        }
                    });
                });
                jQuery(window).load(function(){

                    jQuery('.reservation-section span.span2:nth-child(1)').removeClass('fade-border-left');
                    jQuery('.managers-section span.span2:nth-child(1)').removeClass('fade-border-left');
                    var countArr = [];
                    jQuery('.managers-section span.span2').each(function(index,element){
                        countArr.push(jQuery(this).children().length);
                    });

                    var largestCountIndex = countArr.indexOf(Math.max.apply(null, countArr));
                    
                    jQuery('.managers-section span.span2').height(jQuery('.managers-section span.span2:nth-child('+(largestCountIndex + 1)+')').height());
                    
                });
              </script>
          <?php
          }
        ?>
        <script type="text/javascript">
            var environment = <?php echo json_encode(ENV); ?>;

            jQuery('.contact-btn').on('click',function(){

              jQuery(".thank-you-section").fadeOut();
              jQuery('#contact-us').find('form').fadeIn();
              jQuery(".form-header").fadeIn(function(){
                jQuery('.fancybox-title.fancybox-title-float-wrap').hide();
              });
              

              jQuery('div.wpcf7-response-output').remove();
              jQuery('.fancybox-title.fancybox-title-float-wrap').hide();

              jQuery("#contact-us").find(".wpcf7-response-output").remove();

              jQuery("#contact-us").find(".wpcf7-not-valid-tip").remove();
              jQuery("#contact-us").find(".wpcf7-response-output").html("");
              jQuery("#contact-us").find(".wpcf7-response-output").removeClass("wpcf7-mail-sent-ok");
              jQuery("#contact-us").find(".wpcf7-response-output").removeClass("wpcf7-validation-errors");
              jQuery("#contact-us").find(".input-text").val("");

              jQuery("#contact-us").find('.wpcf7-validation-errors,.fancybox-title').remove();
              //jQuery("#contact-us").find('.ajax-loader').remove();

            });

            jQuery(window).load(function(){

              jQuery("#hotel-subject").val(jQuery('#email_subject').val());

              if(environment == 'production') {
                  jQuery("#hotel-email").val(jQuery("#reservation_email").val());
              }
              else {
                jQuery("#hotel-email").val("corporate@thelalit.com");
              }   

              jQuery("#your-subject").val(jQuery("#flamingo_subject").val());

              jQuery("#general-manager-email").val(jQuery("#general_manager_email").val());

              jQuery("#general-manager-name").val(jQuery("#general_manager_name").val());


            });
    
            /*function contact_request_sent()
            {    

                jQuery('.name-section').text("for your contact request "+jQuery('#salutation').val()+". "+jQuery('#first-name').val()+" "+jQuery('#last-name').val());
                jQuery('#contact-us').find('form').fadeOut();
                jQuery(".form-header").fadeOut(function() {
                    jQuery(".thank-you-section").fadeIn();
                    jQuery.fancybox.update();

                    setTimeout(function() {
                      jQuery.fancybox.close();
                    }, 15000);
                });
            }*/

            document.addEventListener( 'wpcf7mailsent', function( event ) {console.log(event);
                if ( '7207' == event.detail.contactFormId ) {
                  jQuery('.name-section').text("for your contact request "+jQuery('#salutation').val()+". "+jQuery('#first-name').val()+" "+jQuery('#last-name').val());
                  jQuery('#contact-us').find('form').fadeOut();
                  jQuery(".form-header").fadeOut(function() {
                    jQuery(".thank-you-section").fadeIn();
                    jQuery.fancybox.update();

                    setTimeout(function() {
                      jQuery.fancybox.close();
                    }, 15000);
                  });
                }
            }, false );
        </script>
    </body>
</html>