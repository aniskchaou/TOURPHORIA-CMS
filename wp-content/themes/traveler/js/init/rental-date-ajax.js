jQuery(document).ready(function ($) {
    if(!$('body').hasClass('single-st_rental')) return;

    var month_start='';
    var year_start='';
    var is_group = 'off';
    if ($('#rental_is_groupday').length) {
        if ($('#rental_is_groupday').val() == 'on') {
            is_group = 'on';
        } else {
            is_group = 'off';
        }
    }
    if (is_group == 'off') {
        $('#form-booking-inpage .form-group.form-group-icon-left .form-control.checkin_rental').css('background', 'transparent');
        $('#form-booking-inpage .form-group.form-group-icon-left .form-control.checkout_rental').css('background', 'transparent');
        var disabled_dates = [];
        var fist_half_day = [];
        var last_half_day = [];

        var startDate=$('.booking-item-dates-change').data('period');
        if(!startDate){
            startDate='today';
        }
        $('input.checkin_rental, input.checkout_rental').each(function () {
            var $this = $(this);
            $this.datepicker({
                language: st_params.locale,
                format: $('[data-date-format]').data('date-format'),
                todayHighlight: !0,
                autoclose: !0,
                startDate: startDate,
                weekStart: 1,
                setRefresh: !0,
                beforeShowDay: function (date) {
                    var d = date;
                    var curr_date = d.getDate();
                    if (curr_date < 10) {
                        curr_date = "0" + curr_date
                    }
                    var curr_month = d.getMonth() + 1;
                    if (curr_month < 10) {
                        curr_month = "0" + curr_month
                    }
                    var curr_year = d.getFullYear();
                    var key = 'st_calendar_' + curr_date + "_" + curr_month + "_" + curr_year;
                    return {classes: key}
                }
            });
            $this.click(function () {
                if (fist_half_day.length > 0) {
                    for (var i = 0; i < fist_half_day.length; i++) {
                        var $key = 'st_calendar_' + fist_half_day[i];
                        $('.' + $key).addClass('st_fist_half_day')
                    }
                }
                if (last_half_day.length > 0) {
                    for (var i = 0; i < last_half_day.length; i++) {
                        var $key = 'st_calendar_' + last_half_day[i];
                        $('.' + $key).addClass('st_last_half_day')
                    }
                }
                if (disabled_dates.length > 0) {
                    for (var i = 0; i < disabled_dates.length; i++) {
                        var $key = 'st_calendar_' + disabled_dates[i];
                        $('.' + $key).addClass('disabled disabled-date booked day st_booked')
                    }
                }
            });
            $('.date-overlay').addClass('open');
            var date_start = $(this).datepicker('getDate');
            if (date_start == null)
                date_start = new Date();
            year_start = date_start.getFullYear();
            month_start = date_start.getMonth() + 1;
        });
        ajaxGetRentalOrder(month_start, year_start);
        $('input.checkin_rental').on('changeMonth', function (e) {
            year_start = new Date(e.date).getFullYear();
            month_start = new Date(e.date).getMonth() + 1;
            ajaxGetRentalOrder(month_start, year_start, $(this))
        });
        $('input.checkin_rental').on('changeDate', function (e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 1);
            $('input.checkout_rental').datepicker('setStartDate', new_date)
        });
        $('input.checkin_rental, input.checkout_rental').on('keyup', function (e) {
            setTimeout(function () {
                if (fist_half_day.length > 0) {
                    for (var i = 0; i < fist_half_day.length; i++) {
                        var $key = 'st_calendar_' + fist_half_day[i];
                        $('.' + $key).addClass('st_fist_half_day')
                    }
                }
                if (last_half_day.length > 0) {
                    for (var i = 0; i < last_half_day.length; i++) {
                        var $key = 'st_calendar_' + last_half_day[i];
                        $('.' + $key).addClass('st_last_half_day')
                    }
                }
                if (disabled_dates.length > 0) {
                    for (var i = 0; i < disabled_dates.length; i++) {
                        var $key = 'st_calendar_' + disabled_dates[i];
                        $('.' + $key).addClass('disabled disabled-date booked day st_booked')
                    }
                }
            }, 200)
        });
        $('input.checkout_rental').on('changeMonth', function (e) {
            year_start = new Date(e.date).getFullYear();
            month_start = new Date(e.date).getMonth() + 1;
            ajaxGetRentalOrder(month_start, year_start, $(this))
        });

        function ajaxGetRentalOrder(month, year) {
            post_id = $('.booking-item-dates-change').data('post-id');
            $('.date-overlay').addClass('open');
            if (!typeof post_id != 'undefined' || parseInt(post_id) > 0) {
                var data = {
                    rental_id: post_id,
                    month: month,
                    year: year,
                    security: st_params.st_search_nonce,
                    action: 'st_get_disable_date_rental',
                };
                $.post(st_params.ajax_url, data, function (respon) {
                    disabled_dates = Object.keys(respon.disable).map(function (key) {
                        return respon.disable[key]
                    });
                    fist_half_day = Object.keys(respon.fist_half_day).map(function (key) {
                        return respon.fist_half_day[key]
                    });
                    last_half_day = Object.keys(respon.last_half_day).map(function (key) {
                        return respon.last_half_day[key]
                    });
                    if (fist_half_day.length > 0) {
                        for (var i = 0; i < fist_half_day.length; i++) {
                            var $key = 'st_calendar_' + fist_half_day[i];
                            $('.' + $key).addClass('st_fist_half_day')
                        }
                    }
                    if (last_half_day.length > 0) {
                        for (var i = 0; i < last_half_day.length; i++) {
                            var $key = 'st_calendar_' + last_half_day[i];
                            $('.' + $key).addClass('st_last_half_day')
                        }
                    }
                    if (disabled_dates.length > 0) {
                        for (var i = 0; i < disabled_dates.length; i++) {
                            var $key = 'st_calendar_' + disabled_dates[i];
                            $('.' + $key).addClass('disabled disabled-date booked day st_booked')
                        }
                    }
                    $('.date-overlay').removeClass('open')
                }, 'json')
            } else {
                $('.date-overlay').removeClass('open')
            }
        }
    } else {
        $('#form-booking-inpage .form-group.form-group-icon-left .form-control.checkin_rental').css('background', '#dfdfdf');
        $('#form-booking-inpage .form-group.form-group-icon-left .form-control.checkout_rental').css('background', '#dfdfdf');
    }
});
