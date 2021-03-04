<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity content
 *
 * Created by ShineTheme
 *
 */
global $wp_query,$st_search_query;
if($st_search_query){
    $query=$st_search_query;
}else $query=$wp_query;
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
        $obj = get_post_type_object( $query->query['post_type'] );
        $rs_string ="";
        switch($query->query['post_type']){
            case "st_hotel":
                $class = new STHotel();
                $rs_string .= $class->get_result_string();
                $page_search = st()->get_option('hotel_search_result_page');
                break;
            case "st_rental":
                $class = new STRental();
                $rs_string .= $class->get_result_string();
                $page_search = st()->get_option('rental_search_result_page');
                break;
            case "st_cars":
                $class = new STCars();
                $rs_string .= $class->get_result_string();
                $page_search = st()->get_option('cars_search_result_page');
                break;
            case "st_tours":
                $class = new STTour();
                $rs_string .= $class->get_result_string();
                $page_search = st()->get_option('tours_search_result_page');
                break;
            case "st_activity":
                $class = STActivity::inst();
                $rs_string .= $class->get_result_string();
                $page_search = st()->get_option('activity_search_result_page');
                break;
        }
        echo '
        <div class="row">
            <div class="col-md-3"><h3>'.$obj->labels->singular_name.'</h3></div>
            <div class="col-md-9 text-right">
                <h3>'.$rs_string.'</h3>
            </div>
        </div>
        ';
        if(!empty($page_search)){
            $link_view_all =st_get_link_with_search(get_permalink($page_search),array('location_name','location_id','item_name','price_range','pick-up','location_id_pick_up'),$_GET);
            if($query->query['post_type'] == 'st_cars'){
                $link_view_all = add_query_arg(array('pick-up'=>STInput::request('location_name'),'location_id_pick_up'=>STInput::request('location_id')) , $link_view_all);
            }
        }else{
            $link_view_all = "#";
        }
        $content ="";
        $i=0;
        while(have_posts()){
            the_post();
            $post_type = get_post_type();
            if($i < $st_number ) {
                switch( $post_type ) {
                    case "st_hotel":
                        if($st_style == '1') {
                            $content .= st()->load_template( 'hotel/loop' , 'list' );
                        }
                        if($st_style == '2') {
                            $content .= st()->load_template( 'hotel/loop' , 'grid' );
                        }
                        break;
                    case "st_rental":
                        if($st_style == '1') {
                            $content .= st()->load_template( 'rental/loop' , 'list' );
                        }
                        if($st_style == '2') {
                            $content .= st()->load_template( 'rental/loop' , 'grid' );
                        }
                        break;
                    case "st_cars":
                        if($st_style == '1') {
                            $content .= st()->load_template( 'cars/elements/loop/loop-1' );
                        }
                        if($st_style == '2') {
                            $content .= st()->load_template( 'cars/elements/loop/loop-2' );
                        }
                        break;
                    case "st_tours":
                        if($st_style == '1') {
                            $content .= st()->load_template( 'tours/elements/loop/loop-1' );
                        }
                        if($st_style == '2') {
                            $content .= st()->load_template( 'tours/elements/loop/loop-2' );
                        }
                        break;
                    case "st_activity":
                        if($st_style == '1') {
                            $content .= st()->load_template( 'activity/elements/loop/loop-1' );
                        }
                        if($st_style == '2') {
                            $content .= st()->load_template( 'activity/elements/loop/loop-2' );
                        }
                        break;
                }
            }
            $i++;
        }
        ?>
        <?php
        if($st_style == '1'){
            echo '<ul class="booking-list loop-cars style_list">'.$content.'</ul>';
        }
        if($st_style == '2'){
            echo '<div class="row row-wrap isotope-container">'.$content.'</div>';
        }
        ?>
        <div class="row">
            <div class="col-md-12 text-right">
                <?php  if($query->found_posts > $st_number){ ?>
                    <a href="<?php  echo esc_url($link_view_all) ?>"><?php _e("View All",ST_TEXTDOMAIN) ?> <?php echo esc_html($obj->labels->singular_name)?></a>
                <?php } ?>
            </div>
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
    </div>
</div>