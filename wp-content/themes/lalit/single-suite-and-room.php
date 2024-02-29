<?php
$destination  = get_destination_by_feature_id("suites_and_rooms", $post->ID);

if( $destination->have_posts() ) : 
    while($destination->have_posts()) : $destination->the_post();

       $hotel_id = $post->ID;
  
    endwhile;
endif;
wp_reset_postdata();

$location = get_the_terms($hotel_id, 'locations');
$location_id = '';
foreach($location as $value)
{
  $location_id = $value->term_id;
}

$GLOBALS['destination'] = $destination;
$GLOBALS['location'] = $location;
$GLOBALS['location_id'] = $location_id;

$GLOBALS['page-name'] = 'room-details';


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
$itemList[2]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug.'/suites-and-rooms/';
$itemList[2]['item']['name'] = 'Stay';

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
    </head>
    <body <?php body_class('local-page'); ?>>
        <div class="main-wrap">
        	<?php get_header(); ?>

        		<?php get_template_part( 'detail-pages/room', 'detail' ); ?>

         	<?php get_footer(); ?>
        </div><!-- main-wrap -->    
    </body>
    
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
        
        var image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;

        jQuery(document).ready(function(){

            jQuery('.reserve-btn').on('click',function(){

                var bookingEngine = jQuery('#booking_engine').val();
                var bookingEngineURL = jQuery('#booking_engine_url').val();
                var bookingEngineHotelId = '';
                var bookingEngineHotelCode = '';
                var bookingEngineChainId = '';
                var url = '';
                var roomCode = jQuery('#room_id').val();
                var date = new Date();

                if(bookingEngine == '1')
                {
                    bookingEngineHotelCode = jQuery('#booking_engine_hotel_code').val();
                    url = bookingEngineURL+'/?Hotel='+bookingEngineHotelCode;
                    if(jQuery.trim(roomCode) != '')
                    {
                      url += '&room='+roomCode;
                    }
                    window.location.href = url+"&dateTime="+date.getTime();
                }
                else if(bookingEngine == '2')
                {
                    bookingEngineHotelId = jQuery('#booking_engine_hotel_id').val();
                    bookingEngineChainId = jQuery('#booking_engine_chain_id').val();
                    url = bookingEngineURL+'?Hotel='+bookingEngineHotelId+'&Chain='+bookingEngineChainId+'&start=availresults';
                    if(jQuery.trim(roomCode) != '')
                    {
                      url += '&Room='+roomCode;
                    }
                    window.location.href = url+"&dateTime="+date.getTime();
                }
            });

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

            jQuery(".content-section").find("img.image").each(function(index) {
                jQuery(this).attr("src", image_array[index]);
            });
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
    </script> 
</html>   