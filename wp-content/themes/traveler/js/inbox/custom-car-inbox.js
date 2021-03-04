jQuery(document).ready(function($) {
    $('.show-diff-location').click(function () {
        $('.drop-off-location').slideToggle();
    });
    $('.pickup').change(function () {
        var me = $(this);
        if(!$('.drop-off-location').is(':visible')){
            $('.dropoff').val(me.val());
        }
    });

    $('.pick-up-date').each(function () {
        var form = $(this).closest('form');
        var me   = $(this);
        $(this).datepicker({
            language      : st_params.locale,
            startDate     : 'today',
            format        : $('[data-date-format]').data('date-format'),
            todayHighlight: true,
            autoclose     : true,
            weekStart     : 1
        });
        $(this).on('changeDate', function (e) {
            var new_date = e.date;
            new_date.setDate(new_date.getDate());
            $('.drop-off-date', form).datepicker('setDates', new_date);
            $('.drop-off-date', form).datepicker('setStartDate', new_date);
        });

        $('.drop-off-date', form).datepicker({
            language      : st_params.locale,
            startDate     : 'today',
            todayHighlight: true,
            autoclose     : true,
            format        : $('[data-date-format]').data('date-format'),
            weekStart     : 1
        });
    });
    var list_selected_equipment_load = [];
    $('.st-inbox-form-book').find('.equipment').each(function (event) {
        if ($(this)[0].checked == true) {
            var num = 1;
            var parent = $(this).closest('.equipment-list');
            if ($('select[name="number_equipment"]', parent).length) {
                num = parseInt($('select[name="number_equipment"]', parent).val());
            }

            list_selected_equipment_load.push({
                title: $(this).attr('data-title'),
                price: str2num($(this).attr('data-price')),
                price_unit: $(this).data('price-unit'),
                price_max: $(this).data('price-max'),
                number_item: num
            });
        }
    });
    $('.st_selected_equipments').val(JSON.stringify(list_selected_equipment_load));

    $('.booking-item-price-calc .equipment').on('ifChanged', function(event) {
        var list_selected_equipment = [];
        var person_ob = new Object();
        $('.st-inbox-form-book').find('.equipment').each(function (event) {
            if ($(this)[0].checked == true) {
                var price = str2num($(this).attr('data-price'));
                var price_max = str2num($(this).attr('data-price-max'));
                var num = 1;
                var parent = $(this).closest('.equipment-list');
                if ($('select[name="number_equipment"]', parent).length) {
                    num = parseInt($('select[name="number_equipment"]', parent).val());
                }

                person_ob[$(this).attr('data-title')] = str2num($(this).attr('data-price')) * num;
                list_selected_equipment.push({
                    title: $(this).attr('data-title'),
                    price: str2num($(this).attr('data-price')),
                    price_unit: $(this).data('price-unit'),
                    price_max: $(this).data('price-max'),
                    number_item: num
                });
            }
        });
        $('.data_price_items').val(JSON.stringify(person_ob));
        $('.st_selected_equipments').val(JSON.stringify(list_selected_equipment));
    });

    function str2num(val) {
        val = '0' + val;
        val = parseFloat(val);
        return val;
    }

});