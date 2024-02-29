/* form validation functions */		
//var hasError = 0;

//Phone validation
function phonenumber(inputtxt)  
{  
	var phoneno = /^[0-9-+]+$/i;  
	if(phoneno.test(trim(inputtxt)))  
	{  
		return true;  
	}  
	else  
	{  
		return false;  
	}  
} 

function trim(str)
{ 
	return((""+str).replace(/^\s*([\s\S]*\S+)\s*$|^\s*$/,'$1') ); 
}
// Email validation
function isValidEmail(value){
	var filter=/^([\w-\+]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(filter.test(trim(value))) {
		return true;
	}	
	else {
		return false; 
	}
}

//function show select error
function showSelectError(ele, msg, form){
	if(jQuery('#'+form).find('#'+ele).parent().hasClass("error"))
	{
		jQuery('#'+form).find('#'+ele).parent().find("span.hint").text(msg);
	}
	else
	{
		jQuery('#'+form).find('#'+ele).parent().append('<span class="hint">'+msg+'</span>');
		jQuery('#'+form).find('#'+ele).parent().addClass('error');
	}
}

//function change select error
function changeSelectError(form, ele){
	jQuery('#'+form).find('#'+ele).parent().find(".hint").remove();
	jQuery('#'+form).find('#'+ele).parent().removeClass("error");
}

//function show radio button error
function showRedioError(ele, msg, form){
	if(jQuery('#'+form).find('#'+ele).parent().hasClass("error"))
	{
		jQuery('#'+form).find('#'+ele).parent().find("span.hint").text(msg);
	}
	else
	{
		jQuery('#'+form).find('#'+ele).parent().append('<span class="hint">'+msg+'</span>');
		jQuery('#'+form).find('#'+ele).parent().addClass('error');
	}
}

//function change radio button error
function changeRedioError(ele, form){
	jQuery('#'+form).find('#'+ele).parent().find(".hint").remove();
	jQuery('#'+form).find('#'+ele).parent().removeClass("error");
}

//function show chackbox button error
function showCheckboxError(ele, msg, form){
	if(jQuery('#'+form).find('#'+ele).hasClass("error"))
	{
		jQuery('#'+form).find('#'+ele).find("span.hint").text(msg);
	}
	else
	{
		jQuery('#'+form).find('#'+ele).append('<span class="hint">'+msg+'</span>');
		jQuery('#'+form).find('#'+ele).addClass('error');
	}
}

//function change chackbox button error
function changeCheckboxError(ele, form){
	jQuery('#'+form).find('#'+ele).find(".hint").remove();
	jQuery('#'+form).find('#'+ele).removeClass("error");
}


//function show error
function showError(msg, form, ele){
	if(jQuery('#'+form).find('#'+ele).parent().hasClass("error"))
	{
		jQuery('#'+form).find('#'+ele).parent().find("span.hint").text(msg);
		jQuery('#'+form).find('#'+ele).val('');
	}
	else
	{
		jQuery('#'+form).find('#'+ele).parent().append('<span class="hint">'+msg+'</span>');
		jQuery('#'+form).find('#'+ele).parent().addClass('error');
		jQuery('#'+form).find('#'+ele).val('');
	}
	hasError = 1;
}
//function change error
function changeError(form, ele){
	jQuery('#'+form).find('#'+ele).parent().find(".hint").remove();
	jQuery('#'+form).find('#'+ele).parent().removeClass("error");
}


function validatenormalform(id){
	var hasError = 0;
	var name = jQuery('#'+id).find('#name').val();
	var email = jQuery('#'+id).find("#email").val();
	var companyname = jQuery('#'+id).find("#companyname").val();
	var conNo = jQuery('#'+id).find("#contactNo").val();
	if(trim(name)==""){ 
		showError("Please enter Name", id, "name"); 
	 	hasError = 1;
	} 
	else { 
	  changeError(id, "name");
	}
	
	if(trim(email)==""){ 
		showError("Please enter Email Id", id, "email");
		hasError = 1; 
	}
	else if(isValidEmail(email)) {
		changeError(id, "email"); 
	}
	else {
		showError("Please enter a valid Email Id", id, "email"); 
		hasError = 1; 
	}
	
	if(trim(companyname)==""){ 
		showError("Please enter Company Name", id, "companyname"); 
		hasError = 1; 
	} else {
		changeError(id, "companyname"); 
	}
	
	if(trim(conNo)=="") 
	{ 
		showError("Please enter mobile number", id, "contactNo"); 
		hasError = 1; 
	} 
	else 
	{
	    if(!phonenumber(conNo))
	    {
	    	showError("Only digits, +, - and # allowed", id, "contactNo");
			hasError = 1; 
	    } 
		else 
		{ 
			if(conNo.length != 10){
				showError("Please 10 digit mobile number", id, "contactNo");
				hasError = 1; 
			}
			else{
				changeError(id, "contactNo"); 
			}
		}
	}
	
	if(jQuery('#'+id).find("#Gender").find("input:radio:checked").length == 0) 
	{
		showRedioError("Gender", "Please select any one of above ", id);
		hasError = 1;
		
	}
	else {
		changeRedioError("Gender", id );
	}
	
	if(jQuery('#'+id).find("#checkbox-block").find("input:checkbox:checked").length == 0) 
	{
		showCheckboxError("checkbox-block", "Please select terms and conditions", id);
		hasError = 1;
	}
	else {
		changeCheckboxError("checkbox-block", id );
	}

	//Country select code
	if(jQuery("#country").val() == "0"){
		showSelectError("country", "Please select country", id );
		hasError = 1; 	
	}
	else{
		changeSelectError(id, "country");
	}


	//Country state code
	if(jQuery("#state").val() == "0"){
		showSelectError("state", "Please select state", id );
		hasError = 1; 	
	}
	else{
		changeSelectError(id, "state");
	}
	
	/*
	if(jQuery.trim(dobDate)==0 && jQuery.trim(dobMonth)==0 && jQuery.trim(dobYear)=='') { 
		showError("Please select day / month / year", "dobDate"); hasError = 1; 
	} else if(jQuery.trim(dobDate)==0) {
		showError("Please select day", "dobDate"); hasError = 1; 
	} else if(jQuery.trim(dobMonth)==0) {
		showError("Please select month", "dobMonth"); hasError = 1; 
	} else if(jQuery.trim(dobYear)=='') {
		showError("Please enter year", "dobYear"); hasError = 1; 
	} else if(isNaN(jQuery.trim(dobYear))) {
		showError("Enter a numeric value", "dobYear"); hasError = 1; 
	} else if(jQuery.trim(dobYear).length<4) {
		showError("Enter a 4 digit year", "dobYear"); hasError = 1; 
	} else {
		changeError("dobDate");
		changeError("dobMonth");
		changeError("dobYear");
	}
	*/

	if(hasError==0){
		return true;
	}
	else{
		return false;
	}
	
	return false;
}
function checkavailability(id){
	if(jQuery("#selecthotel").val() == "0"){
		showSelectError("selecthotel", "Please select Hotel", id );
		hasError = 1; 	
	}
	else{
		changeSelectError(id, "selecthotel");
	}
	return false;		
			
}
