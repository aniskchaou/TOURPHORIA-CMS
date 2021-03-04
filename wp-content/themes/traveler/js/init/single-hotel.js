jQuery(document).ready(function($) {
    if ($(".st_single_hotel").length < 1) return;
    console.log('Single Hotel');

    $('ul.paged_room a.paged_room').each(function() {
        $(this).attr('data-page', $(this).html())
    });
    $(document).on('click', '.paged_item_room', function() {
        var paged = $(this).data('page');
        $('.booking-item-dates-change .paged_room').val(paged);
        $('.btn-do-search-room').click();
    });
    if ($('#field-hotel-start, #field-hotel-end').length) {
        var check_in = $('#field-hotel-start');
        var check_out = $('#field-hotel-end');
        $('#field-hotel-start, #field-hotel-end').datepicker({
            language: st_params.locale,
            autoclose: !0,
            todayHighlight: !0,
            startDate: 'today',
            format: $('[data-date-format]').data('date-format'),
            weekStart: 1,
        });
        check_in.on('changeDate', function(e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate() + 1);
            check_out.datepicker('setDates', new_date);
            check_out.datepicker('setStartDate', new_date);
            check_out.datepicker('show')
        })
    }
    if ($('.st-slider-list-room').length) {
        $('.st-slider-list-room').owlCarousel({
            items: 3,
            itemsDesktop: [1200, 3],
            itemsDesktopSmall: [992, 3],
            itemsTablet: [768, 2],
            itemsMobile: [320, 1],
            slideSpeed: 1000,
            paginationSpeed: 1000,
            pagination: !1,
        });
        var slider = $(".st-slider-list-room").data('owlCarousel');
        $('.st-slider-list-room-wrapper .control-left').click(function(event) {
            slider.prev();
            return !1
        });
        $('.st-slider-list-room-wrapper .control-right').click(function(event) {
            slider.next();
            return !1
        })
    }

    function $_GET(param) {
        var vars = {};
        window.location.href.replace(location.hash, '').replace(/[?&]+([^=&]+)=?([^&]*)?/gi, function(m, key, value) {
            vars[key] = value !== undefined ? value : ''
        });
        if (param) {
            return vars[param] ? vars[param] : null
        }
        return vars
    }


    var booking_period = $('.booking-item-dates-change').data('booking-period');
    $('input.checkin_hotel, input.checkout_hotel').datepicker('setStartDate','+'+(booking_period+1)+'d');

    $('.overlay-form').fadeOut(500);
})