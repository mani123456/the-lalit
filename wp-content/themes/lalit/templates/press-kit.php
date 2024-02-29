<?php
/**
 *
  Template Name: Press Kit Template
 *
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Paper_Plane
 * @since PaperPlane 1.0
 */

$position = 1;
$itemList = [];
$itemList[0]['@type'] = 'ListItem';
$itemList[0]['position'] = $position;
$itemList[0]['item']['@id'] = site_url().'/';
$itemList[0]['item']['name'] = 'Home';

$itemList[1]['@type'] = 'ListItem';
$itemList[1]['position'] = $position + 1;
$itemList[1]['item']['@id'] = site_url().$_SERVER['REQUEST_URI'];
$itemList[1]['item']['name'] = get_the_title(get_the_id());
?>
<!DOCTYPE html>
<html>
    <head>
        <?php wp_head(); ?>
        <?php get_template_part('includes/css', 'js'); ?>
        <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": <?php echo json_encode($itemList); ?>
        }
        </script>
    </head>
    <body <?php body_class('global-page hide-sharing press-kit'); ?>>
        <div class="main-wrap">
        	<?php get_header(); ?>

        		<?php get_template_part( 'template-parts/press', 'kit' ); ?>

        	<?php get_footer(); ?>
        </div>
    </body>
</html>

<script>
    $(document).ready(function() { 
        var TxtType = function(el, toRotate, period) {
        var self = this;
        this.toRotate = toRotate;
        this.el = el;
        this.period = parseInt(period, 10) || 2000;
        this.initialize();       

        $(".replay-button").bind("click", $.proxy(function() {
            if (self.stopAnimation) {
                $(".replay-button").css("visibility", "hidden");
                self.initialize();
            }
        }, this));
    };

    TxtType.prototype.initialize = function() {
        this.loopNum = 0;
        this.txt = '';
        this.isDeleting = false;
        this.tick();
    }

    TxtType.prototype.tick = function() {
        this.textNumber = 0;
        var i = this.loopNum % this.toRotate.length,
        fullTxt = this.toRotate[i],
        self = this,
        delta = 215 - Math.random() * 100;
        $(".ico-check-without-circle, .ico-close-without-circle").removeClass("icon-show");
        $(".typewrite").removeClass("remove-cursor");

        this.stopAnimation = false;
        
        if (this.isDeleting) {
            if (this.loopNum % 2 == 1) {

            }
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }
        $(".wrap").text(this.txt);
        
        if (this.isDeleting) {
            delta /= 2;
        }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
            if (this.loopNum % 2 == 1) {
                delta = 3500;
                setTimeout(function() {
                    $(".ico-close-without-circle").removeClass("icon-show");
                    $(".ico-check-without-circle").addClass("icon-show");
                    $(".typewrite").addClass("remove-cursor");
                    $(".replay-button").css("visibility", "visible");
                }, 1500);
                this.stopAnimation = true;
            } else {
                delta = 3500;
                setTimeout(function() {
                    $(".ico-check-without-circle").removeClass("icon-show");
                    $(".typewrite").addClass("remove-cursor");
                    $(".ico-close-without-circle").addClass("icon-show");
                    
                }, 1500);
            }
        } else if (this.isDeleting) {
            if (this.loopNum % 2 == 0 && this.txt === "The") {
              $(".ico-check-without-circle").removeClass("icon-show");
                this.isDeleting = false;
                this.loopNum++;
                delta = 750;
            } else if (this.txt === "") {
                this.isDeleting = false;
                this.loopNum++;
                delta = 500;
            }
        }
        if (this.stopAnimation) {
            return;
        } else {
            myTimeout = setTimeout(function() {
                self.tick();
            }, delta);
        }
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i = 0; i < elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
                new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
    };
  })
</script>