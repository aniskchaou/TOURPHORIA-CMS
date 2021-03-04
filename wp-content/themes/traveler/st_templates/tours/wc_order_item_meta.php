<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 14/07/2015
 * Time: 3:17 CH
 */
$item_data=isset($item['item_meta'])?$item['item_meta']:array(); 
$format=TravelHelper::getDateFormat();

$data_price = $item_data['_st_data_price'];

$tour_price_type = $item_data['_st_price_type'];
?>
<ul class="wc-order-item-meta-list">
    <?php if($tour_price_type != 'fixed_depart'){ ?>
        <?php if (!empty($item_data['_st_type_tour']) and $item_data['_st_type_tour'] =='daily_tour') :?>
            <?php if(isset($item_data['_st_check_in'])): $data=$item_data['_st_check_in']; ?>
                <li>
                    <span class="meta-label"><?php _e('Departure date:',ST_TEXTDOMAIN) ?></span>
                    <span class="meta-data">
                        <?php
                        echo esc_attr($data . ($item_data['_st_starttime'] != '' ? ' - ' . $item_data['_st_starttime'] : ''));
                        ?>
                    </span>
                </li>
                <li>
                    <span class="meta-label"><?php _e('Duration:',ST_TEXTDOMAIN) ?></span>
                    <span class="meta-data">
                        <?php
                        $st_duration = $item_data['_st_duration'];
                        if (!empty($st_duration))
                        {
                            echo esc_attr($st_duration);
                        }
                        ?>
                    </span>
                </li>
            <?php endif;?>
        <?php endif ; ?>
    <?php }else{ ?>
        <?php if(isset($item_data['_st_type_tour'])){ ?>
            <li><b><?php echo __('Fixed Departure', ST_TEXTDOMAIN); ?></b></li>
		    <?php if(isset($item_data['_st_check_in'])): $data_check_in=$item_data['_st_check_in']; ?>
                <li>
                    <span class="meta-label"><?php _e('Start date:',ST_TEXTDOMAIN) ?></span>
                    <span class="meta-data">
                        <?php
                            echo TourHelper::getDayFromNumber(date('N', strtotime($data_check_in))) . ' ' . $data_check_in;
                        ?>
                    </span>
                </li>
		    <?php endif;?>
		    <?php if(isset($item_data['_st_check_out'])): $data_check_out=$item_data['_st_check_out']; ?>
                <li>
                    <span class="meta-label"><?php _e('End date:',ST_TEXTDOMAIN) ?></span>
                    <span class="meta-data">
                        <?php
                        echo TourHelper::getDayFromNumber(date('N', strtotime($data_check_out))) . ' ' . $data_check_out;
                        ?>
                    </span>
                </li>
		    <?php endif;?>
        <?php } ?>
    <?php } ?>
    <?php  if (!empty($item_data['_st_type_tour']) and $item_data['_st_type_tour'] =='specific_date' ):?>
        <?php if(isset($item_data['_st_check_in'])): $data=$item_data['_st_check_in']; ?>
            <li>
                <span class="meta-label"><?php _e('Date:',ST_TEXTDOMAIN) ?></span>
                <span class="meta-data"><?php
                    echo esc_attr($data);
                    ?>
                    <?php if(isset($item_data['_st_check_out'])){ $data=$item_data['_st_check_out']; ?>
                        &rarr;
                        <?php
                        echo esc_attr($data);
                        ?>
                    <?php }?>
                    <?php echo $item_data['_st_starttime'] != '' ? ' - ' . esc_html($item_data['_st_starttime']) : ''; ?>
                </span>
            </li>
        <?php endif;?>
    <?php endif ;?>   

        <?php if(isset($item_data['_st_adult_number']) and  $adult = $item_data[ '_st_adult_number' ] and $adult){?>
        <li>
            <span class="meta-label"><?php echo __( 'Adult number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($adult);?>
                <?php if(!empty($data_price['adult_price'])){ ?>
                x
                <?php 
                if(isset($item_data['_st_adult_price']) ){
                    $adult_price = TravelHelper::convert_money($data_price['adult_price']/$adult);
                    ?>
                <?php echo TravelHelper::format_money_raw($adult_price) ?>
                <?php  } } ;?>
            </span>
        </li>
        <?php }?>


        <?php if(isset($item_data['_st_child_number']) and $child=$item_data[ '_st_child_number' ] and $child){?>
        <li>
            <span class="meta-label"><?php echo __( 'Children number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($child)?>
	            <?php if(!empty($data_price['child_price'])){ ?>
                x
                <?php 
                if(isset($item_data['_st_child_price'])){
                    $child_price = TravelHelper::convert_money($data_price['child_price']/$child);
                    ?>
                <?php echo TravelHelper::format_money_raw($child_price) ?>       
                <?php } } ;?>
            </span>
        </li>
        <?php  }?>

        <?php if(isset($item_data['_st_infant_number']) and $infant=$item_data[ '_st_infant_number' ] and $infant){?>
        <li>
            <span class="meta-label"><?php echo __( 'Infant number:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo esc_html($infant)?>
	            <?php if(!empty($data_price['infant_price'])){ ?>
                x
                <?php 
                if(isset($item_data['_st_infant_price'])){
                    $infant_price = TravelHelper::convert_money($data_price['infant_price']/$infant);
                    ?>
                    <?php echo TravelHelper::format_money_raw($infant_price) ?>
                <?php } } ;?>
            </span>
        </li>
        <?php  }?>
        <?php if(isset($item_data['_st_extras']) and ($extra_price = $item_data['_st_extra_price'])): $data=$item_data['_st_extras'];?>
            <li>
                <p><?php echo __("Extra prices"  ,ST_TEXTDOMAIN) .": "; ?></p>
                <ul>
                    <?php
                    if(!empty($data['title']) and  is_array($data['title'])){
                        foreach ($data['title'] as $key => $title) { ?>
                            <?php if($data['value'][$key]){ ?>
                                <li style="padding-left: 10px "> <?php echo esc_attr($title) ;?>:
                                    <?php
                                    echo esc_html($data['value'][$key]) ;?> x <?php echo TravelHelper::format_money($data['price'][$key]) ;
                                    ?>
                                </li>
                            <?php }?>
                        <?php }
                    }
                    ?>
                </ul>
            </li>
        <?php endif; ?>
        <!-- Tour Package -->
    <?php if(isset($item_data['_st_package_hotel']) and ($package_hotel_price = $item_data['_st_package_hotel_price'])): $data=$item_data['_st_package_hotel'];?>
        <li>
            <p><?php echo __("Hotel packages"  ,ST_TEXTDOMAIN) .": "; ?></p>
            <ul>
                <?php
                if(!empty($data) and  is_array($data)){
                    foreach ($data as $key => $val) { ?>
                            <li style="padding-left: 10px "> <?php echo esc_attr($val->hotel_name) ;?>:
                                <?php echo TravelHelper::format_money($val->hotel_price); ?>
                            </li>
                    <?php }
                }
                ?>
            </ul>
        </li>
    <?php endif; ?>

    <?php if(isset($item_data['_st_package_activity']) and ($package_activity_price = $item_data['_st_package_activity_price'])): $data=$item_data['_st_package_activity'];?>
        <li>
            <p><?php echo __("Activity packages"  ,ST_TEXTDOMAIN) .": "; ?></p>
            <ul>
                <?php
                if(!empty($data) and  is_array($data)){
                    foreach ($data as $key => $val) { ?>
                        <li style="padding-left: 10px "> <?php echo esc_attr($val->activity_name) ;?>:
                            <?php echo TravelHelper::format_money($val->activity_price); ?>
                        </li>
                    <?php }
                }
                ?>
            </ul>
        </li>
    <?php endif; ?>

    <?php if(isset($item_data['_st_package_car']) and ($package_car_price = $item_data['_st_package_car_price'])): $data=$item_data['_st_package_car'];?>
        <li>
            <p><?php echo __("Car packages"  ,ST_TEXTDOMAIN) .": "; ?></p>
            <ul>
                <?php
                if(!empty($data) and  is_array($data)){
                    foreach ($data as $key => $val) { ?>
                        <li style="padding-left: 10px "> <?php echo esc_attr($val->car_name) ;?>:
                            <?php
                            echo esc_html($val->car_quantity); ?> x <?php echo TravelHelper::format_money($val->car_price);
                            ?>
                        </li>
                    <?php }
                }
                ?>
            </ul>
        </li>
    <?php endif; ?>

	<?php if(isset($item_data['_st_package_flight']) and ($package_hotel_price = $item_data['_st_package_flight_price'])): $data=$item_data['_st_package_flight'];?>
        <li>
            <p><?php echo __("Flight packages"  ,ST_TEXTDOMAIN) .": "; ?></p>
            <ul>
				<?php
				if(!empty($data) and  is_array($data)){
					foreach ($data as $key => $val) {
						$name_flight_package = $val->flight_origin . ' <i class="fa fa-long-arrow-right"></i> ' . $val->flight_destination;
						$price_flight_package = '';
						if($val->flight_price_type == 'business'){
							$price_flight_package = TravelHelper::format_money($val->flight_price_business);
						}else{
							$price_flight_package = TravelHelper::format_money($val->flight_price_economy);
						}
					    ?>
                        <li style="padding-left: 10px "> <?php echo esc_html($name_flight_package) ;?>:
							<?php echo esc_html($price_flight_package); ?>
                        </li>
					<?php }
				}
				?>
            </ul>
        </li>
	<?php endif; ?>
        <!-- End Tour Package -->
        <?php  if(isset($item_data['_st_discount_rate'])): $data=$item_data['_st_discount_rate'];?>
            <?php  if (!empty($data)) {?><li><p>
                <?php echo __("Discount"  ,ST_TEXTDOMAIN) .": "; ?>
                <?php echo esc_attr($data) ."%";?>
            <?php } ;?></p></li>
        <?php endif; ?>
        <?php  if(isset($item_data['_line_tax'])): $data=$item_data['_line_tax'];?>
            <?php  if (!empty($data)) {?><li><p>
            <?php echo __("Tax"  ,ST_TEXTDOMAIN) .": "; ?>
            <?php echo TravelHelper::format_money($data) ;?>
        <?php } ;?></p></li>
        <?php endif; ?>
        

</ul>