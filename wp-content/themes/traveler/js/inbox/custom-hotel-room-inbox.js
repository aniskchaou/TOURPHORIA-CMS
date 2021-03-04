jQuery(document).ready(function($) {
    var parentDiv = $('.st-inbox-form-book');

    var disabled_dates = [];
    var fist_half_day = [];
    var last_half_day = [];
    var checkin_checkout_input=$('input.checkin_hotel, input.checkout_hotel');
    var startDate=$('.input-daterange').data('period');
    if(!startDate){
        startDate='today';
    }
    if(checkin_checkout_input.length){
        checkin_checkout_input.each(function() {
            var $this = $(this);
            $this.datepicker({
                language:st_params.locale,
                format: $('[data-date-format]').data('date-format'),
                todayHighlight: true,
                autoclose: true,
                startDate: startDate,
                weekStart: 1,
                setRefresh: true,
                beforeShowDay: function(date){
                    var d = date;
                    var curr_date = d.getDate();
                    if(curr_date < 10){
                        curr_date = "0"+curr_date;
                    }
                    var curr_month = d.getMonth() + 1; //Months are zero based
                    if(curr_month < 10){
                        curr_month = "0"+curr_month;
                    }
                    var curr_year = d.getFullYear();
                    var key = 'st_calendar_'+curr_date + "_" + curr_month + "_" + curr_year;
                    return {
                        classes: key
                    };
                }
            });
            $this.click(function(){
                if(fist_half_day.length > 0){
                    for (var i = 0; i < fist_half_day.length; i++) {
                        var $key ='st_calendar_'+fist_half_day[i];
                        $('.'+$key).addClass('st_fist_half_day');
                    }
                }
                if(last_half_day.length > 0){
                    for (var i = 0; i < last_half_day.length; i++) {
                        var $key ='st_calendar_'+last_half_day[i];
                        $('.'+$key).addClass('st_last_half_day');
                    }
                }
                if(disabled_dates.length > 0){
                    for (var i = 0; i < disabled_dates.length; i++) {
                        var $key ='st_calendar_'+disabled_dates[i];
                        $('.'+$key).addClass('disabled disabled-date booked day st_booked');
                    }
                }
            });
            $('.date-overlay').addClass('open');
            var date_start = $(this).datepicker('getDate');
            if(date_start == null)
                date_start = new Date();
            year_start = date_start.getFullYear();
            month_start = date_start.getMonth() + 1;

        });

        ajaxGetHotelOrder(month_start,year_start,checkin_checkout_input);
    }

    $('input.checkin_hotel').on('changeMonth', function(e) {
        year_start =  new Date(e.date).getFullYear();
        month_start =  new Date(e.date).getMonth() + 1;
        ajaxGetHotelOrder(month_start,year_start,$(this));
    });
    $('input.checkin_hotel').on('changeDate', function (e) {
        var new_date = e.date;
        new_date.setDate(new_date.getDate() + 1);
        $('input.checkout_hotel').datepicker('setStartDate', new_date);
        //$('input.checkout_rental').datepicker('setDate', new_date);
    });
    $('input.checkin_hotel, input.checkout_hotel').on('keyup', function (e) {
        setTimeout(function(){
            if(fist_half_day.length > 0){
                for (var i = 0; i < fist_half_day.length; i++) {
                    var $key ='st_calendar_'+fist_half_day[i];
                    $('.'+$key).addClass('st_fist_half_day');
                }
            }
            if(last_half_day.length > 0){
                for (var i = 0; i < last_half_day.length; i++) {
                    var $key ='st_calendar_'+last_half_day[i];
                    $('.'+$key).addClass('st_last_half_day');
                }
            }
            if(disabled_dates.length > 0){
                for (var i = 0; i < disabled_dates.length; i++) {
                    var $key ='st_calendar_'+disabled_dates[i];
                    $('.'+$key).addClass('disabled disabled-date booked day st_booked');
                }
            }
        },200)
    });
    $('input.checkout_hotel').on('changeMonth', function(e) {
        year_start =  new Date(e.date).getFullYear();
        month_start =  new Date(e.date).getMonth() + 1;
        ajaxGetHotelOrder(month_start,year_start,$(this));
    });

    function ajaxGetHotelOrder(month, year, me){
        post_id = $(me).data('post-id');
        $('.date-overlay').addClass('open');
        if(!typeof post_id != 'undefined' || parseInt(post_id) > 0){
            var data = {
                room_id : post_id,
                month: month,
                year: year,
                security:st_params.st_search_nonce,
                action:'st_get_disable_date_hotel',
            };
            $.post(st_params.ajax_url, data, function(respon) {
                disabled_dates = Object.keys(respon.disable).map(function (key) {return respon.disable[key]});
                fist_half_day = Object.keys(respon.fist_half_day).map(function (key) {return respon.fist_half_day[key]});
                last_half_day = Object.keys(respon.last_half_day).map(function (key) {return respon.last_half_day[key]});
                if(fist_half_day.length > 0){
                    for (var i = 0; i < fist_half_day.length; i++) {
                        var $key ='st_calendar_'+fist_half_day[i];
                        $('.'+$key).addClass('st_fist_half_day');
                    }
                }
                if(last_half_day.length > 0){
                    for (var i = 0; i < last_half_day.length; i++) {
                        var $key ='st_calendar_'+last_half_day[i];
                        $('.'+$key).addClass('st_last_half_day');
                    }
                }
                if(disabled_dates.length > 0){
                    for (var i = 0; i < disabled_dates.length; i++) {
                        var $key ='st_calendar_'+disabled_dates[i];
                        $('.'+$key).addClass('disabled disabled-date booked day st_booked');
                    }
                }
                $('.date-overlay').removeClass('open');
                parentDiv.removeClass('loading');
            },'json');

        }else{
            $('.date-overlay').removeClass('open');
        }
    }
});