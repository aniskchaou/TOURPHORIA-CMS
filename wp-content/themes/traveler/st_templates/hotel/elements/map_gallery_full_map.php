<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 5/29/2017
 * Version: 1.0
 */
wp_enqueue_script( 'owl-carousel.js' );
wp_enqueue_script( 'richmarker.jquery' );
wp_enqueue_style( 'weather-icons.css' );
if(empty($num_image)){
    $num_image = 3;
}

$new_gallery = array();
if(has_post_thumbnail()){
    $new_gallery[] = get_the_post_thumbnail_url(get_the_ID(),'full');
}

$tour_gallery = get_post_meta(get_the_ID(), 'gallery', true);

if(!empty($tour_gallery)){
    $ids = explode(',',$tour_gallery);
    for ($i = 0; $i < ((int)$num_image - 1); $i++) {
        if (!empty($ids[$i])) {
            $img = wp_get_attachment_image_src($ids[$i], 'full');
            if (!empty($img[0])) {
                $new_gallery[] = $img[0];
            }
        }
    }
}
?>
<div class="st-gallery-map st-full-height">
    <div class="st-tour-gallery">
        <div class="tour-gallery owl-carousel">
            <?php
            foreach ($new_gallery as $key => $val) {
                $bg = Assets::build_css('background: #ccc url('.esc_url($val).') center no-repeat');
                ?>
                <div class="item <?php echo esc_attr($bg); ?> st-full-height">
                </div>
            <?php } ?>
        </div>
        <div class="caption-star tour">
            <?php
            $tour_weather = TravelHelper::get_location_temp();
            if(!empty($tour_weather)){
                $temp_format = st()->get_option('st_weather_temp_unit','c');
                ?>
                <div class="weather">
                    <div class="w-detail">
                        <span class="icon"><?php echo do_shortcode($tour_weather['icon']) ?></span>
                        <span class="temp"><?php echo balanceTags($tour_weather['temp']) ?><sup>o</sup><span><?php echo esc_attr($temp_format); ?></span></span>
                    </div>
                </div>
            <?php } ?>
            <h4 class="location"><?php echo TravelHelper::locationHtml(get_the_ID()); ?></h4>
            <h1 class="service-title"><?php the_title(); ?></h1>
        </div>
        <div class="owl-prev owl-control"><i class="fa fa-angle-left"></i></div>
        <div class="owl-next owl-control"><i class="fa fa-angle-right"></i></div>
    </div>
    <div class="on_the_map">
        <a class="btn-on-map" data-hide="<?php echo esc_html__('Hide Map', ST_TEXTDOMAIN); ?>" data-no-hide="<?php echo esc_html__('On The Map', ST_TEXTDOMAIN)?>"><?php echo esc_html__('On The Map', ST_TEXTDOMAIN); ?></a>
    </div>
    <div class="review-price">
        <?php
        $count_review = STReview::count_comment(get_the_ID());
        if($count_review > 0){
            ?>
            <span class="review">
            <span>
                <span><?php echo _n(esc_html__('Review', ST_TEXTDOMAIN),esc_html__('Reviews', ST_TEXTDOMAIN),$count_review); ?></span>
                <?php echo esc_attr($count_review); ?></span>
        </span>
            <ul class="review-stars">
                <?php
                $avg = STReview::get_avg_rate();
                echo TravelHelper::rate_to_string($avg, $count_review);
                ?>
            </ul>
        <?php } ?>
        <span class="price">
            <?php
            $price = STHotel::get_price();
            if (STHotel::is_show_min_price()) {
                echo esc_html__('Price from ', ST_TEXTDOMAIN);
            }else{
                echo esc_html__('Price avg ', ST_TEXTDOMAIN);
            }
            echo '<strong>' . TravelHelper::format_money($price) . '</strong>';
            echo '<span class="unit">' . esc_html__(' / night', ST_TEXTDOMAIN) . '</span>';
            ?>
        </span>
    </div>
    <div class="st-tour-map st-hide">
        <?php
        $lat = get_post_meta(get_the_ID(),'map_lat', true);
        $lng = get_post_meta(get_the_ID(),'map_lng', true);
        $zoom = get_post_meta(get_the_ID(),'map_zoom', true);
        if(empty($zoom)){
            $zoom = 12;
        }

        if(!empty($lat) && !empty($lng)) {
            $location_center = array(
                'lat' => $lat,
                'lng' => $lng,
                'zoom' => $zoom
            );
        }

        $marker_data = array(
            'thumb' => get_the_post_thumbnail_url(get_the_ID(),array(300,200)),
            'title' => get_the_title(),
            'in' => TravelHelper::locationHtml(get_the_ID())
        );
        ?>
        <div id="st-tour-map-new" data-style="<?php echo esc_attr($map_style); ?>" data-autoload_map="0" data-marker-data='<?php echo json_encode($marker_data); ?>' data-location='<?php echo json_encode($location_center)?>'></div>
        <div class="zoom-control">
            <a href="#" class="my-location"><i class="fa fa-location-arrow"></i></a>
            <a href="#" class="zoom-in"><i class="fa fa-plus"></i></a>
            <a href="#" class="zoom-out"><i class="fa fa-minus"></i></a>
        </div>
        <div class="view-control">
            <div class="oceaus-relative">
                <a class="full-screen" data-class="full-screen" href="#"><?php echo esc_html__('FULL SCREEN', ST_TEXTDOMAIN)?></a>
                <a class="exit-full-screen" data-class="exit-full-screen" href="#"><?php echo esc_html__('DEFAULT',ST_TEXTDOMAIN)?></a>
                <a class="view" data-class="view" href="#"><?php echo esc_html__('VIEW',ST_TEXTDOMAIN); ?></a>
                <div class="map_type">
                    <span class="st-map-type1 st-type-1" data-map="style_normal"><?php echo esc_html__('Normal',ST_TEXTDOMAIN)?></span>
                    <span class="st-map-type1 st-type-2" data-map="style_midnight"><?php echo esc_html__('Midnight',ST_TEXTDOMAIN)?></span>
                    <span class="st-map-type1 st-type-3" data-map="style_icy_blue"><?php echo esc_html__('Icy Blue',ST_TEXTDOMAIN)?></span>
                    <span class="st-map-type1 st-type-4" data-map="style_family_fest"><?php echo esc_html__('Family Fest',ST_TEXTDOMAIN)?></span>
                    <span class="st-map-type1 st-type-5" data-map="style_open_dark"><?php echo esc_html__('Open Dark',ST_TEXTDOMAIN)?></span>
                    <span class="st-map-type1 st-type-6" data-map="style_riverside"><?php echo esc_html__('Riverside',ST_TEXTDOMAIN)?></span>
                    <span class="st-map-type1 st-type-7" data-map="style_ozan"><?php echo esc_html__('Ozan',ST_TEXTDOMAIN)?></span>
                </div>
            </div>
        </div>

    </div>
</div>
