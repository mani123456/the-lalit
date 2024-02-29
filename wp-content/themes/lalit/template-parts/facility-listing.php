<div id="wxWrap">
    <span id="wxIntro">
        Currently in New Delhi, NY: 
    </span>
    <span id="wxIcon2"></span>
    <span id="wxTemp"></span>
</div>
<script type="text/javascript">
$(function(){
 
    // Specify the ZIP/location code and units (f or c)
    var loc = 'INXX0096'; // or e.g. SPXX0050
    var u = 'c';
 
    var locationQuery = escape("select * from weather.forecast where woeid in (select woeid from geo.places where text='New Delhi, India') and u='c'")
    var query_1 = "select * from geo.places where text='Delhi, IN'&format=json";

    var url = "http://query.yahooapis.com/v1/public/yql?q=" + locationQuery + "&format=json&callback=?";
    var query = "SELECT item.condition FROM weather.forecast WHERE location='" + loc + "' AND u='" + u + "'";
    var cacheBuster = Math.floor((new Date().getTime()) / 1200 / 1000);
    var query_url = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent(query) + '&format=json&_nocache=' + cacheBuster;
 
    window['wxCallback'] = function(data) {
        var info = data.query.results.channel.item.condition;
        $('#wxIcon').css({
            backgroundPosition: '-' + (61 * info.code) + 'px 0'
        }).attr({
            title: info.text
        });
        $('#wxIcon2').append('<img src="http://l.yimg.com/a/i/us/we/52/' + info.code + '.gif" width="34" height="34" title="' + info.text + '" />');
        $('#wxTemp').html(info.temp + '&deg;' + (u.toUpperCase()));
    };
 
    /*$.ajax({
        url: query_url,
        dataType: 'jsonp',
        cache: true,
        jsonpCallback: 'wxCallback'
    });*/

    jQuery.ajax({
        dataType: 'json',
        type: "post",
        url:url,
        success: function(data) {
            console.log(data);
            var info = data.query.results.channel.item.condition;
        $('#wxIcon').css({
            backgroundPosition: '-' + (61 * info.code) + 'px 0'
        }).attr({
            title: info.text
        });
        $('#wxIcon2').append('<img src="http://l.yimg.com/a/i/us/we/52/' + info.code + '.gif" width="34" height="34" title="' + info.text + '" />');
        $('#wxTemp').html(info.temp + '&deg;' + (u.toUpperCase()));
        }
    });
     
});
</script>