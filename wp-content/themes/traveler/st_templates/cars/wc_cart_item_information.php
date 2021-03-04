<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 02/06/2015
 * Time: 3:32 CH
 */

if (!empty($st_booking_data['data_equipment'])){
    $selected_equipments = $st_booking_data['data_equipment'];
} 
$pick_up_date = $st_booking_data['check_in_timestamp'];
$drop_off_date = $st_booking_data['check_out_timestamp'];
$format=TravelHelper::getDateFormat();
$div_id = "st_cart_item".md5(json_encode($st_booking_data['cart_item_key']));
?>
<p class="booking-item-description">
    <?php echo __('Date:',ST_TEXTDOMAIN);?> <?php  echo date_i18n($format.' '.get_option('time_format'),$pick_up_date) ?> <i class="fa fa-long-arrow-right"></i> <?php echo date_i18n($format.' '.get_option('time_format'),$drop_off_date) ?>
    </br>
    <?php echo __('Location:',ST_TEXTDOMAIN);?> 
    <?php if(!empty($st_booking_data['location_id_pick_up']) && !empty($st_booking_data['location_id_drop_off'])): ?>
    <?php echo get_the_title($st_booking_data['location_id_pick_up']); ?> <i class="fa fa-long-arrow-right"></i> <?php echo get_the_title($st_booking_data['location_id_drop_off']) ?>
    <?php else: ?>
    <?php echo __('None', ST_TEXTDOMAIN); ?>
    <?php endif; ?> 
</p>
<div id="<?php echo esc_attr($div_id);?>" class='<?php if (apply_filters('st_woo_cart_is_collapse' , false)) {echo esc_attr("collapse");}?>'>
    <p><small><?php echo __("Booking Details" , ST_TEXTDOMAIN) ; ?></small> </p>
    <div class='cart_border_bottom'></div>
    <div class="cart_item_group" style='margin-bottom: 10px'>
        <p class="booking-item-description">    
            <b class='booking-cart-item-title'><?php echo __("Car price",ST_TEXTDOMAIN);?>  </b>
            : <?php echo TravelHelper::format_money($st_booking_data['sale_price']) ; ?> 
                /<?php
                    if ($st_booking_data['duration_unit'] =='day') {echo __("day" , ST_TEXTDOMAIN) ; }
                    if ($st_booking_data['duration_unit'] =='hour') {echo __("hour" , ST_TEXTDOMAIN) ; }
                    if ($st_booking_data['duration_unit'] == "distance") {
                        $type_distance = st()->get_option( "cars_price_by_distance" , "kilometer" );
                        if($type_distance == "kilometer") {
                            echo __( "kilometer" , ST_TEXTDOMAIN );
                        } else {
                            echo __( "mile" , ST_TEXTDOMAIN );
                        }
                    }
                ?>
        </p>
    </div>
    <div class="cart_item_group" style='margin-bottom: 10px'>
        <p class="booking-item-description">       
            <?php
            if(isset($selected_equipments) and $selected_equipments and !empty($selected_equipments)){
                echo "<b class='booking-cart-item-title'>".__('Equipment(s):',ST_TEXTDOMAIN)."</b>";
                echo "</br>";
                foreach($selected_equipments as $key=>$data){
                    $number_item = (int) $data->number_item;
                    if( $number_item < 2 ){
                        $number_item = 1;
                    }
                    $price_unit=$data->price_unit;
                    $price_unit_html='';
                    switch($price_unit)
                    {
                        case "per_hour":
                            $price_unit_html=__('/hour',ST_TEXTDOMAIN);
                            break;
                        case "per_day":
                            $price_unit_html=__('/day',ST_TEXTDOMAIN);
                            break;
                        default:
                            $price_unit_html='';
                            break;
                    }
                    echo "&nbsp;&nbsp;&nbsp;- ".$data->title.": ".TravelHelper::format_money($data->price).$price_unit_html ." (x".$number_item.")"." <br>";

                }
                echo "";
            }
            ?>
        </p>
    </div>
     <div class="cart_item_group" style='margin-bottom: 10px'>
        <?php 
            $discount = $st_booking_data['discount_rate'];
            if (!empty($discount)){ ?>
                <b class='booking-cart-item-title'><?php echo __( "Discount", ST_TEXTDOMAIN); ?>: </b>
                <?php echo esc_attr($discount)."%" ?>
            <?php }            
        ?>        
    </div>
    <div class="cart_item_group" style='margin-bottom: 10px'>        
        <?php  if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) {
            $wp_cart = WC()->cart->cart_contents; 
            $item = $wp_cart[$st_booking_data['cart_item_key']];
            $tax = $item['line_tax']; 
            if (!empty($tax)) { ?>
                <b class='booking-cart-item-title'><?php echo __( "Tax", ST_TEXTDOMAIN); ?>: </b>
                <?php echo TravelHelper::format_money($tax);?>
            <?php }
        }else {$tax = 0; }
        ?>
    </div>   
    <div class='cart_border_bottom'></div>
    <div class="cart_item_group" style='margin-bottom: 10px'>        
        <b class='booking-cart-item-title'><?php echo __("Total amount" , ST_TEXTDOMAIN) ;  ?>:</b>
	    <?php
	    $include_tax_price =  get_option('woocommerce_prices_include_tax');
	    if($include_tax_price == 'yes')
		    echo TravelHelper::format_money($st_booking_data['ori_price'] );
	    else
		    echo TravelHelper::format_money($st_booking_data['ori_price'] + $tax );
	    ?>
    </div>
</div>