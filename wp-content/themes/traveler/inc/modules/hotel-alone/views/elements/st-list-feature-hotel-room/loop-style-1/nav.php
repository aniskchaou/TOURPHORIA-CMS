<?php
$image = '';
if (has_post_thumbnail() and get_the_post_thumbnail()) {
    $image = wp_get_attachment_image_url(get_post_thumbnail_id(), array(200, 140));
}
$class = Hotel_Alone_Helper::inst()->build_css('background-image:url('.$image.')  !important');
?>
<div class="Room" data-id="<?php the_ID() ?>">
    <div class="AvtRoom <?php echo esc_html($class) ?>"></div>
    <!--end avtRoom-->
    <div class="rightDetail">
        <div class="titleRooms ">
            <a href="<?php the_permalink() ?>">
                <?php the_title() ?>
            </a>
        </div>
        <div class="payRoom">
            <?php esc_html_e("Starting from",ST_TEXTDOMAIN) ?>
            <span class="textBlue fontSize">
                <?php $price = get_post_meta(get_the_ID(),'price',true);echo TravelHelper::format_money($price); ?><span class="small"><?php esc_html_e("/night",ST_TEXTDOMAIN) ?></span>
            </span>
        </div>
        <div class="evalutionRoom">
            <div class="GrayBox">
                <?php
                $number_adult = get_post_meta(get_the_ID(), 'adult_number', true);
                $number_child = get_post_meta(get_the_ID(), 'children_number', true);
                if (!empty($number_adult) || !empty($number_child)) {
                    ?>
                    <?php echo esc_attr($number_child + $number_adult); ?> <?php esc_html_e("GUESTS",ST_TEXTDOMAIN) ?>
                <?php } ?>
            </div>
            <div class="GrayBox">
                <?php
                $room_size = get_post_meta(get_the_ID(),'room_footage',true);
                if(!empty($room_size)) {
                    echo esc_attr($room_size);
                    $hotel_id = wp_get_post_parent_id(get_the_ID());
                    echo '<span>';
                    echo ' m<sup>2</sup>';
                    echo '</span>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

