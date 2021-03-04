<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity filter price
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'ionrangeslider.js' );

if(!isset( $field_size ))
    $field_size = 'md';
?>
<?php if(empty($hidde_button)){ ?><div><form method="get" action=""><?php }else { ?><div class=" form-group form-group-<?php echo esc_attr($field_size) ?> "><?php }?>
    <?php $get=STInput::get();
    if (!empty($data) and is_array($data)){
    if ($data['title']){
        echo  "<label>".$data['title']."</label>";
        }
    }
    if(!empty($get) and empty($hidde_button)){
        foreach($get as $key=>$value){

            if(is_array($value)){
                if(!empty($value)){
                    foreach($value as $key2=>$value2){

                        echo "<input  type='hidden' name='{$key}[{$key2}]' value='$value2' >";
                    }
                }
            }else{
                if($key!="price_range")
                echo "<input type='hidden' name='$key' value='$value' >";
            }
        }
    }
    $data_min_max = TravelerObject::get_min_max_price('st_activity');
    $max = ( (float) $data_min_max['price_max'] > 0 ) ? (float) $data_min_max['price_max'] : 0;
    $min = ( (float) $data_min_max['price_min'] > 0 ) ? (float) $data_min_max['price_min'] : 0;

    if (TravelHelper::get_default_currency('rate') !=0 and TravelHelper::get_default_currency('rate')){
        $rate_change = TravelHelper::get_current_currency('rate')/TravelHelper::get_default_currency('rate');
        $max = round($rate_change *$max);
        if( (float)$max < 0 ) $max = 0;

        $min = round($rate_change *$min);
        if( (float)$min < 0 ) $min = 0;
    }
    /*$min = number_format($min , TravelHelper::get_current_currency('booking_currency_precision')) ; 
    $max = number_format($max , TravelHelper::get_current_currency('booking_currency_precision')) ;*/
    $value_show= $min.";".$max ; // default if error

    if ($rate_change){
         if (STInput::request('price_range')){
            $price_range  = explode(';' , STInput::request('price_range'));
             
            $value_show = $price_range[0].";".$price_range[1];
        }else {
             
            $value_show  = $min.";".$max;
        }
    }
     
    echo '<input name="price_range" type="text" value="'.$value_show.'" class="price-slider" data-symbol="'.TravelHelper::get_current_currency('symbol').'" data-min="'.esc_attr($min).'" data-max="'.esc_attr($max).'" data-step="'.st()->get_option('search_price_range_step',0).'">';

    ?>
    <?php if(empty($hidde_button)){ ?>
    <button style="margin-top: 4px;" type="submit" class="btn btn-primary"><?php esc_html_e('Filter','traveler')?></button>
    <?php  } ; ?>
<?php if(empty($hidde_button)){ ?></form></div><?php }else { ?> </div> <?php };?>

