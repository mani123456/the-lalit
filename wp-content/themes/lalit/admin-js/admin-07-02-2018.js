jQuery(document).ready(function() {
	jQuery('.menuStyle').each(function(index, el) {
		jQuery(this).find('ul li').each(function(index, el) {
			if(jQuery(this).find('i').length)
			{
				jQuery(this).addClass('menuBGColor')
				jQuery(this).find('a').css('color','#eee');
			}
		});
	});
	/*jQuery('.menuBGColor')
	.on('mouseover',function(){
		jQuery(this).find('a').css('color','#0073aa');
	})
	.on('mouseout',function(){
		jQuery(this).find('a').css('color','#eee');
	});*/
	
	jQuery('#publishing-action #publish').on('click', checkOutletEmailField);
	jQuery('#post').on('submit', checkOutletEmailField);
});


function checkOutletEmailField() {

	if(pagenow == 'product'){

		var inputText = jQuery('#acf-field-woocommerce_outlet_email_id').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;

		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				return true;
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter the correct outlet email id separated by commas');
				return false;
			}
		}
	}
}