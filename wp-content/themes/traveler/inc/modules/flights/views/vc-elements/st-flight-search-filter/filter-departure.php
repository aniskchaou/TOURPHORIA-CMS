<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/22/2017
 * Version: 1.4.8
 */
$depart_time_arr = array(
    'mn' => esc_html__('Morning (5:00a - 11:59a)', ST_TEXTDOMAIN),
    'at' => esc_html__('Afternoon (12:00p - 5:59p)', ST_TEXTDOMAIN),
    'ev' => esc_html__('Evening (6:00p - 11:59p)', ST_TEXTDOMAIN),
);

echo '<div>';
foreach($depart_time_arr as $key => $val){
    $checked = TravelHelper::checked_array( explode( ',' , STInput::get( 'dp_time' ) ) , $key );
    if($checked) {
        $link = TravelHelper::build_url_auto_key( 'dp_time' , $key , false );
    } else {
        $link = TravelHelper::build_url_auto_key( 'dp_time' , $key );
    }
    ?>
    <div class="checkbox">
        <label>
            <input <?php if($checked)
                echo 'checked'; ?> value="<?php echo esc_attr( $key )?>" name="dp_time" data-url="<?php echo esc_url( $link ) ?>" class="i-check" type="checkbox"/>
            <?php echo esc_attr($val); ?>
        </label>
    </div>
    <?php
}

echo '</div>';

