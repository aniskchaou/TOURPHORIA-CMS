<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/25/14
 * Time: 10:12 AM
 */

echo '<div class="row row-wrap">';
while(have_posts())
{
    the_post();

    $col = 12 / $st_ht_of_row;
    $hotel=new STHotel(get_the_ID());
    ?>
        <div class="col-md-<?php echo esc_attr($col)?> col-sm-6 style_box st_lazy_load">
            <?php echo STFeatured::get_featured(); ?>
            <div class="thumb">
                <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
                    <?php if(!empty($count_sale)){ ?>
                        <?php STFeatured::get_sale($count_sale) ; ?>
                    <?php } ?>
                <?php }?>
                <a class="hover-img" href="<?php the_permalink()?>">
                    <?php //the_post_thumbnail(array(400,300,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))));?>
	                <?php TravelHelper::getLazyLoadingImage(array(400,300,'bfi_thumb'=>true)); ?>
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5><?php the_title()?></h5>
                            <p><?php comments_number(__('no review',ST_TEXTDOMAIN),__('1 review',ST_TEXTDOMAIN),__('% reviews',ST_TEXTDOMAIN))  ?></p>
                            <?php
                            $count_offer=100;
                            $count_offer=$hotel->count_offers(get_the_ID());
                            if($count_offer):
                                $min_price=STHotel::get_avg_price(get_the_ID());
                            ?>
                                <p class="mb0"><?php
                                    if($count_offer==1){
                                        printf(__('%s offer',ST_TEXTDOMAIN),$count_offer);
                                    }else{
                                        printf(__('%s offers',ST_TEXTDOMAIN),$count_offer);
                                    }

                                    $price = STHotel::get_price();
                                    if(STHotel::is_show_min_price()){
                                        printf(__(' price from %s',ST_TEXTDOMAIN),TravelHelper::format_money($price));
                                    }else{
                                        printf(__(' price avg %s',ST_TEXTDOMAIN),TravelHelper::format_money($price));
                                    }

                                    ?></p>
                            <?php endif;?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php
}
echo "</div>";