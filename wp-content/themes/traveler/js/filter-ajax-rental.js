(function ($) {
    var requestRunning = false;
    var xhr;
    var checkOrderBy = false;
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


            var active_rate = [];
            var active_tax_amen = [];
            var active_tax_sui = [];
            var active_price = '';
            var active_layout = '';
            var active_order = '';

            if ($(this).data('type') == 'layout') {
                $('.checkbox-filter-ajax[data-type="layout"]').removeClass('active');
                $(this).addClass('active');
            }
            var start = $('form[post_type="st_rental"] .irs-from').text();
            var end = $('form[post_type="st_rental"] .irs-to').text();

            var price_unique = start.replace(/\D/g, '') + ';' + end.replace(/\D/g, '');

            active_price = price_unique;

            if ($(this).data('type') == 'order') {
                checkOrderBy = true;
                $('.checkbox-filter-ajax[data-type="order"]').parent().removeClass('active');
                $('.checkbox-filter-ajax[data-type="order"]').removeClass('active');
                $(this).parent().addClass('active');
            }

            var checkValueOrder = $('.ajax-filter-wrapper-order').find('.active');
            if (checkValueOrder.length) {
                checkValueOrder.each(function (index, term) {
                    var data_filter = $(this).find('a').data('value');
                    //Layout
                    if ($(this).find('a').data('type') == 'order') {
                        active_order = data_filter;
                    }
                })
            }

            var checkValueLayout = $('.ajax-filter-wrapper-layout').find('.active');
            if (checkValueLayout.length) {
                checkValueLayout.each(function (index, term) {
                    var data_filter = $(this).data('value');
                    //Layout
                    if ($(this).data('type') == 'layout') {
                        active_layout = data_filter;
                    }
                })
            }

            var arr_tax = [];
            var checkValue = $('.ajax-filter-wrapper').find('.active');
            if (checkValue.length) {
                checkValue.each(function (index, term) {
                    var data_filter = $(this).data('value');
                    //Star
                    if ($(this).data('type') == 'rate') {
                        active_rate.push(data_filter);
                    }
                    if ($(this).data('tax') == 'taxonomy') {
                        if (jQuery.inArray($(this).data('type'), arr_tax) == -1) {
                            arr_tax.push($(this).data('type'));
                        }
                    }
                })
            }

            var rate_string = active_rate.toString();
            var tax_amen_string = active_tax_amen.toString();
            var tax_sui_string = active_tax_sui.toString();

            var data = URLToArrayNew();
            var data_taxonomy = get_all_tax();
            data_taxonomy.forEach(function (term, index, arr) {
                delete data['taxonomy[' + term + ']'];
            });
            var checkValue = $('.ajax-filter-wrapper').find('.active');
            var data_tax = [];
            arr_tax.forEach(function (term, index, arr) {
                data_tax = [];
                checkValue.each(function (index1, term1) {
                    if ($(this).data('type') == term) {
                        data_tax.push($(this).data('value'));
                    }
                });
                data['taxonomy[' + term + ']'] = data_tax.toString();
            });

            if(!$('#jrental-orderby').length || checkOrderBy){
                var active_order = 'new';
                var checkValueOrder = $('.ajax-filter-wrapper-order').find('li.active');
                if (checkValueOrder.length) {
                    checkValueOrder.each(function (index, term) {
                        var data_filter = $(this).find('a').data('value');
                        if ($(this).find('a').data('type') == 'order') {
                            active_order = data_filter;
                        }
                    })
                }
                data['orderby'] = active_order;
            }

            data['action'] = 'st_filter_rental_ajax';
            if(rate_string != '')
                data['star_rate'] = rate_string;
            if(active_price != '0;0' && active_price != ';' && active_price != '')
                data['price_range'] = active_price;
            data['layout'] = active_layout;
            data['page'] = pageNum;
            data['isajax'] = '1';
            data['jcategory'] = $('#jrental-category').val();

            $('.ajax-filter-loading').fadeIn();

            xhr = $.ajax({
                url: st_params.ajax_url,
                dataType: 'json',
                type: 'get',
                data: data,
                success: function (doc) {
                    $('#ajax-filter-content').empty();
                    $('h3.booking-title span#count-filter-tour').html(doc.count);
                    $('#ajax-filter-content').append(doc.content);
                    $('#ajax-filter-pag').html(doc.pag);
                    ajaxShowGallery();
                    $('.ajax-filter-loading').fadeOut();
                    if($('.booking-item-features').length) {
                        $('.booking-item-features li').tooltip({
                            placement: 'top'
                        });
                    }
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
        data['action'] = 'st_filter_rental_ajax';
        data['layout'] = '1';
        $('.ajax-filter-wrapper-layout .sort_icon').each(function(){
            if($(this).find('a').hasClass('active')){
                data['layout'] = $(this).find('a').data('value');
            }
        });

        if(!$('#jrental-orderby').length){
            var active_order = 'new';
            var checkValueOrder = $('.ajax-filter-wrapper-order').find('li.active');
            if (checkValueOrder.length) {
                checkValueOrder.each(function (index, term) {
                    var data_filter = $(this).find('a').data('value');
                    if ($(this).find('a').data('type') == 'order') {
                        active_order = data_filter;
                    }
                })
            }
            data['orderby'] = active_order;
        }
        data['isajax'] = '1';
        data['jcategory'] = $('#jrental-category').val();

        $('.ajax-filter-loading').fadeIn();
        $('h3.booking-title span#count-filter-tour').html('');
        xhr = $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'get',
            data: data,
            success: function (doc) {
                $('#ajax-filter-content').empty();
                $('h3.booking-title span#count-filter-tour').html(doc.count);
                $('#ajax-filter-content').append(doc.content);
                $('#ajax-filter-pag').html(doc.pag);
                ajaxShowGallery();
                $('.ajax-filter-loading').fadeOut();
                if($('.booking-item-features').length) {
                    $('.booking-item-features li').tooltip({
                        placement: 'top'
                    });
                }
            },
            complete: function () {
                requestRunning = false;
            },
        });
        requestRunning = true;
    }

    function ajaxShowGallery() {
        $(document).ready(function () {
            if ($('.st-popup-gallery').length > 0) {
                $('.st-popup-gallery').each(function () {
                    $(this).magnificPopup({
                        delegate: '.st-gp-item',
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    });
                });
            }
        });
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