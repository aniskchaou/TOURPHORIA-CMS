jQuery(document).ready(function($) {
    if ($(".st_single_hotel_room").length <1) return;
    var time;
    var scroll = '';
    var offset_form = '';
    var month_start='';
    var year_start='';
    $(window).resize(function(event) {
        clearTimeout(time);
        time = setTimeout(function(){
                $(window).scroll(function(event) {
                    if($(window).width() >= 992){
                        if(scroll == ''){
                            scroll = $(window).scrollTop();
                        }
                        var t = 0;
                        if($('#top_toolbar-sticky-wrapper').length && $('#top_toolbar-sticky-wrapper').hasClass('is-sticky')){
                            if($('#top_toolbar').length){
                                t += $('#top_toolbar').height();
                            }
                        }
                        if($('#st_header_wrap_inner-sticky-wrapper').length && $('#st_header_wrap_inner-sticky-wrapper').hasClass('is-sticky')){
                            if($('#main-header').length){
                                t += $('#main-header').height();
                            }
                            if($('#top_toolbar').length){
                                t += $('#top_toolbar').height();
                            }
                        }
                        if($('#menu1-sticky-wrapper').length && $('#menu1-sticky-wrapper').hasClass('is-sticky')){
                            if($('#menu1').length){
                                t += $('#menu1').height();
                            }
                            if($('#top_toolbar').length){
                                t += $('#top_toolbar').height();
                            }
                        }
                        var h = 0;
                        if($('.hotel-room-form').length){
                            h = $('.hotel-room-form').offset().top - $(window).scrollTop();
                            if(offset_form == ''){
                                offset_form = $('.hotel-room-form').offset().top;
                            }
                        }
                        if(h <= t){

                            w = $('.hotel-room-form').width();
                            
                            var top_kc = t;
                            if ($('#wpadminbar').length > 0){ 
                                top_kc += $('#wpadminbar').height();
                            }

                            if( ! $('.hotel-room-form').hasClass('sidebar-fixed')){
                                $('.hotel-room-form').css('top', top_kc);
                                $('.hotel-room-form').addClass('sidebar-fixed').css('width', w);
                                $('.hotel-room-form').addClass('no_margin_top');
                            }
                        }
                        if($(window).scrollTop() <= offset_form && $(window).scrollTop() < scroll){
                            $('.hotel-room-form').removeClass('sidebar-fixed').css('width', 'auto');
                            $('.hotel-room-form').css('top', 0);
                            $('.hotel-room-form').removeClass('no_margin_top');
                        }

                        scroll = $(window).scrollTop();
                    }
                });
        }, 500);
    }).resize();

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
            },'json');

        }else{
            $('.date-overlay').removeClass('open');
        }
    }



    var HotelCalendar = function(container){
        var self = this;
        this.container = container;
        this.calendar= null;
        this.form_container = null;

        this.init = function(){
            self.container = container;
            self.calendar = $('.calendar-content', self.container);
            self.form_container = $('.calendar-form', self.container);
            self.initCalendar();
        }

        this.initCalendar = function(){
            var start=self.calendar.data('start');
            self.calendar.fullCalendar({
                firstDay: 1,
                lang:st_params.locale,
                customButtons: {
                    reloadButton: {
                        text: st_params.text_refresh,
                        click: function() {
                            self.calendar.fullCalendar( 'refetchEvents' );
                        }
                    }
                },
                header : {
                    left:   'prev',
                    center: 'title',
                    right:  'next'
                },
                contentHeight: 360,
                events:function(start, end, timezone, callback) {
                    $.ajax({
                        url: st_params.ajax_url,
                        dataType: 'json',
                        type:'post',
                        data: {
                            action:'st_get_availability_hotel_room',
                            post_id:self.container.data('post-id'),
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(doc){
                            if(typeof doc == 'object'){
                                callback(doc);
                            }
                        },
                        error:function(e)
                        {
                            alert('Can not get the availability slot. Lost connect with your sever');
                        }
                    });
                },
                eventClick: function(event, element, view){
                    /*$('#calendar_price', self.form_container).val(event.price);
                     $('#calendar_number', self.form_container).val(event.number);
                     $('#calendar_status option[value='+event.date+']', self.form_container).prop('selected');*/
                },
                eventRender: function(event, element, view){
                    var html = "";
                    var title = "";
                    var html_class = "btn-disabled";
                    var is_disabled = "disabled";
                    var today_y_m_d = new Date().getFullYear() +"-"+(new Date().getMonth()+1)+"-"+new Date().getDate();

                    if(event.status == 'booked'){ }
                    if(event.status == 'past'){ }
                    if(event.status == 'disabled'){ }

                    if(event.status == 'available'){
                        html_class = "btn-available";
                        is_disabled = "";
                        title = st_checkout_text.origin_price + ": "+event.price;
                    }
                    if(event.status == 'available_allow_fist'){
                        html_class = "btn-calendar btn-available_allow_fist available_allow_fist single-room";
                        is_disabled = "";
                        title = st_checkout_text.origin_price + ": "+event.price;
                    }
                    if(event.status == 'available_allow_last'){
                        html_class = "btn-calendar btn-available_allow_last available_allow_last single-room";
                        is_disabled = "";
                        title = st_checkout_text.origin_price + ": "+event.price;
                    }
                    var month = self.calendar.fullCalendar('getDate').format("MM");

                    var month_now = $.fullCalendar.moment(event.start._i).format("MM");
                    var _class = '';
                    if(month_now != month){
                        _class = 'next_month';
                    }

                    html += "<button  "+is_disabled+" data-toggle='tooltip' data-placement='top' class= '"+html_class+" "+_class+" btn' title ='"+title+"''>"+event.day;
                    if (today_y_m_d === event.date) {
                        html += "<span class='triangle'></span>";
                    }
                    html+="</button>";
                    $('.fc-content', element).html(html);
                },
                eventAfterRender: function( event, element, view ) {
                    $('[data-toggle="tooltip"]').tooltip({html:true});
                },
                loading: function(isLoading, view){
                    if(isLoading){
                        $('.calendar-wrapper-inner .overlay-form').fadeIn();
                    }else{
                        $('.calendar-wrapper-inner .overlay-form').fadeOut();
                    }
                },
                defaultDate:$.fullCalendar.moment(start)

            });
        }
    };
    if($('.calendar-wrapper').length){
        $('.calendar-wrapper').each(function(index, el) {
            var t = $(this);
            var hotel = new HotelCalendar(t);
            hotel.init();

            $('body').on('calendar.change_month', function(event, value){
            	var date = hotel.calendar.fullCalendar('getDate');
            	var month = date.format('M');
            	date = date.add(value-month, 'M');
            	hotel.calendar.fullCalendar( 'gotoDate', date.format('YYYY-MM-DD') );
            });

            changeSelectBoxMonth(hotel);
            $('.fc-next-button, .fc-prev-button').click(function(){
                changeSelectBoxMonth(hotel);
            });
        });
    };

    function changeSelectBoxMonth(tt){
        var date = tt.calendar.fullCalendar('getDate');
        var month = date.format('M');
        $('.calendar_change_month').val(month);
    }

    var single_hotel_room  = $(".st_single_hotel_room");
    if(single_hotel_room.length>0){
        var fancy_arr = single_hotel_room.data('fancy_arr');
        if (fancy_arr ==1){
            $('a#fancy-gallery').on("click",function(event) {
                var list = fancy_arr;
                $.fancybox.open(list);
            });
        }

    }
    $('a.button-readmore').click(function(){
        if($('#read-more').length > 0){
            $('#read-more').removeClass('hidden');
            $(this).addClass('hidden');
            $('#show-description').remove();
        }
    });
});
