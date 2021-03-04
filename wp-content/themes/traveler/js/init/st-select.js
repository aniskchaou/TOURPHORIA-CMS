jQuery(document).ready(function($) {
    var last_select_clicked=false;
    $('body').append('<div class="option-wrapper st-option-wrapper"></div>');
    var t_temp;
    $('.st-location-name').each(function(index, el) {
        var form = $(this).parents('form');
        var parent = $(this).parents('.st-select-wrapper');
        var t = $(this);
        var flag = true;
        $('.option-wrapper',parent).remove();
        t.keyup(function(event) {
            t_temp = t;
            last_select_clicked=t;
            if (event.which != 40 && event.which != 38 && event.which != 9) {
                val = $(this).val();
                if (event.which != 13) {

                    flag = false;
                    if( val != '' ){
                        html = '';
                        $('select option', parent).prop('selected', false);
                        $('select option', parent).each(function(index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            var highlight = get_highlight(text, val);
                            if (highlight.indexOf('</span>') > 0) {
                                var current_country = $(this).parent('select').attr('data-current-country');
                                if (typeof current_country != 'undefined' && current_country != '') {
                                    if (country == current_country) {
                                        html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                            '</div>';
                                    }
                                } else {
                                    html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                        '</div>';
                                }
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper'),t);
                    }else{
                        html = '';
                        $('select option', parent).prop('selected', false);

                        $('select option', parent).each(function(index, el) {
                            var country = $(this).data('country');
                            var text = $(this).text();
                            var text_split = text.split("||");
                            text_split = text_split[0];
                            if (text != '') {
                                var current_country = $(this).parent('select').attr('data-current-country');
                                if (typeof current_country != 'undefined' && current_country != '') {
                                    if (country == current_country) {
                                        html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                            '</div>';
                                    }
                                } else {
                                    html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                        '</div>';
                                }
                            }
                        });
                        $('.option-wrapper').html(html).show();
                        t.caculatePosition($('.option-wrapper', parent),t);
                    }
                }

                if (event.which == 13){
                    //$('.option-wrapper .option').trigger('click');
                    //console.log('Event2');
                    //return false;
                    /*html = '';
                    $('select option', parent).prop('selected', false);

                    $('select option', parent).each(function(index, el) {
                        var country = $(this).data('country');
                        var text = $(this).text();
                        var text_split = text.split("||");
                        text_split = text_split[0];
                        if (text != '') {
                            var current_country = $(this).parent('select').attr('data-current-country');
                            if (typeof current_country != 'undefined' && current_country != '') {
                                if (country == current_country) {
                                    html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                        '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                        '</div>';
                                }
                            } else {
                                html += '<div data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option">' +
                                    '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                    '</div>';
                            }
                        }
                    });
                    $('.option-wrapper').html(html).show();
                    t.caculatePosition($('.option-wrapper'),t);*/
                }
                if (event.which == 13 && val != ""){

                }
                if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                    name = t.data('children');
                    $('select[name="' + name + '"]', form).attr('data-current-country', '');
                    $('input[name="drop-off"]', form).val('');
                    $('select[name="' + name + '"] option', form).prop('selected', false);
                }
            }
        });

        var liSelected;
        t.keydown(function(event) {
            last_select_clicked=t;
            if (event.which == 13) {
                /*var text = t.val();
                var val = $('div.option-wrapper .option.active').data('value');
                var country = $('div.option-wrapper .option.active').data('country');
                if( typeof text != 'undefined' && typeof val != 'undefined' ){
                    t.val(text);
                    $('select option[value="' + val + '"]').prop('selected', true);

                    $('.option-wrapper').html('').hide();

                    if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                        name = t.data('children');
                        $('select[name="' + name + '"]', form).attr('data-current-country', country);
                    }
                }*/
                var form = last_select_clicked.closest('form');
                $('.option-wrapper').html('').hide();
                t.focusNextInputField();

                return false;
            }

            if (event.which == 9) {
                var form = last_select_clicked.closest('form');
                $('.option-wrapper').html('').hide();
                //t.focusNextInputField();
                return false;
            }

            if (event.which == 40 || event.which == 38 || event.which == 9) {
                if(event.which === 40){
                    var index = $('.option-wrapper .option.active').index();
                    if(liSelected){
                        liSelected.removeClass('active');
                        next = liSelected.next();
                        if(next.length > 0){
                            liSelected = next.addClass('active');
                        }else{
                            if($('.option-wrapper .option.active').length > 0){
                                $('.st-option-wrapper .option').eq(index).removeClass('active');
                                if(($('.option-wrapper .option').length - 1) == index){
                                    liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                                }else{
                                    liSelected = $('.st-option-wrapper .option').eq(index + 1).addClass('active');
                                }
                            }else{
                                liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                            }
                        }
                    }else{
                        liSelected = $('.st-option-wrapper .option').eq(0).addClass('active');
                    }
                }else if(event.which === 38){
                    var index = $('.option-wrapper .option.active').index();
                    if(liSelected){
                        liSelected.removeClass('active');
                        next = liSelected.prev();
                        if(next.length > 0){
                            liSelected = next.addClass('active');
                        }else{
                            if($('.option-wrapper .option.active').length > 0) {
                                $('.st-option-wrapper .option').eq(index).removeClass('active');
                                liSelected = $('.st-option-wrapper .option').eq(index-1).addClass('active');
                            }else{
                                liSelected = $('.st-option-wrapper .option').last().addClass('active');
                            }
                        }
                    }else{
                        liSelected = $('.st-option-wrapper .option').last().addClass('active');
                    }
                }

                $('.option-wrapper').scrollTo($('.option-wrapper .option.active'), 400);

                event.preventDefault();
                flag = true;

                var value = $('.option-wrapper .option.active').data('value');
                var text = $('.option-wrapper .option.active').text();

                var country = $('.option-wrapper .option.active').data('country');
                t.val(text);
                $('select option[value="' + value + '"]', parent).prop('selected', true);


                if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                    name = t.data('children');
                    $('select[name="' + name + '"]', form).attr('data-current-country', country);
                }
            }

        });
        t.blur(function(event) {
            if (t.data('clear') == 'clear' && $('select option:selected', parent).val() == "") {
                t.val('');
            }
        });
        t.on("focus",function(event) {
        	if(t.data('id') != 'location_origin' && t.data('id') != 'location_destination'){
                last_select_clicked=t;
			}
            //last_select_clicked=t;
            //if (t.val() == '') {
            html = '';
            $('select option', parent).prop('selected', false);

            $('select option', parent).each(function(index, el) {
                var country = $(this).data('country');
                var text = $(this).text();
                var text_split = text.split("||");
                text_split = text_split[0];

                var activeOption = '';

                if (text != '') {
                    var current_country = $(this).parent('select').attr('data-current-country');
                    if (typeof current_country != 'undefined' && current_country != '') {
                        if (country == current_country) {
                            html += '<div style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option '+ activeOption +'">' +
                                '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                                '</div>';
                        }
                    } else {
                        html += '<div  style="'+ $(this).data('style') +'" data-text="' + text + '" data-country="' + country + '" data-value="' + $(this).val() + '" class="option '+ activeOption +'">' +
                            '<span class="label"><a href="#">' + text_split + '<i class="fa fa-map-marker"></i></a>' +
                            '</div>';
                    }
                }
            });

            if (typeof t.data('parent') != 'undefined' && t.data('parent') != "") {
                name = t.data('parent');

                if ($('select[name="' + name + '"]', form).length) {
                    var val = $('select[name="' + name + '"]', form).parent().find('input.st-location-name').val();
                    if (typeof val == 'undefined' || val == '') {
                        t.val('');
                        $('select[name="' + name + '"]', form).parent().find('input.st-location-name').focus();
                    }else{
                        $('.option-wrapper').html(html).show();
                    }
                }
            }else{
                $('.option-wrapper').html(html).show();
            }
            //}

            t.caculatePosition();
        });
        $(document).on('click', '.option-wrapper .option', function(event) {
            if(last_select_clicked.length > 0) {
                var form = last_select_clicked.closest('form');
                var parent = last_select_clicked.closest('.st-select-wrapper');
                setTimeout(function () {
                    if (typeof form.find('input[name="start"]').attr('value') != 'undefined') {
                        var $tmp = form.find('input[name="start"]').attr('value');
                        if ($tmp.length <= 0) {
                            form.find('input[name="start"]').datepicker('show');
                        }
                    }
                }, 100);
                event.preventDefault();
                flag = true;

                var value = $(this).data('value');
                var text = $(this).text();
                var country = $(this).data('country');
                if (text != "") {

                    last_select_clicked.val(text);

                    $('select option[value="' + value + '"]', parent).prop('selected', true);

                    $('.option-wrapper').html('').hide();

                    if (typeof t.data('children') != 'undefined' && t.data('children') != "") {
                        name = t.data('children');
                        $('select[name="' + name + '"]', form).attr('data-current-country', country);
                    }
                }
            }

            last_select_clicked.focusNextInputField();

        });
        $(document).click(function(event) {
            if (!$(event.target).is('.st-location-name')) {
                $('.option-wrapper').html('').hide();
            }
        });
        t.caculatePosition=function(){
            if(!last_select_clicked || !last_select_clicked.length) return;
            var wraper= $('.option-wrapper');
            var input_tag= last_select_clicked;
            var offset=parent.offset();
            var top=offset.top+parent.height();
            var left=offset.left;
            var width=input_tag.outerWidth();
            var wpadminbar = 0;
            if( $('#wpadminbar').length && $(window).width() >= 783 ){
                wpadminbar = $('#wpadminbar').height();
            }else{
                wpadminbar = 0
            }
            if($('body').hasClass('boxed')){
                left = left  - $('body').offset().left;
            }

            top = top - wpadminbar;

            var z_index = 99999;
            var position = 'absolute';

            if( $('#search-dialog').length ){
                position = 'fixed';
                top = top + wpadminbar - $(window).scrollTop();
                z_index = 99999;
            }


            wraper.css({
                position:position,
                top:top,
                left:left,
                width:width,
                'z-index': z_index
            });
        };

        $( window ).resize(function() {
            t.caculatePosition();
        });
        form.submit(function(event) {

            if (t.val() == "" && t.hasClass('required')) {
                t.focus();
                return false;
            } else {
                if ($('input.required-field').length && $('input.required-field').prop('checked') == true) {
                    var val = $('select[name="location_id_pick_up"] option:selected', form).val();
                    var text = $('input[name="pick-up"]', form).val();
                    $('select[name="location_id_drop_off"] option[value="' + val + '"]', form).prop('selected', true);
                    $('input[name="drop-off"]', form).val(text);
                }
                if ($('input.required-field').length && $('input.required-field').prop('checked') == false && $('input[name="drop-off"]', form).val() == "") {
                    $('input[name="drop-off"]', form).focus();
                    $('select[name="location_id_drop_off"] option', form).prop('selected', false);
                    return false;
                }
            }
        });
    });

    function get_highlight(text, val) {
        var highlight = text.replace(
            new RegExp(val + '(?!([^<]+)?>)', 'gi'),
            '<span class="highlight">$&</span>'
        );
        return highlight;
    }

    $.fn.focusNextInputField = function() {
        return this.each(function() {
            var fields = $(this).parents('form:eq(0),body').find('button:visible,input:visible,textarea:visible,select:visible');
            var index = fields.index( this );
            if ( index > -1 && ( index + 1 ) < fields.length ) {
                fields.eq( index + 1 ).focus();
            }
            return false;
        });
    };

});


