<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * hotel result
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script('magnific.js' );
wp_enqueue_script('filter-ajax-hotel.js');
global $wp_query,$st_search_query;
$default=array(
    'style'=>'1',
    'taxonomy'=>'',
);
if(isset($arg)){
    extract(wp_parse_args($arg,$default));
}else{
    extract($default);
}
if(STInput::get('style')){
    $style=STInput::get('style');
}
$hotel=new STHotel();
$allOrderby=$hotel->getOrderby();
$orderby_key = TravelHelper::_parser_orderby_key($allOrderby);
?>
<div class="nav-drop booking-sort"></div>
<div class="sort_top">
    <div class="row">
        <div class="col-md-10 col-sm-9 col-xs-9">
            <ul class="nav nav-pills ajax-filter-wrapper-order">
                <?php
                         wp_reset_query();
                        if(!empty($st_orderby)) {
                            if(empty($st_sortby))
                                $st_sortby = 'asc';
                            $active = TravelHelper::parser_default_order_by_search_result($st_orderby, $st_sortby);
                            $active_temp = STInput::request('orderby');
                            if (!empty($active_temp)) {
                                $active = $active_temp;
                            }
                            if (!in_array($active, $orderby_key)) {
                                echo '<li class="active" style="display: none !important;"><a class="checkbox-filter-ajax" data-type="order" data-value="' . $active . '"></a>';
                            }
                        }else{
                            echo '<input type="hidden" id="jhotel-orderby" value="-1" />';
                            $active = STInput::request('orderby');
                        }
                        echo '<input type="hidden" id="jhotel-category" value="'. $taxonomy .'" />';
                        if(!empty($allOrderby) and is_array($allOrderby)):
                            foreach($allOrderby as $key=>$value)
                            {
                                if( is_front_page() ){
                                    switch (get_page_template_slug( )) {
                                        case 'template-cars-search.php':
                                            $link = add_query_arg(array('orderby'=>$key), home_url( '/?s=&post_type=st_cars' ));
                                            break;
                                        
                                        case 'template-tour-search.php':
                                            $link = add_query_arg(array('orderby'=>$key), home_url( '/?s=&post_type=st_tours' ));
                                            break;
                                        case 'template-rental-search.php':
                                            $link = add_query_arg(array('orderby'=>$key), home_url( '/?s=&post_type=st_rental' ));
                                            break;   
                                        case 'template-hotel-search.php':
                                            $link = add_query_arg(array('orderby'=>$key), home_url( '/?s=&post_type=st_hotel' ));
                                            break;   
                                        case 'template-activity-search.php':
                                            $link = add_query_arg(array('orderby'=>$key), home_url( '/?s=&post_type=st_activity' ));
                                            break; 
                                        case 'template-hotel-room-search.php':
                                            $link = add_query_arg(array('orderby'=>$key), home_url( '/?s=&post_type=hotel_room' ));
                                            break;         
                                    }
                                }else{
                                    $link =  add_query_arg('orderby', $key);
                                }
                                if($active == $key){
                                    echo '<li class="active"><a href="'.esc_url($link).'"  class="checkbox-filter-ajax" data-type="order" data-value="' . $key . '">'.$value['name'].'</a>';
                                }elseif($key == 'new' and empty($active)){
                                    echo '<li class="active"><a href="'.esc_url($link).'" class="checkbox-filter-ajax" data-type="order" data-value="' . $key . '">'.$value['name'].'</a>';
                                }else{
                                    echo '<li><a href="'.esc_url($link).'" class="checkbox-filter-ajax" data-type="order" data-value="' . $key . '">'.$value['name'].'</a>';

                                }
                            }
                        endif;
                        ?>
            </ul>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 text-center ajax-filter-wrapper-layout">
            <div class="sort_icon fist"><a class="<?php if($style=='2')echo'active'; ?> checkbox-filter-ajax" href="<?php echo esc_url(add_query_arg(array('style'=>2))) ?>" data-value="2"
                                           data-type="layout"><i class="fa fa-th-large "></i></a></div>
            <div class="sort_icon last"><a class="<?php if($style=='1')echo'active'; ?> checkbox-filter-ajax" href="<?php echo esc_url(add_query_arg(array('style'=>1))) ?>" data-value="1"
                                           data-type="layout"><i class="fa fa-list "></i></a></div>
        </div>
    </div>
</div>

<?php wp_nonce_field( 'ajax-search', '_wpnonce_search_ajax' ) ?>

<div class="ajax-filter-cover">
    <div class="ajax-filter-loading">
        <img src="<?php echo ST_TRAVELER_URI; ?>/img/loading-filter-ajax.gif"
             alt="<?php echo __('Loading tours', ST_TEXTDOMAIN); ?>"/>
    </div>
    <div id="ajax-filter-content"></div>
</div>

<?php   //echo st()->load_template('hotel/loop',false,array('style'=>$style,"taxonomy"=>$taxonomy));?>

<div class="row" style="margin-bottom: 40px;">
    <div class="col-sm-12">
        <hr>
        <p class="gap"></p>
    </div>
    <div class="col-md-6">
        <div id="ajax-filter-pag"></div>
    </div>
    <div class="col-md-6 text-right">
        <p>
            <?php st_the_language('not_what_you_looking_for') ?>
            <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">
                <?php st_the_language('try_search_again') ?>
            </a>
        </p>
    </div>
</div>
