<?php
$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
$class = isset($settings['class']) ? $settings['class'] : '';
$list = isset($settings['value'])? $settings['value']:'';
$class = isset($settings['class']) ? $settings['class'] : '';
$w = isset($settings['w']) ? $settings['w'] : '';

if(empty($value)){
    $value = isset($settings['std'])? $settings['std']:'';
}
?>
<div class="st_vc_list_image wpb_vc_param_value wpb-input <?php echo esc_attr($class) ?>">
    <label>
        <input type="hidden" name="<?php echo esc_html($param_name) ?>" value="<?php echo esc_html($value) ?>" class="wpb_vc_param_value wpb-input radio_item_value">
    </label>
    <?php
    if(!empty($list)){
        foreach($list as $k=>$v){
            ?>
            <div class="item <?php if($value == $k) echo 'active' ?>" data-image="<?php echo esc_url($v['image']) ?>" data-w="<?php echo esc_attr($w); ?>">
                <img src="<?php echo esc_url($v['image']) ?>" alt="thumb">
                <label>
                    <input type="radio" <?php if($value == $k) echo 'checked' ?> name="custom_<?php echo esc_html($param_name) ?>" value="<?php echo esc_html($k) ?>" class="radio_item wpb-input">
                    <?php echo esc_html($v['title']) ?>
                </label>
            </div>
    <?php
        }
    }
    ?>
</div>


