<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_permalink = get_permalink( $product->id ) ;
$product_short_description = $product->post->post_excerpt;
$hotel_id = get_post_meta($product->id, 'hotel_product', true);
$hotel_name = get_the_title($hotel_id[0]);

?>
<?php
$cat_id = get_query_var('product_cat');
if($cat_id)
{
	if(isIPad())
	{
		$col_class = "col6";
	}
	else if (isMobile())
	{
		$col_class = "mob-col12";
	}
	else
	{
		$col_class = "col4";
	}
}
else if($GLOBALS['cross_sells'])
{
	if(isMobile() || isIPad())
	{
		$col_class = "col12";
	}
	else
	{
		$col_class = "col6";
	}
}
else
{
	$col_class = "col6";
}
?>


<div class="col <?php echo $col_class; ?> offer-listing-block">
	<div <?php post_class(); ?>>
	<?php

			/**
			* woocommerce_before_shop_loop_item hook.
			*
			* @hooked woocommerce_template_loop_product_link_open - 10
			*/
			do_action( 'woocommerce_before_shop_loop_item' );
			?>
		<?php


		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		//do_action( 'woocommerce_shop_loop_item_title' );
		?>
			<?php if(!$cat_id) : ?>
			<h6 class="product-hotel"><?php echo $hotel_name; ?></h6>
			<?php endif; ?>
			

			<h5 class="woocommerce-loop-product__title card-info-title bdr-bottom align-left">
				<span class="bdr-bottom-gold content-product-title"><?php echo apply_filters( 'replace_product_title_with_display_name', get_the_title() ); ?></span>
			</h5>
		

			<p class="content-product-description align-left">
				<?php
				if(isIpad() || isMobile())
				{
					if(strlen($product_short_description) > 80)
					{
						echo trim(substr($product_short_description, 0, 80)).'...';
					}
					else
					{
					 	echo trim($product_short_description); 
					}
				}
				else
				{
					if(strlen($product_short_description) > 110)
					{
						echo trim(substr($product_short_description, 0, 110)).'...';
					}
					else
					{
					 	echo trim($product_short_description); 
					}
				}
				?>
			</p>
			<?php
				$hours = get_post_meta($product->id, 'duration_hour_rejuve', true);
				$minutes = get_post_meta($product->id, 'duration_min_rejuve', true);
				$duration_html = '';
				if($hours)
				{
					$duration_html .= "<p class='duration align-left'><strong>Duration:</strong> $hours hour";
					$duration_html .= ($hours > 1) ? 's' : '';
				}
				if($minutes)
				{
					if(strpos($duration_html, '<p') !== false){
						$duration_html .= " and $minutes minute";
					}
					else{
						$duration_html .= "<p class='duration align-left'><strong>Duration:</strong> $minutes minute";
					}
					
					$duration_html .= ($minutes > 1) ? 's' : '';
					$duration_html .= "</p>";
				}
				else if($duration_html != '')
				{
					$duration_html .= "</p>";
				}
				echo $duration_html;
			?>
			<?php
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
			
			<a class="content-product-link" href="<?php echo $product_permalink; ?>">Buy Now <i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a>
	</div>
</div>