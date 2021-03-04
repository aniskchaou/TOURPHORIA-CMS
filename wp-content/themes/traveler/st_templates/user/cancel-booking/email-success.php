<?php 
/**
*@since 1.2.8
*	Email template refund success
**/
if( !isset( $order_id ) ) return '';

$name = get_post_meta($order_id, 'st_first_name', true);
$item_id = get_post_meta($order_id, 'st_booking_id', true);
$cancel_data = get_post_meta( $order_id, 'cancel_data', true);

$total_price = (float) get_post_meta( $order_id, 'total_price', true);
?>
<table id="" class="wrapper" style="width: 1000px; color: #666; border: 1px solid #666; margin-top: 70px;" width="90%" cellspacing="0" align="center">
<tbody>
<tr>
	<td width="40%" style="padding: 10px 15px;"><strong><?php echo __('Order ID: ', ST_TEXTDOMAIN); ?></strong></td>
	<td align="right" style="padding: 10px 15px;" width="60%"><?php echo $order_id; ?></td>
</tr>
<tr>
	<td width="40%" style="padding: 10px 15px;"><strong><?php echo __('Service: ', ST_TEXTDOMAIN); ?></strong></td>
	<td align="right" style="padding: 10px 15px;" width="60%"><?php echo get_the_title( $item_id ); ?></td>
</tr>
<tr>
	<td width="40%" style="padding: 10px 15px;"><strong><?php echo __('Amount: ', ST_TEXTDOMAIN); ?></strong></td>
	<td align="right" style="padding: 10px 15px;" width="60%"><?php echo TravelHelper::format_money_raw( $total_price, $cancel_data['currency'] ); ?></td>
</tr>
<tr>
	<td width="40%" style="padding: 10px 15px;"><strong><?php echo __('Cancellation Fee: ', ST_TEXTDOMAIN); ?></strong></td>
	<td align="right" style="padding: 10px 15px;" width="60%"><?php echo $cancel_data['cancel_percent'].'%'; ?></td>
</tr>
<tr>
	<td width="40%" style="padding: 10px 15px;"><strong><?php echo __('Refunded Amount: ', ST_TEXTDOMAIN); ?></strong></td>
	<td align="right" style="padding: 10px 15px;" width="60%"><?php echo TravelHelper::format_money_raw( $cancel_data['refunded'], $cancel_data['currency'] ); ?></td>
</tr>
<tr>
	<td width="40%" style="padding: 10px 15px;"><strong><?php echo __('Status: ', ST_TEXTDOMAIN); ?></strong></td>
	<td align="right" style="padding: 10px 15px;" width="60%"><?php echo $cancel_data['cancel_refund_status']; ?></td>
</tr>
</tbody>
</table>