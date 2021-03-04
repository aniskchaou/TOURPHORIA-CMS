<?php
if(!isset($field_size)) $field_size=12;
	// from 1.1.9
	echo st()->load_template('rental/filter_price', false, array('hidde_button'=>true, 'data'=>$data,'field_size'=> $field_size));
?>