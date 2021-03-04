(function ($) {
    $(document).ready(function () {
        var $window = $(window);
        $('#btn-booking-now').click(function () {
            $("html, body").animate({scrollTop: $('#hotel-room-box').offset().top}, 1000);
        });

        checkWidth();
        $(window).resize(checkWidth);

        function checkWidth() {
            if ($('#hotel-room-box').length) {
                var windowsize = $window.width();
                if (windowsize < 992) {
                    $(window).scroll(function () {
                        if ($(this).scrollTop() > ($('#hotel-room-box').offset().top - ($('#hotel-room-box').height()))) {
                            $('#btn-booking-now').fadeOut();
                        } else {
                            $('#btn-booking-now').fadeIn();
                        }
                    });
                }
            }
        }

        if ($('.mega-menu').length > 0) {
            $('.mega-menu').each(function (e) {
                if ($(this).find('.current-menu-item').length !== 0) {
                    $(this).parent().addClass('current-menu-ancestor');
                }
            })
        }

        /* Contact form author page*/
        $('.author-contact-form').submit(function (e) {
            e.preventDefault();
            var t = $(this);
            var check = true;
            var data = t.serializeArray();
            t.find('input[type="text"], textarea').removeClass('error');
            t.find('input[type="text"], textarea').each(function () {
                if ($(this).val() == '') {
                    check = false;
                    $(this).addClass('error');
                }
            })
            var checkEmail = ValidateEmail(data[2]['value']);
            if (!check || !checkEmail) {
                if (!checkEmail && data[2]['value'] != '') {
                    t.find('input[name="au_email"]').addClass('error');
                    if (data[0]['value'] == '' || data[3]['value'] == '') {
                        t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '<br />' + st_checkout_text.email_validate + '</div>');
                    } else {
                        t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.email_validate + '</div>');
                    }
                } else {
                    t.find('#author-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '</div>');
                }
            } else {
                t.find('#author-message').empty();
                t.find('input[type="submit"]').attr('disabled', 'disabled');
                t.find('i.fa-spin').show();
                $.ajax({
                    url: st_params.ajax_url,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        action: 'st_author_contact',
                        data: data,
                    },
                    success: function (doc) {
                        if (doc.status == true) {
                            t.find('#author-message').html('<div class="alert alert-success">' + doc.message + '</div>');
                        } else {
                            t.find('#author-message').html('<div class="alert alert-danger">' + doc.message + '</div>');
                        }
                        t.find('i.fa-spin').hide();
                        t.find('input[type="submit"]').removeAttr('disabled', 'disabled');
                    },
                    complete: function () {
                    }
                });
            }
        })

        function ValidateEmail(mail) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
                return (true)
            }
            return (false)
        }

        $('#author-write-review-form').submit(function (e) {
            e.preventDefault();
            var t = $(this);

            //var data = t.serializeArray();
            t.find('input[type="text"], textarea').removeClass('error');
            var check = true;
            t.find('input[type="text"], textarea').each(function () {
                if ($(this).val() == '') {
                    check = false;
                    $(this).addClass('error');
                }
            });
            if (!check) {
                t.find('#author-wreview-message').html('<div class="alert alert-danger">' + st_checkout_text.validate_form + '</div>');
            } else {
                var arr_star = [];
                /*t.find("input[name='au_review_star[]']").each(function () {
                    arr_star.push($(this).data('title') + '|' + $(this).val());
                });*/
                var values = $("input[name='au_review_star[]']")
                    .map(function () {
                        return $(this).data('title') + '|' + $(this).val();
                    }).get();

                t.find('#author-wreview-message').empty();
                t.find('i.fa-spin').show();
                $.ajax({
                    url: st_params.ajax_url,
                    dataType: 'json',
                    type: 'post',
                    data: {
                        action: 'st_author_write_review',
                        title: t.find('input[name="au_review_title"]').val(),
                        content: t.find('textarea[name="au_review_content"]').val(),
                        user_id: t.find('input[name="user_id"]').val(),
                        partner_id: t.find('input[name="partner_id"]').val(),
                        star: JSON.stringify(values),
                    },
                    success: function (doc) {
                        if (doc.status == true) {
                            t.find('#author-wreview-message').html('<div class="alert alert-success">' + doc.message + '</div>');
                        }
                        t.find('i.fa-spin').hide();
                        t.find('input[type="submit"]').removeAttr('disabled', 'disabled');
                    },
                    complete: function () {
                    }
                });
            }


        });


        /**
         * Friendly select
         * Nếu focus vào input text kiểm tra sụ kiện
         * Nếu List location mà có length > 0 thì bắt đầu bắt sự kiện dùng phím để select + phím enter
         */
        /*$('#field-rental-locationid').focusin(function(){
            if($('.st-option-wrapper').length > 0){
                console.log('Focus');
                var li = $('.st-option-wrapper .option');
                var liSelected;
                $(window).keydown(function(e){
                    if(e.which === 40){
                        if(liSelected){
                            liSelected.removeClass('active');
                            next = liSelected.next();
                            if(next.length > 0){
                                liSelected = next.addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                            }
                        }else{
                            liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                        }
                    }else if(e.which === 38){
                        if(liSelected){
                            liSelected.removeClass('active');
                            next = liSelected.prev();
                            if(next.length > 0){
                                liSelected = next.addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').last().addClass('active');
                            }
                        }else{
                            liSelected = $('.st-option-wrapper .option').last().addClass('active');
                        }
                    }

                });
            }

        });
        $("#field-rental-locationid").on('keyup', function (e) {
            if (e.keyCode == 13) {
                console.log('ENTER111');
                $('.option-wrapper').html('').hide();
                $('#field-rental-checkin').focus();
            }
        });*/
    });
    $(document).on('show','.accordion', function (e) {
        //$('.accordion-heading i').toggleClass(' ');
        alert('OK');
        $(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });

    $(document).on('hide','.accordion', function (e) {
        $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });

    var body = $('body');
    var flag = false;
    body.on('click', '#save_ical', function(event){
        event.preventDefault();
        var parent = $(this).parent(),
            t = $(this),
            spinner = $('.spinner-import', parent),
            message = $('.form-message', parent);
        if(flag){
            return false;
        }
        flag = true;
        spinner.show();
        var data = {
            'action' : 'st_import_ical',
            'url' : $('input.ical_input', parent).val(),
            'post_id' : $('input[name="post_id"]', parent).val()
        };

        $.post(st_params.ajax_url, data, function(respon){
            if(typeof respon === 'object'){
                message.html(respon.message);
            }
            flag = false;
            spinner.hide();
        },'json');
    });

    // Tour package
    $(document).on('click', 'a[href="#package_tab"]', function () {
        var t = $(this);
        var parent = $(this).closest('.tabs_partner');
        var parentType = $('.stour-package');

        var locations = [];
        $('.list-location-wrapper .item', parent).each(function () {
            var me = $(this);
            if (me.find('input').is(':checked')) {
                locations.push(me.find('input').val());
            }
        });

        var address = $('input[name="address"]', parent).val();

        if (locations.length == 0 && address == '') {
            $('.form-message', parentType).html('<div class="alert alert-danger">' + $('#stour-no-location').val() + '</div>');
        } else {
            $('.form-message', parentType).html('');
        }
    });

    $(document).on('click', '.tour-package-load-hotel', function (e) {
        e.preventDefault();

        var t = $(this);
        var parent = t.closest('.tab-content-parent');
        var parentType = t.closest('.stour-tab-content');
        var parentBox = t.closest('.stour-package');

        var locations = [];
        $('#locations .st-field-multi_location .dropdown .item').each(function () {
            var me = $(this);
            if (me.find('input').is(':checked')) {
                locations.push(me.find('input').val());
            }
        });

        var address = $('input[name="address"]', parent).val();

        parentBox.find('.overlay-form').show();
        $('.form-message', parentBox).html('');

        $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_load_hotel_tour_package',
                locations: locations.toString(),
                address: address,
                post_id: t.data('post-id'),
                post_type: t.data('type')
            },
            success: function (respond) {
                if (respond.status == false) {
                    $('.form-message', parentBox).html('<div class="alert alert-danger">' + respond.message + '</div>');
                } else {
                    $('.form-message', parentBox).html('<div class="alert alert-success">' + respond.message + '</div>');
                    $('.list-content', parentType).html(respond.content);
                }
                parentBox.find('.overlay-form').hide();
            },
            error: function (e) {
                console.log('Can not get the availability slot. Lost connect with your sever');
            }
        });
    });

    if($('.stour-list-hotel').length) {
        $(document).on('click', '#cb-select-all-1', function (e) {
            var t = $(this);
            var parent = $(this).closest('.stour-list-hotel');
            parent.find('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(document).on('click', '.stour-list-hotel .cb-select-child1', function (e) {
            var t = $(this);
            var parent = $(this).closest('.stour-list-hotel');
            parent.find('input#cb-select-all-1').prop('checked', false);
            var check = 0;
            $('.stour-list-hotel .cb-select-child1').each(function (e) {
                if (!$(this).is(":checked")) {
                    check++;
                }
            });
            if (check == 0) {
                parent.find('input#cb-select-all-1').prop('checked', true);
            }
        });
    }

    $(document).on('click', '#tour-package-save-hotel', function (e) {
        e.preventDefault();
        var t = $(this);
        var table = $('.stour-list-hotel');
        var data = {};
        var data_activity = {};
        var data_car = {};
        var data_flight = {};

        table.each(function (index) {
            var i = 0;
            var me = $(this);
            var type = me.data('type');
            if(type == 'hotel') {
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data[i] = {
                            'hotel_id': $('input[type="checkbox"]', item).data('id'),
                            'hotel_price': $('input[type="text"]', item).val()
                        };
                        i++;
                    }
                });
            }
            if(type == 'activity') {
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data_activity[i] = {
                            'activity_id': $('input[type="checkbox"]', item).data('id'),
                            'activity_price': $('input[type="text"]', item).val()
                        };
                        i++;
                    }
                });
            }
            if(type == 'car') {
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data_car[i] = {
                            'car_id': $('input[type="checkbox"]', item).data('id'),
                            'car_price': $('input[type="text"]', item).val(),
                            'car_quantity': $('input[type="number"]', item).val(),
                        };
                        i++;
                    }
                });
            }
            if(type == 'flight'){
                me.find('.the-list tr').each(function () {
                    var item = $(this);
                    if ($('input[type="checkbox"]', item).is(':checked')) {
                        data_flight[i] = {
                            'flight_id': $('input[type="checkbox"]', item).data('id'),
                            'flight_price_economy': $('input.price-economy[type="text"]', item).val(),
                            'flight_price_business': $('input.price-business[type="text"]', item).val(),
                        };
                        i++;
                    }
                });
            }
        });

        //Data custom
        var table_custom = $('.stour-list-custom-hotel');
        var data_custom = {};
        var data_custom_car = {};
        var data_custom_activity = {};
        var data_custom_flight = {};
        table_custom.each(function(index){
            var me = $(this);
            var type = me.data('type');
            if(type == 'hotel'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom[j] = {
                        'hotel_name': $('input.hotel-name', item_custom).val(),
                        'hotel_star': $('input.hotel-star', item_custom).val(),
                        'hotel_price': $('input.hotel-price', item_custom).val(),
                    };
                    j++;
                });
            }
            if(type == 'activity'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom_activity[j] = {
                        'activity_name': $('input.activity-name', item_custom).val(),
                        'activity_price': $('input.activity-price', item_custom).val(),
                    };
                    j++;
                });
            }
            if(type == 'car'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom_car[j] = {
                        'car_name': $('input.car-name', item_custom).val(),
                        'car_price': $('input.car-price', item_custom).val(),
                        'car_quantity': $('input.car-quantity', item_custom).val(),
                    };
                    j++;
                });
            }
            if(type == 'flight'){
                var j = 0;
                me.find('tbody tr').not('.parent-row').each(function () {
                    var item_custom = $(this);
                    data_custom_flight[j] = {
                        'flight_origin': $('input.flight-origin', item_custom).val(),
                        'flight_destination': $('input.flight-destination', item_custom).val(),
                        'flight_departure_time': $('input.flight-depature-time', item_custom).val(),
                        'flight_duration': $('input.flight-duration', item_custom).val(),
                        'flight_price_economy': $('input.flight-price-economy', item_custom).val(),
                        'flight_price_business': $('input.flight-price-business', item_custom).val(),
                    };
                    j++;
                });
            }
        });

        var parentType = $('.stour-package');
        var boxList = $('#stour-list-hotel', parentType);
        boxList.find('.overlay-form').show();
        $('.form-message', parentType).html('');

        $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_save_hotel_tour_package',
                tour_package: JSON.stringify(data),
                tour_package_car: JSON.stringify(data_car),
                tour_package_activity: JSON.stringify(data_activity),
                tour_package_flight: JSON.stringify(data_flight),
                tour_package_custom: JSON.stringify(data_custom),
                tour_package_custom_car: JSON.stringify(data_custom_car),
                tour_package_custom_activity: JSON.stringify(data_custom_activity),
                tour_package_custom_flight: JSON.stringify(data_custom_flight),
                post_id: t.data('post-id')
            },
            success: function (respond) {
                if (respond.status == false) {
                    $('.form-message', parentType).html('<div class="alert alert-danger">' + respond.message + '</div>');
                } else {
                    $('.form-message', parentType).html('<div class="alert alert-success">' + respond.message + '</div>');
                }
                boxList.find('.overlay-form').hide();
            },
            error: function (e) {
                console.log('Can not get the availability slot. Lost connect with your sever');
            }
        });
    });

    $(document).on('click', '.hotel-price', function (e) {
        var parent = $(this).closest('tr');
        if (!parent.find('input[type="checkbox"]').is(':checked')) {
            console.log(parent.find('input[type="checkbox"]'));
            parent.find('input[type="checkbox"]').prop("checked", true);
        }
    });

    $(document).on('click', '.btn-add-custom-package', function (e) {
        e.preventDefault();
        var t = $(this);
        var parent = t.closest('.custom-hotel-data-item');
        var table = parent.find('table.stour-list-custom-hotel tbody');
        var tr = table.find("tr.parent-row").clone().removeClass('parent-row').show();
        tr.insertAfter(table.find('tr:last'));
    });
    $(document).on('click', '.hotel-del', function (e) {
        e.preventDefault();
        var t = $(this);
        t.closest('tr').remove();
    });
    // End Tour package

    /* Approve Booking for partner */
    var checkStatus = true;
    $(document).on('click', '.suser-approve', function (e) {
        e.preventDefault();
        var t = $(this);
        if(!checkStatus)
            return;
        t.css({
            'visibility': 'visible'
        });
        t.closest('td').find('.suser-message').show();
        $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_partner_approve_booking',
                post_id: t.data('id'),
                order_id: t.data('order-id')
            },
            beforeSend: function () {
              checkStatus = false;
            },
            success: function (respond) {
                if(respond.status == true){
                    t.closest('td').find('.suser-status').html('<div class="text-success"><b>'+ respond.message +'</b></div>');
                    t.closest('td').find('.suser-message').hide();
                    t.remove();
                    checkStatus = true;
                }else{
                    alert(respond.message);
                    checkStatus = true;
                }
            }
        });

    });
    /* End Approve Booking for partner */
})(jQuery)