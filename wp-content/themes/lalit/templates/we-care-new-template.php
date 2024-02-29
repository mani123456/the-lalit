<?php
/**
 *
  Template Name: We Care New Landing Template
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage spysr_
 * @since spysr
 */

$position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url() . '/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
$itemList[1]['item']['name'] = get_the_title();

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

            <?php get_template_part( 'template-parts/we-care-new', 'listing' ); ?>

          <?php get_footer();  ?>
        </div>
    </body>

    <script>
      var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
      var image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;
      var banner_image_array = <?php echo json_encode($GLOBALS['banner_image_array']); ?>;

      jQuery(document).ready(function() {
          jQuery(".main-wrap").find(".image").hide();
          setTimeout(function() {
              jQuery(".main-wrap").find(".image").each(function(index, element) {
                  var img = new Image();
                  img.src = image_array[index];
                  jQuery(img).load(function() {
                      element.src = image_array[index];
                      jQuery(element).fadeIn(200);
                  });  
              });

              jQuery(".content-section").find(".banner-image").each(function(index) {
                  jQuery(this).css("background-image", "url('"+banner_image_array[index]+"')");
              });
          }, 1000);

          applyOrientation();
      });

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
      
      jQuery(window).load(function() {

            var sPageURL = window.location.search.substring(1);
            if(sPageURL && sPageURL != '')
            {
                var sParameterName = sPageURL.split('=');
                var param = sParameterName[1];
                
                $('html, body').animate({
                  scrollTop: $("#"+param).offset().top - (jQuery(".nav-bar-fill").height() + 10)
                }, 800);

                return false;
            }     
      });

      jQuery(".two-col-listing, .three-col-listing").find(".card-info").on("click", function() {
          var href = jQuery(this).find(".permalink").val();
          window.location = href;
      });

      window.onresize = function (event) {
          applyOrientation();
      };

      function applyOrientation()
      {
          if(ismobile)
          {            
              if(window.innerHeight > window.innerWidth)
              {
                  jQuery(".item-listing").find(".row").removeClass("two-col-listing");
                  jQuery(".item-listing").find(".row").addClass("three-col-listing");
                  jQuery(".item-listing").find(".row").find(".card-item").addClass("col4");
                  jQuery(".item-listing").find(".row").find(".card-item").removeClass("mob-col6");
              }
              else
              {
                  jQuery(".item-listing").find(".row").removeClass("three-col-listing");
                  jQuery(".item-listing").find(".row").addClass("two-col-listing");
                  jQuery(".item-listing").find(".row").find(".card-item").removeClass("col4");
                  jQuery(".item-listing").find(".row").find(".card-item").addClass("mob-col6");
              }
          }
      }
      
    </script>
</html>