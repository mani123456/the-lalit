<?php
/**
 *
  Template Name: Woo-commerce Template
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Paper_Plane
 * @since PaperPlane 1.0
 */
$hide_sharing = '';
if(is_cart() || is_checkout()) 
{
	$hide_sharing = 'hide-sharing';
}

if(is_checkout() || is_cart() || is_account_page()) 
{ 
	$body_class = 'global-page';
}
else
{ 
	$body_class = '';
}


$obj = new WC_Query();
$current_endpoint = $obj->get_current_endpoint();
$motif = '';
$my_account_class = '';

$order_pay_style="";

if(is_account_page() && !is_user_logged_in())
{
	$motif = 'motif-blk';
}
if(is_account_page() && is_user_logged_in())
{
	$my_account_class = 'account-dashboard-pages';
}

if ( $current_endpoint ==  'order-pay'  ) {
    if(	$_SERVER['HTTP_REFERER'] == site_url('/checkout') || 
       	$_SERVER['HTTP_REFERER'] == site_url('/checkout/') || 
       	( strpos($_SERVER['HTTP_REFERER'], 'pay_for_order=true') != false && !isset($_GET['pay_for_order']) )  
      )
    {
    	$order_pay_style="display:none";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
        <style type="text/css">
        	.ui-datepicker-trigger {
			    display: none;
			}
        </style>
    </head>
    <body <?php body_class($body_class.' '.$hide_sharing. 'the-lalit-woocommerce-template'); ?>>
    	<div class="main-wrap <?php echo $my_account_class; ?>" style="<?php echo $order_pay_style; ?>">
    		<?php get_header(); ?>

    			<?php while ( have_posts() ) : the_post(); ?>
    				<div class="content-section">
						<div class="page-con">    
	                        <div class="container section-space <?php echo $motif; ?>">                                   
	                            <div class="row">
	                            	<?php 
	                            	$obj = new WC_Query();
	                            	$current_endpoint = $obj->get_current_endpoint();
	                            	if($current_endpoint != 'order-received' && !is_account_page())
	                            	{		
	                            	?>
	                                <div class="page-heading">
	                                    <h2 class="card-info-title bdr-bottom">
	                                        <span class="bdr-bottom-gold"><?php the_title(); ?></span>
	                                    </h2>
	                                </div>
	                                <?php
	                            	}	
	                                ?>

	                                <?php the_content(); ?>

	                            </div>
	                        </div>
	                    </div>
	                </div>

    			<?php endwhile; ?>

    		<?php get_footer(); ?>
    	</div>
    </body>
    <?php
    // scripts for cart page
    if(is_cart())
    {
    ?>
	    <script type="text/javascript">
	    	var ismobile = navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
	    	var isipad = navigator.userAgent.match(/(iPad)/i) != null;

	    	jQuery( window ).on( "orientationchange", function( event ) {
		    	if(ismobile)
	          	{
  					if(window .orientation == 0) // portrait
  					{
  						jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td.coupon-action").appendTo('.cart-collaterals-subtotal .collaterals-subtotal');

	                  	jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td").show();
  					}
  					else // landscape
  					{
  						jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td.subtotal-action").appendTo('.cart-collaterals-subtotal .collaterals-subtotal');
	                  	jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td").show();
  					}
  				}
			}).trigger("orientationchange");

			jQuery( document.body ).on( 'updated_cart_totals', function(){
    			if(ismobile)
				{
					jQuery( window ).trigger("orientationchange");
				}
    			jQuery('html, body').animate({
			      scrollTop: jQuery('.content-section').offset().top
			    }, 'slow');
			});

			jQuery(document).on('input','.input-text.qty', function() {
				if(jQuery(this).val() != '' && jQuery(this).val() > 0)
				{
					jQuery("input[name='update_cart']").removeAttr("disabled");
					jQuery("input[name='update_cart']").trigger("click");
				}
				else
				{
					jQuery("input[name='update_cart']").attr("disabled", "disabled");
				}
			});

		    /*jQuery(document).on("click", ".cart-coupon-submit", function(e) {
		    	if(jQuery("#coupon_code").val() == '')
		    	{		
		    		showError("#coupon_code", "Please enter a coupon code.");
		    	}
		    	else
		    	{
		    		changeError("#coupon_code");
		    		return true;
		    	}
		    	return false;
		    });*/

		    /*function showError(ele, msg)
	    	{
			    if(jQuery(ele).parent().hasClass("error"))
			    {
			        jQuery(ele).parent().find("span.hint").text(msg);
			    }
			    else
			    {
			        jQuery(ele).parent().addClass("error");
			        jQuery(ele).parent().append('<span class="hint">'+msg+'</span>');
			    }
			}
			function changeError(ele)
			{
			    jQuery(ele).parent().find("span.hint").remove();
			    jQuery(ele).parent().removeClass("error");
			}*/

			/*jQuery(document).on("click", '.cart-coupon-label',function() {
				jQuery(this).next().slideToggle(400);
				changeError("#coupon_code");
			});*/

			/*function applyOrientation()
		    {
	          	if(ismobile)
	          	{        	
	              	if(window.innerHeight > window.innerWidth) //portrait
	              	{     

	                  	jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td.coupon-action").appendTo('.cart-collaterals-subtotal .collaterals-subtotal');

	                  	jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td").show();
	              	}
	              	else // landscape
	              	{     	
	                  	jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td.subtotal-action").appendTo('.cart-collaterals-subtotal .collaterals-subtotal');
	                  	jQuery(".cart-collaterals-subtotal").find(".collaterals-subtotal td").show();
	              	}
	          	}
		    }*/  
	    </script>
	<?php
	}
	// scripts for checkout pages
	else if(is_checkout())
	{
		// scripts for checkout form page
		if(!$current_endpoint)
		{
		?>
			<script type="text/javascript">
				var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
				wc_country_select_params.i18n_select_state_text = 'Select a state';

				jQuery( window ).on( "orientationchange", function( event ) {
					if(ismobile)
					{
						if(window .orientation == 0) // portrait
						{
							jQuery(".woocommerce-form-login").find('.mob-col').addClass("mob-col12");
							jQuery(".woocommerce-form-login").find('.mob-col').removeClass("mob-col7");
						}
						else // landscape
						{
							jQuery(".woocommerce-form-login").find('.mob-col').addClass("mob-col7");
							jQuery(".woocommerce-form-login").find('.mob-col').removeClass("mob-col12");
						}
					}
				}).trigger("orientationchange");

				jQuery(window).on("load", function() {
					jQuery(".country_to_state").on("change", function() {
				    	setTimeout(function() {
				    		jQuery(".state_select option:first").attr("selected", "selected");
				    	}, 50);
					});
				});
				
				/** Billing personal details */
				jQuery(document).on("click", ".woocommerce-billing-fields .checkout-heading-accordian:eq(0)", function() {

					if(jQuery(this).hasClass("active"))
					{
						jQuery(this).removeClass("active")
						jQuery(this).next("div").slideUp(400, function() {

							//jQuery(".checkout-billing-address").css("padding", "0px 0px 30px");
							// jQuery(".checkout-billing-address").css("padding", "0px 0px 0px");
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-down");

						});
					}
					else
					{		
						jQuery(this).addClass("active");
						jQuery(this).next("div").slideDown(400, function() {
							// jQuery(".checkout-billing-address").css("padding", "50px 0 30px");
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-down");
						});
					}
				});
				/** Billing address */
				jQuery(document).on("click", ".woocommerce-billing-fields .checkout-heading-accordian:eq(1)", function() {
					if(jQuery(this).hasClass("active"))
					{
						jQuery(this).removeClass("active");
						if(jQuery(".checkout-shipping-item").length == 0)
						{
							jQuery(".wc-terms-and-conditions").css("padding-top", "30px");
						}	
						jQuery(".checkout-shipping-item").css("padding", "20px 0");
						jQuery(this).next("div").slideUp(400, function() {
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-down");
						});
					}
					else
					{		
						jQuery(this).addClass("active");
						jQuery(this).next("div").slideDown(400, function() {
							jQuery(".checkout-shipping-item").removeAttr("style");
							if(jQuery(".checkout-shipping-item").length == 0)
							{
								jQuery(".wc-terms-and-conditions").removeAttr("style");
							}
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-down");
						});
					}
				});

				/** Shipping personal details */
				jQuery(document).on("click", ".woocommerce-shipping-fields .checkout-heading-accordian:eq(0)", function() {

					if(jQuery(this).hasClass("active"))
					{
						jQuery(this).removeClass("active")
						jQuery(this).next("div").slideUp(400, function() {
							// jQuery(".checkout-shipping-address").css("padding", "0px 0px 30px");
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-down");
						});
					}
					else
					{		
						jQuery(this).addClass("active");
						jQuery(this).next("div").slideDown(400, function() {
							// jQuery(".checkout-shipping-address").css("padding", "50px 0 30px");
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-down");
						});
					}
				});
				/** Shipping address */
				jQuery(document).on("click", ".woocommerce-shipping-fields .checkout-heading-accordian:eq(1)", function() {
					if(jQuery(this).hasClass("active"))
					{
						jQuery(this).removeClass("active");
						jQuery(".wc-terms-and-conditions").css("padding-top", "30px");
						jQuery(this).next("div").slideUp(400, function() {
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-down");
						});
					}
					else
					{		
						jQuery(this).addClass("active");
						jQuery(this).next("div").slideDown(400, function() {
							jQuery(".wc-terms-and-conditions").removeAttr("style");
							jQuery(this).prev().find(".sprite").addClass("ico-brown-arrow-up");
							jQuery(this).prev().find(".sprite").removeClass("ico-brown-arrow-down");
						});
					}
				});

				jQuery(document).ready(function() {
					setTimeout(function() {
						jQuery(".required").addClass("checkout-required");
						jQuery(".required").text("");
					}, 400);

					jQuery(document).on("change", ".country_select", function() {
						jQuery(".required").addClass("checkout-required");
						jQuery(".required").text("");
					});

					if(jQuery('form[name="checkout"]').length && jQuery(".woocommerce-error").length && jQuery(".checkout-login-section").length)
					{
						jQuery(".woocommerce-form-login").show();
						jQuery("html, body").animate({ scrollTop: 0 }, 500); 
					}
				});
				
				jQuery( document.body ).on( 'checkout_error', function() {
				    if(ismobile)
		          	{
	    				jQuery( window ).trigger("orientationchange");
	    			}
	    			jQuery( 'html, body' ).stop();
	    			jQuery('html, body').animate({
				      scrollTop: jQuery('.content-section').offset().top
				    }, 'slow');
				});
			</script>
		<?php
		}
		// scripts for thank you page
		if($current_endpoint == 'order-received')
		{
		?>
			<script type="text/javascript">
				/*var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;

				applyOrientation();

				window.onresize = function (event) {
                	applyOrientation();
            	};*/
            	
				jQuery(document).on("click",".redemption-details-section h6", function() {
					if(jQuery(this).hasClass("active"))
					{	
						jQuery(this).next("div").slideUp(400, function() {
							jQuery(this).prev().find("i").removeClass("ico-bold-red-arrow-down");
							jQuery(this).prev().find("i").addClass("ico-bold-red-arrow-up");
							jQuery(this).prev().removeClass("active");
						});
					}
					else
					{
						jQuery(this).addClass("active");
						jQuery(this).next("div").slideDown(400, function() {
							jQuery(this).prev().find("i").addClass("ico-bold-red-arrow-down");
							jQuery(this).prev().find("i").removeClass("ico-bold-red-arrow-up")
						});
					}
				});

				var oWindow = new Array();

				jQuery(".thankyou-voucher-link").on("click", function() {
					oWindow = [];
					pdf_links = '';
					var links = jQuery(this).attr("data-item");
					var is_array = false;
					if(links.indexOf("|") != -1)
					{
						var pdf_links = links.split("|");
						is_array = true;
					}
					else
					{
						var pdf_links = links;
						is_array = false;
					}

					printAll(pdf_links, is_array);
				});
				
				function printAll(pdf_links, is_array) 
				{
			    	if(is_array)
			    	{
			    		for (var i = 0; i < pdf_links.length; i++) 
				    	{
				       	 	//oWindow[i] = window.open(pdf_links[i]);
				       	 	//jQuery("<a download/>").attr("href", pdf_links[i]).get(0).click();
				       	 	/*$('<iframe>', {
						   		src: pdf_links[i]
						   	})[0].contentWindow.print();*/
						   	//$(iframe).get(0).focus();
						   	//$(iframe).get(0).contentWindow.document.print();
						   	var w = window.open(pdf_links[i]);
						   	setTimeout(function() {
						   		if (navigator.appName == 'Microsoft Internet Explorer')  
						   		{ 
						   			window.print(); 
						   		}
						    	else 
						    	{ 
						    		w.print(); 
						    	}
						   	}, 500);
			    		}
			    	}
			    	else
			    	{
			    		var w = window.open(pdf_links);
					   	setTimeout(function() {
					   		if (navigator.appName == 'Microsoft Internet Explorer')  
					   		{ 
					   			window.print(); 
					   		}
					    	else 
					    	{ 
					    		w.print(); 
					    	}
					   	}, 500);
			    	}
			    }

			    /*function applyOrientation()
			    {
		          	if(ismobile)
		          	{         	
		              	if(window.innerHeight > window.innerWidth) //portrait
		              	{
		                  	jQuery(".landscape-sec").hide();
		                  	jQuery(".portrait-sec").show();
		                  	jQuery("body").addClass("mob-portrait");
		                  	jQuery("body").removeClass("mob-landscape");
		              	}
		              	else // landscape
		              	{
		                  	jQuery(".landscape-sec").show();
		                  	jQuery(".portrait-sec").hide();
		                  	jQuery("body").removeClass("mob-portrait");
		                  	jQuery("body").addClass("mob-landscape");
		              	}
		          	}
			    }*/
			</script>
	<?php
		}
		if($current_endpoint == 'order-pay')
		{
	?>
			<script type="text/javascript">
				/*var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;

				applyOrientation();

				window.onresize = function (event) {
                	applyOrientation();
            	};*/

				jQuery(document).on("click",".redemption-details-section h6", function() {
					if(jQuery(this).hasClass("active"))
					{	
						jQuery(this).next("div").slideUp(400, function() {
							jQuery(this).prev().find("i").removeClass("ico-bold-red-arrow-down");
							jQuery(this).prev().find("i").addClass("ico-bold-red-arrow-up");
							jQuery(this).prev().removeClass("active");
						});
					}
					else
					{
						jQuery(this).addClass("active");
						jQuery(this).next("div").slideDown(400, function() {
							jQuery(this).prev().find("i").addClass("ico-bold-red-arrow-down");
							jQuery(this).prev().find("i").removeClass("ico-bold-red-arrow-up")
						});
					}
				});

				/*function applyOrientation()
			    {
		          	if(ismobile)
		          	{         	
		              	if(window.innerHeight > window.innerWidth) //portrait
		              	{
		                  	jQuery(".landscape-sec").hide();
		                  	jQuery(".portrait-sec").show();
		                  	jQuery("body").addClass("mob-portrait");
		                  	jQuery("body").removeClass("mob-landscape");
		              	}
		              	else // landscape
		              	{
		                  	jQuery(".landscape-sec").show();
		                  	jQuery(".portrait-sec").hide();
		                  	jQuery("body").removeClass("mob-portrait");
		                  	jQuery("body").addClass("mob-landscape");
		              	}
		          	}
			    }*/
			</script>
	<?php
		}		
	}
	// scripts for my account pages
	else if(is_account_page()) 
	{
		// scripts for my account edit address page
		if($current_endpoint == 'edit-address')
		{
	?>
			<script type="text/javascript">
				var isipad =navigator.userAgent.match(/(iPad)/i) != null;
				var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;

				applyOrientation();

				window.onresize = function (event) {
                	applyOrientation();
            	};

				if(typeof wc_country_select_params != 'undefined')
				{	
					wc_country_select_params.i18n_select_state_text = 'Select a state';
				}

				jQuery(window).on("load", function() {
					jQuery(".country_to_state").on("change", function() {
			    		setTimeout(function() {
			    			jQuery(".state_select option:first").attr("selected", "selected");
			    		}, 50);
					});
				});

				jQuery(document).ready(function() {
					setTimeout(function() {
						jQuery(".required").addClass("checkout-required");
						jQuery(".required").text("");
					}, 400);

					jQuery(document).on("change", ".country_select", function() {
						jQuery(".required").addClass("checkout-required");
						jQuery(".required").text("");
					});
				});

            	function applyOrientation()
			    {	
		          	if(ismobile)
		          	{         	
		              	if(window.innerHeight > window.innerWidth) //portrait
		              	{
		                  	jQuery(".address-dashboard-section").find(".address").removeClass("mob-col");
		                  	jQuery(".address-dashboard-section").find(".address").addClass("col");

		                  	jQuery(".address-dashboard-section").find(".address").removeClass("mob-col6");
		                  	jQuery(".address-dashboard-section").find(".address").addClass("col4");
		                  	
							jQuery(".address-dashboard-section").find(".mob-col6").addClass("mob-col12");
							jQuery(".address-dashboard-section").find(".mob-col6").removeClass("mob-col6");
		              	}
		              	else // landscape
		              	{
		                  	jQuery(".address-dashboard-section").find(".address").removeClass("col");
		                  	jQuery(".address-dashboard-section").find(".address").addClass("mob-col");

		                  	jQuery(".address-dashboard-section").find(".address").removeClass("col4");
		                  	jQuery(".address-dashboard-section").find(".address").addClass("mob-col6");

							jQuery(".address-dashboard-section").find(".col").addClass("mob-col");
							jQuery(".address-dashboard-section").find(".col").removeClass("col");
		                  	
							jQuery(".address-dashboard-section").find(".col4").addClass("mob-col6");
							jQuery(".address-dashboard-section").find(".col4").removeClass("col4");

							Query(".address-dashboard-section").find(".mob-col12").removeClass("mob-col12");
		              	}
		          	}
			    }
			</script>
	<?php
		}
		// scripts for my account order listing page
		if($current_endpoint == 'orders')
		{
	?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					if(jQuery(".woocommerce-Pagination").length == 0)
					{
            			jQuery(".order-dashboard-section").find(".myaccount-order:last").find(".myaccount-order-section").css("border", "none");
            		}
            	});

				var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
				var isipad =navigator.userAgent.match(/(iPad)/i) != null;

				applyOrientation();

				window.onresize = function (event) {
                	applyOrientation();
            	};

				var oWindow = new Array();

				jQuery(".myaccount-order-print-link").on("click", function() {
					oWindow = [];
					pdf_links = '';
					var links = jQuery(this).attr("data-item");
					var is_array = false;
					if(links.indexOf("|") != -1)
					{
						var pdf_links = links.split("|");
						is_array = true;
					}
					else
					{
						var pdf_links = links;
						is_array = false;
					}

					printAll(pdf_links, is_array);
				});
				
				function printAll(pdf_links, is_array) 
				{
			    	if(is_array)
			    	{
			    		for (var i = 0; i < pdf_links.length; i++) 
				    	{  	 	
						   	var w = window.open(pdf_links[i]);
						   	setTimeout(function() {
						   		if (navigator.appName == 'Microsoft Internet Explorer')  
						   		{ 
						   			window.print(); 
						   		}
						    	else 
						    	{ 
						    		w.print(); 
						    	}
						   	}, 500);
			    		}
			    	}
			    	else
			    	{
			    		var w = window.open(pdf_links);
					   	setTimeout(function() {
					   		if (navigator.appName == 'Microsoft Internet Explorer')  
					   		{ 
					   			window.print(); 
					   		}
					    	else 
					    	{ 
					    		w.print(); 
					    	}
					   	}, 500);
			    	}
			    }

			    function applyOrientation()
			    {
		          	/*if(ismobile)
		          	{         	
		              	if(window.innerHeight > window.innerWidth) //portrait
		              	{
		                  	//jQuery(".landscape-sec").hide();
		                  	//jQuery(".portrait-sec").show();
		                  	jQuery("body").addClass("mob-portrait");
		                  	jQuery("body").removeClass("mob-landscape");
		              	}
		              	else // landscape
		              	{
		                  	//jQuery(".landscape-sec").show();
		                  	//jQuery(".portrait-sec").hide();
		                  	jQuery("body").removeClass("mob-portrait");
		                  	jQuery("body").addClass("mob-landscape");
		              	}
		          	}*/

		          	if(isipad)
		          	{
		          		if(window.innerHeight > window.innerWidth) //portrait
		              	{
		                  	jQuery(".ipad-portrait-sec").show();
		                  	jQuery(".ipad-landscape-sec").hide();
		              	}
		              	else // landscape
		              	{
		                  	jQuery(".ipad-landscape-sec").show();
		                  	jQuery(".ipad-portrait-sec").hide();
		              	}
		          	}
			    }
			</script>
	<?php
		}
		// scripts for my account order details page
		if($current_endpoint == 'view-order')
		{
	?>
			<script type="text/javascript">
				//var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;

				//applyOrientation();

				/*window.onresize = function (event) {
                	applyOrientation();
            	};*/


				jQuery(document).on("click",".redemption-details-section h6", function() {
					if(jQuery(this).hasClass("active"))
					{	
						jQuery(this).next("div").slideUp(400, function() {
							jQuery(this).prev().find("i").removeClass("ico-bold-red-arrow-down");
							jQuery(this).prev().find("i").addClass("ico-bold-red-arrow-up");
							jQuery(this).prev().removeClass("active");
						});				
					}
					else
					{
						jQuery(this).addClass("active");
						jQuery(this).next("div").slideDown(400, function() {
							jQuery(this).prev().find("i").addClass("ico-bold-red-arrow-down");
							jQuery(this).prev().find("i").removeClass("ico-bold-red-arrow-up")
						});
					}
				});

				var oWindow = new Array();

				jQuery(".thankyou-voucher-link").on("click", function() {
					oWindow = [];
					pdf_links = '';
					var links = jQuery(this).attr("data-item");
					var is_array = false;
					if(links.indexOf("|") != -1)
					{
						var pdf_links = links.split("|");
						is_array = true;
					}
					else
					{
						var pdf_links = links;
						is_array = false;
					}

					printAll(pdf_links, is_array);
				});
			
				function printAll(pdf_links, is_array) 
				{
			    	if(is_array)
			    	{
			    		for (var i = 0; i < pdf_links.length; i++) 
				    	{
				       	 	//oWindow[i] = window.open(pdf_links[i]);
				       	 	//jQuery("<a download/>").attr("href", pdf_links[i]).get(0).click();
				       	 	/*$('<iframe>', {
						   		src: pdf_links[i]
						   	})[0].contentWindow.print();*/
						   	//$(iframe).get(0).focus();
						   	//$(iframe).get(0).contentWindow.document.print();
						   	var w = window.open(pdf_links[i]);
						   	setTimeout(function() {
						   		if (navigator.appName == 'Microsoft Internet Explorer')  
						   		{ 
						   			window.print(); 
						   		}
						    	else 
						    	{ 
						    		w.print(); 
						    	}
						   	}, 500);
			    		}
			    	}
			    	else
			    	{
			    		var w = window.open(pdf_links);
					   	setTimeout(function() {
					   		if (navigator.appName == 'Microsoft Internet Explorer')  
					   		{ 
					   			window.print(); 
					   		}
					    	else 
					    	{ 
					    		w.print(); 
					    	}
					   	}, 500);
			    	}
			    }

			    /*function applyOrientation()
			    {
		          	if(ismobile)
		          	{         	
		              	if(window.innerHeight > window.innerWidth) //portrait
		              	{
		                  	//jQuery(".landscape-sec").hide();
		                  	//jQuery(".portrait-sec").show();
		                  	//jQuery("body").addClass("mob-portrait");
		                  	//jQuery("body").removeClass("mob-landscape");
		              	}
		              	else // landscape
		              	{
		                  	//jQuery(".landscape-sec").show();
		                  	//jQuery(".portrait-sec").hide();
		                  	//jQuery("body").removeClass("mob-portrait");
		                  	//jQuery("body").addClass("mob-landscape");
		              	}
		          	}
			    }*/
			</script>
	<?php
		}
		// scripts for my account edit personal details page
		if($current_endpoint == 'edit-account')
		{
	?>
			<script type="text/javascript">
				var ispad =navigator.userAgent.match(/(iPad)/i) != null;
				var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;

				applyOrientation();

				window.onresize = function (event) {
                	applyOrientation();
            	};

				var dateFormat = "dd M yy";
				var currentyear = new Date().getFullYear();
                var months_short = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                var month_options = '<option value="0">January</option><option value="1">February</option><option value="2">March</option><option value="3">April</option><option value="4">May</option><option value="5">June</option><option value="6">July</option><option value="7">August</option><option value="8">September</option><option value="9">October</option><option value="10">November</option><option value="11">December</option>';

				jQuery('#account_marriage_anv, #account_dob').datepicker({
			        dateFormat: dateFormat,
			        numberOfMonths: 1,
			        buttonImageOnly: true,
			        showButtonPanel: true,
			        closeText: "Close",
			        dayNamesShort: ['SUN','MON', 'TUE', 'WED', 'THR', 'FRI', 'SAT'],
			        dayNamesMin: ['SUN','MON', 'TUE', 'WED', 'THR', 'FRI', 'SAT'],
			        changeMonth: true,
			        //monthNamesShort : ["January", "February", "March", "April", "May", "June",
                  						//"July", "August", "September", "October", "November", "December"],
				    changeYear: true,
				    yearRange: "-100:"+currentyear,
				    maxDate: 0,
				    onSelect: function (dateText, inst) {
				    	var day = inst.currentDay;
				    	if(day.length < 2) { day = '0'+day; }
				    	var month = months_short[inst.selectedMonth];
				    	var year = inst.currentYear;
       	 				jQuery("#"+inst.id).val(day+' '+month+' '+year);
    				},
    				onChangeMonthYear: function(year, month, inst) {
    					var selected_month = inst.selectedMonth;
    					setTimeout(function() {
    						jQuery("#ui-datepicker-div").find(".ui-datepicker-month").html(month_options);
    						jQuery("#ui-datepicker-div").find(".ui-datepicker-month option[value='"+selected_month+"']").attr("selected", "selected");
    					}, 40);
    				}
			    });

			    jQuery('#account_marriage_anv, #account_dob').on("click", function() {
			    	jQuery("#ui-datepicker-div").find(".ui-datepicker-month").html(month_options);
			    	var date = $(this).datepicker('getDate');
			    	if(date)
			    	{
				    	month = date.getMonth();
				    	jQuery("#ui-datepicker-div").find(".ui-datepicker-month option[value='"+month+"']").attr("selected", "selected");
				    }
				    else
					{
						var d = new Date();
    					var month = d.getMonth();
    					jQuery("#ui-datepicker-div").find(".ui-datepicker-month option[value='"+month+"']").attr("selected", "selected");
					}
					jQuery("#ui-datepicker-div").removeClass("vertical-widget-datepicker");
			    });

            	function applyOrientation()
			    {
					if(ispad)
		          	{         	
		              	if(window.innerHeight > window.innerWidth) //portrait
		              	{    	
		                  	jQuery(".edit-account").find(".myaccount-personal-details-section").removeClass("col5");
							  jQuery(".edit-account").find(".myaccount-personal-details-section").removeClass("col6");
		                  	jQuery(".edit-account").find(".myaccount-personal-details-section").addClass("col8");

		                  	jQuery(".edit-account").find(".change-password").removeClass("col5");
							  jQuery(".edit-account").find(".change-password").removeClass("col6");
		                  	jQuery(".edit-account").find(".change-password").addClass("col8");
		              	}
		              	else // landscape
		              	{   
							jQuery(".edit-account").find(".myaccount-personal-details-section").removeClass("col8");
							jQuery(".edit-account").find(".myaccount-personal-details-section").removeClass("col5");	
		                  	jQuery(".edit-account").find(".myaccount-personal-details-section").addClass("col6");

		                  	jQuery(".edit-account").find(".change-password").removeClass("col5");
							  jQuery(".edit-account").find(".change-password").removeClass("col8");
		                  	jQuery(".edit-account").find(".change-password").addClass("col6");
		              	}
		          	}
					  
			    }

			    jQuery("#mobile-book-widget").find(".from").on("click", function() {
			    	jQuery("#ui-datepicker-div").removeClass("vertical-widget-datepicker");
			    	jQuery("#ui-datepicker-div").addClass("vertical-widget-datepicker");
			    });
			    jQuery("#mobile-book-widget").find(".to").on("click", function() {
			    	jQuery("#ui-datepicker-div").removeClass("vertical-widget-datepicker");
			    	jQuery("#ui-datepicker-div").addClass("vertical-widget-datepicker");
			    });
			</script>
	<?php
		}
		// scripts for my account dashboard page
		if(is_account_page() && is_user_logged_in() && !$current_endpoint) 
		{
	?>
			<script type="text/javascript">
				var ispad =navigator.userAgent.match(/(iPad)/i) != null;
				var ismobile =navigator.userAgent.match(/(iPod)|(iPhone)|(android)|(webOS)|(blackbery)/i) != null;
				applyOrientation();

				window.onresize = function (event) {
                	applyOrientation();
            	};

            	function applyOrientation()
			    {
		          	if(ispad)
		          	{         	
		              	if(window.innerHeight > window.innerWidth) //portrait
		              	{    	
		                  	jQuery(".dashboard-main-content").find(".col").addClass("col6");
		                  	jQuery(".dashboard-main-content").find(".col").removeClass("col4");
		              	}
		              	else // landscape
		              	{    	
		                  	jQuery(".dashboard-main-content").find(".col").addClass("col4");
		                  	jQuery(".dashboard-main-content").find(".col").removeClass("col6");
		              	}
		          	}
					
					if(ismobile)
					{
						if(window.innerHeight > window.innerWidth) //portrait
		              	{    	
		                  	jQuery(".dashboard-main-content").find(".dashboard-content-section").addClass("mob-col");
		                  	jQuery(".dashboard-main-content").find(".dashboard-content-section").removeClass("col");
							jQuery(".dashboard-main-content").find(".dashboard-content-section").addClass("mob-col12");
		                  	jQuery(".dashboard-main-content").find(".dashboard-content-section").removeClass("col4");
							  jQuery(".dashboard-main-content").find(".dashboard-content-section").removeClass("mob-col6");
		              	}
		              	else // landscape
		              	{   

							jQuery(".dashboard-main-content").find(".dashboard-content-section").addClass("mob-col");
							jQuery(".dashboard-main-content").find(".dashboard-content-section").removeClass("col");
						  	jQuery(".dashboard-main-content").find(".dashboard-content-section").addClass("mob-col6");
							jQuery(".dashboard-main-content").find(".dashboard-content-section").removeClass("col4");
							jQuery(".dashboard-main-content").find(".dashboard-content-section").removeClass("mob-col12");
		              	}
					}
			    } 
			</script>
	<?php
		}
		// reset password confirmation page
		if($current_endpoint == 'lost-password' && isset($_GET['reset-link-sent']) && $_GET['reset-link-sent'] == true)
		{
	?>
			<script type="text/javascript">
				var isipad =navigator.userAgent.match(/(iPad)/i) != null;

				jQuery( window ).on( "orientationchange", function( event ) {
			    	if(isipad)
		          	{
	  					if(window .orientation == 0) // portrait
	  					{
	  						jQuery(".forgot-password-container").addClass("col9");
	  						jQuery(".forgot-password-container").addClass("offsetBy2");

	  						jQuery(".forgot-password-container").removeClass("col6");
	  						jQuery(".forgot-password-container").removeClass("offsetBy3");
	  					}
	  					else // landscape
	  					{
	  						jQuery(".forgot-password-container").addClass("col6");
	  						jQuery(".forgot-password-container").addClass("offsetBy3");

	  						jQuery(".forgot-password-container").removeClass("col9");
	  						jQuery(".forgot-password-container").removeClass("offsetBy2");
	  					}
	  				}
				}).trigger("orientationchange");
			</script>
	<?php
		}
	}
	?>
</html>