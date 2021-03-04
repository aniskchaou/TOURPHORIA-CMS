
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
                        var pos = $('.message-box .message-item').last().position().top;
                        $('.st-inbox-body-detail .message-box').animate({scrollTop: pos}, 'slow');
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
        if($('.message-box .message-item').length > 0) {
            var pos = $('.message-box .message-item').last().position().top;
            $('.st-inbox-body-detail .message-box').animate({scrollTop: pos}, 'slow');
        }
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
                    var pos = $('.message-box .message-item').last().position().top;
                    container.find('.message-box').animate({scrollTop: pos}, 'slow');
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
});
