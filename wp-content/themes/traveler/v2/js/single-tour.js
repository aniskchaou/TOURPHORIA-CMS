(function ($) {
    'use strict';
    var body = $('body');

    if ($('.has-matchHeight', body).length) {
        $('.has-matchHeight', body).matchHeight();
    }
    if ($('.dropdown-toggle', body).length) {
        $('.dropdown-toggle', body).dropdown();
    }
    $('.open-loss-password', body).click(function (ev) {
        ev.preventDefault();
        $('#st-login-form', body).modal('hide');
        $('#st-register-form', body).modal('hide');
        setTimeout(function () {
            $('#st-forgot-form', body).modal('show');
        }, 500);
    });

    $('.open-login', body).click(function (ev) {
        ev.preventDefault();
        $('#st-register-form', body).modal('hide');
        $('#st-forgot-form', body).modal('hide');
        setTimeout(function () {
            $('#st-login-form', body).modal('show');
        }, 500);
    });

    $('.open-signup', body).click(function (ev) {
        ev.preventDefault();
        $('#st-forgot-form', body).modal('hide');
        $('#st-login-form', body).modal('hide');
        setTimeout(function () {
            $('#st-register-form', body).modal('show');
        }, 500);
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('#st-login-form form', body).submit(function (ev) {
        ev.preventDefault();
        var form = $(this),
            loader = form.closest('.modal-content').find('.loader-wrapper'),
            message = $('.message-wrapper', form);
        var data = form.serializeArray();
        data.push({
            name: 'security',
            value: st_params._s
        });
        message.html('');
        loader.show();
        $.post(st_params.ajax_url, data, function (respon) {
            if (typeof respon == 'object') {
                message.html(respon.message);
                setTimeout(function () {
                    message.html('');
                }, 2000);
                if (respon.status == 1) {
                    setTimeout(function () {
                        window.location.href = respon.redirect;
                    }, 2000);
                }
            }
            loader.hide();
        }, 'json');
    });

    $('#st-register-form form', body).submit(function (ev) {
        ev.preventDefault();
        var form = $(this),
            loader = form.closest('.modal-content').find('.loader-wrapper'),
            message = $('.message-wrapper', form);
        var data = form.serializeArray();
        data.push({
            name: 'security',
            value: st_params._s
        });
        message.html('');
        loader.show();

        $.post(st_params.ajax_url, data, function (respon) {
            loader.hide();
            if (typeof respon == 'object') {
                message.html(respon.message);
                if (respon.status == 1) {
                    swal({
                        type: 'success',
                        title: respon.message,
                        text: respon.sub_message,
                        showConfirmButton: true,
                        confirmButtonText: respon.closeText,
                        onClose: function () {
                            $('#st-login-form', body).modal('show');
                            $('#st-register-form', body).modal('hide');
                        },
                        allowOutsideClick: false
                    });
                } else {
                    message.html(respon.message);
                    setTimeout(function () {
                        message.html('');
                    }, 2000);
                }
            }
        }, 'json');
    });

    $('#st-forgot-form form', body).submit(function (ev) {
        ev.preventDefault();
        var form = $(this),
            loader = form.closest('.modal-content').find('.loader-wrapper'),
            message = $('.message-wrapper', form);
        var data = form.serializeArray();
        data.push({
            name: 'security',
            value: st_params._s
        });
        message.html('');
        loader.show();
        $.post(st_params.ajax_url, data, function (respon) {
            if (typeof respon == 'object') {
                message.html(respon.message);
                setTimeout(function () {
                    message.html('');
                }, 2000);
            }
            loader.hide();
        }, 'json');
    });
    $('.st-select2', body).select2({
        minimumResultsForSearch: -1
    });
    $('.select2-languages', body).select2({
        minimumResultsForSearch: -1
    });
    $('.select2-languages', body).change(function () {
        var target = $('option:selected', this).data('target');
        if (target) {
            window.location.href = target;
        }
    });

    $('.select2-currencies', body).select2({
        minimumResultsForSearch: -1
    });
    $('.select2-currencies', body).change(function () {
        var target = $('option:selected', this).data('target');
        if (target) {
            window.location.href = target;
        }
    });

    $('.has-gutterLeft', body).each(function(){
        var t = $(this);
        var _windowWidth = body.width();
        var _containerwidth = body.find('.container').first().width();

        t.css('padding-left', (_windowWidth - _containerwidth) / 2 - (15/2));
    });

    setTimeout(function(){
        $('.st-half-slider-wrapper .st-owl-carousel', body).each(function () {
            $(this).owlCarousel({
                loop: true,
                items: 1,
                margin: 0,
                responsiveClass: true,
                dots: true,
                nav: false
            });
        });
        setTimeout(function(){
            $('.st-half-slider-wrapper .has-matchHeight', body).matchHeight();
        }, 500);
    }, 500);

    $('.form-date-search', body).each(function () {
        var parent = $(this),
            date_wrapper = $('.date-wrapper', parent),
            check_in_input = $('.check-in-input', parent),
            check_out_input = $('.check-out-input', parent),
            check_in_out = $('.check-in-out', parent),
            check_in_render = $('.check-in-render', parent),
            check_out_render = $('.check-out-render', parent);
        var options = {
            singleDatePicker: false,
            autoApply: true,
            disabledPast: true,
            dateFormat: 'DD/MM/YYYY',
            customClass: '',
            widthSingle: 500,
            onlyShowCurrentMonth: true,
        };
        if (typeof locale_daterangepicker == 'object') {
            options.locale = locale_daterangepicker;
        }
        check_in_out.daterangepicker(options,
            function (start, end, label) {
                check_in_input.val(start.format(parent.data('format')));
                check_in_render.html(start.format(parent.data('format')));
                check_out_input.val(end.format(parent.data('format')));
                check_out_render.html(end.format(parent.data('format')));
                check_in_out.trigger('daterangepicker_change', [start, end]);
                if (window.matchMedia('(max-width: 767px)').matches) {
                    $('label', parent).hide();
                    $('.render', parent).show();
                    $('.check-in-wrapper span', parent).show();
                }
            });
        date_wrapper.click(function (e) {
            check_in_out.trigger('click');
        });
    });
})(jQuery);