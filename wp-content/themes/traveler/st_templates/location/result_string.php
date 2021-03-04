<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * location result string
 *
 * Created by ShineTheme
 *
 */
    wp_enqueue_script('magnific.js' );
    
    
    global $wp_query,$st_search_query;

    if($st_search_query){
        $query=$st_search_query;
    }else $query=$wp_query;
    
    if ($post_type == 'st_cars'){
        $obj=new STCars();
        $layout_id = st()->get_option('cars_search_result_page' , false);
    }
    if ($post_type == 'st_tours'){
        $obj=new STTour();
        $layout_id = st()->get_option('tours_search_result_page' , false);
    }
    if ($post_type == 'st_hotel'){
        $obj=new STHotel();
        $layout_id = st()->get_option('hotel_search_result_page' , false);
    }
    if ($post_type == 'st_activity'){
        $obj=STActivity::inst();
        $layout_id = st()->get_option('activity_search_result_page' , false);
    }
    if ($post_type == 'st_rental'){
        $obj=new STRental();
        $layout_id = st()->get_option('rental_search_result_page' , false);
    }
    
    $allOrderby=$obj->getOrderby();
?>
<div class="row">
    <div class="col-md-12">

        <div class="row" style="margin-bottom: 40px">
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-md-6">
                <p>
                    <small><?php echo __("Total: " , ST_TEXTDOMAIN) ; ?></small>
                    <small>
                        <?php echo balanceTags($obj->get_result_string())?>. &nbsp;&nbsp;
                        <?php
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
                    </small>
                    <?php 
                    $location_key = "location_id" ; 
                    if (!empty($post_type) and $post_type =='st_cars'){$location_key = 'location_id_pick_up' ; }
                    if ($layout_id){
                        $link      = esc_url(add_query_arg(array(
                            $location_key => $location_id,                            
                        ), get_permalink($layout_id)));
                    }else{
                        $link      = esc_url(add_query_arg(array(
                            'post_type' => $post_type,
                            'location_name' => $location_title,
                            $location_key => $location_id,
                            's' => '',
                            'layout' => $layout_id ? $layout_id : ''
                        ), home_url()));
                    }
                        
                    ?>
                    <small> <a href='<?php echo esc_attr($link);?>'><?php echo __(" view all " , ST_TEXTDOMAIN) ;  ?></a></small>
                </p>
                <?php
                //TravelHelper::paging(); ?>
            </div>
            <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="<?php echo esc_attr($post_type) ; ?>search-dialog">
                <?php  
                $quy = explode('_', $post_type);
                echo st()->load_template($quy[1].'/search-form');?>
            </div>
            <div class="col-md-6 text-right">
                <p>
                    <?php st_the_language('not_what_you_looking_for') ?>
                    <a class="popup-text" href="#<?php echo esc_attr($post_type) ; ?>search-dialog" data-effect="mfp-zoom-out">
                        <?php st_the_language('try_your_search_again') ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>