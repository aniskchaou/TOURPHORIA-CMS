<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars content cars
 *
 * Created by ShineTheme
 *
 */
    wp_enqueue_script('magnific.js' );
wp_enqueue_script('filter-ajax-cars.js');
    
    
    global $wp_query,$st_search_query;
    if($st_search_query){
        $query=$st_search_query;
    }else $query=$wp_query;
$cars=new STCars();
$allOrderby=$cars->getOrderby();
$orderby_key = TravelHelper::_parser_orderby_key($allOrderby);
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if(!empty($attr)){
            extract($attr);
        }else{
            $st_style='1';
        }
        $style = STInput::request('style');
        if(!empty($style)){
            $st_style = $style ;
        }
        ?>
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
                            echo '<input type="hidden" id="jcar-orderby" value="-1" />';
                            $active = STInput::request('orderby');
                        }
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
                                    echo '<li class="active"><a href="'.esc_url($link).'" class="checkbox-filter-ajax" data-type="order" data-value="' . $key . '">'.$value['name'].'</a>';
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
                <div class="col-md-2 col-sm-3 text-center col-xs-3 ajax-filter-wrapper-layout">
                    <div class="sort_icon fist"><a class="<?php if($st_style=='2')echo'active'; ?> checkbox-filter-ajax" href="<?php echo esc_url(add_query_arg(array('style'=>2))) ?>" data-value="2"
                                                   data-type="layout"><i class="fa fa-th-large "></i></a></div>
                    <div class="sort_icon last"><a class="<?php if($st_style=='1')echo'active'; ?> checkbox-filter-ajax" href="<?php echo esc_url(add_query_arg(array('style'=>1))) ?>" data-value="1"
                                                   data-type="layout"><i class="fa fa-list "></i></a></div>
                </div>
            </div>
        </div>

        <div class="ajax-filter-cover">
            <div class="ajax-filter-loading">
                <img src="<?php echo get_template_directory_uri(); ?>/img/loading-filter-ajax.gif"
                     alt="<?php echo __('Loading tours', ST_TEXTDOMAIN); ?>"/>
            </div>
            <div id="ajax-filter-content"></div>
        </div>

        <?php
            /*$content="";
            if($query->have_posts()) {
                while( $query->have_posts() ) {
                    $query->the_post();
                    if($st_style == '1'){
                        $content .=st()->load_template('cars/elements/loop/loop-1');
                    }
                    if($st_style == '2'){
                        $content .=  st()->load_template('cars/elements/loop/loop-2');
                    }
                }
            }else{
                echo '<div class="alert alert-warning">'.__("There are no available cars for this location, time and/or date you selected.",ST_TEXTDOMAIN).'</div>';
            }
            if($st_style == '1'){
                echo '<ul class="booking-list loop-cars style_list">'.$content.'</ul>';
            }
            if($st_style == '2'){
                echo '<div class="row row-wrap">'.$content.'</div>';
            }*/
        ?>

        <div class="row" style="margin-bottom: 40px">
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-md-6">
                <div id="ajax-filter-pag"></div>
                <!--<p>
                    <small><?php echo balanceTags($cars->get_result_string())?>. &nbsp;&nbsp;
                        <?php
                        if($query->found_posts):
                            st_the_language('car_showing');
                            if(get_query_var( 'paged' )) {
                                $page = get_query_var( 'paged' );
                            } else if(get_query_var( 'page' )) {
                                $page = get_query_var( 'page' );
                            } else {
                                $page = 1;
                            }
                            
                            $posts_per_page=get_query_var('posts_per_page');
                            if(!$page) $page=1;

                            $last=$posts_per_page*($page);

                            if($last>$query->found_posts) $last=$query->found_posts;
                            echo ' '.($posts_per_page*($page-1)+1).' - '.$last;
                        endif;
                        ?>
                    </small>
                </p>
                <div class="row">
                    <?php
                    TravelHelper::paging(); ?>
                </div>-->
            </div>
            <div class="col-md-6 text-right">
                <p>
                    <?php st_the_language('car_not_what_you_looking_for') ?>
                    <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">
                        <?php st_the_language('car_try_your_search_again') ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>