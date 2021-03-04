<?php
if(!empty($taxonomy)){
    $taxonomy = explode(",",$taxonomy);
    foreach($taxonomy as $key=>$value){
        $html="";
        $data_term = get_the_terms(get_the_ID(), $value, true);
        if(!empty($data_term)){
            foreach($data_term as $k=>$v){
                $icon = TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true));
                if(empty($icon))  $icon = "fa fa-cogs";
                $html .= '<li title="" data-placement="top" rel="tooltip" data-original-title="'.esc_html($v->name).'">
                                                                            <i class="'.$icon.'"></i>
                                                                      </li>';
            }
        }
        echo '<ul class="booking-item-features booking-item-features-small clearfix">'.balanceTags($html).'</ul>';
    }
}
