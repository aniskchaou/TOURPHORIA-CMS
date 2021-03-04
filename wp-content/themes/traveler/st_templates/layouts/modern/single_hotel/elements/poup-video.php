<?php extract(shortcode_atts(array(
    'st_video_pupop'         => '',
    'st_images_video'         => '',
  ), $attr));
$image_src = wp_get_attachment_image_src($st_images_video,'');
?>
<style type="text/css" media="screen">
	
  

</style>
<div class="list-group  st-gallery-grid poup-galler-st poup-video-st">
    	<div class="item">
            <div class="thumbnail">
                <a class="video-poup" href="<?php echo esc_url($st_video_pupop);?>" data-group="video-poup" title=""><img class="group list-group-image" src="<?php echo esc_url($image_src[0]);?>" alt="" style="min-height: 450px;" /></a>
            </div>
        </div>
         <div class="poup-galler-sticon-gallery video-st-popup">
	    	<svg class="video_shape">
			  
			</svg>
	    </div>
	    <div class="poup-galler-sticon-gallery video-st-popup">
	    	<div class="img-icon-pop">
	    		<img src="<?php echo get_template_directory_uri().'/v2/images/assets/ico_play.svg';?>" alt="">
	    	</div>
	    	
	    </div>
	    
    </div>
    
    <script type="text/javascript">
    	jQuery(document).ready(function($) {
    		$('.poup-galler-sticon-gallery.video-st-popup').click(function(){
    			$('.poup-video-st .list-group-image').click();
    		});


    		var groups = {};
			$('.poup-video-st .item').each(function() {
			    var id = parseInt($(this).attr('data-group'), 10);
				if(!groups[id]) {
			    	groups[id] = [];
				} 
			  
				groups[id].push( this );
			});


			$.each(groups, function() {
			  
			  $(this).find(".video-poup").magnificPopup({
			       disableOn: 700,
			        type: 'iframe',
			        mainClass: 'mfp-fade',
			        removalDelay: 160,
			        preloader: false,

			        fixedContentPos: false
			  })
			});
	    	

			 $( document ).ready(function() {
		        $(window).scroll(function() {
		           var hT = $('.st-gallery-grid').offset().top,
		           hH = $('.st-gallery-grid').outerHeight(),
		           wH = $(window).height(),
		           wS = $(this).scrollTop();
		           var html_icon = "<circle id='video_shape'  cx='64' cy='64' r='32' stroke-dasharray='1000' stroke-dashoffset='0'/>";
		           if (wS > (hT+hH-wH)){
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape").html(html_icon);
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").attr("stroke-dashoffset", "0");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("transform", "rotate(-90deg)");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("-webkit-transform", "rotate(-90deg)");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("-ms-transform", "rotate(-90deg)");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("fill", "none");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("stroke", "#FFFFFF");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("stroke-width", "3");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("transition", "all 3s ease-in-out");
		                $(".st-gallery-grid .poup-galler-sticon-gallery  .video_shape circle").css("transform-origin", "center center");

		                var shape_video = document.getElementById('video_shape');
		                setTimeout(function () {
		                  shape_video.setAttribute('stroke-dashoffset', 0);
		                  jQuery('#gallery_shape').addClass('st-opacity');
		                }, 0);
		                }
		        });
		    });
	    	

	    });
    </script>



