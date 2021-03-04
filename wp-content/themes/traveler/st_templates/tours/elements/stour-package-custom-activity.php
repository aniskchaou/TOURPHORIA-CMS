<?php
$tour_package_custom = get_post_meta($post_id, 'tour_packages_custom_activity', true);
?>
<div class="custom-hotel-data-item">
    <table class="wp-list-table widefat fixed striped stour-list-custom-hotel" data-type="activity">
        <thead>
        <tr>
            <td class="manage-column column-cb check-column"></td>
            <td><?php echo __('Activity name', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Price', ST_TEXTDOMAIN); ?></td>
        </tr>
        </thead>
        <tbody>
        <tr class="parent-row">
            <td>
                <a href="#del-item" class="hotel-del">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </td>
            <td data-name="<?php echo __('Activity name', ST_TEXTDOMAIN); ?>"><input type="text" class="activity-name" value=""/></td>
            <td data-name="<?php echo __('Price', ST_TEXTDOMAIN); ?>"><input type="text" class="activity-price" value=""/></td>
        </tr>
        <?php
        if(is_object($tour_package_custom)) {
            if (!empty((array)$tour_package_custom)) {
                foreach ($tour_package_custom as $k => $v) {
                    ?>
                    <tr>
                        <td>
                            <a href="#del-item" class="hotel-del">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td data-name="<?php echo __('Activity name', ST_TEXTDOMAIN); ?>"><input type="text" class="activity-name" value="<?php echo $v->activity_name; ?>"/></td>
                        <td data-name="<?php echo __('Price', ST_TEXTDOMAIN); ?>"><input type="text" class="activity-price" value="<?php echo $v->activity_price; ?>"/></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
        </tbody>
    </table>
    <input type="submit" class="option-tree-ui-button button button-primary btn-add-custom-package btn btn-primary btn-sm"
           value="<?php echo __('Add new', ST_TEXTDOMAIN); ?>">
</div>
