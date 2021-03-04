<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours field people
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
    
    <label for="field-st-people"><?php echo esc_html($title)?></label>
    <i class="fa fa-users input-icon input-icon-highlight"></i>
    <select id="field-st-people" class="form-control <?php echo esc_attr($is_required) ?>" name="people" <?php echo esc_attr($is_required) ?> >
        <option value=""><?php _e('-- Select --',ST_TEXTDOMAIN) ?></option>
        <?php
        for($i=1;$i<=15;$i++)
        {
            echo "<option ".selected($i,STInput::get('people'),false)." value='{$i}'>{$i}</option>";
        }

        ?>
    </select>

</div>