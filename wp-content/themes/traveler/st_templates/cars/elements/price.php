<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element price
 *
 * Created by ShineTheme
 *
 */

//check is booking with modal
$st_is_booking_modal = apply_filters('st_is_booking_modal',false);
$car = new STCars();
$field_list=$car->get_search_fields_box();
$field_type=$car->get_search_fields_name();
$set_col = empty($attr['st_style'])? 1 : $attr['st_style'];
$col = 12 / $attr['st_style'];

///// get Date Time
$pick_up_date=TravelHelper::convertDateFormat(STInput::request('pick-up-date'));
if(empty($pick_up_date)) $pick_up_date = date('m/d/Y',strtotime("now"));
$drop_off_date=TravelHelper::convertDateFormat(STInput::request('drop-off-date'));
if(empty($drop_off_date)) $drop_off_date = date('m/d/Y',strtotime("+1 day"));
$pick_up_time = STInput::request('pick-up-time','12:00 PM');
$drop_off_time = STInput::request('drop-off-time','12:00 PM');
$pick_up=STInput::request('pick-up','');
$location_id_drop_off = STInput::request('location_id_drop_off','');
$drop_off=STInput::request('drop-off','');
$location_id_pick_up = STInput::request('location_id_pick_up','');
$start = $pick_up_date.' '.$pick_up_time;
$start = strtotime($start);
$end = $drop_off_date.' '.$drop_off_time;
$end = strtotime($end);
$time=STCars::get_date_diff($start,$end);

///// get Price
$info_price = STCars::get_info_price(get_the_ID(),$start,$end);
$cars_price = $info_price['price'];
$count_sale = $info_price['discount'];
$price_origin = $info_price['price_origin'];
$list_price = $info_price['list_price'];

$data_price_tmp = STPrice::getSaleCarPrice(get_the_ID(),$price_origin,$start,$end,$location_id_pick_up,$location_id_drop_off);

$car_unit_price = st()->get_option('cars_price_unit', 'day');
$car_data_type = '';
if($car_unit_price == 'day' || $car_unit_price == 'hour'){
    $enable_equipment_by_unit = st()->get_option('equipment_by_unit', 'off');
    if($enable_equipment_by_unit == 'on'){
        $car_data_type = ' data-equip="on"';
    }
}
?>
<form  id="form-booking-inpage" method="post" class="car_booking_form"  <?php echo esc_html($car_data_type); ?>>
<div class="booking-item-price-calc">
    <div class="row row-wrap">
        <?php
        $current_rate = 1;
        $current      = TravelHelper::get_current_currency('name');
        $default      = TravelHelper::get_default_currency('name');
        if($current != $default) {
            $current_rate = TravelHelper::get_current_currency('rate');
        }
        ?>
        <input type="hidden" name="price_rate" value="<?php echo esc_html($current_rate)?>">
        <div class="col-md-<?php echo esc_attr($col) ?> singe_cars" data-car-id="<?php the_ID()?>">
            <?php $list = get_post_meta(get_the_ID(),'cars_equipment_list',true);
            ?>
            <?php
            if(!empty($list)){
                foreach($list as $k=>$v){
					$v['cars_equipment_list_price'] = apply_filters('st_apply_tax_amount',$v['cars_equipment_list_price']);

                    $price_unit = isset($v['price_unit'])? $v['price_unit']: '';
                    $price_max = isset($v['cars_equipment_list_price_max'])? $v['cars_equipment_list_price_max']: '';

                    $price_unit_html='';
                    switch($price_unit)
                    {
                        case "per_hour":
                            $price_unit_html=__('/hour',ST_TEXTDOMAIN);
                            $time_per_unit =STCars::get_date_diff($start,$end, $price_unit);
                            break;
                        case "per_day":
                            $price_unit_html=__('/day',ST_TEXTDOMAIN);
                            $time_per_unit =STCars::get_date_diff($start,$end, $price_unit);
                            break;
                        default:
                            $price_unit_html='';
                            $time_per_unit = '1';
                            break;
                    }
                    echo '<div class="equipment-list clearfix">';
                    //Add price convert equipment
                    echo '<div class="checkbox">
                            <label>
                                <input class="i-check equipment" data-price-max="'.$price_max.'" data-number-unit="'. $time_per_unit .'" data-price-unit="'.$price_unit.'" data-title="'.$v['title'].'" data-price="'. $v['cars_equipment_list_price'] . '" data-convert-price="'. TravelHelper::convert_money_from_to($v['cars_equipment_list_price']) .'" type="checkbox" />'.$v['title'].'
                                <span class="pull-right">'.TravelHelper::format_money($v['cars_equipment_list_price']).''.$price_unit_html.'</span></label>
                       </div>';
                   if( !empty($v['cars_equipment_list_number']) && (int) $v['cars_equipment_list_number'] > 1){
                        echo '<select class="pull-right" name="number_equipment">';
                        $numbers = (int) $v['cars_equipment_list_number'];
                        for($i = 1; $i <= $numbers; $i++){
                            echo '<option value ="'.$i.'">'.$i.'</option>';
                        }
                        echo '</select>';
                    } 
                    echo '</div>';
                }
            }
            ?>
            <div class="cars_equipment_display"></div>
        </div>
        <div class="col-md-<?php echo esc_attr($col) ?>">
            <ul class="list">
                <?php if(empty($list_price)){ ?>
                <li>
                    <p><?php echo st_get_language('car_price_per').' '.ucfirst(STCars::get_price_unit('label')); ?>
                        <span><?php echo TravelHelper::format_money($cars_price) ?></span>
                    </p>
                </li>
                <?php }else{ ?>
                    <li>
                        <p><?php echo st_get_language('car_price_per').' '.ucfirst(STCars::get_price_unit('label')); ?></p>
                        <div class="show_custom_price">
                            <ul>
                                <?php
                                $format = "d/m";
                                $tmp_price = 0;
                                $list_price = STPrice::convert_array_date_custom_price_by_date($list_price);
                                foreach($list_price as $k => $v):
                                ?>
                                <li>
                                    <p class="margin_0">
                                        <?php if($v['start'] == $v['end']){
                                            $format = "d/m/y";
                                            ?>
                                            <?php echo esc_html(date_i18n($format,strtotime($v['start']))) ?>
                                        <?php }else{ ?>
                                            <?php echo esc_html(date_i18n($format,strtotime($v['start']))) ?>
                                            -
                                            <?php echo esc_html(date_i18n($format,strtotime($v['end']))) ?>
                                        <?php } ?>
                                        <span class="pull-right"><?php echo esc_html(TravelHelper::format_money($v['price'])) ?></span>
                                    </p>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </li>
                <?php } ?>

                <?php  if(isset($_REQUEST['pick-up-date']) && !empty($_REQUEST['pick-up-date']) && isset($_REQUEST['drop-off-date']) && !empty($_REQUEST['drop-off-date'])):
                ?>
                <li><p>
                        <?php st_the_language('car_rental_price'); ?>
                        <span class="st_cars_price" data-value="<?php echo TravelHelper::convert_money_from_to(esc_html($data_price_tmp)); ?>" >
                            <?php echo TravelHelper::format_money($data_price_tmp) ?>
                        </span>
                    </p>
                    <?php
                    $unit = st()->get_option('cars_price_unit', 'day');
                    if($unit == 'distance'){
                        $number_distance = STPrice::getDistanceByCar($location_id_pick_up,$location_id_drop_off);
                    ?>
                        <small><?php echo esc_attr($number_distance) ?> <?php if($number_distance > 1) echo STCars::get_price_unit('plural'); else echo STCars::get_price_unit('label'); ?> </small>
                    <?php }else{ ?>
                        <?php
                        $pick_up_date = $drop_off_date = '';
                        $pick_up_date_html = $drop_off_date_html = '';

                        if(!empty($_REQUEST['pick-up-date'])){
                            $pick_up_date_html =  $_REQUEST['pick-up-date'];
                            $pick_up_date =  TravelHelper::convertDateFormat($_REQUEST['pick-up-date']);
                        }else{
                            $pick_up_date_html = date(TravelHelper::getDateFormat(),strtotime("now"));
                            $pick_up_date = date(TravelHelper::getDateFormat(),strtotime("now"));
                        }
                        $unit = st()->get_option('cars_price_unit');
                        if ( $unit== 'hour') {
                            $pick_up_date_html .= !empty($_REQUEST['pick-up-time']) ? " ".$_REQUEST['pick-up-time'] : "" ."</br>";
                        }
                        if(!empty($_REQUEST['drop-off-date'])){
                            $drop_off_date_html =  $_REQUEST['drop-off-date'];
                            $drop_off_date =  TravelHelper::convertDateFormat($_REQUEST['drop-off-date']);
                        }else{
                            $drop_off_date_html = date(TravelHelper::getDateFormat(),strtotime("+1 day"));
                            $drop_off_date = date(TravelHelper::getDateFormat(),strtotime("+1 day"));
                        }
                        if ($unit == 'hour') {
                            $drop_off_date_html .= !empty($_REQUEST['drop-off-time']) ? " ".$_REQUEST['drop-off-time'] : "";
                        }
                        if(!empty($pick_up_date_html)){
                            ?>
                            <small><?php echo esc_attr($time) ?> <?php if($time > 1) echo STCars::get_price_unit('plural'); else echo STCars::get_price_unit('label'); ?> ( <?php echo esc_html($pick_up_date_html) ?> - <?php echo esc_html($drop_off_date_html) ?> )</small>
                        <?php }else{ ?>
                            <small><?php echo esc_attr($time) ?> <?php if($time > 1) echo STCars::get_price_unit('plural'); else echo STCars::get_price_unit('label'); ?> </small>
                        <?php } ?>
                    <?php } ?>

                </li>
            <?php endif; ?>
                <li><p>
                        <?php st_the_language('car_equipment') ?>
                        <span class="st_data_car_equipment_total" data-value="0" data-range-unit="<?php echo esc_html($time); ?>">
                          <?php echo TravelHelper::format_money( 0 ) ?>
                        </span>
                    </p>
                </li>
                <li><p>
                    <?php if(isset($_REQUEST['pick-up-date']) && !empty($_REQUEST['pick-up-date']) && isset($_REQUEST['drop-off-date']) && !empty($_REQUEST['drop-off-date'])): ?>
                        <?php st_the_language('car_rental_total'); ?>
                            <span class="st_data_car_total"> <?php echo TravelHelper::format_money($data_price_tmp) ?></span>
                    <?php endif; ?>    
                    </p>
                    <div class="spinner cars_price_img_loading "></div>
                </li>
            </ul>

            <?php
            $car_external_booking = get_post_meta(get_the_ID(), 'st_car_external_booking', "off");
            if($st_is_booking_modal && $car_external_booking == 'off'){
                if(st_owner_post()) {
	                echo st_button_send_message(get_the_ID());
                }
            ?>
                <a href="#car_booking_<?php the_ID() ?>" class="btn btn-primary btn-st-add-cart" onclick="return false" data-target=#car_booking_<?php the_ID() ?>  data-effect="mfp-zoom-out" ><?php st_the_language('book_now') ?> <i class="fa fa-spinner fa-spin"></i></a>
            <?php }else{ ?>

                <?php echo STCars::car_external_booking_submit(); ?>
                
            <?php } ?>
            <?php echo st()->load_template('user/html/html_add_wishlist',null,array("title"=>"")) ?>
        </div>
    </div>
</div>
    <?php
    if(!$pick_up and $location_id_pick_up) $pick_up=get_the_title($location_id_pick_up);
    if(!$drop_off and $location_id_drop_off) $drop_off=get_the_title($location_id_drop_off);
     $data = array(
         'price_cars'=>$cars_price,
         "pick_up"=>$pick_up,
         "location_id_pick_up"=>$location_id_pick_up,
         "drop_off"=>$drop_off,
         "location_id_drop_off"=>$location_id_drop_off,
         'date_time'=>array(
             "pick_up_date"=>$pick_up_date,
             "pick_up_time"=>$pick_up_time,
             "drop_off_date"=>$drop_off_date,
             "drop_off_time"=>$drop_off_time,
             "total_time"=>$time
         ),
     );
     $location_id_pick_up = STInput::request('location_id_pick_up','');
     $location_id_drop_off = STInput::request('location_id_drop_off','');
    ?>
    
    <input type="hidden" name="location_id_pick_up" class="" value="<?php echo esc_html($location_id_pick_up); ?>">
    <input type="hidden" name="location_id_drop_off" class="" value="<?php echo esc_html($location_id_drop_off); ?>">
    
    <input type="hidden" name="check_in" class="" value="<?php echo date('m/d/Y',$start) ?>">
    <input type="hidden" name="check_in_timestamp" class="" value="<?php echo esc_attr($start) ?>">
    <input type="hidden" name="check_out" class="" value="<?php echo date('m/d/Y',$end) ?>">
    <input type="hidden" name="check_out_timestamp" class="" value="<?php echo esc_attr($end) ?>">
    <input type="hidden" name="county_pick_up" class="county_pick_up" data-address="<?php echo esc_attr($pick_up) ?>" value=''>
    <input type="hidden" name="county_drop_off" class="county_drop_off" data-address="<?php echo esc_attr($drop_off) ?>" value=''>

    <input type="hidden" name="item_id" value='<?php echo get_the_ID() ?>'>

    <input type="hidden" name="action" value='cars_add_to_cart'>
    <input type="hidden" name="data_price_cars"  class="data_price_cars" value='<?php echo json_encode($data) ?>'>
    <input type="hidden" name="selected_equipments" value="" class="st_selected_equipments">
    <?php
        if(!empty($field_list) and is_array($field_list))
        {
            foreach($field_list as $key=>$value){
                if(isset($field_type[$value['field_atrribute']]))
                {
                    $field_name=isset($field_type[$value['field_atrribute']]['field_name'])?$field_type[$value['field_atrribute']]['field_name']:false;

                    if($field_name)
                    {
                        if(is_array($field_name) and !empty($field_name))
                        {
                            foreach($field_name as $k){
                                echo "<input name='{$k}' type='hidden' value='".STInput::request($k)."'>";
                            }
                        }
                    }
                    if(is_string($field_name))
                    {
                        switch($field_name){
                            case "pick_up":
                                echo "<input name='{$field_name}' type='hidden' value='".STInput::request('pick-up')."'>";
                                break;
                            case "drop_off":
                                echo "<input name='{$field_name}' type='hidden' value='".STInput::request('drop-off')."'>";
                                break;
                            case "location_?":
                                echo "<input name='{$field_name}' type='hidden' value='".STInput::request('location_id')."'>";
                                break;
                            default:
                                echo "<input name='{$field_name}' type='hidden' value='".STInput::request($field_name)."'>";
                                break;
                        }
                    }
                }
            }
        }
    ?>
    <?php
    if(!get_option('permalink_structure'))
    {
        echo '<input type="hidden" name="st_cars"  value="'.st_get_the_slug().'">';
    }
    ?>
</form>
<div class="message_box mt10"></div>
<?php
if($st_is_booking_modal){?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="car_booking_<?php the_ID()?>">
        <?php echo st()->load_template('cars/modal_booking');?>
    </div>
<?php }?>
