function initMap() 
{
    var latitude = parseFloat(jQuery(".map-sec").find("#latitude").val());
    var longitude = parseFloat(jQuery(".map-sec").find("#longitude").val());

    map = new google.maps.Map(document.getElementById('map'), {
        mapTypeControl: false,
        center: {lat: latitude, lng: longitude},
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 15,
        zoomControl : true,
        scaleControl : false,
        disableDefaultUI: true,
        scrollwheel: false,
        styles : [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"lightness":20},{"color":"#590f0f"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2},{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"hue":"#ff00ff"},{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"color":"#d94848"},{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#d8d6d6"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"gamma":"1.2"},{"lightness":"25"},{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"labels.text.stroke","stylers":[{"lightness":"-6"}]},{"featureType":"administrative.province","elementType":"geometry.fill","stylers":[{"lightness":"-5"},{"color":"#d9d5d9"},{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"lightness":"-20"},{"saturation":"0"},{"color":"#d9d5d9"},{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"visibility":"simplified"},{"color":"#e2e2e2"}]},{"featureType":"administrative.province","elementType":"labels.text.fill","stylers":[{"color":"#c7c5c5"},{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"color":"#fcfcfc"},{"visibility":"on"},{"weight":"2"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#d9d5d9"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":20},{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#d3d3d3"},{"lightness":17}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d9d5d9"},{"visibility":"on"}]}]
    });
  
    if(is_iPad)
    {
        setTimeout(function() {
          	if(window.innerHeight > window.innerWidth)
          	{
          		  map.panBy(200,0);
          	}
          	else
          	{
          		  map.panBy(210,0);
          	}
        },500);
    }
  
    var marker_hotel = new google.maps.Marker({
          position: {lat: latitude, lng: longitude},
          map: map,
          icon : '/wp-content/themes/lalit/images/property-pin.png'
    });

    var hotel_email_section = '';
    var hotel_phone_section = ''; 
    var hotel_fax_section = '';

    if(hotel_email != '')
    {
        hotel_email_section = '<li class="contact-details">'+       
                                    '<i class="ico-sprite sprite size-24 ico-email"></i>'+
                                    '<p><a href="mailto: '+hotel_email+'">'+hotel_email+'</a></p>'+
                              '</li>';
    }
    
    if(hotel_phone != '')
    {
       hotel_phone_section = '<li class="contact-details">'+
                                    '<i class="ico-sprite sprite size-24 ico-phone"></i>'+
                                    '<p> Phone : <a href="tel:'+hotel_phone+'">'+hotel_phone+'</a></p> '+
                              '</li>';
    }
    
    if(hotel_fax != '')
    { 
       hotel_fax_section = '<li class="contact-details">'+
                              ' <i class="ico-sprite sprite size-24 ico-print"></i> ' +                                       
                              ' <p> Fax: <a href="fax:'+hotel_fax+'">'+hotel_fax+'</a></p>'+
                            ' </li>';
    }
     
    var infoWindowContentHotel = 
    '<div class="row  locatin-sec">' +
      '<div class="col col4 info_img">'+
          '<img src="'+hotel_image+'" alt="'+hotel_name+'" title="'+hotel_name+'" />'+
      '</div>'+
      '<div class="col col8 info_content">'+  
        '<h3>'+hotel_name+'</h3>' +
        '<p>'+hotel_address+'</p>' +
          '<ul>'+
              hotel_email_section +

              hotel_phone_section +

              hotel_fax_section +
          '</ul>' +            
      '</div>'+ 
    '</div>';

  	if(is_iPad)
  	{
  	  	if(window.innerHeight > window.innerWidth)
  	  	{
      			var infoWindow_hotel = new google.maps.InfoWindow({
      				maxWidth:300
      			});
    		}
    		else
    		{
    			var infoWindow_hotel = new google.maps.InfoWindow();
    		}
  	}
  	else
  	{
  		var infoWindow_hotel = new google.maps.InfoWindow();
  	}
  
    // Allow each marker to have an info window    
    google.maps.event.addListener(marker_hotel,'click', (function(marker_hotel,infoWindowContent,infoWindow_hotel){ 
        return function() {
           infoWindow_hotel.setContent(infoWindowContentHotel);
           infoWindow_hotel.open(map,marker_hotel);
        };
    })(marker_hotel,infoWindowContentHotel,infoWindow_hotel));
    
    var center = map.getCenter();
    google.maps.event.addDomListener(window, 'resize', function() {
        map.setCenter(center);
        if(is_iPad)
        {
            if(window.innerHeight > window.innerWidth)
            {
                map.panBy(200,0);
            }
            else
            {
               map.panBy(210,0);
            }
        }
        else
        {
            map.setCenter(center);
        }
    }); 
}

jQuery(function() {
    jQuery(".overview-banner").find(".flex-direction-nav").hide();
    jQuery("#award-services").find("img.image").hide();
    $("img.js_image_load").hide();

    $.fn.inView = function(){
        var viewport = {};
        viewport.top = $(window).scrollTop();
        viewport.bottom = viewport.top + $(window).height();
        var bounds = {};
        bounds.top = this.offset().top;
        bounds.bottom = bounds.top + this.outerHeight();
        return ((bounds.top <= viewport.bottom) && (bounds.bottom >= viewport.top));
    };
    
    var u = 'c';
	var city = jQuery(".main-banner").find(".city").val();
	var country = jQuery(".main-banner").find(".country").val();

	if(city != '' && country != '')
	{
		 var locationQuery = escape("select item.condition, item.link from weather.forecast where woeid in (select woeid from geo.places where text='"+city+", "+country+"') and u='c'");

		 var url = "http://query.yahooapis.com/v1/public/yql?q=" + locationQuery + "&format=json";

		 jQuery.ajax({
			 dataType: 'json',
			 type: "post",
			 url:url,
			 success: function(data) {
				 var channel = data.query.results;
				 var link = 'javascript:void(0);';
				 if(jQuery.isArray(channel.channel))
				 {
					var info = data.query.results.channel[0].item.condition;
					link = data.query.results.channel[0].item.link
				 }
				 else
				 {
					var info = data.query.results.channel.item.condition;
					link = data.query.results.channel.item.link
				 }
				 
				 jQuery(".main-banner").find(".wxIcon").css({
					 backgroundPosition: '-' + (61 * info.code) + 'px 0'
				 }).attr({
					 title: info.text
				 });
				 jQuery(".main-banner").find(".wxIcon2").append('<i class="wi wi-weather-'+info.code+'"/></i>');
				 jQuery(".main-banner").find(".wxTemp").html(info.temp + '&deg;' + (u.toUpperCase()));
				 jQuery(".main-banner").find(".wxIntro").html(city);
				 jQuery(".main-banner").find(".yahoo").attr("href", link);

			 }
		 });
	
	}

    jQuery(window).on("scroll", $.proxy(function() {

        if($('#award-services').inView())
        {
            if(!jQuery('#award-services').hasClass("done"))
            {
                var c = jQuery("#award-services").find("img.image").length - 1;
                jQuery("#award-services").find("img.image").each(function(index){
                    jQuery(this).attr("src", service_images[index]);
                    
                    if(c == index)
                    {
                        jQuery('#award-services').find('.owl-carousel').owlCarousel({
                            autoplay: false,
                            center: true,
                            loop: true,
                            nav:true,
                            dots: true,
                            responsiveClass:true,
                            responsive:{
                                0:{
                                items:1,
                                nav:true
                                },
                                768:{
                                items:3,
                                nav:false
                                }
                            }
                        });
                        jQuery('#award-services').addClass("done");
                        jQuery("#award-services").find("img.image").each(function(index){
                            jQuery(this).load(function() {
                                jQuery(this).fadeIn(600, function() {
                                    jQuery(this).parent().css("background-color", "transparent");
                                });
                            });
                        });
                        return false; 
                    }
                });
            }
        }

        jQuery(".view-port-detect").each($.proxy(function(index,element) {
            if($(element).inView())
            {   
                var image_count = $(element).find(".js_image_load").length;
                var i = 0;
                var b = 0;
                var bg = 0;
                $(element).find(".js_image_load").each($.proxy(function(index, element) {
                    if($(element).hasClass("image-tag"))
                    {
                        var image = $(element).attr("data-src");
                        $(element).attr("src", image);
                        $(element).load(function() {
                            $(element).fadeIn(600, function () {
                                i++;
                                if(image_count == i)
                                {
                                    i = 0;
                                    $(element).closest(".background-color").css("background-color", "transparent");  
                                }
                                return true; 
                            });
                        });
                    }
                    else if($(element).hasClass("background"))
                    {
                        if(!$(element).hasClass("done"))
                        {
                            var image = $(element).attr("data-src");
                            var image_url = $(element).attr("data-url");
                            if($(element).find(".img").length == 0)
                            {
                                $(element).append("<img src='"+image_url+"' class='img' style='display:none;' /> ");
                            }
                            $(element).find(".img").load(function() {
                                $(element).attr("style", image);
                                b++;
                                $(element).find(".img").remove();
                                $(element).addClass("done");
                                if(image_count == b)
                                {
                                    b = 0;
                                    if($(element).hasClass("background-color"))
                                    {
                                        $(element).css("background-color", "transparent");
                                    }
                                    else
                                    {
                                        $(element).closest(".background-color").css("background-color", "transparent"); 
                                    }
                                } 
                            });
                        }
                    }
                    else if($(element).hasClass("background-image"))
                    {
                        if(!$(element).hasClass("done"))
                        {
                            var image = $(element).attr("data-src");
                            var image_url = $(element).attr("data-url");
                            if($(element).find(".img").length == 0)
                            {
                                $(element).append("<img src='"+image_url+"' class='img' style='display:none;' /> ");
                            }  
                            $(element).find(".img").load(function() {
                                $(element).css("background-image", "url('" + image_url + "')");
                                bg++;
                                $(element).find(".img").remove();
                                $(element).addClass("done");
                                if(image_count == b)
                                {
                                    b = 0;
                                    if($(element).hasClass("background-color"))
                                    {
                                        $(element).css("background-color", "transparent");
                                    }
                                    else
                                    {
                                        $(element).closest(".background-color").css("background-color", "transparent"); 
                                    }
                                } 
                            });
                        }
                    }
                }, this));
            }
        }, this));
    },this)).scroll();
});

jQuery(window).bind("load", function() {
    jQuery(".overview-banner").find(".banner-images").each(function(index) {
        jQuery(this).attr("src", banner_images[index]);
    });
    jQuery(".overview-banner").find(".flex-direction-nav").show();

    setTimeout(function() {
          var script = document.createElement("script");
          script.src = "https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBVeqCGir28lzhAxHzG6V_l0j3IkGvLZx0&callback=initMap";
          script.type = "text/javascript";
          document.getElementsByTagName("head")[0].appendChild(script);     
    }, 1000);
});  