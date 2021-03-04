<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Cars element loop 1
     *
     * Created by ShineTheme
     *
     */
    $link=st_get_link_with_search(get_permalink(),array('pick-up','location_id_pick_up','drop-off','location_id_drop_off','drop-off-time','pick-up-time','drop-off-date','pick-up-date'),$_GET);

	if($location_id_pick_up=STInput::get('location_id')){
		$link=add_query_arg(array(
			'location_id_pick_up'=>$location_id_pick_up
		),$link);
	}

	if($text=STInput::get('location_name')){
		$link=add_query_arg(array(
			'pick-up'=>$text
		),$link);
	}
	if($text=STInput::get('st_google_location_pickup')){
		$link=add_query_arg(array(
			'st_google_location_pickup'=>$text
		),$link);
	}
	if($text=STInput::get('st_google_location_dropoff')){
		$link=add_query_arg(array(
			'st_google_location_dropoff'=>$text
		),$link);
	}

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

    $data_price_tmp = STPrice::getSaleCarPrice(get_the_ID(),$price_origin,$start,$end);
?>
<li <?php post_class('booking-item')  ?> itemscope itemtype="http://schema.org/Product">
    <?php echo STFeatured::get_featured(); ?>
    <!--<a class="" href="<?php //echo esc_url($link)?>">-->
    <div class="row">
        <div class="col-md-3">
            <div class="booking-item-car-img">
                <a href="<?php echo esc_url($link)?>">
                <?php
                    if(has_post_thumbnail() and get_the_post_thumbnail()){
                        the_post_thumbnail(array(143,71,'bfi_thumb'=>true), array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id(get_the_ID() ))));
                    }else{
                        echo st_get_default_image();
                    }
                ?>
                <p class="booking-item-car-title"><?php the_title() ?></p>
                </a>
                <?php
                echo st_get_avatar_in_list_service(get_the_ID(),35);
                ?>
            </div>
        </div>
        <?php if(!wp_is_mobile()){ ?>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <?php echo st()->load_template('/cars/elements/attribute-list'); ?>
                </div>
                <div class="col-md-4">
                    <ul class="booking-item-features booking-item-features-dark">
                        <?php $data_terms = get_the_terms(get_the_ID(),'st_cars_pickup_features');
                            if(!empty($data_terms)){
                                foreach($data_terms as $k=>$v){
                                    $icon = get_tax_meta($v->term_id ,'st_icon',true);
                                    if(!empty($icon)){
                                        echo '<li title="" data-placement="top" rel="tooltip" data-original-title="'.$v->name.'">
                                                           <i class="'.TravelHelper::handle_icon( $icon ).'"></i>
                                                         </li>';
                                    }
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="col-md-3">
                <span class="booking-item-price">
                    <?php
                    $info_price = STCars::get_info_price();
                    $cars_price = $info_price['price'];
                    $count_sale = $info_price['discount'];
                    $price_origin = $info_price['price_origin'];
                    ?>
                    <?php if($cars_price != $price_origin){ ?>
                        <span class="text-lg lh1em sale_block onsale">
							<?php echo TravelHelper::format_money( $price_origin ) ;?>
                        </span>
                    <?php } ?>
                    <?php echo TravelHelper::format_money($cars_price) ?>
                </span>
            <span class="booking-item-price-unit">/ <?php echo strtolower(STCars::get_price_unit('label')) ?></span>
            <?php $category = get_the_terms(get_the_ID() ,'st_category_cars') ?>
            <?php
                $txt ='';
                if(!empty($category))
                {
                    foreach($category as $k=>$v){
                        $txt .= $v->name.' ,';
                    }
                }
                $txt = substr($txt,0,-1);
            ?>
            <p class="booking-item-flight-class"><?php echo esc_html($txt); ?></p>
            <a href="<?php echo esc_url($link)?>">
                <span class="btn btn-primary "><?php st_the_language('car_select')?></span>
            </a>
            <?php if(!empty($count_sale)){ ?>
                <?php echo STFeatured::get_sale($count_sale); ?>
            <?php } ?>

        </div>
    </div>
    <!--</a>-->
</li>
