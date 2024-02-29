<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Welcome Email class used to send out welcome emails to customers purchasing a course
 *
 * @extends \WC_Email
 */

class The_Lalit_Order_Confirmed_Email extends WC_Email {
	
	/**
	 * Set email defaults
	 */
	public function __construct() {

		// Unique ID for custom email
		$this->id = 'the_lalit_order_confirmed_email';

		// Is a customer email
		$this->customer_email = true;
		
		// Title field in WooCommerce Email settings
		$this->title = __( 'The Lalit Order Confirmed', 'woocommerce' );

		// Description field in WooCommerce email settings
		$this->description = __( 'This is the order complete email and is sent when the order is successful.', 'woocommerce' );

		// Default heading and subject lines in WooCommerce email settings
		$this->subject = apply_filters( 'the_lalit_order_confirmed_email_default_subject', __( '[The LaLiT] CONFIRMED: Your order number is {order_number}', 'woocommerce' ) );
		$this->heading = apply_filters( 'the_lalit_order_confirmed_email_default_heading', __( 'Your order is complete', 'woocommerce' ) );
		
		// these define the locations of the templates that this email should use, we'll just use the new order template since this email is similar
		
		//$this->template_base  = get_template_directory().'/woocommerce/';	// Fix the template base lookup for use on admin screen template path display
		$this->template_html  = 'emails/customer-processing-order.php';
		$this->template_plain = 'emails/plain/customer-processing-order.php';

		// Trigger email when payment is complete
		/*add_action( 'woocommerce_payment_complete', array( $this, 'trigger' ) );
		add_action( 'woocommerce_order_status_on-hold_to_processing', array( $this, 'trigger' ) );
		add_action( 'woocommerce_order_status_on-hold_to_completed', array( $this, 'trigger' ) );
		add_action( 'woocommerce_order_status_failed_to_processing', array( $this, 'trigger' ) );
		add_action( 'woocommerce_order_status_failed_to_completed', array( $this, 'trigger' ) );
		add_action( 'woocommerce_order_status_pending_to_processing', array( $this, 'trigger' ) );*/
		
		// Call parent constructor to load any other defaults not explicity defined here
		parent::__construct();

	}


	/**
	 * Prepares email content and triggers the email
	 *
	 * @param int $order_id
	 */
	public function trigger( $order_id ) {


		global $order_contains_only_virtual;
		global $order_contains_both_shippable_and_virtual;
		global $order_contains_only_shippable;

		// Bail if no order ID is present
		if ( ! $order_id )
			return;
		
		// Send welcome email only once and not on every order status change		
		if ( ! get_post_meta( $order_id, '_the_lalit_order_confirmed_email_sent', true ) ) {
			
			// setup order object
			$this->object = new WC_Order( $order_id );
			
			// get order items as array
			$order_items = $this->object->get_items();

			/* Proceed with sending email */
			
			$this->recipient = $this->object->billing_email;

			// replace variables in the subject/headings
			$this->find[] = '{order_date}';
			$this->replace[] = date_i18n( woocommerce_date_format(), strtotime( $this->object->order_date ) );

			$this->find[] = '{order_number}';
			$this->replace[] = $this->object->get_order_number();

			if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
				return;
			}

			//var_dump($this->get_content());exit;
			// All well, send the email
			$email_subject = $this->get_subject();

			if($order_contains_only_virtual){

				$email_subject = str_ireplace('Confirmed', 'COMPLETE', $email_subject);
			}
			
			$email_headers = "Content-Type: " . $this->get_content_type() . "\r\n";

			$reply_to_email = 'ecampaign@thelalit.com';
			$email_headers .= "Reply-to: The LaLiT <$reply_to_email>\r\n";

			//if($this->send( $this->get_recipient(), $email_subject, $this->get_content(), $this->get_headers(), $this->get_attachments())){

				$this->send($this->get_recipient(), $email_subject, $this->get_content(), $email_headers, $this->get_attachments());
				/*$voucher_attachment_directory = get_template_directory().'/voucher-directory-'.$order_id.'/';

				if(is_dir($voucher_attachment_directory)){

					foreach(glob($voucher_attachment_directory.'*.pdf') as $file) {

						unlink($file);
					}

					rmdir($voucher_attachment_directory);
				}*/
			//}
			
			// add order note about the same
			$this->object->add_order_note( sprintf( __( '%s email sent to the customer.', 'woocommerce' ), $this->title ) );

			// Set order meta to indicate that the welcome email was sent
			update_post_meta( $this->object->id, '_the_lalit_order_confirmed_email_sent', 1 );
			
		}
		
	}
	
	/**
	 * get_content_html function.
	 *
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
		) );
	}


	/**
	 * get_content_plain function.
	 *
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}


	/**
	 * Initialize settings form fields
	 */
	public function init_form_fields() {

		$this->form_fields = array(
			'enabled'    => array(
				'title'   => __( 'Enable/Disable', 'woocommerce' ),
				'type'    => 'checkbox',
				'label'   => 'Enable this email notification',
				'default' => 'yes'
			),
			'subject'    => array(
				'title'       => __( 'Subject', 'woocommerce' ),
				'type'        => 'text',
				'description' => sprintf( 'This controls the email subject line. Leave blank to use the default subject: <code>%s</code>.', $this->subject ),
				'placeholder' => '',
				'default'     => ''
			),
			'heading'    => array(
				'title'       => __( 'Email Heading', 'woocommerce' ),
				'type'        => 'text',
				'description' => sprintf( __( 'This controls the main heading contained within the email notification. Leave blank to use the default heading: <code>%s</code>.' ), $this->heading ),
				'placeholder' => '',
				'default'     => ''
			),
			'email_type' => array(
				'title'       => __( 'Email type', 'woocommerce' ),
				'type'        => 'select',
				'description' => __( 'Choose which format of email to send.', 'woocommerce' ),
				'default'       => 'html',
				'class'         => 'email_type wc-enhanced-select',
				'options'     => array(
					'plain'	    => __( 'Plain text', 'woocommerce' ),
					'html' 	    => __( 'HTML', 'woocommerce' ),
					'multipart' => __( 'Multipart', 'woocommerce' ),
				)
			)
		);
	}
		
}