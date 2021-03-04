<?php
    $aff_id = st()->get_option('hotelscb_aff_id', '');
    $searchbox_id = st()->get_option('hotelscb_searchbox_id', '');
    if(!empty($aff_id) && !empty($searchbox_id)){
        echo '<script src="https://sbhc.portalhc.com/'. $aff_id .'/SearchBox/'. $searchbox_id .'" ></script>';
    }else{
        echo __('No data for search box.', ST_TEXTDOMAIN);
    }
?>
