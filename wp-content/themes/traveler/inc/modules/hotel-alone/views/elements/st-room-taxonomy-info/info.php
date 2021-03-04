<?php
extract($atts);
if (!empty($choose_taxonomy)) {
    $tax = get_taxonomy($choose_taxonomy);
    $term = get_the_terms(get_the_ID(), $choose_taxonomy);
    if (is_array($term) && count($term)) {
        ?>
        <div class="helios-room-facilities-info">
            <div class="title">
                <?php echo esc_html($title) ?>
            </div>
            <div class="info">
                <div class="list-facilities number_<?php echo esc_attr($number_of_row) ?>">
                    <?php
                    foreach ($term as $key => $val) {
                        echo '<span class="icon-item">';
                        if (function_exists('get_tax_meta') && $icon = get_tax_meta($val->term_id, 'st_icon')) {
                            echo '<i class="' . TravelHelper::handle_icon($icon) . '"></i>';
                        }else{
                            if($choose_taxonomy == 'room_type') {
                                echo '<i class="fa fa-check-square-o"></i>';
                            }
                        }
                        echo esc_html($val->name);
                        echo '</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
?>