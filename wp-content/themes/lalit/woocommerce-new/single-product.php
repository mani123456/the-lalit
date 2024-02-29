<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$product_id = get_the_ID();
$hotel_id = get_post_meta( $product_id, 'hotel_product', true )[0];
$GLOBALS['hotel_name'] = get_the_title($hotel_id);
$location = get_the_terms($hotel_id, 'locations');
$location_id = '';
foreach($location as $value)
{
     $location_id = $value->term_id;
}

$GLOBALS['location'] = $location;
$GLOBALS['location_id'] = $location_id;
$GLOBALS['address'] = get_post_meta($hotel_id,"address",true);
$GLOBALS['email'] = get_post_meta($hotel_id,"email",true);
$GLOBALS['phone'] = get_post_meta($hotel_id,"phone",true);
$GLOBALS['fax'] = get_post_meta($hotel_id,"fax",true);
$GLOBALS['review_widget'] = get_post_meta( $hotel_id, "review_widget", true);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
        <style type="text/css">
        	.ajaxerrors{
        		display: none;
        	}
        </style>
    </head>
    <body <?php body_class('local-page product-detail-page'); ?>>
    	<div class="main-wrap">
    		<?php get_header(); ?>

				<?php
					/**
					 * the_lalit_before_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 */
					//do_action( 'woocommerce_before_main_content' );
					do_action( 'the_lalit_before_main_content' );
				?>

					<?php while ( have_posts() ) : the_post(); ?>
						<div class="content-section">
							<div class="page-con">
								<div class="container section-space"> 
	                            	<div class="row">                   
										<?php wc_get_template_part( 'content', 'single-product' ); ?>
									</div>
								</div>
							</div>
						</div>

					<?php endwhile; // end of the loop. ?>

				<?php
					/**
					 * woocommerce_after_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
				?>

				<?php
					/**
					 * woocommerce_sidebar hook.
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					//do_action( 'woocommerce_sidebar' );
				?>

			<?php get_footer();?>
		</div>
	</body>
</html>