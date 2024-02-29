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
});