<?php
/**
 *
  Template Name: Location Template
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
$itemList[2]['item']['name'] = 'Location';
?>

<!DOCTYPE html>
<html>
   <head>
      <?php wp_head(); ?>
      <?php get_template_part('includes/css', 'js'); 
          get_template_part('includes/global', 'schema');
      ?>
      <script type="application/ld+json">
      {
          "@context": "http://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": <?php echo json_encode($itemList); ?>
      }
      </script>
      <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 100%;
        }
	    </style>
   </head>
   <body <?php body_class(); ?>>
      <div class="main-wrap">
         <?php get_header(); ?>
      

            <?php get_template_part( 'template-parts/location', 'overview' ); ?>
          
          
         <?php get_footer(); ?>
      </div>
      <script type="text/javascript">
      
        var image_or_video_array = [];
        image_or_video_array = <?php echo json_encode($GLOBALS['image_or_video_array']); ?>;

        jQuery(document).ready(function(){

          jQuery('.banner-list').each(function(index, el) {

            //img_url = image_or_video_array[index].replace("\\","");
  
            jQuery(this).css('background-image', 'url("'+image_or_video_array[index]+'")');

          });
          
          jQuery('.hide-show').show();


        });

      </script>
   </body>
</html>