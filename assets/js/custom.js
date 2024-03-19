function owl_sliders(){
    jQuery('.sliding-menu').owlCarousel({
        nav: true,
        items: 2,
        dots: false,
    });

    jQuery('.tabwrapper-carousel').owlCarousel({
        nav: true,
        items: 2,
        dots: false,
        //autoWidth: true,
    });
    
    
}
jQuery(document).ready(function($) { 
    $(".ContentImageBlock").next(".ContentImageBlock").css("padding-top", "0");
    //img responsive
    $('img').addClass('img-fluid');

    // hide #back-top first
    $(".scrollToTop").hide();

    // fade in #back-top
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('.scrollToTop').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    $('.mega-dropdown-lists li a').mouseenter(function () {
        $(this).parent('li').find('.product-detail').show();
        $(this).parents('li.mega-dropdown-items').addClass('active');
	});
    $('.mega-dropdown-lists li a').mouseleave(function () {
        $(this).parent('li').find('.product-detail').hide();
        $(this).parents('li.mega-dropdown-items').removeClass('active');
    });


	if ($(window).width() < 991) {
    //   $('.header-menu').appendTo('.navbar-collapse');
      $('.header-menu').prependTo('.menu-secondary-menu-container');
      $('.inner-header-wrapper').find('div.header-logo').parent('div.col-lg-4').addClass('header-logo-wrapper');
	} 
     
    $('.main-toggler').on("click", function (e) {
        $('.main-dropdown').toggle();
        e.stopPropagation();
        e.preventDefault();
    });

    $('body').on("click", ".parent-toggler", function (e) {
        var copy_text = $(this).text();
        $(this).parent().find('ul').prepend('<li class="fl-main-btn"><span class="back-btn">' + copy_text + '</span></li>');
        $(this).parent('.inner-dropdown-submenu').find('ul.multi-dropdown-menu').show();
        $('.main-toggler').text(copy_text);
        $(this).hide();
  
    });


    $('body').on("click", ".back-btn", function (e) {
        $(this).parents('.inner-dropdown-submenu').find('ul.multi-dropdown-menu').hide();
        $(this).parents('li.inner-dropdown-submenu').find('.parent-toggler').show();
        $('.fl-main-btn').remove();

    });

    /* --------------------------------------------------------
      Animate numbers
      -----------------------------------------------------------*/
    jQuery('.numerical-container').appear(function () {
        var target = $(this).find('div.value');
        var toAnimate = $(this).find('div.value').attr('data-value');
        // Animate the element's value from x to y:
        $({ someValue: 0 }).animate({ someValue: toAnimate }, {
            duration: 1500,
            easing: 'swing', // can be anything
            step: function () { // called on every step
                // Update the element's text with rounded-up value:
                target.text(commaSeparateNumber(Math.round(this.someValue)));
            }
        });

        function commaSeparateNumber(val) {
            while (/(\d+)(\d{3})/.test(val.toString())) {
                val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            }
            return val;
        }
    });
    //sliding-menu
    
	if (jQuery(window).width() < 991) {
    	owl_sliders();
    }else{
        $('.sliding-menu').trigger('destroy.owl.carousel');
        $('.tabwrapper-carousel').trigger('destroy.owl.carousel');
    }

    // for mobile read more toggler
    $('body').on('click', '.fl-mb-read-more .btn', function () {
        $(this).parent('div.fl-mb-read-more').find('p:not(:first-child)').slideToggle();
        $(this).parent('div.fl-mb-read-more').toggleClass('open-readmore');
    });

    $('.fl-mb-read-more').each(function () {
        $(this).find('p').length;
        if ($(this).find('p').length == 1) {
            $(this).find('.btn').hide();
        }
    });
    $('.header-wrapper').scrollToFixed();
    
    $('p:not([role])').each(function() {
        var $this = $(this);
        if ($this.html().replace(/\s|&nbsp;/g, '').length == 0)
            $this.remove();
    });
    $('.ui-slider-handle').draggable();

    $('select.form-control').on('change', function () {
        $(this).addClass('active');
    })

    $('.navbar .navbar-nav li a.dropdown-toggle').click(function(){
        $(this).toggleClass('open');
    });

  
    var $container = $('.mega-dropdown-menu');
    if ($container.length) {
        $(document).bind('mouseup touchend', function (e) {
            if (!$container.is(e.target) // if the target of the click isn't the container...
                &&
                $container.has(e.target).length === 0) // ... nor a descendant of the container
            {
                $('a.dropdown-toggle').removeClass('open');
            }
        });
    }



    //menu masonary
    // $('.dropdown-menu').addClass('show').css('opacity','0');
    // var menuMasonary = window.menuMasonary || {},
    //     $win = $(window);
    // menuMasonary.Isotope = function () {
    //     // 3 column layout
    //     var isotopeContainer2 = $('.mega-dropdown-menu > ul');
    //     if (!isotopeContainer2.length || !jQuery().isotope) return;
    //     // $win.load(function () {
    //             isotopeContainer2.isotope({
    //                 itemSelector: '.dropdown-submenu'
    //             });
    //         $('.dropdown-menu').removeClass('show').css('opacity', '1');
    //     // });
    // };
    // menuMasonary.Isotope();

    jQuery(".service-touch-experts .container").css("padding-left", jQuery(".footer .container").offset().left + 15);

    // $(".dynamictext-msg input").each(function () {
    //     var $txtarea = $("<textarea />");
    //     $txtarea.attr("id", this.id);
    //     // $txtarea.attr("rows", 8);
    //     // $txtarea.attr("cols", 60);
    //     $txtarea.val(this.value);
    //     $(this).replaceWith($txtarea);
    // });

	jQuery(window).resize();
	setTimeout(function() {
		jQuery(window).resize();
	}, 1500);
	setTimeout(function() {
		jQuery(window).resize();
	}, 3000);
});

jQuery(window).resize(function () {
    if (jQuery(window).width() < 991) {
        //   jQuery('.header-menu').appendTo('.navbar-collapse');
        jQuery('.header-menu').prependTo('.menu-secondary-menu-container');
        jQuery('.inner-header-wrapper').find('div.header-logo').parent('div.col-lg-4').addClass('header-logo-wrapper');
    }else{
        jQuery('.header-menu').appendTo('.header-menu-container');
    }
    jQuery(".service-touch-experts .container").css("padding-left", jQuery(".footer .container").offset().left + 10);
    

    if (jQuery(window).width() < 767) {
        owl_sliders();
        jQuery('.sliding-menu').addClass('owl-carousel owl-theme');
        jQuery('.tabwrapper-carousel').addClass('owl-carousel owl-theme');
        //console.log('class add');
    } else {
        jQuery('.sliding-menu').trigger('destroy.owl.carousel');
        jQuery('.tabwrapper-carousel').trigger('destroy.owl.carousel');
    }
});



