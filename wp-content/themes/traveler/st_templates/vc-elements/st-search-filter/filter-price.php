<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.1.3
 *
 * Activity filter price
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'ionrangeslider.js' );


?>
<div><form method="get" action="" post_type="<?php echo esc_html($post_type) ?>">
    <?php $get=STInput::get();

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

    if($post_type == 'all'){
        $data_min_max = TravelerObject::get_min_max_price_all_post_type();
    }else{
        $data_min_max = TravelerObject::get_min_max_price( $post_type );
    }


    $max = ( (float) $data_min_max['price_max'] > 0 ) ? (float) $data_min_max['price_max'] : 0;
    $min = ( (float) $data_min_max['price_min'] > 0 ) ? (float) $data_min_max['price_min'] : 0;

    if (TravelHelper::get_default_currency('rate') != 0 and TravelHelper::get_default_currency('rate')){
        $rate_change = TravelHelper::get_current_currency('rate')/TravelHelper::get_default_currency('rate');
        $max = round($rate_change *$max);
        if( (float)$max < 0 ) $max = 0;

        $min = round($rate_change *$min);
        if( (float)$min < 0 ) $min = 0;
    }

    $value_show= $min.";".$max ; // default if error

    if (!empty($rate_change)){
        if (STInput::request('price_range')){
            $price_range  = explode(';' , STInput::request('price_range'));

            $value_show = $price_range[0].";".$price_range[1];
        }else {

            $value_show  = $min.";".$max;
        }
    }
    echo '<input name="price_range" type="text" value="'.$value_show.'" class="price-slider" data-symbol="'.TravelHelper::get_current_currency('symbol').'" data-min="'.esc_attr($min).'" data-max="'.esc_attr($max).'" data-step="'.st()->get_option('search_price_range_step',0).'">';

    ?>
    <button style="margin-top: 4px;" type="submit" class="btn btn-primary"><?php esc_html_e('Filter','traveler')?></button>
</form>

</div>
