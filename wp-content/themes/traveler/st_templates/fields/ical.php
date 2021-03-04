<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 4/9/2019
 * Time: 2:50 PM
 */
$ical_url = get_post_meta($post_id, 'ical_url', true);
?>
<div class="form-group">
    <div class="ical-sysc-wrapper">
        <div class="form-message"></div>
        <input name="ical_url" id="ical_url"
               value="<?php echo esc_attr($ical_url); ?>"
               class="form-control ical_input"
               type="text">
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
        <button class="btn btn-primary btn-sm btn-ical-sysc"
                id="save_ical"><?php echo __('Import', ST_TEXTDOMAIN); ?></button>
        <img class="spinner spinner-import" style="display: none; float: none; visibility: visible;"
             src="<?php echo admin_url('/images/spinner.gif'); ?>" alt="spinner">
        <p>
            <small><i>
                    <?php
                    $time = get_post_meta($post_id, 'sys_created', true);
                    if (!empty($time)) {
                        echo '(Last updated: ' . date('Y-m-d H:i:s', $time) . ')';
                    }
                    ?>
                </i></small>
        </p>
    </div>
</div>