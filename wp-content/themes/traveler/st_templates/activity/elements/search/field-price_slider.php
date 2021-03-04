<?php 
	// from 1.1.9
	if (empty($field_size)) $field_size = 'lg';
	echo st()->load_template('activity/filter_price', false, array('hidde_button'=>true, 'data'=>$data,'field_size'=> $field_size));
?>