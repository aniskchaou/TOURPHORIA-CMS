<?php 
$format=TravelHelper::getDateFormat();
$div_id = "st_cart_item".md5(json_encode($st_booking_data['cart_item_key']));
$data = $st_booking_data;
$item_id = $st_booking_data['st_booking_id'];
$data_price = $st_booking_data['data_price'];
if(!empty($data_price['adult_price']))
    $adult_price = ( (float) $data_price['adult_price'] > 0 ) ? (float) $data_price['adult_price'] : 0;
if(!empty($data_price['child_price']))
    $child_price = ( (float) $data_price['child_price'] > 0 ) ? (float) $data_price['child_price'] : 0;
if(!empty($data_price['infant_price']))
    $infant_price = ( (float) $data_price['infant_price'] > 0 ) ? (float) $data_price['infant_price'] : 0;

$tour_price_type = get_post_meta($item_id, 'tour_price_by', true);
?>
<?php if($tour_price_type != 'fixed_depart'){ ?>
<?php if(isset($data['type_tour'])): ?>
<p class="booking-item-description">
    <span><?php echo __('Type tour', ST_TEXTDOMAIN); ?>: </span>
    <?php
    if($data['type_tour'] == 'daily_tour'){
        echo __('Daily Tour', ST_TEXTDOMAIN);
    }elseif($data['type_tour'] == 'specific_date'){
        echo __('Special Date', ST_TEXTDOMAIN);
    }
    ?>
</p>
<?php endif; ?>

<?php if(isset($data['type_tour']) && $data['type_tour'] == 'daily_tour'): ?>
<p class="booking-item-description"><span><?php echo __('Departure date', ST_TEXTDOMAIN); ?>: </span><?php echo date_i18n( $format , strtotime( $data['check_in'] ) ) . ($data['starttime'] != '' ? ' - ' . $data['starttime'] : ''); ?></p>
<p class="booking-item-description"><span><?php echo __('Duration', ST_TEXTDOMAIN); ?>: </span><?php echo esc_html($data['duration']); ?></p>
<?php endif; ?>

<?php if(isset($data['type_tour']) && $data['type_tour'] == 'specific_date'): ?>
<p class="booking-item-description"><span><?php echo __('Departure date', ST_TEXTDOMAIN); ?>: </span><?php echo date_i18n( $format , strtotime( $data['check_in'] ) ); ?></p>
<p class="booking-item-description"><span><?php echo __('Return date', ST_TEXTDOMAIN); ?>: </span><?php echo date_i18n( $format , strtotime( $data['check_out'] ) ) . ($data['starttime'] != '' ? ' - ' . $data['starttime'] : ''); ?></p>
<?php endif; ?>
<?php }else{ ?>
    <p><b><?php echo __('Fixed Departure', ST_TEXTDOMAIN); ?></b></p>
    <p class="booking-item-description"><span><?php echo __('Start date', ST_TEXTDOMAIN); ?>: </span><?php echo TourHelper::getDayFromNumber(date_i18n( 'N' , strtotime( $data['check_in'] ) )) . ' ' . date_i18n( $format , strtotime( $data['check_in'] ) )?></p>
    <p class="booking-item-description"><span><?php echo __('End date', ST_TEXTDOMAIN); ?>: </span><?php echo TourHelper::getDayFromNumber(date_i18n( 'N' , strtotime( $data['check_out'] ) )) . ' ' . date_i18n( $format , strtotime( $data['check_out'] ) )?></p>
<?php } ?>

<?php if(empty($data_price['adult_price']) && empty($data_price['child_price']) && empty($data_price['infant_price']) && !empty($data['base_price'])): ?>
    <p class="booking-item-description"><span><?php echo __('Base price', ST_TEXTDOMAIN); ?>: </span><?php echo TravelHelper::format_money($data['base_price']); ?></p>
<?php endif; ?>

<div id="<?php echo esc_attr($div_id);?>" class='<?php if (apply_filters('st_woo_cart_is_collapse' , false)) {echo esc_attr("collapse");}?>'>
	<p><small><?php echo __("Booking Details" , ST_TEXTDOMAIN) ; ?></small> </p>
	<div class='cart_border_bottom'></div>
	<div class="cart_item_group" style='margin-bottom: 10px'>
        <div class="booking-item-description">
			<p class="booking-item-description"> 
			     <?php if (!empty($data['adult_number'])) :?>
                     <span><?php echo __('Adult', ST_TEXTDOMAIN); ?>: </span><?php echo esc_html($data['adult_number']); ?>
                     <?php if(!empty($data_price['adult_price'])): ?>
                    x 
                    <?php                      
                        echo TravelHelper::format_money($adult_price/$data['adult_number']);
                        echo ' <i class="fa fa-long-arrow-right"></i> ';
                        echo TravelHelper::format_money($adult_price);
                        endif;
                    ?>
                    <br>
                <?php endif ; ?>
                <?php if (!empty($data['child_number'])) :?>
                    <span><?php echo __('Child', ST_TEXTDOMAIN); ?>: </span><?php echo esc_html($data['child_number']); ?>
	                <?php if(!empty($data_price['child_price'])): ?>
                    x 
                    <?php                        
                        echo TravelHelper::format_money($child_price/$data['child_number']);
                        echo ' <i class="fa fa-long-arrow-right"></i> ';
                        echo TravelHelper::format_money($child_price);
                        endif
                    ?>
                    <br>
                <?php endif ; ?>
                <?php if (!empty($data['infant_number'])) :?>
                    <span><?php echo __('Infant', ST_TEXTDOMAIN); ?>: </span><?php echo esc_html($data['infant_number']); ?>
	                <?php if(!empty($data_price['infant_price'])): ?>
                    x 
                    <?php                     
                        echo TravelHelper::format_money( $infant_price / $data['infant_number']);
                        echo ' <i class="fa fa-long-arrow-right"></i> ';
                        echo TravelHelper::format_money($infant_price);
                        endif;
                    ?>
                    <br>
                <?php endif ; ?>
			</p>
        </div>
    </div>
    <div class="cart_item_group" style='margin-bottom: 10px'>
        <?php 
            $discount = $st_booking_data['discount_rate'];
            if (!empty($discount)){ ?>
                <b class='booking-cart-item-title'><?php echo __( "Discount", ST_TEXTDOMAIN); ?>: </b>
                <?php 
                $discount_type = get_post_meta( $st_booking_data['st_booking_id'], 'discount_type', true );
                if($discount_type == 'percent'){
                    echo esc_attr($discount)."%" ;
                }else{
                    echo esc_attr(TravelHelper::format_money($discount)) ;
                }

                ?>
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
        }else{$tax = 0;}
        ?>
    </div>
    <div class="cart_item_group" style='margin-bottom: 10px'>
        <?php

        if(!empty($st_booking_data['extras']) and $st_booking_data['extra_price']):
            $extras = $st_booking_data['extras'];
            if(isset($extras['title']) && is_array($extras['title']) && count($extras['title'])): ?>
                <b class='booking-cart-item-title'><?php _e("Extra prices",ST_TEXTDOMAIN) ?></b>
                <div class="booking-item-payment-price-amount">
                    <?php foreach($extras['title'] as $key => $title):
                        $price_item = floatval($extras['price'][$key]);
                        if($price_item <= 0) $price_item = 0;
                        $number_item = intval($extras['value'][$key]);
                        if($number_item <= 0) $number_item = 0;
                        ?><?php if($number_item){ ?>
                        <span style="padding-left: 10px ">
                            <?php echo esc_attr($title).": ".esc_attr($number_item).' x <b>'.TravelHelper::format_money($price_item) . '</b>'; ?>
                        </span> <br />
                    <?php };?>
                    <?php endforeach;?>
                </div>
            <?php  endif; ?>
        <?php endif; ?>
    </div>
    <!-- Tour Package -->
    <div class="cart_item_group" style='margin-bottom: 10px'>
        <?php
        if(!empty($st_booking_data['package_hotel']) and $st_booking_data['package_hotel_price']):
            $hotel_data = $st_booking_data['package_hotel'];
            if(is_array($hotel_data) && count($hotel_data)): ?>
                <b class='booking-cart-item-title'><?php _e("Selected Hotels",ST_TEXTDOMAIN); ?></b>
                <div class="booking-item-payment-price-amount">
                    <?php foreach($hotel_data as $key => $val):
                        ?>
                        <span style="padding-left: 10px ">
                            <?php echo esc_attr($val->hotel_name).": ".' x <b>'.TravelHelper::format_money($val->hotel_price) . '</b>'; ?>
                        </span> <br />
                    <?php endforeach;?>
                </div>
            <?php  endif; ?>
        <?php endif; ?>
    </div>

    <div class="cart_item_group" style='margin-bottom: 10px'>
        <?php
        if(!empty($st_booking_data['package_activity']) and $st_booking_data['package_activity_price']):
            $activity_data = $st_booking_data['package_activity'];
            if(is_array($activity_data) && count($activity_data)): ?>
                <b class='booking-cart-item-title'><?php _e("Selected Activities",ST_TEXTDOMAIN); ?></b>
                <div class="booking-item-payment-price-amount">
                    <?php foreach($activity_data as $key => $val):
                        ?>
                        <span style="padding-left: 10px ">
                            <?php echo esc_attr($val->activity_name).": ".' x <b>'.TravelHelper::format_money($val->activity_price) . '</b>'; ?>
                        </span> <br />
                    <?php endforeach;?>
                </div>
            <?php  endif; ?>
        <?php endif; ?>
    </div>

    <div class="cart_item_group" style='margin-bottom: 10px'>
        <?php
        if(!empty($st_booking_data['package_car']) and $st_booking_data['package_car_price']):
            $car_data = $st_booking_data['package_car'];
            if(is_array($car_data) && count($car_data)): ?>
                <b class='booking-cart-item-title'><?php _e("Selected Cars",ST_TEXTDOMAIN); ?></b>
                <div class="booking-item-payment-price-amount">
                    <?php foreach($car_data as $key => $val):
                        ?>
                        <span style="padding-left: 10px ">
                             <?php echo esc_attr($val->car_name).": ".esc_attr($val->car_quantity).' x <b>'.TravelHelper::format_money($val->car_price) . '</b>'; ?>
                        </span> <br />
                    <?php endforeach;?>
                </div>
            <?php  endif; ?>
        <?php endif; ?>
    </div>

    <div class="cart_item_group" style='margin-bottom: 10px'>
		<?php
		if(!empty($st_booking_data['package_flight']) and $st_booking_data['package_flight_price']):
			$flight_data = $st_booking_data['package_flight'];

			if(is_array($flight_data) && count($flight_data)): ?>
                <b class='booking-cart-item-title'><?php _e("Selected Flight",ST_TEXTDOMAIN); ?></b>
                <div class="booking-item-payment-price-amount">
					<?php foreach($flight_data as $key => $val):
						$name_flight_package = $val->flight_origin . ' <i class="fa fa-long-arrow-right"></i> ' . $val->flight_destination;
						$price_flight_package = '';
						if($val->flight_price_type == 'business'){
							$price_flight_package = TravelHelper::format_money($val->flight_price_business);
						}else{
							$price_flight_package = TravelHelper::format_money($val->flight_price_economy);
						}
						?>
                        <span style="padding-left: 10px ">
                            <?php echo esc_html($name_flight_package).": ".' x <b>'.esc_html($price_flight_package) . '</b>'; ?>
                        </span> <br />
					<?php endforeach;?>
                </div>
			<?php  endif; ?>
		<?php endif; ?>
    </div>
    <!-- End Tour Package -->
    <div class='cart_border_bottom'></div>
    <div class="cart_item_group" style='margin-bottom: 10px'>        
        <b class='booking-cart-item-title'><?php echo __("Total amount" , ST_TEXTDOMAIN) ;  ?>:</b>
        <?php
        $include_tax_price =  get_option('woocommerce_prices_include_tax');
        if($include_tax_price == 'yes')
	        echo TravelHelper::format_money($st_booking_data['ori_price'] );
        else
	        echo TravelHelper::format_money($st_booking_data['ori_price'] + $tax );
            //echo TravelHelper::format_money($st_booking_data['ori_price'] + $tax )
        ?>
    </div>   
</div>