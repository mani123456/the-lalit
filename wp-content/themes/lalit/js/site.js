$(window).scroll(function () {
            
    if($(window).scrollTop() > 45) {
        $('.local-nav').find(".local-city-logo").addClass("sticky-logo");
    }
    if ($(window).scrollTop() < 45) {
        $('.local-nav').find(".local-city-logo").removeClass("sticky-logo");
    }    
    if($(window).scrollTop() > 100) {
        if(jQuery('.primary-nav').hasClass('sticy-nav') == false)
        {
            $('.nav-bar-fill').addClass('navbar-fixed');
            $('.content-section').css("padding-top", "48px");
            if(jQuery(".sidebar-outer").length)
            {
                jQuery(".sidebar-outer").addClass("fixed-sidebar"); 
            }
            if(jQuery(".package-head-sec").length > 0)
            {
                jQuery(".package-head-sec").addClass("package-head-bg");
                jQuery('.content-section').css("padding-top","230px");
            }
        }
    }
    if ($(window).scrollTop() < 100) { 
        if(jQuery('.primary-nav').hasClass('sticy-nav') == false)
        {
            $('.nav-bar-fill').removeClass('navbar-fixed');
            $('.content-section').css("padding-top", "0");
            if(jQuery(".sidebar-outer").length)  
            {
                jQuery(".sidebar-outer").removeClass("fixed-sidebar");
            }
            if(jQuery(".package-head-sec").length > 0)
            {
                jQuery(".package-head-sec").removeClass("package-head-bg");
                jQuery('.content-section').css("padding-top", "0");
            }
        }
    }
    if($(window).scrollTop() > 100) {
        $('.local-nav').find(".local-city-logo").addClass("animate-logo");
    }
    if ($(window).scrollTop() < 100) {
        $('.local-nav').find(".local-city-logo").removeClass("animate-logo");
    }

    /*if(jQuery('.primary-nav').hasClass('sticy-nav'))
    {
        jQuery('.primary-nav').closest('header').next('.content-section').css("padding-top", "100px");
    }
    else{
        jQuery('.primary-nav').closest('header').next('.content-section').css("padding-top", "0");
    }*/
    var windowBottom = jQuery(this).scrollTop() + jQuery(this).innerHeight();
    jQuery(".js_fade").each(function() {
      /* Check the location of each desired element */
      var objectTop = jQuery(this).offset().top + 30;
      
      /* If the element is completely within bounds of the window, fade it in */
      if (objectTop < windowBottom) { //object comes into view (scrolling down)
        if (jQuery(this).css("opacity")==0) {jQuery(this).fadeTo("600",1);}
      }
    });
    
}).scroll(); 


jQuery(document).ready(function(){ 

        jQuery(".mobile-book-stay").fancybox({
            autoSize : false,
            width : "auto",
            height : "auto"
        }); 

        jQuery('.fadeslider').flexslider({ 
            animation: "fade",
            animationLoop: true,
            controlNav: false,
            animationSpeed: 1000,
            slideshowSpeed: 5000,
            pauseOnHover: false, 
            slideshow: true,
            start: function(slider){
              $('body').removeClass('loading');
            } 
        });

        jQuery('#main-banner-slider').flexslider({
            animation: "fade",
            //manualControls: ".flex-control-nav li",
            animationLoop: true,
            slideshow: false 
        });

        jQuery('#banner-slider').flexslider({
            animation: "fade",
            //manualControls: ".flex-control-nav li",
            animationLoop: true,
            slideshow: false
        });
    
        jQuery('#thumb-slider').flexslider({
            animation: "fade",
            manualControls: "#thumb-slider .flex-control-nav li",
            animationLoop: true,
            slideshow: false
        });

        jQuery('.slider').flexslider({
            animation: "fade",
            animationLoop: true,
            slideshow: false,
            controlNav: false,
        });
        
        jQuery('#carousel').flexslider({
            animation: "fade",
            animationLoop: true,
            itemWidth: 423,
            itemMargin: 5,
            controlNav: false,
            slideshow: false,
        });
        
        jQuery(".collapse").click(function(){
            
            if(jQuery(this).hasClass("active") == false)
            {
                //if(jQuery(this).next(".collapse-data").find){
                    jQuery(".collapse.active").next().slideUp();
                    jQuery(".collapse.active").removeClass("active");
                    jQuery(this).next().slideDown();
                    jQuery(this).addClass("active"); 
                //}
            } 
            else
            {
                jQuery(this).next().slideUp();
                jQuery(this).removeClass("active");
            }
            return false;
        });

        
        // scroll top     
        $(window).scroll(function () {
            if ($(this).scrollTop() > 600) {
                $('.scrollup , .scrollup i').fadeIn();
            } else {
                $('.scrollup , .scrollup i').fadeOut();
            }
        });

        $('.scrollup').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        }); 
        
        // Mask Hori       
        $(window).load(function() {
            var width_outer = $(".photoMaskHor").width();
            var width_img = $(".photoMaskHor img").width(); 
            var width =(width_outer - width_img)/2;    
            $(".photoMaskHor img").css('left',  + width + 'px');   
     
        });
        
        // Mask verticaly       
        $(window).load(function() {
                var height_outer = $(".photoMaskVer").height();
                var height_img = $(".photoMaskVer img").height(); 
                var height =(height_outer - height_img)/2;  
             
           
                $(".photoMaskVer  img").css('top',  + height + 'px');   
             
        });
        
       

        jQuery(".book-item .booking-nav-btn").click(function(){
            jQuery(".v-align-widget").fadeToggle(300);
        });

        jQuery("body").on("click", function(e) {
            if( jQuery(e.target).is('.v-align-widget') || jQuery(e.target).is('.book-item .btn.primary-btn') || jQuery(e.target).is('.book-item .btn.tertiary-btn') || jQuery(e.target).is('.form_submit_nav_widget') || jQuery(e.target).is('#ui-datepicker-div') || jQuery(e.target).is('#ui-datepicker-div .ui-datepicker-group .ui-datepicker-calendar, #ui-datepicker-div .ui-datepicker-buttonpane, .ui-icon, .ui-datepicker-close') || jQuery(e.target).parents('#ui-datepicker-div').length) 
            {
                return;
            }
            else
            {
                if(jQuery('.v-align-widget').is(':visible') && e.target.className !== ".v-align-widget" && !jQuery(e.target).parents('.v-align-widget').length)
                {
                    jQuery(".v-align-widget").fadeOut(300);
                }
            }
        });

});

/***** smooth scroll ******/

$(".bottom-scroll a, .smooth-scroll a").on('click', function(event) {
    if (this.hash !== "") 
    {     
        event.preventDefault();      
        var hash = this.hash;

        $('html, body').animate({
            scrollTop: $(hash).offset().top  - (jQuery(".nav-bar-fill").height()+10)
        }, 800);
    } 
});

$(".smooth-scroll-page a").on('click', function(event) {
    if (this.hash !== "") 
    {     
        event.preventDefault();      
        var hash = this.hash;

        $('html, body').animate({
            scrollTop: $(hash).offset().top  - (jQuery(".primary-nav").height()+10)
        }, 800);
    } 
    
});

/***** smooth scroll ******/

// Sticy filter
jQuery(function(){
    var win = '';
    var speakerTop = '';
    var key = '';
    var offset = '';


    if(jQuery(".sticy-nav").length > 0)
    {
        if(jQuery(".sticy-nav").position().top - win <= offset ) 
        {
          //jQuery(".freeToolspage").css("padding-top","160px");
          jQuery(".filter-tab").addClass("");
          //jQuery(".mainWrap").not("body.home").css("padding-top","160px");
        }
    } 
});
