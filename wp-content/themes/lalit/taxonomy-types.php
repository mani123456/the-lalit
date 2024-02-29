<?php
/**
 * The Template for destination types
 *
 */
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$current_category = get_queried_object();
$current_category_id = $current_category->term_id;
$GLOBALS['page-name'] = 'find-a-hotel';

$position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().$_SERVER['REQUEST_URI'];
$itemList[1]['item']['name'] = $current_category->name;
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
    <body <?php body_class('lalit-booking-widget global-page'); ?>>
        <div class="main-wrap">
          <?php get_header(); ?>

            <?php get_template_part( 'template-parts/find', 'hotel' ); ?>

          <?php get_footer(); ?>
        </div>
    </body>
    <script type="text/javascript">
        var is_iPad = navigator.userAgent.match(/iPad/i) != null;
        var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;

        jQuery(function() {
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

            jQuery(window).on("scroll", $.proxy(function() {

                jQuery(".view-port-detect").each($.proxy(function(index,element) {
                    if($(element).inView())
                    {   
                        $(element).find(".js_image_load").each($.proxy(function(index, element) {
                            if($(element).hasClass("image-tag"))
                            {
                                var image = $(element).attr("data-src");
                                $(element).attr("src", image);
                                $(element).load(function() {
                                    $(element).fadeIn({queue: true, duration: 600});
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
                                        $(element).find(".img").remove();
                                        $(element).addClass("done");
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
                                        $(element).css("background-image", image);
                                        $(element).find(".img").remove();
                                        $(element).addClass("done");
                                    });
                                }
                            }
                        }, this));
                    }
                }, this));
            },this)).scroll();
        });
        
        jQuery(document).ready(function() {
            var types = '<?php echo $current_category->slug; ?>';
           
            jQuery(".hotels-listing").find(".hotel:visible:nth-child(4n+1)").find(".hotels-block").css("border-left", "0");
            
            if(types != 'all')
            {
                jQuery(".filter-tab").find("#types li."+types).trigger("click");
            }

            applyOrientation();
        });

        if(ismobile || is_iPad){

            jQuery('body').on('touchstart', '.filter-list',function(){

                jQuery(this).find('.list').show();
            });
        }
        else{

            jQuery(".filter-box").find(".filter-list").hover(function(){
                jQuery(this).find(".list").show();
            }, function(){
                jQuery(this).find(".list").hide();
            });

        }

        jQuery(".filter-list .list").find(".list-item").on("click", function() {
            jQuery(".filter-list.active").removeClass("active");

            if(ismobile){
                jQuery(".hotels-listing").find(".hotel").removeClass('selected');
            }

            if(!jQuery(this).hasClass("active"))
            {
                jQuery(".hotels-listing").find(".hotel .hotels-block").removeAttr("style");
                
                jQuery(".filter-list .list").find(".list-item.active").removeClass("active");
                jQuery(this).addClass("active");

                var href = jQuery(this).find("a").attr("rel");
                var name = jQuery(this).text();

                if(href == 'all')
                {
                    if(jQuery(this).parent().attr("id") == 'interests')
                    {
                        jQuery(".filter-list #types").parents(".filter-item").find("a.selected_value").html('Type <i class="ico-sprite sprite ico-gre-down-arrow"></i>');
                    }
                    else
                    {
                        jQuery(".filter-list #interests").parents(".filter-item").find("a.selected_value").html('Interest <i class="ico-sprite sprite ico-gre-down-arrow"></i>');
                    }
                    jQuery(this).parents(".filter-item").find("a.selected_value").html(name+' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');

                    if(ismobile){
                        jQuery(".hotels-listing").find(".hotel").addClass('selected');
                        applyOrientation();
                    }
                    else{
                        jQuery(".hotels-listing").find(".hotel").show();
                    }
                    jQuery(".hotels-listing").find(".hotel:visible:first").find(".hotels-block").css("border-left", "0");

                    jQuery(this).parent().hide();
                    jQuery(this).closest(".filter-list").removeClass("active");
                }
                else
                {
                    if(jQuery(this).parent().attr("id") == 'interests')
                    {
                        jQuery(".filter-list #types").parents(".filter-item").find("a.selected_value").html('Type <i class="ico-sprite sprite ico-gre-down-arrow"></i>');
                    }
                    else
                    {
                        jQuery(".filter-list #interests").parents(".filter-item").find("a.selected_value").html('Interest <i class="ico-sprite sprite ico-gre-down-arrow"></i>');
                    }

                    jQuery(this).parents(".filter-item").find("a.selected_value").html(name+' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');
                    jQuery(".hotels-listing").find(".hotel").hide();
                    if(ismobile){
                        jQuery(".hotels-listing").find("."+href).parent().addClass('selected');
                        applyOrientation();
                    }
                    else{
                        jQuery(".hotels-listing").find("."+href).parent().show();
                    }
                    jQuery(".hotels-listing").find(".hotel:visible:first").find(".hotels-block").css("border-left", "0");

                    jQuery(this).parent().hide();
                    jQuery(this).closest(".filter-list").addClass("active");
                }
                
                jQuery(".hotels-listing").find(".hotel:visible").find(".hotels-block").each(function(i) {
                    //i = i+1;
                    if(i%4 == 0)
                    {
                        jQuery(this).css("border-left", "0");
                    }
                });

                if(jQuery(".hotels-listing").find(".hotels-block:visible").length == 0)
                {
                    jQuery(".hotels-listing").find(".no_data").remove();
                    jQuery(".hotels-listing").append("<div class='no_data'>No Hotels Found</div>");
                }

                return false;
            }
            return false;
        });

        window.onresize = function (event) {
            applyOrientation();
        };

        function applyOrientation()
        {
            if(ismobile)
            {            
                if(window.innerHeight > window.innerWidth) // portrait
                {
                    if(jQuery("#pick-destination").find(".colZero").hasClass('selected')){
                        jQuery("#pick-destination").find(".colZero.selected").css({"width":"100%", "display": "block"});
                    }
                    else{
                        jQuery("#pick-destination").find(".colZero").css({"width":"100%", "display": "block"});
                    }
                }
                else // landscape
                {
                    if(jQuery("#pick-destination").find(".colZero").hasClass('selected')){
                        jQuery("#pick-destination").find(".colZero.selected").css({"width":"auto", "display": "inline-block"});
                    }
                    else{
                        jQuery("#pick-destination").find(".colZero").css({"width":"auto", "display": "inline-block"});
                    }
                }
            }
        }
    </script>
</html>