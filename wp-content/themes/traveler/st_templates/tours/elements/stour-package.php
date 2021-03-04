<?php
$tour_package = get_post_meta($post_id, 'tour_packages', true);
$arr_tour_package = array();
$arr_tour_package_ids = array();
if (!empty($tour_package)) {
    foreach ($tour_package as $k => $v) {
        $arr_tour_package[$v->hotel_id] = $v->hotel_price;
        array_push($arr_tour_package_ids, $v->hotel_id);
    }
}
if (!empty($ids)) {
    ?>
    <table class="wp-list-table widefat fixed striped stour-list-hotel" data-type="hotel">
        <thead>
        <tr>
            <td class="manage-column column-cb check-column" id="cb">
                <input type="checkbox" id="cb-select-all-1">
                <span><?php echo __('Show/Hide', ST_TEXTDOMAIN); ?></span>
            </td>
            <td><?php echo __('Hotel name', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Price', ST_TEXTDOMAIN); ?></td>
        </tr>
        </thead>
        <tbody class="the-list">
        <?php foreach ($ids as $k => $v) { ?>
            <tr>
                <th class="check-column" scope="row"><input class="cb-select-child1" type="checkbox"
                                                            data-id="<?php echo esc_attr($v['ID']); ?>" <?php if (in_array($v['ID'], $arr_tour_package_ids)) echo 'checked'; ?>/>
                </th>
                <td data-name="<?php echo __('Hotel name', ST_TEXTDOMAIN); ?>">
                    <a target="_blank" href="<?php echo get_the_permalink($v['ID']); ?>"
                       title="<?php echo get_the_title($v['ID']); ?>">
                        <?php echo get_the_title($v['ID']); ?>
                    </a>
                    <?php
                    $star = STHotel::getStar($v['ID']);
                    echo ' ('. $star .'*)';
                    echo '<ul class="icon-list icon-group booking-item-rating-stars">';
                    echo TravelHelper::rate_to_string($star);
                    echo '</ul>';
                    ?>
                </td>
                <td data-name="<?php echo __('Price', ST_TEXTDOMAIN); ?>"><input type="text" class="hotel-price" value="<?php echo (!empty($arr_tour_package) && isset($arr_tour_package[$v['ID']])) ? $arr_tour_package[$v['ID']] : ''; ?>"/></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php
} else {
    echo __('No hotels found!', ST_TEXTDOMAIN);
}
?>