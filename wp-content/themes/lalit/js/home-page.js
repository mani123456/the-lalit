function applyOrientation() {
  ismobile &&
    (window.innerHeight > window.innerWidth
      ? jQuery("#pick-destination").find(".colZero").hasClass("selected")
        ? jQuery("#pick-destination").find(".colZero.selected").css({
            width: "100%",
            display: "block",
          })
        : jQuery("#pick-destination").find(".colZero").css({
            width: "100%",
            display: "block",
          })
      : jQuery("#pick-destination").find(".colZero").hasClass("selected")
      ? jQuery("#pick-destination").find(".colZero.selected").css({
          width: "auto",
          display: "inline-block",
        })
      : jQuery("#pick-destination").find(".colZero").css({
          width: "auto",
          display: "inline-block",
        }));
}
!(function (e) {
  "use strict";
  function i(i, t) {
    (this.opts = e.extend(
      {
        handleWheel: !0,
        handleScrollbar: !0,
        handleKeys: !0,
        scrollEventKeys: [32, 33, 34, 35, 36, 37, 38, 39, 40],
      },
      t
    )),
      (this.$container = i),
      (this.$document = e(document)),
      (this.lockToScrollPos = [0, 0]),
      this.disable();
  }
  var t, s;
  (s = i.prototype),
    (s.disable = function () {
      var e = this;
      e.opts.handleWheel &&
        e.$container.on(
          "mousewheel.disablescroll DOMMouseScroll.disablescroll touchmove.disablescroll",
          e._handleWheel
        ),
        e.opts.handleScrollbar &&
          ((e.lockToScrollPos = [
            e.$container.scrollLeft(),
            e.$container.scrollTop(),
          ]),
          e.$container.on("scroll.disablescroll", function () {
            e._handleScrollbar.call(e);
          })),
        e.opts.handleKeys &&
          e.$document.on("keydown.disablescroll", function (i) {
            e._handleKeydown.call(e, i);
          });
    }),
    (s.undo = function () {
      var e = this;
      e.$container.off(".disablescroll"),
        e.opts.handleKeys && e.$document.off(".disablescroll");
    }),
    (s._handleWheel = function (e) {
      e.preventDefault();
    }),
    (s._handleScrollbar = function () {
      this.$container.scrollLeft(this.lockToScrollPos[0]),
        this.$container.scrollTop(this.lockToScrollPos[1]);
    }),
    (s._handleKeydown = function (e) {
      for (var i = 0; i < this.opts.scrollEventKeys.length; i++)
        if (e.keyCode === this.opts.scrollEventKeys[i])
          return void e.preventDefault();
    }),
    (e.fn.disablescroll = function (e) {
      !t && ("object" == typeof e || !e) && (t = new i(this, e)),
        t && void 0 === e ? t.disable() : t && t[e] && t[e].call(t);
    }),
    (window.UserScrollDisabler = i);
})(jQuery),
  ($.fn.inView = function () {
    var e = {};
    (e.top = $(window).scrollTop()), (e.bottom = e.top + $(window).height());
    var i = {};
    return (
      (i.top = this.offset().top),
      (i.bottom = i.top + this.outerHeight()),
      i.top <= e.bottom && i.bottom >= e.top
    );
  }),
  jQuery(function () {
    applyOrientation(),
      jQuery(".home-page-banner").find(".flex-direction-nav").hide(),
      /* jQuery("#at-lalit").find("img.image").hide(),
      jQuery("#award-services").find("img.image").hide(), */
      jQuery("img.js_image_load").hide(),
      /* (jQuery.fn.isInViewport = function () {
        var e = {};
        (e.top = $(window).scrollTop()),
          (e.bottom = e.top + $(window).height());
        var i = {};
        return (
          (i.top = this.offset().top),
          (i.bottom = i.top + this.outerHeight()),
          i.top <= e.bottom + 10 && i.bottom >= e.top
        );
      }), 
      navigator.userAgent.match(/iPad/i) ||
        jQuery(window).on("scroll", function () {
          $("#parallax").isInViewport() && $("#parallax").paroller();
        }),*/
      jQuery(".hotels-listing")
        .find(".hotel:visible:nth-child(4n+1)")
        .find(".hotels-block")
        .css("border-left", "0"),
      setTimeout(function () {
        jQuery(".home-page-banner")
          .find(".banner-images")
          .each(function (e) {
            jQuery(this).attr("src", banner_images[e]);
          });
      }, 5e3),
      /* setTimeout(function () {
        var e = [];
        jQuery(".first_banner").each(function (i) {
          var t = jQuery(this).find(".city").val(),
            s = jQuery(this).find(".country").val();
          e[i] = t + "," + s;
        });
        for (var i = "", t = 0; t < e.length; t++) i += '"' + e[t] + '",';
        i = i.replace(/(^,)|(,$)/g, "");
        var s = escape(
            "select item.condition, item.link from weather.forecast where woeid in (select woeid from geo.places(1) where text in(" +
              i +
              ")) and u='c'"
          ),
          r = "//query.yahooapis.com/v1/public/yql?q=" + s + "&format=json";
        jQuery.ajax({
          dataType: "json",
          type: "post",
          url: r,
          success: function (e) {
            var i = "javascript:void(0);";
            jQuery(".first_banner").each(function (t) {
              var s = jQuery(this),
                r = s.find(".city").val();
              if (e.query.results.channel[t].item) {
                var o = e.query.results.channel[t].item.condition;
                (i = e.query.results.channel[t].item.link),
                  s
                    .find(".wxIcon")
                    .css({
                      backgroundPosition: "-" + 61 * o.code + "px 0",
                    })
                    .attr({
                      title: o.text,
                    }),
                  s
                    .find(".wxIcon2")
                    .append('<i class="wi wi-weather-' + o.code + '"/></i>'),
                  s.find(".wxTemp").html(o.temp + "&deg;" + "c".toUpperCase()),
                  s.find(".wxIntro").html(r);
              }
            });
          },
        });
      }, 500), */
      jQuery(window)
        .on(
          "scroll",
          $.proxy(function () {
            if (
              jQuery("#at-lalit").inView() &&
              !jQuery("#at-lalit").hasClass("done")
            ) {
              var e = jQuery("#at-lalit").find("img.image").length - 1;
              jQuery("#at-lalit")
                .find("img.image")
                .each(function (i) {
                  if (
                    (jQuery(this).attr("src", at_lalit_images[i]),
                    jQuery(this).load(function () {
                      jQuery(this).fadeIn();
                    }),
                    e == i)
                  )
                    return (
                      jQuery("#at-lalit")
                        .find(".owl-carousel")
                        .owlCarousel({
                          autoplay: !1,
                          center: !0,
                          loop: !0,
                          nav: !0,
                          dots: !0,
                          responsiveClass: !0,
                          responsive: {
                            0: {
                              items: 1,
                              nav: !0,
                            },
                            768: {
                              items: 3,
                              nav: !1,
                            },
                          },
                        }),
                      jQuery("#at-lalit").addClass("done"),
                      jQuery("#at-lalit")
                        .find("img.image")
                        .each(function (e) {
                          jQuery(this).load(function () {
                            jQuery(this).fadeIn(600, function () {
                              jQuery(this)
                                .parent()
                                .parent()
                                .css("background-color", "transparent");
                            });
                          });
                        }),
                      !1
                    );
                });
            }
            if (
              jQuery("#lalit-loyalty-new").inView() &&
              !jQuery("#lalit-loyalty-new").hasClass("done")
            ) {
              var e = jQuery("#lalit-loyalty-new").find("img.image").length - 1;
              jQuery("#lalit-loyalty-new")
                .find("img.image")
                .each(function (i) {
                  if (
                    (jQuery(this).attr("src", lalit_loyalty_new_images[i]),
                    jQuery(this).load(function () {
                      jQuery(this).fadeIn();
                    }),
                    e == i)
                  )
                    return (
                      jQuery("#lalit-loyalty-new")
                        .find(".owl-carousel")
                        .owlCarousel({
                          autoplay: !1,
                          center: !0,
                          loop: !0,
                          nav: !0,
                          dots: !0,
                          responsiveClass: !0,
                          responsive: {
                            0: {
                              items: 1,
                              nav: !0,
                            },
                            768: {
                              items: 3,
                              nav: !1,
                            },
                          },
                        }),
                      jQuery("#lalit-loyalty-new").addClass("done"),
                      jQuery("#lalit-loyalty-new")
                        .find("img.image")
                        .each(function (e) {
                          jQuery(this).load(function () {
                            jQuery(this).fadeIn(600, function () {
                              jQuery(this)
                                .parent()
                                .parent()
                                .css("background-color", "transparent");
                            });
                          });
                        }),
                      !1
                    );
                });
            }
             /* if (
              $("#award-services").inView() &&
              !jQuery("#award-services").hasClass("done")
            ) {
              var i = jQuery("#award-services").find("img.image").length - 1;
              jQuery("#award-services")
                .find("img.image")
                .each(function (e) {
                  if ((jQuery(this).attr("src", service_images[e]), i == e))
                    return (
                      jQuery("#award-services")
                        .find(".owl-carousel")
                        .owlCarousel({
                          autoplay: !1,
                          center: !0,
                          loop: !0,
                          nav: !0,
                          dots: !0,
                          responsiveClass: !0,
                          responsive: {
                            0: {
                              items: 1,
                              nav: !0,
                            },
                            768: {
                              items: 3,
                              nav: !1,
                            },
                          },
                        }),
                      jQuery("#award-services").addClass("done"),
                      jQuery("#award-services")
                        .find("img.image")
                        .each(function (e) {
                          jQuery(this).load(function () {
                            jQuery(this).fadeIn(600, function () {
                              jQuery(this)
                                .parent()
                                .css("background-color", "transparent");
                            });
                          });
                        }),
                      !1
                    );
                });
            } */
            /* if (
              $("#popular-dest").inView() &&
              !jQuery("#popular-dest").hasClass("done")
            ) {
              var i = jQuery("#popular-dest").find("img.image").length - 1;
              jQuery("#popular-dest")
                .find("img.image")
                .each(function (e) {
                  if ((jQuery(this).attr("src", service_images[e]), i == e))
                    return (
                      jQuery("#popular-dest")
                        .find(".owl-carousel-dest")
                        .owlCarousel({
                          autoplay: !1,
                          center: !0,
                          loop: !0,
                          nav: !0,
                          dots: !0,
                          responsiveClass: !0,
                          responsive: {
                            0: {
                              items: 1,
                              nav: !0,
                            },
                            768: {
                              items: 3,
                              nav: !1,
                            },
                          },
                        }),
                      jQuery("#popular-dest").addClass("done"),
                      jQuery("#popular-dest")
                        .find("img.image")
                        .each(function (e) {
                          jQuery(this).load(function () {
                            jQuery(this).fadeIn(600, function () {
                              jQuery(this)
                                .parent()
                                .css("background-color", "transparent");
                            });
                          });
                        }),
                      !1
                    );
                });
            } */
            jQuery(".view-port-detect").each(
              $.proxy(function (e, i) {
                if ($(i).inView()) {
                  var t = $(i).find(".js_image_load").length,
                    s = 0,
                    r = 0,
                    o = 0;
                  $(i)
                    .find(".js_image_load")
                    .each(
                      $.proxy(function (e, i) {
                        if ($(i).hasClass("image-tag")) {
                          var n = $(i).attr("data-src");
                          $(i).attr("src", n),
                            $(i).load(function () {
                              $(i).fadeIn(600, function () {
                                return (
                                  s++,
                                  t == s &&
                                    ((s = 0),
                                    $(i)
                                      .closest(".background-color")
                                      .css("background-color", "transparent")),
                                  !0
                                );
                              });
                            });
                        } else if ($(i).hasClass("background")) {
                          if (!$(i).hasClass("done")) {
                            var n = $(i).attr("data-src"),
                              a = $(i).attr("data-url");
                            0 == $(i).find(".img").length &&
                              $(i).append(
                                "<img src='" +
                                  a +
                                  "' class='img' style='display:none;' /> "
                              ),
                              $(i)
                                .find(".img")
                                .load(function () {
                                  $(i).attr("style", n),
                                    r++,
                                    $(i).find(".img").remove(),
                                    $(i).addClass("done"),
                                    t == r &&
                                      ((r = 0),
                                      $(i).hasClass("background-color")
                                        ? $(i).css(
                                            "background-color",
                                            "transparent"
                                          )
                                        : $(i)
                                            .closest(".background-color")
                                            .css(
                                              "background-color",
                                              "transparent"
                                            ));
                                });
                          }
                        } else if (
                          $(i).hasClass("background-image") &&
                          !$(i).hasClass("done")
                        ) {
                          var n = $(i).attr("data-src"),
                            a = $(i).attr("data-url");
                          0 == $(i).find(".img").length &&
                            $(i).append(
                              "<img src='" +
                                a +
                                "' class='img' style='display:none;' /> "
                            ),
                            $(i)
                              .find(".img")
                              .load(function () {
                                $(i).css(
                                  "background-image",
                                  "url('" + a + "')"
                                ),
                                  o++,
                                  $(i).find(".img").remove(),
                                  $(i).addClass("done"),
                                  t == r &&
                                    ((r = 0),
                                    $(i).hasClass("background-color")
                                      ? $(i).css(
                                          "background-color",
                                          "transparent"
                                        )
                                      : $(i)
                                          .closest(".background-color")
                                          .css(
                                            "background-color",
                                            "transparent"
                                          ));
                              });
                        }
                      }, this)
                    );
                }
              }, this)
            );
          }, this)
        )
        .scroll(),
      jQuery(".view_more_dining").on("click", function () {
        jQuery(".gastronomy-listing-sec")
          .find(".gastronomy-listing.more")
          .slideDown(),
          jQuery(this).hide(),
          jQuery(".view_less_dining").show();
      }),
      jQuery(".view_less_dining").on("click", function () {
        jQuery(".gastronomy-listing-sec")
          .find(".gastronomy-listing.more")
          .slideUp(),
          jQuery(this).hide(),
          jQuery(".view_more_dining").show();
      }),
      ismobile || is_iPad
        ? jQuery("body").on("touchstart", ".filter-list", function () {
            jQuery(this).find(".list").show();
          })
        : jQuery(".filter-box")
            .find(".filter-list")
            .hover(
              function () {
                jQuery(this).find(".list").show();
              },
              function () {
                jQuery(this).find(".list").hide();
              }
            ),
      jQuery(".filter-list .list")
        .find(".list-item")
        .on("click", function () {
          if (
            (jQuery(".filter-list.active").removeClass("active"),
            ismobile &&
              jQuery(".hotels-listing").find(".hotel").removeClass("selected"),
            !jQuery(this).hasClass("active"))
          ) {
            jQuery(".hotels-listing")
              .find(".hotel .hotels-block")
              .removeAttr("style"),
              jQuery(".filter-list .list")
                .find(".list-item.active")
                .removeClass("active"),
              jQuery(this).addClass("active");
            var e = jQuery(this).find("a").attr("href"),
              i = jQuery(this).text();
            return (
              "all" == e
                ? ("interests" == jQuery(this).parent().attr("id")
                    ? jQuery(".filter-list #types")
                        .parents(".filter-item")
                        .find("a.selected_value")
                        .html(
                          'Type <i class="ico-sprite sprite ico-gre-down-arrow"></i>'
                        )
                    : jQuery(".filter-list #interests")
                        .parents(".filter-item")
                        .find("a.selected_value")
                        .html(
                          'Interest <i class="ico-sprite sprite ico-gre-down-arrow"></i>'
                        ),
                  jQuery(this)
                    .parents(".filter-item")
                    .find("a.selected_value")
                    .html(
                      i +
                        ' <i class="ico-sprite sprite ico-gre-down-arrow"></i>'
                    ),
                  ismobile
                    ? (jQuery(".hotels-listing")
                        .find(".hotel")
                        .addClass("selected"),
                      applyOrientation())
                    : jQuery(".hotels-listing").find(".hotel").show(),
                  jQuery(".hotels-listing")
                    .find(".hotel:visible:first")
                    .find(".hotels-block")
                    .css("border-left", "0"),
                  jQuery(this).parent().hide(),
                  jQuery(this).closest(".filter-list").removeClass("active"))
                : ("interests" == jQuery(this).parent().attr("id")
                    ? jQuery(".filter-list #types")
                        .parents(".filter-item")
                        .find("a.selected_value")
                        .html(
                          'Type <i class="ico-sprite sprite ico-gre-down-arrow"></i>'
                        )
                    : jQuery(".filter-list #interests")
                        .parents(".filter-item")
                        .find("a.selected_value")
                        .html(
                          'Interest <i class="ico-sprite sprite ico-gre-down-arrow"></i>'
                        ),
                  jQuery(this)
                    .parents(".filter-item")
                    .find("a.selected_value")
                    .html(
                      i +
                        ' <i class="ico-sprite sprite ico-gre-down-arrow"></i>'
                    ),
                  jQuery(".hotels-listing").find(".hotel").hide(),
                  ismobile
                    ? (jQuery(".hotels-listing")
                        .find("." + e)
                        .parent()
                        .addClass("selected"),
                      applyOrientation())
                    : jQuery(".hotels-listing")
                        .find("." + e)
                        .parent()
                        .show(),
                  jQuery(".hotels-listing")
                    .find(".hotel:visible:first")
                    .find(".hotels-block")
                    .css("border-left", "0"),
                  jQuery(this).parent().hide(),
                  jQuery(this).closest(".filter-list").addClass("active")),
              jQuery(".hotels-listing")
                .find(".hotel:visible")
                .find(".hotels-block")
                .each(function (e) {
                  e % 4 == 0 && jQuery(this).css("border-left", "0");
                }),
              0 ==
                jQuery(".hotels-listing").find(".hotels-block:visible")
                  .length &&
                (jQuery(".hotels-listing").find(".no_data").remove(),
                jQuery(".hotels-listing").append(
                  "<div class='no_data'>No Hotels Found</div>"
                )),
              !1
            );
          }
          return !1;
        }),
      jQuery(".main-banner").find(".video-thumb").length &&
        ((elementClass = ""),
        ismobile || is_iPad
          ? (elementClass = ".videoBannerWrap")
          : (elementClass = ".video-play-btn"),
        jQuery(elementClass).on("click", function () {
          var e = jQuery(window).height(),
            i = jQuery(window).width() + 16;
          if ((jQuery(".flexslider").flexslider("pause"), ismobile || is_iPad))
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".fullVideo iframe")
              .height(jQuery(this).closest(".videoBannerWrap").height()),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".fullVideo iframe")
                .width(jQuery(window).width()),
              jQuery(this)
                .closest(".videoBannerWrap")
                .width(jQuery(window).width());
          else {
            jQuery("body, html").css({
              overflow: "hidden",
            }),
              jQuery(document).off("keydown"),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".fullVideo iframe")
                .height(e),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".fullVideo iframe")
                .width(i),
              jQuery(this).closest(".videoBannerWrap").width(i);
            var t = jQuery(this)
              .closest(".videoBannerWrap")
              .find(".fullVideo")
              .offset().top;
            jQuery("html, body").animate(
              {
                scrollTop: t,
              },
              "slow",
              function () {
                jQuery(window).disablescroll();
              }
            );
          }
          jQuery(this)
            .closest(".videoBannerWrap")
            .find(".fullVideo iframe")
            .css({
              overflow: "hidden",
            }),
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".bannerVideo")
              .removeClass("overflowAuto"),
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".bannerVideo")
              .addClass("overflowHidden");
          var s = jQuery(this)
            .closest(".videoBannerWrap")
            .find(".fullVideo")
            .find("iframe")
            .attr("data");
          if (
            (jQuery(this)
              .closest(".videoBannerWrap")
              .find(".fullVideo")
              .find("iframe")
              .attr("src", s),
            jQuery(this).closest(".videoBannerWrap").find(".fullVideo").show(),
            ismobile || is_iPad)
          ) {
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".bannerVideo")
              .hide();
            var r = jQuery(this)
              .closest(".videoBannerWrap")
              .find(".yahoo")
              .attr("href");
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".yahoo")
              .attr("data-href", r),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".yahoo")
                .attr("href", "javascript(0);"),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".fullVideo")
                .show();
          } else
            jQuery("header").slideUp("slow"),
              jQuery(".booking-widget.h-align-widget").hide(),
              jQuery(".icon-social").fadeOut(),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".fullVideo")
                .animate(
                  {
                    height: "auto",
                  },
                  200,
                  function () {
                    jQuery(".global-page .content-section").css(
                      "padding-top",
                      "0"
                    ),
                      jQuery(this)
                        .closest(".videoBannerWrap")
                        .find(".fullVideo")
                        .fadeIn();
                  }
                ),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".bannerVideo")
                .slideUp(300, function () {
                  jQuery(this).css("padding", 0);
                });
          jQuery(".flex-direction-nav a, .flex-control-nav a").hide(),
            (ismobile || is_iPad) &&
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".closeVideo")
                .addClass("forMobile");
        }),
        jQuery(".closeVideo").on("touchstart click", function () {
          if (
            (jQuery("body, html").css({
              overflow: "",
            }),
            ismobile ||
              is_iPad ||
              (jQuery("header").show(),
              jQuery(".booking-widget.h-align-widget").show(),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".bannerVideo")
                .hide(200, function () {
                  jQuery(".global-page .content-section").css(
                    "padding-top",
                    jQuery(".sticy-nav").height() + "px"
                  ),
                    jQuery(this)
                      .closest(".videoBannerWrap")
                      .find(".fullVideo")
                      .find("iframe")
                      .attr("src", ""),
                    jQuery(this)
                      .closest(".videoBannerWrap")
                      .removeAttr("style"),
                    jQuery(this)
                      .closest(".videoBannerWrap")
                      .find(".fullVideo")
                      .hide();
                }),
              jQuery(window).disablescroll("undo")),
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".bannerVideo")
              .show(),
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".bannerVideo")
              .removeClass("overflowHidden"),
            jQuery(".icon-social").fadeIn(),
            ismobile || is_iPad)
          ) {
            jQuery(this).closest(".videoBannerWrap").find(".fullVideo").hide(),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".fullVideo")
                .find("iframe")
                .attr("src", ""),
              jQuery(this).closest(".videoBannerWrap").removeAttr("style");
            var e = jQuery(this)
              .closest(".videoBannerWrap")
              .find(".yahoo")
              .attr("data-href");
            jQuery(this)
              .closest(".videoBannerWrap")
              .find(".yahoo")
              .removeAttr("data-href"),
              jQuery(this)
                .closest(".videoBannerWrap")
                .find(".yahoo")
                .attr("href", e);
          }
          return (
            jQuery(".flexslider").flexslider("play"),
            jQuery(".flex-direction-nav a, .flex-control-nav a").show(),
            !1
          );
        }));
  }),
  jQuery(window).bind("load", function () {
    jQuery(".home-page-banner").find(".flex-direction-nav").show();
  }),
  (window.onresize = function (e) {
    applyOrientation();
  });
