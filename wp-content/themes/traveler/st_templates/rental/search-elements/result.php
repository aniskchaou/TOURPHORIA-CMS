<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Rental result
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script('magnific.js' );
            
$default=array(
    'style'=>'list',
    'taxonomy'=>'',
);
global $wp_query, $st_search_query;
if ($st_search_query) {
    $query = $st_search_query;
} else $query = $wp_query;

if(isset($arg)){
    extract(wp_parse_args($arg,$default));
}else{
    extract($default);
}
if(STInput::get('style','') != ''){
    $style=STInput::get('style','list');
}
$object=new STRental();
$allOrderby=$object->getOrderby();
?>
<div class="nav-drop booking-sort">
</div>

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
            <div class="sort_icon fist"><a class="<?php if($style=='2')echo'active'; ?>" href="<?php echo esc_url(add_query_arg(array('style'=>2))) ?>"><i class="fa fa-th-large "></i></a></div>
            <div class="sort_icon last"><a class="<?php if($style=='1')echo'active'; ?>" href="<?php echo esc_url(add_query_arg(array('style'=>1))) ?>"><i class="fa fa-list "></i></a></div>
        </div>
    </div>
</div>
<?php   echo st()->load_template('rental/loop',false,array('style'=>$style,"taxonomy"=>$taxonomy));?>
<div class="row" style="margin-bottom: 40px;">
    <div class="col-sm-12">
        <hr>
    </div>
    <div class="col-md-6">
        <p>
            <small><?php echo balanceTags($object->get_result_string())?>. &nbsp;&nbsp;
                <?php
                if($query->found_posts):
                    st_the_language('rental_showing');
                    $page=get_query_var('paged');
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
        </div>
    </div>
    <div class="col-md-6 text-right">
        <p>
            <?php st_the_language('rental_not_what_you_looking_for') ?>
            <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">
                <?php st_the_language('rental_try_your_search_again') ?>
            </a>
        </p>
    </div>
</div>
