<?php
$tour_package_custom = get_post_meta($post_id, 'tour_packages_custom', true);
?>
<div class="custom-hotel-data-item">
    <table class="wp-list-table widefat fixed striped stour-list-custom-hotel" data-type="hotel">
        <thead>
        <tr>
            <td class="manage-column column-cb check-column"></td>
            <td><?php echo __('Hotel name', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Hotel star', ST_TEXTDOMAIN); ?></td>
            <td><?php echo __('Hotel price', ST_TEXTDOMAIN); ?></td>
        </tr>
        </thead>
        <tbody>
        <tr class="parent-row">
            <td>
                <a href="#del-item" class="hotel-del">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </td>
            <td data-name="<?php echo __('Hotel name', ST_TEXTDOMAIN); ?>"><input type="text" class="hotel-name" value=""/></td>
            <td data-name="<?php echo __('Hotel star', ST_TEXTDOMAIN); ?>"><input type="number" min="0" max="5" step="0.5" class="hotel-star" value=""/></td>
            <td data-name="<?php echo __('Hotel price', ST_TEXTDOMAIN); ?>"><input type="text" class="hotel-price" value=""/></td>
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
                        <td data-name="<?php echo __('Hotel name', ST_TEXTDOMAIN); ?>"><input type="text" class="hotel-name" value="<?php echo esc_html($v->hotel_name); ?>"/></td>
                        <td data-name="<?php echo __('Hotel star', ST_TEXTDOMAIN); ?>"><input type="number" min="0" max="5" step="0.5" class="hotel-star"
                                   value="<?php echo esc_html($v->hotel_star); ?>"/></td>
                        <td data-name="<?php echo __('Hotel price', ST_TEXTDOMAIN); ?>"><input type="text" class="hotel-price" value="<?php echo esc_html($v->hotel_price); ?>"/></td>
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
