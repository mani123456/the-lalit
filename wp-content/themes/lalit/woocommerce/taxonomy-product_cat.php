<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$current_category = get_queried_object();
$current_category_id = $current_category->term_id;

$category_array = array();

$current_url = substr($_SERVER['REQUEST_URI'], 1);
$url_array = explode('/', $current_url);
if($url_array[0] == 'products')
{
	$parent_cateory_slug = $url_array[1];
}
else
{
	$parent_cateory_slug = $url_array[0];
}
$location_array = explode('-', strtolower($parent_cateory_slug));
$location_slug = strtolower(end($location_array));
$loc = get_term_by('slug', $location_slug, 'locations');
$GLOBALS['location'] = array($loc);
$GLOBALS['location_id'] = $loc->term_id;

$hotel = get_posts(array(
  'post_type' => 'destination',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'locations',
      'field' => 'id',
      'terms' => $loc->term_id, // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
));
$GLOBALS['address'] = get_post_meta($hotel[0]->ID,"address",true);
$GLOBALS['email'] = get_post_meta($hotel[0]->ID,"email",true);
$GLOBALS['phone'] = get_post_meta($hotel[0]->ID,"phone",true);
$GLOBALS['fax'] = get_post_meta($hotel[0]->ID,"fax",true);
$GLOBALS['review_widget'] = get_post_meta( $hotel[0]->ID, "review_widget", true);

$parent_category = get_term_by('slug', $parent_cateory_slug, 'product_cat');

$array = array(
	'term_id' => $parent_category->term_id,
	'slug' => $parent_category->slug,
	'name' => $parent_category->name,
	'link' => get_term_link($parent_category->term_id, 'product_cat')
);

array_push($category_array, $array);

$child_terms = get_term_children($parent_category->term_id, 'product_cat');
foreach($child_terms as $terms)
{
	$data = get_term_by('id', $terms, 'product_cat');
	if($data->parent == $parent_category->term_id)
	{
		$products = get_posts(array(
		  'post_type' => 'product',
		  'numberposts' => -1,
		  'tax_query' => array(
		    array(
		      'taxonomy' => 'product_cat',
		      'field' => 'id',
		      'terms' => $data->term_id, // Where term_id of Term 1 is "1".
		      'include_children' => true
		    )
		  )
		));
		if($products)
		{
			$array = array(
				'term_id' => $data->term_id,
				'slug' => $data->slug,
				'name' => $data->name,
				'link' => get_term_link($data->term_id, 'product_cat')
			);
			array_push($category_array, $array);
		}
	}
}

$position = 1;
$destination_obj = get_destination_by_taxanomy('locations', $GLOBALS['location_id']);
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
$itemList[1]['item']['@id'] = site_url().'/the-lalit-'.$location_slug.'/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url().'/products/'.'the-lalit-'.$location_slug.'/';
$itemList[2]['item']['name'] = 'Offers At The LaLiT '.ucfirst($location_slug);

if(stripos($current_category->name, 'The Lalit') == false && $current_category->parent != 0){
	$itemList[3]['@type'] = 'ListItem';
	$itemList[3]['position'] = $position + 3;
	$itemList[3]['item']['@id'] = site_url().$_SERVER['REQUEST_URI'];
	$itemList[3]['item']['name'] = $current_category->name;
}
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
    <body <?php body_class('local-page product-listing-section'); ?> >
    	<div class="main-wrap">
    		<?php get_header(); ?>

    			<div class="content-section">
					<div class="page-con">
						<div class="main-banner product-offer-banner">
							<?php
							if(isMobile())
							{
							?>
								<img src="/wp-content/themes/lalit/images/banner-offers-landing-mob.jpg" alt="Product Category banner">
							<?php
							}
							else
							{
							?>
								<img src="/wp-content/themes/lalit/images/banner-offers-landing.jpg" alt="Product Category banner">
							<?php
							}
							?>
								<div class="banner-content">
									<h1 class="main-title text-white text-shadow ">
										<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
											<span class="pos-rel">Offers At <?php echo $parent_category->name; ?>
											<i class="back-shadow"></i>
										</span>
										<?php endif; ?>
									</h1>
								</div>
						</div>

						<?php 
						if(isset($category_array) && count($category_array) > 0)
						{
						?>
						<div class="product-listing-breadcrumb">
							<div class="row">
								<div class="col col12">
									<?php 
									if(isMobile() || isIPad())
									{ 
										if($current_category->term_id == $parent_category->term_id)
										{
											$current_c = 'Our Offers';
										}
										else
										{
											$current_c = $current_category->name;
										}

									?>
                          				<a class="selected_value filter-item mob-view"><?php echo $current_c; ?> <i class="ico-sprite sprite ico-gre-down-arrow"></i></a>
                        			<?php 
                        			} 
                        			?>
									<ul class="smooth-scroll unstyled-listing filter-box filter-tab filter-nav product-list-container" <?php if(isMobile() || isIPad()){ echo 'style="display:none"'; }?>>
										<?php
				                            if(!isMobile() && !isIPad())
				                            {
				                        ?>
				                              	<span class="filter-label">Our Offers :</span>
				                        <?
				                            }
				                        ?>
										

										<?php
										$c = 0;
										foreach($category_array as $cat)
										{
											$class="";
											if($cat['term_id'] == $current_category_id || ($current_category->parent == $cat['term_id'] && $current_category->parent != $parent_category->term_id)  )
											{
												$class="active";
											}
											$first_item = '';
											if($c == 0) { $first_item = 'filter-fist-item'; }
										?>
											<li class="nav-item <?php echo $class; ?> <?php echo $first_item; ?>  offer-filter-nav <?php if(isMobile() || isIPad()){ echo 'mobile-offer-filter'; }?>">
												<a href="<?php echo $cat['link']; ?>" class="list-all" data-category-type="list-all">
													<?php 
													if($cat['term_id'] == $parent_category->term_id)
													{
														echo 'All Offers';
													}
													else
													{
														echo $cat['name'];
													}
													?>
												</a>
											</li>
										<?php
											$c++;
										}
										?>

										<!--<li class="nav-item active filter-fist-item offer-filter-nav"><a href="javascript:void(0);" class="list-all" data-category-type="list-all">All Offers</a></li>
										<li class="nav-item offer-filter-nav"><a href="javascript:void(0);" class="suites-and-rooms" data-category-type="suites-and-rooms">Suites &amp; rooms</a></li>
										<li class="nav-item offer-filter-nav"><a href="javascript:void(0);" class="restaurants-and-bar" data-category-type="restaurants-and-bar">Restaurants &amp; bar</a></li>
										<li class="nav-item offer-filter-nav"><a href="javascript:void(0);" class="spa" data-category-type="spa">Spa</a></li>-->
									</ul>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						

						<div class="product-listing-container">
							<div class="container">                               
								<div class="row">
									<?php wc_get_template( 'archive-product.php' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

    		<?php get_footer(); ?>
    	</div>
    </body>
    <script type="text/javascript">
    	var ismobile = navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
    	var isipad =navigator.userAgent.match(/(iPad)/i) != null;

    	window.onresize = function (event) {
            applyOrientation();
        };

       	jQuery(document).ready(function() {
        	applyOrientation();
        });

        function applyOrientation()
        {
            if(ismobile)
            {            
                //portrait
                if(window.innerHeight > window.innerWidth)
                {
                    jQuery(".offer-listing-block").addClass("mob-col12");
                    jQuery(".offer-listing-block").removeClass("mob-col6");
                }
                //landscape
                else
                {    
                    jQuery(".offer-listing-block").addClass("mob-col6");
                    jQuery(".offer-listing-block").removeClass("mob-col12");
                }
            }

            if(isipad)
            {
            	//portrait
                if(window.innerHeight > window.innerWidth)
                {
                    jQuery(".offer-listing-block").addClass("col6");
                    jQuery(".offer-listing-block").removeClass("col4");
                }
                //landscape
                else
                {    
                    jQuery(".offer-listing-block").addClass("col4");
                    jQuery(".offer-listing-block").removeClass("col6");
                }
            }
        }

        jQuery('a.filter-item, .mobile-offer-filter').on('click',function(){

	        if(jQuery('ul.filter-nav').is(':visible'))
	        {
	            jQuery('ul.filter-nav').slideUp();
	            //jQuery('ul.filter-nav').css('display','none');
	        }
	        else
	        {
	            jQuery('ul.filter-nav').slideDown();
	            jQuery('ul.filter-nav').css('display','block');
	        }
        });
    </script>
</html>
