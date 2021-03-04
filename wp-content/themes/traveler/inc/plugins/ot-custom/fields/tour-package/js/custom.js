jQuery(function ($) {
    $(document).on('click', 'a[href="#setting_st_tour_package_tab"]', function () {
        var t = $(this);
        var parent = $(this).closest('#tour_metabox');
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
            $('.form-message', parentType).html('<div class="alert alert-error">Please select location or put address value</div>');
        } else {
            $('.form-message', parentType).html('');
        }
    });

    $(document).on('click', '.tour-package-load-hotel', function (e) {
        e.preventDefault();

        var t = $(this);
        var parent = t.closest('#tour_metabox');
        var parentType = t.closest('.stour-tab-content');
        var parentBox = t.closest('.stour-package');

        var locations = [];
        $('.list-location-wrapper .item', parent).each(function () {
            var me = $(this);
            if (me.find('input').is(':checked')) {
                locations.push(me.find('input').val());
            }
        });
        var address = $('input[name="address"]', parent).val();

        parentBox.find('.overlay').show();
        $('.form-message', parentBox).html('');

        $.ajax({
            url: ajaxurl,
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
                    $('.form-message', parentBox).html('<div class="alert alert-error">' + respond.message + '</div>');
                } else {
                    $('.form-message', parentBox).html('<div class="alert alert-success">' + respond.message + '</div>');
                    $('.list-content', parentType).html(respond.content);
                }
                parentBox.find('.overlay').hide();
            },
            error: function (e) {
                console.log('Can not get the availability slot. Lost connect with your sever');
            }
        });
    });

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
        boxList.find('.overlay').show();
        $('.form-message', parentType).html('');

        $.ajax({
            url: ajaxurl,
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
                    $('.form-message', parentType).html('<div class="alert alert-error">' + respond.message + '</div>');
                } else {
                    $('.form-message', parentType).html('<div class="alert alert-success">' + respond.message + '</div>');
                }
                boxList.find('.overlay').hide();
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
});