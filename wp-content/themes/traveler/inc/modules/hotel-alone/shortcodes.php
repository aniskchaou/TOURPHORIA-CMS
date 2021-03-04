<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/04/2018
 * Time: 14:24 CH
 */
if(!function_exists('hotel_alone_vc_about')) {
    function hotel_alone_vc_about($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'style' => 'style-1',
            'icon' => '',
            'title' => '',
            'description' => '',
            'link' => '',
            'extra_class' => ''
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-about/about-'.$style, false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_about', 'hotel_alone_vc_about');


}
if(!function_exists('hotel_alone_vc_banner_single_room')){
    function hotel_alone_vc_banner_single_room($atts, $content = false){
        $output = $title_source = $title =  $title_color =   '';
        extract($data = shortcode_atts(array(
            'style' => 'style-1',
            'link_scroll' => '',
        ),$atts));
        $output = st_hotel_alone_load_view( 'elements/st-banner-single-room/'.$style , false , array( 'data' => $data ) );
        return $output;
    }
    st_reg_shortcode('hotel_alone_banner_single_room', 'hotel_alone_vc_banner_single_room');
}
if(!function_exists('hotel_alone_vc_blog') ){
    function hotel_alone_vc_blog($atts, $content = false){
        $output = $style = $number_items = $select_category = $order_by = $order = $show_load_more = $type = $carousel_style = $isotope_style = $load_more = '';
        $atts = shortcode_atts(array(
            'type' => 'grid',
            'style' => 'style-1',
            'carousel_style' => 'style-1',
            'isotope_style' => 'style-1',
            'load_more' => 'yes',
            'number_items' => '3',
            'select_category' => '',
            'order_by' => 'ID',
            'order' => 'DESC'
        ),$atts);
        extract($atts);

        $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
        }

        $args = array(
            'post_type' => 'post',
            'orderby' => $order_by,
            'order' => $order,
            'posts_per_page' => (int)$number_items,
            'paged' => $paged,
        );

        $list_cat = '';
        if (!empty($select_category)) {
            $list_cat = explode(",", $select_category);
            $args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $list_cat,
            );
        }
        $blog_query = new WP_Query($args);
        if($blog_query->have_posts()) {
            if($style != 'style-activity'){
                if ($type == 'grid') {
                    $output .= '<div class="st-posts post-row '.($style=='style-2'?'no-padding':'').'">';
                    $index = 1;
                    while($blog_query->have_posts()) {
                        $blog_query->the_post();
                        $class = 'col-3';
                        if($style == 'style-2'){
                            $class = 'col-4';
                        }
                        $output .= '<div class="'.$class.'">';
                        $output .= st_hotel_alone_load_view('blog/item-style/grid-' . $style, false, array(
                            'index' => $index
                        ));
                        $output .= '</div>';
                        $index++;
                    }
                    $output .= '</div>';
                } elseif ($type == 'list') {
                    $style = 'style-1';
                    echo '<div class="st-posts">';
                    while($blog_query->have_posts()) {
                        $blog_query->the_post();
                        $output .= st_hotel_alone_load_view('blog/item-style/list-' . $style, false, array());
                    }
                    echo '</div>';
                } elseif ($type == 'carousel'){
                    $item = 3;
                    if($carousel_style == 'style-2'){
                        $item = 1;
                    }

                    $output .= '<div class="st-posts post-carousels"><div class="st-post-carousel owl-carousel '.$carousel_style.'" data-item="'.$item.'">';
                    while($blog_query->have_posts()) {
                        $blog_query->the_post();
                        $output .= st_hotel_alone_load_view('blog/item-style/carousel-' . $carousel_style, false, null);
                    }
                    $output .= '</div></div>';
                }
                elseif ($type == 'isotope'){
                    $output .= st_hotel_alone_load_view('elements/st-blog/isotope/isotope-control',false,array(
                        'list_cat' => $list_cat
                    ));
                    $index = 1;
                    $output .= '<div class="row '.$isotope_style.'">
                        <div class="st-posts post-isotope '.$isotope_style.'">';
                    while($blog_query->have_posts()){
                        $blog_query->the_post();
                        $output .= st_hotel_alone_load_view('blog/item-style/isotope-'.$isotope_style,false,array(
                            'index' => $index
                        ));
                        $index++;
                    }
                    $output .= '</div></div>';
                    if($load_more == 'yes'){
                        $output .= '<div class="control-loadmore text-center">';
                        $text = array(
                            'loading' => esc_html__('Loading ...', ST_TEXTDOMAIN),
                            'load_more' => esc_html__('Load more', ST_TEXTDOMAIN),
                            'no_more' => esc_html__('No more', ST_TEXTDOMAIN)
                        );
                        $output .= '<a href="#"
                                        class="load_more_post '.($blog_query->max_num_pages == 1?'disabled':'').'"
                                        id="load_more_post"
                                        data-text=\''.json_encode($text).'\'
                                        data-posts-per-page = "'.$number_items.'"
                                        data-paged = "1"
                                        data-order = "'.$order.'"
                                        data-order-by = "'.$order_by.'"
                                        data-tax-query = "'.esc_attr($select_category).'"
                                        data-max-num-page = "'.$blog_query->max_num_pages.'"
                                        data-style = "'.$isotope_style.'"
                                        data-index = "'.$index.'"
                                        >
                                        '.(((int)$blog_query->max_num_pages == 1)? esc_html__(  'No More' , ST_TEXTDOMAIN ): esc_html__(  'Load More' ,ST_TEXTDOMAIN )).'
                                    </a>
                                    ';
                        $output .= '</div>';
                    }
                }
            } else {
                while($blog_query->have_posts()) {
                     $blog_query->the_post();?>
                    <div class="col-4">
                        <div class="blog-item">
                            <div class="header-thumb">
                                <a href="<?php the_permalink();?>">
                                    <?php
                                        if(has_post_thumbnail() and get_the_post_thumbnail()){
                                            echo get_the_post_thumbnail(get_the_ID(), array(370, 370));
                                        }else{
                                            echo st_get_default_image();
                                        }
                                    ?>
                                </a>
                            </div>
                            <div class="caption-post">
                                <div class="category">
                                    <?php the_category(', '); ?>
                                </div>
                                <h3 class="title">
                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                </h3>
                                <div class="date">
                                    <span class="date-post"><?php echo get_the_date('d M Y');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            }
        }
        wp_reset_postdata();
        return $output;
    }

    st_reg_shortcode('hotel_alone_blog','hotel_alone_vc_blog');

// ajax default
    if (!function_exists('hotel_alone_load_more_post')){
        function hotel_alone_load_more_post()
        {
            $posts_per_page = STInput::request('posts_per_page');
            $st_paged          = STInput::request('paged') + 1;
            $order          = STInput::request('order');
            $order_by       = STInput::request('order_by');
            $select_category      = STInput::request('tax_query');
            $isotope_style      = STInput::request('style');
            $index      = STInput::request('index');

            $args = array(
                'post_type' => 'post',
                'orderby' => $order_by,
                'order' => $order,
                'posts_per_page' => (int)$posts_per_page,
                'paged' => $st_paged,
            );
            if (!empty($select_category)) {
                $st_list_cat = explode(",", $select_category);
                $args['tax_query'][] = array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $st_list_cat,
                );
            }
            $return = array(
                'status' => 0
            );
            $return['paged'] = $st_paged ;
            $return['html'] = "" ;
            $st_pride_query = new WP_Query($args);
            while($st_pride_query->have_posts()) {
                $st_pride_query->the_post();
                $return['html'] .= st_hotel_alone_load_view('blog/item-style/isotope-'.$isotope_style,false, array('index' => $index));
                $index = intval($index) + 1;
            }
            $return['index'] = $index ;
            $return['status'] = 1;
            wp_reset_postdata();
            wp_send_json($return);
            die();
        }
        add_action('wp_ajax_st_hotel_alone_load_more_post','hotel_alone_load_more_post');
        add_action('wp_ajax_nopriv_st_hotel_alone_load_more_post','hotel_alone_load_more_post');
    }

}
if(!function_exists( 'hotel_alone_vc_booking_room' ) ) {
    function hotel_alone_vc_booking_room( $atts , $content = false )
    {
        extract( $data = shortcode_atts( array(
            'style'             => 'style-1' ,
            'title'             => '' ,
            'phone'        => '' ,
            'hotel_room_fields' => '' ,
        ) , $atts ) );
        $output          = st_hotel_alone_load_view('elements/st-booking-room/'.$style , false , array( 'data' => $data ) );
        return $output;
    }
    st_reg_shortcode( 'hotel_alone_booking_room' , 'hotel_alone_vc_booking_room' );

}
if(!function_exists('hotel_alone_vc_breadcrumb') ){
    function hotel_alone_vc_breadcrumb($atts, $content = false){
        $output = $title_source = $title =  $title_color =   '';
        extract(shortcode_atts(array(
            'title_source' => 'custom_title',
            'title' => '',
            'title_color' => '',
        ),$atts));
        if($title_source == 'get_title' && !empty(get_the_ID())){
            $title = get_the_title(get_the_ID());
        }
        if(!empty($title_color)){
            $title_color = Hotel_Alone_Helper::inst()->build_css(' color: '.$title_color.' !important ');
        }
        $output .= '<div class="helios-breadcrumb">
                        <div class="center text-center">';
        $output .= '<h3 class="title '.esc_attr($title_color).'">'.esc_html($title).'</h3>';
        $output .= '<div class="helios-breadcrumb text-color">' . hotel_alone_display_breadcrumbs() . '</div>';
        $output .= '</div></div>';
        return $output;
    }
    st_reg_shortcode('hotel_alone_breadcrumb', 'hotel_alone_vc_breadcrumb');

}
if(!function_exists('st_vc_clients')) {
    function st_vc_clients($atts, $content = false)
    {
        $output = '';

        $atts = shortcode_atts(array(
            'list_clients' => '',
            'items' => 4,
            'extra_class' => ''
        ),$atts);

        $output .= st_hotel_alone_load_view('elements/st-clients/st-clients', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('st_clients', 'st_vc_clients');



}
if(!function_exists('hotel_alone_vc_form_search_room')){
    function hotel_alone_vc_form_search_room($atts, $content = false){
        extract( $data = shortcode_atts( array(
            'title'             => '' ,
            'service_id'        => '' ,
            'hotel_room_fields' => '' ,
        ) , $atts ) );
        $data[ 'title' ] = $content;
        $output          = st_hotel_alone_load_view( 'elements/st-form-search-room/st-form-search' , false , array( 'data' => $data ) );
        return $output;
    }
    st_reg_shortcode('hotel_alone_form_search_room', 'hotel_alone_vc_form_search_room');

}
if(!function_exists('hotel_alone_vc_el_hotel_info') ) {
    function hotel_alone_vc_el_hotel_info($atts, $content = false)
    {
        $output = '';

        $atts = shortcode_atts(array(
            'logo' => '',
            'title' => '',
            'sub_title' => '',
            'star' => 5,
            'hotline' => '',
            'description' => '',
            'extra_class' => ''
        ), $atts);

        $output = st_hotel_alone_load_view('elements/st-hotel-info/hotel-info', false, array('atts' => $atts));

        return $output;
    }

    st_reg_shortcode('hotel_alone_el_hotel_info', 'hotel_alone_vc_el_hotel_info');


}
if(!function_exists('hotel_alone_func_list_feature_hotel_room')){
    function hotel_alone_func_list_feature_hotel_room($atts, $content = false){
        $data = shortcode_atts(array(
            'style' => 'style-1',
            'service_id' => '',
            'select_category' => '',
            'number_post' => '2',
            'order_by' => 'ID',
            'order' => 'DESC',
            'use_ids' => 'no',
            'service_ids' => '',
            'title' => '',
            'description' => '',
        ), $atts);
        extract($data);
        $output = st_hotel_alone_load_view( 'elements/st-list-feature-hotel-room/'.$style , false , array( 'data' => $data ) );
        return $output;
    }
    st_reg_shortcode('hotel_alone_list_feature_hotel_room', 'hotel_alone_func_list_feature_hotel_room');

}
if(!function_exists('hotel_alone_vc_list_offers')){
    function hotel_alone_vc_list_offers($atts, $content = false){
        $output = $order_by = $order = $number_items = $style = '';
        $atts = shortcode_atts(array(
            'style' => 'style-1',
            'list_offfer' => '',
            'title' => '',
            'sub_title' => '',
            'description' => ''
        ),$atts);

        extract($atts);
        wp_enqueue_script('hotel-alone-slick-js');
        wp_enqueue_style('hotel-alone-slick-css');


        $output .= st_hotel_alone_load_view('elements/st-list-offers/offer-'.$style, false, array(
            'atts' => $atts
        ));

        return $output;
    }
    st_reg_shortcode('hotel_alone_list_offers','hotel_alone_vc_list_offers');

}
if(!function_exists('hotel_alone_vc_room_related')) {
    function hotel_alone_vc_room_related($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'number_post' => '3',
            'extra_class' => '',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-related/list-room', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_related', 'hotel_alone_vc_room_related');


}
if(!function_exists('hotel_alone_vc_reservation_contact') ) {
    function hotel_alone_vc_reservation_contact($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'description' => '',
            'phone' => '',
            'email' => '',
            'extra_class' => ''
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-reservation-contact/content', false, array(
            'atts' => $atts
        ));

        return $output;
    }
    st_reg_shortcode('hotel_alone_reservation_contact', 'hotel_alone_vc_reservation_contact');

}
if(!function_exists( 'hotel_alone_vc_reservation_content' )) {
    function hotel_alone_vc_reservation_content( $atts , $content = false )
    {
        extract( $data = shortcode_atts( array(
            'service_id' => '' ,
            'style'      => 'style-1' ,
        ) , $atts ) );
        $output = st_hotel_alone_load_view('elements/st-reservation-content/reservation-content' , false , array( 'data' => $data ) );
        return $output;
    }
    st_reg_shortcode( 'hotel_alone_reservation_content' , 'hotel_alone_vc_reservation_content' );

}
if(!function_exists( 'hotel_alone_vc_reservation_room' )) {
    function hotel_alone_vc_reservation_room( $atts , $content = false )
    {
        extract( $data = shortcode_atts( array(
            'title'             => '' ,
            'service_id'        => '' ,
            'hotel_room_fields' => '' ,
        ) , $atts ) );
        $data[ 'title' ] = $content;
        $output          = st_hotel_alone_load_view( 'elements/st-reservation-room/st-form-search' , false , array( 'data' => $data ) );
        return $output;
    }
    st_reg_shortcode( 'hotel_alone_reservation_room' , 'hotel_alone_vc_reservation_room' );

}
if(!function_exists('hotel_alone_vc_room_discount_by_day_info') ) {
    function hotel_alone_vc_room_discount_by_day_info($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'number_of_row' => '4',
            'extra_class' => '',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-discount-by-day-info/info', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_discount_by_day_info', 'hotel_alone_vc_room_discount_by_day_info');


}
if(!function_exists('hotel_alone_vc_room_extra_info') ) {
    function hotel_alone_vc_room_extra_info($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'extra_class' => ''
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-extra-info/info', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_extra_info', 'hotel_alone_vc_room_extra_info');


}
if(!function_exists('hotel_alone_vc_room_facility_info') ) {
    function hotel_alone_vc_room_facility_info($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'number_of_row' => '4',
            'extra_class' => '',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-facility-info/info', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_facility_info', 'hotel_alone_vc_room_facility_info');


}
if(!function_exists('hotel_alone_vc_room_in_out_info') ) {
    function hotel_alone_vc_room_in_out_info($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'number_of_row' => '4',
            'extra_class' => '',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-in-out-info/info', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_in_out_info', 'hotel_alone_vc_room_in_out_info');


}
if(!function_exists('hotel_alone_vc_room_info') ) {
    function hotel_alone_vc_room_info($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'extra_class' => '',
            'style' => 'style-1',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-info/'.$style, false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_info', 'hotel_alone_vc_room_info');


}
if(!function_exists('hotel_alone_vc_room_meta') ) {
    function hotel_alone_vc_room_meta($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'meta' => 'room_description',
            'extra_class' => '',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-meta/info', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_meta', 'hotel_alone_vc_room_meta');


}
if(!function_exists('hotel_alone_vc_room_taxonomy_info') ) {
    function hotel_alone_vc_room_taxonomy_info($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'number_of_row' => '4',
            'extra_class' => '',
            'choose_taxonomy' => 'room_type',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-room-taxonomy-info/info', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_room_taxonomy_info', 'hotel_alone_vc_room_taxonomy_info');

}
if(!function_exists('st_vc_share') ) {
    function st_vc_share($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'title' => '',
            'extra_class' => '',
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-share/share', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('st_share', 'st_vc_share');

}
if(!function_exists('hotel_alone_vc_signature') ) {
    function hotel_alone_vc_signature($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'sig_image' => '',
            'name' => '',
            'position' => '',
            'align' => 'left',
            'extra_class' => ''
        ),$atts);

        $output .= st_hotel_alone_load_view('elements/st-signature/signature', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_signature', 'hotel_alone_vc_signature');

}
if(!function_exists('hotel_alone_vc_slider') ){
    function hotel_alone_vc_slider($atts, $content = false){

        extract($data = shortcode_atts(array(
            'style' => 'style-1',
            'form_search' => '',
            'list_item_slider' => '',
            'st_title' => '',
            'st_content' => '',
            'st_sub_title' => '',
            'list_images' => '',
            'st_link_viewmore' => '',
            'link_scroll' => '#',
            'text_sroll_1' => '',
            'text_sroll_2' => '',
        ), $atts));

        $html = st_hotel_alone_load_view('elements/st-slider/st-slider', false,array('data'=>$data));

        return $html;
    }
    st_reg_shortcode('hotel_alone_slider', 'hotel_alone_vc_slider');

}
if(!function_exists('st_vc_socials') ) {
    function st_vc_socials($atts, $content = false)
    {
        $output = '';

        $atts = shortcode_atts(array(
            'align' => 'text-left',
            'follow_us' => '',
            'list_social' => '',
            'extra_class' => ''
        ),$atts);

        $output .= st_hotel_alone_load_view('elements/st-socials/st-socials', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('st_socials', 'st_vc_socials');

}
if(!function_exists('hotel_alone_vc_special_services') ) {
    function hotel_alone_vc_special_services($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'style' => 'style-1',
            'list_style_1' => '',
            'list_style_2' => ''
        ),$atts);
        extract($atts);

        $output .= st_hotel_alone_load_view('elements/st-special-services/special-services-'.$style, false, array(
            'atts' => $atts
        ));

        return $output;
    }
    st_reg_shortcode('hotel_alone_special_services', 'hotel_alone_vc_special_services');

}
if(!function_exists('hotel_alone_vc_testimonials') ) {
    function hotel_alone_vc_testimonials($atts, $content = false)
    {
        $output = '';

        $atts = shortcode_atts(array(
            'style' => 'style-1',
            'show_nav' => 1,
            'show_pagi' => 1,
            'v_style' => 'light',
            'lists' => '',
            'extra_class' => ''
        ),$atts);

        $output .= st_hotel_alone_load_view('elements/st-testimonials/st-testimonials', false, array(
            'atts' => $atts
        ));

        return $output;
    }

    st_reg_shortcode('hotel_alone_testimonials', 'hotel_alone_vc_testimonials');

}
if(!function_exists('hotel_alone_vc_title') ) {
    function hotel_alone_vc_title($atts, $content = false){
        $output = $title_link = $text_align = $extra_class = $heading = $title_font = $separator = '';
        $atts = shortcode_atts(array(
            'sub_title' => '',
            'title' => '',
            'separator' => 'yes',
            'title_link' => '',
            'heading' => 'h3',
            'title_font_size' => '',
            'title_line_height' => '',
            'title_font_weight' => '400',
            'text_align' => 'center',
            'title_color' => '',
            'title_font_style' => '',
            'title_font' => '',
            'm_bottom' => 0,
            'extra_class' => ''
        ), $atts);
        extract($atts);

        if(empty($title)){
            return '';
        }

        $link = vc_build_link($title_link);

        $style_str = $title_new = $link_color = '';
        if(!empty($title_font_size)){
            $style_str .= 'font-size: '.$title_font_size.'px !important;';
        }
        if(!empty($title_line_height)){
            $style_str .= 'line-height: '.$title_line_height.'px !important;';
        }
        if(!empty($title_font_weight)){
            $style_str .= 'font-weight: '.$title_font_weight.' !important;';
        }
        if(!empty($title_font_style)){
            $style_str .= 'font-style: '.$title_font_style.' !important;';
        }
        if(!empty($title_color)){
            $style_str .= 'color: '.$title_color.' !important;';
            $link_color = Hotel_Alone_Helper::inst()->build_css('color: '.$title_color.' !important');
        }

        if(!empty($sub_title)){
            $sub_title = '<p class="sub-title">'.$sub_title.'</p>';
        }

        $style_str .= 'text-align: '.$text_align.' !important;';
        $align = Hotel_Alone_Helper::inst()->build_css('text-align: '.$text_align.' !important;');

        $style_class = Hotel_Alone_Helper::inst()->build_css($style_str);

        if(!empty($link['url'])){
            $title_new = '<a class="'.$link_color.'" href="'.$link['url'].'" '.(isset($link['title'])?'title="'.$link['title'].'"':'').' '.(isset($link['target'])?'target="'.$link['target'].'"':'').' '.(isset($link['rel'])?'rel="'.$link['rel'].'"':'').'>'.$title.'</a>';
        }else{
            $title_new = $title;
        }

        $margin_css = '';
        if(!empty($m_bottom)){
            $margin_css = Hotel_Alone_Helper::inst()->build_css('margin-bottom: '.$m_bottom.'px');
        }

        $output .= '<div class="helios-heading '.$align.' '.$extra_class.' '.$margin_css.' '.$text_align.' '.$separator.'">';
        $output .= $sub_title;
        $title_new = str_replace('{','[',$title_new);
        $title_new = str_replace('}',']',$title_new);
        $output .= '<'.$heading.' class="helios-title '.$style_class.' '.$title_font.'">'.do_shortcode($title_new).'</'.$heading.'>';
        $output .= '</div>';

        return $output;
    }

    st_reg_shortcode('hotel_alone_title', 'hotel_alone_vc_title');

}
if(!function_exists('st_vc_video')) {
    function st_vc_video($atts, $content = false)
    {
        $output = $style = '';

        $atts = shortcode_atts(array(
            'style' => 'style-1',
            'link' => '',
            'background_image' => '',
            'title_color' => '',
            'label_color' => '',
            'extra_class' => '',
            'height' => '',
            'enable_label' => 'yes',
            'overlay' =>''
        ),$atts);

        wp_enqueue_script('mb-YTPlayer');

        $output .= st_hotel_alone_load_view('elements/st-video/st-video', false, array(
            'atts' => $atts,
            'content' => $content
        ));

        return $output;
    }

    st_reg_shortcode('st_video', 'st_vc_video');

}
if ( ! function_exists( 'st_vc_weather' ) ) {
    function st_vc_weather( $atts, $content = false ) {
        $output = $style = '';

        $atts = shortcode_atts( array(
            'location_id' => '',
            'show_time'   => '',
            'extra_class' => ''
        ), $atts );
        extract( $atts );

        $output .= st_hotel_alone_load_view( 'elements/st-weather/weather', false, array(
            'atts' => $atts
        ) );

        return $output;
    }

    st_reg_shortcode( 'st_weather', 'st_vc_weather' );

}
