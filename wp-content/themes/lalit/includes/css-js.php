<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/themes/lalit/images/favicon.ico">
<?php
if (ENV == 'production') {
?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-EWK8QKXNS1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-EWK8QKXNS1');
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
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-11443455-1', 'auto', {
      'allowLinker': true
    });
    ga('require', 'linker');
    ga('linker:autoLink', ['synxis.com']);
    //ga('send', 'pageview');
  </script>

  <!-- Global site tag (gtag.js) - Google Ads: 1034065160 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-1034065160"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-1034065160');
  </script>

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5DW2X4B');
  </script>
  <!-- End Google Tag Manager -->

  <!-- Global site tag (gtag.js) - Google Ads: 945704429 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-945704429"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-945704429');
  </script>


  <!-- microsoft clarity code -->

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-M5J8TVK');
  </script>
  <!-- End Google Tag Manager -->


  

    <!-- <script type="text/javascript">
    (function(c,l,a,r,i,t,y){

        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};

        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;

        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);

    })(window, document, "clarity", "script", "dmh9c1rm56");

</script>
 -->



    <!--script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Hotel",
        "name": "The LaLiT",
        "image": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
        "@id": "",
        "url": "https://www.thelalit.com/",
        "telephone": "1800 11 77 11",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Barakhamba Avenue, Connaught Place",
          "addressLocality": "New Delhi",
          "postalCode": "110001",
          "addressCountry": "IN"
        },
        "openingHoursSpecification": {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
          ],
          "opens": "00:00",
          "closes": "23:59"
        },
        "sameAs": [
          "https://www.facebook.com/TheLalitGroup/",
          "https://twitter.com/TheLalitGroup",
          "https://www.instagram.com/thelalitgroup/",
          "https://www.youtube.com/c/TheLalitGroup",
          "https://www.linkedin.com/company/thelalitgroup/"
        ]
      }
    </script-->
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "The LaLiT Group",
        "alternateName": "Bharat Hotels Limited",
        "url": "https://www.thelalit.com/",
        "logo": "https://www.thelalit.com/wp-content/themes/lalit/images/head-logo.png",
        "sameAs": [
          "http://www.facebook.com/TheLaLitGroup",
          "http://twitter.com/TheLalitGroup",
          "http://instagram.com/thelalitgroup",
          "https://www.youtube.com/lalithotels",
          "https://www.linkedin.com/company/thelalitgroup"
        ]
      }
    </script>



  <?php
}
  ?>