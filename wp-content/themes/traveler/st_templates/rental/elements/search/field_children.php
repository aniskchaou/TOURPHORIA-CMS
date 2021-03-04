<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field children
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>''
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
$old=STInput::get('child_number');

if(!isset($field_size)) $field_size='lg';
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-select-plus">
    <label for="field-rental-children"><?php echo esc_html( $title)?></label>

    <div class="btn-group btn-group-select-num <?php if($old>=3)echo 'hidden';?>" data-toggle="buttons">
        <label class="btn btn-primary <?php echo (!$old)?'active':false; ?>">
            <input type="radio" value="0"  />0</label>
        <label class="btn btn-primary <?php echo ($old==1)?'active':false; ?>">
            <input type="radio" value="1"  />1</label>
        <label class="btn btn-primary <?php echo ($old==2)?'active':false; ?>">
            <input type="radio" value="2"  />2</label>
        <label class="btn btn-primary <?php echo ($old==3)?'active':false; ?>">
            <input type="radio" value="3"  />2+</label>
    </div>
    <select id="field-rental-children" class="form-control <?php if($old<3)echo 'hidden';?>" name="child_number">
        <?php $adult_max=st()->get_option('hotel_max_child',14);
        for($i=0;$i<=$adult_max;$i++){
            echo "<option ".selected($old,$i,false)." value='{$i}'>{$i}</option>";
        }
        ?>
    </select>
</div>