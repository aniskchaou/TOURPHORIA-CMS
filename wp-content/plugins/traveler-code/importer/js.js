jQuery(document).ready(function($){
	$(document).on('click','#btn_import',function(){
	   var comf = confirm ('WARNING: Importing data is recommended on fresh installs only once. Importing on sites with content or importing twice will duplicate menus, pages and all posts.');
	   if(comf == true){
            window.onbeforeunload = confirmExit;
			$('.console_iport').show().html('Working ... <br><img class="loding_import" src="images/wpspin_light.gif">');
           var last_update_url;
			function start_loop_import(url){
                last_update_url=url;
				$.ajax({
						url: url,
						type: "POST",
						data: { 
							  },
						dataType: "json",
						beforeSend: function() {
							   
						}
				}).done(function( html ) {
					                       console.log(html);
										   if(html){
											  if(html.status == "ok"){ 
											    $('.loding_import').remove();
										        $('.console_iport').append(html.messenger);
												$('.console_iport').append('<img class="loding_import" src="images/wpspin_light.gif">')
											  }
											  if(html.next_url != ""){
											  	console.log(html.next_url);
												  start_loop_import(html.next_url) ;
											  }else{
												  $('.loding_import').remove();
											  }
										   }
			                             })
					.error(function(html) {
                        console.log('Re Import');
						$('.console_iport').append(html);
						$('.console_iport').append('Re-Import<br>');
                        if(last_update_url){
                            start_loop_import(last_update_url);
                        }
					});
			}
			// start fist
			start_loop_import( $(this).attr('data_url') );
	   }
	});
});


function confirmExit()
{
    return "You have attempted to leave this page.  If you have made any changes to the fields without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
}
										  
												  


