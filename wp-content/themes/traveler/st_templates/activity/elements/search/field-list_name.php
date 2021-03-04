<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * activity field list name
 *
 * Created by ShineTheme
 *
 */ 
$default=array(
    'title'=>'',
    'is_required'=>'on',
    'max_num' => 20
);
if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
if(!isset($field_size)) $field_size='lg';
$old_name=STInput::get('item_id');
$list_name = TravelHelper::get_list_name('st_activity'  , $max_num);
    if($is_required == 'on'){
        $is_required = 'required';
    }
?>
<?php if(!empty($list_name) and is_array($list_name)): ?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-list-name"><?php echo esc_html( $title)?></label>
    <i class="fa  fa-sort input-icon"></i>
   <select id="field-list-name" name="item_id" class="form-control" <?php echo esc_attr($is_required) ?>>
       <option value=""><?php _e('-- Select --',ST_TEXTDOMAIN) ?></option>
       <?php foreach($list_name as $k=>$v): ?>
            <option <?php if($old_name == $v['id'] ) echo 'selected' ?> value="<?php echo esc_html($v['id']) ?>">
                <?php echo esc_html($v['title']) ?>
            </option>
       <?php endforeach; ?>
   </select>
</div>
<?php endif ?>