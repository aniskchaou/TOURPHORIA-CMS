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
global $st_search_query;
$default=array(
    'style'=>'1'
);
if(isset($arg)){
    extract(wp_parse_args($arg,$default));
}else{
    extract($default);
}
if(STInput::get('style','') != ''){
    $style = STInput::get('style','1');
}

$transfer=new STCarTransfer();
$allOrderby=$transfer->getOrderby();
?>
<div class="nav-drop booking-sort"></div>
<div class="sort_top">
    <div class="row">
        <div class="col-md-10 col-sm-9 col-xs-9">
            <ul class="nav nav-pills">
                <?php
                         wp_reset_query();
                        $active = STInput::request('orderby');
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
                                        case 'template-transfer-search.php':
                                            $link = add_query_arg(array('orderby'=>$key), home_url( '/?s=&post_type=car_transfer' ));
                                            break;          
                                    }
                                }else{
                                    $link =  add_query_arg('orderby', $key);
                                }
                                if($active == $key){
                                    echo '<li class="active"><a href="'.esc_url($link).'">'.$value['name'].'</a>';
                                }elseif($key == 'new' and empty($active)){
                                    echo '<li class="active"><a href="'.esc_url($link).'">'.$value['name'].'</a>';
                                }else{
                                    echo '<li><a href="'.esc_url($link).'">'.$value['name'].'</a>';

                                }
                            }
                        endif;
                        ?>
            </ul>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 text-center"> 
            <?php 
                if(!is_page_template( 'template-transfer-search.php' )):
            ?>
                <div class="sort_icon fist"><a class="<?php if($style=='2')echo'active'; ?>" href="<?php echo esc_url(add_query_arg(array('style'=>2))) ?>"><i class="fa fa-th-large "></i></a></div>
            <?php endif; ?>
            <div class="sort_icon last"><a class="<?php if($style=='1')echo'active'; ?>" href="<?php echo esc_url(add_query_arg(array('style'=>1))) ?>"><i class="fa fa-list "></i></a></div>
        </div>
    </div>
</div>
<?php   echo st()->load_template('car_transfer/loop',false,array('style'=>$style,"taxonomy"=>$taxonomy));?>
<div class="row" style="margin-bottom: 40px;">
    <div class="col-sm-12">
        <hr>
        <p class="gap"></p>
    </div>
    <div class="col-md-6"> 
        <p>
            <small>
            <?php 
                if( is_rtl() || st()->get_option('right_to_left') == 'on'):
            ?>
            <?php
                if(!empty($st_search_query)){
                    $wp_query = $st_search_query;
                }
                if($wp_query->found_posts):
                    st_the_language('showing');
                    $page=get_query_var('paged');
                    $posts_per_page=get_query_var('posts_per_page');
                    if(!$page) $page=1;
                    $last=$posts_per_page*($page);
                    if($last>$wp_query->found_posts) $last=$wp_query->found_posts;
                    echo ' '.($posts_per_page*($page-1)+1).' - '.$last;
                endif;
            ?>
             .&nbsp;&nbsp;<?php echo balanceTags($transfer->get_result_string())?>
                
            <?php else: ?>
             <?php echo balanceTags($transfer->get_result_string())?>. &nbsp;&nbsp;
            <?php
                if(!empty($st_search_query)){
                    $wp_query = $st_search_query;
                }
                if($wp_query->found_posts):
                    st_the_language('showing');
                    $page=get_query_var('paged');
                    $posts_per_page=get_query_var('posts_per_page');
                    if(!$page) $page=1;
                    $last=$posts_per_page*($page);
                    if($last>$wp_query->found_posts) $last=$wp_query->found_posts;
                    echo ' '.($posts_per_page*($page-1)+1).' - '.$last;
                endif;
            ?>
            <?php endif; ?>
            </small>
        </p>
        <div class="row">
            <?php
            TravelHelper::paging(); ?>
        </div>
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
