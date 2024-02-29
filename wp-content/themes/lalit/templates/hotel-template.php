<?php
/**
 *
  Template Name: Hotel Template
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
        <?php
    if($GLOBALS['location'])
    {
        if($GLOBALS['location'][0]->slug == 'bangalore')
        {
?>
          	<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Ashok Bangalore",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-bangalore/",
"telephone": "080 6817 7777",
"address": {
"@type": "PostalAddress",
"streetAddress": "Kumarakrupa Rd, High Grounds, Seshadripuram",
"addressLocality": "Bengaluru",
"postalCode": "560001",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitBangalore/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'bekal')
        {
?>
  <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Resort & Spa Bekal",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-bekal/",
"telephone": "0467 223 7777",
"address": {
"@type": "PostalAddress",
"streetAddress": "Padinhar Road, Udma, Kasaragod",
"addressLocality": "Kerala",
"postalCode": "671319",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitBekal/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'chandigarh')
        {
?>
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Chandigarh",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-chandigarh/",
"telephone": "172 676 7777",
"address": {
"@type": "PostalAddress",
"streetAddress": "IT Park Rd",
"addressLocality": "Chandigarh",
"postalCode": "160101",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitHotelChandigarh/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'goa')
        {
?>
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Golf & Spa Resort Goa",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-goa/",
"telephone": "0832 266 7777",
"address": {
"@type": "PostalAddress",
"streetAddress": "Raj Baga, Palolem, Canacona",
"addressLocality": "Goa",
"postalCode": "403702",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitGoa/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'jaipur')
        {
?>
  <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The Lalit Jaipur",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-jaipur/",
"telephone": "0141 519 7777",
"address": {
"@type": "PostalAddress",
"streetAddress": "Jawahar Circle 2B & 2C, Jagatpura Rd, near Jagatpura Road, Malviya Nagar",
"addressLocality": "Jaipur",
"postalCode": "302017",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitJaipur",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'khajuraho')
        {
?>
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Temple View Khajuraho",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-khajuraho/",
"telephone": "099930 92600",
"address": {
"@type": "PostalAddress",
"streetAddress": "opposite Circuit House, Sevagram",
"addressLocality": "Khajuraho",
"postalCode": "471606",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitKhajuraho/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'kolkata')
        {
?>
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Great Eastern Kolkata",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-kolkata/",
"telephone": "033 4444 7777",
"address": {
"@type": "PostalAddress",
"streetAddress": "Dalhousie Square 1, 2,3, Old Court House St, Ward Number 1",
"addressLocality": "Kolkata",
"postalCode": "700069",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitKolkata/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'london')
        {
?>
  <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT London",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-london/",
"telephone": "20 3765 0000",
"address": {
"@type": "PostalAddress",
"streetAddress": "181 Tooley St",
"addressLocality": "London",
"postalCode": "SE1 2JR",
"addressCountry": "GB"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitLondon",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>


<?php
        }
        else if($GLOBALS['location'][0]->slug == 'mangar')
        {
?>
        <script type="application/ld+json">
            {
            "@context": "http://schema.org",
            "@type": "Hotel",
            "name": "The LaLiT Mangar",
            "image": "https://www.thelalit.com/wp-content/uploads/2017/02/The-Lalit-Mangar-1.png",
            "priceRange" : "₹ 150 - ₹ 75,000",
            "@id": "https://www.thelalit.com/the-lalit-mangar",
            "url": "https://www.thelalit.com/",
            "telephone": "+911297157777",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Camp Wild Road Near Mangar Police Chowki, Faridabad-Gurugram Road, Faridabad, Haryana",
                "addressLocality": "Faridabad",
                "postalCode": "121001",
                "addressCountry": "IN"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 28.3820654,
                "longitude": 77.1742213
            },
            "openingHoursSpecification": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
                ],
                "opens": "00:00",
                "closes": "23:59"
            },
            "sameAs": "https://www.facebook.com/TheLalitMangar"
            }
        </script>
<?php
        }
        else if($GLOBALS['location'][0]->slug == 'mumbai')
        {
?>
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Mumbai",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-mumbai/",
"telephone": "022 6699 2222",
"address": {
"@type": "PostalAddress",
"streetAddress": "Sahar Airport Rd, Navpada, Marol, Andheri East",
"addressLocality": "Mumbai",
"postalCode": "400059",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitMumbai",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'delhi')
        {
?>
        <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Hotel",
  "name": "The LaLiT New Delhi",
  "image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
  "@id": "",
  "url": "https://www.thelalit.com/the-lalit-delhi/",
  "telephone": "011 4444 7777",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Barakhamba Avenue, Connaught Place",
    "addressLocality": "New Delhi",
    "postalCode": "110001",
    "addressCountry": "IN"
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  },
  "sameAs": [
    "https://www.facebook.com/TheLalitNewDelhi",
    "https://twitter.com/TheLalitGroup",
    "https://www.youtube.com/c/TheLalitGroup",
    "https://www.linkedin.com/company/thelalitgroup",
    "https://www.instagram.com/thelalitgroup"
  ] 
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'srinagar')
        {
?>
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Grand Palace Srinagar",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-srinagar/",
"telephone": "0194 250 1001",
"address": {
"@type": "PostalAddress",
"streetAddress": "Gupkar Rd, Srinagar",
"addressLocality": "Jammu and Kashmir",
"postalCode": "190001",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitSrinagar/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
        else if($GLOBALS['location'][0]->slug == 'udaipur')
        {
?>
        <script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "Hotel",
"name": "The LaLiT Laxmi Vilas Palace Udaipur",
"image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
"@id": "",
"url": "https://www.thelalit.com/the-lalit-udaipur/",
"telephone": "0294 661 7777",
"address": {
"@type": "PostalAddress",
"streetAddress": "Fateh Sagar Rd, Near Zinc, Fateh Sagar Lake",
"addressLocality": "Udaipur",
"postalCode": "313004",
"addressCountry": "IN"
},
"openingHoursSpecification": {
"@type": "OpeningHoursSpecification",
"dayOfWeek": [
"Monday",
"Tuesday",
"Wednesday",
"Thursday",
"Friday",
"Saturday",
"Sunday"
],
"opens": "00:00",
"closes": "23:59"
},
"sameAs": [
"https://www.facebook.com/TheLalitUdaipur/",
"https://twitter.com/TheLalitGroup",
"https://www.youtube.com/c/TheLalitGroup",
"https://www.linkedin.com/company/thelalitgroup",
"https://www.instagram.com/thelalitgroup"
]
}
</script>

<?php
        }
    }
?>
   </head>
   <body <?php body_class('home-temp lalit-booking-widget hotel-temp'); ?>>
      <div class="main-wrap">
         <?php get_header(); ?>

            <?php get_template_part( 'template-parts/hotel', 'overview' ); ?>

         <?php get_footer(); ?>
      </div>
      <script type="text/javascript">
        
        
        jQuery(window).load(function(){

            jQuery('body').css('overflow-x','hidden');
            
            jQuery(window).on('resize', function(){

               jQuery('.awardsSlider').resize();
            });
         });
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

         if(jQuery(window).width() >= 768){
            
        	if(!is_iPad && jQuery('.awardsSlider .slides li').length > 4){
            	jQuery('.awardsSlider').flexslider({
               		animation: "slide",
               		animationLoop: true,
               		pauseOnAction: true,
               		pauseOnHover: true,
               		itemWidth: 400,      
               		minItems: getGridSize(),
               		maxItems: getGridSize(),
               		itemMargin: 60,
               		slideshowSpeed: 7000,
               		controlNav: true,
               		directionNav: true,
               		move: 4,
            	});
        	}
        	else if(is_iPad && jQuery('.awardsSlider .slides li').length > 3){
        		jQuery('.awardsSlider').flexslider({
               		animation: "slide",
               		animationLoop: true,
               		pauseOnAction: true,
               		pauseOnHover: true,
               		itemWidth: 400,      
               		minItems: getGridSize(),
               		maxItems: getGridSize(),
               		itemMargin: 60,
               		slideshowSpeed: 7000,
               		controlNav: true,
               		directionNav: true,
               		move: 4,
            	});
        	}
         }
         else{
			if(jQuery('.awardsSlider .slides li').length > 1){
            	jQuery('.awardsSlider').flexslider({
               		animation: "slide",
               		animationLoop: true,
               		pauseOnAction: true,
               		pauseOnHover: true,
               		controlNav: true,
               		slideshowSpeed: 7000,
            	});
            }
         }

         function getGridSize() {
      		return (window.innerWidth < 767) ? 1 : (window.innerWidth < 992) ? 3 : 4;
    	}

      </script>
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/hotel-overview.min.js" async></script>
	   <!-- Sojern Container Tag cp_v1_js, Pixel Version: 1 -->
<script>
(function () {
/* Please fill the following values. */
var params = {
hpid: "76565", /* Property ID */
pt: "HOME_PAGE" /* Page Type - HOME_PAGE or PRODUCT or TRACKING */
};
/* Please do not modify the below code. */
var paramsArr = [];
for(key in params) { paramsArr.push(key + '=' + encodeURIComponent(params[key])) };
var pl = document.createElement('script');
pl.type = 'text/javascript';
pl.async = true;
pl.src = "https://beacon.sojern.com/pixel/cp/11?f_v=cp_v1_js&p_v=1&" + paramsArr.join('&');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')
[0]).appendChild(pl);
})();
</script>
<!-- End Sojern Tag -->
<!-- Sojern Container Tag cp_v1_js, Pixel Version: 1 -->
<script>
(function () {
/* Please fill the following values. */
var params = {
hpid: "76565", /* Property ID */
pt: "TRACKING" /* Page Type - HOME_PAGE or PRODUCT or TRACKING */
};
/* Please do not modify the below code. */
var paramsArr = [];
for(key in params) { paramsArr.push(key + '=' + encodeURIComponent(params[key])) };
var pl = document.createElement('script');
pl.type = 'text/javascript';
pl.async = true;
pl.src = "https://beacon.sojern.com/pixel/cp/11?f_v=cp_v1_js&p_v=1&" + paramsArr.join('&');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')
[0]).appendChild(pl);
})();
</script>
<!-- End Sojern Tag -->	   
	   
   </body>
</html>