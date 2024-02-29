<?php
add_action('the_lalit_order_summary_check', 'the_lalit_order_summary_check_callback', 10, 1);
function the_lalit_order_summary_check_callback($order){

	$product_vouchers = array();$j = 0;

	$order_items = $order->get_items();
	$upload_dir = wp_upload_dir();
	$dir = trailingslashit( $upload_dir['basedir'] ) . 'the-lalit-product-vouchers/';

	$default_server_timezone = date_default_timezone_get();
	$date_time_obj = new DateTime("Asia/Kolkata");
	$ymdNow = $date_time_obj->format('Y-m-D-H-i-s');
	date_default_timezone_set($default_server_timezone);

	if(!is_dir($dir)){

		wp_mkdir_p($dir);
		chmod($dir, 0777);
	}
	
	$voucher_directory = $dir.$order->id.'/';

	if(!is_dir($voucher_directory)){

		foreach ($order_items as $item_id => $item_data) {
		
		    $grouped_product_parent_name = '';
		    $item_quantity = $order->get_item_meta($item_id, '_qty', true);
		    $item_total = $order->get_item_meta($item_id, '_line_total', true);

		    $product_id = $item_data['product_id'];
		    $product_display_name = get_post_meta($product_id, 'woocommerce_product_display_name',true);
		    $product_inclusions = get_post_meta($product_id, 'woocommerce_inclusions',true);
		    $product_terms = get_the_terms( $product_id, 'product_cat' );
		    

		    $hotel_id = get_post_meta($product_id, 'hotel_product', true);
		    $product_hotel_name = get_post_meta($hotel_id[0], 'name',true);

		    $grouped_product_parent_id = get_post_meta($product_id, 'parent_product',true);
		    if($grouped_product_parent_id)
		    {
		    	$product_redemption_instructions = get_post_meta($grouped_product_parent_id[0], 'woocommerce_redemption_instructions',true);
		    	$grouped_product_parent_name = get_post_meta($grouped_product_parent_id[0], 'woocommerce_product_display_name',true);
		    }
		    else
		    {
		    	$product_redemption_instructions = get_post_meta($product_id, 'woocommerce_redemption_instructions',true);
		    }

		    $product_hotel_restaurant_name = '';
		    if(get_post_meta($product_id, 'hotel_restaurant', true)){

		    	$restaurant_id = get_post_meta($product_id, 'hotel_restaurant', true);
		    	$product_hotel_restaurant_name = get_post_meta($restaurant_id[0], 'name',true) . ', ';
		    }

			$hotel_location_taxonomy = get_the_terms($hotel_id[0], 'locations');
			$hotel_location_slug = $hotel_location_taxonomy[0]->slug;
			$hotel_location_slug = strtoupper(substr($hotel_location_slug, 0, 3));

		    $variation_id = $item_data['variation_id'];
		    $item_variation_attributes = $item_data->get_meta_data();

		    $single_product = wc_get_product($product_id);

		    if($single_product->get_type() == 'variable'){

		    	$single_product = wc_get_product($variation_id);
		    }


		    if($single_product->is_virtual()){

		    	if(!is_dir($voucher_directory)){

		    		wp_mkdir_p($voucher_directory);
		    	}

		    	for ($i=0; $i < $item_quantity; $i++) {
		  			
		  			$product_vouchers[$j][$i]['product_id'] = $product_id;
			    	$voucher_code = generate_random_numbers();
					$voucher_code = $hotel_location_slug.str_shuffle($voucher_code);
					$voucher_contents_html = '';

					$voucher_contents_html .= '<!DOCTYPE html>
												<html>
												<head>
													<style>
													@font-face{
														font-family: "prata", serif;
														src: url("https://fonts.googleapis.com/css?family=Prata");
													}
													@font-face{
														font-family: "roboto", sans-serif;
														src:url("https://fonts.googleapis.com/css?family=Roboto");
													}
													
													.clearfix:after{
														content: "";
														clear: both;
														display: table;
													}
													
													.redemption-description ul{
														padding-left: 15px; 
														list-style-type: disc;
													}
													.redemption-description ol{
														padding-left: 15px; 
													}
													.redemption-description p{
														font-family: Roboto;
														font-size: 10pt;
														font-weight: lighter;
														font-style: normal;
														font-stretch: normal;
														line-height: 14pt;
														letter-spacing: 0.25pt;
														color: #333333;
													}
													.redemption-description li{
														font-family: Roboto;
														font-size: 10pt;
														font-weight: lighter;
														font-style: normal;
														font-stretch: normal;
														line-height: 14pt;
														letter-spacing: 0.25pt;
														color: #333333;
													}
													.inclusion-description ul{
														padding-left: 15px; 
														list-style-type: disc;
													}
													.inclusion-description ol{
														padding-left: 15px; 
														list-style-type: disc;
													}
													.inclusion-description p{
														font-family: Roboto;
														font-size: 10pt;
														font-weight: lighter;
														font-style: normal;
														font-stretch: normal;
														line-height: 14pt;
														letter-spacing: 0.25pt;
														color: #333333;
													}
													.inclusion-description li{
														font-family: Roboto;
														font-size: 10pt;
														font-weight: lighter;
														font-style: normal;
														font-stretch: normal;
														line-height: 14pt;
														letter-spacing: 0.25pt;
														color: #333333;
													}
													
													
													@page {
														margin: 0%;
													}
													.redemption-description p{
														font-family: Roboto;
														font-size: 10pt;
														font-weight: lighter;
														font-style: normal;
														font-stretch: normal;
														line-height: 14pt;
														letter-spacing: 0.25pt;
														color: #333333;
													}
													.inclusion-description p{
														font-family: Roboto;
														font-size: 10pt;
														font-weight: lighter;
														font-style: normal;
														font-stretch: normal;
														line-height: 14pt;
														letter-spacing: 0.25pt;
														color: #333333;
													}
													</style>
												</head>
													<body>
														<div class="pdf-container clearfix">
															<div class="pdf-section">
																<div class="motif-container" style="width: 35%; float: left;">
																	<img src="'.get_template_directory_uri().'/images/voucher-motif.png">
																</div>
															<div class="voucher-description-container" style="width: 50%; float: left; text-align: center;">
																	<img style="margin: 0pt; padding: 20pt 0 15pt 0;" class="logo-img" src="'.get_template_directory_uri().'/images/voucher-logo.jpg" alt="Logo">
																	<p class="purchase-order" style="font-family: Roboto; font-size: 10pt; font-weight: lighter; line-height: 14pt; letter-spacing: 0.5pt; color: #333333; text-transform: uppercase;margin: 0pt; padding-bottom: 7pt">Purchase Voucher</p>';


					$voucher_contents_html .= '<p class="purchase-no" style="font-family: Roboto; font-size: 14pt; font-weight: lighter; line-height: 18pt; letter-spacing: 0.7pt; color: #333333; margin: 0pt; padding-bottom: 15pt;">#'.$voucher_code.'</p>
													<div class="border-middle" style="border-top: 1pt solid #aeaeae; margin: 0 auto; width: 90pt; padding-bottom: 15pt;"></div>';

					if($grouped_product_parent_name){

						$voucher_contents_html .= '<h1 class="product-name" style="font-family: prata; font-size: 21pt; line-height: 25pt; letter-spacing: 0.5pt; color: #976206; font-weight: normal; margin: 0pt; padding-bottom: 10pt;">'.$grouped_product_parent_name.'</h1>';
						$voucher_contents_html .= '<h6 class="subproduct-name" style="font-family: roboto; font-size: 12pt; line-height: 16pt; letter-spacing: 1pt; color: #976206; font-weight: normal; text-transform: uppercase;margin: 0pt;">'.trim($product_display_name).'</h6>';
					}
					else{

						$voucher_contents_html .= '<h1 class="product-name" style="font-family: prata; font-size: 21pt; line-height: 25pt; letter-spacing: 0.5pt; color: #976206; font-weight: normal; margin: 0pt; padding-bottom: 10pt;">'.trim($product_display_name).'</h1>';
					}
	    			

	                if($item_variation_attributes){

	                	$product_vouchers[$j][$i]['variation_id'] = $variation_id;
			    		foreach($item_variation_attributes as $item_variation_attribute){

					    	$item_attribute_name = ucwords( str_replace( 'pa_', '', $item_variation_attribute->key ) );
					    	$item_attribute_name = str_replace( '-', ' ', $item_attribute_name );
					    	$item_attribute_name = str_replace( '-', ' ', $item_attribute_name );
					    	$item_attribute_name = str_replace( '-', ' ', $item_attribute_name );
					    	$item_attribute_value = $item_variation_attribute->value;
					    	$voucher_contents_html .= '<h6 class="subproduct-name" style="font-family: roboto; font-size: 12pt; line-height: 16pt; letter-spacing: 1pt; color: #976206; font-weight: normal; text-transform: uppercase;margin: 0pt;">'.$item_attribute_name.': '.$item_attribute_value.'</h6>';

					    	$product_vouchers[$j][$i]['atrributes'][$item_attribute_name] = $item_attribute_value;
					    }
			    	}
	                $voucher_contents_html .= '<p class="product-city-name" style="font-family: roboto; font-size: 12pt; font-weight: lighter; line-height: 16pt; letter-spacing: 0.5pt; color: #333333; text-transform: uppercase; margin: 0pt; padding: 15pt 0pt 6pt 0;">'.$product_hotel_restaurant_name.$product_hotel_name.'</p>';

	                if($single_product->is_on_sale()){

						$voucher_contents_html .= '<p class="product-price" style="marging: 0pt; padding-bottom: 10pt;">
														<span class="currency-symbol">&#8377;</span>
														<span class="price-amount" style="font-family: roboto; font-size: 12pt; font-weight: 300; font-style: normal; font-stretch: normal; line-height: 16pt; letter-spacing: 0.5pt; color: #000000; margin: 0pt; padding-bottom: 10pt;">'.$single_product->get_sale_price().'</span>
														<span style="font-family: roboto; font-size: 12pt; font-weight: 300; font-style: normal; font-stretch: normal; line-height: 16pt; letter-spacing: 0.5pt; color: #000000; margin: 0pt; padding-bottom: 10pt;"> (admits one)</span>
													</p>';
	                }
	                else{

						$voucher_contents_html .= '<p class="product-price" style="margin: 0pt; padding-bottom: 10pt;">
														<span class="currency-symbol">&#8377;</span>
														<span class="price-amount" style="font-family: roboto; font-size: 12pt; font-weight: 300; font-style: normal; font-stretch: normal; line-height: 16pt; letter-spacing: 0.5pt; color: #000000; margin: 0pt; padding-bottom: 10pt;">'.$single_product->get_regular_price().'</span>
														<span style="font-family: roboto; font-size: 12pt; font-weight: 300; font-style: normal; font-stretch: normal; line-height: 16pt; letter-spacing: 0.5pt; color: #000000; margin: 0pt; padding-bottom: 10pt;"> (admits one)</span>
													</p>';
	                }

					$voucher_contents_html .= '</div>
												</div>
												<div class="scissor-border-section">
													<img src="'.get_template_directory_uri().'/images/voucher-line.png" alt="Voucher Line">
												</div>'; 

	                if(trim($product_redemption_instructions) != ''){

						$voucher_contents_html .= '<div class="redemption-section" style=" width: 90%; margin: 0pt;  padding: 15pt 30pt 20pt 30pt; text-align: justify;">
														<h3 class="redemption-header" style="font-family: roboto; font-size: 12pt; line-height: 16pt; letter-spacing: 0.3pt; color: #976206; text-transform: uppercase; font-weight: normal; margin: 0pt; padding-bottom: 7pt;">Redemption Instructions</h3>
														<div class="redemption-description" style="font-family: roboto; font-size: 10pt; font-weight: lighter; font-style: normal; font-stretch: normal; line-height: 14pt; letter-spacing: 0.25pt; color: #333333;margin: 0pt;">
															'.wpautop($product_redemption_instructions).'
														</div>
													</div>';
	                }

	                if(trim($product_inclusions) != ''){

						$voucher_contents_html .= '<div class="inclusion-section" style="width: 90%; margin: 0pt; padding: 0 30pt 20pt 30pt; text-align: justify;">
														<h3 class="inclusion-header" style="font-family: roboto; font-size: 12pt; line-height: 16pt; letter-spacing: 0.3pt; color: #976206; text-transform: uppercase; font-weight: normal; margin: 0pt; padding-bottom: 7pt">Inclusions</h3>
															<div class="inclusion-description" style="font-family: roboto; font-size: 10pt; font-weight: lighter; font-style: normal; font-stretch: normal; line-height: 14pt; letter-spacing: 0.25pt; color: #333333;margin: 0pt;">
															'.wpautop($product_inclusions).'
														</div>
													</div>';
	                }
					$voucher_contents_html .= '<div class="other-information" style="margin: 0pt; padding: 15pt 30pt 30pt 30pt;; border-top: 1pt solid #000; color: #333333;">
													<p class="info-description" style="font-family: Roboto; font-size: 10pt; font-weight: lighter; line-height: 14pt; letter-spacing: 0.25pt; color: #333333; margin: 0pt; padding-bottom: 10pt">If you have questions or need any assistance, feel free to contact us:</p>
													<p class="contact-details" style="font-family: Roboto; font-size: 9pt; line-height: 13pt; letter-spacing: 0.3pt; color: #333333; font-weight: bold;margin: 0pt; padding-bottom: 7pt;">Call: <span>+91 11 4444 7777</span></p>
													<p class="contact-details" style="font-family: Roboto; font-size: 9pt; line-height: 13pt; letter-spacing: 0.3pt; color: #333333; font-weight: bold;margin: 0pt; padding-bottom: 7pt;">Email: <span>corporate@thelalit.com</span></p>
													<p class="contact-details" style="font-family: Roboto; font-size: 9pt; line-height: 13pt; letter-spacing: 0.3pt; color: #333333; font-weight: bold;margin: 0pt; padding-bottom: 7pt;">Visit: <span><a href="https://www.thelalit.com">www.thelalit.com</a></span></p>
												</div>
											</div>
										</body>
									</html>';

	                $product_vouchers[$j][$i]['voucher_code'] = $voucher_code;

	                $file_name = $voucher_directory.$order->id.'-'.$voucher_code.'-'.$ymdNow.'.pdf';
	                $product_vouchers[$j][$i]['voucher_path'] = trailingslashit( $upload_dir['baseurl'] ).'the-lalit-product-vouchers/'.$order->id.'/'.$order->id.'-'.$voucher_code.'-'.$ymdNow.'.pdf';

					// var_dump($voucher_contents_html);exit;
					$mpdf = new mPDF();
					@$mpdf->SetDisplayMode('real');
					// $voucher_style = file_get_contents(get_template_directory_uri().'/voucher/voucher-style.css');
					// @$mpdf->WriteHTML($voucher_style, 1);
					@$mpdf->WriteHTML($voucher_contents_html);
					$mpdf->Output($file_name, 'F');
			    }
	    	}
	  		$j++;
		}
		add_post_meta($order->id,'the_lalit_vouchers_details',json_encode($product_vouchers));
	}
}

//echo $voucher_order_id;exit;
function generate_random_numbers(){

	$voucher_code = '';
	for($i=0;$i<7;$i++){

		$nums = rand(0,9);
		$voucher_code .= $nums;
	}

	return $voucher_code;
}