<form id="posts-filter" class="partner-expire-countdown-form"
      action="<?php echo admin_url("admin.php?page=st-users-list-partner-menu&st_tab=" . $st_tab) ?>"
      method="post">
    <div class="overlay">
        <span class="spinner"></span>
    </div>
    <?php wp_nonce_field('shb_action', 'shb_field') ?>
    <input type="hidden" name="action" value="st_sendmail_expire_partner"/>
    <input type="submit" name="st_sendmail_expire_partner" class="button st_sendmail_expire_partner"
           id="st_sendmail_expire_partner" value="<?php echo __('Email to Partner', ST_TEXTDOMAIN); ?>"/>
    <div class="partner-message">
        <div class="alert"></div>
    </div>
    <table class="wp-list-table widefat fixed striped users">
        <thead>
        <tr>
            <td class="manage-column column-cb check-column" id="cb">
                <label for="cb-select-all-1" class="screen-reader-text"><?php _e("Select All", ST_TEXTDOMAIN) ?></label>
                <input type="checkbox" id="cb-select-all-1">
            </td>
            <th class="manage-column column-username column-primary  desc" id="username" scope="col">
                <span><?php _e("Username", ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-name  desc" id="name" scope="col">
                <span><?php _e("Name", ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-date" id="date" scope="col">
                <?php _e("Member package", ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-date" id="date" scope="col">
                <?php _e("Date Register", ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-date" id="date" scope="col">
                <?php _e("Expiration date", ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-date column-partner-countdown" id="date" scope="col">
                <b><?php _e("Number of day", ST_TEXTDOMAIN) ?></b>
            </th>
        </tr>
        </thead>
        <tbody id="the-list">
        <?php
        $i = 0;
        if (!empty($posts)) {
            foreach ($posts as $key => $value) {
                $i++;
                $user_id = $value->ID;
                $cls_package = STPackages::get_inst();
                $order = $cls_package->get_order_package_by("partner = {$user_id}");
                ?>
                <tr id="user-<?php echo esc_attr($user_id) ?>">
                    <th class="check-column" scope="row">
                        <label for="user_<?php echo esc_attr($user_id) ?>" class="screen-reader-text">Select
                            admin</label>
                        <input type="checkbox" value="<?php echo esc_attr($user_id) ?>" class="administrator"
                               id="user_<?php echo esc_attr($user_id) ?>" name="users[]">
                    </th>
                    <td class="username column-username has-row-actions column-primary">
                        <?php echo get_avatar($user_id, 32, null, TravelHelper::get_alt_image()); ?>
                        <strong>
                            <a target="_blank" href="<?php echo admin_url("/user-edit.php?user_id=" . $user_id); ?>">
                                <?php echo esc_html($value->user_nicename) ?>
                            </a>
                        </strong><br/>
                        <?php
                        if ($order->log_mail == '') {
                            ?>
                            <span class="notice-send-mail notice-no"><?php echo __('Not sent!', ST_TEXTDOMAIN); ?></span>
                            <?php
                        } else {
                            ?>
                            <span class="notice-send-mail notice-yes"><?php echo __('Sent!', ST_TEXTDOMAIN); ?></span>
                            <?php
                            echo ' ' . date_i18n(get_option('date_format'), $order->log_mail);
                        }
                        ?>
                    </td>
                    <td data-colname="Name" class="name column-name">
                        <?php echo esc_html($value->display_name) ?><br/>
                        <a href="mailto:<?php echo esc_html($value->user_email) ?>"><?php echo esc_html($value->user_email) ?></a>
                    </td>
                    <td data-colname="date" class="role column-date">
                        <?php
                        if ($order) {
                            $currency = get_post_meta($order->id, 'currency', true);
                            $currency = (isset($currency['symbol'])) ? $currency['symbol'] : '';
                            echo esc_attr($order->package_name) . ' (' . TravelHelper::format_money_raw($order->package_price, $currency) . ')';
                        }
                        ?>
                    </td>
                    <td data-colname="date" class="role column-date">
                        <?php
                        echo esc_html(date_i18n(get_option('date_format') . " " . get_option('time_format'), strtotime($value->user_registered)));
                        ?>
                    </td>
                    <td data-colname="date" class="role column-date">
                        <?php
                        if ($order) {
                            $created = (int)$order->created;
                            $time = $order->package_time;
                            if ($time == 'unlimited') {
                                $expiration = esc_html__('Unlimited', ST_TEXTDOMAIN);
                            } else {
                                $expiration = date('Y-m-d', strtotime('+' . (int)$time . ' days', $created));
                                $expiration = date_i18n(get_option('date_format'), strtotime($expiration));
                            }
                            echo esc_attr($expiration);
                        }
                        ?>
                    </td>
                    <?php
                    if ($order) {
                        $class_notice = 'safe';
                        $date_now = date('Y-m-d');
                        //$date_now = '2017-12-15';
                        $countdown_string = '';
                        $created = (int)$order->created;
                        $time = $order->package_time;
                        if ($time == 'unlimited') {
                            $countdown_string = '<span class="partner-expire-countdown">' . esc_html__('Unlimited', ST_TEXTDOMAIN) . '</span>';
                        } else {
                            $expiration = date('Y-m-d', strtotime('+' . (int)$time . ' days', $created));
                            $date_diff = STDate::dateDiff($date_now, $expiration);
                            $countdown_string = '<span class="partner-expire-countdown">' . $date_diff . '</span> ' . esc_html('day(s)', ST_TEXTDOMAIN);
                        }
                        if ($date_diff <= 5) {
                            $class_notice = 'danger';
                        }
                        if ($date_diff > 5 && $date_diff <= 60) {
                            $class_notice = 'warning';
                        }
                    }
                    ?>
                    <td data-colname="date" class="role column-date column-countdown <?php echo $class_notice; ?>">
                        <?php echo $countdown_string; ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <th colspan="9" class="text-center">
                <?php _e("No Data", ST_TEXTDOMAIN) ?>
            </th>
            <?php
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td class="manage-column column-cb check-column">
                <label for="cb-select-all-2" class="screen-reader-text"><?php _e("Select All", ST_TEXTDOMAIN) ?></label>
                <input type="checkbox" id="cb-select-all-2">
            </td>
            <th class="manage-column column-username column-primary desc" scope="col">
                <span><?php _e("Username", ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-name sortable desc" scope="col">
                <span><?php _e("Name", ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-date" id="date" scope="col">
                <?php _e("Member package", ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-certificates" scope="col"><?php _e("Date Register", ST_TEXTDOMAIN) ?></th>
            <th class="manage-column column-date" id="date" scope="col">
                <?php _e("Expiration date", ST_TEXTDOMAIN) ?>
            </th>
            <th class="manage-column column-date column-partner-countdown" id="date" scope="col">
                <b><?php _e("Number of day", ST_TEXTDOMAIN) ?></b>
            </th>
        </tr>
        </tfoot>

    </table>
    <div class="tablenav bottom">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo sprintf(_n('%s item', '%s items', $data['total']), $data['total'], ST_TEXTDOMAIN) ?></span>
            <?php echo paginate_links($paging) ?>

        </div>
    </div>
    <?php wp_reset_query(); ?>
</form>