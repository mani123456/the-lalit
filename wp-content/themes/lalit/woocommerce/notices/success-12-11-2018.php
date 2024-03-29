<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
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

if ( ! $messages ) {
	return;
}

?>

<?php foreach ( $messages as $message ) : ?>
	<?php

		if(stripos($message, 'removed.'))
		{
			$message = str_replace("removed.", "removed from your cart.", $message);
		}
		if(strpos($message, 'details changed successfully.'))
		{
			$message = str_replace("Account", "Personal", $message);
		}
	?>
	<div class="woocommerce-message success-message-woocommerce">
		<!-- <i class="sprite <?php //echo $class; ?>"></i> -->
		<span class="success-message"><?php echo wp_kses_post( $message ); ?></span> 
	</div>
<?php endforeach; ?>
