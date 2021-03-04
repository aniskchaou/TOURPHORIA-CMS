<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 2:47 PM
 */
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$plh = isset($data['plh']) ? $data['plh'] : '';

$std_value = array();
if(!empty($post_id)){
    $std_value = get_post_meta($post_id, $data['name'], true);
}

$condition = isset($data['condition']) ? $data['condition'] : '';
$operator = isset($data['operator']) ? $data['operator'] : 'or';

$sc = STInput::get('sc');
?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?> st-partner-field" data-condition="<?php echo esc_attr($condition); ?>" data-operator="<?php echo esc_attr($operator); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <?php
    if(!empty($data['fields'])){
        echo '<div class="item origin"><div class="listitem-title">New item</div><div class="del"></div><div class="row">';
        foreach ($data['fields'] as $k => $v){
            $class_col = 'col-lg-12';
            if(!empty($v['col']))
                $class_col = 'col-lg-' . $v['col'];
            ?>
            <div class="item-inner <?php echo esc_attr($class_col); ?>">
                <?php echo st()->load_template('fields/' . $v['type'], '', array('data' => $v, 'list' => true)); ?>
            </div>
            <?php
        }
        echo '</div></div>';
    }
    if(!empty($post_id)){
        if(!empty($std_value)){
            foreach ($std_value as $k => $v){
                $arr_key = array_keys($v);
                echo '<div class="item">';
                ?>
                <div class="listitem-title">
                    <?php echo esc_html($v[$arr_key[0]]); ?>
                </div>
            <?php
            echo '<div class="del"></div><div class="row">';
                foreach ($data['fields'] as $kk => $vv){
                    $class_col = 'col-lg-12';
                    if(!empty($v['col']))
                        $class_col = 'col-lg-' . $v['col'];


                    $name_temp = $vv['name'];
                    if($name_temp == 'policy_title')
                        $name_temp = 'title';

                    if($name_temp == 'property-item[title]')
                        $name_temp = 'title';
                    if($name_temp == 'property-item[featured_image]')
                        $name_temp = 'featured_image';
                    if($name_temp == 'property-item[description]')
                        $name_temp = 'description';
                    if($name_temp == 'property-item[icon]')
                        $name_temp = 'icon';
                    if($name_temp == 'property-item[map_lat]')
                        $name_temp = 'map_lat';
                    if($name_temp == 'property-item[map_lng]')
                        $name_temp = 'map_lng';
                    if($name_temp == 'add_new_facility_title')
                        $name_temp = 'title';
                    if($name_temp == 'add_new_facility_value')
                        $name_temp = 'facility_value';
                    if($name_temp == 'add_new_facility_icon')
                        $name_temp = 'facility_icon';

                    if($name_temp == 'discount_by_day[title]')
                        $name_temp = 'title';
                    if($name_temp == 'discount_by_day[number_day]')
                        $name_temp = 'number_day';
                    if($name_temp == 'discount_by_day[discount]')
                        $name_temp = 'discount';

                    if($name_temp == 'extra[title]')
                        $name_temp = 'title';
                    if($name_temp == 'extra[extra_name]')
                        $name_temp = 'extra_name';
                    if($name_temp == 'extra[extra_max_number]')
                        $name_temp = 'extra_max_number';
                    if($name_temp == 'extra[extra_price]')
                        $name_temp = 'extra_price';

                    if($name_temp == 'tours_faq_title')
                        $name_temp = 'title';
                    if($name_temp == 'tours_faq_desc')
                        $name_temp = 'desc';

                    if($name_temp == 'program_title')
                        $name_temp = 'title';
                    if($name_temp == 'program_desc')
                        $name_temp = 'desc';

                    if($name_temp == 'discount_by_adult_title')
                        $name_temp = 'title';
                    if($name_temp == 'discount_by_adult_key')
                        $name_temp = 'value';
                    if($name_temp == 'discount_by_adult_key_to')
                        $name_temp = 'key';
                    if($name_temp == 'discount_by_adult_value')
                        $name_temp = 'key_to';

                    if($name_temp == 'discount_by_child_title')
                        $name_temp = 'title';
                    if($name_temp == 'discount_by_child_key')
                        $name_temp = 'value';
                    if($name_temp == 'discount_by_child_key_to')
                        $name_temp = 'key';
                    if($name_temp == 'discount_by_child_value')
                        $name_temp = 'key_to';

                    if($name_temp == 'activity_faq_title')
                        $name_temp = 'title';
                    if($name_temp == 'activity_faq_desc')
                        $name_temp = 'desc';

                    if($name_temp == 'equipment_item_title')
                        $name_temp = 'title';
                    if($name_temp == 'equipment_item_price')
                        $name_temp = 'cars_equipment_list_price';
                    if($name_temp == 'equipment_item_price_unit')
                        $name_temp = 'price_unit';
                    if($name_temp == 'equipment_item_price_max')
                        $name_temp = 'cars_equipment_list_price_max';

                    if($name_temp == 'features_title')
                        $name_temp = 'title';
                    if($name_temp == 'features_taxonomy')
                        $name_temp = 'cars_equipment_taxonomy_id';
                    if($name_temp == 'taxonomy_info')
                        $name_temp = 'cars_equipment_taxonomy_info';

                    if($name_temp == 'rdistance-item[title]')
                        $name_temp = 'title';
                    if($name_temp == 'rdistance-item[icon]')
                        $name_temp = 'icon';
                    if($name_temp == 'rdistance-item[name]')
                        $name_temp = 'name';
                    if($name_temp == 'rdistance-item[distance]')
                        $name_temp = 'distance';

                    if($sc != 'edit-room'){
                        if($name_temp == 'facility_value')
                            $name_temp = 'value';
                    }

                    if($sc == 'edit-cars' || $sc == 'create-cars'){
                        if($name_temp == 'st_title')
                            $name_temp = 'title';
                        if($name_temp == 'st_number_start')
                            $name_temp = 'number_start';
                        if($name_temp == 'st_number_end')
                            $name_temp = 'number_end';
                        if($name_temp == 'st_price_by_number')
                            $name_temp = 'price';

                        if($name_temp == 'journey_title')
                            $name_temp = 'title';
                        if($name_temp == 'journey_transfer_from')
                            $name_temp = 'transfer_from';
                        if($name_temp == 'journey_transfer_to')
                            $name_temp = 'transfer_to';
                        if($name_temp == 'journey_price')
                            $name_temp = 'price';
                        if($name_temp == 'journey_return')
                            $name_temp = 'return';
                    }

                    ?>
                    <div class="item-inner <?php echo esc_attr($class_col); ?>">
                        <?php echo st()->load_template('fields/' . $vv['type'], '', array('data' => $vv, 'list' => true, 'list_val' => $v[$name_temp], 'post_id' => $post_id)); ?>
                    </div>
                    <?php
                }
                echo '</div></div>';
            }
        }
    }
    ?>
    <div class="add-item">
        <?php
            if(isset($data['text_add']) && !empty($data['text_add'])){
                echo esc_html($data['text_add']);
            }else{
                echo __('Add new item', ST_TEXTDOMAIN);
            }
        ?>
    </div>
</div>