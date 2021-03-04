<?php
	$start = STInput::get('start');
	$end = STInput::get('end');
	$post_id = get_the_ID();

	$data_seat = ActivityHelper::getSeatAvailability($post_id, $start, $end);
if(!empty($data_seat)){
?>
<div class="seat-availability">
	<div class="slabel">
	<i class="fa fa-check-square-o"></i> <?php echo __('Seat', ST_TEXTDOMAIN); ?>:
	</div>
	<div class="seat-toogle">
		<?php
		foreach ($data_seat as $k => $v){
			echo '<div class="first">';
			if($v['groupday'] == 1 && $v['check_in'] != $v['check_out']){
				echo @date(TravelHelper::getDateFormat(), $v['check_in']) . ' - ' . @date(TravelHelper::getDateFormat(), $v['check_out']) . '<span>' . $v['number_avail'] . ' ' . __('available', ST_TEXTDOMAIN) . '</span>';
			}else{
				echo @date(TravelHelper::getDateFormat(), $v['check_in']) . '<span>' . $v['number_avail'] . ' ' . __('available', ST_TEXTDOMAIN) . '</span>';
			}
			echo '</div>';
		}
		?>
	</div>
</div>
<?php } ?>
