<div class="row row-wrap">
   <?php
   $tours = new STTour();
   while(have_posts()):
       the_post();
       if(intval($st_tour_of_row) <= 0 ) $st_tour_of_row =4;
       $col = 12 / $st_tour_of_row;
       $info_price = STTour::get_info_price();
   ?>
       <div class="col-md-<?php echo esc_attr($col) ?> style_box col-sm-6 col-xs-12 st_fix_<?php echo esc_attr($st_tour_of_row); ?>_col st_lazy_load">
           <?php echo STFeatured::get_featured(); ?>
           <div class="thumb">
               <header class="thumb-header st_avatar_fix">
                   <?php if(!empty( $info_price['discount'] ) and $info_price['discount']>0 and $info_price['price_new'] >0) { ?>
                       <?php echo STFeatured::get_sale($info_price['discount']); ?>
                   <?php } ?>
                   <a href="<?php the_permalink() ?>" class="hover-img">
                       <?php
                       /*$img = get_the_post_thumbnail( get_the_ID() , array(260,190,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( )))) ;
                       if(!empty($img)){
                           echo balanceTags($img);
                       }else{
                           echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(ST_TRAVELER_URI.'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                       }*/
                       TravelHelper::getLazyLoadingImage(array(260,190,'bfi_thumb'=>true));
                       ?>
                       <h5 class="hover-title hover-hold">
                           <?php the_title(); ?>
                       </h5>
                   </a>
                   <?php
                   echo st_get_avatar_in_list_service(get_the_ID(),35);
                   ?>
               </header>
               <div class="thumb-caption">
                   <div class="row mt10">
                           <?php $address = get_post_meta(get_the_ID(),'address',true); ?>
                           <?php
                           if(!empty($address)){
                               echo ' <div class="col-md-5 col-sm-5 col-xs-5">';
                               echo '<i class="fa fa-map-marker"></i> ';
                               echo esc_html($address);
                               echo '</div>';
                           }
                           ?>

                       <div class="col-md-7 col-sm-7 col-xs-7 <?php if($address)echo 'text-right'; ?>">
                           <div class="package-info">
                               <?php
                               $type_tour = get_post_meta(get_the_ID() , 'type_tour' ,true);
                               if($type_tour == 'daily_tour'){
                                  
                                   $day = STTour::get_duration_unit();
                                   echo ' <i class="fa fa-calendar"></i> '.esc_html($day);
                                   
                               }else{
                                   $check_in = get_post_meta(get_the_ID() , 'check_in' ,true);
                                   $check_out = get_post_meta(get_the_ID() , 'check_out' ,true);
                                   if(!empty($check_in) and !empty($check_out)){
                                       $format=TravelHelper::getDateFormat();
                                       $date = date_i18n($format,strtotime($check_in)).' <i class="fa fa-long-arrow-right"></i> '.date_i18n($format,strtotime($check_out));
									   echo ' <i class="fa fa-calendar"></i> '. balanceTags($date);
                                   }
                               }

                               ?>
                           </div>
                       </div>
                   </div>
                   <div class="row mt10">
                       <?php if($price_html=STTour::get_price_html(false,false,' <br> -')){?>
                       <div class="col-md-6 col-sm-6 col-xs-6">
                           <p class="mb0 text-darken">
                               <i class="fa fa-money"></i>
                               <?php echo ($price_html) ?>
                           </p>
                       </div>
                       <?php }?>
                       <div class="col-md-6 col-sm-6 col-xs-6 <?php if(!empty($price_html))echo 'text-right'; ?>">
                           <ul class="icon-group  text-color pull-right">
                               <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
                           </ul>

                       </div>
                   </div>
               </div>
           </div>
       </div>
   <?php
   endwhile;
   ?>
</div>
