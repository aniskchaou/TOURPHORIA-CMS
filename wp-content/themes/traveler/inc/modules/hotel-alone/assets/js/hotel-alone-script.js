(function ($) {
    "use strict";
    $('.topbar  .top-bar-style-2 .room_book').click(function () {
        $(this).closest('.option-item').find('.form-search-position-right').toggleClass('active');
    });
    $('.topbar  .top-bar-style-1 .btn-book').click(function () {
        $(this).closest('.option-item').find('.form-search-position-left').toggleClass('active');
    });
    $('.topbar  .top-bar-style-1 .btn-close').click(function () {
        $(this).closest('.option-item').find('.form-search-position-left').toggleClass('active');
    });
    $('.topbar  .top-bar-style-4 .btn-book').click(function () {
        $(this).closest('.option-item').find('.form-search-position-left').toggleClass('active');
    });
    $('.topbar  .top-bar-style-4 .btn-close').click(function () {
        $(this).closest('.option-item').find('.form-search-position-left').toggleClass('active');
    });
    $('.wpbooking-search-form-wrap .helios-options-number .fa-angle-up').click(function () {
        var parent = $(this).closest('.item-search-content');
        var value  = parent.find('.helios-number').val();
        value      = parseInt(value) + 1;
        if (value >= 100) {
            value = 99;
        }
        parent.find('.helios-number').val(value).trigger('change');

        //for single room
        var name      = parent.find('.helios-number').attr('name');
        var form_book = $(this).closest('.wpbooking-search-form-wrap');
        form_book.find('.form_book_' + name).val(value).trigger('change');
    });
    $('.wpbooking-search-form-wrap .helios-options-number .fa-angle-down').click(function () {
        var parent = $(this).closest('.item-search-content');
        var value  = parent.find('.helios-number').val();
        value      = parseInt(value) - 1;
        var min    = parent.find('.helios-number').attr('min');
        min        = parseInt(min);
        if (value <= min) {
            value = min;
        }
        parent.find('.helios-number').val(value).trigger('change');

        //for single room
        var name      = parent.find('.helios-number').attr('name');
        var form_book = $(this).closest('.wpbooking-search-form-wrap');
        form_book.find('.form_book_' + name).val(value);

    });

    $('.wpbooking-search-form-wrap').each(function () {
        var start = $(this).find('.wpbooking-date-start');
        var end   = $(this).find('.wpbooking-date-end');
        setTimeout(function () {
            start.trigger('change');
            end.trigger('change');
        }, 200);
    });
    $('.wpbooking-search-form-wrap .options').click(function () {
        $(this).closest('.date-group').find('.wpbooking-check-in-out').trigger('click');
    });
    $('.wpbooking-search-form-wrap .wpbooking-date-start').change(function () {
        var parent = $(this).closest('.item-search-content');
        var day    = parent.find('.checkin_d').val();
        var month  = parent.find('.checkin_m').val();
        var year   = parent.find('.checkin_y').val();
        parent.find('.day').html(pad(day));
        parent.find('.month span').html(number_to_monteh(pad(month)));

        var form_book = $(this).closest('.wpbooking-search-form-wrap');
        form_book.find('.form_book_checkin_d').val(day);
        form_book.find('.form_book_checkin_m').val(month);
        form_book.find('.form_book_checkin_y').val(year);
    });
    $('.wpbooking-search-form-wrap .wpbooking-date-end').change(function () {
        var parent = $(this).closest('.item-search-content');
        var day    = parent.find('.checkout_d').val();
        var month  = parent.find('.checkout_m').val();
        var year   = parent.find('.checkout_y').val();
        parent.find('.day').html(pad(day));
        parent.find('.month span').html(number_to_monteh(pad(month)));

        var form_book = $(this).closest('.wpbooking-search-form-wrap');
        form_book.find('.form_book_checkout_d').val(day);
        form_book.find('.form_book_checkout_m').val(month);
        form_book.find('.form_book_checkout_y').val(year);
    });
    function number_to_monteh(number) {
        switch (number) {
            case"01":
                return hotel_alone_params.month_1;
                break;
            case"02":
                return hotel_alone_params.month_2;
                break;
            case"03":
                return hotel_alone_params.month_3;
                break;
            case"04":
                return hotel_alone_params.month_4;
                break;
            case"05":
                return hotel_alone_params.month_5;
                break;
            case"06":
                return hotel_alone_params.month_6;
                break;
            case"07":
                return hotel_alone_params.month_7;
                break;
            case"08":
                return hotel_alone_params.month_8;
                break;
            case"09":
                return hotel_alone_params.month_9;
                break;
            case"10":
                return hotel_alone_params.month_10;
                break;
            case"11":
                return hotel_alone_params.month_11;
                break;
            case"12":
                return hotel_alone_params.month_12;
                break;
        }
    }
    function pad(d) {
        d = parseInt(d);
        return (d < 10) ? '0' + d.toString() : d.toString();
    }
    $('.wpbooking-search-form-wrap').each(function () {
        var check_in     = $(this).find('.wpbooking-date-start');
        var check_out    = $(this).find('.wpbooking-date-end');
        var check_in_out = $(this).find('.wpbooking-check-in-out');
        var date_group   = $(this).find('.date-group');
        var customClass  = check_in_out.data('custom-class');

        check_in_out.daterangepicker({
                singleDatePicker: false,
                autoApply       : true,
                disabledPast    : true,
                dateFormat      : hotel_alone_params.dateformat,
                customClass     : customClass
            },
            function (start, end, label) {
                $('.checkin_d', date_group).val(start.format('DD'));
                $('.checkin_m', date_group).val(start.format('MM'));
                $('.checkin_y', date_group).val(start.format('YYYY'));
                check_in.val(start.format(hotel_alone_params.dateformat)).trigger('change');

                $('.checkout_d', date_group).val(end.format('DD'));
                $('.checkout_m', date_group).val(end.format('MM'));
                $('.checkout_y', date_group).val(end.format('YYYY'));
                check_out.val(end.format(hotel_alone_params.dateformat)).trigger('change');
            });
        check_in.focus(function () {
            check_in_out.trigger('click');
        });

        check_out.focus(function () {
            check_in_out.trigger('click');
        });
    });

    $(window).scroll(function () {
        var offset_top = $(window).scrollTop();
        if (offset_top > 200) {
            $('.topbar-scroll').addClass('active');

        } else {
            $('.topbar-scroll').removeClass('active');
        }
    });

    $('.helios_dl_mobile_menu').each(function () {
        //$(this).dlmenu({});
        $( this ).dlmenu({
            animationClasses : { classin : 'dl-animate-in-1', classout : 'dl-animate-out-1' }
        });
    });

    $('.header-mobile.sticky').each(function () {
        var hw            = $(window).height();
        var height_header = $(this).find('.helios-navbar-header').height();
        $(this).find('.dl-menu').css('max-height', hw - height_header);
        $(this).find('.dl-submenu').css('max-height', hw - height_header);
    });

    $('.st-client').each(function(){
        var item = 4;
        if($(this).data('item') != ''){
            item = $(this).data('item');
        }
        $(this).owlCarousel({
            animateOut: 'slideOutLeft',
            animateIn: 'slideInRight',
            items: parseInt(item),
            margin: 12,
            stagePadding: 12,
            smartSpeed: 450,
            loop: true,
            autoplay: false,
            autoplayTimeout: 9000,
            autoplayHoverPause: true,
            responsive: {

            }
        });
    });

    function st_set_full_height(element, more_height) {
        var ww         = $(window).width();
        var hw         = $(window).height();
        var h_adminbar = 0, h_topbar = 0, h_topbar_mobile = 0;
        if ($('#wpadminbar').length > 0) {
            h_adminbar = $('#wpadminbar').height();
        }

        if ($('.helios_main_content .header-mobile').length > 0) {
            h_topbar_mobile = $('.helios_main_content .header-mobile').height();
        }
        if (ww > 980) {
            hw = hw - h_topbar - h_adminbar + more_height;
        } else {
            hw = hw - h_adminbar - h_topbar_mobile;
        }
        if (ww < 980 && hw < 520) {
            hw = 520;
        }
        element.css({
            "height": hw + 'px'
        });
        return hw;
    }

    $(window).load(function () {
        ///////////////////////////
        //// ST Slider - Style 1 //
        ///////////////////////////
        $('.helios-slider.st-style-1').each(function () {
            var $this      = $(this);
            var $item      = $this.find('.content-slider .item');
            var $item_text = $this.find('.content-slider .content-info');
            setTimeout(function () {
                $item.css('width', '100%')
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
                var owl = $this.find('.content-slider .overlay-image').owlCarousel({
                    items          : 1,
                    loop           : true,
                    dots           : false,
                    responsiveClass: true,
                    animateOut     : 'fadeOut',
                    animateIn      : 'fadeIn',
                    autoplay       : true,
                    autoplayTimeout: 5000,
                    lazyLoad       : true
                });

                // Go to the next item
                $('.owl-next').click(function () {
                    owl.trigger('next.owl.carousel');
                })
                // Go to the previous item
                $('.owl-prev').click(function () {
                    // With optional speed parameter
                    // Parameters has to be in square bracket '[]'
                    owl.trigger('prev.owl.carousel');
                })
            }, 1000);
            $(window).resize(function () {
                var $item      = $this.find('.content-slider .item');
                var $item_text = $this.find('.content-slider .content-info');
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
            });
        });
        ///////////////////////////
        //// ST Slider - Style 3 //
        ///////////////////////////
        $('.helios-slider.st-style-3').each(function () {
            var $this      = $(this);
            var $item      = $this.find('.content-slider .item');
            var $item_text = $this.find('.content-slider .content-info');
            setTimeout(function () {
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
                var owl = $this.find('.content-slider .overlay-image').owlCarousel({
                    items          : 1,
                    loop           : true,
                    dots           : false,
                    responsiveClass: true,
                    animateOut     : 'fadeOut',
                    animateIn      : 'fadeIn',
                    autoplay       : true,
                    autoplayTimeout: 5000,
                    lazyLoad       : true
                });

                // Go to the next item
                $('.owl-next').click(function () {
                    owl.trigger('next.owl.carousel');
                })
                // Go to the previous item
                $('.owl-prev').click(function () {
                    // With optional speed parameter
                    // Parameters has to be in square bracket '[]'
                    owl.trigger('prev.owl.carousel');
                })
            }, 1000);


            $(window).resize(function () {
                var $item      = $this.find('.content-slider .item');
                var $item_text = $this.find('.content-slider .content-info');
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
            });
        });
        ///////////////////////////
        //// ST Slider - Style 2 //
        ///////////////////////////
        $('.helios-slider.st-style-2').each(function () {
            var $this      = $(this);
            var $item      = $this.find('.content-slider .item');
            var $item_text = $this.find('.content-slider .content-info');


            setTimeout(function () {
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
                var owl = $this.find('.content-slider .overlay-image').owlCarousel({
                    items          : 1,
                    loop           : true,
                    dots           : false,
                    responsiveClass: true,
                    animateOut     : 'fadeOut',
                    animateIn      : 'fadeIn',
                    autoplay       : true,
                    autoplayTimeout: 5000,
                    lazyLoad       : true
                });

                // Go to the next item
                $('.owl-next').click(function () {
                    owl.trigger('next.owl.carousel');
                })
                // Go to the previous item
                $('.owl-prev').click(function () {
                    // With optional speed parameter
                    // Parameters has to be in square bracket '[]'
                    owl.trigger('prev.owl.carousel');
                })
            }, 1000);


            $(window).resize(function () {
                var $item      = $this.find('.content-slider .item');
                var $item_text = $this.find('.content-slider .content-info');
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
            });
        });
        $('.st-post-carousel.style-1').each(function () {
            var item = 3;
            if ($(this).data('item') != '') {
                item = $(this).data('item');
            }
            $(this).owlCarousel({
                items: parseInt(item),
                loop: true,
                nav: true,
                navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        });

        $('.st-post-carousel.style-2').each(function () {
            var item = 3;
            if ($(this).data('item') != '') {
                item = $(this).data('item');
            }
            $(this).owlCarousel({
                items: parseInt(item),
                loop: true,
                nav: true,
                navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
            });
        });
    });

    $('.scroll-to').click(function (event) {
        event.preventDefault();
        var IDscrollTo = $(this).attr('href');
        var scrollTo   = $(IDscrollTo).offset().top - 150;
        if (scrollTo) {
            $('html,body').animate({
                scrollTop: scrollTo
            }, 'slow');
        }
    });

    $('.st-list-feature-hotel-room.style-2 .list-room').each(function () {
        var owl = $(this).owlCarousel({
            items          : 3,
            loop           : false,
            dots           : false,
            responsiveClass: true,
            animateOut     : 'fadeOut',
            animateIn      : 'fadeIn',
            autoplay       : true,
            autoplayTimeout: 5000,
            lazyLoad       : true,
            nav            : true,
            navText        : ['<i class="fa fa-long-arrow-left""></i>', '<i class="fa fa-long-arrow-right"></i>'],
            responsive     : {
                0   : {
                    items: 1
                },
                980 : {
                    items: 1
                },
                1024: {
                    items: 2
                },
                1200: {
                    items: 2
                },
                1366: {
                    items: 3
                }
            },
        });
    });

    $('.st-list-feature-hotel-room.style-3 .caurolselWrapRoom').each(function () {
        var parent = $(this).closest('.style-3');
        var $this  = $(this);
        setTimeout(function () {
            var owl = $this.owlCarousel({
                items : 1,
                loop  : false,
                margin: 0,
                nav   : false,
                dots  : false
            });
            parent.find('.ButtonDiscover').click(function () {
                owl.trigger('prev.owl.carousel', [300]);
            })
            parent.find('.ButtonNextsDiscover').click(function () {
                owl.trigger('next.owl.carousel');
            });
        }, 500);
    });

    $('.st-list-feature-hotel-room.style-1').each(function () {
        var parent = $(this).closest('.style-1');
        var $this  = $(this);
        $this.find('.listRoom .Room').first().addClass('active');
        $this.find('.detailRoom .item').first().addClass('active');

        $this.find('.listRoom .Room').click(function () {
            $this.find('.listRoom .Room').removeClass('active');
            $(this).addClass('active');
            var item_id = $(this).data('id')
            $this.find('.detailRoom .item').removeClass('active');
            $this.find('.detailRoom .item.item_' + item_id).addClass('active');
        });
    });

    $(".st-testimonials.style-1").each(function() {
        var dots = false, nav = false, nav_text = '';
        if($(this).data('dots') == '1'){
            dots = true;
        }
        if($(this).data('nav') == '1'){
            nav = true;
            nav_text = ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"];
        }
        $(this).owlCarousel({
            animateOut: 'slideOutLeft',
            animateIn: 'flipInX',
            items: 1,
            margin: 100,
            stagePadding: 100,
            smartSpeed: 450,
            loop: false,
            autoplay: true,
            autoplayTimeout: 9000,
            autoplayHoverPause: true,
            dots: dots,
            nav: nav,
            navText: nav_text,
            responsive: {
                0: {
                    margin: 0,
                    stagePadding: 0
                },
                480: {
                    margin: 0,
                    stagePadding: 0
                },
                768: {
                    margin: 0,
                    stagePadding: 0
                },
                992: {
                    margin: 100,
                    stagePadding: 100
                }
            }
        });
    });
    $(".st-testimonials.style-2").each(function() {
        var dots = false, nav = false, nav_text = '';
        if($(this).data('dots') == '1'){
            dots = true;
        }
        if($(this).data('nav') == '1'){
            nav = true;
            nav_text = ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"];
        }
        $(this).owlCarousel({
            animateOut: 'slideOutLeft',
            animateIn: 'slideInRight',
            items: 3,
            margin: 30,
            stagePadding: 30,
            smartSpeed: 450,
            loop: true,
            autoplay: true,
            autoplayTimeout: 9000,
            autoplayHoverPause: true,
            dots: dots,
            nav: nav,
            navText: nav_text,
            responsive: {
                0: {
                    margin: 0,
                    stagePadding: 0,
                    items: 1
                },
                480: {
                    margin: 0,
                    stagePadding: 0,
                    items: 1
                },
                768: {
                    margin: 10,
                    stagePadding: 10,
                    items: 2
                },
                992: {
                    margin: 50,
                    stagePadding: 30,
                    items: 3
                }
            }
        });
    });

    $('.special-services-carousel').each(function(){
        $(this).owlCarousel({
            items: 3,
            loop: false,
            nav: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    });

    function isotope_init(el){
        var $masonry = el.isotope({

            itemSelector: '.grid-item',
            layoutMode: 'masonry'
        });
        $('.isotope-filter').find('.filter').on( 'click', function() {
            $('.isotope-filter').find('.filter').removeClass('active');
            $(this).addClass('active');
            var filterValue = $(this).attr('data-filter');
            if(filterValue == 'all') {
                $masonry.isotope({filter: '*'});
            }else {
                $masonry.isotope({filter: filterValue});
            }
        });
    }

    $(window).load(function() {

        $('.st-banner-single-room.st-style-1').each(function () {
            var $this      = $(this);
            var $item      = $this.find('.content-slider .item');
            var $item_text = $this.find('.content-slider .content-info');
            setTimeout(function () {
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
                var owl = $this.find('.content-slider .overlay-image').owlCarousel({
                    items          : 1,
                    loop           : true,
                    dots           : false,
                    responsiveClass: true,
                    animateOut     : 'fadeOut',
                    animateIn      : 'fadeIn',
                    autoplay       : true,
                    autoplayTimeout: 5000,
                });

                // Go to the next item
                $('.owl-next').click(function () {
                    owl.trigger('next.owl.carousel');
                })
                // Go to the previous item
                $('.owl-prev').click(function () {
                    // With optional speed parameter
                    // Parameters has to be in square bracket '[]'
                    owl.trigger('prev.owl.carousel');
                })
            }, 1000);
            $(window).resize(function () {
                var $item      = $this.find('.content-slider .item');
                var $item_text = $this.find('.content-slider .content-info');
                st_set_full_height($item, 0);
                st_set_full_height($item_text, 0);
            });
        });

        $('.st-gallery-slider').owlCarousel({
            items: 1,
            loop: true,
            autoplay: false,
            nav: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
        });

        if (typeof $('.post-isotope').isotope == 'function') {

            $('.post-isotope').each(function () {
                isotope_init($(this));
            });

            $('#load_more_post').click(function (e) {
                e.preventDefault();
                var element = $(this);
                var posts_per_page = element.attr('data-posts-per-page');
                var paged = element.attr('data-paged');
                var order = element.attr('data-order');
                var order_by = element.attr('data-order-by');
                var tax_query = element.attr('data-tax-query');
                var max_num_page = element.attr('data-max-num-page');
                var style = element.attr('data-style');
                var text_str = element.attr('data-text');
                var index = element.attr('data-index');
                var text_obj = $.parseJSON(text_str);
                var $container = $('.post-isotope');
                isotope_init($container);
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                        'action': "st_hotel_alone_load_more_post",
                        'posts_per_page': posts_per_page,
                        'paged': paged,
                        'order': order,
                        'order_by': order_by,
                        'tax_query': tax_query,
                        'max_num_page': max_num_page,
                        'style': style,
                        'index': index
                    },
                    dataType: "json",
                    beforeSend: function () {
                        element.html(text_obj.loading);
                    },
                    complete: function (res) {

                        $('<div>' + res.responseJSON.html + '</div>').find('.grid-item').each(function () {
                            $container.append($(this)).isotope('appended', $(this));
                        });

                        $container.imagesLoaded(function () {
                            isotope_init($container);
                            $('.st-gallery-slider').owlCarousel({
                                items: 1,
                                loop: true,
                                autoplay: false,
                                nav: true,
                                navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
                            });
                        });
                        $container.animate({scrollTop: $container.prop("scrollHeight")}, 500);
                        element.attr('data-paged', res.responseJSON.paged);
                        element.attr('data-index', res.responseJSON.index);
                        if (res.responseJSON.paged == element.attr('data-max-num-page')) {
                            element.html(text_obj.no_more);
                            element.addClass('disabled');
                        } else {
                            element.html(text_obj.load_more);
                        }
                    }
                });
            });
        }
        if(typeof $('.slider-for').slick == 'function') {

            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                autoplay: true,
            });
        }

        if (typeof $('.player').YTPlayer === 'function') {
            $('.btn-play-video').click(function (e) {
                e.preventDefault();
                if(typeof player == 'undefined'){
                    var player = jQuery(".player").YTPlayer({align:"center,left"});
                }
                var t = $(this);
                if (t.hasClass('play')) {
                    player.playYTP();
                    t.removeClass('play')
                } else {
                    player.pauseYTP();
                    t.addClass('play')
                }
            });
        }
        $('.st_full_height').each(function () {
            st_set_full_height($(this), 0);
        });
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', '.helios-reservation-content .loop-room .btn_extra', function () {
        var parent     = $(this).closest('.loop-room');
        var $extra     = parent.find('.list-extra');
        var $btn_extra = parent.find('.btn_extra');
        if ($extra.hasClass('active')) {
            $extra.removeClass('active');
            $btn_extra.removeClass('active');
        } else {
            $extra.addClass('active');
            $btn_extra.addClass('active');
        }
        return false;
    });

    $('.st-form-reservation-room .helios-btn-do-search-room').click(function () {
        var searchbox       = $(this).closest('.st-form-reservation-room');
        var style_list_room = $('.helios-reservation-content').data('style');
        if (style_list_room.length > 0) {
            searchbox.find("input[name=helios-style]").val(style_list_room);
        }
        searchbox.find('.wpbooking_paged').val('1');
        do_search_room(searchbox, false);
    });

    $(document).on('click', '.helios-reservation-content .pagination-room a', function () {
        var paged = $(this).data('page');
        $('.st-form-reservation-room .wpbooking_paged').val(paged);
        var searchbox = $('.st-form-reservation-room');
        var style_list_room = $('.helios-reservation-content').data('style');
        if (style_list_room.length > 0) {
            searchbox.find("input[name=helios-style]").val(style_list_room);
        }
        do_search_room(searchbox, false);
    });


    function do_search_room(searchbox, is_validate) {
        var parent = $('.helios-reservation-content');
        var data   = {
            'nonce': searchbox.find('input[name=room_search]').val()
        };
        if (typeof searchbox != "undefined") {
            data               = searchbox.find('input,select,textarea').serializeArray();
            var data_form_book = searchbox.find('input[type=text],select,textarea').serializeArray();
            for (var i = 0; i < data_form_book.length; i++) {
                parent.find('.form_book_' + data_form_book[i].name).val(data_form_book[i].value);
            }
        }
        var dataobj = {};
        for (var i = 0; i < data.length; i++) {
            dataobj[data[i].name] = data[i].value;
        }
        var holder = $('.search_room_alert_new');
        holder.html('');
        searchbox.find('.form-control').removeClass('error');
        if (searchbox.hasClass('loading')) {
            alert('Still loading');
            return;
        }
        searchbox.addClass('loading');
        searchbox.find('.helios-btn-do-search-room').addClass('loading');
        parent.addClass('loading');
        var content_list_room       = parent.find('.content-loop-room');
        var content_search_room     = parent.find('.content-search-room');
        var content_pagination_room = parent.find('.pagination-room');
        $.ajax({
            'type'    : 'post',
            'dataType': 'json',
            'data'    : data,
            'url'     : st_params.ajax_url,
            'success' : function (data) {
                searchbox.removeClass('loading');
                parent.removeClass('loading');
                searchbox.find('.helios-btn-do-search-room').removeClass('loading');
                content_pagination_room.html('');
                if (data.status) {
                    if (typeof data.data != "undefined" && data.data) {
                        content_list_room.html(data.data);
                        content_search_room.show();
                        content_search_room.find('.wpbooking_order_form').removeClass('no_date');
                        content_pagination_room.html(data.pagination);
                    } else {
                        content_list_room.html('');
                        content_search_room.hide();
                    }
                }
                if (data.message) {
                    var status = 'danger';
                    if (typeof data.status_message != "undefined" && data.status_message) {
                        status = data.status_message;
                    }
                    setMessage(holder, data.message, status);
                    content_list_room.html('');
                    content_search_room.hide();
                }
                if (data.status && data.status == 2) {
                    var status = 'danger';
                    if (typeof data.status_message != "undefined" && data.status_message) {
                        status = data.status_message;
                    }
                    setMessage(holder, data.message, status);
                    if (typeof data.data != "undefined" && data.data) {
                        content_list_room.html(data.data);
                        content_search_room.show();
                        content_search_room.find('.wpbooking_order_form').addClass('no_date');

                    } else {
                        content_list_room.html('');
                        content_search_room.hide();
                    }
                }
                $('[data-toggle="tooltip"]').tooltip();
                $('.content-search-room .content-loop-room .loop-room .option_number_room').trigger('change');
                $('.st-summary-booking-price .btn_html_book_now').removeAttr('disabled').removeClass('disabled');
            },
            error     : function (data) {
                searchbox.removeClass('loading');
                parent.removeClass('loading');
                searchbox.find('.helios-btn-do-search-room').removeClass('loading');
            }
        })
    }

    function setMessage(holder, message, type) {
        if (typeof type == 'undefined') {
            type = 'infomation';
        }
        var html = '<div class="alert alert-' + type + '">' + message + '</div>';
        if (!holder.length) return;
        holder.html('');
        holder.html(html);
        do_scrollTo(holder);
    }

    function do_scrollTo(el) {
        if (el.length) {
            var top = el.offset().top;
            if ($('#wpadminbar').length && $('#wpadminbar').css('position') == 'fixed') {
                top -= 32;
            }
            top -= 450;
            $('html,body').animate({
                'scrollTop': top
            }, 500);
        }
    }

    /* Function book now direct on list room */
    var old_order_id = !1;
    $(document).on('click', '.hotel-alone-booking-inpage .btn-hotel-alone-st-add-cart', function () {
        var me = $(this);
        var sform = me.closest('.hotel-alone-booking-inpage');
        var data = [];
        var holder = $('.form-message', sform);
        me.addClass('loading');

        if($('.option_number_room', sform).val() == '-1'){
            setMessage(holder, hotel_alone_params.room_required, 'danger')
            me.removeClass('loading');
            return false;
        }

        var data1 = sform.serializeArray();
        for (var i = 0; i < data1.length; i++) {
            data.push({name: data1[i].name, value: data1[i].value})
        }
        data.push({name: 'action', value: 'st_add_to_cart'});
        var dataobj = {};
        for (var i = 0; i < data.length; ++i) {
            dataobj[data[i].name] = data[i].value
        }

        holder.html('');
        $.ajax({
            'type': 'post', 'dataType': 'json', 'url': st_params.ajax_url, 'data': dataobj, 'success': function (data) {
                me.removeClass('loading');
                if (data.message) {
                    setMessage(holder, data.message, 'danger')
                }
                if (data.status) {
                    $.magnificPopup.open({
                        items: {type: 'inline', src: me.data('target')}, close: function () {
                            old_order_id = !1
                        }
                    });
                    get_cart_detail(me.data('target'))
                }
                if($('.i-check').length || $('.i-radio').length) {
                    $('.i-radio, .i-check').iCheck({
                        checkboxClass: 'i-check',
                        radioClass: 'i-radio'
                    });
                }
            }, error: function (data) {
                me.removeClass('loading')
            }
        })
    });

    function get_cart_detail(dom) {
        var dom_div = dom + " " + " .booking-item-payment";
        var me = $(dom_div);
        me.find('.overlay-form').show();
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': st_params.ajax_url,
            'data': {action: 'modal_get_cart_detail'},
            success: function (result) {
                me.html(result);
                me.find('.overlay-form').hide();
            },
            error: function (data) {
                me.find('.overlay-form').hide();
            }
        })
    }
    /* End function book now direct on list room */

    $('.st-form-booking-room .btn_extra').click(function () {
        var parent = $(this).closest('.st-form-booking-room');
        var $extra = parent.find('.list-extra');
        $extra.toggleClass('active');
    });

    $('.hotel-alone-booking-now').click(function (e) {
        e.preventDefault();
        var me = $(this);
        var sform = me.closest('form');
        var check_in_d = $('.form_book_checkin_d', sform).val();
        var check_in_m = $('.form_book_checkin_m', sform).val();
        var check_in_y = $('.form_book_checkin_y', sform).val();

        var check_in_string = check_in_y + '-' + check_in_m + '-' + check_in_d;

        var check_in =  moment(check_in_string).format(hotel_alone_params.dateformat);
        $('.form_book_check_in', sform).val(check_in);

        var check_out_d = $('.form_book_checkout_d', sform).val();
        var check_out_m = $('.form_book_checkout_m', sform).val();
        var check_out_y = $('.form_book_checkout_y', sform).val();

        var check_out_string = check_out_y + '-' + check_out_m + '-' + check_out_d;

        var check_out =  moment(check_out_string).format(hotel_alone_params.dateformat);
        $('.form_book_check_out', sform).val(check_out);

        var data = sform.serializeArray();

        var holder = $('.search_room_alert');
        holder.html('');
        me.addClass('loading');
        $.ajax({
            'type': 'post', 'dataType': 'json', 'url': st_params.ajax_url, 'data': data, 'success': function (data) {
                console.log(data);
                me.removeClass('loading');
                if (data.message) {
                    setMessage(holder, data.message, 'danger')
                }
                if (data.status) {
                    var cartLink = hotel_alone_params.add_to_cart_link;
                    window.location.href = cartLink;
                }
            }, error: function (data) {
                me.removeClass('loading')
            }
        })
    });

    $(document).on('click', '.btn-hotel-alone-booking', function (e) {
        e.preventDefault();
        var me = $(this);
        var parent = me.closest('.item-room');
        var messageDiv = $('.form-message', parent);
        var sform = me.closest('form');

        messageDiv.html('');

        me.addClass('loading');

        if($('.option_number_room', sform).val() == '-1'){
            messageDiv.html('<div class="alert alert-danger">' + hotel_alone_params.room_required + '</div>');
            me.removeClass('loading');
            return;
        }

        var data = sform.serializeArray();

        $.ajax({
            'type': 'post', 'dataType': 'json', 'url': st_params.ajax_url, 'data': data, 'success': function (data) {
                console.log(data);
                me.removeClass('loading');
                if (data.message) {
                    setMessage(messageDiv, data.message, 'danger')
                }
                if (data.status) {
                    var cartLink = hotel_alone_params.add_to_cart_link;
                    window.location.href = cartLink;
                }
            }, error: function (data) {
                me.removeClass('loading')
            }
        })

    })
})(jQuery);