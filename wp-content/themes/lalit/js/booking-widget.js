 
var bookingEngineArray = ['','myhotelreservation', 'sabre'];

var hotel;
var checkInDate;
var checkOutDate;
var adultsCount;
var childrenCount;
var childrenAges = '';
var hasError = 0;


jQuery(document).ready(function() { 
    
    var dateFormat = "dd M yy";
    var currentyear = new Date().getFullYear();
    var nextYear = new Date().getFullYear() + 1;
    var yearRange = currentyear+":"+nextYear;
    
    jQuery('.from').datepicker({
        dateFormat: dateFormat,
        yearRange: yearRange,
        changeMonth: false,
        minDate: 0,
        numberOfMonths: 2,
        showOn: "both",
        buttonImageOnly: true,
        showButtonPanel: true,
        closeText: "Close",
        dayNamesShort: ['SUN','MON', 'TUE', 'WED', 'THR', 'FRI', 'SAT'],
        dayNamesMin: ['SUN','MON', 'TUE', 'WED', 'THR', 'FRI', 'SAT']
    })
    .on('change',$.proxy(function(event){
        var currentElement = jQuery(event.currentTarget),
        date2 = currentElement.datepicker('getDate');

        date2.setDate(date2.getDate() + 1);
        jQuery(currentElement).closest('.booking_widget').find('.to').datepicker('setDate', date2);
        jQuery(currentElement).closest('.booking_widget').find('.to').datepicker('option', 'minDate', date2);
    },this));

    jQuery('.to').datepicker({
        dateFormat: dateFormat,
        yearRange: yearRange,
        changeMonth: false,
        numberOfMonths: 2,
        showOn: "both",
        buttonImageOnly: true,
        showButtonPanel: true,
        closeText: "Close",
       dayNamesShort: ['SUN','MON', 'TUE', 'WED', 'THR', 'FRI', 'SAT'],
        dayNamesMin: ['SUN','MON', 'TUE', 'WED', 'THR', 'FRI', 'SAT']
    });

    jQuery('.from').datepicker('setDate', new Date());

    var currentDate = new Date();  
    jQuery(".from").datepicker("setDate",currentDate);
    currentDate.setDate(currentDate.getDate()+1);
    jQuery(".to").datepicker("setDate",currentDate);
    jQuery('.to').datepicker('option', 'minDate', currentDate);
});

jQuery('.formSend').on('click',function(event){

    var currentElement = jQuery(event.currentTarget);
    hotel = jQuery(currentElement).closest('.booking_widget').find(".selecthotel option:selected").val();
    checkInDate = new Date(jQuery(currentElement).closest('.booking_widget').find(".from").val());
    checkOutDate = new Date(jQuery(currentElement).closest('.booking_widget').find(".to").val());

    adultsCount = jQuery(currentElement).closest('.booking_widget').find(".adult option:selected").val();
    childrenCount = jQuery(currentElement).closest('.booking_widget').find(".children option:selected").val();
    url = jQuery(currentElement).closest('.booking_widget').find(".selecthotel option:selected").attr("data-booking-url");
    bookingEngine = bookingEngineArray[jQuery(currentElement).closest('.booking_widget').find(".selecthotel option:selected").attr("data-booking-engine")];


    hasError = 0;

    if(hotel == "0"){
        showSelectError("selecthotel", "Please select a Hotel", jQuery(currentElement).closest('.booking_widget') );
        hasError = 1;
    }
    else{
        changeSelectError(jQuery(currentElement).closest('.booking_widget'), "selecthotel");
    }
    if(jQuery(currentElement).closest('.booking_widget').find(".children option:selected").val() > 0)
    {
        val = jQuery(currentElement).closest('.booking_widget').find(".children option:selected").val();
        for(i=1;i<=val;i++)
        {
            if(jQuery(currentElement).closest('.booking_widget').find(".select_field_"+i+" option:selected").val() == -1)
            {
                showSelectError("select_field_"+i, "Please enter child’s age", jQuery(currentElement).closest('.booking_widget') );
                hasError = 1;
            }
            else
            {
                changeSelectError(jQuery(currentElement).closest('.booking_widget'), "select_field_"+i);
            }
        }
    }

    if(url != '-1' && !hasError)
    {   
        if(bookingEngine == 'myhotelreservation')
        {
            checkInMonth = ((checkInDate.getMonth() + 1) < 10) ? "0"+(checkInDate.getMonth() + 1) : (checkInDate.getMonth() + 1);
            checkInDay = (checkInDate.getDate() < 10) ? "0"+checkInDate.getDate() : checkInDate.getDate();

            checkOutMonth = ((checkOutDate.getMonth() + 1) < 10) ? "0"+(checkOutDate.getMonth() + 1) : (checkOutDate.getMonth() + 1);
            checkOutDay = (checkOutDate.getDate() < 10) ? "0"+checkOutDate.getDate() : checkOutDate.getDate();

            from = checkInDate.getFullYear()+"-"+checkInMonth+"-"+checkInDay;
            to = checkOutDate.getFullYear()+"-"+checkOutMonth+"-"+checkOutDay;
        
            if(childrenCount > 0)
            {
                for(i=1;i<=childrenCount;i++)
                {
                    childrenAges += jQuery(currentElement).closest('.booking_widget').find(".select_field_"+i+" option:selected").val() + "-";
                }
                childrenAges = childrenAges.replace(/\-$/, '');
                url += '?a='+adultsCount+"&c="+childrenCount+"&ca="+childrenAges+"&f="+from+"&t="+to;
            }
            else
            {
                url += '?a='+adultsCount+"&f="+from+"&t="+to;
            }

            var ga_cookie = ''
            if(typeof(ga) != 'undefined')
            {
                for (var i=0;i<ga.getAll().length;i++)
                {
                    if(ga.getAll()[i].get('trackingId') == 'UA-11443455-1')
                    {
                         ga_cookie = ga.getAll()[i].get('linkerParam');
                    }
                }
            }
            if(ga_cookie != '')
            {
                window.location = url+"&"+ga_cookie;
            }
            else
            {   
                window.location = url;
            }
        }
        else if(bookingEngine == 'sabre')
        {
            checkInMonth = ((checkInDate.getMonth() + 1) < 10) ? "0"+(checkInDate.getMonth() + 1) : (checkInDate.getMonth() + 1);
            checkInDay = (checkInDate.getDate() < 10) ? "0"+checkInDate.getDate() : checkInDate.getDate();

            checkOutMonth = ((checkOutDate.getMonth() + 1) < 10) ? "0"+(checkOutDate.getMonth() + 1) : (checkOutDate.getMonth() + 1);
            checkOutDay = (checkOutDate.getDate() < 10) ? "0"+checkOutDate.getDate() : checkOutDate.getDate();

            arrive = checkInMonth+"/"+checkInDay+"/"+checkInDate.getFullYear();
            depart = checkOutMonth+"/"+checkOutDay+"/"+checkOutDate.getFullYear();

            if(childrenCount > 0)
            {
                for(i=1;i<=childrenCount;i++)
                {
                    childrenAges += jQuery(currentElement).closest('.booking_widget').find(".select_field_"+i+" option:selected").val() + "|";
                }
                childrenAges = childrenAges.replace(/\|$/, '');
                url += "&start=availresults&arrive="+arrive+"&depart="+depart+"&adult="+adultsCount+"&child="+childrenCount+"&childages="+childrenAges;
            }
            else
            {
                url += "&start=availresults&arrive="+arrive+"&depart="+depart+"&adult="+adultsCount+"&child="+childrenCount;
            }

            var ga_cookie = ''
            if(typeof(ga) != 'undefined')
            {
                for (var i=0;i<ga.getAll().length;i++)
                {
                    if(ga.getAll()[i].get('trackingId') == 'UA-11443455-1')
                    {
                         ga_cookie = ga.getAll()[i].get('linkerParam');
                    }
                }
            }
            if(ga_cookie != '')
            {
                window.location = url+"&"+ga_cookie;
            }
            else
            {   
                window.location = url;
            }
        }
    }

});

jQuery(".children").on('change',function(event){

    var currentElement = jQuery(event.currentTarget);
    childrenCount = jQuery(currentElement).closest('.booking_widget').find(".children option:selected").val();
    if(childrenCount > 0)
    {
        for(i=1;i<=4;i++)
        {
            if(childrenCount >= i)
            {
                jQuery(currentElement).closest('.booking_widget').find('.select_field_'+i).parents('div.errorDisplayDiv').slideDown(100);
            }
            else
            {
                jQuery(currentElement).closest('.booking_widget').find('.select_field_'+i).parents('div.errorDisplayDiv').slideUp(100);
                //jQuery('.select_field_'+i+'>option:eq(0)').prop('selected',true);
                changeSelectError(jQuery(currentElement).closest('.booking_widget'), "select_field_"+i);
            }
        }

        jQuery(currentElement).closest('.booking_widget').find("div.child-element").slideDown(100);
    }
    else
    {
        jQuery(currentElement).closest('.booking_widget').find("div.child-element").slideUp(100);
        
        for(i=1;i<=4;i++)
        {
            jQuery(currentElement).closest('.booking_widget').find('.select_field_'+i+'>option:eq(0)').prop('selected',true);
            changeSelectError(jQuery(currentElement).closest('.booking_widget'), "select_field_"+i);
        }
    }

});

jQuery(".booking-widget").on('submit',function(){

    return false;

});

function showSelectError(ele, msg, form){
    if(jQuery(form).find('.'+ele).parents('div.errorDisplayDiv').hasClass("error"))
    {
        jQuery(form).find('.'+ele).parents('div.errorDisplayDiv').find("span.hint").text(msg);
    }
    else
    {
        jQuery(form).find('.'+ele).parents('div.errorDisplayDiv').append('<span class="hint">'+msg+'</span>');
        jQuery(form).find('.'+ele).parents('div.errorDisplayDiv').addClass('error');
    }

}

function changeSelectError(form, ele){
    jQuery(form).find('.'+ele).parents('div.errorDisplayDiv').find("span.hint").remove();
    jQuery(form).find('.'+ele).parents('div.errorDisplayDiv').removeClass("error");

}

function validateForm(){
    return hasError;
}