jQuery(document).ready(function ($) {
    "use strict";
    $('.check-all').change(function (event) {
        var name = $(this).data('name');
        $("input[name='" + name + "[]']").prop('checked', $(this).prop("checked"))
    });
    if ($('#form-bulk-edit').length) {
        $('#calendar-bulk-close').click(function (event) {
            $(this).closest('#form-bulk-edit').fadeOut();
            if ($('.calendar-bulk-room-close').length) {
            } else {
                $(this).closest('.calendar-wrapper').find('.calendar-content').fullCalendar('refetchEvents')
            }
        })
    }
    $('#calendar-bulk-edit').click(function (event) {
        if ($('#form-bulk-edit').length) {
            $('#form-bulk-edit').fadeIn()
        }
    });
    var flag_save_bulk = !1;

    function step_add_bulk(data1, posts_per_page, total, current_page, all_days, post_id, container, data_first) {
        var data;
        if (typeof(data_first) == 'object') {
            data = data_first
        } else {
            data = {
                'data': data1,
                'posts_per_page': posts_per_page,
                'total': total,
                'current_page': current_page,
                'all_days': all_days,
                'post_id': post_id,
                'action': 'traveler_calendar_bulk_edit_form'
            }
        }
        $.post(ajaxurl, data, function (respon, textStatus, xhr) {
            if (typeof(respon) == 'object') {
                if (respon.status == 2) {
                    step_add_bulk(respon.data, respon.posts_per_page, respon.total, respon.current_page, respon.all_days, respon.post_id, container, '')
                } else {
                    $('#form-bulk-edit .form-message', container).html(respon.message);
                    $('#form-bulk-edit .overlay, #form-bulk-edit .overlay-form', container).removeClass('open').fadeOut()
                }
            }
            flag_save_bulk = !1
        }, 'json')
    }

    if ($('#form-bulk-edit').length) {
        $('#calendar-bulk-save').click(function (event) {
            var parent = $(this).closest('#form-bulk-edit');
            var container = $(this).closest('.calendar-wrapper');
            if (flag_save_bulk) return !1;
            flag_save_bulk = !0;
            var day_of_week = [];
            $('input[name="day-of-week[]"]:checked', parent).each(function (i) {
                day_of_week[i] = $(this).val()
            });
            var day_of_month = [];
            $('input[name="day-of-month[]"]:checked', parent).each(function (i) {
                day_of_month[i] = $(this).val()
            });
            var months = [];
            $('input[name="months[]"]:checked', parent).each(function (i) {
                months[i] = $(this).val()
            });
            var years = [];
            $('input[name="years[]"]:checked', parent).each(function (i) {
                years[i] = $(this).val()
            });

            //Data startime
            var starttime_hour = [];
            $('.bulk-starttime select[name="calendar_starttime_hour[]').each(function(i) {
                starttime_hour[i] = $(this).val()
            });

            var starttime_min = [];
            $('.bulk-starttime select[name="calendar_starttime_minute[]').each(function(i) {
                starttime_min[i] = $(this).val()
            });

            var hasTimeFormat = false;

            if($('.bulk-starttime .calendar_starttime_format').length){
                hasTimeFormat = true;
            }

            if(hasTimeFormat){
                var starttime_format = [];
                $('.bulk-starttime select[name="calendar_starttime_format[]').each(function(i) {
                    starttime_format[i] = $(this).val()
                });
            }

            var starttime_unique = [];
            if(hasTimeFormat){
                for (var i = 0; i < starttime_hour.length; i++) {
                    starttime_unique[i] = starttime_hour[i] + ':' + starttime_min[i] + ' ' + starttime_format[i];
                }
            }else {
                for (var i = 0; i < starttime_hour.length; i++) {
                    starttime_unique[i] = starttime_hour[i] + ':' + starttime_min[i];
                }
            }
            var starttime_unique_arr = [];
            $.each(starttime_unique, function(i, el){
                if($.inArray(el, starttime_unique_arr) === -1) starttime_unique_arr.push(el);
            });

            starttime_unique_arr.sort();


            var calendar_groupday = 0;
            if ($('input[name="calendar_groupday"]', parent).prop('checked')) {
                calendar_groupday = 1
            }
            if ($('input[name="post-id"]', parent).length) {
                var post_select_id = $('input[name="post-id"]', parent).val()
            } else {
                var post_select_id = $('select[name="post-id"]', parent).val()
            }
            var data = {
                'day-of-week': day_of_week,
                'day-of-month': day_of_month,
                'months': months,
                'years': years,
                'price_bulk': $('input[name="price-bulk"]').val(),
                'adult-price_bulk': $('input[name="adult-price-bulk"]').val(),
                'children-price_bulk': $('input[name="children-price-bulk"]').val(),
                'infant-price_bulk': $('input[name="infant-price-bulk"]').val(),
                'starttime': starttime_unique_arr,
                'post_id': post_select_id,
                'status': $('select[name="status"]', parent).val(),
                'calendar_groupday': calendar_groupday,
                'action': 'traveler_calendar_bulk_edit_form'
            };
            $('.form-message', parent).html('');
            $('.overlay, .overlay-form', parent).addClass('open').fadeIn();
            step_add_bulk('', '', '', '', '', '', container, data);
            return !1
        })
    }
})