<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 04/06/2015
 * Time: 10:39 SA
 */
$default=array(
    'title'=>'',
    'is_required'=>'on',
    'placeholder'=>''
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
if(!isset($field_size)) $field_size='lg';

if($is_required == 'on'){
    $is_required = 'required';
}
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> ">
    <label for="field-all-data_post_type"><?php echo balanceTags( $title)?></label>
    <select id="field-all-data_post_type" name="data_post_type" class="form-control <?php echo esc_attr($is_required) ?>" <?php echo esc_attr($is_required) ?>>
        <option value="all"><?php _e("All Post Type",ST_TEXTDOMAIN) ?></option>
        <?php if(st_check_service_available('st_hotel')) {  ?>
            <option value="st_hotel" <?php if(STInput::request('data_post_type') == 'st_hotel') echo "selected"; ?> ><?php _e("Hotel",ST_TEXTDOMAIN) ?></option>
        <?php } ?>
        <?php if(st_check_service_available('st_rental')) {  ?>
            <option value="st_rental" <?php if(STInput::request('data_post_type') == 'st_rental') echo "selected"; ?> ><?php _e("Rental",ST_TEXTDOMAIN) ?></option>
        <?php } ?>
        <?php if(st_check_service_available('st_cars')) {  ?>
            <option value="st_cars" <?php if(STInput::request('data_post_type') == 'st_cars') echo "selected"; ?> ><?php _e("Car",ST_TEXTDOMAIN) ?></option>
        <?php } ?>
        <?php if(st_check_service_available('st_tours')) {  ?>
            <option value="st_tours" <?php if(STInput::request('data_post_type') == 'st_tours') echo "selected"; ?> ><?php _e("Tour",ST_TEXTDOMAIN) ?></option>
        <?php } ?>
        <?php if(st_check_service_available('st_activity')) {  ?>
            <option value="st_activity" <?php if(STInput::request('data_post_type') == 'st_activity') echo "selected"; ?> ><?php _e("Activity",ST_TEXTDOMAIN) ?></option>
        <?php } ?>
    </select>
</div>