jQuery(function($){
	$('.date-picker').datepicker({
        dateFormat: "mm/dd/yy",
        firstDay: 1
    });

	var TourCalendar = function(container){
		var self = this;
		this.container = container;
		this.calendar= null;
		this.form_container = null;

		this.init = function(){
			self.container = container;
			self.calendar = $('.calendar-content', self.container);
			self.form_container = $('.calendar-form', self.container);
			setCheckInOut('', '', self.form_container);
			self.initCalendar();
		}

		this.initCalendar = function(){
            var hide_adult = self.calendar.data('hide_adult');
            var hide_children = self.calendar.data('hide_children');
            var hide_infant = self.calendar.data('hide_infant');
			self.calendar.fullCalendar({
				firstDay: 1,
                lang:st_params.locale,
                timezone: st_timezone.timezone_string,
				customButtons: {
			        reloadButton: {
                        text: st_params.text_refresh,
			            click: function() {
			                self.calendar.fullCalendar( 'refetchEvents' );
			            }
			        }
			    },
				header : {
				    left:   'today,reloadButton',
                    center: 'title',
                    right:  'prev, next'
				},
				selectable: true,
				select : function(start, end, jsEvent, view){
					var start_date = new Date(start._d).toString("MM");
					var end_date = new Date(end._d).toString("MM");
					var start_year = new Date(start._d).toString("yyyy");
					var end_year = new Date(end._d).toString("yyyy");
					var today = new Date().toString("MM");
					var today_year = new Date().toString("yyyy");
					if((start_date < today && start_year <= today_year) || (end_date < today && end_year <= today_year)){
						self.calendar.fullCalendar('unselect');
						setCheckInOut('', '', self.form_container);
					}else{
						var zone = moment(start._d).format('Z');
							zone = zone.split(':');
							zone = "" + parseInt(zone[0]) + ":00";
						var check_in = moment(start._d).utcOffset(zone).format("MM/DD/YYYY");
						var	check_out = moment(end._d).utcOffset(zone).subtract(1, 'day').format("MM/DD/YYYY");
						setCheckInOut(check_in, check_out, self.form_container);
					}
					
				},
				events:function(start, end, timezone, callback) {
                    $.ajax({
                        url: ajaxurl,
                        dataType: 'json',
                        type:'post',
                        data: {
                            action: 'st_get_availability_activity',
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
				eventClick: function(event, element, view){
                    setCheckInOut(event.start.format('MM/DD/YYYY'),event.start.format('MM/DD/YYYY'),self.form_container);

                    var hasTimeFormat = false;
                    if($('.calendar_starttime_format').length){
                        hasTimeFormat = true;
                    }

                    if(event.starttime != '' && event.starttime != null) {
                        var starttime_arr = event.starttime.split(', ');

                        starttime_arr = cleanArray(starttime_arr);

                        $('.calendar-form .calendar-starttime-wraper').not('.starttime-origin').remove();

                        $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_hour').attr('name', 'calendar_starttime_hour[]');
                        $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_minute').attr('name', 'calendar_starttime_minute[]');
                        if(hasTimeFormat){
                            $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_format').attr('name', 'calendar_starttime_format[]');
                        }

                        if (starttime_arr.length > 0) {
                            for (var i = 0; i < (starttime_arr.length - 1); i++) {
                                $('.calendar-form .calendar-starttime-wraper.starttime-origin').clone(true).show().removeClass('starttime-origin').insertBefore('.calendar-form #calendar-add-starttime');
                            }
                        }

                        $('.calendar-form .calendar-starttime-wraper').show();
                        $('.calendar-form .calendar-starttime-wraper').each(function (index, value) {
                            if (starttime_arr.length > 0) {
                                var starttime_string = starttime_arr[index];
                                var starttime_sub_arr = starttime_string.split(':');
                                if(hasTimeFormat){
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_hour').eq(index).val(starttime_sub_arr[0]);
                                    var starttime_sub_with_format_arr = starttime_sub_arr[1].split(' ');
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_minute').eq(index).val(starttime_sub_with_format_arr[0]);
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_format').eq(index).val(starttime_sub_with_format_arr[1]);
                                }else{
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_hour').eq(index).val(starttime_sub_arr[0]);
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_minute').eq(index).val(starttime_sub_arr[1]);
                                }
                            } else {
                                if(hasTimeFormat){
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_hour').eq(index).val('01');
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_minute').eq(index).val('00');
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_format').eq(index).val('AM');
                                }else{
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_hour').eq(index).val('00');
                                    $('.calendar-form .calendar-starttime-wraper .calendar_starttime_minute').eq(index).val('00');
                                }
                            }
                        });
                    }else{
                        $('.calendar-form .calendar-starttime-wraper').not('.starttime-origin').remove();
                        $('.calendar-form .calendar-starttime-wraper.starttime-origin').hide();
                        $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_hour').attr('name', '');
                        $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_minute').attr('name', '');
                        if(hasTimeFormat){
                            $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_format').attr('name', '');
                        }
                    }
                    $('#calendar_adult_price', self.form_container).val(event.adult_price);
                    $('#calendar_child_price', self.form_container).val(event.child_price);
                    $('#calendar_infant_price', self.form_container).val(event.infant_price);
                    $('#calendar_status option[value='+event.status+']', self.form_container).prop('selected');
				},
				eventRender: function(event, element, view){
					var html = '';
					if(event.status == 'available'){
                        if (hide_adult != 'on') {
                            html += '<div class="price">Adult: '+event.adult_price+'</div>';
                        }
                        if (hide_children != 'on') {
                            html += '<div class="price">Children: '+event.child_price+'</div>';
                        }
                        if (hide_infant != 'on') {
                            html += '<div class="price">Infant: '+event.infant_price+'</div>';
                        }
						if(event.starttime != '' && event.starttime != null) {
                            html += '<div class="starttime"><span class="dashicons dashicons-clock"></span> ' + event.starttime + '</div>';
                        }
						
					}
					if(typeof event.status == 'undefined' || event.status != 'available'){
						html += '<div class="not_available">Not Available</div>';
					}
					$('.fc-content', element).html(html);
				},
                loading: function(isLoading, view){
                    if(isLoading){
                    	$('.overlay', self.container).addClass('open');
                    }else{
                    	$('.overlay', self.container).removeClass('open');
                    }
                },

			});
		}
	};

	function setCheckInOut(check_in, check_out, form_container){
		$('#calendar_check_in', form_container).val(check_in);
		$('#calendar_check_out', form_container).val(check_out);
	}
	function resetForm(form_container){
		$('#calendar_check_in', form_container).val('');
		$('#calendar_check_out', form_container).val('');
		$('#calendar_adult_price', form_container).val('');
		$('#calendar_child_price', form_container).val('');
		$('#calendar_infant_price', form_container).val('');
        $('.calendar-form .calendar-starttime-wraper.starttime-origin').hide();
        $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_hour').attr('name', '');
        $('.calendar-form .calendar-starttime-wraper.starttime-origin').find('select.calendar_starttime_minute').attr('name', '');
        $('.calendar-form .calendar-starttime-wraper').not('.starttime-origin').remove();
		$('#calendar_number', form_container).val('');
	}
    function cleanArray(actual) {
        var newArray = new Array();
        for (var i = 0; i < actual.length; i++) {
            if (actual[i]) {
                newArray.push(actual[i]);
            }
        }
        return newArray;
    }
	jQuery(document).ready(function($) {
		$('.calendar-wrapper').each(function(index, el) {
			var t = $(this);
            var tour = new TourCalendar(t);
            tour.init();
			var flag_submit = false;
			$('#calendar_submit', t).click(function(event) {
				var data = $('input, select', '.calendar-form').serializeArray();
					data.push({
						name: 'action',
						value: 'st_add_custom_price_activity'
					});
				$('.form-message', t).attr('class', 'form-message').find('p').html('');	
				$('.overlay', self.container).addClass('open');
				if(flag_submit) return false; flag_submit = true;
				$.post(ajaxurl, data, function(respon, textStatus, xhr) {
					if(typeof respon == 'object'){
						if(respon.status == 1){
							resetForm(t);
							$('.calendar-content', t).fullCalendar('refetchEvents');
						}else{
							$('.form-message', t).addClass(respon.type).find('p').html(respon.message);
							$('.overlay', self.container).removeClass('open');
						}
					}else{
						$('.overlay', self.container).removeClass('open');
					}

					flag_submit = false;
				}, 'json');
				return false;
			});
            $(document).on('click','.ui-tabs-anchor[href="#setting_availability_tab"]',function(){
                //tour.calendar.fullCalendar( 'refetchEvents' );
                $('.calendar-content', t).fullCalendar('today');
            });

            $('body').on('calendar.change_month', function(event, value){
            	var date = tour.calendar.fullCalendar('getDate');
            	var month = date.format('M');
            	date = date.add(value-month, 'M');
            	tour.calendar.fullCalendar( 'gotoDate', date.format('YYYY-MM-DD') );
            });

		});


		
		if($('select#type_activity').length && $('select#type_activity').val() == 'daily_activity'){
			$('input#calendar_groupday').prop('checked', false).parent().hide();
		}else{
			$('input#calendar_groupday').parent().show();
		}
		$('select#type_activity').change(function(event) {
			activity_type = $(this).val();
			if(activity_type == 'daily_activity'){
				$('input#calendar_groupday').prop('checked', false).parent().hide();
			}else{
				$('input#calendar_groupday').parent().show();
			}
		});
	});

    $(document).on('click', '.calendar-form .calendar-add-starttime', function () {
        var sparent = $(this).closest('.calendar-form');
        var starttime_origin = $('.calendar-starttime-wraper.starttime-origin', sparent);
        if(!starttime_origin.is(":visible")) {
            starttime_origin.find('select.calendar_starttime_hour').attr('name', 'calendar_starttime_hour[]');
            starttime_origin.find('select.calendar_starttime_minute').attr('name', 'calendar_starttime_minute[]');
            if($(this).data('time-format') === '12h'){
                starttime_origin.find('select.calendar_starttime_format').attr('name', 'calendar_starttime_format[]');
            }
        }
        starttime_origin.clone(true).show().removeClass('starttime-origin').insertBefore($(this));
        if(!starttime_origin.is(":visible")) {
            starttime_origin.find('select.calendar_starttime_hour').attr('name', '');
            starttime_origin.find('select.calendar_starttime_minute').attr('name', '');
            if($(this).data('time-format') === '12h'){
                starttime_origin.find('select.calendar_starttime_format').attr('name', '');
            }
        }
    });
    $(document).on('click', '.bulk-starttime .calendar-add-starttime', function () {
        var sparent = $(this).closest('.bulk-starttime');
        var starttime_origin = $('.calendar-starttime-wraper.starttime-origin', sparent);
        if(!starttime_origin.is(":visible")) {
            starttime_origin.find('select.calendar_starttime_hour').attr('name', 'calendar_starttime_hour[]');
            starttime_origin.find('select.calendar_starttime_minute').attr('name', 'calendar_starttime_minute[]');
            if($(this).data('time-format') === '12h'){
                starttime_origin.find('select.calendar_starttime_format').attr('name', 'calendar_starttime_format[]');
            }
        }
        starttime_origin.clone(true).show().removeClass('starttime-origin').insertBefore($(this));
        if(!starttime_origin.is(":visible")) {
            starttime_origin.find('select.calendar_starttime_hour').attr('name', '');
            starttime_origin.find('select.calendar_starttime_minute').attr('name', '');
            if($(this).data('time-format') === '12h'){
                starttime_origin.find('select.calendar_starttime_format').attr('name', '');
            }
        }
    });
    $(document).on('click', '.calendar-remove-starttime', function () {
        if($(this).parent().hasClass('starttime-origin')){
            $(this).parent().hide();
            $(this).parent().find('select.calendar_starttime_hour').attr('name', '');
            $(this).parent().find('select.calendar_starttime_minute').attr('name', '');
            if($(this).data('time-format') === '12h'){
                starttime_origin.find('select.calendar_starttime_format').attr('name', '');
            }
        }else{
            $(this).parent().remove();
        }
    });

    function checkHasStarttime(){
    	var i = 0;
    	if($('.calendar-starttime-wraper').length){
    		$('.calendar-starttime-wraper').each(function () {
				i++;
            });
		}
		if(i == 0){
    		return false;
		}else{
			return true;
		}
	}
});
