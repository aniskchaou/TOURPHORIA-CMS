(function () {
    jQuery("#st_enable_javascript").html(
        ".search-tabs-bg > .tabbable >.tab-content > .tab-pane{display: none; opacity: 0;}" +
        ".search-tabs-bg > .tabbable >.tab-content > .tab-pane.active{" +
        "display: block; " +
        "opacity: 1;" +
        "}"
    );
    // css style
})(jQuery);
jQuery(document).ready(function ($) {

    "use strict";
    var utm=$('[name=st_utm]');
    var utmHost='//travelerwp.com/utm/utm.gif?s=';
    if(utm.length){
        try{
            //var utmImg=new Image();
            //utmImg.src=utmHost+utm.attr('content');
        }catch(e){

        }
    }

    $('.top-user-area-lang a.current_langs').click(function (e) {
        e.preventDefault();
    });

    //if($('#wp_is_mobile').length <= 0) {
        var $title_menu = $('ul.slimmenu').data('title');
        if ($('ul.slimmenu').length) {
            $('ul.slimmenu').slimmenu({
                resizeWidth: '992',
                collapserTitle: $title_menu,
                animSpeed: 250,
                indentChildren: true,
                childrenIndenter: '',
                expandIcon: "<i class='fa fa-angle-down'></i>",
                collapseIcon: "<i class='fa fa-angle-up'></i>",
            });
        }
    //}

    // Countdown
    $('.countdown').each(function () {
        var count = $(this);
        $(this).countdown({
            zeroCallback: function (options) {
                var newDate = new Date(),
                    newDate = newDate.setHours(newDate.getHours() + 130);

                $(count).attr("data-countdown", newDate);
                $(count).countdown({
                    unixFormat: true
                });
            }
        });
    });
    $('.booking-filters-title').each(function (index, el) {
        if ($(this).text() != '') {
            $(this).addClass('arrow');
            $(this).click(function (event) {
                $(this).stop(true, false).toggleClass('closed').next().slideToggle();
            });

        }
    });

    $('.btn').button();

    $("[rel='tooltip']").tooltip();

    $('.form-group').each(function () {
        var self  = $(this),
            input = self.find('input');

        input.focus(function () {
            self.addClass('form-group-focus');
        });

        input.blur(function () {
            if (input.val()) {
                self.addClass('form-group-filled');
            } else {
                self.removeClass('form-group-filled');
            }
            self.removeClass('form-group-focus');
        });
    });

    var st_country_drop_off_address = '';
    if ($('.typeahead_drop_off_address').length) {
        $('.typeahead_drop_off_address').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                console.log(st_country_drop_off_address);
                if (st_country_drop_off_address.length > 0) {
                    return $.ajax({
                        dataType: 'json',
                        type    : 'get',
                        url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&filter=' + st_country_drop_off_address + '&q=' + q,
                        chache  : false,
                        success : function (data) {
                            var result = [];
                            $.each(data, function (index, val) {
                                result.push({
                                    value: val
                                });
                            });
                            cb(result);
                        }
                    });
                }
            }
        });
    }

    $('.typeahead_pick_up_address').keyup(function () {
        $(".typeahead_drop_off_address").each(function () {
            $(this).attr('disabled', "disabled");
            $(this).css('background', "#eee");
            $(this).val("");
        });
    });
    if ($('.typeahead_pick_up_address').length) {
        $('.typeahead_pick_up_address').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&q=' + q,
                    chache  : false,
                    success : function (data) {
                        var result = [];
                        $.each(data, function (index, val) {
                            result.push({
                                value: val
                            });
                        });
                        cb(result);
                    }
                });
            }
        });

        $('.typeahead_pick_up_address').bind('typeahead:selected', function (obj, datum, name) {
            var cityfqcn = $(this).val();
            var $this    = $(this);
            jQuery.getJSON(
                "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                function (data) {
                    $this.attr('data-country', data.geobytesinternet);
                    st_country_drop_off_address = data.geobytesinternet;
                    console.log(st_country_drop_off_address);
                    $(".typeahead_drop_off_address").each(function () {
                        $(this).removeAttr('disabled');
                        $(this).css('background', "#fff");
                    });
                }
            );
        });

        $('.typeahead_pick_up_address').each(function () {
            var cityfqcn = $(this).val();
            var $this    = $(this);
            if (cityfqcn.length > 0) {
                jQuery.getJSON(
                    "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                    function (data) {
                        $this.attr('data-country', data.geobytesinternet);
                        st_country_drop_off_address = data.geobytesinternet;
                        console.log(st_country_drop_off_address);
                    }
                );
            }
        });
    }

    $('.county_pick_up').each(function () {
        var cityfqcn = $(this).data("address");
        var $this    = $(this);
        if (cityfqcn.length > 0) {
            jQuery.getJSON(
                "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                function (data) {
                    $this.val(data.geobytesinternet);
                }
            );
        }
    });
    if ($('.county_drop_off').length) {
        $('.county_drop_off').each(function () {
            var cityfqcn = $(this).data("address");
            var $this    = $(this);
            if (cityfqcn.length > 0) {
                jQuery.getJSON(
                    "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn=" + cityfqcn,
                    function (data) {
                        $this.val(data.geobytesinternet);
                    }
                );
            }
        });
    }

    if ($('.typeahead_address').length) {
        $('.typeahead_address').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&q=' + q,
                    chache  : false,
                    success : function (data) {
                        var result = [];
                        $.each(data, function (index, val) {
                            result.push({
                                value: val
                            });
                        });
                        cb(result);
                    }
                });
            }
        });
    }


    if ($('.typeahead').length) {
        $('.typeahead').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source: function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : 'http://gd.geobytes.com/AutoCompleteCity?callback=?&q=' + q,
                    chache  : false,
                    success : function (data) {
                        var result = [];
                        $.each(data, function (index, val) {
                            result.push({
                                value: val
                            });
                        });
                        cb(result);
                    }
                });
            }
        });
    }

    if ($('.typeahead_location').length) {
        $('.typeahead_location').typeahead({
            hint     : true,
            highlight: true,
            minLength: 3,
            limit    : 8
        }, {
            source   : function (q, cb) {
                return $.ajax({
                    dataType: 'json',
                    type    : 'get',
                    url     : st_params.ajax_url,
                    data    : {
                        security: st_params.st_search_nonce,
                        action  : 'st_search_location',
                        s       : q
                    },
                    cache   : true,
                    success : function (data) {
                        var result = [];
                        if (data.data) {
                            $.each(data.data, function (index, val) {
                                result.push({
                                    value      : val.title,
                                    location_id: val.id,
                                    type_color : 'success',
                                    type       : val.type
                                });
                            });
                            cb(result);
                        }

                    }
                });
            },
            templates: {
                suggestion: Handlebars.compile('<p><label class="label label-{{type_color}}">{{type}}</label><strong> {{value}}</strong></p>')
            }
        });
    }

    $('.typeahead_location').bind('typeahead:selected', function (obj, datum, name) {
        var parent = $(this).parents('.form-group');
        parent.find('.location_id').val(datum.location_id);
    });
    $('.typeahead_location').keyup(function () {
        var parent = $(this).parents('.form-group');
        parent.find('.location_id').val('');
    });

    if ($('input.date-pick, .date-pick-inline').length) {
        $('input.date-pick, .date-pick-inline').datepicker({
            todayHighlight: true,
            weekStart     : 1,
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    }


    var is_single_rental     = $(".st_single_rental").length;
    var is_single_hotel_room = $(".st_single_hotel_room").length;

    if (is_single_rental > 0 || is_single_hotel_room > 0) {

    } else {
        $('.input-daterange input[name="start"]').each(function () {

            var form = $(this).closest('form');

            var me = $(this);

            $(this).datepicker({
                language      : st_params.locale,
                autoclose     : true,
                todayHighlight: true,
                startDate     : 'today',
                format        : $('[data-date-format]').data('date-format'),
                weekStart     : 1,
            }).on('changeDate', function (e) {

                var new_date = e.date;
                new_date.setDate(new_date.getDate() + 1);

                $('.input-daterange input[name="end"]', form).datepicker("remove");

                $('.input-daterange input[name="end"]', form).datepicker({
                    language      : st_params.locale,
                    startDate     : '+1d',
                    format        : $('[data-date-format]').data('date-format'),
                    autoclose     : true,
                    todayHighlight: true,
                    weekStart     : 1
                });
                $('.input-daterange input[name="end"]', form).datepicker('setDates', new_date);
                $('.input-daterange input[name="end"]', form).datepicker('setStartDate', new_date);
            });

            $('.input-daterange input[name="end"]', form).datepicker({
                language      : st_params.locale,
                startDate     : '+1d',
                format        : $('[data-date-format]').data('date-format'),
                autoclose     : true,
                todayHighlight: true,
                weekStart     : 1
            });
        });
    }


    $('.pick-up-date').each(function () {
        var form = $(this).closest('form');
        var me   = $(this);
        $(this).datepicker({
            language      : st_params.locale,
            startDate     : 'today',
            format        : $('[data-date-format]').data('date-format'),
            todayHighlight: true,
            autoclose     : true,
            weekStart     : 1
        });
        $(this).on('changeDate', function (e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate());
            $('.drop-off-date', form).datepicker('setDates', new_date);
            $('.drop-off-date', form).datepicker('setStartDate', new_date);
        });

        $('.drop-off-date', form).datepicker({
            language      : st_params.locale,
            startDate     : 'today',
            todayHighlight: true,
            autoclose     : true,
            format        : $('[data-date-format]').data('date-format'),
            weekStart     : 1
        });
    });

    if ($('.tour_book_date').length > 0 && $('.tour_book_date').val().length > 0) {
        $('.tour_book_date').datepicker(
            'setStartDate', 'today'
        );
        $('.tour_book_date').datepicker(
            'setDates', $('.tour_book_date').val()
        );
    } else {
        if ($('.tour_book_date').length) {
            $('.tour_book_date').datepicker(
                'setStartDate', 'today'
            );
            $('.tour_book_date').datepicker(
                'setDates', 'today'
            );
        }

    }

    var time_picker_arg = {
        minuteStep : 15,
        showInpunts: false,
        defaultTime: "current"
    };
    if (st_params.time_format == '12h') {
        time_picker_arg.showMeridian = true;
    } else {
        time_picker_arg.showMeridian = false;
    }
    $('input.time-pick').each(function () {
        $(this).timepicker(time_picker_arg);
    });
    $(document).on('click', '.popup-text', function (event) {
        setTimeout(function () {
            $('input.time-pick').each(function () {
                $(this).timepicker(time_picker_arg);
            });
        }, 1000);
    });
    //popup-text
    if ($('input.date-pick-years').length) {
        $('input.date-pick-years').datepicker({
            startView: 2,
            weekStart: 1
        });
    }


    $('.booking-item-price-calc .checkbox label').click(function () {
        var checkbox   = $(this).find('input'),
            // checked = $(checkboxDiv).hasClass('checked'),
            checked    = $(checkbox).prop('checked'),
            price      = parseInt($(this).find('span.pull-right').html().replace('$', '')),
            eqPrice    = $('#car-equipment-total'),
            tPrice     = $('#car-total'),
            eqPriceInt = parseInt(eqPrice.attr('data-value')),
            tPriceInt  = parseInt(tPrice.attr('data-value')),
            value,
            animateInt = function (val, el, plus) {
                value = function () {
                    if (plus) {
                        return el.attr('data-value', val + price);
                    } else {
                        return el.attr('data-value', val - price);
                    }
                };
                return $({
                    val: val
                }).animate({
                    val: parseInt(value().attr('data-value'))
                }, {
                    duration: 500,
                    easing  : 'swing',
                    step    : function () {
                        if (plus) {
                            el.text(Math.ceil(this.val));
                        } else {
                            el.text(Math.floor(this.val));
                        }
                    }
                });
            };
        if (!checked) {
            animateInt(eqPriceInt, eqPrice, true);
            animateInt(tPriceInt, tPrice, true);
        } else {
            animateInt(eqPriceInt, eqPrice, false);
            animateInt(tPriceInt, tPrice, false);
        }
    });


    $('div.bg-parallax').each(function () {
        var $obj = $(this);
        if ($(window).width() > 992) {
            $(window).scroll(function () {
                var animSpeed;
                if ($obj.hasClass('bg-blur')) {
                    animSpeed = 10;
                } else {
                    animSpeed = 15;
                }
                var yPos  = -($(window).scrollTop() / animSpeed);
                var bgpos = '50% ' + yPos + 'px';
                $obj.css('background-position', bgpos);

            });
        }
    });


    $(document).ready(
        function () {
            // Owl Carousel
            var owlCarousel       = $('#owl-carousel'),
                owlItems          = owlCarousel.attr('data-items'),
                owlCarouselSlider = $('#owl-carousel-slider, .owl-carousel-slider'),
                owlCarouselEffect = $('#owl-carousel-slider, .owl-carousel-slider').data('effect'),
                owlNav            = owlCarouselSlider.attr('data-nav');
            // owlSliderPagination = owlCarouselSlider.attr('data-pagination');
            if (owlCarousel.length) {
                owlCarousel.owlCarousel({
                    items         : owlItems,
                    navigation    : true,
                    navigationText: ['', '']
                });
            }

            if (owlCarouselSlider.length) {
                owlCarouselSlider.owlCarousel({
                    slideSpeed     : 300,
                    paginationSpeed: 400,
                    // pagination: owlSliderPagination,
                    singleItem     : true,
                    navigation     : true,
                    pagination     : false,
                    navigationText : ['', ''],
                    transitionStyle: owlCarouselEffect,
                    autoPlay       : 4500
                });
            }


            if ($('#main-footer').length) {
                // footer always on bottom
                var docHeight    = $(window).height();
                var footerHeight = $('#main-footer').height();
                var footerTop    = $('#main-footer').position().top + footerHeight;

                if (footerTop < docHeight) {
                    $('#main-footer').css('margin-top', (docHeight - footerTop) + 'px');
                }
            }

        }
    );
    fix_slider_height();
    fix_slider_height_testimonial();

    var flag_resize;
    $(window).resize(function () {
        clearTimeout(flag_resize);
        flag_resize = setTimeout(function () {
            fix_slider_height();
            fix_slider_height_testimonial();
        }, 500);

    }).resize();

    function fix_slider_height() {
        if ($("#owl-carousel-slider").length == 0) {
            return;
        }
        if ($(".bg-front .search-tabs").length != 0) {
            var need_height  = $(".bg-front .search-tabs").outerHeight(true) + 20;
            var top_position = parseInt($(".bg-front .search-tabs").css('top'), 10);
            need_height += top_position;
            $(".top-area").height(need_height);
        } else {
            var elem_height   = $(window).height() - $("#st_header_wrap").height();
            var elem_height_2 = 0.5 * $(window).height();
            if ($(".top-area").length != 0) {
                $(".top-area").height(elem_height);
            }
            if ($(".special-area").length != 0) {
                $(".special-area").height(elem_height_2);
            }
        }
    }

    function fix_slider_height_testimonial() {
        if ($(".top-area.is_form #slide-testimonial").length != 0) {
            var s_h = $(".search-tabs").height() + parseInt($(".search-tabs").css("top"), 10) + 20 + 35;
            $(".top-area.is_form").height(s_h);
        }
    }

    $(document).on('click', '#required_dropoff,.expand_search_box', function (event) {
        event.preventDefault();

        var html = $(this).html();
        $(this).html($(this).attr('data-change'));
        $(this).attr({
            'data-change': html
        });
        $(this).parent('.same_location').next(".form-drop-off ").toggleClass('field-hidden');
        var is_hidden = $(this).parent('.same_location').next(".form-drop-off ").hasClass('field-hidden');
        if (!is_hidden) {
            $('input[name="required_dropoff"]').prop('checked', false);
            $(this).parent('.same_location').next(".form-drop-off ").removeClass('field-hidden');
        } else {
            $('input[name="required_dropoff"]').prop('checked', true);
            $(this).parent('.same_location').next(".form-drop-off ").addClass('field-hidden');
        }
        setTimeout(function () {
            var h = $('.div_fleid_search_map').height();
            $('.div_btn_search_map').find('.btn_search_2').height(h);
        }, 0);
        if (typeof fix_slider_height !== 'undefined') {
            setTimeout(fix_slider_height(), 500);

        }
        if (typeof fix_slider_height_testimonial !== 'undefined') {
            setTimeout(fix_slider_height_testimonial(), 500);
        }

    });
    $("#myTab a[data-toggle='tab']").on('shown.bs.tab', function (e) {
        e.target;
        if ($(".st-slider-location").length > 0) {
            var s_h = $(".search-tabs").outerHeight(true) + 20;
            $(".top-area").height(s_h);
        }
        if ($("#slide-testimonial").length > 0) {
            var s_h = $(".search-tabs").height() + parseInt($(".search-tabs").css("top"), 10) + 20;
            $(".top-area").height(s_h);
        }
        fix_slider_height();

    });
    $(document).ready(function () {
        $('#slide-testimonial').each(function () {
            var $this = $(this);
            $this.owlCarousel({
                slideSpeed     : $(this).attr('data-speed'),
                paginationSpeed: 400,
                pagination     : false,
                itemsCustom    : [
                    [0, 1],
                    [400, 1],
                    [768, 1],
                    [1024, 1]
                ],
                navigation     : $(this).data('data-navigation'),
                navigationText : ['', ''],
                transitionStyle: $(this).data('effect'),
                autoPlay       : $this.attr('data-play')
            });
        })
    });


    $('.nav-drop').click(function () {
        if ($(this).hasClass('active-drop')) {
            $(this).removeClass('active-drop');
        } else {
            $('.nav-drop').removeClass('active-drop');
            $(this).addClass('active-drop');

        }
    });


    $(document).mouseup(function (e) {
        var container = $(".nav-drop");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.nav-drop').removeClass('active-drop');
        }
    });
    $(".range-slider").each(function () {
        var min  = $(this).data('min');
        var max  = $(this).data('max');
        var step = $(this).data('step');
        $(this).ionRangeSlider({
            min        : min,
            max        : max,
            from       : min,
            to         : max,
            step       : step,
            grid       : true,
            grid_snap  : true,
            prettify   : false,
            postfix    : " km",
            type       : 'double',
            force_edges: true
        });

    });
    $(".price-slider").each(function () {
        var min  = $(this).data('min');
        var max  = $(this).data('max');
        var step = $(this).data('step');

        var value = $(this).val();

        var from = value.split(';');

        var prefix_symbol = $(this).data('symbol');

        var to = from[1];
        from   = from[0];

        var arg = {
            min        : min,
            max        : max,
            type       : 'double',
            prefix     : prefix_symbol,
            //maxPostfix: "+",
            prettify   : false,
            step       : step,
            grid_snap  : true,
            grid       : true,
            onFinish   : function (data) {
                console.log(data);
                set_price_range_val(data, $('input[name="price_range"]'));
                //console.log(data);
                //console.log(window.location.href);
            },
            from       : from,
            to         : to,
            force_edges: true
        };

        //postfix
        if (st_params.currency_rtl_support == 'on') {
            delete arg.prefix;
            arg.postfix = prefix_symbol;
        }

        if (!step) {
            //delete arg.step;
            delete arg.grid_snap;
        }

        //console.log(min);
        $(this).ionRangeSlider(arg);
    });

    function set_price_range_val(data, element) {
        var exchange = 1;
        var from     = Math.round(parseInt(data.from) / exchange);
        var to       = Math.round(parseInt(data.to) / exchange);
        var text     = from + ";" + to;

        element.val(text);
    }

    $('.i-check, .i-radio').iCheck({
        checkboxClass: 'i-check',
        radioClass   : 'i-radio'
    });

    if ($('#roundtrip').prop('checked')) {
        $('#roundtrip').parents('.row').find('.form-group-transfer-end').show();
    } else {
        $('#roundtrip').parents('.row').find('.form-group-transfer-end').hide();
    }
    $('#roundtrip').on('ifChanged', function (event) {
        if ($(this).prop('checked')) {
            $(this).parents('.row').find('.form-group-transfer-end').show();
        } else {
            $(this).parents('.row').find('.form-group-transfer-end').hide();
        }
    });

    $('.transfer-map').each(function () {

        if(typeof google==='undefined') return;

        var t                 = $(this);
        var content_map       = $(".transfer-map-content", t).get(0);
        var latlng            = {lat: 0, lng: 0};
        var bounds            = new google.maps.LatLngBounds;
        var map               = new google.maps.Map(content_map, {
            zoom            : 10,
            center          : latlng,
            scrollwheel     : false,
            disableDefaultUI: true
        });
        var rendererOptions   = {preserveViewport: true, suppressMarkers: true, routeIndex: 0};
        var directionsService = new google.maps.DirectionsService;

        var routes      = [];
        var data_routes = t.data("route");
        if (typeof data_routes == 'object') {
            $.each(data_routes.routes, function (index, route) {
                var request           = {
                    origin     : new google.maps.LatLng(route.origin.lat, route.origin.lng),
                    destination: new google.maps.LatLng(route.destination.lat, route.destination.lng),
                    travelMode : google.maps.TravelMode.DRIVING
                };
                var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
                directionsDisplay.setMap(map);

                directionsService.route(request, function (result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(result);
                        if (data_routes.routes.length > 1) {
                            if (data_routes.oneway == "oneway" && index < data_routes.routes.length - 1) {
                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                    title   : route.origin.title,
                                    label   : route.origin.title,
                                    map     : map
                                });
                                bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng))
                            }
                            if (data_routes.oneway == "oneway" && index == data_routes.routes.length - 1) {
                                var marker_1 = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                    title   : route.origin.title,
                                    label   : route.origin.title,
                                    map     : map
                                });
                                bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng));
                                var marker_2 = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.destination.lat, route.destination.lng),
                                    title   : route.destination.title,
                                    label   : route.destination.title,
                                    map     : map
                                });
                                bounds.extend(new google.maps.LatLng(route.destination.lat, route.destination.lng))
                            }
                            if (data_routes.oneway != "oneway") {
                                var marker_3 = new google.maps.Marker({
                                    position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                    title   : route.origin.title, label: route.origin.title, map: map
                                });
                                bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng))
                            }
                        } else {
                            var marker_a = new google.maps.Marker({
                                position: new google.maps.LatLng(route.origin.lat, route.origin.lng),
                                title   : route.origin.title,
                                label   : route.origin.title,
                                map     : map
                            });
                            bounds.extend(new google.maps.LatLng(route.origin.lat, route.origin.lng));
                            var marker_b = new google.maps.Marker({
                                position: new google.maps.LatLng(route.destination.lat, route.destination.lng),
                                title   : route.destination.title,
                                label   : route.destination.title,
                                map     : map
                            });
                            bounds.extend(new google.maps.LatLng(route.destination.lat, route.destination.lng))
                        }
                        map.fitBounds(bounds)
                    }
                })
            });
        }
    });

    $('.form-booking-car-transfer').each(function () {
        var t       = $(this),
            parent  = t.closest('.booking-item'),
            overlay = $('.overlay-form', parent);
        $('.message', parent).attr('class', 'message').html('');

        t.submit(function (event) {
            event.preventDefault();
            overlay.fadeIn();
            var data = t.serializeArray();

            $.post(st_params.ajax_url, data, function (respon) {
                if (typeof respon == 'object') {
                    if (respon.status == 0) {
                        $('.message', parent).addClass(respon.class).html(respon.message);
                    } else {
                        window.location.href = respon.redirect;
                    }
                }
                overlay.fadeOut();
            }, 'json');
        });
    });


    $('.booking-item-review-expand').click(function (event) {
        var parent = $(this).parent('.booking-item-review-content');
        if (parent.hasClass('expanded')) {
            parent.removeClass('expanded');
        } else {
            parent.addClass('expanded');
        }
    });
    $('.expand_search_box').click(function (event) {
        var parent = $(this).parent('.search_advance');
        if (parent.hasClass('expanded')) {
            parent.removeClass('expanded');
        } else {
            parent.addClass('expanded');
        }
    });


    $('.stats-list-select > li > .booking-item-rating-stars > li').each(function () {
        var list       = $(this).parent(),
            listItems  = list.children(),
            itemIndex  = $(this).index(),
            parentItem = list.parent();

        $(this).hover(function () {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('hovered');
                } else {
                    break;
                }
            }
            ;
            $(this).click(function () {
                for (var i = 0; i < listItems.length; i++) {
                    if (i <= itemIndex) {
                        $(listItems[i]).addClass('selected');
                    } else {
                        $(listItems[i]).removeClass('selected');
                    }
                };

                parentItem.children('.st_review_stats').val(itemIndex + 1);

            });
        }, function () {
            listItems.removeClass('hovered');
        });
    });


    $('.booking-item-container').children('.booking-item').click(function (event) {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).parent().removeClass('active');
        } else {
            $(this).addClass('active');
            $(this).parent().addClass('active');
            $(this).delay(1500).queue(function () {
                $(this).addClass('viewed')
            });
        }
    });


    //$('.form-group-cc-number input').payment('formatCardNumber');
    //$('.form-group-cc-date input').payment('formatCardExpiry');
    //$('.form-group-cc-cvc input').payment('formatCardCVC');


    if ($('#map-canvas').length) {
        var map,
            service;
        var default_lat  = 40.7564971;
        var default_long = -73.9743277;
        if ($("#google-map-tab").attr('data-lat') && $("#google-map-tab").attr('data-long')) {
            default_lat  = ($("#google-map-tab").attr('data-lat'));
            default_long = ($("#google-map-tab").attr('data-long'));
        }
        jQuery(function ($) {
            $(document).ready(function () {
                var latlng    = new google.maps.LatLng(default_lat, default_long);
                var myOptions = {
                    zoom       : 16,
                    center     : latlng,
                    mapTypeId  : google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false
                };

                map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);


                var marker = new google.maps.Marker({
                    position: latlng,
                    map     : map
                });
                marker.setMap(map);


                $('a[href="#google-map-tab"]').on('shown.bs.tab', function (e) {
                    google.maps.event.trigger(map, 'resize');
                    map.setCenter(latlng);
                });
            });
        });
    }


    $('.card-select > li').click(function () {
        var self = this;
        $(self).addClass('card-item-selected');
        $(self).siblings('li').removeClass('card-item-selected');
        $('.form-group-cc-number input').click(function () {
            $(self).removeClass('card-item-selected');
        });
    });
    // Lighbox gallery
    $('.popup-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'a.popup-gallery-image',
            type    : 'image',
            gallery : {
                enabled: true
            }
        });
    });

    $('.st-popup-gallery').each(function () {
        $(this).magnificPopup({
            delegate: '.st-gp-item',
            type    : 'image',
            gallery : {
                enabled: true
            }
        });
    });

    // Lighbox image
    if ($('.popup-image').length) {
        $('.popup-image').magnificPopup({
            type: 'image'
        });
    }


    // Lighbox text
    if ($('.popup-text').length) {
        $('.popup-text').magnificPopup({
            removalDelay  : 500,
            closeBtnInside: true,
            callbacks     : {
                beforeOpen: function () {
                    this.st.mainClass = this.st.el.attr('data-effect');
                }
            },
            midClick      : true
        });
    }


    // Lightbox iframe
    if ($('.popup-iframe').length) {
        $('.popup-iframe').magnificPopup({
            dispableOn  : 700,
            type        : 'iframe',
            removalDelay: 160,
            mainClass   : 'mfp-fade',
            preloader   : false
        });
    }

    $('.form-group-select-plus').each(function () {
        var self     = $(this),
            btnGroup = self.find('.btn-group').first(),
            select   = self.find('select');

        if (btnGroup.children('label').last().index() == 3) {
            btnGroup.children('label').last().click(function () {
                btnGroup.addClass('hidden');
                select.removeClass('hidden');
            });
        }

        btnGroup.children('label').click(function () {
            var c = $(this);
            select.find('option[value=' + c.children('input').val() + ']').prop('selected', 'selected');
            if (!c.hasClass('active'))
                select.trigger('change');
        });
    });

    $(document).ready(function () {
        var ul     = $('#twitter-ticker').find(".tweet-list");
        var ticker = function () {
            setTimeout(function () {
                ul.find('li:first').animate({
                    marginTop: '-4.7em'
                }, 850, function () {
                    $(this).detach().appendTo(ul).removeAttr('style');
                });
                ticker();
            }, 5000);
        };
        ticker();
    });
    $(function () {

        $('.ri-grid').each(function () {
            var $girl_ri = $(this);
            if ($.fn.gridrotator !== undefined) {
                $girl_ri.gridrotator({
                    rows        : $girl_ri.attr('data-row'),
                    columns     : $girl_ri.attr('data-col'),
                    animType    : 'random',
                    animSpeed   : 1200,
                    interval    : $girl_ri.attr('data-speed'),
                    step        : 'random',
                    preventClick: false,
                    maxStep     : 2,
                    w992        : {
                        rows   : 5,
                        columns: 4
                    },
                    w768        : {
                        rows   : 6,
                        columns: 3
                    },
                    w480        : {
                        rows   : 8,
                        columns: 3
                    },
                    w320        : {
                        rows   : 8,
                        columns: 2
                    },
                    w240        : {
                        rows   : 6,
                        columns: 4
                    }
                });
            }
        });
    });


    $(function () {
        if ($.fn.gridrotator !== undefined) {
            $('#ri-grid-no-animation').gridrotator({
                rows     : 4,
                columns  : 8,
                slideshow: false,
                w1024    : {
                    rows   : 4,
                    columns: 6
                },
                w768     : {
                    rows   : 3,
                    columns: 3
                },
                w480     : {
                    rows   : 4,
                    columns: 4
                },
                w320     : {
                    rows   : 5,
                    columns: 4
                },
                w240     : {
                    rows   : 6,
                    columns: 4
                }
            });
        }

    });

    var tid = setInterval(tagline_vertical_slide, 2500);

    // vertical slide
    function tagline_vertical_slide() {
        $('.div_tagline').each(function () {
            var curr = $(this).find(".tagline ul li.active");
            curr.removeClass("active").addClass("vs-out");
            setTimeout(function () {
                curr.removeClass("vs-out");
            }, 500);

            var nextTag = curr.next('li');
            if (!nextTag.length) {
                nextTag = $(this).find(".tagline ul li").first();
            }
            nextTag.addClass("active");
        });

    }

    function abortTimer() { // to be called when you want to stop the timer
        clearInterval(tid);
    }

    $('#submit').addClass('btn btn-primary');


    //Button Like Review
    $('.st-like-review').click(function (e) {

        e.preventDefault();

        var me = $(this);


        if (!me.hasClass('loading')) {
            var comment_id = me.data('id');
            var loading    = $('<i class="loading_icon fa fa-spinner fa-spin"></i>');

            me.addClass('loading');
            me.before(loading);

            $.ajax({

                url     : st_params.ajax_url,
                type    : 'post',
                dataType: 'json',
                data    : {
                    action    : 'like_review',
                    comment_ID: comment_id
                },
                success : function (res) {
                    if (res.status) {
                        if (res.data.like_status) {
                            me.addClass('fa-thumbs-o-down').removeClass('fa-thumbs-o-up');
                        } else {
                            me.addClass('fa-thumbs-o-up').removeClass('fa-thumbs-o-down');
                        }

                        if (typeof res.data.like_count != undefined) {
                            res.data.like_count = parseInt(res.data.like_count);
                            me.parent().find('.text-color .number').html(' ' + res.data.like_count);
                        }
                    } else {
                        if (res.error.error_message) {
                            alert(res.error.error_message);
                        }
                    }
                    me.removeClass('loading');
                    loading.remove();
                },
                error   : function (res) {
                    console.log(res);
                    alert('Ajax Faild');
                    me.removeClass('loading');
                    loading.remove();
                }
            });
        }


    });

    //Button Like Review
    $('.st-like-comment').click(function (e) {

        e.preventDefault();

        var me = $(this);


        if (!me.hasClass('loading')) {
            var comment_id = me.data('id');
            var loading    = $('<i class="loading_icon fa fa-spinner fa-spin"></i>');

            me.addClass('loading');
            me.before(loading);

            $.ajax({

                url     : st_params.ajax_url,
                type    : 'post',
                dataType: 'json',
                data    : {
                    action    : 'like_review',
                    comment_ID: comment_id
                },
                success : function (res) {
                    console.log(res);
                    if (res.status) {
                        if (res.data.like_status) {
                            me.addClass('fa-heart').removeClass('fa-heart-o');
                        } else {
                            me.addClass('fa-heart-o').removeClass('fa-heart');
                        }

                        if (typeof res.data.like_count != undefined) {
                            res.data.like_count = parseInt(res.data.like_count);
                            me.next('.text-color').html(' ' + res.data.like_count);
                        }
                    } else {
                        if (res.error.error_message) {
                            alert(res.error.error_message);
                        }
                    }
                    me.removeClass('loading');
                    loading.remove();
                },
                error   : function (res) {
                    console.log(res);
                    alert('Ajax Faild');
                    me.removeClass('loading');
                    loading.remove();
                }
            });
        }


    });


    if( $('.booking-item-price-calc .equipment').length){
        // vc-element cars

        $('.booking-item-price-calc .equipment').on('ifChanged', function(event) {

            var price_total_item = 0;
            var price_convert_total_item = 0;
            var person_ob = new Object();
            var list_selected_equipment = [];
            var $total_price_equipment = 0;
            var $start_timestamp = $('.car_booking_form [name=check_in_timestamp]').val();
            var $end_timestamp = $('.car_booking_form [name=check_out_timestamp]').val();

            $('.singe_cars').find('.equipment').each(function(event) {
                if ($(this)[0].checked == true) {
                    var price = str2num($(this).attr('data-price'));
                    var price_max = str2num($(this).attr('data-price-max'));
                    var num = 1;
                    var parent = $(this).closest('.equipment-list');
                    if( $('select[name="number_equipment"]', parent).length ){
                        num = parseInt($('select[name="number_equipment"]', parent).val());
                    }

                    person_ob[$(this).attr('data-title')] = str2num($(this).attr('data-price')) * num;
                    //alert($(this).data('price-unit'));
                    price_total_item = price_total_item + ((str2num($(this).attr('data-price')) * num) * $(this).data('number-unit'));
                    price_convert_total_item              = price_convert_total_item + (str2num($(this).attr('data-convert-price')) * num * $(this).data('number-unit'));
                    list_selected_equipment.push({
                        title: $(this).attr('data-title'),
                        price: str2num($(this).attr('data-price')),
                        price_unit: $(this).data('price-unit'),
                        price_max: $(this).data('price-max'),
                        number_item: num
                    });
                    var item_price = get_amount_by_unit(str2num($(this).attr('data-price')) * num, $(this).data('price-unit'), $start_timestamp, $end_timestamp);
                    if (item_price > price_max && price_max > 0) {
                        item_price = price_max;
                    }
                    $total_price_equipment += item_price;
                }
            });
            $('.data_price_items').val(JSON.stringify(person_ob));
            $('.st_selected_equipments').val(JSON.stringify(list_selected_equipment));

            var total = 0;
            for(var i = 0; i < list_selected_equipment.length; i++){

            }

            var price_total = price_convert_total_item + str2num($('.st_cars_price').attr('data-value'));


            var regular_price = $('.car_booking_form [name=price]').val();
            var price_time = $('.car_booking_form [name=time]').val();
            var price_unit = $('.car_booking_form [name=price_unit]').val();
            var price_rate = $('.car_booking_form [name=price_rate]').val();
            regular_price = parseFloat(regular_price);
            price_time = parseFloat(price_time);

            var sub_total = $('.car_booking_form .st_cars_price').data('value');

            //$('.st_data_car_equipment_total').html(format_money(price_total_item));
            $('.st_data_car_equipment_total').html(format_money(price_convert_total_item));
            $('.st_data_car_total').html(format_money((price_total)));
            $('.data_price_total').val(price_total);

        });

        $('.booking-item-price-calc select[name="number_equipment"]').each(function(){
            var t = $(this);
            t.change(function(){

                var price_total_item = 0;
                var price_convert_total_item = 0;
                var person_ob = new Object();
                var list_selected_equipment = [];
                var $total_price_equipment = 0;
                var $start_timestamp = $('.car_booking_form [name=check_in_timestamp]').val();
                var $end_timestamp = $('.car_booking_form [name=check_out_timestamp]').val();
                var $start_timestamp = $('.car_booking_form [name=check_in_timestamp]').val();
                var $end_timestamp = $('.car_booking_form [name=check_out_timestamp]').val();

                $('.singe_cars').find('.equipment').each(function(event) {
                    if ($(this)[0].checked == true) {
                        var price = str2num($(this).attr('data-price'));
                        var price_max = str2num($(this).attr('data-price-max'));
                        var num = 1;
                        var parent = $(this).closest('.equipment-list');
                        if( $('select[name="number_equipment"]', parent).length ){
                            num = parseInt($('select[name="number_equipment"]', parent).val());
                        }

                        person_ob[$(this).attr('data-title')] = str2num($(this).attr('data-price')) * num;
                        price_total_item = price_total_item + (str2num($(this).attr('data-price')) * num * $(this).data('number-unit'));
                        price_convert_total_item              = price_convert_total_item + (str2num($(this).attr('data-convert-price')) * num * $(this).data('number-unit'));
                        list_selected_equipment.push({
                            title: $(this).attr('data-title'),
                            price: str2num($(this).attr('data-price')),
                            price_unit: $(this).data('price-unit'),
                            price_max: $(this).data('price-max'),
                            number_item: num
                        });
                        var item_price = get_amount_by_unit(str2num($(this).attr('data-price')) * num, $(this).data('price-unit'), $start_timestamp, $end_timestamp);
                        if (item_price > price_max && price_max > 0) {
                            item_price = price_max;
                        }
                        $total_price_equipment += item_price;
                    }
                });
                $('.data_price_items').val(JSON.stringify(person_ob));
                $('.st_selected_equipments').val(JSON.stringify(list_selected_equipment));

                var price_total = price_convert_total_item + str2num($('.st_cars_price').attr('data-value'));

                var regular_price = $('.car_booking_form [name=price]').val();
                var price_time = $('.car_booking_form [name=time]').val();
                var price_unit = $('.car_booking_form [name=price_unit]').val();
                var price_rate = $('.car_booking_form [name=price_rate]').val();
                regular_price = parseFloat(regular_price);
                price_time = parseFloat(price_time);

                var sub_total = $('.car_booking_form .st_cars_price').data('value');

                //$('.st_data_car_equipment_total').html(format_money(price_total_item ));
                $('.st_data_car_equipment_total').html(format_money(price_convert_total_item ));
                $('.st_data_car_total').html(format_money(price_total));
                $('.data_price_total').val(price_total);

            });

        });
    }

    function get_amount_by_unit($amount, $unit, $start_timestamp, $end_timestamp) {
        var time_diff, $hour_diff;
        var hour = time_diff = $end_timestamp - $start_timestamp;
        if (hour <= 0) {
            hour = 0;
        } else {
            hour = Math.ceil(hour / 3600 / 24);
        }
        if (st_single_car.check_booking_days_included) {
            hour++;
        }
        switch ($unit) {
            case "day":
            case "per_day":
                $amount *= (hour);
                break;
            case "hour":
            case "per_hour":
                $hour_diff = Math.ceil(time_diff / 3600);
                if (st_single_car.check_booking_days_included) {
                    $hour_diff++;
                }

                $amount *= $hour_diff;
                break;
        }
        return $amount;
    }

    function format_money($money) {

        if (!$money) {
            return st_params.free_text;
        }
        //if (typeof st_params.booking_currency_precision && st_params.booking_currency_precision) {
        //    $money = Math.round($money).toFixed(st_params.booking_currency_precision);
        //}

        $money            = st_number_format($money, st_params.booking_currency_precision, st_params.decimal_separator, st_params.thousand_separator);
        var $symbol       = st_params.currency_symbol;
        var $money_string = '';

        switch (st_params.currency_position) {
            case "right":
                $money_string = $money + $symbol;
                break;
            case "left_space":
                $money_string = $symbol + " " + $money;
                break;

            case "right_space":
                $money_string = $money + " " + $symbol;
                break;
            case "left":
            default:
                $money_string = $symbol + $money;
                break;
        }

        return $money_string;
    }

    function st_number_format(number, decimals, dec_point, thousands_sep) {


        number         = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
        var n          = !isFinite(+number) ? 0 : +number,
            prec       = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep        = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec        = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s          = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s              = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
                .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    }

    function str2num(val) {
        val = '0' + val;
        val = parseFloat(val);
        return val;
    }

    $('.share li>a').click(function () {
        var href = $(this).attr('href');
        if (href && $(this).hasClass('no-open') == false) {


            popupwindow(href, '', 600, 600);
            return false;
        }
    });

    function popupwindow(url, title, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top  = (screen.height / 2) - (h / 2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }

    $('.social_login_nav_drop .login_social_link').click(function () {
        var href = $(this).attr('href');

        popupwindow(href, '', 600, 450);
        return false;
    });

    $(document).on('click', '.social_login_nav_drop .login_social_link', function (event) {

        var href = $(this).attr('href');

        popupwindow(href, '', 600, 450);
        return false;

    });


    $('.btn_show_year').click(function () {
        $('.head_control a').removeClass('active');
        $(this).addClass("active");
        $(".st_reports").show(1000);
    });
    if ($('.btn_show_year').hasClass('active')) {
        $(".st_reports").show(1000);
    }
    ;

    var activity_booking_form = $('.activity_booking_form');
    var message_box           = $('.activity_booking_form .message_box');

    $('.activity_booking_form input[type=submit]').click(function () {
        if (validate_activity_booking()) {
            activity_booking_form.submit();
        } else {
            return false;
        }
    });
    activity_booking_form.find('.check_in').each(function () {
        $(this).datepicker(
            'setDates', 'today'
        );
    });

    function validate_activity_booking() {
        var form_validate = true;
        message_box.html('');
        message_box.removeClass('alert');
        var check_in  = activity_booking_form.find('.check_in').val();
        var check_out = activity_booking_form.find('.check_out').val();
        try {
            if (check_in.length > 0 && check_out.length > 0) {
                form_validate = true;
            } else {
                form_validate = false;
                message_box.html('<div class="alert alert-danger">' + st_hotel_localize.is_not_select_date + '</div>');
            }

        } catch (e) {
            console.log(e);
        }
        return form_validate;
    }

    //$('.bg-video').hide();
    setTimeout(function () {
        $('.bg-video').show().css('display', 'block');
    }, 2000);
    $(window).load(function () {
        $('.bg-video').show().css('display', 'block');
    });

    $(document).on('click', '.add-item-to-wishlist', function (e) {
        e.preventDefault();
        var me = $(this);
        var post_id = me.data('id');
        var post_type = me.data('post_type');
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: {
                action: "st_add_wishlist",
                data_id: post_id,
                data_type: post_type
            },
            dataType: "json",
            beforeSend: function() {
                me.addClass('loading');
            }
        }).done(function(html) {
            me.removeClass('loading');
            me.find('i').remove();
            me.append(html.icon);
            me.append('<i class="fa fa-spinner loading""></i>');
            me.attr("data-original-title", html.title);
        });
    });
});
// VC element filter
jQuery(document).ready(function ($) {

    $('.form-custom-taxonomy .item_tanoxomy').on('ifClicked', function (event) {
        var $this  = $(this);
        var $value = '';
        $this.parent().parent().parent().parent().parent().find('.item_tanoxomy').each(function () {
            var $this2 = $(this);
            setTimeout(function () {
                if ($this2.prop('checked')) {
                    $value += $this2.val() + ",";
                }
            }, 100);
        });

        setTimeout(function () {
            console.log($value);
            $this.parent().parent().parent().parent().parent().find('.data_taxonomy').val($value);
            //$('.form-custom-taxonomy .data_taxonomy').val($value);
        }, 200)

    });


});
//List rental room
jQuery(document).ready(function ($) {
    if ($('.st_list_rental_room').length) {
        $('.st_list_rental_room').owlCarousel({
            items         : 4,
            navigation    : true,
            navigationText: ['', ''],
            slideSpeed    : 1000
        });
    }

});
jQuery(window).load(function () {
    // fix safari video display
    window.setTimeout(function () {
        jQuery('.bg-video').css("display", "table");
    }, 2000);
});
jQuery(function ($) {
    //.owl_carousel_style2 , .owl_carousel_style2 * {height: 100%;}
    if ($(".owl_carousel_style2").length > 0) {

        var h = $(window).height();
        if ($(".room_bgr_with_form").height() > 0) {
            h = $(".room_bgr_with_form").height();
        }
        var pos = $(".owl_carousel_style2").css("position");
        if (pos === "absolute") {
            h += $("#menu2").height();
        }

        $(".owl_carousel_style2").height(h);
    }
    if ($(window).width() > 1024) {
        var sheight = ($(window).height() - $(".form_bottom").height());
        //var sheight = $(window).height();
        $(".top-are-fix").height(sheight);
    }

});
/* woocommerce cart */
jQuery(document).ready(function ($) {

    $(document).on('click', '._show_wc_cart_item_information_btn', function (event) {
        event.preventDefault();
        var hide_content = ($(this).attr('data-hide'));
        var content      = $(this).html();
        $(this).attr({
            'data-hide': content
        });
        $(this).html(hide_content);
    });
});
jQuery(document).ready(function ($) {
    $(".search_advance:not(.expanded) input,.search_advance:not(.expanded) select").attr({
        "disabled": "disabled"
    });
    $(document).on('click', '.search_advance', function (event) {
        event.preventDefault();
        var is_expanded = $(this).hasClass('expanded');
        if (is_expanded) {
            $(this).find("select, input").removeAttr('disabled');
        } else {
            $(this).find("select, input").attr({
                "disabled": "disabled"
            });
        }
    });

    /* Check required validate form search*/

    $('form.main-search').submit(function (event) {
        var validate = true;
        $('input.required, select.required, textarea.required', this).each(function (index, el) {
            console.log($(this).val());
            if ($(this).val() == '') {
                $(this).addClass('error');
                $(this).closest('.form-group').find('.bootstrap-select').addClass('error');
                if (validate) validate = false;
            } else {
                $(this).removeClass('error');
                $(this).closest('.form-group').find('.bootstrap-select').removeClass('error');
            }
        });

        if (!validate) {
            return false;
        }
        return true;
    });


    $('.register_form .st_register_service').on('ifChecked', function (event) {
        var $content = $(this).parent().parent().parent().parent().parent();
        $content.find(".col-md-7").show(500);
        $content.find(".col-md-2").show(500);
    });
    $('.register_form .st_register_service').on('ifUnchecked', function (event) {

        var $content = $(this).parent().parent().parent().parent().parent();
        $content.find(".col-md-7").hide(500);
        $content.find(".col-md-2").hide(500);
    });

    $('.register_form .st_register_service').on('ifClicked', function (event) {
        var $this    = $(this);
        var is_check = false;
        $this.parent().parent().parent().parent().parent().parent().find('.st_register_service').each(function () {
            var $this2 = $(this);
            setTimeout(function () {
                console.log($this2.prop('checked'));
                if ($this2.prop('checked') == true) {
                    is_check = true;
                }
            }, 100)
        });
        setTimeout(function () {
            console.log(is_check);
            if (is_check == true) {
                $this.parent().parent().parent().parent().parent().parent().find('.col-md-8').show();
            } else {
                $this.parent().parent().parent().parent().parent().parent().find('.col-md-8').hide();
            }
        }, 200)

    });


    var is_check = false;
    $('.register_form').find('.st_register_service').each(function () {
        var $this2 = $(this);
        setTimeout(function () {
            console.log($this2.prop('checked'));
            if ($this2.prop('checked') == true) {
                is_check = true;
            }
        }, 100)
    });
    setTimeout(function () {
        //console.log(is_check);
        if (is_check == true) {
            $('.register_form').find('.col-md-8').show();
        } else {
            $('.register_form').find('.col-md-8').hide();
        }
    }, 200);


    $('.register_form').find('.st_register_service').each(function () {
        var $this2 = $(this);
        setTimeout(function () {
            console.log($this2.prop('checked'));
            if ($this2.prop('checked') == true) {
                var $content = $this2.parent().parent().parent().parent().parent();
                $content.find(".col-md-7").show(500);
                $content.find(".col-md-2").show(500);
            }
        }, 100)
    });

    $(".btn_partner_send_email_user").click(function () {
        var container = $(this).parent().parent().parent();
        var name      = container.find(".name").val();
        var email     = container.find(".email").val();
        var content   = container.find(".message").val();
        var user_id   = container.find(".user_id").val();
        var check     = true;
        if (name == "") {
            container.find(".name").css("border-color", 'red');
            check = false;
        } else {
            container.find(".name").css("border-color", '#ccc');
            check = true;
        }
        if (email == "") {
            check = false;
            container.find(".email").css("border-color", 'red');
        } else {
            container.find(".email").css("border-color", '#ccc');
            check = true;
        }
        if (content == "") {
            check = false;
            container.find(".message").css("border-color", 'red');
        } else {
            container.find(".message").css("border-color", '#ccc');
            check = true;
        }
        if (check == true) {
            container.find(".ajax_loader").show();
            ;
            $.ajax({
                url     : st_params.ajax_url,
                type    : 'post',
                dataType: 'json',
                data    : {
                    action    : 'send_email_for_user_partner',
                    st_name   : name,
                    st_email  : email,
                    st_content: content,
                    user_id   : user_id
                },
                success : function (res) {
                    console.log(res);
                    container.find(".ajax_loader").hide();
                    ;
                    container.find(".msg").html(res.msg);
                    ;

                    //me.removeClass('loading');
                    // loading.remove();
                },
                error   : function (res) {

                }
            });
        }
    });
    if ($(".st_social_login_success_check").length > 0) {
        window.opener.location.reload();
        window.close();
    }
    ;
    $('.tours-filters input[type=checkbox],.hotel-filters input[type=checkbox],.hotel-filters input[type=checkbox],.tours-filters input[type=checkbox]').on('ifClicked', function (event) {
        var url = $(this).data('url');
        if (url) {
            window.location.href = url;
        }
    });
    $('.cars-filters input[type=checkbox]').on('ifClicked', function (event) {
        var url = $(this).attr('data-url');
        if (url) {
            window.location.href = url;
        }
    });

    //login
    $('.st_login_form_popup').on('submit', function (e) {

        e.preventDefault();

        $.ajax({
            url       : st_params.ajax_url,
            type      : "POST",
            data      : {
                'action'       : 'st_login_popup',
                'user_login'   : $(this).find('#pop-login_name').attr('value'),
                'user_password': $(this).find('#pop-login_password').attr('value')
            },
            dataType  : "json",
            beforeSend: function () {
                $('.btn-submit-form img').show();
            },
            complete  : function (res) {
                var data = res.responseText;
                data     = $.parseJSON(data);
                $('.btn-submit-form img').hide();
                if (data.error) {
                    $('.notice_login').html(data.message);
                    $('.popup_forget_pass').show();
                } else {
                    window.location.href = data.need_link;
                }
            },
            error     : function (msg) {

            }
        });

    });

    function convert_arr(data, action) {
        var res       = {};
        res['action'] = action;
        $.each(data, function (index, item) {
            res[item.name] = item.value;
        });
        return res;
    }

    //Register
    $('.register_form_popup').on('submit', function (e) {

        e.preventDefault();
        var data_form = $('.register_form_popup').serializeArray();
        var formData  = new FormData($('.register_form_popup')[0]);
        $.ajax({
            url        : st_params.ajax_url,
            type       : "POST",
            data       : formData,
            dataType   : "json",
            processData: false,
            contentType: false,
            beforeSend : function () {
                $('.btn-submit-form img').show();
            },
            complete   : function (res) {
                var data = res.responseText;
                data     = $.parseJSON(data);
                $('.btn-submit-form img').hide();

                $('.notice_register').html(data.notice);
                if (!data.error) {
                    $(".register_form_popup .data_field :input[type=text]").each(function () {
                        $(this).val('');
                    });
                    $(".register_form_popup .data_field :input[type=password]").each(function () {
                        $(this).val('');
                    });
                    $(".data_image_certificates").each(function () {
                        $(this).html('');
                    });
                }

            },
            error      : function (msg) {

            }
        });

    });
});
/*flick */
jQuery(document).ready(function ($) {
    $('.flickr_items').each(function () {

        var user_id = $(this).data('uid');
        var me      = $(this);
        var num     = $(this).data('num');
        console.log(num);
        if (user_id) {
            $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + user_id + "&format=json&jsoncallback=?", function (data) {
                for (var i = 0; i <= num; i++) {
                    var pic      = data.items[i];
                    var smallpic = pic.media.m.replace('_m.jpg', '_s.jpg');
                    console.log(i);
                    var item = $("<li><a title='" + pic.title + "' href='" + pic.link + "' target='_blank'><img width=\"75px\" height=\"75px\" src='" + smallpic + "' /></a></li>");
                    me.append(item);
                }
            });
        }
    });
});

jQuery(document).ready(function ($) {
    /*  Show mini cart */
    $('#show-mini-cart-button').click(function (event) {
        /* Act on the event */
        $(this).parent().find('.traveler-cart-mini').toggleClass('open');
        return false;
    });

    $('.i-check').on('ifChanged', function () {
        var t = $(this);
        setTimeout(function () {
            var url = t.data('url');
            console.log(url);
            if (url) {
                window.location.href = url;
            }
        }, 500);
    });
});
jQuery(document).ready(function ($) {
    $('input.required-field').each(function (index, el) {
        var form = $(this).parents('form');
        //console.log($(this).prop('checked'));
        if ($(this).prop('checked') == true) {
            $('.form-drop-off', form).addClass('field-hidden');
        } else {
            $('.form-drop-off', form).removeClass('field-hidden');
        }
    });

    jQuery(window).bind("load", function ($) {
        fix_weather_();
    });
    jQuery(window).resize(function ($) {
        fix_weather_();
        full_height_init();
        full_width_init();
    });
    function fix_weather_() {
        var e = $(".top-user-area").parent(".get_location_weather");
        e.remove();
        if ($(window).width() <= 992) {
            $(".menu_div").after(e);
        } else {
            $(".slimmenu-menu-collapser").parent(".nav").parent(".col-lg-8").after(e);
        }
    }

    function full_width_init() {
        var ww   = $(window).width();
        var left = (ww - 1170 + 30) / 2;
        if (ww < 1380) {
            left = (ww - 1170 + 30) / 2;
        }
        if (ww < 1199) {
            left = (ww - 970 + 30) / 2;
        }
        if (ww < 991) {
            left = (ww - 750 + 30) / 2;
        }
        if (ww < 767) {
            left = 15;
        }
        $('.st-new-fullwidth').css({'width': ww + 'px', 'left': '-' + left + 'px', position: 'relative'});
    }

    full_width_init();

    function full_height_init() {
        var wh          = $(window).height();
        var hh          = $('#st_header_wrap').height();
        var full_height = wh - hh;
        if ($('#wpadminbar').length > 0) {
            full_height = full_height - $('#wpadminbar').height();
        }
        if (full_height < 480) {
            full_height = 480;
        }

        $('.st-full-height').css({height: full_height + 'px'});
    }

    full_height_init();

    $(window).load(function () {
        if ($('.tour-gallery').length > 0) {
            var owl = $('.tour-gallery');
            owl.owlCarousel({
                items            : 1,
                center           : true,
                loop             : true,
                autoPlay         : 7000,
                itemsDesktop     : [1199, 1],
                itemsDesktopSmall: [979, 1],
                itemsTablet      : [768, 1],
                itemsTabletSmall : false,
                itemsMobile      : [479, 1],
                dots             : false

            });
            owl.parent().find(".owl-prev").click(function () {
                owl.trigger('owl.prev');
            });
            owl.parent().find(".owl-next").click(function () {
                owl.trigger('owl.next');
            });
        }
    });


    $('.on_the_map .btn-on-map').each(function () {
        $(this).on('click', function (e) {
            e.preventDefault();

            var p = $(this).parent().parent();
            $(this).toggleClass('active');
            if ($(this).hasClass('active')) {
                $(this).text($(this).data('hide'));
            } else {
                $(this).text($(this).data('no-hide'));
            }
            p.find('.st-tour-map').toggleClass('st-hide');
            p.find('.review-price').toggleClass('active');
        });
    });
    //Map new
    function selectStyle(name) {
        var style = [];
        if (name == 'style_normal') {
            style = [{
                featureType: "road.highway",
                elementType: "geometry",
                stylers    : [{saturation: 60}, {lightness: -20}]
            }];
        }
        if (name == 'style_midnight') {
            style = [{
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers"    : [{"saturation": 36}, {"color": "#000000"}, {"lightness": 40}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]
            }, {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers"    : [{"color": "#000000"}, {"lightness": 20}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers"    : [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}, {"lightness": "0"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "13"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 20}]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 21}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}, {"saturation": "-100"}, {"lightness": "-20"}, {"invert_lightness": true}]
            }, {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers"    : [{"color": "#bebebe"}]
            }, {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "-47"}]
            }, {
                "featureType": "road",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"lightness": "-33"}, {"weight": "0.52"}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#b5b5b5"}, {"saturation": "-1"}, {"gamma": "0.00"}, {"weight": "2.22"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers"    : [{"lightness": "0"}, {"visibility": "on"}, {"weight": "2.8"}, {"color": "#585858"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers"    : [{"color": "#909090"}, {"lightness": "2"}, {"weight": "0.2"}, {"visibility": "off"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers"    : [{"lightness": "16"}, {"color": "#595959"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"lightness": "-63"}, {"weight": "1"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 18}, {"visibility": "on"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "10"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"lightness": "28"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"weight": "0.1"}, {"lightness": "-96"}]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 16}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers"    : [{"color": "#000000"}, {"lightness": 19}]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers"    : [{"color": "#12161a"}, {"lightness": 17}]
            }];
        }
        if (name == 'style_family_fest') {
            style = [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers"    : [{"color": "#444444"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers"    : [{"color": "#f2f2f2"}]
            }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"saturation": "-6"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}, {"weight": "1.30"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers"    : [{"saturation": -100}, {"lightness": 45}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers"    : [{"visibility": "off"}]
            }, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#52978e"}, {"visibility": "on"}]}];
        }
        if (name == 'style_open_dark') {
            style = [{
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers"    : [{"color": "#ffffff"}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"color": "#3e606f"}, {"weight": 2}, {"gamma": 0.84}]
            }, {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "administrative",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers"    : [{"weight": 0.6}, {"color": "#1a3541"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}, {"color": "#293c4d"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers"    : [{"color": "#2c5a71"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers"    : [{"color": "#293c4d"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers"    : [{"color": "#406d80"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers"    : [{"color": "#2c5a71"}]
            }, {"featureType": "road", "elementType": "all", "stylers": [{"visibility": "on"}]}, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers"    : [{"color": "#1f3035"}, {"lightness": -37}]
            }, {
                "featureType": "road",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers"    : [{"color": "#406d80"}]
            }, {
                "featureType": "transit",
                "elementType": "labels.icon",
                "stylers"    : [{"hue": "#00d1ff"}]
            }, {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#193341"}]}];
        }
        if (name == 'style_riverside') {
            style = [{
                "featureType": "administrative",
                "elementType": "all",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}, {"color": "#716464"}, {"weight": "0.01"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "administrative.country",
                "elementType": "labels.text",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "landscape",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "landscape.natural.landcover",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "poi.attraction",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "poi.business",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.business",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.government",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "poi.school",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers"    : [{"visibility": "off"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"color": "#787878"}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers"    : [{"visibility": "simplified"}, {"color": "#a05519"}, {"saturation": "-13"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text",
                "stylers"    : [{"color": "#fcfcfc"}, {"visibility": "on"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers"    : [{"color": "#636363"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"weight": "4.27"}, {"color": "#ffffff"}]
            }, {
                "featureType": "road.highway",
                "elementType": "labels.icon",
                "stylers"    : [{"visibility": "on"}, {"weight": "0.01"}]
            }, {
                "featureType": "road.local",
                "elementType": "all",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "transit",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "simplified"}]
            }, {
                "featureType": "transit.station",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers"    : [{"visibility": "simplified"}, {"color": "#84afa3"}, {"lightness": 52}]
            }, {
                "featureType": "water",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}]
            }, {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers"    : [{"visibility": "on"}, {"color": "#7ca0a4"}]
            }, {"featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#ffffff"}]}];
        }
        if (name == 'style_ozan') {
            style = [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers"    : [{"visibility": "on"}, {"weight": 1}, {"color": "#003867"}]
            }, {
                "featureType": "administrative",
                "elementType": "labels.text.stroke",
                "stylers"    : [{"visibility": "on"}, {"weight": 8}]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#E1001A"}, {"weight": 0.4}]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": 0.2}]
            }, {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers"    : [{"visibility": "on"}, {"color": "#edeff1"}, {"weight": 0.4}]
            }];
        }
        if (name == 'style_icy_blue') {
            style = [{"stylers": [{"hue": "#2c3e50"}, {"saturation": 250}]}, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers"    : [{"lightness": 50}, {"visibility": "simplified"}]
            }, {"featureType": "road", "elementType": "labels", "stylers": [{"visibility": "off"}]}]
        }

        return style
    }

    window.__ = {};

    var map_element = $('#st-tour-map-new');

    if (map_element.length > 0 && typeof google === 'object') {

        var style = 'style_normal';
        if (map_element.data('style') != undefined) {
            style = map_element.data('style');
        }

        var autoload = true;
        if (map_element.data('autoload_map') == 0) {
            autoload = false
        }
        window.__.map_data = {
            map_element: map_element,
            location   : map_element.data('location'),
            style      : selectStyle(style),
            style_name : style,
            map        : {},
            map_width  : 0,
            map_height : 0,
            marker     : {},
            marker_data: map_element.data('marker-data'),
            autoload   : autoload,
            marker_icon: map_element.data('marker-icon')
        };

        $('.on_the_map .btn-on-map').on('click', function (e) {
            e.preventDefault();
            if (!__.map_data.autoload) {
                __.map_render.loadmap();
                __.map_render.on();
                __.map_render.responsive();
                __.map_data.autoload = true;
            }
        });

        $(window).load(function () {
            if (!__.map_data.autoload) {
                __.map_render.loadmap();
                __.map_render.on();
                __.map_render.responsive();
                __.map_data.autoload = true;
            }
        });

        var map_render = function () {
        };

        map_render.prototype.init = function () {
            if (__.map_data.autoload) {
                __.map_render.loadmap();
                __.map_render.on();
            }
        };

        var map;

        map_render.prototype.loadmap = function () {

            var scroll      = false, draggable = false;
            __.map_data.map = new google.maps.Map(__.map_data.map_element[0], {
                scrollwheel          : scroll,
                zoom                 : parseInt(__.map_data.location.zoom),
                center               : new google.maps.LatLng(parseFloat(__.map_data.location.lat), parseFloat(__.map_data.location.lng)),
                styles               : __.map_data.style,
                mapTypeId            : google.maps.MapTypeId.ROADMAP,
                zoomControl          : false,
                mapTypeControl       : false,
                scaleControl         : false,
                streetViewControl    : false,
                rotateControl        : false,
                fullscreenControl    : false,
                mapTypeControlOptions: {
                    style     : google.maps.MapTypeControlStyle.DEFAULT,
                    mapTypeIds: [
                        google.maps.MapTypeId.ROADMAP,
                        google.maps.MapTypeId.TERRAIN
                    ]
                }
            });

            map = __.map_data.map;

            //Create marker

            if (__.map_data.marker_data != undefined && __.map_data.marker_data != '') {
                var class_dark = '';
                if (__.map_data.style_name == 'style_midnight') {
                    class_dark = 'dark';
                }
                __.map_data.marker = new RichMarker({
                    position : new google.maps.LatLng(parseFloat(__.map_data.location.lat), parseFloat(__.map_data.location.lng)),
                    map      : __.map_data.map,
                    draggable: draggable,
                    shadow   : 'none',
                    animation: google.maps.Animation.DROP,
                    content  : '<div class="padding-bottom30 ' + class_dark + '"><div class="large-marker-hotel "><div class="bg-thumb" style="background: url(' + __.map_data.marker_data.thumb + ')"></div><div class="caption"><h3 class="title">' + __.map_data.marker_data.title + '</h3><span class="location">' + __.map_data.marker_data.in + '</span></div></div></div>'
                });
            } else {
                var marker = new google.maps.Marker({
                    position : new google.maps.LatLng(parseFloat(__.map_data.location.lat), parseFloat(__.map_data.location.lng)),
                    map      : __.map_data.map,
                    draggable: false,
                    icon     : __.map_data.marker_icon,
                    animation: google.maps.Animation.DROP
                });
            }

            this.loadmap.fullHeight = function () {
                var ww = $(window).width();
                if (__.map_data.full_height) {
                    var hw = $(window).height();
                    if (hw < 480) {
                        hw = 480;
                    }
                    if ($('#wpadminbar').length > 0) {
                        hw = hw - $('#wpadminbar').height();
                    }

                    if ($('.topbar  .no-transparent').length > 0 && ww > 991) {
                        var ht = $('.topbar  .no-transparent').height();
                        hw     = hw - ht;
                    }

                    if (hw < 480) {
                        hw = 480;
                    }

                    if (ww < parseInt(__.map_data.check_width) && parseInt(__.map_data.check_width) > 0) {
                        hw = 300;
                    }

                    __.map_data.map_element.height(hw);

                }
            };

            __.map_render.loadmap.fullHeight();
            __.map_render.action();

        };

        map_render.prototype.responsive = function () {
            if (__.map_data.autoload) {
                __.map_render.loadmap.fullHeight();
            }
            google.maps.event.trigger(__.map_data.map, "resize");
        };

        map_render.prototype.action = function (type, args) {

            this.action.clickZoomControl = function (type) {
                switch (type) {
                    case 'my-location':
                        var my_location = new google.maps.Marker({
                            clickable: false,
                            //animation: google.maps.Animation.DROP,
                            icon     : new google.maps.MarkerImage('https://maps.gstatic.com/mapfiles/ms2/micons/green-dot.png'),
                            shadow   : null,
                            zIndex   : 999,
                            map      : __.map_data.map
                        });
                        if (navigator.geolocation) navigator.geolocation.getCurrentPosition(function (pos) {
                            var me = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
                            my_location.setPosition(me);
                            __.map_data.map.panTo(me);
                        }, function (error) {

                        });
                        break;
                    case 'zoom-in':
                        var zoom_in = __.map_data.map.getZoom();
                        __.map_data.map.setZoom(zoom_in + 1);
                        break;
                    case 'zoom-out':
                        var zoom_out = __.map_data.map.getZoom();
                        __.map_data.map.setZoom(zoom_out - 1);
                        break;
                }
            };
            this.action.clickViewControl = function (type, args) {
                switch (type) {
                    case 'full-screen':
                        __.map_data.map_width  = __.map_data.map_element.css('width');
                        __.map_data.map_height = __.map_data.map_element.css('height');
                        __.map_data.map_element.css({
                            position       : 'fixed',
                            top            : 0,
                            left           : 0,
                            width          : '100%',
                            height         : '100%',
                            backgroundColor: 'dark',
                            'z-index'      : '9999999'
                        });
                        $('.st-tour-map .zoom-control').css({
                            'z-index': 10000000,
                            position : 'fixed'
                        });
                        $('.st-tour-map .view-control').css({
                            'z-index': 10000000,
                            position : 'fixed'
                        });

                        __.map_data.map_element.closest('.st-tour-map').css({
                            position : 'fixed',
                            top      : 0,
                            left     : 0,
                            'z-index': '9999999'
                        });

                        google.maps.event.trigger(__.map_data.map, "resize");

                        $('.full-screen').toggle();
                        $('.exit-full-screen').toggle();

                        break;
                    case 'exit-full-screen':

                        __.map_data.map_element.css({
                            position       : 'relative',
                            'z-index'      : 0,
                            top            : 0,
                            width          : __.map_data.map_width,
                            height         : __.map_data.map_height,
                            backgroundColor: 'transparent'
                        });

                        __.map_data.map_element.closest('.st-tour-map').css({
                            position : 'absolute',
                            top      : 0,
                            left     : 0,
                            'z-index': '2'
                        });

                        $('.st-tour-map .zoom-control').css({
                            'z-index': 1,
                            position : 'absolute'
                        });
                        var ww = $(window).width();
                        if (ww > 640) {
                            $('.st-tour-map .view-control').css({
                                'z-index': 1,
                                position : 'absolute'
                            });
                        } else {
                            $('.st-tour-map .view-control').css({
                                'z-index': 99,
                                position : 'absolute'
                            });
                        }

                        $('.full-screen').toggle();
                        $('.exit-full-screen').toggle();
                        break;
                    case 'view':
                        if (!args.element.hasClass('active')) {
                            args.element.addClass('active');
                            $('.st-tour-map .view-control .map_type').fadeIn(300);
                        } else {
                            args.element.removeClass('active');
                            $('.st-tour-map .view-control .map_type').fadeOut(300);
                        }
                        break;
                }
            };
            this.action.clickMapType     = function (type) {
                if (__.map_data.style_name != type) {
                    __.map_data.style_name = type;
                    __.map_data.style      = selectStyle(type);
                    var customMapType      = new google.maps.StyledMapType(__.map_data.style);
                    __.map_data.map.mapTypes.set('styled_map', customMapType);
                    __.map_data.map.setMapTypeId('styled_map');
                }
            };

        };

        map_render.prototype.on = function () {
            $('body').on('click', '.map-content-marker .icon_marker', function (e) {
                e.preventDefault();
                __.map_render.action.clickMarker({element: $(this)});
            });

            $('.st-tour-map .zoom-control a').each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault();
                    __.map_render.action.clickZoomControl($(this).attr('class'));
                });
            });

            $('.st-tour-map .view-control a').each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault();
                    __.map_render.action.clickViewControl($(this).attr('data-class'), {element: $(this)});
                });
            });

            $('.st-tour-map .view-control .map_type span').each(function () {
                $(this).on('click', function (e) {
                    e.preventDefault();
                    __.map_render.action.clickMapType($(this).attr('data-map'));
                });
            });

        };

        window.__.map_render = new map_render();
        __.map_render.init();

        $(window).on('resize', function () {
            __.map_render.responsive();
        })
    }

    if ($('.collapse-user').length) {
        $('.collapse-user').click(function (event) {
            /* Act on the event */
            $('.user-nav-wrapper').toggleClass('open');
            return false;
        });
    }
    var width_window = $(window).width();
    if (width_window < 768) {
        $('.st-elements-filters').each(function () {
            $(this).find('li .booking-filters-title').addClass('closed');
            $(this).find('li > div').css('display', 'none');
        });
    }

    if ($('.transfer-selectpicker').length) {
        $('.transfer-selectpicker').selectpicker({
            size: 10
        });
        //$('.transfer-selectpicker').tooltip('disable');
    }
});


// Custom 2
jQuery(function ($) {
    $("#st_enable_javascript").each(function () {
        if ($(this).hasClass("allow")) {
            $("#st_enable_javascript").html(".search-tabs-bg > .tabbable >.tab-content > .tab-pane{display: none; opacity: 0;}" + ".search-tabs-bg > .tabbable >.tab-content > .tab-pane.active{display: block;opacity: 1;}" + ".search-tabs-to-top { margin-top: -120px;}")
        }
    })
});
jQuery(document).ready(function ($) {
    if (typeof $.fn.sticky != 'undefined') {
        var topSpacing = 0;
        if ($(window).width() > 481 && $('body').hasClass('admin-bar')) {
            topSpacing = $('#wpadminbar').height()
        }
        set_sticky()
    }
    function set_sticky() {
        var is_menu1 = $(".menu_style1").length;
        var is_menu2 = $(".menu_style2").length;
        var is_menu3 = $(".menu_style3").length;
        var is_menu4 = $(".menu_style4").length;
        var is_topbar = $("#top_toolbar").length;
        var sticky_topbar = $(".enable_sticky_topbar").length;
        var sticky_menu = $(".enable_sticky_menu").length;
        var sticky_header = $(".enable_sticky_header").length;
        if (sticky_header || (sticky_menu && sticky_topbar)) {
            $("#st_header_wrap_inner").sticky({topSpacing: topSpacing});
            return
        } else {
            if (sticky_topbar && is_topbar) {
                $("#top_toolbar").sticky({topSpacing: topSpacing})
            }
            if (sticky_menu && (is_menu1 || is_menu2 || is_menu3 || is_menu4)) {
                var topSpacing_topbar = topSpacing;
                if (is_topbar && sticky_topbar) {
                    topSpacing_topbar += $("#top_toolbar").height()
                }
                $("#menu1").sticky({topSpacing: topSpacing_topbar});
                $("#menu2").sticky({topSpacing: topSpacing_topbar});
                $("#menu3").sticky({topSpacing: topSpacing_topbar});
                $("#menu4").sticky({topSpacing: topSpacing_topbar});
                return
            }
        }
        return
    }

    function other_sticky(spacing) {
    }

    if ($('body').hasClass('search_enable_preload')) {
        window.setTimeout(function () {
            $('.full-page-absolute').fadeOut().addClass('.hidden')
        }, 1000)
    }
    $('#gotop').click(function () {
        $("body,html").animate({scrollTop: 0}, 1000, function () {
            $('#gotop').fadeOut()
        })
    });
    $(window).scroll(function () {
        var scrolltop = $(window).scrollTop();
        if (scrolltop > 200) {
            $('#gotop').fadeIn()
        } else {
            $('#gotop').fadeOut()
        }
        scroll_with_out_transparent()
    });
    scroll_with_out_transparent();
    function scroll_with_out_transparent() {
        var sdlfkjsdflksd_scrolltop = $(window).scrollTop();
        var header_bgr_default = {'background-color': ""};
        if ($("body").hasClass("menu_style2") && sdlfkjsdflksd_scrolltop != 0 && $('.enable_sticky_menu.header_transparent').length !== 0) {
            $(".header-top").css(st_params.header_bgr)
        } else {
            $(".header-top").css(header_bgr_default)
        }
    }

    var top_ajax_search = $('.st-top-ajax-search');
    if (top_ajax_search.length) {
        top_ajax_search.typeahead({hint: !0, highlight: !0, minLength: 3, limit: 8}, {
            source: function (q, cb) {
                $('.st-top-ajax-search').parent().addClass('loading');
                return $.ajax({
                    dataType: 'json',
                    type: 'get',
                    url: st_params.ajax_url,
                    data: {
                        security: st_params.st_search_nonce,
                        action: 'st_top_ajax_search',
                        s: q,
                        lang: top_ajax_search.data('lang')
                    },
                    cache: !0,
                    success: function (data) {
                        $('.st-top-ajax-search').parent().removeClass('loading');
                        var result = [];
                        if (data.data) {
                            $.each(data.data, function (index, val) {
                                result.push({
                                    value: val.title,
                                    location_id: val.id,
                                    type_color: 'success',
                                    type: val.type,
                                    url: val.url
                                })
                            });
                            cb(result);
                            console.log(result)
                        }
                    },
                    error: function (e) {
                        $('.st-top-ajax-search').parent().removeClass('loading')
                    }
                })
            },
            templates: {suggestion: Handlebars.compile('<p class="search-line-item"><label class="label label-{{type_color}}">{{type}}</label><strong> {{value}}</strong></p>')}
        });
        top_ajax_search.bind('typeahead:selected', function (obj, datum, name) {
            if (datum.url) {
                window.location.href = datum.url
            }
        })
    }
    if ($.fn.chosen) {
        $(".chosen_select").chosen()
    }
    $('.woocommerce-ordering .posts_per_page').change(function () {
        $('.woocommerce-ordering').submit()
    });
    var product_timeout;
    $('.woocommerce li.product').hover(function () {
        var me = $(this);
        product_timeout = window.setTimeout(function () {
            me.find('.product-info-hide').slideDown('fast')
        }, 250)
    }, function () {
        window.clearTimeout(product_timeout);
        var me = $(this);
        me.find('.product-info-hide').slideUp('fast')
    });
    var menu3_resize = null;
    $(window).resize(function (event) {
        clearTimeout(menu3_resize);
        if ($('header#menu3').length) {
            menu3_resize = setTimeout(function () {
                if (window.matchMedia("(min-width: 1200px)").matches) {
                    var container = $('#top_header .container').height();
                    var menu = $('#slimmenu').height();
                    $('header#menu3 .nav').css('margin-top', (container - menu) / 2)
                }
            }, 500)
        }
    }).resize();
    $('#search-icon').click(function (event) {
        $('.main-header-search').fadeIn('fast');
        return !1
    });
    $('#search-close').click(function (event) {
        $('.main-header-search').fadeOut('fast');
        return !1
    });
    if ($('.st-slider-list-hotel').length) {
        $('.st-slider-list-hotel').owlCarousel({
            items: 1,
            singleItem: !0,
            slideSpeed: 500,
            transitionStyle: $('.st-slider-list-hotel').data('effect'),
            autoHeight: !0
        })
    }
    if ($("#owl-twitter").length) {
        $("#owl-twitter").owlCarousel({
            navigation: !0,
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: !0,
            navigationText: ["", ""],
            pagination: !1,
            autoPlay: !0
        })
    }
    var st_list_partner = $(".st_list_partner");
    setTimeout(function () {
        st_list_partner.each(function () {
            var items = $(this).data('items');
            var speed = $(this).data('speed');
            var autoplay = $(this).data('autoplay');
            autoplay = (autoplay == 'yes') ? !0 : !1;
            $(this).owlCarousel({
                slideSpeed: speed,
                paginationSpeed: 400,
                navigationText: ["", ""],
                pagination: !1,
                navigation: !1,
                autoPlay: autoplay,
                items: 4,
                itemsDesktop: [1000, 4],
                itemsDesktopSmall: [900, 3],
                itemsTablet: [600, 1],
                itemsMobile: !1
            })
        })
    }, 500);
    $(".st_list_partner_nav .next").click(function () {
        st_list_partner.trigger('owl.next')
    });
    $(".st_list_partner_nav .prev").click(function () {
        st_list_partner.trigger('owl.prev')
    });
    $(".st_tour_ver_countdown").each(function () {
        $(this).syotimer({
            year: parseInt($(this).data('year')),
            month: parseInt($(this).data('month')),
            day: parseInt($(this).data('day')),
            hour: 0,
            minute: 0,
            lang: ($(this).data('lang')),
        })
    })
    if ($('.st_tour_ver_fotorama').length) {
        $('.st_tour_ver_fotorama').fotorama({nav: !1,})
    }
    var flag_ajax_coupon = !1;
    $('body').on('click', '.add-coupon-ajax', function () {
        var t = $(this), overlay = t.closest('.booking-item-payment').find('.overlay-form'), form = t.closest('form'), alert = $('.alert', form), data = form.serializeArray();
        if (flag_ajax_coupon) {
            return !1
        }
        flag_ajax_coupon = !0;
        overlay.fadeIn();
        alert.addClass('hidden').html('');
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            if (respon.status == 1) {
                overlay.fadeIn();
                var data = {'action': 'modal_get_cart_detail'};
                $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                    t.closest('.booking-item-payment').html(respon);
                    overlay.fadeOut();
                    flag_ajax_coupon = !1
                }, 'json')
            } else {
                alert.removeClass('hidden').html(respon.message);
                overlay.fadeOut();
                flag_ajax_coupon = !1
            }
        }, 'json');
        return !1
    });
    var flagApplyCoupon = 1;
    $('body').on('click', '.booking-item-coupon form button', function (e) {
        if (!$(this).hasClass('add-coupon-ajax')) {
            if(flagApplyCoupon == 0){
                return false;
            }
            flagApplyCoupon = 0;

            e.preventDefault();

            var form = $(this).closest('form');
            $(this).append('<i class="fa fa-spinner fa-spin"></i>');
            var data = {
                'action': 'apply_mdcoupon_function',
                'code': $('#field-coupon_code', form).val()
            };
            $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                if (respon.status == 1) {
                    form.submit();
                }
            }, 'json');
        }
    });
    $('body').on('click', '.ajax-remove-coupon', function (event) {
        event.preventDefault();
        var t = $(this), overlay = t.closest('.booking-item-payment').find('.overlay-form'), form = t.closest('form'), alert = $('.alert', form);
        if (flag_ajax_coupon) {
            return !1
        }
        flag_ajax_coupon = !0;
        overlay.fadeIn();
        var data = {'action': 'ajax_remove_coupon', 'coupon': $(this).data('coupon')};
        $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
            overlay.fadeIn();
            var data = {'action': 'modal_get_cart_detail'};
            $.post(st_params.ajax_url, data, function (respon, textStatus, xhr) {
                t.closest('.booking-item-payment').html(respon);
                overlay.fadeOut();
                flag_ajax_coupon = !1
            }, 'json')
        }, 'json')
    });
    $('#myModal').modal('show')
});
jQuery(document).ready(function ($) {
    $('.extra-collapse a').click(function (e) {
        e.preventDefault();
        var p = $(this).closest('.extra-price');
        if (p.find('.extra-collapse-control').hasClass('extra-none')) {
            $(this).find('i').removeClass('fa-angle-double-down');
            $(this).find('i').addClass('fa-angle-double-up');
            p.find('.extra-collapse-control').removeClass('extra-none')
        }
        else {
            $(this).find('i').removeClass('fa-angle-double-up');
            $(this).find('i').addClass('fa-angle-double-down');
            p.find('.extra-collapse-control').addClass('extra-none')
        }
    });
    if ($('.has-matchHeight', 'body').length) {
        $('.has-matchHeight', 'body').matchHeight()
    }
});


jQuery(function ($) {
    $('.ac-gallery').each(function () {
        var owl1 = $(this);
        owl1.owlCarousel({
            items: 1,
            loop: true,
            autoplay: false,
            dots: false,
            pagination: false
        });
        $(this).parent().find(".owl-prev").click(function () {
            owl1.trigger('owl.prev');
        });
        $(this).parent().find(".owl-next").click(function () {
            owl1.trigger('owl.next');
        });
    });

    $('.accommodation-single-map .st_list_map .content_map #list_map').each(function () {
        var wh = $(window).height();
        var hh = $('#st_header_wrap').height();
        var full_height = wh - hh;
        if ($('#wpadminbar').length > 0) {
            full_height = full_height - $('#wpadminbar').height();
        }
        if (full_height < 480) {
            full_height = 480;
        }

        $(this).css({height: full_height + 'px'});
    });

    $('.on_the_map .btn-on-map').each(function () {
        $(this).on('click', function (e) {
            e.preventDefault();

            var p = $(this).parent().parent();
            $(this).toggleClass('active');
            if ($(this).hasClass('active')) {
                $(this).text($(this).data('hide'));
            } else {
                $(this).text($(this).data('no-hide'));
            }
            p.find('.accommodation-single-map').toggleClass('active');
            p.find('.review-price').toggleClass('active');
        });
    });


    //Inbox
    $('.st-inbox-send').click(function(e){
        e.preventDefault();
        var p = $(this).closest('.st-form-inbox');
        var t = $(this);
        if(p.find('input[name="inbox-title"]').val() == ''){
            p.find('input[name="inbox-title"]').addClass('wb-error');
        }else if(p.find('textarea[name="inbox-message"]').val() == '' ){
            p.find('textarea[name="inbox-message"]').addClass('wb-error');
        }else{
            var id = p.find('input[name="post_id"]').val();
            var to_user = p.find('input[name="to_user"]').val();
            var title = p.find('input[name="inbox-title"]').val();
            var message = p.find('textarea[name="inbox-message"]').val();
            t.addClass('loading');
            p.find('input[name="inbox-title"]').removeClass('wb-error');
            p.find('textarea[name="inbox-message"]').removeClass('wb-error');
            $.ajax({
                url: st_params.ajax_url,
                data: {
                    action: 'send_message_partner',
                    id: id,
                    title: title,
                    message: message,
                    to_user: to_user,
                    st_send_message : p.find('input[name="st_send_message"]').val(),
                    _wp_http_referer : p.find('input[name="_wp_http_referer"]').val(),
                },
                dataType: 'json',
                type: 'POST',
                success: function(msg){
                    if(msg.status == 1){
                        p.find('.inbox-group').hide();
                        p.find('.inbox-notice').addClass('success');
                        p.find('.inbox-notice').text(p.find('.inbox-notice').data('success'));
                        p.find('.detail-message').attr('href', msg.link_detail);
                        p.find('.detail-message').removeClass('hide');
                        p.find('.inbox-notice').addClass('alert-success').removeClass('hide').removeClass('alert-danger');
                    }else{
                        if(msg.message.length < 0){
                            p.find('.inbox-notice').text(p.find('.inbox-notice').data('error'));
                        }else{
                            p.find('.inbox-notice').html(msg.message);
                        }
                        p.find('.inbox-notice').addClass('alert-danger').removeClass('hide');
                    }
                    t.removeClass('loading');
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    });
    $('.inbox-reply-btn').click(function (e) {
        e.preventDefault();
        var p = $(this).closest('.form-reply');
        var t = $(this);
        if(p.find('textarea[name="reply-content"]').val() == ''){
            p.find('textarea[name="reply-content"]').addClass('wb-error');
        }else{
            var content = p.find('textarea[name="reply-content"]').val();
            t.addClass('loading');
            $.ajax({
                url: st_params.ajax_url,
                data:{
                    action: 'inbox_reply_message',
                    content: content,
                    to_user: p.find('input[name="to_user"]').val(),
                    parent_id: p.find('input[name="message_id"]').val(),
                    post_id: p.find('input[name="post_id"]').val()
                },
                dataType: 'json',
                type: 'POST',
                success: function(msg){
                    if(msg.status == 1){
                        var html = '<div class="message-item from">' +
                            '<div class="user-avatar">' +msg.data.avatar+
                            '<span>'+msg.data.username+'</span>' +
                            '</div>' +
                            '<div class="message-item-content">'
                            +'<span>'+msg.data.content+'</span>'
                            +'<span>'+msg.data.created_at+'</span>' +
                            '</div>'
                            +'</div>';
                        $('.st-inbox-body-detail .message-box').append(html);
                        p.find('textarea[name="reply-content"]').val('');
                        p.find('textarea[name="reply-content"]').removeClass('wb-error');
                        if(jQuery().niceScroll){
                            $('.st-inbox-body-detail .message-box').niceScroll();
                        }
                        //var pos = $('.message-box .message-item').last().position().top;
                        //$('.st-inbox-body-detail .message-box').animate({scrollTop: pos}, 'slow');
                    }
                    t.removeClass('loading');
                },
                error: function(e){
                    console.log(e);
                }
            });
        }
    });
    $('.btn_remove_message').click(function () {
        var container = $(this).closest('.st-inbox-body');
        var p = $(this).closest('.message-item');
        var t = $(this);
        t.addClass('loading');
        $.ajax({
            url: st_params.ajax_url,
            data:{
                action: 'inbox_remove_message',
                message_id: t.data('message-id'),
            },
            dataType: 'json',
            type: 'POST',
            success: function(msg){
                p.remove();
                container.find('.count_message').html(msg.total_message);
            },
            error: function(e){
                t.removeClass('loading');
            }
        });
    });

    $('.message-box').each(function(){
        if(jQuery().niceScroll){
            $('.st-inbox-body-detail .message-box').niceScroll();
        }
        /*if($('.message-box .message-item').length > 0) {
            var pos = $('.message-box .message-item').last().position().top;
            $('.st-inbox-body-detail .message-box').animate({scrollTop: pos}, 'slow');
        }*/
    });

    $('.st_last_message_id').each(function(){
        var $this = $(this);
        var container = $(this).closest('.st-inbox-body-detail');
        var is_get_data = true;
        setInterval(function(){
            var last_message_id = $this.val();
            if(is_get_data == false ) return false;
            is_get_data = false;
            $.ajax({
                url: st_params.ajax_url,
                data:{
                    action: 'inbox_get_last_message',
                    last_message_id: last_message_id,
                    message_id: $this.data('message_id'),
                    user_id: $this.data('user_id'),
                    post_id: $this.data('post_id')
                },
                dataType: 'json',
                type: 'POST',
                success: function(msg){
                    is_get_data = true;
                    if(msg.length > 0){
                        for (var key in msg){
                            var attrValue = msg[key];
                            var html = '<div class="message-item to">' +
                                '<div class="user-avatar">' +attrValue.avatar+
                                '<span>'+attrValue.username+'</span>' +
                                '</div>' +
                                '<div class="message-item-content">'
                                +'<span>'+attrValue.content+'</span>'
                                +'<span>'+attrValue.created_at+'</span>' +
                                '</div>'
                                +'</div>';
                            container.find('.message-box').append(html);
                            container.find('.st_last_message_id').val(attrValue.id);
                        }
                    }
                    if(jQuery().niceScroll){
                        container.find('.message-box').niceScroll();
                    }
                    //var pos = $('.message-box .message-item').last().position().top;
                    //container.find('.message-box').animate({scrollTop: pos}, 'slow');
                },
                error: function(e){
                }
            });
        },10000);
    });
    $.ajax({
        url: st_params.ajax_url,
        data: {
            action: 'check_inbox_notification'
        },
        dataType: 'json',
        type: 'POST',
        success: function (msg) {
            if(msg.status == 1 && (msg.old_count === undefined || msg.new_message != msg.old_count)){
                var html = "<a href='"+msg.inbox_link+"' target='_blank' ><div class='st_notice_template'><i class='fa fa-comment'></i> <div class='display_table'>" + msg.message + "</div>  </div></a>";
                noty({
                    text: html,
                    layout: 'topRight',
                    type: 'info',
                    closeWith: ['click', 'button'],
                    animation: {
                        open: 'animated bounceInRight',
                        close: 'animated bounceOutRight',
                        easing: 'swing',
                        speed: 500
                    },
                    theme: 'relax',
                    progressBar: true,
                    timeout: 6000
                })
            }
        },
        error: function (e) {
            console.log(e);
        }
    });

    $('.st-inbox').click(function () {
        $(this).find('.st-form-inbox').addClass('active');
    });


    $('.st-hotel-tabs-content .nav-tabs li a, .st-tour-tabs-content .nav-tabs li a').click(function () {
        var href = $(this).attr('href');
        window.location.replace(href);
    });

    $('.st-hotel-tabs-content,.st-tour-tabs-content').each(function () {
        if(window.location.href.indexOf('#') > 0 ){
            var hashes = window.location.href.slice(window.location.href.indexOf('#') + 1).split('&');
            var hash = hashes[0];

            var check_comment = hash.split('-');
            if(hash.length > 0 && check_comment[0] == 'comment'){
                hash = 'review';
            }
            if(hash.length > 0){
                $(this).find('li').removeClass('active');
                $(this).find('.tab-pane').removeClass('active').removeClass('in');

                $(this).find('a[href=#'+hash+']').parent().addClass('active');
                $(this).find('#'+hash).addClass('active').addClass('in');

            }
        }
    });






});

jQuery(function ($) {
    $(document).on('click', '.btn-info-booking', function(event) {
        var modal = $(this).data('target');
        modal = $(modal);
        modal.find('.modal-content-inner').empty();
        modal.find('.overlay-form').fadeIn();
        $.ajax({
            url: st_params.ajax_url,
            data: {
                action: 'st_get_info_booking_history',
                order_id: $(this).data('order_id'),
                service_id: $(this).data('service_id')
            },
            dataType: 'json',
            type: 'POST',
            success: function (res) {
                if(res.status == 1){
                    modal.find('.modal-content-inner').html(res.html);
                }
                if(res.msg != ""){
                    modal.find('.modal-content-inner').html(res.msg);
                }
                modal.find('.overlay-form').fadeOut();
            },
            error: function (e) {
                console.log(e);
            }
        });
    });
    $('.btn-user-update-to-partner').click(function(e){
        var data = confirm($(this).data('confirm'));
        if(data == false)
            e.preventDefault();
    });

    /* Send email to customer by date */
    if($('.booking-email-form').length) {
        $('#cb-select-all').click(function () {
            var t = $(this);
            var parent = $(this).closest('.booking-email-form');
            parent.find('input:checkbox').not(this).prop('checked', this.checked);
        });
        $('.cb-select-child').click(function () {
            var t = $(this);
            var parent = $(this).closest('.booking-email-form');
            parent.find('input#cb-select-all').prop('checked', false);
            var check = 0;
            $('.cb-select-child').each(function (e) {
                if (!$(this).is(":checked")) {
                    check++;
                }
            });
            if (check == 0) {
                parent.find('input#cb-select-all').prop('checked', true);
            }
        });
    }
    $('#booking-email-form-btn').click(function (e) {
        e.preventDefault();
        var t = $(this).closest('.booking-email-form');
        var data = t.serializeArray();
        t.find('.form-message').html('').hide();
        $.ajax({
            url: st_params.ajax_url,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function () {
                t.find('.overlay-form').show();
            }
        }).done(function (respond) {
            if(respond.status == true){
                t.find('.form-message').html('<div class="alert alert-success">'+ respond.message +'</div>').show();
            }else{
                t.find('.form-message').html('<div class="alert alert-danger">'+ respond.message +'</div>').show();
            }
            t.find('.overlay-form').hide();
        })
    });

    if($('input.flight_package').length) {
        $('input.flight_package').on('ifClicked', function (event) {
            var me = $(this);
            if (this.checked) {
                setTimeout(function () {
                    me.iCheck('uncheck');
                }, 1);
            }
        });
    }

});
//End Custom 2