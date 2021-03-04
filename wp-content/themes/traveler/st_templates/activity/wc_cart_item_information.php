<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 03/06/2015
 * Time: 3:53 CH
 */
$div_id = "st_cart_item".md5(json_encode($st_booking_data['cart_item_key']));
?>
<p class="booking-item-description">
    <?php echo __( 'Duration:' , ST_TEXTDOMAIN ); ?>
    <?php echo date_i18n( TravelHelper::getDateFormat() , strtotime( $st_booking_data[ 'check_in' ] ) ) ?>
    <i class="fa fa-long-arrow-right"></i>
    <?php echo date_i18n( TravelHelper::getDateFormat() , strtotime( $st_booking_data[ 'check_out' ] ) ) ?>
</p>
<?php if(isset($st_booking_data['starttime'])){?>
<p class="booking-item-description">
    <?php echo __( 'Start Time:' , ST_TEXTDOMAIN ); ?>
    <?php echo esc_html($st_booking_data['starttime']); ?>
</p>
<?php } ?>
<div id="<?php echo esc_attr($div_id);?>" class='<?php if (apply_filters('st_woo_cart_is_collapse' , false)) {echo esc_attr("collapse");}?>'>
    <p><small><?php echo __("Booking Details" , ST_TEXTDOMAIN) ; ?></small> </p>
    <div class='cart_border_bottom'></div>
    <div class="cart_item_group" style='margin-bottom: 10px'>
        <p class="booking-item-description"> 
            <?php if(!empty($st_booking_data['activity_time'])): ?>
            <?php echo __( 'Department Time:' , ST_TEXTDOMAIN ); ?>
            <?php echo esc_html($st_booking_data['activity_time']); ?>
            <?php endif; ?>
        </p>
    </div>
    <div class="cart_item_group" style='margin-bottom: 10px'>
        <?php 
            $data_price = $st_booking_data['data_price'];
            $adult_price = $data_price['adult_price'];
            $child_price = $data_price['child_price'];
            $infant_price = $data_price['infant_price'];
         ?>
        <p class="booking-item-description"> 
            <?php if($st_booking_data['adult_number']){?>
                <?php echo __( 'Adult Number:' , ST_TEXTDOMAIN ); ?>
                <?php echo esc_html($st_booking_data[ 'adult_number' ]);?>
                <?php if(isset($st_booking_data['adult_price']) and $st_booking_data['adult_price']){?>
                x
                <?php echo TravelHelper::format_money($adult_price/$st_booking_data['adult_number']) ?>
                <i class="fa fa-long-arrow-right"></i>
                <?php echo TravelHelper::format_money($adult_price); ?>
                <?php }?>
            <?php }?>
        </p>
        <p class="booking-item-description"> 
            <?php if($st_booking_data['child_number']){?>
                <?php echo __( 'Children Number:' , ST_TEXTDOMAIN ); ?>
                <?php echo esc_html($st_booking_data[ 'child_number' ]); ?>
                <?php if(isset($st_booking_data['child_price']) and $st_booking_data['child_price']){?>
                x
                <?php echo TravelHelper::format_money($child_price/$st_booking_data['child_number']) ?>
                <i class="fa fa-long-arrow-right"></i>
                <?php echo TravelHelper::format_money($child_price); ?>
                <?php }?>
            <?php }?>
        </p>
        <p class="booking-item-description"> 
            <?php if($st_booking_data['infant_number']){?>
                <?php echo __( 'Infant Number:' , ST_TEXTDOMAIN ); ?>
                <?php echo esc_html($st_booking_data[ 'infant_number' ]); ?>
                <?php if(isset($st_booking_data['infant_price']) and $st_booking_data['infant_price']): ?>
                x
                <?php echo TravelHelper::format_money($infant_price/$st_booking_data['infant_number']) ?>
                <i class="fa fa-long-arrow-right"></i>
                <?php echo TravelHelper::format_money($infant_price); ?>
                <?php endif; ?>
            <?php }?> 
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
        }else {$tax = 0 ;}
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
                            <?php echo esc_attr($title).": ".esc_attr($number_item).' x '.TravelHelper::format_money($price_item); ?>
                        </span> <br />
                    <?php };?>
                    <?php endforeach;?>
                </div>
            <?php  endif; ?>
        <?php endif; ?>
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