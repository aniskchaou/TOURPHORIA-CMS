jQuery(document).ready(function ($) {

    var parentDiv = $('.st-inbox-form-book');

    var requestRunning = false;
    var xhr;

    $('[data-toggle="tooltip"]').tooltip();

    $(document).ajaxStop(function () {
        $('.overlay-form').fadeOut(500);
    });

    //@since 2.0.0
    /**
     * Load select starttime ajax have post
     * */
    if($('#check_in').length) {
        var st_data_checkin = $('#check_in').val();
        var st_data_checkout = $('#check_out').val();

        if (st_data_checkin != st_data_checkout) {
            $('input#check_out').parent().parent().show();
        } else {
            $('input#check_out').parent().parent().hide();
        }

        var tour_type = $('input[name="type_tour"]').val();
        if (tour_type == 'daily_tour') {
            var st_data_checkout = $('#check_in').val();
            $('input#check_out').parent().hide();
        }

        if (st_data_checkin != '') {
            var st_data_tour_id = $('#starttime_hidden_load_form').data('tourid');
            var st_data_starttime = $('#starttime_hidden_load_form').data('starttime');

            if (st_data_starttime != "" && typeof st_data_starttime !== 'undefined') {
                if(st_data_checkout == '')
                    st_data_checkout = st_data_checkin;
                ajaxSelectStartTime(st_data_tour_id, st_data_checkin, st_data_checkout, st_data_starttime);
            }
        }
    }

    var TourCalendar = function (container) {
        var self = this;
        this.container = container;
        this.calendar = null;
        this.form_container = null;

        this.init = function () {
            self.container = container;
            self.calendar = $('.calendar-content', self.container);
            self.form_container = $('.calendar-form', self.container);
            self.initCalendar();
        }
        this.initCalendar = function () {

            var hide_adult = self.calendar.data('hide_adult');
            var hide_children = self.calendar.data('hide_children');
            var hide_infant = self.calendar.data('hide_infant');
            var price_type = self.calendar.data('price-type');

            var current_date = $('.calendar-wrapper').data('current-date');

            self.calendar.fullCalendar({
                defaultDate: current_date,
                firstDay: 1,
                lang: st_params.locale,
                customButtons: {
                    reloadButton: {
                        text: st_params.text_refresh,
                        click: function () {
                            self.calendar.fullCalendar('refetchEvents');
                        }
                    }
                },
                header: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                contentHeight: 360,
                select: function (start, end, jsEvent, view) {
                    var start_date = new Date(start._d).toString("MM");
                    var end_date = new Date(end._d).toString("MM");
                    var today = new Date().toString("MM");
                    if (start_date < today || end_date < today) {
                        self.calendar.fullCalendar('unselect');
                    }
                },
                events: function (start, end, timezone, callback) {
                    $.ajax({
                        url: st_params.ajax_url,
                        dataType: 'json',
                        type: 'post',
                        data: {
                            action: 'st_get_availability_tour_frontend',
                            tour_id: self.container.data('post-id'),
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function (doc) {
                            if (typeof doc == 'object') {
                                callback(doc);
                            }
                        },
                        error: function (e) {
                            alert('Can not get the availability slot. Lost connect with your sever');
                        }
                    });
                },
                eventClick: function (event, element, view) {
                    self.calendar.trigger('st.select.tour.frontend', [event, element, view]);
                },
                eventMouseover: function (event, jsEvent, view) {
                    //$('.event-number-'+event.start.unix()).addClass('hover');
                },
                eventMouseout: function (event, jsEvent, view) {
                    //$('.event-number-'+event.start.unix()).removeClass('hover');
                },
                eventRender: function (event, element, view) {

                    var month = self.calendar.fullCalendar('getDate').format("MM");
                    var month_now = $.fullCalendar.moment(event.start._i).format("MM");
                    var _class = '';
                    if (month_now != month) {
                        _class = 'next_month';
                    }

                    var html = event.day;
                    var html_class = "none";
                    if (typeof event.date_end != 'undefined') {
                        html += ' - ' + event.date_end;
                        html_class = "group";
                    }
                    var today_y_m_d = new Date().getFullYear() + "-" + (new Date().getMonth() + 1) + "-" + new Date().getDate();
                    if (event.status == 'available') {
                        var title = "";

                        if(price_type == 'person'){
                            if (hide_adult != 'on') {
                                title += st_checkout_text.adult_price + ': ' + event.adult_price + " <br/>";
                            }
                            if (hide_children != 'on') {
                                title += st_checkout_text.child_price + ': ' + event.child_price + " <br/>";
                            }
                            if (hide_infant != 'on') {
                                title += st_checkout_text.infant_price + ': ' + event.infant_price;
                            }
                        }else{
                            title += st_checkout_text.price + ': ' + event.base_price;
                        }
                        var dataStartTime = "data-starttime='n'";
                        if(event.starttime != '' && event.starttime != null){
                            title += '<br /><i class="fa fa-clock-o" aria-hidden="true"></i> ' + event.starttime;
                            dataStartTime = "data-starttime='y'";
                        }
                        html = "<button "+ dataStartTime +" data-placement='top' title  = '" + title + "' data-toggle='tooltip' class='" + html_class + " " + _class + " btn btn-available'>" + html;
                    } else {
                        html = "<button disabled data-placement='top' title  = 'Disabled' data-toggle='tooltip' class='" + html_class + " btn btn-disabled'>" + html;
                    }
                    if (today_y_m_d === event.date) {
                        html += "<span class='triangle'></span>";
                    }
                    html += "</button>";
                    element.addClass('event-' + event.id)
                    element.addClass('event-number-' + event.start.unix());
                    $('.fc-content', element).html(html);
                    self.calendar.trigger('st_render_calendar_frontend', [event, element, view]);

                    element.bind('click', function (calEvent, jsEvent, view) {

                        var check_in = '';
                        var check_out = '';

                        if (!$(this).find("button").hasClass('btn-available')) return;
                        $('.fc-day-grid-event').removeClass('st-active');
                        $(this).addClass('st-active');
                        date = $.fullCalendar.moment(event.start._i);
                        $('input#check_in').val(date.format(st_params.date_format_calendar.toUpperCase())).parent().show();
                        check_in = date.format(st_params.date_format_calendar.toUpperCase());
                        if (typeof event.end != 'undefined' && event.end && typeof event.end._i != 'undefined') {
                            date = new Date(event.end._i);
                            date.setDate(date.getDate() - 1);
                            date = $.fullCalendar.moment(date);
                            check_out = date.format(st_params.date_format_calendar.toUpperCase());
                            $('input#check_out').val(date.format(st_params.date_format_calendar.toUpperCase())).parent().parent().show();
                        } else {
                            date = $.fullCalendar.moment(event.start._i).format(st_params.date_format_calendar.toUpperCase());
                            $('input#check_out').val(date).parent().parent().hide();

                        }
                        $('input#adult_price').val(event.adult_price);
                        $('input#child_price').val(event.child_price);
                        $('input#infant_price').val(event.infant_price);

                        //Disable calendar when choose date
                        if($('.page-template-template-user .qtip').length){
                            if($('#select-a-tour').length) {
                                $('#select-a-tour').qtip("hide");
                            }
                        }

                        if (requestRunning) {
                            xhr.abort();
                        }

                        var checkStartTime = $(this).find('button').data('starttime');
                        if(checkStartTime == 'y'){
                            if(check_out == '')
                                check_out = check_in;
                            ajaxSelectStartTime(self.container.data('post-id'), check_in, check_out, '');
                        }else{
                            $('#starttime_tour option').remove();
                            $('#starttime_box').hide();
                        }
                    });
                },
                eventAfterRender: function (event, element, view) {
                    $('[data-toggle="tooltip"]').tooltip({html: true});
                },
                loading: function (isLoading, view) {
                    if (isLoading) {
                        $('.calendar-wrapper-inner .overlay-form').fadeIn();
                    } else {
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

    if ($('#select-a-tour').length) {
        $('#select-a-tour').qtip({
            content: {
                text: $('#list_tour_item').html()
            },
            show: {
                when: 'click',
                solo: true // Only show one tooltip at a time
            },
            hide: 'unfocus',
            api: {
                onShow: function () {
                    $('.calendar-wrapper').each(function (index, el) {
                        var t = $(this);
                        var tour = new TourCalendar(t);
                        tour.init();

                        $('body').on('calendar.change_month', function (event, value) {
                            var date = tour.calendar.fullCalendar('getDate');
                            var month = date.format('M');
                            date = date.add(value - month, 'M');
                            tour.calendar.fullCalendar('gotoDate', date.format('YYYY-MM-DD'));
                        });
                        var checked = false;
                        $('body').on('click', '.st-tour-tabs-content .request', function () {
                            if (!checked) {
                                var current_date = t.data('current-date');
                                if(current_date != ''){
                                    setTimeout(function () {
                                        tour.calendar.fullCalendar('gotoDate', current_date);
                                        checked = true;
                                    }, 1000);
                                }
                            }
                        });

                        /* Trigger next/prev month */
                        changeSelectBoxMonth(tour);
                        $('.fc-next-button, .fc-prev-button').click(function(){
                            changeSelectBoxMonth(tour);
                        });
                    });
                }
            }
        });
    }

    function ajaxSelectStartTime(tour_id, check_in, check_out, select_starttime) {
        var sparent = $('.package-info-wrapper');
        var overlay = $('.overlay-form', sparent);
        overlay.hide();
        xhr = $.ajax({
            url: st_params.ajax_url,
            dataType: 'json',
            type: 'post',
            data: {
                action: 'st_get_starttime_tour_frontend',
                tour_id: tour_id,
                check_in: check_in,
                check_out: check_out
            },

            beforeSend: function () {
                overlay.show();
                parentDiv.addClass('loading');
            },

            success: function (doc) {
                if (doc['data'] != null && doc['data'].length > 0) {
                    $('#starttime_tour option').remove();
                    $('#starttime_box').show();

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
                    $('#starttime_tour option').remove();

                    $('#starttime_tour').append(te);
                    overlay.hide();
                    parentDiv.removeClass('loading');
                } else {
                    $('#starttime_box').hide();
                    overlay.hide();
                }
                requestRunning = false;
            },
        });
        requestRunning = true;
    }
});