jQuery(document).ready(function ($) {
    if ($(".st_single_car").length < 1) return;
    var message_box = $('.car_booking_form .message_box');
    var car_booking_form = $('.car_booking_form');
    $('.car_booking_form input[type=submit]').click(function () {
        if (validate_car_booking()) {
            car_booking_form.submit()
        } else {
            return !1
        }
    });
    $('.single-st_cars .btn-st-add-cart').click(function (e) {
        e.preventDefault();
        if (!validate_car_booking()) {
            $(".popup-text[href='#search-dialog']").trigger('click');
            return !1
        }
    });
    $('.car_booking_form .btn_booking_modal').click(function () {
        if (validate_car_booking()) {
            var tar_get = $(this).data('target');
            $.magnificPopup.open({items: {type: 'inline', src: tar_get}})
        }
    });

    function validate_car_booking() {
        var form_validate = !0;
        message_box.html('');
        message_box.removeClass('alert');
        try {
            if (typeof st_car_booking_validate != "undefined") {
                for (i = 0; i < st_car_booking_validate.required.length; i++) {
                    var field_name = st_car_booking_validate.required[i];
                    console.log(car_booking_form.find('[name=' + field_name + ']').val());
                    if (!car_booking_form.find('[name=' + field_name + ']').val()) {
                        form_validate = !1
                    }
                }
            }
            console.log(form_validate);
            if (!form_validate) {
                form_validate = !1;
                $(".popup-text[href='#search-dialog']").trigger('click')
            }
        } catch (e) {
            console.log(e)
        }
        return form_validate
    };
    booking_period = $('#search-dialog').data('booking-period');
    setTimeout(function () {
        $('input.car_pick-up-date, input.car_drop-off-date').datepicker('setStartDate','+'+booking_period+'d');
    }, 1000);
    $('.overlay-form').fadeOut(500)
    // if (typeof booking_period != 'undefined' && parseInt(booking_period) > 0) {
    //     var data = {booking_period: booking_period, action: 'st_getBookingPeriod'};
    //     $.post(st_params.ajax_url, data, function (respon) {
    //         if (respon != '') {
    //             $('input.car_pick-up-date, input.car_drop-off-date').datepicker('setRefresh', !0);
    //             $('input.car_pick-up-date, input.car_drop-off-date').datepicker('setDatesDisabled', respon)
    //         }
    //     }, 'json');
    //     $(document).ajaxStop(function () {
    //         $('.overlay-form').fadeOut(500)
    //     })
    // } else {
    //     $('.overlay-form').fadeOut(500)
    // }
})