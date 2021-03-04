<?php
$format = TravelHelper::getDateFormat();
$get = $_GET;
$query_var_5day = $get;
$query_var_5day['from'] = '0';
$query_var_5day['to'] = '5';
$query_var_all = $get;
$query_var_all['from'] = 'all';
$query_var_all['to'] = 'all';
$query_var_out = $get;
$query_var_out['from'] = 'expire';
$query_var_out['to'] = 'expire';

$from = STInput::get('from');
if ($from == 'all' || $from == 'expire')
    $from = '';
$to = STInput::get('to');
if ($to == 'all' || $to == 'expire')
    $to = '';

$check = true;
if (($from != 'all' && $from != 'expire') && ($to != 'all' && $to != 'expire')) {
    if ($from > $to) {
        $check = false;
    }
}
$st_tab = STInput::request('car_type','normal');
$page_link = get_permalink();
?>
<form class="form-inline booking-email-filter"
      action="<?php echo TravelHelper::get_user_dashboared_link(get_permalink(), 'dashboard-info'); ?>" method="get">
    <input type="hidden" name="sc" value="booking-cars"/>
    <input type="hidden" name="scaction" value="email-notification"/>
    <div class="form-group booking-email-filter-day">
        <a href="<?php echo add_query_arg($query_var_5day, TravelHelper::get_user_dashboared_link(get_permalink(), 'dashboard-info')); ?>"><?php echo __('5 days left', ST_TEXTDOMAIN); ?></a>
        <a href="<?php echo add_query_arg($query_var_all, TravelHelper::get_user_dashboared_link(get_permalink(), 'dashboard-info')); ?>"><?php echo __('All', ST_TEXTDOMAIN); ?></a>
        <a href="<?php echo add_query_arg($query_var_out, TravelHelper::get_user_dashboared_link(get_permalink(), 'dashboard-info')); ?>"><?php echo __('Out of date', ST_TEXTDOMAIN); ?></a>
    </div>
    <div class="form-group">
        <label class="sr-only" for="out_of_from"><?php echo __('From', ST_TEXTDOMAIN); ?></label>
        <input type="number" min="0" value="<?php echo $from; ?>" name="from" class="form-control input-sm"
               id="out_of_from"
               placeholder="<?php echo __('From', ST_TEXTDOMAIN); ?>">
    </div>
    <div class="form-group">
        <label class="sr-only" for="out_of_to"><?php echo __('To', ST_TEXTDOMAIN); ?></label>
        <input type="number" min="0" value="<?php echo $to; ?>" name="to" class="form-control input-sm" id="out_of_to"
               placeholder="<?php echo __('To', ST_TEXTDOMAIN); ?>">
    </div>
    <button type="submit" class="btn btn-primary btn-sm"><?php echo __('Filter by date', ST_TEXTDOMAIN); ?></button>
</form>

<?php
if (!$check) {
    echo '<div class="alert alert-danger">' . __('Number day of filter is not valid!', ST_TEXTDOMAIN) . '</div>';
}
?>

<form class="booking-email-form" action="" method="post">
    <input type="hidden" name="action" value="st_sendmail_expire_customer"/>
    <div style="" class="overlay-form"><i class="fa fa-spinner text-color"></i></div>
    <?php if ($check && !empty($posts)): ?>
        <input type="button" class="btn btn-primary btn-sm" id="booking-email-form-btn"
               value="<?php echo __('Send email to customer', ST_TEXTDOMAIN); ?>"/>
        <br /><br />
    <?php endif; ?>
    <div class="form-group list-car-type">
        <a href="<?php echo add_query_arg(array('car_type' => 'normal', 'scaction' => 'email-notification'), TravelHelper::get_user_dashboared_link($page_link, 'booking-cars')) ?>" class="<?php if($st_tab=="normal") echo "current"; ?>"><i class="fa fa-car"></i> <?php echo __('Car normal', ST_TEXTDOMAIN); ?></a>&nbsp; &nbsp; &nbsp;
        <a href="<?php echo add_query_arg(array('car_type' => 'transfer', 'scaction' => 'email-notification'), TravelHelper::get_user_dashboared_link($page_link, 'booking-cars')) ?>" class="<?php if($st_tab=="transfer") echo "current"; ?>"><i class="fa fa-tachometer"></i> <?php echo __('Car transfer', ST_TEXTDOMAIN); ?></a>
    </div>
    <div class="form-message"></div>
    <table class="table table-bordered table-striped table-booking-history table-booking-history-email">
        <thead>
        <tr>
            <th class="">
                <input type="checkbox" value="" name="" id="cb-select-all"/>
            </th>
            <th class="hidden-xs"><?php echo __('#ID', ST_TEXTDOMAIN); ?></th>
            <th><?php _e("Customer", ST_TEXTDOMAIN) ?></th>
            <th><?php _e("Car Name", ST_TEXTDOMAIN) ?></th>
            <th class="hidden-xs"><?php _e("From/To date", ST_TEXTDOMAIN) ?></th>
            <th class="hidden-xs" width="10%"><?php _e("Order Date", ST_TEXTDOMAIN) ?></th>
            <th class=""><?php _e("Number of day", ST_TEXTDOMAIN) ?></th>
        </tr>
        </thead>
        <tbody id="data_history_book booking-history-title">
        <?php if (!empty($posts)) {
            $i = 1 + $offset;
            foreach ($posts as $key => $value) {
                $post_id = $value->wc_order_id;
                $item_id = $value->st_booking_id;
                ?>
                <tr>
                    <td class="">
                        <input type="checkbox" value="<?php echo $value->id; ?>" class="cb-select-child"
                               id="order_<?php echo $value->id; ?>" name="order[]">
                    </td>
                    <td class="hidden-xs"><?php echo $value->wc_order_id; ?></td>
                    <td class="booking-history-type" style="text-align: left">
                        <?php
                        if ($post_id) {
                            $name = get_post_meta($post_id, 'st_first_name', true);
                            if (!empty($name)) {
                                $name .= " " . get_post_meta($post_id, 'st_last_name', true);
                            }
                            if (!$name) {
                                $name = get_post_meta($post_id, 'st_name', true);

                            }
                            if (!$name) {
                                $name = get_post_meta($post_id, 'st_email', true);
                            }
                            if (!$name) {
                                $name = get_post_meta($post_id, '_billing_first_name', true);
                                $name .= " " . get_post_meta($post_id, '_billing_last_name', true);
                            }
                            echo esc_html($name) . '<br />';
                            echo '<a href="mailto:' . get_post_meta($post_id, 'st_email', true) . '">' . esc_html(get_post_meta($post_id, 'st_email', true)) . '</a>';

                        }
                        ?>
                    </td>
                    <td class=""> <?php
                        if ($item_id) {
                            if ($item_id) {
                                echo "<a href='" . get_the_permalink($item_id) . "' target='_blank'>" . get_the_title($item_id) . "</a>";
                            }
                        }
                        ?>
                    </td>

                    <td class="hidden-xs">
                        <?php $date = $value->check_in;
                        if ($date) echo date('d/m/Y', strtotime($date)); ?><br>
                        <i class="fa fa-long-arrow-right"></i><br>
                        <?php $date = $value->check_out;
                        if ($date) echo date('d/m/Y', strtotime($date)); ?>
                    </td>

                    <td class="hidden-xs"><?php echo date_i18n($format, strtotime($value->created)) ?></td>
                    <?php
                    $class_notice = 'cssafe';
                    $date_now = date('Y-m-d');
                    $countdown_string = '';
                    $expiration = date('Y-m-d', strtotime($value->check_in));
                    $date_diff = STDate::dateDiff($date_now, $expiration);
                    $countdown_string = '<span class="number-countdown">' . $date_diff . '</span> ' . esc_html('day(s)', ST_TEXTDOMAIN);

                    if ($date_diff <= 5) {
                        $class_notice = 'csdanger';
                    }
                    if ($date_diff > 5 && $date_diff <= 60) {
                        $class_notice = 'cswarning';
                    }
                    ?>
                    <td class="column-countdown <?php echo $class_notice; ?>">
                        <?php echo $countdown_string; ?><br/>
                        <?php
                        if ($value->log_mail == '') {
                            ?>
                            <span class="notice-send-mail notice-no"><?php echo __('Not sent!', ST_TEXTDOMAIN); ?></span>
                            <?php
                        } else {
                            ?>
                            <span class="notice-send-mail notice-yes"><?php echo __('Sent!', ST_TEXTDOMAIN); ?></span>
                            <?php
                            echo ' ' . date_i18n('d/m/Y', $value->log_mail);
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
        } else {
            echo '<h5>' . __('No Cars', ST_TEXTDOMAIN) . '</h5>';
        }
        ?>
        </tbody>
    </table>
</form>