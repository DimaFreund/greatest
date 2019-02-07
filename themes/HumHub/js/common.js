$(function() {
	// Custom JS

  // Sliders
  $('.front-top .base-img-slider').slick({
    // normal options...
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 500,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  function autosize(){
    var el = this;
    setTimeout(function(){
      el.style.cssText = 'height:auto; padding:0';
      // for box-sizing other than "content-box" use:
      // el.style.cssText = '-moz-box-sizing:content-box';
      el.style.cssText = 'height:' + el.scrollHeight + 'px';
    },0);
  }

  // Faq 
  $('.faq .anchors-info .info').click(function () {
    $(this).toggleClass('active');
    $(this).find('.desc').slideToggle();
  });

  // Smooth scroll for anchors
  // Select all links with hashes
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function(event) {
      // On-page links
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
        &&
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          // Only prevent default if animation is actually gonna happen
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000, function() {
            // Callback after animation
            // Must change focus!
            var $target = $(target);
            $target.focus();
            if ($target.is(":focus")) { // Checking if the target was focused
              return false;
            } else {
              $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
              $target.focus(); // Set focus again
            }
          });
        }
      }
    });

  // Input & label validation focus
  function addFocus() {
    var inputFocus = $('textarea, input[type="password"], input[type="text"], input[type="email"]');
    inputFocus.each(function () {
      $(this).focus(function () {
        $(this).parents('.form-item').addClass('focus');
      });
      $(this).focusout(function () {
        $(this).parents('.form-item').removeClass('focus');
      });

      if ($(this).val() == '') {
        $(this).parents('.form-item').removeClass('not-empty');
      } else {
        $(this).parents('.form-item').addClass('not-empty');
      }

      $(this).bind('change paste keyup', function () {
        if ($(this).val() == '') {
          $(this).parents().removeClass('not-empty');
        } else {
          $(this).parents('.form-item').addClass('not-empty');
        }
      });
    });
  }
  addFocus();

  // Slimmenu
  $('#navigation').slimmenu(
    {
      resizeWidth: '767',
      collapserTitle: '',
      animSpeed: 'medium',
      easingEffect: null,
      indentChildren: true,
      childrenIndenter: '&nbsp;'
    }
  );

  $('header .collapse-button').click(function () {
    $(this).toggleClass('active');
    $('.front-header .logo').toggleClass('show')
  });

  // scrollTop() >= 108
  // Should be equal the the height of the header
  $(window).scroll(function(){
    if ($(window).scrollTop() >= 1) {
      $('.front-header').addClass('fixed-header');
    }
    else {
      $('.front-header').removeClass('fixed-header');
    }
  });

  // Relocate link block on mobile header
  var linkBlock = $('header .link-block');
  if(window.matchMedia('(max-width: 767px)').matches) {
    $(linkBlock).appendTo('header #navigation');
  };

  $('.loginPopUp, .recoveryPassPopUp').magnificPopup({
      type: 'inline',
      preloader: false,
      // callbacks: {
      //     open: function() {
      //         $('body').css('overflow', 'hidden');
      //     },
      //     close: function () {
      //         $('body').css('overflow', 'visible')
      //     }
      // }
  });

  // If form has error it open form again
  var errItem = $('#login-form .form-item .has-error');
  if($(errItem).length) {
    $('.loginPopUp').click();
  }
  // Input tags
  $('input#tags').tagsinput();

  //////////////
  //PRIVATE PAGE SCRIPT
  //////////////
  var menuItem = $('.privHeader .activities-menu .item');
  menuItem.attr('tabIndex', 0);
  menuItem.children('.activity-icon').click(function () {
    menuItem.not($(this).parent()).removeClass('showSubMenu');
    $(this).parent().toggleClass('showSubMenu');
  });

  var openMenu = $();
  $(document).mouseup(function (e) {
    openMenu = $('.showSubMenu, .open-menu');
    if (!openMenu.is(e.target) && openMenu.has(e.target).length === 0 ) {
      openMenu.removeClass('showSubMenu open-menu');
    }
  });

  // Search autocomplete
  var options = {
    url: "../searchList.json",
    getValue: "name",

    list: {
      match: {
        enabled: true
      }
    },

    theme: "square"
  };
  $("#headerSearch").easyAutocomplete(options);

  // Desires cloud random position
  function getRandomPosition() {
    function getRandomVal(min, max, step) {
      return (step *Math.floor(Math.random() * (max - min + 1)/step)) + min;
    }

    $('.random-desires .random-desire').each(function (index) {
      var randomTop = getRandomVal(0, 90, 3);
      var randomLeft = getRandomVal(10, 90, 3);
      $(this).css({
        'top': randomTop + '%',
        'left': randomLeft + '%',
        'box-shadow': '0 0 21px rgba(0, 0, 0, 0.2)'
      });
      if (index === 0) {
        $(this).addClass('default-active');
      }
      if(randomLeft < 30) {
        $(this).removeClass('transformLeft transformRight');
        $(this).addClass('transformLeft');
      }
      if(randomLeft > 75) {
        $(this).removeClass('transformLeft transformRight');
        $(this).addClass('transformRight');
      }
    });

    $('.random-desire').mouseover(function () {
        $('.random-desires .default-active').removeClass('default-active');
    });

    $('.random-desire').mouseout(function () {
        $('.random-desire:first-child').addClass('default-active');
    });
  }
  $(window).on('load resize orientationchange', function () {
    if (window.matchMedia("(min-width: 993px)").matches) {
      getRandomPosition();
    } else if (!$('.random-desires').hasClass('slick-initialized')) {
      $('.random-desires').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true
      })
    }
  });

  function pageAjaxRefresh() {
    addFocus(); // add focus script to form item
    openMenu.removeClass('showSubMenu open-menu'); // close submenu

    $('select, #login-form input[type="checkbox"]').styler({
      // crop text on langSwitcher
      // onFormStyled: function () {
      //   var label = $('.lang-block .jq-selectbox__select-text');
      //   label.text(label.text().slice(0, 2));
      //   console.log('styled')
      // },
      // onSelectClosed: function() {
      //   if( $(this).is('.language-switcher') ) {
      //     var label = $(this).find('.jq-selectbox__select-text');
      //     label.text(label.text().slice(0, 2));
      //     console.log('closed')
      //   }
      // }
    });

    // Sidebar item state position
    var sidebarBlock =  $('.right-sidebar .item');
    // add tab state on localstorage
    $(sidebarBlock).each(function(i) {
      var itemId = $(this).attr('id');
      var storage = localStorage.getItem('sidebar-item-' + itemId);
      if (storage === 'true' && !$(this).hasClass('active')) {
        $(this).addClass('active');
        $(this).find('.item-content').slideToggle();
      }
    });
    $(sidebarBlock).find('.item-header .label')
      .unbind('click').bind('click', function () {
      $(this).parents('.item').toggleClass('active');
      $(this).parents('.item').find('.item-content').slideToggle();

      var sidebarItemId = $(this).parents('.item').attr('id');

      localStorage.removeItem('sidebar-item-' + sidebarItemId);
      localStorage.setItem('sidebar-item-' + sidebarItemId, $(this).parents('.item').hasClass('active'));
    });

    // Star rating
    var el = $(".star-rating");
    $(el).each(function () {
      var starVal = $(this).find('.starVal').text();

      $(this).starRating({
        totalStars: 5,
        initialRating: starVal,
        starSize: 25,
        readOnly: true
      });
    });

    $('.active-star-rating').starRating({
      totalStars: 5,
      initialRating: 0,
      disableAfterRate: false,
      useFullStars: true,
      callback: function(currentRating, $el){
        $.ajax({
          'type': 'POST',
          'url': '/index.php/rating/rating/add',
          'cache': false,
          'data': {'objectId': $($el).attr('data-id-desire'), 'rating': currentRating},
          'success': function (html) {
            console.log(html);
          }
        });
      }
    });

    // Show/hide map-block
    $('.map-btn').click(function () {
      $(this).parent().find('.map-block').slideToggle()
    });

    $('.context-menu-btn').unbind('click').bind('click', function () {
      $(this).parent().toggleClass('active-context-menu');
    });

    // Mobile
    var mobileBtn = $('.mobile-user-block .mobile-user-btn, ' +
      '.activities-menu .mobile-activities-btn,' +
      '.sidebar-mobile-block .logo-btn');
    $(mobileBtn).unbind('click').bind('click', function () {
      $(this).parent().toggleClass('open-menu');
    });

    $('.user-info-top-block .mobile-toggle-btn').unbind('click').bind('click', function () {
      $(this).parent().toggleClass('active-item');
      $(this).parent().find('.mobile-wrap, .mobile-desire-img').slideToggle();
    });
    $('.user-info-menu .top-menu ul').not('.slick-initialized').slick({
      mobileFirst: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: false,
      responsive: [
        {
          breakpoint: 320,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 360,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 500,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 992,
          settings: 'unslick'
        }
      ]
    });
    $('.group-top-block .top-menu ul').not('.slick-initialized').slick({
      mobileFirst: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
      responsive: [
        {
          breakpoint: 320,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 500,
          settings: 'unslick'
        }
      ]
    });
  }
  pageAjaxRefresh();

  $('#layout-content').on('pjax:success', function() {
    pageAjaxRefresh();
    getRandomPosition();
  });

  $(document).on('humhub:stream:afterLoadEntries',function() {
    pageAjaxRefresh();
  });

  $( "#datepicker" ).datepicker({
    dateFormat: "yy-mm-dd"
  });

  //Avatar-menu toggle btn state
  $('.group-menu li, .base-post .like').click(function () {
    $(this).toggleClass('active-item');
  });

  // Tags cloud module
  (function tagCloud() {
    var tagBlock = $("#all-tags, #all-footer-tags");

    $(tagBlock).awesomeCloud({
      "size" : {
        "<a href='https://www.jqueryscript.net/tags.php?/grid/'>grid</a>" : 16, // word spacing, smaller is more tightly packed
        "factor" : 0, // font resize factor, 0 means automatic
        "normalize" : false // reduces outliers for more attractive output
      },
      "color" : {
        "background" : "rgba(255,255,255,0)", // background color, transparent by default
        "start" : "#ffe1b5", // color of the smallest font, if options.color = "gradient""
        "end" : "#ffb74d" // color of the largest font, if options.color = "gradient"
      },
      "options" : {
        "color" : "gradient", // random-light, random-dark, gradient
        "rotationRatio" : 0.35, // 0 is all horizontal, 1 is all vertical
        "printMultiplier" : 3, // set to 3 for nice printer output; higher numbers take longer
        "sort" : "random" // highest, lowest or random
      },
      "font" : "'Roboto', sans-serif", //  the CSS font-family string
      "shape" : "square" // circle, square, star or a theta function describing a shape
    });
  })();
});
