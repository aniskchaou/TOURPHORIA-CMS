<?php 
    // default : list
    // for activity list related from 1.1.7
?>
<ul class='activity_list booking-list'>
    <?php 
    while(have_posts()):
        the_post();
       
        ?>
        <li class="item-nearby post-1616 st_activity type-st_activity status-publish has-post-thumbnail hentry st_activity_type-city-trips st_activity_type-ecoactivityism st_activity_type-escorted-activity st_activity_type-group-activity st_activity_type-ligula">
            <?php echo STFeatured::get_featured(); ?>
            <div class="booking-item booking-item-small st_avatar_service">
                <div class="row">
                    <div class="col-xs-4">
                        <a class="hover-img" href="<?php the_permalink()?>">
                            <?php 
                            if(has_post_thumbnail() and get_the_post_thumbnail()){
                                the_post_thumbnail(array(120,90), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));
                            }else{
                                echo st_get_default_image();
                            }
                            ?>
                        </a>
                        <?php echo st_get_avatar_in_list_service(get_the_ID(),35); ?>
                    </div>
                    <div class="col-xs-4">
                        <h5 class="booking-item-title"><a href="<?php echo get_permalink();?>"><?php the_title();?></a> </h5>
                        <ul class="icon-group booking-item-rating-stars">
                            <?php echo TravelHelper::rate_to_string(STReview::get_avg_rate());?>                      
                        </ul>
                    </div>
                    <div class="col-xs-4">
                        <span class="booking-item-price-from"><?php _e('from','traveler') ?></span>
                        <div>
                            <?php if(!empty($is_sale)){ ?>
                                <span class="text-small lh1em  onsale">
                                                <?php echo TravelHelper::format_money( $price )?>
                                            </span>
                                <i class="fa fa-long-arrow-right"></i>
                            <?php } ?>
                            <span class="text-lg lh1em text-color">
                               <?php echo STActivity::get_price_html(get_the_ID(),false,'<br>',FALSE,TRUE); ?>
                           </span>
                        </div>
                        <?php if(!empty( $count_sale )) { ?>
                            <?php echo STFeatured::get_sale($count_sale); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
    endwhile;
    ?>
    
</ul>