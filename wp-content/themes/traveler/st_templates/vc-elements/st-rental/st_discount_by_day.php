<?php 
/**
*@since 1.2.8
**/
$post_id = get_the_ID();
$post_type = get_post_type( $post_id );
if( in_array( $post_type, array('hotel_room', 'st_rental' ) ) ):
	$discount_by_day = get_post_meta( $post_id, 'discount_by_day', true );
	$discount_type = get_post_meta( get_the_ID(), 'discount_type_no_day', true);
	if( !$discount_type || $discount_type == 'percent' ) 
		$discount_type = '%';
	else $discount_type = TravelHelper::get_current_currency('symbol');
	if( !empty( $discount_by_day ) ):
?>
<strong><?php echo __('Discount by day', ST_TEXTDOMAIN) ?> </strong>
<table class="table">
	<tr>
		<th>#</th>
		<th><?php echo __('Package', ST_TEXTDOMAIN); ?></th>
		<th><?php echo __('No. day (s)', ST_TEXTDOMAIN); ?></th>
		<th><?php echo __('Discount', ST_TEXTDOMAIN); ?><?php if( $discount_type ) echo '( '. $discount_type . ' )'; ?></th>
	</tr>
	<?php 
		$i = 1;
		foreach( $discount_by_day as $item ):
	?>
		<tr>
			<td><?php echo esc_html($i); ?></td>
			<td><?php echo esc_html($item['title']); ?></td>
			<td><?php echo esc_html($item['number_day']); ?></td>
			<td><?php echo esc_html($item['discount']); ?></td>
		</tr>
	<?php $i++; endforeach; ?>
</table>
<?php endif; endif; ?>