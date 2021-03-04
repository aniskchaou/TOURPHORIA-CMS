<?php
class V2Hotel_Helper{
    static function getRatingText($avg){
        if($avg >= 4.5){
            echo __('Excellent', ST_TEXTDOMAIN);
        }elseif ($avg >= 3.5){
            echo __('Very Good', ST_TEXTDOMAIN);
        }elseif ($avg >= 3){
            echo __('Average', ST_TEXTDOMAIN);
        }else{
            echo __('Poor', ST_TEXTDOMAIN);
        }
    }

    static function getHotelTerm($post_id = false, $tax = 'hotel_facilities'){
        if(!$post_id)
            $post_id = get_the_ID();

        $term = get_the_terms($post_id, $tax);
        if(!is_wp_error($term)){
            return $term;
        }else{
            return false;
        }
    }
}