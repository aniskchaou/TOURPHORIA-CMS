<?php
$term = wp_get_post_terms(get_the_ID() , 'hotel_facilities');
if(!empty($term) && is_array($term) && count($term) > 0){
    $col = round(count($term)/2);
    echo '<div class="tab-amenities"><div class="amenities-left">';
    foreach($term as $key => $val){
        $icon = get_tax_meta($val,'st_icon');
        if(!empty($val->name)) {
            ?>
            <div class="amenity">
                <div class="title">
                    <h5 class="name"><i class="<?php echo TravelHelper::handle_icon($icon); ?>"></i> <?php echo esc_attr($val->name) ?></h5>
                </div>
                <div class="description">
                    <?php echo esc_attr($val->description) ?>
                </div>
            </div>
            <?php
            if (count($term) > 1 && ($col - 1) == $key) {
                echo '</div><div class="amenities-right">';
            }
        }
    }
    echo '</div></div>';
}
?>
