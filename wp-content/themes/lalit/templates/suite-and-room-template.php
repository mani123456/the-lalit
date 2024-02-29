<?php
/**
 *
  Template Name: Suites and Rooms Landing Template
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
$itemList[1]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug . '/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] =  site_url() . $_SERVER['REQUEST_URI'];
$itemList[2]['item']['name'] = 'Stay';

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
    <body <?php body_class('local-page'); ?>>
        <div class="main-wrap">

        	<?php get_header(); ?>

        		<?php get_template_part( 'template-parts/room', 'listing' ); ?>

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
                      beforeShow: function(){
                        jQuery('body').addClass('overlay-fixed');
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
                      width : "800px",
                      height : "auto",
                      helpers: {
                         overlay: {
                            locked: true 
                         }
                      },
                      beforeShow: function(){
                        jQuery('body').addClass('overlay-fixed');
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
            var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
            var image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;
            var banner_image_array = <?php echo json_encode($GLOBALS['banner_image_array']); ?>;

            jQuery('.read_more').click(function() {
               jQuery(this).closest(".sub-section").find(".service-list").find("li.hiddeble").show();
               jQuery(this).hide();
               jQuery(this).next().show();
            });

            jQuery('.read_less').click(function() {
               jQuery(this).closest(".sub-section").find(".service-list").find("li.hiddeble").hide();
               jQuery(this).hide();
               jQuery(this).prev().show();
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

            jQuery(document).ready(function() {
                jQuery(".content-section").find(".image").hide();
                setTimeout(function() {
                    jQuery(".content-section").find("img.image").each(function(index, element) {
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
		<!-- Sojern Container Tag cp_v1_js, Pixel Version: 1 -->
<script>
(function () {
/* Please fill the following values. */
var params = {
hpid: "76565", /* Property ID */
pt: "PRODUCT" /* Page Type - HOME_PAGE or PRODUCT or TRACKING */
};
/* Please do not modify the below code. */
var paramsArr = [];
for(key in params) { paramsArr.push(key + '=' + encodeURIComponent(params[key])) };
var pl = document.createElement('script');
pl.type = 'text/javascript';
pl.async = true;
pl.src = "https://beacon.sojern.com/pixel/cp/11?f_v=cp_v1_js&p_v=1&" + paramsArr.join('&');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')
[0]).appendChild(pl);
})();
</script>
<!-- End Sojern Tag -->

    </body>
</html>