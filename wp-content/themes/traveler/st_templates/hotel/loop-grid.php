<?php
global $post;
$link = st_get_link_with_search(get_permalink(), array('start', 'end', 'room_num_search', 'adult_number'), $_GET);
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
    
if(!isset($taxonomy)){
    $taxonomy = '';
}
?>
<div class="col-md-4">
    <?php echo STFeatured::get_featured(); ?>
    <div class="thumb">
        <?php if($discount_text=get_post_meta(get_the_ID(),'discount_text',true)){ ?>
            <?php if(!empty($count_sale)){ ?>
                <?php STFeatured::get_sale($count_sale) ; ?>
            <?php } ?>
        <?php }?>
        <header class="thumb-header">
            <a class="hover-img" href="<?php echo esc_url($link)?>">

                <?php if (has_post_thumbnail() and get_the_post_thumbnail()) {
                    the_post_thumbnail(array(360, 270), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id( get_the_ID() ))));
                }else {echo st_get_default_image();} ?>
                <h5 class="hover-title-center"><?php st_the_language('book_now')?> </h5>
            </a>
            <?php
                echo st_get_avatar_in_list_service(get_the_ID(), 35);
            ?>
        </header>
        <div class="thumb-caption">
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
            <h5 class="thumb-title"><a class="text-darken"
                                       href="<?php echo esc_url($link)?>"><?php the_title()?></a></h5>
            <?php if ($address = get_post_meta(get_the_ID(), 'address', TRUE)): ?>
                <p class="mb0">
                    <small><i class="fa fa-map-marker"></i> <?php echo esc_html($address) ?></small>
                </p>
            <?php endif;?>
            <div class="text-darken">
                <?php echo st()->load_template( 'hotel/elements/attribute' , 'list' ,array("taxonomy"=>$taxonomy));?>
            </div>
            <p class="mb0 text-darken">
                <small>
                    <?php if(STHotel::is_show_min_price()): ?>
                        <?php _e("Price from", ST_TEXTDOMAIN) ?>
                    <?php else:?>
                        <?php _e("Price Avg", ST_TEXTDOMAIN) ?>
                    <?php endif;?>
                </small>
                <?php
                $price_by = get_post_meta(get_the_ID(), 'is_auto_caculate', true);
                if(empty($price_by))
                    $price_by = 'on';

                if($price_by == 'off'){
                    $price = isset($post->st_price_avg)?$post->st_price_avg:0;
                }else{
                    $price = isset($post->st_price)?$post->st_price:0;
                }
                ?>
				<span class="text-lg lh1em"><?php echo TravelHelper::format_money($price) ?></span>
            </p>
        </div>
    </div>
</div>