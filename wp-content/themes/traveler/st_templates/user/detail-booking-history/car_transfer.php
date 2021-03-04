<?php
$currency = get_post_meta( $order_id, 'currency', true );
$order_data = STUser_f::get_booking_meta($order_id);
$date_format = TravelHelper::getDateFormat();
?>
<div class="st_tab st_tab_order tabbable">
    <ul class="nav nav-tabs tab_order">
        <li class="active">
            <a data-toggle="tab" href="#tab-booking-detail" aria-expanded="true"> <?php echo __('Car Transfer Details',ST_TEXTDOMAIN )?></a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#tab-customer-detail" aria-expanded="false"> <?php esc_html_e("Customer Details",ST_TEXTDOMAIN) ?></a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent973">
        <div id="tab-booking-detail" class="tab-pane fade active in">
            <div class="info">
                <div class="row">
                    <div class="col-md-6">
                        <strong><?php esc_html_e("Booking ID",ST_TEXTDOMAIN) ?>:  </strong>
                        #<?php echo esc_html($order_id) ?>
                    </div>
                    <div class="col-md-6"><strong><?php esc_html_e("Payment Method: ",ST_TEXTDOMAIN) ?> </strong>
                        <?php echo STPaymentGateways::get_gatewayname(get_post_meta($order_id, 'payment_method', true)); ?>
                    </div>
                    <div class="col-md-6"><strong><?php esc_html_e("Order Date",ST_TEXTDOMAIN) ?>:  </strong>
                        <?php echo esc_html(date_i18n($date_format, strtotime($order_data['created']))) ?>
                    </div>
                    <div class="col-md-6">
                        <strong><?php esc_html_e("Booking Status",ST_TEXTDOMAIN) ?>:  </strong>
                        <?php
                        $data_status =  STUser_f::_get_all_order_statuses();
                        $status = $order_data['status'];
                        if(!empty($status_string = $data_status[$status])){
                            $status_string = $data_status[$status];
                            if( isset( $order_data['cancel_refund_status'] ) && $order_data['cancel_refund_status'] == 'pending'){
                                $status_string = __('Cancelling', ST_TEXTDOMAIN);
                            }
                        }
                        ?>
                        <span class=""> <?php  echo esc_html($status_string); ?></span>
                    </div>
                    <div class="col-md-12"><strong><?php esc_html_e("Transfer",ST_TEXTDOMAIN) ?>:  </strong>
                        <?php
                            $transfer_from = get_post_meta($order_id, 'pick_up', true);
                            $transfer_to = get_post_meta($order_id, 'drop_off', true);

                            echo $transfer_from . ' - '. $transfer_to;
                        ?>
                    </div>
                    <div class="col-md-12"><strong><?php esc_html_e("Arrival Date",ST_TEXTDOMAIN) ?>:  </strong>
                        <?php 
                            $check_in = date_i18n($date_format . ' H:i:s', $order_data['check_in_timestamp']);
                            echo $check_in;
                        ?>
                    </div>
                    <div class="col-md-12"><strong><?php esc_html_e("Departure Date",ST_TEXTDOMAIN) ?>:  </strong>
                        <?php 
                            
                            $check_out = date_i18n($date_format . ' H:i:s', $order_data['check_out_timestamp']);
                            $roundtrip = get_post_meta($order_id, 'roundtrip', true);
                            if($roundtrip == 'roundtrip'){
                                echo $check_out;
                            }
                        ?>
                    </div>
                    <div class="col-md-12"><strong><?php esc_html_e("Address ",ST_TEXTDOMAIN) ?>:  </strong>
                        <?php  echo get_post_meta( $order_data['st_booking_id'], 'cars_address', true); ?>
                    </div>
                    <div class="col-md-12"><?php st_print_order_item_guest_name(json_decode($order_data['raw_data'],true)) ?></div>
                    <div class="line col-md-12"></div>
                    <div class="col-md-12">
                        <strong><?php esc_html_e("No. Passengers :",ST_TEXTDOMAIN) ?> </strong>
                        <?php echo get_post_meta( $order_id, 'passenger', true ); ?>
                    </div>
                    <?php
                    $extras = get_post_meta($order_id, 'extras', true);
                    if(!empty($extras) and is_array($extras)){
                    ?>
                        <div class="col-md-12">
                            <strong><?php esc_html_e("Extra Services :",ST_TEXTDOMAIN) ?> </strong><br />
                            <?php
                                foreach ($extras as $ek => $ev){
                                    echo $ev['title'] . ' ('. TravelHelper::format_money($ev['price']) .') x ' . $ev['number'] . '<br />';
                                }
                            ?>
                        </div>
                    <?php } ?>
                    <?php
                    $discount_rate = get_post_meta($order_id, 'discount_rate', true);
                    if(!empty($discount_rate)){
                        ?>
                        <div class="col-md-12">
                            <strong><?php esc_html_e("Discount Rate:",ST_TEXTDOMAIN) ?> </strong>
                            <?php
                            echo $discount_rate . '%';
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php echo st()->load_template('user/detail-booking-history/detail-price',false,
                        array(
                            'order_data'=>$order_data,
                            'order_id'=>$order_id,
                            'service_id'=>$service_id,
                        )
                    ) ?>
                </div>
            </div>
        </div>
        <div id="tab-customer-detail" class="tab-pane fade">
            <div class="container-customer">
                <?php echo apply_filters( 'st_customer_info_booking_history', st()->load_template('user/detail-booking-history/customer',false,array("order_id"=>$order_id)),$order_id ); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <?php do_action("st_after_body_order_information_table",$order_id); ?>
    <button data-dismiss="modal" class="btn btn-default" type="button"><?php esc_html_e("Close",ST_TEXTDOMAIN) ?></button>
</div>