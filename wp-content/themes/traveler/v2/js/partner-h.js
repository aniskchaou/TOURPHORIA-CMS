jQuery(function($) {
    $(document).ready(function () {
        $('body').on('click', '.st-upload', function(e){
            var t = $(this);
            var frame;
            var multi = t.data('multi');
            var output = t.data('output');
            e.preventDefault();

            var galleryBox = t.parent().find('.st-selection');

            if (frame) {
                frame.open();
                return;
            }
            // Create a new media frame
            frame = wp.media({
                title: 'Select image',
                button: {
                    text: 'Use this media'
                },
                multiple: multi  // Set to true to allow multiple files to be selected
            });

            frame.on('select', function () {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').toJSON();
                var ids = [];
                if(multi === true) {
                    galleryBox.find('.del').each(function () {
                        if(output === 'url'){
                            ids.push($(this).data('url'));
                        }else{
                            ids.push($(this).data('id'));
                        }

                    });
                    if (attachment.length > 0) {
                        for (var i = 0; i < attachment.length; i++) {
                            if (!ids.includes(attachment[i].id)) {
                                galleryBox.append('<div class="item" style="background-image: url(' + attachment[i].url + ')"><div class="del" data-id="' + attachment[i].id + '" data-url="'+ attachment[i].url +'" data-output="'+ output +'"></div></div>');
                                if(output === 'url') {
                                    ids.push(attachment[i].url);
                                }else{
                                    ids.push(attachment[i].id);
                                }
                            }
                        }
                    }
                }else{
                    galleryBox.find('.item').remove();
                    if (attachment.length > 0) {
                        for (var i = 0; i < attachment.length; i++) {
                            if (!ids.includes(attachment[i].id)) {
                                galleryBox.append('<div class="item" style="background-image: url(' + attachment[i].url + ')"><div class="del" data-id="' + attachment[i].id + '" data-url="'+ attachment[i].url +'" data-output="'+ output +'"></div></div>');
                                if(output === 'url') {
                                    ids.push(attachment[i].url);
                                }else{
                                    ids.push(attachment[i].id);
                                }
                            }
                        }
                    }
                }
                t.find('input').val(ids.toString());
            });

            frame.open();
        })

        $('body').on('click', '.st-field-upload .st-selection .item .del', function (e) {
            var cfirm = confirm('Are you sure want to delete this item?');
            if(cfirm) {
                var t = $(this);
                var output = t.data('output');
                var parent = t.parent().parent().parent();
                t.closest('.item').remove();
                var ids = [];
                parent.find('.st-selection .item .del').each(function () {
                    if (output === 'url') {
                        ids.push($(this).data('url'));
                    } else {
                        ids.push($(this).data('id'));
                    }
                });
                parent.find('.st-upload input').val(ids.toString());
            }
        });

        $('body').on('focus',".partner-date", function(){
            var t = $(this);
            t.datepicker({
                format: t.data('format'),
                autoclose: true,
                startDate: '0days'
            });
        });


        $('.st-field-list-item').each(function () {
            var t = $(this);

            t.find('.add-item').click(function(){
                var cl = t.find('.item.origin').clone();
                cl.removeClass('origin').addClass('active');
                //cl.find('input').val('');
                //cl.find('textarea').val('');
                $(cl).insertBefore($(this));
            });
        });

        $(document).on('click', '.st-field-list-item .item .listitem-title', function () {
            $(this).closest('.item').toggleClass('active');
        });

        $(document).on('click', '.st-field-list-item .item .del', function () {
            var cfirm = confirm('Are you sure want to delete this item?');
            if(cfirm){
                $(this).closest('.item').remove();
            }
        })



        $('.st-partner-field').each(function(){
            var cond = $(this).data('condition');
            var oper = $(this).data('operator');
            if(typeof cond !== 'undefined' && cond !== ''){
                var t = $(this);
                var cond_arr = cond.split(',');
                var checkHide = false;
                var checkHideChange = false;
                var arrChange = [];
                var keyChange = '';

                cond_arr.forEach(function (item, index) {
                    var sub_arr = item.split(':'),
                        key = keyChange = sub_arr[0],
                        val = sub_arr[1].replace('is(', '').replace(')', '');

                    if($('.st-partner-field[name="'+ key +'"]').val() === val){
                        checkHide = true;
                    }

                    arrChange.push(val);
                });

                $('.st-partner-field[name="'+ keyChange +'"]').change(function () {

                    var valChange = $(this).val();
                    if(arrChange.includes(valChange)){
                        checkHideChange = true;
                    }else{
                        checkHideChange = false;
                    }
                    if(checkHideChange){
                        t.closest('.st-partner-field-item').fadeIn();
                    }else{
                        t.closest('.st-partner-field-item').fadeOut();
                    }

                });

                if(!checkHide){
                    t.closest('.st-partner-field-item').hide();
                }else{
                    t.closest('.st-partner-field-item').show();
                }
            }

        });

        $('.st-field-timepicker').each(function () {
           $(this).find('input').timepicker();
        });

        $(document).on('click', '.st-btn-back', function(e){
            e.preventDefault();
            var currentTab =  $('.st-create-service-content .nav-tabs li.active').index() - 1;
            if(currentTab >=0) {
                $('.st-create-service-content .nav-tabs li').removeClass('active').eq(currentTab).addClass('active');
                $('.st-create-service-content .tab-content .tab-pane').removeClass('active').eq(currentTab).addClass('active');
                if(currentTab === 0)
                    $(this).hide();
                if((currentTab + 1) === $('.st-create-service-content .nav-tabs li').length){
                    if($('.st-btn-continue').data('status') === 'new'){
                        $('.st-btn-continue').find('span').text(dashboard_params.complete_registration_text);
                    }else{
                        $('.st-btn-continue').find('span').text(dashboard_params.complete_text);
                    }
                }else{
                    $('.st-btn-continue').find('span').text(dashboard_params.continue_text);
                }
            }
        });

        //Step submit form
        $('.st-btn-continue, .st-create-service-content .nav-tabs li').click(function (e) {
            e.preventDefault();
            var clickTab = $(this).index();

            var currentTab = $(this).closest('.nav-tabs').find('li.active').index();

            var obj = $(this).data('obj');
            if(obj === 'button'){
                currentTab =  $('.st-create-service-content .nav-tabs li.active').index();
                clickTab = $('.st-create-service-content .nav-tabs li.active').index() + 1;
            }

            if(clickTab > currentTab) {
                e.stopPropagation();

                if(clickTab - currentTab !== 1)
                    return;

                $('.tab-content, .st-partner-action').addClass('loading');

                var data = $('.st-create-service-content .tab-content .tab-pane.active .st-partner-create-form').serializeArray();

                var currentForm = $('.st-create-service-content .tab-content .tab-pane.active .st-partner-create-form');

                data.push({
                    name: '_s',
                    value: st_params._s
                });


                for (var i = 0; i < Object.keys(data).length; i++){
                    if(data[i]['name'] === 'st_content'){
                        data[i]['value'] =  get_tinymce_content('st_content');
                        break;
                    }
                }


                $.ajax({
                    'type': 'post',
                    'dataType': 'json',
                    'url': st_params.ajax_url,
                    'data': data,
                    success: function (data) {
                        if (!data.status) {
                            $('.st-create-service-content .nav-tabs li.active').removeClass('success');
                            $('.st-partner-field-item').removeClass('error');
                            $('.st-partner-field-item').find('.st_field_msg').html('');
                            $.each(data.err, function (key, value) {
                                currentForm.find('.st-partner-field[name="' + key + '"]').closest('.st-partner-field-item').addClass('error');
                                currentForm.find('.st-partner-field[name="' + key + '"]').closest('.st-partner-field-item').find('.st_field_msg').html('<div class="alert alert-danger">' + value + '</div>');
                            });
                            window.scroll({
                                top: currentForm.find('.st-partner-field-item.error').first().offset().top - 50,
                                left: 0,
                                behavior: 'smooth'
                            });
                        } else {
                            if(data.next_step != 'final') {
                                $('.st-partner-field-item').removeClass('error');
                                $('.st-partner-field-item').find('.st_field_msg').html('');
                                window.location.hash = '#post_id=' + data.post_id + '&step=' + data.next_step;
                                $('.st-partner-input-post-id').val(data.post_id);

                                //Next Tab
                                $('.st-create-service-content .nav-tabs li.active').addClass('success');
                                $('.st-create-service-content .nav-tabs li').removeClass('active').eq((data.next_step - 1)).addClass('active');
                                $('.st-create-service-content .tab-content .tab-pane').removeClass('active').eq((data.next_step - 1)).addClass('active');


                                var totalTabs = $('.st-create-service-content .nav-tabs li').length;
                                if (data.next_step > 1) {
                                    $('.st-btn-back').show();
                                } else {
                                    $('.st-btn-back').hide();
                                }

                                if (data.next_step == totalTabs) {
                                    if($('.st-btn-continue').data('status') === 'new'){
                                        $('.st-btn-continue').find('span').text(dashboard_params.complete_registration_text);
                                    }else{
                                        $('.st-btn-continue').find('span').text(dashboard_params.complete_text);
                                    }
                                    $('.st-btn-back').show();
                                } else {
                                    $('.st-btn-continue').find('span').text(dashboard_params.continue_text);
                                    $('.st-btn-back').show();
                                }

                                window.scroll({
                                    top: $('.st-create-service-content .nav-tabs').first().offset().top - 50,
                                    left: 0,
                                    behavior: 'smooth'
                                });

                                if(data.next_step_name === 'policy'){
                                    if($('.st-inventory').length) {
                                        var body = $('body');
                                        var inventory = $('.st-inventory', body).wpInventory();
                                        var inventory_data = inventory.data('Inventory');
                                        var start = moment().format();
                                        var end = moment().add(30, 'days').format();
                                        var data = {
                                            'action': 'st_fetch_inventory',
                                            'start': moment(start).format("YYYY-MM-DD"),
                                            'end': moment(end).format("YYYY-MM-DD"),
                                            'post_id': $('.st-inventory', body).data('id')
                                        };
                                        inventory_data.render(start, end, ajaxurl, data);
                                    }
                                }
                                if(typeof data.sc !== 'undefined') {
                                    checkAvailabilityFields(data.sc);
                                    setTimeout(function () {
                                        $('.calendar-content', '.calendar-wrapper').fullCalendar('today');
                                        //$('.calendar-content', '.calendar-wrapper').fullCalendar('refetchEvents');
                                        //self.calendar.fullCalendar('refetchEvents')
                                    }, 1000)
                                }
                            }else{
                                window.location.href = data.linkEdit;
                            }
                        }
                    },
                    complete: function (xhr, status) {
                        $('.tab-content, .st-partner-action').removeClass('loading');
                    },
                    error: function (data) {

                    }
                })
            }else if(clickTab == ($('.st-create-service-content .nav-tabs li').length - 1)){
                if($('.st-btn-continue').data('status') === 'new'){
                    $('.st-btn-continue').find('span').text(dashboard_params.complete_registration_text);
                }else{
                    $('.st-btn-continue').find('span').text(dashboard_params.complete_text);
                }

                $('.st-btn-back').show();
            }else{
                $('.st-btn-continue').find('span').text(dashboard_params.continue_text);
                if(clickTab == 0) {
                    $('.st-btn-back').hide();
                }else{
                    $('.st-btn-back').show();
                }
            }
        });

        //Check availability form tour

        function checkAvailabilityFields(posttype){
            switch (posttype) {
                case 'edit-tours':
                    var currentPriceType = $('.st-partner-create-form #st-field-tour_price_by').val();
                    var tourType = $('.st-partner-create-form #st-field-tour_type').val();
                    if(tourType === 'specific_date'){
                        $('#calendar_groupday').closest('.col-xs-6').show();
                    }else{
                        $('#calendar_groupday').closest('.col-xs-6').hide();
                    }
                    if(currentPriceType === 'fixed'){
                        $('.tour-calendar-price-person').hide();
                        $('.tour-calendar-price-fixed').show();
                    }else{
                        $('.tour-calendar-price-person').show();
                        $('.tour-calendar-price-fixed').hide();
                    }
                    if(currentPriceType === 'person' || currentPriceType === 'fixed_depart'){
                        $('#calendar_price_type', '.calendar-form').val('person');
                    }else{
                        $('#calendar_price_type', '.calendar-form').val('fixed');
                    }
                    break;
                case 'edit-activity':
                    var activityType = $('.st-partner-create-form #st-field-type_activity').val();
                    if(activityType === 'specific_date'){
                        $('#calendar_groupday').closest('.col-xs-6').show();
                    }else{
                        $('#calendar_groupday').closest('.col-xs-6').hide();
                    }
                    break;
            }
        }

        /*$('.st-field-multi_location input.st-partner-field').click(function () {
           $(this).closest('.st-field-multi_location').find('.dropdown').slideToggle();
        });*/

        if ($('.st-field-multi_location').length) {
            $('.st-field-multi_location').each(function (index, el) {
                var parent = $(this);
                var input = $('input.st-partner-field', parent);
                var list = $('.dropdown', parent);
                var timeout;
                input.keyup(function (event) {
                    clearTimeout(timeout);
                    var t = $(this);
                    timeout = setTimeout(function () {
                        var text = t.val().toLowerCase();
                        if (text == '') {
                            $('.item', list).show()
                        } else {
                            $('.item', list).hide();
                            $(".item", list).each(function () {
                                var name = $(this).data("name").toLowerCase();
                                var reg = new RegExp(text, "g");
                                if (reg.test(name)) {
                                    $(this).show()
                                }
                            })
                        }
                    }, 100)
                })
            })
        }

        //Auto complete address with map
        $('.i-check, .i-radio').iCheck({
            checkboxClass: 'i-check',
            radioClass: 'i-radio'
        });

        function get_tinymce_content(id) {
            var content;
            var inputid = id;
            var editor = tinyMCE.get(inputid);
            var textArea = jQuery('textarea#' + inputid);
            if (textArea.length>0 && textArea.is(':visible')) {
                content = textArea.val();
            } else {
                content = editor.getContent();
            }
            return content;
        }

    })
});