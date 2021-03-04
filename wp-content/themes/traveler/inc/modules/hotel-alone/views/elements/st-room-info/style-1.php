<div class="helios-room-info style-1">
    <div class="title">
        <?php the_title() ?>
    </div>
    <div class="info">
        <p><?php esc_html_e("Price",ST_TEXTDOMAIN) ?></p>
        <div class="price">
            <?php $price = get_post_meta(get_the_ID(),'price',true);echo TravelHelper::format_money($price); ?><span class="small"><?php esc_html_e("/night", ST_TEXTDOMAIN) ?></span>
        </div>
    </div>
    <div class="info">
        <div class="guest">
            <?php
            $number_adult = get_post_meta(get_the_ID(), 'adult_number', true);
            if (!empty($number_adult)) {
                ?>
                <p><?php esc_html_e("ADULT",ST_TEXTDOMAIN) ?></p>
                <?php echo esc_attr( sprintf("%02d", $number_adult) ); ?>
            <?php } ?>
        </div>
        <div class="guest">
            <?php
            $number_child = get_post_meta(get_the_ID(), 'children_number', true);
            if (!empty($number_child)) {
                ?>
                <p><?php esc_html_e("CHILDREN",ST_TEXTDOMAIN) ?></p>
                <?php echo esc_attr( sprintf("%02d", $number_child) ); ?>
            <?php } ?>
        </div>
        <div class="bed">
            <?php
            $bed_rooms = get_post_meta(get_the_ID(),'bed_number',true);
            if(!empty($bed_rooms)){
                ?>
                <p><?php esc_html_e("BEDS",ST_TEXTDOMAIN) ?></p>
                <?php echo esc_attr( sprintf("%02d", $bed_rooms) ); ?>
            <?php } ?>
        </div>
        <div class="size">
            <p><?php esc_html_e("SIZE",ST_TEXTDOMAIN) ?></p>
            <?php
            $room_size = get_post_meta(get_the_ID(),'room_footage',true);
            if(!empty($room_size)) {
                echo esc_attr( sprintf("%02d", $room_size) );
                echo '<span>';
                echo ' m<sup>2</sup>';
                echo '</span>';
            }
            ?>
        </div>
    </div>
</div>