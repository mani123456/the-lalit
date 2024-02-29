<?php
/**
 *
  Template Name: City Attraction Landing Template
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
$itemList[2]['item']['name'] = get_the_title();

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
    </head>
    <body <?php body_class('local-page'); ?>>
        <div class="main-wrap">
        	<?php get_header(); ?>

        		<?php get_template_part( 'template-parts/city-attraction', 'listing' ); ?>

        	<?php get_footer(); ?>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>    
    <script>
        var image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;

        (function($){
            jQuery(window).on("load",function(){
                jQuery(".scroll-content").mCustomScrollbar();
            });
        })(jQuery);
        
           
        jQuery(document).ready(function(){
            jQuery(".city-attraction-sec .item-blk").mouseenter(function(){
                if($(this).find(".scroll-content .mCSB_scrollTools").css('display') == 'block')
                {
                    $('body').addClass("hover");
                }
            });

            jQuery(".city-attraction-sec .item-blk").mouseleave(function(){           
                jQuery('body').removeClass("hover");            
            });  
             
            
            jQuery('.city-attraction-sec .item-blk ').on({
                'mousewheel': function(e) {
                    if($('body').hasClass('hover'))
                    {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                }
            });

            setTimeout(function() {
                jQuery(".content-section").find("img.image").each(function(index) {
                    jQuery(this).attr("src", image_array[index]);
                });
            }, 2600);
        });
    </script>
</html>