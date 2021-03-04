<?php
//wp_enqueue_script('magnific.js' );
global $post;

$link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number','children_num'), $_GET);
$hotel = new STHotel(get_the_ID());
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
$check_in = '';
$check_out = '';
if(!isset($_REQUEST['start']) || empty($_REQUEST['start'])){
    $check_in = date('m/d/Y', strtotime("now"));
}else{
    $check_in = TravelHelper::convertDateFormat(STInput::request('start'));
}

if(!isset($_REQUEST['end']) || empty($_REQUEST['end'])){
    $check_out = date('m/d/Y', strtotime("+1 day"));
}else{
    $check_out = TravelHelper::convertDateFormat(STInput::request('end'));
}
$numberday = STDate::dateDiff($check_in, $check_out);
?>
<li <?php post_class('booking-item') ?>>
    <?php echo STFeatured::get_featured(); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="booking-item-img-wrap st-popup-gallery">
                <a href="<?php echo esc_url($thumb_url) ?>" class="st-gp-item">
                    <?php if (has_post_thumbnail() and get_the_post_thumbnail()) {
                        the_post_thumbnail(array(360, 270), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID() ))));
                    }else {echo st_get_default_image();} ?>
                </a>
                <?php
                $count = 0;
                $gallery = get_post_meta(get_the_ID(), 'gallery', TRUE);

                $gallery = explode(',', $gallery);


                if (!empty($gallery) and $gallery[0]) {
                    $count += count($gallery);
                }

                if (has_post_thumbnail()) {
                    $count++;
                }


                if ($count) {
                    echo '<div class="booking-item-img-num"><i class="fa fa-picture-o"></i>';
                    echo esc_attr($count);
                    echo '</div>';
                }
                ?>
                <div class="hidden">
                    <?php if (!empty($gallery) and $gallery[0]) {
                        $count += count($gallery);
                        foreach ($gallery as $key => $value) {
                            $img_link = wp_get_attachment_image_src($value, array(800, 600, 'bfi_thumb' => TRUE));
                            if (isset($img_link[0]))
                                echo "<a class='st-gp-item' href='{$img_link[0]}'></a>";
                        }

                    } ?>
                </div>
                <?php
                echo st_get_avatar_in_list_service(get_the_ID(),35);
                ?>

            </div>
        </div>
        <div class="col-md-6">


            <div class="booking-item-rating">
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
                    <span
                        class="booking-item-rating-number"><b><?php echo esc_html($avg) ?></b> <?php st_the_language('of_5') ?></span>
                    <small>
                        (<?php comments_number(st_get_language('no_review'), st_get_language('1_review'), st_get_language('s_reviews')); ?>
                        )
                    </small>
                <?php elseif($view_star_review == 'star'): ?>
                    <ul class="icon-list icon-group booking-item-rating-stars">
                        <span class="pull-left mr10"><?php echo __('Hotel star', ST_TEXTDOMAIN); ?></span>
                        <?php
                        $star = STHotel::getStar();
                        echo  TravelHelper::rate_to_string($star);
                        ?>
                    </ul>
                    <span
                        class="booking-item-rating-number"><b><?php echo esc_html($star) ?></b> <?php st_the_language('of_5') ?></span>
                <?php endif; ?>

            </div>
            <a class="color-inherit" href="<?php echo esc_url($link) ?>">
                <h5 class="booking-item-title"><?php the_title() ?>

                </h5>
            </a>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                <p class="booking-item-address"><i
                        class="fa fa-map-marker"></i> <?php echo esc_html($address) ?>
                </p>
            <?php endif; ?>
            <?php if ($last_booking = $hotel->get_last_booking()): ?>
                <small
                    class="booking-item-last-booked"><?php echo st_get_language('lastest_booking') . ' ' . $last_booking ?></small>
            <?php endif; ?>

            <?php
            if(!empty($taxonomy)){
                echo st()->load_template( 'hotel/elements/attribute' , 'list' ,array("taxonomy"=>$taxonomy));
            }
            ?>

        </div>
        <div class="col-md-3">
            <?php
            $price_by = get_post_meta(get_the_ID(), 'is_auto_caculate', true);
            if(empty($price_by))
                $price_by = 'on';

            if($price_by == 'off'){
                $price = isset($post->st_price_avg)?$post->st_price_avg:0;
            }else{
                $price = isset($post->st_price)?$post->st_price:0;
            }
            if(STHotel::is_show_min_price()):
            ?>
                <span class="booking-item-price-from"><?php _e("Price from", ST_TEXTDOMAIN) ?></span>
            <?php else:
            ?>
                <span class="booking-item-price-from"><?php _e("Price Avg", ST_TEXTDOMAIN) ?></span>
            <?php endif;?>
                <span
                    class="booking-item-price"><?php echo TravelHelper::format_money($price) ?></span><span><!--/--><?php /*printf(__(' %d night(s)', ST_TEXTDOMAIN), $numberday); */?></span>
                <br>
                <a
                    class="btn btn-primary btn_book"
                    href="<?php echo esc_url($link) ?>"><?php st_the_language('book_now') ?></a>

            <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
                <?php if(!empty($count_sale)){ ?>
                    <?php STFeatured::get_sale($count_sale) ; ?>
                <?php } ?>
            <?php }?>
        </div>
    </div>
</li>