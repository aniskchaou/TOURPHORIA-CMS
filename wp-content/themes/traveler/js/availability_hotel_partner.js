jQuery(function($) {
    if ($(".st_partner_avaiablity.edit-room").length < 1) return;
    $('.date-picker').datepicker({
        dateFormat: "mm/dd/yy",
        weekStart: 1
    });
    var HotelCalendar = function(container) {
        var self = this;
        this.container = container;
        this.calendar = null;
        this.form_container = null;
        this.init = function() {
            self.container = container;
            self.calendar = $('.calendar-content', self.container);
            self.form_container = $('.calendar-form', self.container);
            setCheckInOut('', '', self.form_container);
            self.initCalendar()
        }
        this.initCalendar = function() {
            self.calendar.fullCalendar({
                firstDay: 1,
                lang: st_params.locale,
                timezone: st_timezone.timezone_string,
                customButtons: {
                    reloadButton: {
                        text: st_params.text_refresh,
                        click: function() {
                            self.calendar.fullCalendar('refetchEvents')
                        }
                    }
                },
                header: {
                    left: 'today,reloadButton',
                    center: 'title',
                    right: 'prev, next'
                },
                contentHeight: 480,
                selectable: !0,
                select: function(start, end, jsEvent, view) {
                    var start_date = new Date(start._d).toString("MM");
                    var end_date = new Date(end._d).toString("MM");
                    var today = new Date().toString("MM");
                    if (start_date < today || end_date < today) {
                        self.calendar.fullCalendar('unselect');
                        setCheckInOut('', '', self.form_container)
                    } else {
                        var zone = moment(start._d).format('Z');
                        zone = zone.split(':');
                        zone = "" + parseInt(zone[0]) + ":00";
                        var check_in = moment(start._d).utcOffset(zone).format("MM/DD/YYYY");
                        var check_out = moment(end._d).utcOffset(zone).subtract(1, 'day').format("MM/DD/YYYY");
                        setCheckInOut(check_in, check_out, self.form_container)
                    }
                },
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: ajaxurl,
                        dataType: 'json',
                        type: 'post',
                        data: {
                            action: 'st_get_availability_hotel',
                            post_id: self.container.data('post-id'),
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(doc) {
                            if (typeof doc == 'object') {
                                callback(doc)
                            }
                        },
                        error: function(e) {
                            alert('Can not get the availability slot. Lost connect with your sever')
                        }
                    })
                },
                eventClick: function(event, element, view) {},
                eventRender: function(event, element, view) {
                    var html = '';
                    if (event.status == 'available') {
                        html += '<div class="price">Price: ' + event.price + '</div>'
                    }
                    if (typeof event.status == 'undefined' || event.status != 'available') {
                        html += '<div class="not_available">Not Available</div>'
                    }
                    $('.fc-content', element).html("<div class='bgr-main'>" + html + "</div>")
                },
                loading: function(isLoading, view) {
                    if (isLoading) {
                        $('.calendar-wrapper-inner .overlay-form').fadeIn()
                    } else {
                        $('.calendar-wrapper-inner .overlay-form').fadeOut()
                    }
                },
            })
        }
    };

    function setCheckInOut(check_in, check_out, form_container) {
        $('#calendar_check_in', form_container).val(check_in);
        $('#calendar_check_out', form_container).val(check_out)
    }

    function resetForm(form_container) {
        $('#calendar_check_in', form_container).val('');
        $('#calendar_check_out', form_container).val('');
        $('#calendar_price', form_container).val('');
        $('#calendar_priority', form_container).val('');
        $('#calendar_number', form_container).val('')
    }
    jQuery(document).ready(function($) {
        if ($('a[href="#availablility_tab"], ul li[data-step="#step_availablility"]').length) {
            $('a[href="#availablility_tab"], ul li[data-step="#step_availablility"]').click(function(event) {
                setTimeout(function() {
                    $('.calendar-content', '.calendar-wrapper').fullCalendar('today')
                }, 1000)
            })
        }
        $('.calendar-wrapper').each(function(index, el) {
            console.log('sasa');
            var t = $(this);
            var hotel = new HotelCalendar(t);
            hotel.init();
            var flag_submit = !1;
            $('#calendar_submit', t).click(function(event) {
                var data = $('input, select', '.calendar-form').serializeArray();
                data.push({
                    name: 'action',
                    value: 'st_add_custom_price'
                });
                $('.form-message', t).attr('class', 'form-message').find('p').html('');
                $('.overlay', self.container).addClass('open');
                if (flag_submit) return !1;
                flag_submit = !0;
                $.post(ajaxurl, data, function(respon, textStatus, xhr) {
                    if (typeof respon == 'object') {
                        if (respon.status == 1) {
                            resetForm(t);
                            $('.calendar-content', t).fullCalendar('refetchEvents')
                        } else {
                            $('.form-message', t).addClass(respon.type).find('p').html(respon.message);
                            $('.overlay', self.container).removeClass('open')
                        }
                    } else {
                        $('.overlay', self.container).removeClass('open')
                    }
                    flag_submit = !1
                }, 'json');
                return !1
            });

            $('body').on('calendar.change_month', function(event, value){
            	var date = hotel.calendar.fullCalendar('getDate');
            	var month = date.format('M');
            	date = date.add(value-month, 'M');
            	hotel.calendar.fullCalendar( 'gotoDate', date.format('YYYY-MM-DD') );
            });
        })
    })
})