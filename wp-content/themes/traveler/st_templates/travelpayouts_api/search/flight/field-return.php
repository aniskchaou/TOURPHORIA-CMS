<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 2/6/2017
 * Version: 1.0
 */
$default=array(
    'title'=>'',
    'is_required'=>'',
    'placeholder'=> ''
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

<div data-tp-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-group input-daterange input-daterange-return form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <label for="field-return-date"><?php echo esc_html( $title)?></label>
    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
    <input  placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" readonly class="form-control tp_return_date <?php echo esc_attr($is_required) ?>" value="" type="text" />
    <input type="hidden" name="return_date" class="tp-date-to" value="">
    <span class="fa fa-question-circle tp-return-note">
        <span class="return-data-tooltip none">
            <?php echo esc_html__('Return date empty for search one-way flights', ST_TEXTDOMAIN);?>
        </span>
    </span>
</div>
