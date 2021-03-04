<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/22/2017
 * Version: 1.0
 */

$stop_arr = array(
    'direct' => esc_html__('Non-stop', ST_TEXTDOMAIN),
    'one_stop' => esc_html__('1 Stop', ST_TEXTDOMAIN),
    'two_stops' => esc_html__('2 Stops', ST_TEXTDOMAIN),
);

echo '<div>';
foreach($stop_arr as $key => $val){
    $checked = TravelHelper::checked_array( explode( ',' , STInput::get( 'stops' ) ) , $key );
    if($checked) {
        $link = TravelHelper::build_url_auto_key( 'stops' , $key , false );
    } else {
        $link = TravelHelper::build_url_auto_key( 'stops' , $key );
    }
    ?>
    <div class="checkbox">
        <label>
            <input <?php if($checked)
                echo 'checked'; ?> value="<?php echo esc_attr( $key )?>" name="stops" data-url="<?php echo esc_url( $link ) ?>" class="i-check" type="checkbox"/>
                <?php echo esc_attr($val); ?>
        </label>
    </div>
    <?php
}

echo '</div>';