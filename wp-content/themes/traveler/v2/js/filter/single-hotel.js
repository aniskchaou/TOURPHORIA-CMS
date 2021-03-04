(function ($) {
    var requestRunning = false;
    var xhr;
    var hasFilter = false;
    var data = URLToArrayNew();
    /* Dropdown category */
    $('.sts-toolbar .dropdown-category form select').change(function (e) {
        e.preventDefault();
        if($(this).val() != 'all') {
            data['term_id'] = $(this).val();
        }else{
            if(typeof data['term_id'] !== 'undefined'){
                delete data['term_id'];
            }
        }
        if(typeof data['page'] !== 'undefined'){
            data['page'] = 1;
        }
        ajaxFilterHandler();
    });

    /* Layout */
    $('.sts-toolbar .layout li').on('click', function (e) {
        e.preventDefault();
        if(!$(this).hasClass('active')){
            $('.sts-toolbar .layout li').removeClass('active');
            $(this).addClass('active');
            data['layout'] = $(this).data('value');
            ajaxFilterHandler();
        }
    });

    /* Category */
    $('.sts-toolbar .list-category li a').click(function(e){
        e.preventDefault();
        var t = $(this);
        if(!t.hasClass('active')){
            $('.sts-toolbar .list-category li a').removeClass('active');
            t.addClass('active');
            if(t.data('value') != 'all') {
                data['term_id'] = t.data('value');
            }else{
                if(typeof data['term_id'] !== 'undefined'){
                    delete data['term_id'];
                }
            }
            if(typeof data['page'] !== 'undefined'){
                data['page'] = 1;
            }
            ajaxFilterHandler();
        }
    });


    /* Pagination */
    $(document).on('click', '.sts-pag .page-numbers a.page-numbers:not(.current, .dots)', function (e) {
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
        }
    });

    function ajaxFilterHandler(){
        if (requestRunning) {
            xhr.abort();
        }
        data['action'] = 'sts_filter_room_ajax';
        data['_s'] = hotel_alone_params._s;

        if(typeof  data['page'] === 'undefined'){
            data['page'] = 1;
        }

        var divResult = $('.sts-room-wrapper');
        divResult.addClass('loading');

        xhr = $.ajax({
            url: hotel_alone_params.ajax_url,
            dataType: 'json',
            type: 'get',
            data: data,
            success: function (doc) {
                if(doc.status) {
                    if(data['layout'] === 'grid' && divResult.hasClass('list')){
                        divResult.removeClass('list');
                    }
                    if(data['layout'] === 'list' && divResult.hasClass('grid')){
                        divResult.removeClass('grid');
                    }

                    divResult.addClass(data['layout']);
                    divResult.each(function () {
                        $(this).html(doc.content);
                    });
                }
            },
            complete: function () {

                divResult.removeClass('loading');
                divResult.find('img').one("load", function() {
                    if(divResult.find('img.loaded').length === divResult.find('img').length) {
                        if($('.has-matchHeight').length){
                            $('.has-matchHeight').matchHeight({ remove: true });
                            $('.has-matchHeight').matchHeight();
                        }
                    }
                });

                if($('.sts-room-wrapper').length) {
                    extraServicesFunction($('.sts-room-wrapper'));
                }

                $('.st-thumb-slider').each(function () {
                    var $owl = $(this);
                    $owl.owlCarousel({
                        items:1,
                        lazyLoad:true,
                        loop:true,
                        nav: true,
                        center:true,
                        navText : ["<img src='"+ hotel_alone_params.theme_url +"/v2/images/svg/ico_pre_thumb.svg' />","<img src='"+ hotel_alone_params.theme_url +"/v2/images/svg/ico_next_thumb.svg' />"]
                    });
                    $owl.on('loaded.owl.lazy', function(event) {
                        if($('.has-matchHeight').length){
                            $('.has-matchHeight').matchHeight({ remove: true });
                            $('.has-matchHeight').matchHeight();
                        }
                    })
                });

                window.scrollTo({
                    top: $('.sts-toolbar').offset().top - 150,
                    behavior: 'smooth'
                });
                requestRunning = false;
            },
        });
        requestRunning = true;
    }

    function URLToArrayNew() {
        var res = {};

        $('.sts-toolbar .layout li').each(function () {
            if($(this).hasClass('active')){
                res['layout'] = $(this).data('value');
            }
        });

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