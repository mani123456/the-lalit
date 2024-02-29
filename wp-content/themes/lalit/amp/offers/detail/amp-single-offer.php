<?php
global $post;
$hotel_id = get_post_meta($post->ID,'hotel',true);

$location = get_the_terms($hotel_id, 'locations');
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
    <body <?php body_class('local-page'); ?> on="tap:booking-widget-accordion.collapse" role="button" tabindex="0">
            <?php include_once(get_template_directory() . '/amp/includes/amp-header.php'); ?>

                <?php include_once(get_template_directory() . '/amp/offers/detail/amp-offer-detail.php'); ?>

            <?php include_once(get_template_directory() . '/amp/includes/amp-footer.php'); ?>
        </div><!-- main-wrap -->
        <!--<script type="text/javascript">

            var offer_image = [];
            offer_image = <?php echo json_encode($GLOBALS['offer_image']); ?>;
            
            jQuery(document).ready(function(){

                img_url = offer_image[0].replace("\\","");
                jQuery('.offer-image').find('img').attr('src',img_url);

            });

        </script>-->
    </body>
</html>   