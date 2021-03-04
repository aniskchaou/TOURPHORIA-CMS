jQuery(document).ready(function ($) {
    "use strict";
    /* Select date */
    var flight_to = '';
    $('.input-daterange .amd_depart_date').each(function () {
        var form = $(this).closest('form');
        var p = $(this).parent();
        var me = $(this);
        $(this).datepicker({
            language: st_params.locale,
            autoclose: !0,
            todayHighlight: !0,
            startDate: 'today',
            format: p.data('tp-date-format'),
            weekStart: 1,
        }).on('changeDate', function (e) {
            var m = e.date.getMonth() + 1;
            if ((e.date.getMonth() + 1) < 10) {
                m = '0' + m
            }
            var d = e.date.getDate();
            if (e.date.getDate() < 10) {
                d = '0' + d
            }
            $(this).parent().find('.amd-date-from').val(e.date.getFullYear() + '-' + (m) + '-' + d);
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 0);
            $('.input-daterange .amd_return_date', form).datepicker("remove");
            $('.input-daterange .amd_return_date', form).datepicker({
                language: st_params.locale,
                startDate: '+0d',
                format: p.data('tp-date-format'),
                autoclose: !0,
                todayHighlight: !0,
                weekStart: 1
            });
            $('.input-daterange .amd_return_date', form).datepicker('setDates', new_date);
            $('.input-daterange .amd_return_date', form).datepicker('setStartDate', new_date);
        });
        $('.input-daterange .amd_return_date', form).datepicker({
            language: st_params.locale,
            startDate: '+0d',
            format: p.data('tp-date-format'),
            autoclose: !0,
            todayHighlight: !0,
            weekStart: 1
        }).on('changeDate', function (e) {
            var m = e.date.getMonth() + 1;
            if ((e.date.getMonth() + 1) < 10) {
                m = '0' + m
            }
            var d = e.date.getDate();
            if (e.date.getDate() < 10) {
                d = '0' + d
            }
            flight_to = e.date.getFullYear() + '-' + (m) + '-' + d;
            $(this).parent().find('.amd-date-to').val(flight_to);
            var del_html = '<i class="fa fa-times tp-icon-return-del"></i>';
            if($('.input-daterange-return .tp-icon-return-del').length)
                $('.input-daterange-return .tp-icon-return-del').remove();
            $('.input-daterange-return').append(del_html);
        })
    });
    $(document).on('click', '.tp-icon-return-del', function () {
        $('.input-daterange .amd_return_date').val('');
        $('input.amd-date-to').val('');
        $(this).remove();
    });
    /* End select date */
    $('.amd-form-passengers .amd_group_display').click(function () {
        $(this).parent().find('.amd-form-passengers-class').toggleClass('none');
        $(this).find('.fa').toggleClass('fa-chevron-up');
        $(this).find('.fa').toggleClass('fa-chevron-down')
    });

    $(document).on('keyup mouseup', '.amd-passengers-class input[name=adults]', function () {
        var sparent = $(this).closest('.amd-passengers-class');
        if ($(this).val() == '') {
            //$(this).val(1)
        } else {
            var infants = $('input[name=infants]', sparent).val();
            if(infants == '')
                infants = 0;
            var children = $('input[name=children]', sparent).val();
            if(children == '')
                children = 0;
            var total = parseInt(infants) + parseInt(children) + parseInt($(this).val());
            if (total > 9) {
                var adults = 9 - (parseInt(infants) + parseInt(children));
                $(this).val(adults);
                $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxup')).fadeIn();
            } else {
                $('.amd_group_display .quantity-passengers').text(total);
                $('.amd-form-passengers-class .notice').html('').fadeOut();
            }
        }
    });
    $(document).on('keyup mouseup', '.amd-passengers-class input[name=children]', function () {
        var sparent = $(this).closest('.amd-passengers-class');
        if ($(this).val() == '') {
            //$(this).val(0)
        } else {
            var infants = $('input[name=infants]', sparent).val();
            if(infants == '')
                infants = 0;
            var adults = $('input[name=adults]', sparent).val();
            if(adults == '')
                adults = 0;
            var total = parseInt(infants) + parseInt(adults) + parseInt($(this).val());
            if (total > 9) {
                var children = 9 - (parseInt(infants) + parseInt(adults));
                $(this).val(children);
                $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxup')).fadeIn();
            } else {
                $('.amd_group_display .quantity-passengers').text(total);
                $('.amd-form-passengers-class .notice').html('').fadeOut()
            }
        }
    });
    $(document).on('keyup mouseup', '.amd-passengers-class input[name=infants]', function () {
        var sparent = $(this).closest('.amd-passengers-class');
        if ($(this).val() == '') {
            //$(this).val(0)
        } else {
            var adults = $('input[name=adults]', sparent).val();
            if(adults == '')
                adults = 0;
            var children = $('input[name=children]', sparent).val();
            if(children == '')
                children = 0;
            var total = parseInt(adults) + parseInt(children) + parseInt($(this).val());
            if (total > 9) {
                var infants = 9 - (parseInt(children) + parseInt(adults));
                $(this).val(infants);
                $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxup')).fadeIn();
            } else {
                if(parseInt($(this).val()) > adults){
                    $(this).val(adults);
                    $('.amd-form-passengers-class .notice').html($('.amd-form-passengers-class .notice').data('maxinf')).fadeIn();
                }else{
                    $('.amd_group_display .quantity-passengers').text(total);
                    $('.amd-form-passengers-class .notice').html('').fadeOut()
                }
            }
        }
    });
    $(document).on('focusout', '.amd-passengers-class input[name=adults]', function () {
        if ($(this).val() == '' || $(this).val() == 0) {
            $(this).val(1)
        }
    });
    $(document).on('focusout', '.amd-passengers-class input[name=children], .amd-passengers-class input[name=infants]', function () {
        if ($(this).val() == '') {
            $(this).val(0)
        }
    });

    /*var sparent = $('.amd-passengers-class');
    var adults = $('input[name=adults]', sparent).val();
    var children = $('input[name=children]', sparent).val();
    var infants = $('input[name=infants]', sparent).val();
    var total = parseInt(adults) + parseInt(children) + parseInt(infants);
    $('.amd_group_display .quantity-passengers').text(total);*/

    var last_select_clicked = !1;
    $('.amd-flight-location').each(function () {
        var t = $(this);
        var parent = t.closest('.amd-flight-wrapper');
        $(this).keyup(function (event) {
            last_select_clicked = t;
            parent.find('.st-location-id').remove();
            var name = t.attr('data-name');
            var locale = t.attr('data-locale');
            var val = t.val();
            if (val.length >= 2) {
                $.getJSON("https://api.sandbox.amadeus.com/v1.2/airports/autocomplete?apikey="+st_amadeus.apikey+"&term=" + val, function (data) {
                    if (typeof data == 'object') {
                        var html = '';
                        html += '<select name="' + name + '" class="st-location-id st-hidden" tabindex="-1">';
                        $.each(data, function (key, value) {
                            var f_name = '';
                            if (value.label != null) {
                                f_name = value.label;
                            }
                            html += '<option value="' + value.value + '">' + f_name + '</option>';
                        });
                        html += '</select>';
                        parent.find('.st-location-id').remove();
                        parent.append(html);
                        html = '';
                        $('select option', parent).prop('selected', !1);
                        $('select option', parent).each(function (index, el) {
                            var text = $(this).text();
                            var highlight = get_highlight(text, val);
                            if (highlight.indexOf('</span>') >= 0) {
                                html += '<div data-text="' + text + '" data-value="' + $(this).val() + '" class="option">' + '<span class="label"><a href="#">' + text + ' <i class="fa fa-plane"></i></a>' + '</div>'
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper'), t)
                    }
                });
            }
        });
        t.caculatePosition = function () {
            if (!last_select_clicked || !last_select_clicked.length) return;
            var wraper = $('.option-wrapper');
            var input_tag = last_select_clicked;
            var offset = parent.offset();
            var top = offset.top + parent.height();
            var left = offset.left;
            var width = input_tag.outerWidth();
            var wpadminbar = 0;
            if ($('#wpadminbar').length && $(window).width() >= 783) {
                wpadminbar = $('#wpadminbar').height()
            } else {
                wpadminbar = 0
            }
            top = top - wpadminbar;
            var z_index = 99999;
            var position = 'absolute';
            if ($('#search-dialog').length) {
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999
            }
            wraper.css({position: position, top: top, left: left, width: width, 'z-index': z_index})
        };
        $(window).resize(function () {
            t.caculatePosition()
        })
    });

    function get_highlight(text, val) {
        var highlight = text.replace(new RegExp(val + '(?!([^<]+)?>)', 'gi'), '<span class="highlight">$&</span>');
        return highlight
    }

    jQuery(function ($) {
        $(document).ready(function () {
            $(document).on('click', '#tab-amadeus_aff_flight13 .btn-amd-search-flight', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var required = !1;
                $('input', form).each(function () {
                    if($(this).prop('required')){
                        if ($(this).val() == '') {
                            required = !0;
                            $(this).addClass('error')
                        } else {
                            $(this).removeClass('error')
                        }
                    }
                });

                if($('.amd-passengers-class input[name="adults"]').val() == 0 && $('.amd-passengers-class input[name="children"]').val() == 0 && $('.amd-passengers-class input[name="infants"]').val() == 0){
                    required = !0;
                    $('.amd_group_display').addClass('error')
                }else{
                    $('.amd_group_display').removeClass('error')
                }
                if(!required)
                    form.submit();
            });
        });
    });
});