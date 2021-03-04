<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/22/2017
 * Version: 1.0
 */

wp_enqueue_script( 'ionrangeslider.js' );

?>
<div><form method="get" action="" post_type="st_flight">
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

        $data_min_max = ST_Flight_Helper::inst()->get_min_max_price_flight();

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
        <button style="margin-top: 4px;" type="submit" class="btn btn-primary checkbox-filter-ajax button-filter-price"><?php esc_html_e('Filter','traveler')?></button>
    </form>

</div>
