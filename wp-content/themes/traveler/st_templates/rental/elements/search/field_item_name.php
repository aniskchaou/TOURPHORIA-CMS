<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 04/06/2015
 * Time: 10:39 SA
 */
   wp_enqueue_script( 'typeahead.js' );
    wp_enqueue_script( 'handlebars-v2.0.0.js' );
    
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
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    
    <label for="field-rental-itemname"><?php echo balanceTags( $title)?></label>
    <i class="fa fa-sort-amount-asc input-icon"></i>
    <input id="field-rental-itemname" name="item_name" <?php echo esc_attr($is_required) ?> value="<?php echo get_query_var('s') ?>" class="typeahead_location form-control <?php echo esc_attr($is_required) ?>" placeholder="<?php echo ($placeholder)? $placeholder:false?>" type="text" />
</div>