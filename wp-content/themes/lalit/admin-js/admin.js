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
	
	jQuery('.menuScroll').find('.wp-submenu.wp-submenu-wrap').css({'height':'500px','overflow-y':'scroll'});
	jQuery(window).on('scroll',function(){
		var iCurScrollPos = jQuery(this).scrollTop();
		if(iCurScrollPos == 0)
		{
			jQuery('#adminmenuwrap').css({'top':'20px'});
		}
	});
	
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
	
	if(pagenow == 'destination')
	{
		/*var inputText = jQuery('#acf-field-meetings_and_weddings_email').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;
		

		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				flagArray.push(true);
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter the valid email ids separated by commas');
				flagArray.push(false);
			}
		}*/
		var flagArray = [];
		var inputText = jQuery('#acf-field-general_manager_email').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;

		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				flagArray.push(true);
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter a valid General Manager email id. In case of multiple email ids use comma as a separator.');
				flagArray.push(false);
			}
		}

		var inputText = jQuery('#acf-field-pa_to_general_manager_email').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;
		
		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				flagArray.push(true);
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter a valid PA to General Manager email id. In case of multiple email ids use comma as a separator.');
				flagArray.push(false);
			}
		}

		var inputText = jQuery('#acf-field-hotel_manager_email').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;
		
		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				flagArray.push(true);
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter a valid Hotel Manager email id. In case of multiple email ids use comma as a separator.');
				flagArray.push(false);
			}
		}

		var inputText = jQuery('#acf-field-resident_manager_email').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;
		
		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				flagArray.push(true);
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter a valid Resident Manager email id. In case of multiple email ids use comma as a separator.');
				flagArray.push(false);
			}
		}
		
		var inputText = jQuery('#acf-field-room_division_manager_email').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;
		
		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				flagArray.push(true);
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter a valid Room Division Manager email id. In case of multiple email ids use comma as a separator.');
				flagArray.push(false);
			}
		}

		var inputText = jQuery('#acf-field-executive_assistant_manager_email').val();
		var pattern = /^[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}(?:(,|,\s)[-\w+.%]+@[\w-.]+\.[A-Za-z]{2,4}){0,50}$/gi;
		
		if(jQuery.trim(inputText) != ''){

			if(pattern.test(inputText)){
				//jQuery('#publishing-action #publish').removeClass('disabled');
				flagArray.push(true);
			}
			else{
				//jQuery('#publishing-action #publish').addClass('disabled');
				alert('Please enter a valid Executive Assistant Manager email id. In case of multiple email ids use comma as a separator.');
				flagArray.push(false);
			}
		}


		if(flagArray.indexOf(false) != -1){
			return false;
		}
		else {
			return true;
		}
	}
		
	if(pagenow == 'chef'){
		
		if(jQuery.trim(jQuery('#acf-description textarea').val()) == ''){
			alert('All fields are required');
			return false;
		}
	}
}