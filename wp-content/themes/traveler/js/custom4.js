jQuery(document).ready(function ($) {
    if($('.single-room-form').length > 0) {
        var ci = 0;
        $('#field-hotelroom-room, .extra-service-select, #field-hotelroom-checkout, #field-hotelroom-checkin').on('change', function (e) {
            if (ci == 0) {
                changeServiceSelect();
            }
            ci++;
        });
        var flag = false;
        if ($('#field-hotelroom-room').val() != '1' && $('#field-hotelroom-room').length > 0) {
            flag = true;
        }
        if ($('.extra-price').length > 0) {
            $('.extra-price .extra-service-select').each(function () {
                if ($(this).val() != '0') {
                    flag = true;
                }
            });
        }
        if (flag) {
            changeServiceSelect();
        }

        function changeServiceSelect() {
            var basePrice = $('#st-base-price').data('base-price');
            var originPrice = 0;
            if ($('#st-origin-price').length > 0) {
                originPrice = $('#st-origin-price').data('origin-price');
            }
            var roomNumber = $('#field-hotelroom-room').val();
            var roomCheckIn = $('#field-hotelroom-checkin').val();
            var roomCheckOut = $('#field-hotelroom-checkout').val();

            var totalExtraPrice = 0;
            if ($('.extra-price').length > 0) {
                $('.extra-price .extra-service-select').each(function () {
                    var totalItem;
                    var numberItem = $(this).val();
                    var priceItem = $(this).data('extra-price');
                    totalItem = Number(getNumber(priceItem.toString())) * Number(numberItem);
                    totalExtraPrice = totalExtraPrice + totalItem;
                });
            }
            renderHtml(basePrice, originPrice, roomNumber, totalExtraPrice, roomCheckIn, roomCheckOut);
        }

        function renderHtml(basePrice, originPrice, roomNumber, totalExtraPrice, checkIn, checkOut) {
            /* var total = Number(getNumber(basePrice.toString())) * Number(roomNumber) + (totalExtraPrice * Number(roomNumber));
            var totalOrigin = Number(getNumber(originPrice.toString())) * Number(roomNumber) + (totalExtraPrice * Number(roomNumber));
            if ($('#st-base-price').length > 0) {
                $('#st-base-price').html(format_money(total * nightNumber));
                $('#st-base-price').html(format_money(disCountTotalByPackage(total, nightNumber, renderDiscountPackage())));
                console.log('No D: ' + total * nightNumber);
            }
            if ($('#st-origin-price').length > 0) {
                 $('#st-origin-price').html(format_money(totalOrigin * nightNumber));
                $('#st-origin-price').html(format_money(disCountTotalByPackage(totalOrigin, nightNumber, renderDiscountPackage())));
                console.log('No DO: ' + totalOrigin * nightNumber);
            }
            disCountTotalByPackage(total, nightNumber, renderDiscountPackage()); */

            $('.message_box').html('');

            var overlay = $('#hotel-room-box .overlay-form');

            $.ajax({
                method: "POST",
                url: st_params.ajax_url,
                data: {
                    base_price: basePrice,
                    origin_price: originPrice,
                    post_id: $('#field-hotelroom-checkin').data('post-id'),
                    number_room: roomNumber,
                    check_in: checkIn,
                    check_out: checkOut,
                    total_extra: totalExtraPrice,
                    action: 'st_format_real_price'
                },
                beforeSend: function () {
                    overlay.show();
                },
                success: function (response) {
                    if (response.status == true) {
                        if ($('#st-base-price').length > 0) {
                            $('#st-base-price').html(response.sale);
                        }
                        if ($('#st-origin-price').length > 0) {
                            $('#st-origin-price').html(response.origin);
                        }
                        if ($('#st-number-day').length > 0) {
                            $('#st-number-day').html(response.numberday);
                        }
                        $('.message_box').html('');
                        ci = 0;
                        overlay.hide();
                    } else {
                        if (response.message != '') {
                            $('.message_box').html('<div class="alert alert-danger">' + response.message + '</div>');
                            ci = 0;
                            overlay.hide();
                            return false;
                        }
                    }
                }
            });
        }
    }

    function getNumber(str) {
        return str.replace(/([^\d|^\.])*/g, '');
    }

    function format_money($money) {

        if (!$money) {
            return st_params.free_text;
        }
        //if (typeof st_params.booking_currency_precision && st_params.booking_currency_precision) {
        //    $money = Math.round($money).toFixed(st_params.booking_currency_precision);
        //}

        $money = st_number_format($money, st_params.booking_currency_precision, st_params.decimal_separator, st_params.thousand_separator);
        var $symbol = st_params.currency_symbol;
        var $money_string = '';

        switch (st_params.currency_position) {
            case "right":
                $money_string = $money + $symbol;
                break;
            case "left_space":
                $money_string = $symbol + " " + $money;
                break;

            case "right_space":
                $money_string = $money + " " + $symbol;
                break;
            case "left":
            default:
                $money_string = $symbol + $money;
                break;
        }

        return $money_string;
    }

    function st_number_format(number, decimals, dec_point, thousands_sep) {


        number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
                .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    }

    function getNightRoom(start, end){
        var dateNumber = daydiff(parseDate(formatD(start)), parseDate(formatD(end)));

        if(dateNumber <= 0){
            dateNumber = 1;
        }

        return dateNumber;
    }

    function parseDate(str) {
        var mdy = str.split('/');
        return new Date(mdy[2], mdy[0]-1, mdy[1]);
    }

    function daydiff(first, second) {
        return Math.round((second-first)/(1000*60*60*24));
    }

    function formatD(inputDate) {
        var d = new Date(inputDate.split("/").reverse().join("-"));
        var dd = d.getDate();
        var mm = d.getMonth()+1;
        var yy = d.getFullYear();
        var newdate = mm + "/" + dd + "/" + yy;
        return newdate;
    }

    function renderDiscountPackage(){
        var discountObj = [];
        if($('#discount-package').length > 0){
            $('#discount-package .discount-package-item').each(function(index, value){
                discountObj.push([$(this).val(), $(this).data('discount')])
            });
        }

        return discountObj;
    }

    function disCountTotalByPackage(total, nightNumber, discountObj){
        //console.log(discountObj.length);
        var result = total * nightNumber;
        for(var i = 0; i < discountObj.length; i++){
            var dayRange = discountObj[i][0].split('-');
            var discount = parseInt(discountObj[i][1] + ''.replace(/[^0-9\.]/g, ''), 10);

            dayRangeNumArr = [];

            for(var j = 0; j < dayRange.length; j++){
                var dayRangeNum = parseInt(dayRange[j] + ''.replace(/[^0-9\.]/g, ''), 10)
                dayRangeNumArr.push(dayRangeNum);
            }

            if(dayRangeNumArr.length == 1){
                if(nightNumber == dayRangeNumArr[0]){
                    result = total * nightNumber * (100 - discount) / 100;
                }
            }
            if(dayRangeNumArr.length == 2){
                if(nightNumber >= dayRangeNumArr[0] && nightNumber <= dayRangeNumArr[1]){
                    result = total * nightNumber * (100 - discount) / 100;
                }
            }
        }

        return result;
    }


    /**
     * User Verify
     */
    $('.btn-connect-facebook').on('click',function () {
        var me = $(this);
        var input = $(this).closest('.form-group').find('.input_id');
        var input_name = $(this).closest('.form-group').find('.input_name');
        var connected = $(this).closest('.form-group').find('.connected');

        if(typeof FB === 'undefined'){
            console.log('Facebook api is not ready');
            return;
        }

        connected.addClass('hidden');

        FB.login(function(response){
            // Handle the response object, like in statusChangeCallback() in our demo
            // code.
            if (response.status === 'connected') {
                // Logged into your app and Facebook.

                FB.api('/me?fields=id,name', function(response) {
                    input.val(response.id);
                    input_name.val(response.name);
                    connected.removeClass('hidden').find('span').html(response.name);
                });

            } else {
                // The person is not logged into this app or we are unable to tell.
                alert('You cancelled the process')
            }
        });
    });

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    $('.st-js-validate').on('submit',function (e) {

        var inputs = $(this).find('[data-rules]');
        if(inputs.length){

            var check = true;

            inputs.each(function () {
                $(this).trigger('clear-error');
                var val = $(this).val();
                var rules = $(this).data('rules');
                var field_check = true;
                var rules_errors =[];

                rules.split(',').map(function (v) {
                    switch (v.trim())
                    {
                        case "required":
                            if(!val){
                                field_check = false;
                                rules_errors.push(v.trim());
                            }
                            break;
                        case "email":
                            if(!validateEmail(val)) {
                                field_check = false;
                                rules_errors.push(v.trim())
                            }
                            break;

                    }
                });

                //Focus on first error field
                if(check && !field_check){
                    $(this).focus();
                }

                if(!field_check){
                    check = false;
                    console.log('trigger');
                    $(this).trigger('on-error',rules_errors);
                }
            });

            if(check)
            {
                e.target.submit();
            }else{
                e.preventDefault();
            }
        }

    });

    $('.st-js-validate *').on('clear-error',function (e) {
        var parent = $(this).closest('.form-group');
        if(parent.length){

            $(this).removeClass('error');
            parent.removeClass('error');
        }

    }).on('on-error',function (e,rules) {
        var parent = $(this).closest('.form-group');
        if(parent.length){

            $(this).addClass('error');
            parent.addClass('error');
        }
    });

    $('.verify_photo_inputs').change(function () {
        var me = $(this);
        var input  = $(this).closest('.form-group').find("input[type='hidden']");
        var btn  = $(this).closest('.btn');
        var files = $(this).get(0).files;
        var album = $(this).closest('.form-group').find('.lists-photo');
        var notes = $(this).closest('.form-group').find('.upload-notes');
        notes.html('');

        if(files.length)
        {
            var max_files = 5;

            var formData = new FormData();
            formData.append('action','st_user_add_photo');
            formData.append('_s',st_params._s);

            for (var i = 0; i < files.length; ++i) {

                if(i >= max_files) continue;

                formData.append('image['+i+']',files[i]);

            }

            btn.addClass('loading');

            me.val('');

            $.ajax({
                url: st_params.ajax_url,
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success:function (json) {
                    btn.removeClass('loading');
                    if(json.rows)
                    {
                        for( var i = 0;i< json.rows.length ; i++)
                        {
                            var d = $('<div/>');
                            d.addClass('passport-photo-item');
                            d.attr('data-url',json.rows[i].url);
                            d.append('<span class="icon-remove"><i class="fa fa-minus-circle"></i></span>');
                            d.append('<img src="'+json.rows[i].url+'">');
                            album.append(d)
                        }
                    }

                    var val = [];
                    album.find('[data-url]').each(function(){
                        val.push($(this).attr('data-url'));
                    });
                    input.val(val.join(','));

                    if(json.message)
                    {
                        notes.html(json.message);
                    }

                },
                error:function (e) {
                    btn.removeClass('loading');
                }
            })
        }

    });

    $(document).on('click','.passport-photo-item .icon-remove',function () {
        var album = $(this).closest('.form-group').find('.lists-photo');
        var input  = $(this).closest('.form-group').find("input[type='hidden']");
        var val = [];
        album.find('[data-url]').each(function(){
            val.push($(this).data('url'));
        });
        input.val(val.join(','));
        $(this).closest('.passport-photo-item').remove();
    });

    $('.has-datepicker').datepicker({
        autoclose:true
    });

    //----------End User verify----------------------------
    var bottomSpacing = $('#main-footer').height();
    $('.sticky-box').each(function(){
        var args={
            topSpacing:60,
            bottomSpacing:bottomSpacing,
            widthFromWrapper:true,
            getWidthFrom:''
        };

        args.getWidthFrom = $(this).data('width-from');

        $(this).sticky(args);

    });


    //-------------Add Service Step--------------------------
    var prevTab = $('.add-service-progress ul li:first-child');

    $('.add-service-progress ul li').click(function () {
        var validated = true;
        var me = $(this);
        if(prevTab)
        {
            var form = $(prevTab.data('step'));
            validated = validateStep(form);
            if(validated){
                prevTab.addClass('success').removeClass('error');
            }else{
                prevTab.addClass('error').removeClass('success');
            }
        }

        if(validated)
        {
            prevTab = me;
            var newForm=$($(this).data('step'));
            newForm.show().siblings().hide();

            me.addClass('selected').siblings().removeClass('selected');
        }

    });

    if($('#st_form_add_partner').length) {
        $('#st_form_add_partner').submit(function (e) {
            //e.preventDefault();
            var notSuccess = $('.add-service-progress ul li[data-step]:not(.success)');
            var check = true;
            if(notSuccess.length)
            {
                notSuccess.each(function(){
                    var form_id = $(this).data('step');
                    var form =$(form_id);

                    if(!validateStep(form))
                    {
                        check  = false;
                        form.show().siblings().hide();
                        $(this).addClass('selected error').siblings().removeClass('selected');
                        $(this).removeClass('success');
                        //return false;
                    }else{
                        $(this).addClass('success').removeClass('error');
                    }

                });
                if(!check)
                {
                    //$(this).submit();
                    e.preventDefault();
                }
            }
        });
    }

    function validateStep(form) {
        if(typeof tinyMCE !='undefined')
        {
            tinyMCE.triggerSave();
        }

        var inputs = form.find('[data-rules]');
        if(inputs.length){

            var check = true;

            inputs.each(function () {
                $(this).trigger('clear-error');
                var val = $(this).val();
                var rules = $(this).data('rules');
                var field_check = true;
                var rules_errors =[];
                var inputType = $(this).attr('type');
                var name = $(this).attr('name');

                rules.split(',').map(function (v) {
                    switch (v.trim())
                    {
                        case "required":
                            switch (inputType){
                                case "checkbox":
                                    if(form.find("[name='"+name+"']:checked").length < 1){
                                        field_check = false;
                                        rules_errors.push(v.trim());
                                    }
                                    break;
                                default:
                                    if(!val){

                                        field_check = false;
                                        rules_errors.push(v.trim());
                                    }
                                    break;
                            }
                            break;
                        case "email":
                            if(!validateEmail(val)) {
                                field_check = false;
                                rules_errors.push(v.trim())
                            }
                            break;

                    }
                });

                //Focus on first error field
                if(check && !field_check){
                    $(this).focus();
                }

                if(!field_check){
                    check = false;
                    $(this).trigger('on-error',rules_errors);
                }
            });

            return check;
        }

        return true;
    }

    $('.add_service_step [data-rules]').on('on-error',function (e,rules) {
        $(this).closest('.form-group').addClass('error');

        // if(rules.length)
        // {
        //     for(var i = 0;i<rules.length;i++){
        //         $(this).closest('.form-group').addClass('rule-'+rules[i]);
        //     }
        //
        // }
        if(typeof rules !='undefined'){
            $(this).closest('.form-group').addClass('rule-'+rules);
        }

    })
     .on('clear-error',function () {
            $(this).closest('.form-group').removeClass('error').alterClass('rule-*');
        });

    //-------------End Add Service Step--------------------------


    //--------------- Guest Name Inputs -------------------------

    var adultNumber = $('.form-has-guest-name .adult_number');
    var childrenNumber = $('.form-has-guest-name .child_number');
    var infantNumber = $('.form-has-guest-name .infant_number');
    var guestNameInput = $('.form-has-guest-name .guest_name_input');

    adultNumber.on('change',triggerGuestInputChange);
    childrenNumber.on('change',triggerGuestInputChange);
    infantNumber.on('change',triggerGuestInputChange);

    function triggerGuestInputChange(e) {
        guestNameInput.trigger('guest-change', {
            'adult': parseInt(adultNumber.val()),
            'children': parseInt(childrenNumber.val()),
            'infant': parseInt(infantNumber.val())
        });
    };

    guestNameInput.on('guest-change',function(e,number){
        var adult = number.adult;
        var children = number.children;
        var infant = number.infant;
        var hideAdult  = $(this).data('hide-adult');
        var hideChildren  = $(this).data('hide-children');
        var hideInfant  = $(this).data('hide-infant');
        var controlWraps = $(this).find('.guest_name_control');
        var controls = controlWraps.find('.control-item');

        if(isNaN(infant)) infant=0;
        if(isNaN(children)) children=0;

        if(hideAdult=='on'){
            adult = 0;
        }

        if(typeof hideChildren=='undefined' || hideChildren!='on') adult += children;
        if(typeof hideInfant=='undefined' ||  hideInfant!='on') adult += infant;

        //adult-=1;// Only input guest >=2 name

        if(adult<=0){
            $(this).addClass('hidden');
        }else{
            // Append
            for(var i = controls.length?(controls.length):0;i<adult;i++)
            {
                var div = $($('#guest_name_control_item').clone().html());
                var p = div.find('input').attr('placeholder');
                div.find('input').attr('placeholder',p.replace('%d',i+2));

                controlWraps.append(div);
            }

            // Remove
            controls.each(function () {
                if($(this).index() > adult -1)
                {
                    $(this).remove();
                }
            });

            $(this).removeClass('hidden');
        }
    });

    triggerGuestInputChange();
    //------------------End Guest Name Inputs -------------------


});

(function ( $ ) {

    $.fn.alterClass = function ( removals, additions ) {

        var self = this;

        if ( removals.indexOf( '*' ) === -1 ) {
            // Use native jQuery methods if there is no wildcard matching
            self.removeClass( removals );
            return !additions ? self : self.addClass( additions );
        }

        var patt = new RegExp( '\\s' +
            removals.
            replace( /\*/g, '[A-Za-z0-9-_]+' ).
            split( ' ' ).
            join( '\\s|\\s' ) +
            '\\s', 'g' );

        self.each( function ( i, it ) {
            var cn = ' ' + it.className + ' ';
            while ( patt.test( cn ) ) {
                cn = cn.replace( patt, ' ' );
            }
            it.className = $.trim( cn );
        });

        return !additions ? self : self.addClass( additions );
    };

})( jQuery );
