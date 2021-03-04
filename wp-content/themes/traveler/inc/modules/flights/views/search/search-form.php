<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 7/13/2017
 * Version: 1.0
 */

$flight_search_fields = st()->get_option('flight_search_fields','');

$search_result_page = '';
if(!empty($flight_search_fields) && is_array($flight_search_fields)) {
    $search_result_page = st()->get_option('flight_search_result_page', '');
    if (!empty($search_result_page)) {
        $search_result_page = get_the_permalink($search_result_page);
    }
}

?>
<h2><?php echo esc_html($st_title_search) ?></h2>

<?php
if(!empty($flight_search_fields) && is_array($flight_search_fields) && st_check_service_available('st_flight')){
    $flight_type = STInput::get('flight_type',false)?STInput::get('flight_type',false):'return';
    ?>
    <form action="<?php echo esc_url($search_result_page); ?>" method="get" class="st-flight-search-form">
        <div class="tabbable st-flight-search <?php echo esc_attr($flight_type); ?>">
            <input type="hidden" name="flight_type" value="<?php echo esc_attr($flight_type); ?>">
            <ul class="nav nav-pills nav-sm nav-no-br mb10" id="myTab">
                <li class="<?php echo ($flight_type!='one_way'?'active':'')?>"><a href="#flight-search-1" data-toggle="tab"><?php echo esc_html__('Round Trip', ST_TEXTDOMAIN)?></a>
                </li>
                <li class="one_way <?php echo ($flight_type=='one_way'?'active':'')?>"><a href="#flight-search-1" data-toggle="tab"><?php echo esc_html__('One Way', ST_TEXTDOMAIN)?></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="flight-search-1">
                    <div class="row">
                        <?php foreach($flight_search_fields as $key => $val){
                            $col = 'col-md-6';
                            if(!empty($val['layout_col'])){
                                $col = 'col-md-'.$val['layout_col'];
                            }
                            $val['field_size'] = 'lg';
                            echo '<div class="'.$val['flight_field_search'].' '.$col.'">';
                            echo st_flight_load_view('search/fields/'.$val['flight_field_search'],false, array('data' => $val));
                            echo '</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <input class="btn btn-primary mt10" type="submit" value="<?php echo esc_html__('Search for Flights', ST_TEXTDOMAIN);?>" />
    </form>
<?php } ?>
