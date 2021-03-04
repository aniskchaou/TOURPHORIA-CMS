<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/14/2017
 * Version: 1.0
 */

wp_enqueue_style( 'st-flight-select-css' );
//wp_enqueue_script( 'st-flight-select-js' );

$default=array(
    'title'=>'',
    'placeholder'=>'',
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

if(!isset($field_size)) $field_size='lg';

$destination = STInput::get('destination', '');
$destination_name = STInput::get('destination_name', '');
$list_airport = get_terms('st_airport', array(
    'hide_empty' => false
));

?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left flight-input">
    <label for="field-hotel-location"><?php echo esc_attr($title); ?></label>
    <i class="fa fa-plane input-icon"></i>
    <div class="st-select-wrapper">
        <input  autocomplete="off" type="text" name="destination_name" value="<?php echo esc_attr($destination_name); ?>" class="form-control st-flight-location-name destination <?php echo esc_attr($is_required); ?>" placeholder="<?php if($placeholder) echo $placeholder; ?>">
        <select  name="destination" class="st-location-id st-hidden" placeholder="<?php if($placeholder) echo $placeholder; ?>" tabindex="-1">
            <option value=""></option>
            <?php
            if(!empty($list_airport[0]->name)){
                foreach($list_airport as $key => $val){
                    $iata_airport = get_tax_meta($val->term_id , 'iata_airport');
                    $iata_and_key = $iata_airport .'--'. $val->term_id;
                    if(!empty($iata_airport)){
                        echo '<option '.selected($destination, $iata_and_key, false).' value="'.esc_attr($iata_and_key).'">'.st_flight_get_airport_text($val->term_id, $val->name).'</option>';
                    }
                }
            }
            ?>
        </select>
        <div class="option-wrapper"></div>
    </div>
</div>
