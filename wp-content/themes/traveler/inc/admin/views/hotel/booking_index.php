<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Admin hotel booking index
 *
 * Created by ShineTheme
 *
 */
$page=isset($_GET['paged'])?$_GET['paged']:1;
$limit=20;
$offset=($page-1)*$limit;

$data=STAdmin::get_history_bookings('st_hotel',$offset,$limit);
$posts=$data['rows'];
$total=ceil($data['total']/$limit);

global $wp_query;

$paging=array();

$paging['base']=admin_url('edit.php?post_type=st_hotel&page=st_hotel_booking%_%');
$paging['format']='&paged=%#%';
$paging['total']=$total;
$paging['current']=$page;

echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
echo '<h2>'.__('Hotel Bookings',ST_TEXTDOMAIN).'</h2>';

    STAdmin::message();
?>
<form id="posts-filter" action="<?php echo admin_url('edit.php?post_type=st_hotel&page=st_hotel_booking')?>" method="get">
    <input type="hidden" name="post_type" value="st_hotel">
    <input type="hidden" name="page" value="st_hotel_booking">
    <div class="wp-filter st-wp-filter">
        <div class="filter-items">
            <div class="alignleft actions">

                <input type="text" class="st_custommer_name"   name="st_custommer_name" placeholder="<?php _e('Filter by customer name',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_custommer_name') ?>"/>
                <input type="text" class="st_datepicker" format="mm/dd/yyyy"  name="st_date_start" placeholder="<?php _e('Filter by Date from',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_date_start') ?>"/>
                <input type="text" class="st_datepicker" name="st_date_end" placeholder="<?php _e('Filter by Date to',ST_TEXTDOMAIN)  ?>" value="<?php echo STInput::get('st_date_end') ?>"/>
                <input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php _e('Filter',ST_TEXTDOMAIN)?>">
            </div>
        </div>

    </div>
</form>
<form id="posts-filter" action="<?php echo admin_url('edit.php?post_type=st_hotel&page=st_hotel_booking')?>" method="post">

    <?php wp_nonce_field('shb_action','shb_field')?>
    <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text"><?php _e('Select bulk action',ST_TEXTDOMAIN)?></label>
            <select name="st_action" id="bulk-action-selector-top">
                <option value="-1" selected="selected"><?php _e('Bulk Actions',ST_TEXTDOMAIN)?></option>
                <option value="delete"><?php _e('Delete Permanently',ST_TEXTDOMAIN)?></option>
            </select>
            <input type="submit" name="" id="doaction" class="button action" value="<?php _e('Apply',ST_TEXTDOMAIN)?>">
        </div>
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
            <?php echo paginate_links($paging)?>

        </div>
    </div>

    <table class="wp-list-table widefat fixed posts">
        <thead>
            <tr>
                <th class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1"><?php _e('Select All',ST_TEXTDOMAIN)?></label>
                    <input  type="checkbox" id="cb-select-all-1">
                </th>

                <th class="manage-column">
                    <a href="#"><span><?php _e('Customer',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>

                <th class="manage-column" width="10%">
                    <a href="#"><span><?php _e('Check In',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>
                <th class="manage-column" width="10%">
                    <a href="#"><span><?php _e('Check Out',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>
                <th class="manage-column">
                    <a href="#"><span><?php _e('Hotel - Room Name',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>
                <th class="manage-column " width="7%">
                    <a href="#"><span><?php _e('Room(s)',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>
                <th class="manage-column" width="7%">
                    <a href="#"><span><?php _e('Price',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>
                <th class="manage-column"  width="10%">
                    <a href="#"><span><?php _e('Created Date',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>
                <th class="manage-column " width="10%">
                    <a href="#"><span><?php _e('Status',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>

                <th class="manage-column " width="10%">
                    <a href="#"><span><?php _e('Payment Method',ST_TEXTDOMAIN)?></span><span class="sorting-indicator"></span></a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php

                $i=0;

                if(!empty($posts)) {
                    foreach($posts as $key=>$value) {
                        $i++;
                        $post_id=$value->ID;
                        $item_id = get_post_meta($post_id, 'item_id', true);
                        ?>
                        <tr class="<?php if ($i % 2 == 0) echo 'alternate'; ?>">
                            <th scope="row" class="check-column">
                                <input id="cb-select-39" type="checkbox" name="post[]" value="<?php echo esc_attr( $post_id)?>">

                                <div class="locked-indicator"></div>
                            </th>

                            <td class="post-title page-title column-title">
                                <strong><a class="row-title"
                                           href="<?php echo admin_url('edit.php?post_type=st_hotel&page=st_hotel_booking&section=edit_order_item&order_item_id=' . $post_id); ?>"
                                           title=""><?php

                                        if ($post_id) {
                                            $name = get_post_meta($post_id, 'st_first_name', true);
                                            if (!$name) {
                                                $name = get_post_meta($post_id, 'st_name', true);
                                            }
                                            if (!$name) {
                                                $name = get_post_meta($post_id, 'st_email', true);
                                            }
                                            echo esc_html( $name);
                                        }

                                        ?></a></strong>

                                <div class="row-actions">
                                    <a href="<?php echo admin_url('edit.php?post_type=st_hotel&page=st_hotel_booking&section=edit_order_item&order_item_id=' . $post_id); ?>"><?php _e('Edit',ST_TEXTDOMAIN)?></a> |
                                    <a href="<?php echo admin_url('edit.php?post_type=st_hotel&page=st_hotel_booking&section=resend_email&order_item_id=' . $post_id); ?>"><?php _e('Resend Email',ST_TEXTDOMAIN)?></a>
                                    <?php do_action('st_after_order_page_admin_information_table',$post_id) ?>
                                </div>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php $date= get_post_meta($post_id, 'check_in', true);if($date) echo date('m/d/Y',strtotime($date)); ?>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php $date= get_post_meta($post_id, 'check_out', true);if($date) echo date('m/d/Y',strtotime($date)); ?>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php
                                if ($item_id) {
                                    if ($item_id) {
                                        echo "<a href='" . get_edit_post_link($item_id) . "' target='_blank'>" . get_the_title($item_id) . "</a>";
                                    }
                                    $room_id=get_post_meta($post_id,'room_id',true);
                                    if($room_id){
                                        echo " - <a href='" . get_edit_post_link($room_id) . "' target='_blank'>" . get_the_title($room_id) . "</a>";
                                    }

                                }

                                ?>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php echo get_post_meta($post_id, 'item_number', true) ?>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php
                                $price = get_post_meta($post_id,'total_price',true);

                                $currency = TravelHelper::_get_currency_book_history($post_id);

                                echo TravelHelper::format_money_raw($price, $currency);

                                ?>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php echo date(get_option('date_format'),strtotime($value->post_date)) ?>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php echo get_post_meta($post_id, 'status', true) ?>
                            </td>
                            <td class="post-title page-title column-title">
                                <?php
                                echo STPaymentGateways::get_gatewayname(get_post_meta($post_id,'payment_method',true));
                                do_action('st_traveler_after_name_payment_method',$post_id);
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                }

            ?>
        </tbody>
    </table>
    <div class="tablenav bottom">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
            <?php echo paginate_links($paging)?>

        </div>
    </div>
    <?php wp_reset_query();?>
</form>
</div>

