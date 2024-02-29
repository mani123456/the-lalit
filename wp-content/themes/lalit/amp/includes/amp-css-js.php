<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/themes/lalit/images/favicon.ico">
<link rel="profile" href="http://microformats.org/profile/hcard">
<?php
/*if(ENV == 'production')
{
?>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-11443455-1', {'name':'newTracker','allowLinker': true});
		ga('newTracker.require', 'linker');
		ga('newTracker.linker:autoLink', ['gc.synxis.com,myhotelreservation.net'] );
		ga('newTracker.send', 'pageview');
	</script>
	<script>
	   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	   })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	   ga('create', 'UA-49165825-1', 'auto');
	   ga('send', 'pageview');
	</script>
<?php
}*/
do_action( 'amp_post_template_head', $this );
?>
<script async custom-element="amp-position-observer" src="https://cdn.ampproject.org/v0/amp-position-observer-0.1.js"></script>
<script async custom-element="amp-animation" src="https://cdn.ampproject.org/v0/amp-animation-0.1.js"></script>
<script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>