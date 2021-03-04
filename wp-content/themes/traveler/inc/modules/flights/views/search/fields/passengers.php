<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/14/2017
 * Version: 1.0
 */
extract($data);
if(!isset($field_size)) $field_size='lg';
$old = STInput::get('passenger');
$title = esc_html__('Passenger', ST_TEXTDOMAIN);
?>
<div class="form-group form-group-select-plus flight-input form-group-<?php echo esc_attr($field_size)?>">
    <label for="field-passengers"><?php echo esc_html($title)?></label>
    <div class="btn-group btn-group-select-num <?php if($old >=4)echo 'hidden';?>" data-toggle="buttons">
        <label class="btn btn-primary <?php echo (!$old or $old==1)?'active':false; ?>">
            <input type="radio" value="1"  />1</label>
        <label class="btn btn-primary <?php echo ($old==2)?'active':false; ?>">
            <input type="radio" value="2"  />2</label>
        <label class="btn btn-primary <?php echo ($old==3)?'active':false; ?>">
            <input type="radio" value="3"  />3</label>
        <label class="btn btn-primary <?php echo ($old==4)?'active':false; ?>">
            <input type="radio" value="4"  />3+</label>
    </div>
    <select  class="form-control <?php if($old < 4)echo 'hidden';?>" name="passenger">
        <?php $max_passenger = 14;
        for($i=1; $i<=$max_passenger; $i++){
            echo "<option ".selected($old, $i, false)." value='{$i}'>{$i}</option>";
        }
        ?>
    </select>
</div>