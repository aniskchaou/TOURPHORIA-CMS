/**
 * Created by me664 on 3/3/15.
 */

jQuery(document).ready(function($){
    var meecell;
    if ($(".st_single_rental").length <1) return;
    $('.btn_booking_modal').click(function(){
       var form=$(this).closest('form');
       $('.alert',form).remove();
        var validate_form=true;
        var data=[];

        $('input.required,textarea.required,select.required',form).each(function(){

            $(this).removeClass('error');
            if(!$(this).val()){
                validate_form=false;
                $(this).addClass('error');
            }

            if($(this).attr('name')){
                data.push({
                    'value':$(this).val(),
                    'name':$(this).attr('name')
                });
            }

        });

        if(!validate_form)
        {
            form.prepend('<div class="alert alert-danger">'+st_checkout_text.validate_form+'</div>');
            return false;
        }else
        {
            var tar_get=$(this).data('target');

            for(i=0;i<data.length;i++)
            {
                var val=data[i];
                $(tar_get).find('.booking_modal_form').prepend('<input type="hidden" name="'+val.name+'" value="'+val.value+'">');
            }
            
            $.magnificPopup.open({
                items: {
                    type: 'inline',
                    src: tar_get
                }

            });
        }
    });

    var RentalCalendar = function(container){
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
                    right:  'next, '
                },
                contentHeight: 360,
                events:function(start, end, timezone, callback) {
                    $.ajax({
                        url: st_params.ajax_url,
                        dataType: 'json',
                        type:'post',
                        data: {
                            action:'st_get_availability_rental_single',
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
                    var is_group = 'off';
                    if($('#rental_is_groupday').length){
                        if($('#rental_is_groupday').val() == 'on'){
                            is_group = 'on';
                        }else{
                            is_group = 'off';
                        }
                    }
                    if(is_group == 'on') {
                        if ($(this).find('button').hasClass('is_group_day')) {
                            /*meecell = $(this);
                            //Start date
                            date = new Date(event.start._i);
                            date.setDate(date.getDate());
                            date = $.fullCalendar.moment(date);
                            check_in = date.format('YYYY-MM-DD');
                            var gstart_date = (date.format(st_params.date_format_calendar.toUpperCase()));

                            //End date
                            date = new Date(event.end._i);
                            date.setDate(date.getDate() - 1);
                            date = $.fullCalendar.moment(date);
                            check_out = date.format('YYYY-MM-DD');
                            var gend_date = (date.format(st_params.date_format_calendar.toUpperCase()));

                            var d = Date.parse(check_out);

                            var te = '<div id="gdate-choose" class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide gdate-choose-box"><ul>';

                            te += '<li><div class="gdate-choose-item btn btn-primary" id="gdate_start_item" data-date="' + gstart_date + '">' + gstart_date + '</div></li>';
                            te += '<li><div class="gdate-choose-item btn btn-primary" id="gdate_end_item" data-date="' + gend_date + '">' + gend_date + '</div></li>';
                            te += '<li><div class="gdate-choose-item btn btn-primary" id="gdate_all_item" data-start-date="' + gstart_date + '" data-end-date="' + gend_date + '">' + gstart_date + ' - ' + gend_date + '</li></div></ul></div>';
                            $('#gdate-choose').remove();
                            $(this).find('button.is_group_day').append(te);*/

                            /*if (!$(this).find('button').hasClass('btn-disabled-gd') && !$(this).find('button').hasClass('btn-disabled')) {
                                $.magnificPopup.open({
                                    items: {
                                        src: '#gdate-choose',
                                    }
                                });
                            }*/
                            meecell = $(this);

                            //Start date
                            date = new Date(event.start._i);
                            date.setDate(date.getDate());
                            date = $.fullCalendar.moment(date);
                            check_in = date.format('YYYY-MM-DD');
                            var gstart_date = (date.format(st_params.date_format_calendar.toUpperCase()));

                            //End date
                            date = new Date(event.end._i);
                            date.setDate(date.getDate() - 1);
                            date = $.fullCalendar.moment(date);
                            check_out = date.format('YYYY-MM-DD');
                            var gend_date = (date.format(st_params.date_format_calendar.toUpperCase()));

                            $('.fc-day-grid-event').removeClass('st-active');
                            meecell.addClass('st-active');
                            $('input#field-rental-start').val(gstart_date).parent().show();
                            $('input#field-rental-end').val(gend_date).parent().show();

                            $('.fc-day-grid-event').removeClass('current-select');
                            $('.fc-day-grid-event').each(function(index){
                                if($(this).find('button').hasClass('btn-disabled-gd')){
                                    $(this).find('button').removeClass('btn-disabled-gd').addClass('btn-available');
                                    $(this).find('button').removeAttr('disabled');
                                }
                            });
                        } else {
                            if ($('input#field-rental-start').val() == '' || ($('input#field-rental-start').val() != '' && $('input#field-rental-end').val() != '')) {
                                if (!$(this).find("button").hasClass('btn-available') && !$(this).find("button").hasClass('btn-available_allow_fist') && !$(this).find("button").hasClass('btn-available_allow_last')) return;
                                $('.fc-day-grid-event').removeClass('st-active');
                                $('.fc-day-grid-event').removeClass('current-select');
                                $(this).addClass('st-active');
                                var aa = $(this);
                                date = $.fullCalendar.moment(event.start._i);
                                $('input#field-rental-start').val(date.format(st_params.date_format_calendar.toUpperCase())).parent().show();
                                $('input#field-rental-end').val('');

                                $(this).addClass('current-select');
                                var ij = 0;
                                $('.fc-day-grid-event').each(function () {
                                    ij++;
                                    if ($(this).hasClass('current-select')) {
                                        return false;
                                    }
                                });
                                $('.fc-day-grid-event').each(function (index) {
                                    if (index < ij) {
                                        if ($(this).find('button').hasClass('btn-available')) {
                                            $(this).find('button').removeClass('btn-available').addClass('btn-disabled-gd');
                                            $(this).find('button').attr('disabled', true);
                                            $(this).find('.tooltip').remove();
                                        }
                                    }
                                });
                            } else {
                                if ($('input#field-rental-end').val() == '' || ($('input#field-rental-start').val() != '' && $('input#field-rental-end').val() != '')) {
                                    if (!$(this).find("button").hasClass('btn-available') && !$(this).find("button").hasClass('btn-available_allow_fist') && !$(this).find("button").hasClass('btn-available_allow_last')) return;
                                    $(this).addClass('st-active');
                                    date = $.fullCalendar.moment(event.start._i);
                                    $('input#field-rental-end').val(date.format(st_params.date_format_calendar.toUpperCase())).parent().show();
                                }
                            }
                        }
                    }
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
                        html_class = "btn-available btn-calendar btn-available_allow_fist available_allow_fist";
                        is_disabled = "";
                        title = st_checkout_text.origin_price + ": "+event.price;
                    }
                    if(event.status == 'available_allow_last'){
                        html_class = "btn-available btn-calendar btn-available_allow_last available_allow_last";
                        is_disabled = "";
                        title = st_checkout_text.origin_price + ": "+event.price;
                    }
                    var class_group_day = '';
                    if (typeof event.date_end != 'undefined') {
                        class_group_day = 'is_group_day';
                    }
                    html += "<button  "+is_disabled+" data-toggle='tooltip' data-placement='top' class= '"+html_class+" btn "+ class_group_day +"' title ='"+title+"''>"+event.day;
                    if (typeof event.date_end != 'undefined') {
                        html += ' - ' + event.date_end;
                    }
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
            var rental = new RentalCalendar(t);
            //rental.init();
            setTimeout(function(){
                rental.init();
                /* Trigger next/prev month */
                changeSelectBoxMonth(rental);
                $('.fc-next-button, .fc-prev-button').click(function(){
                    changeSelectBoxMonth(rental);
                });
            }, 100);

            $('body').on('calendar.change_month', function(event, value){
            	var date = rental.calendar.fullCalendar('getDate');
            	var month = date.format('M');
            	date = date.add(value-month, 'M');
            	rental.calendar.fullCalendar( 'gotoDate', date.format('YYYY-MM-DD') );
            });
        });
    }
    function changeSelectBoxMonth(tt){
        var date = tt.calendar.fullCalendar('getDate');
        var month = date.format('M');
        $('.calendar_change_month').val(month);
    }
    $(document).on("click",".ui-tabs-anchor",function() {
        setTimeout(function(){
            $('.calendar-content', '.calendar-wrapper').fullCalendar('today');
        }, 1000);
    });
    var me  = $(".st_single_rental_room");
    if(me.length>0){
        var fancy_arr = me.data('fancy_arr');
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

    $(document).on('click', '#gdate-choose .gdate-choose-item' , function(){
        var data_id = $(this).attr('id');
        switch (data_id){
            case 'gdate_start_item':
                if($('input#field-rental-start').val() == '' || ($('input#field-rental-start').val() != '' && $('input#field-rental-end').val() != '')) {
                    $('input#field-rental-start').val($(this).data('date')).parent().show();
                    $('input#field-rental-end').val('');
                    $('.fc-day-grid-event').removeClass('st-active');
                    $('.fc-day-grid-event').removeClass('current-select');
                    meecell.addClass('st-active');

                    meecell.addClass('current-select');
                    var ij = 0;
                    $('.fc-day-grid-event').each(function(){
                        ij++;
                        if($(this).hasClass('current-select')){
                            return false;
                        }
                    });
                    $('.fc-day-grid-event').each(function(index){
                        if(index<ij-1){
                            if($(this).find('button').hasClass('btn-available')){
                                $(this).find('button').removeClass('btn-available').addClass('btn-disabled-gd');
                                $(this).find('button').attr('disabled', true);
                                $(this).find('.tooltip').remove();
                            }
                        }
                    });
                }else{
                    if($('input#field-rental-end').val() == '' || ($('input#field-rental-start').val() != '' && $('input#field-rental-end').val() != '')){
                        $('input#field-rental-end').val($(this).data('date')).parent().show();
                        meecell.addClass('st-active');
                    }
                }
                break;
            case 'gdate_end_item':
                if($('input#field-rental-start').val() == '' || ($('input#field-rental-start').val() != '' && $('input#field-rental-end').val() != '')) {
                    $('input#field-rental-start').val($(this).data('date')).parent().show();
                    $('input#field-rental-end').val('');
                    $('.fc-day-grid-event').removeClass('st-active');
                    $('.fc-day-grid-event').removeClass('current-select');
                    meecell.addClass('st-active');

                    meecell.addClass('current-select');
                    var ij = 0;
                    $('.fc-day-grid-event').each(function(){
                        ij++;
                        if($(this).hasClass('current-select')){
                            return false;
                        }
                    });
                    $('.fc-day-grid-event').each(function(index){
                        if(index<ij){
                            if($(this).find('button').hasClass('btn-available')){
                                $(this).find('button').removeClass('btn-available').addClass('btn-disabled-gd');
                                $(this).find('button').attr('disabled', true);
                                $(this).find('.tooltip').remove();
                            }
                        }
                    });
                }else{
                    if($('input#field-rental-end').val() == '' || ($('input#field-rental-start').val() != '' && $('input#field-rental-end').val() != '')){
                        $('input#field-rental-end').val($(this).data('date')).parent().show();
                        meecell.addClass('st-active');
                    }
                }
                break;
            case 'gdate_all_item':
                $('.fc-day-grid-event').removeClass('st-active');
                meecell.addClass('st-active');
                $('input#field-rental-start').val($(this).data('start-date')).parent().show();
                $('input#field-rental-end').val($(this).data('end-date')).parent().show();

                $('.fc-day-grid-event').removeClass('current-select');
                $('.fc-day-grid-event').each(function(index){
                    if($(this).find('button').hasClass('btn-disabled-gd')){
                        $(this).find('button').removeClass('btn-disabled-gd').addClass('btn-available');
                        $(this).find('button').removeAttr('disabled');
                    }
                });
                break;
        }
        $.magnificPopup.close();
    });

    $('#clear-gdate-rental').click(function (e) {
        e.preventDefault();
        $('input#field-rental-start').val('');
        $('input#field-rental-end').val('');
        $('.fc-day-grid-event').removeClass('st-active');
        $('.fc-day-grid-event').removeClass('current-select');
        $('.fc-day-grid-event').each(function(index){
            if($(this).find('button').hasClass('btn-disabled-gd')){
                $(this).find('button').removeClass('btn-disabled-gd').addClass('btn-available');
                $(this).find('button').removeAttr('disabled');
            }
        });
    });
});

jQuery(document).ready(function($){

});
