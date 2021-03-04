<?php 
/**
*@since 1.2.8
*	Email template for admin
**/
if( !isset( $order_id ) ) return '';

$name = get_post_meta($order_id, 'st_first_name', true);
$item_id = get_post_meta($order_id, 'st_booking_id', true);
$cancel_data = get_post_meta( $order_id, 'cancel_data', true);

$total_price = (float) get_post_meta( $order_id, 'total_price', true);

$user_link = (int)st()->get_option('page_my_account_dashboard', '');
$user_link = get_the_permalink( $user_link );
$refund_manager = esc_url( add_query_arg( array(
                        'sc'      => 'list-refund' ,
                    ) , $user_link ) );
?>
<table id="" class="wrapper" style="width: 1000px; color: #666; border: 1px solid #DDD; margin-top: 70px;" width="90%" cellspacing="0" align="center">
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
<tr>
	<td colspan="2" style="padding: 10px 15px;"><a href="<?php echo esc_url( $refund_manager ); ?>"><?php echo __('Go to the Refund Manager', ST_TEXTDOMAIN); ?></a></td>
</tr>
</tbody>
</table>