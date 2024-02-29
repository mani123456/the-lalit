<?php
  
  $GLOBALS['image_or_video_array'] = array();

  $destination_obj = get_destination_by_taxanomy( 'locations', $GLOBALS['location_id']);

  $city_name = $GLOBALS['location'][0]->slug;

  $hotel_id = '';
  $hotel_name = '';

  if( $destination_obj->have_posts() ) : 

      while($destination_obj->have_posts()) : $destination_obj->the_post();

          $hotel_id = $post->ID;

          $hotel_latitude = get_post_meta( $post->ID, "latitude", true); 
          $hotel_longitude = get_post_meta( $post->ID, "longitude", true); 
          $hotel_title = get_the_title($post->ID);
          $hotel_name = get_post_meta( $post->ID, "name", true); 
          $hotel_address = get_post_meta( $post->ID, "address", true); 
          $hotel_address = preg_replace( '/(^|[^\n\r])[\r\n](?![\n\r])/', '$1 ', $hotel_address );
          $hotel_image_id = get_post_meta( $post->ID, "property_image", true);
          $hotel_image = wp_get_attachment_image_src($hotel_image_id, 'thumbnail')[0];
          $hotel_short_description = addslashes(get_post_meta( $post->ID, "short_description", true)); 
          $hotel_short_description = str_replace('\'', '\\\'\\', $hotel_short_description);
          $city_attractions_object = get_post_meta( $post->ID, "city_attractions", true);

          $GLOBALS['address'] = get_post_meta($post->ID,"address",true);
          $GLOBALS['email'] = get_post_meta($post->ID,"email",true);
          $GLOBALS['phone'] = get_post_meta($post->ID,"phone",true);
          $GLOBALS['fax'] = get_post_meta($post->ID,"fax",true);
          //$GLOBALS['dining_object'] = get_post_meta( $post->ID, "dinings", true);

          $GLOBALS['review_widget'] = get_post_meta( $post->ID, "review_widget", true); 

          $hotel_additional_information = get_post_meta($post->ID, "hotel_additional_information", true);
      
      endwhile;

  endif;

  $hotel_title = get_the_title($hotel_id);
  $hotel_name = get_post_meta($hotel_id, "name", true);
  $banner_images = get_post_meta($hotel_id, "banner_images", true);
?>

<div class="content-section">
<?php

if($banner_images)
{
   
    $banner_ids = array();
    foreach($banner_images as $banner_image_id)
    {
        $banner_ids[] = $banner_image_id;
    }

    $images_videos = get_banner_by_taxonomy($banner_ids, 'location');

    if( $images_videos->have_posts() ) :

?>
          <div class="main-banner align-center banner-slider">
              <div id="banner-slider" class="flexslider">
                  <ul class="slides">
<?php
                    while($images_videos->have_posts()) : $images_videos->the_post();
                        
                        if(isMobile())
                        {
                            $image_id = get_post_meta($post->ID, 'mobile_banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        }
                        else
                        {
                            $image_id = get_post_meta($post->ID, 'banner_image', true);
                            $image = wp_get_attachment_url($image_id);
                        }
                        
                        $heading = get_post_meta($post->ID, 'banner_heading', true);
                        $description = get_post_meta($post->ID, 'banner_description', true);
                        $url = get_post_meta($post->ID, 'url', true);
                        $button_text = get_post_meta($post->ID, 'button_text', true);
                        if($image != ''){

?>
                        <li class="location-banners banner-list">
                            <?php
                            if($url && trim($url) != ''){
                                ?>
                                <a href="<?php echo $url; ?>" class="block">
                                <?php
                            }
                            ?>
                            <img src="<?php echo $image; ?>" />
                            <div class="banner-content align-center">
                            <?php
                            if($heading != '')
                            {
                            ?>
                                <h1 class="main-title hide-show" style="display:none;"><?php echo $heading; ?></h1>
                            <?php
                            }
                            ?>
                            
                            <?php
                            if($description != '')
                            {
                            ?>
                                <p class="banner-intro-text text-shadow hide-show" style="display:none;"><?php echo $description; ?></p>
                            <?php
                            }
                            ?> 
                            </div>
                            <?php
                            if($url && trim($url) != ''){
                                ?>
                                </a>
                                <?php
                            }   
                            ?>
                        </li>
<?php
                        }
                    endwhile;

?>
                  </ul>
              </div> <!-- slider -->
          </div>
<?php     

    endif;
}

?>

<?php
if($hotel_additional_information)
{
    foreach($hotel_additional_information as $info_id)
    {
        $location_title = get_post_meta($info_id, 'location_title', true);
        $location_description = wpautop(get_post_meta($info_id, 'location_description', true));
    }
}
?>

            <div class="container intro-text section-space">
                <div class="row">
                    <div class="col col9">
                         
                          <h2 class="page-title  bdr-bottom">
                              <small><?php echo $hotel_name; ?></small>
                            <?php
                            if($location_title)
                            {
                            ?>
                              <span class="bdr-bottom-gold"><?php echo $location_title; ?></span>
                            <?php
                            }
                            ?>
                          </h2>
                        <?php
                        if($location_description)
                        {
                        ?>   
                          <p><?php echo $location_description;?></p>
                        <?php
                        }
                        ?>
                    </div>                   
                    <div class="col col3">                                                         
                          <div class="contact-info">                            
                              <ul class="unstyled-listing vcard">
                              <?php
                               if($GLOBALS['address'] != '')
                               {
                              ?>
                                  <li class="contact-details">
                                       <i class="ico-sprite sprite size-24 ico-navigation"></i>
                                        <p class="p-adr"><?php echo $GLOBALS['address']; ?></p>
                                  </li> 
                              <?php
                                }
                              ?>

                              <?php
                              if($GLOBALS['email'] != '')
                              {
                              ?>                               
                                  <li class="contact-details">
                                        <i class="ico-sprite sprite size-24 ico-email"></i>
                                        <p><a class="u-email" href="mailto: <?php echo $GLOBALS['email']; ?>"><?php echo $GLOBALS['email']; ?></a></p> 
                                  </li>
                              <?php
                              }
                              ?>

                              <?php
                              if($GLOBALS['phone'] != '')
                              {
                              ?>                                
                                  <li class="contact-details">
                                          <i class="ico-sprite sprite size-24 ico-phone"></i>
                                          <p> Phone : <a class="p-tel" href="tel:<?php echo $GLOBALS['phone']; ?>"><?php echo $GLOBALS['phone']; ?></a></p> 
                                       
                                  </li>
                              <?php
                              }
                              ?>

                              <?php
                              if($GLOBALS['fax'] != '')
                              {
                              ?> 
                                  <li class="contact-details">
                                         <i class="ico-sprite sprite size-24 ico-print"></i>                                         
                                          <p> Fax: <a class="p-tel" href="fax:<?php echo $GLOBALS['fax']; ?>"><?php echo $GLOBALS['fax']; ?></a></p>
                                  </li>
                              <?php
                              }
                              ?>
                              </ul>
                          </div>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- container --> 



<?php

  $attraction_array = array();
  if($city_attractions_object)
  {
      $c = 0;
      foreach($city_attractions_object as $city_attractions_id)
      {
          if(get_post_status ( $city_attractions_id ) == 'publish')
          {
              $name = get_post_meta($city_attractions_id, 'name', true);
              $description = get_post_meta($city_attractions_id, 'description', true);
              /*if(strlen($description) > 500)
              {
                $description = substr($description, 0,500).'...';
              }*/
              $image_id = get_post_meta($city_attractions_id, 'image', true);
              $image = wp_get_attachment_image_src($image_id);
              $image = $image[0];
              $distance = get_post_meta($city_attractions_id, 'distance_from_hotel', true);
              $latitude = get_post_meta($city_attractions_id, 'latitude', true);
              $longitude = get_post_meta($city_attractions_id, 'longitude', true);
              $category_ids = get_post_meta( $city_attractions_id, "city_attraction_category", true);
              $category_id = $category_ids[0];
              $map_icon_id = get_post_meta( $category_id, "map_icon", true);
              $map_icon = wp_get_attachment_url($map_icon_id);

              $attraction_array[$c]['name'] = $name;
              $attraction_array[$c]['description'] = addslashes($description);
              //$attraction_array[$c]['description'] = str_replace('\'', '\\\'\\', $attraction_array[$c]['description']);
              $attraction_array[$c]['image'] = $image;
              $attraction_array[$c]['distance'] = $distance;
              $attraction_array[$c]['latitude'] = $latitude;
              $attraction_array[$c]['longitude'] = $longitude;
              $attraction_array[$c]['map_icon'] = $map_icon;

              $c++;
          }
      }
  }
?>
 <style>
.mymap{position:relative;}
.mymap::before {
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgb(0,0,0,.7) 0%, rgb(0,0,0,.7) 70%);
}
</style>  
        <div id="location"> </div>
        <div class="table-responsive">
            
         	  <div class="form-group section-space">
            	   <!--div id="map" style="width:100%;height:500px">
                   
                 </div-->
				<?php

				$address = $GLOBALS['address'];

				echo '<div class="mymap"><iframe style="width: 100%; height: 500px;" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $address)) . '&z=14&output=embed"></iframe></div>';
				?>
          	</div>

          	<div class="form-group">
          		<div id="dvDistance">
            	</div>
            </div>

          	<div id="mode-selector" class="controls container">
                <div class="row">
                    <div class="col col2"> <label>Get directions to Hotel</label></div>
                    <div class="col col2">
                        <ul class="unstyled-listing travel-mode">
                            <li class="active"><a href="javascript:void(0);" id="DRIVING">
                                <i class="ico-sprite sprite size-24 ico-car visible-normal"></i>
                                <i class="ico-sprite sprite size-24 ico-white-car visible-on-hover"></i>
                                </a></li>
                            <li><a href="javascript:void(0);" id="WALKING">
                                <i class="ico-sprite sprite size-24 ico-crossing visible-normal"></i>
                                <i class="ico-sprite sprite size-24 ico-white-crossing visible-on-hover"></i></a></li>
                            <!--<li><a href="javascript:void(0);" id="BICYCLING"><i>3</i></a></li>-->
                            <li><a href="javascript:void(0);" id="TRANSIT">
                                <i class="ico-sprite sprite size-24 ico-train visible-normal"></i>
                                <i class="ico-sprite sprite size-24 ico-white-train visible-on-hover"></i>
                                </a></li>
                        </ul>
                    </div>
                    <div class="col col3"> 
                        <div class="input-with-icon">
                              <input class="input-text" id="source" name="search" placeholder="Enter the starting location" type="text">
                              <button type="submit" class="input-btn"><i class="ico-sprite sprite size-24 ico-white-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
                
                
            <!-- custom code  -->
              
                <!--<div class="text_input">
                    <input type="radio" name="type" id="changemode-walking" checked="checked">
                   <label for="changemode-walking">walking</label>
                </div>        
              <label for="changemode-walking">Walking</label>
              <input type="radio" name="type" id="changemode-transit">
              <label for="changemode-transit">Transit</label>

              <input type="radio" name="type" id="changemode-driving">
              <label for="changemode-driving">Driving</label>

              <input type="radio" name="type" id="changemode-bicycling">
              <label for="changemode-bicycling">Bicycling</label>

              <select id="place-search" name="place-search" disabled="disabled" class="disabled">
                <option value="">Select Place</option>
                <option value="restaurant">Restaurant</option>
                <option value="bank">Bank</option>
                <option value="atm">ATM</option>
                <option value="park">Park</option>
                <option value="parking">Parking</option>
                <option value="gas_station">Gas Station</option>
                <option value="shopping_mall">Shopping Mall</option>
              </select>-->
                
             <!--  -->
        </div>

<?php

if($hotel_additional_information)
{
    foreach($hotel_additional_information as $info_id)
    {
        $highlights_title = get_post_meta($info_id, 'highlights_title', true);
        $highlights_description = wpautop(get_post_meta($info_id, 'highlights_description', true));
    }
}
?>
    <?php
    if($highlights_title && $highlights_description)
    {
    ?>
        <div class="container section-space city_highlights">
            <div class="row">
                <div class="col col10 align-center align-content-center">
                    <?php
                    if($highlights_title)
                    {
                    ?>
                      <h3 class="sec-title"><?php echo $highlights_title; ?></h3>
                    <?php
                    }
                    ?>

                    <?php
                    if($highlights_description)
                    {
                    ?>
                      <p><?php echo $highlights_description; ?></p>
                    <?php
                    }
                    ?>
                      <a href="/the-lalit-<?php echo $city_name; ?>/city-attractions/" class="btn primary-btn" title="Discover">Discover</a>
                </div><!-- col -->
            </div><!-- row -->
        </div>
    <?php
    }

    //$GLOBALS['image_or_video_array'] = $image_or_video_array;
    ?>


</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
    var array = <?php echo json_encode($attraction_array) ?>;
    var gmarkers = [];
    var place = '';

    var directionsService = '';
    var directionsDisplay = '';

    var google_maps = function initMap() 
    {
        	
          map = new google.maps.Map(document.getElementById('map'), {
          		mapTypeControl: true,
          		center: {lat: <?php echo $hotel_latitude; ?>, lng: <?php echo $hotel_longitude; ?>},
              zoom:11,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              zoomControl : true,
              scaleControl : false,
              disableDefaultUI: true,
              scrollwheel: false,
              styles : [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"lightness":20},{"color":"#590f0f"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2},{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"hue":"#ff00ff"},{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"color":"#d94848"},{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#d8d6d6"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"gamma":"1.2"},{"lightness":"25"},{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"labels.text.stroke","stylers":[{"lightness":"-6"}]},{"featureType":"administrative.province","elementType":"geometry.fill","stylers":[{"lightness":"-5"},{"color":"#d9d5d9"},{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"lightness":"-20"},{"saturation":"0"},{"color":"#d9d5d9"},{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"visibility":"simplified"},{"color":"#e2e2e2"}]},{"featureType":"administrative.province","elementType":"labels.text.fill","stylers":[{"color":"#c7c5c5"},{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"color":"#fcfcfc"},{"visibility":"on"},{"weight":"2"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#d9d5d9"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":20},{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#d3d3d3"},{"lightness":17}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d9d5d9"},{"visibility":"on"}]}]
        	});

        	var marker_hotel = new google.maps.Marker({
          		position: {lat: <?php echo $hotel_latitude; ?>, lng: <?php echo $hotel_longitude; ?>},
          		map: map,
              icon : '<?php echo site_url()?>/wp-content/themes/lalit/images/property-pin.png'
    		  });
          gmarkers.push(marker_hotel);

          var hotel_address = <?php echo json_encode($hotel_address); ?>;
         
          var infoWindowContentHotel = 
          '<div class="row">' +
            '<div class="col col12 info_content">'+
                '<img src="<?php echo $hotel_image; ?>" alt="<?php echo $hotel_name; ?>" title="<?php echo $hotel_name; ?>"/>'+
                '<h3><?php echo $hotel_name; ?></h3>' +
              '<p>'+hotel_address+'</p>' +
            '</div>'+
           
          '</div>';

          var infoWindow_hotel = new google.maps.InfoWindow();
          
          // Allow each marker to have an info window    
          google.maps.event.addListener(marker_hotel,'click', (function(marker_hotel,infoWindowContent,infoWindow_hotel){ 
              return function() {
                 if( currWindow ) {
                      currWindow.close();
                  }
                 infoWindow_hotel.setContent(infoWindowContentHotel);
                 infoWindow_hotel.open(map,marker_hotel);
              };
          })(marker_hotel,infoWindowContentHotel,infoWindow_hotel));

          //service = new google.maps.places.PlacesService(map);

          directionsService = new google.maps.DirectionsService();
        	directionsDisplay = new google.maps.DirectionsRenderer;

        	directionsDisplay.setMap(map);

          var bounds = new google.maps.LatLngBounds();

        	var origin_input = document.getElementById('source');
        	
        	var modes = document.getElementById('mode-selector');


        	var origin_autocomplete = new google.maps.places.Autocomplete(origin_input);

        	origin_autocomplete.bindTo('bounds', map);
        	
        	function expandViewportToFitPlace(map, place) 
        	{
          		if (place.geometry.viewport) 
          		{
            		map.fitBounds(place.geometry.viewport);
          		} 
          		else
          		{
            		map.setCenter(place.geometry.location);
            		map.setZoom(2);
          		}
       		}
        	
        	origin_autocomplete.addListener('place_changed', function() {
          		place =  origin_autocomplete.getPlace();

          		var geocoder =  new google.maps.Geocoder();
          		geocoder.geocode( { 'address': place.name}, function(results, status) {
          			 if (status == google.maps.GeocoderStatus.OK) 
          			 {	
            			  expandViewportToFitPlace(map, place);

                    var origin_place_lat = results[0].geometry.location.lat();
            			  var origin_place_lng = results[0].geometry.location.lng();

                    var travel_mode = jQuery(".travel-mode").find("li.active").find("a").attr("id");

                    calcRoute(origin_place_lat, origin_place_lng, travel_mode, directionsDisplay, directionsService);

          			 } 
          			 else 
          			 {
            			   alert("Something got wrong " + status);
          			 }
        		  });

          		if (!place.geometry) 
          		{
            		window.alert("Autocomplete's returned place contains no geometry");
            		return;
          		}
        	});
          
          // Multiple Markers
          var infoWindow = new google.maps.InfoWindow(), marker, i;

          // Loop through our array of markers & place each one on the map 
          var currWindow =false; 
          for( i = 0; i < array.length; i++ ) 
          {
              if(array[i].latitude != '' && array[i].longitude != '')
              {
                  var position = new google.maps.LatLng(array[i].latitude, array[i].longitude);

                  //bounds.extend(position);
                  if(array[i].map_icon)
                  {    
                      marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: array[i].name,
                        icon: array[i].map_icon
                      });
                      gmarkers.push(marker);
                  }
                  else
                  {
                      marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: array[i].name,
                        icon : 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
                      });
                      gmarkers.push(marker);
                  }

                  var description = array[i].description.replace(/\\/g, '');
                  var infoWindowContent = 
                  '<div class="row">' +
                  '<div class="col col12 info_content">'+
                  '<img src="'+array[i].image+'" alt="'+array[i].name+'" title="'+array[i].name+'" />'+
                  '<h3>'+array[i].name+'</h3>' +
                  '<p>'+description+'</p>' +
                  '</div>'+
                  '</div>';
                  
                  var infoWindow = new google.maps.InfoWindow()
                  
                  
                  // Allow each marker to have an info window    
                  google.maps.event.addListener(marker,'click', (function(marker,infoWindowContent,infoWindow){ 
                      return function() {

                          infoWindow_hotel.close();
                          if( currWindow ) {
                              currWindow.close();
                          }
                          currWindow = infoWindow;

                         infoWindow.setContent(infoWindowContent);
                         infoWindow.open(map,marker);
                      };
                  })(marker,infoWindowContent,infoWindow)); 

                  // Automatically center the map fitting all markers on the screen
                  //map.fitBounds(bounds);
              }
          }

          var center = map.getCenter();
          google.maps.event.addDomListener(window, 'resize', function() {
              google.maps.event.trigger(map, "resize");
              map.setCenter(center);
          });     			
    }

    window.onload = google_maps;


    function calcRoute(lat, lng, travel_mode, directionsDisplay, directionsService) 
    {     
        removeMarkers();
      
        var start = new google.maps.LatLng(lat, lng);
        var end = new google.maps.LatLng(<?php echo $hotel_latitude; ?>,<?php echo $hotel_longitude; ?>);
        var bounds = new google.maps.LatLngBounds();
        bounds.extend(start);
        bounds.extend(end);
        map.fitBounds(bounds);
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode[travel_mode]
        };

        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
                alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
            }
        });
        //google.maps.event.trigger(map, 'resize');
    }

    function removeMarkers()
    {
        for(i=0; i<gmarkers.length; i++)
        {
          gmarkers[i].setMap(null);
        }
    }

    jQuery(".travel-mode").find("li").on("click", function() {
        jQuery(".travel-mode").find("li.active").removeClass("active");
        jQuery(this).addClass("active");

        if(place != '')
        {
            var travel_mode = jQuery(this).find("a").attr("id");

            var geocoder =  new google.maps.Geocoder();
              geocoder.geocode( { 'address': place.name}, function(results, status) {
                 if (status == google.maps.GeocoderStatus.OK) 
                 {  
                    if (place.geometry.viewport) 
                    {
                      map.fitBounds(place.geometry.viewport);
                    } 
                    else
                    {
                      map.setCenter(place.geometry.location);
                      map.setZoom(11);
                    }

                    var origin_place_lat = results[0].geometry.location.lat();
                    var origin_place_lng = results[0].geometry.location.lng();

                    var travel_mode = jQuery(".travel-mode").find("li.active").find("a").attr("id");

                    calcRoute(origin_place_lat, origin_place_lng, travel_mode, directionsDisplay, directionsService);

                 } 
                 else 
                 {
                     alert("Something got wrong " + status);
                 }
              });

        }
    });

</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBVeqCGir28lzhAxHzG6V_l0j3IkGvLZx0&libraries=places"></script>