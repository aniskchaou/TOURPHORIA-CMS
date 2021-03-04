<?php extract(shortcode_atts(array(
    'style_gallery'          => '',
    'images_gallery'      => '',
    'colums_gallery'      => '',
  ), $attr));
if($colums_gallery === '1-colum'){
	$class= "col-lg-12 col-md-12 col-sm-12 col-xs-12";
}elseif($colums_gallery === '2-colum'){
	$class= "col-lg-6 col-md-6 col-sm-6 col-xs-12";
}elseif($colums_gallery === '3-colum'){
	$class= "col-lg-4 col-md-4 col-sm-4 col-xs-12";
}
elseif($colums_gallery === '4-colum'){
	$class= "col-lg-3 col-md-3 col-sm-3 col-xs-12";
}elseif($colums_gallery === '5-colum'){
	$class= "col-5 col-xs-12";
}else {
	$class= "col-lg-4 col-md-4 col-sm-4 col-xs-12";
}
$img_ids = explode(",",$images_gallery);

if($style_gallery === 'slider'){ ?>
	<div  class="list-group-slider">
        <div class="carousel carousel-main" data-flickity='{ "prevNextButtons":false,"wrapAround": true, "pageDots": true , "autoPlay":true }'>
    	<?php
		    foreach( $img_ids as $count=>$im_id ){
		      $image_src = wp_get_attachment_image_src($im_id,'');
		      $meta = wp_prepare_attachment_for_js($im_id);
		      $tes_title=$meta['title'];
		      $tes_caption=$meta['caption'];?>
	        <div class="carousel-cell <?php if( $count == 1){?> active <?php }?>">
	            <a class="galleryItem" href="<?php echo esc_url($image_src[0]);?>" data-group="slider"> <img class="group list-group-image" src="<?php echo esc_url($image_src[0]);?>" alt="<?php echo $tes_title;?>" /></a>
	        </div>
	    <?php }?>
		</div>
		<button class="st-arrow carousel--prev"><img src="<?php echo get_template_directory_uri();?>/v2/images/svg/ico_pre_1.svg" alt=""></button>
		<button class="st-arrow carousel--next"><img src="<?php echo get_template_directory_uri();?>/v2/images/svg/ico_next_1.svg" alt=""></button>
    </div>

    <script type="text/javascript">
    	jQuery(document).ready(function($) {
			$('.carousel--prev').on( 'click', function() {
			 	$('.carousel-main').flickity('previous');
			});

			$('.carousel--next').on( 'click', function() {
			 	$('.carousel-main').flickity('next');
			});

			// var groups_slider = {};
			// 	$('.list-group-slider .carousel-cell').each(function() {
			// 	  var id_sl = parseInt($(this).attr('data-group'), 10);
				  
			// 	    if(!groups_slider[id_sl]) {
			// 	        groups_slider[id_sl] = [];
			// 	    } 
				  
			// 	  groups_slider[id_sl].push( this );
			// 	});


			// 	$.each(groups_slider, function() {
			// 	    $(this).find(".galleryItem").magnificPopup({
			// 	        type: 'image',
			// 	        closeOnContentClick: true,
			// 	        closeBtnInside: false,
			// 	        gallery: { enabled:true }
			// 	  })
			// 	});
	    });
    </script>
	<?php } elseif($style_gallery === 'masonry'){ ?>
		<div class="list-group  st-gallery-masonry">
			<div class="grid">
				<?php
				    foreach( $img_ids as $count=>$im_id ){
				      $image_src = wp_get_attachment_image_src($im_id,'');
				      $meta = wp_prepare_attachment_for_js($im_id);
				      $tes_title=$meta['title'];
				      $tes_caption=$meta['caption'];?>
				     <div class="grid-item <?php echo esc_attr($class);?>">
				        <div class="image-masony">
				        	<a class="galleryItem" href="<?php echo esc_url($image_src[0]);?>" data-group="masonry" title=""><img class="group list-group-image" src="<?php echo esc_url($image_src[0]);?>" alt="<?php echo $tes_title;?>" /></a>
				        </div>
				    </div>
			    <?php }?>
			    
			</div>
	    </div>
	    <script type="text/javascript">
	    	jQuery(document).ready(function($) {
	    		var $grid = $('.st-gallery-masonry .grid').masonry({
				itemSelector: '.grid-item',
				percentPosition: true,
				});
				// layout Masonry after each image loads
				$grid.imagesLoaded().progress( function() {
				$grid.masonry();
				}); 


				var groups_masonry = {};
				$('.list-group.st-gallery-masonry .grid-item').each(function() {
				  var id_masonry = parseInt($(this).attr('data-group'), 10);
				  
				    if(!groups_masonry[id_masonry]) {
				        groups_masonry[id_masonry] = [];
				    } 
				  
				  groups_masonry[id_masonry].push( this );
				});


				$.each(groups_masonry, function() {
				    $(this).find(".galleryItem").magnificPopup({
				        type: 'image',
				        closeOnContentClick: true,
				        closeBtnInside: false,
				        gallery: { enabled:true }
				  })
				});
		    	
		    });
	    </script>
	<?php } else { ?>

	    <div class="row list-group  st-gallery-grid">
	    	<?php
			    foreach( $img_ids as $count=>$im_id ){
			      $image_src = wp_get_attachment_image_src($im_id,'');
			      $meta = wp_prepare_attachment_for_js($im_id);
			      $tes_title=$meta['title'];
			      $tes_caption=$meta['caption'];
			?>
		        <div class="item  <?php echo esc_attr($class);?>">
		            <div class="thumbnail">
		                <a class="galleryItem" href="<?php echo esc_url($image_src[0]);?>" data-group="grid" title=""><img class="group list-group-image" src="<?php echo esc_url($image_src[0]);?>" alt="<?php echo $tes_title;?>" /></a>
		            </div>
		        </div>
		    <?php }?>
	    </div>
	    <script type="text/javascript">
	    	jQuery(document).ready(function($) {
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
		    	
		    });
	    </script>
<?php }
?>
