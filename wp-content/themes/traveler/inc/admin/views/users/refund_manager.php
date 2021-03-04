<?php
$class_user = new STUser_f();
echo '<div class="wrap ad-refund-list"><div id="icon-tools" class="icon32"></div>';
echo '<h2>' . __('Refund Manager', ST_TEXTDOMAIN) . '</h2>';
?>
<?php
$paged = isset( $_GET[ 'paged' ] ) ? $_GET[ 'paged' ] : 1;

$paging = [];

$query = array(
    'post_type' => 'st_order',
    'posts_per_page' => 15,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'desc'
);

$class_user->add_where_join_refund();
$orders = query_posts($query);
global $wp_query;
$paging[ 'base' ]    = admin_url( 'admin.php/?page=st-refund-manager-menu%_%' );
$paging[ 'format' ]  = '&paged=%#%';
$paging[ 'total' ]   = $wp_query->max_num_pages;
$paging[ 'current' ] = $paged;
$paging['type'] = 'list';
$paging[ 'prev_text' ] = "<i class='fa fa-angle-left'></i>";
$paging[ 'next_text' ] = "<i class='fa fa-angle-right'></i>";

?>
<?php if (have_posts()): ?>
    <table class="table table-bordered table-striped table-booking-history">
        <tr>
            <th><?php esc_html_e('Type','traveler') ?></th>
            <th><?php esc_html_e('Title','traveler') ?></th>
            <th class="hidden-xs"><?php esc_html_e('Location','traveler') ?></th>
            <th class="hidden-xs"><?php esc_html_e('Order Date','traveler') ?></th>
            <th class="hidden-xs"><?php esc_html_e('Execution Time','traveler')?></th>
            <th><?php esc_html_e('Cost','traveler')?></th>
            <th class="hidden-xs"><?php _e("Status", ST_TEXTDOMAIN) ?></th>
        </tr>
        <?php
        $user_url = st()->get_option('page_my_account_dashboard');
        $format = TravelHelper::getDateFormat();

        while (have_posts()): the_post();
            global $post;
            $address = get_post_meta($post->st_booking_id, 'address', true);
            if (get_post_type($post->st_booking_id) == 'st_cars') {
                $address = get_post_meta($post->st_booking_id, 'cars_address', true);
            }

            $check_in = $post->check_in;
            $check_out = $post->check_out;
            if ($check_in and $check_out) {
                $date = date_i18n($format, $post->check_in_timestamp) . ' <i class="fa fa-long-arrow-right"></i> ' . date_i18n($format, $post->check_out_timestamp);
            }
            if ($post->st_booking_post_type == 'st_tours') {
                $type_tour = get_post_meta($post->st_booking_id, 'type_tour', true);
                if ($type_tour == 'daily_tour') {
                    $duration = get_post_meta($post->st_booking_id, 'duration_day', true);
                    if ($date) {
                        $date = __("Check in : ", ST_TEXTDOMAIN) . date_i18n($format, $post->check_in_timestamp) . "<br>";
                        $date .= __("Duration : ", ST_TEXTDOMAIN) . $duration . " ";
                    }
                }
            }
            if (!isset($date)) {
                $date = "";
            }

            $currency = $class_user::_get_currency_book_history($post->order_item_id);
            $price = $class_user::_get_order_total_price($post->order_item_id);

            $status_string = "";
            $data_status = $class_user::_get_order_statuses(true);
            if (!empty($data_status[$post->status])) {
                $status_string = $data_status[$post->status];
                if ((float)$post->cancel_refund > 0 && $post->cancel_refund_status == 'pending') {
                    $status_string = __('Cancelling', ST_TEXTDOMAIN);
                }
            }

            $action_cancel = '';
            if ((float)$post->cancel_refund > 0 && $post->cancel_refund_status == 'pending') {
                $action_cancel = '<br /><a data-toggle="modal" data-target="#with-refund-modal" href="javascript: void(0);" class="with_a_refund btn btn-primary btn-xs" data-order_id="' . $post->order_item_id . '" data-order_encrypt="' . TravelHelper::st_encrypt($post->order_item_id) . '">' . __('with refund', ST_TEXTDOMAIN) . '</a>';
            }

            $action = '';

            $data_url['sc'] = 'write_review';
            $data_url['item_id'] = $post->st_booking_id;

            if (STReview::review_check($post->st_booking_id) == 'true') {
                $action = '<a class="btn btn-xs btn-primary" class="user_write_review" href="' . st_get_link_with_search(get_permalink($user_url), array(
                        'sc',
                        'item_id'
                    ), $data_url) . '">' . st_get_language('user_write_review') . '</a>';

            } else {
                $action = "<p style='display: none'>" . STReview::review_check($post->st_booking_id) . "</p>";
            }
            ?>
            <tr>
                <td class="booking-history-type <?php echo $post->st_booking_post_type; ?>">
                    <?php echo $class_user->get_icon_type_order_item($post->st_booking_id); ?>
                </td>
                <td>
                    <a href="<?php echo $class_user->get_link_order_item($post->st_booking_id); ?>"><?php echo $class_user->get_title_order_item($post->st_booking_id) ?></a>
                </td>
                <td class="hidden-xs"><?php echo $address; ?></td>
                <td class="hidden-xs">
                    <?php echo date_i18n($format, strtotime($post->post_date)); ?>
                </td>
                <td class="hidden-xs"><?php echo $date; ?></td>
                <td><?php echo TravelHelper::format_money_raw($price, $currency); ?></td>
                <td class="hidden-xs"><?php echo $status_string . $action_cancel; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
    <div class="pagination">
        <?php echo paginate_links( $paging ) ?>
    </div>
    <?php
else:
    echo '<h3>' . __('The refund list is empty', ST_TEXTDOMAIN) . '</h3>';
endif;
?>
<?php $class_user->remove_where_join_refund();
wp_reset_query();
wp_reset_postdata(); ?>

<!-- Modal show cancel refund -->
<div class="modal fade modal-cancel-booking" id="with-refund-modal" tabindex="-1" role="dialog"
     aria-labelledby="withRefundLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="<?php echo __('Close', ST_TEXTDOMAIN); ?>"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="withRefundLabel"><?php echo __('Refund Infomation', ST_TEXTDOMAIN); ?></h4>
            </div>
            <div class="modal-body">
                <div class="overlay">
                    <span class="spinner is-active"></span>
                </div>
                <div class="modal-content-inner">

                </div>
            </div>
            <div class="modal-footer">
                <button id="" type="button"
                        class="refund_complete next btn btn-primary hidden"><?php echo __('Complete this Refund', ST_TEXTDOMAIN); ?></button>
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>