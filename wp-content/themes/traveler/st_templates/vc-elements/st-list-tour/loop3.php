<div class="row row-wrap">
    <?php
    while(have_posts()):
        the_post();
        if(intval($st_tour_of_row) <= 0 ) $st_tour_of_row =4;
        $col = 12 / $st_tour_of_row;

        $info_price = STTour::get_info_price();
        ?>
        <div class="col-md-<?php echo esc_attr($col) ?> style_box col-sm-6 col-xs-12 st_fix_<?php echo esc_attr($st_tour_of_row); ?>_col st_lazy_load">
            <?php echo STFeatured::get_featured(); ?>
            <div class="thumb">
                <header class="thumb-header">
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
                </header>
                <div class="thumb-caption">
                    <div class="row mt10">
                        <?php if($location=TravelHelper::locationHtml(get_the_ID())){ ?>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <i class="fa fa-location-arrow"></i>
                                <?php
                                echo ($location);
                                ?>
                            </div>
                        <?php }?>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <ul class="icon-group text-color pull-right">
                                <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
                            </ul>
                            <div class="pull-right"></div>
                        </div>
                    </div>
                    <div class="row mt10">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p class="mb0 text-darken">
                                <i class="fa fa-money"></i>
                                <?php echo STTour::get_price_html(false,false,' <br> -'); ?>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                           <a href="<?php the_permalink() ?>" type="button" class="btn btn-primary"><?php _e('Book Now',ST_TEXTDOMAIN) ?> <i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    endwhile;
    ?>

</div>