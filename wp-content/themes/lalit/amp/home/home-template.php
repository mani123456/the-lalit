<?php

/*$GLOBALS['current_theme_template'] = 'home-page';
 $page_id = get_the_id();
 $location = get_the_terms($page_id, 'locations');var_dump($location);exit;
 $location_id = '';
 foreach($location as $value)
 {
      $location_id = $value->term_id;
 }

 $GLOBALS['location'] = $location;
 $GLOBALS['location_id'] = $location_id;*/


global $wp;
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

?>

<!DOCTYPE html>
<html amp>
   <head>
      <?php wp_head(); ?>
      <?php include_once(get_template_directory() . '/amp/includes/amp-css-js.php'); ?>
        <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": <?php echo json_encode($itemList); ?>
        }
        </script>
        <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
        <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
        <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
        <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
        <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
        <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
        <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
        <?php
          $css = file_get_contents(get_template_directory()."/stylesheets/css/amp-global.min.css");

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
   <body <?php body_class('global-page'); ?>>
         <?php include_once(get_template_directory() . '/amp/includes/amp-header.php'); ?>

            <?php include_once(get_template_directory() . '/amp/home/home-listing.php'); ?>

         <?php include_once(get_template_directory() . '/amp/includes/amp-footer.php'); ?>
      </div><!-- main-wrap -->    
   </body>
</html>