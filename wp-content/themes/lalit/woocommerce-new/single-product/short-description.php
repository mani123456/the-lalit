<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
<!--<div class="woocommerce-product-details__short-description">-->
   <p class="product-description"> <?php echo $post->post_excerpt ?></p>
   <?php
				$hours = get_post_meta(get_the_ID(), 'duration_hour_rejuve', true);
				$minutes = get_post_meta(get_the_ID(), 'duration_min_rejuve', true);
				$duration_html = '';
				if($hours)
				{
					$duration_html .= "<p class='detail-product-duration-heading'>Duration: <span class='detail-product-duration'>".$hours." hour";
					$duration_html .= ($hours > 1) ? 's' : '';
					
				}
				if($minutes)
				{
					if(strpos($duration_html, '<p') !== false){
						$duration_html .= " and $minutes minute";
					}
					else{
						$duration_html .= "<p class='detail-product-duration-heading'>Duration: <span class='detail-product-duration'> $minutes minute";
					}
					$duration_html .= ($minutes > 1) ? 's' : '';
					$duration_html .= "</span></p>";
				}
				else if($duration_html != '')
				{
					$duration_html .= "</span></p>";
				}
				echo $duration_html;
			?>
<!--</div>-->
