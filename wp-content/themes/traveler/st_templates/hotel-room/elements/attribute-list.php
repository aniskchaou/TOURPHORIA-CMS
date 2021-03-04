<?php
$adult_number = intval(get_post_meta(get_the_ID(), 'adult_number', true));
$children_number = intval(get_post_meta(get_the_ID(), 'children_number', true));
$bed_number = intval(get_post_meta(get_the_ID(), 'bed_number', true));
$room_footage = intval(get_post_meta(get_the_ID(), 'room_footage', true));
?>
<ul class="booking-item-features booking-item-features-sign clearfix">
    <?php if(!empty($adult_number)){?>
        <li title="" data-placement="top" rel="tooltip" data-original-title="<?php echo __('Adults Occupancy', ST_TEXTDOMAIN); ?>"><i class="fa fa-male"></i>
            <span class="booking-item-feature-sign">x <?php echo esc_html($adult_number) ?></span>
        </li>
    <?php } ?>
    <?php if(!empty($children_number)){?>
        <li title="" data-placement="top" rel="tooltip" data-original-title="<?php echo __('Childs', ST_TEXTDOMAIN); ?>"><i class="im im-children"></i>
            <span class="booking-item-feature-sign">x <?php echo esc_html($children_number) ?></span>
        </li>
    <?php } ?>
    <?php if(!empty($bed_number)){?>
        <li title="" data-placement="top" rel="tooltip" data-original-title="<?php echo __('Beds', ST_TEXTDOMAIN); ?>"><i class="im im-bed"></i>
            <span class="booking-item-feature-sign">x <?php echo esc_html($bed_number) ?></span>
        </li>
    <?php } ?>
    <?php if(!empty($room_footage)){?>
        <li title="" data-placement="top" rel="tooltip" data-original-title="<?php echo __('Room footage (square feet)', ST_TEXTDOMAIN); ?>"><i class="im im-width"></i>
            <span class="booking-item-feature-sign"><?php echo esc_html($room_footage) ?> <?php echo esc_html('m', ST_TEXTDOMAIN); ?></span>
        </li>
    <?php } ?>

</ul>
<?php
if(!empty($taxonomy)){
    $taxonomy = explode(",",$taxonomy);
    foreach($taxonomy as $key=>$value){
        $html="";
        $data_term = get_the_terms(get_the_ID(), $value, true);
        if(!empty($data_term)){
            foreach($data_term as $k=>$v){
                $icon = TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true));
                if(!empty($icon)){
                    $html .= '<li title="" data-placement="top" rel="tooltip" data-original-title="'.esc_html($v->name).'">
                                                                            <i class="'.$icon.'"></i>
                                                                      </li>';
                }
            }
        }
        echo '<ul class="booking-item-features booking-item-features-small clearfix">'.balanceTags($html).'</ul>';
    }
}
