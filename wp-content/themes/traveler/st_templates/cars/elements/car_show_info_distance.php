<?php //wp_enqueue_script( 'detailed-map' ); ?>
<?php
$unit   = st()->get_option( 'cars_price_unit' , 'day' );
if($unit == "distance"){

$location_id_pick_up = STInput::request('location_id_pick_up');
$location_id_drop_off = STInput::request('location_id_drop_off');

$lat_pick_up = get_post_meta($location_id_pick_up,'map_lat',true);
$lng_pick_up = get_post_meta($location_id_pick_up,'map_lng',true);

$lat_drop_off = get_post_meta($location_id_drop_off,'map_lat',true);
$lng_drop_off = get_post_meta($location_id_drop_off,'map_lng',true);
    ?>
    <?php if(!empty($lat_pick_up) and !empty($lng_pick_up) and !empty($lat_drop_off) and !empty($lng_drop_off) ){ ?>
        <div id="car_show_info_distance" style="height: 300px;"
             data-origin-lat="<?php echo esc_attr($lat_pick_up) ?>"
             data-origin-lng="<?php echo esc_attr($lng_pick_up) ?>"
             data-destination-lat="<?php echo esc_attr($lat_drop_off) ?>"
             data-destination-lng="<?php echo esc_attr($lng_drop_off) ?>"
             class="gmap3 ">
        </div>
    <?php } ?>

<?php } ?>