<?php
$GLOBALS['page-name'] = 'we-care-details';

$position = 1;

$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';

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
        <style type="text/css">
            .ui-datepicker-trigger{
                display:none;
            }
        </style>
    </head>
    <body <?php body_class('local-page'); ?>>
        <div class="main-wrap">
        	<?php get_header(); ?>
        		<?php get_template_part( 'detail-pages/we-care', 'detail' ); ?>
         	<?php get_footer(); ?>
        </div><!-- main-wrap -->    
        <?php
        if(isMobile())
        {
        ?>
            <script type="text/javascript">
              jQuery(document).ready( function () {
                  jQuery('.fancybox').fancybox({
                      autoSize : false,
                      width : "100%",
                      height : "auto",
                      helpers: {
                          overlay : {
                            locked : true
                          }
                      },
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                      },
                      afterShow: function() {
                        jQuery(".date-field").focus();
                      },
                      beforeClose: function() {
                        jQuery('.fancybox-opened form').trigger('reset');
                      },
                      beforeShow: function() {
                        jQuery("body").addClass("overlay-fixed");
                      }
                  });
              });

              jQuery(".mob-view").on("click", function() {
                  jQuery(this).next().slideToggle(400);
              });
            </script>
        <?php
        }
        else
        {
        ?>
            <script type="text/javascript">
              jQuery(document).ready( function () {
                  jQuery('.fancybox').fancybox({
                      autoSize : false,
                      width : "550px",
                      height : "auto",
                      helpers: {
                        overlay : {
                            locked : true
                        }
                      },
                      afterClose: function() {
                        jQuery("body").removeClass("overlay-on overlay-fixed");
                      },
                      afterShow: function() {
                        jQuery(".date-field").focus();
                      },
                      beforeClose: function() {
                        jQuery('.fancybox-opened form').trigger('reset');
                      },
                      beforeShow: function() {
                        jQuery("body").addClass("overlay-fixed");
                      }
                  });
              });
            </script>
        <?php
        }
        ?>
  
        <script type="text/javascript">
        
          var image_array = <?php echo json_encode($GLOBALS['image_array']); ?>;
          jQuery(document).ready( function () {

              var dateFormat = "dd M yy";
              var dateFormat = "dd M yy";
              var currentyear = new Date().getFullYear();
              var nextYear = new Date().getFullYear() + 1;
              var yearRange = currentyear+":"+nextYear;

              $(".date-field").datepicker({
                  dateFormat: dateFormat,
                  yearRange: yearRange,
                  changeMonth: false,
                  numberOfMonths: 1,
                  showOn: "button",
                  buttonImageOnly: true,
                  showButtonPanel: true,
                  closeText: "Close",
                  dayNamesShort: ["S","M", "T", "W", "T", "F", "S"],
                  dayNamesMin: ["S","M", "T", "W", "T", "F", "S"],
                  onClose: function(){
                    jQuery('.date-field').focus();
                  }
              });
              var currentDate = new Date();  
              jQuery(".date-field").datepicker("setDate",currentDate);
              jQuery(".date-field").datepicker('option', 'minDate', currentDate);
              jQuery('.date-field').on('click', function(){
                
                jQuery('.date-field').datepicker('show');
              });

              jQuery(".content-section").find("img.image").each(function(index) {
                  jQuery(this).attr("src", image_array[index]);
              });
 
          });

          jQuery('.card-info a').click(function() {
                jQuery(this).parent('.card-info').toggleClass('expand');
          });

          jQuery(".read_more").on("click", function() {
                jQuery(this).closest(".card-info").find(".trunc").hide();
                jQuery(this).closest(".card-info").find(".untrunc").show();
          }); 

          jQuery(".read_less").on("click", function() {
                jQuery(this).closest(".card-info").find(".untrunc").hide();
                jQuery(this).closest(".card-info").find(".trunc").show();
          });

          jQuery(window).scroll(function () {
            var fixSidebar = jQuery('.primary-nav').innerHeight();
            var contentHeight = jQuery('.sidebar-rcol').innerHeight();
            var sidebarHeight = jQuery('.sidebar-outer').height();
            var sidebarBottomPos = contentHeight - sidebarHeight; 
            var trigger = jQuery(window).scrollTop() - fixSidebar;

            if (jQuery(window).scrollTop() >= fixSidebar) 
            {
                //$('.side-navigation').addClass('fixed-sidebar');
            } 
            else 
            {
                jQuery('.sidebar-outer').removeClass('fixed-sidebar');
            }

            if (trigger >= sidebarBottomPos-40) 
            {
                jQuery('.sidebar-outer').addClass('sidebar-bottom');
            } 
            else 
            {
                jQuery('.sidebar-outer').removeClass('sidebar-bottom');
            }
        });
        
        jQuery(window).load(function(){
          
          var url_string = window.location.href;
          var url = new URL(url_string);
          var booking = url.searchParams.get("booking");
          if(booking){
            
            jQuery('.btn.secondary-btn.reserve-btn').trigger('click');
          }
        });

        </script>
    </body>    
</html>   