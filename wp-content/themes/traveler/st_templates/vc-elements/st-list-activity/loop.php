<div class="row row-wrap">
   <?php
   while(have_posts()):
       the_post();
        if (!$st_of_row){$st_of_row = 4; }
       $col = 12 / $st_of_row;

       $info_price = STActivity::get_info_price();

   ?>
   <div class="col-md-<?php echo esc_attr($col) ?> col-sm-6 col-xs-12 list_tour style_box st_lazy_load">
       <?php echo STFeatured::get_featured(); ?>
       <div class="thumb">
           <?php if(!empty( $info_price['discount'] ) and $info_price['discount']>0 and $info_price['price_new'] >0) { ?>
               <?php STFeatured::get_sale($info_price['discount']) ; ?>
           <?php } ?>
           <header class="thumb-header">
               <a href="<?php the_permalink() ?>" class="hover-img">
                   <?php
                   /*$img = get_the_post_thumbnail( get_the_ID() , array(220,160,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
                   if(!empty($img)){
                       echo balanceTags($img);
                   }else{
                       echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                   }*/
                        TravelHelper::getLazyLoadingImage(array(220,160,'bfi_thumb'=>true));
                   ?>
                   <h5 class="hover-title-center"><?php esc_html_e('Book Now','traveler') ?></h5>
               </a>
               <?php echo st_get_avatar_in_list_service(get_the_ID(),35)?>
           </header>
           <div class="thumb-caption">
               <ul class="icon-group text-tiny text-color">
                   <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
               </ul>
               <h5 class="thumb-title">
                   <a href="<?php the_permalink() ?>" class="text-darken">
                       <?php the_title(); ?>
                   </a>
               </h5>

                       <?php $address = get_post_meta(get_the_ID(),'address',true); ?>
                       <?php
                       if(!empty($address)){
                           echo '<p class="mb0">
									   <small><i class="fa fa-map-marker"></i>';
											   echo esc_html($address);
											   echo '
									   </small>
								   </p>';
                       }
                       ?>
               <p class="mb0 text-darken">
                   <span class="text-lg lh1em text-color">
                       <?php echo STActivity::get_price_html(get_the_ID(),false,'<br>',FALSE,true); ?>
                   </span>
               </p>
           </div>
       </div>
   </div>
   <?php
   endwhile;
   ?>
</div>
