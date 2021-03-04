<?php
wp_enqueue_style( 'weather-icons.css' );

$thumbnail=get_post_thumbnail_id();
$img=wp_get_attachment_url($thumbnail);
if(empty($img)){
    $img = ST_TRAVELER_URI.'/img/no-image.png';
}
$class_bg_img = Assets::build_css(" background: url(".$img.") ");
$logo = get_post_meta( get_the_ID() , 'st_logo_location' , true);

$c=TravelHelper::get_location_temp();

$class_bg = Assets::build_css("opacity: ".$opacity."!important;");
?>
<div class="bg-holder full style2">
    <div class="bg-mask <?php echo esc_attr($class_bg) ?>"></div>
    <div class="bg-blur <?php echo esc_attr($class_bg_img) ?>" ></div>
    <div class="bg-content">
        <div class="container">
            <div class="loc-info hidden-xs hidden-sm">
                <h3 class="loc-info-title">
                    <?php if(!empty($logo)){ ?>
                       <img src="<?php echo balanceTags($logo) ?>" alt="Logo" title="Image Title" />
                    <?php } ?>
                    <?php the_title() ?>
                </h3>
                <?php if($st_weather == 'yes' and $c){ ?>
                <p class="loc-info-weather">
                    <span class="loc-info-weather-num"><?php echo esc_html($c['temp']); ?></span>
                    <?php echo balanceTags($c['icon']) ?>
                </p>
                <?php } ?>
                
                    <ul class="loc-info-list">
                        <?php


                        if(class_exists('STHotel') and $hotel=new STHotel() and $hotel->is_available() && TravelHelper::checkTableDuplicate('st_hotel'))
                        {
                            $info = new STLocation() ;
                            $info = $info->get_info_by_post_type(get_the_ID() , 'st_hotel');                           
                            
                            $min_price = $info['min_max_price']['price_min'];      
                            $min_price = TravelHelper::format_money($min_price);
                            if (empty($min_price) or !$min_price){
                                $min_price = __("Free" , ST_TEXTDOMAIN);
                            }
                            $offer = $info['offers'] ; 
                            if(!empty($offer)){
                                $page_search = st_get_page_search_result('st_hotel');
                                $location_text = 'location_id';

                                if(!empty($page_search) and get_post_type($page_search)=='page'){
                                    $link = add_query_arg(array($location_text=>get_the_ID()),get_the_permalink($page_search));
                                }else{
                                    $link = add_query_arg(array($location_text=>get_the_ID(),'s'=>'','post_type'=>'st_hotel'),home_url('/'));
                                }

                                if($offer>1)
                                {
                                    $offer_string=sprintf(__('%d Hotels from %s/night',ST_TEXTDOMAIN),$offer,$min_price);
                                }else{
                                    $offer_string=sprintf(__('%d Hotel from %s/night',ST_TEXTDOMAIN),$offer,$min_price);
                                }
                                echo '<li><a href="'.$link.'"><i class="fa fa-building-o"></i> '.$offer_string.'</a></li>';
                            }
                        }




                        if(class_exists('STRental') and $rental =new STRental() and $rental->is_available() && TravelHelper::checkTableDuplicate('st_rental'))
                        {
                            $info = new STLocation();
                            $info = $info->get_info_by_post_type(get_the_ID() , 'st_rental');

                            
                            $min_price = $info['min_max_price']['price_min'];      
                            $min_price = TravelHelper::format_money($min_price);
                            if (empty($min_price) or !$min_price){
                                $min_price = __("Free" , ST_TEXTDOMAIN);
                            }
                            $offer = $info['offers'] ; 
                            if(!empty($offer)){
                                $page_search = st_get_page_search_result('st_rental');
                                if(!empty($page_search) and get_post_type($page_search)=='page'){
                                    $link = add_query_arg(array('location_id'=>get_the_ID(), 'pick-up'=>get_the_title()),get_the_permalink($page_search));
                                }else{
                                    $link = add_query_arg(array('pick-up'=>get_the_title(),'location_id'=>get_the_ID(),'s'=>'','post_type'=>'st_rental'),home_url('/'));
                                }

                                if($offer>1)
                                {
                                    $offer_string=sprintf(__('%d Rentals from %s/night',ST_TEXTDOMAIN),$offer,$min_price);
                                }else{
                                    $offer_string=sprintf(__('%d Rental from %s/night',ST_TEXTDOMAIN),$offer,$min_price);
                                }
                                echo '<li><a href="'.$link.'"><i class="fa fa-home"></i> '.$offer_string.'</a></li>';
                            }
                        }

                        if(class_exists('STCars') and $car=new STCars() and $car->is_available() && TravelHelper::checkTableDuplicate('st_cars'))
                        {
                            $info = new STLocation();
                            $info = $info->get_info_by_post_type(get_the_ID() , 'st_cars');

                            
                            $min_price = $info['min_max_price']['price_min'];      
                            $min_price = TravelHelper::format_money($min_price);
                            if (empty($min_price) or !$min_price){
                                $min_price = __("Free" , ST_TEXTDOMAIN);
                            }
                            $offer = $info['offers'] ;  
                            if(!empty($offer)){
                                $page_search = st_get_page_search_result('st_cars');
                                if(!empty($page_search) and get_post_type($page_search)=='page'){
                                    //$link = add_query_arg(array('location_id'=>get_the_ID()),get_the_permalink($page_search));
                                    $link = add_query_arg(array('location_id_pick_up'=>get_the_ID(), 'pick-up'=>get_the_title()),get_the_permalink($page_search));
                                }else{
                                    //$link = home_url(esc_url('?s=&post_type=st_hotel&location_id='.get_the_ID()));
                                    //$link = home_url(esc_url('?s=&post_type=st_cars&location_id_pick_up='.get_the_ID()."&pick-up=".get_the_title()));
                                    $link = add_query_arg(array('pick-up'=>get_the_title(),'location_id_pick_up'=>get_the_ID(),'s'=>'','post_type'=>'st_cars'),home_url('/'));
                                }


                                $cars_price_unit = st()->get_option('cars_price_unit','day');
                                if($cars_price_unit == "distance"){
                                    $cars_price_unit = st()->get_option('cars_price_by_distance','kilometer');
                                }

                                switch ($cars_price_unit) {
                                    case "day":
                                        $cars_price_unit = __('day', ST_TEXTDOMAIN);
                                        break;
                                    case "hour":
                                        $cars_price_unit = __('hour', ST_TEXTDOMAIN);
                                        break;
                                    case "kilometer":
                                        $cars_price_unit = __('kilometer', ST_TEXTDOMAIN);
                                        break;
                                    case "mile":
                                        $cars_price_unit = __('mile', ST_TEXTDOMAIN);
                                        break;
                                }

                                if($offer>1)
                                {
                                    $offer_string=sprintf(__('%d Cars from %s/%s',ST_TEXTDOMAIN),$offer,$min_price,$cars_price_unit);
                                }else{
                                    $offer_string=sprintf(__('%d Car from %s/%s',ST_TEXTDOMAIN),$offer,$min_price,$cars_price_unit);
                                }
                                echo '<li><a href="'.$link.'"><i class="fa fa-car"></i> '.$offer_string.'</a></li>';
                            }
                        }


                        if(class_exists('STTour') and $tour=new STTour() and $tour->is_available() && TravelHelper::checkTableDuplicate('st_tours'))
                        {
                            $info = new STLocation();
                            $info = $info->get_info_by_post_type(get_the_ID() , 'st_tours');                            
                            
                            $min_price = $info['min_max_price']['price_min'];      
                            $min_price = TravelHelper::format_money($min_price);
                            if (empty($min_price) or !$min_price){
                                $min_price = __("Free" , ST_TEXTDOMAIN);
                            }
                            $offer = $info['offers'] ; 
                            if(!empty($offer)){
                                $page_search = st_get_page_search_result('st_tours');
                                if(!empty($page_search) and get_post_type($page_search)=='page'){
                                    //$link = add_query_arg(array('location_id'=>get_the_ID()),get_the_permalink($page_search));
                                    $link = add_query_arg(array('location_id'=>get_the_ID(), 'pick-up'=>get_the_title()),get_the_permalink($page_search));
                                }else{
                                    //$link = home_url(esc_url('?s=&post_type=st_hotel&location_id='.get_the_ID()));
                                    //$link = home_url(esc_url('?s=&post_type=st_tours&location_id='.get_the_ID()."&pick-up=".get_the_title()));
                                    $link = add_query_arg(array('pick-up'=>get_the_title(),'location_id'=>get_the_ID(),'s'=>'','post_type'=>'st_tours'),home_url('/'));
                                }

                                if($offer>1)
                                {
                                    $offer_string=sprintf(__('%d Tour from %s',ST_TEXTDOMAIN),$offer,$min_price);
                                }else{
                                    $offer_string=sprintf(__('%d Tours from %s',ST_TEXTDOMAIN),$offer,$min_price);
                                }
                                echo '<li><a href="'.$link.'"><i class="fa fa-bolt"></i> '.$offer_string.'</a></li>';
                            }
                        }

                        if(class_exists('STActivity') and $activity=STActivity::inst() and  $activity->is_available() && TravelHelper::checkTableDuplicate('st_activity'))
                        {
                            $info = new STLocation();
                            $info = $info->get_info_by_post_type(get_the_ID(),'st_activity');

                            $min_price = $info['min_max_price']['price_min'];
                            $min_price = TravelHelper::format_money($min_price);
                            if (empty($min_price) or !$min_price){
                                $min_price = __("Free" , ST_TEXTDOMAIN);
                            }
                            $offer = $info['offers'] ;

                            if(!empty($offer)){
                                $page_search = st_get_page_search_result('st_activity');
                                if(!empty($page_search) and get_post_type($page_search)=='page'){
                                    //$link = add_query_arg(array('location_id'=>get_the_ID()),get_the_permalink($page_search));
                                    $link = add_query_arg(array('location_id'=>get_the_ID(), 'pick-up'=>get_the_title()),get_the_permalink($page_search));
                                }else{
                                    //$link = home_url(esc_url('?s=&post_type=st_hotel&location_id='.get_the_ID()));
                                    //$link = home_url(esc_url('?s=&post_type=st_activity&location_id='.get_the_ID()."&pick-up=".get_the_title()));
                                    $link = add_query_arg(array('pick-up'=>get_the_title(),'location_id'=>get_the_ID(),'s'=>'','post_type'=>'st_activity'),home_url('/'));
                                }

                                if($offer>1)
                                {
                                    $offer_string=sprintf(__('%d Activities from %s',ST_TEXTDOMAIN),$offer,$min_price);
                                }else{
                                    $offer_string=sprintf(__('%d Activity from %s',ST_TEXTDOMAIN),$offer,$min_price);
                                }
                                echo '<li><a href="'.$link.'"><i class="fa fa-bolt"></i> '.$offer_string.'</a></li>';
                            }
                        }

                        ?>
                    </ul>

                <?php
                $page_search = st_get_page_search_result($st_type);
                if(!empty($page_search)){
                    //$link = add_query_arg(array('location_id'=>get_the_ID()),get_the_permalink($page_search));
                    $link = add_query_arg(array('location_id'=>get_the_ID(), 'pick-up'=>get_the_title()),get_the_permalink($page_search));
                }else{
                    //$link = home_url(esc_url('?s=&post_type='.$st_type.'&location_id='.get_the_ID()));
                    //$link = home_url(esc_url('?s=&post_type='.$st_type.'&location_id='.get_the_ID()."&pick-up=".get_the_title()));
                    $link = add_query_arg(array(
                        's'=>'',
                        'post_type'=>$st_type,
                        'location_id'=>get_the_ID(),
                        'pick-up'=>get_the_title()
                    ),home_url('/'));
                }
                if($link_to == 'single'){
                    $link = get_the_permalink();
                }
                ?>
                <a class="btn btn-white btn-ghost mt10" href="<?php echo esc_url($link) ?>">
                    <i class="fa fa-angle-right"></i>
                    <?php esc_html_e('Explore','traveler') ?>
                </a>
            </div>
        </div>
    </div>
</div>