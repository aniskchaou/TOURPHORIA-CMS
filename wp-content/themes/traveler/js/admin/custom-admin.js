jQuery(document).ready(function ($) {
    $('.user-role-wrap #role').change(function () {
        var $value = $(this).val();
        if ($value == "partner") {
            $("#partner_service").show()
        } else {
            $("#partner_service").hide()
        }
    });
    $('.st_datepicker, .st_datepicker_withdrawal').each(function () {
        $(this).datepicker({dateFormat: 'yy/mm/dd',})
    });
    if ($('.st-select-loction').length) {
        $('.st-select-loction').each(function (index, el) {
            var parent = $(this);
            var input = $('input[name="search"]', parent);
            var list = $('.list-location-wrapper', parent);
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
    $('body').on('click', '#add-destination-image', function () {
        var parent = $(this).closest('.form-field');
        var field_id = $(this).parent().find('input').attr('id'),
            btnContent = '';
        if (window.wp && wp.media) {
            window.ot_media_frame = window.ot_media_frame || new wp.media.view.MediaFrame.Select({
                title: $(this).attr('title'),
                button: {
                    text: $(this).attr('data-upload-text')
                },
                multiple: false
            });
            window.ot_media_frame.on('select', function () {
                var attachment = window.ot_media_frame.state().get('selection').first(),
                    href = attachment.attributes.url,
                    attachment_id = attachment.attributes.id,
                    mime = attachment.attributes.mime,
                    regex = /^image\/(?:jpe?g|png|gif|x-icon)$/i;
                if (mime.match(regex)) {
                    btnContent += '<img src="' + href + '" alt="" />';
                }
                $('#' + field_id).val(attachment_id);
                $('.destination-image', parent).html(btnContent).slideDown();
                window.ot_media_frame.off('select');
            }).open();
        }
        return false;
    });
})