<?php

$GLOBALS['current_theme_template'] = 'hotel-overview';
 $page_id = get_the_ID();
 $location = get_the_terms($page_id, 'locations');
 $location_id = '';
 foreach($location as $value)
 {
      $location_id = $value->term_id;
 }

 $GLOBALS['location'] = $location;
 $GLOBALS['location_id'] = $location_id;


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


$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug.'/';
$itemList[1]['item']['name'] = $hotel_name;

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
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
        <?php
          $css = file_get_contents(get_template_directory()."/stylesheets/css/amp.min.css");

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
   <body <?php body_class('local-page'); ?>>
         <?php include_once(get_template_directory() . '/amp/includes/amp-header.php'); ?>

            <?php include_once(get_template_directory() . '/amp/hotel-overview/amp-hotel-overview-listing.php'); ?>

         <?php include_once(get_template_directory() . '/amp/includes/amp-footer.php'); ?>
      </div><!-- main-wrap -->    
   </body>

      <!-- <script type="text/javascript">
	      var is_iPad = navigator.userAgent.match(/iPad/i) != null;
         var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
         
         var service_images = <?php echo json_encode($GLOBALS['hotel_service_image']); ?>;
         var banner_images = <?php echo json_encode($GLOBALS['banner_images']); ?>;

         var hotel_name = <?php echo json_encode($GLOBALS['hotel_name']); ?>;
         var hotel_address = <?php echo json_encode($GLOBALS['address']); ?>;
         var hotel_email = <?php echo json_encode($GLOBALS['email']); ?>;
         var hotel_image = <?php echo json_encode($GLOBALS['hotel_image']); ?>;
         var hotel_phone = <?php echo json_encode($GLOBALS['phone']); ?>;
         var hotel_fax = <?php echo json_encode($GLOBALS['fax']); ?>;
      </script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/hotel-overview.min.js" async></script> -->
   </body>
</html>