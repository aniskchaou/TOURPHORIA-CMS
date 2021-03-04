<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/22/2017
 * Version: 1.4.8
 */
$airlines = array(
    '1' => esc_html__('VietNam Airline', ST_TEXTDOMAIN),
    '2' => esc_html__('VietJet', ST_TEXTDOMAIN),
    '3' => esc_html__('Lao Airline', ST_TEXTDOMAIN),
);

$airlines = st_flight_get_airline_popular(10);

echo '<div>';
foreach($airlines as $key => $val){
    $checked = TravelHelper::checked_array( explode( ',' , STInput::get( 'airline' ) ) , $key );
    if($checked) {
        $link = TravelHelper::build_url_auto_key( 'airline' , $key , false );
    } else {
        $link = TravelHelper::build_url_auto_key( 'airline' , $key );
    }
    ?>
    <div class="checkbox">
        <label>
            <input <?php if($checked)
                echo 'checked'; ?> value="<?php echo esc_attr( $key )?>" name="airline" data-url="<?php echo esc_url( $link ) ?>" class="i-check" type="checkbox"/>
            <?php echo esc_attr($val); ?>
        </label>
    </div>
    <?php
}

echo '</div>';

