<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity filter
 *
 * Created by ShineTheme
 *
 */
if(!isset($instance)) $instance=array();
$default=array(
    'title'=>st_get_language('Filter By').':',
    'st_search_fields'=>'',
    'st_style'         =>'dark'
);

extract(wp_parse_args($instance,$default));

$all_fields=json_decode($st_search_fields);
if($st_style =='dark' ){
    $class_side_bar = 'booking-filters text-white cars-filters';
}else{
    $class_side_bar = 'booking-filters booking-filters-white';
}
?>
<aside class="booking-filters <?php if($st_style=='dark') echo 'text-white'; else echo 'booking-filters-white';?> tours-filters">
    <h3><?php echo apply_filters( 'widget_title' , $title)?></h3>
    <ul class="list booking-filters-list">
        <?php
        if(!empty($all_fields)and is_array($all_fields)):
                foreach($all_fields as $key=>$value):
                    echo '<li>';
                        echo ' <h5 class="booking-filters-title">'.apply_filters( "widget_title" , $value->title).'</h5>';
                        switch($value->field){
                            case "price":
                                echo st()->load_template('activity/filter_price');
                                break;
                            case "rate":
                                $max_rate = 5;
                                echo '<div>';
                                for( $i = $max_rate ; $i >= 1 ; $i-- ) {
                                    $checked = TravelHelper::checked_array( explode( ',' , STInput::get( 'star_rate' ) ) , $i );
                                    if($checked) {
                                        $link = TravelHelper::build_url_auto_key( 'star_rate' , $i , false );
                                    } else {
                                        $link = TravelHelper::build_url_auto_key( 'star_rate' , $i );
                                    }
                                    $link = preg_replace("/page\/\d\//", "", $link);
                                    ?>
                                    <div class="checkbox">
                                        <label>
                                            <input <?php if($checked)
                                                echo 'checked'; ?> value="<?php echo esc_attr( $i )?>" name="star_rate" data-url="<?php echo esc_url( $link ) ?>" class="i-check" type="checkbox"/>
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
                                break;
                            case "taxonomy":
                                TravelHelper::list_tree_tax_search( $value->taxonomy, 0, -1, 'st_activity');
                                echo '</div>';
                                break;
                        }
                    echo "</li>";
                endforeach;
            endif;
        ?>

    </ul>
</aside>