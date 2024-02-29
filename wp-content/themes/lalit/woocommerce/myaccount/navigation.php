<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//do_action( 'woocommerce_before_account_navigation' );
?>

<div class="row">
	
	<div class="col col2">
		<h6 class="dashboard-myaccount-header">My account</h6>
		<nav class="woocommerce-MyAccount-navigation myaccount-navigation">
			<ul class="myaccount-list">
				<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
					<?php if($endpoint != 'downloads') { ?>
					<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> myaccount-list-link">
						<?php
						if($endpoint == 'customer-logout')
						{
						?>
							<a class="myaccount-links" href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>"><?php if($endpoint == 'edit-account') { echo 'Personal Details'; } else { echo esc_html( $label ); } ?></a>
						<?php
						}
						else
						{
						?>
							<a class="myaccount-links" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php if($endpoint == 'edit-account') { echo 'Personal Details'; } else { echo esc_html( $label ); } ?></a>
						<?php
						}
						?>
					</li>
					<?php } ?>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
	


<?php //do_action( 'woocommerce_after_account_navigation' ); ?>
		