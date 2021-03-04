jQuery(document).ready(function ($) {
    var flag_refresh_md = 0;
    var request_running = false;
    var request;
    $('.ad-refund-list .with_a_refund').click(function (e) {
        e.preventDefault();
        var el = $(this);

        $('#with-refund-modal').find('.refund_complete').hide();

        $('#with-refund-modal .modal-content-inner').empty();

        var data = {
            'action': 'st_get_refund_infomation',
            'order_id': el.data('order_id'),
            'order_encrypt': el.data('order_encrypt')
        };

        $('#with-refund-modal').fadeIn();
        $('#with-refund-modal').find('.overlay .spinner').addClass('is-active');
        request = $.ajax({
            url: ajaxurl,
            type: "GET",
            dataType: "json",
            data: data,
            beforeSend: function () {

            },
            success: function(respon, textStatus, xhr) {
                if (typeof respon == 'object') {
                    $('#with-refund-modal .modal-content-inner').html(respon.message);
                    $('#with-refund-modal').data('order_id', respon.order_id);
                    $('#with-refund-modal').data('order_encrypt', respon.order_encrypt);
                }
                $('#with-refund-modal').find('.overlay .spinner').removeClass('is-active');
                $('#with-refund-modal').find('.refund_complete').show();
            },
            complete: function () {
                request_running = false;
            }
        });
        request_running = true;
    });

    $('#with-refund-modal, #with-refund-modal .modal-header .close').click(function (e) {
        if (e.target === this) {
            $('#with-refund-modal').fadeOut('', function () {
                if(request_running) {
                    request.abort();
                }
                if(flag_refresh_md == 1){
                    window.location.reload();
                }
            });
        }
    });
    $('#with-refund-modal .modal-header .close, #with-refund-modal .modal-footer .close-modal').click(function (e) {
        $('#with-refund-modal').fadeOut('', function () {
            if(request_running) {
                request.abort();
            }
            if(flag_refresh_md == 1){
                window.location.reload();
            }
        });
    });

    $('body').on('click', '.refund_complete', function (event) {
        event.preventDefault();
        var el     = $(this);
        var parent = el.closest('#with-refund-modal');
        parent.find('.overlay .spinner').addClass('is-active');
        el.addClass('hidden');
        var data = {
            'action'       : 'st_check_complete_refund',
            'order_id'     : parent.data('order_id'),
            'order_encrypt': parent.data('order_encrypt'),
        };
        $.post(ajaxurl, data, function (respon, textStatus, xhr) {
            if (typeof respon == 'object') {
                $('.modal-content-inner', parent).html(respon.message);
            }
            parent.find('.refund_complete').hide();
            parent.find('.overlay .spinner').removeClass('is-active');
            flag_refresh_md = 1;
        }, 'json')
    });
});