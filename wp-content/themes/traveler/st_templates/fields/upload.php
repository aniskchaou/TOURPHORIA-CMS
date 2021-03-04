<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 3/27/2019
 * Time: 9:44 AM
 */
$multi = 'false';
if(isset($data['multi']) && $data['multi'])
    $multi = 'true';
$require_text = '';
if(isset($data['required']) && $data['required'])
    $require_text = '<span class="required">*</span>';

$plh = isset($data['plh']) ? $data['plh'] : '';

$arr_img = [];
$arr_str = '';

$name_input = esc_attr($data['name']);
if(isset($list)){
    $name_input = esc_attr($data['name']) . '[]';
}

$data_output = 'id';
if(isset($data['output']) && !empty($data['output']))
    $data_output = $data['output'];

if(!empty($post_id)){
    if(!isset($list_val) || empty($list_val)) {
        if ($data['name'] != 'id_featured_image') {
            $name_temp = $data['name'];
            if ($data['name'] == 'id_gallery') {
                $name_temp = 'gallery';
            }
            $arr_str = get_post_meta($post_id, $name_temp, true);
        } else {
            $arr_str = get_post_thumbnail_id($post_id);
        }

    }else{
        $arr_str = $list_val;
    }
    if (!empty($arr_str)) {
        $arr_ids = explode(',', $arr_str);
        if (!empty($arr_ids)) {
            foreach ($arr_ids as $k => $v) {
                if ($data_output == 'url') {
                    $arr_img[$k] = $v;
                } else {
                    $img = wp_get_attachment_image_url($v, 'thumbnail');
                    $arr_img[$v] = $img;
                }
            }
        }
    }
}
?>
<div class="form-group st-field-<?php echo esc_attr($data['type']); ?>">
    <label for="<?php echo 'st-field-' . esc_attr($data['name']); ?>"><?php echo esc_html($data['label']) . ' ' . $require_text; ?></label>
    <div class="st-selection">
    <?php
    if(!empty($arr_img)){
        foreach ($arr_img as $k => $v){
            ?>
            <div class="item" style="background-image: url('<?php echo esc_attr($v); ?>')"><div class="del" data-id="<?php echo $k; ?>" data-url="<?php echo $v; ?>" data-output="<?php echo $data_output; ?>"></div></div>
            <?php
        }
    }
    ?>
    </div>
    <div class="st-upload" data-multi="<?php echo $multi; ?>" data-output="<?php echo esc_attr($data_output); ?>">
        <div class="inner">
            <span class="add">+</span>
            <span class="text"><?php echo __('Upload', ST_TEXTDOMAIN); ?></span>
        </div>
        <input type="hidden" id="<?php echo 'st-field-' . esc_attr($data['name']); ?>" name="<?php echo esc_attr($name_input); ?>" class="st-partner-field form-control" placeholder="<?php echo esc_html($plh); ?>" value="<?php echo esc_html($arr_str); ?>"/>
    </div>
    <div class="st_field_msg"></div>
</div>
