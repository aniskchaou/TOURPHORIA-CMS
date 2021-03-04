<?php
$tour_package = get_post_meta($post_id, 'tour_packages_activity', true);
$arr_tour_package = array();
$arr_tour_package_ids = array();
if (!empty((array)$tour_package)) {
    foreach ($tour_package as $k => $v) {
        $arr_tour_package[$v->activity_id] = $v->activity_price;
        array_push($arr_tour_package_ids, $v->activity_id);
    }
}
if (!empty($ids)) {
    ?>
    <table class="wp-list-table widefat fixed striped stour-list-hotel" data-type="activity">
        <thead>
        <tr>
            <td class="manage-column column-cb check-column" id="cb">
                <input type="checkbox" id="cb-select-all-1">
                <span><?php echo __('Show/Hide', ST_TEXTDOMAIN); ?></span>
            </td>
            <td><?php echo __('Activity name', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Price', ST_TEXTDOMAIN); ?></td>
        </tr>
        </thead>
        <tbody class="the-list">
        <?php foreach ($ids as $k => $v) { ?>
            <tr>
                <th class="check-column" scope="row"><input class="cb-select-child1" type="checkbox"
                                                            data-id="<?php echo esc_attr($v['ID']); ?>" <?php if (in_array($v['ID'], $arr_tour_package_ids)) echo 'checked'; ?>/>
                </th>
                <td data-name="<?php echo __('Activity name', ST_TEXTDOMAIN); ?>">
                    <a target="_blank" href="<?php echo get_the_permalink($v['ID']); ?>"
                       title="<?php echo get_the_title($v['ID']); ?>">
                        <?php echo get_the_title($v['ID']); ?>
                    </a>
                </td>
                <td data-name="<?php echo __('Price', ST_TEXTDOMAIN); ?>"><input type="text" class="hotel-price" value="<?php echo (!empty($arr_tour_package) && isset($arr_tour_package[$v['ID']])) ? $arr_tour_package[$v['ID']] : ''; ?>"/></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php
} else {
    echo __('No activities found!', ST_TEXTDOMAIN);
}
?>