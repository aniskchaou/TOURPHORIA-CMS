jQuery(document).ready(function ($) {
    if ($(".st_template_checkout").length < 1) return;
    var old_order_id = !1;
    var new_nonce = !1;

    function st_validate_checkout(me) {
        me.find('.form_alert').addClass('hidden');
        var data = me.serializeArray();
        var dataobj = {};
        var form_validate = !0;
        for (var i = 0; i < data.length; ++i) {
            dataobj[data[i].name] = data[i].value
        }
        me.find('input.required,select.required,textarea.required').removeClass('error');
        me.find('input.required,select.required,textarea.required').each(function () {
            if (!$(this).val()) {
                $(this).addClass('error');
                form_validate = !1
            }
        });
        if (form_validate == !1) {
            me.find('.form_alert').addClass('alert-danger').removeClass('hidden');
            me.find('.form_alert').html(st_checkout_text.validate_form);
            return !1
        }
        if (!dataobj.term_condition && $('[name=term_condition]', me).length) {
            me.find('.form_alert').addClass('alert-danger').removeClass('hidden');
            me.find('.form_alert').html(st_checkout_text.error_accept_term);
            return !1
        }
        return !0
    }

    /* Start rewrite booking event */
    ;(function ($) {
        $.fn.STSendAjax = function () {
            this.each(function () {
                var me = $(this);
                var button = $('.btn-st-checkout-submit', this);
                var data = me.serializeArray();
                data.push({name: 'action', value: 'booking_form_direct_submit'});
                me.find('.form-control').removeClass('error');
                me.find('.form_alert').addClass('hidden');
                var dataobj = {};
                for (var i = 0; i < data.length; ++i) {
                    dataobj[data[i].name] = data[i].value
                }
                dataobj.order_id = old_order_id;
                var validate = st_validate_checkout(me);
                if (!validate)
                    return !1;
                button.addClass('loading');

                $.ajax({
                    type: 'post',
                    url: st_params.ajax_url,
                    data: dataobj,
                    dataType: 'json',
                    success: function (data) {
                        if (typeof(data.order_id) != 'undefined' && data.order_id) {
                            old_order_id = data.order_id
                        }
                        if (data.message) {
                            me.find('.form_alert').addClass('alert-danger').removeClass('hidden');
                            me.find('.form_alert').html(data.message)
                        }
                        if (data.redirect) {
                            window.location.href = data.redirect
                        }
                        if (data.redirect_form) {
                            $('body').append(data.redirect_form)
                        }
                        if (data.new_nonce) {

                        }
                        var widget_id = 'st_recaptchar_' + dataobj.item_id;
                        get_new_captcha(me);
                        button.removeClass('loading')
                    },
                    error: function (e) {
                        button.removeClass('loading');
                        alert('Lost connect to server');
                        get_new_captcha(me)
                    }
                });
            });
        };
    })(jQuery);

    $('.btn-st-checkout-submit').click(function () {
        var form = $(this).closest('form');
        form.trigger('st_before_checkout');

        var payment = $('input[name="st_payment_gateway"]:checked', form).val();
        var wait_validate = $('input[name="wait_validate_' + payment + '"]', form).val();
        if (wait_validate === 'wait') {
            form.trigger('st_wait_checkout');
            return false;
        }
        form.STSendAjax();
    });
    /* End start rewrite booking event */

    /*$('.btn-st-checkout-submit').click(function () {
        var button = $(this);
        var me = $('#cc-form');
        me.trigger('st_before_checkout');
        var data = me.serializeArray();
        alert('123');
        console.log(data);
        data.push({name: 'action', value: 'booking_form_direct_submit'});
        me.find('.form-control').removeClass('error');
        me.find('.form_alert').addClass('hidden');
        var dataobj = {};
        var form_validate = !0;
        for (var i = 0; i < data.length; ++i) {
            dataobj[data[i].name] = data[i].value
        }
        dataobj.order_id = old_order_id;
        var validate = st_validate_checkout(me);
        if (!validate) return !1;
        button.addClass('loading');
        $.ajax({
            type: 'post', url: st_params.ajax_url, data: dataobj, dataType: 'json', success: function (data) {
                if (typeof(data.order_id) != 'undefined' && data.order_id) {
                    old_order_id = data.order_id
                }
                if (data.message) {
                    me.find('.form_alert').addClass('alert-danger').removeClass('hidden');
                    me.find('.form_alert').html(data.message)
                }
                if (data.redirect) {
                    window.location.href = data.redirect
                }
                if (data.redirect_form) {
                    $('body').append(data.redirect_form)
                }
                if (data.new_nonce) {
                }
                var widget_id = 'st_recaptchar_' + dataobj.item_id;
                get_new_captcha(me);
                button.removeClass('loading')
            }, error: function (e) {
                button.removeClass('loading');
                alert('Lost connect to server');
                get_new_captcha(me)
            }
        })
    });*/

    function get_new_captcha(me) {
        var captcha_box = me.find('.captcha_box');
        url = captcha_box.find('.captcha_img').attr('src');
        captcha_box.find('.captcha_img').attr('src', url)
    }

    $('.payment-item-radio').on('ifChecked', function () {
        var parent = $(this).closest('li.payment-gateway');
        id = parent.data('gateway');
        parent.addClass('active').siblings().removeClass('active');
        $('.st-payment-tab-content .st-tab-content[data-id="' + id + '"]').siblings().fadeOut('fast');
        $('.st-payment-tab-content .st-tab-content[data-id="' + id + '"]').fadeIn('fast')
    })
})