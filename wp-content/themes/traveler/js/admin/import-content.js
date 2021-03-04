/**
 * Created by MSI on 23/11/2015.
 */
jQuery(document).ready(function($){

    $('.st-install-demo').click(function(){
       var package_name=$(this).data('demo-id');
       do_import(package_name);
    });
    function do_import(package_name)
    {
        var comf = confirm (st_import_localize.confirm_message);
        var erorr_count=0;
        if(comf == true){
            $('.console_iport').show().html('Working ... <br><img class="loding_import" src="images/wpspin_light.gif">');
            var last_update_url;
            function start_loop_import(data){
                $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: data,
                    dataType: "json",
                }).done(function( html ) {
                    console.log(html);
                    if(html){
                        if(html.status == "ok"){
                            $('.loding_import').remove();
                            $('.console_iport').append(html.messenger);
                            $('.console_iport').append('<img class="loding_import" src="images/wpspin_light.gif">');
                            $('.console_iport').animate({scrollTop: $('.console_iport').prop("scrollHeight")}, 500);
                        }
                        if(html.next_post_data){
                            start_loop_import(html.next_post_data) ;
                        }else{
                            $('.loding_import').remove();
                        }
                    }
                }).error(function(html) {
                    erorr_count++;
                    if(erorr_count<=5)
                    {
                        console.log('Re Import');
                        $('.console_iport').append(html);
                        $('.console_iport').append('Re-Import<br>');
                        $('.console_iport').animate({scrollTop: $('.console_iport').prop("scrollHeight")}, 500);
                        start_loop_import(data);
                    }

                });
            }
            // start fist
            var first_loop_data={
                version:package_name,
                step:1,
                action:'st_import_content'
            };
            start_loop_import( first_loop_data );
        }

    }


});