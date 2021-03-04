<?php extract(shortcode_atts(array(
    'st_images_gallery'         => '',
  ), $attr));
$img_ids = explode(",",$st_images_gallery);
?>
<style type="text/css" media="screen">
	.item.bg-icon-st{

	}

</style>

<div class="list-group  st-gallery-grid poup-galler-st">
    	<?php
		    foreach( $img_ids as $count=>$im_id ){
		      $image_src = wp_get_attachment_image_src($im_id,'');
		      $meta = wp_prepare_attachment_for_js($im_id);
		      $tes_title=$meta['title'];
		      $tes_caption=$meta['caption'];
			?>
	        <div class="item <?php if($count == 0){ ?> bg-icon-st <?php } ?>" <?php if($count != 0){ ?> style="display: none;" <?php } ?>>
	            <div class="thumbnail">
	                <a class="galleryItem" href="<?php echo esc_url($image_src[0]);?>" data-group="grid" title=""><img class="group list-group-image" src="<?php echo esc_url($image_src[0]);?>" alt="<?php echo $tes_title;?>" style="min-height: 450px;" /></a>
	            </div>
	        </div>
	    <?php }?>
	    <div class="poup-galler-sticon-gallery gallery-st-popup">
	    	<svg>
			  <circle id='gallery_shape' cx='64' cy='64' r='32' stroke-dasharray='1000' stroke-dashoffset='1000'/>
			</svg>
	    </div>
	    <div class="poup-galler-sticon-gallery gallery-st-popup">
	    	<img src="<?php echo get_template_directory_uri().'/v2/images/assets/ico_gallery.svg';?>" alt="">
	    </div>
	    
    </div>
    
    <script type="text/javascript">
    	jQuery(document).ready(function($) {
    		$('.poup-galler-sticon-gallery.gallery-st-popup').click(function(){
    			$('.poup-galler-st .bg-icon-st .list-group-image').click();
    		});

    		var groups = {};
			$('.list-group.st-gallery-grid .item').each(function() {
			    var id = parseInt($(this).attr('data-group'), 10);
				if(!groups[id]) {
			    	groups[id] = [];
				} 
			  
				groups[id].push( this );
			});


			$.each(groups, function() {
			  
			  $(this).find(".galleryItem").magnificPopup({
			      type: 'image',
			      closeOnContentClick: true,
			      closeBtnInside: false,
			      gallery: { enabled:true }
			  })
			});
			var shape = document.getElementById('gallery_shape');
			setTimeout(function () {
			  shape.setAttribute('stroke-dashoffset', 0);
			  jQuery('#gallery_shape').addClass('st-opacity');
			}, 0);
	    });
    </script>



