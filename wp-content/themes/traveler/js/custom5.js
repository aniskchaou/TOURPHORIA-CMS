jQuery(document).ready(function ($) {
    //Booking now in single hotel
    /*$(document).on('click', '.btn_hotel_booking', function (e) {
        e.preventDefault();
        $('#bookingRoomNow').modal('show');
    });
    $('#bookingRoomNow').modal('show');*/
    $('.bookingdc-num-children').change(function () {
        var t = $(this);
        var af = $('.bookingdc-age-children');

        var number_child = t.val();

        if (number_child > 0) {
            var te = '';
            for (var i = 0; i < number_child; i++) {
                te += '<select name="age">';
                for (var j = 0; j < 18; j++) {
                    te += '<option value="' + j + '">' + j + '</option>';
                }
                te += '</select>';
            }
            af.show().children('#bookingdc-age-select').html(te);
        } else {
            af.hide().children('#bookingdc-age-select').html('');
        }
    });

    $('.bookingdc-start').change(function () {
        $('input[name="checkin_monthday"]').remove();
        $('input[name="checkin_month"]').remove();
        $('input[name="checkin_year"]').remove();

        var start = $(this).datepicker("getDate");
        var ci_dd = start.getDate();
        var ci_mm = start.getMonth() + 1;
        var ci_yy = start.getFullYear();

        var ci_te = '';

        if ($('input[name="checkin_monthday"]').length == 0 && $('input[name="checkin_month"]').length == 0 && $('input[name="checkin_year"]').length == 0) {
            ci_te += '<input type="hidden" name="checkin_monthday" value="' + ci_dd + '"/>';
            ci_te += '<input type="hidden" name="checkin_month" value="' + ci_mm + '"/>';
            ci_te += '<input type="hidden" name="checkin_year" value="' + ci_yy + '"/>';
            $('.main-bookingdc-search').append(ci_te);
        }
    });

    $('.bookingdc-end').change(function () {
        $('input[name="checkout_monthday"]').remove();
        $('input[name="checkout_month"]').remove();
        $('input[name="checkout_year"]').remove();

        var end = $(this).datepicker("getDate");
        var co_dd = end.getDate();
        var co_mm = end.getMonth() + 1;
        var co_yy = end.getFullYear();

        var co_te = '';

        if ($('input[name="checkout_monthday"]').length == 0 && $('input[name="checkout_month"]').length == 0 && $('input[name="checkout_year"]').length == 0) {
            co_te += '<input type="hidden" name="checkout_monthday" value="' + co_dd + '"/>';
            co_te += '<input type="hidden" name="checkout_month" value="' + co_mm + '"/>';
            co_te += '<input type="hidden" name="checkout_year" value="' + co_yy + '"/>';

            $('.main-bookingdc-search').append(co_te);
        }
    });
});
