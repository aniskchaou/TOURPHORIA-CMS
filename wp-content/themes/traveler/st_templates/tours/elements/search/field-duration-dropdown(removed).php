<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours field duration
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>'',
    'is_required'=>'on',
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
    if($is_required == 'on'){
        $is_required = 'required';
    }
?>
<div class="form-group form-group-lg form-group-icon-left">
    
    <label for="field-tour-duration-dropdown"><?php echo esc_html($title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <select id="field-tour-duratio-dropdown"  name="duration" class="form-control">
        <option value=""><?php _e('-- Select --',ST_TEXTDOMAIN) ?></option>
        <?php
            for($i=1 ; $i <= 50 ; $i++){
                if($i == STInput::get('duration')){
                    echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
                }else{
                    echo '<option value="'.$i.'">'.$i.'</option>';
                }
            }
        ?>
    </select>
</div>