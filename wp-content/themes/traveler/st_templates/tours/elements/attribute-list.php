<?php
$html = $html_icons="";
if(!empty($taxonomy)){
    $taxonomy = explode(",",$taxonomy);
    foreach($taxonomy as $key=>$value){
        if($value =='st_tour_type'){
            $data_term = get_the_terms(get_the_ID(), $value, true);
            if(!empty($data_term)){
                foreach($data_term as $k=>$v){
                    $html .= esc_html($v->name).", ";
                }
                $html = substr($html,0,-2);
            }
            echo '<div><i class="fa fa-cog"></i> '.__("Category",ST_TEXTDOMAIN).': '.esc_html($html).'</div>';
        }else{
            $data_term = get_the_terms(get_the_ID(), $value, true);
            if(!empty($data_term)){
                foreach($data_term as $k=>$v){
                    $icon = TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true));
                    if(empty($icon))  $icon = "fa fa-cogs";
                    $html_icons .= '<li title="" data-placement="top" rel="tooltip" data-original-title="'.esc_html($v->name).'">
                                                                            <i class="'.$icon.'"></i>
                                                                      </li>';
                }
            }
            echo '<ul class="booking-item-features booking-item-features-small clearfix">'.balanceTags($html_icons).'</ul>';
        }
    }
}
?>