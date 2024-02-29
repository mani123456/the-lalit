<?php
/**
 * Show error messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/error.php.
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
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ) {
	return;
}

?>
<ul class="woocommerce-error error-message-woocommerce">
	<?php foreach ( $messages as $message ) : ?>
		<?php
		if(strpos($message, 'Billing') != FALSE)
		{
			$message = str_replace("Billing ","",$message);
		}
		
		if(strpos($message, 'Please enter an alternative shipping address') != FALSE) 
		{
			$message = 'Sorry! We do not ship to your country. We only ship to the city from which you bought the product. Please enter a valid shipping address, or remove the product from your cart.';
		}

		if(strpos($message, ' Username is required.') != FALSE)
		{
			$message = str_replace("Username","Email address",$message);
		}

		if(strpos($message, 'username or email.') != FALSE)
		{
			$message = ' Invalid email address.';
		}

		if(strpos($message, 'username or email address.') != FALSE)
		{
			$message = str_replace("username or","",$message);
		}

		if(strpos(trim($message), 'do not match.') != FALSE)
		{
			$message = 'Passwords do not match.';
		}
		?>
		<li class="error-message-list"> <i class="ico-sprite sprite size-26 ico-close-with-circle error-message-icon"></i> <?php echo wp_kses_post( $message ); ?></li>
	<?php endforeach; ?>
</ul>
