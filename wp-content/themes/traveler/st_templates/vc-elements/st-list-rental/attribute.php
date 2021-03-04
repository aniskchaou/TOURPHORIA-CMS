<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 11:59 AM
 */
if(isset($attr))
{
    $default=array(
        'taxonomy'=>'',
        'item_col'=>''
    );
    extract(wp_parse_args($attr,$default));
    if($taxonomy and taxonomy_exists($taxonomy)) {

        $value=get_taxonomy($taxonomy);

        //Check is attribute
            $terms = get_the_terms(get_the_ID(), $taxonomy);
            if (!empty($terms)) {
                ?>
                <ul class="booking-item-features booking-item-features-small booking-item-features-sign clearfix mt5">
                    <?php
                    $i=0;
                    $limit = st()->get_option('car_equipment_info_limit',11);
                    $taxonomy_info = get_post_meta(get_the_ID(),'cars_equipment_info',true);
                    foreach ($terms as $key2 => $value2) {
                        $dk_check = false;
                        if(is_array($taxonomy_info)){
                            foreach($taxonomy_info as $k_info => $v_info){
                                if( $value2->term_id == $v_info['cars_equipment_taxonomy_id'] ){
                                    $dk_check = true;
                                    $data_info = $v_info['cars_equipment_taxonomy_info'];
                                    $data_title_info = $v_info['title'];
                                }
                            }
                        }
                        if($i<$limit){
                            if($dk_check == true){
                                echo  '<li title="" data-placement="top" rel="tooltip" data-original-title="'.$data_title_info.'">
                                                                        <i class="'.TravelHelper::handle_icon(get_tax_meta($value2->term_id, 'st_icon',true)).'"></i>
                                                                        <span class="booking-item-feature-sign">'.$data_info.'</span>
                                                                    </li>';
                            }
                        }
                        $i++;
                    } ?>
                </ul>
                <?php
            }
    }



}