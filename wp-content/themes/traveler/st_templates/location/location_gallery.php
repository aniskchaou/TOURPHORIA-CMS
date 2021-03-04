<?php 
//wp_enqueue_script( 'fotorama.js' );
wp_enqueue_script('magnific.js' );

   $gallery_items = get_post_meta(get_the_ID() , 'st_gallery' , true);
   if (!$gallery_style = get_post_meta(get_the_ID() , 'location_gallery_style' , true )){$gallery_style = 1;}
   if (!$gallery_count = get_post_meta(get_the_ID() , 'image_count' , true)){$gallery_count = 6 ;} 


   $gallery_items = explode(",",$gallery_items );   

   // fotorama style 1 , 2
   if ($gallery_style ==1 || $gallery_style ==2 ){
?>
<!-- Start fotorama -->
   <div class="fotorama" 
      data-allowfullscreen="true"  
      data-width="100%"
       data-ratio="1200/600" 
       <?php if ($gallery_style == 1 ) { ?>data-nav="thumbs" <?php } ;?>>
<?php 
   

   if (is_array($gallery_items)  and !empty($gallery_items)){
      foreach ($gallery_items as $key => $value) {
         echo wp_get_attachment_image($value , 'full');
      }
   }
?>
</div>
<!-- End fotorama -->
<?php 
   }else{
      ?>
      <!-- Start gallery style 3 -->
      <div class="row row-no-gutter popup-gallery">
          <?php 
            if (is_array($gallery_items)  and !empty($gallery_items)){
               foreach ($gallery_items as $key => $value) {                  
                  ?>
                  <div class="col-xs-4 col-sm-4  col-md-<?php echo round(12/$gallery_count)?>">
                     <a class="hover-img popup-gallery-image" href="<?php echo wp_get_attachment_url($value , 'full') ?>" data-effect="mfp-zoom-out">
                           <?php 
                              echo wp_get_attachment_image($value , 'medium', false, array('alt' => TravelHelper::get_alt_image($value)));

                           ?>                           
                           <i class="fa fa-plus round box-icon-small hover-icon i round"></i>
                     </a>
                  </div>
                  <?php 
               }
            }
          ?>

      </div>
      <!-- End stage -->
<?php 
   }  
   
?>
      
   