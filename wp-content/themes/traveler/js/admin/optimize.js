/**
 * Created by Administrator on 3/8/2017.
 */
jQuery(document).ready(function($){
    'use strict'

    var optimize_flag = false;
    $('.st-button-optimize', 'body').click(function(event){
        event.preventDefault();
        var t = $(this);
        var parent = t.closest('td');
        var message = parent.closest('tr').find('.st-optimize-message');
        var data = {
            'action': t.data('action')
        };
        if(optimize_flag){
            return false;
        }
        optimize_flag = true;
        parent.closest('tr').find('img').show();

        $.post(ajaxurl, data, function(respon){
            if(typeof  respon == 'object'){
                message.html(respon.message);
            }
            optimize_flag = false;
            parent.closest('tr').find('img').hide();
        },'json');
    });
});