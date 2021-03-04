<?php
$post_id = $rs->ID;
if($rs->is_sale_schedule == 'off'){
    $date  = date(TravelHelper::getDateFormat(), strtotime('+1 day'));
}else {
    $date = date_i18n(TravelHelper::getDateFormat(), strtotime($rs->sale_price_from)) . " - " . date_i18n(TravelHelper::getDateFormat(), strtotime($rs->sale_price_to));
}
$prices = STActivity::get_price_person( $post_id );
if(!empty($prices['adult'])){
    $price_new = $prices['adult'];
}elseif(!empty($prices['child'])){
    $price_new = $prices['child'];
}elseif(!empty($prices['infant'])){
    $price_new = $prices['infant'];
}

$discount         = $rs->discount_rate;
if($discount) {
    if($discount > 100)
        $discount = 100;
    $price_new = $price_new - ( $price_new / 100 ) * $discount;
}
$price_new = TravelHelper::format_money($price_new);
?>
<div class="text-center text-white">
    <h2 class="text-uc mb20"><?php _e("Last Minute Deal",ST_TEXTDOMAIN) ?></h2>
    <ul class="icon-list list-inline-block mb0 last-minute-rating">
        <?php echo balanceTags(TravelHelper::rate_to_string(STReview::get_avg_rate($post_id))) ?>
    </ul>
    <h5 class="last-minute-title"><?php echo get_the_title($post_id) ?></h5>
    <p class="last-minute-date"><?php echo esc_html($date) ?></p>
    <p class="mb20">
        <b><?php printf(__('From %s',ST_TEXTDOMAIN),$price_new) ?></b>
    </p>
    <a class="btn btn-lg btn-white btn-ghost" href="<?php echo get_the_permalink($post_id) ?>">
        <?php _e("Book now",ST_TEXTDOMAIN) ?>
        <i class="fa fa-angle-right"></i>
    </a>
</div>