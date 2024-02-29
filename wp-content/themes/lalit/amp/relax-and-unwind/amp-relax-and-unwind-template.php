<?php

$GLOBALS['current_theme_template'] = 'relax-and-unwind';
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
<html amp>
   <head>
        <?php wp_head(); ?>
        <?php include_once(get_template_directory() . '/amp/includes/amp-css-js.php'); ?>
        <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
        <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
        <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
        <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
        <?php
          $css = file_get_contents(get_template_directory()."/stylesheets/css/amp-relax-unwind.min.css");

          if($css != '') {
            ?>
            <style amp-custom>
              <?php
                echo $css;
              ?>
            </style>
            <?php
            }
        ?>
   </head>
    
   <body <?php body_class('local-page'); ?> on="tap:booking-widget-accordion.collapse, offer-filter-accordion.collapse" role="button" tabindex="0">
         <?php include_once(get_template_directory() . '/amp/includes/amp-header.php'); ?>

            <?php include_once(get_template_directory() . '/amp/relax-and-unwind/amp-relax-and-unwind-listing.php'); ?>

         <?php include_once(get_template_directory() . '/amp/includes/amp-footer.php'); ?>
      </div><!-- main-wrap -->    
   </body>
</html>   