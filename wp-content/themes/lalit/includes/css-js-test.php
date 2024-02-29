<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/themes/lalit/images/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Prata|Roboto:300,400,500,700" rel="stylesheet">
<!--<link type="text/css" rel="stylesheet" href="/wp-content/plugins/contact-form-7/includes/css/styles.css" />-->
<!--<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/jquery-ui.min.css" media="screen" />-->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/flexslider.min.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/jquery.fancybox.min.css" />

<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/lalit-base.min.css?ver=1.10.3" media="all" />
<?php
if (isMobile()) {
?>
	<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/stylesheets/css/mobile-nav.min.css?ver=1.11" media="all" />
<?php
}
?>

<?php
if (ENV == 'production') {
?>
	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o), m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-11443455-1', {
			'name': 'newTracker',
			'allowLinker': true
		});
		ga('newTracker.require', 'linker');
		ga('newTracker.linker:autoLink', ['gc.synxis.com,myhotelreservation.net']);
		ga('newTracker.send', 'pageview');
	</script>
	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-49165825-1', 'auto');
		ga('send', 'pageview');
	</script>
<?php
}
?>