(function ($) {
    var requestRunning = false;
    var xhr;
    var checkOrderBy = false;
    $(document).on('click', '.checkbox-filter-ajax', function (e) {
        e.preventDefault();
        if (requestRunning) {
            xhr.abort();
        }
        if ($('#ajax-filter-content').length > 0) {
            var active_price = '';
            var start = $('form[post_type="all"] .irs-from').text();
            var end = $('form[post_type="all"] .irs-to').text();
            var price_unique = start.replace(/\D/g, '') + ';' + end.replace(/\D/g, '');
            active_price = price_unique;

            var st_style = $('.ajax-filter-cover').data('style');
            var st_number = $('.ajax-filter-cover').data('number');
            var st_post_type = $('.ajax-filter-cover').data('post-type');

            var data = URLToArrayNew();
            data['action'] = 'st_filter_all_post_type_ajax';
            if(active_price != '0;0')
                data['price_range'] = active_price;
            data['isajax'] = '1';
            data['style'] = st_style;
            data['number'] = st_number;
            data['post_type'] = st_post_type;
            $('.ajax-filter-loading').fadeIn();
            xhr = $.ajax({
                url: st_params.ajax_url,
                dataType: 'json',
                type: 'get',
                data: data,
                success: function (doc) {
                    $('#ajax-filter-content').empty();
                    $('#ajax-filter-content').append(doc.content);
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
    })

    if ($('#ajax-filter-content').length > 0) {
        var data = URLToArrayNew();
        data['action'] = 'st_filter_all_post_type_ajax';
        data['isajax'] = '1';

        var st_style = $('.ajax-filter-cover').data('style');
        var st_number = $('.ajax-filter-cover').data('number');
        var st_post_type = $('.ajax-filter-cover').data('post-type');

        data['style'] = st_style;
        data['number'] = st_number;
        data['post_type'] = st_post_type;


        $('.ajax-filter-loading').fadeIn();
        $('h3.booking-title span#count-filter-tour').html('');
        xhr = $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'get',
            data: data,
            success: function (doc) {
                $('#ajax-filter-content').empty();
                $('#ajax-filter-content').append(doc.content);
                if($('.booking-item-features').length) {
                    $('.booking-item-features li').tooltip({
                        placement: 'top'
                    });
                }
            },
            complete: function () {
                $('.ajax-filter-loading').fadeOut();
                requestRunning = false;
            },
        });
        requestRunning = true;
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

    $(document).ready(function () {
        $('.search_rating_star, .ajax-tax-name').click(function () {
            $(this).prev().trigger('click');
        });
    });
})(jQuery)