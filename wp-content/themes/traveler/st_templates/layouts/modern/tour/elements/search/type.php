<?php
$taxonomy = STInput::get('taxonomy');
$tour_type = isset($taxonomy['tour_type']) ? $taxonomy['tour_type'] : '';
$has_icon = (isset($has_icon)) ? $has_icon : false;
?>
<div class="form-group form-tour-type-field form-tour-type clearfix <?php if ($has_icon) echo ' has-icon '; ?>">
    <?php
    if ($has_icon) {
        echo TravelHelper::getNewIcon('ico_calendar_search_box');
    }
    ?>
    <label><?php echo __('Tour Type', ST_TEXTDOMAIN); ?></label>
    <?php
    $terms = get_terms(array(
        'taxonomy' => 'st_tour_type',
        'hide_empty' => false,
    ));
    ?>
    <select name="taxonomy[tour_type]" class="st-select2">
        <?php
        if (!empty($terms)) {
            foreach ($terms as $term) {
                echo '<option value="' . $term->term_id . '">' . esc_html($term->name) . '</option>';
            }
        }
        ?>
    </select>
</div>