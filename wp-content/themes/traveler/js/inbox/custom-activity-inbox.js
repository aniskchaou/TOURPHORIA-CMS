jQuery(document).ready(function($) {
    var parentDiv = $('.st-inbox-form-book');

    $( document ).ajaxStop(function() {
        $('.overlay-form').fadeOut(500);
    });

    if($('#check_in').length) {
        var st_data_checkin = $('#starttime_hidden_load_form').data('checkin');
        var st_data_checkout = $('#starttime_hidden_load_form').data('checkout');

        if (st_data_checkin != st_data_checkout) {
            $('input#check_out').parent().parent().show();
        }

        if (st_data_checkin != '') {
            var st_data_tour_id = $('#starttime_hidden_load_form').data('tourid');
            var st_data_starttime = $('#starttime_hidden_load_form').data('starttime');

            if (st_data_starttime != "" && typeof st_data_starttime !== 'undefined')
                ajaxSelectStartTime(st_data_tour_id, st_data_checkin, st_data_checkout, st_data_starttime);
        }
    }


    var ActivityCalendar = function(container){
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
            var hide_adult = self.calendar.data('hide_adult');
            var hide_children = self.calendar.data('hide_children');
            var hide_infant = self.calendar.data('hide_infant');
            var date_start = self.calendar.data('date-start');
            self.calendar.fullCalendar({
                defaultDate: moment(date_start),
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
                contentHeight: 900,
                select : function(start, end, jsEvent, view){
                    var start_date = new Date(start._d).toString("MM");
                    var end_date = new Date(end._d).toString("MM");
                    var today = new Date().toString("MM");
                    if(start_date < today || end_date < today){
                        self.calendar.fullCalendar('unselect');
                    }
                },
                events:function(start, end, timezone, callback) {
                    $.ajax({
                        url: st_params.ajax_url,
                        dataType: 'json',
                        type:'post',
                        data: {
                            action: 'st_get_availability_activity_frontend',
                            activity_id: self.container.data('post-id'),
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
                eventMouseover: function(event, jsEvent, view){
                },
                eventMouseout: function(event, jsEvent, view){
                },
                eventRender: function(event, element, view){
                    var html = event.day;
                    var html_class = "none";
                    if(typeof event.date_end != 'undefined'){
                        html += ' - '+event.date_end;
                        html_class = "group";
                    }
                    var today_y_m_d = new Date().getFullYear() +"-"+(new Date().getMonth()+1)+"-"+new Date().getDate();

                    var month = self.calendar.fullCalendar('getDate').format("MM");

                    var month_now = $.fullCalendar.moment(event.start._i).format("MM");
                    var _class = '';
                    if(month_now != month){
                        _class = 'next_month';
                    }
                    if(event.status == 'available'){
                        var title ="";

                        if ( hide_adult != 'on'){title += st_checkout_text.adult_price+': '+event.adult_price + " <br/>"; }
                        if ( hide_children != 'on') {title += st_checkout_text.child_price+': '+event.child_price + " <br/>"; }
                        if ( hide_infant != 'on') {title += st_checkout_text.infant_price+': '+event.infant_price ;  }

                        var dataStartTime = 'n';
                        if(event.starttime != '' && event.starttime != null){
                            title += '<br /><i class="fa fa-clock-o" aria-hidden="true"></i> ' + event.starttime;
                            dataStartTime = "data-starttime='y'";
                        }


                        html  = "<button "+ dataStartTime +" data-placement='top' title  = '"+title+"' data-toggle='tooltip' class='"+html_class+" "+_class+" btn btn-available'>" + html;
                    }else {
                        html  = "<button disabled data-placement='top' title  = 'Disabled' data-toggle='tooltip' class='"+html_class+" btn btn-disabled'>" + html;
                    }
                    if (today_y_m_d === event.date) {
                        html += "<span class='triangle'></span>";
                    }
                    html  += "</button>";
                    element.addClass('event-'+event.id)
                    element.addClass('event-number-'+event.start.unix());
                    $('.fc-content', element).html(html);


                    element.bind('click', function(calEvent, jsEvent, view) {

                        var check_in = '';
                        var check_out = '';

                        if (!$(this).find("button").hasClass('btn-available')) return ;
                        $('.fc-day-grid-event').removeClass('st-active');
                        $(this).addClass('st-active');
                        var checkStartTime = $(this).find('button').data('starttime');
                        date = $.fullCalendar.moment(event.start._i);
                        $('input#check_in').val(date.format(st_params.date_format_calendar.toUpperCase())).parent().parent().show();
                        check_in = date.format(st_params.date_format_calendar.toUpperCase());
                        if(typeof event.end != 'undefined' && event.end && typeof event.end._i != 'undefined'){
                            date = new Date(event.end._i);
                            date.setDate(date.getDate() - 1);
                            //date = $.fullCalendar.moment(date).format(st_params.date_format_calendar.toUpperCase());
                            date = $.fullCalendar.moment(date);
                            check_out = date.format(st_params.date_format_calendar.toUpperCase());
                            $('input#check_out').val(date.format(st_params.date_format_calendar.toUpperCase())).parent().parent().show();
                            //$('input#check_out').val(date).parent().show();
                        }else{
                            date = $.fullCalendar.moment(event.start._i).format(st_params.date_format_calendar.toUpperCase());
                            $('input#check_out').val(date).parent().parent().hide();

                        }
                        $('input#adult_price').val(event.adult_price);
                        $('input#child_price').val(event.child_price);
                        $('input#infant_price').val(event.infant_price);

                        //Disable calendar when choose date
                        if($('.page-template-template-user .qtip').length){
                            if($('#select-a-activity').length) {
                                $('#select-a-activity').qtip("hide");
                            }
                        }

                        if(checkStartTime == 'y'){
                            ajaxSelectStartTime(self.container.data('post-id'), check_in, check_out, '');
                        }else{
                            $('.st_activity_starttime option').remove();
                            $('.activity-starttime').hide();
                        }

                    });
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

            });
        }
    };

    function changeSelectBoxMonth(tt){
        var date = tt.calendar.fullCalendar('getDate');
        var month = date.format('M');
        $('.calendar_change_month').val(month);
    }

    if($('#select-a-activity').length){
        if($('#select-a-activity').length){
            $('#select-a-activity').qtip({
                content: {
                    text: $('#list_activity_item').html()
                },
                show: {
                    when: 'click',
                    solo: true // Only show one tooltip at a time
                },
                hide: 'unfocus',
                api :{
                    onShow : function(){
                        $('.calendar-wrapper').each(function(index, el) {
                            var t = $(this);
                            var activity = new ActivityCalendar(t);
                            activity.init();

                            $('body').on('calendar.change_month', function(event, value){
                                var date = activity.calendar.fullCalendar('getDate');
                                var month = date.format('M');
                                date = date.add(value-month, 'M');
                                activity.calendar.fullCalendar( 'gotoDate', date.format('YYYY-MM-DD') );
                            });
                            var current_date = t.data('current-date');
                            if(current_date != '') {
                                activity.calendar.fullCalendar('gotoDate', current_date);
                            }

                            /* Trigger next/prev month */
                            changeSelectBoxMonth(activity);
                            $('.fc-next-button, .fc-prev-button').click(function(){
                                changeSelectBoxMonth(activity);
                            });
                        });
                    }
                }
            });
        }
    }

    function ajaxSelectStartTime(activity_id, check_in, check_out, select_starttime) {
        var sparent = $('.st-inbox-form-book');
        var overlay = $('.overlay-form', sparent);
        overlay.hide();
        xhr = $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_get_starttime_activity_frontend',
                activity_id: activity_id,
                check_in: check_in,
                check_out: check_out
            },

            beforeSend: function () {
                overlay.show();
                parentDiv.addClass('loading');
            },

            success: function (doc) {
                if (doc['data'] != null && doc['data'].length > 0) {
                    $('.st_activity_starttime option', sparent).remove();
                    $('.activity-starttime', sparent).show();
                    var te = '';
                    for (i = 0; i < doc['data'].length; i++) {
                        var op_disable = '';

                        if (doc['check'][i] == '-1') {
                            if (doc['data'][i] == select_starttime) {
                                te += '<option value="' + doc['data'][i] + '" selected ' + op_disable + '>' + doc['data'][i] + '</option>';
                            } else {
                                te += '<option value="' + doc['data'][i] + '" ' + op_disable + '>' + doc['data'][i] + '</option>';
                            }
                        } else {
                            if (doc['check'][i] == '0') {
                                //op_disable = 'disabled="disabled"';
                                if (doc['data'][i] == select_starttime) {
                                    te += '<option value="' + doc['data'][i] + '" selected ' + op_disable + '>' + doc['data'][i] + ' ( ' + st_params.no_vacancy + ' )' + '</option>';
                                } else {
                                    te += '<option value="' + doc['data'][i] + '" ' + op_disable + '>' + doc['data'][i] + ' ( ' + st_params.no_vacancy + ' )' + '</option>';
                                }
                            } else {
                                if (doc['data'][i] == select_starttime) {
                                    if (doc['check'][i] == '1') {
                                        te += '<option value="' + doc['data'][i] + '" selected ' + op_disable + '>' + doc['data'][i] + ' ( ' + st_params.a_vacancy + ' )' + '</option>';
                                    } else {
                                        te += '<option value="' + doc['data'][i] + '" selected ' + op_disable + '>' + doc['data'][i] + ' ( ' + doc['check'][i] + ' ' + st_params.more_vacancy + ' )' + '</option>';
                                    }
                                } else {
                                    if (doc['check'][i] == '1') {
                                        te += '<option value="' + doc['data'][i] + '" ' + op_disable + '>' + doc['data'][i] + ' ( ' + st_params.a_vacancy + ' )' + '</option>';
                                    } else {
                                        te += '<option value="' + doc['data'][i] + '" ' + op_disable + '>' + doc['data'][i] + ' ( ' + doc['check'][i] + ' ' + st_params.more_vacancy + ' )' + '</option>';
                                    }
                                }
                            }
                        }
                    }
                    $('.st_activity_starttime', sparent).append(te);
                    overlay.hide();
                    parentDiv.removeClass('loading');
                } else {
                    $('#starttime_box').hide();
                    overlay.hide();
                    parentDiv.removeClass('loading');
                }
                requestRunning = false;
            },
        });
        requestRunning = true;
    }
});