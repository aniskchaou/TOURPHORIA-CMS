<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 6/14/2017
 * Version: 1.0
 */

extract($atts);

$flight_search_fields = st()->get_option('flight_search_fields','');

if(!empty($title)){
?>
<h1 class="page-title"><?php echo esc_attr($title); ?></h1>
<?php } ?>
<?php
if(!empty($flight_search_fields) && is_array($flight_search_fields)){
    $search_result_page = st()->get_option('flight_search_result_page', '');
    if(!empty($search_result_page)){
        $search_result_page = get_the_permalink($search_result_page);
    }
    if(STInput::get('flight_type',false)){
        $flight_type = STInput::get('flight_type',false);
    }else{
        if($search_type != 'both'){
            $flight_type = $search_type;
        }else{
            $flight_type = 'return';
        }
    }
?>
<form action="<?php echo esc_url($search_result_page); ?>" method="get" class="st-flight-search-form <?php echo esc_attr($style)?> <?php echo ($box_shadow == 'yes'?'booking-item-dates-change mb30':'')?>">
    <div class="tabbable st-flight-search <?php echo esc_attr($flight_type); ?>">
        <input type="hidden" name="flight_type" value="<?php echo esc_attr($flight_type); ?>">
        <?php
        if($search_type == 'both'){
        ?>
        <ul class="nav nav-pills nav-sm nav-no-br mb10" id="myTab">
            <li class="active"><a href="#flight-search-1" data-toggle="tab"><?php echo esc_html__('Round Trip', ST_TEXTDOMAIN)?></a>
            </li>
            <li class="one_way"><a href="#flight-search-1" data-toggle="tab"><?php echo esc_html__('One Way', ST_TEXTDOMAIN)?></a>
            </li>
        </ul>
        <?php } ?>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="flight-search-1">
                <div class="row">

                    <?php
                    foreach($flight_search_fields as $key => $val){
                        $col = 'col-md-6';
                        if(!empty($val['layout2_col'])){
                            $col = 'col-md-'.$val['layout2_col'];
                        }
                        if($style== 'small'){
                            $col = 'col-md-12';
                        }
                        $val['field_size'] = 'no';
                        echo '<div class="'.$val['flight_field_search'].' '.$col.'">';
                        echo st_flight_load_view('search/fields/'.$val['flight_field_search'],false, array('data' => $val));
                        echo '</div>';
                     } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $button_name = esc_html__('Search for Flights', ST_TEXTDOMAIN);
    if(is_page_template('template-flights-search.php')){
        $button_name = esc_html__('Update Search', ST_TEXTDOMAIN);
    }
    ?>
    <input class="btn btn-primary mt10" type="submit" value="<?php echo esc_attr($button_name);  ;?>" />
</form>
<?php } ?>