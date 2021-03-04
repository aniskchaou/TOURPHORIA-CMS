(function ($) {

    'use strict';

    $(document).ready(function () {
        $('.st_checkbox_item .item').on('click', function () {
            var t = $(this);
            var parentBox = t.closest('.st_checkbox_item');
            var text = [];
            parentBox.find('.item').each(function () {
                if ($(this).prop('checked') == true) {
                    if ($(this).val() != '')
                        text.push($(this).val());
                }
            });
            parentBox.find('.st_checkbox').val(text.toString());
        });
    });
})(jQuery);