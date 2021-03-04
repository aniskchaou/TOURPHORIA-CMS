<?php extract(shortcode_atts(array(
    'token_api'          => '',
    'user_id'          => '',
  ), $attr));?> 
<div class="full-width">
</div>
    <script type="text/javascript">
        jQuery(function($){
            <?php if(!empty($token_api) && isset($token_api)){?>
                var token = '<?php echo $token_api;?>',
                userid = 1362124742,
                num_photos = 5;
            <?php } else {?>
                var token = '1362124742.7b33a8d.6613a3567f0a425f9852055b8ef743b7', // learn how to obtain it below
                userid = 1362124742,
                num_photos = 5;
            <?php }?>
             
            jQuery.ajax({
                url: 'https://api.instagram.com/v1/users/self/media/recent',
                dataType: 'jsonp',
                type: 'GET',
                data: {access_token: token, count: num_photos},
                success: function(data){
                    for( x in data.data ){
                        jQuery('.full-width').append('<div class="thm-instagram st_fix_gallery" ><div class="item_insta"><a class="hover-img popup-gallery-image" href="'+data.data[x].images.low_resolution.url+'" data-effect="mfp-zoom-out" data-group="instar"><img width="100%" src="'+data.data[x].images.low_resolution.url+'" class="attachment-360x270 size-360x270"></a></div></div>');
                    }
                },
                error: function(data){
                    console.log(data); 
                },
                complete: function (xhr, status) {
                    var groups_instagram = {};
                    $('.full-width .thm-instagram').each(function() {
                     var id_masonry = parseInt($(this).attr('data-group'), 10);
                  
                    if(!groups_instagram[id_masonry]) {
                        groups_instagram[id_masonry] = [];
                    } 
                  
                      groups_instagram[id_masonry].push( this );
                    });


                    $.each(groups_instagram, function() {
                        $(this).find(".popup-gallery-image").magnificPopup({
                            type: 'image',
                            closeOnContentClick: true,
                            closeBtnInside: false,
                            gallery: { enabled:true }
                        })
                    });
                } 
            });
        });
        

  </script>