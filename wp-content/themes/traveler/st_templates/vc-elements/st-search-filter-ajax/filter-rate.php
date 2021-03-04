<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.1.3
 *
 * Activity filter rate
 *
 * Created by ShineTheme
 *
 */
$max_rate = 5;

echo '<div class="ajax-filter-wrapper">';
for( $i = $max_rate ; $i >= 1 ; $i-- ) {
    $checked = TravelHelper::checked_array( explode( ',' , STInput::get( 'star_rate' ) ) , $i );
    if($checked) {
        $link = TravelHelper::build_url_auto_key( 'star_rate' , $i , false );
    } else {
        $link = TravelHelper::build_url_auto_key( 'star_rate' , $i );
    }
    ?>
    <div class="checkbox-filter-ajax" data-type="rate" data-value ="<?php echo esc_attr( $i )?>" ><span class="checkbox-yes"><i class="fa fa-check" aria-hidden="true"></i></span></div>
    <ul class="icon-group search_rating_star">
        <?php $i_s = '<li><i class="fa fa-star"></i></li>';
        for( $k = 1 ; $k <= $i ; $k++ ) {
            echo balanceTags( $i_s );
        }
        ?>
    </ul>
<?php
}
echo '</div>';