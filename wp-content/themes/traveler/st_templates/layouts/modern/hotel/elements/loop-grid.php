<?php
global $post;
?>
<div class="col-lg-4 col-md-4 col-sm-4 item-service">
    <div class="thumb">
        <div class="service-tag save">
            Bestseller
        </div>
        <a href="<?php echo get_the_permalink() ?>">
            <?php
            if(has_post_thumbnail()){
                the_post_thumbnail(array(450, 417), array('alt' => TravelHelper::get_alt_image(), 'class' => 'img-responsive'));
            }else{
                echo '<img src="'. get_template_directory_uri() . '/img/no-image.png' .'" alt="Default Thumbnail" class="img-responsive" />';
            }
            ?>
        </a>
        <?php
        $view_star_review = st()->get_option('view_star_review', 'review');
        if($view_star_review == 'review') :
            ?>
            <ul class="icon-group text-color">
                <?php
                $avg = STReview::get_avg_rate();
                echo TravelHelper::rate_to_string($avg);
                ?>
            </ul>
        <?php elseif($view_star_review == 'star'): ?>
            <ul class="icon-list icon-group booking-item-rating-stars">
                <span class="pull-left mr10"><?php echo __('Hotel star', ST_TEXTDOMAIN); ?></span>
                <?php
                $star = STHotel::getStar();
                echo  TravelHelper::rate_to_string($star);
                ?>
            </ul>
        <?php endif; ?>
    </div>
    <h4 class="service-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
    <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
        <p class="service-location"><i class="fa fa-map-marker"></i> <?php echo $address; ?></p>
    <?php endif;?>
    <div class="service-review">
        <?php
        $count_review = STReview::count_comment(get_the_ID());
        $avg = STReview::get_avg_rate();
        ?>
        <span class="rating"><?php echo $avg; ?>/5 <?php echo V2Hotel_Helper::getRatingText($avg); ?></span>
        <span class="st-dot"></span>
        <span class="review"><?php echo $count_review . ' ' . _n(esc_html__('Review', ST_TEXTDOMAIN),esc_html__('Reviews', ST_TEXTDOMAIN),$count_review); ?></span>
    </div>
    <div class="service-price">
        <span>
            <?php if(STHotel::is_show_min_price()): ?>
                <?php _e("Price from", ST_TEXTDOMAIN) ?>
            <?php else:?>
                <?php _e("Price Avg", ST_TEXTDOMAIN) ?>
            <?php endif;?>
        </span>
        <span class="price">
            <?php
            $price = isset($post->st_price)?$post->st_price:0;
            echo TravelHelper::format_money($price);
            ?>
        </span>
        <span><?php echo __('/night', ST_TEXTDOMAIN); ?></span>
    </div>
</div>