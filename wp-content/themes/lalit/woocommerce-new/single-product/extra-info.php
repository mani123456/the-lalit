<?php
/**
 * Extra information
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
global $product;
?>
<div class="product-detail-otherinfo">
	<?php
	if ( ! empty( $GLOBALS['breadcrumb'] ) ) 
	{
		$c = 0;
		foreach ( array_reverse($GLOBALS['breadcrumb']) as $key => $crumb ) 
		{
			if($c > 0)
			{
				if ( ! empty( $crumb[1] ) && sizeof( $GLOBALS['breadcrumb'] ) !== $key + 1 ) 
				{
	?>
	<!-- <p>
		<a class="product-detail-category-link" href="<?php echo esc_url( $crumb[1] ); ?>">View all <?php echo esc_html( $crumb[0] ); ?> <i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a>
	</p> -->
	<?php
				}
			}
			$c++;
		}
	}
	?>

	<!-- <p>
		<a class="product-detail-category-link" href="<?php echo site_url()?>/the-lalit-<?php echo $GLOBALS['location'][0]->slug; ?>/offers/">View All Offers at <?php echo $GLOBALS['hotel_name']; ?> <i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a>
	</p> -->
	<?php

		/**
		* the_lalit_display_destinations hook.
		*
		* @hooked the_lalit_display_destinations_callback
		*/
		//do_action('the_lalit_display_destinations');
	?>
</div>