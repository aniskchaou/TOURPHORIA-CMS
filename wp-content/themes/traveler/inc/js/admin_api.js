jQuery(document).ready(function($){
    $(document).on('click','#btn_run_sync_roomorama',function(){
        var comf = confirm ('WARNING: Do you really want to synchronize data to your server?');
        if(comf == true){
            $('#content_run_sync_roomorama').show().html('Working ... <br><img class="loding_import" src="images/wpspin_light.gif" alt="Loading">');
            function start_loop_roomorama(data){
                $.ajax({
                    url: ajaxurl,
                    type: "GET",
                    data: data,
                    dataType: "json",
                    beforeSend: function() {}
                }).done(function( html ) {
                    if(html.data.st_step != 0){
                        $('.loding_import').remove();
                        $('#content_run_sync_roomorama').append(html.msg);
                        $('#content_run_sync_roomorama').append('<img class="loding_import" src="images/wpspin_light.gif">');
                        start_loop_roomorama(html.data) ;
                    }else{
                        $('#content_run_sync_roomorama').append(html.msg);
                        $('.loding_import').remove();
                    }
                });
            }
            var first_loop_data={
                st_step:1,
                action:'st_update_content_api_roomorama'
            };
            start_loop_roomorama( first_loop_data );
        }
    });
});