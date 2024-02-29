/*** single product general script ***/
var isipad = navigator.userAgent.match(/(iPad)/i) != null;
var hasError = 0;
var total_variants = jQuery(".variable-value").length;
var selected_variants = [];

jQuery(document).ready(function() {
    jQuery(".variable-value").find("select").change();
    jQuery(".product-detail-summary").find(".product-detail-tab").find("li.active a").click();
    jQuery(".single-product-image").find(".product-detail-tab").find("li.active a").click();
});

jQuery( window ).on( "orientationchange", function( event ) {
    if(isipad)
    {
        if(window .orientation == 0) // portrait
        {
            jQuery(".single-product-sec").addClass("col12");
            jQuery(".single-product-sec").removeClass("col6");
            jQuery(".product-detail-summary").find(".product-detail-tab").find("li.active a").click();
        }
        else // landscape
        {
            jQuery(".single-product-sec").addClass("col6");
            jQuery(".single-product-sec").removeClass("col12");
            jQuery(".single-product-image").find(".product-detail-tab").find("li.active a").click();
        }
    }
}).trigger("orientationchange");

jQuery(window).load(function() {    
    jQuery('.reset_variations').css({'display':'none'});
});

jQuery(".variable-value").find("select").on("change", function() {
    if(jQuery(this).val() != '')
    {       
        selected_variants.push(jQuery(this).parent().attr('data-attr'));
        selected_variants = jQuery.unique(selected_variants);
        changeError(jQuery(this));
        jQuery(".woocommerce-variation").show();
        if(selected_variants.length == total_variants)
        {       
            jQuery(".price").hide();
        }

        jQuery('.reset_variations').css({"display":"inline-block", "padding-top":"20px"});
    }
    else
    {
        jQuery(".price").show();
        jQuery(".woocommerce-variation").hide();
        jQuery('.reset_variations').css({"display":"none"});
    }           
});

jQuery('.reset_variations').on('click',function(){
    jQuery('.variable-product-details-qty .quantity .input-text.qty.qty-text').val('1');
    setTimeout(function(){
        jQuery('.reset_variations').css({'display':'none'})
    }, 100);
});

jQuery(".variable-product-cart").on('click touchstart', function(e) {
    e.preventDefault();
    jQuery(".variable-value").find("select").each(function() {
        if(jQuery(this).val() == '')
        {
            var id_attr = jQuery(this).attr("id");
            if(id_attr.indexOf('_') != -1)
            {
                var res = id_attr.split("_");
                res.shift();
                var msg = res.toString();
                msg = msg.replace("_", " ");
                msg = msg.replace("-", " ");
                msg = msg.replace("-", " ");
            }
            else
            {
                var msg = id_attr;
                msg = msg.replace("-", " ");
                msg = msg.replace("-", " ");
            }
            showError(jQuery(this), "Please select "+msg+".");
            hasError = 1
        }
        else
        {
            changeError(jQuery(this));
        }
    });

    if(hasError == 0) {
        return true;
    }
});

function showError(ele, msg)
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
}
/*** single product general script ***/




/*** Add to Cart section ***/
var windowWidth = jQuery(window).width();
var classForMobile = '';

if(windowWidth < 767)
{
    classForMobile = ' clearfix';
}

jQuery(window).load(function() {
    jQuery('.single_add_to_cart_button').removeAttr('disabled');

    jQuery(".single_add_to_cart_button").on('touchstart click', function(e) {
        e.preventDefault();
        jQuery('.content-section').addClass('content-overlay');
        jQuery(this).removeClass( 'added' );
        jQuery(this).addClass( 'loading' );

        jQuery('.the-lalit-custom-notices').removeClass('woocommerce-message product-update-message').html('');
        jQuery('.the-lalit-custom-notices').hide();

        var product_id = '', variation_id = '', quantity = '';
        var variationData, simpleProductData, groupedProductsData;
        var i = 0;

        if( jQuery('.group_table').length )
        {
            groupedProductsData = {};
            groupedProductsData.productInfo = [];
            groupedProductsData.productId = jQuery('input[name=add-to-cart]').val();
            jQuery('.group_table > tbody > tr').each(function() {
                if(jQuery(this).find('div.quantity > input.input-text').val() > 0)
                {
                    groupedProductsData.productInfo[i] = {};
                    groupedProductsData.productInfo[i].id = jQuery(this).find('div.quantity > input.input-text').attr('name');
                    groupedProductsData.productInfo[i].quantity = jQuery(this).find('div.quantity > input.input-text').val();
                    i++;
                }
            });
        }
        else if(jQuery('.variations_form').length)
        {
            if(jQuery('.stock.out-of-stock').text() != 'Out of stock')
            {
                $variation_form = jQuery( this ).closest( '.variations_form' );
                var var_id = $variation_form.find( 'input[name=variation_id]' ).val();
                var product_id = $variation_form.find( 'input[name=product_id]' ).val();
                var quantity = $variation_form.find( 'input[name=quantity]' ).val();

                //jQuery( '.ajaxerrors' ).remove();
                variations = $variation_form.find( 'select[name^=attribute]' );
                /* Updated code to work with radio button - mantish - WC Variations Radio Buttons - 8manos */ 
                if ( !variations.length) {
                  variations = $variation_form.find( '[name^=attribute]:checked' );
                }
                
                /* Backup Code for getting input variable */
                if ( !variations.length)
                {
                    variations = $variation_form.find( 'input[name^=attribute]' );
                }
                var check = true;
                var item = {};
                variations.each( function() {
                    var $this = $( this ),
                    attributeName = $this.attr( 'name' ),
                    attributevalue = $this.val(),
                    index,
                    attributeTaxName;
                
                    if ( attributevalue.length === 0 ) 
                    {
                        index = attributeName.lastIndexOf( '_' );
                        attributeTaxName = attributeName.substring( index + 1 );
                
                        check = false;

                        jQuery('.content-section').removeClass('content-overlay');
                        jQuery('.reset_variations').css('padding-top','0px');
                    }
                    else 
                    {
                        item[attributeName] = attributevalue;
                    }
                
                });

                if ( !check ) 
                {
                    return false;
                }

                variationData = {
                    product_id: product_id,
                    quantity: quantity,
                    variation_id: var_id,
                    variation: item
                }
            }
            else
            {
                jQuery('.content-section').removeClass('content-overlay');
            }
        }
        else 
        {
            simpleProductData = {};
            simpleProductData.product_id = jQuery(this).val();
            simpleProductData.quantity = jQuery('input[name="quantity"]').val();
        }

        if ( variationData ) 
        { 
            if(variationData.quantity != 0)
            {
                data = {};
                data.action = 'the_lalit_add_to_cart';
                data.jsonVarObj = JSON.stringify(variationData);

                jQuery.ajax ({
                    url:  '/wp-admin/admin-ajax.php',
                    type: 'POST',
                    data:  data,
                    dataType: 'json',
                    beforeSend:function() {
                        jQuery('.the-lalit-custom-notices').removeClass('woocommerce-message product-update-message woocommerce-error error-message-woocommerce').html('');
                        jQuery('.the-lalit-custom-notices').hide();
                    },
                    success:function(results) {
                        jQuery('.content-section').removeClass('content-overlay');
                        if(results.status)
                        {
                            jQuery('.the-lalit-custom-notices').addClass('woocommerce-message product-update-message').html(results.msg).show();
                            jQuery('a.cart-global-icon > span').addClass('cart-no').text(results.count);
                        }
                        else
                        {
                            jQuery('.the-lalit-custom-notices').html('<ul class="woocommerce-error error-message-woocommerce product-error-message"><li class="error-message-list'+classForMobile+'"> <i class="ico-sprite sprite ico-close-with-circle size-26"></i><span class="product-error-description">'+results.msg+'</span></li></ul>').show();
                            jQuery('a.cart-global-icon > span').addClass('cart-no').text(results.count);
                        }
                        scrollToMessage();
                    }
                });
            }
            else
            {
                jQuery('.the-lalit-custom-notices').html('<ul class="woocommerce-error error-message-woocommerce product-error-message"><li class="error-message-list'+classForMobile+'"> <i class="ico-sprite sprite ico-close-with-circle size-26"></i><span class="product-error-description">You haven’t selected any items, please select quantities for items you wish to add to your cart.</span></li></ul>').show();
                jQuery('.content-section').removeClass('content-overlay');
                scrollToMessage();        
            }
        }
        else if(groupedProductsData) 
        {
            if(groupedProductsData.productInfo.length != 0)
            {
                data = {};
                data.action = 'the_lalit_add_to_cart';
                data.jsonGroupedObj = JSON.stringify(groupedProductsData);

                jQuery.ajax ({
                    url: '/wp-admin/admin-ajax.php',
                    type:'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend:function() {
                        jQuery('.the-lalit-custom-notices').removeClass('woocommerce-message product-update-message woocommerce-error error-message-woocommerce').html('');
                        jQuery('.the-lalit-custom-notices').hide();
                        jQuery('.groupedProductError').html('').remove();
                    },
                    success:function(results) {
                        var errorMsg = successMsg = '';
                        jQuery('.content-section').removeClass('content-overlay');
                        if(results.msg.indexOf('<ul') != -1)
                        {
                            errorMsg = results.msg.substring(results.msg.indexOf('<ul'));
                            successMsg = results.msg.substring(results.msg.indexOf('<ul'), 0);

                            if(errorMsg)
                            {
                                jQuery('.the-lalit-custom-notices').after('<div class="groupedProductError"></div>');
                                jQuery('.groupedProductError').html(errorMsg);
                            }
                            if(successMsg)
                            {
                              jQuery('.the-lalit-custom-notices').addClass('woocommerce-message product-update-message').html(successMsg).show();
                            }
                        }
                        else
                        {
                            if(results.status)
                            {
                                jQuery('.the-lalit-custom-notices').addClass('woocommerce-message product-update-message').html(results.msg).show();
                            }
                            else
                            {
                                jQuery('.the-lalit-custom-notices').html('<ul class="woocommerce-error error-message-woocommerce product-error-message"><li class="error-message-list'+classForMobile+'"> <i class="ico-sprite sprite ico-close-with-circle size-26"></i><span class="product-error-description">'+results.msg+'</span></li></ul>').show();
                                jQuery('a.cart-global-icon > span').addClass('cart-no').text(results.count);
                            }
                        }

                        jQuery('a.cart-global-icon > span').addClass('cart-no').text(results.count);
                        scrollToMessage();
                    }
                });
            }
            else
            {
                jQuery('.the-lalit-custom-notices').html('<ul class="woocommerce-error error-message-woocommerce product-error-message"><li class="error-message-list'+classForMobile+'"> <i class="ico-sprite sprite ico-close-with-circle size-26"></i><span class="product-error-description">You haven’t selected any items, please select quantities for items you wish to add to your cart.</span></li></ul>').show();
                jQuery('.content-section').removeClass('content-overlay');
                scrollToMessage();
            }
        }
        else if(simpleProductData)
        {
            if(simpleProductData.quantity != 0)
            {
                data = {};
                data.action = 'the_lalit_add_to_cart';
                data.jsonSimpleObj = JSON.stringify(simpleProductData);

                jQuery.ajax ({
                    url:  '/wp-admin/admin-ajax.php',  
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend: function() {
                        jQuery('.the-lalit-custom-notices').removeClass('woocommerce-message product-update-message woocommerce-error error-message-woocommerce').html('');
                        jQuery('.the-lalit-custom-notices').hide();
                    },
                    success: function(results) {
                        jQuery('.content-section').removeClass('content-overlay');
                        if(results.status)
                        {
                            jQuery('.the-lalit-custom-notices').addClass('woocommerce-message product-update-message').html(results.msg).show();
                            jQuery('a.cart-global-icon > span').addClass('cart-no').text(results.count);
                        }
                        else
                        {
                            jQuery('.the-lalit-custom-notices').html('<ul class="woocommerce-error woocommerce-error error-message-woocommerce product-error-message"><li class="error-message-list'+classForMobile+'"> <i class="ico-sprite sprite ico-close-with-circle size-26"></i><span class="product-error-description">'+results.msg+'</span></li></ul>').show();
                            jQuery('a.cart-global-icon > span').addClass('cart-no').text(results.count);
                        }
                        scrollToMessage();
                    }
                });
            }
            else
            {
                jQuery('.the-lalit-custom-notices').html('<ul class="woocommerce-error error-message-woocommerce product-error-message"><li class="error-message-list'+classForMobile+'"> <i class="ico-sprite sprite ico-close-with-circle size-26"></i><span class="product-error-description">You haven’t selected any items, please select quantities for items you wish to add to your cart.</span></li></ul>').show();
                jQuery('.content-section').removeClass('content-overlay');
                scrollToMessage();
            }
        }
    });
});

function scrollToMessage()
{
    if(jQuery('.the-lalit-custom-notices').length && !jQuery('.the-lalit-custom-notices').isInViewport())
    {    
        jQuery('html, body').animate({
            scrollTop: jQuery('.content-section').offset().top
        }, 'slow');
    }
    else if(jQuery('.groupedProductError').length && !jQuery('.groupedProductError').isInViewport())
    {
        jQuery('html, body').animate({
            scrollTop: jQuery('.content-section').offset().top
        }, 'slow');
    }
}

jQuery.fn.isInViewport = function() {
    var viewport = {};
    viewport.top = jQuery(window).scrollTop();
    viewport.bottom = viewport.top + jQuery(window).height();
    var bounds = {};
    bounds.top = this.offset().top;
    bounds.bottom = bounds.top + this.outerHeight();
    return ((bounds.top <= viewport.bottom + 10) && (bounds.bottom >= viewport.top));
};
/*** Add to Cart section ***/