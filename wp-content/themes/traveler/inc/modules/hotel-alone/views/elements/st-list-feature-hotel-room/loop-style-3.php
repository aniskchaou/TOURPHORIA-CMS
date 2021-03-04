<div class="TabClassicSingle">
    <div class="tableDis">
        <div class="tableCell">
            <div class="TiTleClassic">
                <a href="<?php the_permalink() ?>">
                    <?php the_title() ?>
                </a>
            </div>
            <div class="SolganClassic">
                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
            </div>
            <div class="navClassic">
                <ul>
                    <li>
                        <?php
                        $number_adult = get_post_meta(get_the_ID(), 'adult_number', true);
                        $number_child = get_post_meta(get_the_ID(), 'children_number', true);
                        if (!empty($number_adult) || !empty($number_child)) {
                            ?>
                            <?php echo esc_attr($number_adult + $number_child); ?><?php esc_html_e("GUESTS", ST_TEXTDOMAIN) ?>
                        <?php } ?>
                    </li>
                    <li>
                        <?php
                        $room_size = get_post_meta(get_the_ID(), 'room_footage', true);
                        if (!empty($room_size)) {
                            echo esc_attr($room_size);
                            echo '<span>';
                            echo ' m<sup>2</sup>';
                            echo '</span>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <div class="facilities">
                <?php $term = get_the_terms(get_the_ID(), 'room_facilities'); ?>
                <?php if (is_array($term) && count($term)) { ?>
                    <?php
                    if ($term) {
                        $i = 0;
                        foreach ($term as $key => $value) {
                            if (!is_wp_error($term) and !empty($value->name)) {
                                if ($i == 4) {
                                    continue;
                                }
                                $i++;
                                ?>
                                <span class="icon-item">
                                        <?php if (function_exists('get_tax_meta') and $icon = get_tax_meta($value->term_id, 'st_icon')) { ?>
                                            <i class="<?php echo TravelHelper::handle_icon($icon) ?>"></i>
                                        <?php } ?>
                                    <?php echo esc_html($value->name); ?>
                                    </span>
                                <?php
                            }
                        }
                    }

                } ?>
            </div>
        </div>
    </div>
</div>
<?php
$image = '';
if (has_post_thumbnail() and get_the_post_thumbnail()) {
    $image = wp_get_attachment_image_url(get_post_thumbnail_id(), array(900, 800));
}
$class = Hotel_Alone_Helper::inst()->build_css('background-image:url(' . $image . ')  !important');
?>
<div class="AvtRoomBig <?php echo esc_attr($class) ?>">
    <div class="btn40">
        <div class="tableDis">
            <div class="tableCell">
                <?php $price = get_post_meta(get_the_ID(), 'price', true);
                echo TravelHelper::format_money($price); ?><span
                        class="small"><?php esc_html_e("/night", ST_TEXTDOMAIN) ?></span>
            </div>
        </div>
    </div>
    <div class="tableDis">
        <div class="tableCell">
            <div class="btnNow">
                <a href="<?php the_permalink() ?>"><?php esc_html_e("BOOK NOW", ST_TEXTDOMAIN) ?></a>
            </div>
        </div>
    </div>
</div>
