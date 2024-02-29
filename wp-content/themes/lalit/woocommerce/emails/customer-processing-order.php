<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     3.5.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $order_contains_only_virtual;
global $order_contains_both_shippable_and_virtual;
global $order_contains_only_shippable;

$order_contains_only_virtual = false;
$order_contains_both_shippable_and_virtual = false;
$order_contains_only_shippable = false;

/**
 * @hooked the_lalit_woocommerce_email_header_callback Output the email header
 * @hooked the_lalit_set_order_id_global Set the order id to global
 */
do_action( 'the_lalit_woocommerce_email_header', $order, $email_heading, $email ); 

/**
 * @hooked the_lalit_woocommerce_email_order_details_callback Shows the order details table.
 * 
 */
do_action( 'the_lalit_woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked the_lalit_woocommerce_email_customer_details_callback Shows customer details
 * 
 */
do_action( 'the_lalit_woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked the_lalit_woocommerce_email_hotel_venues_callback Shows customer details
 * 
 */
do_action( 'the_lalit_woocommerce_email_hotel_venues', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked the_lalit_woocommerce_email_footer_callback Output the email footer
 */
do_action( 'the_lalit_woocommerce_email_footer', $email );

/**
 * @hooked the_lalit_woocommerce_email_global_footer_callback Output the email header - 13
 * 
 */
do_action( 'the_lalit_woocommerce_email_global_footer' );