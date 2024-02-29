<?php

	/* Change woocommerce template title starts here */
	add_filter( 'aioseop_title', 'change_wordpress_seo_title', 10 ,1);
	function change_wordpress_seo_title( $wootitle ){
		$obj = new WC_Query();
		$current_endpoint = $obj->get_current_endpoint();
		if ( $current_endpoint ==  'view-order'  ) {
		    $wootitle = 'Order Details | The LaLiT';
		}
		else
		if ( $current_endpoint ==  'edit-account'  ) {
		    $wootitle = 'Edit Account | The LaLiT'; 
		}
		if ( $current_endpoint ==  'edit-address'  ) {
		    $wootitle = 'Edit Address | The LaLiT'; 
		}
		else
		if ( $current_endpoint == 'lost-password'  ) {
		    $wootitle = 'Lost Password | The LaLiT';    
		}
		else
		if ( $current_endpoint == 'customer-logout'  ) {
		    $wootitle = 'Logout | The LaLiT';   
		}
		else
		if ( $current_endpoint ==  'order-pay'  ) {
		    $wootitle = 'Order Payment | The LaLiT';
		}
		else
		if ( $current_endpoint == 'order-received'  ) {
		    $wootitle = 'Order Received | The LaLiT';
		}
		else
		if ( $current_endpoint == 'add-payment-method'  ) {
		    $wootitle = 'Add Payment Method | The LaLiT';   
		}
		else
		if(is_account_page() && is_user_logged_in() && !$current_endpoint) {
			$wootitle = 'Dashboard | The LaLiT'; 
		}
		else
		if($current_endpoint == 'orders') {
			$wootitle = 'My Orders | The LaLiT';
		}
		else 
		if($current_endpoint == 'edit-account') {
			$wootitle = 'Edit Account | The LaLiT';
		}
		return $wootitle;
	}
	/* Change woocommerce template title starts here */

	/* Change woocommerce template title starts here */
	/*add_filter('wp_title', 'change_woocommerce_template_title');
	function change_woocommerce_template_title($page_title) {
		global $title;
		if($title)
		{
			$page_title = $title;
		}
		return $page_title;
	}*/
	/* Change woocommerce template title ends here */

	/* Added theme supoort for Woocommerce code starts here*/
    add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
		add_theme_support( 'woocommerce');
	    /*$theme_support = get_theme_support( 'woocommerce' );
		$theme_support = is_array( $theme_support ) ? $theme_support[0] : array();
		$theme_support['thumbnail_image_width'] = 145;

		remove_theme_support( 'woocommerce' );
		add_theme_support( 'woocommerce', $theme_support );*/
	    remove_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
	/* Added theme supoort for Woocommerce code ends here */


	/* Woocommerce code to remove tabs from the product detail page starts here */
	add_filter( 'woocommerce_product_tabs', 'the_lalit_remove_product_tabs', 98 );
	function the_lalit_remove_product_tabs( $tabs ) {

	    //unset( $tabs['description'] );      	// Remove the description tab
	    unset( $tabs['reviews'] ); 			// Remove the reviews tab
	    unset( $tabs['additional_information'] );  	// Remove the additional information tab

	    return $tabs;

	}
	/* Woocommerce code to remove tabs from the product detail page ends here */


	/* Woocommerce code to add custom tabs starts here */
	add_filter( 'woocommerce_product_tabs', 'the_lalit_new_product_tabs', 99 );
	function the_lalit_new_product_tabs( $tabs ) {

		global $product;

		$product_inclusions = get_post_meta(get_the_id(), 'woocommerce_inclusions', true);
		$product_description = $product->get_description();

		$parent_product = get_post_meta($product->get_id(), 'parent_product', true);

		if($parent_product){

			$product_terms_and_conditions = get_post_meta($parent_product[0], 'woocommerce_terms_and_conditions', true);
			$product_redemption_instructions = get_post_meta($parent_product[0], 'woocommerce_redemption_instructions', true);
		}
		else{

			$product_terms_and_conditions = get_post_meta(get_the_id(), 'woocommerce_terms_and_conditions', true);
			$product_redemption_instructions = get_post_meta(get_the_id(), 'woocommerce_redemption_instructions', true);
		}
		
		if(trim($product_inclusions) != '') {

			$tabs['inclusions'] = array(
				'title' 	=> __( 'Inclusions', 'woocommerce' ),
				'priority' 	=> 50,
				'callback' 	=> 'the_lalit_inclusions_content'
			);

		}

		if(trim($product_terms_and_conditions) != '') {

			$tabs['terms_and_conditions'] = array(
				'title' 	=> __( 'Terms & Conditions', 'woocommerce' ),
				'priority' 	=> 51,
				'callback' 	=> 'the_lalit_terms_and_conditions_content'
			);

		}

		if(trim($product_redemption_instructions) != '') {

			$tabs['redemption_instructions'] = array(
				'title' 	=> __( 'Redemption Details', 'woocommerce' ),
				'priority' 	=> 52,
				'callback' 	=> 'the_lalit_redemption_instructions_content'
			);

		}

		if(trim($product_description) == '') {

			unset( $tabs['description'] );

		}

		return $tabs;
	}


	function the_lalit_inclusions_content() {

		global $product;
		echo $product_inclusions = get_post_meta($product->get_id(), 'woocommerce_inclusions', true);
	}

	function the_lalit_terms_and_conditions_content() {

		global $product;

		$parent_product = get_post_meta($product->get_id(), 'parent_product', true);

		if($parent_product){

			echo $product_terms_and_conditions = get_post_meta($parent_product[0], 'woocommerce_terms_and_conditions', true);
		}
		else{

			echo $product_terms_and_conditions = get_post_meta($product->get_id(), 'woocommerce_terms_and_conditions', true);
		}
	}

	function the_lalit_redemption_instructions_content() {
		
		global $product;

		$parent_product = get_post_meta($product->get_id(), 'parent_product', true);

		if($parent_product){

			echo $product_redemption_instructions = get_post_meta($parent_product[0], 'woocommerce_redemption_instructions', true);
		}
		else{

			echo $product_redemption_instructions = get_post_meta($product->get_id(), 'woocommerce_redemption_instructions', true);
		}
	}
	/* Woocommerce code to add custom tabs ends here */


	/* Woocommerce code to remove variation attributes from the title starts here */
	add_filter( 'woocommerce_product_variation_title_include_attributes', 'the_lalit_variation_title', 10, 2 );
	function the_lalit_variation_title($should_include_attributes, $product) {
	    $should_include_attributes = false;
	    return $should_include_attributes;
	}
	/* Woocommerce code to remove variation attributes from the title ends here */


	/* replace product title with display name */
	add_filter('replace_product_title_with_display_name', 'change_product_title');
	function change_product_title() {
		global $product;
		if($product) {
			$product_id = $product->id;
			$product_display_name = get_post_meta($product_id, 'woocommerce_product_display_name', true);
			echo $product_display_name;
		}
	}
	/* replace product title with display name */

	/* replace title with display name in cart item removed message */
	add_filter('woocommerce_cart_item_removed_title', 'change_product_title_cart_notice' ,1, 2);
	function change_product_title_cart_notice($product, $cart_item)
	{
		if($cart_item) 
		{	
			$product_display_name = get_post_meta($cart_item['product_id'], 'woocommerce_product_display_name', true);
			return '"'.$product_display_name.'"';
		}
	}
	/* replace title with display name in cart item removed message */


	// remove woocommerce sidebar
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	
	
	/* Custom action hooks for cart pages starts here */
	add_action('the_lalit_cross_sells','woocommerce_cross_sell_display');

	add_action('the_lalit_display_subtotals','woocommerce_cart_totals', 10);
	/* Custom action hooks for cart pages ends here */

	/* Custom add to cart message code starts here */
	add_filter( 'wc_add_to_cart_message', 'the_lalit_add_to_cart_message', 10, 2);
	function the_lalit_add_to_cart_message($message, $product_id) {

	    $product_display_name = get_post_meta($product_id, 'woocommerce_product_display_name', true);
	    $message_string = $product_display_name.' has been added to your cart.';
	    $cart_url = get_permalink(woocommerce_get_page_id('cart'));


	    $message = sprintf('<div class="woocommerce-message success-message-woocommerce"><i class="sprite ico-check-with-circle></i><a href="%s" class="button wc-forward">View cart</a><span>%s</span></div>', $cart_url, $message_string );
	    return $message;
	}
	/* Custom add to cart message code ends here */

	/* Custom action hook for displaying property links starts here */
	add_action('the_lalit_display_destinations', 'the_lalit_display_destinations_callback');
	function the_lalit_display_destinations_callback() 
	{
		$locations = get_terms([
		    'taxonomy' => 'locations',
		    'hide_empty' => false,
		]);

		$locations_array = array();

?>
		<div class="hotel-link-section">
			<?php
				if(is_cart())
				{

					global $woocommerce;
				    $items = $woocommerce->cart->get_cart();
			    	$i = 0;
					
					$links_count = 0;			    	

			        foreach($items as $item => $values) {

			            $product =  wc_get_product( $values['data']->get_id());

			            if($product->is_type('variation')){

			            	$product_id = $product->parent_id;
			            }
			            else{

							$product_id = $product->get_id();
			            }
			       		$product_hotel_id = get_post_meta($product_id, 'hotel_product', true);
			       		$product_hotel_name = get_post_meta($product_hotel_id[0], 'name', true);

			       		$product_location_taxonomies = get_the_terms($product_hotel_id[0],'locations');

			       		if($product_location_taxonomies){

			       			foreach ($product_location_taxonomies as $product_location_taxonomy) {
			       			
				       			if(!in_array($product_location_taxonomy->slug, $locations_array)){

					       			array_push($locations_array, $product_location_taxonomy->slug);
					       			$links_count++;
					       			?>
					       			<p>
										<a class="product-detail-category-link" href="<?php echo site_url()?>/the-lalit-<?php echo $product_location_taxonomy->slug; ?>/offers/">View All Offers at <?php echo $product_hotel_name; ?> <i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a>
									</p>
					       			<?php
					       		}
				       		}
			       		}
			        }

					if(WC()->cart->get_cart_contents_count() != 0)
					{
						if($links_count != (count($locations)-1)){

						?>
						<h4 class="hotel-link-header">Browse All Other Offers</h4>
						<?php
						}
			
					}
					else
					{
						?>
						<h4 class="hotel-link-header">Browse Offers In</h4>
						<?php
					}
				}

				if($links_count != (count($locations)-1)){
				
					if(isMobile())
					{
					?>
						<div class="row sub-menu-links-block">
							<div class="<?php if(isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col3<?php } ?>">
								<ul class="unstyled-listing">
									<?php
										$i = 1;
										foreach($locations as $l)
										{
											if($l->slug != 'london' && !in_array($l->slug, $locations_array)) 
											{
									?>
												<li class="list-item"><a class="hotel-link" href="<?php echo site_url(); ?>/the-lalit-<?php echo $l->slug;?>/offers/"><?php echo $l->name; ?><i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a></li>
												<?php
													if( $i % 6 == 0 && $i < count($locations)-1)
													{
												?>
														</ul><!-- unstyled-listing -->
														</div><!-- col -->
														<div class="<?php if(isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col3<?php } ?>">
														<ul class="unstyled-listing">
												<?php
													}
												$i++;
											}
										}
									?>
								</ul><!-- unstyled-listing -->
							</div><!-- col -->
						</div><!-- row -->
					<?php
					}
					else
					{
					?>
						<div class="row sub-menu-links-block">
							<div class="<?php if(isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col3<?php } ?>">
								<ul class="unstyled-listing">
									<?php
										$i = 1;
										foreach($locations as $l)
										{
											if($l->slug != 'london' && !in_array($l->slug, $locations_array)) 
											{
									?>
												<li class="list-item"><a class="hotel-link" href="<?php echo site_url(); ?>/the-lalit-<?php echo $l->slug;?>/offers/"><?php echo $l->name; ?><i class="ico-sprite sprite size-10 ico-red-right-arrow"></i></a></li>
												<?php
													if( $i % 3 == 0 && $i < count($locations)-1)
													{
												?>
														</ul><!-- unstyled-listing -->
														</div><!-- col -->
														<div class="<?php if(isMobile()) { ?>mob-col mob-col6<?php } else { ?>col col3<?php } ?>">
														<ul class="unstyled-listing">
												<?php
													}
												$i++;
											}
										}
									?>
								</ul><!-- unstyled-listing -->
							</div><!-- col -->
						</div><!-- row -->
					<?php
					}
				}
			?>
		</div>
		
<?php	
	}

	/*function the_lalit_remove_cart_item_ajax() {
		include 'ajax/remove_from_cart_ajax.php';
		exit;
	}
	add_action('wp_ajax_the_lalit_remove_cart_item', 'the_lalit_remove_cart_item_ajax');
	add_action('wp_ajax_nopriv_the_lalit_remove_cart_item', 'the_lalit_remove_cart_item_ajax');*/

	/* Custom action hook for displaying property links ends here */


	/* Adding products to cart from details page using ajax code starts here */
	function the_lalit_adding_scripts() {

		if(is_product()){
			wp_register_script('single-product-add-to-cart', get_template_directory_uri().'/js/woocommerce/single-product-add-to-cart.min.js', array('jquery'),'1.1', true);
			wp_enqueue_script('single-product-add-to-cart');
		}
		/*else if(is_cart()){
	
			/*wp_register_script('button-click-overlay-change', get_template_directory_uri().'/js/button-click-overlay-change.js', array('jquery'),'1.1', true);
			wp_enqueue_script('button-click-overlay-change');
		}*/
	}
	add_action( 'wp_enqueue_scripts', 'the_lalit_adding_scripts' );


	function the_lalit_add_to_cart_ajax() {
		include 'ajax/add_to_cart_ajax.php';
		exit;
	}
	add_action('wp_ajax_the_lalit_add_to_cart', 'the_lalit_add_to_cart_ajax');
	add_action('wp_ajax_nopriv_the_lalit_add_to_cart', 'the_lalit_add_to_cart_ajax');
	/* Adding products to cart from details page using ajax code ends here */


	add_action('the_lalit_custom_notices', 'the_lalit_add_to_cart_message_div');
	function the_lalit_add_to_cart_message_div(){
		?>
		<div class="the-lalit-custom-notices" style="display:none;"></div>
		<?php
	}

	/* remove price, rating and add to cart from product loop starts here*/
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	/* remove price, rating and add to cart from product loop end here*/


	/** cart coupon html starts here */
	function lalit_cart_totals_coupon_html( $coupon ) {
		if ( is_string( $coupon ) ) {
			$coupon = new WC_Coupon( $coupon );
		}

		$discount_amount_html = '';

		if ( $amount = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax ) ) {
			$discount_amount_html = '<span class="deduction">-</span>' . wc_price( $amount );
		} elseif ( $coupon->get_free_shipping() ) {
			$discount_amount_html = __( 'Free shipping coupon', 'woocommerce' );
		}

		$discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon );
		$coupon_html = $discount_amount_html . ' <a href="' . esc_url( add_query_arg( 'remove_coupon', urlencode( $coupon->get_code() ), defined( 'WOOCOMMERCE_CHECKOUT' ) ? wc_get_checkout_url() : wc_get_cart_url() ) ) . '" class="woocommerce-remove-coupon cart-remove-coupon" data-coupon="' . esc_attr( $coupon->get_code() ) . '">' . __( 'Remove', 'woocommerce' ) . '</a>';

		echo wp_kses( apply_filters( 'woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html ), array_replace_recursive( wp_kses_allowed_html( 'post' ), array( 'a' => array( 'data-coupon' => true ) ) ) );
	}
	/** cart coupon html ends here */

	/** checkout coupon html starts here */
	function lalit_checkout_totals_coupon_html( $coupon ) {
		if ( is_string( $coupon ) ) {
			$coupon = new WC_Coupon( $coupon );
		}

		$discount_amount_html = '';

		if ( $amount = WC()->cart->get_coupon_discount_amount( $coupon->get_code(), WC()->cart->display_cart_ex_tax ) ) {
			$discount_amount_html = '<span class="deduction">-</span>' . wc_price( $amount );
		} elseif ( $coupon->get_free_shipping() ) {
			$discount_amount_html = __( 'Free shipping coupon', 'woocommerce' );
		}

		$discount_amount_html = apply_filters( 'woocommerce_coupon_discount_amount_html', $discount_amount_html, $coupon );
		$coupon_html = $discount_amount_html;

		echo wp_kses( apply_filters( 'woocommerce_cart_totals_coupon_html', $coupon_html, $coupon, $discount_amount_html ), array_replace_recursive( wp_kses_allowed_html( 'post' ), array( 'a' => array( 'data-coupon' => true ) ) ) );
	}
	/** checkout coupon html ends here */

	/* change empty cart message starts here */
	  
  	add_filter('wc_empty_cart_message', 'the_lalit_change_empty_cart_message', 1);
  	function the_lalit_change_empty_cart_message($msg)
  	{
		session_start();
		if(isset($_SESSION['user_session_cart']) && !empty($_SESSION['user_session_cart'])){

			$msg = '<h6 class="cart-empty-text">Please click <a href="'.wc_get_cart_url().'">here</a> to reload your cart with the latest products.</h6>';
			unset($_SESSION['user_session_cart']);
		}
		else{
			$msg = '<h6 class="cart-empty-text">Your Cart is Empty!</h6>';
		}
  		
  		return $msg;
  	}
  	/* change empty cart message ends here */

  	/* remove product landing page pagination hook */
  	remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
  	/* remove product landing page pagination hook */

  	/* show all products on listing page */
  	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ) );
  	/* show all products on listing page */


  	/* remove some defined actions from woocommerce */
  	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
  	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
  	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
  	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
  	/* remove some defined actions from woocommerce */

  	/* checkout form fields */
  	function lalit_checkout_form_field( $key, $args, $value = null, $hide=false ) 
  	{
		$defaults = array(
			'type'              => 'text',
			'label'             => '',
			'description'       => '',
			'placeholder'       => '',
			'maxlength'         => false,
			'required'          => false,
			'autocomplete'      => false,
			'id'                => $key,
			'class'             => array(),
			'label_class'       => array(),
			'input_class'       => array(),
			'return'            => false,
			'options'           => array(),
			'custom_attributes' => array(),
			'validate'          => array(),
			'default'           => '',
			'autofocus'         => '',
			'priority'          => '',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required checkout-required" title="' . esc_attr__( 'required', 'woocommerce' ) . '"></abbr>';
		} else {
			$required = '';
		}

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling
		$custom_attributes         = array();
		$args['custom_attributes'] = array_filter( (array) $args['custom_attributes'] );

		if ( $args['maxlength'] ) {
			$args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
		}

		if ( ! empty( $args['autocomplete'] ) ) {
			$args['custom_attributes']['autocomplete'] = $args['autocomplete'];
		}

		if ( true === $args['autofocus'] ) {
			$args['custom_attributes']['autofocus'] = 'autofocus';
		}

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach ( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}

		$field           = '';
		$label_id        = $args['id'];
		$sort            = $args['priority'] ? $args['priority'] : '';
		if( ($key == 'billing_email' || $key == 'shipping_email') && $value != '') {
			if($hide) {
				$cls = 'hide';
			}
			else {
				$cls = '';
			}
		}
		else {
			$cls = '';
		}
		$field_container = '<p class="'.esc_attr($cls).' form-row %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</p>';

		switch ( $args['type'] ) {
			case 'country' :

				$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

				if ( 1 === sizeof( $countries ) ) {

					$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

					$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

				} else {

					$field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select country-dropdown' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '>' . '<option value="">' . esc_html__( 'Select a country', 'woocommerce' ) . '</option>';

					foreach ( $countries as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
					}

					$field .= '</select>';

					$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '" /></noscript>';

				}

				break;
			case 'state' :

				/* Get country this state field is representing */
				$for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
				//$states = '';
				$states = WC()->countries->get_states( $for_country );

				if ( is_array( $states ) && empty( $states ) ) {

					$field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

					$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

				} elseif ( ! is_null( $for_country ) && is_array( $states ) ) {

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
						<option value="">' . esc_html__( 'Select a state;', 'woocommerce' ) . '</option>';

					foreach ( $states as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
					}

					$field .= '</select>';

				} else {
					
					$field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				}

				break;
			case 'textarea' :

				$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

				break;
			case 'checkbox' :

				$field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> '
						 . $args['label'] . $required . '</label>';

				break;
			case 'password' :
			case 'text' :
			case 'email' :
			case 'tel' :
			case 'number' :
				
					if( ($key == 'billing_email' || $key == 'shipping_email') && $value != '') {
						if($hide) {
							$cls = 'hide';
						}
						else {
							$cls = '';
						}
					}
					else {
						$cls = '';
					}
					$field .= '<input type="' . esc_attr( $args['type'] ) . '" class="'.esc_attr($cls).' input-text checkout-input-text' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' '.$attr.' />';
				
				break;
			case 'select' :

				$options = $field = '';

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						if ( '' === $option_key ) {
							// If we have a blank option, select2 needs a placeholder
							if ( empty( $args['placeholder'] ) ) {
								$args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
							}
							$custom_attributes[] = 'data-allow_clear="true"';
						}
						$options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
					}

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
				}

				break;
			case 'radio' :

				$label_id = current( array_keys( $args['options'] ) );

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						$field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
						$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
					}
				}

				break;
		}

		if ( ! empty( $field ) ) {
			$field_html = '';

			if ( $args['label'] && 'country' == $args['type'] ) {
				$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="country-label ' . esc_attr( implode( ' ', $args['label_class'] ) ) . 'checkout-label-form">' . $args['label'] . $required . ' </label>';	
			}
			else if ( $args['label'] && 'checkbox' != $args['type'] ) {
				if( ($key == 'billing_email' || $key == 'shipping_email') && $value != '') {
					if($hide) {
						$cls = 'hide';
					}
					else {
						$cls = '';
					}
				}
				else {
					$cls = '';
				}
				$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . 'checkout-label-form '.esc_attr($cls).'">' . $args['label'] . $required . '</label>';
			}

			$field_html .= $field;

			if ( $args['description'] ) {
				$field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
			}

			$container_class = esc_attr( implode( ' ', $args['class'] ) );
			$container_id    = esc_attr( $args['id'] ) . '_field';
			$field           = sprintf( $field_container, $container_class, $container_id, $field_html );
		}

		$field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

		if ( $args['return'] ) {
			return $field;
		} else {
			echo $field;
		}
	}
	/* checkout form fields */


	add_filter('woocommerce_checkout_login_message', 'the_lalit_checkout_login_message', 1, 10);
	function the_lalit_checkout_login_message($msg) 
	{
		 $msg = "<p class=checkout-login>Have an existing account?</p>";
		 return $msg;
	}

	add_filter( 'woocommerce_checkout_fields' , 'the_lalit_customise_checkout_fields' );
	function the_lalit_customise_checkout_fields( $fields ) 
	{
		$fields['account']['account_password']['label'] = 'Password';
    	return $fields;
	}

	/* Voucher number generation code starts here */

	if(!is_admin() || is_order_received_page()){

		//include '../../../mpdf60/mpdf.php';
		include( ABSPATH . 'mpdf60/mpdf.php' );
		include( ABSPATH . 'wp-admin/includes/file.php' );

	}

	require('voucher-generation-code/voucher-number-generation.php');
	
	/* Voucher number generation code ends here */

	/* Adding column to orders content type starts here */
	add_filter( 'manage_edit-shop_order_columns', 'the_lalit_custom_voucher_column',11);
	function the_lalit_custom_voucher_column($columns)
	{
	    //add columns
	    //$columns['the-lalit-voucher-code-for-product'] = __( 'Voucher for Product','woocommerce');
	    $columns['the-lalit-voucher-code'] = __( 'Voucher Code','woocommerce');

	    return $columns;
	}

	// adding the data for each orders by column (example)
	add_action( 'manage_shop_order_posts_custom_column' , 'custom_orders_list_column_content', 10, 2 );
	function custom_orders_list_column_content( $column, $order )
	{
	    switch ( $column )
	    {
	        case 'the-lalit-voucher-code' :
	        	$cms_html = the_lalit_generate_cms_voucher_html($order);
				echo $cms_html;
	            break;
	    }
	}

	add_action( 'add_meta_boxes', 'the_lalit_add_metaboxes' );
	function the_lalit_add_metaboxes(){

	  add_meta_box('the_lalit_order_display_vouchers', 'Order Vouchers', 'the_lalit_order_display_vouchers_callback', 'shop_order', 'side', 'core');
	}

	function the_lalit_order_display_vouchers_callback($order){

		$cms_html = the_lalit_generate_cms_voucher_html($order->ID);
		echo $cms_html;
	}

	function the_lalit_generate_cms_voucher_html($order_id){

		$voucher_codes_array = json_decode( get_post_meta( $order_id, 'the_lalit_vouchers_details', true ), true );
		if($voucher_codes_array) {

        	$html = "<ul>";
        	foreach ($voucher_codes_array as $products) {

        		$voucher_code = '';
        		foreach ($products as $product) {

        			if(array_key_exists('variation_id', $product)){

        				$html .= "<li>";
        				$html .= get_post_meta( $product['product_id'], 'woocommerce_product_display_name', true ).' ';
        				foreach ($product['atrributes'] as $name => $value) {
        					
        					$html .= $value.' ';
        				}
        				$html .= ": ".$product['voucher_code'];
        				$html .= "</li>";
        			}
        			else{

        				$html .= "<li>";
        				$html .= get_post_meta( $product['product_id'], 'woocommerce_product_display_name', true )." : ";
        				$html .= $product['voucher_code'];
        				$html .= "</li>";
        			}  
				}
        	}
        	$html .= "</ul>";
        }
        else{

        	$html = '-';
        }

        return $html;
	}
	/* Adding column to orders content type ends here */


	/* Order Completion custom email code starts here */

	function the_lalit_order_confirmed_email_callback( $email_classes ) {

	    require( 'woocommerce/class-the-lalit-order-confirmed-email.php' );
	    $email_classes['The_Lalit_Order_Confirmed_Email'] = new The_Lalit_Order_Confirmed_Email();

	    return $email_classes;
	}
	add_filter( 'woocommerce_email_classes', 'the_lalit_order_confirmed_email_callback' );

	add_action('the_lalit_order_confirmed_email', 'the_lalit_order_confirmed_email_action_callback', 10, 1);
	function the_lalit_order_confirmed_email_action_callback($order){

		WC()->mailer()->emails['The_Lalit_Order_Confirmed_Email']->trigger($order->get_id());
	}

	/* Order Completion custom email code ends here */

	/* Order Confirmed Custom Email Template Code starts here */

	require('woocommerce-custom-emailers/the-lalit-order-confirmation-email.php');

	/* Order Confirmed Custom Email Template Code ends here */

	/* Order Refund Custom Email Template Code starts here */

	//require('woocommerce-custom-emailers/the-lalit-order-confirmation-email.php');

	/* Order Refund Custom Email Template Code ends here */

	/* New Account Custom Email Template Code starts here */

	require('woocommerce-custom-emailers/the-lalit-new-account-email.php');

	/* New Account Custom Email Template Code ends here */

	/* Reset Password Custom Email Template Code starts here */
	
	require('woocommerce-custom-emailers/the-lalit-reset-password-email.php');

	/* Reset Password Custom Email Template Code ends here */

	/* WooCommerce Order failed email to admin code starts here */

	add_action('trigger_failed_email_to_admin', 'trigger_failed_email_to_admin_callback');
	function trigger_failed_email_to_admin_callback($order){

		$mailer = WC()->mailer();
		$mails = $mailer->get_emails();
		if ( ! empty( $mails ) ) {
		    foreach ( $mails as $mail ) {
		        if ( $mail->id == 'failed_order' ) {
		        	$mail->enabled = 'yes';
		        	$mail->trigger( $order->get_id() );
		        	$mail->enabled = 'no';
		        }
		     }
		}
	}
	
	/* WooCommerce Order failed email to admin code ends here */


	/* Woocommerce admin code to outlets starts here */

	add_filter( 'woocommerce_email_recipient_new_order', 'wc_new_order_cash_on_delivery_recipient', 10, 2 );
	function wc_new_order_cash_on_delivery_recipient( $recipient, $order ) {
	 	
	 	if(method_exists($order, 'get_items')){

	 		$product_outlet_email = '';
		    $order_items = $order->get_items();
		    
		    foreach ($order_items as $item_id => $item_data) {

		    	$product_id = $item_data['product_id'];
		    	$outlet_email = get_post_meta($product_id, 'woocommerce_outlet_email_id',true);
		    	
		    	if(trim($outlet_email) != ''){

		    		$product_outlet_email .= ',' . $outlet_email;
		    	}
		    }

		    $product_outlet_email = rtrim($product_outlet_email, ',');

		    if(trim($product_outlet_email) != ''){

		    	$recipient .= $product_outlet_email;
		    }
		 
		    return $recipient;
	 	}
	}

	/* Woocommerce admin code to outlets ends here */

	/* adding breadcrum and wrapper start on product detail page */
	add_action( 'the_lalit_breadcrum', 'the_lalit_breadcrumb', 20, 0 );
	add_action( 'the_lalit_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	/* adding breadcrum and wrapper start on product detail page */


	function the_lalit_breadcrumb( $args = array() ) 
	{
		$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '&nbsp;&#47;&nbsp;',
			'wrap_before' => '<nav class="woocommerce-breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			//'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
		) ) );

		$breadcrumbs = new WC_Breadcrumb();

		/*if ( ! empty( $args['home'] ) ) {
			$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
		}*/

		$args['breadcrumb'] = $breadcrumbs->generate();

		/**
		 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
		 */
		do_action( 'the_lalit_breadcrumb', $breadcrumbs, $args );

		wc_get_template( 'global/breadcrumb.php', $args );
	}


	add_action('woocommerce_after_single_product_summary', 'the_lalit_product_detail_extra_info', 12);
	function the_lalit_product_detail_extra_info()
	{
		wc_get_template( 'single-product/extra-info.php' );
	}

	/* change postion of price and short description on product detail page */
	//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
	/* change postion of price and short description on product detail page */


	/* Variable product detail page customization starts here */

	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
	remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );


	add_action( 'the_lalit_generate_empty_div_for_price', 'woocommerce_single_variation', 10 );
	add_action( 'the_lalit_add_to_cart_button', 'the_lalit_single_variation_add_to_cart_button', 20 );
	function the_lalit_single_variation_add_to_cart_button() {
		
		wc_get_template( 'single-product/add-to-cart/variation-add-to-cart-button.php' );
	}
	/* Variable product detail page customization ends here */


	/* Setting the order id to global variable code starts here */
	
	global $order_id;

	add_action( 'the_lalit_woocommerce_email_header', 'the_lalit_set_order_id_global', 10, 3 );
	function the_lalit_set_order_id_global($order, $email_heading, $email){

		global $order_id;
		$order_id = $order->id;
	}

	/* Setting the order id to global variable code ends here */

	/* Attaching voucher pdf in an email code starts here */
	add_filter( 'woocommerce_email_attachments', 'the_lalit_voucher_pdf_attachements', 10, 3 );
	function the_lalit_voucher_pdf_attachements($attachments, $email_id, $email_object){

		if( $email_id == 'the_lalit_order_confirmed_email' ){

			global $order_id;

			$upload_dir = wp_upload_dir();

			if(is_dir(trailingslashit( $upload_dir['basedir'] ).'the-lalit-product-vouchers/'.$order_id.'/')){

				$pdf_path = trailingslashit( $upload_dir['basedir'] ).'the-lalit-product-vouchers/'.$order_id.'/';
				chmod($pdf_path, 0777);
				//$voucher_attachment_directory = get_template_directory().'/voucher-directory-'.$order_id.'/';
				//wp_mkdir_p($voucher_attachment_directory);

				foreach(glob($pdf_path.'*.pdf') as $file) {
					
					//copy($file, $voucher_attachment_directory.basename($file));

					//$file = $voucher_attachment_directory.basename($file);
					$attachments[] = $file;
				}
				return $attachments;
			}
		}
	}

	/* Attaching voucher pdf in an email code ends here */

	/* remove related and upsell products from detail page */
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	/* remove related and upsell products from detail page */

	/* change position of description tabs on product detail page*/
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	add_action('the_lalit_product_details_tabs', 'woocommerce_output_product_data_tabs', 10);
	/* change position of description tabs on product detail page*/
	

	
	/* Separete Login form and registration form */
	add_action('woocommerce_before_customer_login_form','load_registration_form');
	function load_registration_form()
	{
		if($_GET['action']=='register')
		{
			wc_get_template( 'myaccount/form-register.php');
		}
	}
	/* Separete Login form and registration form */


	/* validating extra register fields */
	add_filter( 'woocommerce_process_registration_errors', 'the_lalit_validate_extra_register_fields', 10, 4 );
	function the_lalit_validate_extra_register_fields( $validation_errors, $username, $password, $email ) 
	{
		//echo "abc".trim($_POST['account_first_name'])."def";exit;
		$account_first_name = trim( $_POST['account_first_name'] );
		$account_last_name = trim( $_POST['account_last_name'] );
		$account_phone = $_POST['account_phone'];

       	if ( isset( $account_first_name ) && empty( $account_first_name ) ) {

            $validation_errors->add( 'account_first_name_error', __( 'Please Enter First name.', 'woocommerce' ) );
       	}

       	if ( isset( $account_last_name ) && empty( $account_last_name ) ) {

            $validation_errors->add( 'account_last_name_error', __( 'Please Enter Last name.', 'woocommerce' ) );
		}
		   
		if(!preg_match('%^[+]?[0-9()/ -]*$%', $account_phone)) 
		{
			$validation_errors->add( 'account_phone_error', __( 'Only numbers, -, + . Permitted in <b>Phone Number</b>.', 'woocommerce' ) );
		}
		elseif(strlen($account_phone) > 0 && trim($account_phone) == '')
		{	
			$validation_errors->add( 'account_phone_error', __( 'Spaces not allowed, only numbers, -, + . Permitted in <b>Phone Number</b>.', 'woocommerce' ) );
		}
		
		return $validation_errors;
       	/*if ( strcmp( $_POST['password'], $_POST['confirm_password'] ) !== 0 ) {

			$validation_errors->add( 'confirm_password_error', __( 'Passwords do not match.', 'woocommerce' ) );
		}*/
	}	
	/* validating extra register fields */

	/* Phone number field on the checkout page length code starts here */
	add_filter( 'woocommerce_checkout_fields' , 'the_lalit_custom_override_checkout_fields' );
	function the_lalit_custom_override_checkout_fields( $fields )
	{
		//echo "<pre>";print_r($fields);exit;
		$fields['billing']['billing_salutation']['autofocus'] = true;
		$fields['shipping']['shipping_salutation']['autofocus'] = true;

		$fields['billing']['billing_salutation']['custom_attributes'] = array( "tabindex" => "1" );
		$fields['billing']['billing_first_name']['custom_attributes'] = array( "tabindex" => "2" );
		$fields['billing']['billing_last_name']['custom_attributes'] = array( "tabindex" => "3" );
		$fields['billing']['billing_phone']['custom_attributes'] = array( "tabindex" => "4", "minlength" => "1" );
		$fields['billing']['billing_email']['custom_attributes'] = array( "tabindex" => "5" );

		$fields['shipping']['shipping_salutation']['custom_attributes'] = array( "tabindex" => "1" );
		$fields['shipping']['shipping_first_name']['custom_attributes'] = array( "tabindex" => "2" );
		$fields['shipping']['shipping_last_name']['custom_attributes'] = array( "tabindex" => "3" );
		$fields['shipping']['shipping_phone']['custom_attributes'] = array( "tabindex" => "4", "minlength" => "1" );
		$fields['shipping']['shipping_email']['custom_attributes'] = array( "tabindex" => "5" );

		if(!is_user_logged_in())
		{

			$fields['account']['account_password']['custom_attributes'] = array( "tabindex" => "6" );
			//$fields['account']['account_confirm_password']['custom_attributes'] = array( "tabindex" => "7" );
			
			$fields['billing']['billing_address_1']['custom_attributes'] = array( "tabindex" => "8" );
			$fields['billing']['billing_address_2']['custom_attributes'] = array( "tabindex" => "9" );
			$fields['billing']['billing_city']['custom_attributes'] = array( "tabindex" => "10" );
			$fields['billing']['billing_postcode']['custom_attributes'] = array( "tabindex" => "11" );
			$fields['billing']['billing_state']['custom_attributes'] = array( "tabindex" => "12" );
			$fields['billing']['billing_country']['custom_attributes'] = array( "tabindex" => "13" );

			$fields['shipping']['shipping_address_1']['custom_attributes'] = array( "tabindex" => "8" );
			$fields['shipping']['shipping_address_2']['custom_attributes'] = array( "tabindex" => "9" );
			$fields['shipping']['shipping_city']['custom_attributes'] = array( "tabindex" => "10" );
			$fields['shipping']['shipping_postcode']['custom_attributes'] = array( "tabindex" => "11" );
			$fields['shipping']['shipping_state']['custom_attributes'] = array( "tabindex" => "12" );
			$fields['shipping']['shipping_country']['custom_attributes'] = array( "tabindex" => "13" );
		}
		else
		{
			$fields['billing']['billing_address_1']['custom_attributes'] = array( "tabindex" => "6" );
			$fields['billing']['billing_address_2']['custom_attributes'] = array( "tabindex" => "7" );
			$fields['billing']['billing_city']['custom_attributes'] = array( "tabindex" => "8" );
			$fields['billing']['billing_postcode']['custom_attributes'] = array( "tabindex" => "9" );
			$fields['billing']['billing_state']['custom_attributes'] = array( "tabindex" => "10" );
			$fields['billing']['billing_country']['custom_attributes'] = array( "tabindex" => "11" );

			$fields['shipping']['shipping_address_1']['custom_attributes'] = array( "tabindex" => "6" );
			$fields['shipping']['shipping_address_2']['custom_attributes'] = array( "tabindex" => "7" );
			$fields['shipping']['shipping_city']['custom_attributes'] = array( "tabindex" => "8" );
			$fields['shipping']['shipping_postcode']['custom_attributes'] = array( "tabindex" => "9" );
			$fields['shipping']['shipping_state']['custom_attributes'] = array( "tabindex" => "10" );
			$fields['shipping']['shipping_country']['custom_attributes'] = array( "tabindex" => "11" );
		}
		


		return $fields;    
	}
	/* Phone number field on the checkout page length code ends here */

	add_filter('woocommerce_registration_errors', 'the_lalit_registration_errors_validation', 10,3);
	function the_lalit_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) 
	{
		global $woocommerce;
		//extract( $_POST );
		if ( strcmp(  $_POST['password'], $_POST['confirm_password']) !== 0 ) {
			return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
		}
		return $reg_errors;
	}

	/* saving extra registration fields */
	function the_lalit_save_extra_register_fields( $customer_id ) 
	{
	    /** Registration through registration form */
	    if(isset( $_POST['account_salutation'] ) )
	    {
	    	//Salutation field which is by default
	        update_user_meta( $customer_id, 'salutation', sanitize_text_field( $_POST['account_salutation'] ) );

	        // Salutation field which is used in WooCommerce
	        update_user_meta( $customer_id, 'billing_salutation', sanitize_text_field( $_POST['account_salutation'] ) );

	        // Salutation field which is used in WooCommerce
	        update_user_meta( $customer_id, 'account_salutation', sanitize_text_field( $_POST['account_salutation'] ) );
	    }
	    if ( isset( $_POST['account_first_name'] ) ) 
	    {
	        //First name field which is by default
	        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['account_first_name'] ) );
	        // First name field which is used in WooCommerce
	        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['account_first_name'] ) );
	        //First name field which is by default
	        update_user_meta( $customer_id, 'account_first_name', sanitize_text_field( $_POST['account_first_name'] ) );
	    }
	    if ( isset( $_POST['account_last_name'] ) ) 
	    {
	        // Last name field which is by default
	        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['account_last_name'] ) );
	        // Last name field which is used in WooCommerce
	        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['account_last_name'] ) );
	        //Last name field which is by default
	        update_user_meta( $customer_id, 'account_last_name', sanitize_text_field( $_POST['account_last_name'] ) );
	    }
	    /** Registration through registration form */

	    
		
		/** Registration through checkout */
	    if(isset( $_POST['billing_salutation'] ) )
		{
			//Salutation field which is by default
		    update_user_meta( $customer_id, 'salutation', sanitize_text_field( $_POST['billing_salutation'] ) );
		    // Salutation field which is used in WooCommerce
		    update_user_meta( $customer_id, 'account_salutation', sanitize_text_field( $_POST['billing_salutation'] ) );

		}
		if ( isset( $_POST['billing_first_name'] ) ) 
		{
		    //First name field which is by default
		    update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		    // First name field which is used in WooCommerce
		    update_user_meta( $customer_id, 'account_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		}
		if ( isset( $_POST['billing_last_name'] ) ) 
		{
		    // Last name field which is by default
		    update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		    // Last name field which is used in WooCommerce
		    update_user_meta( $customer_id, 'account_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		}
		if ( isset( $_POST['billing_phone'] ) ) 
		{
		    // Last name field which is by default
		    update_user_meta( $customer_id, 'phone', sanitize_text_field( $_POST['billing_phone'] ) );
		}
		/** Registration through checkout */
	}
	add_action( 'woocommerce_created_customer', 'the_lalit_save_extra_register_fields' );
	/* saving extra registration fields */

	/* add to cart ajax change item count on header cart*/
	function the_lalit_add_to_cart_fragment( $fragments ) 
	{
	    ob_start();
	    $count = WC()->cart->cart_contents_count;
	?>
			<a href="<?php echo WC()->cart->get_cart_url(); ?>" class='cart-global-icon'>
				<i class="ico-sprite sprite size-22 ico-cart"></i>
				<?php
				$cls = '';
				if ( $count > 0 ) 
				{
					$cls = 'cart-no';
				}
				else
				{
					$count = '';
				}
				?>
				<span class="<?php echo $cls; ?>"><?php echo $count; ?></span>
			</a>
	<?php	
	 
	    $fragments['a.cart-global-icon'] = ob_get_clean();
	     
	    return $fragments;
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'the_lalit_add_to_cart_fragment' );
	/* add to cart ajax change item count on header cart*/


	/* change password strength message */
	add_action( 'wp_enqueue_scripts',  'the_lalit_password_strength_messages', 9999 );
	function the_lalit_password_strength_messages() 
	{
	 
		wp_localize_script( 'wc-password-strength-meter', 'pwsL10n', array(
			'short' => 'Very Weak',
			'bad' => 'Weak',
			'good' => 'Strong',
			'strong' => 'Strong',
			'mismatch' => 'Passwords do not match, please re-enter them.'
		) ); 
	}
	/* change password strength message */

	/* change password strength hint message */
	add_filter( 'wc_password_strength_meter_params', 'the_lalit_change_password_change_errors_and_hint' );
	function the_lalit_change_password_change_errors_and_hint( $data ) 
	{
	    // Old hint --> Hint: The password should be at least twelve characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).
	    $data_new = array(
	        //'i18n_password_error'   => esc_attr__( 'Come on, enter a stronger password.', 'woocommerce' ),
	        'i18n_password_hint'    => esc_attr__( 'Hint: Please use a strong password. To make the password stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).', 'woocommerce' )
	    );

	    return @array_merge( $data, $data_new );
	}
	/* change password strength hint message */

	/* Trim zeros in price decimals*/
	//add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
	/* Trim zeros in price decimals*/

	/* sending cancel email to admin */
	add_action('woocommerce_order_status_pending_to_cancelled', 'the_lalit_cancelled_send_an_email_notification', 10, 2 );
	add_action('woocommerce_order_status_processing_to_cancelled', 'the_lalit_cancelled_send_an_email_notification', 10, 2 );
	function the_lalit_cancelled_send_an_email_notification( $order_id, $order )
	{
		// Getting all WC_emails objects
		$email_notifications = WC()->mailer()->get_emails();

		// Sending the email
		$email_notifications['WC_Email_Cancelled_Order']->trigger( $order_id );
	}
	/* sending cancel email to admin */

	/* Remove notices from single product page code starts here */
	remove_action('woocommerce_before_single_product', 'wc_print_notices', 10);
	/* Remove notices from single product page code ends here */

	
	/* change user details after checkout */
	add_action('the_lalit_change_user_details', 'the_lalit_change_details', 1, 10);
	function the_lalit_change_details($order)
	{
		$user_id = $order->user_id;
		$salutation = get_user_meta($user_id, 'salutation', true);
		if($salutation)
		{
			update_user_meta($user_id, 'salutation', sanitize_text_field($salutation));
		}
		else
		{
			$sl = get_user_meta($user_id, 'billing_salutation', true);
			update_user_meta($user_id, 'salutation', sanitize_text_field($sl));
		}

		$first_name = get_user_meta($user_id, 'account_first_name', true);
		if($first_name)
		{
			update_user_meta($user_id, 'first_name', sanitize_text_field($first_name));
		}
		else
		{
			$f_name = get_user_meta($user_id, 'first_name', true);
			update_user_meta($user_id, 'account_first_name', sanitize_text_field($f_name));
		}

		$last_name = get_user_meta($user_id, 'account_last_name', true);
		if($last_name)
		{
			update_user_meta($user_id, 'last_name', sanitize_text_field($last_name));
		}
		else
		{
			$l_name = get_user_meta($user_id, 'last_name', true);
			update_user_meta($user_id, 'account_last_name', sanitize_text_field($l_name));
		}

		$phone = get_user_meta($user_id, 'phone', true);
		if($phone)
		{
			update_user_meta($user_id, 'phone', sanitize_text_field($phone));
		}
		else
		{
			$p = get_user_meta($user_id, 'billing_phone', true);
			update_user_meta($user_id, 'phone', sanitize_text_field($p));
		}
	}
	/* change user details after checkout */

	/* save account details */
	add_action( 'woocommerce_save_account_details', 'the_lalit_save_account_details', 10, 999 );
	function the_lalit_save_account_details($user_id)
	{
		if(isset($_POST['account_salutation']))
		{
			update_user_meta($user_id, 'salutation', sanitize_text_field($_POST['account_salutation']));
			update_user_meta($user_id, 'account_salutation', sanitize_text_field($_POST['account_salutation']));
		}

		if(isset($_POST['account_first_name']))
		{
			update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['account_first_name']));
			update_user_meta($user_id, 'account_first_name', sanitize_text_field($_POST['account_first_name']));
		}

		if(isset($_POST['account_last_name']))
		{
			update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['account_last_name']));
			update_user_meta($user_id, 'account_last_name', sanitize_text_field($_POST['account_last_name']));
		}

		if(isset($_POST['account_phone']))
		{
			update_user_meta($user_id, 'phone', sanitize_text_field($_POST['account_phone']));
			update_user_meta($user_id, 'account_phone', sanitize_text_field($_POST['account_phone']));
		}

		if(isset($_POST['account_dob']))
		{
			update_user_meta($user_id, 'date_of_birth', sanitize_text_field($_POST['account_dob']));
			update_user_meta($user_id, 'account_date_of_birth', sanitize_text_field($_POST['account_dob']));
		}

		if(isset($_POST['account_marriage_anv']))
		{
			update_user_meta($user_id, 'marriage_anniversary', sanitize_text_field($_POST['account_marriage_anv']));
			update_user_meta($user_id, 'account_marriage_anniversary', sanitize_text_field($_POST['account_marriage_anv']));
		}

		if(isset($_POST['account_city']))
		{
			update_user_meta($user_id, 'city', sanitize_text_field($_POST['account_city']));
			update_user_meta($user_id, 'account_city', sanitize_text_field($_POST['account_city']));
		}

		if(isset($_POST['account_country']))
		{
			update_user_meta($user_id, 'country', sanitize_text_field($_POST['account_country']));
			update_user_meta($user_id, 'account_country', sanitize_text_field($_POST['account_country']));
		}

		wp_safe_redirect(wc_customer_edit_account_url()); 
       	exit;
	}
	/* save account details */

	/* validating account details fields */
	add_action( 'woocommerce_save_account_details_errors','the_lalit_validate_account_field', 10, 1 );
	function the_lalit_validate_account_field($args)
	{
		$account_phone = $_POST['account_phone'];
		$account_first_name = trim( $_POST['account_first_name'] );
		$account_last_name = trim( $_POST['account_last_name'] );

		/*if( $account_phone == '' )
		{
			$args->add( 'error', __( '<b>Phone number</b> is a required field.', 'woocommerce' ),'');
		}
		else
		{*/
			if(!preg_match('%^[+]?[0-9()/ -]*$%', $account_phone)) 
			{
			    $args->add( 'error', __( 'Only numbers, -, + . Permitted in <b>Phone Number</b>.', 'woocommerce' ),'');
			}
			elseif(strlen($account_phone) > 0 && trim($account_phone) == '')
			{
				$args->add( 'error', __( 'Spaces not allowed, only numbers, -, + . Permitted in <b>Phone Number</b>.', 'woocommerce' ),'');
			}

			if ( isset( $account_first_name ) && empty( $account_first_name ) ) {

				$args->add( 'error', __( ' Please Enter First name. ', 'woocommerce' ),'');
			}

			if ( isset( $account_last_name ) && empty( $account_last_name ) ) {

				$args->add( 'error', __( ' Please Enter Last name. ', 'woocommerce' ),'');
			}
		//}
	}
	/* validating account details fields */

	/* change address fields */
	add_filter( 'woocommerce_billing_fields' , 'the_lalit_override_billing_fields', 1, 1 );
	add_filter( 'woocommerce_shipping_fields' , 'the_lalit_override_shipping_fields', 1, 1 );

	function the_lalit_override_billing_fields($fields)
	{
		$fields['billing_salutation'] = array(
	    	'label'       => __('Salutation', 'woocommerce'),             // Add custom field label
	    	'placeholder' => _x('Salutation', 'placeholder', 'woocommerce'),  // Add custom field placeholder
	    	'required'    => true,             // if field is required or not
	    	'clear'       => false,             // add clear or not
	    	'type'        => 'select',                // add field type
	    	'options'	  => array('Mr'=> 'Mr', 'Ms'=>'Ms', 'Mrs'=>'Mrs'),
	    	'priority'	  => 1
	    );

		$fields['billing_first_name']['label'] = 'First Name';
		$fields['billing_first_name']['placeholder'] = 'First Name';
		$fields['billing_first_name']['priority'] = 2;

		$fields['billing_last_name']['label'] = 'Last Name';
		$fields['billing_last_name']['placeholder'] = 'Last Name';
		$fields['billing_last_name']['priority'] = 3;

		$fields['billing_phone']['label'] = 'Phone';
		$fields['billing_phone']['placeholder'] = 'Phone';
		$fields['billing_phone']['priority'] = 4;

		$fields['billing_email']['label'] = 'Email Address';
		$fields['billing_email']['placeholder'] = 'Email';
		$fields['billing_email']['priority'] = 5;

		$fields['billing_address_1']['label'] = 'Address Line 1';
		$fields['billing_address_1']['placeholder'] = 'House number and street name';
		$fields['billing_address_1']['priority'] = 6;

		$fields['billing_address_2']['label'] = 'Address Line 2 (Optional)';
		$fields['billing_address_2']['placeholder'] = 'Apartment, suite, unit etc. (optional)';
		$fields['billing_address_2']['priority'] = 7;

		$fields['billing_city']['label'] = 'City';
		$fields['billing_city']['placeholder'] = 'City';
		$fields['billing_city']['priority'] = 8;

		$fields['billing_postcode']['label'] = 'Pincode';
		$fields['billing_postcode']['placeholder'] = 'Pincode';
		$fields['billing_postcode']['priority'] = 9;

		$fields['billing_state']['label'] = 'State';
		$fields['billing_state']['placeholder'] = 'State';
		$fields['billing_state']['priority'] = 10;

		$fields['billing_country']['label'] = 'Country';
		$fields['billing_country']['placeholder'] = 'Country';
		$fields['billing_country']['priority'] = 11;

		unset($fields['billing_company']);
		

		return $fields;
	}

	function the_lalit_override_shipping_fields($fields)
	{
		$fields['shipping_salutation'] = array(
	    	'label'       => __('Salutation', 'woocommerce'),             // Add custom field label
	    	'placeholder' => _x('Salutation', 'placeholder', 'woocommerce'),  // Add custom field placeholder
	    	'required'    => true,             // if field is required or not
	    	'clear'       => false,             // add clear or not
	    	'type'        => 'select',                // add field type
	    	'options'	  => array('Mr'=> 'Mr', 'Ms'=>'Ms', 'Mrs'=>'Mrs'),
	    	'priority'	  => 1
	    );

		$fields['shipping_first_name']['label'] = 'First Name';
		$fields['shipping_first_name']['placeholder'] = 'First Name';
		$fields['shipping_first_name']['priority'] = 2;

		$fields['shipping_last_name']['label'] = 'Last Name';
		$fields['shipping_last_name']['placeholder'] = 'Last Name';
		$fields['shipping_last_name']['priority'] = 3;

		$fields['shipping_phone']['label'] = 'Phone';
		$fields['shipping_phone']['placeholder'] = 'Phone';
		$fields['shipping_phone']['priority'] = 4;

		$fields['shipping_email']['label'] = 'Email Address';
		$fields['shipping_email']['placeholder'] = 'Email';
		$fields['shipping_email']['priority'] = 5;

		$fields['shipping_address_1']['label'] = 'Address Line 1';
		$fields['shipping_address_1']['placeholder'] = 'House number and street name';
		$fields['shipping_address_1']['priority'] = 6;

		$fields['shipping_address_2']['label'] = 'Address Line 2 (Optional)';
		$fields['shipping_address_2']['placeholder'] = 'Apartment, suite, unit etc. (optional)';
		$fields['shipping_address_2']['priority'] = 7;

		$fields['shipping_city']['label'] = 'City';
		$fields['shipping_city']['placeholder'] = 'City';
		$fields['shipping_city']['priority'] = 8;

		$fields['shipping_postcode']['label'] = 'Pincode';
		$fields['shipping_postcode']['placeholder'] = 'Pincode';
		$fields['shipping_postcode']['priority'] = 9;

		$fields['shipping_state']['label'] = 'State';
		$fields['shipping_state']['placeholder'] = 'State';
		$fields['shipping_state']['priority'] = 10;

		$fields['shipping_country']['label'] = 'Country';
		$fields['shipping_country']['placeholder'] = 'Country';
		$fields['shipping_country']['priority'] = 11;

		unset($fields['shipping_company']);

		return $fields;
	}
	/* change address fields */

	/* Confirm Password Field and its validation code starts here */
	add_action( 'woocommerce_checkout_init', 'the_lalit_confirm_password_checkout', 10, 1 );
	function the_lalit_confirm_password_checkout( $checkout ) {

		if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {

			$fields = $checkout->get_checkout_fields();

			$fields['account']['account_confirm_password'] = array(
				'type' => 'password',
				'label' => __( 'Confirm password', 'woocommerce' ),
				'required' => true,
				'placeholder' => _x( 'Confirm Password', 'placeholder', 'woocommerce' )
			);
			$fields['account']['account_confirm_password']['custom_attributes'] = array( "tabindex" => "7" );
			$checkout->__set( 'checkout_fields', $fields );
		}
	}

	add_action( 'woocommerce_after_checkout_validation', 'the_lalit_confirm_password_validation', 10, 2 );
	function the_lalit_confirm_password_validation( $posted ) {

		$checkout = WC()->checkout;
		if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
			if ( strcmp( $posted['account_password'], $posted['account_confirm_password'] ) !== 0 ) {
				wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' );
			}
			else
			{

			}
		}
	}
	/* Confirm Password Field and its validation code ends here */


	/* Renaming Proceesing order status to Confirmed code starts here */

	function the_lalit_renaming_order_status_callback( $order_statuses ) {

	    foreach ( $order_statuses as $key => $status ) {

	        $new_order_statuses[ $key ] = $status;

	        if ( 'wc-processing' === $key ) {

	            $order_statuses['wc-processing'] = _x( 'Confirmed', 'Order status', 'woocommerce' );
	        }
	    }
	    return $order_statuses;
	}
	add_filter( 'wc_order_statuses', 'the_lalit_renaming_order_status_callback' );


	// Rename order status 'Completed' to 'Order Received' in admin main view - different hook, different value than the other places
	function the_lalit_rename_order_status_type( $order_statuses ) {

	    foreach ( $order_statuses as $key => $status ) {
	        $new_order_statuses[ $key ] = $status;
	        if ( 'wc-processing' === $key ) {
	            $order_statuses['wc-processing']['label_count'] = _n_noop( 'Confirmed <span class="count">(%s)</span>', 'Confirmed <span class="count">(%s)</span>', 'woocommerce' );
	        }
	    }
	    return $order_statuses;
	}
	add_filter( 'woocommerce_register_shop_order_post_statuses', 'the_lalit_rename_order_status_type' );


	// Rename order status in the bulk actions dropdown on main order list
	function the_lalit_rename_bulk_status( $translated_text, $untranslated_text, $domain ) {

	    if( is_admin()) {
	    	
	        if( $untranslated_text == 'Mark processing' )
	            $translated_text = __( 'Mark confirmed','woocommerce' );
	    }
	    return $translated_text;
	}
	add_filter('gettext', 'the_lalit_rename_bulk_status', 20, 3);

	/* Renaming Proceesing order status to Confirmed code ends here */

	/* Custom order status (shipped) for shippable products code starts here */

	/*add_action( 'init', 'the_lalit_register_new_order_statuses' );
	function the_lalit_register_new_order_statuses() {
	    register_post_status( 'wc-shipped', array(
	        'label'                     => _x( 'Shipped', 'Order status', 'woocommerce' ),
	        'public'                    => true,
	        'exclude_from_search'       => false,
	        'show_in_admin_all_list'    => true,
	        'show_in_admin_status_list' => true,
	        'label_count'               => _n_noop( 'Shipped <span class="count">(%s)</span>', 'Shipped <span class="count">(%s)</span>', 'woocommerce' )
	    ) );
	}*/

	/*add_filter( 'wc_order_statuses', 'the_lalit_wc_order_statuses_callback' );
	function the_lalit_wc_order_statuses_callback( $order_statuses ) {

	    $order_statuses['wc-shipped'] = _x( 'Shipped', 'Order status', 'woocommerce' );
	    return $order_statuses;
	}*/

	/* Custom order status (shipped) for shippable products code ends here */

	/* Change Order status code starts here */

	add_action('the_lalit_changed_order_status', 'the_lalit_changed_order_status_callback', 12, 1);
	function the_lalit_changed_order_status_callback($order){

		global $order_contains_only_virtual;
		global $order_contains_both_shippable_and_virtual;
		global $order_contains_only_shippable;

		$order_contains_only_virtual = false;
		$order_contains_both_shippable_and_virtual = false;
		$order_contains_only_shippable = false;

		$order_items = $order->get_items();
		$hotel_email = '';
		$order_contains_virtual_products = false;
		foreach ($order_items as $item_id => $item_data) {

			if($item_data['variation_id']){

				$product_id = $item_data['variation_id'];
			}
			else{

				$product_id = $item_data['product_id'];
			}

			$product = wc_get_product($product_id);

			if($product->is_virtual()){

				$order_contains_virtual_products = true;
			}
		}


		if(!$order->needs_shipping_address() && $order_contains_virtual_products){

			$order_contains_only_virtual = true;
			$order->update_status('completed', 'Virtual product only. Hence, marking the order as complete.');
		}
		else if($order->needs_shipping_address() && $order_contains_virtual_products){

			$order_contains_both_shippable_and_virtual = true;
			$order->update_status('processing', 'Order contains shippable product. Hence marking it as confirmed.');
		}
		else if($order->needs_shipping_address() && !$order_contains_virtual_products){

			$order_contains_only_shippable = true;
			$order->update_status('processing', 'Order contains shippable product. Hence marking it as confirmed.');
			/*$order->update_status('shipped', 'Shippable product only. Hence, marking the order as shipped.');*/
		}
	}

	/* Change Order status code ends here */

	/* Parent product relationsip field in realtionship content type starts here */
	add_filter('acf/fields/relationship/query/name=parent_product', 'the_lalit_filter_grouped_products', 10, 3);
	function the_lalit_filter_grouped_products($args, $field, $post_id)
	{
		$args['post_status'] = 'publish';
		$args['tax_query'] = array(
			
			array(

				'taxonomy' => 'product_type',
	            'field'    => 'slug',
	            'terms'    => 'grouped', 
			)
		);
		return $args;
	}
	/* Parent product relationsip field in realtionship content type ends here */

	add_filter('woocommerce_return_to_shop_redirect', 'change_shop_link', 10, 1);
	function change_shop_link($link)
	{
		$link = site_url('/the-lalit-delhi/offers/');
		return $link;
	}

	/* change placeholder image */
	add_filter('woocommerce_placeholder_img_src', 'the_lalit_change_placeholder_image', 10, 1);
	function the_lalit_change_placeholder_image( $src ) 
	{
		$src = site_url('wp-content/themes/lalit/images/woocommerce-placeholder.png');
		return $src;
	}
	/* change placeholder image ends here */

	/* Woocommerce View Cart Button Code Starts Here */
	function the_lalit_after_add_to_cart_button() {
		
		//$cart_count = WC()->cart->get_cart_contents_count();
		?>
		<div class="product-view-cart-container clearfix hide">
			<p class="view-cart-count-description"></p>
			<a href="<?php echo wc_get_cart_url(); ?>" class="btn secondary-btn view-more-cart-count">View your cart</a>
		</div>
		<?php
	}	 
	add_action( 'woocommerce_after_add_to_cart_button', 'the_lalit_after_add_to_cart_button', 10, 0 ); 
	/* Woocommerce View Cart Button Code Ends Here */


	/*
	* Remove the default WooCommerce 3 JSON/LD structured data format
	*/
	add_filter( 'woocommerce_structured_data_product', 'structured_data_product_nulled', 10, 2 );
	function structured_data_product_nulled( $markup, $product ) {

		if( is_product() ) {
			$markup = '';
		}
		return $markup;
	}

	/**
	 * WooCommerce cart page structured data
	 */
	function the_lalit_add_sturctured_data() {

		/*if(is_cart()){

			$position = 1;
			$itemList = [];
			$itemList[0]['@type'] = 'ListItem';
			$itemList[0]['position'] = $position;
			$itemList[0]['item']['@id'] = site_url().'/';
			$itemList[0]['item']['name'] = 'Home';

			$itemList[1]['@type'] = 'ListItem';
			$itemList[1]['position'] = $position + 1;
			$itemList[1]['item']['@id'] = site_url().'/cart/';
			$itemList[1]['item']['name'] = get_the_title();

			?>
			<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement": <?php echo json_encode($itemList); ?>
			}
			</script>
			<?php
		}
		else if(is_checkout()){

			$position = 1;
			$itemList = [];
			$itemList[0]['@type'] = 'ListItem';
			$itemList[0]['position'] = $position;
			$itemList[0]['item']['@id'] = site_url().'/';
			$itemList[0]['item']['name'] = 'Home';

			$itemList[1]['@type'] = 'ListItem';
			$itemList[1]['position'] = $position + 1;
			$itemList[1]['item']['@id'] = site_url().'/checkout/';
			$itemList[1]['item']['name'] = get_the_title();

			?>
			<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement": <?php echo json_encode($itemList); ?>
			}
			</script>
			<?php
		}
		else if(stripos($_SERVER['REQUEST_URI'], 'terms-conditions') != false){

			$position = 1;
			$itemList = [];
			$itemList[0]['@type'] = 'ListItem';
			$itemList[0]['position'] = $position;
			$itemList[0]['item']['@id'] = site_url().'/';
			$itemList[0]['item']['name'] = 'Home';

			$itemList[1]['@type'] = 'ListItem';
			$itemList[1]['position'] = $position + 1;
			$itemList[1]['item']['@id'] = site_url().'/terms-conditions/';
			$itemList[1]['item']['name'] = get_the_title();

			?>
			<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement": <?php echo json_encode($itemList); ?>
			}
			</script>
			<?php
		}*/
		/*else if(is_account_page()){

			$position = 1;
			$itemList = [];
			$itemList[0]['@type'] = 'ListItem';
			$itemList[0]['position'] = $position;
			$itemList[0]['item']['@id'] = site_url().'/';
			$itemList[0]['item']['name'] = 'Home';

			$itemList[1]['@type'] = 'ListItem';
			$itemList[1]['position'] = $position + 1;
			$itemList[1]['item']['@id'] = site_url().'/my-account/';
			$itemList[1]['item']['name'] = get_the_title();

			if(stripos($_SERVER['REQUEST_URI'], 'orders') != false || stripos($_SERVER['REQUEST_URI'], 'view-order') != false){

				$itemList[2]['@type'] = 'ListItem';
				$itemList[2]['position'] = $position + 2;
				$itemList[2]['item']['@id'] = site_url().'/my-account/orders';
				$itemList[2]['item']['name'] = 'My Orders';


				if(stripos($_SERVER['REQUEST_URI'], 'view-order') != false){

					$itemList[3]['@type'] = 'ListItem';
					$itemList[3]['position'] = $position + 3;
					$itemList[3]['item']['@id'] = site_url() . $_SERVER['REQUEST_URI'];
					$itemList[3]['item']['name'] = 'Order Details';
				}
			}
			else if(is_wc_endpoint_url('edit-address')){

				$itemList[2]['@type'] = 'ListItem';
				$itemList[2]['position'] = $position + 2;
				$itemList[2]['item']['@id'] = site_url().'/my-account/edit-address';
				$itemList[2]['item']['name'] = 'My Address';

				if(stripos($_SERVER['REQUEST_URI'], 'shipping') != false){

					$itemList[3]['@type'] = 'ListItem';
					$itemList[3]['position'] = $position + 3;
					$itemList[3]['item']['@id'] = site_url().'/my-account/edit-address/shipping/';
					$itemList[3]['item']['name'] = 'Shipping Address';
				}
				else if(stripos($_SERVER['REQUEST_URI'], 'billing') != false){

					$itemList[3]['@type'] = 'ListItem';
					$itemList[3]['position'] = $position + 3;
					$itemList[3]['item']['@id'] = site_url().'/my-account/edit-address/billing/';
					$itemList[3]['item']['name'] = 'Billing Address';
				}
			}
			else if(is_wc_endpoint_url('edit-account')){

				$itemList[2]['@type'] = 'ListItem';
				$itemList[2]['position'] = $position + 2;
				$itemList[2]['item']['@id'] = site_url().'/my-account/edit-account';
				$itemList[2]['item']['name'] = 'Personal Details';
			}
			?>
			<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement": <?php echo json_encode($itemList); ?>
			}
			</script>
			<?php
		
		}*/
	}
	add_action('wp_head', 'the_lalit_add_sturctured_data');

	function the_lalit_print_voucher_icon_callback($atts) {
		
		if($atts['quantity'] > 1) {
			?>
			<span class="info-icon"><img src="/wp-content/themes/lalit/images/info-icon.png">
				<p class="print-pop-up-description">If you are printing more than 1 ticket, please disable your pop-up blocker, if turned on. Each ticket will open in a separate pop-up for you to print.
					<span class="print-pop-up-note"><strong><em>NOTE: Your Order Confirmation email will contain all tickets as attachments.</em></strong></span>
				</p>
			</span>
			<?php
		}
	}
	add_shortcode('the_lalit_print_voucher_icon', 'the_lalit_print_voucher_icon_callback');
	
	/* Fixing the error causing Display name is required starts here */
	add_filter('woocommerce_save_account_details_required_fields', 'wc_save_account_details_required_fields' );
	function wc_save_account_details_required_fields( $required_fields ){
		unset( $required_fields['account_display_name'] );
		return $required_fields;
	}
	/* Fixing the error causing Display name is required ends here */
	
	/* Empty Cart Message hooks starts here */

	remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
	add_action('the_lalit_cart_is_empty', 'the_lalit_empty_cart_message');
	function the_lalit_empty_cart_message() {

		session_start();
		if(isset($_SESSION['user_session_cart']) && !empty($_SESSION['user_session_cart'])){

			foreach($_SESSION['user_session_cart'] as $key => $value){
					
				$product_id = wc_clean($value['product_id']);
				$quantity = wc_clean($value['quantity']);
				$variation_id = wc_clean($value['variation_id']);
				$variation = wc_clean($value['variation']);
				//$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

				WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation );
			}
			echo '<p class="cart-empty true">' . wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your cart is with the new products will reload after 5 seconds', 'woocommerce' ) ) ) . '</p>';
		}
		else{
			echo '<p class="cart-empty">' . wp_kses_post( apply_filters( 'wc_empty_cart_message', __( 'Your cart is currently empty.', 'woocommerce' ) ) ) . '</p>';
		}
		
	}
	/* Empty Cart Message hooks ends here */


	/* Woocommerce hidden city field in the checkout page starts here */
	add_action( 'woocommerce_checkout_before_customer_details', 'additional_hidden_checkout_field' );
	function additional_hidden_checkout_field() {

		//echo "<pre>";print_r($checkout);exit;

		global $woocommerce;
		$cart_items = $woocommerce->cart->get_cart();
		$city = '';
		$hotel_location_term_name = '';

		foreach ( $cart_items as $cart_item_key => $cart_item ) {
   
			$product_data = $cart_item['data'];
			$cart_product = wc_get_product($product_data->get_id());
			$hotel_id_of_product_in_cart = get_post_meta($cart_product->id,'hotel_product',true);
			$hotel_location_term = get_the_terms($hotel_id_of_product_in_cart[0], 'locations');

			$hotel_location_term_name = get_post_meta($hotel_id_of_product_in_cart[0], 'name', true);
			
			$city = $hotel_location_term[0]->slug;

			break;
		}
		
		if($city != '')
			echo '<input type="hidden" name="city" value="'.$city.'">';
		if($hotel_location_term_name != '')
		 	echo '<input type="hidden" name="hotel_location_term_name" value="'.$hotel_location_term_name.'">';	
	}

	//Saving the hidden city field value in order meta
	add_action( 'woocommerce_checkout_create_order', 'additional_hidden_checkout_field_save', 20, 2 );
	function additional_hidden_checkout_field_save( $order, $data ) {
		// if( ! isset($_POST['city']) || ! isset($_POST['hotel_location_term']) ) return;

		if( ! empty($_POST['city']) ){
			$order->update_meta_data( 'order_city', sanitize_text_field( $_POST['city'] ) );
		}
		if( ! empty($_POST['hotel_location_term_name']) ){
			$order->update_meta_data( 'hotel_name', sanitize_text_field( $_POST['hotel_location_term_name'] ) );
		}
	}
	/* Woocommerce hidden city field in the checkout page ends here */

	/* Woocommerce after customer login replacing the old cart items starts here */
	

	function my_login_redirect( $redirect, $user ) {
		
		global $woocommerce;
		if ( isset( $user->roles ) && is_array( $user->roles ) ) {
			
			if ( in_array( 'customer', $user->roles ) ) {
				$blog_id = get_current_blog_id();
				$persistent_cart = get_user_meta( $user->ID, '_woocommerce_persistent_cart_' . $blog_id, true);
				if ( !empty($persistent_cart['cart']) && !empty($woocommerce->cart->get_cart())) {

					
					$persistent_cart_product_hotel = $session_cart_hotel = '';

					foreach($persistent_cart as $persistent_cart_contents){

						foreach($persistent_cart_contents as $persistent_cart_key => $persistent_cart_value){

							$persistent_cart_product = wc_get_product($persistent_cart_value['product_id']);
							$persistent_cart_product_hotel = get_post_meta($persistent_cart_product->id,'hotel_product',true);

							break;
						}

					}

					$cart_items = $woocommerce->cart->get_cart();
					foreach ( $cart_items as $cart_item_key => $cart_item ) {
			
						$product_data = $cart_item['data'];
						$cart_product = wc_get_product($product_data->get_id());
						$session_cart_hotel = get_post_meta($cart_product->id,'hotel_product',true);

						break;
					}

					if(($persistent_cart_product_hotel != '' && $session_cart_hotel != '') && ($persistent_cart_product_hotel == $session_cart_hotel)){
		
						return $redirect;
					}
					else{

						session_start();

						$_SESSION['user_session_cart'] = $woocommerce->cart->get_cart();
						$woocommerce->cart->empty_cart(false);
						
						wc_clear_notices();
						wc_add_notice( "You already have a product from a previous visit in your cart. You must checkout first, or discard this cart to continue with your current purchase. <a href='".wc_get_page_permalink( 'checkout' )."'>CHECKOUT</a> <a class='discard-and-reload' href='".wc_get_page_permalink( 'cart' )."?discard=1'>DISCARD & RELOAD</a>" );

						return wc_get_page_permalink( 'cart' );
					}
				}
				else{

					return $redirect;
				}
			}
		}
	}
	add_filter( 'woocommerce_login_redirect', 'my_login_redirect', 10, 2 );

	// define the woocommerce_before_cart_table callback 
	function action_woocommerce_before_cart_table(  ) { 
		
		session_start();
		global $woocommerce;
		//$blog_id = get_current_blog_id();
		//$user_id = get_current_user_id();


		if ((isset($_GET['discard']) && $_GET['discard'] == 1) && (isset($_SESSION['user_session_cart']) && !empty($_SESSION['user_session_cart']))) {

			//delete_user_meta( $user_id, '_woocommerce_persistent_cart_' . $blog_id );
			$woocommerce->cart->empty_cart(true);

			wc_clear_notices();

			if($_SESSION['user_session_cart']){

				foreach($_SESSION['user_session_cart'] as $key => $value){
						
					$product_id = wc_clean($value['product_id']);
					$quantity = wc_clean($value['quantity']);
					$variation_id = wc_clean($value['variation_id']);
					$variation = wc_clean($value['variation']);
					//$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

					WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation );
				}
				unset($_SESSION['user_session_cart']);
			}
		}
	}
	add_action( 'woocommerce_before_cart_table', 'action_woocommerce_before_cart_table', 10, 0 ); 


	function the_lalit_check_for_session_cart_callback(){

		global $woocommerce;

		session_start();
		if(isset($_SESSION['user_session_cart']) && !empty($_SESSION['user_session_cart'])){

			foreach($_SESSION['user_session_cart'] as $key => $value){
					
				$product_id = wc_clean($value['product_id']);
				$quantity = wc_clean($value['quantity']);
				$variation_id = wc_clean($value['variation_id']);
				$variation = wc_clean($value['variation']);
				//$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

				WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation );
			}
			unset($_SESSION['user_session_cart']);
		}
	}
	add_action('the_lalit_check_for_session_cart', 'the_lalit_check_for_session_cart_callback');

	/* Woocommerce after customer login replacing the old cart items ends here */

