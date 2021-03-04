<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field taxonomy
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
if(!isset($field_size)) $field_size='lg';

$terms = get_terms('st_location_tax', array(
        'hide_empty' => false,
    ));
if(!empty($terms)):
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?>">
    <label for="field-hotel-location-tax"><?php echo esc_html( $title)?></label>
    <select id="field-hotel-location-tax" class="form-control" name="location_tax">
        <option value=""><?php _e('-- Select --',ST_TEXTDOMAIN) ?></option>
        <?php if(is_array($terms)){ ?>
            <?php foreach($terms as $k => $v){ ?>
                <?php $is_taxonomy = STInput::request('location_tax'); ?>
                <option <?php if(!empty($is_taxonomy[$taxonomy]) and $is_taxonomy[$taxonomy] == $v->term_id) echo 'selected'; ?>  value="<?php echo esc_attr($v->term_id) ?>">
                    <?php echo esc_html($v->name) ?>
                </option>
            <?php } ?>
        <?php } ?>
    </select>
</div>
<?php endif ?>
