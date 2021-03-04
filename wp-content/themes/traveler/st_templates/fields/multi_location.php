<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/29/2019
 * Time: 2:51 PM
 */
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$plh = isset($data['plh']) ? $data['plh'] : '';
$default = '';
if(isset($data['std']))
    $default = $data['std'];

$condition = isset($data['condition']) ? $data['condition'] : '';
$operator = isset($data['operator']) ? $data['operator'] : 'or';
$validator= STUser_f::$validator;
$name_input = esc_attr($data['name']);
if(isset($list)){
    $name_input = esc_attr($data['name']) . '[]';
}


?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <input type="text" id="<?php echo 'st-field-' . esc_attr($data['name']); ?>" name="<?php echo esc_attr($name_input); ?>" class="st-partner-field form-control" placeholder="<?php echo esc_html($plh); ?>" value="<?php echo esc_html($default); ?>" data-condition="<?php echo $condition; ?>" data-operator="<?php echo $operator; ?>"/>
    <div class="st_field_msg"></div>
    <div class="dropdown">
        <?php
        $html_location = TravelHelper::treeLocationHtml();
        $post_id = STInput::request('id', '');

        $multi_location = get_post_meta($post_id, 'multi_location', true);
        if (!empty($multi_location) && !is_array($multi_location)) {
            $multi_location = explode(',', $multi_location);
        }
        if (empty($multi_location)) {
            $multi_location = array('');
        }

        if (is_array($html_location) && count($html_location)):
            foreach ($html_location as $key => $location):
                ?>
                <div data-name="<?php echo esc_attr($location['parent_name']); ?>" class="item"
                     style="margin-left: <?php echo esc_attr($location['level'] . 'px;'); ?> margin-bottom: 5px;">
                    <label for="<?php echo 'location-' . $location['ID']; ?>">
                        <input <?php if (in_array('_' . $location['ID'] . '_', $multi_location)) echo 'checked'; ?>
                                id="<?php echo 'location-' . $location['ID']; ?>" type="checkbox"
                                name="multi_location[]" value="<?php echo '_' . $location['ID'] . '_'; ?>">
                        <span><?php echo esc_html($location['post_title']); ?></span>
                    </label>
                </div>
            <?php endforeach; endif; ?>
    </div>
</div>