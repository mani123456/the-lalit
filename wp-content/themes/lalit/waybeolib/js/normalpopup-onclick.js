//Init Form fields
$(document).ready(function () {
    var telInput = $("#mobile");
    // $.get("http://ipinfo.io", function (response) {
        telInput.intlTelInput({
            defaultCountry: 'in'
        });
    // }, "jsonp");
    $('.themeselector').change(function () {
        $('.themeselector option').each(function () {
            $('.wbf-container').removeClass($(this).val());
        });
        $('.wbf-container').addClass($(this).val());
    }).trigger("change");
    $('#reset').click(function () {
        $('#status').removebounzd();
        $('#name, #phone, #email').val(' ');
    });
    $('.clickme').click(function () {
        $('.wbf-screen').addClass('active');
        $('.wbf-container').addClass('active');
    });
    $('.wbf-close').click(function () {
        $('.wbf-screen').removeClass('active');
        $('.wbf-container').removeClass('active').delay('400').queue(function () {
            $.dequeue(this);
            clearStatus();
            if (timer) {
                timer = null;
            }
        });
    });
    // Customization - location select.
    $("#location").val('');
    $('#location').change(function() {
        var loc = $('#location').val();
        if (loc != '') {
            var options = '<option value="55b608193205b">Suites & Rooms</option>';
            switch (loc) {
                case 'Khajuraho':
                    options += '<option value="55b6087ad484d">Dining - Table Reservation</option>';
                    options += '<option value="55b6089f1100d">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b608d4d6b56">Rejuve-The Spa</option>';
                    break;
                case 'Udaipur':
                    options += '<option value="55b60927aa53e">Dining - Table Reservation</option>';
                    options += '<option value="55b60affd01c2">Weddings, Meetings &amp; Events</option>';
                    break;
                case 'Bangalore':
                    options += '<option value="55b60b7045214">Dining - Table Reservation</option>';
                    options += '<option value="55b60d8b932f8">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b60b9d19285">Rejuve-The Spa</option>';
                    break;
                case 'Goa':
                    options += '<option value="55b60cfcda0b4">Dining - Table Reservation</option>';
                    options += '<option value="55b60d40b5f43">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b60f8eced74">Rejuve-The Spa</option>';
                    break;
                case 'Srinagar':
                    options += '<option value="55b60ff508e0e">Dining - Table Reservation</option>';
                    options += '<option value="55b6101dddcb0">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b6108616281">Rejuve-The Spa</option>';
                    break;
                case 'Mumbai':
                    options += '<option value="55b610d2c2da2">Dining - Table Reservation</option>';
                    options += '<option value="55b610f451f31">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b611189dc05">Rejuve-The Spa</option>';
                    break;
                case 'Chandigarh':
                    options += '<option value="55b6117949c3d">Dining - Table Reservation</option>';
                    options += '<option value="55b611be5ae21">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b611dfce1a0">Rejuve-The Spa</option>';
                    break;
                case 'Kolkata':
                    options += '<option value="55b6127221436">Dining - Table Reservation</option>';
                    options += '<option value="55b612a881004">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b612dd7fb20">Rejuve-The Spa</option>';
                    break;
                case 'Bekal':
                    options += '<option value="55b61326e38b5">Dining - Table Reservation</option>';
                    options += '<option value="55b6134a4f008">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b61375d1b42">Rejuve-The Spa</option>';
                    break;
                case 'Delhi':
                    options += '<option value="55b613eb47263">Dining - Table Reservation</option>';
                    options += '<option value="55b6140b41ffb">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b61427b01d8">Rejuve-The Spa</option>';
                    break;
                case 'Jaipur':
                    options += '<option value="55b6147b28e16">Dining - Table Reservation</option>';
                    options += '<option value="55b61498e3630">Weddings, Meetings &amp; Events</option>';
                    options += '<option value="55b614b350d7a">Rejuve-The Spa</option>';
                    break;
                default:
                    options = '';
                    break;
            }
            $('#services').html(options).show();
        } else {
            $('#services').html('').hide();
        }
    });
    $('#normalMakeCall').click(function() {
        if ($('#services').val() != null) {
            var _phone = $.trim($("#mobile").val()).replace('+', '').replace(' ', '');
            makecall(_phone);
            $('.wbf-container').addClass('connecting');
        }
    });
});

//Init CTC
Waybeo.CTC.Init({
    hash: '55b6346ac1fd6',
   /* exitIntent: {
            aggressive: true,
            timer: 15,
            trigger: showExitPopup
        }*/
});

//makeCall
function makecall(_phone) {
    var _routeHash = $('#services').val();

    //Initiate CTC Call
    Waybeo.CTC.MakeCall({
        'hash': '55b6346ac1fd6',
        'route_hash': _routeHash,
        'callerid_hash': '55b6346ac2c5b',
        'contact_number': _phone
    }, eventCallBack);
}

function showExitPopup() {
    //Trigger for abandoned visitor popup
    $('.wbf-screen').addClass('active');
    $('.wbf-container').addClass('active');
}

//Form reset
function clearStatus() {
    $('.wbf-container').removeClass('connecting')
            .removeClass('connected')
            .removeClass('verifying')
            .removeClass('verification-success')
            .removeClass('failed')
            .removeClass('in-progress')
            .removeClass('completed')
            .removeClass('ended')
            .removeClass('agent-busy')
            .removeClass('oops')
            .removeClass('timer');
}

//Callback handler
var captcha = '', timer = '';
function eventCallBack(event, data) {
    clearStatus();
    switch (event) {
        case 'CAPTCHA':
            captcha = data.code;
            $('.wbf-container').addClass('connecting');
            break;
        case 'ORIGINATE_ERROR':
            $('.wbf-container').addClass('wbf-livemsg-oops');
            break;
        case 'DIALING':
            $('.wbf-container').addClass('connected');
            break;
        case 'VERIFICATION_IN_PROGRESS':
            $('.wbf-container').addClass('verifying');
            $('.wbf-verificationcode').text(captcha);
            break;
        case 'VERIFIED':
            $('.wbf-container').addClass('verification-success');
            setTimeout(function () {
                $('.wbf-container').removeClass('verification-success');
                $('.wbf-container').addClass('in-progress');
            }, 1000);
            setStatusTimer();
            break;
        case 'AGENT_BUSY':
            $('.wbf-container').addClass('agent-busy');
            break;
        case 'INPROGRESS':
            $('.wbf-container').addClass('in-progress');
            setStatusTimer();
            break;
        case 'COMPLETED':
            $('.wbf-container').addClass('completed');
            clearInterval(timer);
            break;
        default:
            $('.wbf-container').addClass('in-progress');
            break;
    }
}

function setStatusTimer() {
    if (!timer) {
        var statusTime = 0;
        timer = setInterval(function () {
            statusTime++;
            var sec = statusTime % 60;
            var min = Math.floor(statusTime / 60);
            var hour = Math.floor(min / 60);
            min = min % 60;
            if (!Math.floor(sec / 10))
                sec = '0' + sec;
            if (!Math.floor(min / 10))
                min = '0' + min;
            if (!Math.floor(hour / 10))
                hour = '0' + hour;
            $('#timer').text(hour + ':' + min + ':' + sec)
        }, 1000);
    }
}