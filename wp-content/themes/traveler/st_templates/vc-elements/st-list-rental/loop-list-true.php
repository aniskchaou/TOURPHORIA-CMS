<?php 
    // default : list
    // for rental list related from 1.1.7
?>
<ul class='renral_list booking-list'>
    <?php 
    while(have_posts()):
        the_post();

        $price=STRental::get_orgin_price();
        $is_sale=STRental::is_sale();
        $price_sale=STRental::get_price();
        if ($price){
            $count_sale = 100 - round($price_sale*100/$price) ;
        }

        ?>
        <li class="item-nearby post-1616 st_rental type-st_rental status-publish has-post-thumbnail hentry st_tour_type-city-trips st_tour_type-ecotourism st_tour_type-escorted-tour st_tour_type-group-tour st_tour_type-ligula">
            <?php echo STFeatured::get_featured(); ?>
            <div class="booking-item booking-item-small">
                <div class="row">
                    <div class="col-xs-4 st_avatar_service">
                        <a class="hover-img" href="<?php the_permalink()?>">
                            <?php 
                            if(has_post_thumbnail()){
                                the_post_thumbnail(array(400,300), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));
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
                        <span class="booking-item-price-from">from</span>                        
                        <div>
                            <?php if(!empty($is_sale)){ ?>
                                <span class="text-small lh1em  onsale">
                                                <?php echo TravelHelper::format_money( $price )?>
                                            </span>
                                <i class="fa fa-long-arrow-right"></i>
                            <?php } ?>
                            <?php
                            if(!empty($price)){
                                echo '<span class="text-darken mb0 text-color">'.TravelHelper::format_money($price_sale).'<small> /'.__('night',ST_TEXTDOMAIN).'</small></span>';
                            }
                            ?>
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