<?php
/**
 *
  Template Name: Media Coverage Landing Template
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

$position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().$_SERVER['REQUEST_URI'];
$itemList[1]['item']['name'] = get_the_title(get_the_id());
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
    <body <?php body_class('lalit-booking-widget global-page hide-sharing'); ?>>
        <div class="main-wrap">
        	<?php get_header(); ?>

        		<?php get_template_part( 'template-parts/media-coverage', 'listing' ); ?>

        	<?php get_footer(); ?>
        </div>
        <script type="text/javascript">

            jQuery(document).ready(function(){

                var publisher_logo =[];
                publisher_logo = <?php echo json_encode($GLOBALS['publisher_logo']); ?>;
                
                jQuery('.all-years').each(function(index, el) {

                    //img_url = publisher_logo[index].replace("\\","");
                    jQuery(this).find('img').attr('src',publisher_logo[index]);

                });

                jQuery('.all-years').show();

                jQuery('.filter-item').on('mouseover',function(){

                    jQuery(this).find('.sub-menu').find('ul.drop-down-menu').css('display','block');

                });

                jQuery('.city-filter').on('click',function(){

                    jQuery(this).closest('.drop-down-menu').hide();
                    jQuery('.no-record-found').fadeOut(50);
                    jQuery('.year-filter').closest('li').removeClass('active');
                    jQuery('.year').text('Year');
                    jQuery('.year').append(' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');

                    jQuery('.city-filter').closest('li').removeClass('active');
                    jQuery(this).closest('li').addClass('active');
                    jQuery('.city').text('');
                    jQuery('.city').text(jQuery(this).text());
                    jQuery('.city').append(' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');

                    deptClass = jQuery(this).closest('li').attr('data-location-name');

                    jQuery('.all-destinations').fadeOut(20);

                    if(deptClass == 'all-destinations')
                    {
                        setTimeout(function(){
                            jQuery('div.main-container').fadeIn(100);
                            jQuery('div.content-section').removeClass('not-found');
                            jQuery('.all-destinations').fadeIn(100);
                        },200);
                    }
                    else
                    {
                        setTimeout(function(){
                            jQuery('div.main-container').fadeIn(100);
                            jQuery('.'+deptClass).closest('li').fadeIn(100); 
                            if(jQuery('.all-destinations:visible').length == 0)
                            {   
                                jQuery('div.main-container').fadeOut(20);
                                jQuery('div.content-section').addClass('not-found');
                                jQuery('.no-record-found').fadeIn(100);
                            }
                        },200);
                    }

                });

                jQuery('.year-filter').on('click',function(){

                    jQuery(this).closest('.drop-down-menu').hide();
                    jQuery('.no-record-found').fadeOut(50);
                    jQuery('.city-filter').closest('li').removeClass('active');
                    jQuery('.city').text('City');
                    jQuery('.city').append(' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');


                    jQuery('.year-filter').closest('li').removeClass('active');
                    jQuery(this).closest('li').addClass('active');
                    jQuery('.year').text('');
                    jQuery('.year').text(jQuery(this).text());
                    jQuery('.year').append(' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');

                    deptClass = jQuery(this).closest('li').attr('data-year-name');

                    jQuery('.all-years').fadeOut(20);

                    if(deptClass == 'all-years')
                    {
                        setTimeout(function(){
                            jQuery('div.main-container').fadeIn(100);
                            jQuery('div.content-section').removeClass('not-found');
                            jQuery('.all-years').fadeIn(100);
                        },200);
                    }
                    else
                    {
                        setTimeout(function(){
                            jQuery('div.main-container').fadeIn(100);
                            jQuery('.'+deptClass).fadeIn(100);
                            if(jQuery('.all-years:visible').length == 0)
                            {
                                jQuery('div.main-container').fadeOut(20);
                                jQuery('div.content-section').addClass('not-found');
                                jQuery('.no-record-found').fadeIn(100);
                            }
                        },200);

                    }

                });


            });


        </script>
    </body>
</html>