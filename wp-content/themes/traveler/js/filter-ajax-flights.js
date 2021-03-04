(function ($) {
    var requestRunning = false;
    var xhr;
    $(document).on('click', '.checkbox-filter-ajax, a.pagination', function (e) {
        if ($('#ajax-filter-content').length > 0) {
            e.preventDefault();

            if (requestRunning) {
                xhr.abort();
            }

            var pageNum = 1;
            if ($(this).hasClass('pagination')) {
                $('a.pagination').removeClass('current');
                $(this).addClass('current');
                var url = $(this).attr('href');
                if (typeof url !== typeof undefined && url !== false) {
                    var arr = url.split('/');
                    var pageNum = arr[arr.indexOf('page') + 1];

                    if (isNaN(pageNum)) {
                        pageNum = 1;
                    }
                } else {
                    return false;
                }
            } else {
                $(this).toggleClass('active');
                if ($('ul.pagination').length > 0) {
                    $('ul.pagination').find('li').each(function () {
                        if ($(this).children().hasClass('current')) {
                            pageNum = $(this).children().text();
                        }
                    });
                }
                if ($(this).data('type') != 'layout' && $(this).data('type') != 'order') {
                    pageNum = 1;
                }
            }

            var active_stop = [];
            var active_air = [];
            var active_time = [];
            var active_price = '';

            var start = $('form[post_type="st_flight"] .irs-from').text();
            var end = $('form[post_type="st_flight"] .irs-to').text();
            var price_unique = start.replace(/\D/g, '') + ';' + end.replace(/\D/g, '');
            active_price = price_unique;

            var arr_tax = [];
            var checkValue = $('.ajax-filter-wrapper').find('.active');
            if (checkValue.length) {
                checkValue.each(function (index, term) {
                    var data_filter = $(this).data('value');

                    if ($(this).data('type') == 'stops') {
                        active_stop.push(data_filter);
                    }
                    if ($(this).data('type') == 'airline') {
                        active_air.push(data_filter);
                    }
                    if ($(this).data('type') == 'dp_time') {
                        active_time.push(data_filter);
                    }
                })
            }

            var tax_stop_string = active_stop.toString();
            var tax_air_string = active_air.toString();
            var tax_time_string = active_time.toString();

            var data = URLToArrayNew();

            data['action'] = 'st_filter_flights_ajax';
            if(active_price != '0;0')
                data['price_range'] = active_price;
            if(tax_stop_string != '')
                data['stops'] = tax_stop_string;
            if(tax_air_string != '')
                data['airline'] = tax_air_string;
            if(tax_time_string != '')
                data['dp_time'] = tax_time_string;
            data['page'] = pageNum;

            $('.ajax-filter-loading').fadeIn();

            xhr = $.ajax({
                url: st_params.ajax_url,
                dataType: 'json',
                type: 'get',
                data: data,
                success: function (doc) {
                    $('#ajax-filter-content').empty();
                    $('h3.booking-title span#count-filter').html(doc.count);
                    $('.sum-result-filter').css({'visibility': 'visible'});
                    $('#ajax-filter-content').append(doc.content);
                    $('#ajax-filter-pag').html(doc.pag);
                    ajaxActionLoad();
                    $('.ajax-filter-loading').fadeOut();
                },
                complete: function () {
                    requestRunning = false;
                },
            });
            requestRunning = true;
        }
    });

    function get_all_tax() {
        var arr_tax = [];
        $('.ajax-filter-wrapper .checkbox-filter-ajax[data-tax="taxonomy"]').each(function (index, term) {
            if (jQuery.inArray($(this).data('type'), arr_tax) == -1) {
                arr_tax.push($(this).data('type'));
            }
        });
        return arr_tax;
    }

    if ($('#ajax-filter-content').length > 0) {
        var data = URLToArrayNew();
        data['action'] = 'st_filter_flights_ajax';
        data['page'] = '1';

        $('.ajax-filter-loading').fadeIn();
        $('h3.booking-title span#count-filter-tour').html('');
        xhr = $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'get',
            data: data,
            success: function (doc) {
                $('#ajax-filter-content').empty();
                $('#count-filter').html(doc.count);
                $('.sum-result-filter').css({'visibility': 'visible'});
                $('#ajax-filter-content').append(doc.content);
                $('#ajax-filter-pag').html(doc.pag);
                ajaxActionLoad();
            },
            complete: function () {
                $('.ajax-filter-loading').fadeOut();
                requestRunning = false;
            },
        });
        requestRunning = true;
    }

    function ajaxActionLoad() {
        $(document).ready(function () {
            if ($('.popup-text').length) {
                $('.popup-text').magnificPopup({
                    removalDelay: 500,
                    closeBtnInside: true,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = this.st.el.attr('data-effect');
                        },
                    },
                    midClick: true
                });
            }
            ;

            $('.i-check, .i-radio').iCheck({
                checkboxClass: 'i-check',
                radioClass: 'i-radio'
            });
        });

        var flight_data = {
            price_depart: 0,
            price_depart_html: '',
            total_price_depart: 0,
            total_price_depart_html: '',
            tax_price_depart: '',
            enable_tax_depart: 'no',
            price_return: 0,
            price_return_html: '',
            total_price_return: 0,
            total_price_return_html: '',
            tax_price_return: '',
            enable_tax_return: 'no',
            total_price: 0,
            total_price_html: '',
            flight_type: $('.st-booking-list-flight').data('flight_type')
        };

        $('input[name="flight1"]').iCheck('uncheck');
        $('input[name="flight2"]').iCheck('uncheck');
        $('.st-cal-flight-depart').each(function () {
            var t = $(this);
            $(document).on('ifChecked', 'input[name="flight1"]', function (event) {
                $('.st-cal-flight-depart').removeClass('active');
                t.addClass('active');

                var elink = $(this).closest('li').data('external-link');
                var emode = $(this).closest('li').data('external');
                if(emode == 'on'){
                    $('.flight-book-now').hide();
                    var emessage = $('.flight-message');
                    if($('.e-external-alter').length == 0) {
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                        emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                        $('.e-external-alter').after('<a href="'+ elink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                    }else{
                        $('.btn-external-link').attr('href', elink);
                    }
                }else{
                    eftype = 'on_way';
                    var eftype = $('.st-booking-list-flight').data('flight_type');
                    if(eftype == 'on_way') {
                        $('.flight-book-now').show();
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').show();
                        if ($('.e-external-alter').length > 0) {
                            $('.e-external-alter, .btn-external-link').remove();
                        }
                    }else{
                        var echeck = 0;
                        var eelink = '#';
                        $('input[name="flight2"]:checked').each(function (el) {
                            if($(this).data('external') == 'on'){
                                echeck = 1;
                                eelink = $(this).closest('li').data('external-link');
                            }else{
                                echeck = 2;
                            }
                        });
                        if(echeck == 0 || echeck == 2){
                            $('.flight-book-now').show();
                            $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').show();
                            if ($('.e-external-alter').length > 0) {
                                $('.e-external-alter, .btn-external-link').remove();
                            }
                        }else{
                            $('.flight-book-now').hide();
                            var emessage = $('.flight-message');
                            if($('.e-external-alter').length == 0) {
                                $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                                emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                                $('.e-external-alter').after('<a href="'+ eelink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                            }else{
                                $('.btn-external-link').attr('href', eelink);
                            }
                            echeck = 0;
                        }
                    }
                }

                var price_depart = $(this).data('price');
                if (price_depart) {
                    flight_data.price_depart = price_depart;
                    flight_data.total_price_depart = flight_data.price_depart;
                    $('.st-booking-select-depart').removeClass('hidden');
                    $('.st-booking-select-depart').find('.fare .price').html(format_money(flight_data.price_depart));

                    var tax_enable = $(this).data('tax');
                    var tax_amount = $(this).data('tax_amount');
                    if (tax_enable != 'no') {
                        tax_price = (parseFloat(tax_amount) * parseFloat(flight_data.price_depart)) / 100;
                        if (tax_price > 0) {
                            flight_data.total_price_depart = flight_data.price_depart + tax_price;
                            $('.st-booking-select-depart').find('.tax').removeClass('hidden');

                            $('.st-booking-select-depart').find('.tax .price').html(format_money(tax_price))
                        } else {
                            $('.st-booking-select-depart').find('.tax').addClass('hidden');
                        }
                    } else {
                        $('.st-booking-select-depart').find('.tax').addClass('hidden');
                    }

                    $('.st-booking-select-depart').find('.total .price').html(format_money(flight_data.total_price_depart));
                    $('.booking-flight-form input[name="depart_id"]').val($(this).data('post_id'));
                    if ($(this).data('business') == 1) {
                        $('.booking-flight-form input[name="price_class_depart"]').val('business_price');
                    } else {
                        $('.booking-flight-form input[name="price_class_depart"]').val('eco_price');
                    }
                }
                calculate_total_price();
            });
        });

        $('.st-cal-flight-return').each(function () {
            var t = $(this);
            t.find('input[name="flight2"]').on('ifChecked', function (event) {
                $('.st-select-item-flight-return').removeClass('active');
                t.addClass('active');

                var elink = $(this).closest('li').data('external-link');
                var emode = $(this).closest('li').data('external');
                if(emode == 'on'){
                    $('.flight-book-now').hide();
                    var emessage = $('.flight-message');
                    if($('.e-external-alter').length == 0) {
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                        emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                        $('.e-external-alter').after('<a href="'+ elink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                    }
                }else{
                    var echeck = 0;
                    var eelink = '#';
                    $('input[name="flight1"]:checked').each(function (el) {
                        if($(this).data('external') == 'on'){
                            echeck = 1;
                            eelink = $(this).closest('li').data('external-link');
                        }else{
                            echeck = 2;
                        }
                    });
                    if(echeck == 0 || echeck == 2){
                        $('.flight-book-now').show();
                        $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').show();
                        if ($('.e-external-alter').length > 0) {
                            $('.e-external-alter, .btn-external-link').remove();
                        }
                    }else{
                        $('.flight-book-now').hide();
                        var emessage = $('.flight-message');
                        if($('.e-external-alter').length == 0) {
                            $('.st-booking-select-depart, .st-booking-select-return, .st-flight-total-price').hide();
                            emessage.after('<p class="e-external-alter"><b>'+$(this).closest('li').data('external-text')+'</b></p>');
                            $('.e-external-alter').after('<a href="'+ eelink +'" class="btn btn-primary btn-external-link">'+$('.flight-book-now').text()+'</a>');
                        }else{
                            $('.btn-external-link').attr('href', eelink);
                        }
                        echeck = 0;
                    }
                }

                var price_return = $(this).data('price');
                if (price_return) {
                    flight_data.price_return = price_return;
                    flight_data.total_price_return = price_return;
                    $('.st-booking-select-return').removeClass('hidden');
                    $('.st-booking-select-return').find('.fare .price').html(format_money(flight_data.price_return));

                    var tax_enable = $(this).data('tax');
                    var tax_amount = $(this).data('tax_amount');
                    if (tax_enable != 'no') {
                        tax_price = (parseFloat(tax_amount) * flight_data.price_return) / 100;
                        if (tax_price > 0) {

                            flight_data.total_price_return = flight_data.price_return + tax_price;

                            $('.st-booking-select-return').find('.tax').removeClass('hidden');

                            $('.st-booking-select-return').find('.tax .price').html(format_money(tax_price))
                        } else {
                            $('.st-booking-select-return').find('.tax').addClass('hidden');
                        }
                    } else {
                        $('.st-booking-select-return').find('.tax').addClass('hidden');
                    }

                    $('.st-booking-select-return').find('.total .price').html(format_money(flight_data.total_price_return));
                    $('.booking-flight-form input[name="return_id"]').val($(this).data('post_id'));
                    if ($(this).data('business') == 1) {
                        $('.booking-flight-form input[name="price_class_return"]').val('business_price');
                    } else {
                        $('.booking-flight-form input[name="price_class_return"]').val('eco_price');
                    }

                }
                calculate_total_price();
            });
        });

        function calculate_total_price() {

            var passenger = $('input[name="passenger"]').val();
            if (parseInt(passenger) < 1) {
                passenger = 1;
            }

            if (flight_data.flight_type == 'on_way') {
                flight_data.total_price = flight_data.total_price_depart * parseInt(passenger);
                flight_data.total_price_html = format_money(flight_data.total_price);
            } else {
                if (parseFloat(flight_data.total_price_depart) > 0 && parseFloat(flight_data.total_price_return) > 0) {
                    flight_data.total_price = (parseFloat(flight_data.total_price_depart) + parseFloat(flight_data.total_price_return)) * parseInt(passenger);
                    flight_data.total_price_html = format_money(flight_data.total_price);
                }
            }

            if (parseFloat(flight_data.total_price) > 0) {
                $('.st-flight-booking .st-flight-total-price .price').html(flight_data.total_price_html);
            }
        }

        function format_money($money) {

            if (!$money) {
                return st_params.free_text;
            }

            $money = st_number_format($money, st_params.booking_currency_precision, st_params.decimal_separator, st_params.thousand_separator);
            var $symbol = st_params.currency_symbol;
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


            number = (number + '')
                .replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
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

        $(document).on('click', '.flight-book-now', function (e) {
            //$('.flight-book-now').on( 'click', function(e){

            var t = $(this);

            var form = $(this).closest('.booking-flight-form');

            var data = form.serialize();
            t.addClass('loading');
            form.find('.flight-message').empty();

            $.ajax({
                dataType: 'json',
                type: 'post',
                data: data,
                url: st_params.ajax_url,
                success: function (res) {
                    t.removeClass('loading');

                    if (typeof res.message != 'undefined') {
                        form.find('.flight-message').append(res.message);
                    }

                    if (typeof res.redirect != 'undefined') {
                        window.location = res.redirect;
                    }
                },
                error: function (e) {
                    t.removeClass('loading');
                }
            });
            return false;
        });
    }

    //Get param form url passing to flight param
    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }

    function URLToArray(url) {
        var request = {};
        var pairs = url.substring(url.indexOf('?') + 1).split('&');
        for (var i = 0; i < pairs.length; i++) {
            if (!pairs[i])
                continue;
            var pair = pairs[i].split('=');
            request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
        }
        return request;
    }

    function URLToArrayNew() {
        var res = {};
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        if(sURLVariables.length){
            for (var i = 0; i < sURLVariables.length; i++){
                var sParameterName = sURLVariables[i].split('=');
                if(sParameterName.length)
                    res[decodeURIComponent(sParameterName[0])] = decodeURIComponent(sParameterName[1]);
            }
        }
        return res;
    }

    $(document).ready(function(){
        $('.search_rating_star, .ajax-tax-name').click(function(){
            $(this).prev().trigger('click');
        });
    });

})(jQuery)