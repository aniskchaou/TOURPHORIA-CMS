<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel nearby
 *
 * Created by ShineTheme
 *
 */
extract($attr);
$hotel=new STHotel();
$nearby_posts=$hotel->get_near_by();
if($style == 'style-2'){
    $nearby_posts = $hotel->get_near_by(get_the_ID(), 20, 3);
    if($nearby_posts and !empty($nearby_posts)) {
        if(empty($attr['font_size'])) $attr['font_size']='3';
        if(!empty($attr['title'])){
            ?>
            <h<?php echo esc_attr($attr['font_size']) ?> class="text-center"><?php echo esc_html($attr['title']); ?>
                <span class="title_bol"><?php echo the_title(); ?></span>
            </h<?php echo esc_attr($attr['font_size']) ?>><br>
            <?php
        }
        global $post;
        echo '<div class="list_tours"><div class="row row-wrap">';
        foreach($nearby_posts as $key=>$post)
        {
            setup_postdata($post);
            $info_price = STPrice::get_info_price();
            ?>
            <div class="col-md-4 style_box col-sm-6 col-xs-12 st_fix_3_col st_lazy_load">
                <div class="hotel-item-1">
                    <div class="thumb-header">
                        <?php echo STFeatured::get_featured(); ?>
                        <a href="<?php echo get_the_permalink(); ?>">
                            <?php
                                //the_post_thumbnail(array(420,300), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( ))))
                                TravelHelper::getLazyLoadingImage(array(420,300));
                            ?>
                        </a>
                        <?php if(!empty( $info_price[ 'discount' ] ) and $info_price[ 'discount' ] > 0 and $info_price[ 'price_new' ] > 0) { ?>
                            <?php echo STFeatured::get_sale( $info_price[ 'discount' ] ); ?>
                        <?php } ?>
                    </div>
                    <div class="caption-content ">
                        <h3 class="title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title()?></a></h3>
                        <ul class="review-stars-2">
                            <?php
                            $avg = STReview::get_avg_rate();
                            echo TravelHelper::rate_to_string($avg);
                            ?>
                        </ul>
                        <p class="description">
                            <?php
                            $address = get_post_meta(get_the_ID(),'address',true);
                            if(!empty($address)) {
                                echo '<p class="address"><i class="fa fa-map-marker"></i> ' . $address . '</p>';
                            }
                            ?>
                        </p>
                        <p class=""></p>
                        <?php
                        $count_review = STReview::count_comment(get_the_ID());
                        if($count_review > 0){
                            ?>
                            <div class="review">
                                <ul class="review-stars">
                                    <?php
                                    $avg = STReview::get_avg_rate();
                                    echo TravelHelper::rate_to_string($avg);
                                    ?>
                                </ul>
                                <span class="count">
                                <?php echo sprintf(_n(esc_html__('%d review', ST_TEXTDOMAIN),esc_html__('%d reviews', ST_TEXTDOMAIN),$count_review), $count_review); ?>
                            </span>
                            </div>
                        <?php } ?>
                        <span class="price">
                            <p class="mb0 text-darken">
                                <small>
                                   <?php if(STHotel::is_show_min_price()):
                                       $price = HotelHelper::get_minimum_price_hotel(get_the_ID());
                                       ?>
                                       <?php _e("from", ST_TEXTDOMAIN) ?>
                                   <?php else:
                                       $price = HotelHelper::get_avg_price_hotel(get_the_ID());
                                       ?>
                                       <?php _e("avg", ST_TEXTDOMAIN) ?>
                                   <?php endif;?>
                                </small>
                				<span class="text-lg lh1em"><?php echo TravelHelper::format_money($price) ?></span>
                            </p>
                        </span>
                        <a class="btn btn-primary btn-normal book-now" href="<?php echo get_the_permalink(); ?>"><?php echo esc_html__('Book Now', ST_TEXTDOMAIN); ?></a>
                    </div>
                </div>
            </div>

            <?php
        }
        echo '</div></div>';
    }
}else{
    if($nearby_posts and !empty($nearby_posts))
    {
        if(empty($attr['font_size'])) $attr['font_size']='3';
        if(!empty($attr['title'])){
            ?>
            <h<?php echo esc_attr($attr['font_size']) ?>><?php echo esc_html($attr['title']); ?>
                <span class="title_bol"><?php echo the_title(); ?></span>
            </h<?php echo esc_attr($attr['font_size']) ?>>
            <?php
        }
        global $post;
        echo "<ul class='booking-list'>";
        foreach($nearby_posts as $key=>$post)
        {
            setup_postdata($post);
            ?>
            <li <?php post_class('item-nearby st_lazy_load')?>>
                <div class="bookinst_save_attributeg-item booking-item booking-item-small">
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="<?php the_permalink()?>">
                                <?php
                                    //the_post_thumbnail(array(67,67), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() ))))
                                    TravelHelper::getLazyLoadingImage(array(67,67));
                                ?>

                            </a>
                        </div>
                        <div class="col-xs-5">
                            <h5 class="booking-item-title"><a href="<?php the_permalink()?>"><?php the_title()?></a> </h5>

                            <?php
                            $view_star_review = st()->get_option('view_star_review', 'review');
                            if($view_star_review == 'review') :
                                ?>
                                <ul class="icon-group booking-item-rating-stars">
                                    <?php
                                    $avg = STReview::get_avg_rate();
                                    echo TravelHelper::rate_to_string($avg);
                                    ?>
                                </ul>
                            <?php elseif($view_star_review == 'star'): ?>
                                <ul class="icon-group booking-item-rating-stars hotel-star">
                                    <?php
                                    $star = STHotel::getStar();
                                    echo  TravelHelper::rate_to_string($star);
                                    ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-3">
                            <?php if(STHotel::is_show_min_price()):
                                $price = HotelHelper::get_minimum_price_hotel(get_the_ID());
                                ?>
                                <span class="booking-item-price-from"><?php _e("from", ST_TEXTDOMAIN) ?></span>
                            <?php else:
                                $price = HotelHelper::get_avg_price_hotel(get_the_ID());
                                ?>
                                <span class="booking-item-price-from"><?php _e("avg", ST_TEXTDOMAIN) ?></span>
                            <?php endif;?>
                            <span
                                class="booking-item-price"><?php echo TravelHelper::format_money($price) ?></span><span>/<?php echo __('night', ST_TEXTDOMAIN); ?></span>

                            <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
                                <?php if(!empty($count_sale)){ ?>
                                    <?php STFeatured::get_sale($count_sale) ; ?>
                                <?php } ?>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </li> 
            <?php
        }
        echo "</ul>";
        wp_reset_query();
        wp_reset_postdata();
    }
}
