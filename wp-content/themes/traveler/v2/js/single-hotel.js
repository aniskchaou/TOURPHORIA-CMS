(function ($) {
    'use strict';
    window.extraServicesFunction = function(el){
        el.find('.item  .form-more-extra').each(function(){
            var t = $(this);
            t.find('.dropdown').click(function (e) {
                e.preventDefault();
                el.find('.item  .form-more-extra .extras').not(t.find('.extras')).hide();
                t.find('.extras').stop(true, true).slideToggle();
            })
        });

        if(el.find('.item  .form-more-extra').length){
            $(document).mouseup(function(e)
            {
                var container = el.find('.item  .form-more-extra .extras, .item  .form-more-extra .dropdown');
                if (!container.is(e.target) && container.has(e.target).length === 0)
                {
                    el.find('.item  .form-more-extra .extras').hide();
                }
            });
        }
    }

    if($('.vinhome-slider-wrapper').length > 0) {
        $('.vinhome-slider-wrapper').vinhomeSlider({
            effect: 'vinhome-slider-scale-transform',
            autoplay: true,
            interval: $(this).data('interval'),
            stopHover: true
        });
    }
})(jQuery);

jQuery(document).ready(function($) {
    if($('.main-slider.slider').length) {
        var heightSlider = $('.main-slider.slider').outerHeight();
        $('.st-bg-slider').fotorama({
            height: heightSlider
        });
    }

    /*Datepicker*/
    $('.item-search-content .options').click(function () {
        $(this).find('.wpbooking-check-in-out').trigger('click');
        $(this).closest('.template-hotel-activity_submit').find('.wpbooking-check-in-out').trigger('click');
    })

    $('.item-search-content .wpbooking-date-start').change(function () {
        var parent = $(this).closest('.item-search-content');
        var day    = parent.find('.checkin_d').val();
        var month  = parent.find('.checkin_m').val();
        var year   = parent.find('.checkin_y').val();
        parent.find('.day span').html(pad(day));
        parent.find('.month-year span').html(number_to_monteh(pad(month)) +", "+year);
    });


    $('.item-search-content .wpbooking-date-end').change(function () {
        var parent = $(this).closest('.item-search-content');
        var day    = parent.find('.checkout_d').val();
        var month  = parent.find('.checkout_m').val();
        var year   = parent.find('.checkout_y').val();
        parent.find('.day span').html(pad(day));
        parent.find('.month-year span').html(number_to_monteh(pad(month)) +", "+year);
    });
    /**
     * Date time picker in the check available section
     */

    $('.st-room-check-available .sts-date-start').change(function () {
        var parent = $(this).closest('.item');
        var day    = parent.find('.checkin_d').val();
        var month  = parent.find('.checkin_m').val();
        var year   = parent.find('.checkin_y').val();
        parent.find('.value').html(pad(day));
        parent.find('.sub-label').html(number_to_monteh(pad(month)) +", "+year);
    });


    $('.st-room-check-available .sts-date-end').change(function () {
        var parent = $(this).closest('.item');
        var day    = parent.find('.checkout_d').val();
        var month  = parent.find('.checkout_m').val();
        var year   = parent.find('.checkout_y').val();
        parent.find('.value').html(pad(day));
        parent.find('.sub-label').html(number_to_monteh(pad(month)) +", "+year);
    });

    $('.st-room-check-available').each(function () {
        var check_in     = $(this).find('.sts-date-start');
        var check_out    = $(this).find('.sts-date-end');
        var check_in_out = $(this).find('.sts-check-in-out');
        var date_group   = $(this).find('.item');

        date_group.find('.value, .sub-label').click(function () {
            $(this).closest('.sts-form-wrapper').find('.sts-check-in-out').trigger('click');
        });

        var dateToday = new Date();
        check_in_out.daterangepicker({
                singleDatePicker: false,
                autoApply       : true,
                disabledPast    : true,
                dateFormat      : hotel_alone_params.dateformat,
                minDate: dateToday,
                customClass         : '',
                widthSingle         : 500,

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
        $(this).find('.sts-date-end').focus(function () {
            check_in_out.trigger('click');
        });
        $(this).find('.sts-date-start').focus(function () {
            check_in_out.trigger('click');
        });
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

    $('.st-filter').each(function () {
        var check_in     = $(this).find('.wpbooking-date-start');
        var check_out    = $(this).find('.wpbooking-date-end');
        var check_in_out = $(this).find('.wpbooking-check-in-out');
        var date_group   = $(this).find('.item-search-content');
        var customClass  = check_in_out.data('custom-class');
        var dateToday = new Date();
        check_in_out.daterangepicker({
                singleDatePicker: false,
                autoApply       : true,
                disabledPast    : true,
                dateFormat      : hotel_alone_params.dateformat,
                customClass     : customClass,
                minDate: dateToday,
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
   

    /* Match Height Render */
    var body = $('body');
    if ($('.has-matchHeight', body).length) {
        $('.has-matchHeight', body).matchHeight();
    }
});

jQuery(function($){
    $(document).ready(function(){
        var body = $('body');
        $('.st-discover-slider').each(function () {
            $(this).owlCarousel({
                loop:true,
                items: 3,
                margin: 0,
                responsiveClass:true,
                navigation: true,
                responsive:{
                    0:{
                        items:1,
                    },
                    575:{
                        items:2,
                    },
                    992:{
                        items:3,
                    },
                    1200:{
                        items:3,
                    }
                }
            });
        });

        //Add to cart in list room page
        $(document).on('click', '.sts-room-wrapper .item .action .btn-booknow', function (e) {
            e.preventDefault();
            var t = $(this).closest('.sts-room-wrapper .item'),
                    messageBox = t.find('.action .message'),
                    loading = $(this).find('i');

            if(t.find('.action select').val() == ''){
                messageBox.text(hotel_alone_params.number_room_required).show();
                if ($('.has-matchHeight', body).length) {
                    $('.has-matchHeight', body).matchHeight();
                }
            }else{
                loading.css({display: 'inline-block'});
                messageBox.text('').hide();
                var data = t.find('.action form').serializeArray();
                $.ajax({
                    'type': 'post',
                    'dataType': 'json',
                    'url': hotel_alone_params.ajax_url,
                    'data': data,
                    success: function (data) {
                        loading.css({display: 'none'});
                        if (data.message) {
                            messageBox.text(data.message).show();
                        }
                        if (data.status) {
                            var cartLink = hotel_alone_params.add_to_cart_link;
                            window.location.href = cartLink;
                        }
                        if ($('.has-matchHeight', body).length) {
                            $('.has-matchHeight', body).matchHeight();
                        }
                    },
                    error: function (data) {
                        loading.css({display: 'none'});
                    }
                })
            }
        });

        //Check availability in single room
        $('.sts-booking-form .sts-single-room-check').click(function (e) {
            e.preventDefault();
            var t = $(this),
                sform = t.closest('form'),
                loading = t.find('i'),
                messageBox = sform.find('.message');

            loading.css({display: 'inline-block'});
            messageBox.text('').hide();

            var data = sform.serializeArray();

            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': hotel_alone_params.ajax_url,
                'data': data,
                success: function (data) {
                    loading.css({display: 'none'});
                    if (data.message) {
                        messageBox.text(data.message).show();
                    }
                    if (data.status) {
                        var cartLink = hotel_alone_params.add_to_cart_link;
                        window.location.href = cartLink;
                    }
                    if ($('.has-matchHeight', body).length) {
                        $('.has-matchHeight', body).matchHeight();
                    }
                },
                error: function (data) {
                    loading.css({display: 'none'});
                }
            })
        });

        if ($('.sts-popup').length) {
            $('.sts-popup').magnificPopup({
                removalDelay  : 500,
                closeBtnInside: true,
                callbacks     : {
                    beforeOpen: function () {
                        this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
                midClick      : true,
                closeMarkup: '<button title="Close (Esc)" type="button" class="mfp-close"></button>',
            });
        }

        if($('.sts-room-wrapper').length) {
            extraServicesFunction($('.sts-room-wrapper'));
        }
        if($('.sts-booking-form').length) {
            extraServicesFunction($('.sts-booking-form'));
        }

        // Availability
        $('.sts-booking-form .item.checkin-out', body).each(function () {
            var parent           = $(this),
                date_wrapper = $('.date-wrapper', parent),
                check_in_input   = $('.check-in-input', parent),
                check_out_input  = $('.check-out-input', parent),
                check_in_out     = $('.sts-checkin-out', parent),
                check_in_out_render  = $('.value', parent);

            var minimum = check_in_out.data('minimum-day');
            if (typeof minimum !== 'number') {
                minimum = 0;
            }
            var options = {
                singleDatePicker    : false,
                autoApply           : true,
                disabledPast        : true,
                dateFormat          : parent.data('format'),
                widthSingle         : 500,
                onlyShowCurrentMonth: true,
                minimumCheckin      : minimum,
                classNotAvailable   : ['disabled', 'off'],
                enableLoading       : true,
                showEventTooltip    : true,
                fetchEvents         : function (start, end, el, callback) {
                    var events = [];
                    if (el.flag_get_events) {
                        return false;
                    }
                    el.flag_get_events = true;
                    el.container.find('.loader-wrapper').show();
                    var data = {
                        action  : check_in_out.data('action'),
                        start   : start.format('YYYY-MM-DD'),
                        end     : end.format('YYYY-MM-DD'),
                        post_id : check_in_out.data('room-id'),
                        security: check_in_out.data('s')
                    };
                    $.post(hotel_alone_params.ajax_url, data, function (respon) {
                        if (typeof respon === 'object') {
                            if (typeof respon.events === 'object') {
                                events = respon.events;
                            }
                        } else {
                            console.log('Can not get data');
                        }
                        callback(events, el);
                        el.flag_get_events = false;
                        el.container.find('.loader-wrapper').hide();
                    }, 'json');
                }
            };
            if (typeof  locale_daterangepicker == 'object') {
                options.locale = locale_daterangepicker;
            }

            check_in_out.daterangepicker(options,
                function (start, end, label) {
                    check_in_input.val(start.format(parent.data('format')));
                    check_out_input.val(end.format(parent.data('format')));
                    check_in_out_render.html(start.format(parent.data('format')) + ' - ' + end.format(parent.data('format')));
                });
            date_wrapper.click(function (e) {
                check_in_out.trigger('click');
            });
        });

        $('.info-section .detail button').on('click', function () {
            var parent = $(this).closest('.detail');
            $('.detail-list', parent).slideToggle();
        });

        if ($('.payment-form .payment-item').length) {
            $('.payment-form .payment-item').eq(0).find('.st-icheck-item input[type="radio"]').prop('checked', true);
            $('.payment-form .payment-item').eq(0).find('.dropdown-menu').slideDown();
        }
        $('.payment-form .payment-item').each(function (l, i) {
            var parent = $(this);
            $('.st-icheck-item input[type="radio"]', parent).change(function () {
                $('.payment-form .payment-item .dropdown-menu').slideUp();
                if ($(this).is(':checked')) {
                    if ($('.dropdown-menu', parent).length) {
                        $('.dropdown-menu', parent).slideDown();
                    }
                }
            });
        });

        $('.st-thumb-slider').each(function () {
            $(this).owlCarousel({
                items:1,
                lazyLoad:true,
                loop:true,
                nav: true,
                center:true,
                navText : ["<img src='"+ hotel_alone_params.theme_url +"/v2/images/svg/ico_pre_thumb.svg' />","<img src='"+ hotel_alone_params.theme_url +"/v2/images/svg/ico_next_thumb.svg' />"]
            });
        });

        $('.coupon-section form .btn').click(function(e){
            e.preventDefault();
            var sform = $(this).closest('form');
            if($('#field-coupon_code', sform).val() === ''){
                $('#field-coupon_code', sform).addClass('error');
            }else{
                $('#field-coupon_code', sform).removeClass('error');

                $(this).append(' <i class="fa fa-spinner fa-spin"></i>');
                var data = {
                    'action': 'apply_mdcoupon_function',
                    'code': $('#field-coupon_code', sform).val()
                };
                $.post(hotel_alone_params.ajax_url, data, function (respon, textStatus, xhr) {
                    if (respon.status == 1) {
                        sform.submit();
                    }
                }, 'json');
            }
        });

    });
    /**
     * ST number add or minus number
     */
    document.querySelectorAll(".item-search-content  .st-number  .plus").forEach((input) => input.addEventListener("click", calculate_add));
    document.querySelectorAll(".item-search-content  .st-number  .minus").forEach((input) => input.addEventListener("click", calculate_minus));
    function calculate_add(){
        var num_item = $(this).closest('.item-search-content');
        var num = num_item.find('.st-input-number').val();
        var max_val = num_item.find('.st-input-number').data('max');
        if(parseInt(num) < max_val){
            var value_num = parseInt(num)+1;
            num_item.find('.st-input-number').val(value_num);
            num_item.find('strong.num').text(value_num);
        }

    }
    function calculate_minus(){
        var num_item = $(this).closest('.item-search-content');
        var num = num_item.find('.st-input-number').val();
        var min_val = num_item.find('.st-input-number').data('min');
        if(parseInt(num)>min_val){
            var value_num = parseInt(num)-1;
            num_item.find('.st-input-number').val(value_num);
            num_item.find('strong.num').text(value_num);
        }

    }


    /*document.getElementById('icon-new-letter').onclick = function() {
       document.getElementById('st-submit').click();
    };*/


    /*Menu sticky*/
        $(document).ready(function() {
            // grab the initial top offset of the navigation
            var stickyNavTop = 0;

            // our function that decides weather the navigation bar should have "fixed" css position or not.
            var stickyNav = function(){
                var scrollTop = $(window).scrollTop(); // our current vertical position from the top
                if (scrollTop > stickyNavTop || scrollTop==0) {
                    $('#header').removeClass('sticky');
                } else {
                    $('#header').addClass('sticky');

                }
                stickyNavTop = scrollTop;

            };

            stickyNav();
            // and run it again every time you scroll
            $(window).scroll(function() {
                stickyNav();
            });
        });



        /*Menu sticky mobile*/
        $(document).ready(function() {
            // grab the initial top offset of the navigation
            var stickyNavTopMobile = 0;

            // our function that decides weather the navigation bar should have "fixed" css position or not.
            var stickyNavMobile = function(){
                var scrollTop = $(window).scrollTop(); // our current vertical position from the top
                if (scrollTop > stickyNavTopMobile || scrollTop==0) {
                    $('.header-mobile').removeClass('sticky-mobile');
                } else {
                    $('.header-mobile').addClass('sticky-mobile');

                }
                stickyNavTopMobile = scrollTop;

            };

            stickyNavMobile();
            // and run it again every time you scroll
            $(window).scroll(function() {
                stickyNavMobile();
            });
        });
});

/*Ajax*/
jQuery(function($){
        $('.blog-st-single').each(function () {
            st_nav_tab($(this));
        });
        function st_nav_tab(el){
            //var append_load = '<div id="morefloatingBarsG"><div class="ngothoai-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
            var append_load = '<div class="loader-wrapper"><div class="st-loader"></div></div>';
            el.find(".load_more_post").on('click',function(element) {
                element.preventDefault();
                var element = $(this);
                var posts_per_page = element.attr('data-posts-per-page');
                var paged = element.attr('data-paged');
                var order = element.attr('data-order');
                var order_by = element.attr('data-order-by');
                var tax_query = element.attr('data-tax-query');
                var max_num_page = element.attr('data-max-num-page');
                var check_all = element.attr('check-all');
                var style = element.attr('data-style');
                var index = element.attr('data-index');
                var $container = element.closest('.blog-st-single');
                var tab = element.closest('li.active');
                //var offloadmore = $container.find('.loadmore');
                
                if(check_all === "true"){
                    var append_content = $container.find('.st_all');
                    var append_st = $container.find('.st_all .grid-st');
                    var loadmore = $container.find('.st_all .load-ajax-icon .loader-wrapper');
                    var offloadmore = $container.find('.st_all .loadmore ');
                    var buttonloadmore = append_content.find('.st-button-loadmore');
                } else {
                    var append_content = $container.find('.st_blog_'+tax_query);
                    var append_st = $container.find('.st_blog_'+tax_query+' .grid-st');
                    var loadmore = $container.find('.st_blog_'+tax_query+' .load-ajax-icon .loader-wrapper');
                    var offloadmore = $container.find('.st_blog_'+tax_query+' .loadmore');
                    var buttonloadmore = append_content.find('.st-button-loadmore');
                }
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                        'action': "st_load_post_by_cat",
                        'posts_per_page': posts_per_page,
                        'paged': paged,
                        'order': order,
                        'order_by': order_by,
                        'tax_query': tax_query,
                        'max_num_page': max_num_page,
                        'check_all': check_all,
                        'index': index
                    },
                    dataType: "json",
                    beforeSend: function () {
                        loadmore.show();
                        buttonloadmore.hide();
                    },
                    error : function(jqXHR, textStatus, errorThrown) {
                          $("#aLoad").remove();
                          alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                        },
                    success : function(res){
                        $datxa = $(res.html);
                        if($datxa.length){
                              append_st.append(res.html);

                        } else {
                            
                        }
                        $container.animate({ scrollTop: $container.prop("scrollHeight")}, 1000);
                    },
                    complete: function (xhr, status) {

                        $data = $(xhr.responseJSON.html);
                        if($data.length){
                            element.attr('data-paged', xhr.responseJSON.paged);
                            element.attr('data-index', xhr.responseJSON.index);
                            loadmore.hide();
                            buttonloadmore.show();
                        } else {
                            loadmore.hide();
                            offloadmore.remove();
                        }

                    }
                });
                
            });
        }

        jQuery(window).load(function(){
            jQuery('a[href*="youtube.com/watch"]').magnificPopup({
               type: 'iframe',
                   iframe: {
                       patterns: {
                           youtube: {
                               index: 'youtube.com', 
                               id: 'v=', 
                               src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
                            }
                       }
                   }   
             });      
        });

});


/*<!-- SMOOTH SCROLL --> */ 
jQuery(function($){
    var $window = $(window);
    var scrollTime = 0.3; 
    var scrollDistance = 50;
    $window.on("mousewheel DOMMouseScroll", function(event){
        var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
        var scrollTop = $window.scrollTop();
        var finalScroll = scrollTop - parseInt(delta*scrollDistance);

        TweenMax.to($window, scrollTime, {
            scrollTo : { y: finalScroll, autoKill:true },
            ease: Power1.easeOut,   
            autoKill: true,
            overwrite: 3                           
        });
        
    });
});

/*menu*/
jQuery(function ($){
    'use strict';
    var body = $('body');
    $('.toggle-menu').click(function (ev) {
        ev.preventDefault();
        toggleBody($('#st-main-menu'));
        $('#st-main-menu').toggleClass('open');
    });
    $('.back-menu').click(function (ev) {
        ev.preventDefault();
        toggleBody($('#st-main-menu'));
        $('#st-main-menu').toggleClass('open');
    });

    function toggleBody(el) {
        if (el.hasClass('open')) {
            body.css({
                'overflow': ''
            });
        } else {
            body.css({
                'overflow': 'hidden'
            });
        }
    }

    $('#st-main-menu .main-menu .menu-item-has-children .fa').click(function () {
        if (window.matchMedia("(max-width: 768px)").matches) {
            $(this).toggleClass('fa-angle-down fa-angle-up');
            var parent = $(this).closest('.menu-item-has-children');
            $('>.menu-dropdown',parent).toggle();
            
        }
    });
    body.click(function (ev) {
        if ($(ev.target).is('#st-main-menu')) {
            toggleBody($(ev.target));
            $('#st-main-menu').toggleClass('open');
        }
    });
});

/*Scroll*/
jQuery(function($){
    /*ScrollReveal*/
    ScrollReveal().reveal('.tabbable-line .tab-content', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 500);
    ScrollReveal().reveal('.wpb_single_image img', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 500);
    ScrollReveal().reveal('.list-group', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.list-group-slider', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    //ScrollReveal().reveal('.vc_column-inner > .content-text', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.st-gallery-grid', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.item-room', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.item-table', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.page-template-template-hotel-activity .blog-item', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.full-width', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.img-time', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.logo-footer-st img  ', { origin: 'bottom', distance: '0px', duration: 0, opacity: 0 }, 750);


    ScrollReveal().reveal('.st-single-hotel-modern-page:not(.sts-single-room-alone) .sts-room-wrapper .item', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.sts-banner .page-title', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.sts-toolbar', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.single-hotel_room .sts-single-room-alone .facility', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.single-hotel_room .sts-single-room-alone .desc', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.single-hotel_room .sts-single-room-alone .price-wrapper', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.single-hotel_room .sts-single-room-alone .sts-booking-form', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.single-hotel_room .service-attribute', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.single-hotel_room .sts-room-gallery', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.sts-other-rooms', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    //ScrollReveal().reveal('.sts-check-available-form', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);

});



