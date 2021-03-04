<?php 
	// from 1.1.9
	echo st()->load_template('cars/filter_price' , false, array('hidde_button'=>true, 'data'=>$data,'field_size'=> isset($field_size) ? $field_size : ''));
?>