<?php
if(!class_exists('STHotel')) return;
$room_id = $rs->post_id;
$hotel_id = $rs->room_parent;

$date1  = date(TravelHelper::getDateFormat(), $date);
$check_in = date('Y-m-d', $date);
$check_out = date("Y-m-d", strtotime("+1 day", $date));

$price = STPrice::getRoomPriceOnlyCustomPrice($room_id, strtotime($check_in), strtotime($check_out), 1);
$price = $price * (1 - $rs->discount_rate / 100);

$price = TravelHelper::format_money($price);

$view_star_review = st()->get_option('view_star_review', 'review');
if($view_star_review == 'review') :
    $html_review=' <ul class="icon-list list-inline-block mb0 last-minute-rating">
                            '.TravelHelper::rate_to_string(STReview::get_avg_rate($hotel_id)).'
                        </ul>';
elseif($view_star_review == 'star'):
    $html_review='<ul class="icon-list list-inline-block mb0 last-minute-rating">';
    $star = ( $hotel_id ) ? STHotel::getStar($hotel_id) : 0;
    $html_review.=TravelHelper::rate_to_string($star);
    $html_review.='</ul>';
endif;
?>
<div class="text-center text-white">
    <h2 class="text-uc mb20"><?php _e("Last Minute Deal",ST_TEXTDOMAIN) ?></h2>
    <?php echo balanceTags($html_review) ?>
    <h5 class="last-minute-title"><?php if( $hotel_id ) echo get_the_title($hotel_id) . ' - '; ?> <?php echo get_the_title($room_id) ?> </h5>
    <p class="last-minute-date"><?php echo esc_html($date1) ?></p>
    <p class="mb20">
        <b>
        <?php
            ?>
            <?php printf(__("from %s / night",ST_TEXTDOMAIN),$price) ?>
        <?php
        ?>
        </b>
    </p>
    <a class="btn btn-lg btn-white btn-ghost" href="<?php if( $hotel_id ) echo get_the_permalink($hotel_id); else  echo get_the_permalink($room_id);?>">
        <?php _e("Book now",ST_TEXTDOMAIN) ?>
        <i class="fa fa-angle-right"></i>
    </a>
</div>