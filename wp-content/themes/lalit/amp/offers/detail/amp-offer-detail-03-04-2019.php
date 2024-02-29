<?php
$hotel_id = get_post_meta($post->ID,'hotel',true);
$hotel_name = get_post_meta($hotel_id, 'name', true);

$GLOBALS['address'] = get_post_meta($hotel_id,"address",true);
$GLOBALS['email'] = get_post_meta($hotel_id,"email",true);
$GLOBALS['phone'] = get_post_meta($hotel_id,"phone",true);
$GLOBALS['fax'] = get_post_meta($hotel_id,"fax",true);
$GLOBALS['dining_object'] = get_post_meta( $hotel_id, "dinings", true);

$GLOBALS['offer_image'] = array();

$GLOBALS['review_widget'] = get_post_meta( $hotel_id, "review_widget", true);
 

$offer_name = get_post_meta($post->ID, "name", true);
// $offer_description = wpautop(get_post_meta($post->ID,'description', true));
// $offer_terms_and_conditions = wpautop(get_post_meta($post->ID,'terms_conditions',true));
// $offer_inclusions = wpautop(get_post_meta($post->ID,'inclusions',true));

$offer_description = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($post->ID,'description', true)));
$offer_terms_and_conditions = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($post->ID,'terms_conditions',true)));
$offer_inclusions = the_lalit_remove_image_tags_amp(wpautop(get_post_meta($post->ID,'inclusions',true)));

$offer_price = get_post_meta($post->ID,'offer_price',true);
$offer_image_ids = get_post_meta($post->ID, "image", true);

if(strpos($offer_image_ids,','))
{
    $offer_image_ids = explode(',', $offer_image_ids);
    $offer_image = wp_get_attachment_url($offer_image_ids[0]);
}
else
{
    $offer_image = wp_get_attachment_url($offer_image_ids);
}

$current_offer_id = $post->ID;
$current_city_offers = get_offers_by_destination('hotel', $hotel_id);
$city_offers_array = array();
if($current_city_offers->have_posts())
{
    $count = 0;
    while($current_city_offers->have_posts())
    {
        $current_city_offers->the_post();
        $offer_id = $post->ID;
        $city_offers_array[$count]['id'] = $offer_id;
        $city_offers_array[$count]['permalink'] = get_permalink($offer_id);
        if($offer_id == $current_offer_id) 
        {
          $city_offers_array[$count]['current'] = 'true';
        }
        else
        {
           $city_offers_array[$count]['current'] = 'false';
        }

        $count++;
    }
}
wp_reset_postdata();
$current_key = array_search($post->ID,array_column($city_offers_array, 'id'));
?>

<div class="content-section">

    <div class="container offer-details h-product">
        <div class="row">
            <div class="detail-breadcrumb-container">
                <a on="tap:AMP.setState({visited_<?php echo $GLOBALS['location'][0]->slug; ?>: !visited_<?php echo $GLOBALS['location'][0]->slug; ?>})" [class]="visited_<?php echo $GLOBALS['location'][0]->slug; ?> ? 'active detail-breadcrumb-link' : 'detail-breadcrumb-link'" class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/"><?php echo $hotel_name; ?></a>
                <span class="breadcrumb-separator"></span>
                <a on="tap:AMP.setState({visited_offers: !visited_offers})" [class]="visited_offers ? 'active detail-breadcrumb-link' : 'detail-breadcrumb-link'" class="detail-breadcrumb-link" href="/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/offers/?amp">Offers</a>
                <span class="breadcrumb-separator"></span>
                <a class="detail-breadcrumb-link last-breadcrumb-link"><?php echo $offer_name; ?></a>
            </div>

            <?php if(trim($offer_name) != '') { ?>
            <h2 class="sec-title p-name"><?php echo $offer_name; ?></h2>
            <?php } ?>
        </div>
    </div>
    
  
    <div class="container offer-inner">
        <div class="row">
            <div class="col col5"> 
                <?php if(trim($offer_description) != '') 
                { 
                ?>
                    <p class="marB20"><?php echo $offer_description; ?></p>
                <?php 
                } 
                ?>

                <?php 
                if(trim($offer_inclusions) != '')
                { 
                ?>
                    <div class="sub-section">
                      <h4 class="item-title">Inclusions</h4>  
                      <?php echo $offer_inclusions; ?>
                    </div><!-- sub-section -->
                <?php 
                } 
                ?>

                <?php 
                if(trim($offer_terms_and_conditions) != '')
                { 
                ?>
                    <div class="sub-section">  
                      <h4 class="item-title">Terms &amp; Conditions</h4>  
                      <?php echo $offer_terms_and_conditions; ?>   
                    </div><!-- sub-section -->
                <?php 
                } 
                ?>

                <?php 
                if($GLOBALS['location'][0]->slug != '' && trim($hotel_name) != '')
                { 
                ?>
                    <a href="<?php echo get_home_url().'/the-lalit-'.$GLOBALS['location'][0]->slug.'/offers/?amp'; ?>" class="text-link offer-text-link">View all offers at <?php echo $hotel_name; ?> <i class="ico-sprite sprite ico-red-right-arrow"></i></a>
                <?php 
                } 
                ?>
            </div><!-- col -->
            <div class="col col7">
                <?php
                if($offer_image != '')
                {
                ?>
                    <div id="slider" class="flexslider slider offer-image">
                        <ul class="slides">
                            <li>
                                <amp-img src="<?php echo $offer_image; ?>"
                                    width="820"
                                    height="600"
                                    layout="responsive"
                                    alt="<?php echo $offer_name; ?>">
                                </amp-img>
                            </li>
                        </ul>
                    </div><!-- slider --> 
                <?php 
                }
                if(trim($offer_price) != '')
                { 
                ?> 
                <div class="btn-block offer-starting-price-container">
                ?>
                <div class="btn-block">
                    <div class="row">
                        <div class="col col6 offer-starting-price">
                            <span class="label">Offer Starting at</span>
                            <strong class="label offer-detail-price-show"><span class="woocommerce-Price-currencySymbol">₹</span><?php echo $offer_price; ?></strong>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- btn-block -->
                <?php 
                }
                ?>
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
    <div class="container offer-details-arrows clearfix">
        <div class="row">
            <?php
                if($city_offers_array[$current_key-1]['permalink'])
                { 
                ?>
                    <div class="prev-arrow-container">
                        <a class="offer-arrows offer-prev btn tertiary-btn" href="<?php echo $city_offers_array[$current_key-1]['permalink'].'amp/'; ?>"><i class="ico-sprite sprite ico-offer-left-arrow"></i></i><span class="offer-text prev-offer-text">Previous Offer</a>
                    </div>
                <?php
                }
                ?>

                <?php
                if($city_offers_array[$current_key+1]['permalink'])
                {
                ?>
                    <div class="next-arrow-container">
                        <a class="offer-arrows offer-next btn tertiary-btn" href= "<?php echo $city_offers_array[$current_key+1]['permalink'].'amp/'; ?>"><span class="offer-text next-offer-text">Next Offer</span><i class="ico-sprite sprite ico-offer-right-arrow"></i></a>
                    </div>

                <?php
                }
            ?>
        </div>
    </div>
</div><!-- content-section -->