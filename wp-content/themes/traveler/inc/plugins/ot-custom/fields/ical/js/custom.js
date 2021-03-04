jQuery(function($){
    var flag = false;
    var body = $('body');
    body.on('click', '#save_ical', function(event){
        event.preventDefault();
        //var textCheckOveride = $('#setting_ical_url').find('i').text().trim();
        /*if(textCheckOveride != ''){
            if (!confirm('Are you sure?')) {
                return;
            }
        }*/
        var parent = $(this).parent(),
            t = $(this),
            spinner = $('.spinner-import', parent),
            message = $('.form-message', parent);
        if(flag){
            return false;
        }
        flag = true;
        spinner.show();
        var data = {
            'action' : 'st_import_ical',
            'url' : $('input.ical_input', parent).val(),
            'post_id' : $('input[name="post_id"]', parent).val(),
            'ical_type' : $('input[name="type_ical"]:checked').val()
        };

        $.post(ajaxurl, data, function(respon){
            if(typeof respon === 'object'){
                message.html(respon.message);
            }
            flag = false;
            spinner.hide();
        },'json');
    });

    $('#export-ical').click(function(e){
        e.preventDefault();
        var spinner = $('.spinner-export');
        spinner.show();

        $.ajax({
            url: ajaxurl,
            dataType: 'json',
            type:'post',
            data: {
                action: 'st_export_ical',
                post_id : $('input[name="post_id"]').val(),
            },
            /*success: function(doc){
                $('#export-ical-content').html(doc);
                spinner.hide();
            },*/
            success: function(return_data, textStatus, jqXHR) {
                parsedData = return_data;
                window.open(parsedData.url);
            },
            error:function(e)
            {
                alert('Can not get the availability slot. Lost connect with your sever');
            }
        });
    });
});     

