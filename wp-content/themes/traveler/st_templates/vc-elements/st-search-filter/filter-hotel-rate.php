<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.1.3
 *
 * Activity filter hotel rate
 *
 * Created by ShineTheme
 *
 */
$max_rate = 5;

echo '<div>';
for( $i = $max_rate ; $i >= 1 ; $i-- ) {
    $checked = TravelHelper::checked_array( explode( ',' , STInput::get( 'hotel_rate' ) ) , $i );
    if($checked) {
        $link = TravelHelper::build_url_auto_key( 'hotel_rate' , $i , false );
    } else {
        $link = TravelHelper::build_url_auto_key( 'hotel_rate' , $i );
    }
    ?>
    <div class="checkbox">
        <label>
            <input <?php if($checked)
                echo 'checked'; ?> value="<?php echo esc_attr( $i )?>" name="hotel_rate" data-url="<?php echo esc_url( $link ) ?>" class="i-check" type="checkbox"/>
            <ul class="icon-group search_rating_star">
                <?php $i_s = '<li><i class="fa fa-star"></i></li>';
                for( $k = 1 ; $k <= $i ; $k++ ) {
                    echo balanceTags( $i_s );
                }
                ?>
            </ul>
        </label>
    </div>
<?php
}
echo '</div>';