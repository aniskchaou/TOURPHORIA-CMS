<ul class="booking-item-features booking-item-features-small booking-item-features-sign clearfix mt5">
    <?php
    $i=0;
    $limit = st()->get_option('car_equipment_info_limit',11);
    $taxonomy= get_object_taxonomies('st_cars','object');
    $taxonomy_info = get_post_meta(get_the_ID(),'cars_equipment_info',true);
    if(!empty($taxonomy) and is_array($taxonomy)){
        foreach($taxonomy as $key => $value){
            if($key != 'st_category_cars'){
                if($key != 'st_cars_pickup_features') {
                    $data_term = get_the_terms(get_the_ID(), $key, true);
                    if(!empty($data_term) and is_array($data_term)){
                        foreach($data_term as $k=>$v){
                            // check taxonomy info
                            $dk_check = false;
                            if(is_array($taxonomy_info)){
                                foreach($taxonomy_info as $k_info => $v_info){
                                    if(!empty($v_info['cars_equipment_taxonomy_id'])){
                                        if( $v->term_id == $v_info['cars_equipment_taxonomy_id'] ){
                                            $dk_check = true;
                                            $data_info = $v_info['cars_equipment_taxonomy_info'];
                                            $data_title_info="";
                                            if(!empty($v_info['title']))
                                                $data_title_info = $v_info['title'];
                                        }
                                    }
                                }
                            }
                            if($i<$limit){
                                if($dk_check == true){
                                    echo  '<li title="" data-placement="top" rel="tooltip" data-original-title="'.$data_title_info.'">
                                                                        <i class="'.TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true)).'"></i>
                                                                        <span class="booking-item-feature-sign">'.$data_info.'</span>
                                                                    </li>';
                                }else{
                                    /*echo '<li title="" data-placement="top" rel="tooltip" data-original-title="'.esc_html($v->name).'">
                                                        <i class="'.TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true)).'"></i>
                                                  </li>';*/
                                }
                            }
                            $i++;
                        }
                    }
                }
            }
        }
    }
    ?>
</ul>