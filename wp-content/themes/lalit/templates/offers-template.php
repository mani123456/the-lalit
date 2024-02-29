<?php
/*
  Template Name: Offers Landing Template
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
$parent_page_id = wp_get_post_parent_id($page_id);

$location = get_the_terms($parent_page_id, 'locations');
$location_id = '';
foreach ($location as $value) {
  $location_id = $value->term_id;
}

$GLOBALS['location'] = $location;
$GLOBALS['location_id'] = $location_id;


$position = 1;
$destination_obj = get_destination_by_taxanomy('locations', $location[0]->term_id);
$hotel_name = '';
if ($destination_obj->have_posts()) {

  while ($destination_obj->have_posts()) {

    $destination_obj->the_post();
    $hotel_name = get_post_meta(get_the_id(), 'name', true);
  }
}
wp_reset_postdata();

$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url() . '/';
$itemList[0]['item']['name'] = 'Home';


$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url() . '/' . 'the-lalit-' . $location[0]->slug . '/';
$itemList[1]['item']['name'] = $hotel_name;

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
$itemList[2]['item']['name'] = 'Offers';
?>
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

    <?php get_template_part('template-parts/offer', 'listing'); ?>

    <?php get_footer(); ?>
  </div><!-- main-wrap -->
</body>
<script type="text/javascript">
  jQuery(document).ready(function() {

    var image_array = [];
    var offer_images = [];

    //image_array = <?php //echo json_encode($GLOBALS['image_array']); 
                    ?>;
    offer_images = <?php echo json_encode($GLOBALS['offer_images']); ?>;

    //setTimeout(function(){

    /*jQuery('.banner-list').each(function(index, el) {

      //img_url = image_array[index].replace("\\","");
      jQuery(this).css('background-image', 'url("'+image_array[index]+'")');

    });*/

    /*jQuery('.offers-block').each(function(index, el) {
            //img_url = offer_images[index].replace("\\","");
            jQuery(this).find('img').attr('src',offer_images[index]);
          });

          jQuery('.offers-block').show();

          jQuery('.hide-show').show();

        },1000);*/


    jQuery('a.filter-item, .mobile-offer-filter').on('click', function() {

      if (jQuery('ul.filter-nav').is(':visible')) {
        jQuery('ul.filter-nav').slideUp();
        //jQuery('ul.filter-nav').css('display','none');
      } else {
        jQuery('ul.filter-nav').slideDown();
        jQuery('ul.filter-nav').css('display', 'block');
      }
    });

    jQuery('.three-col-listing-block').css('min-height', '650px');

    jQuery('.filter-nav a').on('click', function(e) {

      e.preventDefault();
      jQuery('a.selected_value').html('').html(jQuery(this).text() + ' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');
      jQuery('.filter-nav').find('li.active').removeClass('active');
      jQuery('div.offer-listing-block').hide();
      jQuery('.offer-listing-block').removeClass('first');
      jQuery('.offer-listing-block').removeClass('filtered-offers');
      jQuery(this).parent().addClass('active');
      var cat = jQuery(this).data('categoryType');

      if (cat != 'list-all') {

        jQuery('div[data-category-type="' + cat + '"]').addClass('filtered-offers');

        addFirstClass('filtered-offers');

        setTimeout(function() {

          jQuery('.filtered-offers').fadeIn();

        }, 300);

      } else {
        addFirstClass('offer-listing-block');
        setTimeout(function() {
          jQuery('.offer-listing-block').fadeIn();
        }, 300);
      }

    });

    var sPageURL = window.location.search.substring(1);
    if (sPageURL && sPageURL != '') {
      var sParameterName = sPageURL.split('=');
      var param = sParameterName[1];
      if (param) {
        setTimeout(function() {
          jQuery(".filter-nav").find("a." + param).click();
        }, 10);
      }

      return false;
    }

  });

  function addFirstClass(className) {
    jQuery('.three-col-listing-block').find('.' + className).each(function(index, el) {

      if (index % 3 == 0) {
        jQuery(this).addClass('first');
      }

    });
  }

  jQuery(".three-col-listing-block").find(".card-info").on("click", function() {
    var href = jQuery(this).find(".permalink").val();
    window.location = href;
  });
</script>

</html>