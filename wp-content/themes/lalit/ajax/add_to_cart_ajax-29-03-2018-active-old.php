<?php
	
	global $variation_id;
	$variation_id = 0;

	if ($_POST['jsonVarObj']) {
		
		$jsonVarObj = stripslashes($_POST['jsonVarObj']);
	  	$variable_products = json_decode($jsonVarObj, true);
	  	$product_id = wc_clean($variable_products['product_id']);
	  	$quantity = wc_clean($variable_products['quantity']);
	  	$variation_id = wc_clean($variable_products['variation_id']);
	  	$variation = wc_clean($variable_products['variation']);
	  	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
	  	$product_display_name = get_post_meta($product_id, 'woocommerce_product_display_name', true);

	  	$shippable_flag = can_shippable_product_be_added_to_cart($variation_id);

	    if($shippable_flag){

	    	
		    if($passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation)){

			    $message_string = $product_display_name.' has been added to your cart.';

			    if(isMobile()){
			    	$return_msg['msg'] = '<div class="clearfix"><i class="sprite ico-check-with-circle size-26"></i><span class="product-update-description">'.$message_string.'</span></div><a href="'.site_url().'/cart/" class="button wc-forward">View cart</a>';
			    }
			    else{
			    	$return_msg['msg'] = '<i class="sprite ico-check-with-circle size-26"></i><span class="product-update-description">'.$message_string.'</span><a href="'.site_url().'/cart/" class="button wc-forward">View cart</a>';
			    }
			  	
			  	$return_msg['count'] = WC()->cart->cart_contents_count;
			  	$return_msg['status'] = true;
			  	echo json_encode($return_msg, true);
		    }
		    else{

		    	$temp = wc_get_notices('error');
		  		for ($k=0; $k < count($temp); $k++) { 
		  			
		  			$temp[$k] = html_entity_decode($temp[$k]);
		  			$temp[$k] = preg_replace('/\".*?\"/', "$product_display_name", $temp[$k]);
		  			if(strpos($temp[$k], 'href')){

		  				$temp[$k] = preg_replace('/<a[^>]*>.*?<\/a>/', '', $temp[$k]);
		  			}
		  			$temp[$k] = htmlentities($temp[$k]);
		  		}
		    	$return_msg['msg'] = $temp;
		    	wc_clear_notices();
			  	$return_msg['count'] = WC()->cart->cart_contents_count;
			  	$return_msg['status'] = false;
		  		echo json_encode($return_msg, true);
		  	}
		}
		else {

			$return_msg['msg'] = 'Sorry! This item could not be added to your cart. Please checkout first and purchase this item as a separate transaction.';
			$return_msg['count'] = WC()->cart->cart_contents_count;
			$return_msg['status'] = false;
		  	echo json_encode($return_msg, true);exit;
		}
	}
	else if($_POST['jsonGroupedObj']) {

	  	$jsonGroupedObj = stripslashes($_POST['jsonGroupedObj']);
	  	$groupedProducts = json_decode($jsonGroupedObj, true);
	  	$grouped_product_id = wc_clean($groupedProducts['productId']);
	  	$product_info = wc_clean($groupedProducts['productInfo']);
	  	$msg = array();$product_added_to_cart = false;
	  	$j = 0;
		for($i=0;$i<count($product_info);$i++){

			$product_id = $product_info[$i]['id'];
			$product_id = ltrim($product_id, 'quantity[');
			$product_id = rtrim($product_id, ']');
			$product_id = wc_clean($product_id);
			
			$shippable_flag = can_shippable_product_be_added_to_cart($product_id);
			$quantity = wc_clean($product_info[$i]['quantity']);

			if($shippable_flag){

				$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
				if($passed_validation && WC()->cart->add_to_cart( $product_id, $quantity )){
					
			  		$product_added_to_cart = true;
			  	}
			  	else{

			  		$product_display_name = '"'.get_post_meta($product_id, 'woocommerce_product_display_name', true).'"';
			  		$temp = wc_get_notices('error');

			  		for ($k=0; $k < count($temp); $k++) { 
			  			
			  			$temp[$k] = html_entity_decode($temp[$k]);
			  			$temp[$k] = preg_replace('/\".*?\"/', "$product_display_name", $temp[$k]);
			  			if(strpos($temp[$k], 'href')){

			  				$temp[$k] = preg_replace('/<a[^>]*>.*?<\/a>/', '', $temp[$k]);
			  			}
			  			$temp[$k] = htmlentities($temp[$k]);
			  		}

			  		$msg[$j] = $temp;
			  		wc_clear_notices();
			  		$j++;
			  	}
			}
			else {

				$return_msg['msg'] = 'Sorry! This item could not be added to your cart. Please checkout first and purchase this item as a separate transaction.';
				$return_msg['count'] = WC()->cart->cart_contents_count;
				$return_msg['status'] = false;
			  	echo json_encode($return_msg, true);exit;
			}
		}
		$return_msg['msg'] = '';

		if($product_added_to_cart){

			$product_display_name = get_post_meta($grouped_product_id, 'woocommerce_product_display_name', true);
			$message_string = $product_display_name.' has been added to your cart.';
			
			if(isMobile()){

				$return_msg['msg'] .= '<div class="clearfix"><i class="sprite ico-check-with-circle size-26"></i><span class="product-update-description">'.$message_string.'</span></div><a href="'.site_url().'/cart/" class="button wc-forward">View cart</a>';
			}
			else{

				$return_msg['msg'] .= '<i class="sprite ico-check-with-circle size-26"></i><span class="product-update-description">'.$message_string.'</span><a href="'.site_url().'/cart/" class="button wc-forward">View cart</a>';
			}
			$return_msg['status'] = true;
			$return_msg['count'] = WC()->cart->cart_contents_count;
		}
		if($msg){

			$return_msg['msg'] .= '<ul class="woocommerce-error product-error-message" style="list-style-type:none;padding-left:0px;">';

			foreach($msg as $single_msg_array) {

				for($j=0;$j<count($single_msg_array);$j++){

					$return_msg['msg'] .= '<li class="error-message-list"> <i class="ico-sprite sprite ico-close-with-circle size-26"></i><span style="font-family: Roboto;font-size: 16px;line-height: 20px;letter-spacing: .8px;color: #363636;padding-left: 10px;font-weight: 400;">'.$single_msg_array[$j].'</span></li>';
				}
			}

			$return_msg['msg'] .= '</ul>';
			$return_msg['status'] = false;
			$return_msg['count'] = WC()->cart->cart_contents_count;
		}
		echo json_encode($return_msg, true);
	}
	else if($_POST['jsonSimpleObj']) {

		$jsonSimpleObj = stripslashes($_POST['jsonSimpleObj']);
	  	$simple_product = json_decode($jsonSimpleObj, true);
	  	$product_id = wc_clean($simple_product['product_id']);
	  	$quantity = wc_clean($simple_product['quantity']);

	  	$shippable_flag = can_shippable_product_be_added_to_cart($product_id);

	  	if($shippable_flag){

	  		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
		  	if($passed_validation && WC()->cart->add_to_cart( $product_id, $quantity )){

				$product_display_name = get_post_meta($product_id, 'woocommerce_product_display_name', true);
			    $message_string = $product_display_name.' has been added to your cart.';

			    if(isMobile()){

			    	$return_msg['msg'] = '<div class="clearfix"><i class="sprite ico-check-with-circle size-26"></i><span class="product-update-description">'.$message_string.'</span></div><a href="'.site_url().'/cart/" class="button wc-forward">View cart</a>';
			    }
			    else{

			    	$return_msg['msg'] = '<i class="sprite ico-check-with-circle size-26"></i><span class="product-update-description">'.$message_string.'</span><a href="'.site_url().'/cart/" class="button wc-forward">View cart</a>';
			    }
				$return_msg['count'] = WC()->cart->cart_contents_count;
				$return_msg['status'] = true;
			  	echo json_encode($return_msg, true);
		  	}
		  	else{

		  		$temp = wc_get_notices('error');
		  		for ($k=0; $k < count($temp); $k++) { 
		  			
		  			$temp[$k] = html_entity_decode($temp[$k]);
		  			$temp[$k] = preg_replace('/\".*?\"/', "$product_display_name", $temp[$k]);
		  			if(strpos($temp[$k], 'href')){

		  				$temp[$k] = preg_replace('/<a[^>]*>.*?<\/a>/', '', $temp[$k]);
		  			}
		  			$temp[$k] = htmlentities($temp[$k]);
		  		}
		    	wc_clear_notices();
		    	$return_msg['msg'] = $temp;
				$return_msg['count'] = WC()->cart->cart_contents_count;
				$return_msg['status'] = false;
			  	echo json_encode($return_msg, true);
		  	}
	  	}
	  	else{
	  		
	  		$return_msg['msg'] = 'Sorry! This item could not be added to your cart. Please checkout first and purchase this item as a separate transaction.';
			$return_msg['count'] = WC()->cart->cart_contents_count;
			$return_msg['status'] = false;
		  	echo json_encode($return_msg, true);exit;
	  	}
	}


	function can_shippable_product_be_added_to_cart($product_id) {

		if(WC()->cart->get_cart_contents_count() > 0) {

			$product_to_be_added = wc_get_product($product_id);
			$hotel_id_of_product_to_be_added = get_post_meta($product_to_be_added->id,'hotel_product',true);

			if( the_lalit_is_product_shippable($product_to_be_added) ){

				$cart_items = WC()->cart->get_cart();

				foreach ( $cart_items as $cart_item_key => $cart_item ) {
   
				    $product_data = $cart_item['data'];

				    $cart_product = wc_get_product($product_data->get_id());

				    if( the_lalit_is_product_shippable($cart_product) ) {

						$hotel_id_of_product_in_cart = get_post_meta($cart_product->id,'hotel_product',true);
						
						if($hotel_id_of_product_in_cart[0] && $hotel_id_of_product_to_be_added[0]){

							if($hotel_id_of_product_in_cart[0] == $hotel_id_of_product_to_be_added[0]) {

								$product_can_be_added = true;
								continue;
							}
							else{
								
								$product_can_be_added = false;
								break;
							}
						}
				  	}
				  	else{

				  		$product_can_be_added = true;
				  		continue;
				  	}
				}
			}
			else{

				$product_can_be_added = true;
			}
		}
		else {

			$product_can_be_added = true;
		}
		
		return $product_can_be_added;
	}

	function the_lalit_is_product_shippable($product){

		if($product->is_virtual()){

			return false;
		}
		else{

			return true;
		}
	}
?>
