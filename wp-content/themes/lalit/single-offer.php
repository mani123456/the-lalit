<?php
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
$itemList[2]['item']['@id'] = site_url().'/'.'the-lalit-'.$location[0]->slug.'/offers/';
$itemList[2]['item']['name'] = 'Offers';

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
    <body <?php body_class(); ?>>
        <div class="main-wrap">
            <?php get_header(); ?>

                <?php get_template_part( 'detail-pages/offer', 'detail' ); ?>

            <?php get_footer(); ?>
        </div><!-- main-wrap -->
        <script type="text/javascript">

            var offer_image = [];
            offer_image = <?php echo json_encode($GLOBALS['offer_image']); ?>;
            
            jQuery(document).ready(function(){

                img_url = offer_image[0].replace("\\","");
                jQuery('.offer-image').find('img').attr('src',img_url);

            });

        </script>   
    </body>
</html>   