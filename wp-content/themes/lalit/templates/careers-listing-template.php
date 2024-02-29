<?php
/**
 *
  Template Name: Careers Listing Template
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
$itemList[1]['item']['@id'] = site_url().'/careers';
$itemList[1]['item']['name'] = 'Careers';

$itemList[2]['@type'] = 'ListItem';
$itemList[2]['position'] = $position + 2;
$itemList[2]['item']['@id'] = site_url().$_SERVER['REQUEST_URI'];
$itemList[2]['item']['name'] = get_the_title(get_the_id());
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
    <body <?php body_class('global-page hide-sharing'); ?>>
        <div class="main-wrap">
        	<?php get_header(); ?>
        		<?php get_template_part( 'template-parts/careers', 'listing' ); ?>
        	<?php get_footer(); ?>
        </div>
    </body>
    <script type="text/javascript">

        jQuery(document).ready(function(){

            jQuery('.filter-item').on('mouseover',function(){

                jQuery(this).find('.sub-menu').find('ul.drop-down-menu').css('display','block');

            });

            jQuery('.city-filter').on('click',function(){

                jQuery(this).closest('.drop-down-menu').hide();
                jQuery('a.job-listing-block').hide();
                jQuery('.no-record-found').fadeOut(50);
                jQuery('.dept-filter').closest('li').removeClass('active');
                jQuery('.dept').text('Department');
                jQuery('.dept').append(' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');

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
                        jQuery('.all-destinations').fadeIn(100);
                        jQuery('a.job-listing-block').fadeIn(100);
                    },200);
                }
                else
                {
                    setTimeout(function(){
                        jQuery('.'+deptClass).closest('li').fadeIn(100);
                        jQuery('a.'+deptClass).fadeIn(100);
                        if(jQuery('.all-destinations:visible').length == 0)
                        {
                            jQuery('.no-record-found').fadeIn(100);
                        }
                    },200);
                }

            });

            jQuery('.dept-filter').on('click',function(){
                jQuery('a.job-listing-block').fadeIn(100);
                jQuery(this).closest('.drop-down-menu').hide();
                jQuery('.no-record-found').fadeOut(50);
                jQuery('.city-filter').closest('li').removeClass('active');
                jQuery('.city').text('City');
                jQuery('.city').append(' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');


                jQuery('.dept-filter').closest('li').removeClass('active');
                jQuery(this).closest('li').addClass('active');
                jQuery('.dept').text('');
                jQuery('.dept').text(jQuery(this).text());
                jQuery('.dept').append(' <i class="ico-sprite sprite ico-gre-down-arrow"></i>');

                deptClass = jQuery(this).closest('li').attr('data-dept-name');

                jQuery('.all-departments').fadeOut(20);

                if(deptClass == 'all-departments')
                {
                    setTimeout(function(){
                        jQuery('.all-departments').fadeIn(100);
                        jQuery('a.job-listing-block').fadeIn(100);
                    },200);
                }
                else
                {
                    setTimeout(function(){
                        jQuery('.'+deptClass).closest('li').fadeIn(100);
                        if(jQuery('.all-departments:visible').length == 0)
                        {
                            jQuery('.no-record-found').fadeIn(100);
                        }
                    },200);

                }

            });


        });

    </script>
</html>