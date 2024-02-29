<?php
/**
 *
  Template Name: Contact Us Landing Template
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

 /*$page_id = get_the_ID();
 $parent_page_id = wp_get_post_parent_id( $page_id );

 $location = get_the_terms($parent_page_id, 'locations');
 $location_id = '';
 foreach($location as $value)
 {
      $location_id = $value->term_id;        
 }

 $GLOBALS['location'] = $location;
 $GLOBALS['location_id'] = $location_id;*/

 $position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().$_SERVER['REQUEST_URI'];
$itemList[1]['item']['name'] = get_the_title(get_the_id());
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
    <body <?php body_class('global-page'); ?>>
        
        <div class="main-wrap">
        	<?php get_header(); ?>

        		<?php get_template_part( 'template-parts/contact-us', 'listing' ); ?>

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
              </script>
          <?php
          }
        ?>
        <script type="text/javascript">

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
                if ( '7208' == event.detail.contactFormId ) {
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