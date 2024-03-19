jQuery(document).ready(function ($) {
    var url = window.location.href;
    $('.innerpagemenu li a[href="' + url + '"]').addClass('active');
});

jQuery(function ($) {
    //banner slider
    $('#testimonials').owlCarousel({
        nav: true,
        //loop:true,
        //margin: 25,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        items: 1,
        dots: false,
        navText: ['<img src=' + finlease_url.URL + '/images/prev.svg>', '<img src=' + finlease_url.URL + '/images/next.svg>'],

    });

    $('.latest-news-carousel').owlCarousel({
        nav: false,
        //loop:true,
        margin: 24,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        items: 3,
        dots: false,
        responsive: {
            0: {
                items: 1,
                dots: true,
            },
            600: {
                items: 2,
                dots: true,
            },
            1200: {
                items: 3,
                nav: false,
                loop: false
            }
        }

    });

    $("img.svg").each(function () {
        //console.log('gdg');
        var $img = $(this);
        var imgID = $img.attr("id");
        var imgClass = $img.attr("class");
        var imgURL = $img.attr("src");
        $.get(
            imgURL,
            function (data) {
                // Get the SVG tag, ignore the rest
                var $svg = $(data).find("svg");
                // Add replaced image's ID to the new SVG
                if (typeof imgID !== "undefined") {
                    $svg = $svg.attr("id", imgID);
                }
                // Add replaced image's classes to the new SVG
                if (typeof imgClass !== "undefined") {
                    $svg = $svg.attr("class", imgClass + " replaced-svg");
                }
                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr("xmlns:a");
                // Replace image with new SVG
                $img.replaceWith($svg);
            },
            "xml"
        );
    });


    //Broker slider
    owl = $('.expert__wrapper');
    owl.owlCarousel({
        nav: false,
        margin: 4,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        dots: true,
        responsive: {
            0: {
                items: 1,
                dots: true,
                margin: 0,
                stagePadding: 15,
            },
            600: {
                items: 2,
                dots: true,
            },
            1024: {
                items: 3,
                dots: true,
            },
        }

    });


    //Brokers Filter 
    $('body').on('change', '#fl-broker-location', function (e) {
        e.preventDefault();
        $this = $(this);
        var location = $('#fl-broker-location :selected').val();
        var broker_num = $('#broker-num').val();
        var data_loc = {
            action: "finlease_broker_filter",
            location: location,
            broker_num: broker_num
        };
        $.ajax({
            type: "POST",
            url: finlease_url.ajaxurl,
            data: data_loc,
            beforeSend: function () {
                $("#loader").show();
                $("#broker-ajax").hide();
            },
            success: function (data) {
                var $data = $(data);
                if ($data.length) {
                    $("#broker-ajax").html($data);
                    $("#broker-ajax").show();
                    $("#loader").hide();

                    $('.expert__wrapper').owlCarousel('destroy');

                    owl = $('.expert__wrapper');
                    owl.owlCarousel({
                        nav: false,
                        margin: 4,
                        autoplay: false,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true,
                        dots: false,
                        responsive: {
                            0: {
                                items: 1,
                                dots: true,
                                margin: 0,
                                stagePadding: 15,
                            },
                            600: {
                                items: 2,
                                dots: true,
                            },
                            1024: {
                                items: 3,
                                dots: false,
                            },

                            // 1400: {
                            //     items: 2,
                            //     dots: false,
                            //     stagePadding: 200,
                            // },
                        }

                    });

                    if ($('.expert__wrapper').hasClass('owl-hidden'))
                        $('.expert__wrapper').removeClass('owl-hidden');
                } else {
                    $("#loader").hide();
                    var html = "<li class='no-result'>No Brokers found</li>";
                    $("#broker-ajax").html(html);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });

    });

    /**
     * Blog page Ajax
     */
    var page = 1;
    $("body").on("click", ".fl-blog-term", function (e) {
        e.preventDefault();
        $(".fl-blog-term").removeClass("selected-term");
        $(this).addClass("selected-term");
        var term = $(this).data("slug"),
            sort_val = $("#fl-blog-sort :selected").val();
        finlease_blog_filter(sort_val, term);
    });

    $("body").on("change", "#fl-blog-sort", function (e) {
        e.preventDefault();
        var sort_val = $("#fl-blog-sort :selected").val(),
            term = $(".selected-term").data("slug");
        finlease_blog_filter(sort_val, term);
    });

    function finlease_blog_filter(sort, term) {
        var nonce = $(".filter-section").attr("data-nonce"),
            data = {
                action: "finlease_blog_posts",
                sort: sort,
                term: term,
                nonce: nonce,
                page: 1,
            }

        $.ajax({
            url: finlease_url.ajaxurl,
            data: data,
            type: "post",
            beforeSend: function () {
                $("#loader").show();
                $("#fl-blog-posts").hide();
                $("#fl-blog-btn").remove();
            },
            success: function (data) {
                page = 1;
                var $data = $(data);
                $("#fl-blog-posts").html($data);
                $("#fl-blog-posts").show();
                $("#loader").hide();
                // $("#fl-blog-btn").remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    }

    $("body").on("click", "#fl-blog-more", function (e) {
        e.preventDefault();
        page++;
        var nonce = $(this).attr("data-nonce"),
            currentOffset = $(this).attr("data-offset"),
            term = $(".selected-term").data("slug"),
            sort_val = $("#fl-blog-sort :selected").val(),
            data = {
                action: "finlease_blog_posts",
                currentOffset: currentOffset,
                page: page,
                term: term,
                sort: sort_val,
                nonce: nonce,
            }

        $.ajax({
            url: finlease_url.ajaxurl,
            data: data,
            type: "post",
            beforeSend: function () {
                $("#loader").show();
                $("#fl-blog-btn").remove();
            },
            success: function (data) {
                var $data = $(data);
                $("#fl-blog-posts").append($data);
                $("#loader").hide();
                // $("#fl-blog-btn").remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

    /**Brokers load */
    $('body').on('click', '.fl-broker', function (e) {
        e.preventDefault();
        var state = this.hash.substr(1),
            term_id = $(this).attr("data-id"),
            nonce = $(this).attr("data-nonce"),
            data = {
                action: "finlease_brokers",
                state: state,
                term_id: term_id,
                nonce: nonce,
            };
        $.ajax({
            url: finlease_url.ajaxurl,
            data: data,
            type: "post",
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (data) {
                var $data = $(data);
                $("#myTabContent").html($data);
                $("#loader").hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

    var page_title = $('h1').first().text();
    $('#display-page-title').html('<strong>' + page_title + '</strong>');
    $('#cf-page-title').val(page_title);

    var blocktitle = $('.remove-finance');

    for (var x = 0; x < blocktitle.length; x++) {
        var ee = blocktitle[x].innerHTML;
        var yy = ee.replace('Finance', '');
        var xx = yy.replace('Equipment', '');
        blocktitle[x].innerHTML = xx;

    }


    // NEW Brokers Filter

    $(function () {
        $('#new-form').change(function () {
            $('.expert__wrapper .owl-item, .expert__wrapper .owl-dots').hide();
            var child = $('.' + $(this).val());
            child.parent().show();
        });
    });


    // SELECT2

    $("#new-form").select2({
        minimumResultsForSearch: -1,
        placeholder: "Select location"
    });

    $("#fl-broker-location").select2({
        minimumResultsForSearch: -1,
        placeholder: "Select location"
    });
    $("#quote-type").select2({
        minimumResultsForSearch: -1,
        placeholder: "Type of Asset"
    });
    /*
    $(".js-programmatic-enable").on("click", function () {
      $(".js-example-disabled").prop("disabled", false);
      $(".js-example-disabled-multi").prop("disabled", false);
    });

    $(".js-programmatic-disable").on("click", function () {
      $(".js-example-disabled").prop("disabled", true);
      $(".js-example-disabled-multi").prop("disabled", true);
    });
    */

    /* Contact Form 7 */
    document.addEventListener('wpcf7mailsent', function (event) {
        if (event.detail.contactFormId == 626) {
            window.location = finlease_url.siteurl + '/fast-track/thank-you/';
        } else if (event.detail.contactFormId == 1893) {
            window.location = finlease_url.siteurl + '/equipment-finance-calculator/thank-you-equipment/';

            dataLayer.push({
                event: 'emailQuote',
                Type: "Equipment Finance"
            });
        } else if (event.detail.contactFormId == 1889) {
            window.location = finlease_url.siteurl + '/boat-loan-repayment-calculator/thank-you-boat/';

            dataLayer.push({
                event: 'emailQuote',
                Type: "Boat Finance"
            });
        } else if (event.detail.contactFormId == 1891) {
            window.location = finlease_url.siteurl + '/car-loan-repayment-calculator/thank-you-car/';

            dataLayer.push({
                event: 'emailQuote',
                Type: "Car Finance"
            });
        } else if (event.detail.contactFormId == 1897) {
            window.location = finlease_url.siteurl + '/truck-finance-calculator/thank-you-truck/';

            dataLayer.push({
                event: 'emailQuote',
                Type: "Truck Finance"
            });
        } else if (event.detail.contactFormId == 1895) {
            window.location = finlease_url.siteurl + '/mortgage-repayment-calculator/thank-you-mortgage/';

            dataLayer.push({
                event: 'emailQuote',
                Type: "Mortgage Finance"
            });
        } else if (event.detail.contactFormId == 681) {
            var inputs = event.detail.inputs,
                quote_type = '';
            for (var i = 0; i < inputs.length; i++) {
                if ('quote-first-menu' == inputs[i].name) {
                    var quote_type = inputs[i].value;
                }
            }

            dataLayer.push({
                event: 'requestQuote',
                Type: quote_type
            });

            window.location = finlease_url.siteurl + '/get-a-quote/thank-you-quote/';
        } else if (event.detail.contactFormId == 2268) {
            var inputs = event.detail.inputs,
                quote_type = '';
            for (var i = 0; i < inputs.length; i++) {
                if ('quote-first-menu' == inputs[i].name) {
                    var quote_type = inputs[i].value;
                }
            }

            dataLayer.push({
                event: 'requestQuote',
                Type: quote_type
            });

            window.location = finlease_url.siteurl + '/contact/thank-you-contact/';
        } else if (event.detail.contactFormId == 659) {
            dataLayer.push({
                event: 'emailQuote'
            });
        } else if (event.detail.contactFormId == 657) {
            dataLayer.push({
                event: 'emailQuote'
            });
        } else if (event.detail.contactFormId == 1478 || event.detail.contactFormId == 3666) {
            dataLayer.push({
                event: 'emailQuote'
            });
        } else if (event.detail.contactFormId == 1481 || event.detail.contactFormId == 3667) {
            dataLayer.push({
                event: 'emailQuote'
            });
        } else if (event.detail.contactFormId == 1484) {
            dataLayer.push({
                event: 'emailQuote'
            });
        }
    }, false);


    // Landing Page
    if ($('.landing-page').length) {
        // Making tabs toggles, not links
        $('.landing-page .finlease--calculator--tab .nav-link').click(function (e) {
            e.preventDefault();

            var target = $(this).data('tab');

            $('.landing-page .finlease--calculator--tab .tab-pane').removeClass('show active');
            $('#' + target).addClass('show active');

            $('.landing-page .finlease--calculator--tab .nav-link').removeClass('active')
            $(this).addClass('active');
        });
        $('.landing-page .finlease--calculator--tab .nav-link').first().click();

        // Forcing new name on tab heading, thank you Brendelle...
        $('.landing-page #Car-tab').text('Cars & Vans');

        // Stripping reviews from iframe to use custom style
        var wait_for_reviews = setInterval(function () {
            var $html = $('.product-review-section iframe').contents().find('.css-1du9rlh').html();

            if ($html !== undefined) {
                var $reviews = $('.product-review-section .reviews');

                $reviews.html($html);
                $reviews.owlCarousel({
                    nav: true,
                    autoplay: false,
                    items: 3,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        767: {
                            items: 2,
                        },
                        991: {
                            items: 3,
                        }
                    }
                });

                $('.product-review-section .productreviewwidget').remove();
                clearInterval(wait_for_reviews);
            }
        }, 200);

        // Stopping waiting for reviews in case it is still active after 10 seconds
        setTimeout(function () {
            clearInterval(wait_for_reviews);
        }, 10000);

        // Intro mini form
        $('.landing-page .intro .page.page-1').append('<button class="btn btn--red--dust btn--big next">Next</button>');
        $('.landing-page .intro .page.page-2').append('<button type="button" class="btn btn--big btn--transparent back">< Back</button>');

        function form_page(num) {
            $('.form-pagination .dot').removeClass('active');
            $('.form-pagination .dot[data-page=' + num + ']').addClass('active');

            if (num == 2) {
                $('.pages').addClass('moved');
            } else {
                $('.pages').removeClass('moved');
            }
        }

        $('.landing-page .intro .page .next').click(function (e) {
            e.preventDefault();
            form_page(2);
        });
        $('.landing-page .intro .page .back').click(function (e) {
            e.preventDefault();
            form_page(1);
        });

        $('.landing-page .intro .form-pagination .dot').click(function (e) {
            e.preventDefault();

            var page = $(this).data('page');
            form_page(page);
        });

        // Calculator form text
        $('.landing-page .calculator__output .wpcf7-submit').val('Email Quote');

        // Redirecting forms to thank you page
        document.addEventListener('wpcf7mailsent', function (event) {
            var redirectFormIDs = [1481, 3667, 1478, 3666, 3149];
            if (redirectFormIDs.includes(event.detail.contactFormId)) {
                window.location = finlease_url.siteurl + '/500-thank-you/';
            } else if(event.detail.contactFormId == 3693){
                //new shared landing form for equipment
                window.location = window.location.href.split(/[?#]/)[0]  + '/thank-you/';
            }
        });
    }
});

jQuery(document).ready(function($) {
    if ($('#reviews').length) {
        $.get('https://api.productreview.com.au/api/services/rich-snippet/v1/0ba1c1c6-2869-31f7-9d5a-87dbe1b0bf5c', function( data ) {
            if ( data.average_rating_value && data.number_of_reviews ) {
                $('#reviews .average-rating-value').text(data.average_rating_value);
                $('#reviews .number-of-reviews').text(data.number_of_reviews);
                $('#reviews .stars').empty();
                for (var i = 0;i<Math.round(data.average_rating_value);i++) {
                    $('#reviews .stars').append('<span></span>');
                }
            }
        });
    }
});