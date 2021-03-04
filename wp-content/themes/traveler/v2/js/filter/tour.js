(function ($) {
    var requestRunning = false;
    var xhr;
    var hasFilter = false;

    var data = URLToArrayNew();
    /*Layout*/
    $('.toolbar .layout span.layout-item').on('click', function () {
        if(!$(this).hasClass('active')){
            $(this).parent().find('span').removeClass('active');
            $(this).addClass('active');
            data['layout'] = $(this).data('value');
            ajaxFilterHandler(false);
        }
    });

    /*Sort menu*/
    $('.sort-menu input.service_order').change(function () {
        data['orderby'] = $(this).data('value');
        $(this).closest('.dropdown-menu').slideUp(50);
        ajaxFilterHandler();
    });

    /* Price */
    $('.btn-apply-price-range').on('click', function (e) {
        e.preventDefault();
        data['price_range'] = $(this).parent().find('.price_range').val();
        $(this).closest('.dropdown-menu').slideUp(50);
        data['page'] = 1;
        ajaxFilterHandler();
    });

    /*Checkbox click*/
    var filter_checkbox = {};
    $('.filter-item').each(function () {
        if(!Object.keys(filter_checkbox).includes($(this).data('type'))){
            filter_checkbox[$(this).data('type')] = [];
        }
    });

    $('.filter-item').change(function () {
       var t = $(this);
       var filter_type = t.data('type');
       if(t.is(':checked')){
           filter_checkbox[filter_type].push(t.val());
       }else{
           var index = filter_checkbox[filter_type].indexOf(t.val());
           if (index > -1) {
               filter_checkbox[filter_type].splice(index, 1);
           }
       }
       if(filter_checkbox[filter_type].length){
           data[filter_type] = filter_checkbox[filter_type].toString();
       }else{
           if(typeof data[filter_type] != 'undefined'){
               delete data[filter_type];
           }
       }
        data['page'] = 1;
        ajaxFilterHandler();
    });

    /*Taxnonomy*/
    var arrTax = [];
    $('.filter-tax').each(function () {
        if(!Object.keys(arrTax).includes($(this).data('type'))){
            arrTax[$(this).data('type')] = [];
        }

        if($(this).is(':checked')){
            arrTax[$(this).data('type')].push($(this).val());
        }
    });

    /* Pagination */
    $(document).on('click', '.pagination a.page-numbers:not(.current, .dots)', function (e) {
        e.preventDefault();
        var t = $(this);
        var pagUrl = t.attr('href');

        pageNum = 1;

        if (typeof pagUrl !== typeof undefined && pagUrl !== false) {
            var arr = pagUrl.split('/');
            var pageNum = arr[arr.indexOf('page') + 1];
            if (isNaN(pageNum)) {
                pageNum = 1;
            }
            data['page'] = pageNum;
            ajaxFilterHandler();
            if($('.modern-search-result-popup').length){
                $('.col-left-map').animate({scrollTop: 0}, 'slow');
            }

            if($('#modern-result-string').length) {
                    window.scrollTo({
                        top: $('#modern-result-string').offset().top - 20,
                        behavior: 'smooth'
                    });
            }
            return false;
        } else {
            return false;
        }
    });

    $('.filter-tax').change(function () {
        var t = $(this);
        var filter_type = t.data('type');

        if(t.is(':checked')){
            arrTax[filter_type].push(t.val());
        }else{
            var index = arrTax[filter_type].indexOf(t.val());
            if (index > -1) {
                arrTax[filter_type].splice(index, 1);
            }
        }
        if(arrTax[filter_type].length){
            if(typeof data['taxonomy'] == 'undefined')
                data['taxonomy'] = {};
            data['taxonomy['+filter_type+']'] = arrTax[filter_type].toString();
        }else{
            if(typeof data['taxonomy'] == 'undefined')
                data['taxonomy'] = {};
            if(typeof data['taxonomy['+filter_type+']'] != 'undefined'){
                delete data['taxonomy['+filter_type+']'];
            }
        }

        if(Object.keys(data['taxonomy']).length <= 0){
            delete data['taxonomy'];
        }
        data['page'] = 1;
        ajaxFilterHandler();
    });

    function duplicateData(parent, parentGet){
        if(typeof data['price_range'] != 'undefined'){
            $('input[name="price_range"]', parent).each(function () {
                var instance = $(this).data("ionRangeSlider");
                var price_range_arr = data['price_range'].split(';');
                if(price_range_arr.length){
                    instance.update({
                        from: price_range_arr[0],
                        to: price_range_arr[1]
                    });
                }
            });
        }

        //Filter
        var dataFilterItem = [];
        parent.find('.filter-item').prop('checked', false);
        parentGet.find('.filter-item').each(function () {
            var t = $(this);
            if(t.is(':checked')) {
                if (Object.keys(dataFilterItem).includes(t.data('type'))) {
                    dataFilterItem[t.data('type')].push(t.val());
                } else {
                    dataFilterItem[t.data('type')] = [];
                    dataFilterItem[t.data('type')].push(t.val());
                }
            }
        });
        if(Object.keys(dataFilterItem).length){
            for(var i = 0; i < Object.keys(dataFilterItem).length; i++){
                var iD = dataFilterItem[Object.keys(dataFilterItem)[i]];
                if(iD.length){
                    for(var j = 0; j < iD.length; j++){
                        $('.filter-item[data-type="'+ Object.keys(dataFilterItem)[i] +'"][value="'+ iD[j] +'"]', parent).prop('checked', true);
                    }
                }
            }
        }

        //Tax
        var dataFilterTax = [];
        parent.find('.filter-tax').prop('checked', false);
        parentGet.find('.filter-tax').each(function () {
            var t = $(this);
            if(t.is(':checked')){
                if(Object.keys(dataFilterTax).includes(t.data('type'))){
                    dataFilterTax[t.data('type')].push(t.val());
                }else{
                    dataFilterTax[t.data('type')] = [];
                    dataFilterTax[t.data('type')].push(t.val());
                }
            }
        });
        if(Object.keys(dataFilterTax).length){
            for(var i = 0; i < Object.keys(dataFilterTax).length; i++){
                var iD = dataFilterTax[Object.keys(dataFilterTax)[i]];
                if(iD.length){
                    for(var j = 0; j < iD.length; j++){
                        $('.filter-tax[data-type="'+ Object.keys(dataFilterTax)[i] +'"][value="'+ iD[j] +'"]', parent).prop('checked', true);
                    }
                }
            }
        }
    }

    $('.toolbar-action-mobile .btn-date').click(function (e) {
        e.preventDefault();
        var me = $(this);
        window.scrollTo({
            top     : 0,
            behavior: 'auto'
        });
        $('.popup-date').each(function () {
            var t = $(this);

            var checkinOut = t.find('.check-in-out');
            checkinOut.daterangepicker({
                    singleDatePicker: false,
                    autoApply: true,
                    disabledPast: true,
                    dateFormat: t.data('format'),
                    customClass: 'popup-date-custom',
                    widthSingle: 500,
                    onlyShowCurrentMonth: true,
                    alwaysShowCalendars: true,
                    //showCalendar        : true,
                    //alwaysShow          : true,
                },
                function (start, end, label) {
                    me.text(start.format(t.data('format')) + ' - ' + end.format(t.data('format')));
                    data['start'] = start.format(t.data('format'));
                    data['end'] = end.format(t.data('format'));
                    if($('#modern-result-string').length) {
                        window.scrollTo({
                            top: $('#modern-result-string').offset().top - 20,
                            behavior: 'smooth'
                        });
                    }
                    ajaxFilterHandler();
                    t.hide();
                });
            checkinOut.trigger('click');
            t.fadeIn();
        });
    });

    $('.popup-close').click(function () {
        $(this).closest('.st-popup').hide();
    });

    function ajaxFilterHandler(loadMap = true){
        if (requestRunning) {
            xhr.abort();
        }

        if($('#tour-top-search').length > 0){
            data['top_search'] = 1;
        }

        hasFilter = true;

        $('html, body').css({'overflow': 'auto'});

        if (window.matchMedia('(max-width: 991px)').matches) {
            $('.sidebar-filter').fadeOut();
            $('.top-filter').fadeOut();

            if($('#modern-result-string').length) {
                window.scrollTo({
                    top: $('#modern-result-string').offset().top - 20,
                    behavior: 'smooth'
                });
            }
        }

        $('.filter-loading').show();
        var layout = $('#modern-search-result').data('layout');
        data['format'] = $('#modern-search-result').data('format');
        if($('.modern-search-result-popup').length){
            data['is_popup_map'] = '1';
        }

        data['action'] = 'st_filter_tour_ajax';
        data['is_search_page'] = 1;
        data['_s'] = st_params._s;
        if(typeof  data['page'] == 'undefined'){
            data['page'] = 1;
        }

        var divResult = $('.modern-search-result');
        var divResultString = $('.modern-result-string');
        var divPagination = $('.moderm-pagination');

        divResult.addClass('loading');

        xhr = $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'get',
            data: data,
            success: function (doc) {
                divResult.each(function () {
                    $(this).html(doc.content);
                });

                divResultString.each(function () {
                    $(this).html(doc.count);
                });

                divPagination.each(function () {
                    $(this).html(doc.pag);
                });
            },
            complete: function () {
                divResult.removeClass('loading');
                if($('.modern-search-result-popup').length){
                    $('.map-content-loading').fadeOut();
                }

                var time = 0;
                divResult.find('img').one("load", function() {
                    $(this).addClass('loaded');
                    if(divResult.find('img.loaded').length === divResult.find('img').length) {
                        console.log("All images loaded!");
                        if($('.has-matchHeight').length){
                            $('.has-matchHeight').matchHeight({ remove: true });
                            $('.has-matchHeight').matchHeight();
                        }
                    }
                });

                if(checkClearFilter()){
                    $('.btn-clear-filter').fadeIn();
                }else{
                    $('.btn-clear-filter').fadeOut();
                }
                requestRunning = false;
            },
        });
        requestRunning = true;
    }

    $(document).ready(function () {
        if(checkClearFilter()){
            $('.btn-clear-filter').fadeIn();
        }else{
            $('.btn-clear-filter').fadeOut();
        }
        $(document).on('click', '#btn-clear-filter', function () {
            var arrResetTax = [];
            $('.filter-tax').each(function () {
                if(!Object.keys(arrResetTax).includes($(this).data('type'))){
                    arrResetTax[$(this).data('type')] = [];
                }

                if($(this).is(':checked')){
                    arrResetTax[$(this).data('type')].push($(this).val());
                }
            });

            if(Object.keys(arrResetTax).length){
                for(var i = 0; i < Object.keys(arrResetTax).length; i++){
                    if(typeof data['taxonomy['+ Object.keys(arrResetTax)[i] +']'] != 'undefined'){
                        delete data['taxonomy['+ Object.keys(arrResetTax)[i] +']'];
                    }
                }
            }

            if(typeof data['price_range'] != 'undefined'){
                delete data['price_range'];
                $('input[name="price_range"]').each(function () {
                    var sliderPrice = $(this).data("ionRangeSlider");
                    sliderPrice.reset();
                });
            }

            if(typeof data['star_rate'] != 'undefined'){
                delete data['star_rate'];
            }

            if($('.filter-item').length) {
                $('.filter-item').prop('checked', false);
            }
            if($('.filter-tax').length) {
                $('.filter-tax').prop('checked', false);
            }

            if($('.sort-item').length){
                data['orderby'] = 'new';
                $('.sort-item').find('input').prop('checked', false);
                $('.sort-item').find('input[data-value="new"]').prop('checked', true);
            }

            $(this).fadeOut();
            ajaxFilterHandler();

        });
    });

    function checkClearFilter(){
        if(((typeof data['price_range'] != 'undefined' && data['price_range'].length) || (typeof data['star_rate'] != 'undefined' && data['star_rate'].length )|| (typeof data['taxonomy[duration]'] != 'undefined' && data['taxonomy[duration]'].length ) || (typeof data['taxonomy[st_tour_type]'] != 'undefined' && data['taxonomy[st_tour_type]'].length ) || (typeof data['taxonomy[languages]'] != 'undefined' && data['taxonomy[languages]'].length ) || (typeof data['orderby'] != 'undefined' && data['orderby'] != 'new')) && hasFilter){
            return true;
        }else{
            return false;
        }
    }

    function URLToArrayNew() {
        var res = {};

        $('.toolbar .layout span').each(function () {
           if($(this).hasClass('active')){
               res['layout'] = $(this).data('value');
           }
        });

        res['orderby'] = 'new';

        var sPageURL = window.location.search.substring(1);
        if(sPageURL != '') {
            var sURLVariables = sPageURL.split('&');
            if (sURLVariables.length) {
                for (var i = 0; i < sURLVariables.length; i++) {
                    var sParameterName = sURLVariables[i].split('=');
                    if (sParameterName.length)
                        res[decodeURIComponent(sParameterName[0])] = decodeURIComponent(sParameterName[1]);
                }
            }
        }
        return res;
    }
})(jQuery);