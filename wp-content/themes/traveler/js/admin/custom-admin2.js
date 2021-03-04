jQuery(document).ready(function ($) {
    if ($('#st_sendmail_expire_partner').length) {
        $('#st_sendmail_expire_partner').click(function (e) {
            e.preventDefault();
            var t    = $(this).closest('#posts-filter');
            var data = t.serializeArray();
            t.find('.partner-message .alert').hide();
            console.log(data);
            $.ajax({
                url       : ajaxurl,
                type      : "POST",
                data      : data,
                dataType  : "json",
                beforeSend: function () {
                    t.find('.overlay').show();
                    t.find('.overlay .spinner').addClass('is-active');
                }
            }).done(function (respond) {
                if (respond.status == true) {
                    t.find('.partner-message .alert').removeClass('alert-error').show().html(respond.message);
                } else {
                    t.find('.partner-message .alert').addClass('alert-error').show().html(respond.message);
                }
                t.find('.overlay').hide();
                t.find('.overlay .spinner').removeClass('is-active');
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            })
        });
    }
});

(function ($) {
    'use strict';
    $('input[name="st_icon_new"]').each(function () {
        var t      = $(this),
            parent = t.parent();
        parent.css('position', 'relative');
        parent.append('<div class="st-icon-new-wrapper">' +
            '<input type="text" name="search" placeholder="Enter a minimum of 2 characters">' +
            '<div class="result">' +
            '<div class="render"></div>' +
            '<div class="loader-wrapper">' +
            '    <div class="lds-ripple">' +
            '        <div></div>' +
            '        <div></div>' +
            '    </div>' +
            '</div>' +
            '</div>' +
            '</div>');

        t.focus(function () {
            $('.st-icon-new-wrapper', parent).show();
            if(t.val() == ''){
                $('.st-icon-new-wrapper input', parent).focus();
            }
        });
        $('body').click(function (ev) {
            if ($(ev.target).closest('.st-icon-new-wrapper').length == 0 && !$(ev.target).is('#st_icon_new')) {
                $('.st-icon-new-wrapper', parent).hide();
            }
        });
        var timeout, ajax;
        $('.st-icon-new-wrapper input', parent).on('keyup', function () {
            var text = $(this).val();
            if (text.length < 2) {
                return false;
            }
            clearTimeout(timeout);
            if(ajax){
                ajax.abort();
            }
            var data = {
                text  : text,
                action: 'st_get_icon_new'
            };
            timeout  = setTimeout(function () {
                $('.st-icon-new-wrapper .loader-wrapper', parent).show();
                ajax = $.post(ajaxurl, data, function (respon) {
                    $('.st-icon-new-wrapper .loader-wrapper', parent).hide();
                    if (typeof respon == 'object') {
                        if (respon.status == 0) {
                            $('.st-icon-new-wrapper .render', parent).html(respon.data);
                        } else {
                            var html = '';
                            $.each(respon.data, function (index, value) {
                                html += '<div class="item" data-icon="' + index + '">' + value + '</div>';
                            });
                            $('.st-icon-new-wrapper .render', parent).html(html);
                            $('.st-icon-new-wrapper .render .item', parent).click(function(){
                                t.val($(this).attr('data-icon'));
                            });
                        }
                    }
                }, 'json');
            }, 500);
        });
    });

    $(document).ready(function () {
        /* Show / Hide metabox */
        setTimeout(function () {
            showMetaBoxByTemplate($('#st_rental_search_result_options'), 'template-rental-search.php');
            showMetaBoxByTemplate($('#st_hotel_search_result_options'), 'template-hotel-search.php');
            showMetaBoxByTemplate($('#st_tour_search_result_options'), 'template-tour-search.php');
            showMetaBoxByTemplate($('#st_activity_search_result_options'), 'template-activity-search.php');
            showMetaBoxByTemplate($('#st_hotel_alone_page_options'), 'template-hotel-alone.php');
        }, 5000);

        function showMetaBoxByTemplate(divMeta, templateName) {
            var selectTemp = $('#page_template');
            if ($('.editor-page-attributes__template').length) {
                selectTemp = $('.editor-page-attributes__template').eq(0).find('select');
            }

            if (selectTemp.length) {
                if (selectTemp.val() == templateName) {
                    divMeta.show();
                } else {
                    divMeta.hide();
                }

                selectTemp.change(function () {
                    if ($(this).val() == templateName) {
                        divMeta.show();
                    } else {
                        divMeta.hide();
                    }
                });
            }
        }
    });
})(jQuery);