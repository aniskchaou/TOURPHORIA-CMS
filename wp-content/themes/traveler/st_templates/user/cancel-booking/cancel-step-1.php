<?php 
/**
*@since 1.2.8
*	Cancel booking step 1 - Get order infomation and confirm
**/

if( !isset( $order_id ) ):
?>
<div class="text-danger"><?php echo __('Can not get order infomation', ST_TEXTDOMAIN); ?></div>
<?php else: 
	$item_id = (int) get_post_meta( $order_id, 'st_booking_id', true);
	$post_type = get_post_meta( $order_id, 'st_booking_post_type', true);
	if( $post_type == 'st_hotel' ){
		$room_id = (int) get_post_meta($order_id, 'room_id', true);
	}
	$total_price = (float) get_post_meta( $order_id, 'total_price', true);
	$currency = STUser_f::_get_currency_book_history($order_id);

	$percent = (int) get_post_meta( $item_id, 'st_cancel_percent', true );
	if( $post_type == 'st_hotel' && isset( $room_id ) ){
		$percent = (int) get_post_meta( $room_id, 'st_cancel_percent', true );
	}  

	$refunded = $total_price - ( $total_price * $percent / 100 );
	$status = get_post_meta( $order_id, 'status', true);
	if( $status != 'complete' ){
		$refunded = 0;
	}

	$check_in        = strtotime( get_post_meta( $order_id, 'check_in', true));
    $check_out       = strtotime(get_post_meta( $order_id, 'check_out', true));
    $format=TravelHelper::getDateFormat();

    if($check_in and $check_out) {
        $date = date_i18n( $format , $check_in) . ' <i class="fa fa-long-arrow-right"></i> ' . date_i18n( $format , $check_out  );
    }
    if( $post_type == 'st_tours') {
        $type_tour = get_post_meta( $item_id , 'type_tour' , true );
        if($type_tour == 'daily_tour') {
            $duration = get_post_meta( $item_id , 'duration_day' , true );
            if ($date){
                $date     = __( "Check in : " , ST_TEXTDOMAIN ) . date_i18n( $format , $check_in ) . "<br>";
                $date .= __( "Duration : " , ST_TEXTDOMAIN ) . $duration. " ";
            }
        }
    }
?>
<div class="info">
	<div><strong><?php echo __('Service: ', ST_TEXTDOMAIN); ?> </strong> <em><?php echo get_the_title( $item_id ); ?></em></div>
	<?php if( isset( $room_id ) && !empty( $room_id ) ): ?>
	<div><strong><?php echo __('Room: ', ST_TEXTDOMAIN); ?> </strong> <em><?php echo get_the_title( $room_id ); ?></em></div>
	<?php endif; ?>
	<div><strong><?php echo __('Execution Time: ', ST_TEXTDOMAIN); ?> </strong> <em><?php echo $date; ?></em></div>
	<button class="btn btn-primary btn-sm mt10"><?php echo $status; ?></button>

	<div class="clearfix mt10"><strong><?php echo __('Amount: ', ST_TEXTDOMAIN); ?></strong> <div class="pull-right"><strong><?php echo TravelHelper::format_money_raw( $total_price, $currency ); ?></strong></div></div>
	<div class="clearfix"><strong><?php echo __('Cancellation Fee: ', ST_TEXTDOMAIN); ?></strong> <div class="pull-right"><strong><?php echo $percent . '%'; ?></strong></div></div>
	<div class="line clearfix"></div>
	<div class="clearfix mt10"><strong><?php echo __('Amount refunded: ', ST_TEXTDOMAIN); ?></strong> <div class="pull-right"><strong><?php echo TravelHelper::format_money_raw( $refunded, $currency ); ?></strong></div></div>

	<div class="alert alert-warning mt20" role="alert">
		<div class=""><strong><?php echo __('Why do you want to cancel this order?', ST_TEXTDOMAIN); ?></strong></div>
		<form action="" class="form mt10" method="post">
			<div class="form-group">
				<label for="">
					<input type="radio" name="why_cancel" value="booked_wrong_itinerary" data-text="<?php echo __('Booked wrong itinerary', ST_TEXTDOMAIN); ?>">
					<span><?php echo __('Booked wrong itinerary', ST_TEXTDOMAIN); ?></span>
				</label>
				<label for="">
					<input type="radio" name="why_cancel" value="booked_wrong_dates" data-text="<?php echo __('Booked wrong Dates', ST_TEXTDOMAIN); ?>">
					<span><?php echo __('Booked wrong Dates', ST_TEXTDOMAIN); ?></span>
				</label>
				<label for="">
					<input type="radio" name="why_cancel" value="found_better_itinerary" data-text="<?php echo __('Found better itinerary', ST_TEXTDOMAIN); ?>">
					<span><?php echo __('Found better itinerary', ST_TEXTDOMAIN); ?></span>
				</label>
				<label for="">
					<input type="radio" name="why_cancel" value="found_better_price" data-text="<?php echo __('Found better price', ST_TEXTDOMAIN); ?>">
					<span><?php echo __('Found better price', ST_TEXTDOMAIN); ?></span>
				</label>
				<label for="">
					<input type="radio" name="why_cancel" value="other" >
					<span><?php echo __('Other', ST_TEXTDOMAIN); ?></span>
				</label>
			</div>
			<div class="form-group">
				<textarea name="detail" id="" class="form-control hide">
					
				</textarea>
			</div>	
		</form>
	</div>
</div>
<?php endif; ?>
