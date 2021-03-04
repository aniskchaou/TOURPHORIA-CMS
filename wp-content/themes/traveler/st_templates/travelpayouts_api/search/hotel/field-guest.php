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

?>
<div class="form-group form-passengers-class form-group-<?php echo esc_attr($field_size)?> ">
    <label><?php echo esc_html( $title)?></label>
    <div class="tp_group_display tp_guests_field">
        <span class="display-guests"><span class="quantity-guests">1</span> <?php echo esc_html__('guest(s)', ST_TEXTDOMAIN)?></span>
        <span class="display-icon-dropdown"><i class="fa fa-chevron-down"></i></span>
    </div>
    <div class="tp-form-passengers-class none">
        <div class="twidget-passenger-form-wrapper">
            <ul class="twidget-age-group guests">
                <li>
                    <div class="twidget-cell twidget-age-name"><?php echo esc_html__('Adults', ST_TEXTDOMAIN); ?></div>
                    <div class="twidget-cell twidget-age-select">
                        <span class="twidget-num"><input type="text" name="adults" value="1"></span>
                    </div>
                </li>
                <li>
                    <div class="twidget-cell twidget-age-name"><?php echo wp_kses(__('Children to 17<br>years', ST_TEXTDOMAIN), array('br'=>array()))?></div>
                    <div class="twidget-cell twidget-age-select">
                        <span class="twidget-num"><input type="text" data-text="<?php echo esc_html__('Age (children', ST_TEXTDOMAIN); ?>" class="children" value="0"></span>
                    </div>
                </li>
            </ul>
            <span class="notice none">
                <?php echo esc_html__('You may only search for up to 4 adults and 3 children at a time', ST_TEXTDOMAIN); ?>
            </span>
            <hr>
            <div class="tp-children-group">

            </div>
        </div>
    </div>
</div>