<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//wc_print_notices();
/**
 * @hooked wc_empty_cart_message - 10
 */
do_action( 'woocommerce_cart_is_empty' );

?>
	<div class="cart-empty-section">
		<img src="/wp-content/themes/lalit/images/empty-cart.png" alt="Empty Cart">
		
<?php
	do_action( 'the_lalit_cart_is_empty' );
	if ( wc_get_page_id( 'shop' ) > 0 ) : 

		/**
		* the_lalit_display_destinations hook.
		*
		* @hooked the_lalit_display_destinations_callback
		*/
		do_action('the_lalit_display_destinations');
								
	endif; 
?>
	</div>
